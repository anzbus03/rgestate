<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * SettingsController
 * 
 * Handles the settings for the application
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class Upload_settingsController extends Controller
{
    public function init()
    {
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('settings.js')));
        parent::init();
    }
    
    /**
     * Handle the common settings page
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $commonModel = new OptionCommonUploads();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($commonModel->modelName, array()))) {
            $commonModel->attributes = $attributes;
            
           
            if (!$commonModel->save()) {//	print_r($commonModel->getErrors());exit;
                $notify->addError(Yii::t('app', 'Your form contains a few errors, please fix them and try again!'));
            } else {
			
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
          
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'success'       => $notify->hasSuccess,
                'commonModel'   => $commonModel,
            )));
            
            if ($collection->success) {
                $this->redirect(array('upload_settings/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->getData('pageMetaTitle') . ' | ' . Yii::t('settings', 'Upload Settings'), 
            'pageHeading'       => Yii::t('settings', 'Upload Settings'),
            'pageBreadcrumbs'   => array(
                Yii::t('settings', 'Settings') => $this->createUrl('upload_settings/index'),
                Yii::t('settings', 'Upload settings')
            )
        ));
        
        $this->render('index', compact('commonModel'));
    }
    
}
