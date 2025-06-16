<style>
	.pwdstrength {
		position: absolute;
	}

	#ListingUsers_password {
		position: relative;
	}

	.pwdstrengthstr {
		position: absolute;
		top: -19px;
		right: 3px;
	}
</style>

<style>
	.isOnFram .sign-in-form .form-group {
		margin-bottom: 10px;
	}

	.isOnFram .container.card-1 {
		margin-top: 0px;
	}
</style>


<?php
$register = $this->tag->getTag('register', 'Register');
$Validating = $this->tag->getTag('validating', 'Validating..');
$please_wait = $this->tag->getTag('please_wait', 'Please wait..');
$form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl("user/signup", array('return' => @$return, 't' => 'c')),
	'id' => 'signin-form',
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

	$("html, body").animate({
scrollTop: form.find(".errorMessage:visible:first").offset().top-50
}, 2000);

	form.find("#bb").html("' . $register . '");
	return false;
}
else
{
	form.find("#bb").html("' . $please_wait . '");	return true;
}
}',


	),
	'htmlOptions' => array('autocomplete' => 'off', 'class' => 'recapt', 'style' => 'max-width:280px;margin:auto;')
));  ?>

<div class="form-group  ">
	<?php if (Yii::app()->user->hasFlash('registered')): ?>
		<div class="alert alert-success text-center">
			<?php echo Yii::t('app', 'Registration successful. Please check your email to verify your account.'); ?>
		</div>
	<?php endif; ?>

	<?php if (Yii::app()->user->hasFlash('registerfail')): ?>
		<div class="alert alert-danger">
			<?php echo Yii::app()->user->getFlash('registerfail'); ?>
		</div>
	<?php endif; ?>

	<div class="row">


		<div class="col-sm-12">

			<?php echo $form->textField($model, 'first_name',  $model->getHtmlOptions('first_name', array('class' => 'input-text LJB smllinput form-control', 'placeholder' => $this->tag->getTag('full_name_*', 'Full Name *'))));  ?>

			<?php echo $form->error($model, 'first_name'); ?>

		</div>

	</div>
</div>

<div class="clear"></div>

<div class="form-group  ">

	<div class="row">


		<div class="col-sm-12">

			<?php echo $form->textField($model, 'email',  $model->getHtmlOptions('email', array('class' => 'input-text LJB smllinput form-control', 'placeholder' => $this->tag->getTag('email', 'Email *'), 'onkeyup' => 'return emailCase(this)')));  ?>

			<?php echo $form->error($model, 'email'); ?>

		</div>

	</div>

