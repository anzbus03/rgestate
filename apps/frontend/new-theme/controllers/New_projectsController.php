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


class New_projectsController   extends Controller
{

	/**
	 * Define the filters for various controller actions
	 * Merge the filters with the ones from parent implementation
	 */
	public $Controlloler_title = "New Projects";
	public $focus = "country";
	public $member;
	public function init()
	{

		parent::Init();
	}
	public function  beforeAction($action)
	{

		if (in_array($action->id, array('create', 'success', 'update', 'success_edit'))) {
			$apps = Yii::app()->apps;


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
		$model = new NewDevelopment();
	
		$model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
		$model->scenario = 'new_insert';
		$image_array = array();
		$country = Countries::model()->ListDataForJSON();

		$section = Section::model()->ListDataForJSON_New();
		$list_type = Category::model()->listingTypeArrayMainData();

		$image_array = array();
		$this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'Create New Projects', '{p}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create  New Projects"),
			'hooks'       => Yii::app()->hooks,

		));

		//  print_r($_POST);exit;
		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;
			if (isset(Yii::app()->params['POST'][$model->modelName]['ad_description'])) {
				$model->ad_description = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$model->modelName]['ad_description']);
			}
			if (!$model->save()) {

				$model->amenities = Yii::app()->request->getPost("amenities");
				$exp =  explode(",", $model->image);
				if ($exp) {
					foreach ($exp as $k => $v) {
						if ($v != "") {
							$image_array[] = $v;
						}
					}
				}
				$notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
			} else {
			    
			    // Start CRM Code
			    
		    	$requestParms = $request->getPost("NewDevelopment");
		  //  	echo "<pre>";
		  //  	print_r($requestParms);
		  //  	exit;
                $createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';
    		    
                // Prepare data for the request
                $fullName = $requestParms['contact_person'];
                
                // Split the full name into an array using spaces as the delimiter
                $nameParts = explode(' ', $fullName);
                
                // Extract the first and last names
                $firstName = isset($nameParts[0]) ? $nameParts[0] : null;
                $lastName = isset($nameParts[1]) ? $nameParts[1] : null;
        
                $crmCustomerData = [
                    'fields' => [
                        'NAME' => $firstName,
                        'SECOND_NAME' => $lastName,
                        "TYPE_ID" => "CLIENT",
                        "SOURCE_ID" => "SELF",
                        "PHONE" => [[ "VALUE" => $requestParms['mobile_number'], "VALUE_TYPE" => "WORK" ]]
                    ],
                ];
                $postCustomerData = http_build_query($crmCustomerData);
                $contextCusotomerOptions = [
                    'http' => [
                        'method' => 'POST',
                        'header' => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postCustomerData,
                    ],
                ];
                $contextCreateCustomer = stream_context_create($contextCusotomerOptions);
            	try {
                    // Send the HTTP request using file_get_contents
                    $data = file_get_contents($createCustomerUrl, false, $contextCreateCustomer);
                    $response = json_decode($data, true);
                    $customerId = $response['result'];
                    // Handle the CRM response as needed
        
                } catch (Exception $e) {
                    // Handle exceptions, e.g., connection errors
        			echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
                }
                // Send the form crm function 
                $crmUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.lead.add.json';

                $subCategories = Category::model()->ListDataForJSON_ID_ByListingType($requestParms['listing_type']);
                $crmData = [
                    'FIELDS' => [
                        'TITLE' => 'RGestate Lead - Submit New Project',
                        'CATEGORY_ID' => 10,
                        'CONTACT_ID' => $customerId,
                        'ASSIGNED_BY_ID' => 22,
                        'COMMENTS' => 
                            'Title: '.$requestParms['ad_title'].
                            'Description: '.$requestParms['ad_description'].
                            '<br/> Area: '.$requestParms['area_location'].
                            '<br/> Country: '.Countries::model()->find($requestParms['country'])->country_name.
                            '<br/> Location: '.States::model()->find($requestParms['state'])->state_name.
                            '<br/> Price: '.$requestParms['price_false']
                            ,
                        'UF_CRM_65571AE7B82CF' => 138,
                    ],
                ];
        
                // Convert data to a query string
                $postData = http_build_query($crmData);
        
                // Set up options for the stream context
                $contextOptions = [
                    'http' => [
                        'method' => 'POST',
                        'header' => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postData,
                    ],
                ];
        
                $context = stream_context_create($contextOptions);
        
        
        		try {
                    // Send the HTTP request using file_get_contents
                    $response = file_get_contents($crmUrl, false, $context);
        
                    // Handle the CRM response as needed
        
                } catch (Exception $e) {
                    // Handle exceptions, e.g., connection errors
        				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($e->getMessage()).'. </div>'));
                }
			    
			    // End CRM Code
			    
				$this->insertAfterSaveFn($model);
				$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
				$this->redirect(Yii::App()->createUrl($this->id . '/Success_posted'));
			}
		}
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css')));


		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=5')));

		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));


		$banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->default_country_id, 'NP');
		$img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		$img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		if (!empty($banners)) {
			$img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['image']) : $img;
			$img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['mobile']) : $img_mobile;
		}
		$this->setData(array(
			'pageTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' =>  'Submit New Project', '{p}' => @$this->project_name)),
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),

		));
		$this->render('root.apps.backend.views.new_projects.form', compact('model', "country", "section", 'list_type', 'image_array', 'img', 'img_mobile'));
	}
	public function actionSuccess_posted()
	{
		$lastDevelopment = NewDevelopment::model()->find(array(
			'order' => 'id DESC', // Replace 'id' with your primary key or timestamp column if different
		));
		$name = $lastDevelopment ? $lastDevelopment->contact_person : null;
		$email = $lastDevelopment ? $lastDevelopment->salesman_email : null;	

		$this->setData(array(
			'hooks'     =>  Yii::app()->hooks,
			'pageTitle'     => Yii::t('app', '{name} :: {p}', 
				array(
					'{name}' 	=> 'Successfully submitted yor property ', 
					'{p}' 		=> Yii::app()->options->get('system.common.site_name'),
					'{user}' 	=> $name,
					'{email}' 	=> $email,
				)
			),
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
				Yii::t('app', 'Create new'),
			),
			'name' => $name,
			'email' => $email
		));
		//   $this->no_header = '1'; $this->secure_header='1';
		$this->render('//place_an_ad/success', compact('model'));
	}

	public function insertAfterSaveFn($model)
	{
		$room_image = new AdImage;
		$room_image->deleteAll(array("condition" => "ad_id=:ad_id", "params" => array(":ad_id" => $model->id)));
		$imgArr =  explode(',', $model->image);

		if ($imgArr) {


			$img_saved = false;
			foreach ($imgArr as $k) {

				if (!$img_saved and $model->image != "") {

					$model->updateByPk($model->id, array('image' => $k));
				}
				$room_image->isNewRecord = true;
				$room_image->id = "";
				$room_image->ad_id = $model->id;
				$room_image->image_name =  $k;
				$room_image->save();
			}
		}
		$am = new  AdAmenities();
		$am->deleteAll(array("condition" => "ad_id=:ad_id", "params" => array(":ad_id" => $model->id)));
		if ($ameni = Yii::app()->request->getPost("amenities")) {

			foreach ($ameni as $k) {

				$am->isNewRecord = true;
				$am->ad_id = $model->id;
				$am->amenities_id =  $k;
				$am->save();
			}
		}
	}

	public function actionDetails($model, $subcategory, $category, $fields, $image_array)
	{
		$apps = Yii::app()->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->render('details', compact('model', 'subcategory', 'category', "fields", "image_array", 'hooks'));
	}
	public function actionDetails_2($model, $subcategory, $category, $fields, $image_array, $jsonData)
	{

		$this->getData('pageScripts')->add(array('src' => AssetsUrl::js('myAjax.js')));
		$this->render('location_view', compact('model', 'subcategory', 'category', "fields", "image_array", "jsonData"));
		exit;
	}
	public function actionDetails_edit($model, $subcategory, $category, $fields, $image_array)
	{
		$apps = Yii::app()->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->render('details_edit', compact('model', 'subcategory', "category", "fields", "image_array"));
	}
	public function actionFindOnMap()
	{
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$model = new NewDevelopment();
		//  $subcategory= SubCategory::model()->FindSubategory("12");

		$this->setData(array(
			'pageMetaTitle'     =>  Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
				Yii::t('app', 'Create new'),
			)
		));
		$this->render('details', compact('model'));
	}


	/**
	 * Update existing user
	 */
	/*
    public function actionUpdate($id)
    {
		 
        $model = NewDevelopment::model()->findByPk((int)$id);

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
    * */

	/**
	 * Delete existing user
	 */
	public function actionDelete($id)
	{
		$model = NewDevelopment::model()->findByPk((int)$id);

		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}


		$model->updateByPk($id, array('isTrash' => Yii::app()->params['onTrash']));


		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		if (!$request->getQuery('ajax')) {
			$notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
			$this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
		}
	}
	public function actionFeatured($id, $featured)
	{
		$model = NewDevelopment::model()->findByPk((int)$id);

		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$featured = ($featured == "N") ? "Y" : "N";
		$model->updateByPk($id, array('featured' => $featured));


		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		if (!$request->getQuery('ajax')) {
			$notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
			$this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
		}
	}
	public function actionStatus($id, $status)
	{


		$model = NewDevelopment::model()->findByPk((int)$id);
		$status = (string)$status;
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$status =  'I';



		$model->updateByPk($id, array('status' => $status));


		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		if (!$request->getQuery('ajax')) {
			$notify->addSuccess(Yii::t('app', 'Successfully changed status'));
			$this->redirect($request->getPost('returnUrl', array(Yii::app()->controller->id . '/index')));
		}
	}
	public function actionSelect_state()
	{
		echo   States::model()->ListDataForJSON(Yii::app()->request->getPost("country"));
		exit;
	}
	public function actionSelect_city()
	{
		echo   City::model()->ListDataForJSON(Yii::app()->request->getPost("state"));
		exit;
	}
	public function actionSelect_category()
	{
		echo   Category::model()->ListDataForJSON_ID_BySEction(Yii::app()->request->getPost("section"));
		exit;
	}
	public function actionSelect_sub_category()
	{
		echo   Subcategory::model()->ListDataForJSON_ID(Yii::app()->request->getPost("category"));
		exit;
	}
	public function actionSelect_model($id)
	{
		$subcategory =  Subcategory::model()->findByPk($id);

		$fields = array();
		$fields =  ($subcategory->change_parent_fields == "N") ? CHtml::listData($subcategory->category->relatedFields, 'field_name', 'field_name') : CHtml::listData($subcategory->relatedFields, 'field_name', 'field_name');

		if (in_array('model', $fields)) {
			echo   VehicleModel::model()->ListDataForJSON_ID_ByModel($id);
			exit;
		} else {
			echo 0;
		}
	}
	public $image_size;
	public $image_name;
	public function actionUpload($width = null, $height = null)
	{


		ini_set('memory_limit', '-1');
		if (defined('ENABLED_AWS_SERVER') && ENABLED_AWS_SERVER == '1') {
			$file = $_FILES['file']['name'];
			$file_orginal = $_FILES['file']['tmp_name'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$File = pathinfo($file, PATHINFO_FILENAME);
			//$img = $File.'_'.uniqid(rand(0, time())).".".$ext;

			$img = rand(0, 9999) . '_' . time() . "." . $ext;

			$awsAccessKey = ENABLED_AWS_ACCESS;
			$awsSecretKey = ENABLED_AWS_SECRET;

			$bucketName = ENABLED_BUCKET_NAME;

			Yii::import('common.extensions.amazon.S3');
			$s3 = new S3($awsAccessKey, $awsSecretKey);
			$uploadName = $_FILES['file']['name'];
			$ar = $s3->putObject(S3::inputFile($file_orginal, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
			echo $img;
		} else {
			$path =  Yii::getPathOfAlias('root.uploads.images');
			//Yii::import('backend.extensions.ResizeImage');
			if ($_FILES['file']['tmp_name']) {
				ini_set('memory_limit', '-1');
				$file = $_FILES['file']['name'];
				$file_orginal = $_FILES['file']['tmp_name'];
				$ext = pathinfo($file, PATHINFO_EXTENSION);
				$File = pathinfo($file, PATHINFO_FILENAME);
				$new_name =  substr(preg_replace("/[^a-zA-Z0-9._-]/", '_', "{$File}"), 0, 220);
				$new_name = empty($new_name) ? 'Untitled' : $new_name;
				$img = date('my') . '_' . time() . $new_name . '_' . "." . $ext;
				if (!empty($width)) {

					$detSize = getimagesize($_FILES['file']['tmp_name']);
					if ($detSize) {
						if (empty($height)) {
							$aspectRatio = $detSize[1] / $detSize[0];
							$newHeight = (int)($aspectRatio * $width);
						} else {
							$newHeight = $height;
						}
						$this->image_size = $detSize;
						$this->image_name = $img;

						$tempPath = Yii::getPathOfAlias('root.uploads.resized');
						$resized = $this->makeTumbnail($_FILES['file']['tmp_name'], $width, $newHeight, $tempPath);
					}
				}
				move_uploaded_file($_FILES['file']['tmp_name'], $path . "/{$img}");
				echo $img;
			} else {
				echo "0";
			}
		}
	}
	function actionDelete_image()
	{


		$str = "";
		if (isset($_POST['inp'])) {


			$ar = explode(',', $_POST['inp']);


			if ($ar) {
				foreach ($ar as $k => $val) {

					if ($val != $_POST['file'] and $val != "") {

						$str .= "," . $val;
					}
				}
			}
		}
		echo $str;
	}
	public function actionSuccess($id)
	{
		$model = NewDevelopment::model()->findByPk($id);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ', '{p}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
				Yii::t('app', 'Create new'),
			)
		));
		$this->render('success', compact('model'));
	}
	public function actionSuccess_edit($id)
	{
		$model = NewDevelopment::model()->findByPk($id);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$this->setData(array(
			'pageMetaTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'List your property ', '{p}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "Update Listing"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
				Yii::t('app', 'Create new'),
			)
		));
		$this->render('success-edit', compact('model'));
	}


	public function actionLoadCities()
	{
		$id = null;
		if (isset($_POST['state'])) {
			$id = $_POST['state'];
		}
		$data = City::model()->FindCities($id);
		$data = CHtml::listData($data, 'city_id', 'city_name');
		echo "<option value=''>All Cities</option>";
		foreach ($data as $k => $v)
			echo CHtml::tag('option', array('value' => $k), CHtml::encode($v), true);
	}
	public function actionImage_management($id)
	{

		$ad = NewDevelopment::model()->findByPk((int)$id);
		if (empty($ad)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$user =  new AdImage;

		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		if ($request->isPostRequest) {
			$sortOrderAll = $_POST['priority'];
			if (count($sortOrderAll) > 0) {
				foreach ($sortOrderAll as $menuId => $sortOrder) {
					$user->isNewRecord = true;
					$user->updateByPk($menuId, array('priority' => $sortOrder));
				}
			}
			$up = $user->HighestPriorityImage($id);
			if ($up) {
				$ad->updateByPk($id, array('image' => $up->image_name));
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
			'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t('room_manage', 'Image Management'),
			'pageHeading'       => Yii::t('room_manage', 'Image Management'),
			'pageBreadcrumbs'   => array(
				Yii::t('hotel', 'Ad') => $this->createUrl('place_an_ad/index'),
				Yii::t('app', 'Update'),
			)
		));

		$this->render('image_manage', compact('ad', 'id', 'user'));
	}
	public function actionDelete_image_db($id)
	{

		$ad = new AdImage();
		$manager = new NewDevelopment();
		$rm = $ad->find(array("condition" => "t.id=:id", "params" => array(":id" => $id)));
		if ($rm) {

			$man = $manager->findByPk((int)$rm->ad_id);
			if (empty($man)) {
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
			} else {
				$up = $ad->HighestPriorityImage($rm->ad_id);
				if ($up) {
					$manager->updateByPk($rm->ad_id, array('image' => $up->image_name));
				} else {
					$manager->updateByPk($rm->ad_id, array('image' => ""));
				}
				$ad->deleteByPk($id);
			}
		}
	}
	public function actionApprove($id)
	{

		$user = new AdImage();
		$manager = new NewDevelopment();
		$rm = $user->findByPk((int)$id);
		if (empty($rm)) {

			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}



		$man = $manager->findByPk((int)$rm->ad_id);
		if (empty($man)) {

			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		} else {

			$rm->status = ($rm->status === "A") ? "I" : "A";
			$rm->save();

			$up = $user->HighestPriorityImage($rm->ad_id);
			if ($up) {
				$manager->updateByPk($rm->ad_id, array('image' => $up->image_name));
			} else {

				$manager->updateByPk($rm->ad_id, array('image' => ""));
			}
		}




		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		if (!$request->getQuery('ajax')) {
			$notify->addSuccess(Yii::t('app', 'The item has been successfully updated!'));
			$this->redirect(Yii::app()->createUrl("place_an_ad/image_management", array("id" => $rm->ad_id)));
		}
	}
	public function actionDisapprove($id)
	{
		$user =  new AdImage;
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		if ($request->isPostRequest) {
			$sortOrderAll = $_POST['id'];
			if (count($sortOrderAll) > 0) {
				foreach ($sortOrderAll as $menuId => $sortOrder) {
					$user->isNewRecord = true;
					$user->updateByPk($menuId, array('status' => "I"));
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
			if (count($sortOrderAll) > 0) {
				foreach ($sortOrderAll as $menuId => $sortOrder) {
					$user->isNewRecord = true;
					$user->updateByPk($menuId, array('status' => "A"));
				}
			}



			$notify->addSuccess(Yii::t('app', 'Ssuccessfully Approved'));
		}
		$this->redirect($request->urlReferrer);
	}
	public function actionApprove_all($id)
	{
		$model = NewDevelopment::model()->findByPk((int)$id);

		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}


		$user =  new AdImage;
		$user->updateAll(array('status' => 'A'), array("condition" => "ad_id=:id", "params" => array(":id" => $id)));
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$notify->addSuccess(Yii::t('app', 'Ssuccessfully Approved'));
		$this->redirect($request->urlReferrer);
	}
	public function actionDispprove_all($id)
	{
		$model = NewDevelopment::model()->findByPk((int)$id);

		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}


		$user =  new AdImage;
		$user->updateAll(array('status' => 'I'), array("condition" => "ad_id=:id", "params" => array(":id" => $id)));


		$request = Yii::app()->request;
		$notify = Yii::app()->notify;

		$notify->addSuccess(Yii::t('app', 'Ssuccessfully Disapproved'));
		$this->redirect($request->urlReferrer);
	}
	public function actionAd_image()
	{
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$model =  new NewDevelopment();
		$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('dropzone.css')));

		$this->setData(array(
			'pageMetaTitle'     => $this->data->pageMetaTitle . ' | ' . Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title} List"),
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "Image Management"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
				Yii::t('app', 'View all')
			)
		));
		$this->render('ad_image', compact('model'));
	}
	public function actionImage_approve_manage()
	{
		$id = $_POST["id"];
		$user = new AdImage();
		$rm = $user->findByPk((int)$id);
		if (empty($rm)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}


		$manager = new NewDevelopment();
		$man = $manager->findByPk((int)$rm->ad_id);
		if (empty($man)) {

			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		} else {

			$rm->status = ($rm->status === "A") ? "I" : "A";
			$rm->save();

			$up = $user->HighestPriorityImage($rm->ad_id);
			if ($up) {
				$manager->updateByPk($rm->ad_id, array('image' => $up->image_name));
			} else {

				$manager->updateByPk($rm->ad_id, array('image' => ""));
			}
		}
	}
	function Get_LatLng_From_Google_Maps($address)
	{

		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

		// Make the HTTP request
		$data = @file_get_contents($url);
		// Parse the json response
		$jsondata = json_decode($data, true);

		// If the json data is invalid, return empty array
		if (!$this->check_status($jsondata))   return array();

		$LatLng = array(
			'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
			'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
		);

		return $LatLng;
	}

	function check_status($jsondata)
	{
		if ($jsondata["status"] == "OK") return true;
		return false;
	}
	public function actionCheckModel($id = null)
	{
		$category =  Category::model()->findByPk($id);
		if ($category) {
			if (in_array('model', CHtml::listData($category->relatedFields, 'field_name', 'field_name'))) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
		exit;
	}
	public function actionCommunity()
	{
		$limit = 30;
		$request = Yii::app()->request;
		$criteria = Community::model()->search(1);
		//$criteria->with = array('district'=>array('with'=>array('city'=>array('with'=>'state'))));

		//$criteria->together = true; 
		$region_id = $request->getQuery('state_id');
		$country_id = $request->getQuery('country_id');
		$condition = '';
		if ($region_id) {
			$criteria->params = array(':state' => $request->getQuery('state_id'));
			$condition    .= ' and t.region_id=:state ';
			$criteria->params[':state'] =  $region_id;
		} else if (!empty($country_id)) {
			$criteria->join  .= ' LEFT JOIN {{countries}} c_st on c_st.country_id = st.country_id  ';
			$condition .= ' and t.country_id=:con or c_st.country_id = :con ';
			$criteria->params[':con'] =  $country_id;
		}
		if ($condition) {
			if ($criteria->condition) {
				$criteria->condition .= $condition;
			} else {
				$criteria->condition .= '1 and ' . $condition;
			}
		}

		$criteria->compare('community_name', $request->getQuery('q'), true);
		$count = Community::model()->count($criteria);
		$criteria->limit   =  $limit;
		$page = Yii::app()->request->getQuery('page', 1);
		$offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset;
		$Result = Community::model()->findAll($criteria);
		$ar = array();
		if ($Result) {
			foreach ($Result as $k => $v) {
				$ar[] = array('id' => $v->community_id, 'text' => $v->community_name . '(' . $v->location . ')');
			}
		}
		$record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
		echo  json_encode($record);
		Yii::app()->end();
	}
	public function actionDistrict()
	{
		$limit = 30;
		$request = Yii::app()->request;
		$criteria = new CDbCriteria;
		$criteria->with = array('city' => array('with' => array('state')));
		$criteria->condition = 'state.state_id=:state';
		$criteria->together = true;
		$criteria->params = array(':state' => $request->getQuery('state_id'));
		$criteria->compare('district_name', $request->getQuery('q'), true);
		$count = District::model()->count($criteria);
		$criteria->limit   =  $limit;
		$page = Yii::app()->request->getQuery('page', 1);
		$offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset;
		$Result = District::model()->findAll($criteria);
		$ar = array();
		if ($Result) {
			foreach ($Result as $k => $v) {
				$ar[] = array('id' => $v->district_id, 'text' => $v->district_name);
			}
		}
		$record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
		echo  json_encode($record);
		Yii::app()->end();
	}
	public function actionCustomer()
	{
		$limit = 30;
		$request = Yii::app()->request;
		$criteria = new CDbCriteria;
		$criteria->select = 't.first_name,t.last_name,t.user_type,t.user_id,cn.country_name';
		$criteria->compare(new CDbExpression('CONCAT(first_name, " ", last_name)'), $request->getQuery('q'), true);
		$criteria->join .= 'LEFT JOIN {{countries}} cn ON cn.country_id = t.country_id  ';
		$criteria->compare('t.isTrash', '0');
		$criteria->compare('t.status', 'A');
		$count = ListingUsers::model()->count($criteria);
		$criteria->order = 't.first_name';
		$criteria->limit   =  $limit;
		$page = Yii::app()->request->getQuery('page', 1);
		$offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset;

		$Result = ListingUsers::model()->findAll($criteria);
		$ar = array();
		if ($Result) {
			foreach ($Result as $k => $v) {
				$ar[] = array('id' => $v->user_id, 'text' => $v->fullName . '(' . $v->user_type . '::' . $v->country_name . ')');
			}
		}
		$record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
		echo  json_encode($record);
		Yii::app()->end();
	}
	public function actionSubCoummunity()
	{
		$request = Yii::app()->request;
		$criteria = new CDbCriteria;
		$criteria->condition =   't.community_id=:community_id';
		$criteria->params = array(':community_id' => $request->getQuery('id'));
		$criteria->compare('sub_community_name', $request->getQuery('q'), true);
		$count = SubCommunity::model()->count($criteria);
		$Result = SubCommunity::model()->findAll($criteria);
		$ar = array();
		if ($Result) {
			foreach ($Result as $k => $v) {
				$ar[] = array('id' => $v->sub_community_id, 'text' => $v->sub_community_name);
			}
		}
		$record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
		echo  json_encode($record);
		Yii::app()->end();
	}
	public function makeTumbnail($filename, $width = 150, $height = true, $tempPath)
	{
		$url      = $filename;
		$new_file_name =  $this->image_name;
		$filename = $tempPath . '/' . $new_file_name;
		return $this->resize_crop_image($width, $height, $url, $filename, 80);
	}
	function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80)
	{

		$imgsize = $this->image_size;
		$width = $imgsize[0];
		$height = $imgsize[1];
		$mime = $imgsize['mime'];

		switch ($mime) {
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
		if ($mime == 'image/png') {
			imageAlphaBlending($dst_img, false);
			imageSaveAlpha($dst_img, true);
			imagefilledrectangle($dst_img, 0, 0, $max_width, $max_height, imagecolorallocate($dst_img, 255, 255, 255));
		}
		$src_img = $image_create($source_file);

		$width_new = $height * $max_width / $max_height;
		$height_new = $width * $max_height / $max_width;
		//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
		if ($width_new > $width) {
			//cut point by height
			$h_point = (($height - $height_new) / 2);
			//copy image
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
		} else {
			//cut point by width
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
		}

		$image($dst_img, $dst_dir, $quality);

		if ($dst_img) {
			imagedestroy($dst_img);
			return true;
		}
		if ($src_img) {
			imagedestroy($src_img);
			return true;
		}
	}
	public function actionView($id)
	{
		$model = NewDevelopment::model()->findByPk((int)$id);

		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$this->renderPartial('_view', compact('user', 'model', 'personal'));
	}
	public function actionStatus_change($id = null, $val = null)
	{
		if (!Yii::app()->request->isAjaxRequest) {
			return false;
		}
		$user = NewDevelopment::model()->findByPk((int)$id);

		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		$user::model()->updateByPk($id, array('status' => $val));
		echo 1;
	}
	public function actionUpload_floor_plan($width = null, $height = null)
	{


		$path =  Yii::getPathOfAlias('root.uploads.floor_plan');
		//Yii::import('backend.extensions.ResizeImage');
		if ($_FILES['file']['tmp_name']) {
			ini_set('memory_limit', '-1');
			$file = $_FILES['file']['name'];
			$file_orginal = $_FILES['file']['tmp_name'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$File = pathinfo($file, PATHINFO_FILENAME);
			$new_name =  substr(preg_replace("/[^a-zA-Z0-9._-]/", '_', "{$File}"), 0, 220);
			$new_name = empty($new_name) ? 'Untitled' : $new_name;
			$img = $new_name . '_' . time() . "." . $ext;
			move_uploaded_file($_FILES['file']['tmp_name'], $path . "/{$img}");
			echo $img;
		} else {
			echo "0";
		}
	}
	function actionDelete_floor_plan()
	{


		$str = "";
		if (isset($_POST['inp'])) {


			$ar = explode(',', $_POST['inp']);


			if ($ar) {
				foreach ($ar as $k => $val) {

					if ($val != $_POST['file'] and $val != "") {

						$str .= "," . $val;
					}
				}
			}
		}
		echo $str;
	}
	public function actionUpdatemetatag()
	{
		$request = Yii::app()->request;
		$model = NewDevelopment::model()->findByPk((int)$_POST['NewDevelopment']['id']);
		if ($model) {
			$model->updateByPk((int)@$_POST['NewDevelopment']['id'], array('meta_title' => @$_POST['NewDevelopment']['meta_title'], 'meta_description' => @$_POST['NewDevelopment']['meta_description']));
			echo (int)$_POST['NewDevelopment']['id'];
		} else {
			echo 0;
		}
	}
	public function actionSavetaglist()
	{

		$ad_id = (int)$_POST['NewDevelopment']['id2'];
		$request = Yii::app()->request;
		PlaceAdTags::model()->deleteAllByAttributes(array('ad_id' => $ad_id));;
		$items = @$_POST['NewDevelopment']['tags_list'];
		if ($items) {
			foreach ($items as $tags) {
				$model = new PlaceAdTags();
				$model->ad_id = $ad_id;
				$model->tag_id = $tags;
				$model->save();
			}
		}
		echo 1;
	}
	public function actionGet_tag_list($id = null, $sect_id = null, $category_id = null, $listing_type = null)
	{
		$section_id = $sect_id;
		$section_active =  array();
		if (!empty($section_id)) {
			$inactive_category_active = CHtml::listData(TagCategory::model()->findAllByAttributes(array('category_id' => $category_id)), 'tag_id', 'tag_id');
			$section_active2 = CHtml::listData(TagType::model()->findAllByAttributes(array('type_id' => $listing_type)), 'tag_id', 'tag_id');
			$section_active = CHtml::listData(TagSection::model()->findAllByAttributes(array('section_id' => $section_id)), 'tag_id', 'tag_id');
			$section_active_a = CHtml::listData(Tag::model()->findAllByAttributes(array('enable_all' => '1')), 'tag_id', 'tag_id');
			$section_active = array_replace($section_active, $section_active_a, $section_active2);
			if (!empty($inactive_category_active)) {
				foreach ($inactive_category_active as $tg) {
					if (isset($section_active[$tg])) {
						unset($section_active[$tg]);
					}
				}
			}
		}
		echo json_encode(array('items' => CHtml::listData(PlaceAdTags::model()->findAllByAttributes(array('ad_id' => $id)), 'tag_id', 'tag_id'), 'enabled' => $section_active));;
		Yii::app()->end();
	}
	public function actionGet_tag_list2($id = null, $listing_type = null)
	{
		$section_active =  array();
		if (!empty($listing_type)) {

			$section_active = CHtml::listData(TagTypeCustomer::model()->findAllByAttributes(array('type_id' => $listing_type)), 'tag_id', 'tag_id');
		}
		echo json_encode(array('items' => CHtml::listData(ListingUsersTag::model()->findAllByAttributes(array('user_id' => $id)), 'tag_id', 'tag_id'), 'enabled' => $section_active));;
		Yii::app()->end();
	}
	public function actionSavetaglist2($model = null)
	{

		$ad_id = (int)$_POST[$model]['id2'];
		$request = Yii::app()->request;
		ListingUsersTag::model()->deleteAllByAttributes(array('user_id' => $ad_id));;
		$items = @$_POST[$model]['tags_list'];
		if ($items) {
			foreach ($items as $tags) {
				$model = new ListingUsersTag();
				$model->user_id = $ad_id;
				$model->tag_id = $tags;
				$model->save();
			}
		}
		echo 1;
	}


	//CHtml::listData(States::model()->AllListingStatesOfCountry((int) $model->country) ,'state_id' , 'state_name') , $model->getHtmlOptions('state',array('empty'=>'Select City','class'=>'form-control select2','data-url'=>Yii::App()->createUrl($this->id.'/select_city'),'onchange'=>'load_via_ajax(this,"city")
	public function actionSelect_city_new($id = null)
	{

		$html = '<option value="">Select City</option>';
		$states = States::model()->AllListingStatesOfCountry((int) $id);


		if (!empty($states)) {
			foreach ($states as $k) {
				$html .= '<option value="' . $k->state_id . '">' . $k->state_name . '</option>';
			}
		}
		echo json_encode(array('data' => $html, 'size' => sizeOf($states)));
	}
	public function actionSelect_location($id = null)
	{
		$html = '<option value="">Select Location</option>';
		$states = City::model()->FindCities((int) $id);


		if (!empty($states)) {
			foreach ($states as $k) {
				$html .= '<option value="' . $k->city_id . '">' . $k->city_name . '</option>';
			}
		}
		echo json_encode(array('data' => $html, 'size' => sizeOf($states)));
	}
	public function actionSelect_category2($id = null)
	{
		$category =    Category::model()->ListDataForJSON_ID_BySEctionNew($id);
		$html = '<option value="">Select Category</option>';


		if (!empty($category)) {
			foreach ($category as $k => $v) {
				$html .= '<option value="' . $k . '">' . $v . '</option>';
			}
		}
		echo json_encode(array('data' => $html, 'size' => sizeOf($category)));

		exit;
	}
	public function actionSelect_sub_category2($id = null)
	{
		$category =    Subcategory::model()->ListDataForJSON_IDNew($id);
		$html = '<option value="">Select Category</option>';


		if (!empty($category)) {
			foreach ($category as $k => $v) {
				$html .= '<option value="' . $k . '">' . $v . '</option>';
			}
		}
		echo json_encode(array('data' => $html, 'size' => sizeOf($category)));

		exit;
		exit;
	}
	public function actionBulk_action()
	{


		$request = Yii::app()->request;
		$notify  = Yii::app()->notify;

		$action = $request->getPost('bulk_action');

		$items  = array_unique((array)$request->getPost('bulk_item', array()));
		if ($action == PlaceAnAd::BULK_ACTION_TRASH && count($items)) {
			$affected = 0;
			$customerModel = new  PlaceAnAd();
			foreach ($items as $item) {

				$customer = $customerModel->findByPk($item);
				if (!$customer) {
					continue;
				}
				//echo $customer->id;echo "<br />";

				$customer->updateByPk($item, array('isTrash' => '1'));
				$affected++;
			}
			if ($affected) {
				$notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
			}
		}
		if ($action == PlaceAnAd::BULK_ACTION_RESTORE && count($items)) {
			$affected = 0;
			$customerModel = new  PlaceAnAd();
			foreach ($items as $item) {

				$customer = $customerModel->findByPk($item);
				if (!$customer) {
					continue;
				}
				//echo $customer->id;echo "<br />";

				$customer->updateByPk($item, array('isTrash' => '0'));
				$affected++;
			}
			if ($affected) {
				$notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
			}
		}
		if ($action == PlaceAnAd::BULK_ACTION_DELETE && count($items)) {
			$affected = 0;
			$customerModel = new  PlaceAnAd();
			foreach ($items as $item) {

				$customer = $customerModel->findByPk($item);
				if (!$customer) {
					continue;
				}

				$customer->delete();;
				$affected++;
			}
			if ($affected) {
				$notify->addSuccess(Yii::t('app', 'The action has been successfully completed!'));
			}
		}

		$defaultReturn = $request->getServer('HTTP_REFERER', array('new_projects/index'));
		$this->redirect($request->getPost('returnUrl', $defaultReturn));
	}
	public function _setupEditorOptions(CEvent $event)
	{
		if (!in_array($event->params['attribute'], array('ad_description'))) {
			return;
		}

		$options = array();
		if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
			$options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
		}
		$options['id'] = CHtml::activeId($event->sender->owner, $event->params['attribute']);

		if ($event->params['attribute'] == 'ad_description') {
			$options['fullPage'] = true;
			$options['allowedContent'] = true;
			$options['height'] = 500;
		}

		$event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
	}
}
