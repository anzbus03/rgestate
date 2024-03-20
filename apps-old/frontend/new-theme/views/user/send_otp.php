<?php defined('MW_PATH') || exit('No direct script access allowed');?>
       <link rel="stylesheet" href="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/css/intlTelInput.css');?>">
                          <script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/intlTelInput.js');?>"></script> 
 
<div class="container">

	<div class="row">
	<style>
	    .iti input { margin-right:0px !important;    width: 100% !important; } .iti { width:100%; }
	    
	</style>
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1">
           
             <h4 class="subheading_font row bold-style">Phone Number Verification</h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				 <?php
			 if(!Yii::app()->request->isPostRequest){
			 
			  $model->phone = $model->full_number;
			  }
			  ?>
            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
 
            <!-- Login -->
							<div class="tab-content padding-top-0" id="tab1" style="border-top:0px;margin:auto;max-width: 300px;margin: auto;display: block;">
							<?php
							   $action = !empty($email) ? Yii::app()->createUrl('user/otp_verify',array('email'=>$email)) : Yii::app()->createUrl('user/otp_verify' ); 
						
							$form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'action'=>$action,
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'validateOnType'=>true,
							),
							)); ?>
							<div id="right-col">


							<div id="signin-form">


								<div class="form-group  ">

						    <div class="row">

		 
							<div class="col-sm-12">

							<?php  
						  
							
							echo $form->textField($model , 'phone' ,  $model->getHtmlOptions('phone',array('class'=>'input-text form-control LJB','style'=>'font-size: 16px; line-height: 24px; padding: 12px 12px 12px 92px; height: auto; width: auto;','placeholder'=>'','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"   )));  ?>

							<?php echo $form->error($model, 'phone');?>

							</div>
							 
 

							</div>
		</div> 
	<div class="form-group  ">

						    <div class="row">

							 
							<div class="col-sm-12">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n"  style="  clear: both;width: 100% !important;max-width: unset !important; "  />Send Verification Code</button>

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
       

		

		</div>
		 
		
	 </div>

</div>
 
		<script>
    var input = document.querySelector("#ListingUsers_phone");
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
       initialCountry: "<?php echo COUNTRY_CODE;?>",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
        separateDialCode: true,
      utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
    });
  </script>
