<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.3
 */
?>
<hr />      
<div class="col-lg-12">
    <h4><?php echo Yii::t('lists', 'Custom webhooks');?> <a href="javascript:;" class="btn btn-xs btn-primary pull-right btn-list-custom-webhook-add"><?php echo Yii::t('lists', 'Add new')?></a></h4>
    <div class="clearfix"><!-- --></div>
    <div class="list-custom-webhooks-list">
        <?php foreach ($models as $index => $mdl) { ?>
        <div class="col-lg-6 list-custom-webhooks-row" data-start-index="<?php echo $index;?>">
            <div class="form-group col-lg-8">
                <?php echo CHtml::activeLabelEx($mdl, 'request_url');?>
                <?php echo CHtml::textField($mdl->modelName.'['.$index.'][request_url]', $mdl->request_url, $mdl->getHtmlOptions('request_url')); ?>
                <?php echo CHtml::error($mdl, 'request_url');?>
            </div>
            <div class="form-group col-lg-2">
                <?php echo CHtml::activeLabelEx($mdl, 'request_type');?>
                <?php echo CHtml::dropDownList($mdl->modelName.'['.$index.'][request_type]', $mdl->request_type, $mdl->getRequestTypes(), $mdl->getHtmlOptions('request_type')); ?>
                <?php echo CHtml::error($mdl, 'request_type');?>
            </div>
            <div class="form-group col-lg-2">
                <div class="pull-left" style="margin-top: 30px;">
                    <a href="javascript:;" class="btn btn-danger btn-xs btn-list-custom-webhook-remove" data-webhook-id="<?php echo $mdl->webhook_id;?>" data-message="<?php echo Yii::t('lists', 'Are you sure you want to remove this webhook? There is no coming back from this after you save the changes.');?>"><?php echo Yii::t('app', 'Remove');?></a>
                </div>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <?php } ?>
    </div>
</div>
<div id="list-custom-webhooks-row-template" style="display: none;">
    <div class="col-lg-6 list-custom-webhooks-row" data-start-index="{index}">
        <div class="form-group col-lg-8">
            <?php echo CHtml::activeLabelEx($model, 'request_url');?>
            <?php echo CHtml::textField($model->modelName.'[{index}][request_url]', $model->request_url, $model->getHtmlOptions('request_url')); ?>
            <?php echo CHtml::error($model, 'request_url');?>
        </div>
        <div class="form-group col-lg-2">
            <?php echo CHtml::activeLabelEx($model, 'request_type');?>
            <?php echo CHtml::dropDownList($model->modelName.'[{index}][request_type]', $model->request_type, $model->getRequestTypes(), $model->getHtmlOptions('request_type')); ?>
            <?php echo CHtml::error($model, 'request_type');?>
        </div>
        <div class="form-group col-lg-2">
            <div class="pull-left" style="margin-top: 30px;">
                <a href="javascript:;" class="btn btn-danger btn-xs btn-list-custom-webhook-remove" data-webhook-id="<?php echo $model->webhook_id;?>" data-message="<?php echo Yii::t('lists', 'Are you sure you want to remove this webhook? There is no coming back from this after you save the changes.');?>"><?php echo Yii::t('app', 'Remove');?></a>
            </div>
        </div>
        <div class="clearfix"><!-- --></div>
    </div>
</div>
<div class="clearfix"><!-- --></div>