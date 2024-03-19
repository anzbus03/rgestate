<?php

/**
 * Backend application bootstrap file
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
// define the type of application we are creating.
define('MW_APP_NAME', 'backend'); 
define('LOGO_URL', 'realcommercial.pl/assets/new/images/new_logo.png'); 
define('FRONT_LINK', 'http://localhost/projects/homepolski.pl/realcommercial.pl/');
define('SITE_UID', 'R'); 
define('DBNAME', 'home_real_commercial'); 
define('DBUSER', 'root'); 
define('DBPASSWORD', ''); 
define('APP_PATH',realpath(dirname(__FILE__).'/../realcommercial.pl')); 
define('USER_MODEL','ListingUsersCommercial');  
// and start an instance of it.
require_once(dirname(__FILE__) . '/../apps/init.php');
