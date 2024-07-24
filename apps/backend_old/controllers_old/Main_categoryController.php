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
 
class Main_categoryController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Category";
     public $focus = "catebory_name";
     public function init()
    {
        $this->getData('pageStyles')->add(array('src' => AssetsUrl::css('table.css')));
        parent::init();
    }
 
    /**
     * List all available users
     */
    public function actionIndex()
    {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new MainCategory('serach');
         if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$model->isNewRecord =true; 
						$model->updateByPk($menuId,array('priority'=>$sortOrder)); 
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
						 
						$id = 'MainCategory_category_name_'.$menuId;
						$relation = 'category_id';
						$relationID = $menuId;
						$lan = 'ar';
						if(!empty($message)){
								 
							$saved[] =  $controller->actionSaveNormal($id,$relation,$relationID,$lan,$message);
						}
						 
						
					}
					 
						 
				}
			    Yii::app()->options->set('system.common.category_cache',date('YmdHis'));
				$notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				$this->redirect(Yii::app()->request->urlReferrer) ;
        }
       
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
        $this->render('list', compact('model'));
    }
    
    public function actionCreate()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new MainCategory();
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			   ;
            $model->attributes = $attributes;
             $model->listing_countries = Yii::app()->request->getPost("listing_countries");
            $model->slug = $model->getUniqueSlug();
            
            
				$uploadedFile=CUploadedFile::getInstance($model,'sub_image');
				if($uploadedFile){
					$ext =  pathinfo($uploadedFile ,PATHINFO_EXTENSION ) ; 
					$fileName = date('Ymdhis').rand(100,1000).'.'.$ext;
					$model->image = $fileName;
				}
         
            
             if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				if($uploadedFile)
				{
					$path =  Yii::app()->basePath . '/../../uploads';
					$uploadedFile->saveAs($path.'/banner/'. $fileName);
				} 
				 Yii::app()->options->set('system.common.category_cache',date('YmdHis'));
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect($this->createUrl(Yii::app()->controller->id.'/index' ));
            }
        }
               $apps = Yii::app()->apps;
        $this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('model'));
    }
    
    /**
     * Update existing user
     */
    public function actionUpdate($id=null)
    {
		 
	
        $model = MainCategory::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        	 
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			
			 $oldfilename =$model->sub_image;
             $model->attributes = $attributes;
              $model->listing_countries = Yii::app()->request->getPost("listing_countries");
            // $model->slug = $model->getUniqueSlug();
            
              $file = CUploadedFile::getInstance($model, 'sub_image');
			 if (is_object($file) && get_class($file)==='CUploadedFile') {
				          
				
				$ext =  pathinfo($file ,PATHINFO_EXTENSION ) ; 
				$fileName = rand(100,1000).date('Ymdhis').'.'.$ext;
				$model->sub_image = $fileName;
			 } else {
				$model->sub_image = $oldfilename;
			 }
            
            if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				 if (is_object($file) && get_class($file)==='CUploadedFile') {
				 
				$path =  Yii::app()->basePath . '/../../uploads';
				$file->saveAs($path.'/banner/'. $fileName);
				if ($oldfilename != $fileName) {
				@unlink(Yii::app()->basePath . '/../../uploads/banner/'. $oldfilename);
				}
				}
				Yii::app()->options->set('system.common.category_cache',date('YmdHis'));
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
				 $this->redirect($this->createUrl(Yii::app()->controller->id.'/index' ));
                 //$this->redirect($this->createUrl(Yii::app()->controller->id.'/fields',array("id"=>$model->category_id)));
            }
        }
		 else{
		    //$model->listing_countries = CHtml::listData($model->listCountries,'country_id','country_id');
	    } 
		$apps = Yii::app()->apps;
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Update {$this->Controlloler_title}"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id,"{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('model'));
    }
    public function actionFields($id)
    {
		 
        $model = MainCategory::model()->findByPk((int)$id);
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest) {
               
               $attributes2 = (array)$request->getPost('fields');
               $attributes3 = (array)$request->getPost('master_fields');
               $Fileds =  new   CategoryFieldList;
			   $Fileds->deleteAll(array("condition"=>"category_id=:category_id","params"=>array(":category_id"=>$model->category_id)));
			   if($attributes2)
			   {
				   foreach($attributes2 as $k)
				   {
						$Fileds->isNewRecord =true;
						$Fileds->field_name = $k ;
						$Fileds->category_id = $model->category_id ;
						$Fileds->save();
				   }  
					 
				   
			   }
			   if($attributes3)
			   {
				   foreach($attributes3 as $k)
				   {
						$Fileds->isNewRecord =true;
						$Fileds->field_name = $k ;
						$Fileds->category_id = $model->category_id ;
						$Fileds->save();
				   }  
			   }
            $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->refresh();
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Update {$this->Controlloler_title}"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id,"{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('fields', compact('model'));
    }
    public function actionMandatory($id)
    {
		 
        $model = MainCategory::model()->findByPk((int)$id);
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest) {
               
               $attributes2 = (array)$request->getPost('fields');
               $Fileds =  new   CategoryFieldListManadatory;
			    $Fileds->deleteAll(array("condition"=>"category_id=:category_id","params"=>array(":category_id"=>$model->category_id)));
			 
			    if($attributes2)
			   {
				    
					   foreach($attributes2 as $k)
				   {
						$Fileds->isNewRecord =true;
						$Fileds->field_name = $k ;
						$Fileds->category_id = $model->category_id ;
						$Fileds->save();
				   }  
			 
			 
					 
				   
			   }
            $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->refresh();
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Update {$this->Controlloler_title}"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id,"{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('mandatory', compact('model'));
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = MainCategory::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->updateByPk($id,array('isTrash'=>Yii::app()->params['onTrash']));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    
   
    
}
