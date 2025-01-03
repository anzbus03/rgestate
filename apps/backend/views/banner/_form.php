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
        <div class="card">
            <div class="card-header"">
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

				<div class="form-group col-lg-6 hidden">
				<?php echo $form->labelEx($model,'ad_type'); ?>
				<br />
				<?php echo $form->radioButton($model,'ad_type',array('value'=>'adSense','uncheckValue'=>null, 'onClick'=> "$('.forImage').hide();$('.forScript').show();")) . ' Script'; ?>
				<?php echo $form->radioButton($model,'ad_type',array('value'=>'adImage','uncheckValue'=>null, 'onClick'=> "$('.forScript').hide();$('.forImage').show();")) . ' Image'; ?>
				<?php echo $form->error($model,'ad_type'); ?>
				</div>     
				
				
                <div class="clearfix"><!-- --></div>
				<div class="form-group col-lg-12">
				<?php echo $form->labelEx($model, 'title');?>
				<?php echo $form->textField($model, 'title',$model->getHtmlOptions('title')); ?>
				<?php echo $form->error($model, 'title');?>
				</div>  
                <div class="clearfix"><!-- --></div>
				<div class="form-group col-lg-12">
				<?php echo $form->labelEx($model, 'description');?>
				<?php echo $form->textArea($model, 'description',$model->getHtmlOptions('description',array('rows'=>'4'))); ?>
				<?php echo $form->error($model, 'description');?>
				</div>  
                <div class="clearfix"><!-- --></div>
                    
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'position_id');?> 
                      <?php $dropdwn =   array_merge( $model->getHtmlOptions('position_id'),array('empty'=>'Select Position ',"style"=>"1")) ;  ?> 
                    <?php echo $form->dropDownList($model,'position_id',CHtml::listData(BannerPosition::model()->listData(),"position_id" ,"position_name"), $dropdwn  ); ?>
                   
                             <?php echo $form->error($model, 'position_id');?>
                </div>   
                    <div class="clearfix"><!-- --></div>
                <div class="forImage" style="<?php echo  ($model->ad_type=='adImage') ? '' : 'display:none;' ;  ?>" >    
					<div class="clearfix"><!-- --></div>
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model, 'image');?>
						<?php echo $form->fileField($model, 'image',$model->getHtmlOptions('image')); ?>
						<?php echo $form->error($model, 'image');?>
					</div>   
				   
					<div class="clearfix"><!-- --></div>        
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model, 'link_url');?>
						<?php echo $form->textField($model, 'link_url',$model->getHtmlOptions('link_url')); ?>
						<?php echo $form->error($model, 'link_url');?>
					</div>   
				   
					<div class="clearfix"><!-- --></div>     
                </div>   
                <div class="forScript"  style="<?php echo   ($model->ad_type=='adSense') ? '' : 'display:none;' ;  ?>">    
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'script');?>
                    <?php echo $form->textArea($model, 'script',array_merge($model->getHtmlOptions('script'),array("rows"=>"6"))); ?>
                    <?php echo $form->error($model, 'script');?>
                </div>   
               
                <div class="clearfix"><!-- --></div>        
               </div>
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
