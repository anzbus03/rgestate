<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
?>

<?php $form = $this->beginWidget('CActiveForm'); ?>
<div class="box box-primary">
    <div class="box-header">
        <div class="pull-left">
            <h3 class="box-title">
                <span class="glyphicon glyphicon-plus-sign"></span> <?php echo Yii::t('ext_xml', 'GoMasterKey -   XML   Settings');?>
            </h3>
        </div>
        <div class="pull-right"></div>
        <div class="clearfix"><!-- --></div>
    </div>
    <div class="box-body">
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'access_code');?>
            <?php echo $form->textField($model, 'access_code',   $model->getHtmlOptions('access_code')); ?>
            <?php echo $form->error($model, 'access_code');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'group_code');?>
            <?php echo $form->textField($model, 'group_code',   $model->getHtmlOptions('group_code')); ?>
            <?php echo $form->error($model, 'group_code');?>
        </div> 
   
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'sale_xml_url');?>
            <?php echo $form->textField($model, 'sale_xml_url',   $model->getHtmlOptions('sale_xml_url')); ?>
            <?php echo $form->error($model, 'sale_xml_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'sale_cron_url');?>
            <?php echo $form->textField($model, 'sale_cron_url',   $model->getHtmlOptions('sale_cron_url')); ?>
            <?php echo $form->error($model, 'sale_cron_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'last_update_sale_xml_url');?>
            <?php echo $form->textField($model, 'last_update_sale_xml_url',   $model->getHtmlOptions('last_update_sale_xml_url')); ?>
            <?php echo $form->error($model, 'last_update_sale_xml_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'last_update_sale_cron_url');?>
            <?php echo $form->textField($model, 'last_update_sale_cron_url',   $model->getHtmlOptions('last_update_sale_cron_url')); ?>
            <?php echo $form->error($model, 'last_update_sale_cron_url');?>
        </div> 
   
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'rent_xml_url');?>
            <?php echo $form->textField($model, 'rent_xml_url',   $model->getHtmlOptions('rent_xml_url')); ?>
            <?php echo $form->error($model, 'rent_xml_url');?>
        </div> 
   
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'rent_cron_url');?>
            <?php echo $form->textField($model, 'rent_cron_url',   $model->getHtmlOptions('rent_cron_url')); ?>
            <?php echo $form->error($model, 'rent_cron_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'last_update_rent_xml_url');?>
            <?php echo $form->textField($model, 'last_update_rent_xml_url',   $model->getHtmlOptions('last_update_rent_xml_url')); ?>
            <?php echo $form->error($model, 'last_update_rent_xml_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'last_update_rent_cron_url');?>
            <?php echo $form->textField($model, 'last_update_rent_cron_url',   $model->getHtmlOptions('last_update_rent_cron_url')); ?>
            <?php echo $form->error($model, 'last_update_rent_cron_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_country_url');?>
            <?php echo $form->textField($model, 'get_country_url',   $model->getHtmlOptions('get_country_url')); ?>
            <?php echo $form->error($model, 'get_country_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_country_cron_url');?>
            <?php echo $form->textField($model, 'get_country_cron_url',   $model->getHtmlOptions('get_country_cron_url')); ?>
            <?php echo $form->error($model, 'get_country_cron_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_state_url');?>
            <?php echo $form->textField($model, 'get_state_url',   $model->getHtmlOptions('get_state_url')); ?>
            <?php echo $form->error($model, 'get_state_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_state_crone_url');?>
            <?php echo $form->textField($model, 'get_state_crone_url',   $model->getHtmlOptions('get_state_crone_url')); ?>
            <?php echo $form->error($model, 'get_state_crone_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_city_url');?>
            <?php echo $form->textField($model, 'get_city_url',   $model->getHtmlOptions('get_city_url')); ?>
            <?php echo $form->error($model, 'get_city_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_city_cron_url');?>
            <?php echo $form->textField($model, 'get_city_cron_url',   $model->getHtmlOptions('get_city_cron_url')); ?>
            <?php echo $form->error($model, 'get_city_cron_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_district_url');?>
            <?php echo $form->textField($model, 'get_district_url',   $model->getHtmlOptions('get_district_url')); ?>
            <?php echo $form->error($model, 'get_district_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_district_cron_url');?>
            <?php echo $form->textField($model, 'get_district_cron_url',   $model->getHtmlOptions('get_district_cron_url')); ?>
            <?php echo $form->error($model, 'get_district_cron_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_community_url');?>
            <?php echo $form->textField($model, 'get_community_url',   $model->getHtmlOptions('get_community_url')); ?>
            <?php echo $form->error($model, 'get_community_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_community_cron_url');?>
            <?php echo $form->textField($model, 'get_community_cron_url',   $model->getHtmlOptions('get_community_cron_url')); ?>
            <?php echo $form->error($model, 'get_community_cron_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_sub_community_url');?>
            <?php echo $form->textField($model, 'get_sub_community_url',   $model->getHtmlOptions('get_sub_community_url')); ?>
            <?php echo $form->error($model, 'get_sub_community_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_sub_community_cron_url');?>
            <?php echo $form->textField($model, 'get_sub_community_cron_url',   $model->getHtmlOptions('get_sub_community_cron_url')); ?>
            <?php echo $form->error($model, 'get_sub_community_cron_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_agent_url');?>
            <?php echo $form->textField($model, 'get_agent_url',   $model->getHtmlOptions('get_agent_url')); ?>
            <?php echo $form->error($model, 'get_agent_url');?>
        </div> 
         <div class="form-group col-lg-6">
            <?php echo $form->labelEx($model, 'get_agent_cron_url');?>
            <?php echo $form->textField($model, 'get_agent_cron_url',   $model->getHtmlOptions('get_agent_cron_url')); ?>
            <?php echo $form->error($model, 'get_agent_cron_url');?>
        </div> 
   
        <div class="clearfix"><!-- --></div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="submit" class="btn btn-default btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
        </div>
        <div class="clearfix"><!-- --></div>
    </div>
</div>
<?php $this->endWidget(); ?>
