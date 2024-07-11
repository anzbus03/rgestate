<?php defined('MW_PATH') || exit('No direct script access allowed');
$model->country = '66124';
if(Yii::app()->isAppName('frontend')){
	
	?>
	<style>
		.dz-details,.dz-filename{display:none; }
	html	.box-footer { 
	border: 0px !important;
}
		html .box {
 
	background: transparent !important;
 
}.lab-p{
			 
	width: auto !important; ;
	min-width: 39px !important; ;
	text-align: center !important; ;
	line-height: 1;
	position: unset;
	display: block;
	/* background: green; */
	/* color: #fff; */
	padding: 0px 2px;
	height: 100%;
	flex: 1;
 		}html .input-group{max-width:unset !important; }
		.no-front{ display:none; }
		.box-header { display:none; }
					html body	.box.box-primary{
	padding: 0px 13px;
	box-shadow: 0 1px 6px 0 rgba(32, 33, 36, 0.28) !important;
	border-radius: 10px;margin-bottom:50px;
}.form-control, .gfield .medium, .ginput_container_address input {
 
	height: 40px !important;;  
	border: 1px solid #eee !important;
}html .subhead {
 
	padding-left: 15px;
	font-weight: 600;
}
						.place_ad {min-height:400px;}
						#place_an_ad {margin-top:0px !important;}
	html .subheading_font {
	background: var(--secondary-color);
	color: #fff !important;
	padding-top: 15px;
	padding-bottom: 15px;
}
#mainContainerClass {width:100%; max-width:100%;}
.tp_banner {height:150px;background-color:var(--secondary-color);color:#fff;display: flex;align-items: center;justify-content: center; margin-bottom:50px;}
.tp_banner .h2{ color:#fff}
.site-block {
	background: #fff;
	height: 100px;
	border: 1px solid #EEE;
	border-radius: 6px;
	color: #2B2D2E;
	display: -ms-flexbox;
	-js-display: flex;
	display: flex;
	-ms-flex-align: center;
	align-items: center;
	-ms-flex-pack: center;
	justify-content: center;
}.site-block h1 {
	margin: 0;
	font-weight: 600;
	font-size: 16px;
	line-height: 20px;
}.site-block:hover {
	border: 1px solid var(--secondary-color);
	color:var(--secondary-color);
	box-shadow: 0 20px 40px 0 rgba(0,0,0,.1);
}
.site-block:hover h1 {
 
	color:var(--secondary-color) !important;
	 
}
.site-blocks-wrapper > li {
  padding: 8px;
}
.site-blocks-wrapper {
	max-width: 800px;
	margin: auto;
	position: relative;
	top: -100px;
}.box {
	padding: 30px;
	background: #fff;
	margin: auto; 
	max-width:900px;margin:auto;
}.banner {
    margin-left: -15px;
    margin-right: -15px;
    width: calc(100% + 30px);
    position: relative;
    height: 20.56vw;
    background-color: rgba(0,0,0,0.8);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}.abs-banner {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    color: #fff;
    z-index: 1;
    content: '';
}.bloghead {
    align-items: center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
    font-weight: 300;
    display: flex;
    z-index: 1;
    position: relative;
} .fancy-title {
    color: #fff;
    font-size: 33px;
    font-weight: 900;
    text-shadow: 1px 1px #000;margin-bottom:0px;padding:0px;
}.box.box-primary   {
    margin-top: -66px;
    background: #fff !important;
    position: relative;
    z-index: 1;
}.abs-banner {
 
    background: rgba(0,0,0,0.2);
}
</style>
 
<section class="panel1 panel-bg banner" style="background-image:url(<?php echo $img;?>);">
    <div class="abs-banner"> 
            <div class="bloghead container"> 
                <div class="fancy-title-hold text-initial clearfix">
                   <h3 class="fancy-title animate animated"><span class="title">Submit New Project</span></h3>
                </div>
            </div> 
    </div> 
</section>
	<?php
}

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
        if(Yii::app()->isAppName('frontend')){
            	$mainText = $this->tag->getTag('submit_property','Submit Property');
	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
              $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus),
        	'enableAjaxValidation'=>true,
							'id'=>'post-property',
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {
				     
						form.find("#bb").html("'.$Validating.'");
						return true;
					}',
					'afterValidate' => 'js:function(form, data, hasError) { 
					 
					if(hasError) {
					 
						  $("html, body").animate({
        scrollTop: form.find(".errorMessage:visible:first").offset().top-110
    }, 2000);
						
							form.find("#bb").html("'.$mainText.'");
							return false;
					}
					else
					{
							form.find("#bb").html("'.$please_wait.'");	return true;
					}
					}',
					
					
							),
							'htmlOptions'=>array('autocomplete'=>'off')
							)); 
        }else{
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus)));
        }
        ?>
        <style>.jqx-combobox-content{ text-indent:4px;}</style>
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
                
                </style>
          <?php
           
								if((int) $model->state>0)
								{
								 
								$lat = @$model->stateLocation->location_latitude;
								$long =@$model->stateLocation->location_longitude; 
								 
								}
								else
								{
								$lat = @$model->country0->location_latitude;
								$long =@$model->country0->location_longitude; 
								 
								}
								
								// Saving coordinates after model dragged our marker.
							   
							    if ($model->location_latitude!="" and $model->location_longitude!="") {
									 $lat  =  $model->location_latitude;
									 $long =  $model->location_longitude;
									 
								} 
							//	$model->country  = '66099' ; 
          ?>
               
                <div class="clearfix"><!-- --></div>
              
                <div class="clearfix"><!-- --></div>
                  <div class="subhead font_s ros subhead2">Property Type and Location</div>
                
                   <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-3 no-front ">
                   <?php echo $form->labelEx($model, 'country');?>
                    <?php echo $form->dropDownList($model, 'country',Countries::model()->ListData(), $model->getHtmlOptions('country',array('empty'=>'Select Country','class'=>'form-control select2','data-url'=>Yii::App()->createUrl($this->id.'/select_city_new'),'onchange'=>'load_via_ajax(this,"state")'))); ?>
                    <?php echo $form->error($model, 'country');?>
                </div>  
               
                  <?php  
                     $cities =  CHtml::listData(States::model()->AllListingStatesOfCountry((int) $model->country) ,'state_id' , 'state_name') ;
                    $m_class = empty( $cities ) ? 'hidden' : '' ; 
                    ?>
                <div class="form-group col-lg-3 <?php echo $m_class;?>">
                      <?php echo $form->labelEx($model, 'state');?>
                    <?php echo $form->dropDownList($model, 'state', $cities  , $model->getHtmlOptions('state',array('empty'=>'Select City','class'=>'form-control select2 ' ,'data-url'=>Yii::App()->createUrl($this->id.'/select_location'),'onchange'=>'load_via_ajax(this,"city")'))); ?>
                    <?php echo $form->error($model, 'state');?>
                </div>  
     
                 <?php  
                     $locationlist =   CHtml::listData(City::model()->FindCities((int) $model->state) ,'city_id' , 'city_name') ;
                    $m_class = empty(  $locationlist ) ? 'hidden' : '' ; 
                    ?>
                <div class="form-group col-lg-3 <?php echo $m_class;?>">
                    
                    <?php echo $form->labelEx($model, 'city');?>
                    <?php echo $form->dropDownList($model, 'city', $locationlist, $model->getHtmlOptions('state',array('empty'=>'Select Location','class'=>'form-control select2','onchange'=>'changeMap()'))); ?>
                    <?php echo $form->error($model, 'city');?>
                </div>  
                 <div class="form-group col-lg-3  ">
                    
                    <?php echo $form->labelEx($model, 'project_status');?>
                    <?php echo $form->dropDownList($model, 'project_status', $model->projectStatus(), $model->getHtmlOptions('state',array('empty'=>'Please Select','class'=>'form-control select2' ))); ?>
                    <?php echo $form->error($model, 'project_status');?>
                </div>  
				<div class="form-group col-lg-3  ">
					<?php echo $form->labelEx($model, 'Permit Number'); ?>
					<?php echo $form->textField($model, 'PropertyID', $model->getHtmlOptions('Permit No')); ?>
					<?php echo $form->error($model, 'PropertyID'); ?>
                </div>  
                <div class="clearfix"><!-- --></div>
                
	   <?php $this->renderPartial('root.apps.backend.views.new_projects._location',compact('form'));?> 
		
                <div class="clearfix"><!-- --></div>
               
                      <?php  
                     $catlist =  Category::model()->ListDataForJSON_ID_BySEctionNewdevelopment(3)   ;
                    $m_class = empty(  $catlist ) ? 'hidden' : '' ; 
                    ?>
                 <div class="form-group col-lg-12 <?php echo $m_class;?>">
                    <?php echo $form->labelEx($model, 'p_types');
                    if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
						$model->p_types = CHtml::listData($model->pCategories,'category_id','category_id');
					}
                    
                    ?>
                    <?php echo $form->dropDownList($model, 'p_types', $catlist  , $model->getHtmlOptions('p_types',array('data-placeholder'=>'Select Types','empty'=>'Select Types','class'=>'form-control select2','multiple'=>true  ))); ?>
                    <?php echo $form->error($model, 'p_types');?>
               </div>  
                  
                 
                <div class="clearfix"><!-- --></div>
                  <div class="subhead font_s ros subhead2">Project Details</div>
                  	<div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'ad_title');?>	<?php  
											if(!$model->isNewRecord){
												?>
												<a href="javascript:void(0)" style="" data-id="PlaceAnAd_ad_title_<?php echo $model->id;?>" data-lan="ar" data-fieldid="PlaceAnAd_ad_title" data-relation_id="<?php echo $model->id;?>" data-relation="ad_id" data-disableediter="1" onclick="showAjaxModal(this)"><small class="label pull-right bg-blue">ar</small></a>
												<?php
											}
											
											  ?>
										<?php echo $form->textField($model, 'ad_title', $model->getHtmlOptions('ad_title')); ?>
										<?php echo $form->error($model, 'ad_title');?>
									</div>      
									  
									 <div class="clearfix"><!-- --></div> 
									 
									<div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'ad_description');?><?php
									if(!$model->isNewRecord){
										   ?>
										   <a href="javascript:void(0)" style="" data-id="PlaceAnAd_ad_description_<?php echo $model->id;?>" data-lan="ar" data-fieldid="PlaceAnAd_ad_description" data-relation_id="<?php echo $model->id;?>" data-relation="ad_id" data-disableediter="" onclick="showAjaxModal(this)"><small class="label pull-right bg-blue">ar</small></a>
										   <?php
									}
									?>
										<?php echo $form->textArea($model, 'ad_description', array_replace($model->getHtmlOptions('ad_description'),array("rows"=>"5"))); ?>
										<?php echo $form->error($model, 'ad_description');?>
									</div>    
									
								
									<div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'video');?>
										<?php echo $form->textField($model, 'video', array_replace($model->getHtmlOptions('video'))); ?>
										<?php echo $form->error($model, 'video');?>
									</div>    
									<style>
									label span.required { 
    font-size: 13px;
}
									</style>
							 
										 	 <div class="clearfix"><!-- --></div> 
								 
										  <div class="form-group col-lg-4" style="max-width: 250px;">
										<div class="clearfix"><!-- --></div>
										<style>.lab-p{z-index:22; }</style>
										<?php echo $form->labelEx($model, 'price_false');?>
											 <div class="input-group" style=" max-width: 200px;border: 1px solid #eee;display:flex">
												 <span class="lab-p"  style="width: auto; min-width: 30px; text-align: center;    line-height: 2.3;" ><?php echo $model->currencyTitle;?></span> 
										<?php echo $form->textField($model, 'price_false', $model->getHtmlOptions('price_false',array('placeholder'=>$model->getAttributeLabel('price_false'),'style'=>'max-width: 106px;','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"))); ?>
										<?php echo $form->dropDownList($model, 'from_price_unit',CHtml::listData(PriceUnit::model()->listData($model->country),'master_id','master_name'), $model->getHtmlOptions('from_price_unit',array('empty'=>'----', 'style'=>'max-width: 79px;'))); ?>
										  </div>
										<?php echo $form->error($model, 'price_false');?>
										</div>
										 
										  <div class="form-group col-lg-4">
										<div class="clearfix"><!-- --></div>
										<style>.lab-p{z-index:22; }</style>
										<?php echo $form->labelEx($model, 'price_to_false');?>
											 <div class="input-group" style=" max-width: 200px;border: 1px solid #eee;display:flex">
												 <span class="lab-p"  style="width: auto; min-width: 30px; text-align: center;    line-height: 2.3;" ><?php echo $model->currencyTitle;?></span> 
										<?php echo $form->textField($model, 'price_to_false', $model->getHtmlOptions('price_to_false',array('placeholder'=>$model->getAttributeLabel('price_to_false'),'style'=>'max-width: 106px;','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"))); ?>
										<?php echo $form->dropDownList($model, 'to_price_unit',CHtml::listData(PriceUnit::model()->listData($model->country),'master_id','master_name'), $model->getHtmlOptions('to_price_unit',array('empty'=>'----', 'style'=>'max-width: 79px;'))); ?>
										  </div>
										<?php echo $form->error($model, 'price_to_false');?>
										</div>
										  
										 
										 
										 
										
								 <div class="clearfix"></div>
								 		  <div class="clearfix"><!-- --></div>
<div class="subhead font_s ros subhead_img">Amenities</div>
									<div class="clearfix"><!-- --></div>
							 
									<div class="clearfix"><!-- --></div>
								 
									<div class="form-group col-lg-12">
									   <div class="">
										<div class="container34">
										    <?php
											 $amenities_array=	 CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_name');
											 
											echo CHtml::checkBoxList('amenities',$model->amenities ,$amenities_array,array('separator'=>'','labelOptions'=>array('class'=>''),'template'=>'<div class="form-check form-check-flat"><label class="form-check-label">{input}  {labelTitle} <i class="input-helper"></i></label></div>'));                                              
											?>
										</div>
										<?php echo $form->error($model, 'amenities');?>
									</div>    
									<div class="clearfix"><!-- --></div>    
									</div>  
									
									
								 <div class="clearfix"></div>
								 <?php $this->renderPartial('root.apps.backend.views.new_projects.add_property_types');?>
								 <div class="clearfix"></div>
								   <div class="form-group col-lg-12 margin-top-15 no-front">
												 
										<div class="subhead font_s ros  " style="padding-right:10px;"> Available Units</div>
										<?php $mer =  array_merge($model->getHtmlOptions('available_units'),array('empty'=>"Select Customer",'class'=>"  form-control")); ?>
										<?php
										if(Yii::app()->request->isPostRequest){
										    if(!empty($model->available_units )){
										     foreach($model->available_units  as $k5=>$v5){
										          $dats[$v5]  = $v5;
										     }
										    }
										     
										     
										}
										else{
										 $unitIds = PlaceAnAdUnits::model()->getFullUnits($model->id); 
										 $model->available_units =  CHtml::listData($unitIds,'unit_id','unit_id') ;
										 $dats = CHtml::listData($unitIds,'unit_id','fullName') ; 
										}
										 echo $form->dropDownList($model, 'available_units',   $dats   ,  $model->getHtmlOptions('available_units',array('multiple'=>true)) ); ?>
										<?php echo $form->error($model, 'available_units');?>
									</div>
								
								 <div class="clearfix"></div>
               	 
                <div class="clearfix"><!-- --></div>
                	 <?php $this->renderPartial('root.apps.backend.views.new_projects._image_upload',compact('form'));?> 

<div class="clearfix"></div>
  
  	<div class="clearfix"><!-- --></div>	
			 	<div class="">
							 <?php  
							 $fileField = 'payment_plan';
							 $title_text = 'Upload Payment Plan++';
							 $types = '.pdf,.png,.jpg';
							 $maxFiles = '1';
							 $maxFilesize = '5';
				 
							  $this->renderPartial('root.apps.backend.views.new_projects._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text')); ?>
						</div>
<div class="clearfix"></div>
	<div class="clearfix"><!-- --></div>	
			 	<div class="col-md-12 col-sm-12">
							 <?php  
							 $fileField = 'floor_plan';
							 $title_text = 'Upload Floor Plan++';
							 $types = '.pdf,.png,.jpg';
							 $maxFiles = '1';
							 $maxFilesize = '5';
				 
							  $this->renderPartial('root.apps.backend.views.new_projects._file_field_browse_plan',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text')); ?>
						</div>
			
<div class="clearfix"></div>
<div class="subhead font_s ros subhead_img">Contact Details</div>
							  
	<div class="form-group col-lg-3">
										<?php 
									 	echo $form->labelEx($model, 'contact_person');?>
										<?php echo $form->textField($model, 'contact_person', $model->getHtmlOptions('contact_person')); ?>
										<?php echo $form->error($model, 'contact_person');?>
										</div> 
									 		<div class="form-group col-lg-3">
										<?php 
									 	echo $form->labelEx($model, 'mobile_number');?>
										<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('mobile_number')); ?>
										<?php echo $form->error($model, 'mobile_number');?>
										</div> 
											<div class="form-group col-lg-3">
										<?php 
									 
										echo $form->labelEx($model, 'landline');?>
										<?php echo $form->textField($model, 'landline', $model->getHtmlOptions('landline')); ?>
										<?php echo $form->error($model, 'landline');?>
										</div> 
										 
										 	 <div class="form-group col-lg-6 no-front">
												 
										<?php
										$model->user_id = empty($model->user_id) ? '31988' : $model->user_id; 
										echo $form->labelEx($model, 'user_id');?>
										<?php $mer =  array_merge($model->getHtmlOptions('user_id'),array('empty'=>"Select Customer",'class'=>"  form-control")); ?>
										<?php echo $form->dropDownList($model, 'user_id', CHtml::listData(ListingUsers::model()->findAllByPk($model->user_id),'user_id','fullName')    , $mer ); ?>
										<?php echo $form->error($model, 'user_id');?>
									</div>
							 
                <div class="clearfix"><!-- --></div>
                <?php
if(Yii::app()->isAppName('backend')){
	?>
		<div class="clearfix"></div>
		<div class="subhead font_s ros subhead_img">Admin Settings</div>
		 <h2 class="main_head_purpose"></h2>
		<div class="clearfix"></div> 
		<div class=" ">
		<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model, 'status');?>
		<?php echo $form->dropDownList($model, 'status', $model->statusArray()    , $model->getHtmlOptions('community_id' ,array('class'=>'form-control selectt2') )); ?>
		<?php echo $form->error($model, 'status');?>
		</div> 
		<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model, 'featured');?>
		<?php echo $form->dropDownList($model, 'featured', array('N'=>'Not Featured' , 'Y'=>'Featured' )    , $model->getHtmlOptions('featured' ,array('class'=>'form-control selectt2') )); ?>
		<?php echo $form->error($model, 'featured');?>
		</div> 
		</div>
		<div class="clearfix"></div> 
	<?php } ?>
                <div class="clearfix"><!-- --></div>
               
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" id="bb"  class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Submit');?></button>
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
	function changeMap(){
	 
			 var location_text ='';
			 if($('#'+modelName+'_state').val() != ''){
			   location_text +=  $('#'+modelName+'_state option:selected').text();
			 }
			 if($('#'+modelName+'_city').val() != ''){
			   location_text +=   ',';
			   location_text +=  $('#'+modelName+'_city option:selected').text();
			 }
			  if(location_text !=''){
			  codeAddressInitial(location_text);
			 }
	}
$(function(){ $('.select2').select2();  })
var modelName = '<?php echo $model->modelName;?>'
function load_via_ajax(k,id){
	var url_load = $(k).attr('data-url') 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
	 
		 $('#'+modelName+'_'+id).val('');
		 $('#'+modelName+'_'+id).html('<option value="">Loading...</option>').select2();
		 var attr_id = $(k).attr('id');
		 if(attr_id== '<?php echo $model->modelName;?>_state'){
			changeMap()
		 }
		 $.get(url_load,function(data){ var data = JSON.parse(data) ;   $('#'+modelName+'_'+id).html(data.data).select2(); if(data.size != '0') {    $('#'+modelName+'_'+id).closest('.form-group').removeClass('hidden') }else{  $('#'+modelName+'_'+id).closest('.form-group').addClass('hidden') }  })
	}
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo Yii::app()->options->get('system.common.google_map_api_key','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ');?>"></script>
 
 <script type="text/javascript">

function sun(lat,lan)
{
	 
$("#<?php echo $model->modelName;?>_location_latitude").val(lat);
$("#<?php echo $model->modelName;?>_location_longitude").val(lan);
 
}
</script>
 <script>
	 
        
 function codeAddress() {
			$("#<?php echo $model->modelName;?>_location_latitude").val("");
			$("#<?php echo $model->modelName;?>_location_longitude").val("");
			 
			var address = document.getElementById("locate-add").value;
			geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				$("#<?php echo $model->modelName;?>_location_latitude").val(results[0].geometry.location.lat().toFixed(6));
			$("#<?php echo $model->modelName;?>_location_longitude").val(results[0].geometry.location.lng().toFixed(6));
			
			initMap(results[0].geometry.location.lat().toFixed(6),results[0].geometry.location.lng().toFixed(6));
			} else {

			}
			});
			}
 function codeAddressInitial(adress) {
		 
		 
			var address = adress;
			geocoder = new google.maps.Geocoder();		
			if(geocoder )	{ 
			geocoder.geocode( { 'address': address}, function(results, status) {
			 
			if (status == google.maps.GeocoderStatus.OK) {
			
			initMap(results[0].geometry.location.lat().toFixed(6),results[0].geometry.location.lng().toFixed(6));
			} else {

			}
			});
			}
			}
 
 </script>
 <script>
 $(function(){
		 
 
    $('#locate-add').autocomplete({
          
    
        lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
            var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
            return re.test(suggestion.value);
        },
        onSelect: function(suggestion) {
           // $('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
     
						$("#<?php echo $model->modelName;?>_location_latitude").val("");
						$("#<?php echo $model->modelName;?>_location_longitude").val("");
						 

						 
						initMap(suggestion.latitude,suggestion.longitude);
					
					
           
				},
        
			});

        });
