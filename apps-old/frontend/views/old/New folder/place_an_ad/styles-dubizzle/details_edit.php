<?php defined('MW_PATH') || exit('No direct script access allowed');
/*
?>
 <nav class="breadcrumbs small">
	 <ul>
		<li><a href="<?php echo Yii::app()->createUrl("");?>">Home</a></li>
		<li><a href="<?php echo Yii::app()->createUrl("place_an_ad/create");?>">Place An Ad</a></li>
		<li class="active"><a href="#">Ad Edit</a></li>
 </ul>
 </nav>
<?php
*/
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
        $form = $this->beginWidget('CActiveForm',array("id"=>"top-websites-cr-form_next",'focus'=>array($model,Yii::app()->controller->focus))); 
        ?>
     <div class="breadcrumbs mar4" >
		<a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('place_an_ad/create');?>">Place Ad</a>
		</div>
		<div class="clear"></div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                      <h1 id="innerhead"><?php echo $model->ad_title; ?> Edit</h1> 
                </div>
                <div class="pull-right">
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
                 <div class="clearfix"><!-- --></div>
                	<ul class="fourStep stepNavigation" style="width:100%;">
					<li class="lastDone"><a title=""><em>Step 1: Ad Type</em><span>Edit Ad Type</span></a></li>
					<li class="current"><a title=""><em>Step 2: Details</em><span>Edit Ad details</span></a></li>
					<li><a title=""><em>Step 3: Location</em><span>Edit Location</span></a></li>
					<li class="lastStep"><a title=""><em>Step 4: Done</em><span>Completed</span></a></li>
	           </ul>
	           <div style="clear:both"></div>
                 <div class="content_place_an_ad">
					
				 	<div class="content_head"  >Step 2 : Edit Details</div>
					 
				   <div style="clear:both"></div>
				      <div class="content_content">
						  
						  <div style="font-weight:bold;color:#6B6B6B;font-size:16px;margin-bottom:20px;">Ad Type : <?php echo $subcategory->category->category_name;?>/<?php echo $subcategory->sub_category_name;?>&nbsp;<a href="<?php echo Yii::app()->createUrl("place_an_ad/update",array("id"=>$model->id)); ?>">Change</a></div>
						 <div style="clear:both"></div>
				   <?php 
					   
				 ?>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($model, 'ad_title');?>
                    <?php echo $form->textField($model, 'ad_title', $model->getHtmlOptions('ad_title')); ?>
                    <?php echo $form->error($model, 'ad_title');?>
                </div>      
                  
                 <div class="clearfix"><!-- --></div> 
                     <div class="form-group col-lg-12">
                    <?php echo $form->labelEx($model, 'ad_description');?>
                    <?php echo $form->textArea($model, 'ad_description', $model->getHtmlOptions('ad_description')); ?>
                    <?php echo $form->error($model, 'ad_description');?>
                </div>        
                 
                    <div class="clearfix"><!-- --></div>
              
            	  <div class="clearfix"><!-- --></div>
									   <?php 
								  if($subcategory->category->amenities_required=="Y" and $subcategory->relatedAmenities)
								  {
									  
									  ?>

									 <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'amenities');?>
										<div class="container34">
										  <?php
											 $amenities_array=	 CHtml::listData(Amenities::model()->ListDataWithAmenities($subcategory->category_id),'amenities_id','amenities_name');
											 $amenties=   CHtml::listData($subcategory->relatedAmenities,'amenities_id','amenities_id');
											 
											 $amenitiesArray =  array();
											 $sectedIndex =  ($model->amenities) ? $model->amenities : CHtml::listData($model->adAmenities,'amenities_id','amenities_id') ; 
											 if($amenties)
											 {
												 foreach($amenties as $k)
												 {
													 $amenitiesArray[$k] = @$amenities_array[$k];
												 }
											 }
											  
											 
											echo CHtml::checkBoxList('amenities', $sectedIndex ,$amenitiesArray);                                              
											?>
										</div>
										<?php echo $form->error($model, 'amenities');?>
									</div>    
									<?
								}
								  
								?>  
									<?php if(in_array("area",$fields)){
										
										?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'area');?>
										<?php echo $form->textField($model, 'area', $model->getHtmlOptions('area')); ?>
										<?php echo $form->error($model, 'area');?>
									</div> 
								   <?php }  ?>       
									 
									<?php if(in_array("bathrooms",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bathrooms');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bathrooms'),array('empty'=>"Select bathrooms","class"=>"select3")); ?>
										<?php echo $form->dropDownList($model, 'bathrooms',  $model->bathrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bathrooms');?>
									</div>  
									 <?php }  ?>             
									
									 
									 <?php if(in_array("bedrooms",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bedrooms');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bedrooms'),array('empty'=>"Select bedrooms","class"=>"select5","style"=>"width:450px;")); ?>
										<?php echo $form->dropDownList($model, 'bedrooms',  $model->bedrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bedrooms');?>
									</div> 
									 <?php }  ?>        
									  
									<?php if(in_array("engine_size",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'engine_size');?>
										<?php $mer =  array_merge($model->getHtmlOptions('engine_size'),array('empty'=>"Select Engine Size","class"=>"select5")); ?>
										<?php echo $form->dropDownList($model, 'engine_size', CHtml::listData(EngineSize::model()->listData(),'engine_size_id','engine_size_name') , $mer ); ?>
										<?php echo $form->error($model, 'engine_size');?>
									</div>  
									 <?php }  ?>       
									 
									   
									 
									  
									<?php if(in_array("model",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'model');?>
										<?php $mer =  array_merge($model->getHtmlOptions('model'),array('empty'=>"Select Model","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'model', array_replace(CHtml::listData(VehicleModel::model()->findByModels($model->sub_category_id),'model_id','model_name'),array('Others'=>'Others')) , $mer ); ?>
										<?php echo $form->error($model, 'model');?>
									</div>  
									 <?php }  ?>       
									  
									
									<?php if(in_array("year",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'year');?>
										<?php $mer =  array_merge($model->getHtmlOptions('year'),array('empty'=>"Select year","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'year',  $model->year() , $mer ); ?>
										<?php echo $form->error($model, 'year');?>
									</div>  
									 <?php }  ?>
									   <?php if(in_array("killometer",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'killometer');?>
										<?php echo $form->textField($model, 'killometer', $model->getHtmlOptions('killometer')); ?>	                    
										<?php echo $form->error($model, 'killometer');?>
									</div>  
									 <?php }  ?>      
									 
									<?php if(in_array("color",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'color');?>
										<?php $mer =  array_merge($model->getHtmlOptions('color'),array('empty'=>"Select Color","class"=>"select2","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'color', CHtml::listData(Color::model()->listData(),'color_id','color_name') , $mer ); ?>
										<?php echo $form->error($model, 'color');?>
									</div>  
									 <?php }  ?>   
 
									
									<?php if(in_array("door",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'door');?>
										<?php $mer =  array_merge($model->getHtmlOptions('door'),array('empty'=>"Select Door","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'door', CHtml::listData(Door::model()->listData(),'door_id','door_name') , $mer ); ?>
										<?php echo $form->error($model, 'door');?>
									</div>  
									 <?php }  ?>
																	 
									<?php if(in_array("bodycondition",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bodycondition');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bodycondition'),array('empty'=>"Select Condition","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'bodycondition', CHtml::listData(Bodycondition::model()->listData(),'bodycondition_id','bodycondition_name') , $mer ); ?>
										<?php echo $form->error($model, 'bodycondition');?>
									</div>  
									 <?php }  ?>  
									 
									 <?php if(in_array("mechanicalcondition",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'mechanicalcondition');?>
										<?php $mer =  array_merge($model->getHtmlOptions('mechanicalcondition'),array('empty'=>"Select Condition","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'mechanicalcondition', CHtml::listData(Mechanicalcondition::model()->listData(),'mechanicalcondition_id','mechanicalcondition_name') , $mer ); ?>
										<?php echo $form->error($model, 'mechanicalcondition');?>
									</div>  
									 <?php }  ?>    
								    
								    <?php if(in_array("fuel_type",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'fuel_type');?>
										<?php $mer =  array_merge($model->getHtmlOptions('fuel_type'),array('empty'=>"Select Fuel Type","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'fuel_type', CHtml::listData(FuelType::model()->listData(),'fuel_id','fuel_name') , $mer ); ?>
										<?php echo $form->error($model, 'fuel_type');?>
									</div>  
									 <?php }  ?> 	
									
								
									  <?php if(in_array("body_type",$fields)){?>
									 <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'body_type');?>
										<?php $mer =  array_merge($model->getHtmlOptions('body_type'),array('empty'=>"Select Body Type","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'body_type', CHtml::listData(BodyType::model()->listData(),'body_type_id','body_type_name')  , $mer ); ?>
										<?php echo $form->error($model, 'body_type');?>
									 </div>  
									 <?php }  ?> 
									 	  <?php if(in_array("cylinders",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'cylinders');?>
										<?php $mer =  array_merge($model->getHtmlOptions('cylinders'),array('empty'=>"No. Of Cylinder","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'cylinders',  $model->cylinders() , $mer ); ?>
										<?php echo $form->error($model, 'cylinders');?>
									</div>  
									 <?php }  ?>  
									 
								     
									
									  
								   <?php if(in_array("employment_type",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'employment_type');?>
										<?php $mer =  array_merge($model->getHtmlOptions('model'),array('empty'=>"Employment Type","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'employment_type', CHtml::listData(EmploymentType::model()->listData(),'employment_type_id','employment_type_name') , $mer ); ?>
										<?php echo $form->error($model, 'employment_type');?>
									</div>  
									 <?php }  ?>       
									  
									  
									<?php if(in_array("compensation",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'compensation');?>
										<?php echo $form->textField($model, 'compensation', $model->getHtmlOptions('compensation')); ?>	
										<?php echo $form->error($model, 'compensation');?>
									</div>  
									 <?php }  ?>       
									   
									<?php if(in_array("age",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'age');?>
										<?php echo $form->textField($model, 'age', $model->getHtmlOptions('age')); ?>	
										<?php echo $form->error($model, 'age');?>
									</div>  
									 <?php }  ?>       
									  
									  
									<?php if(in_array("height",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'height');?>(Feet and Inch ,Enter   5.7  for 5 feet & 7 inch)
										<?php echo $form->textField($model, 'height', $model->getHtmlOptions('height')); ?>	
										<?php echo $form->error($model, 'height');?>
									</div>  
									 <?php }  ?>       
									  
									  
									<?php if(in_array("marital_status",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'marital_status');?>
										<?php $mer =  array_merge($model->getHtmlOptions('marital_status'),array('empty'=>"Marital Status","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'marital_status', CHtml::listData(MaritalStatus::model()->listData(),'marital_id','marital_name') , $mer ); ?>
											
										<?php echo $form->error($model, 'marital_status');?>
									</div>  
									 <?php }  ?>       
									   
									   
									
									  
									<?php if(in_array("religion_id",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'religion_id');?>
										<?php $mer =  array_merge($model->getHtmlOptions('religion_id'),array('empty'=>"Religion","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'religion_id', CHtml::listData(Religion::model()->listData(),'religion_id','religion_name') , $mer ); ?>
											
										<?php echo $form->error($model, 'religion_id');?>
									</div>  
									 <?php }  ?>       
									  
									  
									  <?php if(in_array("mother_tongue",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'mother_tongue');?>
										<?php echo $form->textField($model, 'mother_tongue', $model->getHtmlOptions('mother_tongue')); ?>	
										<?php echo $form->error($model, 'mother_tongue');?>
									</div>  
									 <?php }  ?>       
									  

									 <?php if(in_array("education_level",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'education_level');?>
										<?php $mer =  array_merge($model->getHtmlOptions('model'),array('empty'=>"Education Level","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'education_level', CHtml::listData(EducationLevel::model()->listData(),'education_id','education_name') , $mer ); ?>
										<?php echo $form->error($model, 'education_level');?>
									</div>  
									 <?php }  ?>   
									   
									 
									 <?php if(in_array("current_occupation",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'current_occupation');?>
										<?php $mer =  array_merge($model->getHtmlOptions('current_occupation'),array('empty'=>"Current Occupation","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'current_occupation', CHtml::listData(Occupation::model()->listData(),'occupation_id','occupation_name') , $mer ); ?>
										<?php echo $form->error($model, 'current_occupation');?>
									</div>  
									 <?php }  ?>       

								   	
									<?php if(in_array("experience_level",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'experience_level');?>
										<?php $mer =  array_merge($model->getHtmlOptions('model'),array('empty'=>"Expereience Level","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'experience_level', CHtml::listData(Experience::model()->listData(),'experience_id','experience_name') , $mer ); ?>
										<?php echo $form->error($model, 'experience_level');?>
									</div>  
									 <?php }  ?>       
									
									  
									  
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'mobile_number');?>
										<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('mobile_number')); ?>
										<?php echo $form->error($model, 'mobile_number');?>
									</div>   
									   
						 
								  <?php if(in_array("price",$fields)){?>
								 <div class="form-group col-lg-6"  >
										<?php echo $form->labelEx($model, 'price');?>
										<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price')); ?>
										<?php echo $form->error($model, 'price');?>
									</div>        
									 <?php }  ?>       
							      <?php if(in_array("warranty",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'warranty');?>
										<?php $mer =  array_merge($model->getHtmlOptions('warranty'),array('empty'=>"Select warranty","class"=>"select2")); ?>
										<?php echo $form->dropDownList($model, 'warranty',  $model->warranty() , $mer ); ?>
										<?php echo $form->error($model, 'warranty');?>
									</div>  
									 <?php }  ?> 
									 	 <div class="form-group col-lg-6"  >
										<?php echo $form->labelEx($model, 'area_location');?>
										<?php echo $form->textField($model, 'area_location', $model->getHtmlOptions('area_location')); ?>
										<?php echo $form->error($model, 'area_location');?>
									</div>  
									   <?php echo $form->hiddenField($model,'sub_category_id');?>
									 <?php echo $form->hiddenField($model,'country');?>
									 <?php echo $form->hiddenField($model,'state');?>
             
                 <div class="clearfix"><!-- --></div> 
                 <div class="clearfix"><!-- --></div> 
                 
                   <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'image');?>
                    
                </div> 
               <div class="clearfix"><!-- --></div> 
               <?php 
               if(!empty($image_array) )
               {
				   
				   ?>
					<div class="property_img_box" style="margin-bottom:10px;">
						
						<?php
						$image = "";
						foreach($image_array as $k=>$v)
						{
							$image .= ",".$v;
						?>
						<div id="property_img_<?php echo $k;?>" class="property_img">
						<img src="<?php echo Yii::app()->params["uploadDir"]."/ads_thumb/".@$v ?>" style="width:135px;">
						<div class="property_img_overlay">
						<span class="isw-favorite" style="margin-right: 0px;"></span>
						</a>
						<a class="btn btn-danger btn-small" onclick="delete_property_image2('<?php echo $v;?>',this);">
						<span class="isw-delete2" style="margin-right: 0px;"></span>
						</a>
						</div>
						</div>
						<?
						}
				   ?>
					</div>
					<?php
					$model->image = $image;
			   }
			   
			    echo $form->hiddenField($model, 'image', $model->getHtmlOptions('image')); ?>
               <?php echo $form->error($model, 'image');?>
				 
                
                                
                
                 <div class="clearfix"><!-- --></div>
				<div class="img_h">Drag and drop Photos here or click below to select photos from your computer </div> 
				<div   class="img_s">Hint: File types allowed: jpg, gif, png, Max Width & Height : 1024px</div>
				<div id="myId" class="dropzone" title="Click or Drag here to upload photos"></div>
				<script type="text/javascript">
				var myDropzone = new Dropzone("div#myId", { url: "<?php echo $this->createUrl('upload'); ?>",addRemoveLinks: true, maxFilesize: 1024, acceptedMimeTypes: 'image/jpeg,image/gif',}) //according to your forms action
				 myDropzone.on("removedfile", function(file, serverFileName) {
				 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:file.serverId,inp:$("#PlaceAnAd_image").val()},function(data){  $("#PlaceAnAd_image").val(data) ; } );
				});
				myDropzone.on("success", function(file,serverFileName) {
					 file.serverId =serverFileName;
					 var vals  = $("#PlaceAnAd_image").val();
					 vals += ","+serverFileName;
					 $("#PlaceAnAd_image").val(vals) ;
					 
				});
				  var imgs = $("#PlaceAnAd_image").val(); 
				function delete_property_image(img, val,k)
				{
					 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:img,inp:val},function(data){  $("#PlaceAnAd_image").val(data) ;imgs=data; } );
					 $(k).parent().parent().remove();
				}
				
				function delete_property_image2(val,k)
				{
 
					 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:val,inp:imgs},function(data){  $("#PlaceAnAd_image").val(data) ;imgs=data; } );
					 $(k).parent().parent().remove();
				}
				</script>
				
                <div class="clearfix"><!-- --></div> 
                 
                 
                 
                 <div class="clearfix"><!-- --></div> 
					 
				   </div>
				 
            
                    <button type="submit" class="btn btn-primary btn-submit btn_my" style="float:right;margin-right:53px;margin-bottom:35px;" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Go To Next');?></button>
                <div class="clear"></div>
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
  
<script type="text/javascript">
$(function() {
	$.noConflict();
    //find all form with class jqtransform and apply the plugin
    $("input").attr("size","41");
    $("#PlaceAnAd_ad_title").attr("size","88");
    $("#PlaceAnAd_ad_description").css("width","878");
    $("select").css("width","390");
    $("#top-websites-cr-form_next").jqTransform();
});
</script>
</div>
</div>
