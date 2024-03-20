               <style>.myaccount-menu.is-ended{display:none; } .memberSecure.secure .main-panel{ margin-left:0px; }</style>
                <link rel="stylesheet" href="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/css/intlTelInput.css');?>">
                          <script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/intlTelInput.js');?>"></script>
                <?php $this->renderPartial('//detail/_success_html');?>
                <h4 class="subheading_font   bold-style">Change Contact Details</h4>
               <div id="topThirdPlacementLeadFormContainer" class="pan plm">
                
                  <div class="backgroundBasic    " id="topPanelLeadFormContainer">
                     <div data-reactroot="" class="pvn clearfix">
                        <div class="false" style="padding: 10px;">
							      
						   <?php // ajaxSubmitHappenlist2(form, data, hasError,"'.Yii::app()->createUrl('member/submitDetails').'");
						   $mainTex =  'Send' ; 
						    
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'frm_ctnt',
							//'action'=>Yii::app()->createUrl('member/validateChange'),
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,
							'beforeValidate' => 'js:function(form) {

							form.find("#bb3").html("'. 'Validating...' .'");
							return true;
							}',
							'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb3").html("'.$mainTex.'");
							return false;
							}
							else
							{
							form.find("#bb3").val("'. 'Please wait..' .'"); 
				           return true;
							  
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
							));
							?>
                            <style>
                            img.ag{max-width:110px!important;max-height:50px!important;margin-bottom:0;margin-left:auto;text-align:center;margin-right:auto;display:block}.ptn.man.kw-agent-info__agentItem___2iGT_.h7{font-weight:700;line-height:20px;display:flex}.ptn.man.kw-agent-info__agentItem___2iGT_.h7 span{margin-right:10px;font-weight:400;display:inline-block;max-width:90px;overflow:hidden;white-space:nowrap;min-width:90px;font-size:11px}
                            .ptn.man.kw-agent-info__agentItem___2iGT_.h7 { line-height:25px;}
                        html     .success-modal {
    margin: -15px;
    
}
                            </style>
                           
                           <div class="cols24">
                                  <div class="adDetailsinsideform" style="width:calc(100% - 100px);float:left;padding-right:10px;">
								       <div><span class="property-price new_sec"><span class="pri sec_1"><span class="codc"> <?php echo $userModel->fullName;?> </span>(<small><?php echo $userModel->TypeTile;?></small>)</span></span>  </div>
           <div><h2 class="residential-card__address-heading "><span class="details-link residential-card__details-link"><span class=""><?php echo $userModel->getAttributeLabel('phone');?> : <?php echo $userModel->phone;?>
           
           <?php
           	if($userModel->o_verified=='1'){
		      echo '<i class="fa fa-check text-green" style="color: var(--logo-color);"> Verified</i>'; 
	     }
           ?></span></span></h2></div>
 
                </div>
            <div class="imageDetailsinsideform" style="width:90px;float:right;height:70px;border:1px solid #eee;padding:5px;">
				<div style="background-position:center;background-size:cover;background-repeat:no-repeat;background-image:url('<?php echo $userModel->AvatarUrl;?>');width:100%;height:100%;"></div>
			</div>
			<div class="clearfix"></div>
           <hr>
								 </div>
								 <?php
							if(!Yii::app()->request->isPostRequest){
								$contact->contact_name = $this->mem->first_name; 
								$contact->phone = $this->mem->full_number; 
								$contact->whatsapp = $this->mem->whatsapp; 
							}
							?>
                           	<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><?php echo $form->labelEx($contact ,'contact_name');?></div>

							<div class="col-sm-7">

							<?php  	echo $form->textField($contact , 'contact_name' ,  $contact->getHtmlOptions('contact_name',array('class'=>'input-text form-control','placeholder'=>'' )));  ?>

							<?php echo $form->error($contact, 'contact_name');?>
		                    <?php 
		                     $contact->user_id =  $userModel->user_id; 
		                     echo $form->hiddenField($contact , 'user_id'  );  ?>

							<?php echo $form->error($contact, 'user_id');?>

							</div>

							</div>
		</div> 
      	<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><?php echo $form->labelEx($contact ,'phone');?></div>

							<div class="col-sm-7">

							<?php  	echo $form->textField($contact , 'phone' ,  $contact->getHtmlOptions('phone',array('class'=>'input-text form-control form_have_placeholder','placeholder'=>'' )));  ?>

							<?php echo $form->error($contact, 'phone');?>

							</div>

							</div>
		</div> 
		
	 		  	<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><?php echo $form->labelEx($contact ,'whatsapp');?></div>

							<div class="col-sm-7">

							<?php  	echo $form->textField($contact , 'whatsapp' ,  $contact->getHtmlOptions('whatsapp',array('class'=>'input-text form-control form_have_placeholder','placeholder'=>'', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  )));  ?>

							<?php echo $form->error($contact, 'whatsapp');?>
							<?php echo $form->error($contact, 'whatsapp_false');?>

							</div>

							</div>
		</div> 
		
		
		       <div id="msg_alert"></div>
  	<div class="clearfix"></div> 
				<div class="form-group  ">

						    <div class="row">
 
							<div class="col-sm-12">
	  
							<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">
		<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s" data-html="<?php echo $mainTex;?>"  data-auto-test-id="submitButton" id="bb3"style=" clear: both;"   /><?php echo $mainTex;?></button>

							</div>
		</div> 
							</div><!-- end #signin-form -->
						
	
							</div>
		</div> 

	<div class="clear"></div>
	<div class="clear"></div>

  
					<div class="clearfix"></div>
				</div>
		 
                           <?php $this->endWidget(); ?>
                        </div>
                     </div>
                  </div>
               </div><?php
               if(Yii::app()->request->urlReferrer){ ?> 
               <div class="lastrow"><span class="col-sm-12">Go  Back? <a href="<?php echo Yii::app()->request->urlReferrer;?>" class="link_color" style="font-weight:400">Click here</a></span><div class="clearfix"></div></div>
               <?php } ?> 
			   <div class="clearfx"></div>
       <script>
    var input = document.querySelector("#<?php echo $contact->modelName;?>_phone");
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
    var input2 = document.querySelector("#<?php echo $contact->modelName;?>_whatsapp");
    window.intlTelInput(input2, {
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
        hiddenInput: "whatsapp_false",
       initialCountry: "pk",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
        separateDialCode: true,
      utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
    });
  </script>  
 
