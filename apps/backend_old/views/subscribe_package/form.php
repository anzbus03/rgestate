<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
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
        $form = $this->beginWidget('CActiveForm'); ?>
        <div class="box box-primary  ">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/'.$index), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
                <div class="">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($order, 'user_id');?>
                            <?php echo $form->hiddenField($order, 'user_id', $order->getHtmlOptions('user_id')); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                                'name'          => 'customer',
                                'value'         => !empty($order->user_id) ? $order->user->getFullName() : '',
                                'source'        => $this->createUrl('listingusers/autocomplete'),
                                'cssFile'       => false,
                                'options'       => array(
                                    'minLength' => '2',
                                    'select'    => 'js:function(event, ui) {
                                $("#'.CHtml::activeId($order, 'user_id').'").val(ui.item.customer_id);
                            }',
                                    'search'    => 'js:function(event, ui) {
                                $("#'.CHtml::activeId($order, 'user_id').'").val("");
                            }',
                                    'change'    => 'js:function(event, ui) {
                                if (!ui.item) {
                                    $("#'.CHtml::activeId($order, 'user_id').'").val("");
                                }
                            }',
                                ),
                                'htmlOptions'   => $order->getHtmlOptions('user_id'),
                            ));
                            ?>
                            <?php echo $form->error($order, 'user_id');?>
                        </div>
                    </div>
                   <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($order, 'package_id');?>
                            <?php echo $form->hiddenField($order, 'package_id', $order->getHtmlOptions('package_id')); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                                'name'          => 'plan',
                                'value'         => !empty($order->package_id) ? $order->package->packageTitle2 : '',
                                'source'        => $this->createUrl('package/autocomplete'),
                                'cssFile'       => false,
                                'options'       => array(
                                    'minLength' => '0',
                                    'select'    => 'js:function(event, ui) {
                                $("#'.CHtml::activeId($order, 'package_id').'").val(ui.item.package_id);
                            }',
                                    'search'    => 'js:function(event, ui) {
                                $("#'.CHtml::activeId($order, 'package_id').'").val("");
                            }',
                                    'change'    => 'js:function(event, ui) {
                                if (!ui.item) {
                                    $("#'.CHtml::activeId($order, 'package_id').'").val("");
                                }
                            }',
                                ),
                                'htmlOptions'   => $order->getHtmlOptions('package_id'),
                            ));
                            ?>
                            <?php echo $form->error($order, 'package_id');?>
                        </div>
                    </div>
              
              <?php
                 	if(AccessHelper::hasRouteAccess ('subscribe_package/update_status')){ ?>     
                 <div class="">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($order, 'status');?>
                            <?php echo $form->dropDownList($order, 'status', $order->getStatusesList(), $order->getHtmlOptions('status')); ?>
                            <?php echo $form->error($order, 'status');?>
                        </div>
                    </div>
                </div>
                <?php } ?> 
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
            </div>
            <div class="clearfix"></div>
            </div>
           
         
            <div class="box-footer">
                <div class="pull-right">
              
                    <button type="submit" class="btn btn-primary btn-flat"><?php echo   Yii::t('app', 'Save changes');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <!-- modals -->
        <div class="modal modal-info fade" id="page-info" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?php  Yii::t('app',  'Info');?></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo Yii::t('orders', 'Please note that any order added/changed from this area is not verified nor it goes through a payment gateway.');?><br />
                        <?php echo Yii::t('orders', 'Updating orders from this area is useful for offline orders mostly or for payment corrections.');?><br />
                        <?php echo Yii::t('orders', 'If the order is incomplete, pending or due and changed to complete, the customer will be affected and the price plan will be assigned properly.');?><br />
                    </div>
                </div>
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
