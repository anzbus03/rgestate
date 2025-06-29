<?php

/**
 * This is the model class for table "mw_booking_users".
 *
 * The followings are the available columns in table 'mw_booking_users':
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property integer $country
 * @property string $zip
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $password
 * @property integer $isTrash
 * @property string $status
 */
class ListingUsers extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
     public $no_image; 
    public $service_offerng;
	public $service_offerng_detail;
	public $con_password;
	public $old_password;
	public $checkin;
	public $user_name;
	public  $login_email;
	public  $login_password;
	public  $mul_country_id;
	public  $mul_state_id;
	public  $languages_known;
	public  $property_type;
	public  $country_slug;
	public  $region;
	public  $property;
	public  $confirm_email;
	public  $state_slug;
	public  $tags_list;
	public  $id2;
	public $agree;
	public $v_false;public $f_type;
	public  $tag_list2;public  $otp_false;
	const FEATURED_AGENT = '18';
	const PROFILE_ID = '3';
	public $follow;
	const FEATURED_DEVELOPER = '23';
	const FEATURED_AGENCIES = '20';
	const RECOMANDED_AGENTS     = '13';
	const RECOMANDED_AGENCIES = '19';
	const RECOMANDED_DEVELOPERS = '22';
	const TOP_REAL_ESTATE_COMPANIES = 14;
	const TOP_REAL_ESTATE_DEVELOPERS = '21';
	
	const TOP_SALE_AGENT = '13';
	const EXPERIENCED_S_MANAGERS = '15';
	const TOP_RENT_AGENTS = '16';
     public $_recaptcha;
    public $need_captcha_validation;
    public $search_visitor;
    public $search_agent;
    
     public $show_full;
    public function tableName()
    {
        return '{{listing_users}}';
    }
 public function getPrimaryField(){
		 return 'user_id';
	 }

    /**
     * @return array validation rules for model attributes.
     */
    public function validateemailRequired($attribute,$params){
			if( $this->log_not != '1' ){ 
				if (empty($this->email)){
					$this->addError('email',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel($attribute))));
				}
				if (empty($this->password)){
					$this->addError('password',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel($attribute))));
				}
			 }
			 else{
				 if (empty($this->contact_email)){
					$this->addError('contact_email',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel($attribute))));
				}
			 }
			 
		 
	}
	public $hours_different;
	public $whatsapp_false;
	public $phone_false;
	public function user_status(){
		return array(
		'A' =>$this->mTag()->getTag('active','Active'),
		'I' =>$this->mTag()->getTag('inactive','Inactive'),
		
		);
	}
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $required = $this->mTag()->gettag('required','Required');
        return array(
            array('login_email,login_password', 'required',"on"=>array("login"),  'message'=>$required),
            //  array('_recaptcha', 'validateRecaptcha' ,"on"=>'new_front_insert' ),
            array('first_name,email', 'required',"on"=>array('frontend_insert',"insert","update",'agent_insert','agent_update','developer_insert','developer_update','agent_update1','developer_update1','customer_insert','customer_update'),  'message'=>$required),
             array('phone,whatsapp', 'validatePhone'),
                array('phone', 'required',"on"=>'change_phone',  'message'=>$required), 
                array('email', 'required',"on"=>array('change_email'),  'message'=>$required),
                 array('email', 'validateUniqueEmail',"on"=>array('change_email')),
              array('phone', 'validateUnique',"on"=>'new_front_insert,change_phone'), 
               array('first_name', 'required',"on"=>array('change_name'),  'message'=>$required),
              array('v_false', 'validateVerification',"on"=>'verificationCode'),
              array('company_name_ar,address_ar,company_name,address', 'length', 'max'=>250),
              array('phone', 'validateUniqueOTP',"on"=>'send_otp'),
              //array('full_number', 'validatePhoneforVerification','on'=>'send_otp'), 
                array('phone', 'required','on'=>'send_otp',  'message'=>$required), 
                 array('max_no_users',  'numerical', 'integerOnly'=>true, 'min'=>0, 'max'=>200),
                 array('otp,full_number', 'safe','on'=>'send_otp'), 
                 array('full_number,user_status', 'safe' ), 
                   array('otp_false', 'required','on'=>'input_otp',  'message'=>'Please enter.'),
                    array('otp_false', 'validateOtpCompare','on'=>'input_otp'),
                     array('otp_false', 'length', 'max'=>4),
                       array('v_false', 'length', 'max'=>6),
                        array('description,description_ar', 'validateDescription' ),
                    array('description', 'validateUpdateProfile','on'=>'update_profile'), 
                    array('property_t', 'validateUpdateDoc','on'=>'update_profile'), 
                    array('cr_number', 'validateUpdateDoc2','on'=>'update_profile'), 
                     array('licence_no', 'validateLicence','on'=>'update_profile'), 
                    array('property_t,property_a,cr_number,u_crdoc,s_w', 'safe' ), 
            array('email,password', 'validateemailRequired',"on"=>array('new_front_insert'),  'message'=>$required),
            array('email', 'validateemailRequired',"on"=>array('email')),
            array('first_name, phone ', 'required',  "on"=>array('new_front_insert'),  'message'=>$required),
            array('user_type', 'required',  'message'=>'Please select.',"on"=>array('new_front_insert'),  'message'=>$required),
            array('first_name,user_type', 'required',"on"=>array('new_update'),  'message'=>$required),
            array('zip,fax,website', 'safe',"on"=>array('new_update')),
            array('con_password', 'compare', 'compareAttribute' => 'password',"on"=>"new_front_insert",'message'=>$this->mTag()->getTag('not_match_with_password','Not match with password')),
            //array('company_name,address,service_offerng_detail,mul_state_id,service_offerng,description', 'validateCompanyFields',"on"=>"new_front_insert,new_update"),
              array('agree', 'validateAgreeFields',"on"=>"new_front_insert,new_update"),
            array('email', 'unique' ),
            array('country_id,state_id, isTrash', 'numerical', 'integerOnly'=>true),
            array('password,con_password','required','on'=>"frontend_insert,insert,updatepassword,updatepasswordu,agent_insert,developer_insert, customer_insert",  'message'=>$required),
            array('image,country_id,phone,mul_country_id','required','on'=>"agent_insert,developer_insert,developer_update,agent_update,agent_update1,developer_update1",  'message'=>$required),
            array('password,con_password','required','on'=>"updatepassword1",  'message'=>$required),
            array('image,country_id,phone','required','on'=>'customer_insert,customer_update',  'message'=>$required),
            array('first_name, last_name, city, state, email', 'length', 'max'=>150),
            array('email','email','message'=>$this->mTag()->getTag('enter_a_valid_email_address.','Enter a valid email address.')),
            array('iframe_map', 'length', 'max'=>500),
            array('company_profile', 'length', 'max'=>150),
            array('explore_title', 'length', 'max'=>250),
            
             array('e_h_t,l_h_t', 'length', 'max'=>50),
             array('v_a_ti,p_he', 'length', 'max'=>50),
        
            array('full_number,v_send_at,o_send_at,super_user,is_verified,search_visitor,search_agent,banner_image,banner_image_mobile,a_number,company_profile,iframe_map,explore_title,s_channel,refered_by,parent_user,from_date,to_date,show_all,longitude,latitude,first_name_ar,role_id,a_chara_ar','safe'),
            
             array('first_name,phone,country_id,state_id,user_type', 'required',"on"=>array('new_update1'),  'message'=>$required),
            array('zip,fax,website,enable_l_f,o_verified,email_verified,image', 'safe',"on"=>array('new_update1')),
            array('first_name,phone,country_id,state_id,user_type,full_number', 'required',"on"=>array('new_update1'),  'message'=>$required),
            
              array('first_name,user_type', 'required',"on"=>array('new_update2'),  'message'=>$required),
            array('zip,fax,website,enable_l_f,o_verified,email_verified,image', 'safe',"on"=>array('new_update2')),
         
            
            array('description,image,address','required', 'on'=>"developer_update,agent_update,agent_update1,developer_update1" ,  'message'=>$required),
           
            array('website','safe', 'on'=>"developer_update,agent_update,agent_update1,developer_update1" ),
            array('contact_person,contact_email,facebook,twiter,google,company_name','safe', 'on'=>"developer_update,agent_update,agent_update1,developer_update1" ),
            array('contact_person,contact_email,facebook,twiter,google,company_name', 'length', 'max'=>150),
            array('contact_email','email'),
            
            array('whatsapp_c_link', 'length', 'max'=>130),
            array('cover_image,log_not,otp,o_verified,,o_skipped,e_skipped,youtube,whatsapp_c_image,whatsapp_c_name,premium,whatsapp_c_text,whatsapp_c_link,languages_known,pf_id','safe'),
            array('facebook,twiter,google,website','url','defaultScheme'=>'https'),

            array('email','unique', 'on'=>"frontend_insert,insert,agent_insert,developer_insert,developer_update,agent_update,agent_update1,developer_update1,customer_insert,customer_update" ),
            array('country_slug','required', 'on'=> 'find_step_1',  'message'=>$required ),
            array('property_type','safe', 'on'=>'find_step_1' ),
            array('address', 'length', 'max'=>500),
            array('licence_no', 'length', 'max'=>50),
            array('description', 'length', 'max'=>3000),
            array('user_type', 'required', 'on'=>'frontend_insert',  'message'=>$required),
             array('email_verified', 'safe', 'on'=>'frontend_insert'),
            array('user_type,calls_me,country_id,filled_info,transparent,user_type,service_offerng,service_offerng_detail,created_by,f_type,by_id', 'safe' ),
            array('image', 'required', 'on'=>'update_logo',  'message'=>$required),
            array('user_type', 'in', 'range' => array_keys($this->getUserType()),  'message'=>'Please enter a value for {attribute_value}.'),
            array('zip', 'length', 'max'=>7),
            array('phone', 'length', 'max'=>15),array('phone', 'length', 'min'=>9),
            array('old_password','checkOldPassword', 'on'=>'updatepassword'),
                array('password', 'required' , 'on'=>'update-new-password',  'message'=>$required),
			array('password', 'length', 'min'=>5,'on'=>'update-new-password'),

            array('first_name','required', 'on'=>'chnage_name',  'message'=>$required),
            array('fax', 'length', 'max'=>10),
            array('password', 'length', 'max'=>250,"on"=>"frontend_insert,insert,agent_insert,developer_insert,developer_update,agent_update,customer_insert,customer_update"),
            array('password', 'length', 'min'=>5,"on"=>"frontend_insert,insert,agent_insert,developer_insert,developer_update,agent_update,customer_insert,customer_update"),
            array('languages_known', 'required' ,"on"=>"agent_insert,agent_update,agent_update1",  'message'=>$required),
             array('slug', 'validateSlug' ,'on'=>'developer_update,agent_update,agent_update1,developer_update1' ),
             array('con_password', 'compare', 'compareAttribute' => 'password',"on"=>"frontend_insert,insert,updatepassword,updatepasswordu,agent_insert,developer_insert,developer_update,agent_update,customer_insert,customer_update,updatepassword1",'message'=>$this->mTag()->getTag('not_match_with_password','Not match with password')),
            array('status', 'length', 'max'=>1),
            array('mul_country_id,mul_state_id,enable_l_f,city,show_full', 'safe'),
            array('registered_via', 'safe'),
            array('send_me,featured', 'length', 'max'=>1),
            array('email','unique', 'on'=>'updateEmail'),
            array('email','required', 'on'=>'updateEmail',  'message'=>$required),
            array('email','updateEmailChecker', 'on'=>'updateEmail'),
            array('cover_letter,dob,calls_me,country,position_level,education_level,updates,advertisement,username,con_password,image,xml_inserted,xml_image,mobile,user_type,phone,city,user_name,email_verified','safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, first_name, last_name, address, city, state, country, zip, phone, fax, email, password, isTrash, status,date_added,company_name', 'safe', 'on'=>'search'),
        );
    }
    public function getLandLineNo(){
		return ''; 
	}
     public function getFilePath($file){
         if (strpos(	$file , '/20') !== false) {
					
					 
					    return Yii::app()->apps->getBaseUrl('uploads/files/'.$file );
					}
		return  ENABLED_AWS_PATH .$file ;
	}
    public function checkOldPassword($attribute,$params)
	{
			$login = new UserLogin();
			$login->email = $this->email;
			$login->password = $this->old_password;
			if(!$login->validate())
			{
				$this->addError($attribute, $this->mTag()->gettag('invalid_credential', 'Invalid Credential') );
			}
	}
     
       public function getUserType(){
		return array(
		'U' => $this->mTag()->getTag('visitor_(guest_member)','Visitor (Guest Member)'),
		'A' => $this->mTag()->getTag('user','User'),
		'C' => $this->mTag()->getTag('real_estate_company','Real Estate Company'),
		'D' => $this->mTag()->getTag('real_estate_developer','Real Estate Developer'),
		'P' => $this->mTag()->getTag('property_owner','Property Owner'),
		'M' => $this->mTag()->getTag('property_management_company','Property Management Company'),
	 
		);
	}
    public function getStatusArray(){
		return array(
		'A' => 'Active',
		'I' => 'Inactive',
		'W' => 'Waiting',
		'R' => 'Blocked',
		);
	}
	    public function updateEmailChecker($attribute,$params)
	{
		if(Yii::app()->user->getId()!= '' ){
			if (!empty($this->email)){
				if(Yii::app()->user->getModel()->email == $this->email  )
				{
				 
					$this->addError($attribute, 'change email must be differ from registered email ');
				}
			  
			}
		}
	    
	}
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
         'countries'=>array(self::BELONGS_TO, 'Countries', 'country_id'),
            'states'=>array(self::BELONGS_TO, 'States', 'state_id'),
         'adsCount' => array(self::STAT, 'PlaceAnAd', 'user_id','condition'=>"t.isTrash='0'"),
         'searchCount' => array(self::STAT, 'Searchlist', 'user_id'),
         'watchCount' => array(self::STAT, 'Watchlist', 'user_id'),
         'designation' => array(self::BELONGS_TO, 'AgentRole', 'designation_id'),
         'designationT' => array(self::BELONGS_TO, 'AgentRole', 'designation_id'),
         'moreCountry' => array(self::HAS_MANY, 'ListingUserMoreCountry', 'user_id'),
         'moreState' => array(self::HAS_MANY, 'ListingUserMoreState', 'user_id'),
         'moreLanguages' => array(self::HAS_MANY, 'UserLanguages', 'user_id'),
             'moreSection' => array(self::HAS_MANY, 'ListingUserSection', 'user_id'),
         'moreCategory' => array(self::HAS_MANY, 'ListingUserCategory', 'user_id'),
         'userTags' => array(self::HAS_MANY, 'ListingUsersTag', 'user_id'),
         'referer' => array(self::BELONGS_TO, 'ListingUsers', 'refered_by'),
        
        );
    }
    
	
	public function validateSlug($attribute,$params){
	 
			if (!empty($this->$attribute) and !preg_match('/^[A-Za-z0-9._-]+$/', $this->$attribute)   ){
			$this->addError($attribute, 'Only english letters numbers and \'_-\' allowed');
			}
		 
	}
	public function validateOtpCompare($attribute,$params){
	        
			if ( $this->otp_false  != $this->otp  ){
			$this->addError($attribute, 'Enter Valid Verification Code');
			}
            $criteria=new CDbCriteria;
            $criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ' ; 
            $criteria->condition=" t.user_id= :params ";
            $criteria->params[":params"] =  $this->user_id;
            $model =  ListingUsers::model()->find($criteria);
            if(!empty($model)  and ($model->hours_different >  10)){
            $this->addError($attribute, 'Verification Code Expired.');
            }

		 
		 
	}
	public function validateVerification($attribute,$params){
	 
	       $criteria=new CDbCriteria;
		   $criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.v_send_at IS NULL THEN t.date_added ELSE t.v_send_at  END , NOW()) AS hours_different ' ; 
		   $criteria->condition=" t.user_id = :params ";
		   $criteria->params[":params"] = $this->user_id ;
		    
		   $model =  ListingUsers::model()->find($criteria);
			if(empty($this->v_false)){
				$this->addError($attribute, $this->mTag()->gettag('required','Required'));
				}
	 
			if ( $this->v_false  != $model->verification_code  ){
			$this->addError($attribute, $this->mTag()->getTag('wrong_verification_code.','Wrong Verification Code.'));
			}
			if(!empty($model)  and ($model->hours_different >  120)){
			    	$this->addError($attribute, $this->mTag()->getTag('verification_code_expired.','Verification Code Expired.'));
			}
		 
	}
	
	public function validateUnique($attribute,$params){
	 
			 $criteria=new CDbCriteria;
			 $last7 = substr($this->phone, -10);
			 if(strlen($last7)==10){
			 $criteria->compare('RIGHT(t.phone,10)', $last7);
			 //$criteria->compare('t.isTrash','0');
			 $total_found = self::model()->count($criteria);
			 if( $total_found > 0 ){
			     
			     	$this->addError($attribute,Yii::t('app','Phone ends with  "{num}" has already been taken',array('{num}'=> $last7)));
			 }
			 }
		 
	}
		public function validateUniqueEmail($attribute,$params){
	 
			 $criteria=new CDbCriteria;
			  
			 $criteria->compare(' t.email', $this->email);
			 
			 $total_found = self::model()->count($criteria);
			 if( $total_found > 0 ){
			     
			     	$this->addError($attribute,Yii::t('app','Email has already been taken'));
			 }
			 
		 
	}
	public function validateUniqueOTP($attribute,$params){
	 
			 $criteria=new CDbCriteria;
			 $last7 = substr($this->phone, -10);
			 $criteria->compare('RIGHT(t.phone,10)', $last7);
			 //$criteria->compare('t.isTrash','0');
			  $criteria->compare('user_id!', $this->user_id);
			 $total_found = self::model()->count($criteria);
			 if( $total_found > 0 ){
			     
			     	$this->addError($attribute,Yii::t('app','Phone ends with  "{num}" has already been taken',array('{num}'=> $last7)));
			 }
			
		  
	}
	
	
	public function validatePhoneforVerification($attribute,$params){
	 
			if(strpos(Yii::t('app',$this->full_number,array(' '=>'')), $this->phone) !== false){
			 
			}else{
		    	$this->addError($attribute, 'Phone number mismatched'.$this->full_number.'-'.$this->phone);
			}
		 
	}
	
		public function validateAgreeFields($attribute,$params){
		 if(Yii::app()->isAppName('frontend')){
		    if (empty($this->$attribute)){
				$this->addError($attribute,  $this->mTag()->getTag('please_agree_our_terms','Please Agree Our Terms' ));
			}
		 }
		 
	}
	public function validateCompanyFields($attribute,$params){
		 
			if($attribute =='service_offerng' and in_array($this->user_type,array('D','U') )){ return true; }
			if(in_array($this->user_type,array('A','C','D','M'))){
			if (empty($this->$attribute)){
				$this->addError($attribute,  Yii::t('app','{attribute} cannot be blank.',array('{attribute}'=>$this->getAttributeLabel($attribute))));
			}
			}
		 
	}
	public function validateUpdateProfile($attribute,$params){
		 
		 	if (empty($this->description)){
				$this->addError('description',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel('description'))));
			}
			if (in_array($this->user_type,array('D','C','M') )){  
			    if (empty($this->company_name)){
			    	$this->addError('company_name',  Yii::t('app','{attribute} cannot be blank.',array('{attribute}'=>$this->getAttributeLabel('company_name'))));
		    	}  
			    if (empty($this->address)){
			    	$this->addError('address',  Yii::t('app','{attribute} cannot be blank.',array('{attribute}'=>$this->getAttributeLabel('address'))));
		    	} 
			}
			 
		 
	}
	public function validateUpdateDoc($attribute,$params){
		  if($this->user_type=='P'){
		 	if (empty($this->property_t)){
				$this->addError('property_t',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel('property_t'))));
			} 
		 	if (empty($this->property_a)){
				$this->addError('property_a',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel('property_a'))));
			} 
		  }
			 
		 
	}
	public function validateUpdateDoc2($attribute,$params){
		 	if(in_array($this->user_type,array('A','C','D','M'))){  
		 	if (empty($this->cr_number)){
				$this->addError('cr_number',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel('cr_number'))));
			} 
		 	if (empty($this->u_crdoc)){
				$this->addError('u_crdoc',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel('u_crdoc'))));
			} 
		  }
			 
		 
	}
	public function validateLicence($attribute,$params){
		 	if(in_array($this->user_type,array('A','C','D','M'))){  
		 	if (empty($this->licence_no)){
				$this->addError('licence_no',  Yii::t('app',$this->mTag()->gettag('required','Required'),array('{attribute}'=>$this->getAttributeLabel('cr_number'))));
			} 
		 	 
		  }
	}
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'by_id'=>'Bayut Broker ID',
            'pf_id' => 'Property Finder Broker ID',
            'company_name' => $this->mTag()->getTag('company_name','Company Name'),
             'company_name_ar' => $this->mTag()->getTag('company_name','Company Name'),
            'log_not' => 'Login info not required',
            'date_added' => $this->mTag()->getTag('date_added','Date Added'),
            'email' => $this->mTag()->getTag('email','Email'),
            'user_status'=> $this->mTag()->getTag('user_status','User Status'),
            'options' => $this->mTag()->getTag('options','Options'),
            'user_id' => 'ID',
            'role_id' =>$this->mTag()->getTag('role','Role') ,
            'property_t' =>  $this->mTag()->getTag('upload_property_title_deed','Upload Property Title Deed'),
            'property_a' =>  $this->mTag()->getTag('upload_authorization_letter','Upload Authorization Letter'),
            'cr_number' => $this->mTag()->getTag('commercial_registration_no.','Commercial Registration No.'),
            'u_crdoc' =>  $this->mTag()->getTag('upload_commercial_registration','Upload Commercial Registration'),
            'first_name' => $this->mTag()->getTag('full_name','Full Name'),
            'first_name_ar' => $this->mTag()->getTag('full_name','Full Name'),
            's_w' =>  $this->mTag()->getTag('click_here_if_same_mobile_no','Click here if same Mobile No. on WhatsApp'),
            'last_name' => 'Last Name',
            'address' => $this->mTag()->getTag('address','Address'),
             'address_ar' => $this->mTag()->getTag('address','Address'),
            'city' => 'City',
            'state' => 'State',
            'country_id' => 'Country',
            'zip' => 'Zip Code',
            
            'phone' => $this->mTag()->getTag('mobile_no.','Mobile No.'),
            'fax' => 'Fax',
            //'email' => 'Email',
            'password' => $this->mTag()->getTag('password','Password'),
            'isTrash' => 'Is Trash',
            'con_password' =>  $this->mTag()->getTag('confirm_password','Confirm Password'), 
            'send_me'=>'Send me newsletters with Secret Deals',
            'login_email'=>'Email',
            'login_password'=>'Password',
            'image'=>'Profile Photo',
            'state_id'=>'Region',
            'mul_country_id'=>'Choose Service Areas',
            'licence_no'=>$this->mTag()->getTag('advertiser_license_number','Advertiser License Number') ,
            'mul_state_id'=>$this->mTag()->getTag('service_areas','Service Areas'),
            'country_slug'=>'Country',
            'slug'=>'Unique ID',
             'designation_id'=>'Designation',
             'service_offerng_detail'=>$this->mTag()->getTag('property_types','Property Types'),
             'service_offerng' => $this->mTag()->getTag('properties_for','Properties for'),
             'mobile'=>'Landline No.',
              'user_type'=>'Registered as a',
               'otp'=>'Verification Code',
               'otp_false'=>'Enter Verification Code',
                'description'=> $this->getDescriptionTitle(),
                'description_ar'=> $this->getDescriptionTitle(),
                 'image'=>$this->ImageTitle,
                 'o_verified' =>'Mobile Verified',
                  'v_false' =>$this->mTag()->getTag('verification_code','Verification Code'),
                  'enable_l_f' =>'Enable listing on frontend',
                   'is_verified' =>'Verified',
                    'banner_image' =>'Banner Image - Desktop - 1920X800 ',
                   'banner_image_mobile' =>'Banner Image - Mobile - 400X600',
                   'iframe_map' =>'Map Source  - Iframe',
                   'cover_letter' =>'Contact Info',
                   'company_profile' =>'Company profile - pdf',
                   'youtube' =>'Youtube Video URL',
                   'whatsapp_c_name' =>'whatsapp contact name',
                   'whatsapp_c_image' =>'Whatsapp contact image 400 X 400 ',
                   'whatsapp_c_text' => 'Whatsapp Help text  ',
                   'whatsapp_c_link' => 'Whatsapp Help - link  ' ,
                   'premium' => 'Premium Member',
                   'e_h_t'=>'Explore Title - Heading',
                   'v_a_ti' => 'Title - View All',
                   'l_h_t' => 'Title - Latest Project',
                   'p_he' => 'Title - Projects',
                   'explore_title' =>'Explore Title  - Description ',
                   's_channel'=>'Sales Channel',
                   'refered_by'=>'Refered By',
                   'max_no_users'=>'Max no. of users  allowed under developer account?',
                   'languages_known' => $this->mTag()->getTag('languages','Language(s)'),
                   'banner_image_mobile' => $this->mTag()->getTag('advertiser-character','Advertiser character'),
                   'a_chara_ar' => $this->mTag()->getTag('advertiser-character','Advertiser Character'),
                   'a_number' => $this->mTag()->getTag('a_number','Authorization number'),
                   
        );
    }
   
    public function getDescriptionTitle(){
      switch($this->user_type){
         case 'A':
         return $this->mTag()->getTag('about_yourself','About Yourself') ;
         break;
         case 'C':
         return $this->mTag()->getTag('about_company','About Company');
         break;
         case 'D':
         return $this->mTag()->getTag('about_company','About Company');
         break;
         case 'M':
         return $this->mTag()->getTag('about_company','About Company');
         break;
         default:
         return $this->mTag()->getTag('about_yourself','About Yourself') ;
         break;
      }
    }
    public function getImageTitle(){
      switch($this->user_type){
         case 'A':
         return   $this->mTag()->getTag('upload_your_picture','Upload Your Picture') ;
         break;
         case 'C':
         return  $this->mTag()->getTag('upload','Upload Logo');
         break;
         case 'D':
         return  $this->mTag()->getTag('upload','Upload Logo');
         break;
         case 'M':
         return  $this->mTag()->getTag('upload','Upload Logo');
         break;
         default:
         return $this->mTag()->getTag('upload_your_picture','Upload Your Picture') ;
         break;
      }
    }
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
     public function getFullName()
    {
        if(defined('LANGUAGE')){
			 if(LANGUAGE=='en'){
				 if(!empty($this->company_name)){ return $this->company_name;  }
			 }
			 if(LANGUAGE=='ar'){
				 if(!empty($this->company_name_ar)){ return $this->company_name_ar;  }
			 }
		 }
        if(!empty($this->company_name)){ return $this->company_name; }
         if(defined('LANGUAGE') and LANGUAGE=='ar'){
              if(!empty($this->first_name_ar)){ return $this->first_name_ar;  }
			  
         }
        return $this->first_name.' '.$this->last_name ; 
    }
    	 public function latestFiles($limit=10){
			 $criteria = $this->search(1);
			 $criteria->limit = $limit;
			 return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
               'pagination'    => array(
                'pageSize'  => $limit,
                'pageVar'   => 'page',
            ),
        ));
		 }
		  public $city;
		  public $e_h_t;
		  public $l_h_t;
		  public $v_a_ti;
		  public $p_he;
		  public $whatsapp_c_link;
		  public $from_date;public $to_date;
		  public $show_all;
		  public $company_image;
		  public $active_plan;
    public function search($return = false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->condition = '1'; $criteria->select = 't.*';
        $criteria->compare('t.user_id',$this->user_id);
        
        /*
        $criteria->compare('t.first_name',$this->first_name,true);
        $criteria->compare('t.last_name',$this->last_name,true);
        $criteria->compare('t.first_name',$this->user_name,true);
        $criteria->compare('t.last_name',$this->user_name,true,'OR');
        */
        
        if(!empty($this->first_name)){
            	$criteria->condition.= ' and ( t.first_name like :firstname or t.first_name_ar like :firstname or t.last_name like :firstname   ) ';
			$criteria->params[':firstname'] = '%'.$this->first_name.'%';
        }
        
        $criteria->compare('address',$this->address,true);
        if(!empty($this->company_name)){
			$criteria->condition.= ' and CASE WHEN puser.user_id IS NOT NULL THEN puser.company_name ELSE t.company_name END  like :company_name ';
			$criteria->params[':company_name'] = '%'.$this->company_name.'%';
		}
		if(!empty($this->f_type)){
		    switch($this->f_type){
            case 'U':
                $criteria->condition.= ' and (t.parent_user is not null or t.user_type  = "A" )  ';
            break;
            case 'C':
                $criteria->condition.= ' and t.parent_user is null and t.user_type != "A" ';
            break;
		    }
		}
        //$criteria->compare('company_name',$this->company_name,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('state',$this->state,true);
        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('t.role_id',$this->role_id);
        $criteria->compare('zip',$this->zip,true);
        if(!empty($this->created_by)){
            $criteria->select   =   ' t.* ';
            	$criteria->join  .=   ' INNER   JOIN {{user}} gpu on gpu.user_id = t.created_by ';
            	$criteria->condition   .=  ' and gpu.group_id = 8 '; 
            	//if(Yii::app()->user->getModel()->removable=='yes'){
            	if(empty($this->show_all)){
            	 
                    $criteria->compare('t.created_by',$this->created_by);
                    $criteria->condition .= ' and t.parent_user is NULL ';
            	}
        }
        if(!empty($this->from_date)){
        $criteria->condition .= ' and DATE(t.date_added) >= :fromdate  ' ;
        $criteria->params[':fromdate'] = date('Y-m-d',strtotime($this->from_date));
		}
		if(!empty($this->to_date)){
        $criteria->condition .= ' and DATE(t.date_added) <= :to_date  ' ;
        $criteria->params[':to_date'] = date('Y-m-d',strtotime($this->to_date));
		}
        
        $criteria->compare('t.phone',$this->phone,true);
        $criteria->compare('fax',$this->fax,true);
        $criteria->compare('featured',$this->featured);
         $criteria->compare('premium',$this->premium);
        $criteria->compare('t.email',$this->email,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('t.isTrash',$this->isTrash);
        if(empty($this->show_full)){
        $criteria->compare('t.parent_user',$this->parent_user);
        }else{
         $criteria->condition .= ' and (t.user_id =:show_full or t.parent_user =:show_full) ';
         $criteria->params['show_full'] = $this->parent_user;
        }
        $criteria->compare('t.status',$this->status,true);
        $criteria->compare('t.user_type',$this->user_type);
       //  $criteria->compare('t. enable_l_f',1);
        $criteria->order = 't.user_id desc';
        if(!empty($this->search_visitor)){
          $criteria->compare('t.user_type','U');   
        }
        if(!empty($this->search_agent)){
          $criteria->compare('t.user_type!','U');   
        }
        $criteria->join  .=   ' LEFT   JOIN {{listing_users}} puser on puser.user_id = t.parent_user ';
			$criteria->select  .= ',CASE WHEN puser.user_id IS NOT NULL THEN puser.company_name ELSE t.company_name END as company_name,CASE WHEN puser.user_id IS NOT NULL THEN puser.image ELSE t.image END as company_image ';
			
         if(Yii::app()->isAppName('backend')){
				$criteria->join  .=   ' LEFT   JOIN {{states}} sts on sts.state_id = t.state_id ';
				$criteria->select .= ' ,sts.state_name as city '; 
				 $criteria->compare('sts.state_name',$this->city);
				 $criteria->select .=  "  , ( CASE WHEN  plan.plan_id THEN 1 ELSE 0 END )  as active_plan   ";
  $criteria->distinct = 't.user_id' ; 
				  $criteria->join  .= ' left join {{price_plan_order}}  plan on plan.customer_id =    (CASE WHEN t.parent_user is NOT NULL THEN  t.parent_user ELSE t.user_id END) and plan.status = "complete" and ( plan.max_listing_per_day = "0"  or  plan.max_listing_per_day   > 0  ) and CASE WHEN plan.validity ="0" THEN 1 ELSE    DATEDIFF( NOW(), plan.date_added  ) <=  plan.validity END  ';
	
		}
		  if(!empty($this->show_full)){
		        $criteria->order = 't.parent_user is null desc,t.user_id asc';
		  }
       if($return){ return $criteria ; }
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
     public function duplicate($return = false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        
		$criteria->select .= ',group_concat(t.user_id) as duplicate_column';
		$criteria->group = 't.full_number';
		
		
		
		
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('first_name',$this->user_name,true);
        $criteria->compare('last_name',$this->user_name,true,'OR');
        $criteria->compare('address',$this->address,true);
        $criteria->compare('company_name',$this->company_name,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('state',$this->state,true);
        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('zip',$this->zip,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('fax',$this->fax,true);
        $criteria->compare('featured',$this->featured);
        $criteria->compare('premium',$this->premium);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('t.isTrash',$this->isTrash);
        $criteria->compare('t.status',$this->status,true);
        $criteria->compare('t.user_type',$this->user_type);
        $criteria->order = 't.user_id desc';
        
        $criteria->having  =  ' count(t.user_id) > 1 ';
        if(!empty($this->search_visitor)){
          $criteria->compare('t.user_type','U');   
        }
        if(!empty($this->search_agent)){
          $criteria->compare('t.user_type!','U');   
        }
         if(Yii::app()->isAppName('backend')){
			//	$criteria->join  .=   ' LEFT   JOIN {{states}} sts on sts.state_id = t.state_id ';
				//$criteria->select .= ' ,sts.state_name as city '; 
				// $criteria->compare('sts.state_name',$this->city);
		}
       if($return){ return $criteria ; }
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  =>  $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
    public $duplicate_column;
      public function getUpdateAdFields(){
			    $criteria=new CDbCriteria;$criteria->condition = '1';
			    $ar1 = explode(',',$this->duplicate_column);
			    foreach($ar1 as $k2){
					$ar[$k2] =  $k2;
				}
				
				
				
				
			   unset($ar[$this->user_id]);
			    
			    foreach($ar as $k=>$v){
					// ListingUsers::model()->updateByPk($v,array('isTrash'=>'1'));
				}
			    
			    
			    $criteria->addInCondition('user_id', $ar);
			    $ads_found = PlaceAnAd::model()->findAll($criteria);
			    $html = '';
			    if($ads_found){
					  $html .= 'Found ';
					foreach($ads_found as $k=>$v){
						$html .= $v->id.',';
					}
				}
				if(!empty($html)){ rtrim($html,',');}
				return $html;
			    
		  }
		
   
    	public function generatePIN($digits = 6){
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }
        return $pin;
    }
    protected function beforeSave()
    {
         if($this->isNewRecord){
             if(defined('COUNTRY_ID')){
                 $this->country_id = COUNTRY_ID;
             }
          	$this->verification_code =  $this->generatePIN(6);
          	if(in_array($this->user_type,array('C','D'))){
			//	$this->max_no_users =  Yii::app()->options->get('system.common.max_no_users','') ; 
			}
         }
        if (!parent::beforeSave()) {
            return false;
        }
        if($this->isNewRecord and Yii::app()->isAppName('backend')){
            if(empty($this->created_by)){
			$this->created_by = Yii::app()->user->getId();
            }
			if(AccessHelper::hasRouteAccess ('listingusers/settings_panel')){
			}else{
				$this->status = 'W';
			}
		}
        if($this->isNewRecord and Yii::app()->isAppName('frontend')){
            
            if($this->user_type=='U'){
				$this->status = 'A';
			}
			else{
				$this->status = 'W';
			}
            $this->status = 'A';
            /*
			switch($this->user_type){
				 
				
				case 'A':
				$this->status = Yii::app()->options->get('system.common.agent_admin_status','W');
				break;
				case 'D':
				$this->status = Yii::app()->options->get('system.common.agent_admin_status','W');
				break;
				case 'U':
				$this->status = Yii::app()->options->get('system.common.customer_default_status','W');
				break;
				default:
				$this->status ='W';
				break;
				
			}
			* * */
		}
        
         if($this->scenario == 'updateEmail'){
			$this->email_verified = '0' ;
		}
        
        $this->getUpdateTag();
        if (!empty($this->con_password)) {
			 
            $this->password = Yii::app()->passwordHasher->hash($this->con_password);
        }
        return true;
    }
    public function getUpdateTag(){
		$array = array('company_name','address','description','first_name');
		 
		 foreach($array as $field){
				$arbic_field = $field.'_ar';
				if(empty($this->$field)){ continue; }
				if(!empty($this->$arbic_field)){ continue; }
				$message = $this->getTranslateCurl($field);
				if(!empty($message)){
					$this->$arbic_field= $message;
				}
				  
				 
		 }
    }
    public function getTranslateCurl($field){
			$handle = curl_init();

			if (FALSE === $handle)
			throw new Exception('failed to initialize');

			curl_setopt($handle, CURLOPT_URL,'https://www.googleapis.com/language/translate/v2');
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
			 $source = 'en';$target = 'ar';  
			curl_setopt($handle, CURLOPT_POSTFIELDS, array('key'=> 'AIzaSyAY0-OgH2OLDs25xXI_Ei8hP4sTje0Wva4', 'format'=>'text','q' => $this->$field, 'source' => $source , 'target' => $target));
			curl_setopt($handle,CURLOPT_HTTPHEADER,array('X-HTTP-Method-Override: GET'));
			$response = curl_exec($handle);

			$data = json_decode($response,true); 
			if(isset($data['data']['translations']['0']['translatedText'])){
				return   $data['data']['translations']['0']['translatedText']; 
			}

	 }
    public function afterSave(){
			parent::afterSave();
			if(in_array($this->scenario,array('update_profile','update_profile_agent','new_front_insert','new_update','agent_insert','developer_insert','developer_update','agent_update','developer_update1','agent_update1','new_update1','new_update2'))){
				if(!$this->isNewRecord){
					ListingUserMoreCountry::model()->deleteAllByAttributes(array('user_id'=>$this->primaryKey));
					ListingUserMoreState::model()->deleteAllByAttributes(array('user_id'=>$this->primaryKey));
					UserLanguages::model()->deleteAllByAttributes(array('user_id'=>$this->primaryKey));
					ListingUserCategory::model()->deleteAllByAttributes(array('user_id'=>$this->primaryKey));
					ListingUserSection::model()->deleteAllByAttributes(array('user_id'=>$this->primaryKey));
				}
				$cn_model = new ListingUserMoreCountry();
				if(!empty($this->mul_country_id)){
				foreach($this->mul_country_id as $couuntry){
					$cn_model_new = clone $cn_model;
					$cn_model_new->user_id = $this->primaryKey;
					$cn_model_new->country_id = $couuntry;
					$cn_model_new->save();
					
				}
				}
		 
				$cn_model = new ListingUserMoreState();
				if(!empty($this->mul_state_id)){
				foreach($this->mul_state_id as $city){
					$cn_model_new = clone $cn_model;
					$cn_model_new->user_id = $this->primaryKey;
					$cn_model_new->state_id = $city;
					$cn_model_new->save();
					
				}
				}
				$cn_model = new UserLanguages();
				if(!empty($this->languages_known)){
				foreach($this->languages_known as $language_id){
					$cn_model_new = clone $cn_model;
					$cn_model_new->user_id = $this->primaryKey;
					$cn_model_new->language_id = $language_id;
					$cn_model_new->save();
					
				}
				}
				$cn_model = new ListingUserSection();
				if(!empty($this->service_offerng)){
					foreach($this->service_offerng as $section_id){
						$cn_model_new = clone $cn_model;
						$cn_model_new->user_id = $this->primaryKey;
						$cn_model_new->section_id = $section_id;
						$cn_model_new->save();
						
					}
				}
			
				$cn_model = new ListingUserCategory();
					if(!empty($this->service_offerng_detail)){
					foreach($this->service_offerng_detail as $category_id){
					$cn_model_new = clone $cn_model;
					$cn_model_new->user_id = $this->primaryKey;
					$cn_model_new->category_id = $category_id;
					$cn_model_new->save();
					}
				}
			}
			if($this->isNewRecord and  Yii::app()->apps->isAppName('frontend')){
			 
			    if($this->email_verified !='1' and $this->scenario != 'new_update2' ){
			    	$this->sendVerificationEmail();
				}
				else{
				     //$this->WelcomeEmail;
					 //Yii::app()->notify->addSuccess(Yii::t('app', Yii::app()->options->get('system.messages._message_after_register_if_confirmed','Successfully registered your account.')));
				}
			 
			}
			if($this->isNewRecord and $this->filled_info != '1'    and  Yii::app()->apps->isAppName('backend')){
				ListingUsers::model()->updateByPk($this->user_id,array('filled_info'=>'1'));
			}
			if($this->filled_info != '1' and in_array($this->scenario,array('developer_update1','agent_update1') ) and  Yii::app()->apps->isAppName('frontend')){
				ListingUsers::model()->updateByPk($this->user_id,array('filled_info'=>'1'));
	
			}
			if($this->scenario == 'updateEmail'){
					$this->sendVerificationEmail();
			}
	 
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BookingUsers the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function listData()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition= "t.status='A'";
		//  $criteria->select= "t.*,concat(t.first_name,t.last_name) as name";
		 return $this->findAll($criteria);
	}
	public function getStatusWithStats($sta=null)
	{
		$ar = $this->activeArray();
		return (isset($ar[$sta]))?$ar[$sta]:"Inactive";
	}
	public function getStatusTitle()
	{
		$ar = $this->activeArray();
		return (isset($ar[$this->status]))?$ar[$this->status]:"Unknown";
	}
	
	public function getStatusTitleU()
	{
		$ar = $this->user_status();
		return (isset($ar[$this->user_status]))?$ar[$this->user_status]:"Unknown";
	}
      public function activeArray()
    {
		$arr = $this->getStatusArray();
		return $arr;
	}
	public function dayOfMonth()
	{
		for($i=1;$i<=31;$i++)
		{
			$day[$i] = str_pad($i,2,0,STR_PAD_LEFT);
		}
		return $day;
	}
	public function findByEmail($email)
	{
		 $criteria=new CDbCriteria;
		 $criteria->condition= "t.email=:email";
	     $criteria->params[':email']= $email;
		 return $this->find($criteria);
	}
		function is_image($path)
		{
		@$a = getimagesize($path);
		$image_type = $a[2];

		if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
		{
		return true;
		}
		return false;
		}
		public function featuredArray(){
			return array('N'=>'No','Y'=>'Yes');
		}
		
		  public function behaviors(){
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'company_name',
            'overwrite' => false
        ))
    );
   }
   	public function getUserall_languages(){
	    $criteria=new CDbCriteria;
	    $criteria->select = 't.language_id,lan.name as language_name';
	    $criteria->condition =' t.user_id = :user_id   ';
	    $criteria->join =' INNER JOIN {{language}} lan on lan.language_id = t.language_id ';
	      $criteria->params[':user_id'] = $this->user_id; 
	    $criteria->order =' name asc';
	    $languages= UserLanguages::model()->findAll($criteria);
	    $html = '';
	    if( $languages){
			foreach($languages as $k=>$v){
			$html .= $v->language_name.',' ; 
			}
		}
		if($html!=''){
			return rtrim($html,',');
		}
	}
	public $designation;
	public function getRentalUrl(){
		return Yii::App()->createUrl('properties/sec/property-for-rent/dealer/'.$this->slug);
	}
	public function getSaleUrl(){
		return Yii::App()->createUrl('properties/sec/property-for-sale/dealer/'.$this->slug);
	}
	public function findAgents($formData=array(),$count_future=false,$user_type='',$return=false){
		  
	    $criteria=new CDbCriteria;
		$criteria->select = 't.*,cn.country_name,st.state_name
		,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad LEFT JOIN {{listing_users}} adsr ON adsr.user_id = ad.user_id   where (t.user_id = ad.user_id or t.user_id = adsr.parent_user)  and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::SALE_ID.' ) as sale_total
		,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad LEFT JOIN {{listing_users}} adsr ON adsr.user_id = ad.user_id    where  (t.user_id = ad.user_id or t.user_id = adsr.parent_user)   and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::RENT_ID.' ) as rent_total
		';
 
        $criteria->compare('t.isTrash','0');
        $criteria->compare('t.status','A');
        $criteria->compare('t.log_not','0');
        $criteria->compare('t.user_type!','U');
        if(defined('COUNTRY_ID')){
			$criteria->compare('t.country_id', COUNTRY_ID);
		}
        $criteria->compare('t.user_type',$user_type);
        $criteria->compare('t.company_name',@$formData['company_name'],true);
          if(empty($user_type)){
        $criteria->addInCondition('t.user_type',array_keys($this->getUserType()));
		}
        $criteria->distinct =  't.id' ;
		
		$criteria->join  .= ' left join {{countries}} cn ON cn.country_id = t.country_id ';
		$criteria->join  .= ' left join {{states}} st ON st.state_id = t.state_id ';
	 
		    $criteria->join  .= ' left join {{services}} srv ON srv.service_id = t.designation_id ';
		     $criteria->select .= ' , srv.service_name as designation ';
		 
        $criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
        
          	 $criteria->join  .=   ' LEFT   JOIN {{listing_users}} puser1 on puser1.user_id = t.parent_user ';
		    	$criteria->select  .= ',CASE WHEN puser1.user_id IS NOT NULL THEN puser1.image ELSE t.image END as company_image ';
	
        
		if(isset($formData['agent_language']) and !empty($formData['agent_language'])){
			$criteria->join  .=   ' INNER JOIN {{user_languages}} lans on lans.user_id = t.user_id and lans.language_id=:lan_id ';
			$criteria->params[':lan_id'] = $formData['agent_language'];
		}
		if(isset($formData['enable_li']) and !empty($formData['enable_li'])){
				$criteria->compare('t.enable_l_f','1');
		}
		if(isset($formData['property']) and !empty($formData['property'])){
			$criteria->join  .= ' left  join {{place_an_ad}} ad ON ad.user_id = t.user_id and ad.isTrash="0" and ad.status="A"  and ( ad.ad_title  like :keyword or ad.ad_description like :keyword ) ';
			$criteria->params[':keyword'] = '%'.$formData['property'].'%';
			$criteria->condition .= ' and ( (CONCAT(t.first_name," ",t.last_name)  like :keyword OR t.company_name like :keyword ) OR ad.id IS NOT NULL )  ';
			 $criteria->group =  'ad.user_id' ;
		}
		$country_joined = false;
		if(isset($formData['country_id']) and !empty($formData['country_id'])){
			    $country_joined = true;
				$criteria->join  .=   ' INNER  JOIN {{listing_user_more_country}} usr_service on usr_service.user_id = t.user_id and usr_service.country_id = :county_of_service ';
				$criteria->params[':county_of_service'] = $formData['country_id'];
		}
		if(isset($formData['agent_regi']) and !empty($formData['agent_regi'])){
			
			$criteria->join  .=   ' LEFT  JOIN {{listing_user_more_state}} simple_checkeck_usr_service_state on simple_checkeck_usr_service_state.user_id = t.user_id';
			$criteria->join  .=   ' LEFT  JOIN {{listing_user_more_state}} usr_service_state on usr_service_state.user_id = t.user_id  and usr_service_state.state_id = :state_of_service ';
			$criteria->condition  .= ' and case when simple_checkeck_usr_service_state.user_id is   null then 1  when usr_service_state.user_id is not null then 1 else 0 end  ' ;
			$criteria->params[':state_of_service'] = $formData['agent_regi'];
		}
		if(empty($user_type)){
		$criteria->condition  .= ' and t.parent_user is null ' ; 
		}
		if(isset($formData['regn']) and !empty($formData['regn'])){
			
			$criteria->join  .=   ' INNER  JOIN {{listing_user_more_state}} simple_checkeck_usr_service_state on simple_checkeck_usr_service_state.user_id = t.user_id';
			$criteria->join  .=   ' INNER  JOIN {{states}} usr_service_state on usr_service_state.state_id = simple_checkeck_usr_service_state.state_id   and usr_service_state.slug = :regn ';
			$criteria->params[':regn'] = $formData['regn'];
		}
		$langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
	 
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelationst` on translationRelationst.state_id = st.state_id   LEFT  JOIN mw_translation_data tdatast ON (`translationRelationst`.translate_id=tdatast.translation_id and tdatast.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdatast.message   IS NOT NULL THEN tdatast.message ELSE st.state_name  END as  state_name  ';
				$criteria->distinct = 't.user_id'; 
		} 
		if(isset($formData['service_offerng_detail']) and !empty($formData['service_offerng_detail'])){
			
			$criteria->join  .=   ' INNER  JOIN {{listing_user_category}} ucat on ucat.user_id = t.user_id and  ucat.category_id = :service_offerng_detail';
			$criteria->params[':service_offerng_detail'] = $formData['service_offerng_detail'];
		}
		if(isset($formData['service_offerng']) and !empty($formData['service_offerng'])){
			
			$criteria->join  .=   ' INNER  JOIN {{listing_user_section}} usec on usec.user_id = t.user_id and  usec.section_id = :service_offerng';
			$criteria->params[':service_offerng'] = $formData['service_offerng'];
		}
		
		if(isset($formData['dkeyword']) and !empty($formData['dkeyword'])){
			$criteria->params[':dkeyword'] = '%'.$formData['dkeyword'].'%';
			$criteria->condition .= ' and ( (CONCAT(t.first_name," ",t.last_name)  like :dkeyword OR t.company_name like :dkeyword  OR t.company_name_ar like :dkeyword OR t.full_number like :dkeyword OR t.mobile like :dkeyword OR t.description like :dkeyword )   )  ';
			 
		}
		if(isset($formData['mkeyword']) and !empty($formData['mkeyword'])){
			$criteria->params[':mkeyword'] = '%'.$formData['mkeyword'].'%';
			$criteria->condition .= ' and ( (CONCAT(t.first_name," ",t.last_name)  like :mkeyword OR t.company_name like :mkeyword OR t.full_number like :mkeyword OR t.mobile like :mkeyword )   )  ';
			 
		}
 
		$criteria->distinct = 't.user_id';
		$order  = '    (sale_total+ rent_total)  desc  , t.featured="Y" desc,-t.priority desc , t.company_name asc  ';  
		if(isset($formData['order']) and !empty($formData['order'])){
			switch($formData['order']){
				case  'verified':
				$order  = '  t.is_verified="1"  desc  ,  (sale_total+ rent_total)  desc , t.company_name asc   ';
				break;
				case  'featured':
				$order  = '  t.featured="Y"  desc  ,  (sale_total+ rent_total)  desc , t.company_name asc   ';
				break;
				case  'alphabetically':
				$order  = '  t.company_name  asc  ';
				break;
			}
		
		}	
	    $criteria->order  =   $order; 		
	    if($return){ return $criteria; }
		$criteria->limit  = Yii::app()->request->getQuery('limit','10');
		$criteria->offset = Yii::app()->request->getQuery('offset','0');	 
		if(!empty($count_future)){
			$Result = self::model()->findAll($criteria);
			$criteria->offset = $criteria->limit+$criteria->offset   ;
			$criteria->select = 't.user_id'; $criteria->order ='';
			$criteria->limit = '1'; 
			$future_count = self::model()->find($criteria);
			return array('result'=>$Result,'future_count'=>$future_count );
		}
		else{
			return  self::model()->findAll($criteria)  ; 
		 
		}
	 
	}
		public function getDetailUrl(){
		return Yii::app()->createUrl('detail/index',array('slug'=>$this->ad_slug)); 
	}
	 	 
	public function getIsFeatured(){
		if($this->featured=='Y'){ return '<i class="glyphicon glyphicon-star" title="Featured"></i>'; }
	}
	public $parent_company;
	public $parent_slug;
	public function getAgentDetailUrl(){
	    /*
	    if($this->user_type=='C'){
	     	return Yii::app()->createUrl('user_listing/detail2',array('slug'=>$this->slug));
	    }
	    */
	    
		return Yii::app()->createUrl('user_listing/detail',array('slug'=>$this->slug));
	}
	public function getAgentDetailUrl2(){
		return Yii::app()->createAbsoluteUrl('user_listing/detail',array('slug'=>$this->slug));
	}
	public function getDeveloperDetailUrl(){
		return Yii::app()->createUrl('user_listing_developers/detail',array('slug'=>$this->slug));
	}
	public function getDeveloperDetailUrl2(){
		return Yii::app()->createAbsoluteUrl('user_listing_developers/detail',array('slug'=>$this->slug));
	}
		public $rent_total;
	public $sale_total;
	 public $country_name;
	  public function sendVerificationEmail(){
			$emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid('rh576q825p4c0');
			 $emailTemplate_common = $this->commonTemplate()   ;
			$options     =   Yii::app()->options;
			$support_phone  =  $options->get('system.common.support_phone');
			$support_email  =  $options->get('system.common.support_email');
			$notify     = Yii::app()->notify;
			if(empty($emailTemplate)) { return true ; }
			else{
				  $subject =   Yii::t('app',$emailTemplate->subject,array('{x}'=> $this->verification_code));
				  $emailTemplate = $emailTemplate->content; 
				  $url = Yii::app()->createAbsoluteUrl('user/emailVerify', array('verify' => $this->verification_code)); 
				  $site_link = CHtml::link($options->get('system.common.project_name'),Yii::app()->createAbsoluteUrl('member/dashboard')); 
				  $emailTemplate = str_replace('[USER_NAME]' , $this->fullName, $emailTemplate);
				  $emailTemplate = str_replace('[ACCOUNT_LINK]' ,$site_link, $emailTemplate);
				  $emailTemplate = str_replace('VCODEV' , $this->verification_code, $emailTemplate);
				  $emailTemplate = str_replace('[VCODE]' , $this->verification_code, $emailTemplate);
				  $emailTemplate = Yii::t('app', $emailTemplate,array('HVERIFY_LINKH'=>$url));
				 // $emailTemplate_common = $options->get('system.email_templates.common');
				 // $emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
				 $status = 'S';
				  
				 $adminEmail = new Email();			 
				 $adminEmail->subject = $subject ;
				 $adminEmail->message =   Yii::t('app',$emailTemplate_common, array('[CONTENT]'=>$emailTemplate)); 
				 $receipeints = serialize(array($this->email));
				 $adminEmail->status = $status;
				 $adminEmail->receipeints = $receipeints;
				 $adminEmail->sent_on =   1;
				 $adminEmail->type =   'S';
				 $adminEmail->sent_on_utc =   new CDbExpression('NOW()');
				 $adminEmail->save(false); 
				 $adminEmail->getSend(false);
			}
			if(!$this->isNewRecord){
				//  	$notify->addSuccess(Yii::t('app', Yii::app()->options->get('system.messages._message_after_resent','Successfully Send Verification Email . Please Verify Your Account')));
		  
			}
			else{
			// $notify->addSuccess(Yii::t('app', Yii::app()->options->get('system.messages._meesage_after_register','Successfully Send Verification Email . Please Verify Your Account')));
			}
			return true; 
	}
	public function getWelcomeEmail(){
	            $options     =   Yii::app()->options;
				$emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid("db411p1rtg1c1");
				$emailTemplate_common = $this->commonTemplate()   ;
			    if($emailTemplate)
			    {
			        $subject =  $emailTemplate->subject ;
					 $emailTemplate = $emailTemplate->content;
				}
				else
				{
					    return true ;
				}
                
                $status = 'S';
                $emailTemplate = str_replace('[USER_NAME]' , $this->fullName, $emailTemplate);
               // $emailTemplate_common = $options->get('system.email_templates.common');
                //$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
                $adminEmail = new Email();			 
                $adminEmail->subject = $subject ;
                $adminEmail->message =  Yii::t('app',$emailTemplate_common, array('[CONTENT]'=>$emailTemplate)); 
                $receipeints = serialize(array($this->email));
                $adminEmail->status = $status;
                $adminEmail->receipeints = $receipeints;
                $adminEmail->sent_on =   1;
                $adminEmail->type =   'S';
                $adminEmail->sent_on_utc =   new CDbExpression('NOW()');
                $adminEmail->save(false); 
                $adminEmail->getSend(false);;
                return true;
	}
	public function resentverification(){
	 
		 
									$options = Yii::app()->options;
									$notify = Yii::app()->notify;
									$emailTemplate =  CustomerEmailTemplate::model()->findByName("Registration");
									$logo =  '<a href="'.Yii::app()->createAbsoluteUrl("site/index").'" alt="">><img src="'.OptionCommon::logoUrl().'" style="width:70px"  alt=""></a> ';
									$common_name = Yii::app()->options->get('system.common.site_name');
									$support_phone  =   Yii::app()->options->get('system.common.support_phone');
									$support_email  =  Yii::app()->options->get('system.common.support_email');
									if($emailTemplate)
									{
										 $emailTemplate = $emailTemplate->content;
									}
									else
									{
											$emailTemplate = $options->get('system.email_templates.common');
									}
									$emailBody = Yii::app()->controller->renderPartial('root.apps.frontend.views.user._verification_link' , array('model'=>$this), true);
									$emailTemplate = str_replace('[CONTENT]', $emailBody, $emailTemplate);
									//$logo =  '<a href="'.Yii::app()->createAbsoluteUrl("site/index").'" alt="'.Yii::app()->options->get('system.common.site_name').'"><img src="'.  OptionCommon::logoUrl() .'"   style="width:134px; " ></a> ';
									$login_path = Yii::app()->createAbsoluteUrl('user/signin');
									$account_path = Yii::app()->createAbsoluteUrl('user/my_profile');
									$emailTemplate = str_replace('{logo}',$logo, $emailTemplate);
									$emailTemplate = str_replace('{name}',$this->fullName, $emailTemplate);
									$emailTemplate = str_replace('{phone}',$support_phone, $emailTemplate);
									$emailTemplate = str_replace('{support}',$support_email, $emailTemplate);
									$emailTemplate = str_replace('{login-path}','<a href="'.$login_path.'" style="color:#1e7ec8;" target="_blank">Login</a>', $emailTemplate);
									$emailTemplate = str_replace('{my-account}','<a href="'.$account_path.'" style="color:#1e7ec8;" target="_blank">My Account</a>', $emailTemplate);
									
									 
									$params = array(
									'to'            =>  $this->email,
									'fromName'      =>  $common_name,
									'subject'       =>	'Please verify your account  .  Email Verification - '.$common_name,
									'body'          =>   $emailTemplate,
									 'mailerPlugins' => array(
									'logger'    => true,
									 ),
										   
									 );
									 $status = 'Q';
									$server = DeliveryServer::pickServer();
									if($server){
										if (!$server->sendEmail($params)){
				                                if(Yii::app()->isAppName('frontend')){
												$notify->addError(Yii::t('error','Temporary error while sending your email, please try again later or contact us!'));
				                                }
				 
										}
										else{
												 $status = 'S';
												 if(Yii::app()->isAppName('frontend')){
												 $notify->addSuccess(Yii::t('success','Success!!! Verification  Email is Send to your account.Don\'t forget to check your Spam/Junk folder.Please verify your email account. '));
												 }
											}
									}
									$adminEmail = new Email();
									 
									$adminEmail->subject = $this->fullName.' Resent Verification Email';
									$adminEmail->message = $emailTemplate;
									$receipeints = serialize(array($this->email));
									$adminEmail->status = $status;
									$adminEmail->receipeints = $receipeints;
									$adminEmail->sent_on =   1;
									$adminEmail->type =   'RESENT';
									$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
									$adminEmail->save(false); 
				
									return true; 
}
    public function getAvatarUrl($width = 50, $height = 50, $forceSize = false)
    {
        
						 
													 
			$fileName =$this->image;
			if(!empty($fileName))
			{
			$filename =  pathinfo($fileName, PATHINFO_FILENAME);;
			$ext	  =  pathinfo($fileName, PATHINFO_EXTENSION);
			}

			if (!empty($this->image)) {
			 
			          //	$image =   ENABLED_AWS_PATH .$fileName   ;
			        		$image = $this->singleImage;
			}
			else
			{
				 
				// $path =  strtolower(substr($this->fullName,0,'1')).'_p.jpg?q=1'.self::PROFILE_ID;
		            return  Yii::App()->apps->getBaseUrl('assets/img/useravenue.png');	 
						$image =  Yii::app()->apps->getBaseUrl("uploads/default/f1.png" )  ;
 					 

					 
					 
				 
			}									 
			if(empty($image)){return false; }	
			return $image;
			return ImageHelper::resize($image, $width, $height, $forceSize);
    }
    public function getTypeTile(){
		$ar = $this->getUserType();
		return isset($ar[$this->user_type]) ? $ar[$this->user_type] : 'Customers';
	}
	    public function getMemebrApproved(){
			$cl = 'bg-blue';
	        if($this->status=='W'){
				$cl = 'bg-yellow';
			}
			if($this->status=='I'){
				$cl = 'bg-gray';
			}
			return '<span class="label  '.$cl.'" onclick="previewthis(this,event)" href="'.Yii::app()->createUrl('listingusers/view',array('id'=>$this->user_id)).'">'.$this->StatusTitle.'</span>';
		 
	}
	public function getFillPersonalInformation(){
		 if(in_array($this->user_type,array('A','D'))){
			 return true ; 
		 }
		 return false ; 
	}
	  public function getImpersonateLink(){
		return ASKAAN_PATH."site/impersonate/id/".$this->user_id ;
	}  
	public function getUserAvatarUrl(){
		return Yii::app()->apps->getBaseUrl('uploads/resized/'.$this->image);
	}
	public function getDescriptionDetails()
    {
		if(defined('LANGUAGE')){
			 if(LANGUAGE=='en'){
				 if(!empty($this->description)){ return  $this->description;   }
			 }
			 if(LANGUAGE=='ar'){
				 if(!empty($this->description_ar)){  return $this->description_ar;    }
			 }
		 }
		 
        return  $this->description ;
    }
	public function getShortDescription($length = 100)
    {
        if(defined('LANGUAGE')){
			 if(LANGUAGE=='en'){
				 if(!empty($this->description)){  return StringHelper::truncateLength($this->description, (int)$length);  }
			 }
			 if(LANGUAGE=='ar'){
				 if(!empty($this->description_ar)){  return StringHelper::truncateLength($this->description_ar, (int)$length);   }
			 }
		 }
        return StringHelper::truncateLength($this->description, (int)$length);
    }
     public function getWebsiteTitle(){
		return Yii::t('s',$this->website,array('https://'=>'','http://'=>''));
	}
	 public function getCompanyName(){
	      if(defined('LANGUAGE')){
			 if(LANGUAGE=='en'){
				 if(!empty($this->company_name)){ return $this->company_name;  }
			 }
			 if(LANGUAGE=='ar'){
				 if(!empty($this->company_name_ar)){ return $this->company_name_ar;  }
			 }
		 }
	     if(!empty($this->company_name)){
	         return $this->company_name;
	     }
	     else{
	         return   $this->fullName;
	     } 
	}
	 public function getContactPhone(){
	     if(!empty($this->full_number)){ return $this->full_number;  }
	      return $this->phone;
	     
	}
		 public function getContactEmail(){
	     if(!empty($this->contact_email)){
	         return $this->contact_email;
	     }
	     else{
	         return   $this->email;
	     }
	     
	}
		 public function getContactPerson(){
	     if(!empty($this->contact_person)){
	         return $this->contact_person;
	     }
	      
	}
		public function getsmalDale(){
			return date('d-M-Y',strtotime($this->date_added));
		}
			public function generateImage($apps,$h=190,$w=285,$s_id=null,$bg=null){
	   $html = '';
	   
				$html .= '<div>';
					if(!empty($this->image)){ 
				$image =    $this->SingleImage ; 
					}else{
					    
					     $path =  strtolower(substr($this->fullName,0,'1')).'_p.jpg?q=1'.self::PROFILE_ID;
		            $image =   Yii::App()->apps->getBaseUrl('uploads/avatar/'.$path);
					    	 //	$image = ENABLED_AWS_PATH.'1207_1576747125.png';
					}
				$html .= '<img src="'.$image.'" alt="" class="user-m-i">';
				$html .='</div>';
		 
		return $html; 				 
   }
   	public function generateImageNew($apps,$h=190,$w=285,$s_id=null,$bg=null){
	   $html = '';
	   
				$html .= '<div>';
					if(!empty($this->image)){ 
				$image =    $this->SingleImage ; 
					}else{
					    
					     $path =  strtolower(substr($this->fullName,0,'1')).'_p.jpg?q=1'.self::PROFILE_ID;
		            $image =   Yii::App()->apps->getBaseUrl('uploads/avatar/'.$path);
					    	 //	$image = ENABLED_AWS_PATH.'1207_1576747125.png';
					}
				$html .= '<img data-src="'.$image.'" alt="" class="user-m-i lozad">';
				$html .='</div>';
		 
		return $html; 				 
   }
   public function getCompanyImageHtml(){
                    	if(!empty($this->image)){ 
			 
							return  '<img src="'.$this->SingleImage.'" alt="" class="img-xs rounded-circle">';
					}
   }
   public function getCompanyImageHtml2(){
                    	if(!empty($this->company_image)){ 
			 
							return  '<img src="'.$this->SingleImage2.'" alt="" class="img-xs rounded-circle">';
					}
   }
   public function generateLogoImage($w=100,$h=100){
             $image = !empty($this->image) ? $this->image : $this->company_image; 
			if(!empty( $image)){ 
					return    $this->getSingleImage($w,$h) ; 
			}
	 			else{
	 			     $path =  strtolower(substr($this->fullName,0,'1')).'_p.jpg?q=1'.self::PROFILE_ID;
		            return  Yii::App()->apps->getBaseUrl('uploads/avatar/'.$path);
			 return ENABLED_AWS_PATH.'1207_1576747125.png';
			}
	 					 
   }
   public function getCompanyLogo(){
			if(!empty($this->image)){ 
					return   $this->SingleImage; 
			}
			else{
			     $path =  strtolower(substr($this->fullName,0,'1')).'_p.jpg?q=1'.self::PROFILE_ID;
		            return  Yii::App()->apps->getBaseUrl('uploads/avatar/'.$path);
			 return ENABLED_AWS_PATH.'1207_1576747125.png';
			}
	 				 
   }
   public function getTags(){
		$tagsList = $this->userTags;
		$html = '';
		if(!empty($tagsList)){
			foreach($tagsList as $v){
				$html .= '<span class="tag_short_'.$v->tag_id.'"></span>';
			}
		}
		return $html;
	}
		public function getMainImage(){
		return Yii::app()->apps->getBaseUrl('uploads/images/'.$this->image);
	}
	public function getServiceLocationDetails(){
		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->select = 'cn.country_name';
		$criteria->join = ' INNER  JOIN {{countries}} cn ON  cn.country_id = t.country_id ';
		$country_list = ListingUserMoreCountry::model()->findAll($criteria);
		$countries_title = '' ; 
		if($country_list){
		    foreach($country_list as $k=>$v){
			    $countries_title .= $v->country_name.',';
		    }
		}
		return rtrim($countries_title,',');
	}
	public $state_name;
	public function getServiceLocationStatesDetails(){
		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->select = 'st.state_name,st.slug as state_slug';
		$criteria->join = ' INNER  JOIN {{states}} st ON  st.state_id = t.state_id ';
		
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.state_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.state_id = t.state_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE st.state_name END  AS state_name ';
			}
			 
		
		return  ListingUserMoreState::model()->findAll($criteria);
		$countries_title = '' ; 
		if($country_list){
		    foreach($country_list as $k=>$v){
			    $countries_title .= $v->state_name.',';
		    }
		}
		return rtrim($countries_title,',');
	}
		public function getLanguageKnownDetails(){
		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->select = 'ln.name as language_name';
		$criteria->join = ' INNER  JOIN {{language}} ln  ON  ln.language_id = t.language_id ';
		
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.language_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.lang_id = t.language_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE ln.name END  AS language_name ';
			}
			 
		
		$country_list =   UserLanguages::model()->findAll($criteria);
		$countries_title = '' ; 
		if($country_list){
		    foreach($country_list as $k=>$v){
			    $countries_title .= $v->language_name.', ';
		    }
		}
		return rtrim($countries_title,', ');
	}
		public function getServiceOfferingDetails(){
		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->select = 't.section_id,st.section_name';
		$criteria->join = ' INNER  JOIN {{section}} st ON  st.section_id = t.section_id ';
		$country_list = ListingUserSection::model()->findAll($criteria);
		$countries_title = '' ; 
		if($country_list){
		    foreach($country_list as $k=>$v){
				 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
					 switch($v->section_id){
						 case '1':
						 $countries_title .= $this->mTag()->getTag('for_sale','For Sale').',';
						 break;
						 case '2':
						 $countries_title .= $this->mTag()->getTag('for_rent','For Rent').',';
						 break;
						 default :
						 $countries_title .= $v->section_name.',';
						 break;
					 }
				 }
				 else{
					$countries_title .= $v->section_name.',';
				}
		    }
		}
		return rtrim($countries_title,',');
	}
		public function getServiceOfferingDetails2(){
		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->select = 'st.section_name';
		$criteria->join = ' INNER  JOIN {{section}} st ON  st.section_id = t.section_id ';
		$country_list = ListingUserSection::model()->findAll($criteria);
		$countries_title = '' ; 
		if($country_list){
		    foreach($country_list as $k=>$v){
			    $countries_title .= '<li>'.$v->section_name.'</li>';
		    }
		}
		return  $countries_title ;
	}
		public function getServiceOfferingDetailsSection(){
		$criteria=new CDbCriteria;
		$criteria->compare('user_id',$this->user_id);
		return  (array) CHtml::listData(ListingUserSection::model()->findAll($criteria),'section_id','section_id');
		 
	}
		public function getCategoryOfferingDetails(){
		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->select = 'st.category_name';
		$criteria->join = ' INNER  JOIN {{category}} st ON  st.category_id = t.category_id ';
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE st.category_name END  AS category_name ';
			}
			
		$country_list = ListingUserCategory::model()->findAll($criteria);
		$countries_title = '' ; 
		if($country_list){
		    foreach($country_list as $k=>$v){
			    $countries_title .= $v->category_name.', ';
		    }
		}
		return rtrim($countries_title,', ');
	}
		public function getCategoryOfferingDetails2(){
		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->select = 'st.category_name';
		$criteria->join = ' INNER  JOIN {{category}} st ON  st.category_id = t.category_id ';
		$country_list = ListingUserCategory::model()->findAll($criteria);
		$countries_title = '' ; 
		if($country_list){
		    foreach($country_list as $k=>$v){
			    $countries_title .=  '<li>'.$v->category_name.'</li>';
		    }
		}
		return rtrim($countries_title,',');
	}
	public $total; 
		public function getCategoryOfferingDetailsCount($sec_id=1){
		$criteria=new CDbCriteria;
		$criteria->compare('t.user_id',$this->user_id);
		$criteria->select = 'st.category_name';
		$criteria->select .= ',(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where t.user_id = ad.user_id and ad.status="A" and ad.isTrash="0" and ad.section_id='.$sec_id.' and  ad.category_id=t.category_id ) as total';
		
		$criteria->join = ' INNER  JOIN {{category}} st ON  st.category_id = t.category_id ';
		return ListingUserCategory::model()->findAll($criteria); 
	}
	public function getUserAvatarUrlAbsolute(){
		return Yii::app()->apps->getBaseUrl('uploads/resized/'.$this->image,true);
	}
	public function getcanLogin(){
		return  $this->log_not == '1' ?  false  :  true  ; 
	}
		  public function validateRecaptcha($attribute,$params){
		
		  if(!Yii::app()->request->isAjaxRequest and Yii::app()->isAppName('frontend') and !empty($this->need_captcha_validation)){
 
	 
			$captcha= '';
			if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
			}

			if(!$captcha){
				$this->addError($attribute, 'Please check the   captcha form.' );
			}
		 
				 
			$data = array(
			'secret' => Yii::app()->options->get('system.common.re_captcha_secret','6Ldsl2IaAAAAAO_jFA_V7ldxyoDUnZLeIvNZ8owG'),
			'response' => $captcha,
			'remoteip' => $_SERVER['REMOTE_ADDR']
			);

			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$res = curl_exec($verify);

			$captcha = json_decode($res);
			
		 
				if ($captcha->success) {
						 
				 }
				 else{
					 $this->addError($attribute,  'Spam Suspect.Please try again.' );
				 }
				
 
		 
		  }
		   
	}
	public function search_company_approved_cron(){
		 $criteria=new CDbCriteria;
		 $criteria->compare('t.isTrash','0');
		 $criteria->compare('t.log_not','0');
		  $criteria->compare('t.email_verified','1');
		  $criteria->compare('t.status','A');
		  $criteria->compare('t.a_notify','0');
		  $criteria->compare('t.user_type!','U');
		  return $criteria ; 
	}
	public function search_company_rejected_cron(){
		 $criteria=new CDbCriteria;
		 $criteria->compare('t.isTrash','0');
		  $criteria->compare('t.status','R');
		  $criteria->compare('t.email_verified','1');
		  $criteria->compare('t.log_not','0');
		  $criteria->compare('t.r_notify','0');
		  $criteria->compare('t.user_type!','U');
		  return $criteria ; 
	}
	 public function getAcceptUrl(){
			return ASKAAN_PATH_BASE_B.'/dashboard/change_status_email/status/A/id/'.$this->user_id  ;
	}
	public function getRejectUrl(){
		return ASKAAN_PATH_BASE_B.'/dashboard/change_status_email/status/R/id/'.$this->user_id  ;
	}
	public function getDetails_items(){
			$list =  $this->ServiceLocationStatesDetails; $html = ''; 
			foreach($list  as $k2){
			$html .=  $k2->state_name.','; 
			}
			if($html != '') { $html  =  rtrim($html,','); } 
 
			return array(
			'user_type' => $this->TypeTile,
			'email' => $this->CheckEmailVerified,
			'phone' => $this->phone,
			'first_name' => $this->first_name,
			'country_id' =>  !empty($this->country_id)? $this->countries->country_name : '' ,
			'state_id' =>  !empty($this->state_id)? $this->states->state_name : '' ,
			'company_name' =>  $this->company_name,  
			'service_locations' =>  $html ,
			'services_offering' =>  $this->getServiceOfferingDetails() ,
			'dealing_categories' =>  $this->getCategoryOfferingDetails() ,
			'description' =>  $this->description  ,

			);
	}
	public function search_company_waiting_cron(){
		 $criteria=new CDbCriteria;
		 $criteria->compare('t.isTrash','0');
		  $criteria->compare('t.status','W');
		  $criteria->compare('t.log_not','0');
		  $criteria->compare('t.w_notify','0');
		   $criteria->compare('t.user_type!','U');
		  return $criteria ; 
	}
	public function getCheckEmailVerified(){
		$html = $this->email;
		if($this->email_verified=='1'){
		      $html .='<i class="fa fa-check text-green"></i>'; 
	     }
	     else{
	           $html .='<i class="fa fa-ban text-red"></i>'; 
	     }
	       return $html;
	}
	public function getCheckMobileVerified(){
		$html = $this->phone;
		if($this->o_verified=='1'){
		      $html .='<i class="fa fa-check text-green"></i>'; 
	     }
	     else{
	           $html .='<i class="fa fa-ban text-red"></i>'; 
	     }
	       return $html;
	}
	public function verification_process(){
	      if($this->email_verified=='0' and $this->e_skipped=='0'){
	          if(empty($this->o_verified)){
	          Yii::app()->controller->redirect(Yii::app()->createUrl('user/EmailVerification'));
	          }
	       }
	       if($this->o_verified=='0' and $this->o_skipped=='0'){
			  
			//	Yii::app()->controller->redirect(Yii::app()->createUrl('user/otp_verify'));
			  
	       }
	       /*
	   if($this->user_type != 'U'){
	    
	       if($this->u_p=='0'){
	          Yii::app()->controller->redirect(Yii::app()->createUrl('user/update_profile'));
	       }
	   }
	   */
	}
		public function getSendOtpLogin(){
               $attemt = Yii::app()->options->get('system.common.try','2');
				$attemt_last_hrs1 = Yii::app()->options->get('system.common.last_hours','24');
				$attemt_last_hrs = $attemt_last_hrs1*60; 
				if(((int)$this->hours_different >  $attemt_last_hrs)  ){
						ListingUsers::model()->updateByPk($this->user_id,array('login_attempt'=> '1'));
				}
				else{
						ListingUsers::model()->updateByPk($this->user_id,array('login_attempt'=> (int)$this->login_attempt+1));
				}
                $mobile = Yii::t('app',$this->full_number,array(' '=>''));///Recepient Mobile Number
                $message = Yii::t('app','{otp} is your ArabAvenue login  code',array('{otp}'=>$this->otp));
                if(strpos($mobile, '+') !== false){  }else{  $mobile = '+'. $mobile;  }
			     
                if (strpos($mobile, '+92') !== false) {
                    /* if Pakistan use send PK */
                 $username =  Yii::app()->options->get('system.common.sendpk_username','');///Your Username
                $password = Yii::app()->options->get('system.common.sendpk_password','');///Your Password
                $sender = Yii::app()->options->get('system.common.sendpk_sender','');;
               
                ////sending sms
                $post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
                $url = "https://sendpk.com/api/sms.php?username=$username&password=$password";
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $result = curl_exec($ch); 
                /*Print Responce*/
                return $result; 
                }
                else{
                    require Yii::getPathOfAlias('common'). '/extensions/twi/Services/Twilio.php';
                	$sid = Yii::app()->options->get('system.common.twilio_sid',''); 
                	$token = Yii::app()->options->get('system.common.twilio_token',''); 
	                $phone =  Yii::app()->options->get('system.common.twilio_phone',''); 
	                $client = new Services_Twilio($sid, $token);
                	$message2 = $client->account->sms_messages->create(
                    	$phone, // From a valid Twilio number
	                    $mobile, // Text this number
	                    $message
                	);
                // 	return $message2;
 
                }
                
	}
	public function getSendOtp(){
                $attemt = Yii::app()->options->get('system.common.try','2');
                $attemt_last_hrs1 = Yii::app()->options->get('system.common.last_hours','24');
                $attemt_last_hrs = $attemt_last_hrs1*60; 
                if(((int)$this->hours_different >  $attemt_last_hrs)  ){
                ListingUsers::model()->updateByPk($this->user_id,array('otp_attempt'=> '1'));
                }
                else{
                ListingUsers::model()->updateByPk($this->user_id,array('otp_attempt'=> (int)$this->otp_attempt+1));
                }
                $mobile = Yii::t('app',$this->full_number,array(' '=>''));///Recepient Mobile Number
                $message = Yii::t('app','{otp} is your ArabAvenue verification code',array('{otp}'=>$this->otp));
                if(strpos($mobile, '+') !== false){  }else{  $mobile = '+'. $mobile;  }
                if (strpos($mobile, '+92') !== false) {
                $username = Yii::app()->options->get('system.common.sendpk_username','');///Your Username
                $password = Yii::app()->options->get('system.common.sendpk_password',''); ///Your Password
                $sender =  Yii::app()->options->get('system.common.sendpk_sender',''); ;
                ////sending sms
                
                $post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
                $url = "https://sendpk.com/api/sms.php?username=$username&password=$password";
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $result = curl_exec($ch); 
                /*Print Responce*/
                return $result; 
                }
                else{
                    require Yii::getPathOfAlias('common'). '/extensions/twi/Services/Twilio.php';
                	$sid = Yii::app()->options->get('system.common.twilio_sid',''); 
                	$token = Yii::app()->options->get('system.common.twilio_token',''); 
	                $phone =  Yii::app()->options->get('system.common.twilio_phone',''); 
	                $client = new Services_Twilio($sid, $token);
                	$message2 = $client->account->sms_messages->create(
                    	$phone, // From a valid Twilio number
	                    $mobile, // Text this number
	                    $message
                	);
                }
                
	}
	const BULK_ACTION_TRASH = 'trash';
    const BULK_ACTION_DELETE = 'delete';
    const BULK_ACTION_RESTORE = 'restore';
    const BULK_ACTION_FEATURED = 'make-featured';
    const BULK_ACTION_UNFEATURED = 'make-un-featured';
	public function getBulkActionsList()
    {
				$ar =   
				array(
							self::BULK_ACTION_DELETE         => Yii::t('app', 'Delete Permanently '),
							 
				);
				if(Yii::app()->controller->action->id=='trash'){
					$ar[self::BULK_ACTION_RESTORE] =  Yii::t('app', 'Restore');
				}
				else{
					$ar[self::BULK_ACTION_TRASH] =  Yii::t('app', 'Move To Trash');
				}
				$ar[self::BULK_ACTION_FEATURED] =  Yii::t('app', 'Make Featured');
				$ar[self::BULK_ACTION_UNFEATURED] =  Yii::t('app', 'Make UnFeatured');
				return $ar; 
			 
				 
    }
    public function getSingleImage($width=100,$height=100){
        $image = !empty($this->image) ? $this->image : $this->company_image; 
        if(!empty($image)){ 
		   if (strpos(	$image , '/20') !== false) {
					
					return   Yii::app()->easyImage->thumbSrcOf(
		Yii::getpathOfAlias('root')  .'/uploads/files/'.$image,		 
		array(
                'resize' => array('width' => $width, 'height' =>$height,"master"=>EasyImage::RESIZE_AUTO),
              
               // 'scaleAndCrop' => array('width' => $width, 'height' => $height),
               // 'resize' => array('width' => $width, 'height' =>$height,"master"=>EasyImage::RESIZE_AUTO),															
                
                'sharpen' => 20,  'background' => '#E7ED67', 'type' => 'jpg',  'quality' => 90
		) 
		);
					 
						
						
					}else{
					return  ENABLED_AWS_PATH.$image ; 
					}
			}
			else{
				     $path =  strtolower(substr($this->fullName,0,'1')).'_p.jpg?q=1'.self::PROFILE_ID;
		            return  Yii::App()->apps->getBaseUrl('uploads/avatar/'.$path); 
			}
   }
    public function getSingleImage2($width=100,$height=100){
	   	if(!empty($this->company_image)){ 
		  	
					return   Yii::app()->easyImage->thumbSrcOf(
		Yii::getpathOfAlias('root')  .'/uploads/files/'.$this->company_image,		 
		array(
                'resize' => array('width' => $width, 'height' =>$height,"master"=>EasyImage::RESIZE_AUTO),
              
               // 'scaleAndCrop' => array('width' => $width, 'height' => $height),
               // 'resize' => array('width' => $width, 'height' =>$height,"master"=>EasyImage::RESIZE_AUTO),															
                
                'sharpen' => 20,  'background' => '#E7ED67', 'type' => 'jpg',  'quality' => 90
		) 
		);
	}
					  
   }
   public function home_featured_banners_cache(){
        $cacheKey = 'featureds'.Yii::App()->options->get('system.common.featured_key','123456');
        if(defined('COUNTRY_ID')){
			$cacheKey .= COUNTRY_ID;
		}
        if ($items = Yii::app()->cache->get($cacheKey)) {
           
		    return   $items ; 
        } 
        
       	$criteria =  ListingUsers::model()->findAgents(array(),false, '' ,1);
		$criteria->addInCondition('t.user_type', array ('C','D','A','M'));
		$criteria->compare('t.featured', 'Y');
		 if(defined('COUNTRY_ID')){
			$criteria->compare('t.country_id', COUNTRY_ID);
		}
		$criteria->limit = '100';
		$criteria->order = ' t.premium ="1"  desc , -t.priority desc , t.first_name asc  ';
		$items  = ListingUsers::model()->findAll($criteria);
		Yii::app()->cache->set($cacheKey, $items, 2592000);
        return $items; 
   }
   public function getCoverImageFile(){
         if (strpos(	$this->cover_image , '/20') !== false) {
    	      
    	            if(defined('DISABLE_WEBP')){
					    return Yii::app()->apps->getBaseUrl('uploads/files/'. $this->cover_image );
					}
					if(Yii::App()->isAppName('backend')){
					  return Yii::app()->apps->getBaseUrl('uploads/files/'.	$this->cover_image );
					}
					 $ref=new imageResize;
					  
					 $file_format='webp';	
					 $src =   'uploads/files/'.	$this->cover_image ;
					 $ref->resize($src,'uploads/mobile_images',1140,91,$file_format,FALSE);
					 
					 return Yii::app()->apps->getBaseUrl($ref->newfilename);;
					 
    	       
		 }
		 $path =  strtolower(substr($this->fullName,0,'1')).'_c.jpg?q=1'.self::PROFILE_ID;
		 return  Yii::App()->apps->getBaseUrl('uploads/avatar/'.$path); 
		
 	}
 	   public function findByPhoneLast10($phone){
			 $criteria=new CDbCriteria;
			 $last7 = substr($phone, -10);
			 if(strlen($last7)==10){
			 $criteria->compare('RIGHT(t.phone,10)', $last7);
			 return self::model()->find($criteria);
			 }
		 }
		  public function sendOtpEmail(){
		 	 
			$options     =   Yii::app()->options;
			$support_phone  =  $options->get('system.common.support_phone');
			$support_email  =  $options->get('system.common.support_email');
			$notify     = Yii::app()->notify;
		 
		 
				  $subject =   Yii::t('app','{x} is your ArabAvenue verification code',array('{x}'=> $this->verification_code));
				 
				  $emailTemplate = '<table border="0" cellpadding="0" cellspacing="0" width="600">
	<tbody>
		<tr>
			<td>
			<p style="font-weight:600;line-height:30px;font-size:30px;color:#34A853;">Arab Avenue</p>
			</td>
		</tr>
		<tr>
			<td>
			<p style="font-weight:600;line-height:30px;font-size:23px;">Confirm your email address , </p>
			</td>
		</tr>
		<tr>
			<td>
			<p>There&rsquo;s one quick step you need to complete before creating your ArabAvenue account. Let&rsquo;s make sure this is the right email address for you &mdash; please confirm this is the right address to use for your new account. .</p>
			<p>Please enter this verification code to get started on Feeta:</p>
			<p style="font-size:24px;">'.$this->verification_code.'</p>
			<p>Verification codes expire after two hours.<br />
			<br />
			<span style="font-size:18px;">Thanks,<br />
			Arab Avenue</span><br />
			&nbsp;</p>
			</td>
		</tr>
	</tbody>
</table>
';
				 // $emailTemplate_common = $options->get('system.email_templates.common');
				 // $emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
				 $status = 'S';
				  
				 $adminEmail = new Email();			 
				 $adminEmail->subject = $subject ;
				 $adminEmail->message = $emailTemplate;
				 $receipeints = serialize(array($this->email));
				 $adminEmail->status = $status;
				 $adminEmail->receipeints = $receipeints;
				 $adminEmail->sent_on =   1;
				 $adminEmail->type =   'S';
				 $adminEmail->sent_on_utc =   new CDbExpression('NOW()');
				 $adminEmail->save(false); 
				 $adminEmail->getSend(false);
			 
			return true; 
	}
	
	public function getSmallDate() { return date('M d,Y',strtotime($this->dateAdded));} 
     public function getfirst_nameD(){
         	 ;
		$strr = $this->first_name ;
		$strr .="<span style='display:block;color: #888;'>".$this->SmallDate."</span>" ;
		return $strr;
	}
    public function getTypeTileD(){
		$strr = $this->TypeTile ;
		$strr .="<span style='display:block;color: #888;'>".$this->SmallDate.$this->VerifiedTitlesPlan."</span>" ;
		return $strr;
	}
		public function getVerifiedTitles(){
		$html = '';
		$html .=  $this->featured=='Y' ? '<i  class="featuredUser" title="Featured"></i>':''; 
		$html .=  $this->is_verified=='1' ? ' <i  class="verifiedUser" title="Verified"></i>':''; 
		return $html; 
	}
		public function getVerifiedTitlesPlan(){
		$html = '';
		$html .=  $this->is_verified=='1' ? ' <i  class="verifiedUser" title="Verified"></i>':''; 
		$html .=  $this->active_plan=='1' ? '<i  class="activePlan" title="Active Plan"></i>':''; 
		
		return $html; 
	}
	public function getBackendUpdateURl(){
		return  Yii::app()->apps->getAppUrl('backend', 'index.php/listingusers/update/id/'.$this->user_id, true) ;
	}
  	  public function getBannerImage(){
	   	 	
					if(defined('DISABLE_WEBP')){
					    return Yii::app()->apps->getBaseUrl('uploads/files/'.	$this->banner_image );
					}
					if(Yii::App()->isAppName('backend')){
					  return Yii::app()->apps->getBaseUrl('uploads/files/'.	$this->banner_image );
					}
					 $ref=new imageResize;
					  
					 $file_format='webp';	
					 $src =   'uploads/files/'.	$this->banner_image ;
					 $ref->resize($src,'uploads/mobile_images',1920,91,$file_format,FALSE);
					 
					 return Yii::app()->apps->getBaseUrl($ref->newfilename);;
					 
   }
  	 public function getBannerImageMobile(){
	   	 	
					if(defined('DISABLE_WEBP')){
					    return Yii::app()->apps->getBaseUrl('uploads/files/'.	$this->banner_image_mobile );
					}
					if(Yii::App()->isAppName('backend')){
					  return Yii::app()->apps->getBaseUrl('uploads/files/'.	$this->banner_image_mobile );
					}
					 $ref=new imageResize;
					  
					 $file_format='webp';	
					 $src =   'uploads/files/'.	$this->banner_image_mobile ;
					 $ref->resize($src,'uploads/mobile_images',1920,91,$file_format,FALSE);
					 
					 return Yii::app()->apps->getBaseUrl($ref->newfilename);;
					 
   }
   
   public function getFilePath2($file){
       return Yii::app()->apps->getBaseUrl('uploads/images/'.$file );
				 
	}
	public function DeveloperData(){
		$criteria=new CDbCriteria;
		$criteria->select = 't.company_name,t.user_id';
		$criteria->compare('t.isTrash','0');
		$criteria->compare('t.status','A');
		$criteria->compare('t.user_type','D');
		$count = ListingUsers::model()->count($criteria);
		$criteria->order = 't.company_name asc'; 
		$criteria->limit   = 100 ;  
		return self::model()->findAll($criteria);
	}
	public function getAccountBalance(){
		return 'Rs.' . number_format((int) $this->amount,0,'.',',');
	}
		public function getvalidateUserListingPackage(){
			$model = PricePlanOrder::model()->userActiveListingPackage($this->user_id);
			//print_r($model->available_listings);exit; 
	 
			if($model){
				return $model->available_listings; 
			} 
			else {
				return false; 
			} 
		}
		public function getvalidateUserCurrentPackage($id=1){
		
		 $model = Package::model()->userActivePackage($id,$this->user_id);
		 if(!empty($model)){
			 switch($id){
				 case '1':
				 if($model->used_ad>=$model->ads_allowed){
					return array('redirect'=>'package_expired','message'=>'Package expired or exceeded ads limit. Please activate suitable packages');
				 }
				 break;
				 case '3':
				 
				 if($model->used_ad>=$model->ads_allowed){
					return array('redirect'=>'package_expired','message'=>'Featured limit exceeded or expired.');
				 }
				 else{ 
					 return array('success'=>'success','validity'=>$model->uap_validity,'id'=>$model->uap_id,'message'=>'Successfully set as featured.');
				 }
				 break;
				  case '4':
				 
				 if($model->used_ad>=$model->ads_allowed){
					return array('redirect'=>'package_expired','message'=>'Featured limit exceeded or expired.');
				 }
				 else{ 
					 return array('success'=>'success','validity'=>$model->uap_validity,'id'=>$model->uap_id,'message'=>'Successfully refreshed.');
				 }
				 break;
			 }
		 } 
		 else{
			 switch($id){
					 case '1':
					 $model =  Package::model()->defaultPakcage();
					 $max_can_post = 5; 
					 if(!empty($model)){
					       
						 $max_can_post = $model->max_listing_per_day;
					 }
					 $criteria=new CDbCriteria;
					 $criteria->compare('t.user_id',(int)Yii::app()->user->getId());
					 
					$count = PlaceAnAd::model()->count($criteria);
					if($count>=$max_can_post){
						 return array('redirect'=>'package_expired','message'=>'Default package limit exceeded. Please activate suitable packages');
						
					} 
					break;
					case '3':
					return array('redirect'=>'no_active_package','message'=>'No Featured Package  Subscribed!');
					break;
						case '4':
					return array('redirect'=>'no_active_package','message'=>'No Refresh  Package  Subscribed!');
					break;
			}
		 
		 }
	}
	public function getAgentsCreated(){
		 return   ListingUsers::model()->countByAttributes(array('parent_user'=>(int) $this->user_id, 'isTrash'=>'0' ));
       
	}
	
	public function getListAgentPermission(){
		if(!in_array($this->user_type,array('D','C')) and empty($this->max_no_users)){
		 //  throw new CHttpException(404, Yii::t('app', 'Permission denied.'));
	     }
	}
	public function getListAgentPermission2(){
		if(!in_array($this->user_type,array('D','C')) and empty($this->max_no_users)){
			  return false; 
	     }
	     else{
			  return true; 
		 }
	}
		public $designation_id;
	public function getUserDesignation(){
		if(!empty($this->designation_id)) { return "Need to update"; }
	}
	
	const DESIGNATION_ID = '5';
	public function getValidateAgentsCreated(){
		$user = ListingUsers::model()->findByAttributes(array('user_id'=>(int) $this->user_id  ));
		if(empty($user)){ 
			throw new CHttpException(404, Yii::t('app', 'No Admin User Found.'));
		}
		$permitted = $user->max_no_users;
		if((int) $this->AgentsCreated >= $permitted ){
			 throw new CHttpException('Warning', Yii::t('app', $this->mTag()->getTag('listing_quota_exceeded','Listing Quota Exceeded.')));
		}
	 
       
	}
	
	public $active_total;
		public function getActivePropertys(){  
		 $criteria=new CDbCriteria;$criteria->condition  = '1';
		$criteria->select = '(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where  (CASE WHEN t.parent_user is NOT NULL THEN t.parent_user = ad.user_id  or t.user_id = ad.user_id  ELSE t.user_id = ad.user_id END ) and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::SALE_ID.' ) as sale_total
		,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where  (CASE WHEN t.parent_user is NOT NULL THEN t.parent_user = ad.user_id  or t.user_id = ad.user_id  ELSE t.user_id = ad.user_id END )  and ad.status="A" and ad.isTrash="0" and ad.section_id='.PlaceAnAd::RENT_ID.' ) as rent_total  
		,(select COALESCE(count(ad.id),0) from {{place_an_ad}} ad where  (CASE WHEN t.parent_user is NOT NULL THEN t.parent_user = ad.user_id  or t.user_id = ad.user_id  ELSE t.user_id = ad.user_id END )  and ad.status="A" and ad.isTrash="0"   ) as active_total ';
		  $criteria->distinct =  't.id' ;
		 	
		    $criteria->compare('t.user_id',(int)$this->user_id);
		 $totalResult =  ListingUsers::model()->find($criteria);
		
		 if(!empty( $totalResult)){
			return array('sale_total'=> $totalResult->sale_total,'rent_total'=> $totalResult->rent_total,'active_total'=> $totalResult->active_total); 
		 }
	}
	  public function detailFile($im,$w=100,$height=100)
   { 
	  $file_format = pathinfo($im, PATHINFO_EXTENSION); 
	 switch($file_format){
			 
			case 'pdf':
			$bgn = 'pdf.png';
			break;
			 
			default:
			$bgn = $im;
			break;
			
	 }     
	 	return   Yii::app()->easyImage->thumbSrcOf(
		Yii::getpathOfAlias('root')  .'/uploads/files/'.$bgn,		 
		array(
                'resize' => array('width' => $width, 'height' =>$height,"master"=>EasyImage::RESIZE_AUTO),
              
               // 'scaleAndCrop' => array('width' => $width, 'height' => $height),
               // 'resize' => array('width' => $width, 'height' =>$height,"master"=>EasyImage::RESIZE_AUTO),															
                
                'sharpen' => 20,  'background' => '#E7ED67', 'type' => 'jpg',  'quality' => 90
		) 
		);
			 
   }
   public function getFirstNameN(){
       if(defined('LANGUAGE') and LANGUAGE=='ar'){
              if(!empty($this->first_name_ar)){ return $this->first_name_ar;  }
			  
         }
        return $this->first_name.' '.$this->last_name ;
   }
     public function findRoles()
    {
         static $_roles;
        if ($_roles !== null) {
            return $_roles;
        }
		$_roles =  CHtml::listData(Master::model()->listData(ListingUsers::DESIGNATION_ID),'master_id','master_name');
		 
        return $_roles;
    }
    function getRoleTitle()
            {
                if(empty($this->parent_user)){ return $this->mTag()->gettag('agency_admin','Agency Admin'); }
                 $ar = $this->findRoles();
                return isset($ar[$this->role_id])  ?  $ar[$this->role_id] : '-'; 
            }
}