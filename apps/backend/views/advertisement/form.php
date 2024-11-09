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
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
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
                    <?php echo $form->labelEx($model, 'advertising_title');?>
                    <?php echo $form->textField($model, 'advertising_title',$model->getHtmlOptions('advertising_title')); ?>
                    <?php echo $form->error($model, 'advertising_title');?>
                </div>   
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'max_items');?>
                    <?php echo $form->textField($model, 'max_items',$model->getHtmlOptions('max_items')); ?>
                    <?php echo $form->error($model, 'max_items');?>
                </div>   
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'position_banner');?>
                    <?php echo $form->dropDownList($model, 'position_banner',$model->banner_positon(),$model->getHtmlOptions('position_banner',array('empty'=>'Select'))); ?>
                    <?php echo $form->error($model, 'position_banner');?>
                </div>   
               
                <div class="clearfix"><!-- --></div>        
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($model, 'layout');?>
                    <div class="clearfix"><!-- --></div>
                    <div>
						 <?php
                    if($model->position_banner!='T'){ ?>
                    <div style="width:300px;height:300px;float:left;">
						<div><h3>  <?php echo $form->radioButton($model, 'layout',$model->getHtmlOptions('layout',array('value'=>'R1', 'uncheckValue'=>null,'style'=>'width:20px;height:auto;float:left;'))); ?> Rows 1 </h3></div>
                    <div  style="background-color:#edf0f2;background-image:url('<?php echo Yii::app()->apps->getBaseUrl('uploads/layout_image/rows_1.png');?>');background-position:center center;background-size:contain;width: 100%;height: 250px;background-repeat: no-repeat;" ></div>
                    </div>
                    <div style="width:300px;height:300px;float:left;margin-left:20px;">
						<div><h3><?php echo $form->radioButton($model, 'layout',$model->getHtmlOptions('layout',array('value'=>'R2', 'uncheckValue'=>null,'style'=>'width:20px;height:auto;float:left;'))); ?> Rows 2 </h3></div>
                    <div  style="background-color:#edf0f2;background-image:url('<?php echo Yii::app()->apps->getBaseUrl('uploads/layout_image/rows_2.png');?>');background-position:center center;background-size:contain;width: 100%;height: 250px;background-repeat: no-repeat;" ></div>
                    </div>
                    <div style="width:300px;height:300px;float:left;margin-left:20px;">
							<div><h3><?php echo $form->radioButton($model, 'layout',$model->getHtmlOptions('layout',array('value'=>'R2M1', 'uncheckValue'=>null,'style'=>'width:20px;height:auto;float:left;'))); ?>Rows 2 Middle 1 </h3></div>
						  <div  style="background-color:#edf0f2;background-image:url('<?php echo Yii::app()->apps->getBaseUrl('uploads/layout_image/rows_2_middle_1.png');?>');background-position:center center;background-size:contain;width: 100%;height:250px;background-repeat: no-repeat;" ></div>
                    </div>
                    <?php } ?>
                    <?php
                    if($model->position_banner=='T'){ ?>
                    <div style="width:300px;height:300px;float:left;margin-left:20px;">
							<div><h3><?php echo $form->radioButton($model, 'layout',$model->getHtmlOptions('layout',array('value'=>'R1S', 'uncheckValue'=>null,'style'=>'width:20px;height:auto;float:left;'))); ?>Rows 1 Full Slider [Support only home page Top Banner] </h3></div>
						  <div  style="background-color:#edf0f2;background-image:url('<?php echo Yii::app()->apps->getBaseUrl('uploads/layout_image/r1_slider.png');?>');background-position:center center;background-size:contain;width: 100%;height:250px;background-repeat: no-repeat;" ></div>
                    </div>
                    <?php } ?>
                     <div class="clearfix"><!-- --></div>
                    </div>
                     <div class="clearfix"><!-- --></div>
                    <?php echo $form->error($model, 'layout');?>
                </div>   
               <div style="width:100%;"></div>
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
