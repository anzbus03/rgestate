<!doctype html>
<html  lang="<?php echo $this->language;?>" dir="<?php echo $this->direction;?>" class="absolutehtml <?php echo $this->secure_header == '1' ? 'secure' : '';?> <?php echo defined('HIDEATIPHONE') ? 'hidemenuiphone' : '';?>  <?php echo defined('APLEDEVICE') ? 'appled' : '';?>">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php 
    $meta_description = !empty($pageMetaDescription) ? Yii::t('app',$pageMetaDescription,array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name)) :  Yii::t('app',$this->generateCommon('home_meta_description'),array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name));
    $meta_keyword = !empty($meta_keyword) ? Yii::t('app',$meta_keyword) : Yii::t('app',$this->generateCommon('home_meta_keywords'),array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name)); 
    $en = Yii::t('app',CURRENT_URL,array('rgestate.com/ar/'=>'rgestate.com/')); 
    ?>
    <link rel="alternate" hreflang="en-AE" href="<?php echo $en;?>" />
    <link rel="alternate" hreflang="en-gb" href="<?php echo $en;?>" />
    <link rel="alternate" hreflang="en-us" href="<?php echo $en;?>" />
    <link rel="alternate" hreflang="ar" href="<?php echo Yii::t('app',CURRENT_URL,array('rgestate.com/ar/'=>'rgestate.com/ar/','rgestate.com/'=>'rgestate.com/ar/'));?>" />
    <link rel="canonical" href="<?php echo CURRENT_URL;?>" />
    <link rel="icon" href="<?php echo  $this->app->apps->getBaseUrl('new_assets/images/favicon.png');?>" type="image/png" sizes="32x32">
    <title><?php  echo  $pageTitle ;  ?></title>
    <meta name = "viewport" content = "user-scalable=no, width=device-width">
    <meta name="title" content="<?php echo $pageTitle; ?>" />
    <meta name="description" content="<?php echo $meta_description; ?>" />
    <meta name="keywords" content="<?php echo $meta_keyword;?>" /> 
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php  echo  $pageTitle ;  ?>" />
    <meta property="og:description" content="<?php echo $meta_description;?>" />
    <meta property="og:url" content="<?php echo CURRENT_URL;?>" />
    <meta property="og:site_name" content="<?php echo $this->project_name;?>"/>
    <meta property="og:email" content="sales@rgestate.com"/>
    <meta property="og:phone_number" content="+971552792403"/>
    <meta property="og:site_name" content="RGEstate.Com By Riveria Global Group" />
    <meta property="article:publisher" content="https://www.facebook.com/RGEstateUAE"/>
    <meta property="article:modified_time" content="2022-03-28T19:39:09+00:00" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@RGEstateUAE" />
    <meta name="twitter:label1" content="Est. reading time" />
    <meta name="twitter:data1" content="4 minutes" />
    <meta name="Revisit-After" content="1 Days" />
    <meta name="Language" content="<?php echo $this->language=='ar' ? 'Arabic':'English';?>" />
    <meta name="distribution" content="Global" />
    <meta name="geo.region" content="AE-DU" />
    <meta name="geo.placename" content="Dubai" />
    <meta name="geo.position" content="25.192529490878545, 55.26743257129561" />
    <meta name="allow-search" content="yes" />
    <meta name="expires" content="never" />
    <meta name="YahooSeeker" content="INDEX, FOLLOW" />
    <meta name="msnbot" content="INDEX, FOLLOW" />
    <meta name="googlebot" content="index,follow" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta http-equiv="Content-Language" content="<?php echo $this->language;?>" />
    <?php 
    if($this->id=='detail' and in_array($this->action->id,array('index','project'))){
    ?>
    <meta property="fb:app_id" content="<?php echo $this->options->get('system.common.facebook_app_id');?>">
    <meta property="og:site_name" content="<?php echo $this->options->get('system.common.site_name');?>">
    <meta property="og:title" content="<?php echo $title;?>">
    <meta property="og:description" content="<?php echo $description;?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo  $shareUrl;?>">
    <meta property="og:image" content="<?php echo $image;?>">
    <meta property="og:image:width" content="">
    <meta property="og:image:height" content="">
    <meta property="og:locale" content="en_US">
    <meta name="twitter:widgets:csp" content="on">
    <meta name="twitter:card" content="photo">
    <meta name="twitter:url" content="<?php echo  $shareUrl;?>">
    <meta name="twitter:image" content="<?php echo $image;?>">
    <meta name="twitter:title" content="<?php echo $title;?>">
    <meta name="twitter:description" content="<?php echo $description;?>">
    <meta name="twitter:site" content="<?php echo $this->options->get('system.common.site_name');?>">
    <?php
    }
    $prefx = $this->language=='ar'?'ar/':''; 
    ?>  
  
    <script>
    var baseid = '<?php echo ASKAAN_PATH_BASE;?>';var baseid2 = '<?php echo ASKAAN_PATH_BASE.$prefx;?>';$(function(){iniFrame()}); 
    var CALLING_title =  '<?php echo Yii::t('app',$this->tag->getTag('please_quote_property_referenc','Please quote property reference{}when calling us'),array('{}'=>'<div dir="ltr" class="phone-div-tedifgar">[REFERENCENUMBER]</div>'));?>';
    var Phone_title 	= '<?php echo $this->tag->getTag('phone','Phone');?>';
    var Agent_title 	= '<?php echo $this->tag->getTag('agent2','Agent');?>';
    var Close_title 	= '<?php echo $this->tag->getTag('close','Close');?>';
    var call_statistics = '<?php echo $this->app->createUrl('articles/statistics/case/C');?>/';
    var Contact_title 	= '<?php echo $this->tag->getTag('contact_us','Contact Us');?>';
    
    </script>
  <style>
    /* .b24-widget-button-wrapper{
      display: none !important;
    } */
  </style>
    <?php
    if(!empty($schema)){ echo $schema; } ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DMQGQPSMZC"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-DMQGQPSMZC');
    </script>
