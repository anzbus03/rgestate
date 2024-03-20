<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * BackupManagerSnapshot
 * 
 * @package MailWizz EMA
 * @subpackage Backup manager
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
/**
 * This is the model class for table "{{backup_manager_snapshot}}".
 *
 * The followings are the available columns in table '{{backup_manager_snapshot}}':
 * @property integer $snapshot_id
 * @property string $name
 * @property string $path
 * @property integer $size
 * @property string $meta_data
 * @property string $date_added
 */
class BackupManagerSnapshot extends ActiveRecord
{
    protected $_backupLogger;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{backup_manager_snapshot}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules = array();
        return CMap::mergeArray($rules, parent::rules());
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = array();
        return CMap::mergeArray($relations, parent::relations());
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$labels = array(
			'snapshot_id'=> Yii::t('ext_backup_manager', 'Snapshot'),
			'name'       => Yii::t('ext_backup_manager', 'Name'),
			'path'       => Yii::t('ext_backup_manager', 'Path'),
			'size'       => Yii::t('ext_backup_manager', 'Size'),
			'meta_data'  => Yii::t('ext_backup_manager', 'Meta data'),
		);
        return CMap::mergeArray($labels, parent::attributeLabels());
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('size',$this->size);

		return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder'  => array(
                    'snapshot_id'   => CSort::SORT_DESC,
                ),
            ),
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BackupManagerSnapshot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    protected function afterDelete()
    {
        $this->deleteSnapshotArchive();
        $this->onAfterSnapshotDelete(new CEvent($this));
        parent::afterDelete();
    }
    
    protected function getBackupLogStart()
    {
        return '[' . date('Y-m-d H:i:s') . '] - ';
    }
    
    protected function deleteSnapshotArchive()
    {
        if (!CommonHelper::functionExists('exec')) {
            return @is_file($this->getFullPath()) && @unlink($this->getFullPath());
        }
        
        $command  = 'if [ ! -e %s ]; then echo 0; else echo 1; fi';
        $command  = sprintf($command, escapeshellarg($this->getFullPath()));
        $lastLine = exec($command, $output, $status);
        
        if ($status !== 0 || (is_numeric($lastLine) && $lastLine == 0)) {
            return false;
        }
        
        $command  = 'rm -f %s >/dev/null';
        $command  = sprintf($command, escapeshellarg($this->getFullPath()));
        $lastLine = exec($command, $output, $status);
        
        return (int)$status === 0;
    }
    
    public function backup()
    {
        // raise the start event
        $this->onBackupStart(new CEvent($this));
        
        // set a unique key for this process and try to acquire a lock on it
        $mutexKey = md5(__FILE__ . __FUNCTION__);
        if (!Yii::app()->mutex->acquire($mutexKey)) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Unable to acquire the mutex lock!'));
            return false;
        }
        
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Starting the backup process...'));
        
        $this->path = rtrim($this->path, '/');
        if (empty($this->path)) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Invalid storage path, please supply a valid storage path!'));
            $this->onBackupError(new CEvent($this));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }
        
        if (!CommonHelper::functionExists('exec')) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'The exec function must be enabled in order to perform backups!'));
            $this->onBackupError(new CEvent($this));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }
        
        $command = 'if command -v tar >/dev/null && command -v mysqldump >/dev/null; then echo 1; else echo 0; fi';
        $lastLine = exec($command, $output, $status);
        if ((int)$status !== 0 || (int)$lastLine !== 1) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Missing linux binaries to create the backup!'));
            $this->onBackupError(new CEvent($this));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }
        
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Checking to see if the storage directory exists...'));
        
        $command  = 'if [ ! -d %s ]; then echo 0; else echo 1; fi';
        $command  = sprintf($command, escapeshellarg($this->path));
        $lastLine = exec($command, $output, $status);
        if ((int)$status !== 0) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Cannot run the directory check command!'));
            $this->onBackupError(new CEvent($this));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }

        if ((int)$lastLine == 0) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'The storage directory does not exist, trying to create it...'));
            $command  = 'mkdir %s >/dev/null && chmod -R 0777 %s >/dev/null';
            $command  = sprintf($command, escapeshellarg($this->path), escapeshellarg($this->path));
            $lastLine = exec($command, $output, $status);
            if ((int)$status !== 0) {
                $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Unable to create the directory, please check the permissions!'));
                $this->onBackupError(new CEvent($this));
                Yii::app()->mutex->release($mutexKey);
                return false;
            }
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'The storage directory has been created!'));
        } else {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'The storage directory exists.'));
        }
        
        $now       = time();
        $backupDir = $this->path . '/' . $now;
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'The directory for this backup is: {dir}', array(
            '{dir}' => $backupDir,
        )));
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Checking to see if the directory for this backup exists...'));
        
        $command  = 'if [ ! -d %s ]; then echo 0; else echo 1; fi';
        $command  = sprintf($command, escapeshellarg($backupDir));
        $lastLine = exec($command, $output, $status);
        if ((int)$status !== 0) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Cannot run the directory check command!'));
            $this->onBackupError(new CEvent($this));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }

        if ((int)$lastLine == 0) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'The backup directory does not exists, trying to create it...'));
            $command  = 'mkdir %s >/dev/null && chmod -R 0777 %s >/dev/null';
            $command  = sprintf($command, escapeshellarg($backupDir), escapeshellarg($backupDir));
            $lastLine = exec($command, $output, $status);
            if ((int)$status !== 0) {
                $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Unable to create the directory, please check the permissions!'));
                $this->onBackupError(new CEvent($this));
                Yii::app()->mutex->release($mutexKey);
                return false;
            } else {
                $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'The backup directory has been created.'));
            }
        } else {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'The backup directory exists.'));
        }
        
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Starting the database backup process...'));
        $db = Yii::app()->getDb();
        $connectionString = $db->connectionString;
        $connectionString = preg_replace('/^([a-z]+):/i', '', $connectionString);
        $connectionString = str_replace(';', '&', $connectionString);
        parse_str($connectionString, $data);
        $dbName = isset($data['dbname']) ? $data['dbname'] : null;
        $dbHost = isset($data['host']) ? $data['host'] : 'localhost';
        $dbPort = isset($data['port']) ? $data['port'] : 3306;
        $socket = isset($data['unix_socket']) ? $data['unix_socket'] : null;
        
        if (!$dbName) {
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Unable to get the database name from configuration file!'));
            $this->onBackupError(new CEvent($this));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }
        
        // close the db connection since this will take time
        Yii::app()->getDb()->setActive(false);
        
        if (empty($socket)) {
            $command  = 'mysqldump --single-transaction --tz-utc -h %s -P %d -u %s -p%s %s > %s';
            $command  = sprintf($command, escapeshellarg($dbHost), (int)$dbPort, escapeshellarg($db->username), escapeshellarg($db->password), escapeshellarg($dbName), escapeshellarg($backupDir . '/database.sql'));
        } else {
            $command  = 'mysqldump --single-transaction --tz-utc -S %s -u %s -p%s %s > %s';
            $command  = sprintf($command, escapeshellarg($socket), escapeshellarg($db->username), escapeshellarg($db->password), escapeshellarg($dbName), escapeshellarg($backupDir . '/database.sql'));
        }
        $lastLine = exec($command, $output, $status);
        if ((int)$status !== 0) {
            Yii::app()->getDb()->setActive(true);
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Unable to backup the database!'));
            $this->onBackupError(new CEvent($this));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }
        
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Database backed up successfully!'));
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Starting the file system backup process...'));
        
        $command  = 'tar -pczf %s -C %s . >/dev/null';
        $command  = sprintf($command, escapeshellarg($backupDir . '/application.tar.gz'), Yii::getPathOfAlias('root'));
        $lastLine = exec($command, $output, $status);
        if ((int)$status !== 0) {
            Yii::app()->getDb()->setActive(true);
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Unable to backup the file system!'));
            $this->onBackupError(new CEvent($this));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }
        
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'File system backed up successfully!'));
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Starting to pack the backup...'));
        
        $command  = 'tar -pczf %s -C %s . >/dev/null';
        $command  = sprintf($command, escapeshellarg($backupDir . '.tar.gz'), $backupDir);
        $lastLine = exec($command, $output, $status);
        if ((int)$status !== 0) {
            Yii::app()->getDb()->setActive(true);
            $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Failed to pack the backup...'));
            Yii::app()->mutex->release($mutexKey);
            return false;
        }
        
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Done packing the backup!'));
        $this->getBackupLogger()->add($this->getBackupLogStart() . Yii::t('ext_backup_manager', 'Backup complete!'));
        
        // cli vs web
        $command  = 'chmod 0777 %s >/dev/null';
        $command  = sprintf($command, escapeshellarg($backupDir . '.tar.gz'));
        $lastLine = exec($command, $output, $status);
        
        // remove the database file
        $command  = 'rm -f %s >/dev/null';
        $command  = sprintf($command, escapeshellarg($backupDir . '/database.sql'));
        $lastLine = exec($command, $output, $status);
        
        // remove the archive
        $command  = 'rm -f %s >/dev/null';
        $command  = sprintf($command, escapeshellarg($backupDir . '/application.tar.gz'));
        $lastLine = exec($command, $output, $status);
        
        // now the backup dir is empty, remove it.
        $command  = 'rmdir %s >/dev/null';
        $command  = sprintf($command, escapeshellarg($backupDir));
        $lastLine = exec($command, $output, $status);
        
        // try to get the size of the backup file.
        $command  = 'command -v wc >/dev/null && wc -c < %s';
        $command  = sprintf($command, escapeshellarg($backupDir . '.tar.gz'));
        $lastLine = exec($command, $output, $status);
        
        if ((int)$status !== 0) {
            $this->size = intval(@filesize($backupDir.'.tar.gz'));
        } else {
            $this->size = (int)$lastLine;
        }
        
        // make sure the db connection is opened
        Yii::app()->getDb()->setActive(true);
        
        // add the attributes and save the snapshot
        $this->name = basename($backupDir) . '.tar.gz';
        $this->getModelMetaData()->add('log', implode("\n", $this->getBackupLogger()->toArray()));
        $this->save(false);
        
        // mark last backup if cli only
        if (MW_IS_CLI) {
            Yii::app()->extensionsManager->getExtensionInstance('backup-manager')->setOption('last_backup_time', $now);
        }
        
        // raise the event
        $this->onBackupFinish(new CEvent($this));
        
        // release the lock
        Yii::app()->mutex->release($mutexKey);
        
        return true;
    }
    
    public function deleteOldBackups()
    {
        $models = self::model()->findAll(array(
            'order'     => 'snapshot_id DESC',
            'limit'     => 100,
            'offset'    => (int)Yii::app()->extensionsManager->getExtensionInstance('backup-manager')->getOption('keep_max_backups', 30),
        ));
        
        foreach ($models as $model) {
            $model->delete();
        }
        
        return $this;
    }
    
    public function deleteAllBackups()
    {
        $models = self::model()->findAll();
        foreach ($models as $model) {
            $model->delete();
        }
        return $this;
    }

    public function getBackupLogger()
    {
        if ($this->_backupLogger !== null) {
            return $this->_backupLogger;
        }
        return $this->_backupLogger = new CList();
    }
    
    public function getFullPath()
    {
        return $this->path . '/' . $this->name;
    }
    
    public function getFormattedSize()
    {
        return round($this->size / 1024 / 1024, 2) . ' MB';    
    }
    
    public function getDownloadUrl()
    {
        $url = Yii::app()->createUrl("backup_manager_ext/download", array("id" => $this->snapshot_id));
        return Yii::app()->hooks->applyFilters('ext_backup_manager_on_get_download_url', $url);
    }
    
    public function onBackupStart(CEvent $event)
    {
        Yii::app()->hooks->doAction('ext_backup_manager_on_backup_start', $event);
        $this->raiseEvent('onBackupStart', $event);
    }
    
    public function onBackupFinish(CEvent $event)
    {
        Yii::app()->hooks->doAction('ext_backup_manager_on_backup_finish', $event);
        $this->raiseEvent('onBackupFinish', $event);
    }
    
    public function onBackupError(CEvent $event)
    {
        Yii::app()->hooks->doAction('ext_backup_manager_on_backup_error', $event);
        $this->raiseEvent('onBackupError', $event);
    }
    
    public function onAfterSnapshotDelete(CEvent $event)
    {
        Yii::app()->hooks->doAction('backup_manager_after_snapshot_delete', $event);
        $this->raiseEvent('onAfterSnapshotDelete', $event);
    }
    
}
