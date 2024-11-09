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
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus))); 
        ?>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                 
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'name');?>
                    <?php echo $form->textField($model, 'name',$model->getHtmlOptions('name')); ?>
                    <?php echo $form->error($model, 'name');?>
                </div>   
               
             
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'show_on_order_form');?>
                    <?php echo $form->checkBox($model,'show_on_order_form',array('value'=>1,'uncheckValue'=>0,'checked'=>($model->show_on_order_form=="1")?true:false,'style'=>'')); ?>
                    <?php echo $form->error($model, 'show_on_order_form');?>
                </div>   
                
             
                <div class="clearfix"><!-- --></div>  
                                <div class="clearfix"><!-- --></div>
				<?php
				switch($model->id)
				{
				 case 1:
					?>
					
				<div class="clearfix"><!-- --></div>
				<div class="form-group col-lg-6">
					<?php echo $form->labelEx($model, 'paypal_email');?>
					<?php echo $form->textField($model, 'paypal_email',$model->getHtmlOptions('paypal_email')); ?>
					<?php echo $form->error($model, 'paypal_email');?>
				</div>    
                
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-7">
                    <?php echo $form->labelEx($model, 'force_one_time_payments');?>
                    <?php echo $form->checkBox($model,'force_one_time_payments',array('value'=>1,'uncheckValue'=>0,'checked'=>($model->force_one_time_payments=="1")?true:false,'style'=>'')); ?> &nbsp; Never show the payment button.
                    <?php echo $form->error($model, 'force_one_time_payments');?>
                </div>   
                
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-7">
                    <?php echo $form->labelEx($model, 'force_subscriptions');?>
                    <?php echo $form->checkBox($model,'force_subscriptions',array('value'=>1,'uncheckValue'=>0,'checked'=>($model->force_subscriptions=="1")?true:false,'style'=>'')); ?>&nbsp; Hide the one time payment button when the subscription can be created.
                    <?php echo $form->error($model, 'force_subscriptions');?>
                </div>   
                 
                 <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-7">
                    <?php echo $form->labelEx($model, 'require_shipping_address');?>
                    <?php echo $form->checkBox($model,'require_shipping_address',array('value'=>1,'uncheckValue'=>0,'checked'=>($model->require_shipping_address=="1")?true:false,'style'=>'')); ?>&nbsp; Tick this box to require a shipping address from user on PayPal's site.
                    <?php echo $form->error($model, 'require_shipping_address');?>
                </div>   
                
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-8">
                    <?php echo $form->labelEx($model, 'client_addres_matching');?>
                    <?php echo $form->checkBox($model,'client_addres_matching',array('value'=>1,'uncheckValue'=>0,'checked'=>($model->client_addres_matching=="1")?true:false,'style'=>'')); ?>&nbsp;Tick this box to force using cloient profile information entered into WHMC's at PayPal.
                    <?php echo $form->error($model, 'client_addres_matching');?>
                </div>         
                
                <div class="clearfix"><!-- --></div>  
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'api_username');?>
                    <?php echo $form->textField($model, 'api_username',$model->getHtmlOptions('api_username')); ?>
                    <?php echo $form->error($model, 'api_username');?>
                </div> 
                 <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'api_password');?>
                    <?php echo $form->textField($model, 'api_password',$model->getHtmlOptions('api_password')); ?>
                    <?php echo $form->error($model, 'api_password');?>
                </div> 
                 <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'api_signature');?>
                    <?php echo $form->textField($model, 'api_signature',$model->getHtmlOptions('api_signature')); ?>
                    <?php echo $form->error($model, 'api_signature');?>
                </div> 
                <?php
				 break;
				case 2:
				 
					?>
				<div class="clearfix"><!-- --></div>
				<div class="form-group col-lg-6">
				<?php echo $form->labelEx($model, 'bank_transfer_instructions');?>
				<?php echo $form->textArea($model, 'bank_transfer_instructions',$model->getHtmlOptions('bank_transfer_instructions')); ?>
				<?php echo $form->error($model, 'bank_transfer_instructions');?>
				</div> 
					
					<?
				 break;
				 default:
				 break;
			 }
				 
			?>
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
