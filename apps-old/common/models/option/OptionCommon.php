<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * OptionCommon
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class OptionCommon extends OptionBase
{
    // settings category
    protected $_categoryName = 'system.common';
    
    public $site_name;
    public $copywrite_name;
    
    public $site_tagline;
    
    public $site_description;
    
    public $site_keywords;
    
    public $clean_urls = 0;
    
    public $site_status = 'online';
    
    public $site_offline_message = 'Application currently offline. Try again later!';
    
    public $api_status = 'online';
    
    public $backend_page_size = 10;
    
    public $customer_page_size = 10;
    
    public $check_version_update = 'yes';
    
    public $default_mailer;public $office_timing;
    
    public $company_info;
    
    public $show_backend_timeinfo = 'no';
    
    public $show_customer_timeinfo = 'no';
    public $admin_email  ;
    public $facebook_url  ;
    public $linked_in  ;
    public $twitter_url  ;
    public $youtube_channel_url  ;
    public $google_plus_url  ;
    public $pinterest_url  ;
    public $google_analytics_code  ;
    public $home_meta_title ="Please Change your home meta title" ;
    public $home_meta_keywords  ="Please Change your home meta keyword" ;
    public $home_meta_description  ="Please Change your home description title" ;
    public $defalut_currency  ;
    public $facebook_app_id  ;
    public $facebook_seceret_key  ;
    public $facebook_response_url  ;
    public $fav_ico  ;
    public $hide_projects_from_top_menu  ;
     
    public $logo  ;
    public $smtp_host  ;
    public $smtp_port  ;
    public $smtp_username  ;
    public $smtp_password  ;
    public $support_phone  ;
    public $support_email  ;
    public $contact_phone  ;
    public $contact_email  ;
    public $contact_fax  ;
    public $contact_address  ;
    public $contact_map  ;
    public $commercial_categories  ;
    public $residential_categories  ;
    public $google_map_api_key;
    public $agent_default_status;
    public $customer_default_status;
    public $agent_admin_status;
    public $frontend_default_ad_status;
    
    
    public $poperties_for_one_page;
        public $default_listing_country;
    public $cache_id;
    public $enable_db_cache;
        public $google_app_id;
    public $google_client_secret;
    public $home_page_banner_title ;
    public $home_page_banner_sub_title ;
    public $home_page_about_us ;
    public $agent_banner_title ;
    public $agent_meta_title ;
    
     public $buypage_meta_title ;
    public $buypage_meta_keywords ;
    public $buypage_meta_description ;
    
    public $rentpage_meta_title ;
    public $rentpage_meta_keywords ;
    public $rentpage_meta_description ;
    
    public $devpage_meta_title ;
    public $devpage_meta_keywords ;
    public $devpage_meta_description ;
    
    public $agentpage_meta_title ;
    public $agentpage_meta_keywords ;
    public $agentpage_meta_description ;
    
    public $approval;
    
    public $wanted_page_meta_title ;
    public $wanted_page_meta_keywords ;
    public $wanted_page_meta_description ;
    public $usd_val ;
    
    public $enable_home_featured_agents ;
    public $frontend_default_ad_image_status; 
   
	public $blog_link ;
	public $enable_blog_home ;
	public $home_blob_title ;
	public $upload_property_whatsapplink ;
	public $upload_property_contact_name ;
	public $upload_property_image ;
	public $customer_support_whatsapplink ;
	public $customer_support_contact_name ;
	public $customer_support_image ;
	public $customer_support_title ;
	public $upload_property_title ;
	public $price_trends_table;
     
     public $twilio_sid ;
     public $twilio_token ;
     public $twilio_phone ;
     public $customer_support_hide ;
     public $upload_property_hide ;
     public $benefites_of_register ;
     public $sendpk_username  ;
     public $sendpk_password  ;
     public $sendpk_sender  ;
      public $cookie_text  ;
     public $cookie_url_more  ;
     
    public $ad_expiry  ;
    public $no_expiry  ;
    public $ad_expiry_notification ;
    public $ad_expiry_notification_message ;
    
        public $assistance_nmber ;
     public $easy_paisa_account ;
     public $bank_transfer_account ;
     public $default_ad_package ;
     public $enable_featured;
     public $show_pack_link;
     public $max_no_users;
      public $contact_phone_hide_with;
      public $payment_policy;
       public $try;
    public $last_hours;
public $disable_login_otp;
public $tax_title;public $tax_number;public $re_captcha_key;
public $re_captcha_secret;

public $areaguide_title;public $areaguide_description;public $areaguide_keywords;

    public function rules()
    {
        $rules = array(
            array('site_name,usd_val,agent_default_status,customer_default_status, frontend_default_ad_status, copywrite_name,site_tagline, clean_urls, site_status, site_offline_message, api_status, backend_page_size, customer_page_size, default_mailer, show_backend_timeinfo, show_customer_timeinfo,defalut_currency,cache_id,enable_db_cache', 'required'),
            array('contact_map,contact_phone,contact_email,contact_fax,contact_address,site_description,support_phone,google_analytics_code,pinterest_url,google_plus_url,smtp_host,smtp_port,smtp_username,smtp_password, facebook_response_url,site_keywords,facebook_url,twitter_url,youtube_channel_url,home_meta_title,home_meta_keywords,home_meta_description,facebook_app_id,facebook_seceret_key,linked_in,hide_projects_from_top_menu,residential_categories,commercial_categories,google_map_api_key,google_map_api_key,google_client_secret,google_app_id', 'safe'),
            array('clean_urls', 'in', 'range' => array(0, 1)),
            array('site_status, api_status', 'in', 'range' => array('online', 'offline')),
            array('site_offline_message', 'length', 'max' => 250),
            array('home_page_banner_sub_title,home_page_banner_title,office_timing', 'length', 'max' => 250),
            array('admin_email,support_email', 'email'),
            array('max_no_users',  'numerical', 'integerOnly'=>true, 'min'=>0, 'max'=>200),
             array('cookie_text,cookie_url_more,contact_phone_hide_with,payment_policy,try,last_hours,disable_login_otp,tax_number,tax_title,re_captcha_key,re_captcha_secret', 'safe' ),
            array('agent_banner_title,agent_meta_title,frontend_default_ad_image_status,benefites_of_register,upload_property_hide,customer_support_hide,sendpk_username,sendpk_password,sendpk_sender', 'safe'),
             array('upload_property_image,customer_support_image', 'file', 'types'=>'jpg,jpeg, gif, png','allowEmpty'=>true ),
            array('blog_link,enable_blog_home,home_blob_title, upload_property_whatsapplink ,upload_property_contact_name ,upload_property_image , customer_support_whatsapplink , customer_support_contact_name , customer_support_image', 'safe'),
            array('backend_page_size, customer_page_size', 'in', 'range' => array_keys($this->paginationOptions->getOptionsList())),
            array('check_version_update, show_backend_timeinfo, show_customer_timeinfo,hide_projects_from_top_menu,enable_db_cache,approval,enable_home_featured_agents', 'in', 'range' => array_keys($this->getYesNoOptions())),
            array('default_mailer', 'in', 'range' => array_keys($this->getSystemMailers())),
            array('company_info,home_page_banner_title_r,home_page_banner_title_n,home_page_banner_title_w,home_page_about_us,customer_support_title,upload_property_title,price_trends_table', 'safe'),
            array('poperties_for_one_page', 'numerical', 'integerOnly'=>true ),
             array('buypage_meta_title,buypage_meta_keywords,buypage_meta_description,rentpage_meta_title,rentpage_meta_keywords,rentpage_meta_description,devpage_meta_title,devpage_meta_keywords,devpage_meta_description,agentpage_meta_title,agentpage_meta_keywords,agentpage_meta_description,wanted_page_meta_title,wanted_page_meta_keywords,wanted_page_meta_description', 'safe'),
            array('ad_expiry', 'numerical', 'integerOnly'=>true ),
            array('no_expiry,ad_expiry_notification,ad_expiry_notification_message,default_ad_package,areaguide_keywords,areaguide_description,areaguide_title', 'safe'),
            array('fav_ico', 'file', 'types'=>'ico'),
            array('logo', 'file', 'types'=>'jpg, gif, png'),
            array('twilio_sid,twilio_token,twilio_phone,enable_featured,show_pack_link', 'safe' ),
            array('assistance_nmber,easy_paisa_account,bank_transfer_account', 'safe' ),
        );
        
        return CMap::mergeArray($rules, parent::rules());    
    }
    
    public function attributeLabels()
    {
        $labels = array(
              'ad_expiry'             => Yii::t('settings', 'Ad Expiry Days:'),
            'ad_expiry_notification'             => Yii::t('settings', 'Send Message Ad Expiry Automatically:'),
            'no_expiry'             => Yii::t('settings', 'Stop Expiry'),
            'usd_val'             => Yii::t('settings', '1 USD = __ SAR ?'),
            'site_name'             => Yii::t('settings', 'Site name'),
            'copywrite_name'             => Yii::t('settings', 'Copyright text'),
            'site_tagline'          => Yii::t('settings', 'Site tagline'),
            'site_description'      => Yii::t('settings', 'Site description'),
            'site_keywords'         => Yii::t('settings', 'Site keywords'),
            'clean_urls'            => Yii::t('settings', 'Clean urls'),
            'site_status'           => Yii::t('settings', 'Site status'),
            'site_offline_message'  => Yii::t('settings', 'Site offline message'),
            'api_status'            => Yii::t('settings', 'Api status'),
            
            'backend_page_size'     => Yii::t('settings', 'Backend page size'),
            'customer_page_size'    => Yii::t('settings', 'Customer page size'),
            'check_version_update'  => Yii::t('settings', 'Check for new version automatically'),
            'default_mailer'        => Yii::t('settings', 'Default system mailer'),
            'company_info'          => Yii::t('settings', 'Company info'),
            'linked_in'            => 'instagram',
            'show_backend_timeinfo' => Yii::t('settings', 'Show backend time info'),
            'show_customer_timeinfo'=> Yii::t('settings', 'Show customer time info'),
            'customer_default_status'=> Yii::t('settings', 'Customer Default Status '),
            'agent_default_status'=> Yii::t('settings', 'Agent/Developer Default Status '),
            'agent_admin_status'=> Yii::t('settings', 'By Default Agent/Developer is Approved By Admin?'),
            'frontend_default_ad_status'=> Yii::t('settings', 'Frontend Default Ad Status'),
            'default_listing_country'=> Yii::t('settings', 'Default Country When browse from unlisted country'),
            'cache_id'=> Yii::t('settings', 'Cache ID'),
            'home_page_banner_title'=> Yii::t('settings', 'Buy - Tab Banner Title'),
            'home_page_banner_title_r'=> Yii::t('settings', 'Rent - Tab Banner Title'),
            'home_page_banner_title_w'=> Yii::t('settings', 'Wanted - Tab Banner Title'),
            'home_page_banner_title_n'=> Yii::t('settings', 'New Projects - Tab Banner Title'),
            'google_plus_url'=> Yii::t('settings', 'LinkeIn'),
            'approval'=> Yii::t('settings', 'Account Required Admin Approval (Yes/ NO)'),
            'pinterest_url' =>'Instagram',
            'upload_property_whatsapplink' => 'WhatsApp - Upload property issue',
            'customer_support_whatsapplink' => 'WhatsApp - Customer support ',
            'upload_property_contact_name' => 'Contact Name - Upload property issue ',
            'customer_support_contact_name' => 'Contact Name - Customer support',
            'upload_property_image'        => 'Image - Upload property issue',
            'customer_support_image'    => 'Image - Customer support',
            'upload_property_title'  => 'Title - Upload issue ',
            'customer_support_title' => 'Title - Customer Support',
            'twilio_sid' => 'Twilio - Account Sid',
            'twilio_token' => 'Twilio - Auth Token',
            'twilio_phone' => 'Twilio - Sender Number',
            'customer_support_hide' => 'Hide',
            'upload_property_hide' => 'Hide',
            'benefites_of_register' => 'Benefits Of Register',
            'sendpk_username' => 'Username - sendpk.com',
            'sendpk_password' => 'Password - sendpk.com',
            'sendpk_sender' => 'Sender - sendpk.com',
            'home_blob_title' => 'Home Blog Title',
            'assistance_nmber' => 'For Assiatance - Contact Number ',
            'easy_paisa_account' => 'Easy Paisa - Acount Details',
            'bank_transfer_account' => 'Bank Transfer - Acount Details ',
            'enable_featured' => 'Show make Featured / Video  Link',
            'show_pack_link'  =>'Show Package Link',
            'contact_fax'=>'Contact Phone2',
            'contact_phone_hide_with' => 'Contact Phone2 hide with no#',
            'max_no_users'  =>'Max no. of users  allowed under developer account?',
            'disable_login_otp' => 'Disable Login Mobile OTP',
            'price_trends_table' => 'Price Trends Shows from  ',
             'wanted_page_meta_title'=>'wanted_page_meta_title',
            'wanted_page_meta_keywords'=>'Business for sale meta keyword' ,
            'wanted_page_meta_description'=>'Business for sale meta description'
    
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());    
    }
    public $home_page_banner_title_r;
    public $home_page_banner_title_w;
    public $home_page_banner_title_n;
    public function attributePlaceholders()
    {
        $placeholders = array(
            'site_name'         => Yii::t('app', 'sdfsd'),
            'site_tagline'      => Yii::t('app', 'sdfsdfsdf'),
            'site_description'  => '',
            'site_keywords'     => '',
            'company_info'      => '',
        );
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
    public function price_trends_table(){
     return array(
         '1' =>'Property Table',
         '2' =>  'Price Trends  Table',
         '3' => 'Price Trends and Property Table'
         
         );
    }
    public function attributeHelpTexts()
    {
        $texts = array(
            'site_name'             => Yii::t('settings', 'Your site name, will be used in places like logo, emails, etc.'),
            'site_tagline'          => Yii::t('settings', 'A very short description of your website.'),
            'site_description'      => Yii::t('settings', 'Description'),
            'site_keywords'         => Yii::t('settings', 'Keywords'),
            'clean_urls'            => Yii::t('settings', 'Enabling this will remove the index.php part of your urls.'),
            'site_status'           => Yii::t('settings', 'Whether the website is online or offline.'),
            'site_offline_message'  => Yii::t('settings', 'If the website is offline, show this message to users.'),
            'api_status'            => Yii::t('settings', 'Whether the website api is online or offline.'),
            
            'backend_page_size'     => Yii::t('settings', 'How many items to show per page in backend area'),
            'customer_page_size'    => Yii::t('settings', 'How many items to show per page in customer area'),
            'check_version_update'  => Yii::t('settings', 'Whether to check for new application version automatically'),
            'default_mailer'        => Yii::t('settings', 'Choose the default system mailer, please do your research if needed'),
            'company_info'          => Yii::t('settings', 'Your company info, used in places like payment page'),
            
            'show_backend_timeinfo' => Yii::t('settings', 'Whether to show the time info in the backend area'),
            'show_customer_timeinfo'=> Yii::t('settings', 'Whether to show the time info in the customer area'),
                'cache_id'=> Yii::t('settings', 'Database Cache is used::Need to Update new value when listing information change'),
        
        );
        
        return CMap::mergeArray($texts, parent::attributeHelpTexts());
    }

    public function getSiteStatusOptions()
    {
        return array(
            'online'    => Yii::t('settings', 'Online'),
            'offline'   => Yii::t('settings', 'Offline'),
        );
    }
    public static function logoUrl(){
		return ASKAAN_PATH_BASE.'assets/new/images/logo.png';
	}
    
    public static function getHomeLinks()
    {
			$html  = '';
			$property_for_sale_class  = '';
			$property_for_sale_current_menu  = '';
			$property_for_rent_class  = '';
			$property_for_rent_current_menu  = '';;
			$project_class  = '';
			$project_current_menu  = '';
			$floor_plan_class  = '';
			$floor_plan_current_menu  = '';
			$place_an_ad_class  = '';
			$place_an_ad_current_menu  = '';
			$about_class  = '';
			$style="style='color: #d30e7d; border-bottom: 9px solid #d30e7d' ";
			$menu="currentmenu='selected'";
			if (!empty(Yii::app()->controller->activeUrl) and Yii::app()->controller->activeUrl=="property-for-sale") {
				$property_for_sale_class = $style;
				$property_for_sale_current_menu  = $menu;
			}
			if (!empty(Yii::app()->controller->activeUrl) and Yii::app()->controller->activeUrl=="property-for-rent") {
				$property_for_rent_class = $style;
				$property_for_rent_current_menu  =  $menu;
			}
			if (!empty(Yii::app()->controller->activeUrl) and Yii::app()->controller->activeUrl=="project") {
				$project_class = $style;
				$project_current_menu  = $menu;
			}
			if (!empty(Yii::app()->controller->activeUrl) and Yii::app()->controller->activeUrl=="floor-plan") {
				$floor_plan_class = $style;
				$floor_plan_current_menu  = $menu;
			}
			if (!empty(Yii::app()->controller->activeUrl) and Yii::app()->controller->activeUrl=="place_an_ad") {
				$place_an_ad_class = $style;
				$place_an_ad_current_menu  = $menu;
			}
			 
		   
		 
			
			$html .= '<li><a href="'.Yii::app()->createUrl('contact').'"  class="buy" > <div>Contact Us</div> </a><span>|</span></li>';
			$html .= '<li><a href="'.Yii::app()->createUrl('about-us').'"  class="buy" > <div>About Us</div> </a><span>|</span></li>';
			$html .= '<li><a href="'.Yii::app()->createUrl('property-management-services').'"   class="buy width180" > <div>Property Management</div> </a><span>|</span></li>';
			//$html .= '<li><a href="'.Yii::app()->createUrl('floor-plan').'" '.$floor_plan_class. ' class="buy" '.$floor_plan_current_menu.' > <div>Floor Plan</div> </a><span>|</span></li>';
			$html .= '<li><a href="'.Yii::app()->createUrl('place_an_ad').'" '.$place_an_ad_class.' class="buy width120"  '.	$place_an_ad_current_menu .'  > <div>List Property</div>  </a><span>|</span></li>';
			if(Yii::app()->options->get('system.common.hide_projects_from_top_menu','no')!= self::TEXT_YES ){
			$html .= '<li><a href="'.Yii::app()->createUrl('project').'"  '.$project_class.' class="buy width185"   '.$project_current_menu.'  > <div>International Properties</div>  </a><span>|</span></li>';
			}
			$html .= '<li><a href="'.Yii::app()->createUrl('property-for-rent').'" '.$property_for_rent_class.' class="buy"  '.$property_for_rent_current_menu.'  > <div>Rent</div> </a><span>|</span></li>';
			$html .= '<li><a href="'.Yii::app()->createUrl('property-for-sale').'" '.$property_for_sale_class.'  class="buy"  '.$property_for_sale_current_menu.'  > <div>Sale</div> </a></li>';
			return $html;
    }
    
    public function getSystemMailers()
    {
        static $list;
        if ($list !== null) {
            return $list;
        }
        $list = array();
        $mailers = Yii::app()->mailer->getAllInstances();
        foreach ($mailers as $instance) {
            $list[$instance->name] = $instance->name . ' - ' .$instance->description;
        }
        return $list;
    }
    public static function timeZone(){
			  static $_timezone;
			  if ($_timezone !== null) {
				return $_timezone;
			  }
			   if ( Yii::app()->user->getModel()->timezone) {
				   $_timezone = Yii::app()->user->getModel()->timeZone;
			   }
			  return   $_timezone;
	}
    public static function localtime($date,$outfomat='Y-m-d'){
		
					$timezone = self::timeZone();
				 
					if($timezone){
						$src_tz = new DateTimeZone('UTC');
						$dest_tz = new DateTimeZone($timezone);
						$dt = new DateTime($date, $src_tz);
						$dt->setTimeZone($dest_tz);
						return $dt->format($outfomat); 
					}
					else{
						return date($outfomat,strtotime($date));
					}
	}
	public static function allowedLanguages(){
		 
			return array('en'=>'English','ar'=>'Arabic');
		 
	 }
    public static function rtlLanguages(){
		return  array('ar');
	 }
	     public static function systemLanguages(){
	 
			return array('en'=>'English','ar'=>'العربية');
		  
	 }
	 public static function defaultLanguage(){
		return 'en' ;
	 }
	 public static function getLanguage(){
	     if(defined('LANGUAGE')){  return LANGUAGE; 	 }
	     if(isset($_GET['lan']) and in_array($_GET['lan'],array('en'))){return 'en';  }  
		if(isset(Yii::app()->request->cookies['lan']) and !empty(Yii::app()->request->cookies['lan']->value) and in_array(Yii::app()->request->cookies['lan']->value,array_keys(self::systemLanguages()))){
			return Yii::app()->request->cookies['lan']->value; 
		}
		else{
		 if(isset(Yii::app()->request->cookies['lan']) and !empty(Yii::app()->request->cookies['lan']->value)   and isset(Yii::app()->request->cookies['presetation']) and !empty(Yii::app()->request->cookies['presetation']->value)){
				return Yii::app()->request->cookies['lan']->value; 			
			}else{
				return self::defaultLanguage();
			}
		}
	 }
}
