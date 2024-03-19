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
                <div class="form-group col-lg-8">
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($model, 'bank_name');?>
                    <?php echo $form->textField($model, 'bank_name',$model->getHtmlOptions('bank_name')); ?>
                    <?php echo $form->error($model, 'bank_name');?>
                </div> 
              
                <div class="form-group col-lg-8">       
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model, 'interest_rate');?>
						<?php echo $form->textField($model, 'interest_rate',$model->getHtmlOptions('interest_rate')); ?>
						<?php echo $form->error($model, 'interest_rate');?>
					</div>        
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model, 'down_payment');?>
						<?php echo $form->textField($model, 'down_payment',$model->getHtmlOptions('interest_rate')); ?>
						<?php echo $form->error($model, 'down_payment');?>
					</div>        
                </div>  
                <div class="form-group col-lg-12">
						<?php echo $form->labelEx($model, 'terms');?>
						<?php echo $form->textArea($model, 'terms',$model->getHtmlOptions('terms')); ?>
						<?php echo $form->error($model, 'terms');?>
					</div>       
                </div>        
                  <div class="form-group col-lg-4">
                     <div class="form-group  col-md-4 col-sm-4">
							 <?php  
							 $fileField = 'logo';
							 $types = '.png,.jpg';
							 $maxFiles = '1';
							 $maxFilesize = '2';
							  $this->renderPartial('//listingusers/_file_field_browse2',compact('form','fileField','maxFilesize','types','maxFiles','model')); ?>
						</div>
                </div> 
                <div class="clearfix"><!-- --></div>
               
               <div class="clearfix"><!-- --></div>
                	<div class="form-group col-lg-6">
					<?php echo $form->labelEx($model, 'show_all');?>
					<?php echo $form->dropDownList($model,'show_all',$model->countryOption(), $model->getHtmlOptions('show_all',array('onchange'=>'showCountries(this)'))); ?>
					<?php echo $form->error($model, 'show_all');?>
					</div> 
                <div class="clearfix"><!-- --></div>
                	<div class="amn row <?php echo $model->show_all=='1' ? '' : 'hide';?>" style="margin-left:0px; margin-right:0px;">
										  <?php
										   $categoris =   CHtml::listData(Countries::model()->listingCountries(),'country_id','country_name');
										   foreach($categoris as $k=>$v){
											 
											   echo '<div class="col-sm-2" style="">';
											       
											     	
													  echo '<div class="form-check form-check-flat"><label class="form-check-label"><input value="'.$k.'" id="amenities_'.$k.'" '; echo  in_array($k,(array) $model->listing_countries) ? 'checked' : '';  echo ' type="checkbox" name="listing_countries[]"  >  '.$v.' <i class="input-helper"></i></label></div>';
												  
											      
											      
											       echo '</div>';
											    
										   }
										   
											?>
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
?>
 <script>
		function showCountries(k){
			if($(k).val()=='1'){
				$('.amn').removeClass('hide')
			}
			else{
				$('.amn').addClass('hide')
			}
		}

</script>
