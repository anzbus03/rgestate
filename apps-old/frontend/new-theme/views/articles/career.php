<?php
 $banners = HomeBanner::model()->fetchBanners($this->default_country_id,$this->default_country_id,'CA');
  $img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
  $img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
  if(!empty($banners)){
   $img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/'.$banners[0]['image']): $img; 
   $img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/'.$banners[0]['mobile']): $img_mobile; 
  }
  ?>
<div style="position:relative;overflow-x:hidden;max-width: 100% !important;">
<style>
	/*@import url('https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900');
@import url('https://fonts.googleapis.com/css?family=Merienda:400,700');
@import url('https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700');*/
	
	@import url('https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700');
	.box-inner h1 {
		color: #fff;
		text-align: center;
		padding: 0;
		margin: 0;
	}
	
	.banner {
		height: 36.45vw;
	}
	body#articles p, html .stagc-loc-txt-span2 li{text-align:initial!important;}
	.banner {
		position: relative;
		height: 20.56vw;
		box-shadow: inset 0 200px 200px -200px #000, inset 0 -400px 400px -400px #000;
		background-position: center center !important;
	}
	
	.banner::before {
		content: '';
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		z-index: 1;
 
		position: absolute;
	}
	
	section.content {
		z-index: 3;
		position: relative;
	}
	
	.panel-white:first-child {
		padding-bottom: 0;
	}
	
	.panel-white {
		padding: 4.68vw 0;
		padding-bottom: 4.68vw;
	}
	
	.container {
		width: 1170px;
		padding: 0 .78vw;
		position: relative;
		margin: 0 auto;
	}
	
 

	.box-inner {
		width: 50.96vw;
		margin: 0 auto 0px;
		margin-top: 0px;
		padding: 4.68vw 3.12vw 3.12vw;
		border: 13px solid rgba(238,238,238, 0.5);
		position: relative;
		z-index: 1;
		margin-top: -20vw;
	}
	
	.text-center {
		text-align: center;
	}
	
	.box-inner h1 {
		color: var(--black-color);
		text-align: center;
		padding: 0;
		margin: 0;font-size: 34px;
	}
	
	h1 {
		font-size: 2.5em;
		line-height: 1.2em;
	}
	
	.box-inner h1::after {
		height: 7.44vw;
		position: relative;
		display: block;
		width: 1px;
		margin: 1.71vw auto;
		background: transparent;
	}
	
	h1::after {
		background: #feca3d none repeat scroll 0 0;
		bottom: 0;
		content: "";
		display: block;
		height: 1px;
		left: 0;
		position: absolute;
		width: 7.604vw;
	}
	
	.box-inner h1::after {
		height: 7.44vw;
		position: relative;
		display: block;
		width: 1px;
		margin: 1.71vw auto;
		background: transparent;
	}
	
	h3 {
		font-size: 1.88em;
		line-height: 1.2em;
		margin-bottom: 1.04vw;
		color: #262626;
	}
	
	.navigate_link {
		display: none !important;
	}
	.panel {
    /*height: 100vh;*/
    width: 100%;
    border: 0;
    margin: 0;
    box-shadow: none;
    border-radius: 0;
}

	
	.panel-bg {
    background-repeat: no-repeat;
    background-position: top center;
    background-size: cover;
}
	@media (max-width:1280px) {
		.box-inner {
		
		margin-top: -25%;
	}
		
		
	}
		@media(max-width:600px) {
	   html .banner {
   
}
	
		}
	@media(max-width:991px) {
	   
		.box-inner {
    margin: -159px auto 30px;width: 100%;
}
		.banner {
    height: 300px;
}
		.box-inner h1 {
    font-size: 22px;
margin-bottom: 50px;
}
		.container {
    width: 100%;
    padding: 0 15px;
   
}
	}
	textarea {
 
    border-color: #ddd;
    appearance: none;
    border-radius: 16px;
    border-style: solid;
    border-width: 2px;
}
	@media (max-width:600px) {
	    .box-inner {
  margin: 0px 0px 30px 0px;
    width: 100%;
}.banner {
    height: 118px;
}
.panel-white .container { margin-left:0px;margin-right:0px; padding-left:0px;padding-right:0px;}
.box-inner h1 {
    font-size: 18px;
    margin-bottom: 20px;
    line-height: 1.5;
}
	}
	#pageContainer {
    
    padding: 0px !important;
}
.abs-banner{
   
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    color: #fff;
    z-index: 1;
    content: '';
 
} .fancy-title {
   
    color: #fff;
}
	  </style>
	     <style>
     .ja_title > div
{
    position:absolute;background:#fff;
}.fancy-title .title {
    font-size: 50px; 
}
.bloghead {
    align-items: center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
    font-weight: 300;
    display: flex;
    z-index: 1;
    position: relative;
}
.crumbarHeadingCms { display:none; }
 
</style>

