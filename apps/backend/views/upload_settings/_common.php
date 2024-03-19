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
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('settings', 'Upload settings')?></h3>
    </div>
    <div class="box-body">
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
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'agent_avatar_resize_width');?>
            <?php echo $form->textField($commonModel, 'agent_avatar_resize_width', $commonModel->getHtmlOptions('agent_avatar_resize_width')); ?>
            <?php echo $form->error($commonModel, 'agent_avatar_resize_width');?>
        </div>
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'agent_avatar_resize_height');?>
            <?php echo $form->textField($commonModel, 'agent_avatar_resize_height', $commonModel->getHtmlOptions('agent_avatar_resize_height')); ?>
            <?php echo $form->error($commonModel, 'agent_avatar_resize_height');?>
        </div>
  
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'developer_avatar_resize_width');?>
            <?php echo $form->textField($commonModel, 'developer_avatar_resize_width', $commonModel->getHtmlOptions('developer_avatar_resize_width')); ?>
            <?php echo $form->error($commonModel, 'developer_avatar_resize_width');?>
        </div>    
        <div class="form-group col-lg-6">
            <?php echo $form->labelEx($commonModel, 'developer_avatar_resize_height');?>
            <?php echo $form->textField($commonModel, 'developer_avatar_resize_height', $commonModel->getHtmlOptions('developer_avatar_resize_height')); ?>
            <?php echo $form->error($commonModel, 'developer_avatar_resize_height');?>
        </div>    
        
        <div class="clearfix"><!-- --></div>
   
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
