<?php defined('MW_PATH') || exit('No direct script access allowed');
 
//ategory_list = 'commercial|commercial_Office|commercial_retail|commercial_restaurant|commercial_building|commercial_industrial|commercial_Land|commercial_farm|commercial_wedding-venue|commercial_bulk-units|commercial_entertainment-complex|commercial_factory|commercial_labor-camp|commercial_showroom|commercial_staff-accommodation|commercial_warehouse|residential|residential_palace|residential_Villa|residential_compound|residential_Apartment|residential_building|residential_Land|residential_farm|residential_istiraha|residential_chalets|residential_duplex|residential_floor|commercial_hospital|commercial_schools|residential_hotelhotel-apartment|residential_penthouse|residential_townhouse|';
//$category_list = 'all|residential-building|schools|hospital|penthouse|factory|townhouse|hotel-apartment|floor|chalets|warehouse|bulk-units|labor-camp|staff-accommodation|showroom|entertainment-complex|duplex|restaurant|wedding-venue|industrial|building|retail|istiraha|farm|compound|palace|Office|land|apartment|villa';
$category_list = 'all|shopping-mall|residential-building|other-commercial|schools|hospital|penthouse|factory|townhouse|hotel-apartment|floor|warehouse|bulk-units|labor-camp|labour-camps|staff-accommodation|showroom|entertainment-complex|duplex|restaurant|hotels|industrial|building|retail|farm|compound|palace|office|land|apartment|villa';
$category_main = 'commercial|residential';
$busines_category = 'manufacturing|markettng|new-franchise|other-business|retail-business|service-business|trade-distribution';
 