<section class="panel panel-bg banner"  style="background-image:url(<?php echo $img;?>);">
    
        <div class="abs-banner"> 
        <div class="bloghead container"> 
        <div class="fancy-title-hold text-initial clearfix">
        <h3 class="fancy-title animate animated  padding-bottom-0 padding-right-0"><span class="title"><?php echo Yii::t('app',$this->tag->getTag('careers_at_{n}','Careers at {n}'),array('{n}'=>$this->project_name));?></span></h3>
        </div> 
        </div> 
        </div>
    
    
    
</section>
<section class="content">
	<div class="panel-white">
		<div class="container">
			<div class="box-inner234   animate begin-animate">
			    <div class="row">
			        <div class="col-sm-6">
			    <?php 
			    echo Yii::t('app',$article->content,array('{lnk}'=>'<a href="'.$this->options->get('system.common.contact_email').'">'.$this->options->get('system.common.contact_email').'</a>'));?>
			   </div>
			        <div class="col-sm-6">
			   <div class="clearfix"></div>
			   <?php $model =new CareerNew();?>
			      <div class="false"  >
						 <style>
   .modal-body {
   
    overflow-x: hidden;
}
.main_gh { display:none; }
.about_rp_outwer a:hover{ text-decoration:underline; }
.stagc-loc-txt-span2 h1{
    font-size:2.5em;
}#ListingUsers_password input, #signUpForm .form-control.LJB, #signin-form input.form-control.LJB, #signin-form select.form-control.LJB,.form-control, .gfield .medium, .ginput_container_address input {
    border-color: #fff; 
    background: #f4f4f4;border-radius: 0px !important;
}.form-group {
    margin-bottom: 15px;
}#file_image .btn.btn-info {
 
    height: auto !important;
}
.fa-camera:before {
    content: "\f1c1";
}
</style>

