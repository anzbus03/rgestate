<?php
$banners = HomeBanner::model()->fetchBanners($this->default_country_id, $this->default_country_id, 'CC');
$img = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
$img_mobile = $this->app->apps->getBaseUrl('assets/img/dubai.jpg');
if (!empty($banners)) {
    $img = !empty($banners[0]['image']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['image']) : $img;
    $img_mobile = !empty($banners[0]['mobile']) ? $this->app->apps->getBaseUrl('uploads/files/' . $banners[0]['mobile']) : $img_mobile;
}
?>
<style>
    #ListingUsers_password input,
    #signUpForm .form-control.LJB,
    #signin-form input.form-control.LJB,
    #signin-form select.form-control.LJB {
        border-color: #fff;
        appearance: none;
        border-radius: 2px;
        border-style: solid;
        border-width: 1px;
        line-height: 36px;
        min-height: 48px;
        width: 100%;
        text-indent: 18px;
        font-size: 16px !important;
        background: #f8f8f8;
    }

    #contact #mainContainerClass {
        background: #fff;
    }

    #contact input,
    #contact label,
    #contact textarea {
        margin-bottom: 0px;
        margin-top: 0px;
    }

    #contact label {
        font-weight: 600;
    }

    #contact .rows {
        margin-bottom: 15px;
    }

    #signUpForm .rounded-btn-n,
    #signin-form .rounded-btn-n {

        height: 65px !important;

        font-size: 21px;
    }

    .errorMessage {
        color: #e13009 !important;
    }

    .banner {
        margin-left: -15px;
        margin-right: -15px;
        width: calc(100% + 30px);
        position: relative;
        height: 20.56vw;
        background-color: rgba(0, 0, 0, 0.8);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    #mainContainerClass,
    #pageContainer {
        max-width: 100%;
        width: 100%;
    }

    .abs-banner::before {
        content: '';
        left: 0px;
        right: 0px;
        top: 0px;
        bottom: 0px;
        position: absolute;
        background: rgba(0, 0, 0, 0.2);
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

    .bloghead {}

    .bloghead h1,
    .bloghead p {
        background-color: transparent !important;
        color: #fff !important;
    }

    .bloghead h1 {
        margin-bottom: 19px;
    }

    .bloghead p {
        font-weight: 300;
        font-size: 16px;
    }

    .abs-banner {

        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        color: #fff;
        z-index: 1;
        content: '';

    }

    .fancy-title {

        color: #fff;
    }
</style>
<style>
    .ja_title>div {
        position: absolute;
        background: #fff;
    }

    .continue {
        padding: 10px;
        margin-top: 10px !important;
        border-radius: 5px;
        min-width: 136px;
        font-size: 16px;
        cursor: pointer;
        background: var(--secondary-color);
    }

    html .ja_close_round {
        color: inherit;
        font-size: 60px;
        font-weight: 300;
        background: transparent;
        right: 15px;
        top: 22px;
    }

    html .ja_body .title {
        font-weight: 600;
        text-align: left;
        margin-bottom: 15px;
        font-size: 22px;
    }

    html .ja_body .text {
        text-align: left;
        font-size: 18px;
    }

    html .ja_body .info {
        text-align: left;
        max-width: 400px;
        margin: auto;
        color: #888;
    }

    html[dir="rtl"] .ja_body .info {
        text-align: right;
    }

    html .jAlert>div {
        position: relative;
        border-radius: 5px !important;
        overflow: hidden;
    }

    html .ja_body {
        padding: 50px;
    }

    .jAlert {
        margin-top: 0px;
        width: 600px;
        max-width: 90%;
    }

    .ja_close_round:hover,
    .ja_close_round:active {
        color: inherit;
        background: transparent;
    }

    #signUpForm .rounded-btn-n,
    #signin-form .rounded-btn-n {

        font-size: 17px !important;
        font-weight: 500 !important;
    }

    .widget .social-icons a {

        border: 1px solid var(--secondary-color);
        color: var(--secondary-color);
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    .widget .social-icons {
        line-height: 1;
        border: 0px dotted #eee;
        padding: 0px;
        display: flex;
        align-items: center;
        /* justify-content: center; */
        background: #fff;
    }

    html .continue {
        padding: 9px 10px !important;
        margin-top: 10px !important;
        border-radius: 5px;
        min-width: 136px;
        font-size: 16px;
        cursor: pointer;
        background: var(--secondary-color);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        border: 0px;
    }
</style>
<div hidden>
    <svg id="send_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 497 497" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
        <g>
            <g xmlns="http://www.w3.org/2000/svg">
                <path d="m285.987 391.537-149.805 94.45 16.149-115.146 41.763-54.411 70.569 20.01z" fill="#0092e2" data-original="#0092e2" class=""></path>
                <path d="m11.04 152.258c-11.836 3.44-14.957 18.746-5.414 26.546l77.968 63.725 176.276-60.547 237.13-170.969z" fill="#00699e" data-original="#83deff" class=""></path>
                <path d="m194.094 316.43 116.125 94.912 60.41 49.379c8.782 7.179 22.049 2.643 24.598-8.41l101.773-441.298-233.039 173.778z" fill="#00699e" data-original="#83deff" class=""></path>
                <path d="m497 11.013-302.906 305.417-57.912 169.557-52.588-243.458z" fill="#e90c0c" data-original="#00b4fd" class=""></path>
            </g>
        </g>
    </svg>
</div>
<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Content
================================================== -->

<!-- Map Container -->

<div class="clearfix"></div>
<!-- Map Container / End -->
<section class="panel panel-bg banner" style="background-image:url(<?php echo $img; ?>);">
    <div class="abs-banner">


        <div class="bloghead container">

            <div class="fancy-title-hold text-initial clearfix">
                <h3 class="fancy-title animate animated"><span class="title"><?php echo $this->tag->getTag('contact_us', 'Contact us'); ?></span> <span class="subtitle"><?php echo $this->tag->getTag('letstalk', 'Let\'s Talk'); ?></span></h3>
            </div>

        </div>


    </div>



</section>

<div class="home-banner-outer contact-us">
    <?php
    /*<div class="inner-banner " style="background:url('<?php echo Yii::app()->apps->getBaseUrl('assets/img/signing-1.jpg');?>') no-repeat center;">
    <div class="olay" style="position: absolute;left: 0;right: 0 !important;bottom: 0;top: 0;background: rgba(0,0,0,0.4);"></div>
  <div class="container">
    <div class="tit-innrhd animatedParent">
      <div class="theme-title banner_text animated growIn go">
        <h3>Contact Us</h3>
        	        	  <ul style="list-style-type:none;font-weight:400;">
							  <?php
				$your_array = explode("\n", $this->options->get('system.common.contact_address'));
			 	if(!empty($your_array)){
					foreach($your_array as $k=>$v){
						if($k=='0'){
							echo '<li>'.$v.'</li>';
						}else{
							echo '<li>'.$v.'</li>';
						}
					}
					
					}
					?>
								 
										<li><a href="tel:<?php echo $this->options->get('system.common.contact_phone','');?>" style="color:#fff;"><?php echo $this->options->get('system.common.contact_phone','');?></a></li> 
					
					 
				</ul>
				 
      </div>
    </div>
    
</div>
</div>
*/ ?>

</div>

<!-- Container / Start -->
<div class="container margin-top-20" style="    max-width: 1024px;">
    <style>
        .left-content-bl {

            border-right: 1px dotted #d8e4ef;
        }

        .right-contentl {
            padding: 0px 0px 25px 0px !important;

        }

        .sidebar-header {
            font-size: 19.6px;
            border-bottom: 3px solid #d8e4ef;
            padding: 0px 0 10px 2px;
            font-size: 22px;
            line-height: 32px;
        }

        #pre-method-text {
            margin-top: 8px;
            color: #7B7B7B;
        }

        #contact-method li {

            padding-bottom: 4px;
        }

        #contact-telephone {

            padding-left: 0px;
        }

        #contact-telephone span,
        #contact-skype span,
        #contact-email span {
            font-weight: bold;
            font-size: 1.1em;
        }

        a.link-color:hover {
            text-decoration: underline;
            color: var(--link-color);
        }

        .link-color {
            color: var(--link-color);
        }

        .pk-text {
            color: var(--logo-color);
        }

        #contact #mainContainerClass {
            background: #eee;
            max-width: 100%;
        }

        #contact .container h4 {
            font-weight: 700;
            color: var(--secondary-color);
        }

        #contact #mainContainerClass {
            background: #fff !important;
            max-width: 100%;
        }

        .fancy-title {

            padding-right: 76px;
        }

        .fancy-title .title {
            font-size: 50px;
            padding-bottom: 0px;
        }

        #signUpForm .rounded-btn-n,
        #signin-form .rounded-btn-n {
            height: 51px !important;
            font-size: 19px;
            line-height: 1;
            padding: 0px;
            max-width: 214px;
            border-radius: 4px;
        }

        .widget {
            margin-bottom: 34px;
        }

        .widget-contact-details p small {
            display: block;
            font-weight: 400;
            font-size: 400;
            color: orange !important;
            font-size: 15px;
        }

        .widget-contact-details p span {
            display: block;
            font-size: 16px;
            color: inherit !important;
            font-weight: 400;
        }

        .widget-contact-details p small {
            display: block;
            font-weight: 500;
            font-size: 400;
            color: inherit !important;
            font-size: 18px;
            line-height: 1;
            margin-bottom: 10px !important;
        }

        .widget-contact-details p {

            margin-bottom: 30px;
        }

        .widget {
            margin-bottom: 0px;
            padding: 0px 0px;

        }
    </style>
    <div class="row margin-top-40 margin-bottom-50">

        <!-- Contact Details -->
        <!-- Contact Form -->
        <div class="col-sm-6">
            <h2 class="animate animated"> <span class="title"><?php echo $this->tag->getTag('contact_us', 'Contact us'); ?></span></h2>
            <style>
                .widget-contact-details small svg {
                    width: 30px;
                    height: 35px;
                    color: var(--secondary-color);
                    fill: var(--logo-color);
                }

                .widget-contact-details p.d-flex {

                    display: flex;
                    align-items: center;
                }

                .widget .social-icons a {
                    border: 0px;
                    color: #555;
                    display: inline-flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>

            <div class="widget widget-contact-details">
                <p class=""><small class="margin-right-25">Telephone</small> <a href="tel:<?php echo  $this->options->get('system.common.contact_phone'); ?>"><i class="fa fa-phone"></i> <?php echo  $this->options->get('system.common.contact_phone'); ?></a></p>
                <p class=" "> <small class=" "><?php echo $this->tag->getTag('email', 'Email'); ?></small> <a href="mailto:<?php echo  $this->options->get('system.common.contact_email'); ?>"><i class="fa fa-envelope"></i> <?php echo  $this->options->get('system.common.contact_email'); ?></a></p>

                <p class=""> <small class=" "><?php echo $this->tag->getTag('address', 'Address'); ?></small>
                    <span style="font-weight: 600;; line-height: 23px;">
                        <i class="fa fa-map-marker"></i> <?php echo  Yii::t('app', nl2br($this->options->get('system.common.contact_address')), array('Tel. No:' => '<i class="fa fa-phone"></i> ', 'WhatsApp : ' => '<i class="fa fa-whatsapp"></i> ')); ?></span>

                </p>

                <p> <span><strong style="font-weight: 800;margin-bottom: 9px !important;display: block;"><?php echo $this->tag->getTag('please_note', 'Please Note'); ?>:</strong>
                        <i class="fa fa-clock-o"></i> <?php echo $this->tag->getTag('office_timing', 'Office timing'); ?><br><strong style="font-weight: 600;"> <?php echo  Yii::t('app', nl2br($this->options->get('system.common.office_timing')), array('{b}' => '<strong>', '{be}' => '</strong>')); ?></strong></span></p>
                <div class="social-icons hide"> <a href="<?php echo $this->options->get('system.common.facebook_url'); ?>" class="social-icon social-facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a> <a href="<?php echo $this->options->get('system.common.twitter_url'); ?>" class="social-icon social-twitter" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a> <a href="<?php echo $this->options->get('system.common.pinterest_url'); ?>" class="social-icon social-instagram" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a> <a href="<?php echo $this->options->get('system.common.google_plus_url'); ?>" class="social-icon social-youtube" target="_blank" rel="nofollow"><i class="fa fa-youtube-play"></i></a></div>



            </div>



        </div>

        <div class="col-sm-6  ">
            <h2 class="animate animated"> <span class="title"><?php echo $this->tag->getTag('get_directions', 'Get Directions'); ?></span></h2>

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3616.026526429091!2d55.16789981500552!3d24.999214583988667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f696247868065%3A0x109d4609df87abd2!2sRGEstate.com%20-%20By%20Riveria%20Global%20Group!5e0!3m2!1sen!2sin!4v1645769710574!5m2!1sen!2sin" width="100%" height="350" style="background:#eee" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


        </div>



    </div>
    <!-- Contact Form / End -->

    <div class="row">

        <div class="col-sm-12" style="margin-left:auto;margin-right:auto;">

            <section id="contact" class="padding-top-0" style="margin: auto;max-width: 600px;width: 100%;margin-top: 10px;">


                <h3>Send us a message</h3>
                <div id="contact-message"></div>


                <?php
                $maintTaxt = $this->tag->getTag('contact_us', 'Contact Us');
                $Validating = $this->tag->getTag('validating', 'Validating..');
                $please_wait = $this->tag->getTag('please_wait', 'Please wait..');
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'signUpForm',
                    'action' => Yii::app()->createUrl('contact/index'),
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false,
                        'beforeValidate' => 'js:function(form) {
				     
						form.find("#bb").val("' . $Validating . '");
						return true;
					}',
                        'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
                                form.find("#bb").val("' . $maintTaxt . '");
                                
                                return false;
							}else{
    							form.find("#bb").val("' . $please_wait . '"); 		
	    						ajaxSubmitHappenlistmort(form, data, hasError,"' . Yii::app()->createUrl($this->id . '/send') . '"); 
							}
						}',
                    ),
                ));
                ?>
                <div class="row rows">
                    <div class="col-md-6">
                        <?php echo $form->labelEX($model, 'name'); ?>
                        <div>
                            <?php echo $form->textField($model, 'name', $model->getHtmlOptions('name', array('class' => 'form-control LJB', 'placeholder' => $this->tag->getTag('full_name_*', 'Full Name *')))); ?>
                            <?php echo $form->error($model, 'name'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->labelEX($model, 'email'); ?>
                        <div>
                            <?php echo $form->textField($model, 'email', $model->getHtmlOptions('email', array('class' => 'form-control LJB', 'placeholder' => $this->tag->getTag('email_*', 'Email *')))); ?>
                            <?php echo $form->error($model, 'email'); ?>
                        </div>
                    </div>


                </div>



                <div class="row rows">


                    <div class="col-md-12">
                        <?php echo $form->labelEX($model, 'phone'); ?>
                        <div>
                            <?php echo $form->textField($model, 'phone_false', $model->getHtmlOptions('phone_false', array('class' => 'form-control LJB', 'placeholder' => $this->tag->getTag('contact_number_*', 'Contact Number *')))); ?>
                            <?php echo $form->error($model, 'phone_false'); ?>
                        </div>
                    </div>
                </div>

                <div class="rows">
                    <?php echo $form->textArea($model, 'meassage', $model->getHtmlOptions('meassage', array('cols' => '40', 'rows' => '2', 'class' => 'form-control LJB', 'style' => 'min-height:200px;', 'placeholder' => $this->tag->getTag('contact_number_*', 'Type your message here *')))); ?>
                    <?php echo $form->error($model, 'meassage'); ?>
                </div>
                <div class="clearfix"></div>
                <div class="pop_boxone">
                    <?php
                    $min_error_count  = 1;

                    $min_error_count  = 2;
                    ?>
                    <div class="form-group  margin-bottom-0">

                        <script src="https://www.google.com/recaptcha/api.js?render=explicit&onload=onRecaptchaLoadCallback"></script>

                        <script>
                            function onRecaptchaLoadCallback() {
                                var clientId = grecaptcha.render('inline-badge', {
                                    'sitekey': '<?php echo Yii::app()->options->get('system.common.re_captcha_key', '6Ldsl2IaAAAAAGSkGrL7xUeucC9yKthmDsYWdTmy'); ?>',
                                    'badge': 'bottomleft',
                                    'size': 'invisible'
                                });

                                grecaptcha.ready(function() {
                                    grecaptcha.execute(clientId, {
                                            action: 'action_name'
                                        })
                                        .then(function(token) {
                                            $('#signUpForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                                            // Verify the token on the server.
                                        });
                                });
                            }
                        </script>

                        <?php echo $form->error($model, '_recaptcha', array('style' => 'top:0px !important;')); ?>

                    </div>

                    <div class="clear_div"></div>
                </div>


                <input type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n" style="color:#fff;width:100% !important;margin-bottom:40px;" id="bb" value="<?php echo $maintTaxt; ?>" />

                <?php $this->endWidget(); ?>
            </section>


        </div>

    </div>


</div>

</div>
<div id="inline-badge"></div>
<!-- Container / End -->



<style>
    .wa__btn_popup {
        position: fixed;
        right: 30px;
        bottom: 30px;
        cursor: pointer;

        z-index: 999;
    }

    .wa__btn_popup_txt {
        position: absolute;
        width: 163px;
        right: 100%;
        background-color: #f5f7f9;
        font-size: 12px;
        color: #43474e;
        top: 15px;
        padding: 7px 7px 7px 12px;
        margin-right: 7px;
        letter-spacing: -.03em;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        transition: .4s ease all;
        -webkit-transition: .4s ease all;
        -moz-transition: .4s ease all;
    }

    .wa__btn_popup_icon {
        background: #2db742;
        width: 56px;
        height: 56px;
        background: #2db742;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        box-shadow: 0 6px 8px 2px rgba(0, 0, 0, .14);
        -webkit-box-shadow: 0 6px 8px 2px rgba(0, 0, 0, .14);
        -moz-box-shadow: 0 6px 8px 2px rgba(0, 0, 0, .14);
    }

    .wa__btn_popup_icon::before {
        content: '';
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: transparent url('<?php echo Yii::App()->apps->getBaseUrl('assets/img/whatsapp_logo.svg'); ?>') center center no-repeat;
        background-size: auto;
        background-size: 30px auto;
        -webkit-background-size: 30px auto;
        -moz-background-size: 30px auto;
        transition: .4s ease all;
        -webkit-transition: .4s ease all;
        -moz-transition: .4s ease all;
    }

    .wa__btn_popup_icon::after {
        content: '';
        opacity: 0;
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: transparent url('<?php echo Yii::App()->apps->getBaseUrl('assets/img/x_icon.svg'); ?>') center center no-repeat;
        background-size: auto;
        background-size: 14px auto;
        -webkit-background-size: 14px auto;
        -moz-background-size: 14px auto;
        transition: .4s ease all;
        -webkit-transition: .4s ease all;
        -moz-transition: .4s ease all;
        -ms-transform: scale(0) rotate(-360deg);
        transform: scale(0) rotate(-360deg);
        -webkit-transform: scale(0) rotate(-360deg);
        -moz-transform: scale(0) rotate(-360deg);
    }

    .wa__popup_chat_box {
        font-family: Arial, Helvetica, sans-serif;
        width: 351px;
        border-radius: 5px 5px 8px 8px;
        -webkit-border-radius: 5px 5px 8px 8px;
        -moz-border-radius: 5px 5px 8px 8px;
        position: fixed;
        overflow: hidden;
        box-shadow: 0 10px 10px 4px rgba(0, 0, 0, .04);
        -webkit-box-shadow: 0 10px 10px 4px rgba(0, 0, 0, .04);
        -moz-box-shadow: 0 10px 10px 4px rgba(0, 0, 0, .04);
        bottom: 102px;
        right: 25px;
        z-index: 998;
        opacity: 0;
        visibility: hidden;
        -ms-transform: translate(0, 50px);
        transform: translate(0, 50px);
        -webkit-transform: translate(0, 50px);
        -moz-transform: translate(0, 50px);
        transition: .4s ease all;
        -webkit-transition: .4s ease all;
        -moz-transition: .4s ease all;
        will-change: transform, visibility, opacity;
        max-width: calc(100% - 50px);
    }

    .wa__popup_chat_box.wa__active {
        -ms-transform: translate(0, 0);
        transform: translate(0, 0);
        -webkit-transform: translate(0, 0);
        -moz-transform: translate(0, 0);
        visibility: visible;
        opacity: 1;
    }

    .wa__popup_chat_box .wa__popup_heading {
        background: #2db742;
    }

    .wa__popup_chat_box .wa__popup_heading {
        position: relative;
        padding: 15px 43px 17px 74px;
        color: #d9ebc6;
        background: #2db742;
    }

    .wa__popup_chat_box .wa__popup_heading::before {
        content: '';
        background: url(<?php echo Yii::App()->apps->getBaseUrl('assets/img/whatsapp_logo.svg'); ?>) center top no-repeat;
        background-size: auto;
        background-size: 33px;
        display: block;
        width: 55px;
        height: 33px;
        position: absolute;
        top: 20px;
        left: 12px;
    }

    .wa__popup_chat_box .wa__popup_heading .wa__popup_title {
        padding-top: 2px;
        padding-bottom: 3;
        color: #fff;
        font-size: 18px;
        color: #fff;
        line-height: 24px;
    }

    .wa__popup_chat_box .wa__stt {
        border-left: 2px solid #2db742;
        border-left-color: rgb(45, 183, 66);
    }

    .wa__popup_chat_box .wa__stt {
        padding: 13px 40px 12px 74px;
        position: relative;
        text-decoration: none;
        display: table;
        width: 100%;
        border-left: 2px solid #2db742;
        background: #f5f7f9;
        border-radius: 2px 4px 2px 4px;
        -webkit-border-radius: 2px 4px 2px 4px;
        -moz-border-radius: 2px 4px 2px 4px;
    }

    .wa__popup_content {
        background: #fff;
        padding: 13px 20px 21px 19px;
        text-align: center;
    }

    .wa__popup_content_left {
        text-align: left;
    }

    .wa__popup_notice {
        font-size: 11px;
        color: #a5abb7;
        font-weight: 500;
        padding: 0 3px;
    }

    .wa__popup_content_left {
        text-align: left;
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(1) {
        transition-delay: .3s;
        -webkit-transition-delay: .3s;
        -moz-transition-delay: .3s;
    }

    .wa__popup_chat_box.wa__lauch .wa__popup_content_list .wa__popup_content_item {
        opacity: 1;
        transform: translate(0, 0);
        -webkit-transform: translate(0, 0);
        -moz-transform: translate(0, 0);
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item {
        transition: .4s ease all;
        -webkit-transition: .4s ease all;
        -moz-transition: .4s ease all;
        transition-delay: 0s;
        transition-delay: 2.1s;
        -webkit-transition-delay: 2.1s;
        -moz-transition-delay: 2.1s;
    }

    .wa__popup_content_list .wa__popup_content_item {
        margin: 14px 0 0;
        transform: translate(0, 20px);
        -webkit-transform: translate(0, 20px);
        -moz-transform: translate(0, 20px);
        will-change: opacity, transform;
        opacity: 0;
    }

    .wa__stt_offline {
        pointer-events: none;
    }

    .wa__stt_offline {
        background: #ebedf0;
        color: #595b60;
        box-shadow: none;
        cursor: initial;
    }

    .wa__popup_chat_box .wa__popup_avatar {
        position: absolute;
        overflow: hidden;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        left: 12px;
        top: 12px;
    }

    .wa__popup_content_item .wa__cs_img_wrap {
        width: 48px;
        height: 48px;
    }

    .wa__popup_content_list .wa__popup_content_item .wa__popup_txt {
        display: table-cell;
        vertical-align: middle;
        min-height: 48px;
        height: 48px;
    }

    .wa__popup_content_list .wa__popup_content_item .wa__member_name {
        font-size: 14px;
        color: #363c47;
        line-height: 1.188em !important;
    }

    .wa__popup_content_list .wa__popup_content_item .wa__member_duty {
        font-size: 11px;
        color: #989b9f;
        padding: 2px 0 0;
        line-height: 1.125em !important;
    }

    .wa__popup_content_list .wa__popup_content_item .wa__member_status {
        color: #f5a623;
        font-size: 10px;
        padding: 5px 0 0;
        line-height: 1.125em !important;
    }

    .wa__btn_popup.wa__active .wa__btn_popup_icon::before {
        opacity: 0;
        -ms-transform: scale(0) rotate(360deg);
        transform: scale(0) rotate(360deg);
        -webkit-transform: scale(0) rotate(360deg);
        -moz-transform: scale(0) rotate(360deg);
    }

    .wa__btn_popup.wa__active .wa__btn_popup_icon::before {
        opacity: 0;
        -ms-transform: scale(0) rotate(360deg);
        transform: scale(0) rotate(360deg);
        -webkit-transform: scale(0) rotate(360deg);
        -moz-transform: scale(0) rotate(360deg);
    }

    .wa__btn_popup.wa__active .wa__btn_popup_icon::after {
        opacity: 1;
        -ms-transform: scale(1) rotate(0deg);
        transform: scale(1) rotate(0deg);
        -webkit-transform: scale(1) rotate(0deg);
        -moz-transform: scale(1) rotate(0deg);
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(2) {
        transition-delay: .5s;
        -webkit-transition-delay: .5s;
        -moz-transition-delay: .5s;
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(1) {
        transition-delay: .3s;
        -webkit-transition-delay: .3s;
        -moz-transition-delay: .3s;
    }

    @media only screen and (max-width: 600px) {
        .wa__btn_popup {

            right: 10px;
            bottom: 50px;

        }
    }

    #signUpForm .rounded-btn-n,
    #signin-form .rounded-btn-n {
        height: 51px !important;
        font-size: 19px;
        line-height: 1;
        padding: 0px;
        max-width: 214px;
        border-radius: 4px;
    }
</style>
<script>
    function openthisfn(k) {
        if ($(k).hasClass('wa__active')) {
            $(k).removeClass('wa__active');
            $('.wa__popup_chat_box').removeClass('wa__pending wa__active wa__lauch');
        } else {
            $(k).addClass('wa__active');
            $('.wa__popup_chat_box').addClass('wa__pending wa__active wa__lauch');
        }
    }
</script>
<?php
$hide_upload_property_support = Yii::app()->options->get('system.common.upload_property_hide', '');
$hide_customer_support = Yii::app()->options->get('system.common.customer_support_hide', '');
if ($hide_upload_property_support == '0' or  $hide_customer_support == '0') { ?>
    <div class="wa__btn_popup" onclick="openthisfn(this)">
        <div class="wa__btn_popup_txt">Need Help? <strong>Chat with us </strong></div>
        <div class="wa__btn_popup_icon"></div>
    </div>
    <!--  wa__pending wa__active wa__lauch -->
    <div class="wa__popup_chat_box">
        <div class="wa__popup_heading">
            <div class="wa__popup_title">Start a Conversation</div>
            <div class="wa__popup_intro">Hi! Click one of our members below to chat on <strong>WhatsApp ;)</strong>
                <div id="\&quot;eJOY__extension_root\&quot;"></div>
            </div>
        </div>
        <!-- /.wa__popup_heading -->
        <div class="wa__popup_content wa__popup_content_left">
            <div class="wa__popup_notice">The team typically replies in a few minutes.</div>


            <div class="wa__popup_content_list">
                <?php
                if ($hide_upload_property_support != '1') { ?>
                    <div class="wa__popup_content_item ">
                        <a target="_blank" href="<?php echo Yii::app()->options->get('system.common.upload_property_whatsapplink'); ?>" class="wa__stt wa__stt_online">
                            <div class="wa__popup_avatar">
                                <div class="wa__cs_img_wrap" style="background: url('<?php echo Yii::app()->apps->getBaseUrl('uploads/' . Yii::app()->options->get('system.common.upload_property_image')); ?>') center center no-repeat; background-size: cover;"></div>
                            </div>

                            <div class="wa__popup_txt">
                                <div class="wa__member_name"><?php echo Yii::app()->options->get('system.common.upload_property_contact_name'); ?></div>
                                <!-- /.wa__member_name -->
                                <div class="wa__member_duty"><?php echo Yii::app()->options->get('system.common.upload_property_title', 'Uploading Property Issue?'); ?></div>
                                <!-- /.wa__member_duty -->
                            </div>
                            <!-- /.wa__popup_txt -->
                        </a>
                    </div>
                <?php } ?>
                <?php
                if ($hide_customer_support != '1') { ?>
                    <div class="wa__popup_content_item ">
                        <a target="_blank" href="<?php echo Yii::app()->options->get('system.common.customer_support_whatsapplink'); ?>" class="wa__stt wa__stt_online">
                            <div class="wa__popup_avatar">
                                <div class="wa__cs_img_wrap" style="background: url('<?php echo Yii::app()->apps->getBaseUrl('uploads/' . Yii::app()->options->get('system.common.customer_support_image')); ?>') center center no-repeat; background-size: cover;"></div>
                            </div>

                            <div class="wa__popup_txt">
                                <div class="wa__member_name"><?php echo Yii::app()->options->get('system.common.customer_support_contact_name'); ?></div>
                                <!-- /.wa__member_name -->
                                <div class="wa__member_duty"><?php echo Yii::app()->options->get('system.common.customer_support_title', 'Customer Support'); ?></div>
                                <!-- /.wa__member_duty -->
                            </div>
                            <!-- /.wa__popup_txt -->
                        </a>
                    </div>
                <?php } ?>

            </div>
            <!-- /.wa__popup_content_list -->
        </div>
        <!-- /.wa__popup_content -->
    </div>
<?php } ?>
<script>
    var imgSucces = '<?php echo $maintTaxt; ?>';
    var success_message = '<?php echo $this->renderPartial('//contact/success_message_popup', array(), true, false); ?>';

    function closejs() {
        $('.ja_close').click();
    }

    function ajaxSubmitHappenlistmort(form, data, hasError, saveUrl) {
        if (!hasError) {

            $.ajax({

                "type": "POST",
                "url": saveUrl,
                "data": form.serialize(),
                "success": function(data) {
                    var data = JSON.parse(data);
                    if ($("#requestBtn").length > 0) {
                        var hhtmk = $("#requestBtn").attr('data-html');
                        if (hhtmk !== undefined) {
                            $("#requestBtn").attr('disabled', false);
                            $("#requestBtn").html(hhtmk);
                        }
                    }
                    if ($("#bb").length > 0) {
                        var hhtmk = $("#bb").attr('data-html');
                        if (hhtmk !== undefined) {
                            $("#bb").attr('disabled', false);
                            $("#bb").val(hhtmk);
                        }
                    }
                    if (data.status == '1') {

                        $('#signUpForm').find('input.form-control').val('');
                        form.find("#bb").val(imgSucces);
                        $('#signUpForm').find('textarea').val('');
                        $('#signUpForm').find('select').val('');
                        var msg_new = success_message;
                        if (data.name != undefined) {
                            successAlert('&nbsp; ', msg_new.replace("{name}", data.name));

                        } else {
                            successAlert('&nbsp; ', msg_new.replace("{name}", ''));

                        }
                        onRecaptchaLoadCallback();
                    } else {
                        errorAlert('Error', data.msg);
                    }

                },

            });
        } else {
            alert('error');
        }
    }
</script>
<script>
    $(function() {

        var input5 = document.querySelector("#<?php echo $model->modelName; ?>_phone_false");
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
            initialCountry: "<?php echo COUNTRY_CODE; ?>",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            separateDialCode: true,
            utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js'); ?>",
        });

    })
</script>