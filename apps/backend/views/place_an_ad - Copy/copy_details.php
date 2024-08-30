<?php  defined('MW_PATH') || exit('No direct script access allowed');  
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
									  <div style="font-weight:bold;color:#6B6B6B;font-size:16px;margin-bottom:20px;">Ad Type :
									   <?php 
									   
									  
									  if(!empty($subcategory))
									  {
									  echo $subcategory->category->category_name;?>/<?php echo $subcategory->sub_category_name;?>&nbsp;<a href="<?php echo Yii::app()->createUrl("place_an_ad/create"); ?>" class="my_link">Change</a>
									  <?php
									  }	
									  else
									  {
										    echo $category->category_name;?>  &nbsp;<a href="<?php echo Yii::app()->createUrl("place_an_ad/create"); ?>" class="my_link">Change</a>
									   <?php
									  }
									  ?>
									  </div>
				   
									<div class="clearfix"><!-- --></div>
									<div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'ad_title');?>
										<?php echo $form->textField($model, 'ad_title', $model->getHtmlOptions('ad_title')); ?>
										<?php echo $form->error($model, 'ad_title');?>
									</div>      
									  
									 <div class="clearfix"><!-- --></div> 
									 
									<div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'ad_description');?>
										<?php echo $form->textArea($model, 'ad_description', array_replace($model->getHtmlOptions('ad_description'),array("rows"=>"10"))); ?>
										<?php echo $form->error($model, 'ad_description');?>
									</div>        
									   
									  <div class="clearfix"><!-- --></div> 
								 

									
									 
									<?php if(in_array("builtup_area",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'builtup_area');?>
										<?php echo $form->textField($model, 'builtup_area', $model->getHtmlOptions('builtup_area')); ?>
										<?php echo $form->error($model, 'builtup_area');?>
									</div> 
								   <?php }  ?>       
								 
									<?php if(in_array("bathrooms",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bathrooms');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bathrooms'),array('empty'=>"Select bathrooms")); ?>
										<?php echo $form->dropDownList($model, 'bathrooms',  $model->bathrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bathrooms');?>
									</div>  
									 <?php }  ?>             
									
								 
									 <?php if(in_array("bedrooms",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bedrooms');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bedrooms'),array('empty'=>"Select bedrooms")); ?>
										<?php echo $form->dropDownList($model, 'bedrooms',  $model->bedrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bedrooms');?>
									</div> 
									 <?php }  ?> 
									 	 <?php if(in_array("parking",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'parking');?>
										<?php echo $form->textField($model, 'parking',$model->getHtmlOptions('parking')); ?>
										<?php echo $form->error($model, 'parking');?>
									</div> 
									 <?php }  ?>        
									 <?php if(in_array("FloorNo",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'FloorNo');?>
										<?php echo $form->textField($model, 'FloorNo',$model->getHtmlOptions('FloorNo')); ?>
										<?php echo $form->error($model, 'FloorNo');?>
									</div> 
									 <?php }  ?>         
									 <?php if(in_array("property_name",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'property_name');?>
										<?php echo $form->textField($model, 'property_name',$model->getHtmlOptions('property_name')); ?>
										<?php echo $form->error($model, 'property_name');?>
									</div> 
									 <?php }  ?>        
									 <?php if(in_array("PrimaryUnitView",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'PrimaryUnitView');?>
										<?php echo $form->textField($model, 'PrimaryUnitView',$model->getHtmlOptions('PrimaryUnitView')); ?>
										<?php echo $form->error($model, 'PrimaryUnitView');?>
									</div> 
									 <?php }  ?>        
									 <?php if(in_array("occupant_status",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'occupant_status');?>
										<?php echo $form->dropDownList($model, 'occupant_status', array("Blocked"=>"Blocked","Vacant"=>"Vacant")   , $model->getHtmlOptions('occupant_status' ,array('empty'=>"Select Status"   )) ); ?>
										<?php echo $form->error($model, 'occupant_status');?>
									</div> 
									 <?php }  ?>        
								 
									 <?php if(in_array("bedrooms",$fields)){?>
										<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'community_id');?>
										<?php echo $form->dropDownList($model, 'community_id', CHtml::listData( Community::model()->findAllByAttributes(array('community_id'=>$model->community_id)) ,'community_id','community_name')    , $model->getHtmlOptions('community_id' ,array('empty'=>"Select Communtiy", "onChange"=>"getSubCommunity(this)",'class'=>'autoSelect_community form-control') )); ?>
										<?php echo $form->error($model, 'community_id');?>
										</div> 
										<div class="form-group col-lg-6">		
										<?php echo $form->labelEx($model, 'sub_community_id');?>
										
										<?php echo $form->dropDownList($model, 'sub_community_id',  CHtml::listData( SubCommunity::model()->findAllByAttributes(array('sub_community_id'=>$model->sub_community_id)) ,'sub_community_id','sub_community_name')   ,$model->getHtmlOptions('sub_community_id',array('empty'=>"Select SubCommunity" , 'class'=>'autoSelect_sub_community form-control' ) )); ?>
										<?php echo $form->error($model, 'sub_community_id');?>
										</div>		
									 <?php }  ?>        
									 
									  
								 
									  
									  
								 
									 
									 
									 <?php echo $form->hiddenField($model,'section_id');?>
									 <?php echo $form->hiddenField($model,'category_id');?>
									 <?php echo $form->hiddenField($model,'sub_category_id');?>
									 <?php echo $form->hiddenField($model,'country');?>
									  
									 <?php if(in_array("price",$fields)){?>
										 <?php
										 if($model->section_id==$model::RENT_ID){
											 ?>
											<div class="form-group col-lg-6">
												<div class="col-lg-6">
												<?php echo $form->labelEx($model, 'price');?>
												<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price')); ?>
												<?php echo $form->error($model, 'price');?>
												</div>
												<div class="col-lg-6">
												<?php echo $form->labelEx($model, 'rent_paid');?>
												<?php echo $form->dropDownList($model, 'rent_paid', array("monthly"=>"Monthly","yearly"=>"Yearly")   , $model->getHtmlOptions('rent_paid') ); ?>
												<?php echo $form->error($model, 'rent_paid');?>
												
												</div>
									
											</div>       
											<?php
										}
										else{
											?>
											<div class="form-group col-lg-6">
												<?php echo $form->labelEx($model, 'price');?>
												<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price')); ?>
												<?php echo $form->error($model, 'price');?>
											</div>   
											<?
										} 
									}
									   ?> 
									  
										        
									   
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'mobile_number');?>
										<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('mobile_number')); ?>
										<?php echo $form->error($model, 'mobile_number');?>
									</div> 
									<div class="clearfix"><!-- --></div>       
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'nearest_metro');?>
										<?php echo $form->textArea($model, 'nearest_metro', array_replace($model->getHtmlOptions('nearest_metro'),array("rows"=>"6"))); ?>
										<?php echo $form->error($model, 'nearest_metro');?>
									</div>
									  
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'nearest_railway');?>
										<?php echo $form->textArea($model, 'nearest_railway', array_replace($model->getHtmlOptions('nearest_railway'),array("rows"=>"6"))); ?>
										<?php echo $form->error($model, 'nearest_railway');?>
									</div>     
									<div class="clearfix"><!-- --></div>
									   <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'amenities');?>
										<div class="container34">
										  <?php
											 $amenities_array=	 CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_name');
											// $amenties=   CHtml::listData($subcategory->relatedAmenities,'amenities_id','amenities_id');
											/*
											 $amenitiesArray =  array();
											 if($amenties)
											 {
												 foreach($amenties as $k)
												 {
													 $amenitiesArray[$k] = @$amenities_array[$k];
												 }
											 }
											 * */
											echo CHtml::checkBoxList('amenities',$model->amenities ,$amenities_array);                                              
											?>
										</div>
										<?php echo $form->error($model, 'amenities');?>
									</div>    
									 <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'user_id');?>
										<?php $mer =  array_merge($model->getHtmlOptions('user_id'),array('empty'=>"Select Customer",'class'=>"autoSelect_customer form-control")); ?>
										<?php echo $form->dropDownList($model, 'user_id',  CHtml::listData(ListingUsers::model()->findAll(array("condition"=>"status='A' and isTrash='0'")),'user_id','first_name') , $mer ); ?>
										<?php echo $form->error($model, 'user_id');?>
									</div>  
									 
									 <div class="form-group col-lg-6">
										 
										<?php echo $form->labelEx($model, 'district');?>
										<?php echo $form->dropDownList($model, 'district', CHtml::listData( District::model()->findAllByAttributes(array('district_id'=>$model->district)) ,'district_id','district_name')    , $model->getHtmlOptions('district' ,array('empty'=>"Select Near By  Location ", 'class'=>'autoSelect_district form-control') )); ?>
										<?php echo $form->error($model, 'district');?>
										</div> 
								 
								
								   <?php echo $form->hiddenField($model, 'state', $model->getHtmlOptions('state')); ?>
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
											<img src="<?php echo Yii::app()->apps->getBaseUrl('uploads/ads/'.@$v) ?>" style="width:140px;">
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
 
