<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
    $this->renderPartial('_confirm-form');
    /**
     * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
     * in order to stop rendering the default content.
     * @since 1.3.3.1
     */
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm');
        ?>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-send"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array('delivery_servers/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
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
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($server, 'name');?>
                    <?php echo $form->textField($server, 'name', $server->getHtmlOptions('name')); ?>
                    <?php echo $form->error($server, 'name');?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'from_email');?>
                    <?php echo $form->textField($server, 'from_email', $server->getHtmlOptions('from_email')); ?>
                    <?php echo $form->error($server, 'from_email');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'from_name');?>
                    <?php echo $form->textField($server, 'from_name', $server->getHtmlOptions('from_name')); ?>
                    <?php echo $form->error($server, 'from_name');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'probability');?>
                    <?php echo $form->dropDownList($server, 'probability', $server->getProbabilityArray(), $server->getHtmlOptions('probability', array('data-placement' => 'right'))); ?>
                    <?php echo $form->error($server, 'probability');?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'hourly_quota');?>
                    <?php echo $form->textField($server, 'hourly_quota', $server->getHtmlOptions('hourly_quota')); ?>
                    <?php echo $form->error($server, 'hourly_quota');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'bounce_server_id');?>
                    <?php echo $form->dropDownList($server, 'bounce_server_id', $server->getBounceServersArray(), $server->getHtmlOptions('bounce_server_id')); ?>
                    <?php echo $form->error($server, 'bounce_server_id');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'tracking_domain_id');?>
                    <?php echo $form->dropDownList($server, 'tracking_domain_id', $server->getTrackingDomainsArray(), $server->getHtmlOptions('tracking_domain_id')); ?>
                    <?php echo $form->error($server, 'tracking_domain_id');?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'use_for');?>
                    <?php echo $form->dropDownList($server, 'use_for', $server->getUseForOptions(), $server->getHtmlOptions('use_for')); ?>
                    <?php echo $form->error($server, 'use_for');?>
                </div>
                <?php if ($server->getCanUseQueue()) { ?>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'use_queue');?>
                    <?php echo $form->dropDownList($server, 'use_queue', $server->getYesNoOptions(), $server->getHtmlOptions('use_queue')); ?>
                    <?php echo $form->error($server, 'use_queue');?>
                </div>
                <?php } ?>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'signing_enabled');?>
                    <?php echo $form->dropDownList($server, 'signing_enabled', $server->getYesNoOptions(), $server->getHtmlOptions('signing_enabled')); ?>
                    <?php echo $form->error($server, 'signing_enabled');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'force_from');?>
                    <?php echo $form->dropDownList($server, 'force_from', $server->getForceFromOptions(), $server->getHtmlOptions('force_from')); ?>
                    <?php echo $form->error($server, 'force_from');?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'reply_to_email');?>
                    <?php echo $form->textField($server, 'reply_to_email', $server->getHtmlOptions('reply_to_email')); ?>
                    <?php echo $form->error($server, 'reply_to_email');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($server, 'force_reply_to');?>
                    <?php echo $form->dropDownList($server, 'force_reply_to', $server->getForceReplyToOptions(), $server->getHtmlOptions('force_reply_to')); ?>
                    <?php echo $form->error($server, 'force_reply_to');?>
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
                <div class="col-lg-12">
                    <?php $this->renderPartial('_customer', compact('form'));?> 
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="col-lg-12">
                    <?php $this->renderPartial('_policies', compact('form'));?> 
                </div>
                <div class="clearfix"><!-- --></div>    
                <div class="col-lg-12">   
                    <?php $this->renderPartial('_additional-headers');?>  
                </div>   
                <div class="clearfix"><!-- --></div>                              
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <?php 
        $this->endWidget(); 
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));

}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));