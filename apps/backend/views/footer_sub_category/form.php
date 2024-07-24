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
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
                    <?php echo $form->labelEx($model, 'parent_master');?>
                    <?php echo $form->dropDownList($model, 'parent_master',CHtml::listData(Master::model()->findAllByAttributes(array('category_id'=>'1')),'master_id','master_name'),$model->getHtmlOptions('parent_master',array('empty'=>'Select Category'))); ?>
                    <?php echo $form->error($model, 'parent_master');?>
                </div>        
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'master_name');?>
                    <?php echo $form->textField($model, 'master_name',$model->getHtmlOptions('master_name')); ?>
                    <?php echo $form->error($model, 'master_name');?>
                </div>        
                   
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'status');?>
                    <?php echo $form->dropDownList($model, 'status',array('A'=>'Active','I'=>'Inactive'),$model->getHtmlOptions('status')); ?>
                    <?php echo $form->error($model, 'status');?>
                </div>        
            
                
				<div class="clearfix"><!-- --></div> 
				<?php /* 
				<div class="form-group col-lg-12">
				<?php echo $form->labelEx($model, 'categories');?>
				<?php echo $form->checkbox($model, 'a');?>All
				<div class="container34">
				<?php
				$amenities_array=	 CHtml::listData(MainCategory::model()->ListData(),'category_id','category_name');
				if(!Yii::app()->request->isPostRequest){
					$model->categories = $model->cList;
				}
				echo CHtml::checkBoxList('categories',$model->categories ,$amenities_array);                                              
				?>
				</div>
				<?php echo $form->error($model, 'categories');?>
				</div>     
                <div class="clearfix"><!-- --></div>
                <?php /*  
                <div class="form-group col-lg-12">
				<?php echo $form->labelEx($model, 'subcategories');?>
				<?php echo $form->checkbox($model, 'b');?>All
				<div class="container34">
				<?php
				$amenities_array=	 CHtml::listData(Category::model()->ListData(),'category_id','category_name');
				if(!Yii::app()->request->isPostRequest){
					$model->subcategories = $model->sList;
				}
				echo CHtml::checkBoxList('subcategories',$model->subcategories ,$amenities_array);                                              
				?>
				</div>
				<?php echo $form->error($model, 'subcategories');?>
				</div>        
				* */
				?>
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
