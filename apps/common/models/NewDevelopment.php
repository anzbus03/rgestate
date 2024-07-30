<?php

/**
 * This is the model class for table "mw_place_an_ad".
 *
 * The followings are the available columns in table 'mw_place_an_ad':
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
class NewDevelopment extends PlaceAnAd
{
	public $add_property_types;
	public $payment_plan; 
	public $startDate;
	public $endDate;
	public function attributeLabels()
    {
		$label1 =  array();
		 if(!empty($this->category->section_id) and $this->category->section_id==self::RENT_ID)
		 {
 
		  $label1 =   
		    array('price'=> 'Rent') ;
		     
	      }
         $label2 =  array(
            'id' => 'ID',
            'section_id' => 'Section',
            'rent_pad' => 'Rent Paid On ',
            'category_id' => 'Category',
            'sub_category_id' => 'Sub Category',
            'ad_title' => 'Project Title',
            'ad_description' => 'Project Description',
            'engine_size' => 'Engine Size',
            'killometer' => 'Killometer',
            'model' => 'Model',
          //  'price' => 'Price',
            'year' => 'Year',
            'country' => 'Country',
            'state' => 'State',
            'mobile_number' => 'Mobile Number',
            'employment_type' => 'Employment Type',
            'compensation' => 'Compensation',
            'education_level' => 'Education Level',
            'experience_level' => 'Experience Level',
         //   'skills' => 'Skills',
            'area' => 'Area (sqft)',
            'bathrooms' => 'Bathrooms',
            'bedrooms' => 'Bedrooms',
            'price' => 'Starting Price ',
            'user_id' => $this->CustomerTitle ,
             'p_types' => 'Property Types' ,
            'added_date' => 'Added Date',
            'date_added' => 'Date',
            'modified_date' => 'Modified Date',
             'age' =>'Age',
            'height'=>'Height',
            'marital_status' =>'Marital Status',
            'religion_id' =>'Religion',
            'mother_tongue' =>'Mother Tongue',
            'current_occupation' =>'Current Occupation',
            'priority' => 'Priority',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'slug' => 'Slug',
            'bodycondition' => 'Body Condition',
            'mechanicalcondition' => 'Mechanical Condition',
            'cylinders'=>'Cylinder',
            'area_location' =>'Location',
            	'community_id'=>'Community',
				'sub_community_id'=>'Sub Community',
				'builtup_area_sqft' =>'Area ( Sq.Ft. )',
				'nearest_metro' =>'Nearest metro stations',
				'nearest_railway' =>'Nearest school',
					'builtup_area'=>'Builtup area in Sq.Ft.',
					'plot_area'=>'Plot area in Sq.Ft.',
					'parking'=>'Parking Available?.',
					'bathroom'=>'No. of Bathroom.',
					'bedroom'=>'No. of Bedroom.',
					'rera_no'=>'RERA Permit Number',
					'PrimaryUnitView'=>'Property Views',
					'construction_status'=>'Possession Status',
						'FloorNo'=>'Property on Floor',
						'total_floor'=>'Total Floors',
						'balconies'=>'Total Balconies',
						'state'=>'Region',
						'country_name'=>'City',
						'year_built'=> $this->section_id=='3' ? 'Completion Year' :'Year Built',
						'price' => 'From Price ',
						'price_false' => 'From Price ',
            'price_to' => 'To Price ',
            'price_to_false' => 'To Price ',
              'video' => 'Youtube URL',
              'location_latitude'=>'Location',
        );
  
           // return array_replace($label2,$label1);
           return array_merge($label2,$label1);
    }
    public function projectStatus(){
        return array(
            '1' => 'Off Plan',
            '2' => 'Ready'
            
            );
    }
	  
	public function rules()
    {
		 $rules1 =  array(); 
		 if($this->dynamic)
		 {
	         
					$rules1[] =   array(array_diff((array)$this->dynamicArray,(array) $this->_notMadatory  ) , 'required');
					$rules1[] =   array( (array) $this->_notMadatory , 'safe');
				 
				 
		 }
		 $rules  =  array(
            array('user_id ,image,ad_title,ad_description,price_false,mobile_number,p_types,project_status', 'required'),
            array('country,state, location_latitude', 'required','on'=>'new_insert'),
            array('city', 'safe','on'=>'new_insert'),
            array('section_id, category_id, sub_category_id, country, state, city, district,   user_id, priority,    community_id, sub_community_id,RetUnitCategory', 'numerical', 'integerOnly'=>true),
            array('ad_title, slug,   area_location, property_name, PrimaryUnitView,      FloorNo,             mandate', 'length', 'max'=>250),
            array(' currency_abr, area_measurement', 'length', 'max'=>10),
            array('price', 'length', 'max'=>14),
            array('price,RentPerMonth,Rent', 'length', 'max'=>14),
            array('mobile_number', 'length', 'max'=>15),
            array('isTrash,  dynamic,    featured, xml_inserted', 'length', 'max'=>1),
            array('location_latitude, location_longitude, salesman_email', 'length', 'max'=>150),
            //array('xml_type', 'length', 'max'=>2),
            //array('xml_reference', 'length', 'max'=>25),
            array('code, RefNo', 'length', 'max'=>20),
            array('plot_area, builtup_area', 'numerical' ),
            array('plot_area, builtup_area', 'length', 'max'=>10),
            array('parking', 'length', 'max'=>5),
            array('furnished,maid_room', 'length', 'max'=>5),
            array('rera_no', 'length', 'max'=>50),
            array('bedrooms,bathrooms', 'numerical', 'integerOnly'=>true),
            array('minPrice,maxPrice,type_of', 'numerical' ),
		    array('price', 'numerical' ),
		    array('dynamicArray', 'unsafe' ),
		    array('ad_images_g,payment_plan,contact_person', 'safe' ),
		    array('add_property_types', 'validateAddProperty' ),
		    array('payment_plan', 'validateAddProperty2' ),
		    array('foor_plan', 'validateAddProperty3' ),
		    array('meta_title,meta_description,tag_list2,price,price_to_false,price_to,video,from_price_unit,to_price_unit,available_units', 'safe' ),
            array('nearest_metro,nearest_railway,category_name,community_name,country_name,user_name,keyword,maxSqft,minSqft,sort,year_built,floor_plan,listing_type', 'safe'),
            array('modified_date, xml_listing_date, xml_update_date, expiry_date,property_overview,LocalAreaAmenitiesDesc,RecommendedProperties,PropertyID,status,rent_paid,name', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, section_id, category_id, sub_category_id, ad_title, ad_description, price, country, state, city, district, mobile_number, bathrooms, bedrooms, user_id, added_date, modified_date, priority, isTrash, status,occupant_status, slug, image, dynamic, dynamicArray, location_latitude, location_longitude, featured, area_location, xml_inserted, xml_pk, xml_type, xml_reference, xml_listing_date, xml_update_date, code, RefNo, community_id, sub_community_id, property_name, builtup_area, PrimaryUnitView,     FloorNo, HandoverDate,     parking,   salesman_email, expiry_date,   endDate,startDate,date_added,    mandate, currency_abr, area_measurement, PDFBrochureLink,property_overview,ReraStrNo', 'safe', 'on'=>'search'),
        );
        return array_merge($rules1,$rules);
    }
      public function validateAddProperty($attribute,$params){
			     $post =  Yii::App()->request->getPost('add_property_types',array());
			     $errorFound = false; 
			      if(!empty($post)){ 
					  
		 
					for($i= 0 ; $i<sizeOf($post['title']);$i++){
						if(empty( $post['title'][$i]) ||  empty($post['size'][$i]) ||  empty($post['a_unit'][$i])  )
						{
							 $errorFound = true; 
						}
				 	};  
				 	if($errorFound){
						$this->addError($attribute,  Yii::t('app','Please fill title , from pricce , unit area    values.' ,array('{attribute}'=>$this->getAttributeLabel($attribute))));
			 
					}
				}
				
		 
	}
      public function validateAddProperty2($attribute,$params){
			     $post =  Yii::App()->request->getPost('payment_plan',array());
			     $errorFound = false; 
			      if(!empty($post)){ 
					  
		 
					for($i= 0 ; $i<sizeOf($post['title']);$i++){
						if(empty( $post['title'][$i]))
						{
							 $errorFound = true; 
						}
				 	};  
				 	if($errorFound){
						$this->addError($attribute,  Yii::t('app','Please fill all row values.' ,array('{attribute}'=>$this->getAttributeLabel($attribute))));
			 
					}
				}
	}

      public function validateAddProperty3($attribute,$params){
			     $post =  Yii::App()->request->getPost('floor_plan',array());
			     $errorFound = false; 
			      if(!empty($post)){ 
					  
		 
					for($i= 0 ; $i<sizeOf($post['title']);$i++){
						if(empty( $post['title'][$i]))
						{
							 $errorFound = true; 
						}
				 	};  
				 	if($errorFound){
						$this->addError($attribute,  Yii::t('app','Please fill all row values.' ,array('{attribute}'=>$this->getAttributeLabel($attribute))));
			 
					}
				}
	}
    public function beforeSave(){
		 parent::beforeSave();
		  if(!empty($this->from_price_unit) and !empty($this->price_false)){
			$priceModel =  PriceUnit::model()->findByPk($this->from_price_unit);
			if($priceModel){
				$this->price = $this->price_false * $priceModel->value; 
			}
			else{
				$this->price = $this->price_false ; 
			}
		 }
		 else{
				$this->price = $this->price_false ; 
			}
		 if(!empty($this->to_price_unit) and !empty($this->price_to_false)){
			$priceModel =  PriceUnit::model()->findByPk($this->to_price_unit);
			if($priceModel){
				$this->price_to = $this->price_to_false * $priceModel->value; 
			}
			else{
				$this->price_to = $this->price_to_false ; 
			}
		 }
		 	else{
				$this->price_to = $this->price_to_false ; 
			}
		 $this->section_id = '3' ; 
		 if(defined('IS_MOBILE')){
		      $this->status  = Yii::app()->options->get('system.common.frontend_default_ad_status','W');
		 }
		 else if(Yii::app()->isAppName('frontend')){
			  //$this->user_id = Yii::app()->user->getId();
			  $this->status  =  'W' ;
		 }
	 
		 return true;
	 }
       public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	 
}
