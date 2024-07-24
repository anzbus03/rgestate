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
 
class Agent_reviewsController  extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Agent Review";
     public $focus = "";
     public function init()
    {
		   $this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/js/jquery.fancybox.js')));
            $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('frontend/assets/css/jquery.fancybox.css')));
     Yii::$classMap = array_merge( Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
        ));
        parent::init();
       
        
    }
 
    /**
     * List all available users
     */
    public function actionIndex()
    {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new AgentReview('serach');
       
         $model->unsetAttributes();
         $model->attributes = (array)$request->getQuery($model->modelName, array());
         $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
         ));
        $condition =  AgentReview::model()->search(1);
        $total_application =  AgentReview::model()->count($condition);
         
        $model2 = new AgentReview();$model2->status = 'A';
        $totla_acceptedCriteria =  $model2->search(1);
        $total_accepted_application =  AgentReview::model()->count($totla_acceptedCriteria);
         
         
        $model2 = new AgentReview();$model2->status = 'R';
        $total_rejectedCriteria =  $model2->search(1);
        $total_rejected =  AgentReview::model()->count($total_rejectedCriteria);
         
         
          
         
         
        $this->render('list', compact('model','total_application','total_accepted_application','total_rejected'));
    }
    
   
    
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = AgentReview::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->deleteByPk($id);    
         
		$model->updateReviewField();
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
     public function actionUpdate($id)
    {
		 
        $model = AgentReview::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
		 
        
       
        
        $this->renderPartial('form', compact('model'));
    }
    
    public function actionView($id)
    {
		 
        $criteria = AgentReview::model()->search(1);
         $criteria->compare('review_id',(int)  $id);
        $model = AgentReview::model()->find($criteria);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/bootstrap.min.css')));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
         if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
            $model->attributes = $attributes;
              if (!$model->save()) {
				  
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
              

                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
             
            )));

            if ($collection->success) {
                 $this->redirect($this->refresh());
				 
            }
        }
		 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} ID-".$model->primaryKey),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
         ));
       
        
        $this->render('form', compact('model','note','note2'));
    }
    
      public function actionBulk_action()
    {
		
	
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        
        $action = $request->getPost('bulk_action');
        
        $items  = array_unique((array)$request->getPost('bulk_item', array()));
        
        if ($action == AgentReview::BULK_ACTION_DELETE && count($items)) {
            $affected = 0;
            $customerModel = new  AgentReview();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				 
                $customer->delete();;  
                $customer->updateReviewField();
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }  
        if ($action == AgentReview::BULK_ACTION_ACTIVATE && count($items)) {
            $affected = 0;
            $customerModel = new  AgentReview();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				
                $customer->updateByPk($customer->review_id,array('status'=>'A'));; 
                $customer->updateReviewField(); 
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }  
        if ($action == AgentReview::BULK_ACTION_REJECT && count($items)) {
            $affected = 0;
            $customerModel = new  AgentReview();
            foreach ($items as $item) {
               
                $customer = $customerModel->findByPk($item);
                if(!$customer){
					continue;
				}
				 
                $customer->updateByPk($customer->review_id,array('status'=>'R'));;
                $customer->updateReviewField();  
                $affected++;
                  
            }
            if ($affected) {
                $notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
            }
            
        }  
         
        $defaultReturn = $request->getServer('HTTP_REFERER', array('home_insurance/index'));
        $this->redirect($request->getPost('returnUrl', $defaultReturn));
    }
   
	 
}
