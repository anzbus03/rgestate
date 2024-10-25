<?php

/**
 * This is the model class for table "mw_place_an_ad".
 *
 * The followings are the available columns in table 'mw_place_an_ad':a
 * @property integer $id
 * @property integer $section_id
 * @property integer $category_id
 * @property integer $sub_category_id
 * @property string $ad_title
 * @property string $ad_description
 * @property integer $engine_size
 * @property string $killometer
 * @property integer $model
 * @property string $price
 * @property string $year
 * @property integer $city
 * @property integer $neighbourhood
 * @property string $mobile_number
 * @property integer $employment_type
 * @property string $compensation
 * @property integer $education_level
 * @property integer $experience_level
 * @property string $skills
 * @property string $area
 * @property integer $bathrooms
 * @property integer $bedrooms
 * @property integer $user_id
 * @property string $added_date
 * @property string $modified_date
 * @property integer $priority
 * @property string $isTrash
 * @property string $status
 * @property string $slug
 */ 
class PlaceAnAd extends ActiveRecord
{
	public $amenities;
	public $district_name;
	public $enable_l_f;
	public $location;
	public $location_longitude;
	public $location_latitude;
	public $values;
	public $keyword;
	public $name;
	public $email;
	public $user_name;
	public $floor_plan;
	public $no_of_units;
	public $no_of_stories;
	public $car_parking;
	public $kitchen;
	public $city_slug;
	public $hide_new_development;
	public $category_slug;
	public $premium_u;
	public $available_units;
	public $video_urls;
	public $puser_id;
	public $cr_number;
	public $agent_slug;
	public $avg_r;
	public $total_reviews;
	public $company_name_ar;
	public $first_name_ar;
	public $team_manager;
	public $licence_no;
	public $unpublished;
	public $featured_date;
	public $featured;
	public $enter_city;
	public $whatsapp;
	public $f_properties;
	public $startDate;
	public $endDate;
	const FEATURED_CONDITION = " t.isTrash='0' and featured='Y'  and t.status='A'   ";
	const LATEST_CONDITION   = " t.isTrash='0'  and t.status='A'  ";
	const FEATURED_ORDER     = " featured='Y' desc,t.id desc ";
	const LATEST_ORDER       = " t.id desc";
	const SALE_ID      	  = 1;
	const RENT_ID       	  = 2;
	const NEW_ID       	  = 3;
	const APARTMENT_FOR_SALE = 30;
	const APARTMENT_FOR_RENT = 36;
	const WAREHOUSE_ID       = 96;
	const VILLA_FOR_SALE 	  = 31;
	const VILLA_FOR_RENT     = 38;
	const OFFICE_FOR_SALE 	  = 33;
	const OFFICE_FOR_RENT    = 39;
	const COMMON_CONDITION   = " t.isTrash='0' and t.status='A'  ";
	const COMMON_ORDER       = " featured='Y' desc,t.id desc ";
	const BEDROOM_PLUS       = "10";
	const BATHROOM_PLUS      = "3";