<?php   $this->renderPartial('//layouts/_seo_scripts'); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <?php echo LANGUAGE == 'ar' ? '<script>var isRtl = true;</script>' : '<script>var isRtl = false;</script>' ; ?>
    <style>.closepopu {display:none; } .isOnFram  .closepopu {display:block; }.for-mobile { display: none;}</style>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Style -->
    <link href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/lib/slick/slick.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/js/build/css/intlTelInput.min.css" />
    <link href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/css/style.css" rel="stylesheet">
    <style>
        .select2-container{
            z-index:9999;
        }
        #popup-phone{
            padding-left:88px !important;
        }
        #signUpForm .iti--separate-dial-code .iti__selected-flag,
        #signUpForm2 .iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag, 
        #signUpForm2 .iti--separate-dial-code .iti__selected-flag,
        #signUpForm2 .iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag{
            background-color:#fff !important;
        }
        
        .close-btn {
            display: flex;
            margin-left: auto;
            margin-right: 10px;
        }
        .close-btn span {
            font-size: 35px;
            color: red;
        }
    </style>
</head>

<body>
     <!--Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q8V4GM"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
     <!--End Google Tag Manager (noscript) -->


    <?php $this->renderPartial('//layouts/header' ); ?>

    <?php echo $content; ?>

    <?php $this->renderPartial('//common/_subscribe' ); ?>
    
    <?php $this->renderPartial('//layouts/footer' ); ?>
   
    <!-- jQuery -->
    <script src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/js/jquery-3.7.0.min.js"></script>
     <script>
    
    // const input = document.querySelector("#telephone");
    //   window.intlTelInput(input, {
    //     initialCountry: "ae",
    //     separateDialCode: true,
    //     utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
    //   });
    
	user_login_url = '<?php echo Yii::app()->createUrl('user/load_signin_form');?>';
	add_to_fav = '<?php echo Yii::app()->createUrl('user/add_to_fav');?>';
	var get_property='<?php echo Yii::app()->createUrl('site/get_property');?>';
   
	var stopPaginationFav;
	var loadingHtmlFav    	= '<div style="position:relative;"><div class="loading "><div class="spinner rmsdf"><div class="bounce1"></div>  <div class="bounce2"></div>  <div class="bounce3"></div></div></div></div>';
	var	loadMoreHtmlFav 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right"   onclick="checkScrollFav();"  ><?php echo  $this->tag->getTag('load_more','Load More') ;?></a>';  
	var afterFinishHtmlFav = '';   
	var scrollFav=true;
	var limitFav='20';
	var offsetFav ='0';
	var stopPaginationFav;
	var checkFutureFav = true ;
	var loadingDivFav ;
	$(document).ready(function () {
	loadingDivFav  =  $('#lodivScro');
	});
	var currentPageFav = 1;
	var slugFav ='<?php echo Yii::app()->createUrl('listing/fav_properties');?>';
	var deleteFav ='<?php echo Yii::app()->createUrl('user/remove_properties');?>';
    var CALLING_title =   '<?php echo Yii::t('app','<p class="rg-fs-14 rg-text-blue text-center mt-4">Please quote property reference</p>{}<p class="rg-fs-14 rg-text-blue text-center mt-4">when calling us</p>',array('{}'=>'<h2 class="rg-fs-30 rg-fw-600 rg-text-blue text-center mt-4">[REFERENCENUMBER]</h2>'));?>';
    var Phone_title 	=   'Phone' ;
    var Agent_title 	=  'Agent' ;
    var Close_title 	=  'Close' ;
    var call_statistics = '<?php echo Yii::app()->createUrl('articles/statistics/case/C');?>/';
    var Contact_title 	=  'Contact Us';
    var propertyUrl     = '<?php echo Yii::app()->createUrl('detail/contact_property');?>';
    
