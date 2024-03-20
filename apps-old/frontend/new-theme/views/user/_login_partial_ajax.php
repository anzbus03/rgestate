<?php
	$merge_array = array_filter($_GET);
	$query = '';
	if(!empty($merge_array)){
	$query = http_build_query($merge_array);
	}
	$saveUrl = Yii::app()->createUrl('user/signinajax');
	$saveUrl = $saveUrl.'?'.$query ; 
	$form = $this->beginWidget('CActiveForm', array(
	'id'=>'werwerwer',
	'action'=>Yii::app()->createUrl('user/signin',array('a'=>'t')),
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	'validateOnChange'=>false,
	'beforeValidate' => 'js:function(form) {
				     
						form.find("#log_btn2").html("Validating..");
						return true;
					}',
	'afterValidate' => 'js:function(form, data, hasError) { 
	if(hasError) {
	form.find("#log_btn2").html("Sign In");
	return false;
	}
	else
	{
	$("#log_btn2").html("Processing...");
	ajaxSubmitHappenFav(form, data, hasError,"'.$saveUrl.'"); 
	}
	}',
	),
	'htmlOptions'=>array('class'=>'form   phs','style'=>'margin-top: 5px;' ),
	));
	
	  $user->email		=	isset(Yii::app()->request->cookies['email_login']) ? Yii::app()->request->cookies['email_login']->value : '';
		$user->password	=	isset(Yii::app()->request->cookies['email_password']) ? Yii::app()->request->cookies['email_password']->value : '';
	
	?>
							<style>
							#fbsignin-form #right-col #signin-form {
    float: none;
    border-left: 0px solid #cacaca;
    padding-left:  0px; margin:auto; 
}
							</style>
		 <div id="right-col" style="float:none !important;;border-left:0px !important; margin:auto;">
			 
			 
			<div id="signin-form" style="max-width: 350px;margin:0px auto;">
				<div class="popup_container">
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
				 <div id="userd">
					<div class="form-check form-check-flat  pull-left" style="padding-left: 20px;position: relative;">
<label class="form-check-label" style="padding-left: 0px;color: #333;">
<?php  	echo $form->checkBox($user , 'remember_me', array_merge($user->getHtmlOptions('remember_me'),array(  'class'=>'form-check-input','value'=>'1', 'uncheckValue'=>'','style'=>'width:auto;height:auto;')));?> 
<i class="input-helper"></i> <?php echo Yii::t('app',$user->getAttributeLabel('remember_me'));?>
</label>
	<?php echo $form->error($user, 'remember_me');?>
</div>
					<div class="clearfix"></div>
				</div>
				
				<div style="clear:both"></div>
				</div>
				<div class="fbsignin-button-block">
					<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
				 
					<button type="submit" id="log_btn2" value="Register" class="btn btn-primary btnLrg btnFullWidth">Sign In</button>
							
					<p id="donth">Don't have an account? <a href="<?php echo Yii::app()->createUrl('user/signup');?>"   <?php /* onclick="loadSetAcount(this)"*/
					?> id="register-link">Register</a></p>
					
					<div class="clear"></div>
				</div>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
	<?php $this->endWidget();?>
 
