<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * BounceHandlerCommand
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class BounceHandlerCommand extends CConsoleCommand 
{
    // lock name
    protected $_lockName = 'bounce-handler';
    
    // flag 
    protected $_restoreStates = true;
    
    // flag
    protected $_improperShutDown = false;
    
    // current server
    protected $_server;
    
    public function init()
    {
        parent::init();
        
        // this will catch exit signals and restore states
        if (function_exists('pcntl_signal')) {
            declare(ticks = 1);
            pcntl_signal(SIGINT,  array($this, '_handleExternalSignal'));  
            pcntl_signal(SIGTERM, array($this, '_handleExternalSignal'));
            pcntl_signal(SIGHUP,  array($this, '_handleExternalSignal'));
        }
        
        register_shutdown_function(array($this, '_restoreStates'));
        Yii::app()->attachEventHandler('onError', array($this, '_restoreStates'));
        Yii::app()->attachEventHandler('onException', array($this, '_restoreStates'));
    }
    
    public function _handleExternalSignal($signalNumber)
    {
        // this will trigger all the handlers attached via register_shutdown_function
        $this->_improperShutDown = true;
        exit;
    }

    public function _restoreStates($event = null)
    {
        if (!$this->_restoreStates) {
            return;
        }
        $this->_restoreStates = false;
        
        // remove the lock
        Yii::app()->mutex->release($this->_lockName);
        
        // called as a callback from register_shutdown_function
        // must pass only if improper shutdown in this case
        //if ($event === null && !$this->_improperShutDown) {
        //    return;
        //}

        if (!empty($this->_server) && $this->_server instanceof BounceServer) {
            if ($this->_server->status == BounceServer::STATUS_CRON_RUNNING) {
                $this->_server->status = BounceServer::STATUS_ACTIVE;
                $this->_server->save(false);
            }
        }
    }
    
    public function actionIndex() 
    {
        // because some cli are not compiled same way with the web module.
        if (!function_exists('imap_open')) {
            return 1;
        }
        
        if (!Yii::app()->mutex->acquire($this->_lockName, 5)) {
            return 0;
        }
        
        Yii::import('common.vendors.BounceHandler.*');
        $options = Yii::app()->options;
        
        if ($memoryLimit =  $options->get('system.cron.process_bounce_servers.memory_limit')) {
            ini_set('memory_limit', $memoryLimit);    
        }
        
        $this->process(0, (int)$options->get('system.cron.process_bounce_servers.servers_at_once', 10));
        
        Yii::app()->mutex->release($this->_lockName);
        
        return 0;
    }
    
    protected function process($offset = 0, $limit = 10)
    {
        $servers = BounceServer::model()->findAll(array(
            'select'    => 't.server_id',
            'condition' => 't.status = :status',
            'params'    => array(':status' => BounceServer::STATUS_ACTIVE),
            'limit'     => (int)$limit,
            'offset'    => (int)$offset,
        ));
        
        if (empty($servers)) {
            return $this;
        }
        
        $serversIds = array();
        foreach ($servers as $server) {
            $serversIds[] = $server->server_id;
        }
        unset($servers, $server);
        
        $options = Yii::app()->options->resetLoaded();
        try {
            foreach ($serversIds as $serverId) {
                $this->_server = BounceServer::model()->findByPk((int)$serverId);
                if (empty($this->_server) || $this->_server->status != BounceServer::STATUS_ACTIVE) {
                    $this->_server = null;
                    continue;
                }
                $this->_server->status = BounceServer::STATUS_CRON_RUNNING;
                $this->_server->save(false);
                
                $bounceHandler = new BounceHandler($this->_server->getConnectionString(), $this->_server->username, $this->_server->password, array(
                    'returnOriginalEmailHeadersArray'   => true,
                    'deleteMessages'                    => true,
                    'processLimit'                      => (int)$options->get('system.cron.process_bounce_servers.emails_at_once', 500)
                ));
    
                $results = $bounceHandler->getResults();
                
                if (empty($results)) {
                    $this->_server = BounceServer::model()->findByPk((int)$this->_server->server_id);
                    if (empty($this->_server)) {
                        continue;
                    }
                    if ($this->_server->status == BounceServer::STATUS_CRON_RUNNING) {
                        $this->_server->status = BounceServer::STATUS_ACTIVE;
                        $this->_server->save(false);
                    }
                    continue;
                }
                
                foreach ($results as $result) {
                    foreach ($result['originalEmailHeadersArray'] as $key => $value) {
                        unset($result['originalEmailHeadersArray'][$key]);
                        $result['originalEmailHeadersArray'][strtoupper($key)] = $value;
                    }
                    
                    if (!isset($result['originalEmailHeadersArray']['X-MW-CAMPAIGN-UID'], $result['originalEmailHeadersArray']['X-MW-SUBSCRIBER-UID'])) {
                        continue;
                    }
                    
                    $campaignUid    = trim($result['originalEmailHeadersArray']['X-MW-CAMPAIGN-UID']);
                    $subscriberUid  = trim($result['originalEmailHeadersArray']['X-MW-SUBSCRIBER-UID']);
                    
                    $campaign = Campaign::model()->findByUid($campaignUid);
                    if (empty($campaign)) {
                        continue;
                    }
                    
                    $subscriber = ListSubscriber::model()->findByAttributes(array(
                        'list_id'           => $campaign->list->list_id,
                        'subscriber_uid'    => $subscriberUid,
                        'status'            => ListSubscriber::STATUS_CONFIRMED,
                    ));
                    
                    if (empty($subscriber)) {
                        continue;
                    }
                    
                    // NOTE: 
                    // in various circumstances this can produce duplicate results, 
                    // i.e: when same bounce server twice and the messages were not removed!
                    // the probability is small, but it's there
                    if (in_array($result['bounceType'], array(BounceHandler::BOUNCE_SOFT, CampaignBounceLog::BOUNCE_HARD))) {
                        $bounceLog = new CampaignBounceLog();
                        $bounceLog->campaign_id     = $campaign->campaign_id;
                        $bounceLog->subscriber_id   = $subscriber->subscriber_id;
                        $bounceLog->message         = $result['diagnosticCode'];
                        $bounceLog->bounce_type     = $result['bounceType'] == BounceHandler::BOUNCE_SOFT ? CampaignBounceLog::BOUNCE_SOFT : CampaignBounceLog::BOUNCE_HARD;  
                        $bounceLog->save();  
                    } else {
                        if ($options->get('system.cron.process_feedback_loop_servers.subscriber_action', 'unsubscribe') == 'delete') {
                            $subscriber->delete();
                        } else {
                            $subscriber->status = ListSubscriber::STATUS_UNSUBSCRIBED;
                            $subscriber->save(false);
                            
                            $trackUnsubscribe = new CampaignTrackUnsubscribe();
                            $trackUnsubscribe->campaign_id   = $campaign->campaign_id;
                            $trackUnsubscribe->subscriber_id = $subscriber->subscriber_id;
                            $trackUnsubscribe->note          = 'Unsubscribed via FBL Report!';
                            $trackUnsubscribe->save(false);
                        }
                    }
                }

                $this->_server = BounceServer::model()->findByPk((int)$this->_server->server_id);
                if (empty($this->_server)) {
                    continue;
                }
                
                if ($this->_server->status == BounceServer::STATUS_CRON_RUNNING) {
                    $this->_server->status = BounceServer::STATUS_ACTIVE;
                    $this->_server->save(false);
                }

                sleep((int)$options->get('system.cron.process_bounce_servers.pause', 5));
            }
        } catch (Exception $e) {
            if (!empty($this->_server)) {
                $this->_server = BounceServer::model()->findByPk((int)$this->_server->server_id);
                if (!empty($this->_server) && $this->_server->status == BounceServer::STATUS_CRON_RUNNING) {
                    $this->_server->status = BounceServer::STATUS_ACTIVE;
                    $this->_server->save(false);
                }    
            }
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
        }
        
        $this->_server = null;
        
        return $this->process($offset + (int)$options->get('system.cron.process_bounce_servers.servers_at_once', 10), $limit);
    }
}