return array(
    'basePath'          => Yii::getPathOfAlias('frontend'),
    'defaultController' => 'site',
    'controllerPath'=>Yii::getPathOfAlias('frontend.new-theme.controllers'),
	'viewPath'=>Yii::getPathOfAlias('frontend.new-theme.views'), 
      'name'=>'Yabella3.com',
     
   // 'theme'=>'qweqwe',
    'preload' => array(
        'frontendSystemInit'
    ),
    'controllerMap'=>array(
     
   ),
  
    // autoloading model and component classes
    'import' => array(
        'frontend.components.*',
        'frontend.components.db.*',
        'frontend.components.db.ar.*',
        'frontend.components.db.behaviors.*',
      //  'customer.components.field-builder.*',
        'frontend.components.utils.*',
        'frontend.components.web.*',
        'frontend.components.web.auth.*',
        'frontend.models.*',   
        'common.extensions.yii-easyimage-master.EasyImage',
        
       
    ),
    
    'components' => array(
         'request' => array( 
            'noCsrfValidationRoutes'  => array("ajax/upload/*",'detail/price_Trends/*','site/*','dswh/*','subcategory/loadCategories',"place_an_ad/upload/*","place_an_ad/image_approve_manage","place_an_ad/select_state","place_an_ad/select_city","place_an_ad/select_category","place_an_ad/select_sub_category","place_an_ad/upload","place_an_ad/delete_image","place_an_ad/loadCities","city/LoadStates","details/*","site/oauthadmin",'place_an_ad/ppload_floor_plan/*','place_an_ad/delete_floor_plan'),
        ),
 
       	'easyImage' => array(
		 
		'class' => 'common.extensions.yii-easyimage-master.EasyImage',
 
		),
	     'eauth' => array(
			'class' => 'common.extensions.yii-eauth-master.EAuth',
			'popup' => true, // Use the popup window instead of redirecting.
			'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
			'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
			'services' => array( // You can change the providers and their classes.
				 
				'google_oauth' => array(
					// register your app here: https://code.google.com/apis/console/
					'class' => 'GoogleOAuthService',					 
					'title' => 'Google',
				),
				 
				'facebook' => array(
					// register your app here: https://developers.facebook.com/apps/
					'class' => 'FacebookOAuthService',
					 
				), 

			),
		),
        
      'LayoutClass' => array(
            'class' => 'frontend.components.web.LayoutClass',
        ),
        
       
        
        'urlManager' => array(
      		// 'urlFormat'=>'get',
           	'urlFormat'=>'path',
            'showScriptName'=>false,
            'urlSuffix'      => false, 
            'rules' => array(
				
                // array('site/index', 'pattern' => ''),
                // array('site/index', 'pattern' => 'home'),
                array('site/sitemap', 'pattern' => 'sitemap.xml', 'urlSuffix' => '.xml'),
				
                /*
                    array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|for-sale|preleased|all)>/<type_of:('.$category_list.')>/<type_of:('.$category_list.')>/<state:(.*)>/<reg:(fujairah|umm-al-quwain|ras-al-khaimah|al-ain|ajman|sharjah|abu-dhabi|dubai)>/*'),

           			array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|for-sale|preleased|all)>/<type_of:('.$category_list.')>/<reg:(fujairah|umm-al-quwain|ras-al-khaimah|al-ain|ajman|sharjah|abu-dhabi|dubai)>/*'),
					array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|for-sale|preleased|all)>/<state:(.*)>/<reg:(fujairah|umm-al-quwain|ras-al-khaimah|al-ain|ajman|sharjah|abu-dhabi|dubai)>/*'),
					array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|for-sale|preleased|all)>/<reg:(fujairah|umm-al-quwain|ras-al-khaimah|al-ain|ajman|sharjah|abu-dhabi|dubai)>/*'),  
					
										
							array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|for-sale|preleased|all)>/<type_of:('.$category_list.')>/<state:(.*)>/*'),
					array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|for-sale|preleased|all)>/<type_of:('.$category_list.')>/*'),
					array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|for-sale|preleased|all)>/<state:(.*)>/*'),
				*/                

				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<category:(.*)>/<type_of:(.*)>/<state:(.*)>/<sub_state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<category:(.*)>/<type_of:(.*)>/<state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<category:(.*)>/<type_of:(.*)>/<sub_state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<category:(.*)>/<state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<category:(.*)>/<type_of:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<type_of:(.*)>/<state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<category:(.*)>/<sub_state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<type_of:(.*)>/<sub_state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<category:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<type_of:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/<sub_state:(.*)>/*'),
				array('listing/index', 'pattern' =>'<sec:(property-for-sale|property-for-rent|to-rent|preleased|new-development|all)>/*'),  

				'<sec:(property-for-sale|property-for-rent|preleased)>'=>'listing/index',

				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<sub_category:(.*)>/<nested_sub_category:(.*)>/<state:(.*)>/<location:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<sub_category:(.*)>/<nested_sub_category:(.*)>/<state:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<sub_category:(.*)>/<nested_sub_category:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<sub_category:(.*)>/<state:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<sub_category:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<state:(.*)>/<location:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<state:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<sub_category:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<nested_sub_category:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<state:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<sub_category:(.*)>/<state:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<state:(.*)>/<sub_category:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/<type_of:(.*)>/<nested_sub_category:(.*)>/<state:(.*)>/*'),
				array('business_listing/index', 'pattern' =>'<sec:(business-opportunities)>/*'),  
				'<sec:(business-opportunities)>'=>'business_listing/index',


                '<sec>-list/Property_<type_of>/<state>/Locality_<locality>'=>'listing/index',
                '<sec>-list/Property_<type_of>/<state>'=>'listing/index',
                '<sec>-list/Property_<type_of>'=>'listing/index',
                '<sec>-list/<state>'=>'listing/index',
                '<sec>-list/<state>/Locality_<locality>'=>'listing/index',
                '<sec>-list'=>'listing/index',
				'<sec>List/Property_<type_of>/<state>/Locality_<locality>'=>'listing/index',
                '<sec>List/Property_<type_of>/<state>'=>'listing/index',
                '<sec>List/Property_<type_of>'=>'listing/index',
                '<sec>List/<state>'=>'listing/index',
                '<sec>List/<state>/Locality_<locality>'=>'listing/index',
                '<sec>List'=>'listing/index',
             
               	array('listing/index/sec/property-for-sale/type_of[]/114/state/(.*)', 'pattern' => 'Houses_Property/$1'),
                array('hybridauth/endpoint', 'pattern' => 'hybridauth/endpoint?hauth.done'),
				array('details/index', 'pattern' => '<slug:(.*)>/detailView'), 
				array('project/detail', 'pattern' => '<slug:(.*)>/projectView'), 
				array('project/floor_detail', 'pattern' => '<slug:(.*)>/floorPlan'), 
				array('project/floor_plan', 'pattern' => 'floor-plan'),  
				array('place_an_ad_no_login/create', 'pattern' => 'submit/<type:(.*)>'  ),
				array('new_projects/create', 'pattern' => 'submit-new-project'  ),
				array('place_an_ad_no_login/select', 'pattern' => 'choose-your-option'), 
				array('submited_jvproposal/success', 'pattern' => 'submitted-jvproposal-success'), 
				//	 array('listing/index', 'pattern' => 'properties'), 
				'Houses_Property/<state:.*?>'=>array('properties/sec/property-for-sale/type_of[]/114'),
				array('listing/index/term/furnish', 'pattern' => 'Furnished_Properties'),
				array('listing/index/term/installment', 'pattern' => 'Installment_Properties'),
          
				array('listing/index/sec/new-development', 'pattern' => 'new-development'), 
				array('listing/index/sec/new-development', 'pattern' => 'new-development/*'), 
				array('listing/index/sec/property-for-sale', 'pattern' => 'property-for-sale'), 
				array('listing/index/sec/property-for-sale', 'pattern' => 'property-for-sale/*'), 
				array('listing/index/sec/property-for-rent', 'pattern' => 'property-for-rent'), 
				array('listing/index/sec/property-for-rent', 'pattern' => 'property-for-rent/*'), 

				array('listing/index/sec/business-for-sale', 'pattern' => 'business-for-sale'), 
				array('listing/index/sec/business-for-sale', 'pattern' => 'business-for-sale/*'),
				array('submited_preq/success', 'pattern' => 'submitted-property-requirement-success'), 
				array('listing/index/sec/wanted', 'pattern' => 'wanted'), 

				array('listing/index/sec/wanted', 'pattern' => 'wanted/*'), 
				array('listing/index', 'pattern' => 'properties'),
				array('listing/index', 'pattern' => 'properties/*'),
				array('detail/index/section/1', 'pattern' => 'sale/<slug:(.*)>'  ),
				array('detail/index/section/2', 'pattern' => 'rent/<slug:(.*)>' ),
				array('detail/index/section/1', 'pattern' => 'property-for-sale/<slug_en:(.*)>'  ),
				array('detail/index/section/2', 'pattern' => 'for-rent/<slug_en:(.*)>' ),


				array('detail/index/section/1', 'pattern' => 'تخفيض-السعر/<slug_ar:(.*)>'  ),
				array('detail/index/section/2', 'pattern' => 'تأجير/<slug_ar:(.*)>' ),

				array('detail/index_business/section/6', 'pattern' => 'business-sale/<slug:(.*)>' ),

				array('detail/short_link/section/1', 'pattern' => 'property-for-sale/<id:(.*)>'  ),
				array('detail/short_link/section/2', 'pattern' => 'for-rent/<id:(.*)>' ),
				array('detail/short_link/section/5', 'pattern' => 'business-sale/<id:(.*)>' ),


				array('detail/index', 'pattern' => 'id-<id:(.*)>'  ),
				array('detail/index', 'pattern' => 'id-<id:(.*)>' ),

				array('detail/index_business', 'pattern' => 'business-for-sale-id-<id:(.*)>'  ),
				array('detail/index_business', 'pattern' => 'business-for-sale-<id:(.*)>' ),
				array('detail/index', 'pattern' => 'property/<slug:(.*)>'),

				array('detail/project', 'pattern' => 'project/<slug:(.*)>'),

				array('member/activate_ad', 'pattern' => 'activate-ad/<id:(.*)>'), 
				array('bloglist/runtimeloader', 'pattern' => 'blogruntimeloader'),
				array('bloglist/fetch_ad', 'pattern' => 'bajax'),	array('bloglist/fetch_ad', 'pattern' => 'bajax/*'),

				array('bloglist/index', 'pattern' => 'blogs/<category:(.*)>/*'),
				array('bloglist/index', 'pattern' => 'blog'),
				array('bloglist/details', 'pattern' => 'blog/<slug:(.*)>/*'), 
				array('articles/category/slug/help', 'pattern' => 'help'),
				array('articles/category/slug/policies', 'pattern' => 'policies'),
				array('articles/view/slug/career', 'pattern' => 'careers'), 
				array('articles/view/slug/site-map-1', 'pattern' => 'sitemap'), 
				array('articles/view/slug/privacy', 'pattern' => 'privacy'), 
				array('articles/view/slug/legal', 'pattern' => 'legal'), 
				array('articles/view/slug/media-sales', 'pattern' => 'media-sales'), 
				array('user/signup', 'pattern' => 'free-register'),  
				array('user/signin', 'pattern' => 'login'),  

				array('member/dashboard', 'pattern' => 'my-dashboard'), 
				array('member/dashboard', 'pattern' => 'my-dashboard/*'), 

				array('place_an_ad/create', 'pattern' => 'post-my-property'), 
				array('place_an_ad/create', 'pattern' => 'post-my-property/*'), 
				array('place_an_ad/update', 'pattern' => 'update-my-property'), 
				array('place_an_ad/update', 'pattern' => 'update-my-property/*'),

				array('place_an_ad/index', 'pattern' => 'my-properties-listings'),  
				array('place_an_ad/index', 'pattern' => 'my-properties-list/*'),

				array('place_an_ad/index/status/A', 'pattern' => 'my-published-properties-listings'), 
				array('place_an_ad/index/status/A', 'pattern' => 'my-published-properties-listings/*'),


				array('place_an_ad/index/status/W', 'pattern' => 'my-waiting-approval-properties-listings'), 
				array('place_an_ad/index/status/W', 'pattern' => 'my-waiting-approval-properties-listings/*'),

				array('place_an_ad/index/status/R', 'pattern' => 'my-rejected-properties-listings'), 
				array('place_an_ad/index/status/R', 'pattern' => 'my-rejected-properties-listings/*'),


				array('place_an_ad/index/status/I', 'pattern' => 'my-inactive-properties-listings'), 
				array('place_an_ad/index/status/I', 'pattern' => 'my-inactive-properties-listings/*'),

				array('member/account_settings', 'pattern' => 'account-settings'), 
				array('member/account_settings', 'pattern' => 'account-settings/*'),
				array('user/logout', 'pattern' => 'logout'), 

				array('member/profile_settings', 'pattern' => 'profile-settings'), 
				array('member/profile_settings', 'pattern' => 'profile-settings/*'),

				array('articles/view/slug/advertise', 'pattern' => 'advertise'),  
				array('articles/view/slug/about-us', 'pattern' => 'about-us'),
				array('articles/view/slug/terms', 'pattern' => 'terms'),
				array('articles/view', 'pattern' => 'article/<slug:(.*)>'),
				array('advertise_interest/index', 'pattern' => 'advertise-with-us'),
				array('contact/index', 'pattern' => 'contact-us'),
				array('advertisement/details/slug/home', 'pattern' => 'advertisement-home'),
				array('advertisement/details', 'pattern' => 'advertise-askaan/<slug:(.*)>'),

				//array('user_listing/find', 'pattern' => 'real-estate-agents-find'), 
				array('user_listing_developers/find', 'pattern' => 'real-estate-developers-find'), 
				array('user_listing/index', 'pattern' => 'real-estate-agencies'), 
				array('user_listing/index', 'pattern' => 'real-estate-agencies/*'), 
				array('user_listing_developers/index', 'pattern' => 'real-estate-developers'), 
				array('user_listing/detail', 'pattern' => 'real-estate-agent/<slug:(.*)>'),
				array('user_listing/detail_developer', 'pattern' => 'real-estate-developer/<slug:(.*)>'),
				array('user_listing_developers/detail', 'pattern' => 'real-estate-developer/<slug:(.*)>'), 
				array('blog/details', 'pattern' => 'blog/<slug:(.*)>/<action:(details)>'), 
				array('blog/index', 'pattern' => 'blog/<slug:(.*)>'), 

				array('partners/index', 'pattern' => 'our-partners'),
				array('areaguides/index', 'pattern' => 'area-guides'),
				array('areaguides/view', 'pattern' => 'area-guides/<area:(.*)>'),
				array('submited_preq/index', 'pattern' => 'submit-your-requirements'),
				array('submited_jvproposal/index', 'pattern' => 'submit-jvproposal'),
				array('services/project_funding','pattern' => 'services/project-funding'),
				array('services/retail_investments','pattern' => 'services/retail-investments'),
				array('services/project_development','pattern' => 'services/project-development'),
				array('services/project_contracting','pattern' => 'services/project-contracting'),
				array('services/interior_fitouts','pattern' => 'services/interior-fitouts'),
				array('services/building_maintenance','pattern' => 'services/building-maintenance'),
				array('services/business_buying_selling','pattern' => 'services/business-buying-selling'),
				array('services/business_funding','pattern' => 'services/business-funding'),
				array('for-rent','pattern' => 'property-for-rent'),
				
            ),
        ),
        
        'assetManager' => array(
            'basePath'  => Yii::getPathOfAlias('root.frontend.assets.cache'),
            'baseUrl'   => '/frontend/assets/cache'
        ),
        
       'themeManager' => array(
            'class'     => 'common.components.managers.ThemeManager',
            'basePath'  => Yii::getPathOfAlias('root.frontend.themes'),
            'baseUrl'   => AppInitHelper::getBaseUrl('frontend/themes'),
        ),
        
        'errorHandler' => array(
            'errorAction'   => 'site/error',
        ),
         'session' => array(
            'timeout' => 86400,
        ),
         'user' => array(
            'class'             => 'frontend.components.web.auth.WebCustomer',
            'allowAutoLogin'    => true,
            'loginUrl'          => array('user/signin'),
            'returnUrl'         => array('/user/my_profile'),
           
            
            'identityCookie'    => array(
                'httpOnly'  => true, 
            )
        ),
        'frontendSystemInit' => array(
            'class' => 'frontend.components.init.FrontendSystemInitLatest',
        ),
    ),
	
    'modules' => array(),
   
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
			'description' =>'DF',
			'siteDomain' =>'dubizzlefree.com',
			'siteDomainYear' =>'2015',
			"siteUrl"=>"http://dubizzlefree.com/index.php",
			'uploadDir' =>'http://yallabe3.com/uploads',
			//'forgot_password_mail'=>'test@reservetrip.com',
			'forgot_password_mail'=>'vineethnjalil@gmail.com',
			'info_email'=>'vineethnjalil@gmail.com',
			'admin_email'=>'vineethnjalil@gmail.com',
			'wordpress'=>'http://www.redspider.me/workspace/tgi/',
			'classifieds'=>4,
			//'for_rent'=>2,
			'for_rent'=>11,
			'for_sale'=>10,
			//'for_sale'=>3,
			'matrimonial'=>6,
			'jobs'=>5,
			'auto'=>1,
			'realEstate'=>2,
			'travel'=>7,
			'dirctory'=>8,
			'deals'=>9,
			'emailVerificationMessage'=>'Successfully verified your account.Now you can explore your account ',
    ),
);
