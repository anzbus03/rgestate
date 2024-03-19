<?php defined('MW_PATH') || exit('No direct script access allowed'); 
class Controller extends FrontController
{
	public $options;
	public $sec_id;
	public $boxshdw;
	public $secure_header;
	public $no_header;
	public $app;
	public $default_country;
	public $c_slug;
	public $l_view;
	public $project_name;
	public $logo_path;
	public $assetsUrl;
	public $white_header;
	public $quicklinks;
	public $project_country_id = '66124';
	public $header_class = 'header';
	public $mem = 'header'; 
	public $default_area_unit ;
	public $default_currency ;
	public $disablewebp ;
	public $fav_count ;
	public $parent_user ;
	public $parent_member ;
	public $country ;
	public $country_list ;
	public $can_open_cookie = false ;
	public $language ;
	public $tag ;
	public $direction ;
	public $logo_without; 
	public $logo_transparent; 
	public $default_country_id= '66124' ; 
	public $currencies;
	public $area_units;
	public function Init(){
	  //  echo $_SERVER['HTTP_USER_AGENT']; exit;
	  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	  define('CURRENT_URL',$actual_link);
	  define('BRAND_TITLE','RGEstate UAE');
	  $this->logo_path = 'assets/img/logo/svg/Logo-svg-500.svg'; 
	  $this->logo_without = 'assets/img/logo/svg/Logo-svg-500.svg'; 
	  $this->language = OptionCommon::getLanguage();
	  define('LANGUAGE',$this->language);
	  
	  switch(LANGUAGE){
		  case 'ar':
		  //$this->logo_path = 'assets/img/ArabAvenueLogoAr1.svg'; 
		  $this->logo_path = 'new_assets/images/logoo.svg';
		  $this->logo_without = 'new_assets/images/logoo.svg'; 
		  break;
		  default:
		  //$this->logo_path = 'assets/img/ArabAvenueLogoEn1.svg';
		  $this->logo_path = 'new_assets/images/logoo.svg';
		  $this->logo_without = 'new_assets/images/logoo.svg'; 
		  break;
	  }
	  $this->logo_transparent = 'assets/img/logoo-white.svg'; 
	  $this->country_list  = Countries::model()->list_array_country();
	  $this->area_units = AreaUnit::model()->ListDataSort();
	  $this->getCountryID();
	  $browser = $this->getBrowser(); 
	  
	  $this->tag = Yii::app()->tags;
	  $this->direction =  $this->language == 'ar'  ? 'rtl':'ltr'; 
	  $country_name = $this->country_list[COUNTRY_ID]['country_name'];
	  $country_code = $this->country_list[COUNTRY_ID]['code'];
	  $currency_code = $this->country_list[COUNTRY_ID]['currency_code'];
	  $base_rate = $this->country_list[COUNTRY_ID]['base_rate'];
	  $country_slug = $this->country_list[COUNTRY_ID]['slug'];
	  
	  define('COUNTRY_NAME',$country_name);
	  define('COUNTRY_CODE', $country_code);
	  define('CURRENCY_CODE', $currency_code);
	  define('COUNTRY_SLUG', $country_slug);
	  define('BASE_RATE', $base_rate);
	  
        $this->currencies =  Currency::model()->systemCurrencies();
        define('DEFAULT_CURRENCY','2');
        if((isset(Yii::app()->request->cookies['currency_id'.COUNTRY_ID]) and   !empty(Yii::app()->request->cookies['currency_id'.COUNTRY_ID]->value)  )){
        define('SELECTED_CURRENCY',Yii::app()->request->cookies['currency_id'.COUNTRY_ID]->value);
        }else{
        define('SELECTED_CURRENCY',DEFAULT_CURRENCY);
        }
        define('SELECT_CURRENCY_TITLE',$this->currencies[SELECTED_CURRENCY]['name']);
        define('SELECT_CURRENCY_RATE',$this->currencies[SELECTED_CURRENCY]['rate']);
	  
		$path = Yii::getPathOfAlias('root.assets'); 
	//	  $this->assetsUrl  =  Yii::app()->assetManager->publish($path  , false, -1, MW_DEBUG);
 $this->assetsUrl  = Yii::app()->apps->getbaseUrl('assets');
 
		 if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') ||  stristr($_SERVER['HTTP_USER_AGENT'],'macintosh') ||    stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ||    $browser['name'] == 'Internet Explorer' ||  $browser['name'] == 'Apple Safari' ) {
		    //define('HIDEATIPHONE',1);
		    if(stristr($_SERVER['HTTP_USER_AGENT'],'iphone') ||  stristr($_SERVER['HTTP_USER_AGENT'],'macintosh') ||  stristr($_SERVER['HTTP_USER_AGENT'],'ipad')){
		        define('APLEDEVICE',1);
		    }
		 	define('DISABLE_WEBP',1);
		}
		$request = Yii::app()->request;
         /*hide menu at iphone*/
		 if(isset($_GET['mob']) and $_GET['mob']=='1' and !isset($request->cookies['hidemenuiphone'])  ){
				$cookie = new CHttpCookie('hidemenuiphone',1);
				$cookie->expire = time()+60*60*24*180; 
				$request->cookies['hidemenuiphone'] = $cookie;
				define('HIDEATIPHONE',1);
		 }
		 if((isset($request->cookies['hidemenuiphone']) and !defined('HIDEATIPHONE')  )){
			 define('HIDEATIPHONE',1);
		 }
		 /*hide menu at iphone*/
	//	define('DISABLE_WEBP',1);
	     
