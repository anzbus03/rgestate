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
class ContactUs extends ActiveRecord
{
	public $verifyCode;  public $_recaptcha ;
	public $phone_false; 
	public $startDate;
	public $endDate;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_contact_us';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $required = $this->mTag()->gettag('required','Required');
        return array(
            array('email, name, meassage,   phone,phone_false', 'required',  'message'=>$required),
            array('type,phone', 'numerical', 'integerOnly'=>true),
            array('email, name', 'length', 'max'=>150),
            array('city', 'length', 'max'=>250),
            array('phone', 'length', 'min'=>10),
            array('phone', 'length', 'max'=>14),
            array('email', 'email','message'=>$this->mTag()->getTag('enter_a_valid_email_address.','Enter a valid email address.')),
            array('ip_address', 'safe'),
              array('_recaptcha', 'validateRecaptcha' ,"on"=>'insert','except' => 'ai_bot' ),
           // array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
           // array('verifyCode', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, email, ai_bot, name, meassage, city, date', 'safe', 'on'=>'search'),
        );
    }
    public function validateRecaptcha($attribute,$params){
		
		  if(!Yii::app()->request->isAjaxRequest){
 
	 
			$captcha= '';
			if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
			}

			if(!$captcha){
				$this->addError($attribute, Yii::app()->tags->getTag('captcha_check','Please check the   captcha form.'));
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
     parent::beforeSave();
     if($this->isNewRecord){
			$this->ip_address      =  $this->getIp();
	 }
	    return true;
 }
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Subject',
            'email' => 'Email',
            'phone' =>'Mobile No.',
            'name' => 'Name',
            'meassage' => 'Message',
            'city' => 'Subject',
            'date' => 'Date',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('type',$this->type);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('name',$this->name,true);
		if ($this->ai_bot == 1) {
			$criteria->compare('ai_bot', 1);
		}
        $criteria->compare('meassage',$this->meassage,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('date',$this->date,true);
        // $criteria->compare('contact_type','CONTACT');
		if ($this->startDate && $this->endDate) {
			$criteria->addCondition('date >= :startDate AND date <= :endDate');
			$criteria->params[':startDate'] = $this->startDate;
			$criteria->params[':endDate'] = $this->endDate;
		}
         $criteria->order="id desc";
	 	return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => false,  // Disable pagination
		));
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
    public function Model_type()
    {
		return array(
		
		'1' => 'Need help with a technical problem',
		'2' => 'Report Copyright Infringement',
		'3' => 'Report Spam/Abuse/Fraud',
		'4' => 'Advertising on RsClassify',
		'5' => 'My property listing account',
		'6' => 'My Autos listing account',
		'7' => 'Feedback / suggestions',
		'8' => 'Other / General business inquiry',
		 
		);
	}
    public function getType($id)
    {
		$ar = $this->Model_type();
		return  (isset($ar[$id]))?  $ar[$id] : 'No Subject Defined';
		 
		 
	}
	public function getIpInfo(){
	    if(!empty($this->ip_address)){ return $this->ip_address;  }
 
	}
	
	public function findEnquiry($formData=array(),$count_future=false ,$returnCriteria =false){
		  
		$criteria=new CDbCriteria;
		$criteria->compare('contact_type','CONTACT');
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
	 public function getCondsideringTitle(){
		return $this->city;
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
		return ASKAAN_PATH_BASE.'backend/index.php/contact_us/view?id='.$this->primaryKey;
	}
	
      public function afterSave(){
				parent::afterSave();
		        $options =Yii::app()->options;
			    $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid("az3438eqlm2fc");;
			    $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("gc385h18fmdcc");;
			     $emailTemplate_common = $this->commonTemplate()   ;
			     if($emailTemplate)
			    {
					if(!empty($emailTemplate->receiver_list)){
						$list_receivers = array_filter(explode(',',$emailTemplate->receiver_list));
					}
					$subject		= $emailTemplate->subject;
					$emailTemplate  = $emailTemplate->content;
					$emailTemplate = str_replace('{name}',$this->name, $emailTemplate);
					$emailTemplate = str_replace('{phone}', $this->phone, $emailTemplate);
					$emailTemplate = str_replace('{email}', $this->email, $emailTemplate);
					$emailTemplate = str_replace('{message}', nl2br($this->meassage), $emailTemplate);
					$emailTemplate = str_replace('{date}',  date('d/m/Y') , $emailTemplate);	
					$emailTemplate = str_replace('{backendurl}',$this->BackendUrl, $emailTemplate);
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					if(!empty($list_receivers)){
						$receipeints = serialize($list_receivers);
					}
					else{
						$receipeints = serialize(array($options->get('system.common.admin_email')));
					}
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
					$emailTemplate = str_replace('[NAME]',$this->name, $emailTemplate);
					//$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
				 
					
				    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message =   Yii::t('app',$emailTemplate_common, array('[CONTENT]'=>$emailTemplate));  
					$receipeints = serialize(array($this->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
	}

}
