                <?php $this->renderPartial('//user_listing/_success_html');?>
                
                <style>
             #cn_property{padding:0!important;overflow:hidden}html input.input-text.form-control,html select.input-text.form-control,input.pwdfield{border:1px solid #dfe0e3;border-radius:3px;color:#72727d;font:13px arial;height:24px;padding:1px 0;width:100%; }html textarea.input-text.form-control{border:1px solid #dfe0e3;line-height:1.4;padding:10px 8px;color:#72727d;font:13px arial}.sign-in-form label{margin-bottom:0}.sign-in-form .btn.btn-primary{background-color:var(--secondary-color);box-shadow:unset;border:0; font-size:14px;color:#fff;line-height:40px;border-radius:5px}.btn-sm-s{max-width:100%!important;line-height:35px!important;padding:0}.col-sm-5 label{color:#72727d!important;line-height:1;text-align:right}html .container_check input:checked~.checkmark{background-color:#90ee90;border:1px solid transparent}.container_check input:checked~.checkmark{background-color:#dc143c;border:1px solid transparent}.container_check .checkmark{position:absolute;top:0;left:0;height:20px;width:20px;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;-moz-transition:all .3s ease-in-out;-o-transition:all .3s ease-in-out;-webkit-transition:all .3s ease-in-out;-ms-transition:all .3s ease-in-out;transition:all .3s ease-in-out}.container_check input:checked~.checkmark::after{display:block}.container_check .checkmark::after{content:"";position:absolute;display:none;left:7px;top:3px;width:5px;height:10px;border:solid #fff;border-top-width:medium;border-right-width:medium;border-bottom-width:medium;border-left-width:medium;border-top-width:medium;border-right-width:medium;border-bottom-width:medium;border-left-width:medium;border-width:0 2px 2px 0;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}#frm_ctnt .errorMessage{font-size:12px;color:#e13009!important;padding:2px 0 0;top:unset!important}.grecaptcha-badge{z-index:999911119999!important}
                .success-modal .info .title {
    font-weight: var(--weight-800);
    margin: 0;
    line-height: 1.42857143;
    color: #333;
    font-weight: 600 !important;
    font-size: 18px;
} 
                </style>
                  
               <div id="topThirdPlacementLeadFormContainer" class="pan plm rms-data-h">
               <div class="backgroundBasic sign-in-form   " id="topPanelLeadFormContainer">
                     <div data-reactroot="" class="pvn clearfix">
                        <div class="false padding-left-0   padding-bottom-15"  >
							      
						   <?php
						   $mainTex =    $this->tag->getTag('email','Email')   ; 
						   	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
						    $contact = new ContactAgent();
							$contact->user_id = $model->user_id ;
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'frm_ctnt1',
							'action'=>Yii::app()->createUrl('user_listing/validateEnquiry2'),
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
							 
							form.find("#bb2").html("'. $please_wait .'"); 
				
							ajaxSubmitHappenlist(form, data, hasError,"'.Yii::app()->createUrl('user_listing/SendEnquiry2').'"); 
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact ns1 phs','style'=>'margin-top: 5px;' ),
							));
							?>
                            <style>
                            img.ag{max-width:110px!important;max-height:50px!important;margin-bottom:0;margin-left:auto;text-align:center;margin-right:auto;display:block}.ptn.man.kw-agent-info__agentItem___2iGT_.h7{font-weight:700;line-height:20px;display:flex}.ptn.man.kw-agent-info__agentItem___2iGT_.h7 span{margin-right:10px;font-weight:400;display:inline-block;max-width:90px;overflow:hidden;white-space:nowrap;min-width:90px;font-size:11px}
                            .ptn.man.kw-agent-info__agentItem___2iGT_.h7 { line-height:25px;}
                            .cctnct-txt { font-size:14px; font-weight:600;margin-bottom:10px;margin-top:10px;text-align:center;}
                            .ctin hr { margin-top:5px !important; margin-bottom:5px!important;}
                            .ctin #SendEnquiry_meassage{ resize: none;height: 100px !important;min-height: unset;}
                            </style>
                           
                              <div class="cols24">
                                   
         
			<div class="clearfix"></div>
           <h1 class="cctnct-txt agentss"><?php echo $this->tag->getTag('contact_for_more_information','Contact for more information');?></h1>
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

							<?php  	echo $form->textField($contact , 'name' ,  $contact->getHtmlOptions('name',array('class'=>'input-text form-control','placeholder'=>$contact->getAttributeLabel('name').' *' )));  ?>

							<?php echo $form->error($contact, 'name');?>
							<?php echo $form->hiddenField($contact, 'user_id'); ?>
											 <?php echo $form->error($contact, 'user_id');?>

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                        	<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  	echo $form->textField($contact , 'email' ,  $contact->getHtmlOptions('email',array('class'=>'input-text form-control','placeholder'=>$contact->getAttributeLabel('email').' *' )));  ?>

							<?php echo $form->error($contact, 'email');?>
						 

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                        
                                        	<div class="clearfix"></div>
		<div class="form-group  ">

						    <div class="row">

							 
							<div class="col-sm-12" dir="ltr">
