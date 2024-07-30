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
 
class SubcategoryController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Sub Category";
     public $focus = "sub_category_name";
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
         $model = new Subcategory('serach');
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
        $model = new Subcategory();
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
          
            $model->attributes = $attributes;
            $model->slug = $model->getUniqueSlug();
            
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            $uploadedFile2=CUploadedFile::getInstance($model,'active_image');
            if($uploadedFile){	 $fileName  = 'ims'.rand(100,1000).$uploadedFile; $model->image = $fileName; }
            if($uploadedFile2){	 $fileName2 = 'acs'.rand(100,1000).$uploadedFile2; $model->active_image = $fileName2; }

             if (!$model->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
                
            } else {
				     if($uploadedFile){	$path =  Yii::app()->basePath . '/../../uploads';$uploadedFile->saveAs($path.'/default/'. $fileName);}
					 if($uploadedFile2){	$path =  Yii::app()->basePath . '/../../uploads';$uploadedFile2->saveAs($path.'/default/'. $fileName2);}
             
				 
				// 	  $this->redirect($this->createUrl(Yii::app()->controller->id.'/fields',array("id"=>$model->sub_category_id)));exit;
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array(Yii::app()->controller->id.'/index'));
            }
        }
        
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
    public function actionUpdate($id)
    {
		 
        $model = Subcategory::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
             $oldfilename =$model->image;
			 $oldfilename2 =$model->active_image;
        
             $model->attributes = $attributes;
             
             $file = CUploadedFile::getInstance($model, 'image');
             $file2 = CUploadedFile::getInstance($model, 'active_image');
			 if (is_object($file) && get_class($file)==='CUploadedFile') {	     $fileName = 'ims'.rand(100,1000).$file; $model->image = $fileName;  } 
			 if (is_object($file2) && get_class($file2)==='CUploadedFile') {	 $fileName2 = 'acs'.rand(100,1000).$file; $model->active_image = $fileName2;  } 
         
            // $model->slug = $model->getUniqueSlug();
            if (!$model->save()) {
				
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
			  	    if (is_object($file) && get_class($file)==='CUploadedFile') { $path =  Yii::app()->basePath . '/../../uploads'; $file->saveAs($path.'/default/'. $fileName); 	if ($oldfilename != $fileName) { @unlink(Yii::app()->basePath . '/../../uploads/default/'. $oldfilename); } }  
					if (is_object($file2) && get_class($file2)==='CUploadedFile') { $path =  Yii::app()->basePath . '/../../uploads'; $file2->saveAs($path.'/default/'. $fileName2); 	if ($oldfilename2 != $fileName2) { @unlink(Yii::app()->basePath . '/../../uploads/default/'. $oldfilename2); } }  

					$this->redirect($this->createUrl(Yii::app()->controller->id.'/fields',array("id"=>$model->sub_category_id)));exit;
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect(array(Yii::app()->controller->id.'/index'));
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
        
        $this->render('form', compact('model'));
    }
    public function actionUpdateAmenities($id)
    {
		 
        $model = Subcategory::model()->FindData_SubCategory_With_Amenities_required($id);
        
        if (empty($model->category)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest) {
               
               $attributes2 = (array)$request->getPost('amenities');
               $Amenities =  new   SubcategoryAmenitiesList;
			   $Amenities->deleteAll(array("condition"=>"sub_category_id=:sub_category_id","params"=>array(":sub_category_id"=>$model->sub_category_id)));
			   if($attributes2)
			   {
				   foreach($attributes2 as $k)
				   {
						$Amenities->isNewRecord =true;
						$Amenities->amenities_id = $k ;
						$Amenities->sub_category_id = $model->sub_category_id ;
						$Amenities->save();
				   }  
					 
				   
			   }
				 
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                 $this->redirect($this->createUrl(Yii::app()->controller->id.'/fields',array("id"=>$model->sub_category_id)));exit;
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
        
        $this->render('amenities', compact('model'));
    }
    
   
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = Subcategory::model()->findByPk((int)$id);
        
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
    public function actionLoadCategories()
	{
	   $id=null;
	   if(isset($_POST['section_id'])){ $id =$_POST['section_id'];  }
	   $data=Category::model()->ListDataWithSection($id);
	   $data=CHtml::listData($data,'category_id','category_name');
	   echo "<option value=''>Select Category</option>";
	   foreach($data as $k=>$v)
	   echo CHtml::tag('option', array('value'=>$k),CHtml::encode($v),true);
	}
	 public function actionFields($id)
    {
		 
        $model = Subcategory::model()->findByPk((int)$id);
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
        $model->attributes = $attributes;
        
       $model->change_parent_fields = @$attributes['change_parent_fields'];
            if (!$model->save()) {
                  $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
			   $attributes2 = (array)$request->getPost('fields');
               $Fileds =  new   SubCategoryFieldList;
			   $Fileds->deleteAll(array("condition"=>"sub_category_id=:sub_category_id","params"=>array(":sub_category_id"=>$model->sub_category_id)));
			   if($model->change_parent_fields=="Y")
			   {
				   if($attributes2)
				   {
					   foreach($attributes2 as $k)
					   {
							$Fileds->isNewRecord =true;
							$Fileds->field_name = $k ;
							$Fileds->sub_category_id = $model->sub_category_id ;
							$Fileds->save();
					   }  
						 
					   
				   }
			   }
               $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
              
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
				
				$model = Subcategory::model()->Find_id_add_models($id);
				if (empty($model) or !in_array("model",($model->change_parent_fields=="Y") ? CHtml::listData($model->relatedFieldsList,'field_name','field_name'): CHtml::listData($model->category->relatedFields,'field_name','field_name'))) {
				 $this->redirect(array(Yii::app()->controller->id.'/index'));	 
				}
				else
				{
					$this->redirect($this->createUrl(Yii::app()->controller->id.'/models',array("id" => $model->sub_category_id )));exit;
				}
               
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
    
    
      public function actionModels($id)
    {
		 
        $model = Subcategory::model()->Find_id_add_models($id);
        if (empty($model) or !in_array("model",($model->change_parent_fields=="Y") ? CHtml::listData($model->relatedFieldsList,'field_name','field_name'): CHtml::listData($model->category->relatedFields,'field_name','field_name'))) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest) {
             $attributes = (array)$request->getPost("VehicleModel");
            // $model->slug = $model->getUniqueSlug();
            if (!$attributes) {
				
                $notify->addError(Yii::t('app', 'please add ateast one row'));
            } else {
				
				if($attributes)
				{
					 $vehiclemodel = new VehicleModel;
					 foreach($attributes as $k=>$v)
					 {
						 if( isset($v["model_name"]) and $v["model_name"]!="")
						 {
							 
						 $vehiclemodel->isNewRecord = true;
						 $vehiclemodel->model_id  ="";
						 $vehiclemodel->model_name  = $v["model_name"];
						 $vehiclemodel->sub_category_id  = $model->sub_category_id;
						 $vehiclemodel->save() ;
					   }
				   }
				  
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
               }
		  }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect($this->createUrl(Yii::app()->controller->id.'/model_list',array("id" => $model->sub_category_id )));exit;
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
        $vehiclemodel = new VehicleModel;
        $this->render('models', compact('model',"vehiclemodel"));
    }
    public function actionModel_list($id)
    {
		 
        $model = Subcategory::model()->Find_id_add_models($id);
        if (empty($model) or !in_array("model",($model->change_parent_fields=="Y") ? CHtml::listData($model->relatedFieldsList,'field_name','field_name'): CHtml::listData($model->category->relatedFields,'field_name','field_name'))) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $model2 = new VehicleModel;
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
  
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Update {$this->Controlloler_title}"),
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id,"{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        $vehiclemodel = new VehicleModel;
        $this->render('model_list', compact('model',"model2"));
    }
    public function actionModel_Update($id)
    {
		 
        $model = VehicleModel::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
             $model->attributes = $attributes;
            // $model->slug = $model->getUniqueSlug();
            if (!$model->save()) {
				
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
			    
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'model'       => $model,
            )));
            
            if ($collection->success) {
                $this->redirect($this->createUrl(Yii::app()->controller->id.'/model_list',array("id" => $model->sub_category_id )));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "Update {$this->Controlloler_title}"),
            'pageHeading'       => "Model Manger",
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id,"{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('model_update', compact('model'));
    }
   public function actionModel_delete($id)
    {
        $model = VehicleModel::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
            $model->updateByPk($id,array('isTrash'=>Yii::app()->params['onTrash']));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($this->createUrl(Yii::app()->controller->id.'/model_list',array("id" => $model->sub_category_id )));
        }
    }
}
