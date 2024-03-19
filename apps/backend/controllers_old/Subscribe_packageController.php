<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticlesController
 *
 * Handles the actions for articles related tasks
 *
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

class Subscribe_packageController  extends Controller

{
    public function init()
    {
        $this->onBeforeAction = array($this, '_registerJuiBs');
        parent::init();
    }

    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public function filters()
    {
        $filters = array(
            'postOnly + delete, delete_note',
        );

        return CMap::mergeArray($filters, parent::filters());
    }

    /**
     * List all available orders
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new UserPackages('search');
        $order->unsetAttributes();

        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'View package subscriptions'),
            'pageHeading'       => Yii::t('orders', 'View package subscriptions'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Package subscriptions') => $this->createUrl($this->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
 $this->getData('pageStyles')->mergeWith(array(
                array('src' => Yii::app()->apps->getBaseUrl('assets/css/jui-bs/jquery-ui-1.10.3.custom.css'), 'priority' => -1001),
            ));  
        $this->render('list', compact('order'));
    }
       public function actionTrash()
    {
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new UserPackages('search');
        $order->unsetAttributes();

        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));
		$order->show_trash = '1';
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'View trashed package subscriptions'),
            'pageHeading'       => Yii::t('orders', 'View trashed package subscriptions'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Package subscriptions') => $this->createUrl($this->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
    $this->getData('pageStyles')->mergeWith(array(
                array('src' => Yii::app()->apps->getBaseUrl('assets/css/jui-bs/jquery-ui-1.10.3.custom.css'), 'priority' => -1001),
            ));  
        $this->render('list_trash', compact('order'));
    }

    public function actionCreated_by_me()
    {
        $request = Yii::app()->request;
        $ioFilter= Yii::app()->ioFilter;
        $order   = new UserPackages('search');
        $order->unsetAttributes();

        $order->attributes = $ioFilter->xssClean((array)$request->getOriginalQuery($order->modelName, array()));
		if(empty($order->created_by)){
   
$order->created_by = (int) Yii::app()->user->getId() ;
if(Yii::app()->user->getModel()->removable=='no'){
    $order->show_all = 1; 
    }
}
 
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'My Packages'),
            'pageHeading'       => Yii::t('orders', 'My Packages'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'My Packages') => $this->createUrl($this->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));

        $this->render('list', compact('order'));
    }

    /**
     * Create order
     */
    public function actionCreate($package_id=null)
    {
        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;
        $order   = new UserPackages();

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($order->modelName, array()))) {
            $order->attributes = $attributes;
            if(!empty($order->package_id) and !empty($order->user_id)){
				 
				$model = Package::model()->fetchPackage($order->package_id);
		$success = false;
		if(empty($model)){
			$message = 'Package Not Exist!';
		}
		else{
			$price_for_package =  $model->price_per_month; $memberAccount =  ListingUsers::model()->findByPk($order->user_id); 
			$price_in_user_account = $memberAccount->amount ; 
			if(empty($price_in_user_account)){$price_in_user_account = 0; }
			if($price_in_user_account<$price_for_package){
				$message = 'Insufficient Balance!<br />Please Recharge';
			}
			else{
			 	$order->ads_allowed = $model->max_listing_per_day;
				$order->validity = $model->validity_in_days;
				$order->amount = $model->price_per_month;
				$order->category_id = $model->category;
				$order->latest = 1;
				if($order->save()){
				 	
					$message = 'Package Activated!';$success = true;
				}
				else{
					$message = CHtml::errorSummary($usageModel);
				}
			}
		}
			}
            
           
             
				if($success){
					$notify->addSuccess(Yii::t('app', $message));
				}
				else if(!empty($message)){
					$notify->addError(Yii::t('app', $message));
				}
                
             

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'order'     => $order,
            )));

            if ($collection->success) {
                 if(AccessHelper::hasRouteAccess ($this->id.'/index')){
                $this->redirect(Yii::App()->createUrl($this->id.'/index/type/'.$user->user_type));
				}
				else if(AccessHelper::hasRouteAccess ($this->id.'/created_by_me')){
                $this->redirect(Yii::App()->createUrl($this->id.'/created_by_me/type/'.$user->user_type));
				 
				}
            }
        }

         if(AccessHelper::hasRouteAccess ($this->id.'/index')){
					 $index = 'index';
				}
				else if(AccessHelper::hasRouteAccess ($this->id.'/created_by_me')){
					 $index = 'created_by_me';
				 
				}
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'Create package subscriptions'),
            'pageHeading'       => Yii::t('orders', 'Create package subscriptions'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Package subscriptions') => $this->createUrl($this->id.'/'.$index),
                Yii::t('app', 'Create'),
            )
        ));
		if(empty($package_id)){
			  $this->getData('pageStyles')->add(array('src' =>Yii::app()->apps->getBaseUrl('assets/css/addons_package.css'), 'priority' => -100));
      
			   $this->render('_select_package', compact('order', 'note','index'));
		}
		else{
			if(!Yii::app()->request->isPostRequest ){
			$order->package_id =$package_id; 
			}
        $this->render('form', compact('order', 'note','index'));
		}
    }

    /**
     * Update existing order
     */
    public function actionUpdate($id)
    {
        $order = UserPackages::model()->findByPk((int)$id);
		$old_amount  = $order->amount;
        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($order->modelName, array()))) {
            $order->attributes = $attributes;
              if(!empty($order->package_id) and !empty($order->user_id)){
				 
				$model = Package::model()->fetchPackage($order->package_id);
				 
		$success = false;
		if(empty($model)){
			$message = 'Package Not Exist!';
		}
		else{
			$price_for_package =  $model->price_per_month; $memberAccount =  ListingUsers::model()->findByPk($order->user_id); 
			$price_in_user_account = $memberAccount->amount+$old_amount  ; 
			 
			if(empty($price_in_user_account)){$price_in_user_account = 0; }
			if($price_in_user_account<$price_for_package){
				$message = 'Insufficient Balance!<br />Please Recharge';
				 
			}
			else{
			 	$order->ads_allowed = $model->max_listing_per_day;
				$order->validity = $model->validity_in_days;
				$order->amount = $model->price_per_month;
				
			 
				$order->category_id = $model->category;
				$order->latest = 1;
				if($order->save()){
				 	
					$message = 'Package Activated!';$success = true;
				}
				else{
					$message = CHtml::errorSummary($usageModel);
				}
			}
		}
			}
            if($success){
					$notify->addSuccess(Yii::t('app', $message));
				}
				else if(!empty($message)){
					$notify->addError(Yii::t('app', $message));
				}
            if ($collection->success) {
                 if(AccessHelper::hasRouteAccess ($this->id.'/index')){
                $this->redirect(Yii::App()->createUrl($this->id.'/index/type/'.$user->user_type));
				}
				else if(AccessHelper::hasRouteAccess ($this->id.'/created_by_me')){
                $this->redirect(Yii::App()->createUrl($this->id.'/created_by_me/type/'.$user->user_type));
				 
				}
            }

            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'order'     => $order,
            )));

            if ($collection->success) {
				if(AccessHelper::hasRouteAccess ($this->id.'/index')){
					$this->redirect(Yii::App()->createUrl($this->id.'/index/type/'.$user->user_type));
				}
				else if(AccessHelper::hasRouteAccess ($this->id.'/created_by_me')){
					$this->redirect(Yii::App()->createUrl($this->id.'/created_by_me/type/'.$user->user_type));
				 
				}
            }
        }

    if(AccessHelper::hasRouteAccess ($this->id.'/index')){
					 $index = 'index';
				}
				else if(AccessHelper::hasRouteAccess ($this->id.'/created_by_me')){
					 $index = 'created_by_me';
				 
				}

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('orders', 'Update package subscription'),
            'pageHeading'       => Yii::t('orders', 'Update package subscription'),
            'pageBreadcrumbs'   => array(
                Yii::t('orders', 'Package subscriptions') => $this->createUrl($this->id.'/'.$index),
                Yii::t('app', 'Update'),
            )
        ));

        $this->render('form', compact('order', 'note','index'));
    }
