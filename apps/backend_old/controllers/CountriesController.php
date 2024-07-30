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
 
class CountriesController extends Controller
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
        $user = new Countries('search');
        $notify = Yii::app()->notify;
        if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				
			    Yii::import('backend.controllers.TranslateController');
			    $controller = new TranslateController('translate','');
                $sortOrderAll = $_POST['bulk'];
				if(count($sortOrderAll)>0)
				{
					set_time_limit(0);
					$sortOrderAll =  array_filter($sortOrderAll);
					foreach($sortOrderAll as $menuId=>$message)
					{
						 
						$id = 'Countries_country_name_'.$menuId;
						$relation = 'country_id';
						$relationID = $menuId;
						$lan = 'ar';
						if(!empty($message)){
								 
							$saved[] =  $controller->actionSaveNormal($id,$relation,$relationID,$lan,$message);
						}
						 
						
					}
					 
						 
				}
				 Yii::app()->options->set('system.common.country_cache',date('YmdHis'));
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
       
      //  print_r($user->search());exit;
     // print_r($user->search());exit;
        $user->unsetAttributes();
        
        // for filters.
        $user->attributes = (array)$request->getQuery($user->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('users', 'View users'), 
            'pageHeading'       => Yii::t('countries', 'Country List'),
            'pageBreadcrumbs'   => array(
                Yii::t('countries', 'Country') => $this->createUrl('countries/index'),
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
        $user = new Countries();
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
            if($user->location_longitude!="" and $user->location_longitude!="")
            {
				$user->location="1";
			}
            if (!$user->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				 
				 Yii::app()->options->set('system.common.country_cache',date('YmdHis'));
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
            if ($collection->success) {
                $this->redirect(array('countries/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('countries', 'Create new country'), 
            'pageHeading'       => Yii::t('countries', 'Create new Country'),
            'pageBreadcrumbs'   => array(
                Yii::t('countries', 'Country') => $this->createUrl('countries/index'),
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
        $user = Countries::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
         
        
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($user->modelName, array()))) {
            $user->attributes = $attributes;
                 if (isset(Yii::app()->params['POST'][$user->modelName]['footer_links'])) {
                $user->footer_links = Yii::app()->params['POST'][$user->modelName]['footer_links'] ;
            } 
               if (isset(Yii::app()->params['POST'][$user->modelName]['popular_links_sale'])) {
                $user->popular_links_sale = Yii::app()->params['POST'][$user->modelName]['popular_links_sale'] ;
            }
            if (isset(Yii::app()->params['POST'][$user->modelName]['popular_links_rent'])) {
                $user->popular_links_rent = Yii::app()->params['POST'][$user->modelName]['popular_links_rent'] ;
            }
            if($user->location_longitude!="" and $user->location_longitude!="")
            {
				$user->location="1";
			}
            if (!$user->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				  Yii::app()->options->set('system.common.country_cache',date('YmdHis'));
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
            if ($collection->success) {
                $this->redirect(array('countries/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('countries', 'Update Country'),
            'pageHeading'       => Yii::t('countries', 'Country'),
            'pageBreadcrumbs'   => array(
                Yii::t('capacity', 'Country') => $this->createUrl('countries/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('user'));
    }
    public function actionShow_on_listing($id=null,$show_on_listing=0)
    {
		$request = Yii::app()->request;
		if(!$request->isAjaxRequest){
			return false; 
		}
        $user = Countries::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user->show_on_listing = $show_on_listing;    Yii::app()->options->set('system.common.country_cache',date('YmdHis')); 
        if($show_on_listing=='1'){
			$user->updateByPk($id,array('show_on_listing'=>$show_on_listing,'enable_all_cities'=>'1'));
			echo json_encode(array('status'=>'1','msg'=>'Successfully added to list items '));
			Yii::app()->end();
		}
		else{
			$user->updateByPk($id,array('show_on_listing'=>$show_on_listing,'enable_all_cities'=>'0'));
			echo json_encode(array('status'=>'1','msg'=>'Successfully removed from  list items '));
			Yii::app()->end();
		}
        
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax') and $user->save()) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully update!'));
            $this->redirect($request->getPost('returnUrl', array('countries/index')));
        }
        
        $this->render('form', compact('user'));
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $user = Countries::model()->findByPk((int)$id);
        
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
    
}
