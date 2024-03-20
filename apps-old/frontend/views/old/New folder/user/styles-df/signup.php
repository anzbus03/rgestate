 <?php defined('MW_PATH') || exit('No direct script access allowed'); 
 ?>
 
	 
	<nav class="breadcrumbs small">
	<ul>
		<li><a href="<?php echo Yii::app()->createUrl("");?>">Home</a></li>
		<li class="active"><a href="#">Sign Up</a></li>
	</ul>
    </nav>
	 
	<?php
							if(Yii::app()->user->hasFlash("success"))
							{
								?>
								<div id="display-success">			<span></span>  Successfully Created your account.  <a class="my_link_s" style="color:#0A852F" href="<?php echo Yii::app()->createUrl('user/signin')?>">	Click here to login</a>	</div>
								<?
							}
							?>
							<?php
							if(Yii::app()->user->hasFlash("failure"))
							{
								?>
								<div id="display-error">			<span></span> Your form has following errors.		</div>
								<?
							}
							?> 
							<?php
							if(Yii::app()->user->hasFlash("registerfail"))
							{
								?>
								<div id="display-error">			<span></span><?php echo Yii::app()->user->getFlash("registerfail") ;?>.		</div>
								<?
							}
							?> 
	
	 
	<div id='cssmenu'>
	<ul>
		
		<li><a href='<?php echo Yii::app()->createUrl("user/signin") ;?>'><span>Sign in</span></a>  </li>
		<li class='active has-sub'><a href='<?php echo Yii::app()->createUrl("user/signup") ;?>'><span>Sign Up</span></a></li>
		 <li><a href='<?php echo Yii::app()->createUrl("user/forgot_password") ;?>'><span>Forgot Password</span></a></li>
	</ul>
	</div>
	  <div class="clear"></div>
  	<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'top-websites-cr-form',
							'method'=>'post',
							'focus'=>"first_name",
							  
							)); ?>
								
							
	 <div class="sub_content">
	  <!-- Content left-->
	  <div class="sub_content_left">
		 
		<h4 class="scheme-g signin"><span></span> Sign up to <?php echo Yii::app()->name ; ?></h4>
		<div class="sub_content_left_content">
		 <p>
							<?php echo $form->labelEx($model, 'first_name');?>
							<?php echo $form->textField($model, 'first_name', $model->getHtmlOptions('first_name')); ?>
							<?php echo $form->error($model, 'first_name');?>
						</p>
						<p>
							<?php echo $form->labelEx($model, 'last_name');?>
							<?php echo $form->textField($model, 'last_name', $model->getHtmlOptions('last_name')); ?>
							<?php echo $form->error($model, 'last_name');?>
						</p>
						<p>
							<?php echo $form->labelEx($model, 'email');?>
							<?php echo $form->textField($model, 'email', $model->getHtmlOptions('email')); ?>
							<?php echo $form->error($model, 'email');?>
						</p>
						 
						<p>
							<?php echo $form->labelEx($model, 'password');?>
							<?php echo $form->passwordField($model, 'password', $model->getHtmlOptions('password')); ?>
							<?php echo $form->error($model, 'password');?>
						</p>
						<p>
							<?php echo $form->labelEx($model, 'con_password');?>
							<?php echo $form->passwordField($model, 'con_password', $model->getHtmlOptions('con_password')); ?>
							<?php echo $form->error($model, 'con_password');?>
						</p>
						<p>
							<label style="width:100%;font-weight:bold;">
							 <?php echo $form->checkBox($model, 'send_me') . ' ' . $model->getAttributeLabel('send_me');?>
							</label>
						
						</p>
						 <p class="link-c"><button class="btn_my" type="submit">Create Account</button></p>
						 <p>By having an account you are agreeing with our <a href="#" class="my_link">Terms and Conditions</a> and <a class="my_link"  href="#">Privacy Statement</a></p>
						 <p><a class="my_link_s" style="color:#0A852F"href="<?php echo Yii::app()->createUrl('user/signin')?>"><b>Already have account ?</b></a></p>
		</div>			
	  </div>
	    <!-- Content right-->
	  <div class="sub_content_right">
	  <h4 class="scheme-g signin"><span></span>Create a free Account for</h4>
	   <ul>
	   <li>
            <span></span>Be in control 24/7
	   </li>
	   <li>
           <span></span> Manage your search
	   </li>
	   <li>
           <span></span> Manage your account
	   </li>
	   <li>
           <span></span>Place free ads
	   </li>
	   <li>
           <span></span> Manage your ads
	   </li>
	   </ul>
	  
	  </div>
  
  <div class="clear"></div>
  </div>
 						
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
 
 <?php  $this->endWidget();  ;?>
