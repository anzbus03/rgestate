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
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo Yii::t('settings', 'Exporter settings')?></h3>
    </div>
    <div class="card-body">
        <?php 
        /**
         * This hook gives a chance to prepend content before the active form fields.
         * Please note that from inside the action callback you can access all the controller view variables 
         * via {@CAttributeCollection $collection->controller->data}
         * @since 1.3.3.1
         */
        $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
            'controller'    => $this,
            'form'          => $form    
        )));
        ?>
        <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-2">
            <?php echo $form->labelEx($exportModel, 'enabled');?>
            <?php echo $form->dropDownList($exportModel, 'enabled', $exportModel->getYesNoOptions(), $exportModel->getHtmlOptions('enabled')); ?>
            <?php echo $form->error($exportModel, 'enabled');?>
        </div>
        <div class="form-group col-lg-2">
            <?php echo $form->labelEx($exportModel, 'records_per_file');?>
            <?php echo $form->textField($exportModel, 'records_per_file', $exportModel->getHtmlOptions('records_per_file')); ?>
            <?php echo $form->error($exportModel, 'records_per_file');?>
        </div>
        <div class="form-group col-lg-2">
            <?php echo $form->labelEx($exportModel, 'memory_limit');?>
            <?php echo $form->dropDownList($exportModel, 'memory_limit', $exportModel->getMemoryLimitOptions(), $exportModel->getHtmlOptions('memory_limit')); ?>
            <?php echo $form->error($exportModel, 'memory_limit');?>
        </div>    
        <div class="form-group col-lg-2">
            <?php echo $form->labelEx($exportModel, 'process_at_once');?>
            <?php echo $form->textField($exportModel, 'process_at_once', $exportModel->getHtmlOptions('process_at_once')); ?>
            <?php echo $form->error($exportModel, 'process_at_once');?>
        </div>
        <div class="form-group col-lg-2">
            <?php echo $form->labelEx($exportModel, 'pause');?>
            <?php echo $form->textField($exportModel, 'pause', $exportModel->getHtmlOptions('pause')); ?>
            <?php echo $form->error($exportModel, 'pause');?>
        </div>   
        <div class="clearfix"><!-- --></div> 
        <?php 
        /**
         * This hook gives a chance to append content after the active form fields.
         * Please note that from inside the action callback you can access all the controller view variables 
         * via {@CAttributeCollection $collection->controller->data}
         * @since 1.3.3.1
         */
        $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
            'controller'    => $this,
            'form'          => $form    
        )));
        ?>
        <div class="clearfix"><!-- --></div>
    </div>
</div>