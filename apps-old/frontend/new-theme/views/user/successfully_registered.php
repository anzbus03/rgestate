<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1" >
         
          <div class="tabs-container alt" > 

            <!-- Login -->
			<div class="tab-content" id="tab1"  style="border-top: 0px  ;padding-top:0px;">
		 	<div class="tab_container no-margin no-padding">

<div id="tab1" class="tab_content active_content" id="fbsignin-form">
	 <div class="form">
		 <div class="emil_img text-center"><img src="<?php echo Yii::App()->apps->getBaseUrl('assets/img/email-verification.png');?>" style="width:200px;" /></div>
		 <h2 class="large_h2 text-center" >Great! You've   successfully <br /> signed up for   <?php echo $this->project_name;?></h2>
		 <p class="margin-top-20 article_font text-center" style="max-width:430px;margin:auto;">We've sent you  a link to confirm your email address. Please check your inbox. It coould take up to minutes to show up in your inbox.</p>
						
						<div class="text-center">
						
							<a href="<?php echo Yii::app()->createUrl('site/index');?>" class="btn btn-secondary btnLrg" style="padding:5px 10px !important;border-radius:10px;font-size:16px !important;margin-right:15px;">Go to Home</a>
								<a href="<?php echo Yii::app()->createUrl('member/dashboard');?>" class="btn btn-primary btnLrg" style="padding:5px 10px !important;border-radius:10px;font-size:16px !important;">Go to My Account</a>
						</div>
							<span id="login-form"> </span>
		<div id="register-head">
		 
			    <?php  
				
				$form = $this->beginWidget('CActiveForm',array( 
				'enableAjaxValidation'=>true,
				'htmlOptions' =>array('id'=>'form-account-logina','data-abide'=>'','style'=>''),
				'clientOptions' => array(
				'validateOnSubmit'=>true,
				),
				)); 
				;?>
				<button data-layer-action="login" style="margin-top:0px; width:100%;  " id="resend_btn" class="hide btn red awesome fbsignin-button headfont" name="resent" value="resent" type="submit"  ><i class="fa fa-mail-forward"></i> Resent Verification Email</button>
				<?php $this->endWidget();?>
			<div class="clear"></div>
		</div>
	
		 <!-- end #right-col -->
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div><!-- end #tab1 -->

		 
		</div><!-- end .tab_container -->
	
			</div>

			<!-- Register -->
		 
            </div>
          </div>
       

		

		</div>
	 
		<div class="col-md-4 hide"> 
		<div class="description-item"><i class="description-star-icon description-icon my-i"></i> <h3 class="description-title">Don’t receive th email ?</h3>
		 <p >1. Is <a href="mailto:<?php echo $model->email;?>" class="link_color"><?php echo $model->email;?></a> your correct email without typos? If not <a href="<?php echo Yii::app()->createUrl('user/signup');?>"> you can restart the signup process </a></p>
		 <p >2. Check your spam folder </p>
		 <p >3. Click <a href="javascript:void(0)" onclick="$('#resend_btn').click();"  class="link_color">here</a> to resend the  email </p>
		 
		 </div>
		 <div class="clearfix"></div>
		 <div style="position:relative;">
		<div class="description-item"><i class="description-open-icon description-icon my-i"></i> <h3 class="description-title">Still having trouble?</h3>
		 <p class="description-content"><a href="<?php echo Yii::app()->createUrl('contact/index');?>"  class="link_color">Contact Us</a></p>
		</div>
		</div>
		
		
		 	</div>
	</div>

</div>
  
<style>input, input[type=text], input[type=password], input[type=email], input[type=number], textarea, select {
    	height: 51px;
            line-height: 51px;
            padding: 0 20px;
            outline: 0;
            font-size: 15px;
            color: gray;
            margin: 0 0 16px;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
            display: block;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.06);
            font-weight: 500;
            opacity: 1;
            border-radius: 3px;
    margin-left: 0 !important;
    width:100%;
}.no-padding-left{padding-left:0px;}.no-padding-right{padding-right:0px;}.pull-right{ float:right;}.forgotpassword a{color:#82addc !important;}</style>