         if(!Yii::app()->user->getId() and !Yii::app()->request->isAjaxRequest){
             
             $this->autoLogin();
         }
          
          
          
          
          
		$this->country = COUNTRY_ID; 
		$this->default_country =COUNTRY_ID;	
		$this->c_slug ='';
		$this->app = Yii::app();
		$this->options = $this->app->options;
		if(Yii::app()->user->getId()){
			$this->mem = Yii::app()->user->getModel();
			$this->parent_user = $this->mem->parent_user;
			if(!empty($this->parent_user)){
				$this->parent_member = ListingUsers::model()->findByPk($this->parent_user);
			}
			
		            	$cookieName2 = 'C_USERFAV'.COUNTRY_ID.Yii::app()->user->getId();
						 
						if((isset(Yii::app()->request->cookies[$cookieName]))){
							$this->fav_count  =  Yii::app()->request->cookies[$cookieName]->value;
							  
						}
						else{
                                $placead = new PlaceAnAd();
                                $criteria =  $placead->findAds($formData,false,1);
                                $criteria->join .= ' INNER JOIN {{ad_favourite}} af  on af.ad_id = t.id and af.user_id = :user_idn ';
                                $criteria->params[':user_idn'] = (int) Yii::app()->user->getId(); 
                                $total_favourite = $placead->count( $criteria); 
                                
                                $cookieName2 = 'C_USERFAV'.COUNTRY_ID.Yii::app()->user->getId();
                                $cookie = new CHttpCookie($cookieName2, $total_favourite);
                                $cookie->expire = time()+60*60*24*180; 
                                Yii::app()->request->cookies[$cookieName2] = $cookie;
								$this->fav_count  = $total_favourite ; 
								 
						}
		}
		else{
		    $this->fav_count  =  0 ; 
		    $cookieName = 'C_USERFAV'.COUNTRY_ID;
			if((isset(Yii::app()->request->cookies[$cookieName])   )){
				$data =  Yii::app()->request->cookies[$cookieName]->value;
				$this->fav_count  = (int) $data;
			}
			 
		}
		$this->project_name = $this->generateCommon('site_name','');
		if((isset(Yii::app()->request->cookies['currency_id'.COUNTRY_ID]) and   Yii::app()->request->cookies['currency_id'.COUNTRY_ID]->value != '0' )){
			define('SYSTEM_CURRENCY',Yii::app()->request->cookies['currency_id'.COUNTRY_ID]->value);
		}
		else{
			define('SYSTEM_CURRENCY',CURRENCY_CODE);
		}
			if(isset($_GET['a_unit']) and !empty($_GET['a_unit'])){
				unset(Yii::app()->request->cookies['area_unit']);
				$cookie = new CHttpCookie('area_unit', $_GET['a_unit']);
				$cookie->expire = time()+60*60*24*180; 
				Yii::app()->request->cookies['area_unit'] = $cookie;
		}
	    if((isset(Yii::app()->request->cookies['area_unit']) and   Yii::app()->request->cookies['area_unit']->value != '0' )){
			$v_cokie =  Yii::app()->request->cookies['area_unit']->value; 
			$ArModel= AreaUnit::model()->findByPk($v_cokie);
			if($ArModel){
			$this->default_area_unit  = $ArModel->master_name; 
			define('AREAVALUE', $ArModel->value);
			define('AREANAME',$ArModel->master_name);
			define('AREAUNIT',$ArModel->master_id);
			}
		}
		if(!defined('AREAUNIT') ){  define('AREAUNIT','1');define('AREAVALUE','1');define('AREANAME','Sq. Ft.'); } 
	 	if(AREAUNIT != '6' and !defined('AREAVALUE')){
			$ArModel= AreaUnit::model()->findByPk(AREAUNIT);
			if($ArModel){
			$this->default_area_unit  = $ArModel->master_name; 
			define('AREAVALUE', $ArModel->value);
			define('AREANAME',$ArModel->master_name);
			}
		}
		if((isset(Yii::app()->request->cookies['cookie_accepted']) and   Yii::app()->request->cookies['cookie_accepted']->value = '1' )){
		$this->can_open_cookie = false; 
		}
		 
	}
	public function autoLogin(){
	    
              if(isset(Yii::app()->request->cookies['l_type'])){
				 
                  $type_login =  Yii::app()->request->cookies['l_type']->value;
                  $email_login =  Yii::app()->request->cookies['u_user']->value;
                  $password_login =  Yii::app()->request->cookies['u_password']->value;
                  
                  $impersonate_login =  Yii::app()->request->cookies['u_impersonate']->value;
                  
                  
                  
                  if(!empty( $email_login) and (!empty( $password_login) or !empty( $impersonate_login)) ){
                     
                  $email_login = base64_decode($email_login);
                  $password_login = base64_decode($password_login);
                    
                  switch($type_login){
                      case 'authenticate':
                        $identity =   new UserIdentity($email_login ,$password_login);
                          
                        if(!empty( $impersonate_login) and empty( $password_login)){  $identity->impersonate = true; }
                        if ($identity->authenticate()) {
                        Yii::app()->user->login($identity,  3600 * 24 * 30);
                        }     
                      break;
                      case 'authenticatePhone':
                           
                        $identity =   new UserIdentity($email_login ,$password_login);
                        if ($identity->authenticatePhoneNoExpiry()) {
                        Yii::app()->user->login($identity,  3600 * 24 * 30);
                        }     
                      break;
                      case 'authenticateEmailCode':
                        $identity =   new UserIdentity($email_login ,$password_login);
                        if ($identity->authenticatePhoneNoExpiry()) {
                        Yii::app()->user->login($identity,  3600 * 24 * 30);
                        }     
                      break;
                  }
                  }
              }
	}
	public function appAssetUrl($file){
		return  $this->app->apps->getBaseUrl('assets/new/'.$file);
	}
	function converToTz($time="",$toTz='',$fromTz='',$format='Y-m-d H:i:s')
	{	
		// timezone by php friendly values
		$date = new DateTime($time, new DateTimeZone($fromTz));
		$date->setTimezone(new DateTimeZone($toTz));
		$time= $date->format($format);
		return $time;
	}
	function get_client_ip() {
		// return '137.97.108.194';
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
	public	function getLocationInfoByIp(){

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
        $ip = '1.187.255.255';
		$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    

		if($ip_data && $ip_data->geoplugin_countryName != null){

 

		$result['country'] = $ip_data->geoplugin_countryCode;

		$result['city'] = $ip_data->geoplugin_city;

		}

		return $result;

   }
     public function  generateOutPut($status='',$code='1',$error_message=array(),$data=array(),$successMessage='',$title=''){
		 return json_encode(array("status"=>$status,"statusCode"=>$code,"errorMessage"=>$error_message,"successMessage"=>$successMessage,"title"=>$title,"data"=>$data))  ;		
	 }
	 public function html_encode($input){
		 return htmlspecialchars($input);
	 }
	  public function checkEmpty($input=null){
		 return !empty($input) ? $input : '' ;
	 }
	 function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  //First get the platform?
  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edge/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }

    

  return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    
    'platform'  => $platform,
   
  );
} 

