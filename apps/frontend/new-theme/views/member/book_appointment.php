<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 <style>
     .col-sm-5 label { text-align:left;float: left; } .nolabel label { display:none; }
     .collapse:not(.in) {
    display: none;
}
.container.bg-bk.card-1{ padding:0px ; }
.main-panel { margin-left:0px; }.myaccount-menu.is-ended{ display: none; }
#ListingUsers_password input { max-width:100%;}.package-detail-ul   { list-style-type:none; margin:0px; padding:0px;}.package-detail-ul li.title  { font-weight:600; }
 
 </style>
 	 <style>.pwdstrength { position:absolute; } #ListingUsers_password{position:relative; } .pwdstrengthstr{position: absolute;top: -19px;right: 3px;} </style>
						
						 
<style>
    .card-1 .subheading_font { display:block; }
    ul.account_details li { line-height:1.5; }
    .p-img-payment { margin:auto;line-height:1;text-align: center;position: absolute;right: 10px;/*! top: 50px; */}
    html[dir='rtl'] .p-img-payment{ right:unset; left:10px; }
</style>
<div class="container">

	<div class=" ">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div>
           
             <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('book_an_appointment','Book an appointment');?></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div  id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
		 
			<Style>
			.headbd { font-weight:600;}
			</Style>
			 
	 		
			<div class="col-sm-12 headbd"><?php echo $this->tag->getTag('package_details','Add-on Features');?></div>
			<div class="col-sm-12"><?php echo $packageModel->PackageDetails;?></div>
					
			
			    <div class="false col-sm-12"  >
							      
						   <?php
						      		$mainTex =  $this->tag->getTag('book_an_appointment','Book an appointment');
	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'signin-form',
							'action'=>Yii::app()->createUrl('member/book_an_appointment',array('package_uid'=>$package_uid)),
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
				
						 return true;
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs recapt','style'=>'margin-top: 5px;' ),
							));
							?>
                            <style>
                            img.ag{max-width:110px!important;max-height:50px!important;margin-bottom:0;margin-left:auto;text-align:center;margin-right:auto;display:block}.ptn.man.kw-agent-info__agentItem___2iGT_.h7{font-weight:700;line-height:20px;display:flex}.ptn.man.kw-agent-info__agentItem___2iGT_.h7 span{margin-right:10px;font-weight:400;display:inline-block;max-width:90px;overflow:hidden;white-space:nowrap;min-width:90px;font-size:11px}
                            .ptn.man.kw-agent-info__agentItem___2iGT_.h7 { line-height:25px;}
                            </style>
                           
                              
													 
														  

													<div class="clearfix"></div>
												 	<div class="clearfix"></div>
												 	
														<div class="clearfix"></div>
													<h2 style="font-size:24px;"><?php echo  $this->tag->getTag('contact_details','Contact Details');?></h2>
													<div class="clearfix"></div>
												
													
													
                                        	<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  	echo $form->textField($model , 'name' ,  $model->getHtmlOptions('name',array('class'=>'input-text form-control LJB','placeholder'=>$model->mTag()->getTag('full_name_*','Full Name *'))));  ?>

							<?php echo $form->error($model, 'name');?>
							<?php
							$model->user_id = (int) Yii::app()->user->getId();
							$model->package_id = $packageModel->primaryKey;
							?>
							<?php echo $form->hiddenField($model, 'package_id');?>
						    <?php echo $form->error($model, 'package_id');?>
							<?php echo $form->hiddenField($model, 'user_id');?>
						    <?php echo $form->error($model, 'user_id');?>

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                        	<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  	echo $form->textField($model , 'email' ,  $model->getHtmlOptions('email',array('class'=>'input-text form-control LJB','placeholder'=>$model->mTag()->getTag('email_*','Email *') )));  ?>

							<?php echo $form->error($model, 'email');?>
						 

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                      
                                        	<div class="clearfix"></div>
		<div class="form-group  ">

						    <div class="row">


							<div class="col-sm-12 phndd" dir="ltr">
