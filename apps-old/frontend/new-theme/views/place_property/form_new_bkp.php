<?php defined('MW_PATH') || exit('No direct script access allowed');
if($this->id=='update_property'){
    if($this->functionality=='picture'){
        ?>
        <style>
            .full-content { display:none !important;}
           
        </style>
        <?php
    }
}
if($model->isNewRecord){ echo '<script>var isnewrecord= 1;</script>'; }

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
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus),
        	'enableAjaxValidation'=>true,
							'id'=>'post-property',
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {
				     
						form.find("#bb").html("Validating..");
						return true;
					}',
					'afterValidate' => 'js:function(form, data, hasError) { 
					 
					if(hasError) {
					 
						  $("html, body").animate({
        scrollTop: form.find(".errorMessage:visible:first").offset().top-110
    }, 2000);
						
							form.find("#bb").html("Submit Property");
							return false;
					}
					else
					{
							form.find("#bb").html("Please wait..");	return true;
					}
					}',
					
					
							),
							'htmlOptions'=>array('autocomplete'=>'off')
							));  ?>
        <style>.jqx-combobox-content{ text-indent:4px;}  
        span#selected_text, .only-no-sector a {    font-size: 14px !important;    font-weight: 600; }
        .r-detail-c {margin-top: 26px;}
        #place_an_ad .place-property {
 
    border: 0px solid rgba(0,47,52,.2);
    -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
}
#place_an_ad .place-property { max-width:550px;}
.subheading_font {
    background: #ededed;
    padding: 5px 15px;
    font-size: 17px !important;
    vertical-align: middle;
    color: #72727d !important;
    margin-bottom: 1rem;
} 
  #place_an_ad h3.box-title {

    margin-bottom: 20px;
    font-family: var(--main-font) !important;
    font-weight: 700;
    font-size: 24px;
    text-align: initial;
    line-height: inherit;
    text-transform: initial;
    padding: 5px  0px;
    margin-bottom: 0px;

}
#place_an_ad .place-property.sector1 {

   
    padding: 0px 13px;

}
    h3.box-title   {

    color: #72727d !important;
    font-weight: 600 !important;
    font-size: 25px;
    line-height: 47px;
    height: auto;
    vertical-align: middle;

}
#place_an_ad ._1ybgv {
    width: 100%;
    padding: 0 0 10px;
}#place_an_ad .place-property{     padding: 0px 13px; }#place_an_ad .rui-3blDo{ padding-left:0px; }
#place_an_ad .insidecontent { padding-left:0px; padding-right:0px; padding-top:15px;padding-bottom:15px; }
      
      #place_an_ad ._2ytqd {

    box-sizing: border-box;
    border-bottom: 1px solid rgba(0,47,52,.2);
    float: none;
    height: 0;
    width: auto;
    margin-left: -13px;
    margin-right: -13px;
    clear: both;
    display: block;

}
#place_an_ad .row  label {
    color: #72727d !important;
    font-weight: 400;
}#place_an_ad .form-control {
    color: #72727d;font-weight: 400;
    border-color: #dfe0e3;
}
#place_an_ad .minimize_form{ max-width:100% !important; }

.amn1 { margin-left: -15px;

margin-right: -15px; }

#place_an_ad .amn1 .amn {
    max-height: initial;
  
}#moredetails .col-sm-5 label::after {

    content: ':';
    display: inline-block;
    margin-left: 10px;

}.rui-qvKkT1 {

    color: rgba(0,47,52,.64);
    font-size: 11px;
    font-weight: 400;
    display: inline-block !important;
    float: none;
    line-height: 24px;
    padding-left: 10px;

}.form-check .form-check-label, .form-radio .form-check-label {
    
    padding-left: 9px;
    line-height: 1.2;
}
        </style>
       
        <div class="box box-primary place_ad place-property <?php echo $model->isNewRecord ? 'sector1' : 'sector2' ;?>">
             <h3 class="box-title hide"><?php echo $model->isNewRecord ? 'Post your Property' : 'Update your Property' ;?></h3>
            <div class="box-header">
                
                    
                
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body <?php echo $model->category_id=='121' ? 'land-prop' : '';?>" id="boxdy">
				 <div class="spinner rmsdf">
  <div class="bounce1"></div>
  <div class="bounce2"></div>
  <div class="bounce3"></div>
