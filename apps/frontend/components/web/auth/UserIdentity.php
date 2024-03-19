<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * UserIdentity
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class UserIdentity extends BaseUserIdentity
{
     public $impersonate = false;
    public function authenticate()
    {
		$criteria=new CDbCriteria;
		$criteria->condition= "t.status in ('I','A','W') and t.email = :email ";
		$criteria->params[':email'] = $this->email;
 		$user = ListingUsers::model()->find($criteria);

          if (!$this->impersonate && ( empty($user) || !Yii::app()->passwordHasher->check($this->password, $user->password) )) {
            $this->errorCode = Yii::t('users', 'Invalid login credentails.');
            return !$this->errorCode;
        }
         if ($user->status=='W') {
            $this->errorCode = Yii::t('users', 'Your account waiting for administartor approval.Please contact admin.');
            return !$this->errorCode;
        }
        
        $this->setLogCookies('l_type', 'authenticate');
        $this->setLogCookies('u_user', base64_encode($this->email));
        $this->setLogCookies('u_password', base64_encode($this->password));
        if($this->impersonate){ $this->setLogCookies('u_impersonate', 1); }
         $this->setState('username', $user->first_name);
         $this->setState('user_type', $user->user_type);
         $this->setState('super_user', $user->super_user);
        $this->setId($user->user_id);
        $this->setAutoLoginToken($user);
        $this->setAutoLoginTokenLog($user);
        $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }
    
    public function setAutoLoginToken(ListingUsers $user)
    {
        $token = sha1(uniqid(rand(0, time()), true));
        $this->setState('__booking_user_auto_login_token', $token);
        
        ListingUserAutoLoginToken::model()->deleteAllByAttributes(array(
            'user_id' => (int)$user->user_id,
        ));  
        
        $autologinToken             = new ListingUserAutoLoginToken();
        $autologinToken->user_id    = (int)$user->user_id;
        $autologinToken->token      = $token;
        $autologinToken->save(); 
        
        return $this;
    }
      public function authenticateSocial($email)
    {
		 
        $user = ListingUsers::model()->findByAttributes(array(
            'email'     => $email,
            'status'    => 'A',
        ));
 
        
        $this->setState('username', $user->first_name);
        $this->setId($user->user_id);
  
        $this->setAutoLoginToken($user);
        $identity = new UserIdentity("vineethnjalil@gmail.com", "123456");
         
        Yii::app()->user->login( $identity ,  3600 * 24 * 30  );
        $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }
     public function authenticatePhone()
    {
        
     
        
        
		$criteria=new CDbCriteria;
		$criteria->condition= "t.status in ('I','A','W') and t.phone = :phone and t.otp = :otp ";
		$criteria->params[':phone'] = $this->email;
		   $criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ' ; 
	
		$criteria->params[':otp'] = $this->password;
 		$user = ListingUsers::model()->find($criteria);
  
          if ( ( empty($user)  )) {
            $this->errorCode = Yii::t('users', 'Wrong code.');
            return !$this->errorCode;
        }
        if(!empty($user)  and ($user->hours_different >  10)){
			     
			    	 $this->errorCode = Yii::t('users', 'Verification Code Expired.');
            return !$this->errorCode;
			}
         if ($user->status=='W') {
            $this->errorCode = Yii::t('users', 'Your account waiting for administartor approval.Please contact admin.');
            return !$this->errorCode;
        }
        
        
        
         $this->setState('username', $user->first_name);
         $this->setState('user_type', $user->user_type);
         $this->setState('super_user', $user->super_user);
        $this->setId($user->user_id);
        
        $new_otp = rand ( 1000 , 9999 );
        $user->updateByPk($user->user_id,array('cookie_otp'=>$new_otp));
        $this->setLogCookies('l_type', 'authenticatePhone');
        $this->setLogCookies('u_user', base64_encode($this->email));
        $this->setLogCookies('u_password', base64_encode($new_otp));
        
        $this->setAutoLoginToken($user);
     
        $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }
       public function authenticateEmailCode()
    {
        
     
        
        
		$criteria=new CDbCriteria;
		$criteria->condition= "t.status in ('I','A','W') and t.email = :phone and t.verification_code = :otp ";
		$criteria->params[':phone'] = $this->email;
		$criteria->params[':otp'] = $this->password;
 		$user = ListingUsers::model()->find($criteria);
 
          if ( ( empty($user)  )) {
            $this->errorCode = Yii::t('users', 'Wrong code.');
            return !$this->errorCode;
        }
         if ($user->status=='W') {
            $this->errorCode = Yii::t('users', 'Your account waiting for administartor approval.Please contact admin.');
            return !$this->errorCode;
        }
        
         $this->setState('username', $user->first_name);
         $this->setState('user_type', $user->user_type);
         $this->setState('super_user', $user->super_user);
        $this->setId($user->user_id);
        $new_otp = rand ( 1000 , 9999 );
        $user->updateByPk($user->user_id,array('cookie_otp'=>$new_otp ));
        
        $this->setLogCookies('l_type', 'authenticateEmailCode');
        $this->setLogCookies('u_user', base64_encode($this->email));
        $this->setLogCookies('u_password', base64_encode($new_otp));
        
        $this->setAutoLoginToken($user);
     
        $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }
     
      public function setAutoLoginTokenLog(ListingUsers $user)
    {
          
        try {
    

        $LoginLog              =   new UserLoginLog();
        $LoginLog->user_id     =  (int)$user->user_id;
        $LoginLog->l_type      =  'I';
        $LoginLog->user_ip     =  ip2long($_SERVER['REMOTE_ADDR']);;
        $LoginLog->save();         
        return $this;
        } catch (Exception $e) {
        }
    }
    public function setLogCookies($name='',$value=''){
        	$cookie = new CHttpCookie($name, $value);
			$cookie->expire = time()+60*60*24*360; 
			Yii::app()->request->cookies[$name] = $cookie;
    }
     public function authenticatePhoneNoExpiry()
    {
        
		$criteria=new CDbCriteria;
		$criteria->condition= "t.status in ('I','A','W') and t.phone = :phone and t.cookie_otp = :otp ";
		$criteria->params[':phone'] = $this->email;
		   $criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ' ; 
	
		$criteria->params[':otp'] = $this->password;
 		$user = ListingUsers::model()->find($criteria);
  
          if ( ( empty($user)  )) {
            $this->errorCode = Yii::t('users', 'Wrong code.');
            return !$this->errorCode;
        }
   
         if ($user->status=='W') {
            $this->errorCode = Yii::t('users', 'Your account waiting for administartor approval.Please contact admin.');
            return !$this->errorCode;
        }
        
        
        
         $this->setState('username', $user->first_name);
         $this->setState('user_type', $user->user_type);
         $this->setState('super_user', $user->super_user);
        $this->setId($user->user_id);
        
        $new_otp = rand ( 1000 , 9999 );
        $user->updateByPk($user->user_id,array('cookie_otp'=>$new_otp));
        $this->setLogCookies('l_type', 'authenticatePhone');
        $this->setLogCookies('u_user', base64_encode($this->email));
        $this->setLogCookies('u_password', base64_encode($new_otp));
        
        $this->setAutoLoginToken($user);
     
        $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }
}
