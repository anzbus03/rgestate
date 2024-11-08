<?php
defined('MW_PATH') || exit('No direct script access allowed');

class SiteController extends Controller
{

	public function init()
	{
		parent::Init();
		Yii::$classMap = array_merge( Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('root.apps.extensions.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
        ));
	}

	public function actionListAllCountries()
	{
		$listContries  = Countries::model()->list_array_country();
		echo json_encode(array('status' => 'SUCCESS', 'statusCode' => '1', 'errorMessage' => '', 'data' => json_encode($listContries)));
	}
	public function actionSubmit_bot() {
		$rawData 	= Yii::app()->request->getRawBody();
    	$jsonData 	= CJSON::decode($rawData, true);

		$model 		= new ContactUs();
		$model->scenario = 'ai_bot';
		$name 		= $jsonData['name'];
		$email		= $jsonData['email'];
		$phone		= $jsonData['phone'];
		$message 	= $jsonData['message'];

		// CRM URL to get customer details
		$createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';

	
		$crmCustomerData = [
			'fields' => [
				'NAME' => $name,
				'SECOND_NAME' => $name,
				'TYPE_ID' => 'CLIENT',
				'SOURCE_ID' => 'SELF',
				'EMAIL' => [['VALUE' => $email, 'VALUE_TYPE' => 'WORK']],
				'PHONE' => [['VALUE' => $phone, 'VALUE_TYPE' => 'WORK']],
			]
		];

		// Send customer creation request
		$postCustomerData = http_build_query($crmCustomerData);
		$contextCustomerOptions = [
			'http' => [
				'method' => 'POST',
				'header' => 'Content-Type: application/x-www-form-urlencoded',
				'content' => $postCustomerData,
			]
		];
		$contextCreateCustomer = stream_context_create($contextCustomerOptions);

		try {
			$data = file_get_contents($createCustomerUrl, false, $contextCreateCustomer);
			$response = json_decode($data, true);
			$customerId = $response['result'] ?? null; // Get customer ID from response
			if (!$customerId) {
				throw new Exception('Failed to create customer in CRM.');
			}
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => 'Unable to create customer.']);
			Yii::app()->end();
		}

		// CRM URL to create a new lead
		$crmUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.lead.add.json';

		$crmData = [
			'FIELDS' => [
				'TITLE' => 'RGestate Lead - AI Bot',
				'CATEGORY_ID' => 16,
				'LEAD_PHONE' => $phone,
				'LEAD_LAST_NAME' => $name,
				'LEAD_NAME' => $name,
				'LEAD_EMAIL' => $email,
				'CONTACT_ID' => $customerId,
				'COMMENTS' => $message,
				'ASSIGNED_BY_ID' => 22,
			]
		];

		// Send lead creation request
		$postData = http_build_query($crmData);
		$contextOptions = [
			'http' => [
				'method' => 'POST',
				'header' => 'Content-Type: application/x-www-form-urlencoded',
				'content' => $postData,
			]
		];
		$context = stream_context_create($contextOptions);

		try {
			file_get_contents($crmUrl, false, $context);
		} catch (Exception $e) {
			echo json_encode(['status' => 'error', 'message' => 'Unable to create lead.']);
			Yii::app()->end();
		}
		$model->attributes = $_POST; 
		// Set model attributes and save
		$model->name = $name; // Set other attributes as necessary
		$model->email = $email;
		$model->phone = $phone;
		$model->phone_false = $phone;
		$model->meassage = $message;
		$model->ai_bot = 1;

		// Save the model and return the success or error message
		if ($model->validate() && $model->save()) {
			echo json_encode(['status' => 'success', 'message' => 'Successfully submitted.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Error: ' . CHtml::errorSummary($model)]);
		}


	}
	public $default_country_slug;
	public $system_defaultt_country_id;
	public $banners;
	public function actionIndex()
	{
	    
        $model = new ContactPopup;
		$this->layout = '//layouts/main_custom';

		define('ITSHOME', '1');
		$this->header_class = 'headers';
		$apps = $this->app->apps;
		//'featred_agencies',
		$this->banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->system_defaultt_country_id);


		$fav_communities = States::model()->AllListingStatesOfCountry($this->default_country_id, 11, 1);


		// print_r(CHtml::listData($fav_communities,'state_name','icon'));exit; 

		$this->setData(array(
			'pageTitle'         =>   Yii::t('app', $this->generateCommon('home_meta_title', ''), array('{country}' => COUNTRY_NAME, '{project_name}' => $this->project_name)),
		));
		$this->quicklinks = '1';
		$this->boxshdw = '1';

		$featred_agencies  = ListingUsers::model()->home_featured_banners_cache();

		$country_id = $this->country;
		$state_id = '';
		//$criteria->condition .= ' and t.section_id =:new_section_id ';
		$adModel = new PlaceAnAdNew();
		$adModelCriteria =	$adModel->findAds(array(), false, true);
		$condition = $adModelCriteria->condition;

		$new_homesCritieria         	 =	$adModelCriteria;
		$new_homesCritieria->limit  	 =   5;
		$new_homesCritieria->order 		 = 	' t.id desc';
		$new_homesCritieria->condition  .= '  and t.section_id   in("1","2") ';

		$new_homes =  $adModel->findAll($new_homesCritieria);



		$featured_developersCrit     		=   $adModel->findAds(array('_sec_id' => '3'), false, true);;
		$featured_developersCrit->limit		=  2;
		$featured_developersCrit->order 	= ' t.id desc';
		$featured_developers = $adModel->findAll($featured_developersCrit);

		$b_1 = array();
		$b_2 = array();
		$b_3 = array();
		$b_4 = array();


		$latest = BlogArticle::model()->latestBlogs($limit = 4);


		// echo 'Herer<br>'.__FILE__;
		// echo '<br>'.__LINE__;
		// echo '<pre>';
		// print_r($latest);
		// exit; 


		//Yii::app()->options->set('system.common.banner','yes');
		if ($this->options->get('system.common.banner', 'no') == 'yes') {
			$banner = new Banner();
			//$b_1 = $banner->newBannerFn(11);
			$b_2 = $banner->newBannerFn(12);
			$b_3 = $banner->newBannerFn(13);
			$b_5 = $banner->newBannerFn(11);
		}
		$banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->default_country_id, 'AB');
		$img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		$img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
		if (!empty($banners)) {
			$img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['image']) : $img;
			$img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['mobile']) : $img_mobile;
		}
		$apps = $this->app->apps;
		//	$this->getData('pageStyles')->add(array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.css?q=1'), 'priority' => -100));
		//	$this->getData('pageScripts')->add(array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.js?q=1'), 'priority' => -100));
		$filterModel = new PlaceAnAd();
		$areaData = States::model()->all_cities_list();
		$areaData = array_values($areaData);
		$filterModel->section_id = 'property-for-sale';
		if ($this->app->request->isAjaxRequest) {
			$this->renderPartial('index', compact('areaData', 'filterModel', 'last_viewd', 'latest', 'new_homes', 'new_properties_forrent', 'featured_developers', 'featred_agencies', 'b_2', 'b_3', 'b_5', 'fav_communities','model'));
			$this->app->end();
		}
		$widget = ContentPages::model()->pageContentList(1);

		/* Partners */
		$criteria = new CDbCriteria();
		$criteria->compare('status', Partners::STATUS_PUBLISHED);
		$criteria->order = 'partners_id DESC';

		$partners = Partners::model()->findAll($criteria);
		/* Partners */

		$featured = $this->getHomeFeaturedListing();

		$this->render('index', compact('featured','img', 'img_mobile', 'areaData', 'filterModel', 'widget', 'last_viewd', 'latest', 'new_homes', 'new_properties_forrent', 'featured_developers', 'featred_agencies', 'b_2', 'b_3', 'b_5', 'fav_communities', 'partners','model'));
	}

    public function actionContact_popup(){
		$model = new ContactPopup;
		$notify = Yii::app()->notify;
		if (isset($_POST['ajax'])) {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
        if (Yii::app()->request->isPostRequest && ($attributes = (array)Yii::app()->request->getPost($model->modelName, array()))) {
		echo $model->name;
		$model->attributes = $attributes;
	    if($model->save())
		{
		    	$options =Yii::app()->options;
			    $emailTemplate =  CustomerEmailTemplate::model()->findByAttributes(array('template_uid'=>"az3438eqlm2fc"));;
			    $emailTemplate_customer =  CustomerEmailTemplate::model()->findByAttributes(array('template_uid'=>"px349xcdrw78d"));;
				$emailTemplate_common = $options->get('system.email_templates.common');
			    if($emailTemplate)
			    {
					$subject		= $emailTemplate->subject;
					$emailTemplate  = $emailTemplate->content;
					$emailTemplate = str_replace('{name}',$model->name, $emailTemplate);
					$emailTemplate = str_replace('{phone}', $model->phone, $emailTemplate);
					$emailTemplate = str_replace('{email}', $model->email, $emailTemplate);
					$emailTemplate = str_replace('{message}', nl2br($model->message), $emailTemplate);
					//$emailTemplate = str_replace('{subject}',  $model->city , $emailTemplate);					 
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($options->get('system.common.admin_email')));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				if( $emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$model->name, $emailTemplate);
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
				 
					
				    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($model->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				  $notify->addSuccess(Yii::t('app','Your message was successfully sent to the {p} Support Team. One of our representative will contact you soon.'  ,array('{p}'=>$options->get('system.common.site_name'))));
				  $this->refresh() ;
					 
					 
		}
		else
		{
		 
		   $notify->addError(Yii::t('app', 'Please fix the following Errors'));
		}
	    }
		 
 
        $this->setData(array(
            'pageMetaTitle'     =>Yii::app()->options->get('system.common.site_name').' | '.Yii::t('articles', 'Contact Us'), 
            'pageBreadcrumbs'   => array()
        ));
           $this->setData(array(
            'pageTitle'     =>'Contact Us', 
            'pageMetaDescription'   => 'Questions or comments? We can help you. Reach us today or email at office@askaan.com', 
            'metaKeywords'   => 'Contact Us', 
        ));

        $this->render("index" , compact('model'));
        
    }
	private function getHomeFeaturedListing(){
        $criteria = new CDbCriteria();
		$catSlugs = ['featured', 'Warehouse','retail','labor-camp','land','hospital','hospitals','schools','building','hotels'];

		$featured = [];

		$model = new PlaceAnAdNew();
		// Fetch featured listings separately
		$criteriaFeatured = new CDbCriteria();
		$criteriaFeatured->select = 't.*,usr.phone as user_number,usr.email as user_email,usr.first_name,usr.first_name_ar,usr.last_name,usr.user_type as user_type,usr.full_number as mobile_number,usr.first_name,usr.last_name';
		$criteriaFeatured->join = ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteriaFeatured->condition = "t.featured = 'Y' AND t.status = :status AND t.isTrash = :isTrash";
		$criteriaFeatured->params[':status'] = 'A';
		$criteriaFeatured->params[':isTrash'] = '0';
		$criteriaFeatured->order = 't.date_added DESC';
		$criteriaFeatured->limit = 10;
		$featuredListings = $model->findAll($criteriaFeatured);
		   // Add featured listings to $featured array
		   $featured[] = array(
			'category' => (object) ['category_name' => 'Featured Listings'],
			'listings' => $featuredListings
		);
		foreach($catSlugs as $slug){

			$category = Category::model()->getCategoryFromSlug($slug);
            $criteria->select = 't.*,usr.phone as user_number,usr.email as user_email,usr.first_name,usr.first_name_ar,usr.last_name,usr.user_type as user_type,usr.full_number as mobile_number,usr.first_name,usr.last_name';
            $criteria->join  =   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
			//$criteria->join  =   ' LEFT JOIN {{listing_users}} p_usr on p_usr.user_id = usr.parent_user ';
            $criteria->condition ="t.category_id=:category_id AND t.status=:status AND t.isTrash = :isTrash";
            
            $criteria->params[':category_id'] = $category->category_id;
            // $criteria->params[':featured'] = 'Y';
            $criteria->params[':status'] = 'A';
            $criteria->params[':isTrash'] = '0';
            $criteria->order = 't.date_added DESC';
            
			$cookieName = 'USERFAV'.COUNTRY_ID;
			if((isset(Yii::app()->request->cookies[$cookieName])   )){
				$cook =  Yii::app()->request->cookies[$cookieName]->value;
				//print_r($cook);exit; 
				if(!empty($cook) and is_array($cook)){
					$userStr = implode("', '", $cook);
					$criteria->select .= " , CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END as fav " ;
				}
			}
			
			$criteria->limit = 10;
			$listings = $model->findAll($criteria);
			
			$featured[] = array(
				'category' => $category,
				'listings' => $listings
			);
		}

		return $featured;
	}


	public function actionLoad_data($country_id = null, $state_id = null)
	{

		if (empty($state_id)) {
			$country = Countries::model()->findByPk($country_id);
		} else {
			$state = States::model()->findByPk($state_id);
		}

		//$new_developments  = PlaceAnAd::model()->newDevelopments($country_id,$state_id,8);
		///$featured_developments = PlaceAnAd::model()->faturedProjects($country_id,$state_id,3,PlaceAnAd::NEW_ID);
		$new_homes         = PlaceAnAd::model()->new_homes($country_id, $state_id, 8, PlaceAnAd::SALE_ID);
		$new_properties_forrent         = PlaceAnAd::model()->new_homes($country_id, $state_id, 8, PlaceAnAd::RENT_ID);
		//$wanted         = PlaceAnAd::model()->new_homes($country_id,$state_id,8,4 );
		$wanted = array();
		/* $property_of_featured_developers         = Developer::model()->featured_developers($country_id,$state_id,2,0,true); */
		$not_in = array();
		if (!empty($property_of_featured_developers)) {
			foreach ($property_of_featured_developers as $k => $v) {
				$not_in[] = $v->user_id;
			}
		}

		//$featured_developers         = Developer::model()->featured_developers($country_id,$state_id,8,$not_in);
		$featured_developers         = PlaceAnAd::model()->new_homes($country_id, $state_id, 3, PlaceAnAd::NEW_ID, null, false, $promoted_properties_default_order = 'new', $show_multiple = true, array(), $title = true);;

		if (empty($new_developments) and  empty($wanted) and  empty($featured_projects) and  empty($new_homes) and  empty($new_properties_forrent) and  empty($property_of_featured_developers) and  empty($featured_developers)) {
			return;
			Yii::app()->end();
		}
		$this->renderPartial('_ajax_render_items', compact('wanted', 'featured_developments', 'country', 'state', 'new_developments', 'featured_projects', 'new_homes', 'new_properties_forrent', 'featured_developers', 'property_of_featured_developers', 'featured_developers'));
	}
	public function actionLoad_data_ads($layout_id = null)
	{

		$model = AdvertisementLayout::model()->findByPk($layout_id);
		if (empty($model)) {
			echo 1;
			Yii::app()->end();
		}
		$criteria = new CDbCriteria;
		$criteria->select = 't.*, ad.section_id,ad.slug as ad_slug,ban.link_url as banner_slug , art.slug as blog_slug  , ad.ad_description as ad_description, ad.ad_title as ad_title,ban.title as banner_title , art.title as blog_title  , ad.ad_description as ad_description,ban.description as banner_description , art.content as blog_description  ,  (CASE WHEN  t.section = "A" THEN  (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.ad_id and  img.status="A" and  img.isTrash="0"  limit 1  )  WHEN t.section = "B" THEN ban.image  ELSE 0 END ) as      ad_image ';
		$criteria->join  .= ' left join {{place_an_ad}} ad ON ad.id = t.ad_id  ';
		$criteria->join  .= ' left join {{banner}} ban ON ban.banner_id = t.banner_id ';
		$criteria->join  .= ' left join {{article}} art ON art.article_id = t.article_id ';
		$criteria->condition  .= ' 1  and  t.layout_id = :layout_id ';
		$criteria->order   = 't.row_id asc';
		$criteria->params[':layout_id']   = $model->primaryKey;
		$data = AdvertisementItems::model()->findAll($criteria);
		if (empty($data)) {
			echo 1;
			Yii::app()->end();
		}
		$this->renderPartial('ad/add_values', compact('model', 'data'));
		Yii::App()->end();
	}

	public function actionOffline()
	{
		if (Yii::app()->options->get('system.common.site_status') !== 'offline') {
			$this->redirect(array('site/index'));
		}

		throw new CHttpException(503, Yii::app()->options->get('system.common.site_offline_message'));
	}



	public function actionError()
	{
		//$this->layout =   Yii::app()->LayoutClass->layoutpath("sub"); 
		//$this->headerImage  =  Yii::app()->theme->baseUrl.'/images/404.jpg';
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest) {
				echo CHtml::encode($error['message']);
			} else {
				$this->setData(array(
					'pageTitle'         => Yii::t('app', 'Error {code}!', array('{code}' => $error['code'])),
					'pageMetaDescription'   => $error['message'],
				));
				$this->render("error",  compact('error'));
			}
		}
	}
	public function actionSocial()
	{
		$this->render("social");
	}
	public function actionDistrict()
	{
		$limit = 30;
		$request = Yii::app()->request;
		$criteria = new CDbCriteria;
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
	public function actionLocation()
	{
		$limit = 30;
		$request = Yii::app()->request;
		$criteria = new CDbCriteria;
		$json = file_get_contents('php://input');

		$obj = json_decode($json);

		$string = str_replace('\\', '', @$obj->textKeyword);

		if (Yii::app()->request->cookies['country_id']->value != 0) {

			$criteria->with['city'] = array('with' => array('state' => array('with' => 'con', 'condition' => 'con.country_id=:countryID', 'params' => array(':countryID' => Yii::app()->request->cookies['country_id']->value)), "together" => true));
		}

		$criteria->compare('LOWER(district_name)', strtolower($string), true);
		$count = District::model()->count($criteria);
		$criteria->limit   =  $limit;
		$page = Yii::app()->request->getQuery('page', 1);
		$offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset;
		$Result = District::model()->findAll($criteria);
		$ar = array();
		if ($Result) {
			foreach ($Result as $k => $v) {
				$ar[] = array('LocationName' => $v->district_name);
			}
		}
		$record =  $ar;

		echo  json_encode($record);
		Yii::app()->end();
	}
	public function actionChangeCountry($id = null)
	{
		$country = Countries::model()->findByAttributes(array('country_id' => $id, 'show_on_listing' => '1', 'isTrash' => '0'));
		if (!empty($country)) {
			$cookie = new CHttpCookie('country_name', $country->country_name);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies['country_name'] = $cookie;

			$cookie = new CHttpCookie('country_id', $country->country_id);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies['country_id'] = $cookie;
			$cookie = new CHttpCookie('flag', $country->flag);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies['flag'] = $cookie;
		}

		$this->redirect(Yii::app()->apps->getBaseUrl(''));
		Yii::app()->end();
	}
	public function actionSendEnquiry()
	{
		$request    = Yii::app()->request;
		$model  = new SendEnquiry();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
			$model->attributes = $attributes;
			if (!$model->save()) {
				print_r($model->getErrors());
				Yii::app()->end();
			} else {
				echo "1";
				Yii::app()->end();
			}
		}
	}
	public function actionValidateEnquiry()
	{
		$model = new SendEnquiry;
		if (isset($_POST['ajax'])) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionLoadStates()
	{
		$id = null;
		if (isset($_REQUEST['country_id'])) {
			$id = $_REQUEST['country_id'];
		}

		$data = States::model()->getStateWithCountry_2($id);
		$data = CHtml::listData($data, 'state_id', 'state_name');
		echo "<option value=''>Select Region</option>";
		foreach ($data as $k => $v)
			echo CHtml::tag('option', array('value' => $k), CHtml::encode($v), true);
	}
	public function actionLoadCity()
	{



		$limit = 30;
		$request = Yii::app()->request;
		$criteria = new CDbCriteria;
		$criteria->compare('state_name', $request->getQuery('q'), true);
		$criteria->compare('t.isTrash', '0');
		$country_array = explode(',', $request->getQuery('country_id'));
		$criteria->join  = ' LEFT JOIN {{countries}} cn on t.country_id = cn.country_id  ';
		$criteria->condition .= ' and CASE WHEN cn.enable_all_cities = "1" THEN 1 ELSE t.enable_listing="1" END ';
		$criteria->addInCondition('t.country_id', $country_array);

		$criteria->select = 't.state_id,state_name';
		$count = States::model()->count($criteria);
		$criteria->order = 'state_name ASC';
		$criteria->group = 'state_name';
		$criteria->limit   =  $limit;
		$page = Yii::app()->request->getQuery('page', 1);

		$offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset;

		$data = States::model()->findAll($criteria);
		$ar = array();

		if ($data) {
			foreach ($data as $k => $v) {

				$ar[] = array('id' => $v->state_id, 'text' => $v->state_name);
			}
		}
		if ($request->getQuery('city_id') != 'null') {
			$city_array = explode(',', $request->getQuery('city_id'));
			if (!empty($city_array)) {
				$criteria = new CDbCriteria;
				$criteria->addInCondition('t.state_id', $city_array);
				$criteria->addInCondition('t.country_id', $country_array);
				$data2 = States::model()->findAll($criteria);
				if ($data2) {
					foreach ($data2 as $k => $v) {

						$ar[] = array('id' => $v->state_id, 'text' => $v->state_name);
					}
				}
			}
		}
		$record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
		echo  json_encode($record);
		Yii::app()->end();
	}
	public function actionImpersonate($id)
	{


		if (!strpos(Yii::app()->request->urlReferrer, 'backend')) {
			//throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$user = ListingUsers::model()->findByPk((int)$id);

		if (empty($user)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		$identity = new UserIdentity($user->email, null);
		$identity->impersonate = true;


		if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
			$notify->addError(Yii::t('app', 'Unable to impersonate the customer!'));
			$this->redirect(array('user/signin'));
		}
		$this->redirect(array('member/dashboard'));
	}
	public function actionImage_crop()
	{



		$newArray = (object) array(
			'x' => $_GET['imgX5'],
			'y' => $_GET['imgY5'],
			'height' => $_GET['widthY'],
			'width' => $_GET['widthX'],
			'cropW' => $_GET['cropW'],
			'cropH' => $_GET['cropH'],
			'rotate' => $_GET['rotate'],
		);



		$ext  = pathinfo($_GET['imgUrl'], PATHINFO_EXTENSION);
		$file = pathinfo($_GET['imgUrl'], PATHINFO_FILENAME);
		$src   =  $file . '.' . $ext;
		$tempPath = Yii::getPathOfAlias('root.uploads.images');
		$tempPath2 = Yii::getPathOfAlias('root.uploads.resized');
		$src =  $tempPath . '/' . $src;
		$output_filename = $tempPath2 . "/" . $file . '.' . $ext;
		$response = $this->crop($src, $output_filename, $newArray);
		echo json_encode($response);
		exit;
	}
	public $src;
	public $type;
	public $extension;

	public function crop($src,  $dst, $data)
	{


		if (!empty($src)) {
			$type = exif_imagetype($src);

			if ($type) {
				$this->src = $src;
				$this->type = $type;
				$this->extension = image_type_to_extension($type);
			}
		}



		if (!empty($src) && !empty($dst) && !empty($data)) {
			switch ($this->type) {
				case IMAGETYPE_GIF:

					$src_img = imagecreatefromgif($src);
					break;

				case IMAGETYPE_JPEG:

					$src_img = imagecreatefromjpeg($src);
					break;

				case IMAGETYPE_PNG:
					$src_img = imagecreatefrompng($src);
					break;
			}

			if (!$src_img) {
				$this->msg =  array('status' => 'failed', 'message' => "Failed to read the image file");;
				return;
			}

			$size = getimagesize($src);
			$size_w = $size[0]; // natural width
			$size_h = $size[1]; // natural height



			$src_img_w = $size_w;
			$src_img_h = $size_h;

			$degrees = $data->rotate;

			// Rotate the source image
			if (is_numeric($degrees) && $degrees != 0) {
				// PHP's degrees is opposite to CSS's degrees
				$new_img = imagerotate($src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127));

				imagedestroy($src_img);
				$src_img = $new_img;

				$deg = abs($degrees) % 180;
				$arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

				$src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
				$src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

				// Fix rotated image miss 1px issue when degrees < 0
				$src_img_w -= 1;
				$src_img_h -= 1;
			}

			$tmp_img_w = $data->width;
			$tmp_img_h = $data->height;
			$dst_img_w =  $data->cropW;
			$dst_img_h =  $data->cropH;

			$src_x = $data->x;
			$src_y = $data->y;

			if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
				$src_x = $src_w = $dst_x = $dst_w = 0;
			} else if ($src_x <= 0) {
				$dst_x = -$src_x;
				$src_x = 0;
				$src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
			} else if ($src_x <= $src_img_w) {
				$dst_x = 0;
				$src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
			}

			if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
				$src_y = $src_h = $dst_y = $dst_h = 0;
			} else if ($src_y <= 0) {
				$dst_y = -$src_y;
				$src_y = 0;
				$src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
			} else if ($src_y <= $src_img_h) {
				$dst_y = 0;
				$src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
			}

			// Scale to destination position and size
			$ratio = $tmp_img_w / $dst_img_w;
			$dst_x /= $ratio;
			$dst_y /= $ratio;
			$dst_w /= $ratio;
			$dst_h /= $ratio;

			$dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

			// Add transparent background to destination image
			if ($this->type ==  IMAGETYPE_PNG) {
				imageAlphaBlending($dst_img, false);
				imageSaveAlpha($dst_img, true);
				imagefilledrectangle($dst_img, 0, 0, $dst_img_w, $dst_img_h, imagecolorallocate($dst_img, 255, 255, 255));
			}

			$result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);


			if ($result) {
				if (!imagejpeg($dst_img, $dst, '100')) {
					return     array('status' => 'failed', 'message' => 'unable to save');
				} else {
					$ext  = pathinfo($dst, PATHINFO_EXTENSION);
					$file = pathinfo($dst, PATHINFO_FILENAME);
					$image = $file . '.' . $ext;
					$thumbUrl =   Yii::app()->apps->getBaseUrl('timthumb.php') . '?src=' . Yii::app()->apps->getBaseUrl('uploads/posts/' . $image) . '&w=83&h=60&zc=1';
					return array('status' => 'success', 'url' => $image, 'thumbUrl' => $thumbUrl);
				}
			} else {
				return     array('status' => 'failed', 'message' => 'unable to save');
			}

			imagedestroy($src_img);
			imagedestroy($dst_img);
		}
	}
	function randomPassword()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	public function  processAppleLogin()
	{
		Yii::import('common.vendors.tokens.jwt.src.*');
		Yii::import('common.vendors.tokens.jwt.src.BeforeValidException');
		Yii::import('common.vendors.tokens.jwt.src.ExpiredException');
		Yii::import('common.vendors.tokens.jwt.src.SignatureInvalidException');
		Yii::import('common.vendors.tokens.jwt.src.JWT');


		//Yii::setPathOfAlias('JWT',Yii::getPathOfAlias('common.vendors.tokens.jwt.src.JWT'));

		$file =  Yii::getPathOfAlias('root') . '/apps/common/vendors/tokens/jwt/src/JWT.php';
		require_once($file);

		$key = "-----BEGIN PRIVATE KEY-----
MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQgMAwzW2kJhBy1RDVE
ppKGBOPqieosuYjo9SuVnUT0k06gCgYIKoZIzj0DAQehRANCAATXszxbjZU2gNZm
s2FNOjcebTWwnUuD+McxR+MzyRJsNAtz6HV6p3BEsuObcRHgGlFZiK8rZwOEIuKa
Jq4pd48R
-----END PRIVATE KEY-----";
		$session_state = '121-aarab';
		$client_id = 'com.arabavenue.login';
		$redirect_uri = 'https://www.arabavenue.com/site/login/service/apple';

		if (isset($_POST['code'])) {

			$client_secret = JWT::encode([
				'iss' => '4BSD93T97N',
				'iat' => time(),
				'exp' => time() + 3600,
				'aud' => 'https://appleid.apple.com',
				'sub' => 'com.arabavenue.login',
			], $key, 'ES256', 'J364PHNU4P', array('kid' => 'J364PHNU4P', 'alg' => 'ES256'));
			if ($session_state != $_POST['state']) {
				die('Authorization server returned an invalid state parameter');
			}

			// Token endpoint docs: 
			// https://developer.apple.com/documentation/signinwithapplerestapi/generate_and_validate_tokens

			$response = $this->http('https://appleid.apple.com/auth/token', [
				'grant_type' => 'authorization_code',
				'code' => $_POST['code'],
				'redirect_uri' => $redirect_uri,
				'client_id' => $client_id,
				'client_secret' => $client_secret,
			]);


			$error = '';
			if (!isset($response->access_token)) {
				$error .= '<p>Error getting an access token:</p>';
				$error .= '<pre>';
				print_r($response);
				echo '</pre>';
				$error .= '<p><a href="/">Start Over</a></p>';
				echo '<script>alert("' . $error . '.")</script>';
				die();
			} else {
				$claims = explode('.', $response->id_token)[1];
				$claims = json_decode(base64_decode($claims));

				if (isset($claims->email)) {

					$this->loginApple($claims->email);
				} else {
					echo '<script>alert("Not Receiving Registered Email Address From your account.")</script>';
					die();
				}
			}

			die();
		}




		//Yii::app()->user->setState("session_state", $session_state);
		$authorize_url = 'https://appleid.apple.com/auth/authorize' . '?' . http_build_query([
			'response_type' => 'code',
			'response_mode' => 'form_post',
			'client_id' => $client_id,
			'redirect_uri' => $redirect_uri,
			'state' => $session_state,
			'scope' => 'name email',
		]);
		$authorize_url = Yii::t('app', $authorize_url, array('name+email' => 'email%20name'));
		$this->redirect($authorize_url);
		//echo '<a href="'.$authorize_url.'">Sign In with Apple</a>';
		exit;
		echo 'processs apple login';
		exit;
	}
	public function loginApple($email = null)
	{
		if (!empty($email)) {
			$model = new ListingUsers();
			$registered = $model->findByEmail($email);
			if ($registered) {

				$identity = new UserIdentity($email, null);
				$identity->impersonate = true;
				if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
					echo '<script>alert("Unable to login.")</script>';
					die();
				} else {
					$this->redirect($this->app->createUrl('member/dashboard'));
				}
			} else {

				$first_name =  'AppleUser';
				$password = $this->randomPassword();
				$subscriber  = new ListingUsers();
				$subscriber->first_name  = $first_name;
				$subscriber->email  = $email;
				$subscriber->email_verified = '1';
				$subscriber->o_verified = '0';
				$subscriber->enable_l_f = '0';
				$subscriber->user_type  = 'U';
				$subscriber->o_skipped  = '1';
				$password = $this->randomPassword();
				$subscriber->password  = $password;
				$subscriber->con_password  = $password;
				$subscriber->scenario  = 'new_update2';
				$subscriber->otp_login =  rand(1000, 9999);
				if (!$subscriber->save()) {
					echo '<script>alert("' . CHtml::errorSummary($subscriber) . '")</script>';
					die();
				} else {
					$subscriber->WelcomeEmail;
					$identity = new UserIdentity($subscriber->email, null);
					$identity->impersonate = true;
					if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
						echo '<script>alert("Unable to login.")</script>';
						die();
					} else {
						$this->redirect($this->app->createUrl('member/dashboard'));
					}
				}
			}
		} else {
			echo '<script>alert("Not Receiving Registered Email Address From your account.")</script>';
			die();
		}
	}
	function http($url, $params = false)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if ($params)
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Accept: application/json',
			'User-Agent: curl', # Apple requires a user agent header at the token endpoint
		]);
		$response = curl_exec($ch);
		return json_decode($response);
	}

	public function actionLogin()
	{
		$serviceName = Yii::app()->request->getQuery('service');


		if (isset($serviceName)) {
			/** @var $eauth EAuthServiceBase */
			switch ($serviceName) {
				case 'google_oauth':
					$componentArray = array(
						'client_id'		=>		 Yii::app()->options->get('system.common.google_app_id', ''),
						'client_secret'	=>		Yii::app()->options->get('system.common.google_client_secret', ''),
						//	'scope' => 'https://www.googleapis.com/auth/userinfo.profile',

					);
					$first_name1 = 'GoogleUser';
					break;
				case 'facebook':
					$componentArray = array(
						'client_id'		=>		 Yii::app()->options->get('system.common.facebook_app_id', ''),
						'client_secret'	=>		Yii::app()->options->get('system.common.facebook_seceret_key', '')

					);
					$first_name1 = 'FbUser';
					break;
				case 'apple':
					$this->processAppleLogin();
					exit;
					break;
			}
			/** @var $eauth EAuthServiceBase */
			$eauth = Yii::app()->eauth->getIdentity($serviceName, $componentArray);
			$eauth->redirectUrl = $this->createAbsoluteUrl('site/login') . '?service=$serviceName';
			$eauth->cancelUrl = $this->createAbsoluteUrl('user/signin');

			try {
				if ($eauth->authenticate()) {
					$eauth->redirectUrl =   Yii::app()->createAbsoluteUrl('member/dashboard');

					if (isset($eauth->email)) {
						$model = new ListingUsers();
						$registered = $model->findByEmail($eauth->email);


						if ($registered) {
							$identity = new UserIdentity($registered->email, null);
							$identity->impersonate = true;
							if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
								echo '<script>alert("Unable to login.")</script>';
								$eauth->cancel();
							} else {
								$this->redirect($this->app->createUrl('member/dashboard'));
							}
						} else {
							if (empty($eauth->name)) {
								$first_name = explode('@', $eauth->email);
								if (isset($first_name['0'])) {
									$first_name = $first_name['0'];
								} else {
									$first_name = 'GoogleUser';
								}
								if (!preg_match("/^([a-zA-Z' ]+)$/", $first_name)) {
									$first_name = $first_name1;
								}
							} else {
								$first_name = $eauth->name;
							}
							$password = $this->randomPassword();
							$subscriber  = new ListingUsers();
							$subscriber->first_name  = $first_name;
							$subscriber->email  = $eauth->email;
							$subscriber->email_verified = '1';
							$subscriber->o_verified = '0';
							$subscriber->enable_l_f = '0';
							$subscriber->user_type  = 'U';
							$subscriber->o_skipped  = '1';
							$password = $this->randomPassword();
							$subscriber->password  = $password;
							$subscriber->con_password  = $password;
							$subscriber->scenario  = 'new_update2';
							$subscriber->otp_login =  rand(1000, 9999);
							if (!$subscriber->save()) {
								echo '<script>alert("' . CHtml::errorSummary($subscriber) . '")</script>';
								$eauth->cancel();
							} else {
								$subscriber->WelcomeEmail;
								$identity = new UserIdentity($subscriber->email, null);
								$identity->impersonate = true;
								if (!$identity->authenticate() || !Yii::app()->user->login($identity)) {
									echo '<script>alert("Unable to login.")</script>';
									$eauth->cancel();
								} else {
									$this->redirect($this->app->createUrl('member/dashboard'));
								}
							}
						}
					} else {

						echo '<script>alert("Not Receiving Registered Email Address From your account.")</script>';
						$eauth->cancel();
					}
				}

				// Something went wrong, redirect to login page
				$this->redirect(array('site/login'));
			} catch (EAuthException $e) {
				// save authentication error to session
				Yii::app()->user->setFlash('error', 'EAuthException: ' . $e->getMessage());

				// close popup window and redirect to cancelUrl
				$eauth->redirect($eauth->getCancelUrl());
			}
		}

		// default authorization code through login/password ..
	}
	public function actionLoadCityByCountry($country_id = null)
	{
		$data = States::model()->findListingCountries($country_id);
		$html = '<option value="">Select Region</option>';
		if ($data) {
			foreach ($data as $k => $v) {
				$html .= '<option value="' . $v->slug . '">' . $v->state_name . '</option>';
			}
		}
		echo $html;
		Yii::app()->end();
	}

	public function actionFeaturedAgentsList($country_id = null, $state_id = null, $limit = 10, $offset = 0, $logged_in = null, $show_all = null, $keyword = null, $suggested = null, $t_s_a = null, $e_s_m = null, $t_r_a = null)
	{
		$agentData = array();
		if (!empty($state_id)) {
			$agentData['agent_regi'] = $state_id;
		}
		if (!empty($country_id)) {
			$agentData['country_id'] = $country_id;
		}
		if (!empty($keyword)) {
			$agentData['property'] = $keyword;
		}
		$criteria = ListingUsers::model()->findAgents($agentData, $count_future = false, $user_type = 'A', $return = 1);
		if (!empty($suggested)) {
			$criteria->join .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tgid ';
			$criteria->params[':tgid'] = ListingUsers::RECOMANDED_AGENTS;
		} else if (!empty($t_s_a)) {
			$criteria->join .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tgid ';
			$criteria->params[':tgid'] = ListingUsers::TOP_SALE_AGENT;
		} else if (!empty($e_s_m)) {

			$criteria->join .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tgid ';
			$criteria->params[':tgid'] = ListingUsers::EXPERIENCED_S_MANAGERS;
		} else if (!empty($t_r_a)) {
			$criteria->join .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tgid ';
			$criteria->params[':tgid'] = ListingUsers::TOP_RENT_AGENTS;
		} else if (empty($show_all)) {
			$criteria->join .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tgid ';
			$criteria->params[':tgid'] = ListingUsers::FEATURED_AGENT;
		}

		if (!empty($logged_in)) {
			$criteria->select .= ' ,uf.follow as follow ';
			$criteria->join  .= ' left join {{user_follow}} uf ON uf.follow = t.user_id and uf.followed_by =:user_me';
			$criteria->params[':user_me'] = $logged_in;
		}

		$criteria->limit =  $limit;
		$criteria->offset = $offset;

		$order = '';
		if (!empty($country_id)) {
			$order .= ' t.country_id = "' . (int) $country_id . '" desc , ';
		}
		$field = Agents::model()->findAll($criteria);



		if (!empty($field)) {
			$agent_list = array();
			foreach ($field as $k => $v) {
				$agent_list[] = array('user_id' => $v->user_id, 'designation' => $this->checkEmpty($v->designation), 'nationality' => $this->checkEmpty($v->country_name), 'full_name' => $v->fullName, 'image' => Yii::app()->apps->getBaseUrl('uploads/images/' . $v->image, true), 'is_user_follow' => array('label' => empty($v->follow) ? 'Follow' : 'Following', 'value' =>  empty($v->follow) ? 0 : 1));
			}

			echo $this->generateOutPut('SUCCESS', '1', '', $agent_list);
		} else {
			echo $this->generateOutPut('FAILED', '0', 'No Agents Found', array(), '', 'Featured Agents');
		}
		Yii::app()->end();
	}

	public function actionLoad_city($state = null)
	{


		$limit = 30;
		$criteria = new CDbCriteria;
		$criteria->compare('city_name', Yii::app()->request->getQuery('q'), true);
		$criteria->join .= ' INNER JOIN {{states}} st on st.state_id = t.state_id  ';

		$criteria->compare('st.slug', $state);

		$criteria->select = 't.city_id,city_name';
		$count = City::model()->count($criteria);
		$criteria->order = 'city_name ASC';
		$criteria->limit   =  $limit;
		$page = Yii::app()->request->getQuery('page', 1);

		$offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset;

		$data = City::model()->findAll($criteria);
		$ar = array();
		if ($data) {
			foreach ($data as $k => $v) {

				$ar[] = array('id' => $v->city_id, 'text' => '<span>   ' . $v->city_name . '</span>');
			}
		}
		$record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
		echo  json_encode($record);
		Yii::app()->end();
	}
	public function actionLoad_category_url($listing_type = null)
	{
		$html =  ' <div class="miniCol12 smlCol24">';
		$categories =   Category::model()->ListDataForJSON_ID_BySEctionNewModel($listing_type);

		foreach ($categories as $k => $v) {
			$title_h = !empty($v->category_other) ? $v->category_other : $v->category_name;
			$html .= '<div class="pbs"><span class="fieldItem checkbox"><input id="homeType' . $v->category_id . '"  class="h_type" name="type_of[]" ';
			$html .= 'value="' . $v->category_id . '" type="checkbox"><label for="homeType' . $v->category_id . '">' . $title_h . '</label></span></div>';
		}
		$html .= '</div>';
		echo $html;
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
	public function actionSelect_city_new($id = null)
	{
		$html = '<option value="">Select City</option>';
		$states = States::model()->AllStatesOfCountry((int) $id);


		if (!empty($states)) {
			foreach ($states as $k) {
				$html .= '<option value="' . $k->state_id . '">' . $k->state_name . '</option>';
			}
		}
		echo json_encode(array('data' => $html, 'size' => sizeOf($states)));
	}
	public function actionCustomer($user_type = null)
	{
		$limit = 30;
		$request = Yii::app()->request;
		$criteria = new CDbCriteria;
		$criteria->select = 't.company_name,t.slug';
		$criteria->compare('t.company_name', $request->getQuery('q'), true);

		$criteria->compare('t.isTrash', '0');
		$criteria->compare('t.status', 'A');
		$criteria->compare('t.user_type', $user_type);
		$criteria->compare('t.user_type!', 'U');
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

				$name  = $v->company_name;

				$ar[] = array('id' => $v->slug, 'text' => $name);
			}
		}
		$record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
		echo  json_encode($record);
		Yii::app()->end();
	}

	public function actiongetListAccounts()
	{
		$inivitation_criteria = ListingUsers::model()->search_company_approved_cron();
		$inivitation_criteria->offset = 0;
		$inivitation_criteria->limit = 50;
		$inivitation		   = ListingUsers::model()->findAll($inivitation_criteria);

		print_r($inivitation);
		exit;
	}
	public function actionChange_area_unit($unit = null)
	{
		$request = Yii::app()->request;
		$unitModel = AreaUnit::model()->findByPk($unit);
		if (empty($unitModel)) {
			throw new CHttpException(404, Yii::t('app', 'The corrency code    does not exist.'));
		}
		unset(Yii::app()->request->cookies['area_unit']);
		$cookie = new CHttpCookie('area_unit', $unit);
		$cookie->expire = time() + 60 * 60 * 24 * 180;
		Yii::app()->request->cookies['area_unit'] = $cookie;
		$defaultReturn = $request->getServer('HTTP_REFERER', array('site/index'));
		$this->redirect($request->getPost('returnUrl', $defaultReturn));
	}
	public function actionChange_currency($id = null)
	{
		$request = Yii::app()->request;
		if (!isset($this->currencies[$id])) {
			throw new CHttpException(503, 'Selected currency not defined');
		}

		$unit = $id;
		unset(Yii::app()->request->cookies['currency_id' . COUNTRY_ID]);
		$cookie = new CHttpCookie('currency_id' . COUNTRY_ID, $unit);
		$cookie->expire = time() + 60 * 60 * 24 * 180;
		Yii::app()->request->cookies['currency_id' . COUNTRY_ID] = $cookie;
		$defaultReturn = $request->getServer('HTTP_REFERER', array('site/index'));
		$this->redirect($request->getPost('returnUrl', $defaultReturn));
	}
	public function actionSelect_location2($id = null)
	{
		$idModel = States::model()->findByAttributes(array('slug' => $id, 'country_id' => $this->project_country_id));
		if (!empty($idModel)) {
			$id = $idModel->state_id;
		} else {
			$id = '';
		}
		$html = '<option value="">Type your  Location</option>';
		$states = City::model()->FindCities((int) $id);


		if (!empty($states)) {
			foreach ($states as $k) {
				$html .= '<option value="' . $k->slug . '">' . $k->city_name . '</option>';
			}
		}
		echo json_encode(array('data' => $html, 'size' => sizeOf($states)));
	}
	public function actionCheck_wilio()
	{
		require Yii::getPathOfAlias('common') . '/extensions/twi/Services/Twilio.php';


		$sid = Yii::app()->options->get('system.common.twilio_sid', '');; // Your Account SID from www.twilio.com/user/account
		$token = Yii::app()->options->get('system.common.twilio_token', ''); // Your Auth Token from www.twilio.com/user/account
		$phone = '+1 205 843 6932'; // Your Auth Token from www.twilio.com/user/account

		$client = new Services_Twilio($sid, $token);
		$message = $client->account->sms_messages->create(
			$phone, // From a valid Twilio number
			'+919544023086', // Text this number
			"Your Login Code " . rand(1000, 9999)
		);
		echo "WER";
		exit;
		print_r($message);
		exit;
	}
	public function actionDownload_profile($file = null)
	{
		if (empty($file)) {
			throw new CHttpException(503, 'Not found file');
		}
		$filepath = 'uploads/images/' . base64_decode($file);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		flush(); // Flush system output buffer
		readfile($filepath);
		die();
	}
	//	Yii::app()->cache->flush();
	/* 	

	require Yii::getPathOfAlias('common'). '/extensions/twi/Services/Twilio.php';


	$sid = Yii::app()->options->get('system.common.twilio_sid','');; // Your Account SID from www.twilio.com/user/account
	$token = Yii::app()->options->get('system.common.twilio_token','');// Your Auth Token from www.twilio.com/user/account
	$phone = Yii::app()->options->get('system.common.twilio_phone','');// Your Auth Token from www.twilio.com/user/account

	$client = new Services_Twilio($sid, $token);
	$message = $client->account->sms_messages->create(
	$phone, // From a valid Twilio number
	'+918714313483', // Text this number
	"Hello world! This is admin, testing our twilio api"
	);
	echo "WER";exit; 
	print_r($message);exit; 
	*/
	public function actionAccept_cookie()
	{
		$cookie = new CHttpCookie('cookie_accepted', '1');
		$cookie->expire = time() + 60 * 60 * 24 * 360;
		Yii::app()->request->cookies['cookie_accepted'] = $cookie;
		if (!Yii::app()->request->isAjaxRequest) {
			$this->redirect(Yii::app()->createUrl('site/index'));
		} else {
			echo 1;
			exit;
		}
	}
	public function actionGenerateLink()
	{
	  
		$criteria = new CDbCriteria;
		$criteria->compare('f_type', 'FL');
		$criteria->compare('parent_master', '13');
		$data = FooterLinks::model()->findAll($criteria);


		foreach ($data as $k2 => $v2) {
			if (!empty($v2->title)) {
				print_r($v2->title);
				$Ar = json_decode($v2->master_array);


				$sec_slug = '';
				$cat_slug = '';
				$state_slug = '';

				switch ($Ar->section_id) {
					case '1':
						$sec_slug = SALE_SLUG;
						break;
					case '2':
						$sec_slug = RENT_SLUG;
						break;
				}

				if (isset($Ar->category_id)) {
					$catModel = Category::model()->findByPk($Ar->category_id);
					if ($catModel) {
						$cat_slug =  $catModel->slug;
					}
				}
				$city = strtolower(Yii::t('app', $v2->title, array('Houses to rent in ' => '')));


				if (isset($city)) {
					$criteria = new CDbCriteria;
					$criteria->compare('state_name', $city, true);
					$catModel = States::model()->find($criteria);
					if ($catModel) {
						$state_slug =  $catModel->slug;
					}
				}

				$url  =   Yii::app()->createUrl('listing/index', array('sec' => $sec_slug, 'type_of' => $cat_slug, 'state' => $state_slug));
				echo $url;
				$v2->updateByPk($v2->master_id, array('master_generated' =>	$url));

				echo "<br />";
			}
		};



		exit;
	}
	public function actionFile_download()
	{

		$file = file_get_contents('https://apollo-singapore.akamaized.net:443/v1/files/tu8ss6mdqueb1-PK/image');
		print_r($file);
		exit;
	}
	public function actionSetview_list($val = null)
	{
		$request = Yii::app()->request;
		if (in_array($val, array('list', 'grid', 'map'))) {
			$cookie = new CHttpCookie('list_view', $val);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			$request->cookies['list_view'] = $cookie;
		}
		exit;
	}
	public static  function htmlHead($uid)
	{
		$dir = LANGUAGE == 'ar'  ? 'dir="rtl"' : 'dir="ltr"';
		$html =  '<html  ><head><title>' . Yii::app()->tags->getTag('invoice', 'Invoice') . ' - ' . $uid . '</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/></head><body  >';
		return $html;
	}
	public static function bodyClose()
	{
		return ' </body></html> ';
	}
	const PAPER_WIDTH = '576';
	const PAPER_HEIGHT = '784';
	public   function actionPdf($order_uid = null)
	{


		$order_uid = base64_decode($order_uid);

		$model = PricePlanOrder::model()->findByPk($order_uid);
		if (empty($model)) {
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		require_once('/home/fpibkbmy/public_html/apps/common/extensions/tcpdf-main/tcpdf.php');
		//Yii::import('common.extensions.tcpdf-main.tcpdf.*');


		//print_r($_POST);

		$html = $this->renderPartial('_new_invoice', compact('model'), true, true);



		//content

		//end content
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set default monospaced font
		// set margins
		$pdf->SetMargins(-1, 0, -1);
		// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set default font subsetting mode
		$pdf->setFontSubsetting(true);
		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		//$fontname = TCPDF_FONTS::addTTFfont('ubuntu.ttf', 'TrueTypeUnicode', '', 96);
		//$fontbold = TCPDF_FONTS::addTTFfont('ubuntuB.ttf', 'TrueTypeUnicode', '', 96);

		if (LANGUAGE == 'ar') {
			$pdf->setLanguageArray($lg);
			$pdf->SetFont('dejavusans', '', 10);
			$pdf->setRTL(true);

			$pdf->setImageScale(1);
		} else {
			$pdf->SetFont($fontname, '', 10);
		}
		$pdf->AddPage();
		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
		//$pdf->Output(dirname(__FILE__).'example_001.pdf', 'F');
		$pdf_name = '' . $model->order_uid . time() . '.pdf';
		//$pdf_name = 'test.pdf';
		ob_end_flush();
		//Close and output PDF document
		if (isset($_GET['dw']) and $_GET['dw'] == '1') {
			$pdf->Output($pdf_name, 'D');
		} else {
			$pdf->Output($pdf_name, 'I');
		}
		//Close and output PDF document
		exit;
		Yii::import('common.extensions.dompdf.*');
		require_once(Yii::getPathOfAlias('common.extensions') . '/dompdf/dompdf_config.inc.php');
		Yii::registerAutoloader('DOMPDF_autoload');
		$pdf = new DOMPDF(array('isRemoteEnabled' => true));
		$html = self::htmlHead($model->uid);
		//$html .= '<link type="text/css" href="https://www.arabavenue.com/assets/css/pdfn.css?q=4" rel="stylesheet" />';
		if (LANGUAGE == 'ar') {
			$html .=  Yii::app()->controller->renderPartial('root.invoice-4-ar', compact('model', 'title', 'view', 'org', 'title_right', 'title_right_number', 'date', 'signature', 'digital_stamp_logo'), true);;
		} else {
			$html .=  Yii::app()->controller->renderPartial('root.invoice-4', compact('model', 'title', 'view', 'org', 'title_right', 'title_right_number', 'date', 'signature', 'digital_stamp_logo'), true);;
		}
		$html .= self::bodyClose();
		$pdf->load_html($html);
		$customPaper = array(0, 0, self::PAPER_WIDTH, self::PAPER_HEIGHT);
		$pdf->set_paper($customPaper);

		// Render the HTML as PDF
		$pdf->render();

		// Output the generated PDF to Browser
		if (isset($_GET['dw']) and $_GET['dw'] == '1') {
			$pdf->stream($model->order_uid . '.pdf', array("Attachment" => true));
		} else {
			$pdf->stream($model->order_uid . '.pdf', array("Attachment" => false));
		}
		exit;
	}
	public   function actionPdf_contract($f = null)
	{

		if (!empty($f)) {
			if (isset($_GET['dw']) and $_GET['dw'] == '1') {
				$file_url = 'https://www.rgestate.com/uploads/files/' . $f;

				header('Content-Type: application/octet-stream');
				header("Content-Transfer-Encoding: Binary");
				header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
				readfile($file_url);
			} else {

				$filePath = "https://www.rgestate.com/uploads/files/" . $f;
				$filename = $f;
				header('Content-type:application/pdf');
				header('Content-disposition: inline; filename="' . $filename . '"');
				header('content-Transfer-Encoding:binary');
				header('Accept-Ranges:bytes');
				@readfile($filePath);
			}
		}
		exit;
	}
	public function actionChange_country($country_id = null)
	{
		$request = Yii::app()->request;
		$country = Countries::model()->findByAttributes(array('country_id' => $country_id, 'show_on_listing' => '1', 'isTrash' => '0'));
		if (!empty($country)) {
			$cookie = new CHttpCookie('COUNTRY_ID', $country->country_id);
			$cookie->expire = time() + 60 * 60 * 24 * 180;
			Yii::app()->request->cookies['COUNTRY_ID'] = $cookie;
		}

		$defaultReturn = $request->getServer('HTTP_REFERER', array('site/index'));
		$this->redirect($request->getPost('returnUrl', $defaultReturn));
	}
	public function actionChangeLanguage($val = null, $ret = null)
	{
		$request = Yii::app()->request;
		if (!in_array($val, array_keys(OptionCommon::systemLanguages()))) {
			throw new CHttpException(404, Yii::t('app', 'The requested language does not exist.'));
		}
		unset(Yii::app()->request->cookies['lan']);
		$cookie = new CHttpCookie('lan', $val);
		$cookie->expire = time() + 60 * 60 * 24 * 180;
		Yii::app()->request->cookies['lan'] = $cookie;
		if (LANGUAGE == 'en') {
			$defaultReturn = $request->getServer('HTTP_REFERER', array('site/index'));
			$this->redirect(Yii::t('app', $defaultReturn, array(ASKAAN_PATH => ASKAAN_PATH_ar)));
			//$this->redirect( ASKAAN_PATH_ar);
		} else {
			$defaultReturn = $request->getServer('HTTP_REFERER', array('site/index'));
			$this->redirect(Yii::t('app', $defaultReturn, array(ASKAAN_PATH_ar => ASKAAN_PATH)));
			// $this->redirect( ASKAAN_PATH);
		}

		if (!empty($ret)) {
			$retModel = PlaceAnAd::model()->findByPk($ret);
			if (!empty($retModel)) {
				$return =  $retModel->DetailUrl;
				$this->redirect(Yii::t('app', $return, array('/en/' => '/ar/', '/ar/' => '/en/')));
			}
		}
		$defaultReturn = $request->getServer('HTTP_REFERER', array('site/index'));
		$defaultReturn = Yii::t('app', $defaultReturn, array('/en/' => '/ar/', '/ar/' => '/en/'));

		$this->redirect($request->getPost('returnUrl', $defaultReturn));
	}
	public   function actionCareer_file($file = null)
	{

		if (!empty($file)) {
			$f = Yii::t('app', $file, array('|' => '/'));

			$file_url = 'https://www.rgestate.com/uploads/files/' . $f;

			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary");
			header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
			readfile($file_url);
		}
		exit;
	}
	public function actionUpdate()
	{


		$refresh_Ads = PlaceAnAdNew::model()->cronJobs();
		echo sizeOf($refresh_Ads);
		echo "<br />";
		if (!empty($refresh_Ads)) {

			foreach ($refresh_Ads as $k => $v) {
				echo $v->id;
				echo '-';
				echo $v->expire1;
				echo '<br />';
				PlaceAnAd::model()->updateByPk($v->id, array('cron_expiry' => $v->expire1, 'cron_images' => $v->ad_images_g, 'cron_simage' =>   $v->ad_image2, 'cron_arabic' => $v->ad_title2, 'cron_updated' => new CDbExpression('NOW()')));
			}
			echo "updatecontinue";
			exit;
		} else {
			$country = 65949;
			$ttal_for_sale = PlaceAnAdNew::model()->fetchCounter(1, $country);
			//$ttal_for_sale =  ($ttal_for_sale-($ttal_for_sale%10));
			Yii::app()->options->set('system.common.total_for_sale_' . $country, $ttal_for_sale);

			$ttal_for_rent = PlaceAnAdNew::model()->fetchCounter(2, $country);
			//$ttal_for_rent =  ($ttal_for_rent-($ttal_for_rent%10));
			Yii::app()->options->set('system.common.total_for_rent_' . $country, $ttal_for_rent);
			echo "update finished";
			exit;
		}
	}
	public function actionUpdate_property_counter()
	{
		$country = 65949;
		$adModel = new PlaceAnAdNew();
		$adModelCriteria =	$adModel->findAds(array(), false, true);
		$condition = $adModelCriteria->condition;

		$new_homesCritieria         	 =	$adModelCriteria;
		$new_homesCritieria->condition  .= ' and t.section_id = "1" and t.country = :cntt';
		$new_homesCritieria->params[':cntt'] = $country;
		$ttal_for_sale =  $adModel->count($new_homesCritieria);
		$ttal_for_sale =  ($ttal_for_sale - ($ttal_for_sale % 10));
		Yii::app()->options->set('system.common.total_for_sale_' . $country, $ttal_for_sale);

		$new_homesCritieria         	= $adModelCriteria;
		$new_homesCritieria->condition  = $condition;
		$new_homesCritieria->condition  .= ' and t.section_id = "2" and t.country = :cntt';
		$new_homesCritieria->params[':cntt'] = $country;
		$ttal_for_rent = $adModel->count($new_properties_forrent);
		$ttal_for_rent =  ($ttal_for_rent - ($ttal_for_rent % 10));
		Yii::app()->options->set('system.common.total_for_rent_' . $country, $ttal_for_rent);
	}
	public function actionPopulating_data()
	{
 
	    $formData = (array)$_GET;
		$formData = array_filter($formData);
		if (isset($formData['type_of']) and strpos($formData['type_of'], 'business') !== false) {
			define('BUSINESS', '1');
		}


		$adModel = new PlaceAnAdNew();
		

		$htm = '';
		/*
		    if(!isset($formData['reg'])){
		        $htm = $this->renderPartial('_list_cities',compact('formData','adModel'),true,false);
		    }else 
		    
		    _list_location_city =region 
	    */
		if (!isset($formData['state']) && !isset($formData['type_of']) && !isset($formData['sub_category'])) {
			$htm = $this->renderPartial('_list_categories', compact('formData', 'adModel'), true, false);
        } else if (isset($formData['state']) && !isset($formData['type_of']) && !isset($formData['sub_category'])) {
			if (isset($formData['state']) && !in_array(strtolower($formData['state']), array('fujairah', 'umm-al-quwain', 'ras-al-khaimah', 'al-ain', 'ajman', 'sharjah', 'abu-dhabi', 'dubai'))) {
				
				$htm = $this->renderPartial('_list_location_city', compact('formData', 'adModel'), true, false);
            } else {
				
				$htm = $this->renderPartial('_list_categories', compact('formData', 'adModel'), true, false);
            }
        } 
        // else if (!isset($formData['state']) && isset($formData['type_of']) && !isset($formData['sub_category'])) {
			
			// $subCategories = SubCategory::model()->find($fermData['sub_category']);
            // $htm = $this->renderPartial('_list_sub_categories', compact('formData', 'adModel', 'subCategories'), true, false);
			// } 
			else if (isset($formData['state']) && isset($formData['type_of']) && isset($formData['sub_category'])) {
				$htm = $this->renderPartial('_list_location', compact('formData', 'adModel'), true, false);
			} else if (!isset($formData['state']) && isset($formData['type_of']) && !isset($formData['sub_category'])) {
				$htm = $this->renderPartial('_list_location_city', compact('formData', 'adModel'), true, false);
			} else if (isset($formData['state']) && !in_array(strtolower($formData['state']), array('fujairah', 'umm-al-quwain', 'ras-al-khaimah', 'al-ain', 'ajman', 'sharjah', 'abu-dhabi', 'dubai')) && !isset($formData['sub_category'])) {
				// $htm = $this->renderPartial('_list_location_city', compact('formData', 'adModel'), true, false);
				// print_r(5);
        } else {
			$htm = $this->renderPartial('_list_location', compact('formData', 'adModel'), true, false);
        }

		
		    // if( !isset($formData['state'])){
		    //     $htm = $this->renderPartial('_list_location',compact('formData','adModel'),true,false);
		    // }else if(isset($formData['state']) and !isset($formData['type_of'])){
		    //     $htm = $this->renderPartial('_list_categories',compact('formData','adModel'),true,false);
		    // }else if(isset($formData['state']) and in_array($formData['state'],array('fujairah','umm-al-quwain','ras-al-khaimah','al-ain','ajman','sharjah','abu-dhabi','dubai'))){
		    //        $htm = $this->renderPartial('_list_location',compact('formData','adModel'),true,false);
		    // }
		    

		//$htm = $this->renderPartial('_list_categories',compact('new_homes','formData'),true,false);


		//Yii::app()->cache->set($cacheKey, $htm,60 * 15  );
		//print_r(CHtml::listData($new_homes,'category_name','id'));exit;


		if (!empty($htm)) {

			echo json_encode(array('status' => '1', 'html' => $htm));
			exit;
		} else {

			echo   json_encode(array('status' => '0', 'html' => ''));
			exit;
		}


		echo json_encode($data);
		exit;
	}


	public function actionPopulating_data2()
	{

		$formData = (array)$_GET;
		$formData = array_filter($formData);
		if (isset($formData['type_of']) and strpos($formData['type_of'], 'business') !== false) {
			define('BUSINESS', '1');
		}
		$adModel = new BusinessForSale();
		$htm = '';
		/*
		    if(!isset($formData['reg'])){
		        $htm = $this->renderPartial('_list_cities',compact('formData','adModel'),true,false);
		    }else 
		    */
		if (!isset($formData['type_of'])) {
			$htm = $this->renderPartial('_list_categories', compact('formData', 'adModel'), true, false);
		}else if (!isset($formData['sub_category'])) {
			$category = Category::model()->getCategoryFromSlug($formData['type_of']);
            $subCategories = Subcategory::model()->ListDataForCategory($category->category_id);
            if (count($subCategories) > 0){
				$htm = $this->renderPartial('_list_sub_categories', compact('formData', 'adModel', 'subCategories'), true, false);		
            }else {
				$htm = $this->renderPartial('_list_location_business', compact('formData', 'adModel'), true, false);
            }
        }else if (!isset($formData['nested_sub_category'])){
			$htm = $this->renderPartial('_list_nested_sub_categories', compact('formData', 'adModel'), true, false);
        }else if (!isset($formData['state'])) {
			$htm = $this->renderPartial('_list_business_location', compact('formData', 'adModel'), true, false);
		}else if (isset($formData['location'])){
		
		}else {
			$htm = $this->renderPartial('_list_location_business', compact('formData', 'adModel'), true, false);
		}

		//$htm = $this->renderPartial('_list_categories',compact('new_homes','formData'),true,false);


		//Yii::app()->cache->set($cacheKey, $htm,60 * 15  );
		//print_r(CHtml::listData($new_homes,'category_name','id'));exit;


		if (!empty($htm)) {

			echo json_encode(array('status' => '1', 'html' => $htm));
			exit;
		} else {

			echo   json_encode(array('status' => '0', 'html' => ''));
			exit;
		}


		echo json_encode($data);
		exit;
	}

	public function actionGet_property($val = null)
	{
		$request = Yii::app()->request;
		if ($request->isAjaxRequest) {
			define('SHOW_ALL_PROP', '1');
			$adModel = new PlaceAnAdNew();
			$new_homesCritieria =	$adModel->findAds(array(), false, true);

			$new_homesCritieria->condition  .= ' and (t.id =:thisidval or t.RefNo =:thisidval)';
			$new_homesCritieria->params['thisidval'] = $val;

			$property = $adModel->find($new_homesCritieria);
			if (empty($property)) {
				echo json_encode(array('status' => '0'));
				exit;
			} else {
				echo json_encode(array('status' => '1', 'url' => $property->detailUrl));
				exit;
			}
		}
	}
	public function actionSitemap()
	{
		return $this->renderPartial('root.apps.frontend.new-theme.views.sitemap');
	}
	
	public function actionGenerate_sitemap()
	{
		$time_format = date('Y-m-d');
		$path = ASKAAN_PATH;
		$path2  = ASKAAN_PATH_CONTSTANT;
		$constatnts = array(
			'about-us',
			'blogs',
			'contact-us',
			'property-for-sale',
			'property-for-rent',
			'preleased',
			'new-development',
			'business-for-sale',
			'area-guides',
			'choose-your-option',
			'submit/property,',
			'submit-your-requirements',
			'submit/business',
			'submit-new-project',
			'submit-jvproposal',
			'advertise-with-us',
			'terms',
			'privacy',
			'our-partners',

		);
		define('NO_SECTION', 1);
		$adModel = new PlaceAnAdNew();
		$adModelCriteria =	$adModel->findAds(array(), false, true);
		$adModelCriteria->order 		 = 	' t.id desc';
		$adModelCriteria->condition  .= '  and t.section_id   in ("1","2","3" ) ';
		$new_homes =  $adModel->findAll($adModelCriteria);

		$adModel2 = new BusinessForSale();
		$adModelCriteria2 =	$adModel2->findAds(array(), false, true);
		$adModelCriteria2->order 		 = 	' t.id desc';
		$adModelCriteria2->condition  .= '  and t.section_id = "6" ';

		$new_business =  $adModel2->findAll($adModelCriteria2);



		$categories = MainCategory::model()->findProperties_category();
		$cities =  States::model()->getAllCommunitiesPostedAd();

		$properties_sec = array('for=sale', 'to-rent');

		$html = '<?xml version="1.0" encoding="UTF-8"?>
            <urlset
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
            ';
		$html .= '
            <url>
            <loc>' . $path . '</loc>
            <lastmod>' . $time_format . '</lastmod>
            <priority>1.00</priority>
            </url>
            ';
		foreach ($constatnts as $urls) {
			$html .= '
            <url>
            <loc>' . $path . $urls . '</loc>
            <lastmod>' . $time_format . '</lastmod>
            <priority>0.80</priority>
            </url>';
		}

		//SALE_RENT PROPERTIES
		$sec_list = array('for-sale', 'to-rent');
		foreach ($sec_list as $sec) {
			foreach ($categories as $itm) {

				$url = $this->app->createUrl('listing/index', array('sec' => $sec, 'category' => $itm['slug']));
				$html .= '
                <url>
                <loc>' . $path2 . $url . '</loc>
                <lastmod>' . $time_format . '</lastmod>
                <priority>0.80</priority>
                </url>';
				if (isset($itm['items'])) {
					foreach ($itm['items'] as $itm_sub) {
						$url = $this->app->createUrl('listing/index', array('sec' => $sec, 'type_of' => $itm_sub));
						$url2 = $this->app->createUrl('listing/index', array('sec' => $sec, 'category' => $itm['slug'], 'type_of' => $itm_sub));

						$html .= '
                            <url>
                            <loc>' . $path2 . $url . '</loc>
                            <lastmod>' . $time_format . '</lastmod>
                            <priority>0.80</priority>
                            </url>';
						$html .= '
                            <url>
                            <loc>' . $path2 . $url2 . '</loc>
                            <lastmod>' . $time_format . '</lastmod>
                            <priority>0.80</priority>
                            </url>';

						foreach ($cities['region'] as $region) {
							$url = $this->app->createUrl('listing/index', array('sec' => $sec, 'type_of' => $itm_sub, 'state' => $region));
							$html .= '
                            <url>
                            <loc>' . $path2 . $url . '</loc>
                            <lastmod>' . $time_format . '</lastmod>
                            <priority>0.80</priority>
                            </url>';
						}
						foreach ($cities['community'] as $region) {
							$url = $this->app->createUrl('listing/index', array('sec' => $sec, 'type_of' => $itm_sub, 'state' => $region));
							$html .= '
                            <url>
                            <loc>' . $path2 . $url . '</loc>
                            <lastmod>' . $time_format . '</lastmod>
                            <priority>0.80</priority>
                            </url>';
						}
					}
				}
			}
		}


		//DETAIL_PAGES
		if (!empty($new_homes)) {
			foreach ($new_homes as $k => $v) {
				$urls = $v->detailUrl;
				$html .= '
                            <url>
                            <loc>' . $path2 . $urls . '</loc>
                            <lastmod>' . $time_format . '</lastmod>
                            <priority>0.80</priority>
                            </url>';
			}
		}


		if (!empty($new_business)) {
			foreach ($new_business as $k => $v) {
				$urls = $v->detailUrl;
				$html .= '
                            <url>
                            <loc>' . $path2 . $urls . '</loc>
                            <lastmod>' . $time_format . '</lastmod>
                            <priority>0.80</priority>
                            </url>';
			}
		}
		$html .= '</urlset>';
		$path_file =  Yii::getPathOfAlias('root');
		$img = 'sitemap.xml';
		file_put_contents($path_file . "/{$img}", $html);
		echo 'updated XML';
	}
	public function actionSubmit() {
		$request = Yii::app()->request;
		$model = new ContactUs();
	
		// Check if it's a POST request
		if ($request->isPostRequest) {
			// Get form data directly from POST
			$name = $request->getPost('name');
			$email = $request->getPost('email');
			$contact = $request->getPost('contact'); 
			$message = $request->getPost('message');
	
			// Check if required fields are provided
			if (empty($name) || empty($email) || empty($contact) || empty($message)) {
				echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
				Yii::app()->end();
			}
	
			// CRM URL to get customer details
			$createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';
	
			// Prepare customer data
			$nameParts = explode(' ', $name);
			$firstName = $nameParts[0] ?? null;
			$lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : null; // Handle last name correctly
	
			$crmCustomerData = [
				'fields' => [
					'NAME' => $firstName,
					'SECOND_NAME' => $lastName,
					'TYPE_ID' => 'CLIENT',
					'SOURCE_ID' => 'SELF',
					'EMAIL' => [['VALUE' => $email, 'VALUE_TYPE' => 'WORK']],
					'PHONE' => [['VALUE' => $contact, 'VALUE_TYPE' => 'WORK']],
				]
			];
	
			// Send customer creation request
			$postCustomerData = http_build_query($crmCustomerData);
			$contextCustomerOptions = [
				'http' => [
					'method' => 'POST',
					'header' => 'Content-Type: application/x-www-form-urlencoded',
					'content' => $postCustomerData,
				]
			];
			$contextCreateCustomer = stream_context_create($contextCustomerOptions);
	
			try {
				$data = file_get_contents($createCustomerUrl, false, $contextCreateCustomer);
				$response = json_decode($data, true);
				$customerId = $response['result'] ?? null; // Get customer ID from response
				if (!$customerId) {
					throw new Exception('Failed to create customer in CRM.');
				}
			} catch (Exception $e) {
				echo json_encode(['status' => 'error', 'message' => 'Unable to create customer.']);
				Yii::app()->end();
			}
	
			// CRM URL to create a new lead
			$crmUrl = 'https://crm.rgestate.com/rest/88/x0g9p2hpse2h48si/crm.lead.add.json';
	
			// Prepare lead data
			$crmData = [
				'FIELDS' => [
					'TITLE' => 'RGestate Lead - Contact Form',
					'CATEGORY_ID' => 16,
					'LEAD_PHONE' => $contact,
					'LEAD_LAST_NAME' => $lastName,
					'LEAD_NAME' => $firstName,
					'LEAD_EMAIL' => $email,
					'CONTACT_ID' => $customerId,
					'COMMENTS' => $message,
					'ASSIGNED_BY_ID' => 22,
				]
			];
	
			// Send lead creation request
			$postData = http_build_query($crmData);
			$contextOptions = [
				'http' => [
					'method' => 'POST',
					'header' => 'Content-Type: application/x-www-form-urlencoded',
					'content' => $postData,
				]
			];
			$context = stream_context_create($contextOptions);
	
			try {
				file_get_contents($crmUrl, false, $context);
			} catch (Exception $e) {
				echo json_encode(['status' => 'error', 'message' => 'Unable to create lead.']);
				Yii::app()->end();
			}
			$model->attributes = $_POST; 
			// Set model attributes and save
			$model->name = $name; // Set other attributes as necessary
			$model->email = $email;
			$model->phone = $contact;
			$model->phone_false = $contact;
			$model->meassage = $message;
	
			// Save the model and return the success or error message
			if ($model->validate() && $model->save()) {
				echo json_encode(['status' => 'success', 'message' => 'Successfully submitted.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Error: ' . CHtml::errorSummary($model)]);
			}
	
			Yii::app()->end();
		} else {
			throw new CHttpException(400, 'Invalid request.');
		}
	}
	
	public function actionSend(){
		$request    = Yii::app()->request;
		$requestParms = $request->getPost("ContactPopup");
		$model  = new ContactPopup();
		if ($request->isPostRequest && ($attributes = (array)$request->getPost($model->modelName, array()))) {
		  $model->attributes = $attributes;
		}
		$createCustomerUrl = 'https://crm.rgestate.com/rest/158/x0g9p2hpse2h48si/crm.contact.add.json';
    	$customerId = 0;	    
        // Prepare data for the request
        $fullName = $requestParms['name'];
        
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
                "EMAIL" => [[ "VALUE" => $requestParms['email'], "VALUE_TYPE" => "WORK" ]],
                "PHONE" => [[ "VALUE" => $requestParms['phone'], "VALUE_TYPE" => "WORK" ]]
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
		$services = [
		    'Real Estate' => '2870',
            'Project Funding' => '2872',
            'Startups Funding' => '2874',
            'Retail Investments' => '2876',
            'Project Development' => '2878',
            'Project Contracting' => '2880',
            'Interior Fitouts' => '2882',
            'Building Maintenance' => '2884',
            'Business Buying & Selling' => '2886',    
		];
		$crmData = [
			'FIELDS' => [
				'TITLE' => 'RGestate Lead - Popup Form',
				'CATEGORY_ID' => 16,
				'ASSIGNED_BY_ID' => 22,
				'CONTACT_ID' => $customerId,
				'COMMENTS' => 'Name: ' . $requestParms['name'] . ' <br/> Phone: ' . $requestParms['phone'] . ' <br/> Email: ' . $requestParms['email'],
				'UF_CRM_1701236145750' => $services[$requestParms['type']],
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
			$response = file_get_contents($crmUrl, false, $context);
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
				echo json_encode(array('status'=>'1','name'=>$model->name , 'msg'=>'<div class="alert alert-success"><strong>Success!</strong> Succesfully submited. </div>'));
			}
		}
	
        // End the request to prevent any further output
        Yii::app()->end();
	}
}