</div>
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
                <style>
					.select2{ width:100% !important;}
                .subhead {
    background-color: 
#008000;
border-radius: 3px;
clear: both;
color:
    #ffffff;
    float: left;
    margin-bottom: 7px;
    margin-top: 8px;
    padding: 7px 0;
    text-indent: 9px;
    text-transform: uppercase;
   width: calc(100% - 15px);
    margin-top:25px;
}.dropzone {
    
min-height: 160px; 
background:
    #fafafa;
    
}
@media only screen and (max-width: 600px) {
   #place_an_ad ._1ybgv.full-content ,#place_an_ad ._1ybgv.full-content .rui-3blDo { display:block;}
}
.only-no-sector{ display:none; }
                #section_picker.open-second .sect_select { display:none;}
                #section_picker.open-second .only-no-sector { display:block;}
                </style>
           
               
               
                <div id="section_picker" >
						 <div class="insidecontent  padding-top-0">
						     
						     <h4 class="subheading_font row ">Choose a Category</h4>
						     
                <div class="col-sm-6 picker_class sect_select ">
                
                <div class="clearfix"><!-- --></div>
                <div class="listli sector_details sector1">
				<?php
				echo CHtml::radioButtonList('section_id',$model->section_id,$section,array( 'data-url'=>Yii::App()->createUrl($this->id.'/select_category3'),'onchange'=>'load_via_ajax_category(this,"category_id")' ,'separator'=>'','labelOptions'=>array('class'=>'')
				,'template'=>'<div class="inputGroup" id="sec_{idInput}"> <span class="img"></span>  {input}   {label} <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg><div class="clearfix"><!-- --></div></div>') );                                              
				?>
                </div>
                  <div class="clearfix"><!-- --></div>
             
                      <div class="col-sm-12 sector1 picker_class no-padding w_for <?php echo  ($model->section_id=='4') ?  '' : 'hide';?>">
                  <div class="clearfix"><!-- --></div>
             
                <div class="clearfix"><!-- --></div>
                
                
                
                <div class="listli  sector_details">
                
				<?php

				echo CHtml::radioButtonList('w_for',$model->w_for,$model->wanted_for(),array('onchange'=>'openFields2(this)','separator'=>'','labelOptions'=>array('class'=>'')
				,'template'=>'<div class="inputGroup">{input}   {label} <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg><div class="clearfix"><!-- --></div></div>'));                                              
				?>
  
   
                </div>
                
                
                </div>
           
                </div>
             
                 
                <div id="<?php echo $model->modelName.'_l_type_main_div';?>"  class="col-sm-6 picker_class  l_type <?php echo  empty($model->listing_type ) ?  'hidden' : '';?>">
                 <h3 class="subHeadh2 ain padding-bottom-0"><span class="only-no-sector">Select Category</span> <span class="pull-right only-no-sector"><span id="selected_text"></span> <a href="javascript:void()" onclick="openSelectedSection()">Back</a></span></h3>
                <div class="clearfix"><!-- --></div>
             
                <div class="clearfix"><!-- --></div>
                
                
                
                <div class="listli sector3 sector_details">
               
				<?php
				/*
				echo CHtml::radioButtonList('listing_type',$model->listing_type,$list_type,array('data-url'=>Yii::App()->createUrl($this->id.'/select_category3'),'onchange'=>'load_via_ajax_category(this,"category_id")' ,'separator'=>'','labelOptions'=>array('class'=>'')
				,'template'=>'<div class="inputGroup" id="l_type_{idInput}"><span class="img"></span> {input}  <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg>  {label}<div class="clearfix"><!-- --></div></div>'));                                              
				
				*/
				?>
  <?php
 $list_typeq =    Category::model()->ListDataForJSON_ID_BySEctionNew($model->section_id) ;
	 
				echo CHtml::radioButtonList('listing_type',$model->listing_type,$list_typeq,array( 'separator'=>'','onchange'=>'load_via_ajax_main_category(this)','data-url'=>Yii::App()->createUrl($this->id.'/select_category4'),'separator'=>'','labelOptions'=>array('class'=>'')
				,'template'=>'<div class="inputGroup">{input}   {label}</div>'));                                              
				?>
  
   
                </div>
                
                
                </div>
                   <?php  
                     $catlist =  Category::model()->ListDataForJSON_ID_ByListingType($model->listing_type)   ;
                    $m_class = empty(  $catlist ) ? 'hidden' : '' ; 
                    ?>
                <div class="col-sm-6 picker_class c_type <?php echo $m_class;?>" id="<?php echo $model->modelName.'_category_id_main_div';?>">
                <h3 class="subHeadh2 ain padding-bottom-0"><span>&nbsp;</span></h3>
                <div class="clearfix"><!-- --></div>
             
                <div class="clearfix"><!-- --></div>
                
                <style>
                   .listli.r-detail-c .inputGroup input:checked ~ label::after {
    content: 'Go';
    background: #fff;
    position: absolute;
    right: 10px;
    width: 26px;
    height: 20px;
    line-height: 20px;
    vertical-align: middle;
    padding: 0px 5px;
    background: var(--logo-color);
    color: #fff;
    border-radius: 5px;
    z-index: 11;
    font-size: 12px;
}label span.required{ font-size: 14px !important; }
#member .select2-container--default .select2-selection--single, #place_an_ad .select2-container--default .select2-selection--single {
    border: 1px solid #eee;
}
                </style>
                
                <div class="listli sector_details r-detail-c"  >
                
				<?php

				echo CHtml::radioButtonList('category_id',$model->category_id,$catlist,array( 'separator'=>'','onclick'=>'validateInputSector()','labelOptions'=>array('class'=>'')
				,'template'=>'<div class="inputGroup">{input}   {label}</div>'));                                              
				?>
  
   
                </div>
                
                
                </div>
                 <div class="clearfix"><!-- --></div>
                </div>
                <div class="clearfix"><!-- --></div>
                </div>
                <div id="moredetails" >
                
                   <h4 class="subheading_font row  full-content">Selected Category</h4>
                  <div class="_1ybgv full-content" data-aut-id="breadcrumb"><div class="rui-3blDo"><ol class="rui-1CmqM" id="textChanger"></ol></div><div><a class="_3OiU0"><span><a href="javascript:void(0)" style="font-weight: 600;letter-spacing: 1.5px;" onclick="movingtoStep1()">Change</a></span></a></div></div>
                 <div class="_2ytqd"></div>
                  <div class="rui-2SwH7 rui-1JF_2">
                 
                  	 <div class="clearfix"><!-- --></div> 
                  	 
                  	 <div class="insidecontent">
						 <?php
						     if($this->id=='update_property' and $this->functionality=='picture'){
						         ?>
						         <div class="col-sm-5 text-right">
											    <label for="PlaceAnAd_sub_category_id" class="required">Property</label>
									 
										</div>
											
										<div class="col-sm-7">
										    <?php echo $model->ad_title;?>
						               </div>
						         <?
						     }
						     ?> 	
						   <div class="minimize_form full-content">
						        
							<div class="row for-land  form-group">
							    <?php 
							    $sub_category =  CHtml::listData(Subcategory::model()->ListDataForCategory(121),'sub_category_id','sub_category_name'); ?> 
							     	<div class="clearfix"><!-- --></div> 
									 
											<div class="col-sm-5 text-right">
											    <label for="PlaceAnAd_sub_category_id" class="required">Sub Category <span class="required">*</span></label>
									 
										</div>
												<div class="col-sm-7">
										<?php $mer =  array_merge($model->getHtmlOptions('sub_category_id'),array( 'class'=>'input-text  form-control','empty'=>'Select')); ?>
										<?php echo $form->dropDownList($model, 'sub_category_id', $sub_category , $mer ); ?>
										<?php echo $form->error($model, 'sub_category_id');?>
											</div>
									</div>       
							    
						 
                  <div class="row">
                   
									<div class="col-sm-5 text-right">	<?php echo $form->labelEx($model, 'ad_title');?></div>
									<div class="col-sm-7">
										<style>
										html #PlaceAnAd_ad_title::placeholder {   color: #b6b6b6 !important;  opacity: 1; /* Firefox */}
										html #PlaceAnAd_ad_description::placeholder {   color: #b6b6b6 !important;  opacity: 1; /* Firefox */}
										</style>
										<?php echo $form->textField($model, 'ad_title', $model->getHtmlOptions('ad_title',array('placeholder'=>'','class'=>'input-text form-control'))); ?>
										<span class="rui-qvKkT"></span>
										<?php echo $form->error($model, 'ad_title');?>
									 
									</div> 
					</div>				  
									 <div class="clearfix"><!-- --></div> 
						 <div class="row">			 
									<div class="form-group col-lg-12">
								 <div style="width:100%;height:15px;"></div>
								 <?php echo $form->labelEx($model, 'ad_description');?>
										<?php echo $form->textArea($model, 'ad_description', array_replace($model->getHtmlOptions('ad_description'),array("rows"=>"5",'placeholder'=>'Mention the key feature of your property (short description of your property)'))); ?>
										 
										<?php echo $form->error($model, 'ad_description');?>
									</div>    
							</div>	
							
						
							
							<div class="row  form-group">	
								 <?php
										
									if($model->checkFieldsShow2('builtup_area')){ ?> 
								
										<div class="col-sm-5 text-right">
										<?php echo $form->labelEx($model, 'builtup_area');?>
										</div>
											<div class="col-sm-7">
                                            <div style="width:50%;margin-right:5px;float:left;max-width: 83px;">
                                            <?php $mer =  array_merge($model->getHtmlOptions('area_unit'),array( 'class'=>'input-text  form-control',)); ?>
                                            <?php echo $form->dropDownList($model, 'area_unit',  CHtml::listData(AreaUnit::model()->listData(),'master_id','master_name') , $mer ); ?>
                                            <?php echo $form->error($model, 'area_unit');?>
                                            </div>
									  <div style="width:calc(50% - 5px);margin-right:0px;float:left;max-width:100px;">
										<?php echo $form->textField($model, 'builtup_area', $model->getHtmlOptions('builtup_area',array( 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  , 'class'=>'input-text  form-control',))); ?>
										
										<?php echo $form->error($model, 'builtup_area');?>
										 <div style="width:50%;margin-right:5px;float:left">
									</div> 
										<div class="clearfix" style="width:100%;"><!-- --></div> 
								 
								</div> 
								        </div>
								<?php } ?>
								</div>
									<div class="clearfix"><!-- --></div>
								<div class="row  form-group bedroomsclass">
									<?php
								    if($model->checkFieldsShow2('bedrooms')){ ?> 
								    <div class="col-sm-5 text-right">
								 
										<?php echo $form->labelEx($model, 'bedrooms');?>
										
										</div>
										<div class="col-sm-7">
										<?php $mer =  array_merge($model->getHtmlOptions('bedrooms'),array('empty'=>"Select",'class'=>'input-text  form-control')); ?>
										<?php echo $form->dropDownList($model, 'bedrooms',  $model->bedrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bedrooms');?>
									</div> 
									<?php } ?>
									</div>
										<div class="clearfix"><!-- --></div>
								<div class="row  form-group bathroomsclass">
							 <?php
					    if($model->checkFieldsShow2('bathrooms')){ ?>
						<div class="col-sm-5 text-right">
							<?php echo $form->labelEx($model, 'bathrooms');?>
							</div>
							<div class="col-sm-7 ">
							<?php $mer =  array_merge($model->getHtmlOptions('bathrooms'),array('empty'=>"Select",'class'=>'input-text  form-control')); ?>
							<?php echo $form->dropDownList($model, 'bathrooms',  $model->bathrooms() , $mer ); ?>
							<?php echo $form->error($model, 'bathrooms');?>
						</div>  
						<?php } ?>
						</div>
		 
							   		<div class="clearfix"><!-- --></div> 
									 
							   	<div class="">
							   	    	<div class="clearfix"><!-- --></div>
									   <div class="amn1">
										<div class="amn">
										  <?php
										   $categoris =   CHtml::listData(Master::model()->listData(2),'master_id','master_name');
										    
										   foreach($categoris as $k=>$v){
											    $amenities_array=	 CHtml::listData(Amenities::model()->findAllCategories($k),'amenities_id','amenities_name');
												 if(!empty($amenities_array)){ 
											   echo '<div class="col-sm-12 amlabel amn-'.$k.'" style="">';
											       
											      echo '<h4 class="subheading_font row ">'.$v.'</h4><div class="clearfix"></div>';
											      foreach( $amenities_array as $k=>$v){
													
													  echo '<div class="form-check form-check-flat"  id="amnitm_'.$k.'"><label class="form-check-label"><input class="amnit" value="'.$k.'" id="amenities_'.$k.'" '; echo  in_array($k,(array) $model->amenities) ? 'checked' : '';  echo ' type="checkbox" name="amenities[]" onchange="expandthis(this)" >  '.$v.' <i class="input-helper"></i></label></div>';
												  }
											      
											      
											      
											       echo '</div>';
											   }
										   }
										   
									 
											 
								            //	echo CHtml::checkBoxList('amenities',$model->amenities ,$amenities_array,array('separator'=>'','labelOptions'=>array('class'=>''),'template'=>'<div class="form-check form-check-flat"><label class="form-check-label">{input}  {labelTitle} <i class="input-helper"></i></label></div>'));                                              
											?>
										</div>
										<div class="clearfix"></div>
										<div class="expandDiv hide" onclick="toggleClassExpand()"></div>
										<div class="clearfix"></div>
										<?php echo $form->error($model, 'amenities');?>
									</div>    
									<div class="clearfix"><!-- --></div>    
									</div>  
									
					
							<div class="clearfix"><!-- --></div>
							</div>
					 
						  
						  
						  <div class="insidecontent full-content">
						   <h4 class="subheading_font row ">Price</h4>
                            <div class="minimize_form">
							<div class="row">			
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'price');?>
										<div class="clearfix"><!-- --></div> 
										<span class="lab-p"><?php echo $model->currencyTitle;?></span>
										<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price',array('oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"))); ?>
										<div class="clearfix"><!-- --></div>
										<?php echo $form->error($model, 'price');?>
										</div>
										 
										<div class="form-group col-lg-4 rent_paid <?php echo $model->section_id==$model::RENT_ID ? '' : 'hidden';?>">
										<label for="PlaceAnAd_rent_paid" class="required">Rent Paid  <span class="required">*</span></label>
										<?php echo $form->dropDownList($model, 'rent_paid', $model->paidArray()  , $model->getHtmlOptions('rent_paid',array('empty'=>'Select Option' , 'class'=>'form-control')) ); ?>
										<?php echo $form->error($model, 'rent_paid');?>
										</div>
									</div>			
								 <div class="clearfix"></div>
								 </div>
								 	<div class="clearfix"></div>
									
							 
								  <div class="clearfix"><!-- --></div>
								  
								  <div class="clearfix"><!-- --></div>
                				<div class="clearfix"></div>
									</div>
							 	
							
               	   <div class="insidecontent">
                <div class="clearfix"><!-- --></div>
		 <div class="clearfix"><!-- --></div>
		 <div class="">
                		 	<div class="col-lg-12">
							 <?php  
							 $fileField = 'image';
							 $title_text = 'Add Photos';
							 $types = '.png,.jpg,.jpeg';
							 $maxFiles = '20';
							 $maxFilesize = '5';
				 
							  $this->renderPartial('root.apps.frontend.new-theme.views.place_property._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text')); ?>
						</div> 
                </div>
                 <div class="clearfix"><!-- --></div> 
		  </div> 
	 
		 <div class="clearfix"><!-- --></div> 
		  <div class="clearfix"></div>
		   <div class="insidecontent">
								 <?php $this->renderPartial('root.apps.frontend.new-theme.views.place_property.add_property_types');?>
								 <div class="clearfix"></div>
		 </div>					
		 <div class="clearfix"><!-- --></div> 
		   <div class="insidecontent full-content">
		       <h4 class="subheading_font row ">Confirm your location</h4>
                    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('assets/js/typehead/jquery.typeahead.min.css');?>">
                              <style>
                              .lgJTPn {
    width: 90%;
    max-width: 600px;
    position: relative;
    top: 0px;
}.jNhpJt {
    display: flex;
    -moz-box-align: center;
    align-items: center;
    height: 54px;
    background: rgb(255, 255, 255) none repeat scroll 0% 0%;
    border-radius: 8px;
    box-shadow: rgba(28, 28, 28, 0.08) 0px 2px 8px;
    border: 1px solid rgb(232, 232, 232);
}.gaQgjK {
    display: flex;
    justify-content: space-around;
    position: relative;
    height: 100%;
    width: 340px;
    border-radius: 8px;
    padding: 0px 10px;
    -moz-box-align: center;
    align-items: center;
}.rbbb40-1.MxLSp.pointer {
    position: absolute;
    left: 8px;
    z-index: 1111111;
}
.MxLSp {
    display: flex;
    -moz-box-align: center;
    align-items: center;
    cursor: inherit;
}.kIxlGM {
    display: inline-block;
    vertical-align: middle;
    line-height: 1;
    width: 20px;
    height: 20px;
}
           .js-typeahead-user_v2::placeholder {
    color: #eee !important;
    opacity: 1;
}                    </style>
                              
                               <script type="text/javascript" src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/typehead/jquery.typeahead.min.js');?>"></script>                                     
                
                   <div class="clearfix"><!-- --></div>
                 <div class="clearfix"><!-- --></div>
                 <div class="minimize_form">
                
		
                <div class="clearfix"><!-- --></div>
                <?php
                $city_title = ''; 
                if(!empty($model->city)){
					$CityData = City::model()->getById($model->city);
					if(!empty($CityData)){ $city_title = trim($CityData->city_name); }
				}
				?>
              <div tabindex="-1" class="sc-chAAoq lgJTPn" style=" margin:20px auto;">
   <div class="sc-cBdUnI jNhpJt">
      <div class="sc-18n4g8v-0 gAhmYY sc-hdPSEv gaQgjK" style="width:100% !important;">
         <i class="rbbb40-1 MxLSp pointer" color="#F57082" size="20">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#F57082" width="20" height="20" viewBox="0 0 20 20" aria-labelledby="icon-svg-title- icon-svg-desc-" role="img" class="rbbb40-0 kIxlGM">
               <linearGradient id="ckfdzuddo0096256u6dgh9rpm" x1="0" x2="100%" y1="0" y2="0">
                  <stop offset="0" stop-color="#F57082"></stop>
                  <stop offset="100%" stop-color="#F57082"></stop>
               </linearGradient>
               <title id="icon-svg-title-"></title>
               <desc id="icon-svg-desc-">It is an icon with title </desc>
               <title>location-fill</title>
               <path d="M10.2 0.42c-4.5 0-8.2 3.7-8.2 8.3 0 6.2 7.5 11.3 7.8 11.6 0.2 0.1 0.3 0.1 0.4 0.1s0.3 0 0.4-0.1c0.3-0.2 7.8-5.3 7.8-11.6 0.1-4.6-3.6-8.3-8.2-8.3zM10.2 11.42c-1.7 0-3-1.3-3-3s1.3-3 3-3c1.7 0 3 1.3 3 3s-1.3 3-3 3z" fill="url(#ckfdzuddo0096256u6dgh9rpm)"></path>
            </svg>
         </i>
         <div class="typeahead__container" id="form-user_v2" style="width:100%;">
        <div class="typeahead__field">
            <div class="typeahead__query">
                <input class="js-typeahead-user_v2" name="user_v1[query]" value="<?php echo $city_title;?>" placeholder="Your Property Loccaion"  style="border: 0px;padding-left: 23px;outline: none;font-size: 16px;font-weight: normal;" autocomplete="off">
            </div>
        </div>
    </div>
    
          <i class="rbbb40-1 MxLSp sc-fHSTwm hyorsL rightDown" color="#4F4F4F" size="12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#4F4F4F" width="12" height="12" viewBox="0 0 20 20" aria-labelledby="icon-svg-title- icon-svg-desc-" role="img" class="rbbb40-0 fQZfgq">
               <linearGradient id="ckfdzuddo0097256u5tby9y95" x1="0" x2="100%" y1="0" y2="0">
                  <stop offset="0" stop-color="#4F4F4F"></stop>
                  <stop offset="100%" stop-color="#4F4F4F"></stop>
               </linearGradient>
               <title id="icon-svg-title-"></title>
               <desc id="icon-svg-desc-">It is an icon with title </desc>
               <title>down-triangle</title>
               <path d="M20 5.42l-10 10-10-10h20z" fill="url(#ckfdzuddo0097256u5tby9y95)"></path>
            </svg>
         </i>
        </div>
        
    </div>
