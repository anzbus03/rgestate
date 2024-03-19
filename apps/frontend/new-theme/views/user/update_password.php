<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1">
           
             <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('email_confirmed','Email Confirmed');?></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0; margin:auto;  max-width:280px;    margin: auto;    width: 100%;display:block;">
		   <div class=" "> 
<p class="inf"><?php echo $this->tag->getTag('create_a_password_to_access_yo','Create a password to access your account on your phone, tablet, or computer.');?></p>
       
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


								<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  	echo $form->passwordField($model , 'password' ,  $model->getHtmlOptions('password',array('style'=>'font-size: 16px;width:100% !important;line-height: 24px;padding: 12px;height: auto;width: auto;','class'=>'input-text form-control','placeholder'=>$this->tag->getTag('type_your_new_password','Type your new password') )));  ?>

							<?php echo $form->error($model, 'password');?>

							</div>

							</div>
		</div> 

							<div class="fbsignin-button-block">

						 
							
								<button  type="submit" class="btn btn-primary btn-block headfont" style="background-color:var(--secondary-color);border-color:var(--secondary-color);"  /><?php echo $this->tag->getTag('submit','Submit');?></button>
								
								 
								<div  class="lastrow text-center"><span class= ""><?php echo Yii::t('app',$this->tag->getTag('know_your_password?_{link}','Know your password? {link}'),array('{link}'=>'<br /><a href="'.$this->app->createUrl('user/signin').'"   class="redbold">'.$this->tag->getTag('sign_in','Sign in').'</a>'));?> </span>	<div class="clearfix"></div></div>
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
