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
            <div class="card-body"">
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
                <ol class="progtrckr" data-progtrckr-steps="4">
					<li class="progtrckr-done">Choose Ad Type</li> 
					<li class="progtrckr-done">Enter Details</li> 
					<li class="progtrckr-todo">Choose Location</li> 
					<li class="progtrckr-todo">Done</li> 
				</ol>
                <div class="content_place_an_ad">
					
					<div class="content_head"  >Step 2 : Enter Details</div>
					 
				   <div style="clear:both"></div>
				      
				     <div class="content_content">
									<div class="clearfix"><!-- --></div>
									  <div style="font-weight:bold;color:#6B6B6B;font-size:16px;margin-bottom:20px;">Ad Type : <?php echo $subcategory->category->category_name;?>/<?php echo $subcategory->sub_category_name;?>&nbsp;<a href="<?php echo Yii::app()->createUrl("place_an_ad/create"); ?>">Change</a></div>
				   
									<div class="clearfix"><!-- --></div>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'ad_title');?>
										<?php echo $form->textField($model, 'ad_title', $model->getHtmlOptions('ad_title')); ?>
										<?php echo $form->error($model, 'ad_title');?>
									</div>      
									  
									 <div class="clearfix"><!-- --></div> 
									 
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'ad_description');?>
										<?php echo $form->textArea($model, 'ad_description', $model->getHtmlOptions('ad_description')); ?>
										<?php echo $form->error($model, 'ad_description');?>
									</div>        
									 
									 <div class="clearfix"><!-- --></div>
									<?php if(in_array("area",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'area');?>
										<?php echo $form->textField($model, 'area', $model->getHtmlOptions('area')); ?>
										<?php echo $form->error($model, 'area');?>
									</div> 
								   <?php }  ?>       
									 <div class="clearfix"><!-- --></div> 
									<?php if(in_array("bathrooms",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bathrooms');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bathrooms'),array('empty'=>"Select bathrooms")); ?>
										<?php echo $form->dropDownList($model, 'bathrooms',  $model->bathrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bathrooms');?>
									</div>  
									 <?php }  ?>             
									
									 <div class="clearfix"><!-- --></div>
									 <?php if(in_array("bedrooms",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bedrooms');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bedrooms'),array('empty'=>"Select bedrooms")); ?>
										<?php echo $form->dropDownList($model, 'bedrooms',  $model->bedrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bedrooms');?>
									</div> 
									 <?php }  ?>        
									  <div class="clearfix"><!-- --></div>
									  
									 <div class="clearfix"><!-- --></div> 	
									<?php if(in_array("engine_size",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'engine_size');?>
										<?php $mer =  array_merge($model->getHtmlOptions('engine_size'),array('empty'=>"Select Engine Size")); ?>
										<?php echo $form->dropDownList($model, 'engine_size', CHtml::listData(EngineSize::model()->listData(),'engine_size_id','engine_size_name') , $mer ); ?>
										<?php echo $form->error($model, 'engine_size');?>
									</div>  
									 <?php }  ?>       
									<div class="clearfix"><!-- --></div>
									<?php if(in_array("killometer",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'killometer');?>
										<?php echo $form->textField($model, 'killometer', $model->getHtmlOptions('killometer')); ?>	                    
										<?php echo $form->error($model, 'killometer');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									  
									<?php if(in_array("model",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'model');?>
										<?php $mer =  array_merge($model->getHtmlOptions('model'),array('empty'=>"Select Model")); ?>
										<?php echo $form->dropDownList($model, 'model', CHtml::listData(VehicleModel::model()->findByModels($model->sub_category_id),'model_id','model_name') , $mer ); ?>
										<?php echo $form->error($model, 'model');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									  
								 	<?php if(in_array("color",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'color');?>
										<?php $mer =  array_merge($model->getHtmlOptions('color'),array('empty'=>"Select Color")); ?>
										<?php echo $form->dropDownList($model, 'color', CHtml::listData(Color::model()->listData(),'color_id','color_name') , $mer ); ?>
										<?php echo $form->error($model, 'color');?>
									</div>  
									 <?php }  ?>      
									  <div class="clearfix"><!-- --></div>
									  
								 	<?php if(in_array("door",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'door');?>
										<?php $mer =  array_merge($model->getHtmlOptions('door'),array('empty'=>"Select Door")); ?>
										<?php echo $form->dropDownList($model, 'door', CHtml::listData(Door::model()->listData(),'door_id','door_name') , $mer ); ?>
										<?php echo $form->error($model, 'door');?>
									</div>  
									 <?php }  ?>      
									  <div class="clearfix"><!-- --></div>
								 	<?php if(in_array("bodycondition",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bodycondition');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bodycondition'),array('empty'=>"Select Condition")); ?>
										<?php echo $form->dropDownList($model, 'bodycondition', CHtml::listData(Bodycondition::model()->listData(),'bodycondition_id','bodycondition_name') , $mer ); ?>
										<?php echo $form->error($model, 'bodycondition');?>
									</div>  
									 <?php }  ?>      
									  <div class="clearfix"><!-- --></div>
								 	<?php if(in_array("mechanicalcondition",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'mechanicalcondition');?>
										<?php $mer =  array_merge($model->getHtmlOptions('mechanicalcondition'),array('empty'=>"Select Condition")); ?>
										<?php echo $form->dropDownList($model, 'mechanicalcondition', CHtml::listData(Mechanicalcondition::model()->listData(),'mechanicalcondition_id','mechanicalcondition_name') , $mer ); ?>
										<?php echo $form->error($model, 'mechanicalcondition');?>
									</div>  
									 <?php }  ?>      
									  <div class="clearfix"><!-- --></div>
								 	<?php if(in_array("fuel_type",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'fuel_type');?>
										<?php $mer =  array_merge($model->getHtmlOptions('fuel_type'),array('empty'=>"Select Fuel Type")); ?>
										<?php echo $form->dropDownList($model, 'fuel_type', CHtml::listData(FuelType::model()->listData(),'fuel_id','fuel_name') , $mer ); ?>
										<?php echo $form->error($model, 'fuel_type');?>
									</div>  
									 <?php }  ?>      
									  <div class="clearfix"><!-- --></div>
									
									<?php if(in_array("warranty",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'warranty');?>
										<?php $mer =  array_merge($model->getHtmlOptions('warranty'),array('empty'=>"Select warranty")); ?>
										<?php echo $form->dropDownList($model, 'warranty',  $model->warranty() , $mer ); ?>
										<?php echo $form->error($model, 'warranty');?>
									</div>  
									 <?php }  ?>       
									 <div class="clearfix"><!-- --></div>
									<?php if(in_array("cylinders",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'cylinders');?>
										<?php $mer =  array_merge($model->getHtmlOptions('cylinders'),array('empty'=>"No. Of Cylinder")); ?>
										<?php echo $form->dropDownList($model, 'cylinders',  $model->cylinders() , $mer ); ?>
										<?php echo $form->error($model, 'cylinders');?>
									</div>  
									 <?php }  ?>  
									 
									 <div class="clearfix"><!-- --></div>
									 <?php if(in_array("body_type",$fields)){?>
									 <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'body_type');?>
										<?php $mer =  array_merge($model->getHtmlOptions('body_type'),array('empty'=>"Select Body Type")); ?>
										<?php echo $form->dropDownList($model, 'body_type', CHtml::listData(BodyType::model()->listData(),'body_type_id','body_type_name')  , $mer ); ?>
										<?php echo $form->error($model, 'body_type');?>
									 </div>  
									 <?php }  ?>       
									
									       
									 <div class="clearfix"><!-- --></div>
									   
									
									<?php if(in_array("year",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'year');?>
										<?php $mer =  array_merge($model->getHtmlOptions('year'),array('empty'=>"Select year")); ?>
										<?php echo $form->dropDownList($model, 'year',  $model->year() , $mer ); ?>
										<?php echo $form->error($model, 'year');?>
									</div>  
									 <?php }  ?>       
									 <div class="clearfix"><!-- --></div>
									 
								
								   <?php if(in_array("employment_type",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'employment_type');?>
										<?php $mer =  array_merge($model->getHtmlOptions('model'),array('empty'=>"Employment Type")); ?>
										<?php echo $form->dropDownList($model, 'employment_type', CHtml::listData(EmploymentType::model()->listData(),'employment_type_id','employment_type_name') , $mer ); ?>
										<?php echo $form->error($model, 'employment_type');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									  
									<?php if(in_array("compensation",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'compensation');?>
										<?php echo $form->textField($model, 'compensation', $model->getHtmlOptions('compensation')); ?>	
										<?php echo $form->error($model, 'compensation');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									  
									<?php if(in_array("age",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'age');?>
										<?php echo $form->textField($model, 'age', $model->getHtmlOptions('age')); ?>	
										<?php echo $form->error($model, 'age');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									  
									<?php if(in_array("height",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'height');?>(Feet and Inch ,Enter   5.7  for 5 feet & 7 inch)
										<?php echo $form->textField($model, 'height', $model->getHtmlOptions('height')); ?>	
										<?php echo $form->error($model, 'height');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									  
									<?php if(in_array("marital_status",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'marital_status');?>
										<?php $mer =  array_merge($model->getHtmlOptions('marital_status'),array('empty'=>"Marital Status")); ?>
										<?php echo $form->dropDownList($model, 'marital_status', CHtml::listData(MaritalStatus::model()->listData(),'marital_id','marital_name') , $mer ); ?>
											
										<?php echo $form->error($model, 'marital_status');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									   
									
									  
									<?php if(in_array("religion_id",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'religion_id');?>
										<?php $mer =  array_merge($model->getHtmlOptions('religion_id'),array('empty'=>"Religion")); ?>
										<?php echo $form->dropDownList($model, 'religion_id', CHtml::listData(Religion::model()->listData(),'religion_id','religion_name') , $mer ); ?>
											
										<?php echo $form->error($model, 'religion_id');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									  
									  <?php if(in_array("mother_tongue",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'mother_tongue');?>
										<?php echo $form->textField($model, 'mother_tongue', $model->getHtmlOptions('mother_tongue')); ?>	
										<?php echo $form->error($model, 'mother_tongue');?>
									</div>  
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>

									 <?php if(in_array("education_level",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'education_level');?>
										<?php $mer =  array_merge($model->getHtmlOptions('model'),array('empty'=>"Education Level")); ?>
										<?php echo $form->dropDownList($model, 'education_level', CHtml::listData(EducationLevel::model()->listData(),'education_id','education_name') , $mer ); ?>
										<?php echo $form->error($model, 'education_level');?>
									</div>  
									 <?php }  ?>   
									   
									  <div class="clearfix"><!-- --></div>
									 <?php if(in_array("current_occupation",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'current_occupation');?>
										<?php $mer =  array_merge($model->getHtmlOptions('current_occupation'),array('empty'=>"Current Occupation")); ?>
										<?php echo $form->dropDownList($model, 'current_occupation', CHtml::listData(Occupation::model()->listData(),'occupation_id','occupation_name') , $mer ); ?>
										<?php echo $form->error($model, 'current_occupation');?>
									</div>  
									 <?php }  ?>       

								   <div class="clearfix"><!-- --></div> 	
									<?php if(in_array("experience_level",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'experience_level');?>
										<?php $mer =  array_merge($model->getHtmlOptions('model'),array('empty'=>"Expereience Level")); ?>
										<?php echo $form->dropDownList($model, 'experience_level', CHtml::listData(Experience::model()->listData(),'experience_id','experience_name') , $mer ); ?>
										<?php echo $form->error($model, 'experience_level');?>
									</div>  
									 <?php }  ?>       
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
											 if($amenties)
											 {
												 foreach($amenties as $k)
												 {
													 $amenitiesArray[$k] = @$amenities_array[$k];
												 }
											 }
											echo CHtml::checkBoxList('amenities',$model->amenities ,$amenitiesArray);                                              
											?>
										</div>
										<?php echo $form->error($model, 'amenities');?>
									</div>    
									<?
								}
								?>  
									  <div class="clearfix"><!-- --></div>
									
									
									
									 
									 <?php echo $form->hiddenField($model,'sub_category_id');?>
									 <?php echo $form->hiddenField($model,'country');?>
									 <?php if(in_array("price",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'price');?>
										<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price')); ?>
										<?php echo $form->error($model, 'price');?>
									</div>        
									 <?php }  ?>       
									  <div class="clearfix"><!-- --></div>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'mobile_number');?>
										<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('mobile_number')); ?>
										<?php echo $form->error($model, 'mobile_number');?>
									</div>        
									 <div class="clearfix"><!-- --></div> 
									 <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'user_id');?>
										<?php $mer =  array_merge($model->getHtmlOptions('user_id'),array('empty'=>"Select listing user")); ?>
										<?php echo $form->dropDownList($model, 'user_id',  CHtml::listData(ListingUsers::model()->findAll(array("condition"=>"status='A' and isTrash='0'")),'user_id','first_name') , $mer ); ?>
										<?php echo $form->error($model, 'user_id');?>
									</div>  
									 <div class="clearfix"><!-- --></div> 
									 
									 <div class="form-group col-lg-6"> 
										<?php echo $form->labelEx($model, 'state');?>
										  <?php $dropdwn =   array_merge( $model->getHtmlOptions('state'),array('empty'=>'Select region ',"style"=>"1",) )
										
										 ;  ?>
										 <span id="myDiv" style="padding-left:20px;"></span>
										<?php echo $form->dropDownList($model, 'state',  CHtml::listData(States::model()->getStateWithCountry_2($model->country),'state_id','state_name') , $dropdwn ); ?>
										<?php echo $form->error($model, 'state');?>
									</div>  
									<div class="clearfix"><!-- --></div> 
									
								   
									 <div class="clearfix"><!-- --></div> 
									 
									   <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'image');?>
									   
										<?php echo $form->error($model, 'image');?>
									</div> 
									 <div class="clearfix"><!-- --></div>
									 <?php 
								   if(!empty($image_array) )
								   {
									   
									   ?>
										<div class="property_img_box" style="margin-bottom:20px;">
											
											<?php
											$image = "";
											foreach($image_array as $k=>$v)
											{
												$image .= ",".$v;
											?>
											<div id="property_img_<?php echo $k;?>" class="property_img">
											<img src="<?php echo Yii::app()->params["uploadDir"]."/ads_thumb/".@$v ?>" style="width:140px;">
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
								   ?>
									<?php echo $form->hiddenField($model, 'image', $model->getHtmlOptions('image')); ?>
									
									 <div class="clearfix"><!-- --></div>
									<div style="height:20px;color:#4E4E4E;font-size:16px;background:#EAEAEA;padding:15px 0px 35px 15px;">Drag and drop Photos here or click below to select photos from your computer </div> 
									<div  style="height:15px;color:#4E4E4E;font-size:12px; ;padding:12px 0px 25px 7px;">Hint: File types allowed: jpg, gif, png, Max Width & Height : 1024px</div>
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
										 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:img,inp:val},function(data){  $("#PlaceAnAd_image").val(data) ;imgs = data; } );
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
				   </div>
				 
            
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Go To Next');?></button>
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
 