</script>
    <script src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/lib/select2/js/select2.full.min.js"></script>
    <script src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/lib/slick/slick.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>

    <script type="text/javascript" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/js/build/js/intlTelInput.min.js"></script>
    <script src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/js/app.js"></script>
    <script src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/js/home.js"></script>
<!-- Contact Modal -->
<div class="modal fade rg-modal-350 rg-blue-modal" id="contactUsModal" tabindex="-1" aria-labelledby="contactUsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header rg-bg-blue text-white">
                <h2 class="modal-title rg-fs-20" id="contactUsLabel">Contact Us</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5" id="phone-modal">
               
            </div>
        </div>
    </div>
</div>

<!-- Email Modal -->
<div class="modal fade rg-modal-540 rg-blue-modal" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header rg-bg-blue text-white">
                <h2 class="modal-title rg-fs-20" id="emailModalLabel">Contact For more information</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="email-model"></div>
        </div>
    </div>
</div>

 <div class="modal fade rg-register-intrest-modal modal-new" id="popupmodal" tabindex="-1" role="dialog" aria-labelledby="popupmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content position-relative rounded-0">
        <button type="button" class="btn-close rg-close-btn" id="closepopup" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body p-0">
          <div class="rg-register-intrest-meta">
            <div class="row m-0">
              <div class="col-md-6 col-12 p-0">
                <img class="rg-modal-img d-block w-100 object-fit-cover" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/subscribe-modal.jpg" alt="Register Your Invest">
              </div>
              <div class="col-md-6 col-12 p-0">

                <div class="rg-modal-content p-5">
                  <div id="contact-message"></div>
                  <h2 class="modal-title rg-fs-20 rg-text-dark text-uppercase" id="popupmodalLabel">Register Your Interest</h2>
                  <?php
                  $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'signUpForm3',
                    'htmlOptions' => array(
                      'class' => 'rg-modal-form rg-form mt-4 rg-custom-form',
                    ),

                    'action' => Yii::app()->createUrl('site/contact_popup'),
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                      'validateOnSubmit' => true,
                      'validateOnChange' => false,
                      'beforeValidate' => 'js:function(form) {
        				     
        						form.find("#bb3").val("Validating");
        						return true;
        					}',
                      'afterValidate' => 'js:function(form, data, hasError) { 
        							if(hasError) {
        							form.find("#bb3").val("SEND INQUIRY");
        							 
        							return false;
        							}
        							else
        							{
        							form.find("#bb3").val("Please Wait"); 
        				
        							ajaxSubmitHappenlistmort_popup(form, data, hasError,"' . Yii::app()->createUrl($this->id . '/send') . '"); 
        							}
        							}',
                    ),
                  ));
                  ?>

                  <div class="form-group mb-4">
                    <?php echo $form->textField($model, 'name', $model->getHtmlOptions('name', array('class' => 'form-control form-control-lg', 'placeholder' => $this->tag->getTag('full_name_*', 'Full Name *')))); ?>
                    <?php echo $form->error($model, 'name'); ?>

                  </div>
                  <div class="form-group mb-4">
                    <?php echo $form->textField($model, 'email', $model->getHtmlOptions('email', array('class' => 'form-control form-control-lg', 'placeholder' => $this->tag->getTag('email_*', 'Email *')))); ?>
                    <?php echo $form->error($model, 'email'); ?>
                  </div>
                  <div class="form-group mb-4">
                    <?php echo $form->textField($model, 'phone_false', $model->getHtmlOptions('phone_false', array('id' => 'popup-phone', 'class' => 'form-control form-control-lg', 'placeholder' => $this->tag->getTag('contact_number_*', 'Contact Number *')))); ?>
                    <?php echo $form->error($model, 'phone_false'); ?>
                  </div>
                  <div class="form-group rg-filter-col rg-project-dropdown rg-custom-select mb-4">
                    <!--<select class="form-select form-control" id="rg-project-dropdown" name="ContactPopup[projects]">-->
                    <!--<option></option>-->
                    <?php echo $form->dropDownList($model, 'type', $model->Model_type()); ?>
                    <?php echo $form->error($model, 'type'); ?>
                    <!--</select>-->
                  </div>
                  <div class="form-group mb-4">
                        <?php echo $form->textArea($model, 'message', $model->getHtmlOptions('message', array('class' => 'form-control form-control-lg', 'placeholder' => $this->tag->getTag('message_*', 'Message *')))); ?>
                        <?php echo $form->error($model, 'message'); ?>
                    </div>
                  <!--<p class="rg-fs-12 rg-text-dark">I agree to share my data with rgestate properties, and allow rgestate properties or its affiliates to collect, control or process my data in order to communicate with me. Should I wish to unsubscribe, I will send an email to <a href="mailto:sales@rgestate.com">sales@rgestate.com</a>. For more information on our Terms & Conditions, <a href="https://www.dev.rgestate.com/terms">Please click here</a>.</p>-->
                  <div class="rg-sub-btn text-center mt-5">
                    <input type="submit" id="bb3" class="btn btn-outline-secondary w-100" value="SEND INQUIRY">
                  </div>
                  <?php $this->endWidget(); ?>
                </div>
              </div>
            </div>
          </div>
          <!--<button type="button" class="close close-ne" data-dismiss="modal" aria-label="Close">-->
          <!--<span aria-hidden="true">&times;</span>-->
          <!--</button>-->
          <!--<script type="text/javascript" src="https://app.getresponse.com/view_webform_v2.js?u=t9lxl&webforms_id=zzsSd" data-webform-id="zzsSd"></script>-->

        </div>

      </div>
    </div>
  </div>
  <style>
    .close {
        position: absolute;
        /* top: 10px; */
        right: 10px;
        font-size: 24px;
        color: #000; /* Change color as needed */
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    /* Close button hover effect */
    .close:hover {
        color: #ff0000; /* Change color on hover as needed */
    }
  </style>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var closeButton = document.querySelector(".modal-header .close");

      closeButton.addEventListener("click", function() {
        var modal = document.getElementById("exampleModal");
        $(modal).modal("hide");
      });
    });
  </script>
