<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.4
 */
 
/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('views_before_content', $viewCollection = new CAttributeCollection(array(
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
    $hooks->doAction('views_before_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off')));  
        ?>
        <div class="box box-primary borderless">
            <div class="card-header">
        		<div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
        		<div class="pull-right">
                       <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
               
        		</div>
        	</div>
            <div class="card-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('views_before_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
                <div class="">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'code');?>
                            <?php echo $form->textField($promoCode, 'code', $promoCode->getHtmlOptions('code')); ?>
                            <?php echo $form->error($promoCode, 'code');?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'type');?>
                            <?php echo $form->dropDownList($promoCode, 'type', $promoCode->getTypesList(), $promoCode->getHtmlOptions('type')); ?>
                            <?php echo $form->error($promoCode, 'type');?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'discount');?>
                            <?php echo $form->textField($promoCode, 'discount', $promoCode->getHtmlOptions('discount')); ?>
                            <?php echo $form->error($promoCode, 'discount');?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'total_amount');?>
                            <?php echo $form->textField($promoCode, 'total_amount', $promoCode->getHtmlOptions('total_amount')); ?>
                            <?php echo $form->error($promoCode, 'total_amount');?>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'total_usage');?>
                            <?php echo $form->textField($promoCode, 'total_usage', $promoCode->getHtmlOptions('total_usage')); ?>
                            <?php echo $form->error($promoCode, 'total_usage');?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'customer_usage');?>
                            <?php echo $form->textField($promoCode, 'customer_usage', $promoCode->getHtmlOptions('customer_usage')); ?>
                            <?php echo $form->error($promoCode, 'customer_usage');?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'date_start');?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model'     => $promoCode,
                                'attribute' => 'date_start',
                                'language'  => $promoCode->getDatePickerLanguage(),
                                'cssFile'   => null,
                                'options'   => array(
                                   
                                    'dateFormat'    => $promoCode->getDatePickerFormat(),
                                ),
                                'htmlOptions'=>$promoCode->getHtmlOptions('date_start',array('autocomplete'=>'off')),
                            ));
                            ?>
                            <?php echo $form->error($promoCode, 'date_start');?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'date_end');?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                'model'     => $promoCode,
                                'attribute' => 'date_end',
                                'language'  => $promoCode->getDatePickerLanguage(),
                                'cssFile'   => null,
                                'options'   => array(
                                    
                                    'dateFormat'    => $promoCode->getDatePickerFormat(),
                                ),
                                'htmlOptions'=>$promoCode->getHtmlOptions('date_end',array('autocomplete'=>'off')),
                            ));
                            ?>
                            <?php echo $form->error($promoCode, 'date_end');?>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="col-lg-3">
                        <?php echo $form->labelEx($promoCode, 'status');?>
                        <?php echo $form->dropDownList($promoCode, 'status', $promoCode->getStatusesList(), $promoCode->getHtmlOptions('status')); ?>
                        <?php echo $form->error($promoCode, 'status');?>
                    </div>
                                  <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'assigned_to');?>
                            <?php echo $form->dropDownList($promoCode, 'assigned_to',CHtml::listData(User::model()->allAssigned(),'user_id','fullName'), $promoCode->getHtmlOptions('assigned_to',array('empty'=>'Please Select'))); ?>
                            <?php echo $form->error($promoCode, 'assigned_to');?>
                        </div>
                    </div>
        <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'plan_id');?>
                            <?php echo $form->hiddenField($promoCode, 'plan_id', $promoCode->getHtmlOptions('plan_id')); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                                'name'          => 'plan',
                                'value'         => !empty($promoCode->plan_id) ? $promoCode->plan->package_name : '',
                                'source'        => $this->createUrl('package/autocomplete',array('offer'=>'1')),
                                'cssFile'       => false,
                                'options'       => array(
                                    'minLength' => '0',
                                    'select'    => 'js:function(event, ui) {
                                $("#'.CHtml::activeId($promoCode, 'plan_id').'").val(ui.item.plan_id);
                            }',
                                    'search'    => 'js:function(event, ui) {
                                $("#'.CHtml::activeId($promoCode, 'plan_id').'").val("");
                            }',
                                    'change'    => 'js:function(event, ui) {
                                if (!ui.item) {
                                    $("#'.CHtml::activeId($promoCode, 'plan_id').'").val("");
                                }
                            }',
                                ),
                                'htmlOptions'   => $promoCode->getHtmlOptions('plan_id'),
                            ));
                            ?>
                            <?php echo $form->error($promoCode, 'plan_id');?>
                        </div>
                    </div>
             
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'offer_title');?>
                            <?php echo $form->textField($promoCode, 'offer_title', $promoCode->getHtmlOptions('offer_title')); ?>
                            <?php echo $form->error($promoCode, 'offer_title');?>
                        </div>
                    </div>
                     <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo $form->labelEx($promoCode, 'offer_title_ar');?>
                            <?php echo $form->textField($promoCode, 'offer_title_ar', $promoCode->getHtmlOptions('offer_title_ar')); ?>
                            <?php echo $form->error($promoCode, 'offer_title_ar');?>
                        </div>
                    </div>
              
             
                </div>
                <?php 
                /**
                 * This hook gives a chance to append content after the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('views_after_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>    
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-footer">
    			<div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-flat"><?php echo   Yii::t('app', 'Save changes');?></button>
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
    $hooks->doAction('views_after_form', new CAttributeCollection(array(
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
$hooks->doAction('views_after_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
