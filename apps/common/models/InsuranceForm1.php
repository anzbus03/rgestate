<?php

/**
 * This is the model class for table "{{insurance_form}}".
 *
 * The followings are the available columns in table '{{insurance_form}}':
 * @property integer $id
 * @property string $sal
 * @property string $f_name
 * @property string $m_name
 * @property string $last_name
 * @property string $m_status
 * @property integer $nationlity
 * @property string $dob
 * @property string $occupation
 * @property string $p_o
 * @property string $employer
 * @property string $phone
 * @property string $land
 * @property integer $city
 * @property string $email
 * @property string $address
 * @property string $date_added
 * @property string $last_updated
 */
class InsuranceForm1 extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{insurance_form}}';
    }
	public $asked_type;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('f_name,property_type,address,v_of_personal,o_status,c_required,v_of_content,email,phone_false,bank_id', 'required',   'message'=>$this->mTag()->getTag('required','Required'),'on'=>'insert'),
            array('f_name,email,phone_false,bank_id,property_id', 'required',   'message'=>$this->mTag()->getTag('required','Required'),'on'=>'ask_insurance'),
            array('nationlity, city', 'numerical', 'integerOnly'=>true),
            array('sal, m_status', 'length', 'max'=>1),
               array('agree', 'required',  'message'=>$this->mTag()->getTag('please_select','Please select.') ),
            array('f_name, m_name, last_name, occupation', 'length', 'max'=>100),
            array('email', 'email','message'=>$this->mTag()->getTag('enter_a_valid_email_address.','Enter a valid email address.')),
            array('phone_false', 'validatePhone'),
            array('p_o', 'length', 'max'=>10),
            array('employer', 'length', 'max'=>200),
            array('location_longitude,location_latitude,property_type,o_status,c_required,v_of_content,v_of_personal,country_id,bank_id,reference,asked_type', 'safe'),
            array('_recaptcha', 'validateRecaptcha'   ),
            array('phone, land', 'length', 'max'=>15),
            array('email', 'length', 'max'=>150),
            array('address', 'length', 'max'=>250),
            array('dob,statusm,user_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, sal, f_name, m_name, last_name, m_status, nationlity,status, dob, occupation, p_o, employer, phone, land, city, email, address, date_added, last_updated,asked_type', 'safe', 'on'=>'search'),
        );
    }
     public function beforeSave(){
		
	   if(parent::beforeSave()) 
	   {
            if($this->isNewRecord){
              if(defined('COUNTRY_ID')){
				$this->country_id      =  COUNTRY_ID;
			  }
            }
             if($this->isNewRecord){
				$this->user_id = (int) Yii::app()->user->getId();
				if(empty($this->user_id)){ $this->user_id= null; }
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
		if(!empty($this->property_id)){
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
	public function getPropertyDetails(){
		$property = $this->property;
		if(!empty($property)){
		$title = $property->ReferenceNumberTitle.' '.$property->PriceTitle.' '.$property->ad_title; 
		$url   = $property->DetailUrlAbs ;
		return CHtml::link($title,$url) ;
		}
	}
		public function afterSave(){
		  $options = Yii::app()->options ; 
		  $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("zj207n1pom83b");
		  $emailTemplate_common = $this->commonTemplate()   ;
		  if($this->scenario=='ask_insurance'){
			  $emailTemplate_admin =  CustomerEmailTemplate::model()->getTemplateByUid("sc357j3fgw615");
		  }else{
			 $emailTemplate_admin =  CustomerEmailTemplate::model()->getTemplateByUid("vz142jngb6850");
		  }
		  if($emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$this->f_name, $emailTemplate);
					$emailTemplate =   Yii::t('app',$emailTemplate_common, array( '[CONTENT]'=>$emailTemplate)); 
					    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
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
					 if($this->scenario=='ask_insurance'){
						 
							$emailTemplate =  Yii::t('app', $emailTemplate,
								array(
								 '{reference}' => $this->reference,
								 '{property}' => $this->PropertyDetails,
								 '{company_name}' => $this->bank->bank_name,
								'{name}' => $this->f_name,
								'{email}' => $this->email,
								'{phone}' => $this->phone,
								'{backendurl}' => $this->BackendUrl,
								)
								);
								
						}else{
							$emailTemplate =  Yii::t('app', $emailTemplate,
								array(
								'{reference}' => $this->reference,
								'{address}' => $this->AddressDetails,
								'{o_status}' => $this->o_statusTitle,
								'{property_type}' => $this->propertyTitle,
								'{c_required}' => $this->c_requiredTitle,
								'{c_content}' => $this->v_of_contentTitle,
								'{v_p_belongings}' => $this->V_of_personalTitle,
								'{company_name}' => $this->bank->bank_name,
								'{name}' => $this->f_name,
								'{email}' => $this->email,
								'{phone}' => $this->phone,
								'{backendurl}' => $this->BackendUrl,
								)
							);
						}
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
 public function validateRecaptcha($attribute,$params){
		
		  if( Yii::app()->isAppName('frontend') and !in_array(strtolower(Yii::app()->controller->action->id),array('validateinsurance','validateinsurance_ask'))){
 
	 
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
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
        'bank' => array(self::BELONGS_TO, 'Bank', 'bank_id'),
        'property' => array(self::BELONGS_TO, 'PlaceAnAd', 'property_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'sal' => 'Sal',
            'f_name' => 'Full Name',
            'm_name' => 'M Name',
            'last_name' => 'Last Name',
            'm_status' => 'M Status',
            'nationlity' => 'Nationlity',
            'dob' => 'Dob',
            'occupation' => 'Occupation',
            'p_o' => 'P O',
            'employer' => 'Employer',
            'phone' => 'phone',
            'land' => 'Land',
            'city' => 'City',
            'email' => 'Email',
            'address' => $this->mTag()->getTag('location_of_your_property','Location of Your Property'),
            'date_added' => 'Date Added',
            'last_updated' => 'Last Updated',
            'o_status' =>  $this->mTag()->getTag('ownership_status','Ownership status'),
            'c_required' => $this->mTag()->getTag('collateral_required','Collateral required') ,
            'v_of_content' =>  $this->mTag()->getTag('furniture_value','Furniture value'),
            'v_of_personal' =>  $this->mTag()->getTag('merchandise_value','Merchandise value'),
            'asked_type' => 'Type',
            'statusm' => $this->mTag()->getTag('status','Status'), 
            'property_detail' => $this->mTag()->getTag('property','Property'),
            'date_added' => $this->mTag()->gettag('date','Date'), 
            'property_type' => $this->mTag()->getTag('property_type','Property Type'),
            'bank' => $this->mTag()->getTag('bank','Bank'),
            'reference' => $this->mTag()->getTag('reference','Reference')
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
		$criteria->select = 't.*,(SELECT  status  FROM {{insurance_followup}} folloup  WHERE  folloup.form_id = t.id and folloup.status in ("A","R")  order by folloup.id desc  LIMIT 1  )   as statusm';
		$criteria->condition = '1';
        $criteria->compare('id',$this->id);
        $criteria->compare('sal',$this->sal,true);
        $criteria->compare('reference',$this->reference,true);
        $criteria->compare('f_name',$this->f_name,true);
        $criteria->compare('m_name',$this->m_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('m_status',$this->m_status,true);
        $criteria->compare('nationlity',$this->nationlity);
        $criteria->compare('dob',$this->dob,true);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('occupation',$this->occupation,true);
        $criteria->compare('p_o',$this->p_o,true);
        $criteria->compare('employer',$this->employer,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('land',$this->land,true);
        $criteria->compare('city',$this->city);
        $criteria->compare('email',$this->email,true);
        if(!empty($this->statusm)){
			$status = $this->statusm=='1' ? '' : $this->statusm; 
			$criteria->compare('(SELECT  status  FROM {{insurance_followup}} folloup  WHERE  folloup.form_id = t.id and folloup.status in ("A","R")  order by folloup.id desc  LIMIT 1  ) ',$status);
		}
        
        if($this->asked_type == '1'){
			$criteria->condition .= ' and t.property_id is not null';
		}
        if($this->asked_type == '2'){
			$criteria->condition .= ' and t.property_id is   null';
		}
		
		
		if(AccessHelper::hasRouteAccess ('home_insurance/index') and !AccessHelper::hasRouteAccess ('home_insurance/all_company_application')){
			 $bank_id = Yii::app()->user->getModel()->bank_id;
			 $criteria->compare('t.bank_id',(int) $bank_id);
		}
        $criteria->compare('address',$this->address,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);


		if(!empty($return)){return $criteria;}

       return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder'  => array(
                    'id'   => CSort::SORT_DESC,
                ),
            ),
        ));
    }
    public $phone_false;
    public $agree;
    public $_recaptcha; 
 public function getAttibuteLabelWithEx($label){
		 $html ='';
		 if($this->isAttributeRequired($label)){  $html = '<span class="ateric"> * </span>'; };
		 return $this->getAttributeLabel($label).$html;
	 }
     
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InsuranceForm the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function salutation1(){
		return array('1'=>'Mr.','2'=>'Mrs.','3'=>'Miss');
	}
	
	public function getPropertyTitle(){
		$ar = $this->property_type_Array();
		return isset($ar[$this->property_type]) ? $ar[$this->property_type] : ''; 
	}
	
	
	public function getO_statusTitle(){
		$ar = $this->o_status_array();
		return isset($ar[$this->o_status]) ? $ar[$this->o_status] : ''; 
	}
	
	public function getC_requiredTitle(){
		$ar = $this->c_required_array();
		return isset($ar[$this->c_required]) ?$ar[$this->c_required] : ''; 
	}
	public function getV_of_contentTitle(){
		$ar = $this->v_of_content_array();
		return isset($ar[$this->v_of_content]) ?$ar[$this->v_of_content] : ''; 
	}
	
	public function getV_of_personalTitle(){
		$ar = $this->v_of_personal_array();
		return isset($ar[$this->v_of_personal]) ?$ar[$this->v_of_personal] : ''; 
	}
	
	
    public function property_type_Array(){
		return array('1'=> $this->mTag()->getTag('apartment','Apartment') ,'2'=>$this->mTag()->getTag('villa','Villa') );
	}
    public function o_status_array(){
		return array('1'=>$this->mTag()->getTag('landlord','Landlord') ,'2'=>$this->mTag()->getTag('tenant','Tenant') );
	}
    public function c_required_array(){
		return array('1'=>$this->mTag()->getTag('furniture','Furniture')   ,'3'=>$this->mTag()->getTag('building','Building') );
	}
    public function v_of_content_array(){
		if(defined('CURRENCY_CODE')){ $CURRENCY_CODE = CURRENCY_CODE; }else { $CURRENCY_CODE = ''; }
		return array('1'=>$CURRENCY_CODE.' 1-75,000','2'=>$CURRENCY_CODE.' 75,000-150,000','3'=>$CURRENCY_CODE.' 150,000-350,000', '4'=>Yii::t('app',$this->mTag()->getTag('above_{c}_{a}','Above {c} {a}'),array('{c}'=>$CURRENCY_CODE,'{a}'=>'350,000')));
	}
    public function v_of_personal_array(){
		if(defined('CURRENCY_CODE')){ $CURRENCY_CODE = CURRENCY_CODE; }else { $CURRENCY_CODE = ''; }
		return array('1'=>$this->mTag()->getTag('not_covered','Not Covered'),'2'=>$CURRENCY_CODE.' 1-25,000','3'=>$CURRENCY_CODE.' 25,000-50,000','4'=>$CURRENCY_CODE.' 50,000-100,000','5'=>$CURRENCY_CODE.' 100,000-150,000','6'=>Yii::t('app',$this->mTag()->getTag('above_{c}_{a}','Above {c} {a}'),array('{c}'=>$CURRENCY_CODE,'{a}'=>'150,000')));
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
    
    public function getBackendUrl(){
		return ASKAAN_PATH_BASE.'backend/index.php/home_insurance/view?id='.$this->primaryKey;
	}
    public function getAddressDetails(){
		if(empty($this->location_longitude)){
		return $this->address;
		}
		else{
		return	Yii::t('app','<a href="{link}" target="_blank">'.$this->address.'</a>',array('{link}'=>'https://www.google.com/maps/?q='.$this->location_latitude.','.$this->location_longitude));
		}
	}
	public function getValuationDetails(){
	 
 if(empty($this->property_id)){
		 $html = ''; 
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('property_type').' :</span><span class="pricecls" >'.$this->propertyTitle.'</span></h1>';
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('o_status').' :</span><span class="pricecls" >'.$this->o_statusTitle.'</span></h1>';
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('c_required').' :</span><span class="pricecls" >'.$this->c_requiredTitle.'</span></h1>';
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('v_of_content').' :</span><span class="pricecls" >'.$this->v_of_contentTitle.'</span></h1>';
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('v_of_personal').' :</span><span class="pricecls" >'.$this->V_of_personalTitle.'</span></h1>';
		 $html  .= '<h1 class="sml-header"><span class=" ">'. $this->getAttributeLabel('address').' :</span><span class="pricecls" >'.$this->AddressDetails.'</span></h1>';
			return $html ;
		 } else{
				$modelCriteria  = PlaceAnAd::model()->findAds($formData=array(),$count_future=false,$returnCriteria=1,$calculate=false, false);
				$modelCriteria->condition .= '   and t.id = :thisadid '; 
				$modelCriteria->params[':thisadid']  = $this->property_id; 
				$ad =  PlaceAnAd::model()->find($modelCriteria)  ;
				return '<div class="col-sm-12">'.$ad->ListingLi.'</div><div class="col-sm-12">'.$ad->ListingLiTitle.'</div>' ;
		 }
	
	}
}
