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
                 <div id="header">
					<ul>
						<li><a href="<?php if($model->sub_category_id) { echo $this->createUrl(Yii::app()->controller->id.'/update',array("id" => $model->sub_category_id )) ; } else { echo "#"; } ?>">Sub Category Details</a></li>
						<?php if($model->sub_category_id and $model->category->amenities_required=="Y")
						{
							?>
						<li><a href="<?php if($model->sub_category_id) { echo $this->createUrl(Yii::app()->controller->id.'/updateAmenities',array("id" => $model->sub_category_id )) ; } else { echo "#"; } ?>">Amenities Details</a></li>
							<?
						}
						?>
						<li><a href="<?php if($model->sub_category_id) { echo $this->createUrl(Yii::app()->controller->id.'/fields',array("id" => $model->sub_category_id )) ; } else { echo "#"; } ?>">Required Fields</a></li>
					    <li   id="selected"><a href="<?php if($model->sub_category_id) { echo $this->createUrl(Yii::app()->controller->id.'/models',array("id" => $model->sub_category_id )) ; } else { echo "#"; } ?>">Add Models</a></li>
						<li><a href="<?php if($model->sub_category_id) { echo $this->createUrl(Yii::app()->controller->id.'/model_list',array("id" => $model->sub_category_id )) ; } else { echo "#"; } ?>">View Models</a></li>
					
					</ul>
				</div>
				  <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, '<b>Category</b>');?> : 
                    <?php echo $model->category->category_name;?>
                    <?php echo $form->error($model, 'category_id');?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, ' <b>sub_category_name</b>');?> : 
                   <?php echo  $model->sub_category_name; ?>
                    <?php echo $form->error($model, 'Sub_category_name');?>
                </div>     
                 <div class="clearfix"><!-- --></div>
                  <table class="tg2" style="width:520px;">
					  <tr><th colspan="2">Add Models</th></tr>
					  <tr class="rowgrid"><td><?php echo $form->textField($vehiclemodel,'[]model_name',$model->getHtmlOptions('model_name')); ?></td><td><a href="javascript:" onclick="rmove(this)">Delete</a></td></tr>
					  <tr id="last"><td><a href="javascript:" onclick='appendRow()'>Add More</a></td><td></td></tr>
                  
                  </table>
                 
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
	function appendRow() {
     $("#last").before($("tr.rowgrid:first").clone());
     $("tr.rowgrid:last input").val(""); 
       
}
function rmove(k)
{
	if($("tr.rowgrid").length=="1"){ alert("Sorry you can't delete the one last row");return false; }; 
	$(k).parent().parent().remove();
}
</script>
