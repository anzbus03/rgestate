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
      'name'=>'The Gulf Indian',
     //'theme'=>'custom_theme',
    'preload' => array(
        'frontendSystemInit'
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
        'common.extensions.yii-easyimage-master.EasyImage'
    ),
    
    'components' => array(
         'request' => array( 
            'noCsrfValidationRoutes'  => array('subcategory/loadCategories',"place_an_ad/image_approve_manage","place_an_ad/select_state","place_an_ad/select_city","place_an_ad/select_category","place_an_ad/select_sub_category","place_an_ad/upload","place_an_ad/delete_image","place_an_ad/loadCities","city/LoadStates"),
        ),
       	'easyImage' => array(
		 
		'class' => 'common.extensions.yii-easyimage-master.EasyImage',
		//'driver' => 'GD',
		//'quality' => 100,
		//'cachePath' => '/assets/easyimage/',
		//'cacheTime' => 2592000,
		//'retinaSupport' => false,
		),
     
        
       
        
        'urlManager' => array(
          'urlFormat'=>'path',
                    'showScriptName'=>'false',
            'rules' => array(
                array('site/index', 'pattern' => ''),
                array('adlist/index', 'pattern' => 'adlist/<slug:(.*)>'),
                array('details/index', 'pattern' => 'details/<slug:(.*)>'),
             //   array('searchlist/index', 'pattern' => 'searchlist/<slug:(.*)>'),
            ),
        ),
        
        'assetManager' => array(
            'basePath'  => Yii::getPathOfAlias('root.frontend.assets.cache'),
            'baseUrl'   => AppInitHelper::getBaseUrl('frontend/assets/cache')
        ),
        
       'themeManager' => array(
            'class'     => 'common.components.managers.ThemeManager',
            'basePath'  => Yii::getPathOfAlias('root.frontend.themes'),
            'baseUrl'   => AppInitHelper::getBaseUrl('themes'),
        ),
        
        'errorHandler' => array(
            'errorAction'   => 'site/error',
        ),
         'user' => array(
            'class'             => 'frontend.components.web.auth.WebCustomer',
            'allowAutoLogin'    => true,
            'loginUrl'          => array('/'),
            'returnUrl'         => array('/'),
            
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
     'description' =>'Hotel Reservation',
      "siteUrl"=>"http://www.reservetrip.com/index.php/",
        'uploadDir' =>'http://localhost/projects/classified/uploads',
         'forgot_password_mail'=>'test@reservetrip.com',
         'info_email'=>'vineethnjalil@gmail.com',
         'admin_email'=>'vineethnjalil@gmail.com',
    ),
);
 