</div>
<div class="clearfix"></div>
<div class="form-group  ">

	<div class="row">


		<div class="col-sm-12">

			<?php echo $form->textField($model, 'phone',  $model->getHtmlOptions('phone', array('class' => 'input-text  LJB smllinput form-control', 'placeholder' => '', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');")));  ?>

			<?php echo $form->error($model, 'phone'); ?>

		</div>

	</div>
</div>
<style>
	.iti {
		position: relative;
		display: inline-block;
		width: 100% !important;
	}

	#ListingUsers_phone {
		direction: ltr;
		unicode-bidi: embed;
	}

	#ListingUsers_con_password_em_ {
		white-space: nowrap;
	}
</style>
<div class="form-group hide ">

	<div class="row">

		<div class="col-sm-5"><?php echo $form->labelEx($model, 'mobile'); ?></div>

		<div class="col-sm-7">

			<?php echo $form->textField($model, 'mobile',  $model->getHtmlOptions('mobile', array('class' => 'input-text form-control', 'placeholder' => '')));  ?>

			<?php echo $form->error($model, 'mobile'); ?>

		</div>

	</div>
</div>


<div class="clearfix"></div>

<div class="form-group mb-3">
	<div id="ListingUsers_password"></div>
	<?php echo $form->error($model, 'password'); ?>
</div>

<!-- Confirm Password -->
<div class="form-group mb-3">
	<?php echo $form->passwordField($model, 'con_password', $model->getHtmlOptions('con_password', [
		'class' => 'form-control LJB smllinput',
		'placeholder' => $this->tag->getTag('password_*', 'Confirm Password *'),
		'id' => 'ListingUsers_con_password_input'
	])); ?>
	<?php echo $form->error($model, 'con_password'); ?>
</div>


<div class="form-group  ">

	<div class="row">
		<?php
		$user_type_array = $model->getUserType();
		unset($user_type_array['U']);
		unset($user_type_array['A']);
		// 	if(!Yii::App()->request->isPostRequest and empty($model->user_type)){$model->user_type = 'U';}
		?>

		<div class="col-sm-12">

			<?php echo $form->dropDownList($model, 'user_type', $user_type_array,  $model->getHtmlOptions('user_type', array('class' => 'input-text form-control  LJB smllinput',  "empty" => $this->tag->gettAg('registered_as_*', "Registered as *"), 'onchange' => 'selectDetailFields(this)')));  ?>

			<?php echo $form->error($model, 'user_type'); ?>

		</div>

	</div>
</div>

<div class="clearfix"></div>
<div class="pop_boxone">
	<?php
	$min_error_count  = 1;
	$min_error_count  = 2;
	?>
	<div class="form-group">
		<div class="clearfix"></div>
		<script>


		</script>


		<div class="clearfix"></div>
		<?php echo $form->hiddenField($user, '_recaptcha'); ?>
		<?php echo $form->error($user, '_recaptcha', array('style' => 'top:0px !important;')); ?>
	</div>
	<div class="clearfix"></div>
</div>

<div class="clearfix"></div>

<div class="clear"></div>
<div class="checkboxes">
	<label class="container_check" for="<?php echo $model->modelName; ?>_agree" style="line-height: 1.3 !important;font-size: 11px !important;"><?php echo Yii::t('app', $this->tag->getTag('agree_to_the_{link1}_and_the_{', 'I Agree to the {link1} and the {link2}'), array('{link1}' => '<a href="' . Yii::app()->createUrl('terms') . '" target="_blank" class="link_color">  ' . $this->tag->getTag('terms_and_conditions', 'Terms and Conditions') . '</a>', '{link2}' => '<a href="' . Yii::app()->createUrl('privacy') . '" target="_blank" class="link_color"> ' . $this->tag->getTag('privacy_policy', 'Privacy Policy') . '</a>')); ?>
		<?php echo $form->checkBox($model, 'agree',  $model->getHtmlOptions('agree'));  ?>
		<span class="checkmark"></span>
	</label>
	<?php echo $form->error($model, 'agree'); ?>
</div>

<div class="clear"></div>

<div class="form-group  margin-bottom-0 ">

	<div class="row">


		<div class="col-sm-12">

			<button type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n" id="bb" style="margin-top:20px;width:100%;max-width: 100% !important;"><?php echo $register; ?></button>

		</div>
	</div>
</div><!-- end #signin-form -->


<?php $this->endWidget(); ?>
<script>
	var modelName = '<?php echo $model->modelName; ?>'

	function selectDetailFields(k) {
		if ($(k).val() == 'U' || $(k).val() == '') {
			$('.openWhenUserType').addClass('hide');
		} else {
			$('.openWhenUserType').removeClass('hide');
		}
	}
</script>
<script type="text/javascript">
	$(function() {
		var pwdwidget = new PasswordWidget('ListingUsers_password', 'ListingUsers[password]');
		pwdwidget.MakePWDWidget();
	})
</script>
<script>
	$(function() {
		var input = document.querySelector("#ListingUsers_phone");
		window.intlTelInput(input, {
			// allowDropdown: false,
			// autoHideDialCode: false,
			// autoPlaceholder: "off",
			// dropdownContainer: document.body,
			// excludeCountries: ["us"],
			// formatOnDisplay: false,
			// geoIpLookup: function(callback) {
			//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
			//     var countryCode = (resp && resp.country) ? resp.country : "";
			//     callback(countryCode);
			//   });
			// },
			hiddenInput: "full_number",
			initialCountry: "<?php echo COUNTRY_CODE; ?>",
			// localizedCountries: { 'de': 'Deutschland' },
			// nationalMode: false,
			// onlyCountries: ['<?php echo COUNTRY_CODE; ?>'],
			placeholderNumberType: "MOBILE",
			// preferredCountries: ['cn', 'jp'],
			separateDialCode: true,
			utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js'); ?>",
		});
	})
	$(function() {
		setTimeout(function() {
			$('#ListingUsers_password').find('input').attr('placeholder', '<?php echo $this->tag->getTag('password_*', 'Password *'); ?>');
			$('#ListingUsers_password').find('input').addClass('form-control LJB smllinput');
		}, 300);

	})
</script>
<style>
	.pwdopsdiv {
		display: none;
	}

	.pwdstrengthstr,
	.pwdstrength {
		height: auto;
	}
</style>