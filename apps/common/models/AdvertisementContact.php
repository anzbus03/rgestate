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
class AdvertisementContact extends ActiveRecord
{
	 public $verifyCode;
	 public $phone_false;
	 public $_recaptcha ;
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
        return array(
            array('email, name,phone,m_id1,m_id2,city,region_id', 'required',   'message'=>$this->mTag()->getTag('required','Required')),
            array('type,phone', 'numerical', 'integerOnly'=>true),
            array('email, name', 'length', 'max'=>150),
            array('city', 'length', 'max'=>250),
              array('_recaptcha', 'validateRecaptcha' ,"on"=>'insert' ),
           
                 array('phone_false', 'validatePhone'),
              array('phone', 'length', 'min'=>9),
              array('phone', 'length', 'max'=>11),
            array('email', 'email'),
             array('id', 'safe'),
           // array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
           // array('verifyCode', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, email, name, meassage, city, date', 'safe', 'on'=>'search'),
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

     public function getNameWithCountry(){
		if(!empty($this->country_id)){
			return $this->name.'('.$this->country->country_name.')';
		}
		else{
			return $this->name;
		}
	}

	public function afterSave(){
		 
		
		     $options = Yii::app()->options ; 
			 
             
			$emailTemplate =  CustomerEmailTemplate::model()->findByAttributes(array('template_uid'=>"dq878d3hdfef8"));
			if($emailTemplate) { 
			    $subject       = $emailTemplate->subject;
			    $emailTemplate = $emailTemplate->content;
			 
			}
			else { 	 return true; }
		   
		    
			$emailTemplate = str_replace('{name}',$this->NameWithCountry, $emailTemplate);
			$emailTemplate = str_replace('{phone}', $this->phone, $emailTemplate);
			$emailTemplate = str_replace('{email}', $this->email, $emailTemplate); 
			$emailTemplate = str_replace('{date}', date('d/m/Y'), $emailTemplate);
		    $emailTemplate = str_replace('{subject}',@$this->master->master_name, $emailTemplate);
		    $emailTemplate = str_replace('{backendurl}',$this->BackendUrl, $emailTemplate);
			 
			$emailTemplate = str_replace('{from}',Yii::app()->options->get('system.common.site_name'), $emailTemplate);
			 
			$receipeints = serialize(array($options->get('system.common.admin_email')));
			$status = 'S';
			 
			$adminEmail = new Email();			 
			$adminEmail->subject = $subject ;
			$adminEmail->message =  Yii::t('trans',$emailTemplate,array('{user}'=>$v)) ;
	 
			$adminEmail->status = $status;
			$adminEmail->receipeints = $receipeints;
			$adminEmail->sent_on =   1;
			$adminEmail->type =   'REGISTER';
			$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
			$adminEmail->save(false);
			$adminEmail->getSend(false);
	
			 
		  $emailTemplate_customer =  CustomerEmailTemplate::model()->findByAttributes(array('template_uid'=>"qw877q08hd713"));
		  if( $emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$this->name, $emailTemplate);
					//$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
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
			 
	 return true;
       
     
	}
	
	    public function getBackendUrl(){
		return ASKAAN_PATH_BASE.'backend/index.php/adv_interest/view?id='.$this->primaryKey;
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
          'region' => array(self::BELONGS_TO, 'MainRegion', 'region_id'),
           'master' => array(self::BELONGS_TO, 'Master', 'm_id1'),
            'master2' => array(self::BELONGS_TO, 'Master', 'm_id2'),
        );
    }
    public function beforeSave(){
		parent::beforeSave();
		 $this->phone = (!empty($this->phone)) ? $this->phone : $this->phone_false;
			 if($this->isNewRecord){
              if(defined('COUNTRY_ID')){
				$this->country_id      =  COUNTRY_ID;
			  }
            }
		$this->contact_type  = 'AD';
		return true;
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Subject',
            'city' => $this->mTag()->getTag('company','Company'),
            'region_id' => $this->mTag()->getTag('city','City'),
            'm_id1' => $this->mTag()->getTag('how_can_we_help?','How can we help?'), 
            'm_id2' => $this->mTag()->getTag('how_did_you_hear_about_us?','How did you hear about us?'), 
            'name' => $this->mTag()->getTag('your_full_name','Your Full Name'),
            'meassage' => 'Message',
             'phone' => $this->mTag()->gettag('contact_phone','Contact Phone'),  
            'url' => $this->mTag()->gettag('Subject','Subject'),  
            
              'email' => $this->mTag()->gettag('contact_email','Contact Email'),  
           
            'position_id' => 'Position',
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
     public $position_name;
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->select = 't.*,bp.position_name';
        $criteria->compare('id',$this->id);
        $criteria->compare('type',$this->type);
         $criteria->compare('m_id1',$this->m_id1);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('meassage',$this->meassage,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('date',$this->date,true);
        if(!empty($this->position_id)){
        $criteria->compare('t.position_id',$this->position_id);
	}
        $criteria->compare('contact_type','AD');
        $criteria->join = ' LEFT JOIN {{banner_position}}  bp on bp.position_id = t.position_id ' ;
         $criteria->order="id desc";
		$pageSize = (Yii::app()->request->getQuery("page_size")) ?  (int) Yii::app()->request->getQuery("page_size") : $pageSize = 10;
		return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
		'pagination'=>array(
		'pageSize'=>$pageSize,
		),
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
    public function getSDate(){
        return date('d/m/Y',strtotime($this->date_added)); 
    }
}
