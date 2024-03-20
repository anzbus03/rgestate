<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * UserLogin
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class UserLoginPopup extends User
{
    public $remember_me = true;
    public $_recaptcha;
    public $need_captcha_validation;
    public $need_ajaxlogin;
     public $otp_false;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $hooks  = Yii::app()->hooks;
        $apps   = Yii::app()->apps;
        $filter = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
    
        $rules = array(
            array('email', 'required','on'=>'step1','message'=>$this->mTag()->getTag('required','Required')),
             
			  array('_recaptcha', 'validateRecaptcha','on'=>'step1'   ),
            array('email', 'email','message'=>$this->mTag()->getTag('enter_a_valid_email_address.','Enter a valid email address.')),
           array('otp_false', 'required','on'=>'enterOtp','message'=>$this->mTag()->getTag('required','Required')),
            array('otp_false', 'authenticate','on'=>'enterOtp'),
            
            array('remember_me', 'safe'),
        );
        
        $rules = $hooks->applyFilters($filter, new CList($rules));
        $this->onRules(new CModelEvent($this, array(
            'rules' => $rules,
        )));
        
        return $rules->toArray();
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'remember_me' => Yii::t('users', 'Remember me'),
              'otp_false' => Yii::t('users', 'Enter Code'),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Customer the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
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
					 $this->addError($attribute,  'You are a spammer.' );
				 }
				
 
		 
		  }
		   
	}
public function insertUser(){
							$subscriber =   ListingUsers::model()->findByAttributes(array('email'=>$this->email));
							if(empty($subscriber)){  
							$subscriber  = new ListingUsers(); 
							$subscriber->first_name  = 'Visitor';
							$subscriber->email  =  $this->email;
							$subscriber->email_verified = '0' ;
							$subscriber->o_verified = '0' ;
							$subscriber->enable_l_f = '0' ;
							$subscriber->user_type  = 'U';
							$subscriber->o_skipped  = '1';
							$password = $this->randomPassword();
							$subscriber->password  = $password;
							$subscriber->con_password  =$password;
							$subscriber->scenario  = 'new_update2';
							$subscriber->otp_login =  rand ( 1000 , 9999 );
							if(!$subscriber->save()){
								
									 
								}
								else{
									 
									$subscriber->sendOtpEmail();
									 
									Yii::app()->controller->redirect(Yii::app()->createUrl('user/email_otp',array('email'=>base64_encode($subscriber->email))));
								}
						}
						else{
							
							Yii::app()->controller->redirect(Yii::app()->createUrl('user/Signin_password',array('email'=>base64_encode($this->email)))); 
             
						}
							
  }
  function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

 public function authenticatePhone()
    {
		$criteria=new CDbCriteria;
		$criteria->condition= "t.status in ('I','A','W') and t.email = :email ";
		$criteria->params[':phone'] = Yii::t('app',$this->email,array(' '=>''));
 		$user = ListingUsers::model()->find($criteria);

        if (empty($user)) {
              		$this->addError('phone',  'Your phone number not registered with us.'.CHtml::link('click here to register free',Yii::app()->createUrl('user/signup'),array('class'=>'link_color','style'=>'display:inline-block')));
			 
        }
        else if ($user->status=='W') {
            
            	$this->addError('phone',  'Your account waiting for administartor approval.Please contact admin.');
        } 
    }
    
    public function authenticate($attribute, $params)
    {
		 
        if ($this->hasErrors()) {
            return;
        }
        
        
        $identity = new UserIdentity($this->email, $this->otp_false);
        if (!$identity->authenticateEmailCode()) {
            $this->addError($attribute, $identity->errorCode);
            return;
        }
       
           if (!Yii::app()->user->login($identity, $this->remember_me ? 3600 * 24 * 30 : 0)) {
            $this->addError($attribute, Yii::t('customers', 'Unable to login with the given identity!'));
            return;
        }
    }
}
