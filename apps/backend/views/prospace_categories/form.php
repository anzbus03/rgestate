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
        $form=$this->beginWidget('CActiveForm', array(
		'id'=>'miscellaneous-pages-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		));
        ?>
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
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

                    <div class="form-group col-lg-4">
                       <?php echo $form->labelEx($model, 'category');?>
                       <?php echo $form->textField($model, 'category',$model->getHtmlOptions('category')); ?>
                       <?php echo $form->error($model, 'category');?>
                    </div>       
                    <div class="form-group col-lg-4">
                       <?php echo $form->labelEx($model, 'category_id');?>
                       <?php echo $form->dropDownList($model, 'category_id',CHtml::listData(MainCategory::model()->ListData(),'category_id','category_name'), $model->getHtmlOptions('category_id',array('empty'=>'Select','onchange'=>'changeCategorythis(this)'))); ?>
                       <?php echo $form->error($model, 'category_id');?>
                    </div>   
                    <div class="form-group col-lg-4">
                       <?php echo $form->labelEx($model, 'type_id');?>
                       <?php echo $form->dropDownList($model, 'type_id',Category::model()->ListDataForJSON_ID_ByListingType($model->category_id,false,''), $model->getHtmlOptions('type_id',array('empty'=>'Select'))); ?>
                       <?php echo $form->error($model, 'type_id');?>
                    </div>  
                </div>
                  
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
                <div class="pull-right m-4">
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
var modelName = 'ProspaceCategory';
$(function(){$('select').select2();});
 var change_select_url = '<?php echo Yii::App()->createUrl('links/getCategory');?>';
  var change_subcategory_url = '<?php echo Yii::App()->createUrl('links/getSubCategory');?>';
 var change_city_url = '<?php echo Yii::App()->createUrl('links/getCity');?>';
  var change_location_url = '<?php echo Yii::App()->createUrl('links/getLocation');?>';
function changeSEctionthis(k){
    var country_id = ($('#'+modelName+'_country_id').val() == '') ? '' :  $('#'+modelName+'_country_id').val()
$('#'+modelName+'_category_id').find('option').remove().end().append('<option value="">Select Type</option>').val('');$('#'+modelName+'_category_id').select2();
$.get(change_select_url+'/id/'+$(k).val()+'/country_id/'+country_id,function(data){  $('#'+modelName+'_category_id').append(data);$('#'+modelName+'_category_id').select2();  })
}
function changeCategorythis(k){
    var country_id = ($('#'+modelName+'_country_id').val() == '') ? '' :  $('#'+modelName+'_country_id').val()
$('#'+modelName+'_type_id').find('option').remove().end().append('<option value="">Select Category</option>').val('');$('#'+modelName+'_type_id').select2();
$.get(change_subcategory_url+'/id/'+$(k).val()+'/country_id/'+country_id,function(data){  $('#'+modelName+'_type_id').append(data);$('#'+modelName+'_type_id').select2();  })
}
function changeforCity(k){
$('#'+modelName+'_city_id').find('option').remove().end().append('<option value="">Select City</option>').val('');$('#'+modelName+'_city_id').select2();
$.get(change_city_url+'/id/'+$(k).val(),function(data){  $('#'+modelName+'_city_id').append(data);$('#'+modelName+'_city_id').select2();  })
}
function changeforLocation(k){
$('#'+modelName+'_location_id').find('option').remove().end().append('<option value="">Select Location</option>').val('');$('#'+modelName+'_location_id').select2();
$.get(change_location_url+'/id/'+$(k).val(),function(data){  $('#'+modelName+'_location_id').append(data);$('#'+modelName+'_location_id').select2();  })
}
</script>
