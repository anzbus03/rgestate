<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @subpackage Payment Gateway Paypal
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
echo CHtml::form($model->getModeUrl(), 'post', array(
    'id'         => 'paypal-hidden-form',
    'data-order' => Yii::app()->createUrl($dataUrl),
));

 
echo CHtml::hiddenField('business', $model->email);
echo CHtml::hiddenField('cmd', '_xclick');
echo CHtml::hiddenField('item_name', Yii::t('price_plans', 'Ad Promotion'));
echo CHtml::hiddenField('item_number', 1);
echo CHtml::hiddenField('amount', round($order->total, 2));
echo CHtml::hiddenField('currency_code', $currency->code);
echo CHtml::hiddenField('no_shipping', 1);
echo CHtml::hiddenField('cancel_return', $cancelUrl);
echo CHtml::hiddenField('return', $returnUrl);
echo CHtml::hiddenField('notify_url', $notifyUrl);
echo CHtml::hiddenField('custom', $customVars);
 
?>
<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
    Paypal - www.paypal.com <br />
    <?php echo Yii::t('ext_payment_gateway_paypal', 'You will be redirected to pay securely on paypal.com official website!');?>
</p>
<p><button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> <?php echo Yii::t('price_plans', 'Submit payment')?></button></p>

<?php echo CHtml::endForm(); ?>
