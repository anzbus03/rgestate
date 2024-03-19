<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
<div class="container">

	<div class="row  signup-container margin-top-50">
		<div class="col-md-6" style="margin:auto;float:none;max-width:448px;">
			
        <!--Tabs -->
        <div class="sign-in-form style-1">
			<div class="module-head" id="yui_3_18_1_1_1536724890525_310"><h2 id="yui_3_18_1_1_1536724890525_309">Email Confirmed</h2></div>
      
		   <div class="tabs-container alt "> 
<p class="inf">Create a password to access your account on your phone, tablet, or computer.</p>
       
            <!-- Login -->
							<div class="tab-content padding-top-0" id="tab1" style="border-top:0px;">
							<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>true,
							'validateOnType'=>true,
							),
							)); ?>
							<div id="right-col">


							<div id="signin-form">


							<div class="form-row " hint="">
							<?php 
							echo $form->passwordField($model , 'password', array_merge($model->getHtmlOptions('password'),array("placeholder"=> 'Create password'   ,'class'=>''))); 
							?>
							</label>
							<?php echo $form->error($model, 'password');?>
							<div class="clear"></div>
							</div>

							<div class="fbsignin-button-block">

							<span class="pull-left"><input type="submit" class="button" value="<?php echo   'Update' ;?>" tabindex="3" /></span>
							<span class="forgotpassword pull-left margin-top-20">Know your password? <a href="<?php echo $this->app->createUrl('user/signin');?>"   class="redbold"><?php echo  'Sign in' ;?></a> </span>
							<div class="clearfix"></div>
							<div class="clear"></div>
							</div>
							</div><!-- end #signin-form -->
							</div><!-- end #right-col -->
							<?php $this->endWidget();?>

			</div>

			<!-- Register -->
		 
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