<style>.iti.iti--allow-dropdown input { margin-right:0px !important; }.iti{ width:100%; }</style>
							<?php  	echo $form->textField($model , 'phone_false' ,  $model->getHtmlOptions('phone_false',array('class'=>'input-text form-control LJB','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  )));  ?>

							<?php echo $form->error($model, 'phone_false');?>
							

							</div>

							</div>
		</div>
		 <div class="clearfix"></div>
		 
		                   <div class="clearfix"></div>
		                   <div style="clear:both;"></div>
            
                       
		                 <div class="clearfix"></div>
								 
                              <div class="cols24">
                             
                                
								 	 <div id="msg_alert"></div>
								 	 
								 	 
								 	 
								 	  <div class="clearfix"></div>
  	 	 
								 	 	<div class="clearfix"></div>
								 	 		<div class="form-group  spl-12 agr"  >

						    <div class="row">

							<div class="col-sm-12">
					<div class="checkboxes">
						<label class="container_check" for="<?php echo $model->modelName;?>_agree"><?php echo Yii::t('app',$this->tag->getTag('agree_to_the_{link1}_and_the_{','Agree to the {link1} and the {link2}'),array('{link1}'=>'<a href="'.Yii::app()->createUrl('terms').'" target="_blank" class="link_color">  '.$this->tag->getTag('terms_and_conditions','Terms and Conditions').'</a>','{link2}'=>'<a href="'.Yii::app()->createUrl('privacy').'" target="_blank" class="link_color"> '.$this->tag->getTag('privacy_policy','Privacy Policy').'</a>'));?>
						<?php  echo $form->checkBox($model , 'agree',  $model->getHtmlOptions('agree',array('uncheckValue'=>'', 'value'=>'1' )) );  ?> 
						  <span class="checkmark"></span>
						</label>
						<?php echo $form->error($model, 'agree');?>
					</div>
					</div>
					</div>
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
									 <script>
						

  </script>
			 
			
									<div class="clearfix"></div>
									<?php echo $form->hiddenField($model, '_recaptcha' );?>
									<?php echo $form->error($model, '_recaptcha',array('style'=>'top:0px !important;'));?>
									 </div>	
									<div class="clearfix"></div>
										</div>	
	
<div class="clearfix"></div>
 
					<div class="clearfix"></div>
					
	<div class="form-group spl-n-right  margin-bottom-5">

						    <div class="row">
 
							<div class="col-sm-12">
	  
							<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-7">
		 
							<button  type="submit"   class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n"  id="bb2" style=" clear: both;max-width:90%;margin:auto;" data-html="<?php echo $mainTex;?>"><?php echo $mainTex;?></button>
	   <p class="formLegalDisclaimer positionRelative h8 typeLowlight mtn">
                                      <?php // echo Yii::t('trans', 'By clicking on \'Check Availablity\', I agree to the {p} {t} and {pp}' ,array('{p}'=>$this->project_name,'{t}'=>'<a class="linkUnderline linkLowlight" href="/terms" target="_blank">'. 'Terms & Conditions' .'</a>','{pp}'=>'<a class="linkUnderline linkLowlight" href="/privacy" target="_blank">'. 'Privacy Policy' .'</a>'));?> 
                                  
                                    </p>
		
							</div>
		</div> 
							</div><!-- end #signin-form -->
						
	
							</div>
		</div> 

	<div class="clearfix"></div>
	<div class="clearfix"></div>

  
					<div class="clearfix"></div>
				</div>
		 	
                              
                              </div>
                          <?php $this->endWidget(); ?>
                        </div>
                    
			 
			<div class="clearfix"></div>
			 
            <!-- Login -->		 
		</div>
					 
					 
				</div>
				</div>
				</div>

			 
			  
     	 
			<!-- Register -->
		 
           
            
           
         	</div>

			<!-- Register -->
		 
            </div>
         
  
        
          </div>
       
		

		</div>
		 
		
	 </div>

</div> 

		<script>
    var input = document.querySelector("#<?php echo $model->modelName;?>_phone_false");
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
    $(function(){
			onloadCallback()
			
			})
  </script>
