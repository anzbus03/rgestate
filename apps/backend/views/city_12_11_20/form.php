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
                    <?php 
                    if($model->isNewRecord and !Yii::app()->request->isPostRequest){
                        	$model->country_id ='66099';
                    }
                    if(empty( $model->country_id) and !empty($model->state_id)){
						$model->country_id = $model->state->country_id;
					}
                    
                    echo $form->labelEx($model, 'country_id');?> 
                    <?php $dropdwn =   array_merge( $model->getHtmlOptions('country_id'),array('empty'=>'Select Country ',"style"=>"1",
                       'ajax' =>
                       array('type'=>'POST',
                       'url'=>$this->createUrl('LoadStates'), //url to call.
                       'update'=>'#City_state_id', //selector to update
                        'data'=>array('country_id'=>'js:this.value'),
                        'beforeSend' => 'function(){
							$("#myDiv").addClass("grid-view-loading");}',
							'complete' => 'function(){
						    $("#myDiv").removeClass("grid-view-loading");
						   }',
							)
                       )
                       )
                    
                     ;  ?> 
                    <span id="myDiv" style="padding-left:20px;"></span>
                    <?php echo $form->dropDownList($model,'country_id',CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"), $dropdwn  ); ?> 
                    <?php echo $form->error($model, 'country_id');?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'state_id');?> 
                    <?php $dropdwn =   array_merge( $model->getHtmlOptions('state_id'),array('empty'=>'Select Region ',"style"=>"1")) ;  ?> 
                    <?php echo $form->dropDownList($model,'state_id',CHtml::listData(States::model()->getStateWithCountry_2($model->country_id),"state_id" ,"state_name"), $dropdwn  ); ?>
                    <?php echo $form->error($model, 'state_id');?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'city_name');?>
                    <?php echo $form->textField($model, 'city_name',$model->getHtmlOptions('city_name')); ?>
                    <?php echo $form->error($model, 'city_name');?>
                </div>  
                
                 <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($model, 'location_latitude');?>
                    <?php echo $form->textField($model, 'location_latitude',$model->getHtmlOptions('location_latitude')); ?>
                    <?php echo $form->error($model, 'location_latitude');?>
                </div> 
                   <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($model, 'location_longitude');?>
                    <?php echo $form->textField($model, 'location_longitude',$model->getHtmlOptions('location_longitude')); ?>
                    <?php echo $form->error($model, 'location_longitude');?>
                </div>  
                  <div class="clearfix"><!-- --></div>
                <?php
                if($model->isNewRecord){ ?> 
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'mul_city');?>
                    <?php echo $form->textArea($model, 'mul_city',$model->getHtmlOptions('mul_city')); ?>
                    <?php echo $form->error($model, 'mul_city');?>
                </div>  
                <?php } ?> 
                 
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
