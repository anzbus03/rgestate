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
             //   $model-> parent_master  = '13';
                ?>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'parent_master');?>
                    <?php echo $form->dropDownList($model, 'parent_master', $model->findFooterLinksSubcategory() ,$model->getHtmlOptions('parent_master',array('empty'=>'Select Category'))); ?>
                    <?php echo $form->error($model, 'parent_master');?>
                </div>        
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'title');?>
                    <?php echo $form->textField($model, 'title',$model->getHtmlOptions('title')); ?>
                    <?php echo $form->error($model, 'title');?>
                </div>        
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'master_name');?>
                    <?php echo $form->textField($model, 'master_name',$model->getHtmlOptions('master_name')); ?>
                    <?php echo $form->error($model, 'master_name');?>
                </div>        
                <div class="clearfix"><!-- --></div>
                
                
                
                
                 <div class="clearfix"><!-- --></div>
                 <?php 
                 $section = Section::model()->ListDataForJSON_New();
        $list_type = Category::model()->listingTypeArrayMainData();
                if(!Yii::app()->request->isPostRequest and !$model->isNewRecord){
			 
					$master_array =  (array) json_decode($model->master_array)  ; 
				    if(!empty($master_array)){
					foreach( $master_array as $k=>$v){
						$model->$k   =  $v ;  
					}
					}
				}
                  
                  ?> 
                     <?php  
                     $cities =  CHtml::listData(States::model()->AllListingStatesOfEnabledCountry() ,'state_id' , 'state_name') ;
                    $m_class = empty( $cities ) ? 'hidden' : '' ; 
                    ?>
                <div class="form-group col-lg-4  ">
                      <?php echo $form->labelEx($model, 'state');?>
                    <?php echo $form->dropDownList($model, 'state', $cities  , $model->getHtmlOptions('state',array('empty'=>'Select City','class'=>'form-control select2 ' ,'data-url'=>Yii::App()->createUrl('place_property/select_location'),'onchange'=>'load_via_ajax(this,"city")'))); ?>
                    <?php echo $form->error($model, 'state');?>
                </div>  
     
                 <?php  
                     $locationlist =   CHtml::listData(City::model()->FindCities((int) $model->state) ,'city_id' , 'city_name') ;
                    $m_class = empty(  $locationlist ) ? 'hidden' : '' ; 
                    ?>
                <div class="form-group col-lg-4  ">
                    
                    <?php echo $form->labelEx($model, 'city');?>
                    <?php echo $form->dropDownList($model, 'city', $locationlist, $model->getHtmlOptions('state',array('empty'=>'Select Location','class'=>'form-control select2'))); ?>
                    <?php echo $form->error($model, 'city');?>
                </div>  
                <div class="clearfix"></div>
                 <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($model, '');?>
                    <?php echo $form->dropDownList($model, 'section_id',$section, $model->getHtmlOptions('section_id',array('empty'=>'Select Section','class'=>'form-control select2' ,'data-url'=>Yii::App()->createUrl('place_property/select_category2'),'onchange'=>'load_via_ajax(this,"category_id")'  ))); ?>
                    <?php echo $form->error($model, 'section_id');?>
                </div>  
                 
               
                <?php  
               
                     $catlist =  Category::model()->ListDataForJSON_ID_BySEctionNew($model->section_id)   ;
				 
               
                    ?>
                 <div class="form-group col-lg-3  ">
                    <?php echo $form->labelEx($model, 'category_id');?>
                    <?php echo $form->dropDownList($model, 'category_id', $catlist  , $model->getHtmlOptions('category_id',array('empty'=>'Select Category','class'=>'form-control select2','data-url'=>Yii::App()->createUrl($this->id.'/Select_sub_category2'),'onchange'=>'load_via_ajax(this,"sub_category_id")'))); ?>
                    <?php echo $form->error($model, 'category_id');?>
               </div>  
                
                
                
                <div class="clearfix"><!-- --></div>
                  
                   
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
?>
<script>



var modelName = '<?php echo $model->modelName;?>'
function load_via_ajax(k,id){
	var url_load = $(k).attr('data-url') 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
	 
		 $('#'+modelName+'_'+id).val('');
		 $('#'+modelName+'_'+id).html('<option value="">Loading...</option>').select2();
		 var attr_id = $(k).attr('id');
		 if(attr_id== '<?php echo $model->modelName;?>_state'){
			 
		 }
		 $.get(url_load,function(data){ var data = JSON.parse(data) ;   $('#'+modelName+'_'+id).html(data.data).select2(); if(data.size != '0') {    $('#'+modelName+'_'+id).closest('.form-group').removeClass('hidden') }else{  $('#'+modelName+'_'+id).closest('.form-group').addClass('hidden') }  })
	}
}
function openFields(k){
	var idSwitch = $(k).attr('id');
	switch(idSwitch){
		case '<?php echo $model->modelName;?>_section_id':
		if($(k).val()=='2'){
			$('.rent_paid').removeClass('hidden');
		}
		else{
			$('.rent_paid').addClass('hidden');
		}
		if($(k).val()=='4'){
			$('.w_for').removeClass('hide');
		}
		else{
			$('.w_for').addClass('hide');
		}
		
		break;
	}
}
$(function(){ $('.select2').select2();   }) 
</script> 
