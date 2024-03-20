	<?php $form=$this->beginWidget('CActiveForm', array(
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							   'validateOnSubmit'=>true,
								'validateOnChange'=>false,
							),
							'action'=>Yii::app()->createUrl("user/signin",array('return'=>@$return))
							)); ?>
		<div id="register-head">
			<h4>Sign in with   Facebook</h4>
			<p class="note2">Use Facebook to sign in to <?php echo  $common_name;?></p>
			<a class="fbbtn-login-sprite" href="<?php echo Yii::app()->createUrl("hybridauth");?>"  ></a>
			<div class="clear"></div>
		</div>
	
		<div id="right-col">
			<div id="signin-vsep">
				<span><img src="https://www.247zoom.com/frontend/themes/styles-yellow/images/or.jpg" /></span>
			</div>
			 
			<div id="signin-form">
				<h4>Sign in with <?php echo   $common_name;?></h4>
				<?php
				if(Yii::app()->user->hasFlash('loginfail'))
				{
					?>   
				 <div class="error1">Please enter a valid email address and password.</div>
				 <?php
			 }
			 ?>
				<div class="form-row " hint="">
					<label for="id_username">Email address</label>
					<?php 
					echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array("placeholder"=>"username@provider.com" ,'class'=>''))); 
					?>
					<?php echo $form->error($model, 'email');?>
					
					<div class="clear"></div>
				</div>
				<div class="form-row " >
					<label for="id_password">Password
					<span class="forgotpassword"><a href="<?php echo Yii::app()->createUrl("user/forgot_password") ;?>">Forgot Password?</a></span>
					</label>
					<?php 
					echo $form->passwordField($model , 'password', array_merge($model->getHtmlOptions('password'),array("placeholder"=>"Password" ,'class'=>''))); 
					?>
					<?php echo $form->error($model, 'password');?>
					<div class="clear"></div>
				</div>
				<div class="fbsignin-button-block">
					<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
					<input type="submit" class="red awesome fbsignin-button frebites_button" value="Sign In" tabindex="3" />
					<p>Don't have an account? <a href="javascript:void(0)" onclick="activateTab(this,'tab2');return false;" id="register-link">Register</a></p>
					<div class="clear"></div>
				</div>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
	<?php $this->endWidget();?>
