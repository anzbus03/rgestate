<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Backup manager
 * 
 * Backup manager for file system and database
 * 
 * @package MailWizz EMA
 * @subpackage Backup manager
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
class BackupManagerExt extends ExtensionInit 
{
    // name of the extension as shown in the backend panel
    public $name = 'Backup manager';
    
    // description of the extension as shown in backend panel
    public $description = 'Backup manager for file system and database';
    
    // current version of this extension
    public $version = '1.0';
    
    // minimum app version required for this extension to run properly
    public $minAppVersion = '1.3.4.5';
    
    // the author name
    public $author = 'Redspider.ae';
    
    // author website
    public $website = 'http://www.Redspider.ae/';
    
    // contact email address
    public $email = 'ahmad@redspider.ae';
    
    // in which apps this extension is allowed to run
    public $allowedApps = array('backend', 'console');
    
    // mark as cli enabled.
    public $cliEnabled = true;
    
    // can this extension be deleted? this only applies to core extensions.
    protected $_canBeDeleted = true;
    
    // can this extension be disabled? this only applies to core extensions.
    protected $_canBeDisabled = true;
    
    // the extension model
    protected $_extModel;
    
    // run the extension
    public function run()
    {
        Yii::import('ext-backup-manager.common.models.*');
        
        // hook into our own hooks to send the notifications
        if ($this->isAppName('backend') || $this->isAppName('console')) {
            Yii::app()->hooks->addAction('ext_backup_manager_on_backup_finish', array($this, '_sendSuccessNotifications'));
            Yii::app()->hooks->addAction('ext_backup_manager_on_backup_error', array($this, '_sendErrorNotifications'));
        }
        
        if ($this->isAppName('backend')) {
            
            // handle all backend related tasks
            $this->backendApp();
        
        } elseif ($this->isAppName('console')) {
        
            // handle all console related tasks
            $this->consoleApp();
        }
    }
    
    // Add the landing page for this extension (settings/general info/etc)
    public function getPageUrl()
    {
        return Yii::app()->createUrl('backup_manager_ext/settings');
    }
    
    // create the database table
    public function beforeEnable()
    {
        Yii::app()->getDb()->createCommand('
        CREATE TABLE IF NOT EXISTS `{{backup_manager_snapshot}}` (
          `snapshot_id` INT NOT NULL AUTO_INCREMENT,
          `name` VARCHAR(50) NOT NULL,
          `path` VARCHAR(255) NOT NULL,
          `size` INT(11) NOT NULL,
          `meta_data` BLOB NULL,
          `date_added` DATETIME NOT NULL,
          PRIMARY KEY (`snapshot_id`))
        ENGINE=InnoDB CHARSET=utf8;
        ')->execute();
        return true;
    }
    
    // drop the table
    public function beforeDelete()
    {
        Yii::import('ext-backup-manager.common.models.*');
        BackupManagerSnapshot::model()->deleteAllBackups();
        Yii::app()->getDb()->createCommand('DROP TABLE IF EXISTS `{{backup_manager_snapshot}}`')->execute();
        return true;
    }

    // handle all backend related tasks
    protected function backendApp()
    {
        $hooks = Yii::app()->hooks;
        
        // register the url rule to resolve the extension page.
        Yii::app()->urlManager->addRules(array(
            array('backup_manager_ext/<action>', 'pattern' => 'backup-manager/<action>/*'),
            array('backup_manager_ext/<action>', 'pattern' => 'backup-manager/<action>'),
        ));
        
        // add the backend controller
        Yii::app()->controllerMap['backup_manager_ext'] = array(
            'class'     => 'ext-backup-manager.backend.controllers.Backup_manager_extController',
            'extension' => $this,
        );
        
        // add the menu item
        $hooks->addFilter('backend_left_navigation_menu_items', array($this, '_registerBackendMenuItem'));
    }
    
    // handle all console related tasks
    protected function consoleApp()
    {
        $hooks = Yii::app()->hooks;
        $hooks->addAction('console_command_daily', array($this, '_runBackup'), 1000);
        $hooks->addAction('console_command_daily', array($this, '_deleteOldBackups'), 1001);
    }

    // extension main model
    public function getExtModel()
    {
        if ($this->_extModel !== null) {
            return $this->_extModel;
        }
        
        $this->_extModel = new BackupManagerExtModel();
        return $this->_extModel->setExtensionInstance($this)->populate();
    }
    
    // menu callback
    public function _registerBackendMenuItem($items)
    {
        $route = Yii::app()->getController()->getRoute();
        $items['backup-manager'] = array(
            'name'      => Yii::t('ext_backup_manager', 'Backup manager'),
            'icon'      => 'glyphicon-floppy-saved',
            'active'    => 'backup_manager_ext',
            'route'     => null,
            'items'     => array(
                array('url' => array('backup_manager_ext/index'), 'label' => Yii::t('app', 'Backups'), 'active' => strpos($route, 'backup_manager_ext/index') === 0),
                array('url' => array('backup_manager_ext/settings'), 'label' => Yii::t('app', 'Settings'), 'active' => strpos($route, 'backup_manager_ext/settings') === 0),
            ),
        );
        return $items;
    }
    
    // callback from console
    public function _runBackup($command)
    {
        if ($this->getOption('auto_backup', 'enabled') != 'enabled') {
            return;
        }        

        $now = time();
        $max = 24 * 60 * 60 * (int)$this->getOption('auto_backup_frequency', 1);
        $lastBackupTime = (int)$this->getOption('last_backup_time', 0);
        if ($lastBackupTime + $max >= $now) {
            return;
        }

        $snapshot = new BackupManagerSnapshot();
        $snapshot->path = $this->getOption('storage_path');
        $snapshot->backup();
    }
    
    // callback from console
    public function _deleteOldBackups($command)
    {
        BackupManagerSnapshot::model()->deleteOldBackups();
    }
    
    public function _sendSuccessNotifications(CEvent $event)
    {
        $this->sendEmailNotifications($this->getOption('success_notifications'), $event, 'success');
    }
    
    public function _sendErrorNotifications(CEvent $event)
    {
        $this->sendEmailNotifications($this->getOption('error_notifications'), $event, 'error');
    }
    
    protected function sendEmailNotifications($emails, CEvent $event, $type)
    {
        if (empty($emails)) {
            return;
        }
        
        $emails = explode(',', $emails);
        $emails = array_map('trim', $emails);
        foreach ($emails as $index => $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                unset($emails[$index]);
            }
        }
        if (empty($emails)) {
            return;
        }

        $options  = Yii::app()->options;
        $emailTemplate  = $options->get('system.email_templates.common');
        $emailBody      = implode("<br />", $event->sender->getBackupLogger()->toArray());
        $emailTemplate  = str_replace('[CONTENT]', $emailBody, $emailTemplate);
        
        $prefix = sprintf('%s - ', strtoupper(Yii::t('ext_backup_manager', $type)));
        foreach ($emails as $emailAddress) {
            $email = new TransactionalEmail();
            $email->to_name     = $emailAddress;
            $email->to_email    = $emailAddress;
            $email->from_name   = $options->get('system.common.site_name', 'Marketing website');
            $email->subject     = $prefix . Yii::t('ext_backup_manager', 'Backup manager notification');
            $email->body        = $emailTemplate;
            $email->save();
        }
    }
}
