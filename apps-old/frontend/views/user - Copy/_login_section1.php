	<?php $form=$this->beginWidget('CActiveForm', array(
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							   'validateOnSubmit'=>true,
								'validateOnChange'=>false,
							),
							'action'=>Yii::app()->createUrl("user/signin",array('return'=>@$return))
							)); ?>
							<style>
							#fbsignin-form #right-col #signin-form {
    float: none;
    border-left: 0px solid #cacaca;
    padding-left:  0px; margin:auto; 
}
							</style>
		 <div id="right-col" style="float:none !important;;border-left:0px !important; margin:auto;">
			 
			 
			<div id="signin-form" style="width:260px;">
				<h4 style="text-align:left" >Login</h4>
			 
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
					<p>Don't have an account? <a href="javascript:void(0)" data-href="<?php echo Yii::app()->createUrl('user/signup_ajax',array('return'=>$return));?>" onclick="openRegister(this);return false;" id="register-link">Register</a></p>
					
					<div class="clear"></div>
				</div>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
	<?php $this->endWidget();?>
