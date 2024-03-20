<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 <style>
     .col-sm-5 label { text-align:left;float: left; } .nolabel label { display:none; }
     html[dir='rtl'] .col-sm-5 label { text-align:right;float: right; }
     .collapse:not(.in) {
    display: none;
}.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice, .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__placeholder, .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-search--inline {
    float: right;
}
.main-panel { margin-left:0px; }.myaccount-menu.is-ended{ display: none; }
html input.input-text.form-control{ padding-left:5px;padding-right:5px;text-indent: 0px;}
html .col-sm-6 .col-sm-12 input.input-text.form-control{ width:100% !important;}
.col-sm-12 label {
    color: #72727d !important; } 
#ListingUsers_password input { max-width:100%;}
html[dir='rtl'] .container_check .checkmark::after {
    
    right: 6px; left: 0px;
}
html[dir="ltr"] .fl-left{ float:left !important;order: 1;}html[dir="ltr"] .fl-right{ float:right !important;order: 2;}
 </style>
 	 <style>.pwdstrength { position:absolute; } #ListingUsers_password{position:relative; } .pwdstrengthstr{position: absolute;top: -19px;right: 3px;} </style>
						
						<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('assets/css/pwdwidget.css');?>" />
                        <script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/pwdwidget.js');?>" type="text/javascript"></script>
                          <link rel="stylesheet" href="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/css/intlTelInput.css');?>">
                          <script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/intlTelInput.js');?>"></script>
<style>
    .card-1 .subheading_font { display:block; }
    .upgrade { font-weight:500;text-decoration:underline;color:var(--secondary-color);font-size:14px;}
    html .rui-qvKkT1 {
    color: rgba(0,47,52,.64);
    font-size: 11px;
    font-weight: 400;
    background-color: transparent !important;
    color: var(--secondary-color) !important;
    padding: 0px !important;
    font-weight: 600;
}
@media only screen and (max-width: 600px) {
  .col-sm-5 label {
    white-space: initial !important;
  }
}
html[dir="rtl"] .card-1 .col-sm-7 {
    padding-right: 0px !important;padding-left: 15px !important;
}.back-btn img { width:12px;}
.back-btn { font-weight: 400;
color: var(--secondary-color);
font-size: 17px;}
</style>
<script>
function upgradePropt(k){
	$.jAlert({
        'type': 'confirm',
        'confirmQuestion': 'Are you sure to upgrade?',
        'onConfirm': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            var url_load = $(k).attr('data-href');
            if (url_load !== undefined) { 
				window.location.href = url_load;
            }
            return false;
        },
        'onDeny': function(e, btn) {
            e.preventDefault();
            //do something here
            btn.parents('.jAlert').closeAlert();
            return false;
        }
    });
}
</script>
	<style>
								 .browse_type   .upload-btn-wrapper .btn {   height: 62px !important; width:150px !important; background: #fff;color: var(--logo-color);border-color: var(--logo-color);}
								 .browse_type  .upload-btn-wrapper .btn i  { margin-bottom:5px !important;}
								 .browse_type    .property_img_overlay {     top: 15px;    width: 100%;    z-index: 111;    left: 0px;    right: 0px;}
								 .browse_type    .property_img_overlay  .btn{    padding: 5px;    width: 87%; }
								 .browse_type .dropzone { width:150px !important; }
								 .browse_type .dropzone .dz-message .upload-btn-wrapper {   max-width: unset; }
								.property_img_box {    width: 57px !important;    height: 57px !important;    display: inline-block;    overflow: hidden; float:left !important;}
								html  div.property_img_box div.property_img{    width: 100% !important;    height: 100% !important; display: flex; line-height: 1 !important;   }
								html .property_img_box .property_img img{    width: 100% !important;   }
								</style>
<div class="container">

	<div class=" ">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div>
           
             <h4 class="subheading_font row bold-style"><?php echo $this->tag->gettag('update_profile','Update Profile');?> <a href="<?php echo Yii::app()->createUrl("member/dashboard");?>"   class="pull-right margin-right-10 back-btn"><?php echo $this->tag->gettag('back','Back');?></a></h4>
          <div class="tabs-container alt" style="overflow:initial"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				 <?php  if(Yii::app()->user->getState('user_type','') == 'U'){ echo '<a href="javscript:void(0)" onclick="upgradePropt(this)" data-href="'.Yii::app()->createUrl("member/upgrade_account").'" class="pull-right upgrade margin-bottom-10"  >'.$this->tag->gettag('update_profile','Upgrade account as a Seller').'</a>';} ?>
            <!-- Login -->
			<div  id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
 
            <!-- Login -->
							<div class="  padding-top-0" id="tab1" style="border-top:0px;padding-bottom:10px">
							<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'validateOnType'=>false,
							),
							)); ?>
							<div id="right-col">


							<div id="signin-form">
							    <?php 
							    
							   if (in_array($user->user_type,array('D','C','M') )){  ?> 
                            	<div class="clearfix"></div>
							<div class="form-group  ">

						   <div class="row">
						       		<div class="col-sm-6 no-padding fl-right">
										<div class="col-sm-12"><label for="ListingUsers_company_name"><?php echo $user->getAttributeLabel('company_name_ar');?> (<?php echo $this->tag->gettag('arabic','Arabic');?>)<span class="required">&nbsp;</span> </label></div>


										<div class="col-sm-12">

										 <?php  	echo $form->textField($user , 'company_name_ar' ,  $user->getHtmlOptions('company_name_ar',array('class'=>'input-text form-control','placeholder'=>''  ,'dir'=>"rtl")));  ?>

										<?php echo $form->error($user, 'company_name_ar');?>

										</div>
								</div>
						
								  <div class="col-sm-6  no-padding fl-left">

												<div class="col-sm-12"><label for="ListingUsers_company_name"><?php echo $user->getAttributeLabel('company_name');?>  (<?php echo $this->tag->gettag('english','English');?>) <span class="required">*</span></label></div>


												<div class="col-sm-12">

												<?php  	echo $form->textField($user , 'company_name' ,  $user->getHtmlOptions('company_name',array('class'=>'input-text form-control','placeholder'=>'' ,'dir'=>"ltr")));  ?>

												<?php echo $form->error($user, 'company_name');?>
										 
												</div>
									</div>
							 
							</div>
		
		</div> 
	<div class="clearfix"></div>	<?php } ?> 
	
							<div class="clearfix"></div>
							<div class="form-group  ">
				    <div class="row">
											<div class="col-sm-6 no-padding fl-right">
											<div class="col-sm-12"><label for="ListingUsers_address"><?php echo $user->getAttributeLabel('address_ar');?> (<?php echo $this->tag->gettag('arabic','Arabic');?>) </label></div>

											<div class="col-sm-12">

											<?php  	echo $form->textField($user , 'address_ar' ,  $user->getHtmlOptions('address_ar',array('class'=>'input-text form-control','placeholder'=>'' ,'dir'=>"rtl" )));  ?>

											<?php echo $form->error($user, 'address_ar');?>

											</div>
											</div>
								<div class="col-sm-6 no-padding fl-left">
											<div class="col-sm-12"><label for="ListingUsers_address"><?php echo $user->getAttributeLabel('address');?>  (<?php echo $this->tag->gettag('english','English');?>) </label></div>

											<div class="col-sm-12">

											<?php  	echo $form->textField($user , 'address' ,  $user->getHtmlOptions('address',array('class'=>'input-text form-control','placeholder'=>''  ,'dir'=>"ltr")));  ?>

											<?php echo $form->error($user, 'address');?>
											<a href="javascript:void(0)" style="display:none;" onclick="opendetectLocation()"><?php echo $this->tag->getTag('detect_your_location','Detect Your Location');?></a>
											<?php $this->renderPartial('//user/_update_location_script');?>

											</div>
											</div>
										
							</div>
		
	 	</div> 
		
				 		<div class="clearfix"></div>
				 		<div class="row margin-left-0 margin-right-0" style="flex-direction: column;">
				 					<div class="form-group  fl-right">

						    <div class="row">

							<div class="col-sm-5" style="width:100%; "><label for="ListingUsers_description_ar"><?php echo $user->getAttributeLabel('description');?> (<?php echo $this->tag->gettag('arabic','Arabic');?>)</label></div>

							<div class="col-sm-12">

							<?php  	echo $form->textArea($user , 'description_ar' ,  $user->getHtmlOptions('description_ar',array('class'=>'input-text form-control','placeholder'=>'' ,'dir'=>"rtl" ,'rows'=>'5' ,'style'=>'height: auto;padding:2px; ')));  ?>

							<?php echo $form->error($user, 'description_ar');?>

							</div>

							</div>
		</div> 
		 
							<div class="form-group   fl-left">

						    <div class="row">

							<div class="col-sm-12" style="width:100%; "><label for="ListingUsers_description"><?php echo $user->getAttributeLabel('description');?> (<?php echo $this->tag->gettag('english','English');?>) </label></div>

							<div class="col-sm-12">

							<?php  	echo $form->textArea($user , 'description' ,  $user->getHtmlOptions('description',array('class'=>'input-text form-control','placeholder'=>''  ,'dir'=>"ltr",'rows'=>'5' ,'style'=>'height: auto;padding:2px; ')));  ?>

							<?php echo $form->error($user, 'description');?>

							</div>

							</div>
		</div> 
	</div>
			<div class="clearfix"></div>
							<?php
							if($user->user_type  == 'P'){ ?> 
							
						 <div class="clearfix"></div>
							<div class="form-group   ">

						    <div class="row">
                          
                            <?php 
										$fileField = 'property_t';
										$title_text =   $this->tag->getTag('upload','Upload') ;
										$types = '.pdf,.jpg,.jpeg';
										$maxFiles = '1';
										?>
							<div class="col-sm-5"  ><label for="ListingUsers_property_t" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('property_t');?> <span class="required">*</span>  </label>
							<div class="clearfix"></div>
							 <?php
							 if(empty($user->is_verified) or  empty($user->$fileField)){ ?>
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1; color:#fff;"><?php echo $this->tag->getTag('allowed','Allowed');?>: <b dir="auto"><?php echo $types;?></b></div>
							<?php } ?> 
							</div>

							<div class="col-sm-7 nolabel">

							   <?php
							 if(empty($user->is_verified) or  empty($user->$fileField)){ 
							 $this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
							}
							 else{
								 ?>
								 <img src="<?php echo $user->detailFile($user->$fileField) ;?>" style="width:40px;">
										
								 <?
							 }
							 
							  ?>

							</div>

							</div>
		</div> 				 
					 		<div class="clearfix"></div>
						 <div class="clearfix"></div>
							<div class="form-group  	 ">

						    <div class="row">
                          
                            <?php 
                          
										$fileField = 'property_a';
										$title_text = $this->tag->getTag('upload','Upload') ;
										$types = '.pdf,.jpg,.jpeg';
										$maxFiles = '1';
										?>
							<div class="col-sm-5"  ><label for="ListingUsers_property_a" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('property_a');?> <span class="required">*</span>  </label>
							<div class="clearfix"></div>
							 <?php
							 if(empty($user->is_verified) or  empty($user->$fileField)){ ?>
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1; color:#fff;"><?php echo $this->tag->getTag('allowed','Allowed');?>: <b dir="auto"><?php echo $types;?></b></div>
							<?php } ?> 
							</div>

							<div class="col-sm-7 nolabel">

							  <?php
							 if(empty($user->is_verified) or  empty($user->$fileField)){ 
							 $this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
							}
							 else{
								 ?>
								 <img src="<?php echo $user->detailFile($user->$fileField) ;?>" style="width:40px;">
										
								 <?
							 }
							 
							  ?>
						 
						 

							</div>

							</div>
		</div> 				 
					 		<div class="clearfix"></div>
							<?php } ?> 
				<?php
							if(in_array($user->user_type,array('A','C','D','M')) and empty($user->parent_user)){ ?> 
								 <div class="clearfix"></div>
						 			<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><label for="ListingUsers_licence_no" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('licence_no');?>  <span class="required">*</span></label></div>

							<div class="col-sm-7">
								
							<?php
							 
							if(empty($user->is_verified) or  empty($user->licence_no)){ 
								  	echo $form->textField($user , 'licence_no' ,  $user->getHtmlOptions('licence_no',array('class'=>'input-text form-control','placeholder'=>'' )));  
							}else{
								echo '<span style="font-weight:600">'.$user->licence_no.'</span>';
							}
							?>
							<?php echo $form->error($user, 'licence_no');?>
							 

							</div>

							</div>
		</div> 
		
						 <div class="clearfix"></div>
						 			<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><label for="ListingUsers_cr_number" style="white-space: nowrap;"><?php echo $user->getAttributeLabel('cr_number');?>  <span class="required">*</span></label></div>

							<div class="col-sm-7">
								
							<?php
							 
							if(empty($user->is_verified) or  empty($user->cr_number)){ 
								  	echo $form->textField($user , 'cr_number' ,  $user->getHtmlOptions('cr_number',array('class'=>'input-text form-control','placeholder'=>'' )));  
							}else{
								echo '<span style="font-weight:600">'.$user->cr_number.'</span>';
							}
							?>
							<?php echo $form->error($user, 'cr_number');?>
							 

							</div>

							</div>
		</div> 
		
						 <div class="clearfix"></div>
							<div class="form-group  <?php echo !empty($user->parent_user)? 'hide' :'';?>">

						    <div class="row">
                          
                            <?php   
										$fileField = 'u_crdoc'; 
										$title_text = $this->tag->gettag('upload','Upload');
										$types = '.pdf,.jpg,.jpeg';
										$maxFiles = '1';
										?>
							<div class="col-sm-5"  ><label for="ListingUsers_u_crdoc"  ><?php echo $user->getAttributeLabel('u_crdoc');?> <span class="required">*</span>  </label>
							<div class="clearfix"></div>
							<?php
							 if(empty($user->is_verified) or  empty($user->$fileField)){ ?>
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1; color:#fff;"><?php echo $this->tag->getTag('allowed','Allowed');?>: <b dir="auto"><?php echo $types;?></b></div>
							<?php }?>
							</div>

							<div class="col-sm-7 nolabel">
							 <?php
							 if(empty($user->is_verified) or  empty($user->$fileField)){ 
							 $this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
							}
							 else{
								 ?>
								 <img src="<?php echo $user->detailFile($user->$fileField) ;?>" style="width:40px;">
										
								 <?
							 }
							 
							  ?>
						 

							</div>

							</div>
		</div> 				 
					 		<div class="clearfix"></div>
					 		<div class="clearfix"></div>
							<?php } ?> 
					<div class="clearfix"></div>
							<div class="form-group  ">

						    <div class="row">
                          
                            <?php 
										$fileField = 'image';
										$title_text = $this->tag->getTag('upload','Upload');
										$types = '.png,.jpg,.jpeg';
										$maxFiles = '1';
										?>
							<div class="col-sm-5"  ><label for="ListingUsers_image"><?php echo $user->getAttributeLabel('image');?>  </label>
							<div class="clearfix"></div>
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1; color:#fff;"><?php echo $this->tag->getTag('allowed','Allowed');?>: <b dir="auto"><?php echo $types;?></b></div>
							</div>

							<div class="col-sm-7 nolabel">

							  <?php
									 
										$this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
										
		  
		 
							?>
						 

							</div>

							</div>
		</div> 				 
				<div class="clearfix"></div>
							<div class="form-group  ">

						    <div class="row">
						   

							<div class="col-sm-5"><label for="ListingUsers_phone"><?php echo $this->tag->getTag('phone','Phone Number');?></label></div>


							<div class="col-sm-7" dir="auto">
