<?php defined('MW_PATH') || exit('No direct script access allowed');

/** 
 * Controller file for extension settings.
 * 
 * @package MailWizz EMA
 * @subpackage Backup manager
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
class Backup_manager_extController extends Controller
{
    // the extension instance
    public $extension;
    
    // the init
    public function init()
    {
        parent::init();
        set_time_limit(0);
        ini_set('memory_limit', -1);
    }
    
    // the filters
    public function filters()
    {
        $filters = array(
            'postOnly + delete',
        );
        
        return CMap::mergeArray($filters, parent::filters());
    }
    
    // move the view path
    public function getViewPath()
    {
        return Yii::getPathOfAlias('ext-backup-manager.backend.views');
    }
    
    public function actionIndex()
    {
        $request    = Yii::app()->request;
        $snapshot   = new BackupManagerSnapshot('search');
        
        $snapshot->unsetAttributes();
        $snapshot->attributes = (array)$request->getQuery($snapshot->modelName, array());
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('ext_backup_manager', 'Backup snapshots'),
            'pageHeading'       => Yii::t('ext_backup_manager', 'Backup snapshots'),
            'pageBreadcrumbs'   => array(
                Yii::t('ext_backup_manager', 'Backup manager')  => $this->createUrl('backup_manager_ext/index'),
                Yii::t('ext_backup_manager', 'Snapshots'),
            )
        ));

        $this->render('list', compact('snapshot'));
    }
    
    public function actionSettings()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $model   = $this->extension->getExtModel();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
            if ($model->validate()) {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $model->save();
            } else {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('ext_backup_manager', 'Backup manager'),
            'pageHeading'       => Yii::t('ext_backup_manager', 'Backup manager'),
            'pageBreadcrumbs'   => array(
                Yii::t('ext_backup_manager', 'Backup manager')  => $this->createUrl('backup_manager_ext/index'),
                Yii::t('ext_backup_manager', 'Settings'),
            )
        ));

        $this->render('settings', compact('model'));
    }
    
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $snapshot       = new BackupManagerSnapshot();
        $snapshot->path = $this->extension->getExtModel()->storage_path;
        
        if ($snapshot->backup()) {
            $notify->addSuccess($snapshot->getBackupLogger()->toArray());
        } else {
            $notify->addError($snapshot->getBackupLogger()->toArray());
        }
        
        $snapshot->deleteOldBackups();
        
        $this->redirect(array('backup_manager_ext/index'));
    }

    public function actionDelete($id)
    {
        $snapshot = BackupManagerSnapshot::model()->findByPk((int)$id);
        if (empty($snapshot)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $snapshot->delete();

        $request  = Yii::app()->request;
        $notify   = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('backup_manager_ext/index')));
        }
    }
    
    public function actionDownload($id)
    {
        $snapshot = BackupManagerSnapshot::model()->findByPk((int)$id);
        if (empty($snapshot)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        if (!($fp = @fopen($snapshot->fullPath, "rb"))) {
            $this->redirect(array('backup_manager_ext/index'));
        }
        
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header('Content-type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header('Content-Disposition: attachment; filename="'.$snapshot->name.'"');
        header("Content-Length: ".$snapshot->size); 
        
        while(!feof($fp)) {
            echo fread($fp, 8192);
            flush();
            if (connection_status() != 0) {
                @fclose($fp);
                die();
            }
        }
        @fclose($fp);
    }
}