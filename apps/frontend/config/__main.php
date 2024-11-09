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
    ),
    
    'components' => array(
        
        'request' => array( 
            'noCsrfValidationRoutes'  => array('lists/*'),
        ),
         'ePdf' => array(
            'class'         => 'webroot.apps.extensions.yii-pdf-master.yii-pdf-master.EYiiPdf',
            'params'        => array(
              
                'HTML2PDF' => array(
                    'librarySourcePath' => 'webroot.apps.extensions.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                    /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format'      => 'A4', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )*/
                )
            ),
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
                'sitemap.xml' => 'site/sitemap',
                array('site/index', 'pattern' => ''),
                array('adlist/index', 'pattern' => 'adlist/<slug:(.*)>'),
                array('details/index', 'pattern' => 'details/<slug:(.*)>'),
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
       'uploadDir' =>'http://localhost/projects/hotel-booking/uploads',
         'forgot_password_mail'=>'test@reservetrip.com',
         'info_email'=>'vineethnjalil@gmail.com',
         'admin_email'=>'vineethnjalil@gmail.com',
    ),
);
 