<style>.iti.iti--allow-dropdown input { margin-right:0px !important; }.iti{ width:100%; }</style>
							<?php  	echo $form->textField($contact , 'phone_false' ,  $contact->getHtmlOptions('phone_false',array('class'=>'input-text form-control','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  )));  ?>

							<?php echo $form->error($contact, 'phone_false');?>
							

							</div>

							</div>
		</div>
		 <div class="clearfix"></div>
								    	<div class="form-group  margin-bottom-0 ">

						    <div class="row">

						 
							<div class="col-sm-12">

						<?php
								  
										 if($model->user_type !='A'){
										  $contact->meassage = Yii::t('tran',$this->tag->gettag('i_would_like_to_find_out_more_', 'I would like to find out more about your agency and properties. Please contact me at your earliest convenience.')   ); 
										 }else{
											 
											 
											   $contact->meassage = Yii::t('tran',$this->tag->gettag('i_would_like_to_find_out_more_', 'I would like to inquire about your properties. Please contact me at your earliest convenience.')   ); 
										
										 }
										 
							echo $form->textArea($contact , 'meassage' ,  $contact->getHtmlOptions('meassage',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php echo $form->error($contact, 'meassage');?>
						 

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
								 
                              <div class="cols24">
                             
                                
								 	 
								 	 
								 	  <div class="clearfix"></div>
  	 	 
								 	 	<div class="clear"></div>
								 	 		<div class="form-group  "  >

		 			</div>
					
					<div class="clear"></div>
					
	<div class="form-group  margin-bottom-5">

						    <div class="row">
 
							<div class="col-sm-12">
	  
							<div class="form-group  ">

						    <div class="row" style="display: flex;">
							  <div class="col-sm-12" style="display: flex;">
							  <?php $phone =  !empty($model->full_number) ? $model->full_number : $model->phone; ?> 
							  <a type="button"   class="btn btn-primary btn-block headfont btn-sm-s  text-center margin-right-10" onclick="OpenCallNew(this)"  data-prop="<?php echo  $model->user_id ;?>" data-phone="<?php echo base64_encode( $phone);?>"   data-testid="lead-form-submit" style="margin-bottom:8px" class="b-l-l-m br-black-1-dot Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA" dir="auto" ><i class="fa fa-phone margin-right-3" style="font-size: 20px; "></i> <?php echo  $this->tag->getTag('call','Call') ;?></a>
								  
									<button  type="button"   onclick="OpenSignupRequiredNewEmail(this)" data-reactid="<?php echo $model->user_id;?>"  class="btn btn-primary btn-block headfont btn-sm-s  text-center"  style=" padding: 0px 10px;height: 36px;"  ><i class="fa fa-envelope margin-right-3"  style= "font-size:20px;"></i>  <span  id="bb2"><?php echo $mainTex;?></span></button>
							 
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
    var input = document.querySelector("#<?php echo $contact->modelName;?>_phone_false");
    
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
	 

