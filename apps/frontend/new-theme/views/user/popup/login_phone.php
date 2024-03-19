<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<link rel="stylesheet" href="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/css/intlTelInput.css');?>">
<script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/intlTelInput.js');?>"></script>

<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1"   >
         
          <div class="tabs-container alt" > 
		  <h4 class="subheading_font row bold-style"> <a href="<?php echo Yii::app()->createUrl('user/Login_option_pop');?>" style="display:inline-block;margin-right:5px;" onclick="easyload(this,event,'pajax')" class="bld-link2" ><span data-aut-id="enteruser-click-back" class="_2uUJF"><svg width="14px" height="14px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-22SD7" d="M196.267 469.333l315.733-320-59.733-59.733-422.4 422.4 422.4 422.4 59.733-59.733-320-320h759.467l42.667-42.667-42.667-42.667h-755.2z"></path></svg></span></a> Log in with your phone</h4>
		 
            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0;">
				
			<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'signin-form',
								'action'=>Yii::app()->createUrl('user/signin_phone_popup'),
								'enableAjaxValidation'=>true,
							
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {
				     
						form.find("#bb").html("Validating..");
						return true;
					}',
					'afterValidate' => 'js:function(form, data, hasError) { 
					 
					if(hasError) {
					 
				 
						
							form.find("#bb").html("Send OTP");
							return false;
					}
					else
					{
							form.find("#bb").html("Please wait..");	return true;
					}
					}',
					
					
							),
							'htmlOptions'=>array('autocomplete'=>'off','class'=>'recapt')
							));  ?>
							<style>
							#fbsignin-form #right-col #signin-form {
    float: none;
    border-left: 0px solid #cacaca;
    padding-left:  0px; margin:auto; 
}
.iti input { margin-right:0px !important;    width: 100% !important; } .iti { width:100%; }
							</style>
							
	<div class="clearfix"></div>
 
	<div class="clearfix"></div>
	
		 <div id="right-col" style="float:none !important;;border-left:0px !important; margin:auto;margin:auto;max-width: 300px;margin: auto;display:block;">
			 
			 
			<div id="signin-form" style="">
			    
			    	<div class="clearfix"></div> 
		<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-12"><?php echo $form->labelEx($user ,'phone');?></div>

							<div class="col-sm-12">

							<?php  	echo $form->textField($user , 'phone' ,  $user->getHtmlOptions('phone',array('class'=>'form_have_placeholder input-text form-control','style'=>'font-size: 16px; line-height: 24px; padding: 12px 12px 12px 92px; height: auto; width: auto;margin-right:0px !important;','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" )));  ?>

							<?php echo $form->error($user, 'phone');?>

							</div>

							</div>
		</div> 

	<div class="clear"></div>

 	<div class="clearfix"></div> 
		  	<div class="clearfix"></div> 
				<div class="form-group margin-bottom-0">

						    <div class="row">
 
							<div class="col-sm-12">
	  
							<div class="form-group  margin-bottom-5 ">

						    <div class="row">

					 
							<div class="col-sm-12">
		<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s" disabled   id="bb" style="  clear: both;width: 100% !important;max-width: unset !important; "  >Send Verification Code</button>
 
							</div>
		</div> 
							</div><!-- end #signin-form -->
						
	
							</div>
		</div> 

	<div class="clear"></div>
	<div class="clear"></div>

  
					<div class="clearfix"></div>
				</div>
		 	<div class="clearfix"></div> 
			
			 
				<div class="clearfix"></div> 
			<div class="pop_boxone">
						<?php
						$min_error_count  = 1 ; 
					  
									$min_error_count  = 2 ; 
									?> 
									<div class="form-group">
								 	<div class="clearfix"></div>
								 
									<div class="clearfix"></div>
									<?php echo $form->hiddenField($user, '_recaptcha' );?>
									<?php echo $form->error($user, '_recaptcha',array('style'=>'top:0px !important;'));?>
									 </div>	
									<div class="clearfix"></div>
										</div>	
	
	<?php $this->endWidget();?>
 						<div class="clear_div"></div>
						</div>
        

			</div>

			<!-- Register -->
			 		<div class="clearfix"></div>
		 		<div class="clearfix"></div>
			
            </div>
          </div>
       

		

		</div>
		 
		
 	</div>

</div> 
	<script>
		$(function(){
    var input = document.querySelector("#UserLoginPhone_phone");
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
    })
  </script>
<?php $this->renderPartial('popup/_benefits');?>
