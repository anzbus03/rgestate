
						<?php 
					 	$form=$this->beginWidget('CActiveForm', array(
							'id'=>'signup-form',
							'enableAjaxValidation'=>true,
						 
							'clientOptions' => array(
							   'validateOnSubmit'=>true,
								'validateOnChange'=>true,
								 

							),
							'action'=>Yii::app()->createUrl("user/signup",array('return'=>@$return))
							));  ?>
						<div class="form-row no-bot-border">
							<div id="register-head" style="width:100%">
								<h4 >Create a FREE account</h4>
								<br />
								<a class="fbbtn-register-sprite" href="<?php echo Yii::app()->createUrl("hybridauth");?>" ></a>
							</div>

							
							<div class="clear"></div>
						</div>

						<div id="signin-hsep">
							<span><img src="https://www.247zoom.com/frontend/themes/styles-yellow/images/or.jpg" style="max-width:18px !important;" /></span>
						</div>
						<?php
						if(Yii::app()->user->hasFlash("registerfail"))
						{
							?>
							 
							<div class="error1"> 
							<?php  echo  CHtml::errorSummary($model) ;?>
							</div>
						<?php
						}
						?>
						<?php
						if(Yii::app()->user->hasFlash("registerfail2"))
						{
							?>
							 
							<div class="error1"> 
							<?php  echo Yii::app()->user->getFlash("registerfail2") ;?>
							</div>
						<?php
						}
						?>
						<div class="form-row no-bot-border">
							<h4>Register normally</h4>
							<p class="note">Note: All fields are mandatory</p>
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
    
	<div class="form-row" hint="">
		<label for="id_email">Confirm Email
		</label>
		<?php 
		echo $form->textField($model , 'confirm_email', array_merge($model->getHtmlOptions('confirm_email'),array("placeholder"=>"username@provider.com (confirm)" ,'class'=>''))); 
		?>
		<?php echo $form->error($model, 'confirm_email');?>
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
				#fbsignin-form form #ListingUsers_password, #fbsignin-form form #ListingUsers_con_password {
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
		<label for="id_first_name">First Name    </label>
		<?php 
		echo $form->textField($model , 'first_name', array_merge($model->getHtmlOptions('first_name'),array("placeholder"=>"Please enter your real name." ,'class'=>''))); 
		?>
		<?php echo $form->error($model, 'first_name');?>
		<div class="clear"></div>
		</div>			
         
		<div class="form-row" hint="">
		<label for="id_last_name">Last Name </label>
		<?php 
		echo $form->textField($model , 'last_name', array_merge($model->getHtmlOptions('last_name'),array("placeholder"=>"Your last name will be kept private." ,'class'=>''))); 
		?>
		<?php echo $form->error($model, 'last_name');?>
		<div class="clear"></div>
		</div>
		
		<div class="form-row">
		<label for="id_gender">My Mother Calls Me </label>
		<?php 
		echo $form->dropDownList($model,'calls_me',array(''=>'- Select One -','M'=>'Habibi (M)','F'=>'Habibti (F)'),array( "class"=>"","empty"=>"- Select Nationality -","style"=>"")); 
		?>
		<?php echo $form->error($model, 'calls_me');?>
		<div class="clear"></div>
		</div>
		
		<div class="form-row">
		<label for="id_nationality">My Passport tells me I am from </label> 
		<?php
		echo $form->dropDownList($model,'country', CHtml::listData(Countrieslist::model()->listData(),'id','name'),array("class"=>"", "empty"=>"- Select One -","style"=>";")); 
		?>
		<?php echo $form->error($model, 'country');?>
		<div class="clear"></div>
		</div>

 	<div class="fbregister-button-block">
							<p>By clicking on Register, you agree to the <a href="<?php echo Yii::app()->createUrl('article/terms');?>" target="_blank" class="redbold">  Terms and Conditions</a> and the <a href="<?php echo Yii::app()->createUrl('article/condition');?>" target="_blank" class="redbold">  Privacy Policy</a>.</p>
							<input type="submit" class="red awesome fbregister-button frebites_button" value="Register" />
							<div class="clear"></div>
						</div>
					<?php $this->endWidget();?>
		 
