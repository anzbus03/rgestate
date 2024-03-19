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
	    $this->member =  ListingUsers::model()->findByPk((int)Yii::app()->user->getId());
	    if(empty($this->member)){
			$this->redirect(Yii::app()->createUrl('user/signin'));
		}
	 
		$apps = $this->app->apps;
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/boot_css.css'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/materoial.css'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/new_icons.css'), 'priority' => -100));
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/boot.min.js'), 'priority' => -100));
		$this->getData('pageStyles')->add(array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'priority' => -100));
		 
		 
		 if(!Yii::app()->request->isAjaxRequest){	 
    	if($this->member->filled_info == '0' and  $this->member->FillPersonalInformation   ){ 
			 $this->redirect($this->app->createUrl('member/profile_settings',array('slug'=>$this->member->slug )));
			}
		 if( !in_array($this->member->status,array('W','A'))){
		      $this->redirect($this->app->createUrl('member/profile_settings',array('slug'=>$this->member->slug )));
		 }
		if( !empty( $this->member->filled_info) and $this->member->status == 'W'){
		         $this->redirect(Yii::app()->createUrl('member/dashboard'));
				 $this->setData(array(
				'pageMetaTitle'     =>  Yii::t('app', 'Waiting for Approval :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.free_bites.site_name') )), 
				'pageTitle'     =>  Yii::t('app', 'Waiting for Approval :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.free_bites.site_name') )), 
				'pageHeading'       => Yii::t('hotel_booking', 'My Profile'),
				'pageMetaDescription'   => Yii::app()->params['description'],
			));
				
			$this->render("//member/wait_approval",compact("user","pricePlan"));exit;
		}
		 
		     
		 }
	
		$this->setData(array(
		'hooks'     =>   	  Yii::app()->hooks  , 
		));
    
    
        $this->layout = 'member_area2';
       
        
    }
  public function actionIndex($status=null,$s=null)
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
         $model->user_id  =  Yii::app()->user->getId();
         $title = ' Property  List';
         if(!empty($status) and in_array($status,array_keys($model->StatusArray()))){
			 $model->status = $status;
			$title =  '<span style="color:#989898">'. $model->StatusTitle.'</span> '.$title; 
		 }
         $this->setData(array(
            'pageMetaTitle'     =>  Yii::t('app', 'My Uploads  :: {name} ', array('{name}' => $this->member->fullName .'@'.Yii::app()->options->get('system.free_bites.site_name') )), 
            'pageBreadcrumbs'   => array(
                Yii::t('local_hire', 'Free Bites') => $this->createUrl('free_bites/index'),
                Yii::t('app', 'create')
            )
        ));
        
        $this->render('list', compact('model','title','s'));
    }
     public function  beforeAction($action)
    {   
		 
				if(in_array($action->id,array('create','success','update','success_edit'))){
				$apps = $this->app->apps;
	 
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
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $model = new PlaceAnAd();
        $country = Countries::model()->ListDataForJSON();
        $section = Section::model()->ListDataForJSON_ID();
        $list_type = Category::model()->ListDataTypeForJSON_ID();
         
        $image_array=array();
	    $this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ' ,'{p}'=> $this->options->get('system.common.site_name'))),   
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
		$apps = $this->app->apps;
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
		$apps = $this->app->apps; 
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
		 
        $model = PlaceAnAd::model()->findByAttributes(array('id'=>$id,'user_id'=>Yii::app()->user->getId()));

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
				//$model->dynamicArray ="";
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
	public $image_size;
	public $image_name;
     public function actionUpload($width=null,$height=null)
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
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ' ,'{p}'=> $this->options->get('system.common.site_name'))),   
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
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ' ,'{p}'=> $this->options->get('system.common.site_name'))),   
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "Update Listing"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id.'/index'),
				Yii::t('app', 'Create new'),
			)
        ));
        $this->render('success-edit', compact('model'));
   } 
   
   public function actionView($id)
    {
		$model = PlaceAnAd::model()->findByPk((int)$id);

        if (empty($model)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
     //   $request = Yii::app()->request;
        
        
        // for filters.
        //$user->attributes = (array)$request->getQuery($user->modelName, array());
      
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('hotel_booking', 'Place An Ad'), 
            'pageHeading'       => Yii::t('hotel_booking', 'Place An Ad'),
            'pageBreadcrumbs'   => array(
                Yii::t('hotel', 'Hotel') => $this->createUrl('place_an_ad/index'),
                Yii::t('app', 'Booking Details')
            )
        ));
      
        $this->render('view', compact('model'));
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
    public function actionCustomer(){
		$limit = 30;
		$request=Yii::app()->request;
		$criteria=new CDbCriteria;
		$criteria->compare(new CDbExpression('CONCAT(first_name, " ", last_name)'), $request->getQuery('q') , true);
		$criteria->compare('t.isTrash','0');
		$criteria->compare('t.status','A');
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
				 $ar[]= array('id'=>$v->user_id,'text'=>$v->fullNAme);
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
}
