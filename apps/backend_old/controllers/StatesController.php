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
 
class StatesController extends Controller
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
        $user = new States('search');
      //  print_r($user->search());exit;
     // print_r($user->search());exit;
        $user->unsetAttributes();
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'View users'), 
            'pageHeading'       => Yii::t('states', 'State List'),
            'pageBreadcrumbs'   => array(
                Yii::t('states', 'State') => $this->createUrl('states/index'),
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
        $user = new States();
        
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
                $this->redirect(array('states/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('countries', 'Create new country'), 
            'pageHeading'       => Yii::t('states', 'Create new State'),
            'pageBreadcrumbs'   => array(
                Yii::t('countries', 'State') => $this->createUrl('states/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('user'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
        $user = States::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
         
        
        
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
                $this->redirect(array('states/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('countries', 'Update Country'),
            'pageHeading'       => Yii::t('states', 'State'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', 'State') => $this->createUrl('states/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('user'));
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $user = States::model()->findByPk((int)$id);
        
        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $user->delete();    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('countries/index')));
        }
    }
    public function actionGetSatate($id)
    {
		 $statlist = new States();
		 $states = $statlist->getStateList($id);
		// print_r( $states);exit;
		 $option = "<option value-''>Select State</option>";
		 if($states)
		 {
			 foreach($states as $k=>$v)
			 {
				 $option .= "<option value='".$v->state_id."'>".$v->state_name."</option>";
			 }
		 }
		 echo  $option;
	}
    
}
