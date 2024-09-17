<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Backend application main configuration file
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
    'basePath'          => Yii::getPathOfAlias('backend'),
    'defaultController' => 'dashboard', 
    'name'=>'yallabe3',
    'preload' => array(
        'backendSystemInit'
    ),
    
    // autoloading model and component classes
    'import' => array(
        'application.ext.*',
        'backend.components.*',
        'backend.components.db.*',
        'backend.components.db.ar.*',
        'backend.components.db.behaviors.*',
        'backend.components.utils.*',
        'backend.components.web.*',
        'backend.components.web.auth.*',
        'backend.models.*',   
        'backend.models.customer-group.*',
        'common.extensions.yii-easyimage-master.EasyImage',
         'extensions.YiiMailer.YiiMailer'
    ),
    
    'components' => array(
        
        'request' => array( 
            'noCsrfValidationRoutes'  => array('property_import/*','dashboard/set_email_receicers/*','floor_plan_upload/upload','floor_plan_upload/delete_image','floor_plan/floorlist','floor_plan/loadCategories','subcategory/loadCategories',"place_property/image_approve_manage","place_property/select_state","place_property/select_city","place_property/select_category","place_property/select_sub_category","place_property/upload","place_property/delete_image","place_property/loadCities","city/LoadStates","banner/create",'place_property/*' ,'place_an_ad/*' ),
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
      
                    
            'rules' => array(
               'sitemap.xml' => 'site/sitemap',
            ),
        ),
        	'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				 
				array(
					'class'=>'CWebLogRoute',
				),
				 
			),
		),
        
        'assetManager' => array(
            'basePath'  => Yii::getPathOfAlias('root.backend.assets.cache'),
            'baseUrl'   => AppInitHelper::getBaseUrl('assets/cache')
        ),
        
        'themeManager' => array(
            'class'     => 'common.components.managers.ThemeManager',
            'basePath'  => Yii::getPathOfAlias('root.backend.themes'),
            'baseUrl'   => AppInitHelper::getBaseUrl('themes'),
        ),
        
        'errorHandler' => array(
            'errorAction'   => 'guest/error',
        ),
        
        'session' => array(
            'class'             => 'system.web.CDbHttpSession',
            'connectionID'      => 'db',
            'sessionName'       => 'mwsid',
            'timeout'           => 7200,
            'sessionTableName'  => '{{session}}',
            'cookieParams'      => array(
                'httponly'      => true,
            ),
        ),
        
        'user' => array(
            'class'             => 'backend.components.web.auth.WebUser',
            'allowAutoLogin'    => true,
            'loginUrl'          => array('guest/index'),
            'returnUrl'         => array('dashboard/index'),
            'authTimeout'       => 7200,
            'identityCookie'    => array(
                'httpOnly'  => true, 
            )
        ),
        
        'customer' => array(
            'class'             => 'customer.components.web.auth.WebCustomer',
            'allowAutoLogin'    => true,
            'authTimeout'       => 7200,
            'identityCookie'    => array(
                'httpOnly'  => true, 
            )
        ),
        
        'backendSystemInit' => array(
            'class' => 'backend.components.init.BackendSystemInit',
        ),
    ),
    
    'modules' => array(),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // list of controllers where the user doesn't have to be logged in.
        'unprotectedControllers' => array('guest','property_import'),
        'uploadDir' =>'http://yallabe3.com/uploads',
        'admin_email'=>'vineethnjalil@gmail.com',
    ),
);
