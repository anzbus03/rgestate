<?php
define('MW_APP_NAME', 'frontend');
define('MW_THEME', '2018'); 
define('IS_LOCAL', '1'); 
define('IS_CHECK_ONLINE', '1');
if (!defined('LANGUAGE')) {
    define('LANGUAGE', 'en');
}
if (!defined('COUNTRY_ID')) {
    define('COUNTRY_ID', '66124');
}
// and start an instance of it.
require_once(dirname(__FILE__) . '/apps/init2.php');