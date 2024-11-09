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
                    <?php echo $form->labelEx($model, 'package_name');?><?php echo $model->getTranslateHtml('package_name');?>
                    <?php echo $form->textField($model, 'package_name',$model->getHtmlOptions('package_name')); ?>
                    <?php echo $form->error($model, 'package_name');?>
                </div>  
                  <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'category');?>
                    <?php echo $form->dropDownList($model, 'category', $model->castegoryPackage() ,$model->getHtmlOptions('category',array('empty'=>'Select Category')) ); ?>
                    <?php echo $form->error($model, 'category');?>
                </div> 
               
               <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'p_type');?>
                    <?php echo $form->dropDownList($model, 'p_type', $model->p_typePackage() ,$model->getHtmlOptions('p_type',array('empty'=>'Select Type')) ); ?>
                    <?php echo $form->error($model, 'p_type');?>
                </div>  
                <div class="clearfix"><!-- --></div>
              
                
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-2">
                    <?php echo $form->labelEx($model, 'price_per_month');?>
                    <?php echo $form->textField($model, 'price_per_month',$model->getHtmlOptions('price_per_month')); ?>
                    <?php echo $form->error($model, 'price_per_month');?>
                </div>  
                <div class="form-group col-lg-2">
                    <?php echo $form->labelEx($model, 'currency_id');
                    if(empty($this->currency_id) and !Yii::app()->request->isPostRequest){
						$model->currency_id = 3;
					}
                    
                    ?>
                    <?php echo $form->dropDownList($model,'currency_id',CHtml::listData(Currency::model()->listDataCurrency(),'currency_id','code'),$model->getHtmlOptions('currency_id',array('empty'=>'Please Select'))); ?>
                    <?php echo $form->error($model, 'currency_id');?>
                </div>   
                 <div class="form-group col-lg-2">
                    <?php echo $form->labelEx($model, 'validity_in_days');?>
                    <?php echo $form->dropDownList($model, 'validity_in_days',$model->getListingPackageMonthly(),$model->getHtmlOptions('validity_in_days',array('empty'=>'Select'))); ?>
                    <?php echo $form->error($model, 'validity_in_days');?>
                </div>   
                   <div class="form-group col-lg-2">
                    <?php echo $form->labelEx($model, 'status');?>
                    <?php echo $form->dropDownList($model, 'status',array('A'=>'Active','I'=>'Inactive'),$model->getHtmlOptions('status')); ?>
                    <?php echo $form->error($model, 'status');?>
                </div>   
                 <div class="form-group col-lg-2">
                    <?php echo $form->labelEx($model, 'tag');?>
                    <?php echo $form->dropDownList($model, 'tag',$model->tag_Array(),$model->getHtmlOptions('tag')); ?>
                    <?php echo $form->error($model, 'tag');?>
                </div>   
                <div class="form-group col-lg-2">
                    <?php echo $form->labelEx($model, 'call_of_action');?><?php echo $model->getTranslateHtml('call_of_action');?>
                    <?php echo $form->textField($model, 'call_of_action' ,$model->getHtmlOptions('call_of_action')); ?>
                    <?php echo $form->error($model, 'call_of_action');?>
                </div>   
                   <div class="form-group col-lg-2">
                    <?php echo $form->labelEx($model, 'is_book');?> 
                    <?php echo $form->checkbox($model, 'is_book' ,$model->getHtmlOptions('is_book')); ?>
                    <?php echo $form->error($model, 'is_book');?>
                </div>   
                <div class="clearfix"><!-- --></div>
                   <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'description');?><?php echo $model->getTranslateHtml('description');?>
                    <?php echo $form->textArea($model, 'description',$model->getHtmlOptions('description')); ?>
                    <?php echo $form->error($model, 'description');?>
                </div>  
                <div class="clearfix"><!-- --></div>
                     <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'max_listing_per_day');?><span class="pull-right"> 0 Unlimited</span>
                    <?php echo $form->textField($model, 'max_listing_per_day',$model->getHtmlOptions('max_listing_per_day')); ?>
                    <?php echo $form->error($model, 'max_listing_per_day');?>
                </div>   
                     <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'no_of_featured');?>
                    <?php echo $form->textField($model, 'no_of_featured',$model->getHtmlOptions('no_of_featured')); ?>
                    <?php echo $form->error($model, 'no_of_featured');?>
                </div>   
               
           
                <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'no_of_users');?>
                    <?php echo $form->textField($model, 'no_of_users', $model->getHtmlOptions('no_of_users')); ?>
                    <?php echo $form->error($model, 'no_of_users');?>
                </div>   
               
           
               
                <div class="clearfix"><!-- --></div>        
                       
                <div class="clearfix"><!-- --></div>        
                           <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'valuation');?>
                    <?php echo $form->dropDownList($model, 'valuation',array('0'=>'No','1'=>'Yes'),$model->getHtmlOptions('valuation')); ?>
                    <?php echo $form->error($model, 'valuation');?>
                </div>   
                           <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'photography');?>
                    <?php echo $form->dropDownList($model, 'photography',array('0'=>'No','1'=>'Yes'),$model->getHtmlOptions('photography')); ?>
                    <?php echo $form->error($model, 'photography');?>
                </div>   
                           <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'campain');?>
                    <?php echo $form->dropDownList($model, 'campain',array('0'=>'No','1'=>'Yes'),$model->getHtmlOptions('campain')); ?>
                    <?php echo $form->error($model, 'campain');?>
                </div>   
                           <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'seo');?>
                    <?php echo $form->dropDownList($model, 'seo',array('0'=>'No','1'=>'Yes'),$model->getHtmlOptions('seo')); ?>
                    <?php echo $form->error($model, 'seo');?>
                </div>   
                           <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'blog');?>
                    <?php echo $form->dropDownList($model, 'blog',array('0'=>'No','1'=>'Yes'),$model->getHtmlOptions('blog')); ?>
                    <?php echo $form->error($model, 'blog');?>
                </div>   
                           <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'banners');?>
                    <?php echo $form->dropDownList($model, 'banners',array('0'=>'No','1'=>'Yes'),$model->getHtmlOptions('banners')); ?>
                    <?php echo $form->error($model, 'banners');?>
                </div>   
                           <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'floor');?>
                    <?php echo $form->dropDownList($model, 'floor',array('0'=>'No','1'=>'Yes'),$model->getHtmlOptions('floor')); ?>
                    <?php echo $form->error($model, 'floor');?>
                </div>   
               <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, 'email_campain');?>
                    <?php echo $form->dropDownList($model, 'email_campain',array('0'=>'No','1'=>'Yes'),$model->getHtmlOptions('email_campain')); ?>
                    <?php echo $form->error($model, 'email_campain');?>
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
