<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 /*
?>

<!-- START CONTENT -->
<?php echo Yii::t('users', 'Please follow the following url in order to reset your password:');?><br />
<?php $url = Yii::app()->createAbsoluteUrl('user/reset_password', array('reset_key' => $model->reset_key));?>
<a href="<?php echo $url;?>"><?php echo $url;?></a><br /><br />
<?php echo Yii::t('users', 'If for some reason you cannot click the above url, please paste this one into your browser address bar:')?><br />
<?php echo $url;?>
<!-- END CONTENT-->
<?php */
?>
<?php $url = Yii::app()->createAbsoluteUrl('user/emailVerify', array('verify' => $model->verification_code));?>
<b style="color:#CC0001">Verify your email ID <a href="<?php echo $url;?>" style="color:#1e7ec8;">here</a></b><br />
If a new window doesn't open automatically please copy the URL below and paste it in your browser to manually complete the process.
<br />
<font style="color:#1e7ec8;"><?php echo $url;?></font>
<br />
<br />
<br />
 
 
