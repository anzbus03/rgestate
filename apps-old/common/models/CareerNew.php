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
class CareerNew  extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    
	public $name;
	public $email;
	public $phone_false;
	public $cover_letter;
	public $image;
	public $phone;
    /**
     * @return array validation rules for model attributes.
     */
       public function tableName()
    {
        return '{{career}}';
    }
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name,email,phone_false,cover_letter,image', 'required',   'message'=>Yii::app()->tags->getTag('required','Required')),
            array('name', 'length', 'max'=>100),
            array('image', 'length', 'max'=>400),
            array('phone', 'safe'),
              array('phone_false', 'validatePhone'),
            array('email', 'email','message'=>Yii::app()->tags->getTag('enter_a_valid_email_address.','Enter a valid email address.')),
                );
    }
     public function beforeValidate(){
		
	   if(parent::beforeValidate()) 
	   {
            
             $this->phone = (!empty($this->phone)) ? $this->phone : $this->phone_false;
			  
		 
			 return true;
	   }
	return false;
	 
	} 
	public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id); 
        $criteria->compare('email',$this->email,true);
        $criteria->compare('name',$this->name,true);   
         $criteria->order="id desc";
	 	return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
	   'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
		));
    }
	 public function afterSave(){ 
        $options = Yii::app()->options ; 
		  $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("nn388hsz9282f");
		  $emailTemplate_common = $this->commonTemplate()   ;
		  $emailTemplate_admin =  CustomerEmailTemplate::model()->getTemplateByUid("sf2795h3nvc4c");
		  
		  if($emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$this->name, $emailTemplate);
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
					 
							$emailTemplate =  Yii::t('app', $emailTemplate,
								array(
						 
								'{date}' => date('d-m-Y'),
								'{name}' => $this->name,
								'{email}' => $this->email,
								'{phone}' => $this->phone,
								'{cover_letter}' => nl2br($this->cover_letter),
								'{cv}' => $this->BackendUrl,
								)
							);
						 
					    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					$receipeints = serialize(array($options->get('system.common.admin_email','webmaster@rgestate.com')));
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
		return ASKAAN_PATH_BASE.'site/career_file/file/'.Yii::t('app',$this->image,array('/'=>'|'));
	}
	public function commonTemplate(){
		return Yii::app()->tags->getTag('common',Yii::app()->options->get('system.email_templates.common'));
	}
 public function validateRecaptcha($attribute,$params){
		
		  if( Yii::app()->isAppName('frontend') and !in_array(strtolower(Yii::app()->controller->action->id),array('validatefrm'))){
 
	 
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
  

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
           'image' =>Yii::app()->tags->getTag('upload_cv','Upload CV'),
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
        
    public $agree;
    public $_recaptcha; 
 public function getAttibuteLabelWithEx($label){
		 $html ='';
		 if($this->isAttributeRequired($label)){  $html = '<span class="ateric"> * </span>'; };
		 return $this->getAttributeLabel($label).$html;
	 }
     public function validatePhone($attribute,$params)
	{
		if(!empty($this->$attribute)){
			$string = $this->$attribute;
			$strlen = strlen(Yii::t('app',$string,array(' '=>'')));
			if (strpos($this->$attribute, '+') !== false) {
				$string = substr($this->$attribute,1,strlen($this->$attribute));
			}
			if($strlen<9){
					 $this->addError($attribute,  Yii::t('app','Please enter a valid  Mobile No.'.$this->$attribute));	
			}
			if($strlen>14){
					 $this->addError($attribute,  Yii::t('app','Please enter a valid  Mobile No.'.$this->$attribute));	
			}
			if (substr_count($string, ' ') > 3 ) {
				 $this->addError($attribute,  Yii::t('app','Please enter a valid  Mobile No.'.$this->$attribute));				 
			}
			 
			$rtl_chars_pattern = '/^[\s\d]+$/';
			 
			if(preg_match($rtl_chars_pattern, $string)  ) {
			  
			}
			else {
			   $this->addError($attribute,  Yii::t('app','Please enter a valid  Mobile No.'.$this->$attribute));
			}
			 
		}
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
      
}
