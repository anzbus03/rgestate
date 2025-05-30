<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.3
 */
 
?>

<div class="clearfix"><!-- --></div>

<div class="card">
    <div class="card-header""">
        <div class="pull-left">
            <h3 class="card-title"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo Yii::t('servers', 'Additional headers');?></h3>
        </div>
        <div class="pull-right">
            <a href="javascript:;" class="btn btn-xs btn-primary btn-add-header"><?php echo Yii::t('servers', 'Add new header');?></a>
        </div>
        <div class="clearfix"><!-- --></div>
    </div>
    <div class="card-body">
        <div class="callout callout-info">
            <?php echo Yii::t('servers', 'If your delivery server needs extra headers in order to make the delivery, you can add them here.');?><br />
            <?php echo Yii::t('servers', 'If a header is not in the correct format or if it is part of the restricted headers, it will not be added.');?><br />
            <?php echo Yii::t('servers', 'Use this with caution and only if you know what you are doing, wrong headers can make your email delivery fail.');?>
        </div>
        <div id="headers-list">
            <?php $i = 0; foreach ($server->additional_headers as $name => $value) { ?>
                <div class="form-group col-lg-6">
                    <div class="col-lg-5">
                        <label class="required"><?php echo Yii::t('servers', 'Header name');?> <span class="required">*</span></label>
                        <div class="clearfix"><!-- --></div>
                        <?php echo CHtml::textField($server->modelName . '[additional_headers]['.$i.'][name]', $name, $server->getHtmlOptions('additional_headers', array('placeholder' => Yii::t('servers', 'X-Header-Name'))));?>
                    </div>
                    <div class="col-lg-5">
                        <label class="required"><?php echo Yii::t('servers', 'Header value');?> <span class="required">*</span></label>
                        <div class="clearfix"><!-- --></div>
                        <?php echo CHtml::textField($server->modelName . '[additional_headers]['.$i.'][value]', $value, $server->getHtmlOptions('additional_headers', array('placeholder' => Yii::t('servers', 'Header value'))));?>
                    </div>
                    <div class="col-lg-2">
                        <label>&nbsp;</label>
                        <div class="clearfix"><!-- --></div>
                        <a href="javascript:;" class="btn btn-sm btn-danger remove-header"><?php echo Yii::t('app', 'Remove');?></a>
                    </div>
                </div>
            <?php ++$i; } ?>
        </div> 
        <div class="clearfix"><!-- --></div>           
    </div>
</div>

<div id="headers-template" style="display: none;" data-count="<?php echo count($server->additional_headers);?>">
    <div class="form-group col-lg-6">
        <div class="col-lg-5">
            <label class="required"><?php echo Yii::t('servers', 'Header name');?> <span class="required">*</span></label>
            <div class="clearfix"><!-- --></div>
            <?php echo CHtml::textField($server->modelName . '[additional_headers][__#__][name]', null, $server->getHtmlOptions('additional_headers', array('disabled' => true, 'placeholder' => Yii::t('servers', 'X-Header-Name'))));?>
        </div>
        <div class="col-lg-5">
            <label class="required"><?php echo Yii::t('servers', 'Header value');?> <span class="required">*</span></label>
            <div class="clearfix"><!-- --></div>
            <?php echo CHtml::textField($server->modelName . '[additional_headers][__#__][value]', null, $server->getHtmlOptions('additional_headers', array('disabled' => true, 'placeholder' => Yii::t('servers', 'Header value'))));?>
        </div>
        <div class="col-lg-2">
            <label>&nbsp;</label>
            <div class="clearfix"><!-- --></div>
            <a href="javascript:;" class="btn btn-sm btn-danger remove-header"><?php echo Yii::t('app', 'Remove');?></a>
        </div>
    </div>
</div>