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
 
?>

<!-- START CONTENT -->
<b><?php echo strtoupper($model2->name).' has sent  reply against Ad '.@$ad_details["ad_title"]; ?></b><br /><br />

<u>Enquiry Detail</u><br />

Phone: <?php echo $model2->phone; ?><br />
Email : <?php echo $model2->email; ?><br />
interestedIn:<?php echo @$ad_details["ad_title"]; ?><br />
Message : <?php echo $model2->message; ?><br />
<?php $url = Yii::app()->createAbsoluteUrl('details/'.@$ad_details["ad_slug"]);?>
Ad url  : <a href="<?php echo $url;?>"><?php echo $url;?></a> <br />