</div>
<div class="hide">
<?php echo $form->hiddenField($model, 'country'   ); ?>
<?php echo $form->error($model, 'country');?>
<?php echo $form->hiddenField($model, 'state'   ); ?>
<?php echo $form->error($model, 'state');?>
</div>
<?php echo $form->hiddenField($model, 'city'   ); ?>
<?php echo $form->error($model, 'city');?>
    <script>
		function getUrladd(){
			 var  state_lookup =  $('#<?php echo $model->modelName;?>_country').val();
			 return FindCitiesadd+'/country_id/'+state_lookup;
		 }
		 var FindCitiesadd = "<?php echo Yii::app()->createUrl('ajax/FindCitiesAd');?>";
		 function findCities(){
	
			$.typeahead({
    input: '.js-typeahead-user_v2',
    minLength: 0,
    order: "asc",
    dynamic: true,
    delay: 500,
    backdrop: {
        "background-color": "#fff"
    },
    template: function (query, item) {
 
     
 
        return '<span class=" ">' +
          
            '<span class="username">{{username}} </span>' +
            '<span class="id bltClss"  >{{country}}</span>' +
        "</span>"
    },
    emptyTemplate: "no result for {{query}}",
    source: {
        user: {
             
          display: ["username","id"],
            ajax: function (query) {
                return {
                    type: "GET",
                    url:  getUrladd(),
                    path: "data.user",
                    data: {
                        q: "{{query}}"
                    },
                
                }
            }
 
        },
    },
    callback: {
        onClick: function (node, a, item, event) {
 
		 $('#PlaceAnAd_country').val(item.country_id);
		 $('#PlaceAnAd_state').val(item.state_id);
		 $('#PlaceAnAd_city').val(item.id);
		     
 
        },
        onCancel:  function (node, a, item, event) {
 	
 
 
        }, 
        onSendRequest: function (node, query) {
            console.log('request is sent')
        },
        onReceiveRequest: function (node, query) {
            console.log('request is received')
        }
    },
    debug: true
});
}
 
        $(function(){
			if($('.js-typeahead-user_v2').length >=1 ){
				findCities();
			}
		});
        </script>
                
                <div class="clearfix"><!-- --></div>
                    <?php $this->renderPartial('root.apps.frontend.new-theme.views.place_property._location',compact('form'));?> 
	
                   <div class="clearfix"><!-- --></div>
               </div>
               </div>
               
                   <div class="_2ytqd"></div>
                <div class="clearfix"><!-- --></div>
                 <?php 
                 if(Yii::App()->isAppName('frontend')){  ?> 
                <div class="insidecontent">

<div class="clearfix"></div>
 
 <h4 class="subheading_font row full-content ">Your Contact Details </h4>
<div class="clearfix"></div>
 
<div class="noneditable full-content" style="position:relative;">
    	 <div class="col-sm-12 form-group seperatePlacead">
		 <style>.seperatePlacead  { z-index:2; text-align:right}</style>
		 <a  href="<?php echo Yii::app()->createUrl('member/change_details');?>" class="btn btn-warning">Change Contact Details</a>
		 </div>
	<div class="ovlo-customer"  ></div>
<div class=" ">					  
					<style>
					    .ovlo-customer {
    
    background: rgba(238, 238, 238,0.5);
}
				.seperatePlacead {
   
    margin-top: 15px;
}	    
					</style>
				<div class="_35tqs" style="width:116px;float:left;display:none;">
				    <div class="_2P9Mt"><div data-aut-id="avatarWrapper"><figure class="rui-D_EoZ" style="width: 100px; height: 100px; background-image: url('<?php echo $this->member->getAvatarUrl( 124, '',  true); ?>');"></figure></div> </div>
				    </div>
			 <div class="_35tqs" style="width:100%;float:left; padding:10px; ">
			      <div class="row    form-group">
                   <?php 
										$model->contact_person =  empty($model->contact_person) ? $this->member->first_name : $model->contact_person ;?>
									<div class="col-sm-5 text-right">	<?php echo $form->labelEx($model, 'contact_person');?></div>
									<div class="col-sm-7">
									 
										<?php echo $form->textField($model, 'contact_person', $model->getHtmlOptions('contact_person',array('placeholder'=>'','class'=>'input-text form-control'))); ?>
										<span class="rui-qvKkT"></span>
										<?php echo $form->error($model, 'contact_person');?>
									 
									</div> 
					</div>	
					  <div class="row    form-group">
                   <?php 
										$model->mobile_number =  empty($model->mobile_number) ? $this->member->phone : $model->mobile_number ; 
										$model->mobile_number = Yii::t('app',$model->mobile_number,array('-'=>' '));;?>
									<div class="col-sm-5 text-right">	<?php echo $form->labelEx($model, 'mobile_number');?></div>
									<div class="col-sm-7">
									 
										<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('ad_title',array('placeholder'=>'','class'=>'input-text form-control'))); ?>
										<span class="rui-qvKkT"></span>
										<?php echo $form->error($model, 'mobile_number');?>
									 
									</div> 
					</div>
					 
								  <div class="row    form-group">
                   
									<div class="col-sm-5 text-right"><label for="PlaceAnAd_whatsapp" class="required">Whatsapp Number</label></div>
									<div class="col-sm-7">
									 
										<?php echo CHtml::textField(  'whatsapp',  $this->member->whatsapp, array('placeholder'=>'','class'=>'input-text form-control' )); ?>
										<span class="rui-qvKkT"></span>
									 
									 
									</div> 
					</div>
							 
											<div class="clearfix" style="width:100%;"></div>
									
											<div class="form-group col-lg-6 hide">
										<?php 
										$model->landline =  empty($model->landline) ? $this->member->LandLineNo : $model->landline ; 
										echo $form->labelEx($model, 'landline');?>
										<?php echo $form->textField($model, 'landline', $model->getHtmlOptions('landline')); ?>
										<?php echo $form->error($model, 'landline');?>
										</div> 
										</div>
										</div> 
										<div class="clearfix"></div>
										<div class="row">
									
										</div> 
										<div class="clearfix"></div>
										</div>
										<div class="clearfix"></div>
										 
								<div class="row">			 
										 	 <div class="form-group col-lg-6 hide">
										<?php if(Yii::app()->user->getId()){ if($model->isNewRecord){   $model->user_id = Yii::app()->user->getId(); }  }  ?> 
										<?php echo $form->labelEx($model, 'user_id');?>
										<?php echo $form->hiddenField($model, 'user_id'   ); ?>
										<?php echo $form->error($model, 'user_id');?>
										<?php echo $form->hiddenField($model, 'section_id'   ); ?>
										<?php echo $form->error($model, 'section_id');?>
										<?php echo $form->hiddenField($model, 'listing_type'   ); ?>
										<?php echo $form->error($model, 'listing_type');?>
									 
										<?php echo $form->hiddenField($model, 'w_for'   ); ?>
										<?php echo $form->error($model, 'w_for');?>
										<?php echo $form->hiddenField($model, 'category_id'   ); ?>
										<?php echo $form->error($model, 'category_id');?>
									</div>
		</div>					 
                <div class="clearfix"><!-- --></div>
                </div>
                   <div class="_2ytqd"></div>
             <?php } 
             else{
				 
				  $this->renderPartial('root.apps.frontend.new-theme.views.place_property._admin_settings',compact('form'));
			 }
             
             ?> 
             
                <div class="clearfix"><!-- --></div>
               
                
                </div>
                <div class="clearfix"><!-- --></div>
               </div>
            </div>
            <div class="box-footer  " style="border:0px;padding-top:0px; ">
                <div class="pull-right">
                    <button type="submit" id="bb" class="btn btn-primary  "   data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Submit Property');?></button>
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
var modelName = '<?php echo $model->modelName;?>';
var cityUrl   = '<?php echo YIi::App()->createUrl($this->id.'/getCityId');?>';
var customer_url = '<?php echo Yii::app()->createUrl('place_an_ad/Customer' );?>';
</script>
 
