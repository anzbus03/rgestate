                <?php $this->renderPartial('//forms/_success_html_insurance_ask');?>
                
                <style>
             #cn_property{padding:0!important;overflow:hidden}html input.input-text.form-control,html select.input-text.form-control,input.pwdfield{border:1px solid #dfe0e3;border-radius:3px;color:#72727d;font:13px arial;height:24px;padding:1px 0;width:100%;margin-right:0px}html textarea.input-text.form-control{border:1px solid #dfe0e3;line-height:1.4;padding:10px 8px;color:#72727d;font:13px arial}.sign-in-form label{margin-bottom:0}.sign-in-form .btn.btn-primary{background-color:var(--logo-color);box-shadow:unset;border:0;font-family:Lato,Helvetica,Arial,sans-serif;font-size:14px;color:#fff;line-height:40px;border-radius:5px}.btn-sm-s{max-width:100%!important;line-height:35px!important;padding:0}.col-sm-5 label{color:#72727d!important;line-height:1;text-align:right}html .container_check input:checked~.checkmark{background-color:#90ee90;border:1px solid transparent}.container_check input:checked~.checkmark{background-color:#dc143c;border:1px solid transparent}.container_check .checkmark{position:absolute;top:0;left:0;height:20px;width:20px;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;border-radius:3px;-moz-transition:all .3s ease-in-out;-o-transition:all .3s ease-in-out;-webkit-transition:all .3s ease-in-out;-ms-transition:all .3s ease-in-out;transition:all .3s ease-in-out}.container_check input:checked~.checkmark::after{display:block}.container_check .checkmark::after{content:"";position:absolute;display:none;left:7px;top:3px;width:5px;height:10px;border:solid #fff;border-top-width:medium;border-right-width:medium;border-bottom-width:medium;border-left-width:medium;border-top-width:medium;border-right-width:medium;border-bottom-width:medium;border-left-width:medium;border-width:0 2px 2px 0;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}#frm_ctnt .errorMessage{font-size:12px;color:#e13009!important;padding:2px 0 0;top:unset!important}.grecaptcha-badge{z-index:999911119999!important}
                .success-modal .info .title {
    font-weight: var(--weight-800);
    margin: 0;
    line-height: 1.42857143;
    color: #333;
    font-weight: 600 !important;
    font-size: 18px;
} .form-control.LJB {
    border-color: #ddd;
    appearance: none;
    border-radius: 16px;
    border-style: solid;
    border-width: 2px;
    line-height: 36px;
    min-height: 48px;
    width: 100%;
    text-indent: 18px;
    font-size: 16px !important;
}
html textarea.input-text.form-control {
border-color: #ddd;
appearance: none;
border-radius: 16px;
border-style: solid;
border-width: 2px;
line-height: 36px;
min-height: 48px;
width: 100%;
text-indent: 18px;
font-size: 16px !important;
}.radio-toolbar input[type="radio"] {
  display: none;
}

