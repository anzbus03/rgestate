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
 
class UserLoginPhone extends User
{
    public $remember_me = true;
    public $_recaptcha;
    public $need_captcha_validation;
    public $need_ajaxlogin;
    public $otp_false;
     public $phone;
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $hooks  = Yii::app()->hooks;
        $apps   = Yii::app()->apps;
        $filter = $apps->getCurrentAppName() . '_model_'.strtolower(get_class($this)).'_'.strtolower(__FUNCTION__);
    
        $rules = array(
            array('phone', 'required','on'=>'enterPhone,enterPhonePopup'),
            array('phone', 'OtpLimit','on'=>'enterPhonePopup'),
              array('phone', 'authenticatePhone','on'=>'enterPhone'),
              array('phone', 'authenticatePhonePopup','on'=>'authenticatePhone'),
              array('phone', 'validatePhone'),
           // array('_recaptcha', 'validateRecaptcha'   ),
           // array('email', 'email'),
          //  array('password', 'length', 'min' => 4, 'max' => 100),
           array('otp_false', 'required','on'=>'enterOtp'),
            array('otp_false', 'authenticate','on'=>'enterOtp'),
            
          //  array('remember_me', 'safe'),
        );
        
        $rules = $hooks->applyFilters($filter, new CList($rules));
        $this->onRules(new CModelEvent($this, array(
            'rules' => $rules,
        )));
        
        return $rules->toArray();
    }
    public function authenticatePhone()
    {
		$criteria=new CDbCriteria;
		$criteria->condition= "t.status in ('I','A','W') and t.phone = :phone ";
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ' ; 
		$criteria->params[':phone'] = Yii::t('app',$this->phone,array(' '=>''));
 		$user = ListingUsers::model()->find($criteria);

        if (empty($user)) {
              		$this->addError('phone',  'Your phone number not registered with us.'.CHtml::link('click here to register free',Yii::app()->createUrl('user/signup'),array('class'=>'link_color','style'=>'display:inline-block')));
			 
        }
        else if ($user->status=='W') {
            
            	$this->addError('phone',  'Your account waiting for administartor approval.Please contact admin.');
        } 
        $attemt = Yii::app()->options->get('system.common.try','2');
		$attemt_last_hrs1 = Yii::app()->options->get('system.common.last_hours','24');
		$attemt_last_hrs = $attemt_last_hrs1*60; 
		if(((int)$user->hours_different <  $attemt_last_hrs)  and ((int) $user->login_attempt >= (int)$attemt )){
		$resetminutes =  ($attemt_last_hrs  - $user->hours_different) ;
		$reset = intdiv($resetminutes, 60).':'. ($resetminutes % 60);
		$this->addError('phone',Yii::t('app','<span  style="line-height:24px;font-size: 14px;">You have reached the limit to resend the code. Please use another method or try again later.  {login} </span>',  array('{login}'=>'<a href="'.Yii::app()->createUrl('user/signin').'" style="display:block;" onclick=easyload(this,event,"pajax")   class="jilpeK">Click here to Login through Email </a>'  )));
		}
    }
    public function OtpLimit()
    {
		$criteria=new CDbCriteria;
		$criteria->condition= "t.status in ('I','A','W') and t.phone = :phone ";
		$criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ' ; 
        
		$criteria->params[':phone'] = Yii::t('app',$this->phone,array(' '=>''));
 		$user = ListingUsers::model()->find($criteria);
 
		$attemt = Yii::app()->options->get('system.common.try','2');
		$attemt_last_hrs1 = Yii::app()->options->get('system.common.last_hours','24');
		$attemt_last_hrs = $attemt_last_hrs1*60; 
		if(((int)$user->hours_different <  $attemt_last_hrs)  and ((int) $user->login_attempt >= (int)$attemt )){
		$resetminutes =  ($attemt_last_hrs  - $user->hours_different) ;
		$reset = intdiv($resetminutes, 60).':'. ($resetminutes % 60);
		$this->addError('phone',Yii::t('app','<span style="line-height:24px;font-size: 14px;">You have reached the limit to resend the code. Please use another method or try again later.  {login} </span>',array('{login}'=>'<a href="'.Yii::app()->createUrl('user/signin_popup').'" style="display:block;" onclick=easyload(this,event,"pajax")  class="jilpeK">Click here to Login through Email </a>')  ));
		}
    }
    public function authenticatePhonePopup()
    {
		$criteria=new CDbCriteria;
		$criteria->condition= "t.status in ('I','A','W') and t.phone = :phone ";
		$criteria->params[':phone'] = Yii::t('app',$this->phone,array(' '=>''));
 		$user = ListingUsers::model()->find($criteria);
 
          if ($user->status=='W') {
            
            	$this->addError('phone',  'Your account waiting for administartor approval.Please contact admin.');
        } 
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'remember_me' => Yii::t('users', 'Remember me'),
             'otp_false' => Yii::t('users', 'Enter SMS  Code'),
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
 
    public function authenticate($attribute, $params)
    {
		 
        if ($this->hasErrors()) {
            return;
        }
           if(!isset(Yii::app()->request->cookies['disable_login'])){
                 
            	$try = Yii::app()->user->getState('login_try','0');
				if($try>=1){
				        $maximum_try = 3; 
				        if($try>$maximum_try){
				                $cookie = new CHttpCookie('disable_login',1);
								$cookie->expire = time()+60*10; 
								Yii::app()->request->cookies['disable_login'] = $cookie;
								$try = Yii::app()->user->setState('login_try',0);
								 $this->addError('otp_false', 'Toos many login attempts.Try again in 10 minutes');
				        }
				        else{
				            $try = Yii::app()->user->setState('login_try',$try+1);
				        }
				        
				        
						 
				}
				else{
				 
				    Yii::app()->user->setState('login_try','1');
				}
                }
                else{
                       
                    	 $this->addError('otp_false', Yii::t('app','Too many login attempts.Try again in 10 minutes {login}',array(' {login}'=>'<a href="'.Yii::app()->createUrl('user/signin').'" style="display:block;color:blue;"    class="jilpeK">Click here to Login through Email </a>')));
                }
        
        $identity = new UserIdentity($this->phone, $this->otp_false);
        if (!$identity->authenticatePhone()) {
            $this->addError($attribute, $identity->errorCode);
            return;
        }
       
           if (!Yii::app()->user->login($identity, $this->remember_me ? 3600 * 24 * 30 : 0)) {
            $this->addError($attribute, Yii::t('customers', 'Unable to login with the given identity!'));
            return;
        }
    }
}