</script>
<script type="text/javascript">
	      
				
			<?php
			 if ($model->location_latitude!="" and $model->location_longitude!="") {
									  ?>
									   initMap('<?php echo $model->location_latitude; ?>','<?php echo $model->location_longitude; ?>');
										var latlng = new google.maps.LatLng('<?php echo $model->location_latitude; ?>','<?php echo $model->location_longitude; ?>');
										placeMarker(latlng);
									 
									  <?php
									 
								}
								else{
									if(!empty($model->city)){
										?>
										zoomIndex = 15;
										codeAddressInitial('<?php echo @$model->city0->city_name.','.@$model->stateLocation->state_name;?>');;
										<?php
									}
									else{
									?>
								 
									codeAddressInitial('dubai,uae');;
									<?php
									}
								}  
								?>
        
    
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
		break;
	}
}

var customer_url = '<?php echo Yii::app()->createUrl('place_an_ad/Customer',array('user_type'=>'D'));?>';
$(function(){
$("#"+modelName+"_user_id").select2({
								placeholder: 'Select Developer',
								 allowClear: true,
								ajax: {
								url:  customer_url ,
								dataType: 'json',
								delay: 250,
								data: function (params) {
								return {
								q: params.term, // search term
								page: params.page
								};
								},
								processResults: function (data, params) {
								// parse the results into the format expected by Select2
								// since we are using custom formatting functions we do not need to
								// alter the remote JSON data, except to indicate that infinite
								// scrolling can be used
								params.page = params.page || 1;
								return {
								results: data.items,
								pagination: {
								more: (params.page * 30) < data.total_count
								}
								};
								},
								cache: true
								},
								escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
								minimumInputLength: 0,
								//templateResult: formatRepo, // omitted for brevity, see the source of this page
								//templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
								}) ;
								
								$("#"+modelName+"_available_units").select2({
								placeholder: 'Select Buy / Rent ',
								 
								ajax: {
								url:  '<?php echo Yii::app()->createUrl('place_an_ad/select_ad');?>' ,
								dataType: 'json',
								delay: 250,
								data: function (params) {
								return {
								q: params.term, // search term
								page: params.page
								};
								},
								processResults: function (data, params) {
								// parse the results into the format expected by Select2
								// since we are using custom formatting functions we do not need to
								// alter the remote JSON data, except to indicate that infinite
								// scrolling can be used
								params.page = params.page || 1;
								return {
								results: data.items,
								pagination: {
								more: (params.page * 30) < data.total_count
								}
								};
								},
								cache: true
								},
								escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
								minimumInputLength: 0,
								//templateResult: formatRepo, // omitted for brevity, see the source of this page
								//templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
								}) ;

})


 
</script>

