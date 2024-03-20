<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Ext_ckeditorController
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
class Gomasterkey_xmlController  extends Controller
{
    // init the controller
    public function init()
    {
        parent::init();
        Yii::import('ext-xml.models.*');
    }
    
    // move the view path
    public function getViewPath()
    {
        return Yii::getPathOfAlias('ext-xml.views');
    }
    
    /**
     * Default action for settings, only admin users can access it. 
     */
     public function actionIndex()
     {
	 
        if (!Yii::app()->user->getId()) {
            throw new CHttpException(403, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
        }
        
        $extension  = Yii::app()->extensionsManager->getExtensionInstance('xml');
        
       
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        
        $model = new XmlExtModel();
        $model->populate($extension);

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
            if ($model->validate()) {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
                $model->save($extension);
            } else {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            }
        }
       
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('ext_xml', 'Sale Xml'),
            'pageHeading'       => Yii::t('ext_xml', 'XML options'),
            'pageBreadcrumbs'   => array(
                Yii::t('extensions', 'XML') => $this->createUrl('sale_xml/index'),
                Yii::t('ext_xml', 'Sale Xml Settings'),
            )
        ));

        $this->render('settings', compact('model'));
     }
      public function actionNew()
        {
			echo "ASDAS";exit;
		}
     
}
