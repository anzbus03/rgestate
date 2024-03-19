<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * UsersController
 * 
 * Handles the actions for users related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class DeveloperController extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public function init()
    {
		 
    
        parent::init();
    }
 
    /**
     * List all available users
     */
    public function actionIndex()
    {
	 
		
 
        $request = Yii::app()->request;
        $user = new Developer('search');
       
        $user->unsetAttributes();
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Developers List'), 
            'pageHeading'       => Yii::t('agent', 'Developer List'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', 'Developers') => $this->createUrl('developer/index'),
                Yii::t('app', 'View all')
            )
        ));
      
        $this->render('list', compact('user'));
    }
    
    /**
     * Create a new user
     */
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $user = new Developer();
        $user->scenario = 'developer_insert';
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
        
           
            if (!$user->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				 
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
            if ($collection->success) {
                $this->redirect(array('developer/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Create Developor'), 
            'pageHeading'       => Yii::t('agent', 'Create Developor'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Developor') => $this->createUrl('developer/index'),
                Yii::t('app', 'Create new'),
            )
        ));
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
        $this->render('form', compact('user'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $user = Developer::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
         
        
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
            if($user->password=="")
            {
				unset($user->password);
				unset($user->con_password);
			}
            if (!$user->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
            if ($collection->success) {
                $this->redirect(array('developer/index'));
            }
        }
       
     //  echo  $user->password;echo "SDSD";exit;
            $user->password="";
            $user->con_password="";
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('capacity', 'Update Developor'),
            'pageHeading'       => Yii::t('agent', 'Update Developor'),
            'pageBreadcrumbs'   => array(
                Yii::t('agent', 'Developor') => $this->createUrl('developer/index'),
                Yii::t('app', 'Update'),
            )
        ));
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
        $this->render('form', compact('user'));
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $user = Developer::model()->findByPk((int)$id);
        
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user->updateBypk($id,array('isTrash'=>'1'));    
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('develpor/index')));
        }
    }
    
   
    
}
