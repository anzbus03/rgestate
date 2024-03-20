<style>
#fbsignin-form form .form-row label {   } 
#fbsignin-form form .form-row input {   }
#fbsignin-form form .form-row label{ width:auto;}
</style>
						<?php 
					 	$form=$this->beginWidget('CActiveForm', array(
							'id'=>'signup-form',
							'enableAjaxValidation'=>true,
						 
							'clientOptions' => array(
							   'validateOnSubmit'=>true,
								'validateOnChange'=>true,
								 

							),
							'action'=>Yii::app()->createUrl("user/signup",array('return'=>@$return,'short_signup'=>'1'))
							));  ?>
						  <div style=" margin:auto;width:255px;">
						<div class="form-row no-bot-border">
							<h4 class="no-margin" style="text-align:left">Register</h4>
						 
						</div>
						
						<div class="clear"></div>	
	
	
	
	<div class="form-row" hint="">
			<label for="id_email">Email Address</label>
			<?php 
			echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array("placeholder"=>"username@provider.com" ,'class'=>''))); 
			?>
			<?php echo $form->error($model, 'email');?>
			<div class="clear"></div>
	</div>
    
	 


		<div class="form-row">
		<label for="id_password1">Password </label>
		<div class="multiple">
		<div class="multiple_password1">
			<?php 
			echo $form->passwordField($model , 'password', array_merge($model->getHtmlOptions('password'),array("placeholder"=>"Password",'class'=>'' ))); 
			?>
		</div>
		<style>
				#fbsignin-form form #FreebitesUser_password, #fbsignin-form form #FreebitesUser_con_password {
				margin: 0 2px;
				width: 117px;
				}
				#fbsignin-form .errorMessage
				{
					font-size:10px; 
				}
		</style>
		<div class="multiple_password2">
		 <?php 
			echo $form->passwordField($model , 'con_password', array_merge($model->getHtmlOptions('con_password'),array("placeholder"=>"Confirm Password" ,'class'=>''))); 
			?>
		</div>
		</div>
		<?php echo $form->error($model, 'password');?>
		<?php echo $form->error($model, 'con_password');?>
		<div class="clear"></div>
		</div>
			
			
		<div class="form-row" hint="">
		<label for="id_first_name">Full Name    </label>
		<?php 
		echo $form->textField($model , 'first_name', array_merge($model->getHtmlOptions('first_name'),array("placeholder"=>"Please enter your real name." ,'class'=>''))); 
		?>
		<?php echo $form->error($model, 'first_name');?>
		<div class="clear"></div>
		</div>			
         
	  

 	<div class="fbregister-button-block">
							<p>By clicking on Register, you agree to the <a href="<?php echo Yii::app()->createUrl('article/terms');?>" target="_blank" class="redbold">  Terms and Conditions</a> and the <a href="<?php echo Yii::app()->createUrl('article/condition');?>" target="_blank" class="redbold">  Privacy Policy</a>.</p>
							<input type="submit" class="red awesome fbregister-button frebites_button" value="Register"  />
							<div class="clear"></div><div></div>
								<p style="margin-top:10px;text-align:right;">Already have an account? <a href="javascript:void(0)" data-href="<?php echo Yii::app()->createUrl('user/signin_ajax',array('return'=>$return));?>" onclick="openRegister(this);return false;" id="register-link">login</a></p>
					<div class="clear"></div>
				
							<div class="clear"></div>
						</div>
					<?php $this->endWidget();?>
					<div class="clear"></div>
		 
</div>
