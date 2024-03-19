<?php
if(isset($_GET['floor']) and $_GET['floor']=='1'){

$this->renderPartial('//detail/_success_html_floor');
}else{
$this->renderPartial('//detail/_success_html');
}
?>
    <script> 
    <?php
    if(isset($_GET['floor']) and $_GET['floor']=='1'){ 
    
    ?>
    $('#myModal2').find('#myModal2-title').html('<?php echo $this->tag->getTag('request_floorplan', 'Request Floorplan') ;?>');
    <? }
    else{ ?>
    $('#myModal2').find('#myModal2-title').html('<?php echo $this->tag->getTag('contact_for_more_information', 'Contact For more information') ;?>');
    <?php
    }
    ?>
    
    </script>
                
                <style>
             #cn_property{padding:0!important;overflow:hidden}html input.input-text.form-control,html select.input-text.form-control,input.pwdfield{border:1px solid #dfe0e3;border-radius:3px;color:#72727d;font:13px arial;height:24px;padding:1px 0;width:100%;margin-right:10px}html textarea.input-text.form-control{border:1px solid #dfe0e3;line-height:1.4;padding:10px 8px;color:#72727d;font:13px arial}.sign-in-form label{margin-bottom:0}.sign-in-form .btn.btn-primary{background-color:var(--secondary-color);box-shadow:unset;border:0; font-size:14px;color:#fff;line-height:40px;border-radius:5px}.btn-sm-s{max-width:100%!important;line-height:35px!important;padding:0}.col-sm-5 label{color:#72727d!important;line-height:1;text-align:right}html .container_check input:checked~.checkmark{background-color:#90ee90;border:1px solid transparent}.container_check input:checked~.checkmark{background-color:#dc143c;border:1px solid transparent}.container_check .checkmark{position:absolute;top:0;left:0;height:20px;width:20px;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;-moz-transition:all .3s ease-in-out;-o-transition:all .3s ease-in-out;-webkit-transition:all .3s ease-in-out;-ms-transition:all .3s ease-in-out;transition:all .3s ease-in-out}.container_check input:checked~.checkmark::after{display:block}.container_check .checkmark::after{content:"";position:absolute;display:none;left:7px;top:3px;width:5px;height:10px;border:solid #fff;border-top-width:medium;border-right-width:medium;border-bottom-width:medium;border-left-width:medium;border-top-width:medium;border-right-width:medium;border-bottom-width:medium;border-left-width:medium;border-width:0 2px 2px 0;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}#frm_ctnt .errorMessage{font-size:12px;color:#e13009!important;padding:2px 0 0;top:unset!important}.grecaptcha-badge{z-index:999911119999!important}
                .success-modal .info .title {
    font-weight: var(--weight-800);
    margin: 0;
    line-height: 1.42857143;
    color: #333;
    font-weight: 600 !important;
    font-size: 18px;
} 
                </style>
                  
               <div id="topThirdPlacementLeadFormContainer" class="pan plm rms-data-h <?php  echo  (isset($_GET['floor']) and $_GET['floor']=='1') ? 'floor-pp' : '' ;?>">
               <div class="backgroundBasic sign-in-form   " id="topPanelLeadFormContainer">
                     <div data-reactroot="" class="pvn clearfix">
                        <div class="false" style="padding: 10px;">
							      
						   <?php
						   $mainTex =   $this->tag->getTag('send','Send') ; 
						   	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
						    $contact = new SendEnquiry();
							$contact->ad_id = $model->id ;
							 if(isset($_GET['floor']) and $_GET['floor']=='1'){
								 $form = $this->beginWidget('CActiveForm', array(
							'id'=>'frm_ctnt',
							'action'=>Yii::app()->createUrl('detail/validateEnquiry'),
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {

							form.find("#bb2").html("'. $Validating .'");
							return true;
							}',
							'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb2").html("'.$mainTex.'");
							return false;
							}
							else
							{
							form.find("#bb2").val("'. $please_wait .'"); 
				
							ajaxSubmitHappenlistfloor(form, data, hasError,"'.Yii::app()->createUrl('detail/SendEnquiry').'"); 
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
							));
							 }else{
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'frm_ctnt',
							'action'=>Yii::app()->createUrl('detail/validateEnquiry'),
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {

							form.find("#bb2").html("'. $Validating .'");
							return true;
							}',
							'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb2").html("'.$mainTex.'");
							return false;
							}
							else
							{
							form.find("#bb2").val("'. $please_wait .'"); 
				
							ajaxSubmitHappenlist(form, data, hasError,"'.Yii::app()->createUrl('detail/SendEnquiry').'"); 
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs ajxlo','style'=>'margin-top: 5px;' ),
							));
							 }
							?>
                            <style>
                            img.ag{max-width:110px!important;max-height:50px!important;margin-bottom:0;margin-left:auto;text-align:center;margin-right:auto;display:block}.ptn.man.kw-agent-info__agentItem___2iGT_.h7{font-weight:700;line-height:20px;display:flex}.ptn.man.kw-agent-info__agentItem___2iGT_.h7 span{margin-right:10px;font-weight:400;display:inline-block;max-width:90px;overflow:hidden;white-space:nowrap;min-width:90px;font-size:11px}
                            .ptn.man.kw-agent-info__agentItem___2iGT_.h7 { line-height:25px;}
                       .ajxlo     .input-text3.form-control{ 
    border: 1px solid #dfe0e3;
    /* max-width: 300px; */
    text-indent: 5px;font-size:13px;
    height: 45px;
 
}
.ajxlo .form-group{ margin-bottom:5px; }
html #cn_property .iti {
    max-width:unset !important;
    direction: ltr;
}#ph_replace{ direction:ltr; }
#ph_replace .iti.iti--container {
    top: 45px !important;
    left: 16px !important;
    position: absolute !important;
    bottom: unset !important;
    right: unset !important;
    min-height: 100px;
    max-height: 200px;
    /* overflow-y: scroll; */
    height: 300px !important;
    /* right: unset!important; */
    max-width: 300px !important;
}
                            </style>
                           
                              <div class="cols24">
                                  <h1 data-testid="home-details-summary-address" class="HomeSummaryShared__AddressH1-vqaylf-1 cmjCIx"><span data-testid="home-details-summary-headline" class="Text__TextBase-sc-1cait9d-0 dhOdUy titinc smsec_<?php echo $model->section_id;?>" style="font-size:19px;line-height: 25px;display: block;"><?php echo $model->ad_title;?></span></h1>
                                  <div class="adDetailsinsideform" style="width:calc(100% - 100px);float:left;padding-right:10px;">
								       <div><?php echo $model->listRow1();?></div>
           <div><?php echo $model->listRow3();?></div>
           <div><?php echo $model->listRow2();?></div>
               </div>
            <div class="imageDetailsinsideform" style="width:90px;float:right;height:70px;border:1px solid #eee;padding:5px;">
				<div style="background-position:center;background-size:cover;background-repeat:no-repeat;background-image:url('<?php echo $model->SingleImage ;?>');width:100%;height:100%;"></div>
			</div>
			<div class="clearfix"></div>
           <hr />
								 </div>
								 <?php
								 if(!Yii::app()->request->isPostRequest and !empty($this->mem)){
								     $contact->name = $this->mem->first_name; 
								       $contact->phone_false = $this->mem->full_number; 
								       $contact->email = $this->mem->email; 
								 }
								 ?>
								 		<div class="form-group  ">

						    <div class="row">

					 
							<div class="col-sm-12">

							<?php  	echo $form->textField($contact , 'name' ,  $contact->getHtmlOptions('name',array('class'=>'input-text3 form-control','placeholder'=>$contact->getAttributeLabel('name').' *' )));  ?>

							<?php echo $form->error($contact, 'name');?>
							<?php echo $form->hiddenField($contact, 'ad_id'); ?>
											 <?php echo $form->error($contact, 'ad_id');?>

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                        	<div class="form-group  ">

						    <div class="row">

							 
							<div class="col-sm-12">

							<?php  	echo $form->textField($contact , 'email' ,  $contact->getHtmlOptions('email',array('class'=>'input-text3 form-control','placeholder'=>$this->tag->getTag('your_e-mail_account','Your e-mail account').' *' )));  ?>

							<?php echo $form->error($contact, 'email');?>
						 

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                        
                                        	<div class="clearfix"></div>
		<div class="form-group  ">

						    <div class="row">

						 <style>.iti.iti--allow-dropdown input { margin-right:0px !important; }.iti{ width:100%; }</style>
							<div class="col-sm-12" style="position:relative;" >
                            <div id="ph_replace"></div>
							<?php  	echo $form->textField($contact , 'phone_false' ,  $contact->getHtmlOptions('phone_false',array('class'=>'input-text3 form-control','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  )));  ?>
							<?php echo $form->error($contact, 'phone_false');?>
							</div>

							</div>
		</div>
		 <div class="clearfix"></div>
								    	<div class="form-group  margin-bottom-0 ">

						    <div class="row">

						 
							<div class="col-sm-12">

						<?php
						if(isset($_GET['floor']) and $_GET['floor']=='1'){
							$contact->floor = '1'; 
							echo $form->hiddenField($contact , 'floor');
								   $contact->meassage = Yii::t('tran', $this->tag->getTag('i_would_like_to_inquire_about_','I would like to inquire about the floorplan for your property {REF}. Please contact me at your earliest convenience.') ,array('[PROPERTY]'=>$model->DetailUrlAbs,'{REF}'=>$model->ReferenceNumberTitle,'{site}'=>$this->project_name) ); 
											
						}else{
						    		   $contact->meassage = Yii::t('tran', $this->tag->getTag('i_would_like_to_inquire_about_','Hello, I am interested in this property and would like to make an appointment for a visit. Please contact me as soon as possible.{b}Thank you so much - [PROPERTY]') ,array('[PROPERTY]'=>$model->DetailUrlAbs,'{REF}'=>$model->ReferenceNumberTitle,'{site}'=>$this->project_name,'{b}'=>"\r\n") ); 
									/*
										 if($model->section_id=='2'){
										  $contact->meassage = Yii::t('tran',$this->tag->gettag('i_am_interested_in_this_rental', 'I am interested in this rental and would like to schedule a viewing. Please let me know when this would be possible.') ,array('{ad}'=>$model->AdTitle) ); 
										 }
										 else{
											   $contact->meassage = Yii::t('tran', $this->tag->getTag('i_would_like_to_inquire_about_','I would like to inquire about your property on {site} - {REF}. Please contact me at your earliest convenience.') ,array('{REF}'=>$model->ReferenceNumberTitle,'{site}'=>$this->project_name) ); 
										
										 }
										 */
						}
							echo $form->textArea($contact , 'meassage' ,  $contact->getHtmlOptions('meassage',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php echo $form->error($contact, 'meassage');?>
						 

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
								 
                              <div class="cols24">
                             
                                
								 	 <div id="msg_alert"></div>
								 	 
								 	 
								 	 
								 	  <div class="clearfix"></div>
  	 	 
								 	 	<div class="clear"></div>
								 	 		<div class="form-group  "  >

						    <div class="row">

							<div class="col-sm-12 margin-top-10">
					<div class="checkboxes">
						<label class="container_check" for="<?php echo $contact->modelName;?>_agree"><?php echo Yii::t('app',$this->tag->getTag('agree_to_the_{link1}_and_the_{','I Agree to the {link1} and the {link2}'),array('{link1}'=>'<a href="'.Yii::app()->createUrl('terms').'" target="_blank" class="link_color">  '.$this->tag->getTag('terms_and_conditions','Terms and Conditions').'</a>','{link2}'=>'<a href="'.Yii::app()->createUrl('privacy').'" target="_blank" class="link_color"> '.$this->tag->getTag('privacy_policy','Privacy Policy').'</a>'));?>
						<?php  echo $form->checkBox($contact , 'agree',  $contact->getHtmlOptions('agree',array('uncheckValue'=>'', 'value'=>'1' )) );  ?> 
						  <span class="checkmark"></span>
						</label>
						<?php echo $form->error($contact, 'agree');?>
					</div>
					</div>
					</div>
					</div>
					
					<div class="clear"></div>
					
	<div class="form-group  margin-bottom-5">

						    <div class="row">
 
							<div class="col-sm-12">
	  
							<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-7">
		 
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"  id="bb2" style=" clear: both; min-width:150px;" data-html="<?php echo $mainTex;?>"><?php echo $mainTex;?></button>
	   <p class="formLegalDisclaimer positionRelative h8 typeLowlight mtn">
                                      <?php // echo Yii::t('trans', 'By clicking on \'Check Availablity\', I agree to the {p} {t} and {pp}' ,array('{p}'=>$this->project_name,'{t}'=>'<a class="linkUnderline linkLowlight" href="/terms" target="_blank">'. 'Terms & Conditions' .'</a>','{pp}'=>'<a class="linkUnderline linkLowlight" href="/privacy" target="_blank">'. 'Privacy Policy' .'</a>'));?> 
                                  
                                    </p>
		
							</div>
		</div> 
							</div><!-- end #signin-form -->
						
	
							</div>
		</div> 

	<div class="clear"></div>
	<div class="clear"></div>

  
					<div class="clearfix"></div>
				</div>
		 	
                              
                              </div>
                          <?php $this->endWidget(); ?>
                        </div>
                     </div>
                  </div>
               </div>
			   <div class="clearfx"></div>
         
 
 
	
 
		<script>
			$(function(){
			     
    var input5 = document.querySelector("#<?php echo $contact->modelName;?>_phone_false");
    window.intlTelInput(input5, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      dropdownContainer:document.getElementById('ph_replace') ,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
        hiddenInput: "phone",
       initialCountry: "<?php echo COUNTRY_CODE;?>",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
        separateDialCode: true,
      utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
    });
     
			})
  </script>
   <style>
     .pwdopsdiv { display:none ; } .pwdstrengthstr , .pwdstrength { height:auto; }
       
   </style>
	 
