<style>
	.isOnFram .sign-in-form .form-group {
		margin-bottom: 10px;
	}

	.isOnFram .container.card-1 {
		margin-top: 0px;
	}
</style>
<div class="clearfix"></div>
<?php
$signin_text = $this->tag->getTag('sign_in', 'Sign in');
$Validating = $this->tag->getTag('validating', 'Validating..');
$please_wait = $this->tag->getTag('please_wait', 'Please wait..');
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'signin-form',
	'action' => Yii::app()->createUrl('user/signin', array('t' => 'c')),
	'enableAjaxValidation' => true,

	'clientOptions' => array(
		'validateOnSubmit' => true,
		'validateOnChange' => false,
		'beforeValidate' => 'js:function(form) {
	
	form.find("#bb").html("' . $Validating . '");
	return true;
}',
		'afterValidate' => 'js:function(form, data, hasError) { 
	
if(hasError) {
	

	
		form.find("#bb").html("' . $signin_text . '");
		return false;
}
else
{
		form.find("#bb").html("' . $please_wait . '");	return true;
}
}',


	),
	'htmlOptions' => array('autocomplete' => 'off', 'class' => 'recapt')
));  ?>
<style>
	#fbsignin-form #right-col #signin-form {
		float: none;
		border-left: 0px solid #cacaca;
		padding-left: 0px;
		margin: auto;
	}

	.form-group label {
		margin-bottom: 0px;
	}
</style>


<div id="right-col" style="float:none !important;;border-left:0px !important; margin:auto; margin:auto;max-width: 300px;margin: auto;display:block;">


	<div id="signin-form" style="">

		<div class="clearfix"></div>
		<div class="form-group  ">

			<div class="row">


				<div class="col-sm-12">

					<?php echo $form->textField($user, 'email',  $user->getHtmlOptions('email', array('class' => 'input-text form-control LJB', 'onkeyup' => 'return emailCase(this)')));  ?>

					<?php echo $form->error($user, 'email'); ?>

				</div>

			</div>
		</div>

		<div class="clear"></div>

		<div class="clearfix"></div>
		<div class="form-group  ">

			<div class="row">


				<div class="col-sm-12">

					<?php echo $form->passwordField($user, 'password',  $user->getHtmlOptions('password', array('autocomplete' => 'off', 'class' => 'input-text form-control LJB')));  ?>

					<?php echo $form->error($user, 'password'); ?>

				</div>

			</div>
		</div>
		<div class="form-group  margin-bottom-5">

			<div class="row">

				<div class="col-sm-6 padding-right-0">

					<div class="checkboxes">
						<label class="container_check padding-right-0 margin-right-0" for="<?php echo $user->modelName; ?>_remember_me" style="margin-right:0px;"> <?php echo $this->tag->getTag('remeber_me', 'Remeber Me'); ?>
							<?php echo $form->checkBox($user, 'remember_me',  $user->getHtmlOptions('remember_me', array('value' => '1', 'uncheckValue' => '',)));  ?>
							<span class="checkmark"></span>
						</label>
					</div>
					<?php echo $form->error($user, 'remember_me'); ?>
					<div class="clear"></div>

				</div>
				<div class="col-sm-6 pull-right  padding-left-0"> <span class="forgotpassword  text-right " style="display:block; white-space:nowrap;"><a href="<?php echo  $this->app->createUrl('user/forgot_password'); ?>" onclick="easyload(this,event,'pajax')" class="link_color text-right"><?php echo $this->tag->getTag('forgot_password?', 'Forgot Password?'); ?></a></span>

				</div>
			</div>

			<div class="clearfix"></div>
			<div class="form-group  margin-bottom-5">

				<div class="row">

					<div class="col-sm-12">

						<div class="form-group  margin-bottom-0 ">
							<div class="row">

								<div class="col-sm-12">
									<input type="hidden" name="next" value="" />
									<input type="hidden" name="form_type" value="login" />
									<input type="hidden" name="login" value="1" />
									<button type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n"  id="bb" style=" clear: both;width:100%;max-width:100% !important;"><?php echo $signin_text; ?></button>
									<?php
									if ($this->app->options->get('system.common.disable_login_otp', 'yes') == 'no') { ?>
										<a href="<?php echo Yii::app()->createUrl('user/signin_phone'); ?>" onclick="easyload(this,event,'pajax')" class="bld-link2">Login with Mobile Number?</a>
									<?php } ?>
								</div>
							</div>
						</div>


					</div>
				</div>


			</div>
		</div>
		<div class="pop_boxone">
			<?php
			$min_error_count  = 1;

			$min_error_count  = 2;
			?>
			<div class="form-group">
				<div class="clearfix"></div>

				<div class="clearfix"></div>
				<?php echo $form->hiddenField($user, '_recaptcha'); ?>
				<?php echo $form->error($user, '_recaptcha', array('style' => 'top:0px !important;')); ?>
			</div>
			<div class="clearfix"></div>
		</div>

		<?php $this->endWidget(); ?>
		<!-- <div class="clear_div"></div> -->
		<!-- <p class="" style="margin-bottom: 8px; margin-top: 8px; overflow: hidden; text-align: center; font-size: 14px; color: rgb(51, 51, 51); font-weight: bold;"><?php echo $this->tag->getTag('or', 'OR'); ?></p> -->

		<!-- <a href="javascript:void(0)" data-href="<?php echo Yii::app()->createUrl('site/login', array('service' => 'apple')); ?>" onclick="popitup('6')" class="rounded-btn-n apl"><?php echo $this->tag->getTag('login_with_apple', 'Sign in with Apple'); ?></a> -->
		<!-- <a href="javascript:void(0)" data-href="<?php echo Yii::app()->createUrl('site/login', array('service' => 'facebook')); ?>" onclick="popitup('2')" class="rounded-btn-n margin-top-0 fbl"><?php echo $this->tag->getTag('login_with_facebook', 'Login with Facebook'); ?></a> -->
		<!-- <a href="javascript:void(0)" data-href="<?php echo Yii::app()->createUrl('site/login', array('service' => 'google_oauth')); ?>" onclick="popitup('1')" class="rounded-btn-n gpl"><?php echo $this->tag->getTag('login_with_google', 'Login with Google'); ?></a> -->

	</div>


	<script>
		function popitup(k) {
			parent.OpenWindow(k);
		}
	</script>