<div id="dynamicScripts"></div><div class="modal modal-new fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content position-relative rounded-0">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row m-0">
                  
              <!-- <div class="col-md-6 col-12 p-0">
                  <img class="rg-modal-img d-block w-100 object-fit-cover" style="height: 100%;" src="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/subscribe-modal.jpg" alt="Register Your Interest">
              </div> -->
              <h4 class="text-center" style="margin-bottom: 0px;">Subscribe to our FREE Newsletter and Stay Updated!</h4>
              <div class="col-md-12 col-12 p-0">
                  <script data-b24-form="inline/34/btf76q" data-skip-moving="true">
                  (function(w,d,u){
                  var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);
                  var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
                  })(window,document,'https://cdn.bitrix24.in/b25292121/crm/form/loader_34.js');
                  </script>
              </div>
          </div>    
        </div>
      </div>
  </div>
</div>

<ul class="rg-hero-contact w-100 position-fixed top-50 end-0 translate-middle-y z-1 text-white">
          <li class="pt-4 pb-3">
            <a href="#" class="d-block text-center" data-bs-toggle="modal" data-bs-target="#popupmodal">
              <svg width="16" height="13" class="rg-fill-white mb-1">
                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-email"></use>
              </svg>
              <span class="d-block rg-fs-11 rg-fw-300 text-white text-uppercase"><?php echo $this->tag->getTag('enquire','Enquire');?></span>
            </a>
          </li>
          <li class="pt-4 pb-3">
            <a href="tel:+971 55 279 2403" class="d-block text-center">
              <svg width="16" height="16" class="rg-fill-white mb-2">
                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-call1"></use>
              </svg>
              <span class="d-block rg-fs-11 rg-fw-300 text-white text-uppercase"><?php echo $this->tag->getTag('call','Call');?></span>
            </a>
          </li>
          <li class="pt-4 pb-3">
            <a href="https://wa.me/+971562818008" class="d-block text-center">
              <svg width="21" height="20" class="rg-fill-white mb-2">
                <use xlink:href="<?php echo $this->app->apps->getBaseUrl('theme'); ?>/assets/images/icons.svg#rg-whatsapp1"></use>
              </svg>
              <span class="d-block rg-fs-11 rg-fw-300 text-white text-uppercase"><?php echo $this->tag->getTag('whatsapp','Whatsapp');?></span>
            </a>
          </li>
        </ul>

