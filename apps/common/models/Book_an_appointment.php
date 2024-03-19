<?php

/**
 * This is the model class for table "mw_contact_us".
 *
 * The followings are the available columns in table 'mw_contact_us':
 * @property integer $id
 * @property integer $type
 * @property string $email
 * @property string $name
 * @property string $meassage
 * @property string $city
 * @property string $date
 */
class Book_an_appointment  extends ContactUs
{
	 public $image;
	 public $agree;
	 public $_recaptcha; 
 
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email,   phone_false,package_id', 'required',   'message'=>$this->mTag()->getTag('required','Required')),
            array('agree', 'required',  'message'=>$this->mTag()->getTag('please_select','Please select.') ),
            array('type,phone', 'numerical', 'integerOnly'=>true),
            array('email, name', 'length', 'max'=>150),
            array('city', 'length', 'max'=>250),
            array('phone', 'length', 'min'=>10),
             array('phone_false', 'validatePhone'),
              array('phone_false', 'length', 'min'=>9),
              array('phone_false', 'length', 'max'=>11),
            array('phone', 'length', 'max'=>14),
            array('_recaptcha', 'validateRecaptcha'   ),
            array('email', 'email','message'=>$this->mTag()->getTag('enter_a_valid_email_address.','Enter a valid email address.')),
            array('contact_type,w_talk,country_id,mobile_code_id,phone,requested_by', 'safe'),
            array('ip_address,user_id,ad_title,phone_false', 'safe'),
           // array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
           // array('verifyCode', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, email, name, meassage, city, date', 'safe', 'on'=>'search'),
             array('image', 'file', 'types'=>'pdf,doc,docx', 'allowEmpty'=>true,  'safe' => true),
        );
    }
 
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'ad_id' => 'AD',
            'type' => 'Position',
            'email' => $this->mTag()->getTag('email','Email'), 
            'name' => $this->mTag()->getTag('full_name','Full Name'),
           
            'meassage' => 'Message',
            'ad_title' => $this->mTag()->getTag('property','Property'),
            'country_id' => 'Country',
               'mobile_code_id' => 'Country Mobile Code',
            'city' => 'City',
            'date' => 'Date',
            'w_talk' => 'Date',
            'date' => $this->mTag()->gettag('date','Date'), 
            'phone_false' => $this->mTag()->gettag('phone','Phone'),  
            'phone' => $this->mTag()->gettag('phone','Phone'),  
            'package_id' => $this->mTag()->gettag('add-on_features','Add-on features'),  
              'date' => $this->mTag()->gettag('date_added','Date Added'),  
        );
    }
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        'ad' => array(self::BELONGS_TO, 'PlaceAnAd', 'ad_id'),
          'mobile_code' => array(self::BELONGS_TO, 'Countries', 'mobile_code_id'),
        'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
        );
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
     public $ad_slug;
     public function getAdTitle(){
		if(!empty($this->ad_id)){
		$ad =$this->ad ; 
		return '<a href="'.$ad->DetailUrlAbsolute.'" target="_blank">'.$ad->ad_title.'</a>';
		}
		else{
			return '-';
		}
	}
     public function getAdTitleDetails(){
		if(!empty($this->ad_id)){
		$modelCriteria  = PlaceAnAd::model()->findAds($formData=array(),$count_future=false,$returnCriteria=1,$calculate=false, false);
		$modelCriteria->condition .= '   and t.id = :thisadid '; 
		$modelCriteria->params[':thisadid']  = $this->ad_id; 
		$ad =  PlaceAnAd::model()->find($modelCriteria)  ;
		return '<div class="col-sm-12">'.$ad->ListingLi.'</div><div class="col-sm-12">'.$ad->ListingLiTitle.'</div>' ;
		}
		else{
			return '-';
		}
	}
	public $package_uid;
    public function search($return=false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->select = 't.*,pak.package_uid';
        $criteria->compare('id',$this->id);
        $criteria->compare('type',$this->type);
         $criteria->compare('ad_title',$this->ad_title,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('meassage',$this->meassage,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('requested_by',$this->requested_by);
       // $criteria->compare('usr2.user_id',$this->user_id );
        $criteria->compare('contact_type','B_AP');
            	$criteria->join .= 'INNER JOIN {{package}}  pak on pak.package_id  = t.package_id   ';
        $criteria->order="id desc";
        if(!empty($return)){ return $criteria; }
	 	return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
	   'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
		));
    }
      public function getIp(){
   		$client  = @$_SERVER['HTTP_CLIENT_IP'];

		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

		$remote  = @$_SERVER['REMOTE_ADDR'];

		$result  = array('country'=>'', 'city'=>'');

		if(filter_var($client, FILTER_VALIDATE_IP)){

		$ip = $client;

		}elseif(filter_var($forward, FILTER_VALIDATE_IP)){

		$ip = $forward;

		}else{

		$ip = $remote;

		}
		return $ip;
  }
    public function beforeSave(){
		
	   if(parent::beforeSave()) 
	   {
            if($this->isNewRecord){
              $this->ip_address      =  $this->getIp();
            }
            if($this->isNewRecord ){
				if(Yii::App()->user->getId()){
					$this->requested_by      =  (int) Yii::App()->user->getId();
				}
            }
             $this->phone = (!empty($this->phone)) ? $this->phone : $this->phone_false;
			 $this->contact_type= 'B_AP';
		 

			 return true;
	   }
	return false;
	 
	}
	public function validateRecaptcha($attribute,$params){
		
		  if( Yii::app()->isAppName('frontend') and !in_array(strtolower(Yii::app()->controller->action->id),array('book_an_appointment','validatevaluation_ask'))){
 
	 
			$captcha= '';
			if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
			}

			if(!$captcha){
				$this->addError($attribute, 'Please check the   captcha forms.' );
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
					 $this->addError($attribute,  'Spam suspect. Please try again.' );
				 }
				
 
		 
		  }
		   
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ContactUs the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
     public function getNameWithCountry(){
		if(!empty($this->country_id)){
			return $this->name.'('.$this->country->country_name.')';
		}
		else{
			return $this->name;
		}
	}
    public function getPhoneWithCountry(){
		if(!empty($this->mobile_code_id)){
			$codeing = $this->mobile_code->country_code;
			if(empty($codeing )){
				$codeing = $this->mobile_code->country_name;
			}
			return  '(+'.$codeing.')'.$this->phone;
		}
		else{
			return $this->phone;
		}
	}
	public $phone_false;
    public function afterSave(){ 
			 
	 return true;
       
     
	}
    public function getIpInfo(){
	    if(!empty($this->ip_address)){ return $this->ip_address;  }
 
	}
	
	public $section_name; 
	  public function findEnquiry($formData=array(),$count_future=false ,$returnCriteria =false){
		  
		$criteria=new CDbCriteria;
		$criteria->select = 't.*,ads.ad_title,ads.slug as ad_slug ,ads.section_id as ad_section, cn.cords, cn.country_name , sec.section_name'; 
        $criteria->compare('contact_type','B_AP');
        $criteria->join = ' INNER   JOIN {{place_an_ad}} ads on ads.id = t.ad_id and  ads.isTrash="0" ';
        $criteria->join .= ' LEFT    JOIN {{section}} sec on ads.section_id = sec.section_id  ';
        $criteria->join .= ' LEFT JOIN {{countries}} cn on cn.country_id = ads.country ';
        $criteria->join .= ' LEFT JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
   
        if(Yii::App()->isAppName('backend')){
				$criteria->condition .= ' and  t.ad_id IS NOT NULL  ';
		
		}
        if(!empty($this->user_id)){
			$criteria->condition .= ' and CASE WHEN t.ad_id IS NOT NULL THEN ads.user_id =:user_id ELSE t.user_id =:user_id END  ';
			$criteria->params[':user_id'] = $this->user_id ; 
		}
		$order  = 't.id   desc ';		   
	    $criteria->order  =   $order; 		
		$criteria->limit  = Yii::app()->request->getQuery('limit','10');
		$criteria->offset = Yii::app()->request->getQuery('offset','0');
		if($returnCriteria)	 { return  $criteria; }
		if(!empty($count_future)){
			$Result = self::model()->findAll($criteria);
			$criteria->offset = $criteria->limit+$criteria->offset   ;
			$criteria->select = 't.id'; 
			$criteria->limit = '1'; 
			$future_count = self::model()->find($criteria);
			return array('result'=>$Result,'future_count'=>$future_count );
		}
		else{
			return  self::model()->findAll($criteria)  ; 
		 
		}
	 
	}
	public $country_name;
	 public function getsectionTitle(){
		 
		 return $this->section_name;
	}
		public function getShortName($length = 40)
    {
        if(empty($this->meassage)){ return 'No details entered'; }
        return StringHelper::truncateLength($this->meassage, (int)$length);
    }
    public $ad_title;
 
     public function total_view()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
 
		$criteria->join = 'INNER JOIN {{place_an_ad}}  ad on ad.id = t.ad_id   ';
		$criteria->join .= 'INNER JOIN {{listing_users}}  usr on usr.user_id = ad.user_id   ';
			$criteria->condition  = '    usr.user_id = :me2   '; 
			$criteria->params[':me2'] =   (int) Yii::app()->user->getId() ; 
		 return  $this->count($criteria); 
		  
    }
     
    const BULK_ACTION_DELETE = 'delete';
 
	public function getBulkActionsList()
    {
				$ar =   
				array(
							self::BULK_ACTION_DELETE         => Yii::t('app', 'Delete Permanently '),
							 
				);
			 
				return $ar; 
			 
				 
    }
    
    
    public function getPackageDetail(){
 
		$package = Package::model()-> findByUidFrontend($this->package_uid);
		if(!empty($package)){
		 
			return $package->PackageDetails; 
		} 
 
	}
    public function getNameLink(){
		if(!empty($this->user_id)){
			return CHtml::link($this->name,Yii::app()->createUrl('listingusers/update',array('id'=>$this->user_id))); 
		}
	}
}