public function actionUpdate_status()
    {
	}
    /**
     * View order
     */
    
    /**
     * View order in PDF format
     */
    

    /**
     * Delete existing order
     */
    public function actionDelete($id)
    {
        $order = UserPackages::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $order->updateByPk($id,array('status'=> PricePlanOrder::STATUS_TRASHED ,'deleted_by'=>Yii::app()->user->getId(),'deleted_status'=>$order->status));  	
		PricePlanOrder::model()->calculateTotalBalance($order->user_id);
	

        $request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $redirect = null;
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $redirect = $request->getPost('returnUrl', array($this->id.'/index'));
        }

        // since 1.3.5.9
        Yii::app()->hooks->doAction('controller_action_delete_data', $collection = new CAttributeCollection(array(
            'controller' => $this,
            'model'      => $order,
            'redirect'   => $redirect,
        )));

        if ($collection->redirect) {
            $this->redirect($collection->redirect);
        }
    }
    
      public function actionRestore($id)
    {
		$request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $redirect = null;
        if (!$request->isAjaxRequest) {
            $this->redirect(Yii::app()->createUrl('dashboard/index'));
        }
        
        
        $order = UserPackages::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
	 
	    $order->updateByPk($id,array('status'=> $order->deleted_status ,'deleted_by'=>Yii::app()->user->getId() ));  	
	    PricePlanOrder::model()->calculateTotalBalance($order->user_id);						
        //$order->delete();

        

        // since 1.3.5.9
        Yii::app()->hooks->doAction('controller_action_delete_data', $collection = new CAttributeCollection(array(
            'controller' => $this,
            'model'      => $order,
            'redirect'   => $redirect,
        )));

        if ($collection->redirect) {
            $this->redirect($collection->redirect);
        }
    }
    public function actionDelete_permanent($id)
    {
		$request = Yii::app()->request;
        $notify  = Yii::app()->notify;

        $redirect = null;
        if (!$request->isAjaxRequest) {
            $this->redirect(Yii::app()->createUrl('dashboard/index'));
        }
        
        
        $order = UserPackages::model()->findByPk((int)$id);

        if (empty($order)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
	 
	    $order->delete();	
	    PricePlanOrder::model()->calculateTotalBalance($order->user_id);					
        //$order->delete();

        

        // since 1.3.5.9
        Yii::app()->hooks->doAction('controller_action_delete_data', $collection = new CAttributeCollection(array(
            'controller' => $this,
            'model'      => $order,
            'redirect'   => $redirect,
        )));

        if ($collection->redirect) {
            $this->redirect($collection->redirect);
        }
    }

  public function _registerJuiBs($event)
    {
        if (in_array($event->params['action']->id, array('create', 'update'))) {
            $this->getData('pageStyles')->mergeWith(array(
                array('src' => Yii::app()->apps->getBaseUrl('assets/css/jui-bs/jquery-ui-1.10.3.custom.css'), 'priority' => -1001),
            ));
        }
    }
}
