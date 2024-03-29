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
 
class UsersController extends Controller
{
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public function filters()
    {
        $filters = array(
            'postOnly + delete', // we only allow deletion via POST request
        );
        
        return CMap::mergeArray($filters, parent::filters());
    }
    
    /**
     * List all available users
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $user = new User('search');
       
        $user->unsetAttributes();
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'View users'), 
            'pageHeading'       => Yii::t('users', 'View users'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
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
        $user = new User();
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
        //    print_r($user->attributes);exit;
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
                $this->redirect(array('users/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Create new user'), 
            'pageHeading'       => Yii::t('users', 'Create new user'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        	 $apps = Yii::app()->apps;
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('user'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
        $user = User::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        if ($user->user_id == Yii::app()->user->getId()) {
            $this->redirect(array('account/index'));
        }
        
        if ($user->removable === User::TEXT_NO && $user->user_id != Yii::app()->user->getId())  {
            Yii::app()->notify->addWarning(Yii::t('users', 'You are not allowed to update the master administrator!'));
            $this->redirect(array('users/index'));
        }
        
        $user->confirm_email = $user->email;
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
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
                $this->redirect(array('users/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'Update user'),
            'pageHeading'       => Yii::t('users', 'Update user'),
            'pageBreadcrumbs'   => array(
                Yii::t('users', 'Users') => $this->createUrl('users/index'),
                Yii::t('app', 'Update'),
            )
        ));
         $apps = Yii::app()->apps;
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->render('form', compact('user'));
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $user = User::model()->findByPk((int)$id);
        
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        if ($user->removable == User::TEXT_YES) {
            $user->delete();    
           
           // PlaceAnAd::model()->deleteAll(array('user_id'=>$id));
        }

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('users/index')));
        }
    }
        public function actionImpersonate($id)
    {
        $customer = User::model()->findByPk((int)$id);

        if (empty($customer)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;

        Yii::import('backend.components.web.auth.*');
        $identity = new UserIdentity($customer->email, null);
        $identity->impersonate = true;

        if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
            $notify->addError(Yii::t('app', 'Unable to impersonate the customer!'));
            $this->redirect(array('customers/index'));
        }

        Yii::app()->user->setState('__customer_impersonate', true);
        $notify->clearAll()->addSuccess(Yii::t('app', 'You are using the customer account for {customerName}!', array(
            '{customerName}' => $customer->fullName ? $customer->fullName : $customer->email,
        )));

        $this->redirect(Yii::app()->apps->getAppUrl('backend', 'dashboard/index', true));
    }
    
}
