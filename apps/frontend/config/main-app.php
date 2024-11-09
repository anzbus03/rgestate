<?php defined('MW_PATH') || exit('No direct script access allowed');

 
return array(
    'basePath'          => Yii::getPathOfAlias('frontend'),
    'defaultController' => 'registration',
    'controllerPath'=>'apps/frontend/mobile/controllers',
	'viewPath'=>'apps/frontend/mobile/views', 
    'name'=>'Yabella3.com',      
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
    ),
    
    'components' => array(
         'request' => array( 
            'noCsrfValidationRoutes'  => array('site/*','PlaceAd/*','dswh/*','user/*','subcategory/loadCategories',"place_an_ad/upload/*","place_an_ad/image_approve_manage","place_an_ad/select_state","place_an_ad/select_city","place_an_ad/select_category","place_an_ad/select_sub_category","place_an_ad/upload","place_an_ad/delete_image","place_an_ad/loadCities","city/LoadStates","details/*","site/oauthadmin",'place_an_ad/ppload_floor_plan/*','place_an_ad/delete_floor_plan'),
        ),
 
       
       
        
        'urlManager' => array(
      // 'urlFormat'=>'get',
           'urlFormat'=>'path',
                    'showScriptName'=>'false',
            'rules' => array(
                array('site/index', 'pattern' => ''),
                array('site/index', 'pattern' => 'sitemap', 'urlSuffix' => '.xml'),

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
            'errorAction'   => 'user/error',
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
		 
    ),
);
 