public function getCountryID(){
        if(defined('COUNTRY_ID')){ return COUNTRY_ID; 	}
        else{ 	define('COUNTRY_ID','65949'); return COUNTRY_ID;}
		$request = Yii::app()->request;
		if((isset($request->cookies['COUNTRY_ID']) and   $request->cookies['COUNTRY_ID']->value != '0' )){
				$country_id =  $request->cookies['COUNTRY_ID']->value; 
				define('COUNTRY_ID',$country_id);
			
		}
		else{
				$country_id = '65949';
				$cookie = new CHttpCookie('COUNTRY_ID', $country_id );
				$cookie->expire = time()+60*60*24*180; 
				Yii::app()->request->cookies['COUNTRY_ID'] = $cookie;
				define('COUNTRY_ID',$country_id);
		}
}
 public function generateCommon($field, $default_value=null){
		$Val =  $this->tag->getTag($field,$this->options->get('system.common.'.$field, $default_value));
		return (empty($Val )) ? $default_value : $Val ;
 }
  public function generateCommonHeading($field, $default_value=null){
		$Val =  $this->tag->getTag($field,$this->options->get('system.heading.'.$field, $default_value));
		return (empty($Val )) ? $default_value : $Val ;
 }
 public function generateCommonMessage($field, $default_value=null){
		$Val =  $this->tag->getTag($field,$this->options->get('system.messages.'.$field, $default_value));
		return (empty($Val )) ? $default_value : $Val ;
 }
}
