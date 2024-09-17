<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Frontend application main configuration file
 * 
 * This file should not be altered in any way!
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

return array(
    'basePath'          => Yii::getPathOfAlias('frontend'),
    'defaultController' => 'detailsrert', 
      'name'=>'Yabella3.com',
     
   // 'theme'=>'qweqwe',
    'preload' => array(
        'frontendSystemInit'
    ),
    'controllerMap'=>array(
      'gomasterkey_xml'=>array(
         
         'class'=> 'ext-xml.controllers.Gomasterkey_xmlController',
      ),
      'fetch'=>array(
         
         'class'=> 'ext-xml.controllers.FetchController',
      ),
      'prospace'=>array(
         
         'class'=> 'ext-propspace_xml.controllers.Prospace_fetchController',
      ),
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
            'noCsrfValidationRoutes'  => array('site/*','dswh/*','subcategory/loadCategories',"place_an_ad/upload/*","place_an_ad/image_approve_manage","place_an_ad/select_state","place_an_ad/select_city","place_an_ad/select_category","place_an_ad/select_sub_category","place_an_ad/upload","place_an_ad/delete_image","place_an_ad/loadCities","city/LoadStates","details/*","site/oauthadmin"),
        ),
 
       	'easyImage' => array(
		 
		'class' => 'common.extensions.yii-easyimage-master.EasyImage',
		//'driver' => 'GD',
		//'quality' => 100,
		//'cachePath' => '/assets/easyimage/',
		//'cacheTime' => 2592000,
		//'retinaSupport' => false,
		),
		'hybridAuth'=>array(
            'class'=>'root.apps.extensions.hybridAuth.CHybridAuth',
            'enabled'=>true, // enable or disable this component
            'config'=>array(
                 "base_url" => "http://rsclassify.com/index.php/hybridauth/endpoint", 
                 "providers" => array(
                       "Google" => array(
                            "enabled" => false,
                            "keys" => array("id" => "", "secret" => ""),
                        ),
                       "Facebook" => array(
                            "enabled" => true,
                            "keys" => array("id" => "357776481071916", "secret" => "640691c45a26076c87c79bb355abf265"),
                        ),
                       "Twitter" => array(
                            "enabled" => false,
                            "keys" => array("key" => "", "secret" => "")
                       ),
                 ),
                 "debug_mode" => false,
                 "debug_file" => "",
             ),
         ),
      'LayoutClass' => array(
            'class' => 'frontend.components.web.LayoutClass',
        ),
        
       
        
        'urlManager' => array(
      // 'urlFormat'=>'get',
           'urlFormat'=>'path',
                    'showScriptName'=>'false',
            'rules' => array(
                array('site/index', 'pattern' => ''),
                'sitemap.xml' => 'site/sitemap',
                array('site/index', 'pattern' => 'home'),
             
                array('hybridauth/endpoint', 'pattern' => 'hybridauth/endpoint?hauth.done'),
				array('details/index', 'pattern' => '<slug:(.*)>/detailView'), 
				array('project/detail', 'pattern' => '<slug:(.*)>/projectView'), 
				array('project/floor_detail', 'pattern' => '<slug:(.*)>/floorPlan'), 
				array('project/floor_plan', 'pattern' => 'floor-plan'), 
				  array('listing/index/sec/new-development', 'pattern' => 'new-development'), 
				  array('listing/index/sec/new-development', 'pattern' => 'new-development/*'), 
				  array('listing/index/sec/property-for-sale', 'pattern' => 'property-for-sale'), 
				  array('listing/index/sec/property-for-sale', 'pattern' => 'property-for-sale/*'), 
				  array('listing/index/sec/property-for-rent', 'pattern' => 'property-for-rent'), 
				  array('listing/index/sec/property-for-rent', 'pattern' => 'property-for-rent/*'), 
				  array('listing/index', 'pattern' => 'properties'),
				  array('listing/index', 'pattern' => 'properties/*'),
				   
			  array('detail/index', 'pattern' => 'property/<slug:(.*)>'),
			  array('detail/project', 'pattern' => 'project/<slug:(.*)>'),
               
				array('user_listing/find', 'pattern' => 'real-estate-agents-find'), 
				array('user_listing_developers/find', 'pattern' => 'real-estate-developers-find'), 
				array('user_listing/index', 'pattern' => 'real-estate-agents'), 
				array('user_listing_developers/index', 'pattern' => 'real-estate-developers'), 
				array('user_listing/detail', 'pattern' => 'real-estate-agent/<slug:(.*)>'), 
				array('user_listing_developers/detail', 'pattern' => 'real-estate-developer/<slug:(.*)>'), 
				
				
				array('bloglist/runtimeloader', 'pattern' => 'blogruntimeloader'),
				array('bloglist/index/slug/blog', 'pattern' => 'blogs'),
				array('bloglist/index', 'pattern' => 'blog/<slug:(.*)>'),
				 
				array('bloglist/details', 'pattern' => '<slug:(.*)>/blog'), 
				
				array('articles/view/slug/career', 'pattern' => 'careers'), 
				array('articles/List_topics/slug/help', 'pattern' => 'help'), 
				array('articles/view/slug/site-map-1', 'pattern' => 'site-map'), 
				array('articles/view/slug/privacy', 'pattern' => 'privacy'), 
				array('articles/view/slug/legal', 'pattern' => 'legal'), 
				array('articles/view/slug/media-sales', 'pattern' => 'media-sales'), 
				array('articles/view/slug/advertise', 'pattern' => 'advertise'), 
				
				
				
				array('blog/details', 'pattern' => 'blog/<slug:(.*)>/<action:(details)>'), 
				array('blog/index', 'pattern' => 'blog/<slug:(.*)>'),
				
					 
            ),
        ),
        
        'assetManager' => array(
            'basePath'  => Yii::getPathOfAlias('root.frontend.assets.cache'),
            'baseUrl'   => AppInitHelper::getBaseUrl('frontend/assets/cache')
        ),
        
       'themeManager' => array(
            'class'     => 'common.components.managers.ThemeManager',
            'basePath'  => Yii::getPathOfAlias('root.frontend.themes'),
            'baseUrl'   => AppInitHelper::getBaseUrl('frontend/themes'),
        ),
        
        'errorHandler' => array(
            'errorAction'   => 'site/error',
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
            'class' => 'frontend.components.init.FrontendSystemInit',
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
 