.radio-toolbar label {
  display: inline-block;
  background-color: #fff;
  border:1px solid #7f7f7f;
  border-radius:5px; 
  padding:  5px 15px;
   
  font-size: 16px;
  cursor: pointer;
  color: var(--black-color);
  height: 60px;
display: flex;
justify-content: flex-start;
align-items: center;
background-color: #fff;
color: #7f7f7f;
font-size: 14px;
cursor: pointer;
line-height: 1.43;
transition: all .3s ease-in-out;
margin-bottom:10px !important;
width:calc(50% - 20px);
box-shadow: 0 1px 3px 0 rgba(0,0,0,.06);border: 1px solid #dfe0e3;
}.radio-toolbar.smalln label { width:width:calc(33.3333%- 30px);; text-align:center; } 
.radio-toolbar label svg { width:42px;  height:42px; margin-right:5px;}
.radio-toolbar input[type="radio"]:checked+label {
  background-color:var(--secondary-color); color:#fff; 
}
.radio-toolbar label {
    
    float: left;
    margin-right: 10px;
    line-height:1.5;
}
.tabset > input:checked + label{ background-color:var(--secondary-color) !important;color:#fff !important;  }
.tabset > input:checked + label a{  color:#fff !important;  }
.tab-panel {
    
    border-top: 1px solid var(--secondary-color);
}
                </style>
                 <script>
                     function ajaxSubmitHappenlistn(e,t,i,a){i?alert("error"):$.ajax({type:"POST",url:a,data:e.serialize(),success:function(e){var t;e=JSON.parse(e);$("#requestBtn").length>0&&(void 0!==(t=$("#requestBtn").attr("data-html"))&&($("#requestBtn").attr("disabled",!1),$("#requestBtn").html(t)));$("#bb2").length>0&&(void 0!==(t=$("#bb2").attr("data-html"))&&($("#bb2").attr("disabled",!1),$("#bb2").html(t)));"1"==e.status?($("#topThirdPlacementLeadFormContainer").hide(),	 $("html, body").animate({    scrollTop: $("#WERWER").offset().top}, 1000), $(".rms-data-h").addClass("hide"),$(".success-modal").addClass("visible"),Moveit.put(popGroup,{start:"0%",end:"0%",visibility:0}),Moveit.put(tick,{start:"0%",end:"0%",visibility:0}),Moveit.put(tick2,{start:"0%",end:"0%",visibility:0}),Moveit.put(circle,{start:"0%",end:"0%",visibility:0}),Moveit.animate(circle,{visibility:1,start:"0%",end:"100%",duration:1,delay:0,timing:"ease-out"}),Moveit.animate(tick,{visibility:1,start:"0%",end:"100%",duration:.2,delay:.5,timing:"ease-out"}),Moveit.animate(tick2,{visibility:1,start:"0%",end:"80%",duration:.2,delay:.7,timing:"ease-out"}),Moveit.animate(popGroup,{visibility:1,start:"20%",end:"60%",duration:.2,delay:1,timing:"ease-in"}).animate(popGroup,{visibility:1,start:"100%",end:"100%",duration:.2,delay:1.2,timing:"ease-in-out"})):($("#msg_alert").html(e.msg).show(),setTimeout(function(){$("#msg_alert").hide()},7e3))}})}
                     
                 </script>
               <div id="topThirdPlacementLeadFormContainer" class="pan plm rms-data-h">
               <div class="backgroundBasic sign-in-form   " id="topPanelLeadFormContainer">
                     <div data-reactroot="" class="pvn clearfix">
                        <div class="false"  >
							      
						   <?php
						   $mainTex =  $this->tag->getTag('get_a_quote','GET A QUOTE') ; 
							$Validating = $this->tag->getTag('validating','Validating..');
							$please_wait = $this->tag->getTag('please_wait','Please wait..');  
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'signin-form',
							'action'=>Yii::app()->createUrl('forms/ValidateInsurance_ask'),
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
							form.find("#bb2").val("'.$please_wait .'"); 
				
							ajaxSubmitHappenlistn(form, data, hasError,"'.Yii::app()->createUrl('forms/SendInsurance_ask').'"); 
						
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
													<div class="form-group  ">
													<div class="row">
													<div class="col-sm-12">
													<?php  	
													 
													echo $form->dropDownList($model , 'bank_id' , CHtml::listData($HomeInsuraceCompany,'bank_id','bank_name'),  $model->getHtmlOptions('bank_id',array('class'=>'input-text form-control LJB margin-bottom-0','empty' =>$this->tag->getTag('please_select_company','Please Select Company'),'style' =>'text-indent: 7px;' )));  ?>
													<?php echo $form->hiddenField($model, 'property_id');?>
													<?php echo $form->error($model, 'bank_id');?>
													<?php echo $form->error($model, 'property_id');?>
													</div>
													</div>
													</div> 

													<div class="clearfix"></div>
													<script>
													function setCheckox(id,k){
														$('#<?php echo $model->modelName;?>_'+id).val($(k).val());
													}
													</script>
													 

													<div class="clearfix"></div>
													<h2 class="margin-top-0"><?php echo $this->tag->getTag('about_yourself','About Yourself');?></h2>
													<div class="clearfix"></div>
												 	
													
													
													
                                        	<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  	echo $form->textField($model , 'f_name' ,  $model->getHtmlOptions('first_name',array('class'=>'input-text form-control LJB','placeholder'=>$this->tag->getTag('full_name_*','Full Name *'))));  ?>

							<?php echo $form->error($model, 'f_name');?>
						 

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                        	<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  	echo $form->textField($model , 'email' ,  $model->getHtmlOptions('email',array('class'=>'input-text form-control LJB','placeholder'=>$this->tag->getTag('email_*','Email *'))));  ?>

							<?php echo $form->error($model, 'email');?>
						 

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                        
                                        	<div class="clearfix"></div>
		<div class="form-group  ">

						    <div class="row">


							<div class="col-sm-12">
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
						<label class="container_check" for="<?php echo $model->modelName;?>_agree"> <?php echo Yii::t('app',$this->tag->getTag('agree_to_the_{link1}_and_the_{','Agree to the {link1} and the {link2}'),array('{link1}'=>'<a href="'.Yii::app()->createUrl('terms').'" target="_blank" class="link_color">  '.$this->tag->getTag('terms_and_conditions','Terms and Conditions').'</a>','{link2}'=>'<a href="'.Yii::app()->createUrl('privacy').'" target="_blank" class="link_color"> '.$this->tag->getTag('privacy_policy','Privacy Policy').'</a>'));?>
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
		 
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n"  id="bb2" style=" clear: both;max-width:90%;margin:auto;" data-html="<?php echo $mainTex;?>"><?php echo $mainTex;?></button>
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
                     </div>
                  </div>
               </div>
			   <div class="clearfx"></div>
         
 <div style="clear:both"></div>
 
	
 
		<script>
			$(function(){
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
    	})
    $(function(){
			onloadCallback()
			
			})
  </script>
   <style>
     .pwdopsdiv { display:none ; } .pwdstrengthstr , .pwdstrength { height:auto; }
       
   </style>
	 

