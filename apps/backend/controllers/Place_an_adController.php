<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class Place_an_adController extends Controller
{
 
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
     public $Controlloler_title= "Ad";
     public $focus = "country";
     	public $member;
     public function init()
    {
		 
		parent::Init();
	     
        
    }
   public function actionIndex()
    {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model = new PlaceAnAd('serach');
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
        // $model->listing_type = 'C';
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
           $criteria=new CDbCriteria;
        $criteria->compare('tag_type','L');
          $tagModel = Tag::model()->findAll($criteria);
        $tags = CHtml::listData($tagModel,'tag_id','tag_name');
        $tags_short =   $model->place_ad_tag_code();
        $this->render('list', compact('model','tags','tags_short'));
    }
    
     public function  beforeAction($action)
    {   
		 
				if(in_array($action->id,array('create','success','update','success_edit'))){
				$apps = Yii::app()->apps;
	 
				$this->getData('pageStyles')->add(array('src' =>$apps->getBaseUrl('backend/assets/css/styles/jqx.base.css')));
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/table_common.css')));
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/styles/jqx.energyblue.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxcore.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/custom.js?q=1')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxbuttons.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxscrollbar.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxlistbox.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxcombobox.js')));
				$this->getData('pageScripts')->add(array('src' =>$apps->getBaseUrl('backend/assets/js/jqwidgets/jqxdropdownlist.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
				$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
				$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2script.js')));
				}
				return parent::beforeAction($action);
	}
    public function actionCreate()
    {  
        
        $this->redirect(Yii::App()->createUrl("place_property/create"));
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd();
        $country = Countries::model()->ListDataForJSON();
        $section = Section::model()->ListDataForJSON_ID();
        $list_type = Category::model()->ListDataTypeForJSON_ID();
         
	    $image_array=array();
	    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ' ,'{p}'=> Yii::app()->options->get('system.common.site_name'))),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			 
        ));
      //  print_r($_POST);exit;
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			
		//	 echo "SDSD";exit;
 
			$category= Category::model()->findByPk(@$attributes["category_id"]);
			if(empty($category)){
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
            $subcategory= Subcategory::model()->FindSubategory(@$attributes["sub_category_id"]);
            
            $fields=array();
            
			 
            $fields=  CHtml::listData($category->relatedFields,'field_name','field_name');
            			$not_mandatory_fields=  array_merge($model->common_not_mandatory_field(),CHtml::listData($category->relatedFieldsMandatory,'field_name','field_name'));
			$model->dynamic  =  true; 
			//$model->dynamicArray = array_merge(array_diff((array)$fields,$model->dynamicFields()));
			$model->dynamicArray =  $model->getExcludeArray((array)$fields) ;;
			$model->_notMadatory =  $not_mandatory_fields;
		
			$model->country = $attributes["country"];
			$model->state = $attributes["state"];
			$model->listing_type = $attributes["listing_type"];
			 
	 
			//$model->city = $attributes["city"];
			$model->sub_category_id = $attributes["sub_category_id"];
			$model->category_id = $attributes["category_id"];
			$model->section_id = $attributes["section_id"];
			 
           
			if(isset($attributes['ad_title']))
			{
			    $model->attributes= $attributes;
			    if (isset(Yii::app()->params['POST'][$model->modelName]['ad_description'])) {
				$model->ad_description = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$model->modelName]['ad_description']);
				}

				$model->category_id =  $category->category_id;;
			 
				if(isset($attributes["model"]))
				{
				$model->model = ($attributes["model"]==0)? 'Others': $attributes["model"] ;
				}
				//$model->dynamicArray ="";
				if($model->validate())
				{
				     
					        $jsonData = json_encode(array()) ;/* NearbyLocation::model()->JsonData();*/
				            if(isset($attributes["location_latitude"]) and $model->save())
				            {
								 
									$room_image = new AdImage;
									$imgArr =  explode(',',$model->image);
									if($imgArr)
									{
										 
										$img_saved= false;
										foreach($imgArr as $k)
										{
											 
											 
												if(!$img_saved and $model->image!="")
												{
													 
												 $model->updateByPk($model->id,array('image'=>$k)); 
												 $img_saved=true;	
												 
												}
												$room_image->isNewRecord = true;
												$room_image->id = "";
												$room_image->ad_id = $model->id;
												$room_image->image_name =  $k;
												$room_image->save();
												 
											
										}
										
									 }
									  if($ameni = Yii::app()->request->getPost("amenities"))
									  {
										 $am = new  AdAmenities();
										 foreach($ameni as $k)
										 {
											 
												$am->isNewRecord = true;
												$am->ad_id = $model->id;
												$am->amenities_id =  $k;
												$am->save();
										 }
										 
									  }
									  $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
									 $this->redirect(Yii::app()->createUrl("place_an_ad/success",array("id"=>$model->id)));
								
							}
							else
							{
								
						
							$model->amenities = Yii::app()->request->getPost("amenities");
						
							$exp =  explode(",",$model->image);
							if($exp)
							{
								foreach($exp as $k=>$v)
								{
									if($v!="")
									{
										$image_array[] = $v;
									}
								}
							}
							$this->actionDetails_2($model,$subcategory,$category,$fields,$image_array, $jsonData);
						   }
				 }
				 else
				 {
				 
                     $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
					 $model->amenities = Yii::app()->request->getPost("amenities");
					
						$exp =  explode(",",$model->image);
						if($exp)
						{
							foreach($exp as $k=>$v)
							{
								if($v!="")
								{
									$image_array[] = $v;
								}
							}
					    }
				 }
				 
				 
				 
 
			}
			$model->sub_category_id = $attributes["sub_category_id"];
			$this->actionDetails($model,$subcategory,$category,$fields,$image_array);
           
        }
        else
        {
			$this->render('form', compact('model',"country","section",'list_type'));
		}
        
 
        
    }
     public function actionDetails($model,$subcategory,$category,$fields,$image_array)
    {
		$apps = Yii::app()->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->render('details', compact('model','subcategory','category',"fields","image_array",'hooks'));
    }
     public function actionDetails_2($model,$subcategory,$category,$fields,$image_array,$jsonData)
    {
		 
		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('myAjax.js')));
        $this->render('location_view', compact('model','subcategory','category',"fields","image_array","jsonData"));exit;
    }
     public function actionDetails_edit($model,$subcategory,$category,$fields,$image_array)
    {
		$apps = Yii::app()->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
        $this->render('details_edit', compact('model','subcategory',"category","fields","image_array"));
    }
     public function actionFindOnMap()
    {
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd();
      //  $subcategory= SubCategory::model()->FindSubategory("12");
         
        $this->setData(array(
            'pageMetaTitle'     =>  Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        $this->render('details', compact('model'));
    }
    
    
    /**
     * Update existing user
     */
    public function actionUpdate($id)
    {
		 
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $country = Countries::model()->ListDataForJSON();
        $state   = States::model()->ListDataForJSON($model->country) ;
        $city   = City::model()->ListDataForJSON($model->state) ;
        $list_type = Category::model()->ListDataTypeForJSON_ID();
        $model->state= ($model->state==0)? 'All Cities' : $model->state;
        $section = Section::model()->ListDataForJSON_ID();
        $category = Category::model()->ListDataForJSON_ID_BySEction($model->listing_type);
        $sub_category =   Subcategory::model()->ListDataForJSON_ID($model->category_id) ;
        $subcategory=Subcategory::model()->findByPk($model->sub_category_id);
        $fields=array();
        $vehicleModel =array();
        
 	 
	    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"), 
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "Update Listing "),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
				Yii::t('app', 'Edit'),
			)
        ));
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			
			 
 
            $subcategory= Subcategory::model()->FindSubategory(@$attributes["sub_category_id"]);
            $category=Category::model()->findByPk(@$attributes["category_id"]);
            if(empty($category))
			{
			          throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			}
 	 
			$fields=  CHtml::listData($category->relatedFields,'field_name','field_name');
			$not_mandatory_fields=  array_merge($model->common_not_mandatory_field(),CHtml::listData($category->relatedFieldsMandatory,'field_name','field_name'));
			$model->dynamic  =  true; 
			//$model->dynamicArray = array_merge(array_diff((array)$fields,$model->dynamicFields()));
			$model->dynamicArray =  $model->getExcludeArray((array)$fields) ;;
			$model->_notMadatory =  $not_mandatory_fields;


			$model->country = $attributes["country"];
			$model->state = $attributes["state"];
			$model->listing_type = $attributes["listing_type"];
			//$model->city = $attributes["city"];
			$model->section_id = $attributes["section_id"];
			$model->sub_category_id = $attributes["sub_category_id"];
			if(isset($attributes["model"]))
			{
			$model->model = ($attributes["model"]==0)? 'Others': $attributes["model"] ;
		    }
			  
			$image_array  = array() ;        
            if(isset($model->adImages) )
            {
				foreach($model->adImages as $k=>$v)
				{
					$image_array[] = $v->image_name;
				}
		    }
		 
		   	if(isset($attributes['ad_title']))
			{
				 
			    $model->attributes= $attributes;
			    if (isset(Yii::app()->params['POST'][$model->modelName]['ad_description'])) {
				$model->ad_description = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$model->modelName]['ad_description']);
				}

			    if(isset($attributes["model"]))
				{
				$model->model = ($attributes["model"]==0)? 'Others': $attributes["model"] ;
				}
				$model->category_id = $category->category_id;
			   //  $model->added_date = date("Y-m-d h:i:s");
				if($model->validate())
				{
						  $jsonData = json_encode(array());
						 
				        if(isset($attributes["location_latitude"]) and $model->save())
				        {
						
						 
						 $room_image = new AdImage;
						$room_image->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$model->id)));
						$imgArr =  explode(',',$model->image);
						 
						if($imgArr)
						{
							 
							 
							$img_saved =false;
							foreach($imgArr as $k)
							{
								 
									if(!$img_saved and $model->image!="")
									{
										 
									 $model->updateByPk($id,array('image'=>$k));  	
									 
									}
									$room_image->isNewRecord = true;
									$room_image->id = "";
									$room_image->ad_id = $model->id;
									$room_image->image_name =  $k;
									$room_image->save();
									 
								 
								
							}
						 
							
						 }
						  $am = new  AdAmenities();
						  $am->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$model->id)));
						  if($ameni = Yii::app()->request->getPost("amenities"))
						  {
							 
							 foreach($ameni as $k)
							 {
								 
									$am->isNewRecord = true;
									$am->ad_id = $model->id;
									$am->amenities_id =  $k;
									$am->save();
							 }
							 
						  }
						  $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
						 $this->redirect(Yii::app()->createUrl("place_an_ad/success_edit",array("id"=>$model->id)));
					   }
					   else
					   {
						   $image_array = array();
						   $model->amenities = Yii::app()->request->getPost("amenities");
						$exp =  explode(",",$model->image);
							 
							if($exp)
							{
								foreach($exp as $k=>$v)
								{
									if($v!="")
									{
										$image_array[] = $v;
									}
								}
							}
							
							$this->actionDetails_2($model,$subcategory,$category,$fields,$image_array,$jsonData);
						   }
					   
				 }
				 else
				 {
					
					 $model->amenities = Yii::app()->request->getPost("amenities");
					 $image_array=array();
						$exp =  explode(",",$model->image);
						if($exp)
						{
							foreach($exp as $k=>$v)
							{
								if($v!="")
								{
									$image_array[] = $v;
								}
							}
					    }
					 
					 
				 }
				 
				 
				 
 
			}
			$model->sub_category_id = $attributes["sub_category_id"];
			$this->actionDetails_edit($model,$subcategory,$category,$fields,$image_array);
           
        }
        else
        {
			$this->render('form-edit', compact('model',"country","category","state","sub_category","city","section","vehicleModel",'list_type')); 
		}
    }
    
    /**
     * Delete existing user
     */
    public function actionDelete($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);
        
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
    public function actionFeatured($id,$featured)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
            $featured = ($featured=="N") ? "Y" : "N";
            $model->updateByPk($id,array('featured'=>$featured ));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    public function actionStatus($id,$status)
    {
		 
		 
        $model = PlaceAnAd::model()->findByPk((int)$id);
        $status=(string)$status;
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
          
			  $status =  'I'; 
		   
      
    
            $model->updateByPk($id,array('status'=>$status ));    
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'Successfully changed status'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
     public function actionUpdate_status_i($id,$status)
    {
		 
		 
        $model = AdImage::model()->findByPk((int)$id);
        $status=(string)$status;
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
          
		if($status=='1'){ $status = 'A' ; }	else{ $status = 'I' ; } 
		   
      
    
            $model->updateByPk($id,array('status'=>$status ));    
         
            echo 1; exit; 
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'Successfully changed status'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
     public function actionDelete_i($id)
    {
		 
		 
        $model = AdImage::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
          
	 	   
      
    
            $model->delete();    
         
            echo 1; exit; 
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'Successfully changed status'));
            $this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id.'/index')));
        }
    }
    public function actionSelect_state()
    {
	  echo   States::model()->ListDataForJSON(Yii::app()->request->getPost("country")) ;exit;
	}
    public function actionSelect_city()
    {
	  echo   City::model()->ListDataForJSON(Yii::app()->request->getPost("state")) ;exit;
	}
    public function actionSelect_category()
    {
	  echo   Category::model()->ListDataForJSON_ID_BySEction(Yii::app()->request->getPost("section")) ;exit;
	}
    public function actionSelect_sub_category()
    {
	  echo   Subcategory::model()->ListDataForJSON_ID(Yii::app()->request->getPost("category")) ;exit;
	}
	public function actionSelect_model($id)
    {
	    $subcategory =  Subcategory::model()->findByPk($id);
		
		$fields=array();
		$fields=  ($subcategory->change_parent_fields=="N") ? CHtml::listData($subcategory->category->relatedFields,'field_name','field_name'):CHtml::listData($subcategory->relatedFields,'field_name','field_name');
 
			if(in_array('model',$fields))
			{
				echo   VehicleModel::model()->ListDataForJSON_ID_ByModel($id) ;exit;
			}
			else
			{
				echo 0;
			}
		 
	 
	  
	}
	public function actionUploadExcel()
    {
        $model = new PlaceAnAd();

        if (isset($_POST['PlaceAnAd'])) {
            $model->attributes = $_POST['PlaceAnAd'];

            // Handle file uploads
            $excelFile = CUploadedFile::getInstance($model, 'excelFile');
            $zipFile = CUploadedFile::getInstance($model, 'zipFile');

            if ($excelFile && $zipFile) {
                $uploadsPath = Yii::getPathOfAlias('webroot.uploads');
                $excelFilePath = $uploadsPath . '/' . $excelFile->name;
                $zipFilePath = $uploadsPath . '/' . $zipFile->name;

                $excelFile->saveAs($excelFilePath);
                $zipFile->saveAs($zipFilePath);

                // Extract ZIP file
                $zip = new ZipArchive;
                if ($zip->open($zipFilePath) === TRUE) {
                    $zip->extractTo($uploadsPath . '/images');
                    $zip->close();
                } else {
                    throw new CHttpException(500, 'Failed to open ZIP file.');
                }

                // Read the Excel file
                $data = $this->readExcelFile($excelFilePath);

                // Process the data
                foreach ($data as $row) {
                    $ad = new PlaceAnAd();
                    $ad->attributes = $row;

                    // Handle image
                    $imageName = $row['image'];
                    $imagePath = $uploadsPath . '/images/' . $imageName;
                    if (file_exists($imagePath)) {
                        $ad->image = '/uploads/images/' . $imageName;
                    } else {
                        // Handle missing image
                        $ad->image = null;
                    }

                    if ($ad->validate()) {
                        $ad->save();
                    } else {
                        // Handle validation errors
                    }
                }

                Yii::app()->user->setFlash('success', 'Files have been uploaded and processed successfully.');
            } else {
                Yii::app()->user->setFlash('error', 'Please upload both Excel and ZIP files.');
            }
        }

        $this->render('list', array('model' => $model));
    }

    protected function readExcelFile($filePath)
    {
		$data = array();
        $objPHPExcel = PHPExcel_IOFactory::load($filePath);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            for ($row = 2; $row <= $highestRow; ++$row) {
                $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
                $data[] = array(
                    'sr_no' => $rowData[0][0],
                    'date' => $rowData[0][1],
                    'property_id' => $rowData[0][2],
                    'rg_estate_id' => $rowData[0][3],
                    'property_type' => $rowData[0][4],
                    'availability' => $rowData[0][5],
                    'transaction_type' => $rowData[0][6],
                    'location' => $rowData[0][7],
                    'listing_type' => $rowData[0][8],
                    'ad_title' => $rowData[0][9],
                    'property_details' => $rowData[0][10],
                    'ownership' => $rowData[0][11],
                    'bedrooms' => $rowData[0][12],
                    'plot_area' => $rowData[0][13],
                    'size' => $rowData[0][14],
                    'total_price' => $rowData[0][15],
                    'rent_paid' => $rowData[0][16],
                    'land_mark' => $rowData[0][17],
                    'google_location' => $rowData[0][18],
                    'people_capacity' => $rowData[0][19],
                    'toilet' => $rowData[0][20],
                    'total_lc_people_capacity' => $rowData[0][21],
                    'kitchen' => $rowData[0][22],
                    'bathroom' => $rowData[0][23],
                    'lc_water_closet_wc' => $rowData[0][24],
                    'wash_basin' => $rowData[0][25],
                    'dining' => $rowData[0][26],
                    'wh_no_of_units' => $rowData[0][27],
                    'mezzanine' => $rowData[0][28],
                    'office' => $rowData[0][29],
                    'insulation' => $rowData[0][30],
                    'sprinkler' => $rowData[0][31],
                    'power' => $rowData[0][32],
                    'wh_height' => $rowData[0][33],
                    'usage' => $rowData[0][34],
                    'type' => $rowData[0][35],
                    'company_name' => $rowData[0][36],
                    'name' => $rowData[0][37],
                    'mobile1' => $rowData[0][38],
                    'mobile2' => $rowData[0][39],
                    'email' => $rowData[0][40],
                    'mobile3' => $rowData[0][41],
                    'type2' => $rowData[0][42],
                    'name2' => $rowData[0][43],
                    'mobile4' => $rowData[0][44],
                    'email2' => $rowData[0][45],
                    'plot_no' => $rowData[0][46],
                    'Files' => $rowData[0][47],
                );
            }
        }
        return $data;
    
    }
	public $image_size;
	public $image_name;
      public function actionUpload($width=null,$height=null)
    {
	 
	 
	  ini_set('memory_limit', '-1'); $this->fileUploadDropzone();exit;      
    	 if (defined('ENABLED_AWS_SERVER') && ENABLED_AWS_SERVER=='1'){
			$file = $_FILES['file']['name'];
			$file_orginal = $_FILES['file']['tmp_name'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$File = pathinfo($file, PATHINFO_FILENAME);
			//$img = $File.'_'.uniqid(rand(0, time())).".".$ext;
		 
				$img = rand(0,9999).'_'.time().".".$ext;
			 
			$awsAccessKey = ENABLED_AWS_ACCESS;
			$awsSecretKey = ENABLED_AWS_SECRET;
			 
			$bucketName = ENABLED_BUCKET_NAME;
			 
			Yii::import('common.extensions.amazon.S3');
			$s3 = new S3($awsAccessKey, $awsSecretKey);
			$uploadName = $_FILES['file']['name'];
			$ar = $s3->putObject(S3::inputFile($file_orginal, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
			echo $img;
		}
		else{
	   $path =  Yii::getPathOfAlias('root.uploads.images');    
		//Yii::import('backend.extensions.ResizeImage');
		if($_FILES['file']['tmp_name'])
				{
					ini_set('memory_limit', '-1');
					$file = $_FILES['file']['name'];
					$file_orginal = $_FILES['file']['tmp_name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$File = pathinfo($file, PATHINFO_FILENAME);
					$new_name =  substr(preg_replace("/[^a-zA-Z0-9._-]/", '_', "{$File}"),0,220);
					$new_name = empty($new_name) ? 'Untitled' : $new_name;
					$img = date('my').'_'.time().$new_name.'_'.".".$ext;
					if(!empty($width)){
					 
						$detSize = getimagesize($_FILES['file']['tmp_name']);
						if($detSize){
							if(empty($height)){
								$aspectRatio = $detSize[1] / $detSize[0];
								$newHeight = (int)($aspectRatio * $width)  ;
							}
							else{
								$newHeight = $height ; 
							}
							$this->image_size = $detSize ; 
							$this->image_name = $img ; 
							
							$tempPath = Yii::getPathOfAlias('root.uploads.resized');  
							$resized = $this->makeTumbnail($_FILES['file']['tmp_name'],$width,$newHeight,$tempPath);
							
						}
					}
					move_uploaded_file($_FILES['file']['tmp_name'], $path."/{$img}");
					echo $img;
			    }
			    else
			    {
					echo "0";
				}
			}
	}
  
   function actionDelete_image()
	{
		 
	
		$str="";
		if(isset($_POST['inp']))
		{
		 
			 
			$ar = explode(',',$_POST['inp']);
			 
			 
			if($ar)
			{
				foreach($ar as $k=>$val)
				{
					 
					if($val!=$_POST['file'] and $val!="")
					{
						 
						$str .= ",".$val;
						 
					}
				}
			}
			 
		}
		echo $str; 
		 
    
   }
   public function actionSuccess($id)
   {
	    $model = PlaceAnAd::model()->findByPk($id);
	    if(empty($model))
	    {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
	     $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ' ,'{p}'=>Yii::app()->options->get('system.common.site_name'))),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
				Yii::t('app', 'Create new'),
			)
        ));
        $this->render('success', compact('model'));
   } 
   public function actionSuccess_edit($id)
   {
	    $model = PlaceAnAd::model()->findByPk($id);
	    if(empty($model))
	    {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		 
	    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ' ,'{p}'=> Yii::app()->options->get('system.common.site_name'))),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "Update Listing"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
				Yii::t('app', 'Create new'),
			)
        ));
        $this->render('success-edit', compact('model'));
   } 
   
 
     public function actionLoadCities()
	{
	   $id=null;
	   if(isset($_POST['state'])){ $id =$_POST['state'];  }
	   $data=City::model()->FindCities($id);
	   $data=CHtml::listData($data,'city_id','city_name');
	   echo "<option value=''>All Cities</option>";
	   foreach($data as $k=>$v)
	   echo CHtml::tag('option', array('value'=>$k),CHtml::encode($v),true);
	}
	 public function actionImage_management($id)
	{
		 
		$ad = PlaceAnAd::model()->findByPk((int)$id);
        if (empty($ad)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $user =  new AdImage;
         
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        if ($request->isPostRequest) {
			   $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				$up = $user->HighestPriorityImage($id);
				if($up)
				{
					$ad->updateByPk($id,array('image'=>$up->image_name)); 
				}
				 
				$notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
             
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller' => $this,
                'success'    => $notify->hasSuccess,
                'user'       => $user,
            )));
            
           /* if ($collection->success) {
                $this->redirect(array('room_manage/index'));
            }
            * */
        }
        
      
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('room_manage', 'Image Management'),
            'pageHeading'       => Yii::t('room_manage', 'Image Management'),
            'pageBreadcrumbs'   => array(
                Yii::t('hotel', 'Ad') => $this->createUrl('place_an_ad/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('image_manage', compact('ad','id','user'));
	}
	public function actionDelete_image_db($id)
	{
	 
        $ad = new AdImage();
        $manager = new PlaceAnAd();
        $rm = $ad->find(array("condition"=>"t.id=:id","params"=>array(":id"=>$id)));
        if($rm)
        {
			
			    $man = $manager->findByPk((int)$rm->ad_id);
				if (empty($man)) {
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
				else
				{
					$up = $ad->HighestPriorityImage($rm->ad_id);
					if($up)
					{
						 $manager->updateByPk($rm->ad_id,array('image'=>$up->image_name)); 
					}
					else
					{
						$manager->updateByPk($rm->ad_id,array('image'=>"")); 
					}
					$ad->deleteByPk($id);
			    }
		}
          
       
	}
   public function actionApprove($id)
    {
       
        $user = new AdImage();
        $manager = new PlaceAnAd();
        $rm = $user->findByPk((int)$id);
        if (empty($rm)) {
					
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
         
       
			 
			    $man = $manager->findByPk((int)$rm->ad_id);
				if (empty($man)) {
					
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
				else
				{
					 
					$rm->status = ($rm->status==="A") ? "I" : "A" ;
					$rm->save() ;  
					 
					$up = $user->HighestPriorityImage($rm->ad_id);
					if($up)
					{ 
						 $manager->updateByPk($rm->ad_id,array('image'=>$up->image_name)); 
					}
					else
					{
						 
						$manager->updateByPk($rm->ad_id,array('image'=>"")); 
					}
					
			    }
		 
		 
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
            $this->redirect(Yii::app()->createUrl("place_an_ad/image_management",array("id"=>$rm->ad_id)));
        }
    }
   public function actionDisapprove($id)
   {
	  $user =  new AdImage;
	   $request = Yii::app()->request;
        $notify = Yii::app()->notify;
	  if ($request->isPostRequest) {
			   $sortOrderAll = $_POST['id'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('status'=>"I")); 
					}
				}
				 
				 
				 
				$notify->addSuccess(Yii::t('app', 'Ssuccessfully Disapproved'));
    }
    $this->redirect($request->urlReferrer);
 
}
   public function actionApprove_selected($id)
   {
		$user =  new AdImage;
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
	  if ($request->isPostRequest) {
			   $sortOrderAll = $_POST['id'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$user->isNewRecord =true; 
						$user->updateByPk($menuId,array('status'=>"A")); 
					}
				}
				 
				 
				 
				$notify->addSuccess(Yii::t('app', 'Ssuccessfully Approved'));
    }
    $this->redirect($request->urlReferrer);
 
  }
    public function actionApprove_all($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
        $user =  new AdImage;
        $user->updateAll(array('status'=>'A'),array("condition"=>"ad_id=:id","params"=>array(":id"=>$id)));
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $notify->addSuccess(Yii::t('app', 'Ssuccessfully Approved'));
        $this->redirect($request->urlReferrer);
    }
    public function actionDispprove_all($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);
        
        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        
        $user =  new AdImage;
        $user->updateAll(array('status'=>'I'),array("condition"=>"ad_id=:id","params"=>array(":id"=>$id)));
         

        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        $notify->addSuccess(Yii::t('app', 'Ssuccessfully Disapproved'));
         $this->redirect($request->urlReferrer);
    }
    public function actionAd_image()
    {
         $request = Yii::app()->request;
         $notify = Yii::app()->notify;
         $model =  new PlaceAnAd();
         $this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));
         
         $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"), 
            'pageHeading'       => Yii::t(Yii::app()->controller->id, "Image Management"),
            'pageBreadcrumbs'   => array(
                Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
                Yii::t('app', 'View all')
            )
        ));
        $this->render('ad_image', compact('model'));
    }
    public function actionImage_approve_manage()
    {
		$id=$_POST["id"];
		$user = new AdImage();
        $rm = $user->findByPk((int)$id);
        if (empty($rm)) {
 					      throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
         
       
			     $manager = new PlaceAnAd();
			    $man = $manager->findByPk((int)$rm->ad_id);
				if (empty($man)) {
					
					throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
				}
				else
				{
					 
					$rm->status = ($rm->status==="A") ? "I" : "A" ;
					$rm->save() ;  
					 
					$up = $user->HighestPriorityImage($rm->ad_id);
					if($up)
					{ 
						 $manager->updateByPk($rm->ad_id,array('image'=>$up->image_name)); 
					}
					else
					{
						 
						$manager->updateByPk($rm->ad_id,array('image'=>"")); 
					}
					
			    }
		 
		 
	}
		function Get_LatLng_From_Google_Maps($address) {

		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

		// Make the HTTP request
		$data = @file_get_contents($url);
		// Parse the json response
		$jsondata = json_decode($data,true);

		// If the json data is invalid, return empty array
		if (!$this->check_status($jsondata))   return array();

		$LatLng = array(
			'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
			'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
		);

		return $LatLng;
	}

	function check_status($jsondata) {
		if ($jsondata["status"] == "OK") return true;
		return false;
	}
	public function actionCheckModel($id=null)
	{
		$category =  Category::model()->findByPk($id);
		if($category)
		{
			if(in_array('model',CHtml::listData($category->relatedFields,'field_name','field_name')))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 0;
		}
		 exit;
	}
   public function actionCommunity(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria= Community::model()->search(1);
		//$criteria->with = array('district'=>array('with'=>array('city'=>array('with'=>'state'))));
		
		//$criteria->together = true; 
		$region_id = $request->getQuery('state_id');
		$country_id = $request->getQuery('country_id');
		$condition = '';
		if($region_id){
		$criteria->params = array(':state'=>$request->getQuery('state_id')); 
				$condition    .= ' and t.region_id=:state ';
				$criteria->params[':state'] =  $region_id;
		}
		else if(!empty($country_id)){
			$criteria->join  .= ' LEFT JOIN {{countries}} c_st on c_st.country_id = st.country_id  ';
			$condition .= ' and t.country_id=:con or c_st.country_id = :con ';
				$criteria->params[':con'] =  $country_id;
		}
		if($condition){
			if($criteria->condition){
				$criteria->condition .= $condition;
			}
			else{
				$criteria->condition .= '1 and '.$condition;
			
			}
		}
		
		$criteria->compare('community_name',$request->getQuery('q'),true);
		$count = Community::model()->count($criteria);
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		$Result = Community::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->community_id,'text'=>$v->community_name.'('.$v->location.')');
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	}
    public function actionDistrict(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->with = array('city'=>array('with'=>array('state')));
		$criteria->condition = 'state.state_id=:state';
		$criteria->together = true; 
		$criteria->params = array(':state'=>$request->getQuery('state_id')); 
		$criteria->compare('district_name',$request->getQuery('q'),true);
		$count = District::model()->count($criteria);
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		$Result = District::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->district_id,'text'=>$v->district_name);
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	}
	public function actionSelect_ad(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->condition = '1';
		$criteria->select = 't.ad_title,t.id,t.section_id,usr.company_name';
		$query  =  $request->getQuery('q','');
		$criteria->condition .= ' and t.isTrash="0" and t.status="A"  and t.section_id in ("1","2") ';
		if(!empty($query)){
		$criteria->params[':q']  = '%'.$query.'%';
		$criteria->condition .= ' and ( t.ad_title like :q or  t.id like :q or usr.company_name like :q  )  ';
		}
		$criteria->join .= 'LEFT JOIN {{listing_users}} usr ON usr.user_id = t.user_id  ';
		$criteria->compare('t.isTrash','0');
		$criteria->compare('t.status','A');
		$count = PlaceAnAd::model()->count($criteria);
		$criteria->order = 't.ad_title'; 
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		
		$Result = PlaceAnAd::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
			 
				 $name  = $v->ReferenceNumberTitle.' | '. $v->ad_title.' | '.$v->company_name ;
				  
				 $ar[]= array('id'=>$v->id,'text'=> $name);
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	}
   
    public function actionCustomer($user_type=null){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->condition = '1';
		$criteria->select = 't.first_name,t.last_name,t.user_type,case when t.parent_user is null then t.company_name else puser.company_name end as company_name,t.user_id,st.state_name,t.parent_user';
		$criteria->condition .= ' and ((case when t.parent_user is null then t.company_name else puser.company_name end) like :query or t.first_name like :query ) ';
		$criteria->params[':query'] = '%'.$request->getQuery('q').'%';
		//$criteria->compare('t.company_name', $request->getQuery('q') , true);
		//$criteria->compare('t.first_name', $request->getQuery('q') , true,'OR');
		$criteria->join .= 'LEFT JOIN {{states}} st ON st.state_id = t.state_id  ';
		$criteria->join .= 'LEFT JOIN {{listing_users}} puser ON puser.user_id = t.parent_user  ';
		$criteria->compare('t.isTrash','0');
		$criteria->compare('t.status','A');
		$criteria->compare('t.user_type',$user_type);
		$count = ListingUsers::model()->count($criteria);
		$criteria->order = 't.first_name'; 
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
		
		$Result = ListingUsers::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $name = $v->company_name .'('.$v->first_name.' '.$v->last_name.')';
				 $ar[]= array('id'=>$v->user_id,'text'=> $name);
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	}
    public function actionSubCoummunity(){
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->condition =   't.community_id=:community_id';
		$criteria->params = array(':community_id'=>$request->getQuery('id')); 
		$criteria->compare('sub_community_name',$request->getQuery('q'),true);
		$count = SubCommunity::model()->count($criteria);
		$Result = SubCommunity::model()->findAll($criteria);
        $ar = array(); 
        if($Result){
			foreach($Result as $k=>$v){
				 $ar[]= array('id'=>$v->sub_community_id,'text'=>$v->sub_community_name);
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
	}
	public function makeTumbnail($filename, $width = 150, $height = true,$tempPath) {
			$url      = $filename ;
			$new_file_name =  $this->image_name;
			$filename = $tempPath.'/'.$new_file_name ; 			
			return $this->resize_crop_image($width,$height,$url,$filename,80);
			  
		}        
	 function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
			 
		$imgsize = $this->image_size;
		$width = $imgsize[0];
		$height = $imgsize[1];
		$mime = $imgsize['mime'];

		switch($mime){
			case 'image/gif':
				$image_create = "imagecreatefromgif";
				$image = "imagegif";
				break;

			case 'image/png':
				$image_create = "imagecreatefrompng";
				$image = "imagepng";
				$quality = 7;
				break;

			case 'image/jpeg':
				$image_create = "imagecreatefromjpeg";
				$image = "imagejpeg";
				$quality = 100;
				break;

			default:
				return false;
				break;
		}
		 
		$dst_img = imagecreatetruecolor($max_width, $max_height);
		if($mime=='image/png'){
			imageAlphaBlending($dst_img, false);
			imageSaveAlpha($dst_img, true);
			imagefilledrectangle($dst_img, 0, 0, $max_width, $max_height, imagecolorallocate($dst_img, 255, 255, 255));
		}
		$src_img = $image_create($source_file);
		 
		$width_new = $height * $max_width / $max_height;
		$height_new = $width * $max_height / $max_width;
		//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
		if($width_new > $width){
			//cut point by height
			$h_point = (($height - $height_new) / 2);
			//copy image
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
		}else{
			//cut point by width
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
		}
		 
		$image($dst_img, $dst_dir, $quality);

		if($dst_img){ imagedestroy($dst_img); return true ; }
		if($src_img) { imagedestroy($src_img); return true ; }
		}
 public function actionView($id)
    {
        $model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        $this->renderPartial('_view', compact('user','model','personal'));
    }
     public function actionStatus_change($id=null,$val=null)
    {
		if(!Yii::app()->request->isAjaxRequest){
			return false;
		}
        $user = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        if($val=='C'){
			$user->checkandapproveproperty();
		}
        $user::model()->updateByPk($id,array('status'=>$val));
        echo 1; 
    }
     public function actionStatus_change2($id=null,$val=null)
    {
		if(!Yii::app()->request->isAjaxRequest){
			return false;
		}
        $user = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($user)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        } 
        $user->updateByPk($id,array('status'=>$val));$user->status = $val;
        echo json_encode(array('status'=>1,'html'=>$user->statusLink)); 
    }
    public function actionUpload_floor_plan($width=null,$height=null)
    {
	 
	  
	    $path =  Yii::getPathOfAlias('root.uploads.floor_plan');    
		//Yii::import('backend.extensions.ResizeImage');
		if($_FILES['file']['tmp_name'])
				{
					ini_set('memory_limit', '-1');
					$file = $_FILES['file']['name'];
					$file_orginal = $_FILES['file']['tmp_name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$File = pathinfo($file, PATHINFO_FILENAME);
					$new_name =  substr(preg_replace("/[^a-zA-Z0-9._-]/", '_', "{$File}"),0,220);
					$new_name = empty($new_name) ? 'Untitled' : $new_name;
					$img = $new_name.'_'.time().".".$ext;
					move_uploaded_file($_FILES['file']['tmp_name'], $path."/{$img}");
					echo $img;
			    }
			    else
			    {
					echo "0";
				}
	}
   function actionDelete_floor_plan()
	{
		 
	
		$str="";
		if(isset($_POST['inp']))
		{
		 
			 
			$ar = explode(',',$_POST['inp']);
			 
			 
			if($ar)
			{
				foreach($ar as $k=>$val)
				{
					 
					if($val!=$_POST['file'] and $val!="")
					{
						 
						$str .= ",".$val;
						 
					}
				}
			}
			 
		}
		echo $str; 
		 
    
   }
    public function actionUpdatemetatag()
    {
		$request = Yii::app()->request;
		$model = PlaceAnAd::model()->findByPk((int)$_POST['PlaceAnAd']['id']);
		if($model)
		{
		    $model->updateByPk((int)@$_POST['PlaceAnAd']['id'], array('meta_title'=>@$_POST['PlaceAnAd']['meta_title'],'meta_title_ar'=>@$_POST['PlaceAnAd']['meta_title_ar'],'meta_description'=>@$_POST['PlaceAnAd']['meta_description'],'meta_description_ar'=>@$_POST['PlaceAnAd']['meta_description_ar']));
		    echo (int)$_POST['PlaceAnAd']['id']; 
		}
		else
		{
			echo 0;
		}
	}
	  public function actionSavetaglist()
    {
		if(!isset($_POST['PlaceAnAd'])){
			$ad_id = (int)$_POST['NewDevelopment']['id2'];
			$items = (array)@$_POST['NewDevelopment']['tags_list'];
		}else{
			$ad_id = (int)$_POST['PlaceAnAd']['id2'];
			$items = (array)@$_POST['PlaceAnAd']['tags_list'];
		}
		$request = Yii::app()->request;
		//PlaceAdTags::model()->deleteAllByAttributes(array('ad_id'=>$ad_id));;
		 
		
		$tag_list = PlaceAnAd::model()->place_ad_tag();
		$items_update = array();
		foreach($tag_list  as $ky => $value){
			if(in_array($ky,$items)) {  $items_update[$ky] = '1' ; }else{ $items_update[$ky] = null; }
		}
		PlaceAnAd::model()->updateByPk($ad_id,$items_update);
		echo 1 ; 
	}
       public function actionGet_tag_list($id=null,$sect_id=null,$category_id=null,$listing_type=null)
    {
		/*
         $section_id = $sect_id;
		$section_active =  array();
		if(!empty($section_id)){
			$inactive_category_active = CHtml::listData(TagCategory::model()->findAllByAttributes(array('category_id'=>$category_id)),'tag_id','tag_id');
			$section_active2 = CHtml::listData(TagType::model()->findAllByAttributes(array('type_id'=>$listing_type)),'tag_id','tag_id');
			$section_active = CHtml::listData(TagSection::model()->findAllByAttributes(array('section_id'=>$section_id)),'tag_id','tag_id');
			$section_active_a = CHtml::listData(Tag::model()->findAllByAttributes(array('enable_all'=>'1')),'tag_id','tag_id');
			$section_active = array_replace($section_active,$section_active_a,$section_active2);
			if(!empty($inactive_category_active)){
				foreach($inactive_category_active as $tg){
					if(isset($section_active[$tg])){
						unset($section_active[$tg]);
					}
				}
			}
		}
		*/
		$ad = PlaceAnAd::model()->findByPk($id);
		if($ad){
			$tag_list = PlaceAnAd::model()->place_ad_tag();
			$active_items =array();
			foreach($tag_list as $y=>$val){
				if(!empty($ad->$y)){ $active_items[$y] = $y;   }
			}
	   }
		
		echo json_encode(array('items'=>$active_items));;
		Yii::app()->end();
	}
	  public function actionGet_tag_list2($id=null,$listing_type=null)
    {
		$section_active =  array();
		if(!empty($listing_type)){
		 
			$section_active = CHtml::listData(TagTypeCustomer::model()->findAllByAttributes(array('type_id'=>$listing_type)),'tag_id','tag_id');
			 
		}
		echo json_encode(array('items'=>CHtml::listData(ListingUsersTag::model()->findAllByAttributes(array('user_id'=>$id)),'tag_id','tag_id'),'enabled'=>$section_active));;
		Yii::app()->end();
	}
	 public function actionSavetaglist2($model=null)
    {
		
		$ad_id = (int)$_POST[$model]['id2'];
		$request = Yii::app()->request;
		ListingUsersTag::model()->deleteAllByAttributes(array('user_id'=>$ad_id));;
		$items = @$_POST[$model]['tags_list'];
		
	
		
		if($items){
		foreach($items as $tags){
			$model = new ListingUsersTag();
			$model->user_id = $ad_id ;
			$model->tag_id = $tags ;
			$model->save();
		}
		}
		echo 1 ; 
	}
		 public function actionCity_details($id=null)
    {
        $location = ''; 
		$criteria=new CDbCriteria;
		 $criteria->select="city_name,st.state_name";
		  $criteria->join ='INNER JOIN {{states}} st on st.state_id = t.state_id';
		 $criteria->condition="t.city_id=:city_id";
		 $criteria->params[':city_id'] =  (int) $id;
		 $states = City::model()->find($criteria);
		 
		 
		 if(!empty($states)){
			 echo json_encode(array('status'=>1,'city'=>rtrim($states->city_name) , 'city_name'=>rtrim($states->city_name).' , '.rtrim($states->state_name))) ; 
		 }
		else{
				  echo json_encode(array('status'=>1,'city_name'=>'')) ; 
		}
		exit;
	}
	   
    public function actionUpload_file($width=null,$height=null)
    {
	 
	 
	   
	   $path =  Yii::getPathOfAlias('root.uploads.images');    
		//Yii::import('backend.extensions.ResizeImage');
		if($_FILES['file']['tmp_name'])
				{
					ini_set('memory_limit', '-1');
					$file = $_FILES['file']['name'];
					$file_orginal = $_FILES['file']['tmp_name'];
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					$File = pathinfo($file, PATHINFO_FILENAME);
					$new_name =  substr(preg_replace("/[^a-zA-Z0-9._-]/", '_', "{$File}"),0,220);
					$new_name = empty($new_name) ? 'Untitled' : $new_name;
					$img = date('my').'_'.time().$new_name.'_'.".".$ext;
				 
					move_uploaded_file($_FILES['file']['tmp_name'], $path."/{$img}");
					echo $img;
			    }
			    else
			    {
					echo "0";
				}
			 
	}
  public function actionHidden_ammenities($id=null)
    {
        $location = ''; 
		$criteria=new CDbCriteria;
		 $criteria->select="amenities_id";
		 $criteria->condition="t.category_id=:category_id";
		 $criteria->params[':category_id'] =  (int) $id;
		 $states = AmenitiesCategoryList::model()->findAll($criteria);
		 
		 
		 if(!empty($states)){
			 $amenities_list = CHtml::listData($states,'amenities_id','amenities_id');
			 echo json_encode(array('status'=>1,'amenities_list'=> $amenities_list)) ; 
		 }
		else{
				  echo json_encode(array('status'=>0)) ; 
		}
		exit;
	}
}
