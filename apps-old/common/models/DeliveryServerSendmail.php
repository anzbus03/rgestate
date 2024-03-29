<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * DeliveryServerSendmail
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.2
 */
 
class DeliveryServerSendmail extends DeliveryServer
{
    protected $serverType = 'sendmail';
    
    public $sendmail_path = '/usr/sbin/sendmail';
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array(
            array('username', 'email'),
            array('sendmail_path', 'required'),
        );
        
        return CMap::mergeArray($rules, parent::rules());
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'username'      => Yii::t('servers', 'Email address (from)'),
            'sendmail_path' => Yii::t('servers', 'Sendmail path'),
        );
        
        return CMap::mergeArray(parent::attributeLabels(), $labels);
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DeliveryServer the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function sendEmail(array $params = array())
    {
        $params = (array)Yii::app()->hooks->applyFilters('delivery_server_before_send_email', $params, $this);
        
        $sent = $this->getMailer()->send($this->getParamsArray($params));
        
        if ($sent) {
            $this->logUsage();
        }

        Yii::app()->hooks->doAction('delivery_server_after_send_email', $params, $this, $sent);
        
        return $sent;
    }
    
    protected function afterConstruct()
    {
        if ($path = $this->getModelMetaData()->itemAt('sendmail_path')) {
            $this->sendmail_path = $path;
        }
        
        parent::afterConstruct();
    }
    
    protected function afterFind()
    {
        if ($path = $this->getModelMetaData()->itemAt('sendmail_path')) {
            $this->sendmail_path = $path;
        }
        
        parent::afterFind();
    }

    public function getDefaultParamsArray()
    {
        $params = array(
            'transport'     => self::TRANSPORT_SENDMAIL,
            'sendmailPath'  => $this->sendmail_path,
        );
        
        return CMap::mergeArray(parent::getDefaultParamsArray(), $params);
    }
    
    protected function beforeValidate()
    {
        $this->hostname = 'sendmail.local.host';
        $this->port     = null;
        $this->timeout  = null;

        return parent::beforeValidate();
    }

    protected function beforeSave()
    {
        $this->getModelMetaData()->add('sendmail_path', $this->sendmail_path);
        return parent::beforeSave();
    }
    
    public function attributeHelpTexts()
    {
        $texts = array(
            'username'         => Yii::t('servers', 'The email address from where the emails are sent'),
            'sendmail_path'    => Yii::t('servers', 'The path to the sendmail executable, usually "{path}"', array('{path}' => '/usr/sbin/sendmail')),
        );
        
        return CMap::mergeArray(parent::attributeHelpTexts(), $texts);
    }
    
    public function attributePlaceholders()
    {
        $placeholders = array(
            'sendmail_path'    => Yii::t('servers', 'i.e: /usr/sbin/sendmail'),
            'username'         => Yii::t('servers', 'i.e: me@domain.com'),
        );
        
        return CMap::mergeArray(parent::attributePlaceholders(), $placeholders);
    }
    
    public function requirementsFailed()
    {
        if (!function_exists('proc_open') && !function_exists('popen')) {
            return Yii::t('servers', 'The server type {type} requires following functions to be active on your host: {functions}!', array(
                '{type}'      => $this->serverType,
                '{functions}' => 'proc_open ' . Yii::t('app', 'or') . ' popen',
            ));
        }
        return parent::requirementsFailed();
    }
}