<script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/place_ad_script.js?q=33');?>"></script>
<script type="text/javascript">
<?php
if(Yii::app()->isAppName('backend')){ ?> 
$(function(){
pickCustomer()
})	
<?php } ?> 	      
				
			 
    
<?php
if(!empty($model->category_id)){
    ?>
    $(function(){
		validateInputSector();
    })
    <?
}
?>
 
</script>
  
  <script>
  var location_text_url ='<?php echo Yii::App()->createUrl('place_an_ad/city_details');?>';
   var hiddenAmenities ='<?php echo Yii::App()->createUrl('place_an_ad/hidden_ammenities');?>';
  function getCityDetails(k){
   $.get(location_text_url,{'id':$(k).val()},function(data){ var d = JSON.parse(data);  location_text_details = d.city_name; $('#PlaceAnAd_enter_city').val(d.city) ;  
   
       $('#PlaceAnAd_area_location').val($('#PlaceAnAd_area_location').val()).change();
       
   })
  }
  function emptyInput(k){ if($('#select_from_list').val()==''){ $(k).val(''); }  }
        
        </script>
        <style>.autocomplete-suggestions {
    background-color: #fff;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-shadow: 0 4px 6px 2px rgba(0, 0, 0, 0.1);
    font-size: .875em;
    margin-left: 1px;
    clear: both;
}
.autocomplete-suggestions {
    overflow: auto;
}.autocomplete-suggestion {
    position: relative;
    cursor: pointer;
}.suggestion-img {
    float: left;
    height: 40px;
    line-height: 40px;
    margin: 4px 8px 0 6px;
    overflow: hidden;
    text-align: center;
    vertical-align: middle;
    width: 40px;
} .suggestion-img img {
    max-width: 100%;
    max-height: 40px;
    display: block;
}.suggestion-wrapper {
    display: block;
    height: 48px;
    overflow: hidden;
    position: relative;
    text-overflow: ellipsis;
    vertical-align: middle;
    line-height: 16px;
    padding: 7px;
}.suggestion-value {
    display: block;
    line-height: normal;
    font-weight: 700;
}.sub-text {
    color: #999;
    font-size: 11px;
    font-weight: normal;
}.sub-text {
    color: #999;
    font-size: 11px;
    font-weight: normal;
}
</style>
        
<style>.card-body.mainb { padding-bottom:0px; } 
.land-prop .bedroomsclass ,  .land-prop  .bathroomsclass { display:none; }
.amn-104 , .for-land { display:none ; }
.land-prop .amn-104 , .land-prop  .for-land{display:block  ; }.land-prop  .amn-99 {display:none;  }

</style>
<?php
if(Yii::App()->isAppName('frontend') and $model->isNewRecord){ ?> 
<script>
 
    var saveCookiesUrl = '<?php echo Yii::app()->createUrl('place_an_ad/savecookies');?>';
    function savemycookies(){
        var formData = {};
        var  frm  = $('#post-property');
    frm.find(":input").each(function (index, node) {
       
        
             formData[node.name] = node.value;
        
        
        
    });
     var amn =   $('.amnit:checked').map(function() {return this.value;}).get().join('-');
          
          formData['amn'] = amn;
    $.post(saveCookiesUrl, formData);
}

$(document).ready(function(){
 setInterval(savemycookies,20000);
});
    
</script>
<?php } ?> 
