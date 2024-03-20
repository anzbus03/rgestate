<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * BackupManagerExtModel
 * 
 * @package MailWizz EMA
 * @subpackage Backup manager
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
class BackupManagerExtModel extends FormModel
{
    const AUTO_ENABLED = 'enabled';
    
    const AUTO_DISABLED = 'disabled';
    
    protected $_extensionInstance;
    
    public $storage_path;
    
    public $auto_backup = 'enabled';
    
    public $auto_backup_frequency = 1;
    
    public $keep_max_backups = 30;
    
    public $success_notifications;
    
    public $error_notifications;
    
    public function rules()
    {
        $rules = array(
            array('storage_path, auto_backup, auto_backup_frequency, keep_max_backups', 'required'),
            array('auto_backup', 'in', 'range' => array_keys($this->getAutoBackupDropDown())),
            array('auto_backup_frequency', 'numerical', 'integerOnly' => true, 'min' => 1, 'max' => 365),
            array('keep_max_backups', 'numerical', 'integerOnly' => true, 'min' => 1, 'max' => 1000),
			array('success_notifications, error_notifications', 'safe'),
        );
        
        return CMap::mergeArray($rules, parent::rules());    
    }
    
    public function attributeLabels()
    {
        $labels = array(
            'storage_path'          => Yii::t('ext_backup_manager', 'Storage path'),
            'auto_backup'           => Yii::t('ext_backup_manager', 'Auto backup'),
            'auto_backup_frequency' => Yii::t('ext_backup_manager', 'Auto backup frequency'),
            'keep_max_backups'      => Yii::t('ext_backup_manager', 'Keep max backups'),
            'success_notifications' => Yii::t('ext_backup_manager', 'Success notifications'),
            'error_notifications'   => Yii::t('ext_backup_manager', 'Error notifications'),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());    
    }
    
    public function attributePlaceholders()
    {
        $placeholders = array();
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
    
    public function attributeHelpTexts()
    {
        $texts = array(
            'storage_path'          => Yii::t('ext_backup_manager', 'The path on this file system where we should store the backups. Please note that your current system user must be able to write there. Also, do not set a path inside your public html folder since doing this will backup the previously made backups!'),
            'auto_backup'           => Yii::t('ext_backup_manager', 'Whether the auto backup is enabled'),
            'auto_backup_frequency' => Yii::t('ext_backup_manager', 'Once at how many days the auto backup process should run and create the backup'),
            'keep_max_backups'      => Yii::t('ext_backup_manager', 'The maximum number of backups the system must keep, older backups are removed to save disk space'),
            'success_notifications' => Yii::t('ext_backup_manager', 'A single email address, or a list of emails separated by comma, to where the system should send notifications when a backup is completed successfully'),
            'error_notifications'   => Yii::t('ext_backup_manager', 'A single email address, or a list of emails separated by comma, to where the system should send notifications when a backup fails'),
        );
        
        return CMap::mergeArray($texts, parent::attributeHelpTexts());
    }
    
    public function save()
    {
        $extension  = $this->getExtensionInstance();
        $attributes = array('storage_path', 'auto_backup', 'auto_backup_frequency', 'keep_max_backups', 'success_notifications', 'error_notifications');
        foreach ($attributes as $name) {
            $extension->setOption($name, $this->$name);
        }
        return $this;
    }
    
    public function populate() 
    {
        $extension  = $this->getExtensionInstance();
        $attributes = array('storage_path', 'auto_backup', 'auto_backup_frequency', 'keep_max_backups', 'success_notifications', 'error_notifications');
        foreach ($attributes as $name) {
            $this->$name = $extension->getOption($name, $this->$name);
        }
        if (empty($this->storage_path)) {
            $this->storage_path = dirname(Yii::getPathOfAlias('root')) . '/backups';
        }
        return $this;
    }

    public function getAutoBackupDropDown()
    {
        return array(
            self::AUTO_DISABLED   => Yii::t('app', 'Disabled'),
            self::AUTO_ENABLED    => Yii::t('app', 'Enabled'),
        );
    }
    
    public function setExtensionInstance($instance)
    {
        $this->_extensionInstance = $instance;
        return $this;
    }
    
    public function getExtensionInstance()
    {
        if ($this->_extensionInstance !== null) {
            return $this->_extensionInstance;
        }
        return $this->_extensionInstance = Yii::app()->extensionsManager->getExtensionInstance('backup-manager');
    }
}
