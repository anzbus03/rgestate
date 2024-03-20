<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Verify / Change Email Address</h2>
			</div>
		</div>
	</div>
</div>
<div class="container">

	<div class="row">
	
		<div class="col-md-8">
        <!--Tabs -->
        <div class="sign-in-form style-1">
          <ul class="tabs-nav" style="width: 100%;">
            <li class="active"><a href="#tab1">Verify / Change Email Address</a></li>
          </ul>
          <div class="tabs-container alt"> 

            <!-- Login -->
			<div class="tab-content" id="tab1" style="">
		 	<div class="tab_container no-margin no-padding">

<div id="tab1" class="tab_content active_content" id="fbsignin-form">
	 <div class="form">
							<span id="login-form"> </span>
		<div id="register-head">
			<h4><i class="fa fa-paper-plane"></i> Resent Verification Email</h4>
			    <?php  
				
				$form = $this->beginWidget('CActiveForm',array( 
				'enableAjaxValidation'=>true,
				'htmlOptions' =>array('id'=>'form-account-logina','data-abide'=>'','style'=>''),
				'clientOptions' => array(
				'validateOnSubmit'=>true,
				),
				)); 
				;?>
				<button data-layer-action="login" style="margin-top:0px; background-color:green" class="btn red awesome fbsignin-button" name="resent" value="resent" type="submit"  ><i class="fa fa-mail-forward"></i> Resent Verification Email</button>
				<?php $this->endWidget();?>
			<div class="clear"></div>
		</div>
	
		<div id="right-col">
			<div id="signin-vsep">
				<span><img src="https://www.247zoom.com/frontend/themes/styles-yellow/images/or.jpg" /></span>
			</div>
			 <style>
			 #fbsignin-form #right-col .error { width:auto !important; }
			 </style> 
			<div id="signin-form">
				<h4><i class="fa fa-inbox"></i> Change Email Address</h4>
				
				<div class="form-row "  >
					<?php  
					$form = $this->beginWidget('CActiveForm',array( 
					'enableAjaxValidation'=>true,
					'htmlOptions' =>array('id'=>'form-account-loginasd','data-abide'=>'','style'=>''),
					'clientOptions' => array(
					'validateOnSubmit'=>true,
					),
					)); 
					;?>
					<label for="id_username">Email address</label>
					<?php 
						echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array( "class"=>"user-email" ,"placeholder"=>"Your email address" ))); 
					?>
					<?php echo $form->error($model, 'email');?>
					<div class="clear"></div>
				</div>
				 
				<div class="fbsignin-button-block" style="width:100%;">
					<button type="submit" class="btn awesome fbsignin-button frebites_button" value=""  style="width:100%;" ><i class="fa fa-envelope"></i> Change Email</button>
					 <style>
					 .btn{ line-height: 32px;background-color: #FF5A5F;
						 font-family: 'Hind',! sans-serif important;
text-transform: none;padding: 9px 20px;
color: #fff;border:0px;transition: box-shadow .2s !important;border: 0px  ;
box-shadow: 0 1px 3px 0 rgba(0,0,0,.06);border-radius: 5px;
						 }
					 </style>
					<div class="clear"></div>
				</div>
				<?php $this->endWidget();?>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
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
		
		
		<div class="col-md-4"> 
		<div class="description-item"><i class="description-star-icon description-icon"></i> <h3 class="description-title">Don’t miss a thing</h3> <p class="description-content">Save your dream homes and stay updated on your favourite searches, across any device.</p></div>
		
		<div class="description-item"><i class="description-open-icon description-icon"></i> <h3 class="description-title">Get organised</h3> <p class="description-content">Receive open for inspection planners and our comprehensive weekly auction results.</p></div>
		
		
		<div class="description-item"><i class="description-home-icon description-icon"></i> <h3 class="description-title">Make the most of your home</h3> <p class="description-content">Claim your home and access insights and tools to help you understand the market.</p></div>
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
