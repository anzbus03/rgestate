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
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($user,'hotel_name'))); 
        ?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$user->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array('listingusers/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array('listingusers/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
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
							<?php echo $form->labelEx($user, 'first_name');?>
							<?php echo $form->textField($user, 'first_name', $user->getHtmlOptions('first_name')); ?>
							<?php echo $form->error($user, 'first_name');?>
							</div> 
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'last_name');?>
							<?php echo $form->textField($user, 'last_name', $user->getHtmlOptions('last_name')); ?>
							<?php echo $form->error($user, 'last_name');?>
							</div> 
							<div class="clearfix"><!-- --></div>
							
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'address');?>
							<?php echo $form->textField($user, 'address', $user->getHtmlOptions('address')); ?>
							<?php echo $form->error($user, 'address');?>
							</div> 
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'city');?>
							<?php echo $form->textField($user, 'city', $user->getHtmlOptions('city')); ?>
							<?php echo $form->error($user, 'city');?>
							</div> 
						    
						    <div class="clearfix"><!-- --></div>
						    
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'state');?>
							<?php echo $form->textField($user, 'state', $user->getHtmlOptions('state')); ?>
							<?php echo $form->error($user, 'state');?>
							</div> 
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'country_id');?>
							 <?php $mer =  array('empty'=>'Select Country',"class"=>"form-control") ; ?>
                             <?php echo $form->dropDownList($user, 'country_id', CHtml::listData(Countries::model()->Countrylist(),'country_id','country_name'), $mer); ?>
							<?php echo $form->error($user, 'country_id');?>
							</div> 
						    <div class="clearfix"><!-- --></div>
						    
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'zip');?>
							<?php echo $form->textField($user, 'zip', $user->getHtmlOptions('zip')); ?>
							<?php echo $form->error($user, 'zip');?>
							</div> 
							<div class="form-group col-lg-6">
							 <?php echo $form->labelEx($user, 'phone');?>
							<?php echo $form->textField($user, 'phone', $user->getHtmlOptions('phone')); ?>
							<?php echo $form->error($user, 'phone');?>
							</div> 
						    <div class="clearfix"><!-- --></div>
						    
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'fax');?>
							<?php echo $form->textField($user, 'fax', $user->getHtmlOptions('fax')); ?>
							<?php echo $form->error($user, 'fax');?>
							</div> 
							<div class="form-group col-lg-6">
							 <?php echo $form->labelEx($user, 'email');?>
							<?php echo $form->textField($user, 'email', $user->getHtmlOptions('email')); ?>
							<?php echo $form->error($user, 'email');?>
							</div> 
						    
						    <div class="clearfix"><!-- --></div>
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'password');?>
							<?php echo $form->passwordField($user, 'password', $user->getHtmlOptions('password')); ?>
							<?php echo $form->error($user, 'password');?>
							</div> 
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'con_password');?>
							<?php echo $form->passwordField($user, 'con_password', $user->getHtmlOptions('con_password')); ?>
							<?php echo $form->error($user, 'con_password');?>
							</div> 
                <div class="clearfix"><!-- --></div>  
                 <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($user, 'status');?>
                    <?php echo $form->dropDownList($user, 'status', array('A'=>'Active','I'=>'Inactive'), $user->getHtmlOptions('status')); ?>
                    <?php echo $form->error($user, 'status');?>
                </div>  
                <div class="clearfix"><!-- --></div>  
                  
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
