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
                    <?php echo $form->labelEx($model, 'tag_name');?>
                    <?php echo $form->textField($model, 'tag_name',$model->getHtmlOptions('tag_name')); ?>
                    <?php echo $form->error($model, 'tag_name');?>
                </div>   
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'tag_sub_title');?>
                    <?php echo $form->textField($model, 'tag_sub_title',$model->getHtmlOptions('tag_sub_title')); ?>
                    <?php echo $form->error($model, 'tag_sub_title');?>
                </div>   
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'color_code');?>
                    <?php echo $form->textField($model, 'color_code',$model->getHtmlOptions('color_code')); ?>
                    <?php echo $form->error($model, 'color_code');?>
                </div>   
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'priority');?>
                    <?php echo $form->textField($model, 'priority',$model->getHtmlOptions('priority')); ?>
                    <?php echo $form->error($model, 'priority');?>
                </div>   
                <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'tag_type');?>
                    <?php echo $form->dropDownList($model, 'tag_type',$model->getTagType(),$model->getHtmlOptions('tag_type')); ?>
                    <?php echo $form->error($model, 'tag_type');?>
                </div>   
                <?php /*
                <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'limit_p');?>
                    <?php echo $form->textField($model, 'limit_p',$model->getHtmlOptions('limit_p')); ?>
                    <?php echo $form->error($model, 'limit_p');?>
                </div>   
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'now_of_rows');?>
                    <?php echo $form->dropDownList($model, 'now_of_rows',$model->arrayList(),$model->getHtmlOptions('now_of_rows')); ?>
                    <?php echo $form->error($model, 'now_of_rows');?>
                </div>   
             
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'used_in_section');?>
                    <div class="clearfix"></div>
                    <?php
                    if(!Yii::app()->request->isPostRequest and !$model->isNewRecord){
                    $model->used_in_section =  CHtml::listData(TagSection::model()->findAllByAttributes(array('tag_id'=>$model->tag_id)),'section_id','section_id');
					}
echo $form->checkBoxList(
                $model,
                'used_in_section',
                CHtml::listData(Section::model()->listData(),'section_id','section_name'),
                array(
                    'template'=>'{input}{label}',
                    'separator'=>'',
                    'labelOptions'=>array(
                        'style'=>'
                        padding-left:13px; margin-right:13px;
                        width: auto;
                        float: left;'
                        ),
                    'style'=>'float:left;',
                )                              
            );
?>
                    <?php echo $form->error($model, 'used_in_section');?>
                </div>   
                    <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'enable_all');?>
                    <?php echo $form->checkbox($model, 'enable_all',$model->arrayList(),$model->getHtmlOptions('enable_all')); ?>
                    <?php echo $form->error($model, 'enable_all');?>
                </div>  
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($model, 'used_in_category');?>
                    <div class="clearfix"></div>
                    <?php
                    if(!Yii::app()->request->isPostRequest and !$model->isNewRecord){
                    $model->used_in_category =  CHtml::listData(TagCategory::model()->findAllByAttributes(array('tag_id'=>$model->tag_id)),'category_id','category_id');
					}
echo $form->checkBoxList(
                $model,
                'used_in_category',
                CHtml::listData(Category::model()->listData(),'category_id','category_name'),
                array(
                    'template'=>'{input}{label}',
                    'separator'=>'',
                    'labelOptions'=>array(
                        'style'=>'
                        padding-left:13px; margin-right:13px;
                        width: auto;
                        float: left;'
                        ),
                    'style'=>'float:left;',
                )                              
            );
?>
                    <?php echo $form->error($model, 'used_in_category');?>
                </div>   
               
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($model, 'used_in_type');?>
                    <div class="clearfix"></div>
                    <?php
                    if(!Yii::app()->request->isPostRequest and !$model->isNewRecord){
                    $model->used_in_type =  CHtml::listData(TagType::model()->findAllByAttributes(array('tag_id'=>$model->tag_id)),'type_id','type_id');
					}
echo $form->checkBoxList(
                $model,
                'used_in_type',
               array('R'=>'Residential','C'=>'Commercial') ,
                array(
                    'template'=>'{input}{label}',
                    'separator'=>'',
                    'labelOptions'=>array(
                        'style'=>'
                        padding-left:13px; margin-right:13px;
                        width: auto;
                        float: left;'
                        ),
                    'style'=>'float:left;',
                )                              
            );
?>
                    <?php echo $form->error($model, 'used_in_type');?>
                </div>   
                * */
                ?>
               
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