<span style="font-weight:600"><?php  	echo  $user->full_number  ?></span>
							
							<div class="clearfix"></div>
                          
							</div>
                        
							</div>
						 
							<div class="row">
							    <div class="col-sm-12"> 
							    <div class="">
						 
							    <div class="checkboxes">
						<label class="container_check" for="<?php echo $user->modelName;?>_s_w" style="font-size: 13px !important;line-height: 20px;"> <?php echo $user->getAttributeLabel('s_w');?>
						<?php  echo $form->checkBox($user , 's_w',  $user->getHtmlOptions('s_w',array('onchange'=>'hidewhtsapp(this)')) );  ?> 
						  <span class="checkmark"></span>
						</label>
					 
					</div>
							    
							    </div>
							    </div>
	                    	</div> 
                            	<div class="clearfix"></div>
							<div class="form-group   <?php echo !empty($user->s_w) ? 'hide' : '';?> " id="hdwtsapp">

						    <div class="row">
						    <?php $user->whatsapp_false = $user->whatsapp; ?>

							<div class="col-sm-5"><label for="ListingUsers_whatsapp"><?php echo $this->tag->getTag('whatsapp_number','WhatsApp Number');?> <span class="hide"><br /><small> (Only if  not your registered mobile number)</small></span></label></div>


							<div class="col-sm-7" dir="auto">

							<?php  	echo $form->textField($user , 'whatsapp_false' ,  $user->getHtmlOptions('whatsapp',array('class'=>'input-text form-control form_have_placeholder','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  )));  ?>

							<?php echo $form->error($user, 'whatsapp');?>

							</div>

							</div>
		</div> 
                    </div> 
	<div class="clearfix"></div> 
								<div class="form-group  ">

						    <div class="row">
						     
							<div class="col-sm-5"><label for="ListingUsers_mul_state_id"><?php echo $this->tag->getTag('service_areas','Service Areas');?> </label></div>


							<div class="col-sm-7">

							<?php  	  
							if(!$user->isNewRecord and !Yii::app()->request->isPostRequest){
						$user->mul_state_id = CHtml::listData($user->moreState,'state_id','state_id');
						 
					}
							$country_id = empty($user->country_id) ? COUNTRY_ID : $user->country_id;
							echo $form->dropDownList($user, 'mul_state_id', CHtml::listData(States::model()->AllListingStatesOfCountry($country_id),'state_id' , 'state_name') , $user->getHtmlOptions('mul_state_id',array(  'class'=>'select2' ,'style'=>'width:100%;'	,'multiple'=>true	,'data-placeholder'=>'Select Service Areas'	)			)); ?>
			 

							<?php echo $form->error($user, 'mul_state_id');?>

							</div>

							</div>
		</div> 
	<div class="clearfix"></div> 
	
		<div class="clearfix"></div> 
								<div class="form-group  ">

						    <div class="row">
						     
							<div class="col-sm-5"><label for="ListingUsers_service_offerng"><?php echo $user->getAttributeLabel('service_offerng');?> </label></div>


							<div class="col-sm-7">

							<?php  	  
							if(!$user->isNewRecord and !Yii::app()->request->isPostRequest){
						$user->service_offerng = CHtml::listData($user->moreSection,'section_id','section_id');
						 
					}
							$datas = array('1'=>$this->tag->getTag('for_sale','For Sale'),'2'=>$this->tag->getTag('for_rent','For Rent')) ;
				 
					  echo $form->dropDownList($user, 'service_offerng', $datas , $user->getHtmlOptions('service_offerng',array( 'data-placeholder'=>'Choose services', 'class'=>'select2 form-control' ,'style'=>'width:100%;'		,'multiple'=>true	)			)); ?>

							<?php echo $form->error($user, 'service_offerng');?>

							</div>

							</div>
		</div> 
			<div class="clearfix"></div>
				<div class="form-group  ">

						    <div class="row">
						     
							<div class="col-sm-5"><label for="ListingUsers_service_offerng_detail"><?php echo $user->getAttributeLabel('service_offerng_detail');?> </label></div>


							<div class="col-sm-7">

							<?php  	  
							if(!$user->isNewRecord and !Yii::app()->request->isPostRequest){
						$user->service_offerng_detail =  CHtml::listData($user->moreCategory,'category_id','category_id');
						 
					}
							$datas = CHtml::listData(Category::model()->listData(),'category_id','category_name') ;
							echo $form->dropDownList($user, 'service_offerng_detail', $datas , $user->getHtmlOptions('service_offerng_detail',array( 'data-placeholder'=>'Select your Service Categories', 'class'=>'select2 form-control' ,'style'=>'width:100%;'		,'multiple'=>true	)			)); ?>
			 

							<?php echo $form->error($user, 'service_offerng_detail');?>

							</div>

							</div>
		</div> 
	<div class="clearfix"></div>
								<div class="form-group <?php echo in_array($user->user_type,array('C','D','M')) ? 'hide' : '';?> ;?>  margin-bottom-0 ">

						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"   id="bb"  /><?php echo $this->tag->getTag('update_profile','Update Profile');?></button>

							</div>
		</div> 
							</div><!-- end #signin-form -->
						
							</div><!-- end #signin-form -->
							</div><!-- end #right-col -->
							<?php $this->endWidget();?>

			</div>

			<!-- Register -->
		 
            </div>
         	</div>

			<!-- Register -->
		 
            </div>
         
          <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('change_password','Change Password');?>  <a class="pull-right" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fa fa-edit"></i></a>
</h4>
          <div class="tabs-container alt collapse " id="multiCollapseExample1"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div   id="tab1" style="border-top: 0px solid #e0e0e0;padding-bottom:10px">
		   <div class=" "> 
 
            <!-- Login -->
							<div class="  padding-top-0" id="tab1" style="border-top:0px;">
							<?php
							
							$user->scenario ='updatepassword'; 
							$form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form2',
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'validateOnType'=>false,
							),
							)); ?>
							<div id="right-col">
                            <input type="hidden" name="module" value="change_password" />

							<div id="signin-form">
							      <div class="form-group  ">
                            
                            <div class="row">
                            
                            <div class="col-sm-5">
                            <label for="ListingUsers_old_password" class="required"><?php echo $this->tag->getTag('old_password','Old Password');?> <span class="required">*</span></label>
                            </div>
                            
                            <div class="col-sm-7">
                            	<?php  	echo $form->passwordField($user , 'old_password' ,  $user->getHtmlOptions('old_password',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

                            <?php echo $form->error($user, 'old_password');?>
                            
                            
                            </div>
                            
                            </div>
                            </div> 
                           
                            <div class="form-group  ">
                            
                            <div class="row">
                            
                            <div class="col-sm-5">
                            <label for="ListingUsers_password" class="required"><?php echo $this->tag->getTag('enter_new_password','Enter new Password');?> <span class="required">*</span></label>
                            </div>
                            
                            <div class="col-sm-7">
                            <div class=' '   id='ListingUsers_password' style="width:192px;"></div>
                            <?php echo $form->error($user, 'password');?>
                            
                            <style>
                           #ListingUsers_password  input.pwdfield {
    border: 1px solid #dfe0e3;
    border-radius: 3px;
    color: #72727d;
    font: 13px arial;
        font-size: 13px;
        line-height: normal;
    height: 24px !important;
    padding: 1px 0;
    width: 192px;
    margin-right: 0px;min-height: unset !important;
}
                            </style>
                            </div>
                            
                            </div>
                            </div> 
                            <div class="clearfix"></div> 
	 <div class="clearfix"></div> 
	
		<div class="form-group  ">

						    <div class="row">
	<div class="col-sm-5">
							    <label for="ListingUsers_con_password" class="required"><?php echo $this->tag->getTag('confirm_password','Confirm Password');?>  <span class="required">*</span></label>
							</div>
					 
							<div class="col-sm-7">
                        
                           
							<?php  	echo $form->passwordField($user , 'con_password' ,  $user->getHtmlOptions('con_password',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php echo $form->error($user, 'con_password');?>
							
						 
							</div>

							</div>
		</div> 
	 
		
			<div class="clearfix"></div>
						 	<div class="clearfix"></div>
							
							
							
							<div class="form-group  margin-bottom-0 ">

						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"   id="bb"     /><?php echo $this->tag->gettag('change_password','Change Password');?></button>

							</div>
		</div> 
							</div><!-- end #signin-form -->
							</div><!-- end #right-col -->
							<?php $this->endWidget();?>

			</div>

			<!-- Register -->
		 
            </div>
         	</div>

			<!-- Register -->
		 
            </div>
        
         
          </div>
          <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('change_name','Change Name');?> <a class="pull-right" data-toggle="collapse" href="#multiCollapseExample4" role="button" aria-expanded="false" aria-controls="multiCollapseExample4"><i class="fa fa-edit"></i></a></h4>
          <div class="tabs-container alt collapse" id="multiCollapseExample4"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div   id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
 
            <!-- Login -->
							<div class="  padding-top-0  " id="tab1" style="border-top:0px;padding-bottom:10px">
							<?php
							$user->scenario ='change_name';
							$form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form5',
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'validateOnType'=>false,
							),
							)); ?>
							<div id="right-col">


							<div id="signin-form">
              
			<input type="hidden" name="module" value="change_name" />
			<div class="clearfix"></div>
					 	<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><?php echo $form->labelEx($user ,'first_name');?></div>

							<div class="col-sm-7">

							<?php  	echo $form->textField($user , 'first_name' ,  $user->getHtmlOptions('first_name',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php echo $form->error($user, 'first_name');?>

							</div>

							</div>
		</div> 
						 	<div class="clearfix"></div>
							
								<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><?php echo $form->labelEx($user ,'first_name_ar');?><label class="margin-left-5">(<?php echo $this->tag->getTag('arabic','Arabic');?>)<label></div>

							<div class="col-sm-7">

							<?php  	echo $form->textField($user , 'first_name_ar' ,  $user->getHtmlOptions('first_name',array('class'=>'input-text form-control','placeholder'=>'','dir'=>'rtl' )));  ?>

							<?php echo $form->error($user, 'first_name_ar');?>

							</div>

							</div>
		</div> 
						 	<div class="clearfix"></div>
						
							
							<div class="form-group  margin-bottom-0 ">

						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"   id="bb"     /><?php echo $this->tag->getTag('change_name','Change Name');?></button>

							</div>
		</div> 
							</div><!-- end #signin-form -->
							</div><!-- end #right-col -->
							<?php $this->endWidget();?>

			</div>

			<!-- Register -->
		 
            </div>
         	</div>

			<!-- Register -->
		 
            </div>
        
        
          </div>
       
		
            <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('view_phone','View Phone');?>   <a class="pull-right" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2"><i class="fa fa-eye"></i></a></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div   id="multiCollapseExample2"  class="collapse"  style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
 
            <!-- Login -->
							<div class=" padding-top-0" id="tab1" style="border-top:0px;padding-bottom:10px">
							<?php
							$user->scenario = 'change_phone';
							/*
							$form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form3',
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>false,
							'validateOnChange'=>false,
							'validateOnType'=>false,
					 
							),
							));
							*/
							?>
							<div id="right-col">


							<div id="signin-form">
              
		<input type="hidden" name="module" value="change_phone" />
			<div class="clearfix"></div>
				<div class="form-group  ">

						    <div class="rowd">

						 
							<div class="col-sm-7">
                            <a href="javascript:void(0)"  dir="auto" style="font-size:20px;font-weight:600"><?php  	echo  $user->full_number ;  ?></a>	

							<?php  //	echo $form->textField($user , 'phone' ,  $user->getHtmlOptions('phone',array('class'=>'input-text form-control','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  )));  ?>

							<?php // echo $form->error($user, 'phone');?>
                            <span class="pull-right">
                      
                                
                            </span>
							</div>

							</div>
		</div>
	
						 	<div class="clearfix"></div>
							
							
							
							<div class="form-group  margin-bottom-0 ">
                             <?php /* 
						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"   id="bb"     />Change Phone</button>

							</div>
		</div> 
	                        */ ?>
							</div><!-- end #signin-form -->
							</div><!-- end #right-col -->
							<?php /*  $this->endWidget(); */ ?>

			</div>

			<!-- Register -->
		 
            </div>
         	</div>

			<!-- Register -->
		 
            </div>
        
         
          </div>
       
 <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('view_email','View Email');?>  <a class="pull-right" data-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3"><i class="fa fa-eye"></i></a></h4>
          <div class="tabs-container alt collapse"  id="multiCollapseExample3"   > 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div   id="tab1" style="border-top: 0px solid #e0e0e0;padding-bottom:10px">
		   <div class=" "> 
 
            <!-- Login -->
							<div class=" padding-top-0" id="tab1" style="border-top:0px;">
							<?php 
							$user->scenario = 'change_email'; 
							/*
							$form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form4',
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'validateOnType'=>false,
							),
							)); 
							*/
							?>
							<div id="right-col">


							<div id="signin-form">
              
		<input type="hidden" name="module" value="change_email" />
			<div class="clearfix"></div>
											<div class="form-group  ">

						    <div class="rows">
 
							<div class="col-sm-12">
                            <a href="javascript:void(0)"  style="font-size:20px;font-weight:600"><?php echo $user->email;?></a>
							<?php  //	echo $form->textField($user , 'email' ,  $user->getHtmlOptions('email',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php // echo $form->error($user, 'email');?>

							</div>

							</div>
						 
							 	</div>

						 	<div class="clearfix"></div>
							
							
							
							<div class="form-group  margin-bottom-0 ">
                            <?php /*
						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"   id="bb"     />Change Email</button>

							</div>
		</div> 
		*/
		?>
							</div><!-- end #signin-form -->
							</div><!-- end #right-col -->
							<?php /* $this->endWidget(); */ ?>

			</div>

			<!-- Register -->
		 
            </div>
         	</div>

			<!-- Register -->
		 
            </div>
        <div class="clearfix"></div>
        </div>
      

		</div>
		 
		
	 </div>

</div>
<script  type="text/javascript" >
        $(function(){	
        var pwdwidget = new PasswordWidget('ListingUsers_password','ListingUsers[password]' );
        pwdwidget.MakePWDWidget();
        })
		</script>
		<script>
			$(function(){
    var input = document.querySelector("#ListingUsers_phone");
    if(input!=undefined){
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
        hiddenInput: "full_number",
       initialCountry: "pk",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
        separateDialCode: true,
      utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
    });
    }
			})
  </script>
   <style>
     .pwdopsdiv { display:none ; } .pwdstrengthstr , .pwdstrength { height:auto; }
       
   </style>
   	<script>
   		$(function(){
    var input2 = document.querySelector("#ListingUsers_whatsapp_false");
    if(input2!=undefined){
      
    window.intlTelInput(input2, {
       hiddenInput: "whatsapp",
       
       initialCountry: "<?php echo COUNTRY_CODE;?>",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
        separateDialCode: true,
      utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
    });
    }
   		})
    var modelName = '<?php echo $user->modelName;?>';
    $(function(){
 
		 $('#'+modelName+'_mul_state_id').select2();
	 	 $('#'+modelName+'_service_offerng_detail').select2();
		 	 $('#'+modelName+'_service_offerng').select2();
	})
	 function hidewhtsapp(k){
				  if($(k).is(':checked')){
				    $('#hdwtsapp').addClass('hide');
				  }
				  else{
				       $('#hdwtsapp').removeClass('hide');
				  }
				 }
  </script>
  