<script>

function  ajaxSubmitHappenlist2(form, data, hasError,saveUrl)
{
if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":saveUrl,
                                    "data":form.serialize(),
                                    "success":function(data){
										var data = JSON.parse(data);
										if($("#requestBtn").length>0){  var hhtmk = $("#requestBtn").attr('data-html');  if(hhtmk !==undefined){  $("#requestBtn").attr('disabled',false); $("#requestBtn").html(hhtmk); } }
										if($("#bb2").length>0){  var hhtmk = $("#bb2").attr('data-html'); if(hhtmk !==undefined){  $("#bb2").attr('disabled',false); $("#bb2").html(hhtmk); } }
										 if(data.status=='1'){ 
										      $('#topThirdPlacementLeadFormContainer').hide();
											 $('.success-modal').addClass('visible');
											 		  Moveit.put(popGroup, {
          start: '0%',
          end: '0%',
          visibility: 0
        });
        Moveit.put(tick, {
          start: '0%',
          end: '0%',
          visibility: 0
        });
        Moveit.put(tick2, {
          start: '0%',
          end: '0%',
          visibility: 0
        });
        Moveit.put(circle, {
          start: '0%',
          end: '0%',
          visibility: 0
        });

        Moveit.animate(circle, {
            visibility: 1,
            start: '0%',
            end: '100%',
            duration: 1,
            delay: 0,
            timing: 'ease-out'
        })
        Moveit.animate(tick, {
            visibility: 1,
            start: '0%',
            end: '100%',
            duration: 0.2,
            delay: 0.5,
            timing: 'ease-out'
        })
        Moveit.animate(tick2, {
            visibility: 1,
            start: '0%',
            end: '80%',
            duration: 0.2,
            delay: 0.7,
            timing: 'ease-out'
        })
        Moveit.animate(popGroup, {
            visibility: 1,
            start: '20%',
            end: '60%',
            duration: 0.2,
            delay: 1.,
            timing: 'ease-in'
        }).animate(popGroup, {
            visibility: 1,
            start: '100%',
            end: '100%',
            duration: 0.2,
            delay: 1.2,
            timing: 'ease-in-out'
        });
										}
										else{
											$("#msg_alert").html(data.msg).show();
											setTimeout(function() {
											$("#msg_alert").hide()
											}, 7000);
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
