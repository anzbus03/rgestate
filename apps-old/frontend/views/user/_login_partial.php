	<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'signin-form',
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
							
	<div class="clearfix"></div>
	<span class="_social"> Sign In via social : </span><?php   $this->widget('common.extensions.yii-eauth-master.EAuthWidget', array('action' => 'site/login')); ?>
	<div class="clearfix"></div>

	<div class="separator">
	<span>OR</span>
	</div>
	<div class="clearfix"></div>
	
		 <div id="right-col" style="float:none !important;;border-left:0px !important; margin:auto;">
			 
			 
			<div id="signin-form" style="">
				<div class="form-row form-row-wide" hint="">
					<label for="username">Username: <i class="im im-icon-Male"></i>
					<?php 
					echo $form->textField($user , 'email', array_merge($user->getHtmlOptions('email'),array("placeholder"=>"username@provider.com" ,'class'=>'input-text'))); 
					?>
					</label>
					<?php echo $form->error($user, 'email');?>
					
					<div class="clear"></div>
				</div>
				<div class="form-row " >
					<label for="id_password">Password: <i class="im im-icon-Lock-2"></i>
					<span class="forgotpassword pull-right"><a href="<?php echo  $this->app->createUrl('user/forgot_password');?>">Forgot Password?</a></span>
					<?php 
					echo $form->passwordField($user , 'password', array_merge($user->getHtmlOptions('password'),array("placeholder"=>"Password" ,'class'=>'input-text'))); 
					?>
					</label>
					<?php echo $form->error($user, 'password');?>
					<div class="clear"></div>
				</div>
				<div class="fbsignin-button-block">
					<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
					<input type="submit" class="red awesome fbsignin-button frebites_button" value="Sign In" tabindex="3" />
					<p>Don't have an account? <a href="javascript:void(0)"   onclick="$('#acc_li').click();return false;" id="register-link">Register</a></p>
					
					<div class="clear"></div>
				</div>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
	<?php $this->endWidget();?>
