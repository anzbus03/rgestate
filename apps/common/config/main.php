<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Common application main configuration file
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
    'basePath'          => Yii::getPathOfAlias('common'),
    'runtimePath'       => Yii::getPathOfAlias('common.runtime'),
    'name'              => 'Classifieds', // never change this
    'id'                => 'Classifieds', // never change this
    'sourceLanguage'    => 'en',
    'language'          => 'en',
    'defaultController' => '', 
    'charset'           => 'utf-8',
    'timeZone'          => 'UTC', // make sure we stay UTC
    
    // preloading components
    'preload' => array(
        'log', 'systemInit'
    ),
    
    // autoloading model and component classes
    'import' => array(      
        'common.components.*',
        'common.components.db.*',
        'common.components.db.ar.*',
        'common.components.db.behaviors.*',
        'common.components.helpers.*',
        'common.components.init.*', 
        'common.components.managers.*',
        'common.components.mutex.*',
        'common.components.mailer.*',
        'common.components.utils.*',
        'common.components.web.*',
        'common.components.web.auth.*',
        'common.components.web.response.*',
        'common.components.web.widgets.*',
        'common.models.*',  
        'common.models.option.*',

        'common.vendors.Urlify.*',
        'common.extensions.webp.lib.imageResize',
    ),
    
    // application components
    'components' => array(
        
        // will be merged with the custom one to get connection string/username/password and table prefix
        'db' => array(
            'connectionString'      => 'mysql:host={DB_HOST};dbname={DB_NAME}',
            'username'              => '{DB_USER}',
            'password'              => '{DB_PASS}',
            'tablePrefix'           => '{DB_PREFIX}',
            'emulatePrepare'        => true,
            'charset'               => 'utf8',
            'schemaCachingDuration' => MW_CACHE_TTL,
            'enableParamLogging'    => MW_DEBUG,
            'enableProfiling'       => MW_DEBUG,
            'queryCacheID'          => 'cache',
            'initSQLs'              => array(
                'SET time_zone="+00:00"', 
                'SET NAMES utf8',
                'SET SQL_MODE=""',
            ), // make sure we stay UTC and utf-8,
            'autoConnect'           => true,
        ),
        
        'request'=>array( 
            'class'             => 'common.components.web.BaseHttpRequest',
            'csrfCookie'        => array(
                'httpOnly'      => true,
            ),
            'csrfTokenName'           => 'csrf_token',
            'enableCsrfValidation'    => true,
            'enableCookieValidation'  => true,
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
        
        
        'cache' => array(
            'class'     => 'system.caching.' .   'CFileCache' ,
            'keyPrefix' => md5('v.' . MW_VERSION . Yii::getPathOfAlias('common')),
        ),
        
        'urlManager' => array(
            'class'          => 'CUrlManager',
            'urlFormat'      => 'path',
               'showScriptName'=>'false',
            'caseSensitive'  => false,
            'urlSuffix'      => false, 
            'rules'          => array(
            ),
        ),
         'tags' => array(
            'class' => 'common.components.managers.TagsManager',
        ),
        'messages' => array(
            'class'     => 'CPhpMessageSource',
            'basePath'  => Yii::getPathOfAlias('common.messages'),
        ),
        
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class'   => 'CFileLogRoute',
                    'levels'  => 'error',
                    'enabled' => true,
                ),
                array(
                    'class'   => 'CWebLogRoute',
                    'filter'  => 'CLogFilter',
                    'enabled' => MW_DEBUG,
                ),
                array(
                    'class'   => 'CProfileLogRoute',
                    'report'  => 'summary', 
                    'enabled' => MW_DEBUG,
                ),
            ),
        ),
        
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        
        'format' => array(
            'class' => 'system.utils.CLocalizedFormatter',
        ),
        
        'passwordHasher' => array(
            'class' =>  'common.components.utils.PasswordHasher',
        ),
        
        'ioFilter' => array(
            'class' => 'common.components.utils.IOFilter',
        ),
        
        'hooks' => array(
            'class' => 'common.components.managers.HooksManager',
        ),
        
        'options' => array(
            'class' => 'common.components.managers.OptionsManager',
            'cacheTtl' => MW_CACHE_TTL,
        ),
        
        'notify' => array(
            'class' => 'common.components.managers.NotifyManager',
        ),
        
        'mailer' => array(
            'class' => 'common.components.mailer.Mailer',
            // 'host' => 'smtp.rgestate.com',
            // 'SMTPAuth' => true,
            // 'Username' => 'test@rgestate.com',
            // 'Password' => '{?w9}$IFGA_[',
            // 'SMTPSecure' => 'ssl', // or 'ssl'
            // 'Port' => 465, // or 465 for SSL
        ),
        
        'mutex' => array(
            'class'     => 'common.components.mutex.FileMutex',
            'fileMode'  => 0666,
            'dirMode'   => 0777,
        ),
        
        'extensionMimes' => array(
            'class' => 'common.components.utils.FileExtensionMimes',
        ),
        
        'extensionsManager' => array(
            'class'    => 'common.components.managers.ExtensionsManager',
            'paths'    => array(
                array(
                    'alias'    => 'common.extensions', 
                    'priority' => -1000
                ),
                array(
                    'alias'    => 'extensions', 
                    'priority' => -999
                ),
            ),
            'coreExtensionsList' => array(),
        ),
        
        'systemInit' => array(
            'class' => 'common.components.init.SystemInit',
        ),
    ),
    
    'modules' => array(
           'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1',
            'generatorPaths' => array(
                //    'bootstrap.gii', // since 0.9.1
            ),
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
      'isTrash' =>'0',
      'onTrash' =>'1',
    ),
);