<script>

 var imgSucces = '<?php echo $maintTaxt;?>';
 var success_message = 'Sent Successfully!';
 function  ajaxSubmitHappenlistmort_popup(form, data, hasError,saveUrl)
{
    console.log( form.serialize() );
if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":saveUrl,
                                    "data":form.serialize(),
                                    "success":function(data){
										var data = JSON.parse(data);
										if($("#requestBtn").length>0){  var hhtmk = $("#requestBtn").attr('data-html');  if(hhtmk !==undefined){  $("#requestBtn").attr('disabled',false); $("#requestBtn").html(hhtmk); } }
										if($("#bb").length>0){  var hhtmk = $("#bb").attr('data-html'); if(hhtmk !==undefined){  $("#bb").attr('disabled',false); $("#bb").val(hhtmk); } }
										 if(data.status=='1'){ 
										   
										     $('#signUpForm3').find('input.form-control').val('');
										      form.find("#bb3").val(imgSucces); 
										     $('#signUpForm3').find('textarea').val(''); 
										     $('#signUpForm3').find('select').val('');
										        	var msg_new = success_message;
												if(data.name != undefined){
												    //successAlert('&nbsp; ',msg_new.replace("{name}", data.name)); 
												     $('#contact-message').html('<div class="alert alert-success" role="alert">'+success_message+'</div>');
												}else{
												     //successAlert('&nbsp; ',msg_new.replace("{name}", ''));
												      
												}
										         //onRecaptchaLoadCallback();
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
function  ajaxSubmitHappenlistmort(form, data, hasError,saveUrl)
{
    console.log( form.serialize() );
if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":saveUrl,
                                    "data":form.serialize(),
                                    "success":function(data){
										var data = JSON.parse(data);
										if($("#requestBtn").length>0){  var hhtmk = $("#requestBtn").attr('data-html');  if(hhtmk !==undefined){  $("#requestBtn").attr('disabled',false); $("#requestBtn").html(hhtmk); } }
										if($("#bb").length>0){  var hhtmk = $("#bb").attr('data-html'); if(hhtmk !==undefined){  $("#bb").attr('disabled',false); $("#bb").val(hhtmk); } }
										 if(data.status=='1'){ 
										   
										     $('#signUpForm').find('input.form-input').val('');
										      form.find("#bb").val(imgSucces); 
										     $('#signUpForm').find('textarea').val(''); $('#signUpForm').find('select').val('');
										        	var msg_new = success_message;
												if(data.name != undefined){
												    //successAlert('&nbsp; ',msg_new.replace("{name}", data.name)); 
												     $('#contact-message3').html('<div class="alert alert-success" role="alert">'+success_message+'</div>');
												}else{
												     //successAlert('&nbsp; ',msg_new.replace("{name}", ''));
												      
												}
										         //onRecaptchaLoadCallback();
										}
										else{
										    //errorAlert('Error',data.msg); 
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
 <script>
 var imgSucces = 'Sent Successfully!';
 var success_message = 'Sent Successfully!';
       
function  ajaxSubmitHappenlistmort2(form, data, hasError,saveUrl)
{
    console.log( form.serialize() );
if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":saveUrl,
                                    "data":form.serialize(),
                                    "success":function(data){
										var data = JSON.parse(data);
										if($("#requestBtn").length>0){  var hhtmk = $("#requestBtn").attr('data-html');  if(hhtmk !==undefined){  $("#requestBtn").attr('disabled',false); $("#requestBtn").html(hhtmk); } }
										if($("#bb2").length>0){  var hhtmk = $("#bb").attr('data-html'); if(hhtmk !==undefined){  $("#bb").attr('disabled',false); $("#bb").val(hhtmk); } }
										 if(data.status == "1"){ 
										   
										     $('#signUpForm2').find('input.form-input').val('');
										      form.find("#bb2").val(imgSucces); 
										     $('#signUpForm2').find('textarea').val(''); $('#signUpForm2').find('select').val('');
										        	var msg_new = success_message;
												if(data.name != undefined){
												    //successAlert('&nbsp; ',msg_new.replace("{name}", data.name)); 
												     $('#contact-message2').html('<div class="alert alert-success" role="alert">'+success_message+'</div>');
												}else{
												     //successAlert('&nbsp; ',msg_new.replace("{name}", ''));
												      
												}
										         //onRecaptchaLoadCallback();
										}
										else{
										     form.find("#bb2").val("SEND INQUIRY"); 
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
<script>
    $(function(){
    			     
        var input5 = document.querySelector("#<?php echo $model->modelName;?>_phone_false");
        window.intlTelInput(input5, {
          // allowDropdown: false,
          // autoHideDialCode: false,
          // autoPlaceholder: "off",
     
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
  <script>
    $(function(){
    			     
        var phone2 = document.querySelector("#phone2");
        window.intlTelInput(phone2, {
          // allowDropdown: false,
          // autoHideDialCode: false,
          // autoPlaceholder: "off",
     
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
    			     
        var popup = document.querySelector("#popup-phone");
        window.intlTelInput(popup, {
          // allowDropdown: false,
          // autoHideDialCode: false,
          // autoPlaceholder: "off",
     
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

<!-- <script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: '67252e1be643c722e18f352c' },
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production'
        });
      }
      v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
</script> -->
</body>

</html>