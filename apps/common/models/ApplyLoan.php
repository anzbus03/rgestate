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
class ApplyLoan  extends ActiveRecord
{
	 public $image;
	 public $asked_type;
	 public $agree;
	 public $_recaptcha; 
 public function tableName()
    {
        return 'mw_loan_application';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email,  meassage,phone_false,bank_id,monthly_income', 'required',  'message'=>$this->mTag()->getTag('required','Required')),
            array('agree', 'required',  'message'=>$this->mTag()->getTag('please_select','Please select.') ),
            array('type,phone', 'numerical', 'integerOnly'=>true),
            array('email, name', 'length', 'max'=>150),
            array('city', 'length', 'max'=>250),
            array('phone', 'length', 'min'=>10),
             array('phone_false', 'validatePhone'),
              array('phone_false', 'length', 'min'=>9),
              array('phone_false', 'length', 'max'=>11),
            array('phone', 'length', 'max'=>14),
            array('monthly_income', 'length', 'max'=>50),
            array('email', 'email','message'=>$this->mTag()->getTag('enter_a_valid_email_address.','Enter a valid email address.')),
            array('country_id,phone,statusm', 'safe'),
            array('ip_address,ad_title,phone_false,down_payment,total_loan,loan_period,interest_rate,ad_id,asked_type,reference,user_id', 'safe'),
              array('_recaptcha', 'validateRecaptcha'   ),
           // array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
           // array('verifyCode', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, email, name, meassage, city, date', 'safe', 'on'=>'search'),
             array('image', 'file', 'types'=>'pdf,doc,docx', 'allowEmpty'=>true,  'safe' => true),
        );
    }
 public function validateRecaptcha($attribute,$params){
		
		  if( Yii::app()->isAppName('frontend') and !in_array(strtolower(Yii::app()->controller->action->id),array('validateappication','validateappication'))){
 
	 
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
					 $this->addError($attribute,  'Spam suspect. Please try again' );
				 }
				
 
		 
		  }
		   
	}
	public function afterSave(){
		 
		
		     $options = Yii::app()->options ; 
			 
            
		  $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("vf2394659w065");
		  $emailTemplate_admin =  CustomerEmailTemplate::model()->getTemplateByUid("on207vslld229");
		 $emailTemplate_common = $this->commonTemplate()   ;
		  if( $emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$this->name, $emailTemplate);
					    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message =  Yii::t('app',$emailTemplate_common, array( '[CONTENT]'=>$emailTemplate));
					$receipeints = serialize(array($this->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->getSend(false);;
				}
			  if($emailTemplate_admin){
					$subject		= $emailTemplate_admin->subject;
					$emailTemplate = $emailTemplate_admin->content;					 
					$emailTemplate =  Yii::t('app', $emailTemplate,
					array(
					'{name}' => $this->name,
					'{company_name}' => $this->bank->bank_name,
					'{reference}'=> $this->reference,
					'{email}' => $this->email,
					'{phone}' => $this->phone,
					'{income}' => $this->monthly_income,
					'{description}' => nl2br($this->meassage),
					'{backendurl}' => $this->BackendUrl,
					
					)
					
					);
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
					$adminEmail->getSend(false);;
				}
	 return true;
       
     
	}
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'ad_id' => 'AD',
            'type' => 'Position',
            'email' => 'Email',
            'name' => 'Name',
            'meassage' => 'Message',
            'country_id' => 'Country',
               'mobile_code_id' => 'Country Mobile Code',
            'city' => 'City',
            'date' => 'Date',
            'w_talk' => 'Date',
            'phone_false' =>'Phone',
              'asked_type' => 'Type',
               'company' => $this->mTag()->getTag('company','Company'),
               'property_detail' => $this->mTag()->getTag('property','Property'),
               'statusm' => $this->mTag()->getTag('status','Status'),
              'reference' => $this->mTag()->getTag('reference','Reference'),
               'date_added' => $this->mTag()->gettag('date','Date'), 
        );
    }
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        'ad' => array(self::BELONGS_TO, 'PlaceAnAd', 'ad_id'),
        //  'mobile_code' => array(self::BELONGS_TO, 'Countries', 'mobile_code_id'),
        'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
        'bank' => array(self::BELONGS_TO, 'Bank', 'bank_id'),
        'ad' => array(self::BELONGS_TO, 'PlaceAnAd', 'ad_id'),
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
	 public $statusm;
     public function status_array(){
		return array(
			'1'=>$this->mTag()->getTag('no_action','No Action'),
				'R'=>$this->mTag()->getTag('rejected','Rejected'),
				'A'=>$this->mTag()->getTag('accepted','Accepted') ,
				 
		);
	}
	 public function getstatusTitle(){
		$ar = $this->status_array();
		$this->statusm = empty($this->statusm) ? '1' : $this->statusm;
		return isset($ar[$this->statusm]) ? $ar[$this->statusm] : '';
	}
    public function search($return=false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->select = 't.*,ads.ad_title,ads.slug as ad_slug,(SELECT  status  FROM {{mortgage_followup}} folloup  WHERE  folloup.form_id = t.id and folloup.status in ("A","R")  order by folloup.id desc  LIMIT 1  )   as statusm';
		
        $criteria->condition = '1';
        $criteria->compare('id',$this->id);
         $criteria->compare('reference',$this->reference,true);
        $criteria->compare('type',$this->type);
         $criteria->compare('ad_title',$this->ad_title,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('t.user_id',$this->user_id);
        $criteria->compare('meassage',$this->meassage,true);
        $criteria->compare('city',$this->city,true);
        if($this->asked_type == '1'){
			$criteria->condition .= ' and t.ad_id is not null';
		}
        if($this->asked_type == '2'){
			$criteria->condition .= ' and t.ad_id is   null';
		}
		
		if(!empty($this->statusm)){
			$status = $this->statusm=='1' ? '' : $this->statusm; 
			$criteria->compare('(SELECT  status  FROM {{mortgage_followup}} folloup  WHERE  folloup.form_id = t.id and folloup.status in ("A","R")  order by folloup.id desc  LIMIT 1  ) ',$status);
		}
		if(AccessHelper::hasRouteAccess ('loan_application/index') and !AccessHelper::hasRouteAccess ('loan_application/all_company_application')){
			 $bank_id = Yii::app()->user->getModel()->bank_id;
			 $criteria->compare('t.bank_id',(int) $bank_id);
		}
        //$criteria->compare('date',$this->date,true);
       // $criteria->compare('usr2.user_id',$this->user_id );
             
         $criteria->join = ' LEFT   JOIN {{place_an_ad}} ads on ads.id = t.ad_id and  ads.isTrash="0" ';
           
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
              if(defined('COUNTRY_ID')){
				$this->country_id      =  COUNTRY_ID;
			  }
            }
             if($this->isNewRecord){
				//$this->user_id = (int) Yii::app()->user->getId();
			}
             $this->phone = (!empty($this->phone)) ? $this->phone : $this->phone_false;
			  if(empty($this->reference)) {
				$this->reference = $this->generateUid();
			 }

			 return true;
	   }
	return false;
	 
	}
	public function getaskTitle(){
		if(!empty($this->ad_id)){
			return 'Property';
		}
		return 'General';
	}
	public function findByUid($order_uid)
    {
        return $this->findByAttributes(array(
            'reference' => $order_uid,
        ));    
    }
	public function generateUid()
    {
        //$unique = date('ydm-His');
        $unique  =  date('dmyHi').rand(1,9);
        $exists = $this->findByUid($unique);
        
        if (!empty($exists)) {
            return $this->generateUid();
        }
        
        return $unique;
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
    
    public function getIpInfo(){
	    if(!empty($this->ip_address)){ return $this->ip_address;  }
 
	}
	
	public $section_name; 
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
 
 
     
    const BULK_ACTION_DELETE = 'delete';
 
	public function getBulkActionsList()
    {
				$ar =   
				array(
							self::BULK_ACTION_DELETE         => Yii::t('app', 'Delete Permanently '),
							 
				);
			 
				return $ar; 
			 
				 
    }
     public function getBackendUrl(){
		return ASKAAN_PATH_BASE.'backend/index.php/loan_application/view?id='.$this->primaryKey;
	}
	
	public function getMortgageDetails(){
		 $html = ''; 
		 $country = $this->country;   
		 $currency = $country->currency;
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('monthly_income').' :</span><span class="pricecls" >'.$this->monthly_income.$currency->code.'</span></h1>';
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('total_loan').' :</span><span class="pricecls" >'.$this->total_loan.$currency->code.'</span></h1>';
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('loan_period').' :</span><span class="pricecls" >'.$this->loan_period.' yrs</span></h1>';
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('interest_rate').' :</span><span class="pricecls" >'.$this->interest_rate.' yrs</span></h1>';
 	
		if(!empty($this->ad_id)){
				$modelCriteria  = PlaceAnAd::model()->findAds($formData=array(),$count_future=false,$returnCriteria=1,$calculate=false, false);
				$modelCriteria->condition .= '   and t.id = :thisadid '; 
				$modelCriteria->params[':thisadid']  = $this->ad_id; 
				$ad =  PlaceAnAd::model()->find($modelCriteria)  ;
				$html  .= '<div class=" ">'.$ad->ListingLi.'</div><div class=" ">'.$ad->ListingLiTitle.'</div>' ;

		}
		return $html ; 
 	}
}
