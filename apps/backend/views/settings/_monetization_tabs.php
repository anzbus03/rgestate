<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.4
 */
 
?>
<ul class="nav nav-tabs" style="border-bottom: 0px;">
    <li class="<?php echo $this->getAction()->getId() == 'monetization' ? 'active' : 'inactive';?>">
        <a href="<?php echo $this->createUrl('settings/monetization')?>">
            <?php echo Yii::t('settings', 'Monetization');?>
        </a>
    </li>
    <li class="<?php echo $this->getAction()->getId() == 'monetization_orders' ? 'active' : 'inactive';?>">
        <a href="<?php echo $this->createUrl('settings/monetization_orders')?>">
            <?php echo Yii::t('settings', 'Orders');?>
        </a>
    </li>
</ul>