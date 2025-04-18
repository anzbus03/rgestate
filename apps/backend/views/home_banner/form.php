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
      //  $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus) , 'htmlOptions' => array('enctype' => 'multipart/form-data'),)); 
        ?>
        <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'miscellaneous-pages-form',
        'enableAjaxValidation'=>false,
'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
    }

    .card-header-left {
        flex: 1;
    }

    .card-header-right {
        display: flex;
        gap: 10px;
    }

    .card-header-right .btn {
        margin-left: 5px;
    }
</style>
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
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
              
               <div class="row">
                    <div class="form-group col-lg-6">
                        <?php echo $form->labelEx($model, 'f_type');?>
                        <div class="clearfix"><!-- --></div>
                        <?php echo $form->dropDownList($model, 'f_type',$model->bannerList(),$model->getHtmlOptions('f_type')); ?>
                        <?php echo $form->error($model, 'f_type');?>
                    </div>   
                   <div class="forImage"   >    
                       <div class="clearfix"><!-- --></div>
                       <div class="form-group col-lg-6">
                           <?php echo $form->labelEx($model, 'image');?><span class="pull-right">Banner  Size: 1948px X663px </span>
                           <div class="clearfix"><!-- --></div>
                           <?php echo $form->fileField($model, 'image',$model->getHtmlOptions('image')); ?>
                           <?php echo $form->error($model, 'image');?>
                       </div>   
                      <?php
                       if(!Yii::app()->request->isPostRequest and !empty($model->image)){ ?> 
                       <div class="col-sm-2"><img src="<?php echo Yii::app()->apps->getBaseUrl('uploads/files/'. $model->image);?>" style="width:100%;" /></div>
                       <?php } ?>
                       <div class="clearfix"><!-- --></div>
                       <div class="form-group col-lg-6">
                           <?php echo $form->labelEx($model, 'title');?><span class="pull-right">Banner  Size: 540px ×773px</span>
                           <div class="clearfix"><!-- --></div>
                           <?php echo $form->fileField($model, 'title',$model->getHtmlOptions('title')); ?>
                           <?php echo $form->error($model, 'title');?>
                       </div>   
                          <?php
                       if(!Yii::app()->request->isPostRequest and !empty($model->title)){ ?> 
                       <div class="col-sm-2"><img src="<?php echo Yii::app()->apps->getBaseUrl('uploads/files/'. $model->title);?>" style="width:100%;" /></div>
                       <?php } ?>
                       <div class="clearfix"><!-- --></div>
                   
                           <div class="clearfix"><!-- --></div>
                       <div class="form-group col-lg-6">
                           <?php echo $form->labelEx($model, 'status');?>
                           <div class="clearfix"><!-- --></div>
                           <?php echo $form->dropDownList($model, 'status',$model->statusArray(),$model->getHtmlOptions('status')); ?>
                           <?php echo $form->error($model, 'status');?>
                       </div>   
                         <?php
                         $model->country_id = empty($model->country_id) ? '66124' : $model->country_id; ?>
                           <div class="clearfix"><!-- --></div>
                       <div class="form-group col-lg-6">
                           <?php echo $form->labelEx($model, 'country_id');?>
                           <div class="clearfix"><!-- --></div>
                           <?php echo $form->dropDownList($model, 'country_id',CHtml::listData(Countries::model()->listingCountries(),'country_id','country_name'),$model->getHtmlOptions('country_id',array('empty'=>'Please Select'))); ?>
                           <?php echo $form->error($model, 'country_id');?>
                       </div>   
                         
                      
                       <div class="clearfix"><!-- --></div>     
                   </div>   
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
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" style="margin: 20px;" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
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