	public $_notMadatory;
	public $dynamicArray;
	public $tags_list;
	public $tag_list2;
	public $id2;
	public $a_number;
	public $amenities_fields;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mw_place_an_ad';
	}
	public function getPrimaryField()
	{
		return 'ad_id';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules1 =  array();
		$required = $this->mTag()->getTag('required', 'Required');
		if ($this->dynamic) {

			$rules1[] =   array(array_diff((array)$this->dynamicArray, (array) $this->_notMadatory), 'required', 'message' => $required);
			$rules1[] =   array((array) $this->_notMadatory, 'safe');
		}
		$rules  =  array(
			array('section_id,state, category_id,user_id ,ad_title,ad_description,builtup_area', 'required', 'message' => $required),
			//array('city', 'required','on'=>'new_insert', 'message'=>$required),
			array('ad_description', 'required', 'on' => 'update_content', 'message' => $required),
			array('country,state,city', 'safe', 'on' => 'new_insert'),
			array('price', 'validatePrice'),
			array('availability', 'safe'),
			array('salesman_email', 'email'),
			array('sub_category_id', 'validateSub'),
			array('amenities', 'safe'),
			array('ad_description', 'validateDescription'),
			array('mobile_number', 'validatePhone'),
			array('w_for', 'validateSectionValue', 'on' => 'new_insert'),
			array('property_status', 'validatePropertystatus'),
			array('rent_paid', 'validateSectionValue3', 'on' => 'new_insert'),
			array('image', 'validateSectionValue2', 'on' => 'new_insert'),
			array('section_id, category_id, sub_category_id, country, state, city, district,   user_id, priority,    community_id, sub_community_id,RetUnitCategory,income,roi,lease_status', 'numerical', 'integerOnly' => true),
			array('slug,   area_location, property_name, PrimaryUnitView,      FloorNo,        status,     mandate', 'length', 'max' => 250),
			array('ad_title', 'length', 'max' => 200),
			array('ad_title', 'validateTitle'),
			array('contact_person', 'validateContact'),
			array(' currency_abr, area_measurement', 'length', 'max' => 10),
			array('price,income', 'length', 'max' => 14),
			array('roi', 'length', 'max' => 3),
			array('price,RentPerMonth,Rent', 'length', 'max' => 14),
			array('mobile_number', 'length', 'max' => 15),
			array('date_added,pickerDateStartComparisonSign', 'safe'),
			array('landline', 'length', 'max' => 15),
			array('isTrash,  dynamic,    featured, xml_inserted', 'length', 'max' => 1),
			array('location_latitude, location_longitude, salesman_email', 'length', 'max' => 150),
			array('client_ref', 'length', 'max' => 30),
			//array('xml_type', 'length', 'max'=>2),
			//array('xml_reference', 'length', 'max'=>25),
			array('code, RefNo,PropertyID', 'length', 'max' => 20),
			array('plot_area, builtup_area,interior_size', 'numerical'),
			array('video', 'required', 'on' => 'add_youtube', 'message' => $required),
			array('plot_area, builtup_area,interior_size', 'length', 'max' => 10),
			array('parking', 'length', 'max' => 5),
			array('furnished,maid_room', 'length', 'max' => 5),
			array('rera_no', 'length', 'max' => 50),
			array('bedrooms,bathrooms', 'numerical', 'integerOnly' => true),
			array('minPrice,maxPrice,type_of', 'numerical'),
			array('price', 'numerical'),
			array('preleased,submited_by', 'safe'),
			array('dynamicArray', 'unsafe'),
			array('video_urls', 'validateAddVideo'),
			array('is_mor,rights,r_facade,may_affect,disputes,p_limits', 'length', 'max' => 250),
			array('l_no,plan_no,no_of_u,floor_no,unit_no', 'length', 'max' => 20),
			array('ad_images_g,sub_category_id,reference_number,no_image,insert_via,slug_z,verified,location,site,available_units,show_expired,n_send_at,city_location_image,package_used,location_latitude,location_longitude,adv_ch,is_mor,rights,r_facade,may_affect,disputes,p_limits,l_no,plan_no,no_of_u,floor_no,unit_no,expiry_date,selling_price,c_date,unpublished,hot,broker_pad,RefNo,PropertyID,f_properties', 'safe'),
			array('meta_title,meta_description,tag_list2,image,company_name,video,image_status,uid,property_status,p_o_r,user_updated,team_manager,custom_price,xml_update_date', 'safe'),
			array('nearest_metro,nearest_railway,category_name,community_name,country_name,user_name,keyword,maxSqft,minSqft,sort,year_built,floor_plan,listing_type,area_unit,area_unit_1,p_id,p_url', 'safe'),
			array('modified_date, xml_listing_date, xml_update_date, expiry_date,property_overview,LocalAreaAmenitiesDesc,RecommendedProperties,PropertyID,status,rent_paid,name,unsubmited,amenities_fields', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, section_id, category_id, sub_category_id, ad_title, ad_description, price, country, state, city, district, mobile_number, bathrooms, bedrooms, user_id, added_date, modified_date, priority, isTrash, status,occupant_status, slug, image, dynamic, dynamicArray, location_latitude, location_longitude, area_location, xml_inserted, xml_pk, xml_type, xml_reference, xml_listing_date, xml_update_date, code, RefNo, community_id, sub_community_id, property_name, builtup_area, PrimaryUnitView,     FloorNo, HandoverDate,     parking,   salesman_email, expiry_date,       mandate, currency_abr, area_measurement, PDFBrochureLink,property_overview,ReraStrNo,preleased,PropertyID,featured,last_updated', 'safe', 'on' => 'search'),
		);
		return array_merge($rules1, $rules);
	}
	public function validateAddVideo($attribute, $params)
	{
		$post =  Yii::App()->request->getPost('video_urls', array());
		$errorFound = false;
		if (!empty($post)) {


			for ($i = 0; $i < sizeOf($post['title']); $i++) {
				if (empty($post['title'][$i]) ||  empty($post['video'][$i])) {
					$errorFound = true;
				}
			};
			if ($errorFound) {
				$this->addError($attribute,  Yii::t('app', 'Please fill youtube url , videos.', array('{attribute}' => $this->getAttributeLabel($attribute))));
			}
		}
	}
	public function validatePrice($attribute, $params)
	{
		if ($this->p_o_r == '1') {
			return true;
		}

		if (empty($this->$attribute)) {
			$this->addError($attribute,  $this->mTag()->getTag('required', 'Required'));
		}
	}
	public $no_image;
	public function validateSectionValue($attribute, $params)
	{
		if ($this->section_id == '4') {
			if (empty($this->$attribute)) {
				$this->addError($attribute,  Yii::t('app', '{attribute} cannot be blank.', array('{attribute}' => $this->getAttributeLabel($attribute))));
			}
		}
	}
	public function validatePropertystatus($attribute, $params)
	{
		if ($this->property_status == '1') {
			if (empty($this->income)) {
				$this->addError('income',  Yii::t('app', '{attribute} cannot be blank.', array('{attribute}' => $this->getAttributeLabel('income'))));
			}
			if (empty($this->lease_status)) {
				$this->addError('lease_status',  Yii::t('app', '{attribute} cannot be blank.', array('{attribute}' => $this->getAttributeLabel('lease_status'))));
			}
			if (empty($this->roi)) {
				$this->addError('roi',  Yii::t('app', '{attribute} cannot be blank.', array('{attribute}' => $this->getAttributeLabel('roi'))));
			}
		}
	}
	public function validateSub($attribute, $params)
	{
		if ($this->no_image == '1') {
			return true;
		}
		if (defined('PROSPACE')) {
			return true;
		}
		if ($this->category_id == '121' and empty($this->sub_category_id)) {
			/*
			if (empty($this->$attribute)){
				$this->addError($attribute,  Yii::t('app','{attribute} cannot be blank.',array('{attribute}'=>$this->getAttributeLabel($attribute))));
			}
			*/
		}
	}
	public function validateTitle($attribute, $params)
	{
		/*
			 if(preg_match_all('/[0-9]{3}[\-][0-9]{6}|[0-9]{3}[\s][0-9]{6}|[0-9]{3}[\s][0-9]{3}[\s][0-9]{4}|[0-9]{9}|[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}/', $this->ad_title, $matches))
			{
				 $this->addError($attribute,  Yii::t('app','Title contain excessive use of numbers'));
			 } */
	}
	public function validateContact($attribute, $params)
	{
		if (Yii::app()->isAppName('frontend')) {
			if (empty($this->contact_person)) {
				$this->addError('contact_person',  $this->mTag()->getTag('required', 'Required'));
			}
			if (empty($this->salesman_email)) {
				$this->addError('salesman_email',  $this->mTag()->getTag('required', 'Required'));
			}
			if (empty($this->mobile_number)) {
				$this->addError('mobile_number',  $this->mTag()->getTag('required', 'Required'));
			}
		}
	}
	public function validateSectionValue2($attribute, $params)
	{
		if (Yii::app()->isAppName('backend')) {
			return true;
		}
		if ($this->no_image == '1') {
			return true;
		}
		if ($this->section_id != '4') {
			if (empty($this->$attribute)) {
				$this->addError($attribute,  $this->mTag()->getTag('required', 'Required'));
			}
		}
	}
	public function validateSectionValue3($attribute, $params)
	{
		if (Yii::app()->isAppName('backend')) {
			return true;
		}
		if ($this->no_image == '1') {
			return true;
		}
		if ($this->section_id == '2'  and empty($this->p_o_r)) {
			if (empty($this->$attribute)) {
				$this->addError($attribute, $this->mTag()->getTag('required', 'Required'));
			}
		}
	}
	public function dynamicFields()
	{
		return array(
			'builtup_area' => $this->getAttributeLabel('builtup_area'),
			'plot_area' => $this->getAttributeLabel('plot_area'),
			'bathrooms' => $this->getAttributeLabel('bathrooms'),
			'bedrooms' => $this->getAttributeLabel('bedrooms'),
			'price' =>  $this->getAttributeLabel('price'),
			'FloorNo' =>  $this->getAttributeLabel('FloorNo'),
			'total_floor' =>  $this->getAttributeLabel('total_floor'),
			'balconies' =>  $this->getAttributeLabel('balconies'),
			'parking' =>  $this->getAttributeLabel('parking'),
			'PrimaryUnitView' =>  $this->getAttributeLabel('PrimaryUnitView'),
			'construction_status' =>  $this->getAttributeLabel('construction_status'),
			'transaction_type' =>  $this->getAttributeLabel('transaction_type'),
			'furnished' =>  $this->getAttributeLabel('furnished'),
			'maid_room' =>  $this->getAttributeLabel('maid_room'),
			'year_built' =>  $this->getAttributeLabel('year_built'),
			'floor_plan' =>  $this->getAttributeLabel('floor_plan'),
			'rera_no' =>  $this->getAttributeLabel('rera_no'),
		);
	}
	public function getSectionName()
	{
		switch ($this->section_id) {
			case '1':
				return 'Sale';
				break;
			case '2':
				return 'Rent';
				break;
			case '3':
				return 'New Development';
				break;
			default:
				return 'Unknown';
				break;
		}
	}
	public function getPriceTitleArray($code = '')
	{
		return  array('price' => number_format($this->price, 0, '.', ','), 'currency' => $this->currencyTitle, 'paid_on' => $this->section_id == self::RENT_ID ? $this->RentPaid3 : '');
	}
	public function getExcludeArray($fields)
	{
		$ar = $this->dynamicFields();
		if (empty($fields)) {
			return array_keys($ar);
		} else {
			foreach ($fields as $k => $v) {

				if (array_key_exists($k, $ar)) {

					unset($ar[$k]);
				}
			}
			return array_keys($ar);
		}
	}
	public function getExcludeArrayFormArray($fields)
	{
		$ar = $this->dynamicFields();
		if (empty($fields)) {
			return $ar;
		} else {
			foreach ($fields as $k => $v) {

				if (array_key_exists($k, $ar)) {

					unset($ar[$k]);
				}
			}
			return  $ar;
		}
	}
	public function checkFieldsShow($field)
	{

		if (in_array($field, (array)$this->dynamicArray)) {
			return true;
		}
		return false;
	}
	public function checkFieldsShow2($field)
	{

		return true;
	}
	public function notMadatory()
	{
		return array();
		return array(
			'PrimaryUnitView' => 'PrimaryUnitView',
			'community_id' => 'community_id',
			'bathrooms' => 'bathrooms',
			'bedrooms' => 'bedrooms',
			'parking' => 'parking',
			'FloorNo' => 'FloorNo',
			'property_name' => 'property_name',
			'occupant_status' => 'occupant_status',
		);
	}






	public function dynamicFieldsForPropertyForsale()
	{
		return array(
			'section_id' => 'Section',
			'category_id' => 'Category',
			'sub_category_id' => 'Sub Category',
			'body_type' => 'Body Ttype',
			'bodycondition' => 'Body Condition',
			'bedrooms' => 'Bedrooms',
			'compensation' => 'Compensation',
			'current_occupation' => 'Current Occupation',
			'color' => 'Color',
			'cylinders' => 'Cylinders',
			'door' => 'Door',
			'education_level' => 'Education Level',
			'experience_level' => 'Experience Level',
			'employment_type' => 'Employment Type',
			'fuel_type' => 'Fuel Type',
			'height' => 'Height',
			'killometer' => 'Killometer',
			'marital_status' => 'Marital Status',
			'mechanicalcondition' => 'Mechanical Condition',
			'model' => 'Model',
			'mother_tongue' => 'Mother Tongue',
			'price' => 'Price',
			'religion_id' => 'Religion',
			'skills' => 'Skills',
			'year' => 'Year',
			'warranty' => 'Warranty',
			'country_name' => 'City',




		);
	}

	public function place_ad_tag()
	{
		return array(
			'recmnded' => 'Recomanded',
			'super_hot' => 'Super Hot',
			'hot' => 'Hot',

		);
	}
	public function place_ad_tag_code()
	{
		return array(
			'recmnded' => 'REC|blue',
			'super_hot' => 'SHOT|red',
			'hot' => 'HOT|green',

		);
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'adAmenities' => array(self::HAS_MANY, 'AdAmenities', 'ad_id'),
			'AdUnits' => array(self::HAS_MANY, 'PlaceAnAdUnits', 'ad_id'),
			'pCategories' => array(self::HAS_MANY, 'PlaceAnAdCategories', 'ad_id'),
			'pTypes' => array(self::HAS_MANY, 'AdPropertyTypes', 'ad_id'),
			'aVideos' => array(self::HAS_MANY, 'VideoUrs', 'ad_id'),
			'paymentTypes' => array(self::HAS_MANY, 'AdPaymentPlan', 'ad_id'),
			'AdTags' => array(self::HAS_MANY, 'PlaceAdTags', 'ad_id'),
			'adImages' => array(self::HAS_MANY, 'AdImage', 'ad_id', 'on' => "adImages.isTrash='0'"),
			'adFloorPlans' => array(self::HAS_MANY, 'AdFloorPlan', 'ad_id'),
			'adImagesAll' => array(self::HAS_MANY, 'AdImage', 'ad_id'),
			'singleAdImage' => array(self::HAS_ONE, 'AdImage', 'ad_id', 'on' => "singleAdImage.isTrash='0' and singleAdImage.status='A'", "order" => "singleAdImage.priority"),
			'adImagesOnView' => array(self::HAS_MANY, 'AdImage', 'ad_id', 'on' => "adImagesOnView.isTrash='0' and adImagesOnView.status='A'", "order" => "adImagesOnView.priority"),
			'adImagesOnView2' => array(self::HAS_MANY, 'AdImage', 'ad_id', 'on' => "adImagesOnView2.isTrash='0'", "order" => "adImagesOnView2.status ='A' desc,adImagesOnView2.status='A' desc,adImagesOnView2.priority"),
			'adImagesOnView3' => array(self::HAS_MANY, 'AdImage', 'ad_id', 'condition' => "adImagesOnView3.isTrash='0'   "),
			//           'adImagesOnView3' => array(self::HAS_MANY, 'AdImage', 'ad_id','on'=>"adImages.isTrash='0'"),
			'subCategory' => array(self::BELONGS_TO, 'Subcategory', 'sub_category_id'),
			'section' => array(self::BELONGS_TO, 'Section', 'section_id'),
			'ADIMAGE' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'community' => array(self::BELONGS_TO, 'Community', 'community_id'),
			'subcommunity' => array(self::BELONGS_TO, 'SubCommunity', 'sub_community_id'),
			'stateLocation' => array(self::BELONGS_TO, 'States', 'state'),
			'country0' => array(self::BELONGS_TO, 'Countries', 'country'),
			'state0' => array(self::BELONGS_TO, 'States', 'state'),
			'city0' => array(self::BELONGS_TO, 'City', 'city'),
			'district0' => array(self::BELONGS_TO, 'District', 'district'),
			'Marital' => array(self::BELONGS_TO, 'MaritalStatus', 'marital_status'),
			'Religion' => array(self::BELONGS_TO, 'Religion', 'religion_id'),
			'EngineSize' => array(self::BELONGS_TO, 'EngineSize', 'engine_size'),
			'Model' => array(self::BELONGS_TO, 'VehicleModel', 'model'),
			'EmploymentType' => array(self::BELONGS_TO, 'EmploymentType', 'employment_type'),
			'EducationLevel' => array(self::BELONGS_TO, 'EducationLevel', 'education_level'),
			'Occupation' => array(self::BELONGS_TO, 'Occupation', 'current_occupation'),
			'Experience' => array(self::BELONGS_TO, 'Experience', 'experience_level'),
			'Colors' => array(self::BELONGS_TO, 'Color', 'color'),
			'Customer' => array(self::BELONGS_TO, 'ListingUsers', 'user_id'),
			'Doors' => array(self::BELONGS_TO, 'Door', 'door'),
			'Bodyconditions' => array(self::BELONGS_TO, 'Bodycondition', 'bodycondition'),
			'Mechanicalconditions' => array(self::BELONGS_TO, 'Mechanicalcondition', 'mechanicalcondition'),
			'FuelTypes' => array(self::BELONGS_TO, 'FuelType', 'fuel_type'),
			'BodyTypes' => array(self::BELONGS_TO, 'BodyType', 'body_type'),
			'favCount' => array(self::STAT, 'AdFavourite', 'ad_id'),

			'soldProperty' => array(self::HAS_ONE, 'SoldProperty', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function getCustomerTitle()
	{
		return  $this->section_id == '3' ? 'Developer' : 'User';
	}
	public function attributeLabels()
	{
		static $_ars;
		if ($_ars != null) {
			return $_ars;
		}
		$_ars =  array(
			'id' => 'ID',
			'p_id' => 'Import Reference ID',
			'landline' => 'Landline No',
			'mandate' => 'Enter your location',
			'w_for' => 'Wanted For',
			'section_id' => 'Offer Type',
			'rent_pad' => 'Rent Paid On ',
			'listing_type' => 'Category',
			'category_id' => $this->mTag()->getTag('type', 'Type'),
			'statistics' => $this->mTag()->getTag('statistics', 'Statistics'),
			'sub_category_id' => $this->mTag()->getTag('subcategory', 'Subcategory'),
			'ad_title' => $this->mTag()->getTag('ad_title', 'Ad Title'),
			'ad_description' => $this->mTag()->getTag('description', 'Description'),
			'amenities' => $this->mTag()->getTag('amenities', 'Amenities'),
			'engine_size' => 'Engine Size',
			'killometer' => 'Killometer',
			'model' => 'Model',
			//  'price' => 'Price',
			'year' => 'Year',
			'country' => 'Country',
			'state' => $this->mTag()->getTag('city', 'City'),
			'mobile_number' => 'Mobile Number',
			'employment_type' => 'Employment Type',
			'compensation' => 'Compensation',
			'education_level' => 'Education Level',
			'experience_level' => 'Experience Level',
			'interior_size' =>  $this->mTag()->getTag('plot_area', 'Plot Area'),
			//   'skills' => 'Skills',
			'area' => 'Area (sqft)',
			'bathrooms' => $this->mTag()->getTag('bathrooms', 'Bathrooms'),
			'bedrooms' => $this->mTag()->getTag('bedrooms', 'Bedrooms'),
			'price' => 'Price ',
			'p_types' => 'Property Types',
			'user_id' => $this->CustomerTitle,

			'added_date' => 'Added Date',
			'date_added' => 'Date',
			'modified_date' => 'Modified Date',
			'age' => 'Age',
			'height' => 'Height',
			'marital_status' => 'Marital Status',
			'religion_id' => 'Religion',
			'mother_tongue' => 'Mother Tongue',
			'current_occupation' => 'Current Occupation',
			'priority' => 'Priority',
			'isTrash' => 'Is Trash',
			'status' => $this->mTag()->getTag('status', 'Status'),
			'slug' => 'Slug',
			'bodycondition' => 'Body Condition',
			'mechanicalcondition' => 'Mechanical Condition',
			'cylinders' => 'Cylinder',
			'area_location' => $this->mTag()->getTag('street_address', 'Street Address'),
			'community_id' => 'Community',
			'sub_community_id' => 'Sub Community',
			'builtup_area_sqft' => 'Area ( Sq.Ft. )',
			'nearest_metro' => 'Nearest metro stations',
			'nearest_railway' => 'Nearest school',
			'builtup_area' => $this->mTag()->getTag('size', 'Size'),
			'area_unit' => 'Unit',
			'plot_area' => 'Plot area in Sq.Ft.',
			'parking' => 'Parking Available?.',
			'bathroom' => 'No. of Bathroom.',
			'bedroom' => 'No. of Bedroom.',
			'rera_no' => 'RERA Permit Number',
			'PrimaryUnitView' => 'Property Views',
			'construction_status' => 'Possession Status',
			'FloorNo' => 'Property on Floor',
			'total_floor' => 'Total Floors',
			'balconies' => 'Total Balconies',
			//	'state'=>'City',
			'location_latitude' => 'Select location from list',
			'city' => 'Select Location',
			'contact_person' => $this->mTag()->getTag('contact_name', 'Contact Name'),
			'salesman_email' => $this->mTag()->getTag('contact_email', 'Contact Email'),
			'year_built' => $this->section_id == '3' ? 'Completion Year' : 'Year Built',
			'reference_number' => 'Ref. #',
			'reference' => $this->mTag()->getTag('reference', 'Reference'),
			'country_name' => 'Location',
			'client_ref' => $this->mTag()->getTag('client_ref._#', 'Client Ref. #'),
			'property_ref' => 'Property Ref#',
			'last_updated' => $this->mTag()->getTag('last_updated', 'Last Updated'),
			'location' => $this->mTag()->getTag('location', 'Location'),
			'price' => $this->mTag()->getTag('price', 'Price'),
			'type' => $this->mTag()->getTag('type', 'Type'),
			'listed_by' => $this->mTag()->getTag('listed_by', 'Listed By'),
			'date' => $this->mTag()->getTag('date', 'Date'),
			'property' => $this->mTag()->getTag('property', 'Property'),
			'options' => $this->mTag()->getTag('options', 'Options'),
			'floor_plan' => $this->mTag()->getTag('floor_plan', 'Floor Plan'),
			'Q_score' => $this->mTag()->getTag('quality_score', 'Quality Score'),
			'is_mor' => $this->mTag()->getTag('is_there_a_mortgage_or_restric', 'Is there a mortgage or restriction that prevents or limits the use of the property'),
			'rights' => $this->mTag()->getTag('rights_and_obligations_over_re', 'Rights and obligations over real estate that are not documented in the real estate document'),
			'r_facade' => $this->mTag()->getTag('real__estate_facade', 'Real  Estate Facade'),
			'may_affect' => $this->mTag()->getTag('information_that_may_affect_th', 'Information that may affect the property'),
			'disputes' => $this->mTag()->getTag('property_disputes', 'Property disputes'),
			'p_limits' => $this->mTag()->getTag('p_limits', 'Property limits and lenghts'),
			'l_no' => $this->mTag()->getTag('l_no', 'Land Number'),
			'plan_no' => $this->mTag()->getTag('plan_no', 'Plan Number'),
			'no_of_u' => $this->mTag()->getTag('no_of_u', 'Number Of Units'),
			'floor_no' => $this->mTag()->getTag('floor_no', 'Floor Number'),
			'unit_no' => $this->mTag()->getTag('unit_no', 'Unit Number'),
			'c_date' => $this->mTag()->getTag('construction_date', 'Construction Date'),
			'expiry_date' => $this->mTag()->getTag('construction_date', 'Construction Date'),
			'selling_price' => $this->mTag()->getTag('selling_meter_price', 'Selling Meter Price') . ' (' . $this->currencyTitle . ')',
			'advertiser_character' => $this->mTag()->getTag('advertiser-character', 'Advertiser character'),
			'income' => $this->genLabelIncome(),
			'roi' => $this->genLabelRoi(),
			'sale_price' => $this->mTag()->getTag('sale_price', 'Sale Price'),
			'lease_status' => $this->mTag()->getTag('lease_status', 'Lease Status'),

		);
		//  $_ars = $label2;
		return 	$_ars;
		// return array_replace($label2,$label1);
		return array_merge($label2, $label1);
	}
	public function genLabelIncome()
	{
		switch ($this->section_id) {
			case '2':
				return $this->mTag()->getTag('net_income_p.a', 'Current Net Income');
				break;
			case '1':

				if ($this->lease_status == '1') {
					return $this->mTag()->getTag('net_income_p.a', 'Current Net Income');
				}
				return     $this->mTag()->getTag('expected_net_income', 'Expected Net Income');
				break;
		}
	}
	public function genLabelRoi()
	{
		switch ($this->section_id) {
			case '2':
				return $this->mTag()->getTag('net_roi_p.a_(%)', 'Net ROI P.A (%)');
				break;
			case '1':

				if ($this->lease_status == '2') {
					return $this->mTag()->getTag('expected_net_roi', 'Expected Net ROI (%)');
				}
				return $this->mTag()->getTag('Current Net ROI', 'Current Net ROI');
				break;
		}
	}
	public function genLabelRoi2()
	{




		switch ($this->section_id) {
			case '2':
				return $this->mTag()->getTag('net_roi_p.a_(%)', 'Current Net ROI');
				break;
			case '1':
				if ($this->lease_status == '1') {
					return $this->mTag()->getTag('Current Net ROI', 'Current Net ROI');
				}
				return $this->mTag()->getTag('expected_net_roi', 'Expected Net ROI');
				break;
		}
	}
	public $advertiser_character;
	public $advertiser_character_ar;
	public function getArabicCharacter()
	{
		$ar = $this->arabic_characters_array();
		return isset($ar[$this->advertiser_character]) ? $ar[$this->advertiser_character] : '';
	}
	public $custom_price;
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public $recmnded;
	public $poplar_area;
	public function getCurrencyTitle()
	{
		if (defined('CURRENCY_CODE')) {
			return CURRENCY_CODE;
		}
		if (empty($this->country_id)) {
			return Yii::app()->options->get('system.common.defalut_currency');
		}
		$criteria = new CDbCriteria;
		$criteria->select = 'cn.code';
		$criteria->join  = ' LEFT JOIN  {{currency}} cn ON cn.currency_id = t.default_currency ';
		$criteria->condition = 't.country_id =:country ';
		$criteria->params[':country'] = $this->country;
		$default_currency = Countries::model()->find($criteria);
		if ($default_currency) {
			return $default_currency->code;
		} else {
			return '';
		}
	}

	public function getUserUrl()
	{
		$html =  CHtml::link($this->first_name . ' ' . $this->last_name, Yii::App()->createUrl('listingusers/update', array('id' => $this->user_id)), array('target' => '_blank'));
		$html .= ' <i class="fa fa-envelope ';
		$html .= !empty($this->email_verified) ? 'text-green' : 'text-red';
		$html .= '"></i> <i class="fa fa-phone ';
		$html .= !empty($this->o_verified) ? 'text-green' : 'text-red';
		$html .= '"></i>';
		$html .= '<small style="display:block;color: #888;">' . $this->user_email . '</small>';
		return $html;
	}
	public $user_address;
	public $user_email;
	public $user_website;
	public $company_name;
	public function getCanShowDeletedUserAds()
	{
		return false;
	}

	public $first_name;
	public $last_name;
	public $u_slug;
	public $country_name;
	public $state_name;
	public function getlastUpdatedn()
	{
		$date = !empty($this->user_updated) ? $this->user_updated : $this->date_added;
		return $this->formatLocalizedDateTime($date);
	}
	public function getSmallDate()
	{
		if (defined('LANGUAGE') and LANGUAGE == 'ar') {
			return  Yii::t('app', date('M d,Y', strtotime($this->lastUpdatedn)), array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"));
		}

		return date('M d,Y', strtotime($this->lastUpdatedn));
	}

	public function expiryDays()
	{
		static $expiryModel;
		if ($expiryModel !== null) {
			return $expiryModel;
		}
		$expiry_days = $this->no_days_forexpity();
		$expiry_days_condition = Yii::app()->options->get('system.common.no_expiry', '');
		$expiry_days_init = 0;
		if ($expiry_days_condition != '1' and !empty($expiry_days)) {
			$expiry_days_init = $expiry_days;
		}
		$expiryModel = $expiry_days_init;
		return $expiryModel;
	}
	public function no_days_forexpity()
	{
		static $_no_of_daysExpiry;
		if ($_no_of_daysExpiry !== null) {
			return $_no_of_daysExpiry;
		}
		$_no_of_daysExpiry =  Yii::app()->options->get('system.common.ad_expiry', '');
		return $_no_of_daysExpiry;
	}
	public function getIsExpiredAd()
	{
		$html = $this->days_active .  ' days  ';
		$expirydays = $this->expiryDays();
		if (!empty($expirydays)) {
			$exp = $this->days_active >=  $expirydays ? true : false;

			if ($exp) {
				if (!empty($this->n_send_at)) {
					$class = "<i class='fa fa-check'></i>";
				} else {
					$class = "";
				}
				$html .= '<span class="text-red">Expired</span>' . CHtml::link('Send Notification<i>' . $class . '</i>', Yii::app()->createurl('place_property/notification', array('id' => $this->id)), array('class' => 'btn btn-xs btn-warning', 'onclick' => 'sendNotification(this,event)'));
			}
		}
		return $html;
	}
	public function getIsExpiredAdCheck()
	{
		$expirydays = $this->expiryDays();
		if (!empty($expirydays)) {
			return  $this->days_active >=  $expirydays ? true : false;
		}
	}
	public function getReferenceNumberTitleP()
	{
		// $html =  $this->ReferenceNumberTitle . " " . $this->JavascriptPreview . $this->Sharable . "<span style='display:block;color: #888;'>" . $this->SmallDateAdded . "</span>";
		// return  $html . '  ' . $this->IsExpiredAd . ' ' . $this->SoldStatusH;
		$html =  $this->ReferenceNumberTitle . " ";
		return  $html;
	}
	public function getJavascriptPreview()
	{
		return CHtml::Link('View', "javascript:void(0)", array("onclick" => "openUrlFUll(this)", "data-url" => $this->PreviewUrlTrash, 'class' => 'btn btn-xs btn-sm btn-info'));
	}
	public function getSharable()
	{
		return false;
		if (!empty($this->uid)) {
			$link = Yii::app()->apps->getAppUrl('frontend', 'update_property/update/id/' . base64_encode('full-' . $this->uid), true);
			$link_partial = Yii::app()->apps->getAppUrl('frontend', 'update_property/update/id/' . base64_encode('picture-' . $this->uid), true);

			return '<div class="s-profile-div"  style="display: inline;clear:right;"><div class="dropdown" style="display: inline;">
				<button class="dropdown-toggle" style="border:0px;width:auto;border:0px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="https://www.feeta.pk/assets/img/social-media.png" style="width:20px; ">
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" data-id="no720qnk29552" data-link1="' . $link . '" data-phone="' . Yii::t('app', $this->mob, array(' ' => '', '+' => '')) . '" data-link2="' . $link_partial . '" href="javascript:void(0)" onclick="openeditable(this)">Editable Link</a>
				</div>
				</div></div>';
		}
	}
	public function getGridViewImageManagement()
	{
		$html =   CHtml::Link($this->ad_title . ' - ' . $this->section->section_name, "javascript:void(0)", array("onclick" => "openUrlFUll(this)", "data-url" => $this->PreviewUrlTrash, 'style' => 'display:block;font-size: 14px;line-height: 2.2;'));
		$html .=   '<i class=" fa fa-user"></i> ' . $this->first_name;
		if (!empty($this->company_name)) {
			$html .=   '(' . trim($this->company_name) . ')';
		}
		$html .= '<br />';
		$images = $this->adImagesOnView3;
		$html .=  '<div class="image-container  ">';
		foreach ($images as $k2 => $v2) {
			$image_url1 =  Yii::app()->apps->getBaseUrl('uploads/files/' . $v2->image_name);

			$html .= '<div class="preview-img margin-top-10 status-' . $v2->status . ' ">
		      <div class="img-thumbnail-b margin-top-10"><img src="' . $image_url1 . '"></div>
		      <div class="img-actions   margin-top-10">
		        <div class="col-sm-12   " style="white-space: nowrap;"><input type="radio" name="change_status_' . $v2->id . '" id="change_status1_' . $v2->id . '" onchange="UpdateStatus(this)" value="1"  data-id="' . $v2->id . '" ';
			$html .= $v2->status == 'A' ? 'checked="true"' : "";
			$html .= ' /><label for="change_status1_' . $v2->id . '" style="display: inline-block;">Active</label> <input type="radio"  name="change_status_' . $v2->id . '"  id="change_status2_' . $v2->id . '" onchange="UpdateStatus(this)" value="0"  data-id="' . $v2->id . '" ';
			$html .=  $v2->status == 'I' ? 'checked="true"' : "";
			$html .= '  /><label for="change_status2_' . $v2->id . '"  style="display: inline-block;">Inactive</label> <a href="javascript:void(0)" style="margin-left:10px;"  data-id="' . $v2->id . '"  onclick="deleteImage(this)" ><i class="fa fa-trash"></i></a></div>
		       </div>
		       
		       </div>';
		}
		$html .=  '<div class="clearfix"></div></div><div class="clearfix"></div>';
		return $html;
	}

	public function getCountryName()
	{
		return $this->country_name . '/ ' . $this->state_name;
	}
	public function getCountryNameSection()
	{
		return $this->state_name;
		$html =   $this->city_name . '<br /><small>' . $this->state_name . '</small>';
		return  $html;
	}
	public function getCountryNameSection2()
	{
		$loc_latitude = '';
		$download_image = '';
		if (empty($this->city_location_latitude)) {
			// $loc_latitude .=  '<i   class="fa text-red  fa-check-circle"></i>';
		} else {
			// $loc_latitude .=  '<i   class="fa text-green  fa-check-circle"></i>';
		}
		if (!empty($this->city_location_latitude) and empty($this->city_location_image)) {
			// $download_image =     CHtml::link('<i class="fa fa-photo"></i>', Yii::app()->createUrl('city/generate_image', array('id' => $this->city)));
		}
		$html =   $this->state_name ;
		// . CHtml::link($loc_latitude, Yii::App()->createUrl('city/update', array('id' => $this->city)), array('target' => '_blank')) . $download_image . '<br /><small>' . $this->state_name . '</small>';
		return  $html;
	}
	public $email_verified;
	public $o_verified;
	public $mob;
	public $city_location_latitude;
	public $city_location_longitude;
	public $city_location_image;
	public $days_active;
	public $show_expired;
	public $featured2;
	public $featured_dat_conditon = '';
	public function getFetauredQuery()
	{
		/*and (TIMESTAMPDIFF(HOUR,NOW(), f_e_d ) > 0)*/
		return '(CASE WHEN t.featured_e IS  NULL THEN  t.featured  WHEN   t.featured_e ="1"  ' . $this->featured_dat_conditon . ' and f_status="A" THEN "Y" ELSE  t.featured END)  as featured2 ,';
	}
	public function getFetauredOrder()
	{
		/*and (TIMESTAMPDIFF(HOUR,NOW(), f_e_d ) > 0)*/
		return ' (CASE WHEN t.featured_e IS  NULL THEN  t.featured  WHEN   t.featured_e ="1"  ' . $this->featured_dat_conditon . ' and f_status="A" THEN "Y" ELSE  t.featured END) = "Y" desc ';
	}
	public $preleased;
	public function search($return = false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$connection =  Yii::app()->getDb();
		$res = $connection->createCommand("SET SQL_BIG_SELECTS = 1")->execute();

		$comparisonSigns   = $this->getComparisonSignsList();
		$originalDateStart = $this->date_added;
		if (!empty($this->pickerDateStartComparisonSign) && in_array($this->pickerDateStartComparisonSign, array_keys($comparisonSigns)) && !empty($this->date_added) && (strlen($this->date_added) > 4)) {
			//echo "E".$this->date_added."F";exit; 
			$this->date_added = $comparisonSigns[$this->pickerDateStartComparisonSign] . $this->date_added;
		}

		$criteria = new CDbCriteria;
		$criteria->condition = '1';
		$criteria->select = 't.*,lstype.category_name as listing_category ,cat.category_name as  category_name,' . $this->FetauredQuery . 'TIMESTAMPDIFF(DAY,(CASE WHEN t.extended_on IS NOT NULL THEN t.extended_on ELSE  t.date_added END),NOW()) as days_active ,cn.country_name,st.state_name, (SELECT CONCAT(image_name, "||F||", status)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1 )   as ad_image2';
		if ($this->startDate && $this->endDate) {
			$criteria->addCondition('t.date_added >= :startDate AND t.date_added <= :endDate');
			$criteria->params[':startDate'] = $this->startDate;
			$criteria->params[':endDate'] = $this->endDate;
		}
		if ($this->location) {
			$criteria->addCondition('t.state = :state');
			$criteria->params[':state'] = $this->location;
		}
		if ($this->featured) {
			$criteria->addCondition('t.featured = :featured');
			$criteria->params[':featured'] = $this->featured;
		}
		$criteria->compare('id', $this->id);
		if (!empty($this->reference_number)) {
			$criteria->condition .=  ' and t.id like :reference_number or t.RefNo like :reference_number ';
			$criteria->params[':reference_number'] = '%' . $this->reference_number . '%';
		}
		if (!empty($this->submited_by)) {
			$criteria->compare('t.submited_by', $this->submited_by);
		}
		$criteria->compare('t.section_id', $this->section_id);
		$criteria->compare('t.p_o_r', $this->p_o_r);
		// if (!empty($this->user_id)) {
		// 	$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :thisusr or   t.user_id = :thisusr )   ELSE     t.user_id = :thisusr  END ';
		// 	$criteria->params[':thisusr'] = (int) $this->user_id;
		// }
		if (!empty($this->f_properties)) {
			$criteria->condition .= ' and  t.xml_inserted="0" ';
		}
		// $criteria->compare('t.user_id',$this->user_id);$preleased
		$criteria->compare('t.category_id', $this->category_id);
		$criteria->compare('t.lease_status', $this->preleased);
		$criteria->compare('t.price', $this->custom_price);
		$criteria->compare('t.sub_category_id', $this->sub_category_id);
		$criteria->compare('t.ad_title', $this->ad_title, true);
		if (!empty($this->featured)) {
			$criteria->condition .= ' and (CASE WHEN t.featured_e IS  NULL THEN  t.featured  WHEN   t.featured_e ="1" ' . $this->featured_dat_conditon . ' and f_status="A" THEN "Y" ELSE  t.featured END) = "Y" ';
		}
		if (Yii::app()->isAppName('backend')) {
			$criteria->compare('t.isTrash', $this->isTrash);
		} else {
			$criteria->compare('t.isTrash', '0');
		}
		if (!empty($this->hide_new_development)) {
			$criteria->compare('t.section_id!', '3');
		}
		$criteria->compare('t.verified', $this->verified);
		$criteria->compare('t.status', $this->status);
		$criteria->compare('t.site', $this->site);
		$criteria->compare('t.listing_type', $this->listing_type);
		$criteria->compare('DATE(t.date_added)', $this->date_added);
		// if ($this->CanShowDeletedUserAds) {
		// $criteria->join  = ' INNER JOIN {{user}} usr on t.user_id = usr.user_id';
		// } else {
		// 	$criteria->join  = ' INNER JOIN {{user}} usr on t.user_id = usr.user_id';
		// }
		if (!empty($this->tag_list2)) {
			$criteria->join  .= ' INNER JOIN {{place_ad_tags}} tg on tg.ad_id = t.id and tg.tag_id = :tag_id';
			$criteria->params[':tag_id'] = $this->tag_list2;
		}
		$criteria->join  .= ' INNER JOIN {{countries}} cn on cn.country_id = t.country';
		$criteria->join  .= ' left join {{category}} lstype ON lstype.category_id = t.listing_type ';
		$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
		$criteria->join  .= ' INNER JOIN {{states}} st on st.state_id = t.state';
		//    $criteria->join  .= ' LEFT JOIN {{city}} ct on ct.city_id = t.city'  ;
		//    $criteria->join  .= ' LEFT  JOIN {{community}} cm on cm.community_id = t.community_id'  ;
		if (!empty($this->user_name)) {
			$criteria->compare(new CDbExpression('CONCAT(usr.first_name, " ", usr.last_name)'), $this->user_name, true);
		}

		if (!empty($this->unpublished)) {
			$criteria->condition .= ' and t.status = "I" ';
		}
		if (defined('NO_BUSINESS')) {
			$criteria->condition .= ' and t.section_id != "6" ';
		}
		if (defined('ONLY_BUSINESS')) {
			$criteria->condition .= ' and t.section_id  = "6" ';
		}
		// if (!empty($this->team_manager)) {
		// 	$criteria->join  .=   ' LEFT JOIN {{listing_users}} pusr2 on pusr2.user_id = usr.parent_user ';
		// 	$criteria->condition .=  ' and (CASE WHEN usr.parent_user is NOT NULL THEN pusr2.created_by ELSE usr.created_by END) = :team_manager  ';
		// 	$criteria->select .= ',CASE WHEN pusr2.user_id  is NOT NULL THEN pusr2.company_name ELSE usr.company_name END as company_name ';
		// 	$criteria->params[':team_manager'] = (int) $this->team_manager;
		// }
		if (!empty($this->country_name)) {
			$criteria->compare('lower(st.state_name)', $this->country_name, true);

			// $criteria->compare(new CDbExpression('lower(st.state_name))'),strtolower($this->country_name), true);
		}
		if (!empty($this->keyword)) {

			$refr = '';

			$criteria->condition .= ' and ( t.id like :keyword or t.ad_title like :keyword or t.ad_description like :keyword   ' . $refr . '  )   ';


			$criteria->params[':keyword'] = '%' . $this->keyword . '%';
		}
		if (!empty($this->show_expired) and $this->show_expired == '1') {
			/*
				$expiry_condition = Yii::app()->options->get('system.common.no_expiry','');
				$expiry_days = $this->no_days_forexpity();
				if($expiry_condition !='1' and !empty($expiry_days)){
			 	$criteria->condition .= ' and TIMESTAMPDIFF(DAY,(CASE WHEN t.extended_on IS NOT NULL THEN t.extended_on ELSE  t.date_added END),NOW()) >=   '.$expiry_days ; 
			    }
			    */
			if (!defined('NO_SECTION')) {
				$criteria->condition .= ' and t.section_id != 3 ';
			}
			$criteria->condition .= ' and t.cron_expiry !="1" and t.status="A" ';
		}
		if (!empty($this->city_location_image) and $this->city_location_image == '1') {
			$criteria->condition .= ' and  ct.image is   null   ';
			$criteria->group = ' t.city ';
		}
		if (defined('LANGUAGE')) {
			$langaugae = LANGUAGE;
			if (!empty($langaugae) and  $langaugae != 'en') {

				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name  END as  state_name  ';

				/*
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation5` on translationRelation5.city_id = ct.city_id   LEFT  JOIN mw_translation_data tdata5 ON (`translationRelation5`.translate_id=tdata5.translation_id and tdata5.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE ct.city_name  END as  city_name  ';
					*/
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation15` on translationRelation15.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata15 ON (`translationRelation15`.translate_id=tdata15.translation_id and tdata15.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE cat.category_name  END as  category_name  ';


				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation25` on translationRelation25.category_id = t.listing_type   LEFT  JOIN mw_translation_data tdata25 ON (`translationRelation25`.translate_id=tdata25.translation_id and tdata25.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata25.message   IS NOT NULL THEN tdata25.message ELSE lstype.category_name  END as  listing_category  ';


				$criteria->params[':lan'] = $langaugae;
				$criteria->distinct   = 't.id';
			}
		}
		$criteria->order = " t.id DESC";
		if (Yii::app()->isAppName('backend')) {
			$criteria->order = "t.id desc";
		}
		if (!empty($this->unpublished)) {
			$criteria->order = " (CASE WHEN HandoverDate IS NOT NULL THEN HandoverDate WHEN t.user_updated IS NOT NULL THEN  t.user_updated ELSE t.last_updated END)   desc";
		}
		if ($return) {
			return $criteria;
		}
		if (Yii::app()->isAppName('backend')) {
			$criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan  ) ';
			$criteria->join  .= ' left join `mw_translate` `translateadesc` on (  translateadesc.source_tag = concat("PlaceAnAd_ad_description_",t.id) )          left join `mw_translate_relation` `translationRelationaddesc` on translationRelationaddesc.ad_id = t.id  and  translationRelationaddesc.translate_id = translateadesc.translate_id  LEFT  JOIN mw_translation_data tdataaddesc ON (`translationRelationaddesc`.translate_id=tdataaddesc.translation_id and tdataaddesc.lang=:lan  ) ';
			$criteria->select .= ',tdataad.message as ad_title2,tdataaddesc.message as ad_description2';


			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name  END as  state_name_ar  ';

			$criteria->params[':lan'] = 'ar';
			$criteria->distinct   = 't.id';
		}
		//	echo $criteria->condition; print_r($criteria->params); exit; 
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'    => array(
				'pageSize'  => $this->paginationOptions->getPageSize(),
				'pageVar'   => 'page',
			),
		));
	}
	public function latestFiles($limit = 10)
	{
		$criteria = $this->search(1);
		$criteria->limit = $limit;
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'    => false,
		));
	}
	public function latestFiles2($limit = 10)
	{
		$criteria = $this->search(1);
		$criteria->limit = $limit;
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'    => array(
				'pageSize'  => $limit,
				'pageVar'   => 'page',
			),
		));
	}

	public function getCounter($user_id)
	{
		$clone_criteria =   self::model()->search(1);
		$criteria = clone  $clone_criteria;
		$criteria->compare('t.status', 'W');
		$criteria->compare('t.user_id', $user_id);
		$waiting = self::model()->count($criteria);

		$criteria = clone  $clone_criteria;
		$criteria->compare('t.status', 'A');
		$criteria->compare('t.user_id', $user_id);
		$approved = self::model()->count($criteria);

		$criteria = clone  $clone_criteria;
		$criteria->compare('t.status', 'R');
		$criteria->compare('t.user_id', $user_id);
		$rejected = self::model()->count($criteria);

		$criteria = clone  $clone_criteria;
		$criteria->compare('t.status', 'I');
		$criteria->compare('t.user_id', $user_id);
		$inactive = self::model()->count($criteria);
		return array('waiting' => $waiting, 'approved' => $approved, 'rejected' => $rejected, 'inactive' => $inactive);
	}

	public function constructionArray()
	{
		return array('R' => 'Ready To Move', 'N' => 'Under Construction', 'L' => 'New Launch');
	}
	public function TransactionType()
	{
		return array('N' => 'New Property', 'R' => 'Resale');
	}
	public function getTransactionTypeTitle()
	{
		$ar = $this->TransactionType();
		return isset($ar[$this->transaction_type]) ? $ar[$this->transaction_type] : $this->transaction_type;
	}

	public function getConstructionTitle()
	{
		$ar = $this->constructionArray();
		return isset($ar[$this->construction_status]) ?  $ar[$this->construction_status] : '';
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PlaceAnAd the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	public function behaviors()
	{
		return array_merge(
			parent::behaviors(),
			array(
				'SlugBehavior' => array(
					'class' => 'common.models.SlugBehavior.SlugBehavior',
					'slug_col' => 'slug',
					'title_col' => 'ad_title',
					'overwrite' => false
				)
			)
		);
	}
	public function bathrooms()
	{
		$ar = array();

		for ($i = 0; $i <= 11; $i++) {
			$ar[] =  ($i == 11) ? '10+' : $i;
		}
		return $ar;
	}
	public function FloorNoArray()
	{
		$ar = array();
		$ar['2001'] = 'Basement';
		$ar['2002'] = 'Lower Ground';
		$ar['2003'] =  'Ground';
		$ar['2004'] =  'N/A';
		for ($i = 1; $i <= 41; $i++) {
			$ar[] =  ($i == 41) ? '40+' : $i;
		}
		return $ar;
	}

	public function getFloorNoTitle()
	{
		$ar = $this->FloorNoArray();
		return isset($ar[$this->FloorNo]) ? $ar[$this->FloorNo] : $this->FloorNo;
	}
	public function getTotal_floorTitle()
	{
		$ar = $this->TotalFloorArray();
		return isset($ar[$this->total_floor]) ? $ar[$this->total_floor] : $this->total_floor;
	}

	public function TotalFloorArray()
	{
		$ar = array();
		for ($i = 0; $i <= 41; $i++) {
			$ar[] =  ($i == 41) ? '40+' : $i;
		}
		return $ar;
	}
	public function bedrooms()
	{
		$ar = array();
		$ar[15] = 'Studio';
		for ($i = 0; $i <= 11; $i++) {

			$ar[$i] =  ($i == 11) ? '10+' : $i;
		}
		return $ar;
	}
	public function balconiesArray()
	{
		$ar = array();
		$ar['501'] = 'None';
		for ($i = 1; $i <= 4; $i++) {

			$ar[] =  ($i == 4) ? 'More Than 3' : $i;
		}
		return $ar;
	}
	public function getBalconiesTitle()
	{
		$ar = $this->balconiesArray();
		return isset($ar[$this->balconies]) ? $ar[$this->balconies] : '';
	}
	public function year()
	{
		$ar = array();

		if ($this->section_id == '3') {
			$maximum_years = 40;
			$noe    = date("Y");
			$late   = $noe + $maximum_years;
			for ($i = $noe; $i <= $late; $i++) {
				$ar[$i] = $i;
			}
			return $ar;
		}


		for ($i = date("Y"); $i >= 1920; $i--) {
			$ar[$i] = $i;
		}
		return $ar;
	}
	public $package_used;
	public function beforeSave()
	{

		parent::beforeSave();
		if (!$this->isNewRecord) {
			$existingRecord = self::model()->findByPk($this->primaryKey);
			if ($existingRecord && $existingRecord->featured == 'N' && $this->featured == 'Y') {
				$this->featured_date = new CDbExpression('NOW()');
			}
		} else {
			if ($this->featured == 'Y') {
				$this->featured_date = new CDbExpression('NOW()');
			}
		}
		if (defined('IS_MOBILE')) {
			$this->status  = Yii::app()->options->get('system.common.frontend_default_ad_status', 'W');
		} else if (Yii::app()->isAppName('frontend')) {
			if ($this->isNewRecord) {
				//  $this->user_id = Yii::app()->user->getId();
			}
			$this->status  =  Yii::app()->options->get('system.common.frontend_default_ad_status', 'W');
		}
		if ($this->category_id != '121') {
			$this->sub_category_id = '';
		}
		$this->interior_size = empty($this->interior_size) ? null : $this->interior_size;
		$city =  City::model()->findByPk($this->city);
		if (!empty($city)) {
			$this->state  =  $city->state_id;
		}
		if (empty($this->uid)) {
			$this->uid = $this->generateUid();
		}

		if ($this->isNewRecord) {
			$userMo = ListingUsers::model()->findByPk($this->user_id);
			$userMo2 = User::model()->findByPk($this->user_id);
			if ($userMo) {
				$useridd  = !empty($userMo->parent_user) ? $userMo->parent_user : $userMo->user_id;
				$packagemodel = PricePlanOrder::model()->userActivePackageId($useridd);
			}else if($userMo2) {
				$useridd  = $userMo2->user_id;
				$packagemodel = PricePlanOrder::model()->userActivePackageId($useridd);	
			}
			if ($packagemodel) {
				$this->package_used = $packagemodel->order_id;
			} else {
				$this->package_used = 0;
				// throw new Exception('No active package found! Please contact administrator');
			}
			if (!empty($userMo->parent_user)) {
				define('SEND_NOTIFICATION', $userMo->parent_user);
			}
		}
		if (!empty($this->expiry_date) and ($this->expiry_date != '0000-00-00')) {
			$this->expiry_date =	date('Y-m-d', strtotime($this->expiry_date));
		}
		$this->user_updated = new CDbExpression('NOW()');
		return true;
	}
	public function generateUid()
	{
		$unique = StringHelper::uniqid();
		$exists = $this->findByUid($unique);

		if (!empty($exists)) {
			return $this->generateUid();
		}

		return $unique;
	}
	public function findByUid($order_uid)
	{
		return $this->findByAttributes(array(
			'uid' => $order_uid,
		));
	}

	public function warranty()
	{
		return array("Y" => "Yes", "N" => "No", "D" => "Does not apply");
	}
	public function cylinders()
	{
		return array(
			"3" => "3 Cylinder",
			"4" => "4 Cylinder",
			"5" => "5 Cylinder",
			"6" => "6 Cylinder",
			"7" => "7 Cylinder",
			"8" => "8 Cylinder",
			"9" => "9 Cylinder",
			"10" => "10 Cylinder",
			"11" => "11 Cylinder",
			"12" => "12 Cylinder",
			"13" => "Unknown",
		);
	}
	public function getCylinders($id)
	{
		$ar =  $this->cylinders();
		if (isset($ar[$id])) {
			return $ar[$id];
		} else {
			return "Unknown";
		}
	}
	public function getWarranty($id)
	{
		$ar =  $this->warranty();
		if (isset($ar[$id])) {
			return $ar[$id];
		} else {
			return "No ";
		}
	}

	public function YesNoArray()
	{
		return array("Y" => "Yes", "N" => "No", "I" => "Inactive", "A" => "Active");
	}
	public function YesNoArray2()
	{
		return array("Y" => "Yes", "N" => "No");
	}
	public function parkingArray()
	{
		return array("N" => "None", "Y" => "Open", 'C' => 'Covered');
	}
	public function getParkingTitle()
	{
		$ar = $this->parkingArray();
		return isset($ar[$this->parking]) ? $ar[$this->parking] : $this->parking;
	}
	public function getFurnishedTitle()
	{
		$ar = $this->YesNoArray2();
		if ($this->furnished == 'Y') {
			return isset($ar[$this->furnished]) ? $ar[$this->furnished] : $this->furnished;
		} else {
			$criteria = new CDbCriteria;
			$criteria->compare('t.ad_id', (int)$this->id);
			$criteria->addInCondition('t.amenities_id', array('293', '492'));
			$found =  AdAmenities::model()->count($criteria);
			if (!empty($found)) {
				return 'Yes';
			}
		}
	}
	public function getMaidRooMTitle()
	{
		$ar = $this->YesNoArray2();
		return isset($ar[$this->maid_room]) ? $ar[$this->maid_room] : $this->maid_room;
	}
	public function YesNo($val)
	{

		if ((string)$val == "Y") {
			return "'Featured1'";
		} else {
			return "'Featured'";
		}
	}

	public $image_status;

	public function search_2()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 't.*,usr.first_name,usr.last_name,usr.company_name,usr.image';

		if (!empty($this->image_status)) {
			$criteria->distinct  = 't.id';
			$criteria->join  .= ' INNER JOIN {{ad_image}} ai on ai.ad_id = t.id and ai.status = :thisStatus ';
			$criteria->params[':thisStatus']  = $this->image_status;
		}
		$criteria->compare('t.isTrash', '0');
		$criteria->compare('t.section_id!', '3');
		$criteria->order = "t.id desc";
		// $criteria->with = array("adImagesOnView3");
		// $criteria->together = true;
		$criteria->join  .= ' INNER JOIN {{listing_users}} usr on t.user_id = usr.user_id';
		$pageSize = (Yii::app()->request->getQuery("page_size")) ?  (int) Yii::app()->request->getQuery("page_size") : $pageSize = 20;
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => $pageSize,
			),

		));
	}

	public function getFeaturedAd()
	{
		$criteria = new CDbCriteria;
		$condition		 =  "t.isTrash='0' and t.status='A' and featured='Y' and t.country=:country";;
		$paramsArray[":country"] = Yii::app()->request->cookies['country']->value;
		//FOR SPECIFI STATES

		if (Yii::app()->request->cookies['state']->value != 0) {
			$condition		 .=  " and t.state=:state";
			$paramsArray[":state"] = Yii::app()->request->cookies['state']->value;
		}
		$criteria->condition = $condition;
		$criteria->params = $paramsArray;
		$criteria->order  = "t.id desc";
		$criteria->limit = "18";
		return  $this->findAll($criteria);
	}
	public function getFeaturedListings($limit)
	{
		$criteria			 	 =	new CDbCriteria;
		$condition			 =  self::FEATURED_CONDITION;
		$criteria->condition   =  $condition;
		$criteria->order  	 =  self::FEATURED_ORDER;
		$criteria->limit 		 =  $limit;
		return  $this->findAll($criteria);
	}

	public static function getCommonCondition()
	{
		return " t.isTrash='0' and t.status='A' and t.country=" . Countries::model()->getDefaultCountryId();
	}

	public function getRealtedAds($notinIds, $section, $limit)
	{
		$criteria			 	  =	 new CDbCriteria;
		$condition			  =  self::COMMON_CONDITION;
		if ($section != "") {
			$condition			 .=  Yii::t('ad', ' and t.section_id  = "{section}"', array('{section}' => $section));
		}
		$criteria->condition   =  $condition;
		$criteria->addNotInCondition('id',  $notinIds);
		$criteria->order  	 =  self::COMMON_ORDER;
		$criteria->limit 		 =  $limit;
		return  $this->findAll($criteria);
	}

	public function getLatestListings($limit, $category = null)
	{
		$criteria			 	 =	new CDbCriteria;
		$condition			 =  self::LATEST_CONDITION;
		if ($category != "") {
			$condition			 .=  " and t.section_id=:sec";
			$criteria->params[':sec'] = $category;
		}
		$criteria->condition   =  $condition;
		$criteria->order  	 =  self::FEATURED_ORDER;
		$criteria->limit 		 =  $limit;
		return  $this->findAll($criteria);
	}
	public $p_types;
	public function afterSave()
	{

		parent::afterSave();
		if ((isset(Yii::app()->request->cookies['USER_DRAFT']))) {
			unset(Yii::app()->request->cookies['USER_DRAFT']);
		}
		if (!empty($this->package_used)) {
			try {
				$values =  "('{$this->package_used}','1')";
				$sql = "insert into  {{price_plan_order}} (order_id,ads_used) values {$values} ON DUPLICATE KEY UPDATE ads_used=ads_used+1";
				Yii::app()->db->createCommand($sql)->execute();
			} catch (Exception $e) {
			}
			//	$this->package_used = $packagemodel->active_package;
		}
		$AdFloorPlan = new AdFloorPlan();
		$AdCategories = new PlaceAnAdCategories;
		$AdPropertyTypes = new AdPropertyTypes;
		$video_urls = new VideoUrs;
		$AdPaymentPlan = new AdPaymentPlan;
		$AdUnits = new PlaceAnAdUnits;
		if (!$this->isNewRecord) {
			$AdFloorPlan->deleteAllByAttributes(array('ad_id' => $this->primaryKey));
			$AdCategories->deleteAllByAttributes(array('ad_id' => $this->primaryKey));
			$AdPropertyTypes->deleteAllByAttributes(array('ad_id' => $this->primaryKey));
			$AdPaymentPlan->deleteAllByAttributes(array('ad_id' => $this->primaryKey));
			$AdUnits->deleteAllByAttributes(array('ad_id' => $this->primaryKey));
			$video_urls->deleteAllByAttributes(array('ad_id' => $this->primaryKey));
		}

		/*
			  $imgArr =  array_filter(explode(',',$this->floor_plan));
			  if(!empty($imgArr))
			  {
					foreach($imgArr as $k)
					{
							$AdFloorPlan->isNewRecord = true;
							$AdFloorPlan->floor_id = "";
							$AdFloorPlan->ad_id = $this->id;
							$string = implode('-', explode('_',$k, -1));
							$string =  Yii::t('trn', $string,array('-'=>' ','_'=>' '));						  
							$AdFloorPlan->floor_title   =  ucfirst($string) ;
							$AdFloorPlan->floor_file   =  $k ;
							$AdFloorPlan->save();
					}
					
			  }
			  * */
		if (!empty($this->p_types)) {
			foreach ($this->p_types as $k) {
				$AdCategories->isNewRecord = true;
				$AdCategories->category_id = $k;
				$AdCategories->ad_id = $this->id;
				$AdCategories->save();
			}
		}
		if (!empty($this->available_units)) {
			foreach ($this->available_units as $k) {
				$AdUnits->isNewRecord = true;
				$AdUnits->unit_id = $k;
				$AdUnits->ad_id = $this->id;
				$AdUnits->save();
			}
		}
		/*saving property types*/
		$post =  Yii::App()->request->getPost('add_property_types', array());

		if (!empty($post)) {


			for ($i = 0; $i < sizeOf($post['title']); $i++) {

				if (empty($post['title'][$i]) ||  empty($post['size'][$i]) ||  empty($post['a_unit'][$i])) {
				} else {


					$AdPropertyTypes->isNewRecord = true;
					$AdPropertyTypes->row_id = $i;
					$AdPropertyTypes->ad_id  = $this->id;;
					$AdPropertyTypes->title = $post['title'][$i];
					$AdPropertyTypes->size = $this->formatnuber($post['size'][$i]);
					$AdPropertyTypes->size_to = $this->formatnuber($post['size_to'][$i]);
					$AdPropertyTypes->from_price = $this->formatnuber($post['from_price'][$i]);
					$AdPropertyTypes->to_price = $this->formatnuber($post['to_price'][$i]);
					$AdPropertyTypes->a_unit = $post['a_unit'][$i];
					$AdPropertyTypes->p_unit = $post['p_unit'][$i];
					$AdPropertyTypes->save();
				}
			}
		}
		/*saving payment */
		/*saving videos*/
		$view_360 = 0;
		$view_video = 0;
		$post =  Yii::App()->request->getPost('video_urls', array());

		if (!empty($post)) {


			for ($i = 0; $i < sizeOf($post['title']); $i++) {

				if (empty($post['title'][$i]) ||  empty($post['video'][$i])) {
				} else {
					$video_urls->isNewRecord = true;
					$video_urls->ad_id  = $this->id;
					$video_urls->id = $i;
					$video_urls->title = $post['title'][$i];
					$video_urls->video = $post['video'][$i];
					$video_urls->video_type = $post['video_type'][$i];
					$video_urls->save();
					if ($video_urls->video_type == '1' and empty($view_360)) {
						$view_360 = 1;
					}
					if (empty($video_urls->video_type) and empty($view_video)) {
						$view_video = 1;
					}
				}
			}
		}

		/*saving payment */
		$post =  Yii::App()->request->getPost('payment_plan', array());

		if (!empty($post)) {


			for ($i = 0; $i < sizeOf($post['title']); $i++) {
				if (empty($post['title'][$i])) {
				} else {
					$AdPaymentPlan->isNewRecord = true;
					$AdPaymentPlan->row_id = $i;
					$AdPaymentPlan->ad_id  = $this->id;;
					$AdPaymentPlan->title = $post['title'][$i];
					$AdPaymentPlan->file  = $post['file'][$i];
					$AdPaymentPlan->save();
				}
			};
		}

		/*saving payment */
		$view_floor = 0;
		$post =  Yii::App()->request->getPost('floor_plan', array());

		if (!empty($post)) {


			for ($i = 0; $i < sizeOf($post['title']); $i++) {
				if (empty($post['title'][$i])) {
				} else {


					$AdFloorPlan->isNewRecord = true;
					$AdFloorPlan->floor_id = "";
					$AdFloorPlan->ad_id = $this->id;
					$AdFloorPlan->floor_title = $post['title'][$i];
					$AdFloorPlan->floor_file  = $post['file'][$i];
					if (isset($post['sqft'][$i])) {
						$AdFloorPlan->sqft  = $post['sqft'][$i];
					}
					if (isset($post['file_type'][$i])) {
						$AdFloorPlan->file_type  = $post['file_type'][$i];
					}
					$view_floor = 1;
					$AdFloorPlan->save();
				}
			};
		}
		if (defined('SEND_NOTIFICATION')) {
			$this->sendNotificationAccountManager();
		}
		$this->getUpdateTag();
		$this->getUpdateImages();
		PlaceAnAd::model()->updateByPk($this->id, array('view_360' => $view_360, 'view_video' => $view_video, 'view_floor' => $view_floor));
		return true;
	}
	public function getUpdateImages()
	{
		$criteria			 	 =	new CDbCriteria;
		$criteria->condition = 't.id = :thisid ';
		$criteria->select = 't.id,(SELECT  group_concat(CASE WHEN img.status="A" THEN `image_name` ELSE "waiting-feeta.jpg" END order by id asc)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id and      img.isTrash="0" and   img.status="A"   )   as ad_images_g ,(SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2 ';

		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan2  ) ';
		$criteria->select .= ',tdataad.message as ad_title2 ';
		$criteria->group = 't.id';
		$criteria->params[':lan2'] = 'ar';
		$criteria->params[':thisid'] = $this->primaryKey;
		$criteria->limit = 50;
		$ad =   PlaceAnAd::model()->find($criteria);

		if ($ad) {

			PlaceAnAd::model()->updateByPk($ad->id, array('cron_expiry' => 1, 'cron_images' => $ad->ad_images_g, 'cron_simage' =>   $ad->ad_image2, 'cron_arabic' => $ad->ad_title2, 'cron_updated' => new CDbExpression('NOW()')));
		}
	}


	public function getTranslateCurl($field)
	{
		$handle = curl_init();

		if (FALSE === $handle)
			throw new Exception('failed to initialize');

		curl_setopt($handle, CURLOPT_URL, 'https://www.googleapis.com/language/translate/v2');
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		if ($this->is_rtl($this->$field)) {
			$source = 'ar';
			$target = 'en';
		} else {
			$source = 'en';
			$target = 'ar';
		}
		curl_setopt($handle, CURLOPT_POSTFIELDS, array('key' => 'AIzaSyAR_JNtjus6l2meQne8BqyCrFWtOBioN5Y', 'format' => 'text', 'q' => $this->$field, 'source' => $source, 'target' => $target));
		curl_setopt($handle, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: GET'));
		$response = curl_exec($handle);

		$data = json_decode($response, true);
		if (isset($data['data']['translations']['0']['translatedText'])) {
			return   $data['data']['translations']['0']['translatedText'];
		}
	}
	public function sendNotificationAccountManager()
	{

		$emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid('ap96415qcl7dd');
		$emailTemplate_common = $this->commonTemplate();
		$options     =   Yii::app()->options;
		$support_phone  =  $options->get('system.common.support_phone');
		$support_email  =  $options->get('system.common.support_email');
		$notify     = Yii::app()->notify;
		if (empty($emailTemplate)) {
			return true;
		} else {

			$userModel =  ListingUsers::model()->findByPk((int) $this->user_id);

			$criteria =  ListingUsers::model()->findAgents(array(), false, '', 1);
			$criteria->compare('t.user_id', SEND_NOTIFICATION);
			$account_managerModel  = ListingUsers::model()->find($criteria);


			$stateModel = States::model()->getStatebyId($this->state);

			$state  = !empty($stateModel) ? $stateModel->state_name : '';
			if (empty($account_managerModel)) {
				return false;
			}

			$subject =    $emailTemplate->subject;
			$emailTemplate = $emailTemplate->content;

			$emailTemplate = str_replace('[NAME]', $account_managerModel->first_name . ' ' . $account_managerModel->last_name, $emailTemplate);
			$emailTemplate = str_replace('[AGENT_NAME]', $userModel->first_name . ' ' . $userModel->last_name, $emailTemplate);
			$emailTemplate = str_replace('[Title]', '<b>' . $this->ad_title . '</b>', $emailTemplate);
			$emailTemplate = str_replace('[LOCATION]', '<b>' . $state . '</b>', $emailTemplate);

			$status = 'S';

			$adminEmail = new Email();
			if (Yii::App()->isAppName('frontend')) {
				$adminEmail->subject = Yii::t('app', $subject, array('[PROJECT_NAME]' => Yii::app()->controller->generateCommon('site_name', '')));
			} else {
				$adminEmail->subject = Yii::t('app', $subject, array('[PROJECT_NAME]' => Yii::app()->options->get('system.common.site_name', '')));
			}
			$adminEmail->message =   Yii::t('app', $emailTemplate_common, array('[CONTENT]' => $emailTemplate));

			$receipeints = serialize(array($account_managerModel->email));

			$adminEmail->status = $status;
			$adminEmail->receipeints = $receipeints;
			$adminEmail->sent_on =   1;
			$adminEmail->type =   'S';
			$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
			$adminEmail->save(false);
			$adminEmail->getSend(false);
		}
	}

	public function getUpdateTag()
	{
		$array = array('ad_title', 'ad_description', 'area_location');
		$relationID = $this->id;
		$relation  = 'ad_id';
		$lan   =   'ar';
		foreach ($array as $field) {

			if (empty($this->$field)) {
				continue;
			}
			$id = 'PlaceAnAd_' . $field . '_' . $this->id;

			$message = $this->getTranslateCurl($field);

			if (empty($message)) {
				continue;
			}
			$model =   Translate::model()->findByAttributes(array('source_tag' => $id));

			if ($model) {
				$variable =  TranslationData::model()->findByAttributes(array('lang' => $lan, 'translation_id' => $model->primaryKey));
				if ($variable) {
					$model->translation = $message;
				}
			} else {
				$model = new Translate();
			}

			$model->lan  = 'ar';
			$model->source_tag  =  $id;
			$model->translation = $message;
			if ($model->save()) {
				$data = 	TranslationData::model()->findByAttributes(array('lang' => $lan, 'translation_id' => $model->primaryKey));
				if ($data) {
					$data->message =  $message;
					$data->save();
				} else {
					$data = new TranslationData();
					$data->translation_id =  $model->primaryKey;
					$data->lang 		  =  $lan;
					$data->message 		  =   $message;
					$data->save();
				}
				$foundRelation = TranslateRelation::model()->findByAttributes(array('translate_id' => $model->primaryKey, $relation => $relationID));
				if (!$foundRelation) {
					$saveRelation = new TranslateRelation();
					$saveRelation->$relation		= $relationID;
					$saveRelation->translate_id 	= $model->primaryKey;
					$saveRelation->rec				= 1;
					$saveRelation->save(false);
				}
			}
		}
	}
	public function formatnuber($num)
	{
		return Yii::t('app', $num, array(',' => ''));
	}
	public function afterFind()
	{
		// $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
		// $this->amenities =  CHtml::listData($this->adAmenities,'amenities_id','amenities_id');
		parent::afterFind();
	}
	protected function afterConstruct()
	{
		// $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
		parent::afterConstruct();
	}

	public function _setDefaultEditorForContent(CEvent $event) {}


	public function listDataFromSlug($slug)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "t.isTrash='0' and t.status='A'";
		$criteria->with = array("subCategory" => array("on" => "subCategory.isTrash='0' and subCategory.status='A'", "condition" => "subCategory.slug=:sname", "params" => array(":sname" => $slug), 'joinType' => 'INNER JOIN'));
		return  $this->findAll($criteria);
	}
	public function AdFromSlug($slug)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "t.isTrash='0' and t.status='A' and t.slug=:slug";
		$criteria->params[':slug'] = $slug;
		return  $this->find($criteria);
	}
	public function SearchCondition($search)
	{

		$condition		 =  "t.isTrash='0' and t.status='A' and t.country=:country";
		$paramsArray[":country"] = Yii::app()->request->cookies['country']->value;


		//FOR SPECIFI STATES

		if (Yii::app()->request->cookies['state']->value != 0) {
			$condition		 .=  " and t.state=:state";
			$paramsArray[":state"] = Yii::app()->request->cookies['state']->value;
		}




		//PRICE SEARCH
		if (isset($search["price__from"]) and $search["price__from"] != "") {
			$condition 			   .=  " and t.price>=:price_from";
			$paramsArray[":price_from"]  =  $search["price__from"];
		}

		if (isset($search["price__to"]) and $search["price__to"] != "") {
			$condition 			 .=  " and t.price<=:price_to";
			$paramsArray[":price_to"]  =  $search["price__to"];
		}
		//KILOMETER SEARCH
		if (isset($search["kilometer__from"]) and $search["kilometer__from"] != "") {
			$condition 					.=  " and t.killometer>=:kilometer__from";
			$paramsArray[":kilometer__from"]  =  $search["kilometer__from"];
		}

		if (isset($search["kilometer__to"]) and $search["kilometer__to"] != "") {
			$condition 				  .=  " and t.killometer<=:kilometer__to";
			$paramsArray[":kilometer__to"]  =  $search["kilometer__to"];
		}

		//BEDROOM SEARCH
		if (isset($search["bedrooms_min"]) and $search["bedrooms_min"] != "") {
			$condition 				 .=  " and t.bedrooms>=:bedrooms_min";
			$paramsArray[":bedrooms_min"]  =  $search["bedrooms_min"];
		}

		if (isset($search["bedrooms_max"]) and $search["bedrooms_max"] != "") {
			$condition 				 .=  " and t.bedrooms<=:bedrooms_max";
			$paramsArray[":bedrooms_max"]  =  $search["bedrooms_max"];
		}

		//BATHROOM SEARCH
		if (isset($search["bathrooms_min"]) and $search["bathrooms_min"] != "") {
			$condition 				  .=  " and t.bathrooms>=:bathrooms_min";
			$paramsArray[":bathrooms_min"]  =  $search["bathrooms_min"];
		}

		if (isset($search["bathrooms_max"]) and $search["bathrooms_max"] != "") {
			$condition 				  .=  " and t.bathrooms<=:bathrooms_max";
			$paramsArray[":bathrooms_max"]  =  $search["bathrooms_max"];
		}

		//YEAR SEARCH
		if (isset($search["year_min"]) and $search["year_min"] != "") {
			$condition 			 .=  " and t.year>=:year_min";
			$paramsArray[":year_min"]  =  $search["year_min"];
		}

		if (isset($search["year_max"]) and $search["year_max"] != "") {
			$condition 			 .=  " and t.year<=:year_max";
			$paramsArray[":year_max"]  =  $search["year_max"];
		}
		//Model
		if (isset($search["model"]) and $search["model"] != "") {
			$condition 			 .=  " and t.model=:model";
			$paramsArray[":model"]  =  $search["model"];
		}
		//Section
		if (isset($search["section_id"]) and $search["section_id"] != "") {
			$condition 			 .=  " and t.section_id=:section_id";
			$paramsArray[":section_id"]  =  $search["section_id"];
		}
		//CATEGORY
		if (isset($search["category_id"]) and $search["category_id"] != "") {
			$condition 			 .=  " and t.category_id=:category_id";
			$paramsArray[":category_id"]  =  $search["category_id"];
		}
		//SUBCATEGORY
		if (isset($search["sub_category_id"]) and $search["sub_category_id"] != "") {
			$condition 			 .=  " and t.sub_category_id=:sub_category_id";
			$paramsArray[":sub_category_id"]  =  $search["sub_category_id"];
		}


		//COLOR
		if (isset($search["color_id"]) and !empty($search["color_id"])) {
			$list =  implode(',', $search["color_id"]);
			$condition  .= " and  t.color in (:list)";
			$paramsArray[":list"] =  $list;
		}
		//DOOR
		if (isset($search["door_id"]) and !empty($search["door_id"])) {
			$list =  implode(',', $search["door_id"]);
			$condition  .= " and  t.door in (:list2)";
			$paramsArray[":list2"] =  $list;
		}
		//bodycondition
		if (isset($search["bodycondition_id"]) and !empty($search["bodycondition_id"])) {
			$list =  implode(',', $search["bodycondition_id"]);
			$condition  .= " and  t.bodycondition in (:list3)";
			$paramsArray[":list3"] =  $list;
		}

		//mechanicalcondition
		if (isset($search["mechanicalcondition_id"]) and !empty($search["mechanicalcondition_id"])) {
			$list =  implode(',', $search["mechanicalcondition_id"]);
			$condition  .= " and  t.mechanicalcondition in (:list4)";
			$paramsArray[":list4"] =  $list;
		}
		//user ID
		// if (isset($search["user_id"]) and !empty($search["user_id"])) {

		// 	$condition  .= " and  t.user_id in (:usr)";
		// 	$paramsArray[":usr"] = $search["user_id"];
		// }
		//fuel_id
		if (isset($search["fuel_id"]) and !empty($search["fuel_id"])) {
			$list =  implode(',', $search["fuel_id"]);
			$condition  .= " and  t.fuel_type in (:list5)";
			$paramsArray[":list5"] =  $list;
		}
		//body_type
		if (isset($search["body_type_id"]) and !empty($search["body_type_id"])) {
			$list =  implode(',', $search["body_type_id"]);
			$condition  .= " and  t.body_type in (:list6)";
			$paramsArray[":list6"] =  $list;
		}

		//DATE COMPARE
		if (isset($search["added__date"]) and $search["added__date"] != "") {
			switch ($search["added__date"]) {
				case 0:
					$condition  .= " and  DATE(t.added_date) = CURDATE()";
					break;
				case 3:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -3 DAY)";
				case 7:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
				case 14:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -14 DAY)";
				case 30:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -1 MONTH)";
				case 90:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -3 MONTH)";
				case 190:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -6 MONTH)";
			}
		}





		//KEYWORD
		if (isset($search["keyword"]) and $search["keyword"] != "") {
			$condition  .= " and ( t.ad_title like :keyword or t.ad_description like :keyword ) ";
			$paramsArray[":keyword"] = "%{$search['keyword']}%";
		}

		return array("condition" => $condition, "params" => $paramsArray);
	}
	public function SearchConditionCount($search)
	{
		$condition		 =  "t.isTrash='0' and t.status='A' and t.country=:country";
		$paramsArray[":country"] = Yii::app()->request->cookies['country']->value;


		//FOR SPECIFI STATES

		if (Yii::app()->request->cookies['state']->value != 0) {
			$condition		 .=  " and t.state=:state";
			$paramsArray[":state"] = Yii::app()->request->cookies['state']->value;
		}
		//PRICE SEARCH
		if (isset($search["price__from"]) and $search["price__from"] != "") {
			$condition 			   .=  " and t.price>=:price_from";
			$paramsArray[":price_from"]  =  $search["price__from"];
		}

		if (isset($search["price__to"]) and $search["price__to"] != "") {
			$condition 			 .=  " and t.price<=:price_to";
			$paramsArray[":price_to"]  =  $search["price__to"];
		}
		//KILOMETER SEARCH
		if (isset($search["kilometer__from"]) and $search["kilometer__from"] != "") {
			$condition 					.=  " and t.killometer>=:kilometer__from";
			$paramsArray[":kilometer__from"]  =  $search["kilometer__from"];
		}

		if (isset($search["kilometer__to"]) and $search["kilometer__to"] != "") {
			$condition 				  .=  " and t.killometer<=:kilometer__to";
			$paramsArray[":kilometer__to"]  =  $search["kilometer__to"];
		}

		//BEDROOM SEARCH
		if (isset($search["bedrooms_min"]) and $search["bedrooms_min"] != "") {
			$condition 				 .=  " and t.bedrooms>=:bedrooms_min";
			$paramsArray[":bedrooms_min"]  =  $search["bedrooms_min"];
		}

		if (isset($search["bedrooms_max"]) and $search["bedrooms_max"] != "") {
			$condition 				 .=  " and t.bedrooms<=:bedrooms_max";
			$paramsArray[":bedrooms_max"]  =  $search["bedrooms_max"];
		}

		//BATHROOM SEARCH
		if (isset($search["bathrooms_min"]) and $search["bathrooms_min"] != "") {
			$condition 				  .=  " and t.bathrooms>=:bathrooms_min";
			$paramsArray[":bathrooms_min"]  =  $search["bathrooms_min"];
		}

		if (isset($search["bathrooms_max"]) and $search["bathrooms_max"] != "") {
			$condition 				  .=  " and t.bathrooms<=:bathrooms_max";
			$paramsArray[":bathrooms_max"]  =  $search["bathrooms_max"];
		}

		//YEAR SEARCH
		if (isset($search["year_min"]) and $search["year_min"] != "") {
			$condition 			 .=  " and t.year>=:year_min";
			$paramsArray[":year_min"]  =  $search["year_min"];
		}

		if (isset($search["year_max"]) and $search["year_max"] != "") {
			$condition 			 .=  " and t.year<=:year_max";
			$paramsArray[":year_max"]  =  $search["year_max"];
		}
		//KEYWORD
		if (isset($search["keyword"]) and $search["keyword"] != "") {
			$condition  .= " and ( t.ad_title like :keyword or t.ad_description like :keyword ) ";
			$paramsArray[":keyword"] = "%{$search['keyword']}%";
		}
		//Model
		if (isset($search["model"]) and $search["model"] != "") {
			$condition 			 .=  " and t.model=:model";
			$paramsArray[":model"]  =  $search["model"];
		}

		//Section
		if (isset($search["section_id"]) and $search["section_id"] != "") {
			$condition 			 .=  " and t.section_id=:section_id";
			$paramsArray[":section_id"]  =  $search["section_id"];
		}
		//CATEGORY
		if (isset($search["category_id"]) and $search["category_id"] != "") {
			$condition 			 .=  " and t.category_id=:category_id";
			$paramsArray[":category_id"]  =  $search["category_id"];
		}
		//SUBCATEGORY
		if (isset($search["sub_category_id"]) and $search["sub_category_id"] != "") {
			$condition 			 .=  " and t.sub_category_id=:sub_category_id";
			$paramsArray[":sub_category_id"]  =  $search["sub_category_id"];
		}

		//COLOR
		if (isset($search["color_id"]) and !empty($search["color_id"])) {
			$list =  implode(',', $search["color_id"]);
			$condition  .= " and  t.color in (:list)";
			$paramsArray[":list"] =  $list;
		}
		//DOOR
		if (isset($search["door_id"]) and !empty($search["door_id"])) {
			$list =  implode(',', $search["door_id"]);
			$condition  .= " and  t.door in (:list2)";
			$paramsArray[":list2"] =  $list;
		}
		//bodycondition
		if (isset($search["bodycondition_id"]) and !empty($search["bodycondition_id"])) {
			$list =  implode(',', $search["bodycondition_id"]);
			$condition  .= " and  t.bodycondition in (:list3)";
			$paramsArray[":list3"] =  $list;
		}

		//mechanicalcondition
		if (isset($search["mechanicalcondition_id"]) and !empty($search["mechanicalcondition_id"])) {
			$list =  implode(',', $search["mechanicalcondition_id"]);
			$condition  .= " and  t.mechanicalcondition in (:list4)";
			$paramsArray[":list4"] =  $list;
		}

		//fuel_id
		if (isset($search["fuel_id"]) and !empty($search["fuel_id"])) {
			$list =  implode(',', $search["fuel_id"]);
			$condition  .= " and  t.fuel_type in (:list5)";
			$paramsArray[":list5"] =  $list;
		}
		//user ID
		if (isset($search["user_id"]) and !empty($search["user_id"])) {

			$condition  .= " and  t.user_id in (:usr)";
			$paramsArray[":usr"] = $search["user_id"];
		}
		//body_type
		if (isset($search["body_type_id"]) and !empty($search["body_type_id"])) {
			$list =  implode(',', $search["body_type_id"]);
			$condition  .= " and  t.body_type in (:list6)";
			$paramsArray[":list6"] =  $list;
		}
		//DATE COMPARE
		if (isset($search["added__date"])) {
			switch ($search["added__date"]) {
				case 0:
					$condition  .= " and  DATE(t.added_date) = CURDATE()";
					break;
				case 3:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -3 DAY)";
				case 7:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
				case 14:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -14 DAY)";
				case 30:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -1 MONTH)";
				case 90:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -3 MONTH)";
				case 190:
					$condition  .= " and   t.added_date >= DATE_ADD(CURDATE(), INTERVAL -6 MONTH)";

				default:

					break;
			}
		}
		//echo $condition;exit;
		return array("condition" => $condition, "params" => $paramsArray);
	}
	function updateXmlAds($status)
	{

		$criteria		=	new CDbCriteria;
		$criteria->condition = "xml_inserted=:xml_status";
		$criteria->params[':xml_status'] = '1';
		$this->updateAll(array('status' => $status), $criteria);
	}
	public function getAllxmlPk($SectionID)
	{
		$criteria		=	new CDbCriteria;
		$criteria->select = "t.xml_pk";
		$criteria->condition = "xml_inserted=:xml_status and t.section_id=:sec";
		$criteria->params[':xml_status'] = '1';
		$criteria->params[':sec'] = $SectionID;
		return $this->findAll($criteria);
	}
	public function getAllProspace_xml()
	{

		$criteria		=	new CDbCriteria;
		$criteria->select = "t.xml_reference,t.xml_update_date";
		$criteria->condition = "xml_inserted=:xml_status and t.xml_type=:type";
		$criteria->params[':xml_status'] = '1';
		$criteria->params[':type'] = 'P';
		return $this->findAll($criteria);
	}
	public function getAllxml($section)
	{

		$criteria		=	new CDbCriteria;
		$criteria->select = "t.id,t.modified_date,t.code";
		$criteria->condition = "t.xml_type=:type and t.section_id=:section";
		$criteria->params[':type'] = 'P';
		$criteria->params[':section'] = $section;
		return $this->findAll($criteria);
	}

	function category_isert($SectionID, $v1)
	{
		$category_model = new Category;
		$category_model->isNewRecord = true;
		$category_model->category_id     = "";
		$category_model->section_id     = $SectionID;
		$category_model->category_name  = $v1;
		$category_model->amenities_required  = 'Y';
		$category_model->xml_inserted  = '1';
		$category_model->slug = $category_model->getUniqueSlug();
		$category_model->save();
		return  Yii::app()->db->getLastInsertId();
	}


	function fieldInsertion($category_id)
	{

		$Fileds =  new   CategoryFieldList;
		$attributes2 = array('price', 'area', 'bathrooms', 'bedrooms');
		foreach ($attributes2 as $field) {
			$Fileds->isNewRecord = true;
			$Fileds->field_name = $field;
			$Fileds->category_id = $category_id;
			$Fileds->save();
		}
	}
	function subcategory_insert($category_id, $unitType, $SectionID)
	{
		$sub_category_model = new Subcategory;
		$subcategory = CHtml::listData(Subcategory::model()->ListDataForCategory($category_id), 'sub_category_id', 'sub_category_name');
		if (!$this->in_arrayi($unitType, $subcategory)) {
			$sub_category_model->isNewRecord    = true;
			$sub_category_model->section_id     = $SectionID;
			$sub_category_model->sub_category_id     = "";
			$sub_category_model->category_id     = $category_id;
			$sub_category_model->sub_category_name  = $unitType;
			$sub_category_model->amenities_required  = 'Y';
			$sub_category_model->xml_inserted  = '1';
			$sub_category_model->slug = $sub_category_model->getUniqueSlug();
			$sub_category_model->save();
			return  Yii::app()->db->getLastInsertId();
		} else {
			return  array_search(strtolower($unitType), array_map('strtolower', $subcategory));
		}
	}
	function country_insert($con, $v1)
	{
		$country = new Countries;
		if (!$this->in_arrayi($v1, $con)) {
			$country->country_name = $v1;
			$country->country_code = 'XXX';
			$country->location_longitude = '1';
			$country->location_latitude = '1';
			$country->save();
			return  Yii::app()->db->getLastInsertId();
		} else {

			return  array_search(strtolower($v1), array_map('strtolower', $con));
		}
	}
	function state_insert($con, $v1, $country_id)
	{
		$state = new States;
		if (!$this->in_arrayi($v1, $con)) {
			$state->state_name = $v1;
			$state->country_id = $v1;
			$state->location_longitude = '1';
			$state->location_latitude = '1';
			$state->save();
			return  Yii::app()->db->getLastInsertId();
		} else {

			return  array_search(strtolower($v1), array_map('strtolower', $con));
		}
	}
	function in_arrayi($needle, $haystack)
	{

		return in_array(strtolower($needle), array_map('strtolower', $haystack));
	}
	function insertUser($user_email, $user_phone, $user_name, $user_image)
	{

		$model = new ListingUsers();
		$img_user = "";
		/*
			if (@GetImageSize($user_image)) {



			$path =  Yii::app()->basePath . '/../../uploads' ;
			$img_user = 'usr'.rand(0,9999).'_'.time().".jpg";
			$content = file_get_contents($path);
			file_put_contents($path."/avatar/{$img_user}", $content);
			}
			* */

		$model->email = $user_email;
		$model->phone = $user_phone;
		$serexplode = explode(' ', $user_name);
		$model->first_name = @$serexplode['0'];
		$model->last_name = @$serexplode['1'];
		$password = '123456';
		$model->image = $img_user;
		$model->con_password =  $password;
		$model->password = $password;
		$model->status = 'A';
		$model->xml_inserted = '1';
		$model->xml_image = $user_image;
		$model->save();
		return  Yii::app()->db->getLastInsertId();
	}
	function imageinsert($imagearray, $ad_id, $delete = 0)
	{

		$room_image = new AdImage;
		if ($delete == 1) {
			$room_image->deleteAll(array("condition" => "ad_id=:ad_id", "params" => array(":ad_id" => $ad_id)));
		}

		if (!empty($imagearray)) {
			foreach ($imagearray as  $photo) {

				$img = "";

				if (@GetImageSize($photo)) {

					$path =  Yii::app()->basePath . '/../../uploads';
					$img = rand(0, 9999) . '_' . time() . ".jpg";
					$content = file_get_contents($photo);
					file_put_contents($path . "/ads/{$img}", $content);
				}


				$room_image->isNewRecord = true;
				$room_image->id = "";
				$room_image->ad_id = $ad_id;
				$room_image->image_name = $img;
				$room_image->xml_image = $photo;
				$room_image->status = "A";
				$room_image->save();
			}
		}
	}
	function adsMessage($totalcount, $totalinsertcount, $totalupdatecount, $fetched, $section = "")
	{
		echo "Dear Admin ,<br />";
		$remaining = $totalcount - ($fetched + $totalinsertcount + $totalupdatecount);
		$remainin_msg = "";
		if ((int)$remaining > 0) {
			$remainin_msg = " and remaining <b>{$remaining} </b> Ads to fetch";
		}
		echo "Total Ads {$totalcount} found and {$totalinsertcount} inserted and {$totalupdatecount} updated on section {$section}" . $remainin_msg;
		exit;
	}
	function renderImage($image = "", $xml = "P", $image_name = "")
	{


		$image = Yii::app()->basePath . '/../../uploads/ads/' . $image_name;
		if (is_file($image)) {

			return Yii::app()->apps->getBaseUrl('uploads/ads/' . $image_name);
		} else {
			return   Yii::app()->theme->baseUrl . '/images/ucnoimage.jpg';
		}


		if ($xml == "N") {

			$image = Yii::app()->basePath . '/../../uploads/ads/' . $image_name;
			if (is_file($image)) {

				return Yii::app()->apps->getBaseUrl('uploads/ads/' . $image_name);
			} else {
				return   Yii::app()->theme->baseUrl . '/images/ucnoimage.jpg';
			}
		}
		if (@GetImageSize($image)) {
			return   $image;
		} else {

			return   Yii::app()->theme->baseUrl . '/images/ucnoimage.jpg';
		}
	}
	function renderImageNew($image_name = "")
	{


		$image = Yii::app()->basePath . '/../../uploads/ads/' . $image_name;
		if (is_file($image)) {

			return Yii::app()->apps->getBaseUrl('uploads/ads/' . $image_name);
		} else {
			return   Yii::app()->theme->baseUrl . '/images/ucnoimage.jpg';
		}
	}


	function currencyAbreviation($currency = "")
	{
		return ($currency == "") ? Yii::app()->options->get('system.common.defalut_currency') : $currency;
	}
	function getPriceWithCurrncy()
	{
		return  Yii::app()->options->get('system.common.defalut_currency') . ' ' .  number_format($this->price, 0, '.', ',');
	}
	public $converted_unit;
	public $atitle;
	function getBuiltUpArea()
	{
		if (!empty($this->converted_unit)) {
			if (defined('AREAVALUE') && AREAVALUE != '1') {
				if ($this->area_unit == AREAUNIT) {
					return Yii::t('app', $this->builtup_area) . ' ' . AREANAME;
				}
				return number_format(Yii::t('app', ($this->converted_unit / AREAVALUE)), 0, '.', ',') . ' ' . AREANAME;
			} else {
				return number_format(Yii::t('app', $this->converted_unit), 0, '.', ',') . ' Sq. Ft.';
			}
		}

		if (!empty($this->builtup_area)) {
			return number_format(Yii::t('app', $this->builtup_area), 0, '.', ',') . ' ' . $this->AreaUnit;
		}
	}

	public $atitle2;
	function getInteriorSize()
	{
		if (defined('LANGUAGE') && LANGUAGE == 'ar') {
			switch ($this->atitle2) {
				case 'Sq. M.':
					$this->atitle2 = 'متر مربع';
					break;
			}
		}
		if (!empty($this->atitle2) && !empty($this->interior_size) && $this->interior_size != '0.00') {
			return number_format($this->interior_size, 0, '.', ',') . ' ' . $this->atitle2;
		}
		if (!empty($this->interior_size) && $this->interior_size != '0.00') {
			return number_format($this->interior_size, 0, '.', ',') . ' ' . $this->AreaUnit2;
		}
	}

	public $unit_title;
	public function getAreaUnit()
	{
		if (empty($this->area_unit)) {
			return 'Sq.Ft.';
		} else if (!empty($this->unit_title)) {
			return $this->unit_title;
		} else {
			$return = AreaUnit::model()->findByPk($this->area_unit);
			if (!empty($return)) {
				return $return->master_name;
			}
		}
	}
	public function getAreaUnit2()
	{
		if (empty($this->area_unit_1)) {
			return 'Sq.M.';
		} else {
			$return = AreaUnit::model()->findByPk($this->area_unit_1);
			if (!empty($return)) {
				return $return->master_name;
			}
		}
	}
	function getPloatArea()
	{
		if ($this->plot_area != '0.00') {
			return     number_format($this->plot_area, 0, '.', ',') . ' Sq.Ft.';
		}
	}
	public $sub_community_name;
	function getSystemRefNo()
	{
		if (!empty($this->RefNo)) {
			return $this->RefNo;
		} else {
			return 'MA' . str_pad($this->id, 5, 0, STR_PAD_LEFT);
		}
	}
	function getPriceHtml()
	{
		$htmlTag =  '<div class="Price_span"> ' . $this->priceWithCurrncy;
		if ($this->section_id == self::RENT_ID) {
			$htmlTag .= '<br><span class="rentpermonth" style="font-size:12px">(rent per  ' . $this->rentPaid2 . ')</span>';
		}
		$htmlTag .= ' </div> ';
		return $htmlTag;
	}
	function getDetailsPriceHtml()
	{

		$htmlTag = '<span class="unit-price-div">' . Yii::app()->options->get('system.common.defalut_currency') . ' <span class="price-text">' . number_format($this->price, 0, '.', ',') . '</span>';
		if ($this->section_id == self::RENT_ID) {
			$htmlTag .= '<span class="rentpermonth">(rent per  ' . $this->rentPaid2 . ')</span>';
		}
		$htmlTag .= '</span>';

		return $htmlTag;
	}
	function getRentPaid()
	{
		if (empty($this->rent_paid)) {
			$this->rent_paid = 'yearly';
		}
		return  ' / ' . $this->rent_paid;
	}
	function getRentPaid2()
	{
		if (empty($this->rent_paid)) {
			$this->rent_paid = 'yearly';
		}
		return   $this->rent_paid;
	}
	public function paidArray()
	{
		return
			array(
				"yearly" => $this->mTag()->getTag('yearly', 'Yearly'),
				"monthly" => $this->mTag()->getTag('monthly', 'Monthly'),
				//  "Quarterly" => 'Quarterly',
				"Daily" => $this->mTag()->getTag('daily', 'Daily')
			);
	}
	function getRentPaid3()
	{
		if (empty($this->rent_paid)) {
			$this->rent_paid = 'yearly';
		}
		switch ($this->rent_paid) {
			case 'yearly':
				return 'yr';
				break;
			case 'monthly':
				return 'mo';
				break;
			default:
				return $this->rent_paid;
				break;
		}
	}
	function getLocationString()
	{
		if (!empty($this->district)) {
			return 	$this->district0->district_name;
		} else {
			return 	$this->state0->state_name;
		}
	}
	function getReadyString2()
	{
		if (!empty($this->occupant_status) and $this->occupant_status == 'Vacant') {
			return '<div class="readynow-div2"> <span>Ready Now</span> </div>';
		}
	}
	function getReadyString()
	{
		if (!empty($this->occupant_status) and $this->occupant_status == 'Vacant') {
			return '<div class="readynow-div"> <span>Ready Now</span> </div>';
		}
	}
	function getPropertyDatilUrl()
	{
		return   Yii::app()->createUrl($this->slug . '/detailView');
	}
	function getPropertyAbsoluteDatilUrl()
	{
		return   Yii::app()->createAbsoluteUrl($this->slug . '/detailView');
	}
	function getBuiltupAreaString()
	{
		if (!empty($this->builtup_area)) {
			return 	$this->builtup_area .  ' sq.ft.';
		}
	}
	function getLocalBedString()
	{
		$htmlTag = '';
		if (!empty($this->bedrooms)) {
			$htmlTag .= '<span style="float:left;">' . (int) $this->bedrooms . '</span><span title="' . (int) $this->bedrooms . ' Bedroom(s)" class="unitbeds"></span>';
		}
		if (!empty($this->bathrooms)) {
			$htmlTag .= '<span style="float:left;">' . (int) $this->bathrooms . '</span><span title="' . (int) $this->bathrooms . ' Bathroom(s)" class="unitbaths"></span>';
		}
		if (!empty($this->parking)) {
			$htmlTag .= '<span style="float:left;">' . (int) $this->parking  . '</span><span title="' . (int) $this->parking . ' Car Parking(s)" class="unitparkng"></span>';
		}
		return $htmlTag;
	}
	function FomatMoney($money = "0")
	{
		return  number_format($money, 0, '.', ',');
	}
	function priceArray()
	{
		return array(
			10000 => '10000 ' . Yii::app()->options->get('system.common.defalut_currency'),
			50000 => '50000 ' . Yii::app()->options->get('system.common.defalut_currency'),
			100000 => '100000 ' . Yii::app()->options->get('system.common.defalut_currency'),
			200000 => '200000 ' . Yii::app()->options->get('system.common.defalut_currency'),
			300000 => '300000 ' . Yii::app()->options->get('system.common.defalut_currency'),
			400000 => '400000 ' . Yii::app()->options->get('system.common.defalut_currency'),
			500000 => '500000 ' . Yii::app()->options->get('system.common.defalut_currency'),
			1000000 => '1000000 ' . Yii::app()->options->get('system.common.defalut_currency'),
		);
	}
	function getMinPriceHtml()
	{
		$html = '<option value="">Min Price</option>';

		$prices = array(10000, 50000, 100000, 200000, 300000, 400000, 500000, 1000000);

		foreach ($prices as $price) {
			$selected = (Yii::app()->request->getQuery("min-price") == "$price") ? "selected=true" : "";
			$formatted_price = Yii::app()->options->get('system.common.defalut_currency') . " " . number_format("$price.00", 2, '.', ',');
			$html .= '<option value="' . $price . '" ' . $selected . '>' . $formatted_price . '</option>';
		}

		return $html;
	}

	function getMaxPriceHtml()
	{
		$html = 'Bathrooms<option value="">Max Price</option>';
		$prices = array(10000, 50000, 100000, 200000, 300000, 400000, 500000, 1000000);

		foreach ($prices as $price) {
			$selected = (Yii::app()->request->getQuery("max-price") == "$price") ? "selected=true" : "";
			$formatted_price = Yii::app()->options->get('system.common.defalut_currency') . " " . number_format("$price.00", 2, '.', ',');
			$html .= '<option value="' . $price . '" ' . $selected . '>' . $formatted_price . '</option>';
		}

		return $html;
	}

	function getBedroomHtml()
	{
		$html = '<option value="">Bedrooms</option>';
		$bedrooms = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 'bedroom-equal-and-more');

		foreach ($bedrooms as $bedroom) {
			$selected = (Yii::app()->request->getQuery("bedrooms") == "$bedroom") ? "selected=true" : "";
			$label = ($bedroom === 'bedroom-equal-and-more') ? '10+ Bedrooms' : "$bedroom Bedrooms";
			$html .= '<option value="' . $bedroom . '" ' . $selected . '>' . $label . '</option>';
		}

		return $html;
	}

	function getMBathroomHtml()
	{
		$html = '<option value="">Bathrooms</option>';
		$bathrooms = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 'bathroom-equal-and-more');

		foreach ($bathrooms as $bathroom) {
			$selected = (Yii::app()->request->getQuery("bathrooms") == "$bathroom") ? "selected=true" : "";
			$label = ($bathroom === 'bathroom-equal-and-more') ? '10+ Bathrooms' : "$bathroom Bathrooms";
			$html .= '<option value="' . $bathroom . '" ' . $selected . '>' . $label . '</option>';
		}

		return $html;
	}

	public function getShortName($length = 20)
	{
		return StringHelper::truncateLength($this->ad_title, (int)$length);
	}
	public function getAdTitleWithIcons()
	{
		$html =  $this->ad_title . ' - ' . $this->city_name . ' - ' . $this->state_name;

		if ($this->featured == "Y") {
			$html .=  '<i title="FEATURED" class="glyphicon glyphicon-star"></i>';
		}
		if ($this->verified == "1") {
			$html .=  '<i   class="fa fa-check-circle"></i>';
		}
		if ($this->status == "I") {
			$html .=  '<i title="DISABLED" class="glyphicon glyphicon-ban-circle"></i>';
		}
		return  $html;
	}
	public function getAdTitleWithIcons2()
	{
		$html =  $this->ad_title;

		if ($this->featured == "Y") {
			$html .=  '<i title="FEATURED" class="glyphicon glyphicon-star"></i>';
		}
		if ($this->verified == "1") {
			$html .=  '<i   class="fa fa-check-circle"></i>';
		}
		if ($this->status == "I") {
			$html .=  '<i title="DISABLED" class="glyphicon glyphicon-ban-circle"></i>';
		}
		$html .= $this->ExternalPropertyLink;
		return  $html;
	}
	public function getExternalPropertyLink()
	{
		if (!empty($this->p_url)) {
			return CHtml::link('<i class="fa fa-link"></i>', $this->p_url, array('target' => '_blank', 'style' => '    display: block;    color: orange;    font-weight: bold;    text-align: center;    padding: 2px 5px;    background: #fff;    max-width: 31px;    border-radius: 5px;',));
		}
	}
	public $category_name;
	public $community_name;
	public function newDevelopments($country_id = null, $state = null, $limit = 2)
	{
		$criteria = self::model()->search(1);
		$criteria->select = 't.*,ct.image as location_image,cat.category_name as  category_name, com.community_name , (SELECT CONCAT(image_name, "||F||", status)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )   as ad_image2';
		$criteria->select .= ',(SELECT  group_concat(`image_name`)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0"    )   as ad_images_g';

		//$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
		$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
		$criteria->condition  .= '  and  t.status="A" and t.section_id =:section ';
		$criteria->params[':section'] = self::NEW_ID;
		if ($country_id) {
			$criteria->condition .= ' and t.country = :country ';
			$criteria->params[':country'] = $country_id;
		}
		if ($state) {
			$criteria->condition .= ' and t.state = :state ';
			$criteria->params[':state'] = $state;
		}
		if (Yii::app()->user->getId()) {
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
		}
		$criteria->limit = $limit;
		return self::model()->findAll($criteria);
	}
	public $ad_image2;
	public function faturedProjects($country_id = null, $state = null, $limit = 2, $section_id = null)
	{
		$criteria = self::model()->search(1);
		$criteria->select = 't.*,cat.category_name as  category_name,com.community_name,   (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0"  limit 1 )   as ad_image';
		$criteria->select .= ',(SELECT  group_concat(`image_name`)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0"    )   as ad_images_g';

		//$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
		$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
		$criteria->condition  .= ' and  t.status="A"   and t.featured="Y"   ';
		//	$criteria->params[':section'] = self::NEW_ID ; 
		if (!empty($section_id)) {
			$criteria->condition  .= ' and  t.section_id =:section    ';
			$criteria->params[':section'] = $section_id;
		}
		if ($country_id) {
			$criteria->condition .= ' and t.country = :country ';
			$criteria->params[':country'] = $country_id;
		}
		if ($state) {
			$criteria->condition .= ' and t.state = :state ';
			$criteria->params[':state'] = $state;
		}
		if (Yii::app()->user->getId()) {
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
		}
		$criteria->limit = $limit;
		return self::model()->findAll($criteria);
	}
	public $ad_images_g;
	public function generateImage($apps, $h = 190, $w = 285, $s_id = null, $bg = null)
	{
		$html = '';
		if (!empty($this->ad_images_g) and !empty($bg)) {
			$itemsI = explode(',', $this->ad_images_g);
			if (!empty($itemsI)) {
				foreach ($itemsI as $k => $ad_img) {
					$html .= '<div>';


					$image = ENABLED_AWS_PATH . $this->ad_image;
					if (!empty($bg)) {
						if ($k == 0) {
							$htm = 'style="background-image:url(\'' . $image . '\')"';
							$c = 'is-lazy-loaded';
						} else {
							$htm = 'data-lazy="' . $image . '"';
							$c = 'lazy-bg-img';
						}
						$html .= '<div class="bg-image ' . $c . '" ' . $htm . ' ></div>';
					} else {
						$html .= '<img data-lazy="' . $image . '" alt="">';
					}
					$html .= '</div>';
				}
			}
		}
		if (!empty($html)) {

			return $html;
		} else {

			$html .= '';
			$clss = '';
			if (empty($this->ad_image)) {
				$image = Yii::app()->apps->getBaseUrl('assets/img/photography-camera-image-picture-photo-gallery-38395.png');
				$clss = 'no-image';
			} else {
				$image =   ENABLED_AWS_PATH . $this->ad_image;
			}

			$html .= '<img src="' . $image . '" class="' . $clss . '" alt="">';
			$html .= '';
		}
		return $html;
	}
	//Yii::app()->apps->getBaseUrl('assets/img/waiting-feeta.jpg')
	public function generateImage2($apps, $h = 190, $w = 285, $s_id = null, $bg = null, $opaciti = 60, $wateri = '10')
	{
		$html = '';
		if (!empty($this->ad_images_g) and !empty($bg)) {
			$itemsI = explode(',', $this->ad_images_g);
			if (!empty($itemsI)) {
				foreach ($itemsI as $k => $ad_img) {

					$html .= '<div>';

					if (defined('offline')) {
						$ad_img = '1019_1571412256global-city-ajman-ajman-properties_.jpg';
					}
					$apps = Yii::app()->apps;
					$image = $apps->getBaseUrl('uploads/files/' . $ad_img);
					if (!empty($bg)) {
						if ($k == 0) {
							$htm = 'style="background-image:url(\'' . $this->generateImageWaterMark($ad_img, $w, $h, $opaciti, $wateri) . '\')"';
							$c = 'is-lazy-loaded';
						} else {
							$htm = 'data-lazy="' . $apps->getBaseUrl('uploads/files/' . $ad_img) . '"';
							$c = 'lazy-bg-img';
						}
						$html .= '<div class="bg-image ' . $c . '" ' . $htm . ' ></div>';
					} else {
						$html .= '<img data-lazy="' . $this->generateImageWaterMark($ad_img, $w, $h, $opaciti, $wateri) . '" alt="">';
					}
					$html .= '</div>';
				}
			}
		}
		if (!empty($html)) {

			return $html;
		} else {

			$html .= '';
			//$image =  $apps->getBaseUrl('uploads/images/'.$this->ad_image); 
			//$html .= '<img src="'.$apps->getBaseUrl('timthumb.php').'?src='.$image.'&h='.$h.'&w='.$w.'&zc=1" alt="">';
			$image =  $this->generateImageWaterMark($this->ad_image, $w, $h, $opaciti, $wateri);
			$html .= '<img src="' . $image . '" alt="">';
			$html .= '';
		}
		return $html;
	}
	function generateImageWaterMark($image = null, $width = null, $height = null, $opacity = 60, $water_size = 10)
	{
		if (defined('offline')) {
			$image = '0919_1567488950Untitled_.jpg';
		}
		switch ($water_size) {
			case '10':
				$marker = '50-ArabAvenueLogo.png';
				break;
			case '20':
				$marker = '50-ArabAvenueLogo.png';
				break;
			default:
				$marker = 'logo-watermark-icon.png';
				break;
		}
		return Yii::app()->apps->getBaseUrl('uploads/files/' . $image);
		if (empty($width) and empty($height)) {

			return   Yii::app()->easyImage->thumbSrcOf(
				Yii::getpathOfAlias('root')  . '/uploads/files/' . $image,
				array(
					//	'watermark' => array('watermark' =>'/watermark/'.$marker , 'opacity' => $opacity ), 
					'sharpen' =>  0,
					'background' => '#fff',
					'type' => 'jpg',
					'quality' => 95
				)
			);
		}
		return Yii::app()->apps->getBaseUrl('uploads/files/' . $image);
		return   Yii::app()->easyImage->thumbSrcOf(
			Yii::getpathOfAlias('root')  . '/uploads/files/' . $image,
			array(
				'resize' => array('width' => $width, 'height' => $height, "master" => EasyImage::RESIZE_AUTO),
				//'watermark' => array('watermark' =>'/watermark/'.$marker , 'opacity' => $opacity ), 
				// 'scaleAndCrop' => array('width' => $width, 'height' => $height),
				// 'resize' => array('width' => $width, 'height' =>$height,"master"=>EasyImage::RESIZE_AUTO),															

				'sharpen' => 0,
				'background' => '#fff',
				'type' => 'jpg',
				'quality' => 95
			)
		);
	}

	public $approved_status;
	public function getAd_image()
	{
		if (!empty($this->ad_image2)) {
			$data = explode('||F||', $this->ad_image2);
			if (!empty($data)) {

				$this->approved_status = @$data['1'];
				return @$data['0'];
			}
		}
	}
	public function getAd_image_singlenew($w = '0')
	{

		if (!empty($this->ad_images_g)) {

			$data = explode(',', $this->ad_images_g);
			if (!empty($data)) {

				$this->approved_status = 1;
				return $this->generateImageWaterMark($data['0'], $w, $h = '', $opaciti = 60, $wateri = 10);
			}
		} else {
			return '/new_assets/images/mgrey.jpg';
		}
	}
	public $location_image;
	public function getSingleImage($w = '0')
	{

		$image =  $this->ad_image;
		if ($this->approved_status == 'I') {
			return  Yii::app()->apps->getBaseUrl('assets/img/waiting-feeta.jpg');
		}
		if (!empty($image)) {


			return $this->generateImageWaterMark($image, $w, $h = '', $opaciti = 60, $wateri = 10);
			if (strpos($image, '/') !== false) {
				if (defined('DISABLE_WEBP')) {
					return Yii::app()->apps->getBaseUrl('uploads/files/' . $image);
				}
				$ref = self::imgDefault();
				$file_format = 'webp';
				$src =   'uploads/files/' .	 $image;
				if (empty($w)) {
					if ($this->section_id == '3') {
						$w = '1204';
					} else {
						$w = '960';
					}
				}
				$ref->resize($src, 'uploads/mobile_images', $w, 91, $file_format, FALSE);

				return Yii::app()->apps->getBaseUrl($ref->newfilename);;
			} else {
				return  ENABLED_AWS_PATH . $image;
			}
		} else {
			if (!empty($this->location_image)) {

				return Yii::app()->apps->getBaseUrl('uploads/map/' . $this->location_image);
			}

			return  Yii::app()->apps->getBaseUrl('assets/img/waiting-feeta.jpg');
		}
	}
	public function getdetailImages($im, $status, $w = '960')
	{
		if ($status == 'A') {

			if (strpos($im, '/') !== false) {

				if (defined('DISABLE_WEBP')) {
					return Yii::app()->apps->getBaseUrl('uploads/files/' .	$im);
				}
				return $this->generateImageWaterMark($im, $w, $h = '450', $opaciti = 80, $wateri = 20);
				$ref = self::imgDefault();
				$file_format = 'webp';

				$src =   'uploads/files/' .	$im;
				$ref->resize($src, 'uploads/mobile_images', $w, 91, $file_format, FALSE);

				return Yii::app()->apps->getBaseUrl($ref->newfilename);;
			} else {
				return  ENABLED_AWS_PATH . $this->ad_image;
			}
		} else {
			return  Yii::app()->apps->getBaseUrl('assets/img/waiting.png');
		}
	}
	public function detailView($im)
	{

		if (strpos($im, '/') !== false) {



			return Yii::app()->apps->getBaseUrl('uploads/files/' . $im);;
		} else {
			return  ENABLED_AWS_PATH . $im;
		}
	}


	/*
	 public function generateImage($apps,$h=190,$w=285,$s_id=null,$bg=null){
	   $html = '';
	   if(!empty($this->ad_images_g)){
			$itemsI = explode(',',$this->ad_images_g);
			if(!empty($itemsI)){
				foreach($itemsI as $k=>$ad_img){											 
				$html .= '<div>';
				//$image = $apps->getBaseUrl('uploads/images/'.$ad_img); 
				$image = ENABLED_AWS_PATH.$ad_img ; 
				if(!empty($bg)){
					if($k==0){ $htm = 'style="background-image:url(\''.$image.'\')"';$c = 'is-lazy-loaded'; }
					else{  $htm = 'data-lazy="'.$image.'"'; $c = 'lazy-bg-img'; }
					$html .= '<div class="bg-image '.$c.'" '.$htm.' ></div>';
				}else{
					$html .= '<img data-lazy="'. $image.'" alt="">';
				}
				$html .='</div>'; 
				} 
			}
		}
		if(!empty($html)){ 
			
		return $html; }
		else{
				$html .= '<div>';
				$image = ENABLED_AWS_PATH.$ad_img ;  
				$html .= '<img src="'. $image .'" alt="">';
				$html .='</div>';
		}
		return $html; 				 
   }
   * */
	public $city_name;

	public function getCompanyImage()
	{

		if (!empty($this->user_image)) {
			return $this->getDetailImages($this->user_image, 'A', '200');
		} else {
			$name = !empty($this->company_name) ? $this->company_name : $this->first_name;
			$path =  strtolower(substr($name, 0, '1')) . '_p.jpg?q=11';
			return  Yii::App()->apps->getBaseUrl('uploads/avatar/' . $path);
			return Yii::app()->apps->getBaseUrl('assets/img/NoPicAvailable.png');
		}
	}
	public function getUserImage()
	{
		if (!empty($this->image)) {
			return $this->getDetailImages($this->image, 'A');
		} else {
			$name =   $this->first_name;
			$path =  strtolower(substr($name, 0, '1')) . '_p.jpg?q=11';
			return  Yii::App()->apps->getBaseUrl('uploads/avatar/' . $path);
			return Yii::app()->apps->getBaseUrl('assets/img/NoPicAvailable.png');
		}
	}
	public function getCompanyImage2()
	{
		if (!empty($this->user_image)) {
			return $this->getDetailImages($this->user_image, 'A', 90);
		}
	}
	public function getCompanyName()
	{
		if (defined('LANGUAGE') and LANGUAGE == 'ar') {
			if (!empty($this->company_name_ar)) {
				return $this->company_name_ar;
			}
		}
		return  $this->company_name;
	}
	public function getOwnerName()
	{
		if (defined('LANGUAGE') and LANGUAGE == 'ar') {
			if (!empty($this->first_name_ar)) {
				return $this->first_name_ar;
			}
		}
		return $this->first_name . ' ' . $this->last_name;
	}


	public function getExpityConditionFronEnd()
	{
		$condition = '';
		$expiry_condition = Yii::app()->options->get('system.common.no_expiry', '');

		$expiry_days = $this->no_days_forexpity();
		if ($expiry_condition != '1' and !empty($expiry_days)) {

			$condition =   ' and CASE WHEN t.section_id = "3" THEN 1 ELSE    TIMESTAMPDIFF(DAY,(CASE WHEN t.extended_on IS NOT NULL THEN t.extended_on ELSE  t.date_added END),NOW()) <   ' . $expiry_days . ' END ';
		}

		$condition .= "  and  ( plan.max_listing_per_day = '0'  or  plan.max_listing_per_day   > 0  ) and CASE WHEN plan.validity = '0' THEN 1 ELSE    DATEDIFF( NOW(), plan.date_start  ) <=  plan.validity END  and plan.date_start <= CURDATE() ";

		return $condition;
	}
	public function new_homes($country_id = null, $state = null, $limit = 2, $section_id = null, $tag_id = null)
	{
		$criteria = self::model()->search(1);

		//$ids =implode(',', Yii::app()->options->get('system.common.residential_categories'));

		//$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
		$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
		$criteria->join  .= ' left join {{area_unit}} au ON au.master_id = t.area_unit ';
		$criteria->select = 't.*,ct.image as location_image,usr.phone_number as mobile_number ,  cat.category_name as  category_name,ct.city_name, st.state_name as state_name,com.community_name, (SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2  ,usr.image as user_image,usr.first_name,usr.last_name';
		$criteria->select .= ',(SELECT  group_concat(CASE WHEN img.status="A" THEN `image_name` ELSE "waiting-feeta.jpg" END)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0"    )   as ad_images_g';

		$criteria->select .= ',  (t.builtup_area*(1/au.value))   as converted_unit ,au.master_name as atitle';
		//$criteria->condition  .= ' and  t.status="A" and t.category_id in  ('.$ids.')  and t.section_id in ("'.self::SALE_ID.'","'.self::RENT_ID.'")  ';
		//$ids = join('","',Yii::app()->options->get('system.common.residential_categories'));
		//$criteria->params[':category'] =  '(30,95,32,31)' ; 

		$criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"';

		/*empiryCondition*/

		$criteria->join  .= ' left join {{price_plan_order}}  plan on plan.customer_id =    (CASE WHEN usr.parent_user is NOT NULL THEN  usr.parent_user ELSE t.user_id END) and plan.status = "complete"  ';

		/*empiryCondition*/
		if ((isset($formData['sec']) and $formData['sec'] == 'new-development') or (isset($formData['_sec_id']) and $formData['_sec_id'] == '3')) {
		} else {
			$criteria->condition .=  $this->getExpityConditionFronEnd();
		}


		if (!empty($section_id)) {
			$criteria->condition  .= ' and  t.status="A" and  t.section_id =:section    ';
			$criteria->params[':section'] = $section_id;
		}
		if ($country_id) {
			$criteria->condition .= ' and t.country = :country ';
			$criteria->params[':country'] = $country_id;
		}
		if ($state) {
			$criteria->condition .= ' and t.state = :state ';
			$criteria->params[':state'] = $state;
		}
		if (Yii::app()->user->getId()) {
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
		} else {
			if ((isset(Yii::app()->request->cookies['USERFAV']))) {
				$cook =  Yii::app()->request->cookies['USERFAV']->value;
				if (!empty($cook) and is_array($cook)) {

					$userStr = implode("', '", $cook);
					$criteria->select .= " , CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END as fav ";
				}
			}
		}
		if (!empty($tag_id)) {
			switch ($tag_id) {
				case 'R':
					$criteria->condition  .= ' and  t.recmnded="1"     ';
					break;
			}
		}

		$criteria->distinct =  't.id';
		$criteria->limit = $limit;
		return self::model()->findAll($criteria);
	}
	public $section_name;
	public $fav;
	public $is_saved;
	public $c_cation_latitude;
	public $c_location_longitude;
	public $listing_category;
	public function findAds($formData = array(), $count_future = false, $returnCriteria = false, $calculate = false, $user_id = false)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 't.*,' . $this->FetauredQuery . 'usr.company_name,lstype.category_name as listing_category ,  usr.full_number as mobile_number ,  cat.category_name as  category_name , st.state_name as state_name,  (SELECT CONCAT(image_name, "||F||", status) FROM {{ad_image}} img  WHERE  img.ad_id = t.id   and  img.isTrash="0" order by img.status="A" desc  limit 1  )     as ad_image2  ,usr.image as user_image,usr.first_name,usr.last_name';
		$criteria->select .= ',(SELECT  group_concat(CASE WHEN img.status="A" THEN `image_name` ELSE "waiting-feeta.jpg" END order by id asc)  FROM {{ad_image}} img  WHERE  img.ad_id = t.id and      img.isTrash="0" and   img.status="A"   )   as ad_images_g';

		$criteria->compare('t.isTrash', '0');
		if (isset($formData['sta']) and !empty($formData['sta'])) {
			$criteria->compare('t.status', $formData['sta']);
		} else {
			$criteria->compare('t.status', 'A');
		}
		if (!empty($user_id)) {
			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :thisusr or   t.user_id = :thisusr )   ELSE     t.user_id = :thisusr  END ';
			$criteria->params[':thisusr'] = (int) $user_id;
		}

		$criteria->distinct =  't.id';
		$criteria->select .= ',  (t.builtup_area*(1/au.value))   as converted_unit ,au.master_name as atitle';
		$criteria->join  .= ' left join {{category}} lstype ON lstype.category_id = t.listing_type ';
		$criteria->join  .= ' left join {{category}} cat ON cat.category_id = t.category_id ';
		//	$criteria->join  .= ' left join {{community}} com ON com.community_id = t.community_id ';
		$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state ';
		//$criteria->join  .= ' LEFT JOIN {{city}} ct on ct.city_id = t.city'  ;
		//	 $criteria->select .=  ' , ct.location_latitude as c_cation_latitude , ct.location_longitude as c_location_longitude  ';


		$criteria->join  .= ' left join {{area_unit}} au ON au.master_id = t.area_unit ';
		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		$criteria->condition .= ' and usr.status = "A" and usr.isTrash="0"';
		if (Yii::app()->user->getId() and !isset($formData['logged_in'])) {
			$criteria->select .= ' ,fav.ad_id as fav ';
			$criteria->join  .= ' left join {{ad_favourite}} fav ON fav.ad_id = t.id and fav.user_id =:user_me';
			$criteria->params[':user_me'] = Yii::app()->user->getId();
		} else {
			$cookieName = 'USERFAV' . COUNTRY_ID;
			if ((isset(Yii::app()->request->cookies[$cookieName]))) {
				$cook =  Yii::app()->request->cookies[$cookieName]->value;
				if (!empty($cook) and is_array($cook)) {

					$userStr = implode("', '", $cook);
					$criteria->select .= " , CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END as fav ";
				}
			}
		}
		if (isset($formData['user_fav_only'])) {
			if (Yii::app()->user->getId() and !isset($formData['logged_in'])) {

				$criteria->condition  .= '  and fav.ad_id is NOT NULL ';
			} else {
				$dataC = array();
				$cookieName = 'USERFAV' . COUNTRY_ID;
				if ((isset(Yii::app()->request->cookies[$cookieName]))) {
					$dataC =  Yii::app()->request->cookies[$cookieName]->value;
				}

				$dataC	= (array) $dataC;
				$userStr = implode("', '", $dataC);
				$criteria->condition .= " and  CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END   ";
			}
		}
		if (isset($formData['last_viewed'])) {
			$last_viewed = array();
			$dataC = array();
			if ((isset(Yii::app()->request->cookies['my_views_n' . COUNTRY_ID]))) {
				$dataC =  Yii::app()->request->cookies['my_views_n' . COUNTRY_ID]->value;
			}
			$dataC	= (array) $dataC;
			$userStr = implode("', '", $dataC);
			$criteria->condition .= " and  CASE WHEN t.id  in ('{$userStr}') THEN 1 ELSE 0 END   ";
		}
		// print_r($formData);exit;dealer
		if (isset($formData['user_id']) and !empty($formData['user_id'])) {

			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :user_id or   t.user_id = :user_id )   ELSE     t.user_id = :user_id  END ';
			$criteria->params[':user_id'] = (int)  $formData['user_id'];
			if (isset($formData['dealer'])) {
				unset($formData['dealer']);
			}
		}
		$criteria->join  .=   ' LEFT JOIN {{listing_users}} p_usr1 on p_usr1.user_id = usr.parent_user ';
		$criteria->select .=  ' , CASE WHEN usr.parent_user is NOT NULL THEN p_usr1.image ELSE usr.image END user_image , CASE WHEN p_usr1.user_id  is NOT NULL THEN p_usr1.company_name ELSE usr.company_name END as company_name ';

		if (isset($formData['dealer']) and !empty($formData['dealer'])) {

			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (p_usr1.slug = :dealer or    usr.slug = :dealer )   ELSE     usr.slug = :dealer  END ';
			$criteria->params[':dealer'] =  $formData['dealer'];
		}
		if (isset($formData['floor']) and !empty($formData['floor'])) {
			$criteria->join  .=   ' LEFT JOIN {{ad_floor_plan}} ad_fp on ad_fp.ad_id = t.id ';
			$criteria->condition .= ' and ad_fp.ad_id is NOT NULL   ';
		}
		if (isset($formData['video']) and !empty($formData['video'])) {
			$criteria->join  .=   ' LEFT JOIN {{video_urs}} ad_vd on ad_vd.ad_id = t.id ';
			$criteria->condition .= ' and ad_vd.ad_id is NOT NULL   ';
		}
		if (isset($formData['_sec_id']) and !empty($formData['_sec_id'])) {
			$criteria->condition .= ' and t.section_id =:new_section_id ';
			$criteria->params[':new_section_id'] = $formData['_sec_id'];
		}
		if (!isset($formData['_sec_id']) and !isset($formData['sec'])) {
			$criteria->condition .= ' and t.section_id != 3 ';
		}
		if (isset($formData['project_title']) and !empty($formData['project_title'])) {
			$criteria->condition .= ' and t.ad_title =:ad_title2 ';
			$criteria->params[':ad_title2'] = $formData['project_title'];
		}
		if (isset($formData['_state_id']) and !empty($formData['_state_id'])) {
			$criteria->condition .= ' and t.state =:_state_id ';
			$criteria->params[':_state_id'] = $formData['_state_id'];
		}
		if (isset($formData['state']) and !empty($formData['state'])) {
			$criteria->condition .= ' and st.slug=:state ';
			$criteria->params[':state'] = $formData['state'];
		}
		if (isset($formData['country']) and !empty($formData['country'])) {
			$criteria->condition .= ' and t.country=:country ';
			$criteria->params[':country'] = $formData['country'];
		}
		if (isset($formData['por']) and !empty($formData['por'])) {
			$criteria->condition .= ' and t.p_o_r=:por ';
			$criteria->params[':por'] = $formData['por'];
		}
		if (defined('COUNTRY_ID')) {
			$criteria->condition .= ' and t.country=:country1 ';
			$criteria->params[':country1'] = COUNTRY_ID;
		}
		/*
		else if(isset($formData['country']) and !empty($formData['country'])){
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country ';
			$criteria->condition .= ' and cn.slug=:country ';$criteria->params[':country'] = $formData['country'];
		}
		* */ else if (isset($formData['country']) and !empty($formData['country'])) {
			$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country ';
			$criteria->condition .= ' and cn.slug=:country ';
			$criteria->params[':country'] = $formData['country'];
		}
		if (isset($formData['section_id']) and !empty($formData['section_id'])) {
			$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
			$criteria->condition .= ' and sec.slug=:section_id ';
			$criteria->params[':section_id'] = $formData['section_id'];
		} else if (isset($formData['sec']) and !empty($formData['sec'])) {
			$criteria->join  .= ' left join {{section}} sec ON sec.section_id = t.section_id ';
			$criteria->condition .= ' and sec.slug=:sec ';
			$criteria->params[':sec'] = $formData['sec'];
		}
		if (isset($formData['minPrice']) and !empty($formData['minPrice'])) {

			$criteria->condition .= ' and t.price>=:minPrice ';
			$criteria->params[':minPrice'] = $formData['minPrice'];
		}
		if (isset($formData['maxPrice']) and !empty($formData['maxPrice'])) {

			$criteria->condition .= ' and t.price<=:maxPrice ';
			$criteria->params[':maxPrice'] = $formData['maxPrice'];
		}
		if (isset($formData['locality']) and !empty($formData['locality'])) {

			$criteria->condition .= ' and   ct.slug = :locality ';
			$criteria->params[':locality'] = $formData['locality'];
		}
		if (isset($formData['loc']) and !empty($formData['loc'])) {

			$criteria->condition .= ' and lower(t.area_location) like :area_location1 ';
			$criteria->params[':area_location1'] = '%' . strtolower($formData['loc']) . '%';
		}

		if (isset($formData['bedrooms']) and !empty($formData['bedrooms'])) {
			if ($formData['bedrooms'] == '5') {
				$criteria->condition .= ' and t.bedrooms >=:bedrooms and  t.bedrooms != "15" ';
			} else {
				$criteria->condition .= ' and t.bedrooms =:bedrooms ';
			}
			$criteria->params[':bedrooms'] = $formData['bedrooms'];
		}
		if (isset($formData['rent_paid']) and !empty($formData['rent_paid'])) {
			$criteria->condition .= ' and t.rent_paid =:rent_paid ';
			$criteria->params[':rent_paid'] = $formData['rent_paid'];
		}

		if (isset($formData['type_of']) and !empty(array_filter((array)$formData['type_of'])) and is_array($formData['type_of'])) {
			if (isset($formData['sec']) and $formData['sec'] == 'new-development') {
				/*New Development Multiple*/
				$criteria->join .= ' LEFT JOIN {{place_an_ad_categories}} ad_cat on ad_cat.ad_id = t.id   ';

				if (sizeOf($formData['type_of']) == '1') {
					$criteria->condition .= ' and ad_cat.category_id =:type_of ';
					$criteria->params[':type_of'] = @$formData['type_of'][0];
				} else {
					$cam =  Category::model()->findByAttributes(array('slug' => $formData['type_of']));
					if ($cam) {
						$criteria->addInCondition('ad_cat.category_id', $cam->category_id);
					}
				}
			} else {
				if (sizeOf($formData['type_of']) == '1') {

					$criteria->condition .= ' and t.category_id =:type_of ';
					$criteria->params[':type_of'] = @$formData['type_of'][0];
				} else {
					$criteria->addInCondition('t.category_id', $formData['type_of']);
				}
			}
		} else if (!empty($formData['type_of']) and   @$formData['sec'] != 'new-development') {


			if (strpos($formData['type_of'], '|') !== false) {
				$str = explode('|', $formData['type_of']);
				if (isset($str['1'])) {
					$criteria->condition .= ' and cat.slug =:type_of ';
					$criteria->params[':type_of'] = $str['1'];
					$criteria->condition .= ' and lstype.slug =:lstype ';
					$criteria->params[':lstype'] = $str['0'];
				}
			} else {
				$criteria->condition .= ' and lstype.slug =:lstype ';
				$criteria->params[':lstype'] = $formData['type_of'];
				//$criteria->condition .= ' and cat.slug =:type_of ';$criteria->params[':type_of'] = @$formData['type_of'] ;
			}
		} else if (!empty($formData['type_of']) and   @$formData['sec'] == 'new-development') {
			$criteria->join .= ' LEFT JOIN {{place_an_ad_categories}} ad_cat on ad_cat.ad_id = t.id   ';
			$cam =   Category::model()->findByAttributes(array('slug' => $formData['type_of']));
			if ($cam) {
				$criteria->condition .= ' and ad_cat.category_id =:type_of ';
				$criteria->params[':type_of'] = $cam->category_id;
			}
		}

		if (isset($formData['locations']) and !empty(array_filter((array)$formData['locations'])) and is_array($formData['locations'])) {
			if (sizeOf($formData['locations']) == '1') {
				$criteria->condition .= ' and t.city =:locations ';
				$criteria->params[':locations'] = @$formData['locations'][0];
			} else {
				$criteria->addInCondition('t.city', $formData['locations']);
			}
		}
		if (isset($formData['keyword']) and !empty($formData['keyword'])) {
			$criteria->condition .= ' and ( t.ad_title like :keyword or t.ad_description like :keyword )   ';
			$criteria->params[':keyword'] = '%' . $formData['keyword'] . '%';
		}
		if (isset($formData['mkeyword']) and !empty($formData['mkeyword'])) {
			$criteria->condition .= ' and ( t.ad_title like :mkeyword or t.ad_description like :mkeyword or ct.city_name like :mkeyword  or usr.company_name like :mkeyword   )   ';
			$criteria->params[':mkeyword'] = '%' . $formData['mkeyword'] . '%';
		}
		/*
		if(isset($formData['word']) and !empty($formData['word'])){
			$criteria->condition .= ' and ( t.ad_title like :word or t.ad_description like :word or ct.city_name like :word  )   ';$criteria->params[':word'] = '%'.$formData['word'].'%';
		}
		*/
		if (isset($formData['lat']) and !empty($formData['lat'])  and isset($formData['lng']) and !empty($formData['lng'])) {


			$criteria->condition .= ' and t.location_latitude is not null  and (111.045 * DEGREES(ACOS(COS(RADIANS(:lat))
				* COS(RADIANS(t.location_latitude))
				* COS(RADIANS(t.location_longitude) - RADIANS(:lng))
				+ SIN(RADIANS(:lat))
				* SIN(RADIANS(t.location_latitude))))) < 15  ';
			$criteria->params[':lat']  =  $formData['lat'];
			$criteria->params[':lng']  =  $formData['lng'];
		} else if (isset($formData['word']) and !empty($formData['word'])) {

			$word = $formData['word'];
			$criteria->condition .= ' and ( ad_title like :word or ad_description like :word   ';

			if (defined('LANGUAGE') and LANGUAGE != 'en') {

				$criteria->condition .=  '  or (CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name END)  like :word  or  (CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE cat.category_name  END) like :word  or  (CASE WHEN tdata25.message   IS NOT NULL THEN tdata25.message ELSE lstype.category_name  END)  like :word  ';
			} else {
				$criteria->condition .=  '  or  state_name like :word  or  cat.category_name like :word  or  lstype.category_name  like :word  ';
			}
			$criteria->condition .=  ' ) ';
			$criteria->params[':word'] = '%' . $formData['word'] . '%';
		}

		if (isset($formData['term']) and !empty($formData['term'])) {
			$criteria->condition .= ' and ( t.ad_title like :term or t.ad_description like :term and t.section_id in("1","2")  )   ';
			$criteria->params[':term'] = '%' . $formData['term'] . '%';
		}
		if (empty($returnCriteria)  and isset($formData['a']) and !empty($formData['a']) and isset($formData['b']) and !empty($formData['b']) and isset($formData['c']) and !empty($formData['c']) and isset($formData['d']) and !empty($formData['d'])) {
			$condition1 = $formData['a'] < $formData['c'] ? "t.location_latitude > :a AND t.location_latitude < :c" : "(t.location_latitude > :a OR t.location_latitude < :c)";
			$condition2 = $formData['b'] < $formData['d'] ? "t.location_longitude > :b AND t.location_longitude < :d" : "(t.location_longitude > :d OR t.location_longitude < :b)";
			$q = " and ( $condition1 ) AND ( $condition2 )";
			$criteria->condition .=  $q;
			//$criteria->condition .=  ' and   t.location_latitude > :a AND  t.location_latitude  < :c AND  t.location_longitude > :b AND  t.location_longitude < :d ' ; 
			//$criteria->condition .=  ' and   (CASE WHEN :a < :c         THEN  t.location_latitude BETWEEN :a AND :c         ELSE  t.location_latitude BETWEEN :c AND :a END) AND (CASE WHEN :b < :d         THEN  t.location_longitude BETWEEN :b AND :d         ELSE  t.location_longitude BETWEEN :d AND :b END) ' ; 
			$criteria->params[':a'] = $formData['a'];
			$criteria->params[':b'] = $formData['b'];
			$criteria->params[':c'] = $formData['c'];
			$criteria->params[':d'] =  $formData['d'];
		}
		if (isset($formData['listing_type']) and !empty($formData['listing_type']) and $formData['listing_type'] != 'B') {
			$criteria->condition .= ' and t.listing_type =:listing_type ';
			$criteria->params[':listing_type'] = $formData['listing_type'];
		}
		if (isset($formData['bathrooms']) and !empty($formData['bathrooms'])) {
			if ($formData['bathrooms'] == '5') {
				$criteria->condition .= ' and t.bathrooms >=:bathrooms ';
			} else {
				$criteria->condition .= ' and t.bathrooms =:bathrooms ';
			}
			$criteria->params[':bathrooms'] = $formData['bathrooms'];
		}
		$having = '';

		if (isset($formData['minSqft']) and !empty($formData['minSqft'])) {
			if (defined('AREAVALUE')) {
				$valUnit = $formData['minSqft'] * (1 / AREAVALUE);
			} else {
				$valUnit = $formData['minSqft'];
			}
			//	$having .= ' and  converted_unit   >=:minSqft ';$criteria->params[':minSqft'] = (int) $valUnit;
			$criteria->condition .=  ' and  (t.builtup_area*(1/au.value))   >=:minSqft ';
			$criteria->params[':minSqft'] = (int) $valUnit;
		}
		if (isset($formData['maxSqft']) and !empty($formData['maxSqft'])) {

			if (defined('AREAVALUE')) {
				$valUnit = $formData['maxSqft'] * (1 / AREAVALUE);
			} else {
				$valUnit = $formData['maxSqft'];
			}
			//	$having .= ' and  converted_unit <=:maxSqft ';$criteria->params[':maxSqft'] =  (int) $valUnit;
			$criteria->condition .=  ' and  (t.builtup_area*(1/au.value)) <=:maxSqft ';
			$criteria->params[':maxSqft'] =  (int) $valUnit;
		}
		if (!empty($having)) {
			$criteria->having = '1 ' . $having;
		}

		if (isset($formData['community']) and !empty($formData['community'])) {
			$criteria->condition .= ' and com.community_id  =:community ';
			$criteria->params[':community'] = $formData['community'];
		}


		$criteria->join  .= ' left join `mw_translate` `translatead` on (  translatead.source_tag = concat("PlaceAnAd_ad_title_",t.id) )          left join `mw_translate_relation` `translationRelationad` on translationRelationad.ad_id = t.id  and  translationRelationad.translate_id = translatead.translate_id  LEFT  JOIN mw_translation_data tdataad ON (`translationRelationad`.translate_id=tdataad.translation_id and tdataad.lang=:lan2  ) ';
		$criteria->select .= ',tdataad.message as ad_title2 ';
		$criteria->params[':lan2'] = 'ar';


		if (defined('LANGUAGE')) {
			$langaugae = LANGUAGE;
			if (!empty($langaugae) and  $langaugae != 'en') {
				//	$criteria->condition  .= ' and  use SET SQL_BIG_SELECTS=1 '; 
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = st.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message   IS NOT NULL THEN tdata.message ELSE st.state_name  END as  state_name  ';

				/*
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation5` on translationRelation5.city_id = ct.city_id   LEFT  JOIN mw_translation_data tdata5 ON (`translationRelation5`.translate_id=tdata5.translation_id and tdata5.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata5.message   IS NOT NULL THEN tdata5.message ELSE ct.city_name  END as  city_name  ';
				*/
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation15` on translationRelation15.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata15 ON (`translationRelation15`.translate_id=tdata15.translation_id and tdata15.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE cat.category_name  END as  category_name  ';


				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation25` on translationRelation25.category_id = t.listing_type   LEFT  JOIN mw_translation_data tdata25 ON (`translationRelation25`.translate_id=tdata25.translation_id and tdata25.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata25.message   IS NOT NULL THEN tdata25.message ELSE lstype.category_name  END as  listing_category  ';

				$criteria->distinct   = 't.id';
				$criteria->params[':lan'] = $langaugae;
			}
		}


		$criteria->join  .= ' left join {{price_plan_order}}  plan on plan.customer_id =    (CASE WHEN usr.parent_user is NOT NULL THEN  usr.parent_user ELSE t.user_id END) and plan.status = "complete"  ';

		/*empiryCondition*/
		if ((isset($formData['sec']) and $formData['sec'] == 'new-development') or (isset($formData['_sec_id']) and $formData['_sec_id'] == '3')) {
		} else {
			$criteria->condition .=  $this->getExpityConditionFronEnd();
		}



		$order_val = '';
		if (isset($formData['sort'])  and !empty($formData['sort'])) {
			$order_val = $formData['sort'];
		}

		switch ($order_val) {

			case 'best-asc':
				$order  = 't.id desc';
				//	$order  = $this->getFetauredOrder().' ,t.verified="1" desc,-t.priority desc , t.last_updated desc ';
				break;
			case 'date-desc':
				$order  = 't.id desc';
				break;
			case 'roi-desc':
				$order  = 't.roi desc';
				break;
			case 'roi-asc':
				$order  = 't.roi asc';
				break;
			case 'net-income-desc':
				$order  = 't.income desc';
				break;
			case 'net-income-asc':
				$order  = 't.income asc';
				break;
			case 'date-asc':
				$order  = 't.id asc';
				break;
			case 'price-asc':
				$order  = 't.price  asc';
				break;
			case 'price-desc':
				$order  = 't.price  desc';
				break;
			case 'baths-desc':
				$order  = 't.bathrooms  desc';
				break;
			case 'beds-desc':
				$order  = 't.bedrooms  desc';
				break;
			case 'beds-asc':
				$order  = 't.bedrooms  asc';
				break;
			case 'sqft-desc':
				$order  = 't.builtup_area  desc';
				break;
			case 'sqft-asc':
				$order  = 't.builtup_area  asc';
				break;
			case 'int-desc':
				$order  = 't.interior_size   desc';
				break;
			case 'featured':
				$order  = $this->getFetauredOrder() . ',-t.priority desc , t.last_updated desc ';
				break;
			case 'verified':
				$order  = 't.verified="1" desc,-t.priority desc , t.last_updated desc ';
				break;
			case 'title-asc':
				$order  = 't.ad_title asc ';
				break;
			default:
				$order  = $this->getFetauredOrder() . ' ,t.verified="1" desc ,-t.priority desc , t.last_updated desc ';
				break;
		}

		$criteria->order  =   $order;
		if (isset($formData['latitude']) and !empty($formData['latitude'])  and isset($formData['longitude']) and !empty($formData['longitude'])) {
			$criteria->order  .=  ' , (111.045 * DEGREES(ACOS(COS(RADIANS(:lat))
				* COS(RADIANS(t.location_latitude))
				* COS(RADIANS(t.location_longitude) - RADIANS(:lng))
				+ SIN(RADIANS(:lat))
				* SIN(RADIANS(t.location_latitude))))) asc ';
		}

		$total = false;
		if ($returnCriteria) {
			return $criteria;
		}

		$criteria->limit  = Yii::app()->request->getQuery('limit', '10');
		$criteria->offset = Yii::app()->request->getQuery('offset', '0');
		/* SaFE neighbours */
		if (isset($formData['sort'])  and  $formData['sort'] == 'custom') {
			if (isset($formData['s_limit'])) {
				$criteria->limit  =  $formData['s_limit'];
			} else {
				$criteria->limit  =  5;
			}
			$criteria->order  =   $formData['custom_order'];
		}
		if ($calculate and $criteria->offset == 0) {
			$total = self::model()->count($criteria);
		}
		if (!empty($count_future)) {
			$Result = self::model()->findAll($criteria);
			$criteria->offset = $criteria->limit + $criteria->offset;
			//$criteria->select = 't.id'; 
			$criteria->limit = '1';
			$future_count = self::model()->find($criteria);
			return array('result' => $Result, 'future_count' => $future_count, 'total' => $total);
		} else {
			return  self::model()->findAll($criteria);
		}
	}
	public $state_slug;
	public $sec_slug;
	public $sub_category_name;
	public function getPriceTitle($code = '')
	{

		$code = $this->currencyTitle;
		$html =  $code . number_format($this->price, 0, '.', ',');
		if ($this->section_id == self::RENT_ID) {
			$html .= '/' . $this->RentPaid3;
		}
		return $html;
	}
	public function getPriceTitleSpan($code = '')
	{

		$code = $this->currencyTitle;
		$html =  '<span class="pri sec_' . $this->section_id . '">' . number_format($this->price, 0, '.', ',') . '</span> ' . $code;
		if ($this->section_id == self::RENT_ID) {
			$html .= '/' . $this->RentPaid3;
		}
		return $html;
	}
	public function getPriceTitleDetail()
	{
		$html = $this->currencyTitle . number_format($this->price, 0, '.', ',');
		if ($this->section_id == self::RENT_ID) {
			$html .= '/' . $this->RentPaid3;
		}
		return $html;
	}
	public function getBuiltUpAreaTitle()
	{
		return number_format($this->builtup_area, 0, '.', ',') . ' sqft';
	}
	public function getBathroomTitle()
	{
		if ($this->bathrooms == '11') {
			$this->bathrooms = '10+';
		}
		return  $this->bathrooms . '';
	}
	public function getBedroomTitle()
	{
		if ($this->bedrooms == '11') {
			$this->bedrooms = '10+';
		}
		if ($this->bedrooms == '15') {
			$this->bedrooms = $this->mTag()->getTag('studio', 'Studio');
		}
		return  $this->bedrooms . '';
	}
	public $ad_title2;
	public function getAdTitle2()
	{
		if ($this->is_rtl($this->ad_title) and LANGUAGE == 'en') {
			if (!empty($this->ad_title2)) {
				return $this->ad_title2;
			}
		} else if (!$this->is_rtl($this->ad_title) and LANGUAGE == 'ar') {
			if (!empty($this->ad_title2)) {
				return $this->ad_title2;
			}
		}
		return   $this->ad_title;
	}
	public $ad_description2;
	public function getAdDescription2()
	{
		if ($this->is_rtl($this->ad_description) and LANGUAGE == 'en') {
			if (!empty($this->ad_description2)) {
				return $this->ad_description2;
			}
		}
		if (!$this->is_rtl($this->ad_description) and LANGUAGE == 'ar') {
			if (!empty($this->ad_description2)) {
				return $this->ad_description2;
			}
		}
		return   $this->ad_description;
	}

	public $area_location2;
	public function getAreaLocation()
	{
		if ($this->is_rtl($this->area_location) and LANGUAGE == 'en') {
			if (!empty($this->area_location2)) {
				return $this->area_location2;
			}
		}
		if (!$this->is_rtl($this->area_location) and LANGUAGE == 'ar') {
			if (!empty($this->area_location2)) {
				return $this->area_location2;
			}
		}
		return   $this->area_location;
	}

	public function   is_rtl($string)
	{
		$rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
		return preg_match($rtl_chars_pattern, $string);
	}

	public function getAdTitle()
	{
		if ($this->section_id == '3') {
			return $this->ad_title;
		}
		return  Ucfirst(strtolower($this->ad_title));
	}
	public function DetailUrl2($lan)
	{
		if ($lan == 'en' and !empty($this->slug_en)) {
			return Yii::app()->createUrl('detail/index/section/' . $this->section_id, array('slug_en' => $this->slug_en));
		}
		if ($lan == 'ar' and !empty($this->slug_ar)) {
			return Yii::app()->createUrl('detail/index/section/' . $this->section_id, array('slug_ar' => $this->slug_ar));
		}
		return Yii::app()->createUrl('detail/index/section/' . $this->section_id, array('slug' => $this->slug));
	}
	public function getDetailUrl()
	{
		if ($this->section_id == self::NEW_ID) {
			return Yii::app()->createUrl('detail/project', array('slug' => $this->slug));
		}
		if ($this->section_id == '6') {
			return Yii::app()->createUrl('detail/index_business/section/' . $this->section_id, array('slug' => $this->slug));
		}
		//	return Yii::app()->createAbsoluteUrl('detail/index',array('id'=>$this->id));
		if (defined('LANGUAGE') and LANGUAGE == 'en' and !empty($this->slug_en)) {
			return Yii::app()->createUrl('detail/index/section/' . $this->section_id, array('slug_en' => $this->slug_en));
		}
		if (defined('LANGUAGE') and LANGUAGE == 'ar' and !empty($this->slug_ar)) {
			return Yii::app()->createUrl('detail/index/section/' . $this->section_id, array('slug_ar' => $this->slug_ar));
		}
		return Yii::app()->createUrl('detail/index/section/' . $this->section_id, array('slug' => $this->slug));
	}
	public function getCheckApproveUrl()
	{
		return Yii::app()->apps->getAppUrl('frontend', 'detail/checkapprove/id/' . $this->uid . '?showTrash=1&check_approve=1', true);
	}
	public function checkandapproveproperty()
	{
		//echo "WER";exit;
		$emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid('rb249044gj2db');
		$emailTemplate_common = $this->commonTemplate();
		$options     =   Yii::app()->options;
		$support_phone  =  $options->get('system.common.support_phone');
		$support_email  =  $options->get('system.common.support_email');
		$notify     = Yii::app()->notify;
		if (empty($emailTemplate)) {
			return true;
		} else {
			$account_manager_id   = !empty($this->parent_user) ? $this->parent_user : $this->user_id;
			$account_managerModel = ListingUsers::model()->findByPk($account_manager_id);
			if (empty($account_managerModel)) {
				return false;
			}

			$subject =    $emailTemplate->subject;
			$emailTemplate = $emailTemplate->content;

			$emailTemplate = str_replace('[NAME]', $account_managerModel->first_name . ' ' . $account_managerModel->last_name, $emailTemplate);
			$emailTemplate = str_replace('[TITLE]', '<b>' . $this->ad_title . '</b>', $emailTemplate);
			$emailTemplate = str_replace('REFERNCE_NUMER', $this->ReferenceNumberTitle, $emailTemplate);
			$emailTemplate = str_replace('[APPROVE_LINK]', CHtml::link('Check and Approve', $this->CheckApproveUrl, array('style' => 'color:#fff;background-color:#f27f52;font-size:14px;padding:5px 10px;text-align:center;min-width:200px;text-decoration:none')), $emailTemplate);

			$status = 'S';

			$adminEmail = new Email();
			$adminEmail->subject = $subject;
			$adminEmail->message =   Yii::t('app', $emailTemplate_common, array('[CONTENT]' => $emailTemplate));

			$receipeints = serialize(array($account_managerModel->email));

			$adminEmail->status = $status;
			$adminEmail->receipeints = $receipeints;
			$adminEmail->sent_on =   1;
			$adminEmail->type =   'S';
			$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
			$adminEmail->save(false);
			$adminEmail->getSend(false);
		}

		//return true; 
	}
	public function getDetailUrlAbs()
	{
		if ($this->section_id == self::NEW_ID) {
			return Yii::app()->createAbsoluteUrl('detail/project', array('slug' => $this->slug));
		}
		/*
		if(defined('LANGUAGE') and LANGUAGE=='en'){
			return Yii::app()->createAbsoluteUrl('detail/short_link/section/'.$this->section_id,array('id'=>$this->id,'lan'=>LANGUAGE));
		}
		*/
		return Yii::app()->createAbsoluteUrl('detail/index', array('id' => $this->id));
		return Yii::app()->createAbsoluteUrl('detail/short_link/section/' . $this->section_id, array('id' => $this->id));
	}
	public function getDetailUrlAbsolute()
	{
		if ($this->section_id == self::NEW_ID) {
			return Yii::app()->createAbsoluteUrl('detail/project', array('slug' => $this->slug));
		}
		return Yii::app()->createAbsoluteUrl('detail/index', array('slug' => $this->slug));
	}
	public function getDetailUrlAbsoluteMobile()
	{
		if ($this->section_id == self::NEW_ID) {
			return  'https://www.askaan.com/project/' . $this->slug;
		}
		return  'https://www.askaan.com/property/' . $this->slug;
	}
	public function getLocationTitle()
	{
		if (!empty($this->community_name)) {
			return $this->community_name . ',' . $this->state_name;
		}
		$html =  ''; // trim($this->city_name);
		if (empty($html)) {
			return trim($this->state_name);
		}
		return $html . ' , ' . $this->state_name;
	}
	public function getMainImage()
	{
		return Yii::app()->apps->getBaseUrl('uploads/images/' . $this->ad_image);
	}
	public function getMainImageResized($height = 100, $width = 100)
	{
		$app = Yii::app();
		return $app->apps->getBaseUrl('timthumb.php') . '?src=' . $app->apps->getBaseUrl('uploads/images/' . $this->ad_image) . '&h=' . $height . '&w=' . $width . '&zc=1';
	}
	public function GetMapHtml()
	{
		$html =  '<div class="cardPhoto backgroundPulse " style="height:80px;width:auto;background-image:url(' . $this->getSingleImage("150") . '); background-position:center center;background-size: cover;" data-reactid="' . $this->id . '"><div class="tagsListContainer" data-reactid="' . $this->id . '"></div></div><div class="cardDetails man pts pbn phm h6 typeWeightNormal" data-reactid="' . $this->id . '"><div data-reactid="' . $this->id . '"><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate" data-reactid="59">' . $this->PriceTitle . '</span></div><ul class="listInline typeTruncate mvn" data-reactid="62"> <li data-auto-test="beds" data-reactid="">  <i class="iconBed" data-reactid=""></i>' . $this->BedroomTitle . '</li> <li data-auto-test="baths" data-reactid=""><i class="iconBath" data-reactid=""></i>' . $this->BathroomTitle . '</li>';
		if (!empty($this->builtup_area)) {
			$html .= '<li data-auto-test="sqft" data-reactid="">' . $this->BuiltUpAreaTitle . '</li>';
		}
		$html .= '</ul></div><div class="cardDetails man pts pbn phm h6 typeWeightNormal" data-reactid="' . $this->id . '"><div data-reactid="' . $this->id . '"><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate" data-reactid="59" style="width:120px;font-size:12px;">' . $this->ad_title . '</span></div><div></div>';
		return $html;
	}
	public function getCurrencyCode()
	{
		return $this->currencyTitle;
	}
	public function getPriceArray($no_colde = false)
	{
		if (!$no_colde) {
			$code = $this->currencycode;
		} else {
			$code = '';
		}
		$code = '';
		return
			array(
				'10000' => $code . '10,000',
				'20000' => $code . '20,000',
				'30000' => $code . '30,000',
				'50000' => $code . '50,000',
				'100000' => $code . '100,000',
				'130000' => $code . '130k',
				'150000' => $code . '150k',
				'200000' => $code . '200k',
				'250000' => $code . '250k',
				'300000' => $code . '300k',
				'350000' => $code . '350k',
				'400000' => $code . '400k',
				'450000' => $code . '450k',
				'500000' => $code . '500k',
				'550000' => $code . '550k',
				'600000' => $code . '600k',
				'650000' => $code . '650k',
				'700000' => $code . '700k',
				'750000' => $code . '750k',
				'800000' => $code . '800k',
				'850000' => $code . '850k',
				'900000' => $code . '900k',
				'950000' => $code . '950k',
				'1000000' => $code . '1m',

			);
	}
	public function getPriceArrayTo()
	{
		$Million = $this->mTag()->getTag('million', 'Million');
		$Millions = $Million;
		$Billion = $this->mTag()->getTag('billion', 'Billion');
		$Billions = $Billion;
		if ($this->section_id == 'property-for-rent') {
			return $this->getPriceArrayFromRentTo();
		}
		if (defined('SYSTEM_CURRENCY') && SYSTEM_CURRENCY == "1") {
			return array(
				'20000' => '20,000',
				'30000' => '30,000',
				'40000' => '40,000',
				'50000' => '50,000',
				'60000' => '60,000',
				'85000' => '85,000',
				'110000' => '110,000',
				'135000' => '135,000',
				'160000' => '160,000',
				'185000' => '185,000',
				'210000' => '210,000',
				'235000' => '235,000',
				'260000' => '260,000',
				'285000' => '285,000',
				'310000' => '310,000',
				'335000' => '335,000',
				'360000' => '360,000',
				'410000' => '410,000',
				'460000' => '460,000',
				'510,000' => '510,000',
				'560000' => '560,000',
				'610000' => '610,000',
				'660000' => '660,000',
				'710000' => '710,000',
				'760000' => '760,000',
				'810000' => '810,000',
				'910000' => '910,000',
				'1010000' => '1,010,000',
				'2010000' => '2,010,000',
			);
		} else {

			return
				array(
					//''=>'',
					'200000' => '200,000',
					'225000' => '225,000',
					'250000' => '250,000',
					'275000' => '275,000',
					'300000' => '300,000',
					'325000' => '325,000',
					'350000' => '350,000',
					'400000' => '400,000',
					'450000' => '450,000',
					'500000' => '500,000',
					'1000000' => '1 ' . $Million,
					'2000000' => '2 ' . $Millions,
					'3500000' => '3.5 ' . $Millions,
					'5000000' => '5 ' . $Millions,
					'6500000' => '6.5 ' . $Millions,
					'8000000' => '8 ' . $Millions,
					'10000000' => '10 ' . $Millions,
					'12500000' => '12.5 ' . $Millions,
					'15000000' => '15 ' . $Millions,
					'17500000' => '17.5 ' . $Millions,
					'20000000' => '20 ' . $Millions,
					'25000000' => '25 ' . $Millions,
					'30000000' => '30 ' . $Millions,
					'40000000' => '40 ' . $Millions,
					'50000000' => '50 ' . $Millions,
					'75000000' => '75 ' . $Millions,
					'100000000' => '100 ' . $Millions,
					'250000000' => '250 ' . $Millions,
					'500000000' => '500 ' . $Millions,
					'1000000000' => '1 ' . $Billion,
					'5000000000' => '5 ' . $Billions,
				);
		}
	}
	public function getPriceArrayFromRent()
	{
		return 	  array(
			'0' => '0',
			'20000' => '20,000',
			'30000' => '30,000',
			'40000' => '40,000',
			'50000' => '50,000',
			'60000' => '60,000',
			'85000' => '85,000',
			'110000' => '110,000',
			'135000' => '135,000',
			'160000' => '160,000',
			'185000' => '185,000',
			'210000' => '210,000',
			'235000' => '235,000',
			'260000' => '260,000',
			'285000' => '285,000',
			'310000' => '310,000',
			'335000' => '335,000',
			'360000' => '360,000',
			'410000' => '410,000',
			'460000' => '460,000',
			'510,000' => '510,000',
			'560000' => '560,000',
			'610000' => '610,000',
			'660000' => '660,000',
			'710000' => '710,000',
			'760000' => '760,000',
			'810000' => '810,000',
			'910000' => '910,000',

		);
	}
	public function getPriceArrayFrom()
	{
		if ($this->section_id == 'property-for-rent') {
			return $this->getPriceArrayFromRent();
		}

		$Million = $this->mTag()->getTag('million', 'Million');
		$Millions = $Million;
		$Billion = $this->mTag()->getTag('billion', 'Billion');
		$Billions = $Billion;


		$prices = array(
			'' => '0',
			'200000' => '200,000',
			'225000' => '225,000',
			'250000' => '250,000',
			'275000' => '275,000',
			'300000' => '300,000',
			'325000' => '325,000',
			'350000' => '350,000',
			'400000' => '400,000',
			'450000' => '450,000',
			'500000' => '500,000',
			'1000000' => '1 ' . $Million,
			'2000000' => '2 ' . $Millions,
			'3500000' => '3.5 ' . $Millions,
			'5000000' => '5 ' . $Millions,
			'6500000' => '6.5 ' . $Millions,
			'8000000' => '8 ' . $Millions,
			'10000000' => '10 ' . $Millions,
			'12500000' => '12.5 ' . $Millions,
			'15000000' => '15 ' . $Millions,
			'17500000' => '17.5 ' . $Millions,
			'20000000' => '20 ' . $Millions,
			'25000000' => '25 ' . $Millions,
			'30000000' => '30 ' . $Millions,
			'40000000' => '40 ' . $Millions,
			'50000000' => '50 ' . $Millions,
			'75000000' => '75 ' . $Millions,
			'100000000' => '100 ' . $Millions,
			'250000000' => '250 ' . $Millions,
			'500000000' => '500 ' . $Millions,
			'1000000000' => '1 ' . $Billions,
		);
		if (defined('SYSTEM_CURRENCY') && SYSTEM_CURRENCY == "1") {
			return array(
				'0' => '0',
				'20000' => '20,000',
				'30000' => '30,000',
				'40000' => '40,000',
				'50000' => '50,000',
				'60000' => '60,000',
				'85000' => '85,000',
				'110000' => '110,000',
				'135000' => '135,000',
				'160000' => '160,000',
				'185000' => '185,000',
				'210000' => '210,000',
				'235000' => '235,000',
				'260000' => '260,000',
				'285000' => '285,000',
				'310000' => '310,000',
				'335000' => '335,000',
				'360000' => '360,000',
				'410000' => '410,000',
				'460000' => '460,000',
				'510,000' => '510,000',
				'560000' => '560,000',
				'610000' => '610,000',
				'660000' => '660,000',
				'710000' => '710,000',
				'760000' => '760,000',
				'810000' => '810,000',
				'910000' => '910,000',
			);
		}

		return $prices;
	}

	public function getPriceArrayFromRentTo()
	{


		return 	  array(

			'20000' => '20,000',
			'30000' => '30,000',
			'40000' => '40,000',
			'50000' => '50,000',
			'60000' => '60,000',
			'85000' => '85,000',
			'110000' => '110,000',
			'135000' => '135,000',
			'160000' => '160,000',
			'185000' => '185,000',
			'210000' => '210,000',
			'235000' => '235,000',
			'260000' => '260,000',
			'285000' => '285,000',
			'310000' => '310,000',
			'335000' => '335,000',
			'360000' => '360,000',
			'410000' => '410,000',
			'460000' => '460,000',
			'510,000' => '510,000',
			'560000' => '560,000',
			'610000' => '610,000',
			'660000' => '660,000',
			'710000' => '710,000',
			'760000' => '760,000',
			'810000' => '810,000',
			'910000' => '910,000',
			'1010000' => '1,010,000',
		);
	}
	public $minPrice;
	public $maxPrice;
	public function getPriceViewTitle()
	{
		$price_array = $this->getPriceArray();
		$maxPrice = '';
		$minPrice = '';
		if (!empty($this->minPrice) and isset($price_array[$this->minPrice])) {
			$minPrice = $price_array[$this->minPrice];
		}
		if (!empty($this->maxPrice) and isset($price_array[$this->maxPrice])) {
			$maxPrice = $price_array[$this->maxPrice];
		}
		if (empty($maxPrice) and empty($minPrice)) {
			return 'Price Range';
		} else if (empty($maxPrice)) {
			return $minPrice;
		} else if (empty($minPrice)) {
			return $maxPrice;
		} else {
			return $minPrice . '-' . $maxPrice;
		}
	}
	public function bedroomSearchIndex()
	{
		return array(
			'' => $this->mTag()->getTag('all', 'All'),
			//	'15' => $this->mTag()->getTag('studio','Studio'),
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5+',
			//'16' => '15+',
		);
	}
	public function bathroomSearchIndex()
	{
		return array(
			'' => $this->mTag()->getTag('all', 'All'),
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5+',
		);
	}
	public function squareFeetSearch()
	{
		return
			array(
				'2000' => '2000 sqft',
				'3000' => '3000 sqft',
				'4000' => '4000 sqft',
				'5000' => '5000 sqft',
				'7500' => '7500 sqft',
				'10890' => '0.25+ acre',
				'21780' => '0.5+ acre',
				'43560' => '1+ acre',
				'87120' => '2+ acre',
				'217800' => '5+ acre',
				'435600' => '10+ acre',
			);
	}

	public $type_of;
	public function getBedRoomTitleIndex()
	{

		if (!empty($this->bedrooms) and array_key_exists($this->bedrooms, $this->bedroomSearchIndex())) {
			return $this->bedroomSearchIndex()[$this->bedrooms];
		} else {
			return 'All Beds';
		}
	}

	public function getHomeTypeTitle()
	{


		if (empty(array_filter((array)$this->type_of))) {
			return 'All Category';
		} else if (sizeOf($this->type_of) > 1) {
			return 'Category (' . sizeOf($this->type_of) . ')';
		} else {
			$cate = Category::model()->findByPk(@$this->type_of[0]);
			if ($cate) {
				return $cate->category_name;
			}
			return 'Unknown';
		}
	}
	public $maxSqft;
	public $minSqft;
	public function getSectionViewTitle()
	{
		if ($this->property_status == '1') {
			return $this->mTag()->getTag('preleased_properties', 'Preleased Properties');
		}
		if (empty($this->section_id)) {
			return $this->mTag()->getTag('explore', 'Explore');
		} else {
			if ($this->section_id == 'property-for-sale') {
				return $this->mTag()->getTag('properties_for_sale', 'Properties for sale');
			}
			if ($this->section_id == 'property-for-rent') {
				return $this->mTag()->getTag('properties_for_rent', 'Properties for rent');
			}
			if ($this->section_id == 'new-development') {
				return $this->mTag()->getTag('new_projects', 'New Projects');
			}
			$sec =   Section::model()->findByAttributes(array('slug' => $this->section_id));
			if ($sec) {

				return  $sec->section_name;
			} else {
				return 'Unknown';
			}
		}
	}
	public function getSectionBanner()
	{
		switch ($this->section_id) {
			case '1':
				return '<span class="block_tag for_sale_tag">Sale</span>';
				break;
			case '2':
				return '<span class="block_tag for_rent_tag">Rent</span>';
				break;
		}
	}
	public function getMoreTitle()
	{
		return $this->mTag()->getTag('advanced_search', 'Advanced Search');
		if (!empty($this->keyword) or !empty($this->bedrooms) or !empty($this->bathrooms) or !empty($this->minSqft) or !empty($this->maxSqft)) {
			return 'Advanced Search';
		} else {
			return 'Advanced Search';
		}
	}
	public $sort;
	public function getSortHTml()
	{

		if (!empty($this->sort) and array_key_exists($this->sort, $this->sortArray())) {
			return $this->sortArray()[$this->sort];
		} else {
			return 'Sort: Just For You';
		}
	}
	public $user_image;
	public $user_type;
	public function sortArray()
	{
		if ($this->section_id == 'new-development') {
			return array(
				'best-asc' => $this->mTag()->getTag('featured', 'Featured'),
				'price-desc' => $this->mTag()->getTag('price_(high_to_low)', 'Price (High to Low)'),
				'price-asc' => $this->mTag()->getTag('price_(low_to_high)', 'Price (Low to High)'),
				'featured' => $this->mTag()->getTag('featured', 'Featured'),
				'verified' => $this->mTag()->getTag('verified', 'Verified'),
				'title-asc' => $this->mTag()->getTag('show(a-z)', 'Show(A-Z)'),
			);
		}
		$Ar  =  array(
			'best-asc' => $this->mTag()->getTag('featured', 'Featured'),
			'date-desc' => $this->mTag()->getTag('newest', 'Newest'),

			'roi-desc' => $this->mTag()->getTag('roi_(high_to_low)', 'ROI (High to Low)'),
			'roi-asc' => $this->mTag()->getTag('roi_(low_to_high)', 'ROI (Low to High)'),
			'net-income-desc' => $this->mTag()->getTag('net_income', 'Net Income (High to Low)'),
			'net-income-asc' => $this->mTag()->getTag('net_income', 'Net Income (Low to High)'),
			'price-desc' => $this->mTag()->getTag('price_(high_to_low)', 'Price (High to Low)'),
			'price-asc' => $this->mTag()->getTag('price_(low_to_high)', 'Price (Low to High)'),

			'sqft-asc' => $this->mTag()->getTag('size_(low_to_high)', 'Size (Low to High)'),
			'sqft-desc' => $this->mTag()->getTag('size_(high_to_low)', 'Size (High to Low)'),
			//	'int-desc'=>$this->mTag()->getTag('interior_size','Interior Size'),
			//'date-asc'=>'Oldest Listed',

			//	'beds-desc'=>$this->mTag()->getTag('bedrooms','Bedrooms'),
			//	'baths-desc'=>$this->mTag()->getTag('bathrooms','Bathrooms'),
			//'sqft-desc'=>$this->mTag()->getTag('square_feet','Square Feet')
			//'beds-asc'=>'Minimum Beds',
			//'sqft-desc'=>'Maximum Area',
			//'sqft-asc'=>'Minimum Area',
		);
		if (!defined('PRELE')) {
			unset($Ar['roi-desc']);
			unset($Ar['roi-asc']);
			unset($Ar['net-income-desc']);
			unset($Ar['net-income-asc']);
		}
		return $Ar;
	}
	public function all_images()
	{
		$criteria = new CDbCriteria;
		$criteria->select = 't.image_name,t.status,t.id';
		$criteria->condition = ' isTrash="0" and  t.ad_id = :ad and t.status="A"   ';
		$criteria->params[':ad'] = $this->id;
		$criteria->order = '-t.priority desc,id asc';
		return AdImage::model()->findAll($criteria);
	}
	public function all_amentitie()
	{
		$criteria = new CDbCriteria;
		$criteria->select = 't.amenities_id,t.inp_val ';

		$criteria->condition = 'am.status="A" and am.isTrash="0" and t.ad_id = :ad   ';
		$criteria->join = ' INNER JOIN {{amenities}} am on am.amenities_id = t.amenities_id ';
		//$criteria->join .=' INNER JOIN {{master}} cats on am.master_id = cats.master_id ';

		$criteria->params[':ad'] = $this->id;
		if (defined('LANGUAGE') and LANGUAGE != 'en') {
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.am_id = t.amenities_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE am.amenities_name END  AS amenities_name ';
			/*
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelationct` on translationRelationct.master_id = cats.master_id   LEFT  JOIN mw_translation_data tdatact ON (`translationRelationct`.translate_id=tdatact.translation_id and tdatact.lang=:lan) ';
            $criteria->select .= ' ,CASE WHEN tdatact.message IS NOT NULL THEN tdatact.message ELSE cats.master_name END as  master_name  ';
        */
		} else {
			$criteria->select .= ' ,am.amenities_name';
		}
		$criteria->distinct = 't.master_id';
		$criteria->order = '   amenities_name asc';
		return AdAmenities::model()->findAll($criteria);
	}
	public function all_property_types()
	{
		$criteria = new CDbCriteria;
		$criteria->select = 't.category_id,am.category_name';

		$criteria->condition = 'am.status="A" and am.isTrash="0" and t.ad_id = :ad   ';
		$criteria->join = ' INNER JOIN {{category}} am on am.category_id = t.category_id ';
		if (defined('LANGUAGE')) {
			$langaugae = LANGUAGE;
			if (!empty($langaugae) and  $langaugae != 'en') {

				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation15` on translationRelation15.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata15 ON (`translationRelation15`.translate_id=tdata15.translation_id and tdata15.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata15.message   IS NOT NULL THEN tdata15.message ELSE am.category_name  END as  category_name  ';



				$criteria->params[':lan'] = $langaugae;
				$criteria->distinct   = 't.category_id';
			}
		}
		$criteria->params[':ad'] = $this->id;
		$criteria->order = ' category_name asc';
		return PlaceAnAdCategories::model()->findAll($criteria);
	}
	public function all_property_types_details()
	{
		$criteria = new CDbCriteria;

		$criteria->condition = 't.ad_id = :ad   ';
		$criteria->params[':ad'] = $this->id;
		$criteria->order = ' row_id asc';
		return AdPropertyTypes::model()->findAll($criteria);
	}

	public $user_number;
	public $user_description;
	public $user_slug;
	public function getUserName()
	{
		if ($this->company_name) {
			return $this->company_name;
		}
		return $this->first_name . ' ' . $this->last_name;
	}
	public function getUserProfile()
	{
		switch ($this->user_type) {
			case 'A':
				return Yii::app()->createAbsoluteUrl('user_listing/detail', array('slug' => $this->user_slug));
				break;
			case 'D':
				return Yii::app()->createAbsoluteUrl('user_listing/detail', array('slug' => $this->user_slug));
				break;

			default:
				return  'javascript:void(0)';
				break;
		}
	}

	public function getPreviewUrlTrash()
	{
		if (Yii::app()->isAppName('backend')) {
			if ($this->section_id == self::NEW_ID) {
				return Yii::app()->apps->getAppUrl('frontend', 'project/' . $this->slug . '?showTrash=1&admin=1', true);
			}
			return  Yii::app()->apps->getAppUrl('frontend', 'property/' . $this->slug . '?showTrash=1&admin=1', true);
		}
		if ($this->section_id == self::NEW_ID) {
			return Yii::app()->apps->getAppUrl('frontend', 'project/' . $this->slug, true);
		}
		return  Yii::app()->apps->getAppUrl('frontend', 'property/' . $this->slug, true);
	}
	public function getPreviewUrlTrashB()
	{

		if ($this->section_id == self::NEW_ID) {
			return Yii::app()->apps->getAppUrl('frontend', 'project/' . $this->slug, true);
		}
		return  Yii::app()->apps->getAppUrl('frontend', 'property/' . $this->slug, true);
	}

	public function getStatusUrlBack()
	{

		if (Yii::app()->isAppName('frontend')) {
			return  Yii::app()->apps->getAppUrl('backend', '/index.php/place_an_ad/update_status_i', true);
		}
		return  Yii::app()->apps->getAppUrl('backend', '/place_an_ad/update_status_i', true);
	}


	public function getStatusUrlDeleteBack()
	{
		if (Yii::app()->isAppName('frontend')) {
			return  Yii::app()->apps->getAppUrl('backend', '/index.php/place_an_ad/delete_i', true);
		}
		return  Yii::app()->apps->getAppUrl('backend', '/place_an_ad/delete_i', true);
	}
	public function statusArray()
	{
		return array(
			"A" => $this->mTag()->getTag('published', 'Published'),
			"I" => $this->mTag()->getTag('inactive', 'Inactive'),
			"W" => $this->mTag()->getTag('waiting', 'Waiting'),
			'R' => $this->mTag()->getTag('rejected', 'Rejected')
		);
	}
	public function getStatusLinkFront()
	{

		switch ($this->status) {
			case 'A':
				if ($this->IsExpiredAdCheck) {
					return '<span class="btn btn-xs  btn-danger" title="Active"    >' . CHtml::link('Expired<br /><small>Click to reactivate</small>', Yii::app()->createUrl('member/activate_ad', array('id' => base64_encode($this->id))), array('style' => "white-space: nowrap;color: #fff;min-width: 100px;")) . '</span>';
				}
				return '<span class="btn btn-xs  btn-success" title="Active"    >' . $this->mTag()->getTag('published', 'Published') . '</span>';
				break;
			case 'W':
				return '<span class="btn btn-xs  bg-warning btn-teal"   title="Waiting"  >' . $this->mTag()->getTag('waiting', 'Waiting') . '</span>';
				break;
			case 'C':
				return '<span class="btn btn-xs  btn-outline-warning"   title="Check and Approve"  >' . $this->mTag()->getTag('check_and_approve', 'Check and Approve') . '</span>';
				break;
			case 'I':
				return '<span class="btn btn-xs btn-info"   title="Inactive"    >' . $this->mTag()->getTag('inactive', 'Inactive') . '</span>';
				break;
			case 'R':
				return '<span class="btn btn-xs  btn-danger"    title="Rejected"    title="Rejected">' . $this->mTag()->getTag('rejected', 'Rejected') . '</span>';
				break;
		}
	}
	public function getStatusLink()
	{
		$usrl = Yii::App()->createUrl('place_an_ad/view', array('id' => $this->id));
		switch ($this->status) {
			case 'A':
				return '<span class="label text-white bg-green" title="Active" onclick="previewthis(this,event)"   href="' . $usrl . '">A</span>';
				break;
			case 'W':
				return '<span class="label text-white bg-blue" onclick="previewthis(this,event)" title="Waiting" href="' . $usrl . '">W</span>';
				break;
			case 'I':
				return '<span class="label text-white bg-warning" onclick="previewthis(this,event)" title="Inactive" href="' . $usrl . '"  >I</span>';
				break;
			case 'R':
				return '<span class="label text-white bg-danger" onclick="previewthis(this,event)" title="Waiting" href="' . $usrl . '"  title="Rejected">R</span>';
				break;
			case 'C':
				return '<span class="label text-white bg-yellow" title="Active" onclick="previewthis(this,event)"   href="' . $usrl . '">C</span>';
				break;
			case 'S':
				return '<span class="label text-white bg-success" title="Active" onclick="previewthis(this,event)"   href="' . $usrl . '">S</span>';
				break;
		}
	}
	public function getStatusTitle()
	{

		switch ($this->status) {
			case 'A':
				return 'Published';
				break;
			case 'W':
				return 'Waiting Approval';
				break;
			case 'I':
				return 'Inactive';
				break;
			case 'R':
				return 'Rejected';
				break;
		}
	}
	public function thumbnailImage()
	{
		return array(
			'jpg',
			'jpeg',
			'pdf',
		);
	}
	public function generateFormat()
	{
		$merged_array =  $this->thumbnailImage();
		$str = '';
		foreach ($merged_array as $format) {
			$str .= '.' . $format . ',';
		}
		return rtrim($str, ',');
	}
	function convert_ascii($string)
	{
		$search[]  = chr(226) . chr(128) . chr(152);
		$replace[] = "'";
		$search[]  = chr(226) . chr(128) . chr(153);
		$replace[] = "'";
		$search[]  = chr(226) . chr(128) . chr(156);
		$replace[] = '"';
		$search[]  = chr(226) . chr(128) . chr(157);
		$replace[] = '"';
		$search[]  = chr(226) . chr(128) . chr(147);
		$replace[] = '--';
		$search[]  = chr(226) . chr(128) . chr(148);
		$replace[] = '---';
		$search[]  = chr(226) . chr(128) . chr(162);
		$replace[] = '*';
		$search[]  = chr(194) . chr(183);
		$replace[] = '*';
		$search[]  = chr(226) . chr(128) . chr(166);
		$replace[] = '...';
		$string = str_replace($search, $replace, $string);
		$string = preg_replace("/[^\x01-\x7F]/", "", $string);
		return $string;
	}
	public function getShortDescription($length = 130)
	{
		$string = $this->convert_ascii($this->ad_description);
		return StringHelper::truncateLength($string, (int)$length);
	}

	public function listDataForAjax()
	{


		$limit = 30;
		$criteria = $this->search(1);
		$criteria->compare('t.status', 'A');
		$criteria->select .= ' ,(SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = t.id and  img.status="A" and  img.isTrash="0"  limit 1  )   as ad_image ';
		$query = Yii::app()->request->getQuery('q');
		$criteria->condition  .= ' and ( t.ad_title like :query or t.ad_description like :query )  ';
		$criteria->params[':query'] =  '%' . $query . '%';
		$count = self::model()->count($criteria);
		$criteria->order = 'ad_title ASC';
		$criteria->limit   =  $limit;
		$page = Yii::app()->request->getQuery('page', 1);

		$offset = ($page == 1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset;

		$data = self::model()->findAll($criteria);
		$ar = array();

		if ($data) {
			foreach ($data as $k => $v) {
				$image = Yii::app()->apps->getBaseUrl('uploads/images/' . $v->ad_image);
				$icontactIcon =  '<div style="background-image:url(' . $image . '); " class="backimg"></div>';
				$icontactIcon .=  '<div class="backimg-detail"><h3>' . $v->ad_title . '</h3><p>' . $v->first_name . ',' . $v->country_name . '</p></div><div class="clearfix"></div>';
				$ar[] = array('id' => $v->id, 'text' => $icontactIcon);
			}
		}
		$record = array("total_count" => $count, "incomplete_results" => false, "items" => $ar);
		echo  json_encode($record);
		Yii::app()->end();
	}
	public function should_show_fields()
	{
		return array(
			'ad_title' => 'ad_title',
			'ad_description' => 'ad_description',
			'builtup_area' => 'builtup_area',
			'bathrooms' => 'bathrooms',
			'bedrooms' => 'bedrooms',
			'parking' => 'parking',
			'amenities' => 'amenities',
			'price' => 'price'
		);
	}
	public function common_not_mandatory_field()
	{
		if (defined('IS_MOBILE') && IS_MOBILE) {
			return    array(
				'year_built' => 'year_built',
				'plot_area' => 'plot_area',
				'balconies' => 'balconies',
				'FloorNo' => 'FloorNo',
				'total_floor' => 'total_floor',
				'construction_status' => 'construction_status',
				'transaction_type' => 'transaction_type',
				'furnished' => 'furnished',
				'maid_room' => 'maid_room',
				'community_id' => 'community_id',
				'sub_community_id' => 'sub_community_id',
				'nearest_metro' => 'nearest_metro',
				'nearest_railway' => 'nearest_railway',
				'sub_category_id' => 'sub_category_id',
				'rera_no' => 'rera_no',
				'floor_plan' => 'floor_plan',
				'PrimaryUnitView' => 'PrimaryUnitView'
			);
		}
		return    array(
			'rera_no' => 'rera_no',
			'floor_plan' => 'floor_plan',
			'PrimaryUnitView' => 'PrimaryUnitView'
		);
	}
	public function excludecommon_not_mandatory_field($array)
	{
		$ar =   $this->common_not_mandatory_field();
		if (empty($array)) {
			return $ar;
		} else {
			foreach ($array as $k => $v) {
				if (in_array($k, $ar)) {
					unset($array[$k]);
				}
			}
			return  $array;
		}
	}
	public function getListingType()
	{
		$ar = Category::model()->listingTypeArray();
		$ret =  isset($ar[$this->listing_type]) ? $ar[$this->listing_type] : '';
		return $ret;
	}
	public function getTypeColor()
	{
		switch ($this->section_id) {
			case '1':
				return  '#F15B61';
				break;
			case '2':
				return  '#008489';
				break;
			case '3':
				return  '#20C063';
				break;
			default:
				return  '#FD6D35';
				break;
		}
	}
	public function getTags()
	{
		$tagsList = $this->place_ad_tag();
		$html = '';
		if (!empty($tagsList)) {
			foreach ($tagsList as $k => $v) {
				if (!empty($this->$k)) {
					$html .= '<span class="tag_short_' . $k . '"></span>';
				}
			}
		}
		return $html;
	}
	public function listRow1()
	{
		$mainRow =  '<span class="property-price new_sec">' . $this->PriceTitleSpanL;
		if ($this->section_id == '2') {
			$mainRow .= '<span class="rent_head"> / ' . $this->getRentPaidL(1) . '</span>';
		}
		$mainRow .= '</span>';
		if ($this->section_id != '3') {
			$mainRow .= '<span class="sec_divdr">|</span> <span class="sq_ft">' . $this->BuiltUpArea . '</span>';
		}
		return $mainRow;
	}
	public function listRowPrice()
	{
		$mainRow =  '<small class="price-se-' . $this->section_id . '" >' . $this->PriceTitleSpanL;
		if ($this->section_id == '2' and empty($this->p_o_r)) {
			$mainRow .= '<span class="rent_head"> / ' . $this->getRentPaidL(1) . '</span>';
		}
		$mainRow .= '</small>';
		return $mainRow;
	}
	public function listRowPriceNew()
	{
		$mainRow =   $this->PriceTitleSpanL2;
		if ($this->section_id == '2' and empty($this->p_o_r)) {
			$mainRow .= '<span class="rent_head"> / ' . $this->getRentPaidL(1) . '</span>';
		};
		return $mainRow;
	}

	public function listRow2()
	{

		$found = false;
		$list = '';


		if (!empty($this->bedrooms)) {
			$found = true;
			$list .= Yii::t('app', '<li class="general-features__feature" role="text" aria-label="2 bedrooms"><span class="general-features__icon ' . $this->bedClass . '"> ' . $this->BedroomTitle . '</span></li>');
		}
		if (!empty($this->bathrooms)) {
			$found = true;
			$list .= Yii::t('app', '<li class="general-features__feature" role="text" aria-label="2 bedrooms"><span class="general-features__icon ' . $this->BathClass . '"> ' . $this->BathroomTitle . '</span></li>');
			$found = true;
		}


		$category_title = '';
		if ($found) {
			$category_title .= '<span class="sec_divdr2">|</span>';
		}
		$category_title .= '<h2 class="residential-card__address-heading"><span class="details-link residential-card__details-link"><span class="sizeParmas dark">' . $this->SectionCategoryFullTitle . '</span></span></h2>';
		return Yii::t('app', $this->listRow2Template(), array('{row2}' => $list, '{item2}' => $category_title));
	}
	public function listRowFeatures()
	{

		$found = false;
		$list = '';


		if (!empty($this->bedrooms)) {
			$found = true;
			$list .= Yii::t('app', '<div class="smartad_bed">' . $this->BedroomTitle . '<span class="svg"><svg viewBox="0 0 70.098 53.605" class="smartad_bedicon"> <use xlink:href="#svg-bed"></use> </svg> </span></div> ');
		}
		if (!empty($this->bathrooms)) {
			$found = true;
			$list .= Yii::t('app', '<div class="smartad_bath">' . $this->BathroomTitle . '<span class="svg"><svg viewBox="0 0 70.098 53.605" class="smartad_bathicon"><use xlink:href="#svg-bath"></use> </svg>  </span></div> ');
		}
		if ($this->builtup_area != '0.00') {
			$list .= '<div class="smartad_area" dir="auto">' . $this->BuiltUpArea . '</div>';
		}
		if (empty($list)) {
			$list .= '<div class="smartad_type">' . $this->ListingType . '</div>';
		}
		return $list;
	}
	public function listRowFeaturesNew()
	{
		$html = '';
		if (!empty($this->bedrooms)) {
			$html .= '<li class="list-inline-item"><svg viewBox="0 0 15 15" ><use xlink:href="#new_bed"></use></svg> ' . $this->BedroomTitle . '</li>';
		}
		if (!empty($this->bathrooms)) {
			$html .= '<li class="list-inline-item bathit"><svg viewBox="0 0 15 15" ><use xlink:href="#new_bath"></use></svg> ' . $this->BathroomTitle . '</li>';
		}
		if ($this->builtup_area != '0.00') {
			$html .= '<li class="list-inline-item"><svg viewBox="0 0 15 15" ><use xlink:href="#new_area"></use></svg> ' . $this->BuiltUpArea . '</li>';
		}
		return $html;
	}
	/*/
	 public function footerLinkNew(){
		$html = '<div class="smartad_footer"><div class="card_actions smartad_actions">';
                      $html .= '<span class="button button-light button-size4 card_action card_action-smartad" data-qs="cta" data-reactid="'.$this->id.'" onclick="OpenFormClickNew(this)"><span class="svg"><svg viewBox="0 0 20 16" class="button_icon-style3"><use xlink:href="#svg-envelope-icon"></use></svg></span>Email</span>';
                 
                    $html .= '<div class="card_action-call card_action card_action-smartad" onclick="showCallPopup(this,event)"><span class="button button-light button-size4 button_call-property" data-qs="cta"><span class="svg"><svg viewBox="0 0 15 15" class="button_icon-style3"><use xlink:href="#svg-phone-icon"></use></svg></span>Call</span> <div class="phone-tooltip phone-tooltip--hide"><div class="phone-tooltip__content"><div><div class="phone-tooltip__close" onclick="closeToolTip(this,event)"><span class="svg"> <svg viewBox="0 0 30 20" class="phone-tooltip__close-icon"> <use xlink:href="#svg-close"></use></svg></span></div><div class="phone-tooltip__reference"><a href="tel:'.$this->mobile_number.'" class="_643d3fb4"><span dir="ltr">'.$this->mobile_number.'</span></a></div></div></div></div></div>';
                    // $html .= '<span class="button button-light button-size4 card_action button-visiblemobile card_action-smartad" data-qs="cta"><span class="svg"><svg viewBox="0 0 1792 1792" class="button_icon-style3"><use xlink:href="#svg-share"></use></svg></span>Share</span>';
                    $html .= '<span id="fav_button_'.$this->id.'" class="button button-light button-size4 card_action    card_action-smartad ';  $html .= !empty($this->fav) ?  'active' : '';  $html .= '  false  favbtn " onclick="OpenSignUp(this)" data-function="save_favourite" data-id="'.$this->id.'" data-after="saved_fave" data-qs="cta"><span class="svg"><svg viewBox="0 0 1792 1792" class="button_icon-style3"><use xlink:href="#svg-heart"></use></svg></span>Save</span></div></div>';       
					return $html;
	 }
	 */
	public function footerLinkNew()
	{
		$share_u_abs = $this->DetailUrlAbs;
		$text_message = Yii::t('app', $this->mTag()->getTag('i_would_like_to_inquire_about', 'I would like to inquire about your property {1} - {2}. Please contact me at your earliest convenience. {3}'), array('{1}' => '', '{2}' => $model->ReferenceNumberTitle, '{3}' => '%0a' . $this->mTag()->getTag('property_link', 'Property Link'))) . ' %0a' .   urlencode($share_u_abs);
		$w_share_url = Yii::t('app', 'https://wa.me/{number}?text={text}', array('{number}' => Yii::t('app', !empty($this->whatsapp) ? $this->whatsapp : $this->mobile_number, array('+' => '', ' ' => '')), '{text}' => $text_message));

		$html = '<div class="smartad_footer">
   <div class="buttons smallnomarl footerbtns">
      <div class="col-sm-12  padding-right-0 call-btn-div  mbtn-div" style="padding:0px;width:100% !important">
         <a type="button"  data-reactid="' . $this->id . '" onclick="OpenFormClickNew(this)"  class="button_call-property"   ><i class="fa fa-envelope-o" ></i> <span class="text-not-mob">' . $this->mTag()->getTag('email', 'Email') . '</span></a>
         <a type="button"    onclick="OpenCallNewlatest(this)"  data-prop="' . $this->id . '" data-agent="' . $this->OwnerName . '"  data-ref="' . $this->ReferenceNumberTitle . '" data-phone="' . $this->mobile_number . '" class="tooltipm"   ><i class="fa fa-phone" ></i> <span class="text-not-mob">' . $this->mTag()->getTag('call', 'Call') . '</span>  <div class="top"><p class="nm-cls"> <i class="fa fa-heart"  ></i>   </p>  <i></i> </div></a>
         <a type="button" id="fav_button_' . $this->id . '"  class="';
		$html .= !empty($this->fav) ?  'active' : '';
		$html .= '  false  favbtn lastref" onclick="OpenFavouriteNew(this)" data-function="save_favourite" data-id="' . $this->id . '" data-after="saved_fave"    ><i class="fa fa-heart-o"  ></i>  <span class="text-not-mob">Save</span></a>
           <a type="button"    target="_blank" style="color:#fff"  data-prop="' . $this->id . '"  data-type="W" onclick="OpenWhatsappNew(this)" data-href="' . $w_share_url . '"   data-testid="lead-form-submit" style=" " class="d-none hide  fshare-whatsap"><i class="fa fa-whatsapp" style=" "></i></a>
       </div>
   </div>
   <div class="clearfix"></div>
</div>

';
		return $html;
	}
	public function footerLinkNew2()
	{
		$call = $this->mTag()->getTag('call', 'Call');
		$email = $this->mTag()->getTag('email', 'mail');
		$share_u_abs = $this->DetailUrlAbs;
		$text_message = Yii::t('app', $this->mTag()->getTag('i_would_like_to_inquire_about', 'I would like to inquire about your property {1} - {2}. Please contact me at your earliest convenience. {3}'), array('{1}' => '', '{2}' => $model->ReferenceNumberTitle, '{3}' => '%0a' . $this->mTag()->getTag('property_link', 'Property Link'))) . ' %0a' .   urlencode($share_u_abs);
		$w_share_url = Yii::t('app', 'https://wa.me/{number}?text={text}', array('{number}' => Yii::t('app', !empty($this->whatsapp) ? $this->whatsapp : $this->mobile_number, array('+' => '', ' ' => '')), '{text}' => $text_message));
		$user = User::model()->findByPk($this->user_id);
		$html = '';

		if ($user) {
			// Step 2: Check if user is admin
			if ($user->rules == 1) { // Assuming 1 is the role for admin
				// Display profile_image for admin
				$profileImage = !empty($user->profile_image) ? $user->profile_image : '/new_assets/images/logoo.svg';
				$html .= '<div class="admin-profile"><img style="width: 100px;float: right;" src="' . $profileImage . '" alt="Admin Profile Image"></div>';
			}
			// Step 3: Check if user is an agent
			elseif ($user->is_agent == 1) {
				// Find all users where rule is agency (rule = 2)
				$agencyUsers = User::model()->findAllByAttributes(['rules' => 2]);

				// Loop through each agency user
				foreach ($agencyUsers as $agencyUser) {
					// Check if the agent's ID exists in the agency's 'agents' column (comma-separated values)
					$agents = explode(',', $agencyUser->agents); // Split comma-separated agent IDs into an array
					if (in_array($user->user_id, $agents)) {
						// Display profile_image for the agent (if available)
						$agentProfileImage = !empty($agencyUser->profile_image) ? $agencyUser->profile_image : 'default_agent_image.jpg';
						$html .= '<div class="agent-profile"><img style="width: 100px;height:50px;float: right;" src="/uploads/images/' . $agentProfileImage . '" alt="Agent Profile Image"></div>';
						break; // Exit loop after finding the match
					}
				}
			}
		} else if ($this->user_id == 31988) {
			$profileImage = !empty($user->profile_image) ? $user->profile_image : '/new_assets/images/logoo.svg';
			$html .= '<div class="admin-profile"><img style="width: 100px;float: right;" src="' . $profileImage . '" alt="Admin Profile Image"></div>';
		}

		$html  .= '<div class="d-flex footer-contact"><button type="button"    onclick="OpenCallNewlatest(this)"  data-prop="' . $this->id . '" data-agent="' . $this->OwnerName . '"  data-ref="' . $this->ReferenceNumberTitle . '" data-phone="' . $this->mobile_number . '"  class="btn btnnc btn-transparent"><i class="fa fa-phone"></i> ' . $call . '</button>
                  <button type="button" data-reactid="' . $this->id . '" onclick="OpenFormClickNew(this)"    class="btn btnnc btn-transparent"><i class="fa fa-envelope"></i> ' . $email . '</button>
                      <a type="button" id="fav_button_' . $this->id . '"  class="';
		$html .= !empty($this->fav) ?  'active' : '';
		$html .= '  false  favbtn lastref" onclick="OpenFavouriteNew(this)" data-function="save_favourite" data-id="' . $this->id . '" data-after="saved_fave"    ><i class="fa fa-heart-o margin-right-5"  ></i> <span>Save</span></a>
     
                    <a class="spnnwhatsapp" type="button"    target="_blank" style="color:#fff"  data-prop="' . $this->id . '"  data-type="W" onclick="OpenWhatsappNew(this)" data-href="' . $w_share_url . '"></a></div>';
		return $html;
	}
	public function getProjectstatusTitle()
	{
		switch ($this->project_status) {
			case '1':
				return 'Off Plan';
				break;
			case '2':
				return 'Ready';
				break;
		}
	}
	public function listRow2Template()
	{
		$html = '<div class="piped-content"><div class="piped-content__outer"><div class="piped-content__inner"><div class="primary-features residential-card__primary"><ul class="general-features rui-clearfix " role="presentation">{row2}</ul></div>{item2}</div></div></div>';
		return 	 $html;
	}
	public function listRow3()
	{
		$html = '<h2 class="residential-card__address-heading "><span class="details-link residential-card__details-link"><span class="">';
		if (!empty($this->area_location)) {
			$html .= $this->area_location;
			$html .= ' , ';
		} else {
			$html .= '';
		}
		if (!empty($this->state_name)) {
			$html .=   $this->state_name;
		}
		$html .= '</span></span></h2>';
		return 	 $html;
	}
	public function listRowLocation()
	{
		return    $this->stateName;
	}
	public function getTagList($check = false)
	{

		$html = '';
		if ($this->featured == "Y" or  $this->featured2 == 'Y') {
			$html .=  '<li class="list-inline-item featured margin-right-5"><a href="#">' . $this->mTag()->getTag('featured', 'Featured') . '</a></li>';
		}
		if ($this->verified == "1") {
			$html .=  '<li class="list-inline-item verified  margin-right-5"><a href="#" class="" style="color:#fff"><i class="fa fa-check-circle margin-right-2"></i> ' . $this->mTag()->getTag('verified', 'Verified') . '</a></li>';
		}
		if ($this->hot == "1") {
			$html .=  '<li class="list-inline-item hot"><a href="#" class="margin-right-2" style="color:#fff">' . $this->mTag()->getTag('hot', 'Hot') . '</a></li>';
		}


		if (!empty($html)) {
			return '<ul class="tag mb0">' . $html . '</ul>';
		}



		/*
				
				if($this->promoted=="1"){ $html .=  '<li class="P">Promoted</li>';}
				 
				if($this->recmnded=="1"){ $html .=  '<li class="R">Recommanded</li>';}
				 
				 
				if($this->is_new=="N"){ $html .=  '<li class="F">New</li>'; }
				* 
			
				 
		}
		 
		return $html;	* */
	}
	public function canShowTag()
	{
		static $_can_show;
		if ($_can_show !== null) {
			return $_can_show;
		}

		if (empty($_can_show)) {
			$_can_show =  Yii::app()->options->get('system.common.show_featured_tag', 'no');
		}
		return $_can_show;
	}
	public function getUsdValue()
	{
		static $_dolarValue;
		if ($_dolarValue !== null) {
			return $_dolarValue;
		}
		if (defined('BASE_RATE')) {
			$_dolarValue =	BASE_RATE;
		} else {
			$_dolarValue = Yii::app()->options->get('system.common.usd_val', '0.0065');
		}
		return   $_dolarValue;
	}
	public function getPriceTitleSpanL($code = '')
	{
		if ($this->p_o_r == '1') {
			return '<span class="pri sec_' . $this->section_id . '"><span class="price-on-request">' . $this->mTag()->getTag('price_on_request', 'Price on Request') . '</span></span>';
		}

		if (defined('SELECTED_CURRENCY') && SELECTED_CURRENCY != '2') {
			$num = Yii::t('app', ($this->price * SELECT_CURRENCY_RATE), array('.00' => ''));
			return '<span class="pri sec_' . $this->section_id . '"><span class="codc"> ' . SELECT_CURRENCY_TITLE . ' </span>' . Yii::t('app', $this->getnewFormat($num), array('.00' => '')) . '</span>';
		} elseif (defined('SYSTEM_CURRENCY') && SYSTEM_CURRENCY == 'usd') {
			$num = Yii::t('app', ($this->price / $this->UsdValue), array('.00' => ''));
			return '<span class="pri sec_' . $this->section_id . '"><span class="codc"> $ </span>' . Yii::t('app', $num, array('.00' => '')) . '</span>';
		} else {
			$code = $this->currencyTitle;
			$html = '<span class="pri sec_' . $this->section_id . '"><span class="codc"> ' . $code . ' </span>' . Yii::t('app', $this->newFormat, array('.00' => '')) . '</span>';
		}

		return $html;
	}

	public function getPriceTitleSpanL2($code = '')
	{
		if ($this->p_o_r == '1') {
			return '<span class="pri sec_' . $this->section_id . '"><span class="price-on-request">' . $this->mTag()->getTag('price_on_request', 'Price on Request') . '</span></span>';
		}

		if (defined('SELECTED_CURRENCY') && SELECTED_CURRENCY != '2') {
			$num = Yii::t('app', ($this->price * SELECT_CURRENCY_RATE), array('.00' => ''));
			return '<small> ' . SELECT_CURRENCY_TITLE . ' </small>' . Yii::t('app', $this->getnewFormat($num), array('.00' => ''));
		} elseif (defined('SYSTEM_CURRENCY') && SYSTEM_CURRENCY == 'usd') {
			$num = Yii::t('app', ($this->price / $this->UsdValue), array('.00' => ''));
			return '<span class="pri sec_' . $this->section_id . '"><span class="codc"> $ </span>' . Yii::t('app', $num, array('.00' => '')) . '</span>';
		} else {
			$code = $this->currencyTitle;
			$html = '<small> ' . $code . ' </small>' . Yii::t('app', $this->newFormat, array('.00' => ''));
		}

		return $html;
	}
	public function getPriceTitleSpanT($code = '')
	{
		if (!empty($this->price_to)) {
			if (defined('SYSTEM_CURRENCY') && SYSTEM_CURRENCY == 'usd') {
				$num = Yii::t('app', number_format(($this->price_to / $this->UsdValue), 2, '.', ''), array('.00' => ''));
				return '<span class="pri sec_' . $this->section_id . '"><span class="codc"> $ </span>' . Yii::t('app', $num, array('.00' => '')) . '</span>';
			} else {
				$code = $this->currencyTitle;
				$html = '<span class="pri sec_' . $this->section_id . '"><span class="codc"> ' . $code . ' </span>' . Yii::t('app', number_format($this->price_to, 0, '.', ','), array('.00' => '')) . '</span>';
			}
			return $html;
		}
	}
	public function getNewFormat($price = null)
	{
		$price = empty($price) ? $this->price : $price;
		$num = number_format($price, 0, '.', ',');;
		return $num;
		$ext = ""; //thousand,lac, crore
		$number_of_digits = $this->count_digit($num); //this is call :)

		if ($number_of_digits <= 5) {

			return number_format($num, 0, '.', ',');
		}
		if ($number_of_digits > 3) {
			if ($number_of_digits % 2 != 0)
				$divider = $this->divider($number_of_digits - 1);
			else
				$divider = $this->divider($number_of_digits);
		} else
			$divider = 1;

		$fraction = $num / $divider;
		$fraction = number_format($fraction, 2);

		if ($number_of_digits == 6 || $number_of_digits == 7)
			$ext = "Lac";
		if ($number_of_digits == 8 || $number_of_digits == 9)
			$ext = "Cr";
		if ($number_of_digits > 9)
			$ext = "Cr";
		return $fraction . " " . $ext;
	}
	public function getNewFormat3($price)
	{
		$num = number_format($price, 0, '.', '');;
		$ext = ""; //thousand,lac, crore
		$number_of_digits = $this->count_digit($num); //this is call :)

		if ($number_of_digits <= 5) {

			return number_format($num, 0, '.', ',');
		}
		if ($number_of_digits > 3) {
			if ($number_of_digits % 2 != 0)
				$divider = $this->divider($number_of_digits - 1);
			else
				$divider = $this->divider($number_of_digits);
		} else
			$divider = 1;

		$fraction = $num / $divider;
		$fraction = number_format($fraction, 2);

		if ($number_of_digits == 6 || $number_of_digits == 7)
			$ext = "Lac";
		if ($number_of_digits == 8 || $number_of_digits == 9)
			$ext = "Cr";
		return $fraction . " " . $ext;
	}
	function count_digit($number)
	{
		return strlen($number);
	}

	function divider($number_of_digits)
	{
		$tens = "1";

		if ($number_of_digits > 8)
			return 10000000;

		while (($number_of_digits - 1) > 0) {
			$tens .= "0";
			$number_of_digits--;
		}
		return $tens;
	}
	function getRentPaidL($home = false)
	{
		if (empty($this->rent_paid)) {
			$this->rent_paid = $this->mTag()->getTag('year', 'Year');
		}
		switch ($this->rent_paid) {
			case 'yearly':
				return $this->mTag()->getTag('year', 'Year');
				break;
			case 'monthly':
				return $this->mTag()->getTag('month', 'Month');
				break;
			case 'Daily':
				return $this->mTag()->getTag('day', 'Day');
				break;
			default:
				return $this->rent_paid;
				break;
		}
	}
	function getBuiltUpAreaTitleS()
	{
		if ($this->builtup_area != '0.00') {
			return     number_format($this->builtup_area, 0, '.', ',') . '  <small>Sq. Ft.</small>';
		}
	}
	public function getBedClass()
	{
		return 'iconBed';
	}
	public function getBathClass()
	{
		return 'iconBath';
	}
	public function getW_forTitle()
	{
		$ar = $this->wanted_for();
		return isset($ar[$this->w_for]) ? $ar[$this->w_for] : '';
	}
	public function getSectionCategoryFullTitle()
	{
		switch ($this->section_id) {

			case '1':
				//return Yii::t('app', $this->mTag()->getTag('{l}_{c}_for_sale','{l} {c} for Sale') ,array('{c}'=>$this->category_name,'{l}'=>$this->listing_category)); 
				return Yii::t('app', $this->mTag()->getTag('{l}_{c}_for_sale', '{l} {c} for Sale'), array('{c}' => $this->CategoryName, '{l}' => ''));
				break;
			case '2':
				return Yii::t('app', $this->mTag()->getTag('{l}_{c}_for_rent', '{l} {c} for Rent'), array('{c}' => $this->CategoryName, '{l}' => ''));
				break;
			case '3':
				return  'Development';
				break;
			case '4':
				$tit = $this->w_forTitle;
				return Yii::t('app', 'Wanted {c} for ' . $tit, array('{c}' => $this->category_name));
				break;
			default:
				return $this->category_name;
				break;
		}
	}
	public $cat;
	public function getCategoryTypeTitle()
	{

		$arm = (array) $this->type_of;
		$arms = array_filter($arm);
		if (empty($arms)) {
			if (!empty($this->listing_type)) {
				return $this->ListingType;
			}
			return  'Property Type';
		} else if (sizeOf($this->type_of) > 1) {
			if (!empty($this->listing_type)) {
				$Type =  $this->ListingType;
			} else {
				$Type = 'Type';
			}
			return  Yii::t('app',  $Type . ' ({n})', array('{n}' => sizeOf($this->type_of)));
		} else {
			$cate = Category::model()->categorySlugLan(@$this->type_of);
			if ($cate) {
				if (!empty($this->listing_type)) {
					$Type =  $this->ListingType . '-' . $cate->category_name;
				} else {
					$Type =   $cate->category_name;
				}
				return  $Type;
			}
			return 'Unknown';
		}
	}
	public $reference_number;
	public function getReferenceNumberTitle()
	{
		if (!empty($this->RefNo)) {
			return $this->RefNo;
		}
		if (empty($this->id)) {
			$criteria = new CDbCriteria;
			$criteria->select = 'max(id) as id ';
			$newId = PlaceAnAd::find($criteria);
			$newId = $newId->id + 1;
			$val = str_pad($newId, 5, "0", STR_PAD_LEFT);
			return $val;
		}
		$val = str_pad($this->id, 5, "0", STR_PAD_LEFT);
		return $val;
	}
	public function getAdDescription()
	{
		return !empty($this->ad_descriptionN) ? $this->ad_descriptionN : $this->ad_description;
	}

	public function detailList()
	{
		if ($this->interior_size == $this->builtup_area) {
			$this->interior_size = '';
		}
		return  array(
			'permit_no' 	 =>     $this->PropertyID,
			'reference' 	 =>     $this->ReferenceNumberTitle,
			'listing_type'	 =>  !empty($this->listing_category) ? $this->listing_category :  $this->ListingType,
			//	'location' 	 =>  $this->mandate ,
			'category_id' 	 =>   !empty($this->category_name) ? $this->category_name :     $this->ListingTypeCategory,

			'section_id'	   =>  $this->SecNewTitle,
			//'client_ref' 	 =>     $this->client_ref ,
			'bedrooms'		 =>    $this->BedroomTitle,
			'bathrooms' 	 =>     $this->BathroomTitle,
			'balconies'		 =>   $this->BalconiesTitle,
			'builtup_area' 	 =>  $this->BuiltUpArea,
			'interior_size' 	 =>  $this->interiorSize,



			//	'plot_area' 	 =>   $this->PloatArea ,            
			//'sub_category_id' =>  $this->sub_category_name ,
			'FloorNo' 		 =>  $this->FloorNoTitle,
			'total_floor' 	 =>   $this->total_floorTitle,
			'parking' 		 =>  $this->parkingTitle,
			'construction_status' => $this->ConstructionTitle,
			'transaction_type' =>   $this->TransactionTypeTitle,
			'year_built' 	   =>   $this->year_built,
			//'rera_no'		   =>  in_array('rera_no',$this->getFieldsList()) ? $this->rera_no: '',
			'furnished'		   =>  $this->FurnishedTitle,
			'maid_room'		   =>  $this->MaidRooMTitle,

			//'status'		   =>  $this->StatusTitle ,
			//	'area_location'		   =>  $this->area_location ,
			'l_no' => $this->l_no,
			'plan_no' => $this->plan_no,
			'no_of_u' => $this->no_of_u,
			'floor_no' => $this->floor_no,
			'unit_no' => $this->unit_no,
			//	'c_date'=>$this->CdateTitle ,
			'selling_price' => $this->selling_price,

		);
	}
	public function getselling_price_total()
	{
		if (!empty($this->selling_price)) {
			return $this->selling_price . ' ' . $this->currencyTitle;
		}
	}
	public function getSecNewTitle2()
	{
		switch ($this->section_id) {
			case '1':
				return $this->mTag()->getTag('sale', 'Sale');
				break;
			case '2':
				return  $this->mTag()->getTag('rent', 'Rent');
				break;
			default:
				return $this->section_name;
				break;
		}
	}
	public function getSecNewTitle()
	{
		switch ($this->section_id) {
			case '1':
				return $this->mTag()->getTag('for_sale', 'For Sale');
				break;
			case '2':
				return  $this->mTag()->getTag('for_rent', 'For rent');
				break;
			default:
				return $this->section_name;
				break;
		}
	}
	public function getListingTypeCategory()
	{
		$ty = Category::model()->categoryIdLan($this->category_id);
		if (!empty($ty)) {
			return $ty->category_name;
		}
	}
	public function wanted_for()
	{
		return array('B' => 'Buy', 'R' => 'Rent');
	}
	const BULK_ACTION_TRASH = 'trash';
	const BULK_ACTION_DOWNLOAD = 'download';
	const BULK_ACTION_DELETE = 'delete';
	const BULK_ACTION_RESTORE = 'restore';
	const BULK_ACTION_EXPIRED = 'expired';
	const BULK_ACTION_REFRESH = 'refresh';
	const BULK_ACTION_UNPUBLISH = 'unpublish';
	const BULK_ACTION_PUBLISH = 'publish';
	const BULK_ACTION_UNLEASE = 'unlease';
	const BULK_ACTION_TRASLATE = 'translate';
	const BULK_ACTION_SENDNOTIFICATIOB = 'send-notification';
	public function getBulkActionsList()
	{
		$ar =
			array(
				self::BULK_ACTION_DELETE         => Yii::t('app', 'Delete Permanently '),
				self::BULK_ACTION_DOWNLOAD         => Yii::t('app', 'Download Location Image'),
				self::BULK_ACTION_REFRESH         => Yii::t('app', 'Refresh Property'),
				self::BULK_ACTION_UNPUBLISH         => Yii::t('app', 'Unpublish'),
				self::BULK_ACTION_PUBLISH         => Yii::t('app', 'Publish'),
				self::BULK_ACTION_TRASLATE         => Yii::t('app', 'Update Arabic'),
				//self::BULK_ACTION_UNLEASE         => Yii::t('app', 'Unsold/UnLeased'),

			);
		if (!empty($this->show_expired)) {
			$ar[self::BULK_ACTION_EXPIRED] =  Yii::t('app', 'Extend Expiry');
			$ar[self::BULK_ACTION_SENDNOTIFICATIOB] =  Yii::t('app', 'Send Expiry Notification');
		}
		if (Yii::app()->controller->action->id == 'trash') {
			$ar[self::BULK_ACTION_RESTORE] =  Yii::t('app', 'Restore');
		} else {
			$ar[self::BULK_ACTION_TRASH] =  Yii::t('app', 'Move To Trash');
		}
		return $ar;
	}

	public function getVerifiedTitles()
	{
		$html = '';
		$html .=  ($this->featured == 'Y' or $this->featured2 == 'Y')  ? '<i  class="featured"  >Featured</i>' : '';
		$html .=  $this->verified == '1' ? ' <i  class="verified"  >Verified</i>' : '';
		return $html;
	}
	public function getVerifiedTitlesA()
	{
		if (Yii::app()->options->get('system.common.enable_featured', '0') == '1') {
			$html = '';
			$html .=  ($this->featured == 'Y' or $this->featured2 == 'Y') ? ' <i  class="featured" title="Featured">Featured</i>' : '';
			$html .=  $this->verified == '1' ? ' <i  class="verified"  >Verified</i>' : '';
			return $html;
		}
	}
	public function getBoost()
	{
		if ($this->property_status == '1') {
			return false;
		}
		if ($this->featured2 == 'Y') {
			if ($this->featured != 'Y') {
				return '<a href="javascript:void(0)" onclick="makeunfeatured(this)" data-id="' . $this->id . '"   class="btn btn-xs  btn-success margin-left-10" style="background-color:#fad440;border:0px;"><i class="fa fa-star-o"></i> ' . $this->mTag()->getTag('make_unfeatured', 'Make Unfeatured') . '</a>';
			}
		} else {
			return '<div class="dropdown" style="display:inline;">
  <button class="btn btn-secondary slpbtn" type="button" id="dropdownMenuButton' . $this->id . '"  onclick="OpenthiMod(this)">
   ' . $this->mTag()->gettag('boost', 'Boost') . '
     <div class="mhtml hide"  aria-labelledby="dropdownMenuButton' . $this->id . '">
     <ul style="padding:0px;margin:0px;"><li><div class="h5">
    ' . $this->mTag()->getTag('upgrade_to_featured_ad', 'Upgrade to Featured Ad') . '<br /><small>' . $this->mTag()->getTag('quick_way_to_get_leads_and_sho', 'Quick way to get leads and show your Ad on top listing. Your ad will be highlighted.') . '</small></div>
    <div class="text-center margin-top-30" style="margin:auto;"><a class="btn btn-primary" href="javascript:void(0)" title="Featured" style="white-space: initial;line-height: 1.8;" onclick="processfeatured(this)"  data-href="' . Yii::app()->createUrl('member/add_featured', array('id' => $this->primaryKey)) . '" >' . $this->mTag()->getTag("click_to_featured_your_ad", "Click to featured your ad") . '</a><div>
    </li> <li><a class="ms-package-select hide dropdown-item" href="javascript:void(0)"   title="Refresh Quoat"  onclick="processrefresh(this)"  data-href="' . Yii::app()->createUrl('member/add_reset', array('id' => $this->primaryKey)) . '" >Refresh Your Ad <br /><small>Quick way to get leads and show your Ad on top listing.</small></a>
     </li></ul>
  </div>
  </button>

</div>';
		}
	}
	public function getBackendUpdateURl()
	{
		return  Yii::app()->apps->getAppUrl('backend', 'index.php/place_property/update/id/' . $this->id, true);
	}
	public function getSmallDateAdded()
	{
		return date('M d,Y', strtotime($this->dateAdded));
	}
	public function getTitleSectD2()
	{;
		$strr = $this->section->section_name;
		$strr .= "<span style='display:block;color: #888;'>" . $this->SmallDateAdded . "</span>";
		return $strr;
	}
	public function getTitleSectD()
	{;
		$strr = $this->section->section_name;
		$strr .= "<span style='display:block;color: #888;'>" . $this->SmallDate . "</span>";
		return $strr;
	}
	public function getDetLink()
	{
		$profile_url = ($this->premium_u == '1') ? 'detail_developer'  : 'detail';
		return  $this->enable_l_f == '1' ?  Yii::app()->createUrl('user_listing/' . $profile_url, array('slug' => $this->user_slug)) : 'javascript:void(0)';
	}

	public function getActivePropertys()
	{
		$criteria = new CDbCriteria;
		$criteria->condition  = '1';
		$criteria->select = '(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where  (CASE WHEN t.parent_user is NOT NULL THEN t.parent_user = ad.user_id  or t.user_id = ad.user_id  ELSE t.user_id = ad.user_id END ) and ad.status="A" and ad.isTrash="0" and ad.section_id=' . PlaceAnAd::SALE_ID . ' ) as sale_total
		,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where  (CASE WHEN t.parent_user is NOT NULL THEN t.parent_user = ad.user_id  or t.user_id = ad.user_id  ELSE t.user_id = ad.user_id END )  and ad.status="A" and ad.isTrash="0" and ad.section_id=' . PlaceAnAd::RENT_ID . ' ) as rent_total ';
		$criteria->distinct =  't.id';

		$criteria->compare('t.user_id', (int)$this->user_id);
		$totalResult =  ListingUsers::model()->find($criteria);

		if (!empty($totalResult)) {
			return array('sale_total' => $totalResult->sale_total, 'rent_total' => $totalResult->rent_total);
		}
	}
	public function getRefereceWebUrl()
	{
		switch ($this->site) {
			case 'O':
				if (strpos($this->slug_z, 'www.olx.com.pk') !== false) {
					return $this->slug_z;
				} else {
					return 'https://www.olx.com.pk/item/' . $this->slug_z;
				}
				break;
			default:
				return 'https://www.zameen.com/Property/' . $this->slug_z . '.html';
				break;
		}
	}
	public function imgDefault()
	{
		static $_defaultImgModel;
		if ($_defaultImgModel !== null) {
			return $_defaultImgModel;
		}
		$_defaultImgModel =  $ref = new imageResize;;


		return $_defaultImgModel;
	}
	function converToTzFn($time = "", $toTz = '', $fromTz = '', $format = 'Y-m-d H:i:s')
	{
		// timezone by php friendly values
		$date = new DateTime($time, new DateTimeZone($fromTz));
		$date->setTimezone(new DateTimeZone($toTz));
		$time = $date->format($format);
		return $time;
	}
	public function todayDefault()
	{
		static $_todayModel;
		if ($_todayModel !== null) {
			return $_todayModel;
		}
		$_todayModel = $this->converToTzFn(date('Y-m-d h:i:s'), 'Asia/Karachi', 'UTC', 'Y-m-d');
		return $_todayModel;
	}
	public function getShowDateFrontend()
	{
		$today = $this->todayDefault();
		$updated_date = $this->converToTzFn($this->last_updated, 'Asia/Karachi', 'UTC', 'Y-m-d');
		$date2 = strtotime($updated_date);
		$date1 = strtotime($today);
		$diff = round(($date1 - $date2) / (60 * 60 * 24));

		switch ($diff) {
			case '0':
				return 'Today';
				break;
			case  '1':
				return 'Yesterday';
				break;
			default:
				return date('M d', $date2);
				break;
		}
	}


	public function getSendNotificationExpire()
	{
		$number = $this->Customer->full_number;
		if (!empty($number)) {
		} else {
			return false;
		}

		if (strpos($number, '+') !== false) {
		} else {
			$number = '+' . $number;
		}

		$mobile = Yii::t('app', $number, array(' ' => '')); ///Recepient Mobile Number
		$message = Yii::t('app', Yii::app()->options->get('system.common.ad_expiry_notification_message', ''), array('[PROPERTY_ID]' => $this->ReferenceNumberTitle));

		if (strpos($mobile, '+92') !== false) {
			/* if Pakistan use send PK */
			$username =  Yii::app()->options->get('system.common.sendpk_username', ''); ///Your Username
			$password = Yii::app()->options->get('system.common.sendpk_password', ''); ///Your Password
			$sender = Yii::app()->options->get('system.common.sendpk_sender', '');;

			////sending sms
			$post = "sender=" . urlencode($sender) . "&mobile=" . urlencode($mobile) . "&message=" . urlencode($message) . "";
			$url = "https://sendpk.com/api/sms.php?username=$username&password=$password";
			$ch = curl_init();
			$timeout = 30; // set to zero for no timeout
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$result = curl_exec($ch);

			/*Print Responce*/
			return $result;
		} else {

			require Yii::getPathOfAlias('common') . '/extensions/twi/Services/Twilio.php';
			$sid = Yii::app()->options->get('system.common.twilio_sid', '');
			$token = Yii::app()->options->get('system.common.twilio_token', '');
			$phone =  Yii::app()->options->get('system.common.twilio_phone', '');
			$client = new Services_Twilio($sid, $token);
			$message2 = $client->account->sms_messages->create(
				$phone, // From a valid Twilio number
				$mobile, // Text this number
				$message
			);

			// 	return $message2;

		}
	}
	public function cp1251_to_utf8($s)
	{
		if ((mb_detect_encoding($s, 'UTF-8,CP1251')) == "WINDOWS-1251") {
			$c209 = chr(209);
			$c208 = chr(208);
			$c129 = chr(129);
			for ($i = 0; $i < strlen($s); $i++) {
				$c = ord($s[$i]);
				if ($c >= 192 and $c <= 239) $t .= $c208 . chr($c - 48);
				elseif ($c > 239) $t .= $c209 . chr($c - 112);
				elseif ($c == 184) $t .= $c209 . $c209;
				elseif ($c == 168)    $t .= $c208 . $c129;
				else $t .= $s[$i];
			}
			return $t;
		} else {
			return $s;
		}
	}
	public   function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		//$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = $this->cp1251_to_utf8($text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}
	public function price_title($formData)
	{
		$min_price = isset($formData['minPrice']) && !empty($formData['minPrice']) ? $formData['minPrice'] : '';
		$max_price = isset($formData['maxPrice']) && !empty($formData['maxPrice']) ? $formData['maxPrice'] : '';

		if (empty($min_price) && empty($max_price)) {
			$price_title = 'Any Price';
		} elseif (!empty($min_price) && !empty($max_price)) {
			$min_price = !empty($currency_value) ? number_format($min_price * $currency_value, 2, '.', '') : $min_price;
			$max_price = !empty($currency_value) ? number_format($max_price * $currency_value, 2, '.', '') : $max_price;
			$price_title = $min_price . ' to ' . $max_price;
		} elseif (empty($min_price)) {
			$max_price = !empty($currency_value) ? number_format($max_price * $currency_value, 2, '.', '') : $max_price;
			$price_title = '0 to ' . $max_price;
		} else {
			$min_price = !empty($currency_value) ? number_format($min_price * $currency_value, 2, '.', '') : $min_price;
			$price_title = $min_price . '  to Any';
		}

		return $price_title;
	}

	public $total_items;
	public function pricetrends($ar)
	{
		if (!empty($ar)) {
			$criteria = new CDbCriteria;
			$criteria->condition = '1';
			$criteria->compare('t.status', 'A');



			if (!empty($ar['category_id'])) {

				$criteria->compare('t.category_id', (int)$ar['category_id']);
			}
			if (!empty($ar['bedrooms'])) {

				$criteria->compare('t.bedrooms', (int)$ar['bedrooms']);
			}
			if (!empty($ar['state'])) {

				$criteria->compare('t.state', (int)$ar['state']);
			}

			if (!empty($ar['section_id']) and $ar['section_id'] == '1') {

				$criteria->compare('t.section_id', (int)$ar['section_id']);
				$criteria->join  .= ' inner join {{area_unit}} au ON au.master_id = t.area_unit ';
				$criteria->select = 'sum((COALESCE(t.price,0))/(t.builtup_area*(1/au.value))) as price,count(t.id) as total_items,t.date_added';
			} else if (!empty($ar['section_id']) and $ar['section_id'] == '2') {

				$criteria->compare('t.section_id', (int)$ar['section_id']);

				$criteria->select = 'sum((COALESCE( CASE WHEN rent_paid ="yearly" then  t.price WHEN rent_paid ="monthly" then (t.price*12)    WHEN rent_paid ="Quarterly" then (t.price*4)      WHEN rent_paid ="Daily" then (t.price*30 )   ELSE  t.price  END       ,0)) ) as price,count(t.id) as total_items,t.date_added';
			}
			$criteria->condition .= ' and DATE(t.date_added) > "2021-02-23" ';
			$criteria->group     = 'MONTH(t.date_added),YEAR(t.date_added)';
			$criteria->limit     = 18;
			return self::model()->findAll($criteria);
		} else {
			return false;
		}
	}
	public function getFeaturedTitle()
	{
		switch ($this->featured2) {
			case 'Y':
				return $this->mTag()->gettag('featured_listing', 'Featured Listing');
				break;
			default:
				return  $this->mTag()->gettag('standard_listing', 'Standard Listing');
				break;
		}
	}
	public function getListingLi()
	{
		$html  = '<div class="ordr-det">';
		$html .= '<h1 class="sml-header"><span class="pricecls1">' . $this->getAttributeLabel('reference') . '</span><span class="pricecls padding-left-5">' . $this->ReferenceNumberTitle . '</span></h1>';
		$html .= '<h1 class="sml-header owner"><span class="pricecls1">' . $this->getAttributeLabel('last_updated') . '</span><span class="pricecls padding-left-5">' . $this->SmallDate . '</span></h1>';
		$html .= '<h1 class="sml-header owner"><span class="pricecls1">' . $this->featuredTitle . '</span></h1>';
		$html .= '</div>';
		return $html;
	}
	public function getListingLiTitle()
	{
		$html  = CHtml::Link(CHtml::image(@$this->singleImage, "", array("style" => "margin-right:5px")), Yii::app()->createUrl("place_an_ad/update", array("id" => $data->id))) . " " . CHtml::Link(@$this->AdTitleWithIcons, "javascript:void(0)", array("onclick" => "openUrlFUll(this)", "data-url" => $this->PreviewUrlTrash));
		$html .= '<h1 class="sml-header"><span class="">' . $this->getAttributeLabel('location') . ' :</span><span class="pricecls">' . $this->Locationtitle . '</span></h1>';

		$html  .= '<h1 class="sml-header"><span class=" ">' . $this->getAttributeLabel('price') . ' :</span><span class="pricecls" >' . $this->listRowPrice() . '</span></h1>';
		$html  .= '<h1 class="sml-header"><span class=" ">' . $this->getAttributeLabel('type') . ' :</span><span class="pricecls" >' . $this->SectionCategoryFullTitle . '</span></h1>';
		$html  .= '<h1 class="sml-header owner"><span class=" ">' . $this->getAttributeLabel('listed_by') . ' :</span><span class="pricecls" >' . @$this->first_name . " " . @$this->last_name . '</span></h1>';
		$html  .= '<h1 class="sml-header owner"><span class=" ">' . $this->getAttributeLabel('status') . ' :</span><span class="pricecls" >' . $this->StatusLinkFront . $this->Boost . '</span></h1>';
		return $html;
	}

	public function getq_scoreTitle()
	{
		$html = $this->QualityScoreDEsc;
		if ($this->mark > 75) {
			$class = 'success';
		} else if ($this->mark > 50) {
			$class = 'warning';
		} else {
			$class = 'danger';
		}
		$this->mark = (int) $this->mark;
		return '<div class="gauge"  id="gauge_' . $this->id . '" data-mark="' . $this->mark . '" style="position:relative"></div><div class="hover-pg">' . $html . '</div>';
	}
	public function getQualityScoreDesc()
	{
		$infoTitle = $this->SizeOfTitle;
		$infoimages = $this->SizeOfImages;
		$infoDescription = $this->SizeOfDescription;
		$infoLocation = $this->CityTitlev;
		$mesage = (isset($infoTitle['message']) and !empty($infoTitle['message']))	 ? $infoTitle['message'] : '';
		$mesagedesc = (isset($infoDescription['message']) and !empty($infoDescription['message']))	 ? $infoDescription['message'] : '';
		$mesagelocation = (isset($infoLocation['message']) and !empty($infoLocation['message']))	 ? $infoLocation['message'] : '';
		$html = '<div><h1>' . $this->mTag()->getTag('quality_score_of_selected_list', 'Quality Score Of Selected Listing') . '</h1> 
	<div><div class="breadcrumbn ' . $infoimages['class'] . '"><div><div class="step">' . $this->mTag()->getTag('photos', 'Photos') . '- ' . $infoimages['title'] . '</div></div>  </div>
		
		<div class="breadcrumbn ' . $infoTitle['class'] . '"><div><div class="step">' . $this->mTag()->getTag('title', 'Title') . ' - ' . $infoTitle['title'] . ' </div></div>';
		$html .= !empty($mesage) ? '<div style="color:#333;font-size:12px;line-height:1.2 ">' . $mesage . '</div>' : '';
		$html .= '</div>
		<div class="breadcrumbn ' . $infoDescription['class'] . '"><div><div class="step">' . $this->mTag()->getTag('description', 'Description') . ' - ' . $infoDescription['title'] . '</div></div>';
		$html .= !empty($mesagedesc) ? '<div style="color:#333; font-size:12px;line-height:1.2">' . $mesagedesc . '</div>' : '';
		$html .= '</div>
		<div class="breadcrumbn ' . $infoLocation['class'] . '"><div><div class="step">' . $this->mTag()->getTag('full_location', 'Full Location') . ' - ' . $infoLocation['title'] . '</div></div>  ';
		$html .= !empty($mesagelocation) ? '<div style="color:#333;font-size:12px;line-height:1.2 ">' . $mesagelocation . '</div>' : '';
		$html .= '</div>';
		return $html;
	}

	const TITL_MIN = '30';
	const TITL_MAX = '50';

	const DESC_MIN = '500';
	const DESC_MAX = '1000';
	const image_MAX = '20';

	public function getSizeOfTitle()
	{
		$validateClass = array();
		$strlen =  strlen($this->ad_title);
		if ($strlen >= self::TITL_MIN  && $strlen <= self::TITL_MAX) {
			$validateClass['class'] = 'success';
			$validateClass['title'] =   $this->mTag()->getTag('good', 'Good');
			$this->mark += 25;
		} else {
			$validateClass['class'] = 'danger';
			if ($strlen < self::TITL_MIN) {
				$remaining = self::TITL_MIN - $strlen;
				if ($remaining >= 25) {
					$this->mark += 20;
				} else if ($remaining >= 15) {
					$this->mark += 15;
				} else if ($remaining >= 10) {
					$this->mark += 10;
				} else {
					$this->mark += 5;
				}


				$validateClass['title'] = $this->mTag()->getTag('short', 'Short');
				$validateClass['message'] = Yii::t('app', $this->mTag()->getTag('shorter_than_recommanded_lengt', 'Shorter than Recommanded length {s}{min} - {max}{e}'), array('{s}' => '<span dir="ltr" style="white-space:nowrap;">', '{e}' => '</span>', '{min}' => self::TITL_MIN, '{max}' => self::TITL_MAX));
			} else {
				$validateClass['title'] = $this->mTag()->getTag('long', 'Long');
				$remaining =   $strlen = self::TITL_MAX;
				if ($remaining <= 75) {
					$this->mark += 20;
				} else if ($remaining <= 100) {
					$this->mark += 15;
				} else if ($remaining <= 150) {
					$this->mark += 10;
				} else {
					$this->mark += 5;
				}
				$validateClass['message'] = Yii::t('app', $this->mTag()->getTag('above_recommanded_length_{mi', 'Above   Recommanded length  {s}{min} - {max}{e}'), array('{s}' => '<span dir="ltr" style="white-space:nowrap;">', '{e}' => '</span>', '{min}' => self::TITL_MIN, '{max}' => self::TITL_MAX));
			}
		}
		return $validateClass;
	}
	public function getAdImagesC()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = ' isTrash="0" and  t.ad_id = :ad   ';
		$criteria->params[':ad'] = $this->id;
		$criteria->order = '-t.priority desc';
		return AdImage::model()->count($criteria);
	}
	public $mark = 0;
	public function getSizeOfImages()
	{
		$validateClass = array();
		$strlen =   $this->adImagesC;
		if ($strlen == self::image_MAX) {
			$validateClass['class'] = 'success';
			$validateClass['title'] = $strlen . '/' . self::image_MAX;
			$this->mark += 25;
		} else if ($strlen > 10) {
			$validateClass['class'] = 'warning';
			$validateClass['title'] = $strlen . '/' . self::image_MAX;
			$this->mark += ($strlen * 0.8);
		} else {
			$validateClass['class'] = 'danger';
			$this->mark += ($strlen * 0.8);
			$validateClass['title'] = $strlen . '/' . self::image_MAX;
		}
		return $validateClass;
	}

	public function getSizeOfDescription()
	{
		$validateClass = array();
		$strlen =  strlen($this->ad_description);
		if ($strlen >= self::DESC_MIN  && $strlen <= self::DESC_MAX) {
			$validateClass['class'] = 'success';
			$validateClass['title'] =  $this->mTag()->getTag('good', 'Good');
			$this->mark += 25;
		} else {
			$validateClass['class'] = 'danger';

			if ($strlen < self::DESC_MIN) {
				$remaining = self::DESC_MIN - $strlen;
				if ($remaining <= 50) {
					$this->mark += 20;
				} else if ($remaining <=  100) {
					$this->mark += 15;
				} else if ($remaining <=  200) {
					$this->mark += 10;
				} else {
					$this->mark += 5;
				}
				$validateClass['title'] = 'Short';
				$validateClass['message'] = Yii::t('app', $this->mTag()->getTag('shorter_than_recommanded_lengt', 'Shorter than Recommanded length  {s}{min} - {max}{e}'), array('{s}' => '<span dir="ltr" style="white-space:nowrap;">', '{e}' => '</span>', '{min}' => self::DESC_MIN, '{max}' => self::DESC_MAX));
			} else {
				$remaining =  $strlen - self::DESC_MIN;

				if ($remaining <= 100) {
					$this->mark += 20;
				} else if ($remaining <= 200) {
					$this->mark += 15;
				} else if ($remaining <= 300) {
					$this->mark += 10;
				} else {
					$this->mark += 5;
				}
				$validateClass['title'] = 'Long';
				$validateClass['message'] = Yii::t('app', $this->mTag()->getTag('above_recommanded_length_{mi', 'Above  Recommanded length {s} {min} - {max} {e}'), array('{s}' => '<span dir="ltr" style="white-space:nowrap;">', '{e}' => '</span>', '{min}' => self::DESC_MIN, '{max}' => self::DESC_MAX));
			}
		}
		return $validateClass;
	}
	public function getCityTitlev()
	{
		$validateClass = array();
		if (!empty($this->state) and !empty($this->location_latitude)) {
			$validateClass['class'] = 'success';
			$validateClass['title'] = '2/2';
			$this->mark += 25;
		} else if (empty($this->location_latitude)) {
			$validateClass['class'] = 'danger';
			$this->mark += 15;
			$validateClass['title'] = '1/2';
			$validateClass['message'] = Yii::t('app', $this->mTag()->getTag('street_address_not_picked_from', 'Street address not picked from map dropdown list'));
		}
		return $validateClass;
	}
	public function getOptionCls()
	{
		$html  = '<div class="opts"><a href="' . Yii::app()->createUrl('place_an_ad/update', array('id' => $this->id)) . '"><i class="fa fa-edit"></i> ' . $this->mTag()->gettag('edit', 'Edit') . '</a>  ';
		$html  .= '<br /><a href="javascript:void(0)"  onclick = "openUrlFUll(this)"   data-url = "' . $this->PreviewUrlTrash . '" class="cls-succes"><i class="fa fa-eye"></i> ' . $this->mTag()->gettag('view', 'View') . '</a>  ';
		//$html  .= '<br /><a href="javascript:void(0)"    class="cls-history"><i class="fa fa-history"></i> History</a>  ';
		if ($this->status == 'A') {
			$html  .= '<br /><a href="javascript:void(0)" data-href="' . Yii::app()->createUrl('member/unpublish', array('id' => $this->id)) . '" onclick="termicateProperty(this)" class="cls-danger"><i class="fa fa-stop"></i>  ' . $this->mTag()->gettag('unpublish', 'Unpublish') . '</a>';
			if ($this->property_status == '0') {
				if ($this->section_id == '1') {
					$title = $this->mTag()->getTag('mark_as_sold', 'Mark as Sold');
				} else {
					$title = $this->mTag()->getTag('mark_as_leased', 'Mark as Leased');
				}
				$html  .= '<br /><a href="javascript:void(0)" data-href="' . Yii::app()->createUrl('member/mark_as_sold', array('id' => $this->id)) . '" onclick="termicateProperty(this)" class="cls-success"><i class="fa fa-window-close"></i> ' . $title . '</a> ';
			} else {
				$html  .= '<br />' . $this->SoldStatus;
			}
		}
		//	$html  .= '<br /><a href="javascript:void(0)" data-href="'.Yii::app()->createUrl('member/remove_property',array('id'=>$this->id)).'" onclick="termicateProperty(this)" class="cls-danger"><i class="fa fa-trash"></i> '.$this->mTag()->getTag('delete','Delete').'</a> </div>';

		return $html;
	}
	public function getStatisticsCls()
	{
		$statistcs = StatisticsPage::model()->pageCount('', $this->id);
		$callCount = Statistics::model()->callCount('', $this->id);
		$mainCount = Statistics::model()->mailCount('', $this->id);
		$html  = '<div class=""><a  href="javascript:void(0)" class="text-primary">' . Yii::t('app', '{n} {p}', array('{n}' => (int) $statistcs->s_count, '{p}' => $this->mTag()->gettag('page_views', 'Page Views'))) . '</a> 
		<br /> <a  href="javascript:void(0)" class="text-success" >' . Yii::t('app', '{n} {p}', array('{n}' => (int) $callCount->s_count, '{p}' => $this->mTag()->gettag('call_clicks', 'Call Clicks'))) . '</a>
		<br /><a  href="javascript:void(0)" class="text-warning">' . Yii::t('app', '{n} {p}', array('{n}' => (int) $mainCount->s_count, '{p}' => $this->mTag()->gettag('email_clicks', 'Email Clicks'))) . '</a>
		</div>';
		return $html;
	}
	public function getSoldStatus()
	{
		if ($this->property_status == '1') {
			if ($this->lease_status == '1') {
				$title = $this->mTag()->getTag('leased', 'Leased');
			} else {
				$title = $this->mTag()->getTag('vacant', 'Vacant');
			}
			return $title;
		}
	}
	public function getSoldStatusH()
	{
		if ($this->property_status == '1') {

			if ($this->section_id == '1') {
				$title = '<span class="bg-green">Sold</span>';
			} else {
				$title = '<span class="bg-green">Leased</span>';
			}
			return $title;
		}
	}
	public function all_amentitie_by_id()
	{
		$criteria = new CDbCriteria;
		$criteria->select = 't.amenities_id';

		$criteria->condition = 't.status="A" and t.isTrash="0"    ';

		$criteria->addInCondition('t.amenities_id', (array) $this->amenities);

		if (defined('LANGUAGE') and LANGUAGE != 'en') {
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.am_id = t.amenities_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.amenities_name END  AS amenities_name ';
		} else {
			$criteria->select .= ' ,t.amenities_name';
		}
		$criteria->order = ' amenities_name asc';
		return  Amenities::model()->findAll($criteria);
	}
	public function	subcategoriesarray()
	{
		return array(
			"3" => $this->mTag()->getTag("agriculture_land", "Agriculture Land"),
			"2" => $this->mTag()->getTag("commercial_plot", "Commercial Plot"),
			"6" => $this->mTag()->getTag("file", "File"),
			"5" => $this->mTag()->getTag("industrial_land", "Industrial Land"),
			"1" => $this->mTag()->getTag("residential_plot", "Residential Plot"),
		);
	}
	public $expire1;
	public function isLiveAd()
	{
		$condition = '(CASE WHEN 1 ';
		$expiry_condition = Yii::app()->options->get('system.common.no_expiry', '');

		$expiry_days = $this->no_days_forexpity();
		if ($expiry_condition != '1' and !empty($expiry_days)) {

			$condition .=   '  and  CASE WHEN t.section_id = "3" THEN 1 ELSE    TIMESTAMPDIFF(DAY,(CASE WHEN t.extended_on IS NOT NULL THEN t.extended_on ELSE  t.date_added END),NOW()) <   ' . $expiry_days . ' END ';
		}

		$condition .= "  and  ( plan.max_listing_per_day = '0'  or  plan.max_listing_per_day   > 0  ) and CASE WHEN plan.validity = '0' THEN 1 ELSE    DATEDIFF( NOW(), plan.date_start  ) <=  plan.validity END  and plan.date_start <= CURDATE() ";
		$condition .= ' THEN "1" ELSE "0" END ) as expire1';
		return $condition;
	}
	public function isLiveAd2()
	{
		$condition = '(CASE WHEN 1 ';
		$expiry_condition = Yii::app()->options->get('system.common.no_expiry', '');

		$expiry_days = $this->no_days_forexpity();
		if ($expiry_condition != '1' and !empty($expiry_days)) {

			$condition .=   '  and  CASE WHEN t.section_id = "3" THEN 1 ELSE    TIMESTAMPDIFF(DAY,(CASE WHEN t.extended_on IS NOT NULL THEN t.extended_on ELSE  t.date_added END),NOW()) <   ' . $expiry_days . ' END ';
		}

		$condition .= "  and  plan.plan_id IS NOT NULL ";
		$condition .= ' THEN "1" ELSE "0" END ) as expire1';
		return $condition;
	}
	public function category_list()
	{
		static $_categoryList;
		if ($_categoryList !== null) {
			return $_categoryList;
		}

		if (empty($_categoryList)) {
			$_categoryList = Category::model()->all_categories_list();
		}
		return $_categoryList;
	}
	public function states_list()
	{
		static $_statesList;
		if ($_statesList !== null) {
			return $_statesList;
		}
		if (empty($_statesList)) {
			$_statesList = States::model()->all_cities();
		}
		return $_statesList;
	}
	public function getCategoryName()
	{
		if (!empty($this->category_name)) {
			return $this->category_name;
		}
		$ar = $this->category_list();

		return isset($ar[$this->category_id]) ? $ar[$this->category_id] : '';
	}
	public function getStateName()
	{
		if (!empty($this->state_name)) {
			return $this->state_name;
		}
		if (defined('COUNTRY_ID')) {
			$ar = $this->states_list();
			return isset($ar[$this->state]) ? $ar[$this->state] : '';
		}
	}
	public function getStatebName()
	{
		return !empty($this->state_name_ar) ? $this->state_name_ar : $this->state_name;
	}
	public $state_name_ar;

	public function getAdTitleArabic()
	{
		if (!empty($this->ad_title2) and $this->is_rtl($this->ad_title2)) {
			return $this->ad_title2;
		}
		return   $this->ad_title;
	}

	public function getadTitleEnglish()
	{
		if (!empty($this->ad_title2) and !$this->is_rtl($this->ad_title2)) {
			return  $this->ad_title2;
		}
		return   $this->ad_title;
	}
	public function getAdMetaDescriptionEnglish()
	{
		if (!empty($this->ad_description2) and !$this->is_rtl($this->ad_description2)) {
			return StringHelper::truncateLength($this->ad_description2, 160);
		}
		return StringHelper::truncateLength($this->ad_description, 160);
	}
	public function getMetaTitleEnglish()
	{
		if (!empty($this->meta_title)) {
			return $this->meta_title;
		} else {
			return  $this->adTitleEnglish;
		}
	}
	public function getMetaTitleArabic()
	{
		if (!empty($this->meta_title_ar)) {
			return $this->meta_title_ar;
		} else {
			return  $this->adTitleArabic;
		}
	}

	public function getMetaDescriptionEnglish()
	{
		if (!empty($this->meta_description)) {
			return $this->meta_description;
		} else {
			return $this->adMetaDescriptionEnglish;
		}
	}
	public function getMetaDescriptionArabic()
	{
		if (!empty($this->meta_description_ar)) {
			return $this->meta_description_ar;
		} else {
			return $this->AdMetaDescriptionArabic;
		}
	}

	public function getAdMetaDescriptionArabic()
	{
		if (!empty($this->ad_description2) and $this->is_rtl($this->ad_description2)) {
			return StringHelper::truncateLength($this->ad_description2, 150);
		}
		return StringHelper::truncateLength($this->ad_description, 150);
	}
	public $l_slug;
	public function getPriceTitleSimple($code = '')
	{

		if ($this->p_o_r == '1') {
			return  '0';
		}

		$code = $this->currencyTitle;
		return $code . Yii::t('app', $this->newFormat, array('.00' => ''));
	}
	public function getPriceTitleSimpleRent($code = '')
	{

		if ($this->p_o_r == '1') {
			return  $this->mTag()->getTag('price_on_request', 'Price on Request');
		}

		$code = $this->currencyTitle;
		return $code . Yii::t('app', $this->newFormat, array('.00' => '')) . '/' . $this->getRentPaidL();
	}

	public function getSecNewTitleNew()
	{
		switch ($this->section_id) {
			case '1':
				return 'للبيع';
				break;
			case '2':
				return  'للإيجار';
				break;
			default:
				return $this->section_name;
				break;
		}
	}
	public function getUserTypeNew()
	{
		return array(
			'A' => 'وكيلات',
			'C' => 'شركة عقارية',
			'D' => 'مطور عقارات',
			'P' => 'صاحب العقار',
			'M' => 'شركة إدارة الممتلكات',

		);
	}
	public function getTypeTileNew()
	{
		$ar = $this->getUserTypeNew();
		return isset($ar[$this->user_type]) ? $ar[$this->user_type] : '-';
	}
	public $adv_ch;
	public function selectcount($count = 20)
	{
		$ar = array();
		for ($i = 0; $i <= $count; $i++) {
			$ar[$i] = $i;
		}
		return $ar;
	}
	public function yearsa($count = 50)
	{
		$yr  = $this->mTag()->getTag('year', 'Year');
		$yrs = $this->mTag()->getTag('years', 'Years');
		$ar = array();
		$ar[''] = 'Select';
		$ar[999] = '0+ ' . $yr;;
		$ar[1000] = '0+ ' . $yr;;
		for ($i = 1; $i <= $count; $i++) {
			if ($i == '1') {
				$ar[$i] = $i . '+ ' . $yr;
			} else {
				$ar[$i] = $i . '+ ' . $yrs;;
			}
		}

		return $ar;
	}
	public function getCdateTitle()
	{
		if ($this->expiry_date == '0000-00-00') {
			return false;
		}
		if (!empty($this->expiry_date)) {
			return date('m/d/y', strtotime($this->expiry_date));
		}
		return false;

		if (!empty($this->c_date)) {
			$yr  = $this->mTag()->getTag('year', 'Year');
			$yrs = $this->mTag()->getTag('years', 'Years');
			if ($this->c_date == 1000) {
				return  '0+ ' .	$yr;
			} else  if ($this->c_date == 999) {
				return  '0+ ' .	$yr;
			} else if ($this->c_date == 1) {
				return  '1+ ' .	$yr;
			} else {
				return $this->c_date . '+ ' .	$yrs;
			}
		}
	}
	public function adExpiryDate()
	{
		return date('Y-m-d', strtotime($this->date_added . ' + 180 days'));
	}
	public function adDateAdded()
	{
		return date('Y-m-d', strtotime($this->date_added));
	}
	public function adDateUpdated()
	{
		return date('Y-m-d', strtotime($this->last_updated));
	}
	public function getSecNewTitleNew2()
	{
		switch ($this->section_id) {
			case '1':
				return 'Buy';
				break;
			case '2':
				return 'Rent';
				break;
			default:
				return $this->section_name;
				break;
		}
	}
	public function getUnpublishedDate()
	{
		return !empty($this->HandoverDate) ? date('d-m-Y', strtotime($this->HandoverDate)) :  date('d-m-Y', strtotime($this->lastUpdated));
	}
	public function getIncomePrice()
	{
		if (defined('SELECTED_CURRENCY') && SELECTED_CURRENCY != '2') {
			$num = Yii::t('app', number_format($this->income * SELECT_CURRENCY_RATE, 2, '.', ''), array('.00' => ''));
		} else {
			$num = Yii::t('app', number_format($this->income, 2, '.', ''), array('.00' => ''));
		}
		return '<small> ' . SELECT_CURRENCY_TITLE . ' </small>' . Yii::t('app', $this->getnewFormat($num), array('.00' => ''));
	}
	public function getIsPreleased()
	{
		if ($this->property_status == '1') {
			return true;
		}
		return false;
	}
	public function getSqft_aray()
	{

		return
			array(
				'800' => '800',
				'1000' => '1000',
				'1500' => '1500',
				'2000' => '2000',
				'2500' => '2500',
				'3000' => '3000',
				'3500' => '3500',
				'4000' => '4000',
				'4500' => '4500',
				'5000' => '5000',
				'5500' => '5500',
				'6000' => '6000',
				'6500' => '6500',
				'7000' => '7000',
				'7500' => '7500',
				'8000' => '8000',
				'8500' => '8500',
				'9000' => '9000',
				'9500' => '9500',
				'10000' => '10,000',
				'11000' => '11,000',
				'12000' => '12,000',
				'13000' => '13,000',
				'14000' => '14,000',
				'15000' => '15,000',
				'17500' => '17,500',
				'20000' => '20,000',
				'22500' => '22,500',
				'25000' => '25,000',
				'30000' => '30,000',
				'35000' => '35,000',
				'50000' => '50,000',
				'75000' => '75,000',
				'100000' => '100,000',
				'150000' => '150,000',
				'200000' => '200,000',
			);
	}
	public function getlease_status()
	{

		return array(
			'1' => 'Leased',
			'2' => 'Vacant',
		);
	}
	public function generateLinks($formData, $category_text = null)
	{
		$region_list = array('dubai' => 'Dubai', 'abu-dhabi' => 'Abu Dhabi', 'sharjah' => 'Sharjah', 'ajman' => 'Ajman', 'al-ain' => 'Al Ain', 'ras-al-khaimah' => 'Ras Al Khaimah', 'umm-al-quwain' => 'Umm Al Quwain', 'fujairah' => 'Fujairah');
		$data =  array_filter($formData);
		$html = '';

		if (!empty($category_text)) {
			$category = $category_text;
		} else {
			$category = isset($data['type_of']) ? Yii::t('app', strtolower($data['type_of']), array('_' => ' ', 'commercial' => '', 'residential' => '')) : '';
		}
		switch ($data['sec']) {
			case 'property-for-sale':
				$titlte =  !empty($category) ? Yii::t('app', $this->mTag()->getTag('{c}_for_sale_in_{l}', '{c} for sale in {l}'), array('{c}' => '<span>' . $category . '</span>'))   :  $this->mTag()->getTag('properties_for_sale_in_{l}', 'Properties for sale in {l}');
				break;
			case 'property-for-rent':
				$titlte = !empty($category) ?  Yii::t('app', $this->mTag()->getTag('{c}_for_rent_in_{l}', '{c} for rent in {l}'), array('{c}' => '<span>' . $category . '</span>')) : $this->mTag()->getTag('properties_for_rent_in_{l}', 'Properties for rent in {l}');
				break;
			default:
				$titlte =  !empty($category) ? Yii::t('app', $this->mTag()->getTag('{c}_in_{l}', '{c} in {l}'), array('{c}' => '<span>' . $category . '</span>')) :  $this->mTag()->getTag('properties_for_rent_in_{l}', 'Properties in {l}');
				break;
		}
		$ar = array();
		if (isset($data['sec'])) {
			$ar['sec'] = $data['sec'];
		}
		if (!empty($category)) {
			$ar['type_of'] = $data['type_of'];
		}
		if (isset($data['state']) and in_array($data['state'], array_keys($region_list))) {
			foreach ($region_list as $k => $v) {
				$ar['state'] = $k;
				$html .= '<li>' . Chtml::link(Yii::t('app', $titlte, array('{l}' => $v)), Yii::app()->createUrl('listing/index', $ar)) . '<li>';
			}
		} else  if (isset($data['state']) or isset($data['type_of'])) {
			$criteria =  PlaceAnAdNew::model()->findAds($ar, false, 1);
			if (!isset($formData['state'])) {
				$criteria->select   .= ',st.slug as state_slug';
			}
			$criteria->group = 't.state';
			$criteria->order = 'count(t.id) desc';
			$criteria->limit = 15;
			$items = PlaceAnAdNew::model()->findAll($criteria);

			foreach ($items as $k => $v) {
				$ar['state'] = $v->state_slug;
				$html .= '<li>' . Chtml::link(Yii::t('app', $titlte, array('{l}' => $v->stateName)), Yii::app()->createUrl('listing/index', $ar)) . '<li>';
			}
		}
		return $html;
	}
	public function projectstatus()
	{
		return array(
			'all' => $this->mTag()->getTag('all', 'All'),
			'ready' => $this->mTag()->getTag('ready', 'Ready'),
			'off-plan' => $this->mTag()->getTag('off_plan', 'Off Plan'),

		);
	}
	public $category_img;
	public function getsubmited_by_array()
	{
		return array('1' => 'Real Estate Agent', '2' => 'Seller/Owner', '3' => 'Real Estate Developer');
	}
	public function getSdate()
	{
		return date('d/m/Y', strtotime($this->date_added));
	}
	public function getLdate()
	{
		return date('d/m/Y', strtotime($this->last_updated));
	}
	public function getComparisonSignsList()
	{
		return array(
			'='  => '=',
			'>'  => '>',
			'>=' => '>=',
			'<'  => '<',
			'<=' => '<=',
			'<>' => '<>',
		);
	}
	public $pickerDateStartComparisonSign;
	public function getDatePickerFormat()
	{
		return 'yy-mm-dd';
	}
}