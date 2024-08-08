<?php defined('MW_PATH') || exit('No direct script access allowed');



class Place_an_ad_no_loginController extends Controller
{

	/**
	 * Define the filters for various controller actions
	 * Merge the filters with the ones from parent implementation
	 */
	public $Controlloler_title = "Ad";
	public $focus = "country";
	public $member;
	public $show_overlay;
	public $can_upload_property;
	public function init()
	{

		parent::Init();
		if (!Yii::app()->request->isAjaxRequest) {



			$apps = $this->app->apps;
			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/star/css/shared/style.css?q=3'), 'priority' => -100));
			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/star/css/demo_1/style.css?q=1'), 'priority' => -100));
			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/materoial.css'), 'priority' => -100));
			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/member/new_icons.css'), 'priority' => -100));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/boot.min.js'), 'priority' => -100));
			$this->getData('pageStyles')->add(array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'priority' => -100));
			$this->getData('pageStyles')->add(array('src' =>  'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'));
			$this->getData('pageScripts')->add(array('src' =>  'https://code.jquery.com/ui/1.11.2/jquery-ui.min.js'));

			$this->setData(array(
				'hooks'     =>   	  Yii::app()->hooks,
			));


			//  $this->layout = 'member_area2';

		}
	}

	public function  beforeAction($action)
	{

		if (in_array($action->id, array('create', 'success', 'update', 'success_edit', 'create_business'))) {
			$apps = $this->app->apps;

			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/styles/jqx.base.css')));
			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/table_common.css?q=1')));
			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/styles/jqx.energyblue.css')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxcore.js')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/custom.js?q=2')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxbuttons.js')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxscrollbar.js')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxlistbox.js')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxcombobox.js')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jqwidgets/jqxdropdownlist.js')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
			$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/css/select2.min.css')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2.min.js')));
			$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/select2script.js')));
		}
		return parent::beforeAction($action);
	}
	public $secure;

	public function actionPreview()
	{

		$model = new PlaceAnAd();
		$image_array = array();
		$model->scenario = 'new_insert';

		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		$request = Yii::app()->request;

		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;

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
				if ((isset($request->cookies['preview1']) and   $request->cookies['preview1']->value != '')) {
					$preview_id =  $request->cookies['preview1']->value;
					if (!empty($preview_id)) {
						$LocalStorage = LocalStorage::model()->deleteAllByAttributes(array('cookie_name' => $preview_id));
						unset(Yii::app()->request->cookies[$preview_id]);
					}
				}
				$this->insertAfterSaveFn($model);
				//$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
				$this->redirect(Yii::App()->createUrl($this->id . '/success_posted', array('slug' => $model->slug)));
			}
		}

		if ((isset($request->cookies['preview1']) and   $request->cookies['preview1']->value != '')) {
			$preview_id =  $request->cookies['preview1']->value;
			$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name' => $preview_id));
			if (empty($LocalStorage)) {
				$this->redirect($this->app->createUrl('place_an_ad/create'));
			}
			$post = unserialize($LocalStorage->file);
			$model = new PlaceAnAd();
			$model->attributes = $post['PlaceAnAd'];
			$model->amenities = $post['amenities'];
			if (!empty($model->image)) {
				$exp =  explode(",", $model->image);
				if ($exp) {
					foreach ($exp as $k => $v) {
						if ($v != "") {
							$image_array[] = $v;
						}
					}
				}
			}

			if (isset($post['floor_plan'])) {
				$_POST['floor_plan'] = $post['floor_plan'];
			}
			if (isset($post['video_urls'])) {
				$_POST['video_urls'] = $post['video_urls'];
			}

			$this->no_header = '1';
			$this->secure_header = '1';
			$member = $this->member;
			$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
			$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
			$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css?q=1')));


			$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=2')));

			$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
			$this->setData(array(
				'pageTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => $this->tag->getTag('preview', 'Preview'), '{p}' => $this->project_name)),
				'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),

			));

			$this->render('//place_property/preview', compact('model', "country", "section", 'list_type', 'image_array', 'member', 'LocalStorage'));
		} else {

			$this->redirect($this->app->createUrl('place_an_ad/create'));
		}
	}
	public function actionCreate($preview = null, $type = null)
	{
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$model = new PlaceAnAd();
		$image_array = array();
		$model->scenario = 'new_insert';


		if (!Yii::app()->request->isPostRequest and !empty($preview)) {
			$preview_id =  $request->cookies['preview1']->value;

			$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name' => $preview_id));
			if (empty($LocalStorage)) {
				$this->redirect($this->app->createUrl('place_an_ad/create'));
			}
			$post = unserialize($LocalStorage->file);
			$model = new PlaceAnAd();
			$model->attributes = $post['PlaceAnAd'];
			$model->amenities = $post['amenities'];
			if (!empty($model->image)) {
				$exp =  explode(",", $model->image);
				if ($exp) {
					foreach ($exp as $k => $v) {
						if ($v != "") {
							$image_array[] = $v;
						}
					}
				}
			}

			if (isset($post['floor_plan'])) {
				$_POST['floor_plan'] = $post['floor_plan'];
			}
			if (isset($post['video_urls'])) {
				$_POST['video_urls'] = $post['video_urls'];
			}
		} else if ((isset(Yii::app()->request->cookies['USER_DRAFT']))) {
			$v_cokie =  Yii::app()->request->cookies['USER_DRAFT']->value;

			if (!empty($v_cokie)) {
				$model->attributes = $v_cokie;
			}
			if (!empty($model->image)) {
				$exp =  explode(",", $model->image);
				if ($exp) {
					foreach ($exp as $k => $v) {
						if ($v != "") {
							$image_array[] = $v;
						}
					}
				}
			}
			if (isset($v_cokie['amn']) and !empty($v_cokie['amn'])) {
				$model->amenities =  explode("-", $v_cokie['amn']);
			}
		}
		if (!empty($type)) {
			switch ($type) {
				case 'rent':
					if ($model->section_id != '2') {
						$model = new PlaceAnAd();
						$image_array = array();
						$model->scenario = 'new_insert';
					}
					$model->section_id = '2';
					break;
				case 'sell':
					if ($model->section_id != '1') {
						$model = new PlaceAnAd();
						$image_array = array();
						$model->scenario = 'new_insert';
					}
					$model->section_id = '1';
					break;
			}
		}

		$model->country = COUNTRY_ID;


		$country = Countries::model()->ListDataForJSON();

		$section = Section::model()->ListDataForJSON_New();
		$list_type = Category::model()->listingTypeArrayMainData();
		if ($type == 'business') {

			$mtitle = 'Sell Your Business in UAE with RGEstate';
		} else {
			$mtitle = 'List Your Property in UAE';
		}

		$this->setData(array(
			'pageTitle'     =>   $mtitle,
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),

		));
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css?q=1')));
		$model->user_id = '0';

		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=2')));

		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
		//  print_r($_POST);exit;
		if (Yii::app()->request->isAjaxRequest) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;
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
				/*
				
				if((isset($request->cookies['preview1']) and   $request->cookies['preview1']->value != '' )){
						$preview_id =  $request->cookies['preview1']->value; 
						$LocalStorage = LocalStorage::model()->findByAttributes(array('cookie_name'=>$preview_id));
				}else{
						$preview_id = date('Ymdhis'.rand(1000,1000000));
						$cookie = new CHttpCookie('preview1', $preview_id );
						$cookie->expire = time()+60*60*24*180; 
						Yii::app()->request->cookies['preview1'] = $cookie;
				}
				if(empty($LocalStorage)){
					$LocalStorage = new LocalStorage();
				}
				$LocalStorage->cookie_name = $preview_id; 
				
				 
				$LocalStorage->file = serialize($_POST); 
				if(!$LocalStorage->save()){
					 
				}
				$this->redirect(Yii::app()->createUrl($this->id.'/preview')); 
				*/
				// $this->redirect(Yii::app()->createUrl($this->id.'/preview'));
                
                // Start Crm Code
        		$requestParms = $request->getPost("PlaceAnAd");
    
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
                        "EMAIL" => [[ "VALUE" => $requestParms['salesman_email'], "VALUE_TYPE" => "WORK" ]],
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

                // Prepare data for the request
                $submittedByArray = [
                    1=>136, 
                    2=>48, 
                    3=>2932,
                ];
                $listingTypesArray = [
                    151 => "Commercial",
                    150 => "Residential"
                ];
                $areaUnits = [
                    1 => 622,
                    6 => 624,
                    4 => 626,
                    3 => 628,
                    5 => 630
                ];
                
                $subCategories = Category::model()->ListDataForJSON_ID_ByListingType($requestParms['listing_type']);
                $crmData = [
                    'FIELDS' => [
                        'TITLE' => 'New Lead - Property Submitted - RGEstate',
                        'CATEGORY_ID' => 10,
                        'CONTACT_ID' => $customerId,
						"EMAIL" => [[ "VALUE" => $requestParms['salesman_email'], "VALUE_TYPE" => "WORK" ]],
                        "PHONE" => [[ "VALUE" => $requestParms['mobile_number'], "VALUE_TYPE" => "WORK" ]],
                        'COMMENTS' => 
                            'Description: '.$requestParms['ad_description'].
                            '<br/> Area: '.$requestParms['area_location'].
                            '<br/> Size: '.$requestParms['interior_size'].
                            '<br/> Plot Area: '.$requestParms['builtup_area'].
                            '<br/> Bedrooms: '.$requestParms['bedrooms'].
                            '<br/> Bathrooms: '.$requestParms['bathrooms'].
                            '<br/> Furnished: '.$requestParms['furnished'].
                            '<br/> Listing Type: '.$listingTypesArray[$requestParms['listing_type']].
                            '<br/> Category: '.$subCategories[$requestParms['category_id']]
                            
                            ,
                        'OPPORTUNITY' => $requestParms['price'],
                        'UF_CRM_1705665714112' => $requestParms['ad_title'],
                        'UF_CRM_1701236145750' => 2908,
                        'UF_CRM_1698996056265' => $submittedByArray[$requestParms['submited_by']],
                        'UF_CRM_1702543252851' => $requestParms['section_id'] == 1 ? 2916 : 2918,
                        "UF_CRM_1701080368178" => $areaUnits[$requestParms['area_unit']],
                        'UF_CRM_65BA1A0E48B5F' => $requestParms['interior_size'],
                        'UF_CRM_65BA1A0E6C5C5' => $requestParms['builtup_area'],
                        'UF_CRM_1701080222003' => $requestParms['price'],
                        'ASSIGNED_BY_ID' => 22
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
				$this->insertAfterSaveFn($model);
				//$notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
				$this->redirect(Yii::App()->createUrl($this->id . '/success_posted'));
			}
		}
		// $this->no_header = '1';
		// $this->secure_header='1';
		$member = $this->member;
		$banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->default_country_id, 'BS');
		$img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		$img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		if (!empty($banners)) {
			$img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['image']) : $img;
			$img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['mobile']) : $img_mobile;
		}
		$this->render('//place_property/form_new_nl_login', compact('model', "country", "section", 'list_type', 'image_array', 'member', 'img', 'img_mobile'));
	}
	public function actionSelect()
	{



		$this->setData(array(
			'pageTitle'     =>  'RGEstate Real Estate Investments and Business Services Tailored to You',
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),

		));

		$banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->default_country_id, 'CP');
		$img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		$img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		if (!empty($banners)) {
			$img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['image']) : $img;
			$img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['mobile']) : $img_mobile;
		}

		// $this->no_header = '1';
		// $this->secure_header='1';
		$member = $this->member;
		$this->render('//place_property/select_module', compact('model', "country", "section", 'list_type', 'image_array', 'member', 'img', 'img_mobile'));
	}
	public function actionDetails($model, $subcategory, $category, $fields, $image_array)
	{
		$apps = $this->app->apps;
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
		$apps = $this->app->apps;
		$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('backend/assets/js/myAjax.js')));
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->render('details_edit', compact('model', 'subcategory', "category", "fields", "image_array"));
	}
	public function actionFindOnMap()
	{
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$model = new PlaceAnAd();
		//  $subcategory= SubCategory::model()->FindSubategory("12");

		$this->setData(array(
			'pageTitle'     =>  Yii::t(Yii::app()->controller->id, "Create new {$this->Controlloler_title}"),
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

	/**
	 * Delete existing user
	 */
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


		// sleep(15);

		ini_set('memory_limit', '-1');
		$this->fileUploadDropzone();
		exit;
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



			$fileSize = (int)$_FILES['file']['size'] / 1000000;
			if ($fileSize > 5) {
				$fileSize = 5;
			}
			switch ($fileSize) {
				case '5':
					$quality  = 15;
					$quality_p  = 4;
					break;
				case '4':
					$quality  = 50;
					$quality_p  = 4;
					break;
				case '3':
					$quality  = 60;
					$quality_p  = 8;
					break;
				case '2':
					$quality  = 70;
					$quality_p  = 8;
					break;
				case '1':
					$quality  = 80;
					$quality_p  = 8;
					break;
				default:
					$quality  = 80;
					$quality_p  = 7;
					break;
			}
			$tempPath = Yii::getPathOfAlias('root.uploads.images');
			$filename = $tempPath . '/' . $img;
			$detSize = getimagesize($_FILES['file']['tmp_name']);
			$this->image_size = $detSize;
			$this->image_name = $img;
			$width   = $detSize['0'];
			$newHeight   = $detSize['1'];
			$resized = 0;
			/*
							switch($detSize['mime'])
							{
								case 'image/png': 
								$resized = 1;
								$this->resize_crop_image($width,$newHeight,$url=$_FILES['file']['tmp_name'],$filename,$quality_p);
								break;
								case 'image/jpeg':
							 
								$resized = 1;
							 	$this->resize_crop_image($width,$newHeight,$url=$_FILES['file']['tmp_name'],$filename,$quality);
								break;
							}
							*/

			if ($resized == '1') {
				$fileURL = Yii::App()->apps->getBaseUrl('uploads/images/' . $img, true);
				$fileContents = file_get_contents($fileURL);

				$ar = $s3->putObject($fileContents, $bucketName, $img, S3::ACL_PUBLIC_READ);
				//		@unlink(Yii::app()->basePath . '/../../uploads/images/'. $img);
			} else {
				$ar = $s3->putObject(S3::inputFile($file_orginal, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
			}
			if (isset($_POST['rand'])) {
				echo json_encode(array('img' => $img, 'rand' => $_POST['rand']));
				exit;
			}
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
		$criteria->compare(new CDbExpression('CONCAT(first_name, " ", last_name)'), $request->getQuery('q'), true);
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
				$ar[] = array('id' => $v->user_id, 'text' => $v->fullNAme);
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
				$quality = $quality;
				break;

			case 'image/jpeg':
				$image_create = "imagecreatefromjpeg";
				$image = "imagejpeg";
				$quality = $quality;
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
	public function actionSelect_category3($id = null)
	{
		$category =    Category::model()->ListDataForJSON_ID_BySEctionNew($id);

		$html =  CHtml::radioButtonList('listing_type', '', $category, array(
			'onchange' => 'load_via_ajax_main_category(this)', 'data-url' => Yii::App()->createUrl($this->id . '/select_category4'), 'separator' => '', 'labelOptions' => array('class' => ''), 'template' => '<div class="inputGroup">{input}   {label} <span class="img"></span> <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg></div>'
		));

		echo json_encode(array('data' => $html, 'size' => sizeOf($category)));

		exit;
	}
	public function actionSelect_category4($id = null)
	{
		$category =    Category::model()->ListDataForJSON_ID_ByListingType($id);

		$html =  CHtml::radioButtonList('category_id', '', $category, array(
			'onchange' => 'validateInputSector()', 'separator' => '', 'labelOptions' => array('class' => ''), 'template' => '<div class="inputGroup">{input}   {label} <span class="img"></span><svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg></div>'
		));
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
	public function insertAfterSaveFn($model)
	{
		$room_image = new AdImage;
		//$room_image->deleteAll(array("condition"=>"ad_id=:ad_id","params"=>array(":ad_id"=>$model->id)));
		if (!$model->isNewRecord) {
			$room_image->updateAll(array('isTrash' => '1'), "ad_id=:ad_id", array(":ad_id" => (int)$model->id));
		}
		$imgArr =  explode(',', $model->image);

		if ($imgArr) {


			$img_saved = false;
			foreach ($imgArr as $k) {
				$found =  AdImage::model()->findByAttributes(array('ad_id' => $model->id, 'image_name' => $k));
				if ($found) {
					$found->isTrash = '0';
					$found->save();
				} else {
					$room_image->isNewRecord = true;
					$room_image->id = "";
					$room_image->ad_id = $model->id;
					$room_image->status =  Yii::app()->options->get('system.common.frontend_default_ad_image_status', 'I');
					$room_image->image_name =  $k;
					$room_image->save();
				}
			}
			if (!$model->isNewRecord) {
				AdImage::model()->deleteAll(array("condition" => "ad_id=:ad_id and isTrash='1'", "params" => array(":ad_id" => (int)$model->id)));
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
	public function actionGetCityId($city = null)
	{
		$criteria = new CDbCriteria;
		$criteria->select = "state_id,state_name";
		$criteria->condition = "lower(state_name)=:state";
		$criteria->params[':state'] = strtolower($city);
		$states = States::model()->find($criteria);


		if (!empty($states)) {
			echo json_encode(array('status' => 1, 'state_id' => $states->state_id));
		} else {
			echo json_encode(array('status' => 0));
		}
		exit;
	}
	public function actionCity_details($id = null)
	{
		$location = '';
		$criteria = new CDbCriteria;
		$criteria->select = "city_name,st.state_name";
		$criteria->join = 'INNER JOIN {{states}} st on st.state_id = t.state_id';
		$criteria->condition = "t.city_id=:city_id";
		$criteria->params[':city_id'] =  (int) $id;
		$states = City::model()->find($criteria);


		if (!empty($states)) {
			echo json_encode(array('status' => 1, 'city' => rtrim($states->city_name), 'city_name' => rtrim($states->city_name) . ' , ' . rtrim($states->state_name)));
		} else {
			echo json_encode(array('status' => 1, 'city_name' => ''));
		}
		exit;
	}

	public function actionSavecookies()
	{

		$data = array_filter($_POST['PlaceAnAd']);

		if (isset($data['contact_person'])) {
			unset($data['contact_person']);
		}
		if (isset($data['mobile_number'])) {
			unset($data['mobile_number']);
		}
		if (isset($data['user_id'])) {
			unset($data['user_id']);
		}
		if (isset($_POST['amn'])) {
			$data['amn']  = $_POST['amn'];
		}
		$cookieName = 'USER_DRAFT';
		if (!empty($data)) {

			$cookie = new CHttpCookie($cookieName, $data);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies[$cookieName] = $cookie;
		} else {
			unset(Yii::app()->request->cookies[$cookieName]);
		}
	}
	public function actionHidden_ammenities($id = null)
	{
		$location = '';
		$criteria = new CDbCriteria;
		$criteria->select = "amenities_id";
		$criteria->condition = "t.category_id=:category_id";
		$criteria->params[':category_id'] =  (int) $id;
		$states = AmenitiesCategoryList::model()->findAll($criteria);


		if (!empty($states)) {
			$amenities_list = CHtml::listData($states, 'amenities_id', 'amenities_id');
			echo json_encode(array('status' => 1, 'amenities_list' => $amenities_list));
		} else {
			echo json_encode(array('status' => 0));
		}
		exit;
	}
	public function actionFindCities($zone_id = null)
	{

		$query = (!empty($_GET['q'])) ?   $_GET['q']   : null;


		$status = true;

		/*areas Fetching */
		$criteria = new CDbCriteria;
		$criteria->condition  = '1';
		$criteria->select = 't.city_id,t.state_id,cn.country_id,t.city_name,cn.cords as country_name,st.state_name';
		$criteria->join = ' INNER JOIN {{states}}  st on st.state_id = t.state_id   ';
		$criteria->join .= ' INNER JOIN {{countries}}  cn on cn.country_id = st.country_id   ';
		$criteria->condition .= ' and   cn.show_on_listing ="1"';
		$criteria->condition  .= ' and ( t.city_name like :query   )';

		$criteria->limit = '15';
		$criteria->params[':query'] = '%' . $query . '%';

		$areas = City::model()->findAll($criteria);
		/*areas Fetching */


		$resultUsers = [];
		if ($areas) {
			foreach ($areas as $k => $v) {

				$resultUsers[] =  array(
					"id"        => $v->city_id,
					"state_id"        => $v->state_id,
					"country_id"        => $v->country_id,
					"username"  => trim($v->city_name),
					"avatar"    => "",
					"country" =>  '(' . $v->state_name . ',' . $v->country_name . ')',
				);
			}
		}



		$resultProjects = [];

		// Means no result were found
		if (empty($resultUsers) && empty($resultProjects)) {
			$status = false;
		}

		header('Content-type: application/json; charset=utf-8');

		echo json_encode(array(
			"status" => $status,
			"error"  => null,
			"data"   => array(
				"user"      => $resultUsers,

			)
		));
	}


	public function actionCreate_business($cat = null, $id = null)
	{
		$_GET['type'] = 'business';
		$request = Yii::app()->request;
		$notify = Yii::app()->notify;
		$image_array = array();
		if ($id) {
			$model =  BusinessForSale::model()->findByPk($id);


			if (isset($model->adImages)) {


				foreach ($model->adImages as $k => $v) {
					$image_array[] = $v->image_name;
				}
			}
		}
		if (empty($model)) {
			$model = new BusinessForSale();
		}
		$model->scenario = 'new_insert';
		$model->country =  '66124';
		$model->section_id =  '6';
		if (!empty($cat)) {
			$model->category_id = $cat;
		}

		$country = Countries::model()->ListDataForJSON();

		$section = Section::model()->ListDataForJSON_New();
		$list_type = Category::model()->listingTypeArrayMainData();

		$this->setData(array(
			'pageTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'Post your AD ', '{p}' => Yii::app()->options->get('system.common.site_name'))),
			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),

		));
		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/dropzone.min.js')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/css/dropzone.css')));
		$this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/table_common.css')));


		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/js/custom.js?q=1')));

		$this->getData('pageScripts')->add(array('src' => Yii::app()->apps->getBaseUrl('backend/assets/js/jquery.autocomplete.js')));
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
			
			$model->status = 2;
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
			    // Start Crm Code
	    		$requestParms = $request->getPost("BusinessForSale");
	   // 		echo "<pre>";
	   // 		print_r($requestParms);
	   // 		print_r(Category::model()->findByPk($requestParms['category_id'])->category_name);
	   // 		exit;
                $customerId = 0;
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
                        "EMAIL" => [[ "VALUE" => $requestParms['salesman_email'], "VALUE_TYPE" => "WORK" ]],
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
        		
        		$crmUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.lead.add.json';
        
                // Prepare data for the request
                $crmData = [
                    'FIELDS' => [
                        'TITLE' => 'New Lead - Business Info Submitted - RGEstate',
                        'CATEGORY_ID' => 22,
                        'ASSIGNED_BY_ID' => 22,
                        'SOURCE_ID' => "WEB",
                        'BEGINDATE' => date("d/m/Y"),
                        "OPENED" => "Y",
						"EMAIL" => [[ "VALUE" => $requestParms['salesman_email'], "VALUE_TYPE" => "WORK" ]],
                        "PHONE" => [[ "VALUE" => $requestParms['mobile_number'], "VALUE_TYPE" => "WORK" ]],
                        'CONTACT_ID' => $customerId,
                        'COMMENTS' => 
                        'Title: '. $requestParms['ad_title'].
                        '<br/> Ref No: ' . $requestParms['RefNo'].
                        '<br/> Description: ' . $requestParms['ad_description'].
                        '<br/> Location: ' . $requestParms['area_location'].
                        '<br/> Business Category: ' . Category::model()->findByPk($requestParms['category_id'])->category_name
                        ,
                        'UF_CRM_1701142629' => $requestParms['price'],
                        'UF_CRM_1702643120' => $requestParms['ad_description'],
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
        
                if ($model->hasErrors()) {
        			echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
                } else {
                    if(!$model->save()){
        				echo json_encode(array('status'=>'0','msg'=>'<div class="alert alert-danger1"><strong>Error!</strong> '.CHtml::errorSummary($model).'. </div>'));
        			}else{
        				echo json_encode(array('status'=>'1','name'=>$model->email , 'msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
        		    }
                }

				$this->insertAfterSaveFn($model);
				$this->redirect(Yii::App()->createUrl($this->id . '/success_posted_business'));
			}
		}
		$model->fieldDecorator->onHtmlOptionsSetup = array($this, '_setupEditorOptions');
		//  $this->no_header = '1'; $this->secure_header='1';
		$banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->default_country_id, 'BS');
		$img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		$img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		if (!empty($banners)) {
			$img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['image']) : $img;
			$img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['mobile']) : $img_mobile;
		}
		$this->render('root.apps.frontend.new-theme.views.place_property.form_new_business', compact('model', "country", "section", 'list_type', 'image_array', 'img', 'img_mobile'));
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
			$options['fullPage'] = false;
			$options['allowedContent'] = true;
			$options['toolbar'] = 'Simple';
			$options['height'] = 300;
		}

		$event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
	}
	public function actionSuccess_posted()
	{

		$this->setData(array(
			'hooks' => Yii::app()->hooks,
			'pageTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'Successfully submitted yor property ', '{p}' => Yii::app()->options->get('system.common.site_name'))),

			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
				Yii::t('app', 'Create new'),
			)
		));
		// $this->no_header = '1'; $this->secure_header='1';
		$this->render('//place_an_ad/success', compact('model'));
	}
	public function actionsuccess_posted_business()
	{

		$this->setData(array(
			'hooks' => Yii::app()->hooks,
			'pageTitle'     =>   Yii::t('app', '{name}   :: {p}', array('{name}' => 'Successfully submitted yor property ', '{p}' => Yii::app()->options->get('system.common.site_name'))),

			'pageHeading'       => Yii::t(Yii::app()->controller->id, "List your property"),
			'pageBreadcrumbs'   => array(
				Yii::t(Yii::app()->controller->id, "{$this->Controlloler_title}") => $this->createUrl(Yii::app()->controller->id . '/index'),
				Yii::t('app', 'Create new'),
			)
		));
		//  $this->no_header = '1'; $this->secure_header='1';
		$this->render('//place_an_ad/success_business', compact('model'));
	}
}