<div class="success-modal" style="    margin: auto;" >
        <div class="anim" style="background:#fff;height:auto; margin:60px 0px 25px;display: block;;">
            <div class="contaiwerwner22" >
           <img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDE1Ljg2OSA0MTUuODY5IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0MTUuODY5IDQxNS44Njk7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMzRBODUzIiBkPSJNMTI1LjkxLDE3MC44NDFjLTUuNzQ3LTYuMjY5LTE1LjY3My02Ljc5Mi0yMS45NDMtMS4wNDVjLTYuMjY5LDUuNzQ3LTYuNzkyLDE1LjY3My0xLjA0NSwyMS45NDMgICBsNzguODksODUuNjgyYzMuMTM1LDMuMTM1LDYuNzkyLDUuMjI0LDEwLjk3MSw1LjIyNGMwLDAsMCwwLDAuNTIyLDBjNC4xOCwwLDguMzU5LTEuNTY3LDEwLjk3MS00LjcwMkw0MDMuODUzLDc4Ljg5ICAgYzYuMjY5LTYuMjY5LDYuMjY5LTE2LjE5NiwwLTIxLjk0M2MtNi4yNjktNi4yNjktMTYuMTk2LTYuMjY5LTIxLjk0MywwTDE5My44MjksMjQ0LjUwNkwxMjUuOTEsMTcwLjg0MXoiIGRhdGEtb3JpZ2luYWw9IiM0RENGRTAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiM0RENGRTAiPjwvcGF0aD4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzNEE4NTMiIGQ9Ik00MDAuMTk2LDE5Mi4yNjFjLTguODgyLDAtMTUuNjczLDYuNzkyLTE1LjY3MywxNS42NzNjMCw5Ny4xNzUtNzkuNDEyLDE3Ni41ODgtMTc2LjU4OCwxNzYuNTg4ICAgUzMxLjM0NywzMDUuMTEsMzEuMzQ3LDIwNy45MzVTMTEwLjc1OSwzMS4zNDcsMjA3LjkzNSwzMS4zNDdjOC44ODIsMCwxNS42NzMtNi43OTIsMTUuNjczLTE1LjY3M1MyMTYuODE2LDAsMjA3LjkzNSwwICAgQzkzLjUxOCwwLDAsOTMuNTE4LDAsMjA3LjkzNXM5My41MTgsMjA3LjkzNSwyMDcuOTM1LDIwNy45MzVzMjA3LjkzNS05My41MTgsMjA3LjkzNS0yMDcuOTM1ICAgQzQxNS44NjksMTk5LjA1Myw0MDkuMDc4LDE5Mi4yNjEsNDAwLjE5NiwxOTIuMjYxeiIgZGF0YS1vcmlnaW5hbD0iIzREQ0ZFMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iIzREQ0ZFMCI+PC9wYXRoPgo8L2c+PC9nPiA8L3N2Zz4=" style="width: 50px;">
             <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="info">
            <div class="title"><?php echo Yii::t('app',$this->tag->getTag('your_resume_has_been_submitted','Your resume has been submitted successfully to HR {p}.We will contact you as per current opening.') ,array('{p}'=>$this->project_name)) ;?></div>
            <div class="text"><?php echo  $this->tag->getTag('thank_you','Thank you') ;?></div>
             <div class="text"><b><?php echo   Yii::t('app',$this->tag->getTag('hr_project','HR {p}') ,array('{p}'=>$this->project_name));?></b></div>
         </div> </div>   
						   <?php
						   	$mainTex = $this->tag->getTag('send','Send');
	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..'); 
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'signin-form',
							'action'=>Yii::app()->createUrl('articles/validatefrm'),
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {

							form.find("#bb2").html("'.$Validating .'");
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
				                	ajaxSubmitHappenlistmort(form, data, hasError,"'.Yii::app()->createUrl('articles/send_career').'"); 
							 
						
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
													<h3 class="margin-top-0" ><?php echo  $this->tag->getTag('send_your_cv','Send Your CV');?> </h3>
													<div class="clearfix"></div>
												 	
													
													
													
                                        	<div class="form-group  ">

						    <div class="row  ">

						 
							<div class="col-sm-6">

							<?php  	echo $form->textField($model , 'name' ,   array('class'=>'input-text form-control LJB','placeholder'=>$this->tag->getTag('full_name_*','Full Name *') ) );  ?>

							<?php echo $form->error($model, 'name');?>
						 

							</div>
						<div class="col-sm-6">

							<?php  	echo $form->textField($model , 'email' ,  array('class'=>'input-text form-control LJB','placeholder'=>$this->tag->getTag('email_*','Email *')) );  ?>

							<?php echo $form->error($model, 'email');?>
						 

							</div>

							</div>
		</div> 
                                        <div class="clearfix"></div>
                                      
                                        	<div class="clearfix"></div>
		<div class="form-group  ">

						    <div class="row  ">


							<div class="col-sm-12">
<style>.iti.iti--allow-dropdown input { margin-right:0px !important; }.iti{ width:100%; }</style>
							<?php  	echo $form->textField($model , 'phone_false' ,    array('class'=>'input-text form-control LJB','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  )) ;  ?>

							<?php echo $form->error($model, 'phone_false');?>
							

							</div>

							</div>
		</div>
		 <div class="clearfix"></div>
		         	<div class="form-group  ">

						    <div class="row  ">

						 
							<div class="col-sm-12">

							<?php  	echo $form->textArea($model , 'cover_letter' ,  array('class'=>'input-text form-control LJB','placeholder'=>$this->tag->getTag('cover_*','Cover Letter *')) );  ?>

							<?php echo $form->error($model, 'cover_letter');?>
						 

							</div>

							</div>
		</div> 
                                
		<div class="row margin-bottom-15">
                          
                            <?php 
                            $user = $model; 
										$fileField = 'image';
										$title_text =   $this->tag->getTag('upload','Upload CV') ;
										$types = '.pdf,.doc,.docx';
										$maxFiles = '1';
										?>
							<div class="col-sm-12 mrb-10"  > 
							<div class="clearfix"></div>
						 
							</div>
		
							<div class="col-sm-12 nolabel insidel">

							   <?php
							  $this->renderPartial('root.apps.frontend.new-theme.views.articles._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','user','title_text','model'));
							 
							  ?>

							</div>
							<div class="col-sm-12">
							    
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1;  display:inline;"><?php echo $this->tag->getTag('allowed','Allowed');?>: <b><?php echo $types;?></b></div>
						 
							    
							</div>

							</div> 
		                   <div class="clearfix"></div>
		                   <div style="clear:both;"></div>
            
                       
		                 <div class="clearfix"></div>
								 
                              <div class="cols24">
                             
                                
								 	 <div id="msg_alert"></div>
								 	 
								 	 
								 	 
								 	  <div class="clearfix"></div>
  	 	 
								 	 	<div class="clearfix"></div>
								 	 		<div class="form-group234  spl-12 agr"  >

			 		</div>
					
					<div class="clearfix"></div>
					 <div class="clearfix"></div>
 	<div class="pop_boxone">
						<?php
						$min_error_count  = 1 ; 
					  
									$min_error_count  = 2 ; 
									?> 
									<div class="form-group234">
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
		 
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n"  id="bb2" style=" clear: both;max-width:90%;margin:auto;height: 44px !important;min-width: 200px !important;width: auto;" data-html="<?php echo $mainTex;?>"><?php echo $mainTex;?></button>
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
			   
				<span id="tve_leads_end_content" style="display: block; visibility: hidden; border: 1px solid transparent;"></span>
			</div>

		</div>
	</div>







</section>
	<script>
			$(function(){
    var input = document.querySelector("#CareerNew_phone_false");
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
</div>
<script>
    function  ajaxSubmitHappenlistmort(form, data, hasError,saveUrl)
{
if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":saveUrl,
                                    "data":form.serialize(),
                                    "success":function(data){
										var data = JSON.parse(data);
									 	 if(data.status=='1'){ 
										    
                                                $(".success-modal").addClass("visible");
                                                $("#signin-form").remove();
										}
										else{
										    errorAlert('Error',data.msg); 
										}
										 
                                     },

                                  });
     }
      else
    { 
       alert('error');
     }
 }
</script>