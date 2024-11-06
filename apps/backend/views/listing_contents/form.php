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
        $form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('class'=>'form-horizontal','enctype' => 'multipart/form-data')));
        ?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-book"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$areaguides->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array($this->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
				<div class="form-group col-lg-3">
                    <?php 
                    if(!Yii::app()->request->isPostRequest   and empty($areaguides->area) and $areaguides->isNewRecord){
                        $areaguides->area ='19';
                    }
                    echo $form->labelEx($areaguides, 'area');  ?> 
                    <?php $dropdwn =   array_merge( $areaguides->getHtmlOptions('area'),array('empty'=>'Select Region ',"style"=>"1",
                       'ajax' =>
                       array('type'=>'GET',
                       'url'=>$this->createUrl('LoadCities'), //url to call.
                       'update'=>'#ListingContents_city', //selector to update
                        'data'=>array('area'=>'js:this.value'),
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
                    <?php echo $form->dropDownList($areaguides,'area',CHtml::listData(MainRegion::model()->getStateWithCountry_2(66124),"region_id" ,"name"), $dropdwn); ?>
                    <?php echo $form->error($areaguides, 'area');?>
                </div>
                <div class="form-group col-lg-3">
                    <?php echo $form->labelEx($areaguides, 'city');?> 
                    <?php $dropdwn =   array_merge( $areaguides->getHtmlOptions('city'),array('empty'=>'Select Community ',"style"=>"1")) ;  ?> 
                    <?php echo $form->dropDownList($areaguides,'city',CHtml::listData(States::model()->getStateWithCountry_2(66124),"state_id" ,"state_name"), $dropdwn  ); ?>
                    <?php echo $form->error($areaguides, 'city');?>
                </div>
                <div class="col-lg-3">
                    <div class="form-group ">
                    <?php echo $form->labelEx($areaguides, 'section_id');?> 
                    <?php $dropdwn =   array_merge( $areaguides->getHtmlOptions('section_id'),array('empty'=>'Select Module ',"style"=>"1")) ;  ?> 
                    <?php echo $form->dropDownList($areaguides,'section_id', array('1'=>'for Sale','2'=>'for Rent','Business'), $dropdwn  ); ?>
                    <?php echo $form->error($areaguides, 'section_id');?>
                    </div>
                </div>
                
                <div class="col-lg-3  ">
                     <div class="form-group ">
                    <?php echo $form->labelEx($areaguides, 'p_type');?> 
                    <?php $dropdwn =   array_merge( $areaguides->getHtmlOptions('city'),array('empty'=>'Select category ',"style"=>"1")) ;  ?> 
                    <?php echo $form->dropDownList($areaguides,'p_type',CHtml::listData(MainCategory::model()->category_property_type(),"category_id" ,"category_name"), $dropdwn  ); ?>
                    <?php echo $form->error($areaguides, 'p_type');?>
                     </div>
                </div>
                <div class="clearfix"><!-- --></div>
            
                <div class="form-group col-lg-3  ">
                    <?php echo $form->labelEx($areaguides, 'sub_category');?> 
                    <?php
                    $subCategoryD = Subcategory::model()->findAllByAttributes(array('parent_id' => null));
                    $options = array('' => 'Select'); // Initialize options with a default empty value
                    foreach ($subCategoryD as $subcategory) {
                        $options[$subcategory->sub_category_id] = $subcategory->sub_category_name;
                    }
                    $mer = array_merge($areaguides->getHtmlOptions('sub_category'), array('class' => 'input-text form-control', 'onchange' => 'populateNestedSubcategories(this)'));
                    echo $form->dropDownList($areaguides, 'sub_category', $options, $mer);
                    echo $form->error($areaguides, 'sub_category_id');
                    ?>
                </div>
                <script type="text/javascript">
                    document.addEventListener("DOMContentLoaded", function() {
                        var subCategoryId = "<?php echo $areaguides->sub_category; ?>";
                        
                        populateNestedSubcategoriesOnLoad(subCategoryId);
                    });
                    function populateNestedSubcategories(subCategoryId) {
                        var parentId = $(subCategoryId).val();
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo CController::createUrl("place_property/dynamicNestedSubcategories"); ?>',
                            data: {parentId: parentId},
                            success: function(data) {
                                $('#ListingContents_nested_sub_category').html(data);
                            }
                        });
                    }
                    function populateNestedSubcategoriesOnLoad(subCategoryId) {
                        var parentId = subCategoryId;
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo CController::createUrl("place_property/dynamicNestedSubcategories"); ?>',
                            data: {parentId: parentId,nestedSubcategoryId: "<?php echo $areaguides->nested_sub_category; ?>"},
                            success: function(data) {
                                $('#ListingContents_nested_sub_category').html(data);
                            }
                        });
                    }
                </script>
                <div class=" form-group col-lg-3  ">
                    <?php echo $form->labelEx($areaguides, 'nested_sub_category');?> 
                    <?php
                        $options = array();
                        $mer = array_merge($areaguides->getHtmlOptions('nested_sub_category'), array('class' => 'input-text form-control', 'empty' => 'Select'));
                        echo $form->dropDownList($areaguides, 'nested_sub_category', $options, $mer);
                        echo $form->error($areaguides, 'nested_sub_category');
                    ?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($areaguides, 'meta_title');?><?php echo $areaguides->getTranslateHtml('meta_title');?>
                    <?php echo $form->textField($areaguides, 'meta_title', $areaguides->getHtmlOptions('meta_title')); ?>
                    <?php echo $form->error($areaguides, 'meta_title');?>
                </div>
                
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($areaguides, 'meta_description');?><?php echo $areaguides->getTranslateHtml('meta_description');?>
                    <?php echo $form->textArea($areaguides, 'meta_description', $areaguides->getHtmlOptions('meta_description', array('rows' => 4))); ?>
                    <?php echo $form->error($areaguides, 'meta_description');?>
                </div>
                <div class="clearfix"><!-- --></div>
             
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($areaguides, 'highlights');?><?php echo $areaguides->getTranslateHtml('highlights','ar',false,'1200px');?>
                    <?php echo $form->textArea($areaguides, 'highlights', $areaguides->getHtmlOptions('highlights', array('rows' => 15))); ?>
                    <?php echo $form->error($areaguides, 'highlights');?>
                </div>
		 		
               
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($areaguides, 'neighborhood');?> 
                    <?php echo $form->textArea($areaguides, 'neighborhood', $areaguides->getHtmlOptions('neighborhood', array('rows' => 15))); ?>
                    <?php echo $form->error($areaguides, 'neighborhood');?>
                </div>
                <div class="col-lg-4">
                    <div class="form-group slug-wrapper"<?php if (empty($areaguides->slug)){ echo ' style="display:none"';}?>>
                        <?php echo $form->labelEx($areaguides, 'slug');?>
                        <?php echo $form->textField($areaguides, 'slug', $areaguides->getHtmlOptions('slug')); ?>
                        <?php echo $form->error($areaguides, 'slug');?>
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
