<script
	src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/global/global.min.js'); ?>"
	type="text/javascript"></script>
<div hidden>
	<svg id="add-button" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
		<g>
			<g xmlns="http://www.w3.org/2000/svg" id="_x33_">
				<path d="m18 2c2.206 0 4 1.794 4 4v12c0 2.206-1.794 4-4 4h-12c-2.206 0-4-1.794-4-4v-12c0-2.206 1.794-4 4-4zm0-2h-12c-3.314 0-6 2.686-6 6v12c0 3.314 2.686 6 6 6h12c3.314 0 6-2.686 6-6v-12c0-3.314-2.686-6-6-6z" fill="currentColor" data-original="currentColor"></path>
			</g>
			<g xmlns="http://www.w3.org/2000/svg" id="_x32_">
				<path d="m12 18c-.552 0-1-.447-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10c0 .553-.448 1-1 1z" fill="currentColor" data-original="currentColor"></path>
			</g>
			<g xmlns="http://www.w3.org/2000/svg" id="_x31_">
				<path d="m6 12c0-.552.447-1 1-1h10c.552 0 1 .448 1 1s-.448 1-1 1h-10c-.553 0-1-.448-1-1z" fill="currentColor" data-original="currentColor"></path>
			</g>
		</g>
	</svg>
	<svg id="cls-close" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" x="0" y="0" viewBox="0 0 311 311.07733" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
		<g>
			<path xmlns="http://www.w3.org/2000/svg" d="m16.035156 311.078125c-4.097656 0-8.195312-1.558594-11.308594-4.695313-6.25-6.25-6.25-16.382812 0-22.632812l279.0625-279.0625c6.25-6.25 16.382813-6.25 22.632813 0s6.25 16.382812 0 22.636719l-279.058594 279.058593c-3.136719 3.117188-7.234375 4.695313-11.328125 4.695313zm0 0" fill="currentColor" data-original="currentColor" class=""></path>
			<path xmlns="http://www.w3.org/2000/svg" d="m295.117188 311.078125c-4.097657 0-8.191407-1.558594-11.308594-4.695313l-279.082032-279.058593c-6.25-6.253907-6.25-16.386719 0-22.636719s16.382813-6.25 22.636719 0l279.058594 279.0625c6.25 6.25 6.25 16.382812 0 22.632812-3.136719 3.117188-7.230469 4.695313-11.304687 4.695313zm0 0" fill="currentColor" data-original="currentColor" class=""></path>
		</g>
	</svg>
</div>
<?php
if (isset($_GET['type']) and !empty($_GET['type'])) {
	if ($_GET['type'] == 'business') {
		$titpe = $this->tag->getTag('submit_business', 'Submit Business');
	} else {
		$titpe = $this->tag->getTag('submit_property', 'Submit Property');
	}
?>
	<style>
		html #place_an_ad .place-property {
			padding: 0px 13px;
			box-shadow: 0 1px 6px 0 rgba(32, 33, 36, 0.28) !important;
			border-radius: 10px;
		}

		#post-property {
			margin-top: -71px;
			z-index: 1;
			position: relative;
		}

		html .place_ad {
			min-height: 300px;
		}

		.place_ad {
			min-height: 400px;
		}

		#place_an_ad {
			margin-top: 0px !important;
		}

		html .subheading_font {
			background: #eee;
			color: #333 !important;
			padding-top: 15px;
			padding-bottom: 15px;
		}

		#mainContainerClass {
			width: 100%;
			max-width: 100%;
		}

		.tp_banner {
			height: 150px;
			background-color: var(--secondary-color);
			color: #fff;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 50px;
		}

		.tp_banner .h2 {
			color: #fff
		}

		.site-block {
			background: #fff;
			height: 100px;
			border: 1px solid #EEE;
			border-radius: 6px;
			color: #2B2D2E;
			display: -ms-flexbox;
			-js-display: flex;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
			-ms-flex-pack: center;
			justify-content: center;
		}

		.site-block h1 {
			margin: 0;
			font-weight: 600;
			font-size: 16px;
			line-height: 20px;
		}

		.site-block:hover {
			border: 1px solid var(--secondary-color);
			color: var(--secondary-color);
			box-shadow: 0 20px 40px 0 rgba(0, 0, 0, .1);
		}

		.site-block:hover h1 {

			color: var(--secondary-color) !important;

		}

		.site-blocks-wrapper>li {
			padding: 8px;
		}

		.site-blocks-wrapper {
			max-width: 800px;
			margin: auto;
			position: relative;
			top: -100px;
		}

		.banner {
			margin-left: -15px;
			margin-right: -15px;
			width: calc(100% + 30px);
			position: relative;
			height: 20.56vw;
			background-color: rgba(0, 0, 0, 0.8);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			margin-bottom: 0px;
		}

		.abs-banner {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			color: #fff;
			z-index: 1;
			content: '';
			background: rgba(0, 0, 0, 0.2);
		}

		.bloghead {
			align-items: center;
			justify-content: center;
			height: 100%;
			flex-direction: column;
			font-weight: 300;
			display: flex;
			z-index: 1;
			position: relative;
		}

		.fancy-title {
			color: #fff;
			font-size: 33px;
			font-weight: 900;
			text-shadow: 1px 1px #000;
			margin-bottom: 0px;
			padding: 0px;
		}
	</style>
	<section class="panel1 panel-bg banner" style="background-image:url(<?php echo $img; ?>);">
		<div class="abs-banner">
			<div class="bloghead container">
				<div class="fancy-title-hold text-initial clearfix">
					<h3 class="fancy-title animate animated"><span class="title"><?php echo $titpe; ?></span></h3>
				</div>
			</div>
		</div>
	</section>
<?php

}
?>
<style>
	.cls-closebtn {
		display: none;
	}

	.amn .form-check {
		display: none;
	}

	.amn .op-d h4.spl-headd {
		font-size: 29px;
		margin: 24px 7px !important;
	}

	.amn .op-d .cls-closebtn {
		display: block;
		color: red;
		position: fixed;
		right: 50px;
	}

	.amn .op-d .cls-closebtn svg {
		width: 50px;
		height: 50px;
	}

	.amn .op-d .parent-h-div {
		max-width: 800px;
		margin: auto;
	}

	.amn .op-d .button_icon-style5 {
		display: none;
	}

	.amn .op-d {
		position: fixed;
		left: 0px;
		right: 0px;
		top: 0px;
		bottom: 0px;
		width: 100%;
		height: 100vh;
		background: #fff;
		z-index: 111;
		min-height: 100vh;
		overflow-y: scroll;
	}

	.amn .op-d .form-check {
		display: block;
	}

	.amn .spl-headd {
		color: #00699e;
		cursor: pointer;
	}

	.amn .spl-headd svg {
		width: 20px;
		height: 20px;
		margin-left: 15px;
	}

	.bg-bk.card-1 {

		box-shadow: unset !important;
	}

	.bg-bk {

		width: 100% !important;
	}

	#place_an_ad .place-property {
		max-width: 650px !important;
		box-shadow: unset !important;
		border: 1px solid #eee !important;
		width: 100% !important;
	}

	.d-flex {
		display: flex;
	}

	#place_an_ad .row label.or-labels {
		display: flex;
		align-items: center;
		justify-content: center;
	}

	#place_an_ad .form-control {

		height: 33px;
		text-indent: 7px;
		padding-top: 0px;
		padding-bottom: 0px;
	}

	#place_an_ad .btn.btn-default {
		background: #fff !important;
	}

	font-family: var(--main-font);
	background: #fff;
	/* border: 1px solid  var(--logo-color); */
	}

	#place_an_ad .place-property.sector1 {

		box-shadow: unset !important;
		border: 1px solid #eee !important;
	}

	html .inputGroup span.img {
		display: none !important;
	}

	#place_an_ad .col-sm-12 textarea.form-control {

		border: 1px solid #dfe0e3;
	}

	#place_an_ad .form-control {

		border-color: #dfe0e3;
		border: 1px solid #eee;
	}

	::placeholder {
		/* Chrome, Firefox, Opera, Safari 10.1+ */
		color: #2f2f2f !important;
		opacity: 1;
		/* Firefox */
	}

	:-ms-input-placeholder {
		/* Internet Explorer 10-11 */
		color: #2f2f2f !important;
	}

	::-ms-input-placeholder {
		/* Microsoft Edge */
		color: #2f2f2f !important;
	}

	#member .select2-container .select2-selection--single,
	#place_an_ad .select2-container .select2-selection--single {
		height: 25px;
	}

	.ui-datepicker-year {
		padding: 0px !important;
	}

	.textFields input {
		text-align: unset !important;
	}

	#member .select2-container--default .select2-selection--single .select2-selection__rendered,
	#place_an_ad .select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 23px;
	}

	td.del-ro {
		padding-left: 0px !important;
		padding-right: 0px !important;
	}

	.insinert .select2 {
		width: 88px !important;
	}

	html .select2 {
		max-width: 192px !important;
	}

	#select2-PlaceAnAd_area_unit-container,
	#select2-PlaceAnAd_area_unit_1-container {
		font-size: 12px;
	}

	[id^="select2-PlaceAnAd_state"] li:first-child {
		display: block !important;
	}

	[id^="select2-PlaceAnAd_area_unit"] li:first-child {
		display: block !important;
	}

	[id^="select2-PlaceAnAd_rent_paid-result"] li:first-child {
		display: block !important;
	}

	[id^="select2-video_urls"] li.select2-results__option:first-child {
		display: block !important;
	}

	[id^="select2-amenities"] li.select2-results__option:first-child {
		display: block !important;
	}

	#place_an_ad .insinert .select2-container .select2-selection--single {
		height: 24px;
	}

	#place_an_ad .insinert .select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 22px;
	}

	.insinert .select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 24px;
		line-height: 24px
	}

	#place_an_ad .myaccount-menu.is-ended {
		display: none !important;
	}

	@media only screen and (max-width: 600px) {
		.mem_arae {
			padding-bottom: 0px;
		}
	}

	html[dir="rtl"] .select2-container--default .select2-selection--single .select2-selection__arrow b::before {

		top: -11px;

	}

	.insinert .form-control {
		padding: 0px 7px;
		font-size: 13px !important;
		height: 24px;
	}

	td a {

		max-width: unset !important;
	}

	.select2-dropdown {
		background-color: white;
		border: 1px solid #dadada;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 22px;
	}

	#member .select2-container--default .select2-selection--single .select2-selection__rendered,
	#place_an_ad .select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 21px;
	}

	.select2-results__option {
		padding: 2px 6px;

	}

	li.select2-results__option:first-child {
		display: none;
	}

	html[dir="rtl"] svg.right_svg {
		left: 10px !important;
		right: unset !important;
		transform: rotate(180deg);
	}

	html[dir="rtl"] .listli .inputGroup label {
		padding: 8px 46px 8px 30px;
	}

	html[dir="rtl"] .inputGroup span.img {
		right: 7px;
		left: unset;
	}

	html[dir="rtl"] .form-check .form-check-label input,
	html[dir="rtl"] .form-radio .form-check-label input {
		right: 0;
		left: unset;
	}

	.form-check .form-check-label .input-helper::before {
		top: 8px;
	}

	._3IhNg li:first-child::after {

		background-color: #f27f52 !important;
		color: #fff !important;
	}

	h4.spl-headd {
		font-size: 17px;
	}

	._3IhNg li:first-child::after {
		content: '<?php echo $this->tag->getTag('cover', 'Cover'); ?>' !important;
	}

	.coverimg {
		display: none !important;
		width: 78%;
		height: 25px;
		background-color: var(--secondary-color);
		display: block;
		z-index: 1111111;
		position: absolute;
		bottom: 7px;
		color: #fff !important;
		text-align: center;
		left: 10px;
		right: 10px;
		text-transform: uppercase;
		font-weight: 500;
		text-decoration: none !important;
	}

	li:hover .coverimg {
		display: block !important;
		background-color: #fad440;
		color: #333 !important;
	}

	._3IhNg li:first-child .coverimg {
		display: block !important;
	}

	._3IhNg li:first-child:hover .coverimg {
		display: none !important;
	}
</style>
<script>
	var modelName = '<?php echo $model->modelName; ?>';
	var sectid = '<?php echo $model->section_id; ?>';
	var business_url = '<?php echo Yii::app()->createUrl($this->id . '/create_business'); ?>';
	var cName = '<?php echo defined('COUNTRY_NAME') ? COUNTRY_NAME : ""; ?>';
	var suggestionst = '<?php echo $this->tag->getTag('suggestions', 'Suggestions'); ?>';
	var in_text = '<?php echo $this->tag->getTag('in', 'in'); ?>';
	var cityUrl = '<?php echo YIi::App()->createUrl($this->id . '/getCityId'); ?>';
	var customer_url = '<?php echo Yii::app()->createUrl('place_an_ad/Customer'); ?>';
</script>

<script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/place_ad_script.js?q=65'); ?>"></script>
<script>
	console.log(1);
</script>
<?php defined('MW_PATH') || exit('No direct script access allowed');
if ($this->id == 'update_property') {
	if ($this->functionality == 'picture') {
?>
		<style>
			.full-content {
				display: none !important;
			}
		</style>
	<?php
	}
}
if ($model->isNewRecord and $this->action->id != 'preview' and empty($model->ad_title)) {
	echo '<script>var isnewrecord= 1; </script>';
}

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
	'controller'    => $this,
	'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
	/**
	 * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
	 * Please note that from inside the action callback you can access all the controller view variables 
	 * via {@CAttributeCollection $collection->controller->data}
	 * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
	 * in order to stop rendering the default content.
	 * @since 1.3.3.1
	 */
	$hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
		'controller'    => $this,
		'renderForm'    => true,
	)));

	// and render if allowed
	if ($collection->renderForm) {
		$mainText = $this->tag->getTag('submit_property', 'Submit Property');
		$Validating = $this->tag->getTag('validating', 'Validating..');
		$please_wait = $this->tag->getTag('please_wait', 'Please wait..');
		$form = $this->beginWidget('CActiveForm', array(
			'focus' => array($model, Yii::app()->controller->focus),
			'enableAjaxValidation' => true,
			'id' => 'post-property',
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
        scrollTop: form.find(".errorMessage:visible:first").offset().top-110
    }, 2000);
						
							form.find("#bb").html("' . $mainText . '");
							return false;
					}
					else
					{
							form.find("#bb").html("' . $please_wait . '");	return true;
					}
					}',


			),
			'htmlOptions' => array('autocomplete' => 'off')
		));  ?>
		<style>
			.jqx-combobox-content {
				text-indent: 4px;
			}

			span#selected_text,
			.only-no-sector a {
				font-size: 14px !important;
				font-weight: 600;
			}

			.r-detail-c {
				margin-top: 15px;
			}

			#place_an_ad .place-property {

				border: 0px solid rgba(0, 47, 52, .2);
				-webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
				-moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
				box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
			}

			#place_an_ad .place-property {
				max-width: 550px;
			}

			.subheading_font {
				background: #ededed;
				padding: 5px 15px;
				font-size: 17px !important;
				vertical-align: middle;
				color: #72727d !important;
				margin-bottom: 1rem;
			}

			#place_an_ad h3.box-title {

				margin-bottom: 20px;
				font-family: var(--main-font) !important;
				font-weight: 700;
				font-size: 24px;
				text-align: initial;
				line-height: inherit;
				text-transform: initial;
				padding: 5px 0px;
				margin-bottom: 0px;

			}

			#place_an_ad .place-property.sector1 {


				padding: 0px 13px;

			}

			@media only screen and (max-width: 600px) {}

			h3.box-title {

				color: #72727d !important;
				font-weight: 600 !important;
				font-size: 25px;
				line-height: 47px;
				height: auto;
				vertical-align: middle;

			}

			#place_an_ad ._1ybgv {
				width: 100%;
				padding: 0 0 10px;
			}

			#place_an_ad .place-property {
				padding: 0px 13px;
			}

			#place_an_ad .rui-3blDo {
				padding-left: 0px;
			}

			#place_an_ad .insidecontent {
				padding-left: 0px;
				padding-right: 0px;
				padding-top: 15px;
				padding-bottom: 15px;
			}

			#place_an_ad ._2ytqd {

				box-sizing: border-box;
				border-bottom: 1px solid rgba(0, 47, 52, .2);
				float: none;
				height: 0;
				width: auto;
				margin-left: -13px;
				margin-right: -13px;
				clear: both;
				display: block;

			}

			#place_an_ad .row label {
				color: #72727d !important;
				font-weight: 400;
			}

			#place_an_ad .form-control {
				color: #72727d;
				font-weight: 400;
				border-color: #dfe0e3;
			}

			#place_an_ad .minimize_form {
				max-width: 100% !important;
			}

			.amn1 {
				/* margin-left: -15px;

				margin-right: -15px; */
			}

			#place_an_ad .amn1 .amn {
				max-height: initial;

			}

			#moredetails .col-sm-5 label::after {

				content: ':';
				display: inline-block;
				margin-left: 10px;

			}

			.rui-qvKkT1 {

				color: rgba(0, 47, 52, .64);
				font-size: 11px;
				font-weight: 400;
				display: inline-block !important;
				float: none;
				line-height: 24px;
				padding-left: 10px;

			}

			.form-check .form-check-label,
			.form-radio .form-check-label {

				padding-left: 9px;
				line-height: 1.2;
			}
		</style>

		<div class="box box-primary place_ad place-property <?php echo $model->isNewRecord ? 'sector1' : 'sector2'; ?>">
			<h3 class="box-title hide"><?php echo $model->isNewRecord ? 'Post your Property' : 'Update your Property'; ?></h3>
			<div class="box-header">



				<div class="clearfix"><!-- --></div>
			</div>
			<div class="box-body <?php echo $model->category_id == '121' ? 'land-prop' : ''; ?>" id="boxdy">
				<div class="spinner rmsdf">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
				</div>
				<?php
				/**
				 * This hook gives a chance to prepend content before the active form fields.
				 * Please note that from inside the action callback you can access all the controller view variables 
				 * via {@CAttributeCollection $collection->controller->data}
				 * @since 1.3.3.1
				 */
				$hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
					'controller'    => $this,
					'form'          => $form
				)));
				?>
				<style>
					.select2 {
						width: 100% !important;
					}

					.subhead {
						background-color:
							#008000;
						border-radius: 3px;
						clear: both;
						color:
							#ffffff;
						float: left;
						margin-bottom: 7px;
						margin-top: 8px;
						padding: 7px 0;
						text-indent: 9px;
						text-transform: uppercase;
						width: calc(100% - 15px);
						margin-top: 25px;
					}

					.dropzone {

						min-height: 160px;
						background:
							#fafafa;

					}

					@media only screen and (max-width: 600px) {

						#place_an_ad ._1ybgv.full-content,
						#place_an_ad ._1ybgv.full-content .rui-3blDo {
							display: block;
						}
					}

					.only-no-sector {
						display: none;
					}

					#section_picker.open-second .sect_select {
						display: block;
					}

					#section_picker.open-second .only-no-sector {
						display: none;
					}

					.hide {
						display: none !important;
					}

					.hidden {
						display: none !important;
						visibility: hidden !important;
					}
				</style>



				<div id="section_picker">
					<div class="insidecontent  padding-top-0">

						<h4 class="subheading_font row " style="display: block;"><?php echo $this->tag->gettag('choose_a_category', 'Choose a Category'); ?> <?php if (Yii::app()->isAppName('frontend')) { ?> <a href="<?php $refref = Yii::app()->request->urlReferrer;
																																																						echo  !empty($refref) ? $refref : Yii::app()->createUrl('site/index'); ?>" class="pull-right margin-right-10"><?php echo $this->tag->getTag('back', 'Back'); ?></a> <?php } ?> </h4>

						<div class="col-sm-12 picker_class sect_select ">

							<div class="clearfix"><!-- --></div>
							<h3 class="subHeadh2 ain padding-bottom-15 "><span class="only-no-sector11 pull-left"><?php echo $this->tag->gettag('select_category', 'Select Category'); ?></span> <span class="pull-right only-no-sector"><span id="selected_text"></span></span>
								<div class="clearfix"></div>
							</h3>

							<div class="clearfix"><!-- --></div>
							<div class="listli sector_details sector1">
								<?php
								if (isset($_GET['type']) and !empty($_GET['type'])) {
									if ($_GET['type'] == 'business') {
										$section = array('6' => '<span class="img"></span>' . $this->tag->getTag('business_for_sale', 'Business Opportiunities'));
									} else {
										$section = array('1' => '<span class="img"></span>' . $this->tag->getTag('for_sale', 'For Sale'), '2' => '<span class="img"></span>' . $this->tag->getTag('for_rent', 'For Rent'));
									}
								} else {
									$section = array('1' => '<span class="img"></span>' . $this->tag->getTag('for_sale', 'For Sale'), '2' => '<span class="img"></span>' . $this->tag->getTag('for_rent', 'For Rent'), '6' => '<span class="img"></span>' . $this->tag->getTag('business_for_sale', 'Business Opportiunities'));
								}
								echo CHtml::radioButtonList('section_id', $model->section_id, $section, array(
									'data-url' => Yii::App()->createUrl($this->id . '/select_category3'),
									'onclick' => 'load_via_ajax_category(this,"category_id")',
									'separator' => '',
									'labelOptions' => array('class' => ''),
									'template' => '<div class="inputGroup" id="sec_{idInput}">   {input}   {label} <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg><div class="clearfix"><!-- --></div></div>'
								));
								?>
							</div>
							<div class="clearfix"><!-- --></div>

							<div class="col-sm-12 sector1 picker_class no-padding w_for <?php echo ($model->section_id == '4') ?  '' : 'hide'; ?>">
								<div class="clearfix"><!-- --></div>

								<div class="clearfix"><!-- --></div>



								<div class="listli  sector_details">

									<?php

									echo CHtml::radioButtonList('w_for', $model->w_for, $model->wanted_for(), array(
										'onclick' => 'openFields2(this)',
										'separator' => '',
										'labelOptions' => array('class' => ''),
										'template' => '<div class="inputGroup">{input}   {label} <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg><div class="clearfix"><!-- --></div></div>'
									));
									?>


								</div>


							</div>

						</div>


						<div id="<?php echo $model->modelName . '_l_type_main_div'; ?>" class="col-sm-12 margin-top-15  picker_class  l_type <?php echo  empty($model->section_id) ?  'hidden' : ''; ?>">
							<div class="clearfix"><!-- --></div>

							<div class="clearfix"><!-- --></div>



							<div class="listli sector3 sector_details">

								<?php
								/*
									echo CHtml::radioButtonList('listing_type',$model->listing_type,$list_type,array('data-url'=>Yii::App()->createUrl($this->id.'/select_category3'),'onchange'=>'load_via_ajax_category(this,"category_id")' ,'separator'=>'','labelOptions'=>array('class'=>'')
									,'template'=>'<div class="inputGroup" id="l_type_{idInput}"><span class="img"></span> {input}  <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg>  {label}<div class="clearfix"><!-- --></div></div>'));                                              
									
									*/
								?>
								<?php
								$list_typeq =    Category::model()->ListDataForJSON_ID_BySEctionNew($model->section_id);

								echo CHtml::radioButtonList('listing_type', $model->listing_type, $list_typeq, array(
									'separator' => '',
									'onclick' => 'load_via_ajax_main_category(this)',
									'data-url' => Yii::App()->createUrl($this->id . '/select_category4'),
									'separator' => '',
									'labelOptions' => array('class' => ''),
									'template' => '<div class="inputGroup">{input}   {label} <span class="img"></span> <svg class="right_svg" width="25px" height="25px" viewBox="0 0 1024 1024" data-aut-id="icon" fill-rule="evenodd"><path class="rui-vUQO_" d="M456.533 170.667h-76.8v72.533l268.8 268.8-268.8 268.8v72.533h76.8l341.333-341.333-341.333-341.333z"></path></svg></div>'
								));
								?>


							</div>


						</div>
						<?php
						$catlist =  Category::model()->ListDataForJSON_ID_ByListingType($model->listing_type);
						$m_class = empty($catlist) ? 'hidden' : '';
						?>
						<div class="col-sm-12 picker_class c_type <?php echo $m_class; ?>" id="<?php echo $model->modelName . '_category_id_main_div'; ?>">
							<div class="clearfix"><!-- --></div>

							<div class="clearfix"><!-- --></div>

							<style>
								.listli.r-detail-c .inputGroup input:checked~label::after {
									content: unset;
									background: #fff;
									position: absolute;
									right: 10px;
									width: 26px;
									height: 20px;
									line-height: 20px;
									vertical-align: middle;
									padding: 0px 5px;
									background: var(--logo-color);
									color: #fff;
									border-radius: 5px;
									z-index: 11;
									font-size: 12px;
								}

								label span.required {
									font-size: 14px !important;
								}

								#member .select2-container--default .select2-selection--single,
								#place_an_ad .select2-container--default .select2-selection--single {
									border: 1px solid #eee;
								}

								#place_an_ad .sector1 .picker_class {
									padding-left: 0;
									max-width: 300px;
									clear: both;
									margin: auto;
									float: none;
								}

								#suggest-main #suggestion-word {
									color: #000
								}

								li.suggest {
									border: 1px solid #eee;
									padding: 1px 10px;
									border-radius: 5px;
									margin-right: 10px;
									float: left;
									font-size: 11px;
									margin-bottom: 5px;
									line-height: 2
								}

								html[dir="rtl"] li.suggest {
									float: right;
								}
							</style>

							<div class="listli sector_details r-detail-c">

								<?php

								echo CHtml::radioButtonList('category_id', $model->category_id, $catlist, array(
									'separator' => '',
									'onclick' => 'validateInputSector()',
									'labelOptions' => array('class' => ''),
									'template' => '<div class="inputGroup">{input}   {label}</div>'
								));
								?>


							</div>


						</div>
						<div class="clearfix"><!-- --></div>
					</div>
					<div class="clearfix"><!-- --></div>
				</div>
				<div id="moredetails">

					<h4 class="subheading_font row  full-content" style="display:block;"><?php echo $this->tag->getTag('selected_category', 'Selected Category'); ?> <?php if (Yii::app()->isAppName('frontend')) { ?> <a href="<?php $refref = Yii::app()->request->urlReferrer;
																																																								echo  !empty($refref) ? $refref : Yii::app()->createUrl('site/index'); ?>" class="pull-right margin-right-10"><?php echo $this->tag->getTag('back', 'Back'); ?></a> <?php } ?></h4>
					<div class="_1ybgv full-content" data-aut-id="breadcrumb">
						<div class="rui-3blDo">
							<ol class="rui-1CmqM" id="textChanger"></ol>
						</div>
						<div><a class="_3OiU0"><span><a href="javascript:void(0)" style="font-weight: 600; " onclick="movingtoStep1()"><?php echo $this->tag->getTag('change', 'Change'); ?></a></span></a></div>
					</div>
					<div class="_2ytqd"></div>
					<div class="rui-2SwH7 rui-1JF_2">

						<div class="clearfix"><!-- --></div>

						<div class="insidecontent">
							<?php
							if ($this->id == 'update_property' and $this->functionality == 'picture') {
							?>
								<div class="col-sm-5 text-right" style="text-align: right;">
									<label for="PlaceAnAd_sub_category_id" class="required">Property</label>

								</div>

								<div class="col-sm-7">
									<?php echo $model->ad_title; ?>
								</div>
							<?php
							}
							?>
							<div class="minimize_form full-content">
								<!-- <div class="row for-land  form-group">
									<?php
									/* $sub_category =  CHtml::listData(Subcategory::model()->ListDataForCategory(121),'sub_category_id','sub_category_name'); */
									$sub_category = $model->subcategoriesarray();
									?>
									<div class="clearfix"><!-- </div>

									<div class="col-sm-5 text-right" style="text-align: right;">
										<label for="PlaceAnAd_sub_category_id" class="required"><?php echo $this->tag->getTag('subcategory', 'Subcategory'); ?> <span class="required">*</span></label>
									</div>
									<div class="col-sm-7">
										<?php $mer =  array_merge($model->getHtmlOptions('sub_category_id'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
										<?php echo $form->dropDownList($model, 'sub_category_id', $sub_category, $mer); ?>
										<?php echo $form->error($model, 'sub_category_id'); ?>
									</div>
								</div> -->
								<div class="row  form-group hide <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>">
									<?php
									if (!Yii::app()->request->isPostRequest and   empty($model->client_ref)) {
										$model->client_ref = date('ymdHis') . '-' . rand(1, 100);
									}
									?>

									<div class="col-sm-5 text-right" style="text-align: right;"> <?php echo $form->labelEx($model, 'client_ref'); ?></div>
									<div class="col-sm-7">
										<div class=" ">

											<?php echo $form->textField($model, 'client_ref', $model->getHtmlOptions('client_ref', array('placeholder' => '', 'class' => 'input-text form-control'))); ?>
											<span class="rui-qvKkT"></span>
											<?php echo $form->error($model, 'client_ref'); ?>
										</div>

									</div>
								</div>
								<div class="insidecontent full-content">
									<div class="clearfix"><!-- --></div>
									<?php $this->renderPartial('root.apps.frontend.new-theme.views.place_property._ad_location', compact('form')); ?>
									<div class="clearfix"><!-- --></div>

								</div>

								<div class="row  form-group  <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>">

									<div class="col-sm-5 text-right" style="text-align: right;">

										<?php echo $form->labelEx($model, 'RefNo'); ?>

									</div>
									<div class="col-sm-7">
										<?php $mer =  array_merge($model->getHtmlOptions('RefNo'), array('placeholder' => $this->tag->getTag('ref_no', 'Refrence No.'), 'class' => 'input-text  form-control')); ?>
										<?php echo $form->textField($model, 'RefNo',   $mer); ?>
										<?php echo $form->error($model, 'RefNo'); ?>
									</div>

								</div>
								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?> ">

									<div class="col-sm-5 text-right" style="text-align: right;">

										<?php echo $form->labelEx($model, 'Permit Number'); ?>

									</div>
									<div class="col-sm-7">
										<?php $mer =  array_merge($model->getHtmlOptions('PropertyID'), array('placeholder' => $this->tag->getTag('PropertyID', 'Permit No'), 'class' => 'input-text  form-control')); ?>
										<?php echo $form->textField($model, 'PropertyID',   $mer); ?>
										<?php echo $form->error($model, 'PropertyID'); ?>
									</div>
								</div>
								<div class="clearfix"><!-- --></div>

								<div class="row form-group">

									<div class="col-sm-12"> <?php echo $form->labelEx($model, 'ad_title'); ?>
										<?php
										if (Yii::App()->isAppName('backend')  and !$model->isNewRecord) {
											echo $model->getTranslateHtml('ad_title');
										}
										?>
									</div>
									<div class="col-sm-12">
										<style>
											html #PlaceAnAd_ad_title::placeholder {
												color: #b6b6b6 !important;
												opacity: 1;
												/* Firefox */
											}

											html #PlaceAnAd_ad_description::placeholder {
												color: #b6b6b6 !important;
												opacity: 1;
												/* Firefox */
											}
										</style>
										<?php echo $form->textField($model, 'ad_title', $model->getHtmlOptions('ad_title', array('placeholder' => '', 'dir' => 'auto', 'class' => 'input-text form-control', 'style' => 'width:100% !important'))); ?>
										<span class="rui-qvKkT"></span>
										<div class="text-warning small hide  pull-left"><?php echo Yii::t('app', $this->tag->getTag('recommanded_length_{s}{min}_-_', 'Recommanded length {s}{min} - {max}{e}'), array('{s}' => '<span dir="ltr" style="white-space:nowrap;">', '{e}' => '</span>', '{min}' => $model::TITL_MIN, '{max}' => $model::TITL_MAX));; ?></div>
										<div class="pull-right text-warning" style="font-size: 12px;"><span id="inputcounter"></span></div>
										<div class="clearfix"></div>
										<?php echo $form->error($model, 'ad_title'); ?>

									</div>
									<div id="suggest-main" class="col-sm-12">
										<ul id="option-suggest" class="" style="margin: 0;padding: 0;"></ul>
										<div class="clearfix"></div>
									</div>
								</div>

								<div class="clearfix"><!-- --></div>
								<div class="row">
									<div class="form-group col-lg-12">
										<div style="width:100%;height:15px;"></div>
										<?php echo $form->labelEx($model, 'ad_description'); ?>
										<?php
										if (Yii::App()->isAppName('backend') and !$model->isNewRecord) {
											echo $model->getTranslateHtml('ad_description');
										}
										?>
										<?php echo $form->textArea($model, 'ad_description', array_replace($model->getHtmlOptions('ad_description'), array("rows" => "12", 'dir' => 'auto', 'placeholder' => $this->tag->getTag('mention_the_key_feature_of_you', 'Mention the key feature of your property (short description of your property)')))); ?>
										<div class="text-warning small hide pull-left"><?php echo Yii::t('app', $this->tag->getTag('recommanded_length_{s}{min}_-_', 'Recommanded length {s}{min} - {max}{e}'), array('{s}' => '<span dir="ltr" style="white-space:nowrap;">', '{e}' => '</span>', '{min}' => $model::DESC_MIN, '{max}' => $model::DESC_MAX));; ?></div>
										<div class="pull-right text-warning" style="font-size: 12px;"><span id="inputcounter2"></span></div>
										<div class="clearfix"></div>
										<?php echo $form->error($model, 'ad_description'); ?>
									</div>
								</div>



								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>">
									<?php

									if ($model->checkFieldsShow2('builtup_area')) { ?>

										<div class="col-sm-5 text-right" style="text-align: right;">
											<?php echo $form->labelEx($model, 'builtup_area'); ?>
										</div>
										<div class="col-sm-7">
											<div style="width:50%;max-width: 95px;" class="pull-left margin-right-5">
												<?php $mer =  array_merge($model->getHtmlOptions('area_unit'), array('class' => 'input-text  form-control',)); ?>
												<?php echo $form->dropDownList($model, 'area_unit',  CHtml::listData(AreaUnit::model()->listData(), 'master_id', 'master_name'), $mer); ?>
												<?php echo $form->error($model, 'area_unit'); ?>
											</div>
											<div style="width:calc(50% - 5px);margin-right:0px; max-width:100px;" class="pull-left">
												<?php echo $form->textField($model, 'builtup_area', $model->getHtmlOptions('builtup_area', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'class' => 'input-text  form-control',))); ?>

												<?php echo $form->error($model, 'builtup_area'); ?>
												<div style="width:50%;margin-right:5px;float:left">
												</div>
												<div class="clearfix" style="width:100%;"><!-- --></div>

											</div>
										</div>
									<?php } ?>
								</div>
								<div class="clearfix"><!-- --></div>
								<div class="clearfix"><!-- --></div>

								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_in">
									<?php

									if ($model->checkFieldsShow2('interior_size')) { ?>

										<div class="col-sm-5 text-right" style="text-align: right;">
											<?php echo $form->labelEx($model, 'interior_size'); ?>
										</div>
										<div class="col-sm-7">
											<div style="width:50%;max-width: 95px;" class="pull-left margin-right-5">
												<?php $mer =  array_merge($model->getHtmlOptions('area_unit_1'), array('class' => 'input-text  form-control',)); ?>
												<?php echo $form->dropDownList($model, 'area_unit_1',  CHtml::listData(AreaUnit::model()->listData(), 'master_id', 'master_name'), $mer); ?>
												<?php echo $form->error($model, 'area_unit_1'); ?>
											</div>
											<div style="width:calc(50% - 5px);margin-right:0px; max-width:100px;" class="pull-left">
												<?php echo $form->textField($model, 'interior_size', $model->getHtmlOptions('interior_size', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'class' => 'input-text  form-control',))); ?>

												<?php echo $form->error($model, 'interior_size'); ?>
												<div style="width:50%;margin-right:5px;float:left">
												</div>
												<div class="clearfix" style="width:100%;"><!-- --></div>

											</div>
										</div>
									<?php } ?>
								</div>
								<div class="clearfix"><!-- --></div>
								<div class="row  form-group bedroomsclass <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_bd">
									<?php
									if ($model->checkFieldsShow2('bedrooms')) { ?>
										<div class="col-sm-5 text-right" style="text-align: right;">

											<?php echo $form->labelEx($model, 'bedrooms'); ?>

										</div>
										<div class="col-sm-7">
											<?php $mer =  array_merge($model->getHtmlOptions('bedrooms'), array('empty' => $this->tag->getTag('select', 'Select'), 'class' => 'input-text  form-control')); ?>
											<?php echo $form->dropDownList($model, 'bedrooms',  $model->bedrooms(), $mer); ?>
											<?php echo $form->error($model, 'bedrooms'); ?>
										</div>
									<?php } ?>
								</div>
								<div class="clearfix"><!-- --></div>
								<div class="row  form-group bathroomsclass <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_bth">
									<?php
									if ($model->checkFieldsShow2('bathrooms')) { ?>
										<div class="col-sm-5 text-right" style="text-align: right;">
											<?php echo $form->labelEx($model, 'bathrooms'); ?>
										</div>
										<div class="col-sm-7 ">
											<?php $mer =  array_merge($model->getHtmlOptions('bathrooms'), array('empty' => $this->tag->getTag('select', 'Select'), 'class' => 'input-text  form-control')); ?>
											<?php echo $form->dropDownList($model, 'bathrooms',  $model->bathrooms(), $mer); ?>
											<?php echo $form->error($model, 'bathrooms'); ?>
										</div>
									<?php } ?>
								</div>
								<div class="clearfix"><!-- --></div>
								<Style>
									#h_selling_price.rent_paid {
										display: none !important;
									}

									#h_selling_price.rent_paid.hidden {
										display: block !important;
										visibility: visible !important;
									}

									#h_selling_price.rent_paid.hide {
										display: none !important;
									}
								</Style>
								<?php /* 	
							   		<div class="row  form-group rent_paid"  id="h_selling_price">
<div class="col-sm-5 text-right" style="text-align: right;">
<?php echo $form->labelEx($model, 'selling_price');?> 
</div>
<div class="col-sm-7 ">
<?php $mer =  array_merge($model->getHtmlOptions('selling_price'),array('placeholder'=>'','class'=>'input-text  form-control','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');")); ?>
<?php echo $form->textField($model, 'selling_price'  , $mer ); ?>
<?php echo $form->error($model, 'selling_price');?>
</div>  
</div>
*/
								?>
								<div class="clearfix"><!-- --></div>
								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_l_no">
									<div class="col-sm-5 text-right" style="text-align: right;">
										<?php echo $form->labelEx($model, 'l_no'); ?>
									</div>
									<div class="col-sm-7 ">
										<?php $mer =  array_merge($model->getHtmlOptions('l_no'), array('placeholder' => '', 'class' => 'input-text  form-control')); ?>
										<?php echo $form->textField($model, 'l_no', $mer); ?>
										<?php echo $form->error($model, 'l_no'); ?>
									</div>
								</div>

								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_plan_no">
									<div class="col-sm-5 text-right" style="text-align: right;">
										<?php echo $form->labelEx($model, 'plan_no'); ?>
									</div>
									<div class="col-sm-7 ">
										<?php $mer =  array_merge($model->getHtmlOptions('plan_no'), array('placeholder' => '', 'class' => 'input-text  form-control')); ?>
										<?php echo $form->textField($model, 'plan_no', $mer); ?>
										<?php echo $form->error($model, 'plan_no'); ?>
									</div>
								</div>

								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_no_of_u">
									<div class="col-sm-5 text-right" style="text-align: right;">
										<?php echo $form->labelEx($model, 'no_of_u'); ?>
									</div>
									<div class="col-sm-7 ">
										<?php $mer =  array_merge($model->getHtmlOptions('no_of_u'), array('empty' => $this->tag->getTag('select', 'Select'), 'class' => 'input-text  form-control')); ?>
										<?php echo $form->dropDownList($model, 'no_of_u', $model->selectcount($count = 20), $mer); ?>
										<?php echo $form->error($model, 'no_of_u'); ?>
									</div>
								</div>
								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_floor_no">
									<div class="col-sm-5 text-right" style="text-align: right;">
										<?php echo $form->labelEx($model, 'floor_no'); ?>
									</div>
									<div class="col-sm-7 ">
										<?php $mer =  array_merge($model->getHtmlOptions('floor_no'), array('empty' => $this->tag->getTag('select', 'Select'), 'class' => 'input-text  form-control')); ?>
										<?php echo $form->dropDownList($model, 'floor_no', $model->selectcount($count = 20), $mer); ?>
										<?php echo $form->error($model, 'floor_no'); ?>
									</div>
								</div>

								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_unit_no">
									<div class="col-sm-5 text-right" style="text-align: right;">
										<?php echo $form->labelEx($model, 'unit_no'); ?>
									</div>
									<div class="col-sm-7 ">
										<?php $mer =  array_merge($model->getHtmlOptions('unit_no'), array('placeholder' => '', 'class' => 'input-text  form-control')); ?>
										<?php echo $form->textField($model, 'unit_no', $mer); ?>
										<?php echo $form->error($model, 'unit_no'); ?>
									</div>
								</div>
								<div class="clearfix"><!-- --></div>
								<?php
								/*
<div class="row  form-group is_morclass" id="h_is_mor">
<div class="col-sm-12  text-aa">
<?php echo $form->labelEx($model, 'is_mor');?>
</div>
<div class="col-sm-12 ">
<?php $mer =  array_merge($model->getHtmlOptions('is_mor'),array('placeholder'=>'','class'=>'input-text  form-control')); ?>
<?php echo $form->textArea($model, 'is_mor',   $mer ); ?>
<?php echo $form->error($model, 'is_mor');?>
</div> 
</div>
*/
								?>
								<style>
									#place_an_ad .col-sm-12 textarea.form-control {
										height: 70px !important;
										min-height: unset !important;
									}
								</style>
								<?php
								/*
<div class="row  form-group is_morclass" id="h_rights">
<div class="col-sm-12 text-werright">
<?php echo $form->labelEx($model, 'rights');?>
</div>
<div class="col-sm-12">
<?php $mer =  array_merge($model->getHtmlOptions('rights'),array('placeholder'=>'','class'=>'input-text  form-control')); ?>
<?php echo $form->textArea($model, 'rights',   $mer ); ?>
<?php echo $form->error($model, 'rights');?>
</div> 
</div>
*/
								?>
								<?php
								/*
<div class="row  form-group is_morclass" id="h_may_affect">
<div class="col-sm-12 text-right324">
<?php echo $form->labelEx($model, 'may_affect');?>
</div>
<div class="col-sm-12">
<?php $mer =  array_merge($model->getHtmlOptions('may_affect'),array('placeholder'=>'','class'=>'input-text  form-control')); ?>
<?php echo $form->textArea($model, 'may_affect',   $mer ); ?>
<?php echo $form->error($model, 'may_affect');?>
</div> 
</div>
*/
								?>
								<?php /* 
	
<div class="row  form-group is_morclass" id="h_r_facade">
<div class="col-sm-12 text-right324">
<?php echo $form->labelEx($model, 'r_facade');?>
</div>
<div class="col-sm-12">
<?php $mer =  array_merge($model->getHtmlOptions('r_facade'),array('placeholder'=>'','class'=>'input-text  form-control')); ?>
<?php echo $form->textArea($model, 'r_facade',   $mer ); ?>
<?php echo $form->error($model, 'r_facade');?>
</div> 
</div>
*/
								?>
								<?php /*
<div class="row  form-group is_morclass" id="h_p_limits">
<div class="col-sm-12 text234-right">
<?php echo $form->labelEx($model, 'p_limits');?>
</div>
<div class="col-sm-12">
<?php $mer =  array_merge($model->getHtmlOptions('p_limits'),array('placeholder'=>'','class'=>'input-text  form-control')); ?>
<?php echo $form->textArea($model, 'p_limits',   $mer ); ?>
<?php echo $form->error($model, 'p_limits');?>
</div> 
</div>
*/
								?>
								<div class="clearfix"></div>

								<div class="row  form-group is_morclass <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_disputes">
									<div class="col-sm-5 text-right" style="text-align: right;">
										<?php echo $form->labelEx($model, 'furnished'); ?>
									</div>
									<div class="col-sm-7">
										<?php $mer =  array_merge($model->getHtmlOptions('disputes'), array('placeholder' => '', 'empty' => 'Please Select', 'class' => 'input-text  form-control')); ?>
										<?php echo $form->dropDownList($model, 'furnished', array('Y' => 'Yes', 'N' => 'No'),   $mer); ?>
										<?php echo $form->error($model, 'furnished'); ?>
									</div>
								</div>


								<div class="clearfix"></div>
								<div class="row  form-group <?php if (Yii::app()->isAppName('backend')) { ?> mb-3 <?php } ?>" id="h_expiry_date">



									<div class="col-sm-5 text-right" style="text-align: right;">
										<?php echo $form->labelEx($model, 'expiry_date'); ?>
									</div>
									<div class="col-sm-7">
										<?php
										$model->expiry_date =  	!empty($model->expiry_date) ? date('d-m-Y', strtotime($model->expiry_date)) : '';
										echo  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
											'model' => $model,
											'attribute' => 'expiry_date',
											'cssFile'   => null,
											'options'   => array(
												'changeYear' => 1,
												'maxDate' => '0',
												'showAnim'   => 'fold',
												'dateFormat' =>  'dd-mm-yy',
											),
											'htmlOptions' => array('class' => 'form-control filterInput', 'placeholder' => 'From Date', 'id' => 'from_date', 'autocomplete' => 'off', 'style' => 'width:100%;'),
										), true); ?>
										<?php echo $form->error($model, 'expiry_date'); ?>

										<div class="clearfix" style="width:100%;"><!-- --></div>

									</div>
								</div>

								<div class="clearfix"><!-- --></div>

								<div class="">
									<div class="clearfix"><!-- --></div>
									<div class="clearfix"><!-- --></div>
									<h4 class="subheading_font row "><?php echo $this->tag->getTag('features_/_amenities', 'Features / Amenities'); ?></h4>
									<div class="clearfix"><!-- --></div>

									<div class="amn1 row">
										<div class="row">

											<div class="form-group col-lg-12">
												<div style="width:100%;height:15px;"></div>
												<?php echo $form->labelEx($model, 'amenities'); ?>
												<?php
												if (Yii::App()->isAppName('backend') and !$model->isNewRecord) {
													echo $model->getTranslateHtml('amenities');
												}
												?>
												<?php echo $form->textArea($model, 'amenities', array_replace($model->getHtmlOptions('amenities'), array(
													"rows" => "5",
													'dir' => 'auto',
													'placeholder' => Yii::t('app', 'Mention the key features of your property (short description of your property)')
												))); ?>
												<div class="text-warning small hide pull-left">
													<?php echo Yii::t('app', $this->tag->getTag('recommanded_length_{s}{min}_-_', 'Recommanded length {s}{min} - {max}{e}'), array(
														'{s}' => '<span dir="ltr" style="white-space:nowrap;">', 
														'{e}' => '</span>', 
														'{min}' => $model::DESC_MIN, 
														'{max}' => $model::DESC_MAX
													)); ?>
												</div>
												<div class="pull-right text-warning" style="font-size: 12px;">
													<span id="inputcounter2"></span>
												</div>
												<div class="clearfix"></div>
												<?php echo $form->error($model, 'amenities'); ?>
											</div>
										</div>
										<!-- <style>
											.amlabel .form-check {
												width: 50% !important;
												float: left;
											}

											.amlabel .form-check:nth-child(2n+1) {
												clear: both;
											}
										</style> -->
										<!-- <div class="amn">
											<?php
											// $categoris =   CHtml::listData(Master::model()->listData(2), 'master_id', 'master_name');
											// //print_r($model->amenities) ;exit; 

											// foreach ($categoris as $k => $v) {
											// 	//$amenities_array=	 CHtml::listData(Amenities::model()->findAllCategories($k),'amenities_id','amenities_name');
											// 	$amenities_array =	 Amenities::model()->findAllCategories($k);

											// 	//echo $k.''. print_r($amenities_array); echo '<br />';echo '<br />';echo '<br />';echo '<br />';
											// 	if (!empty($amenities_array)) {
											// 		echo '<div class="col-sm-12 amlabel amn-' . $k . '" style="">';
											// 		echo '<div class="parent-h-div">';
											// 		echo '<a href="javascript:void(0)" class="cls-closebtn"  onclick="updateOpenClose(this)"><svg viewBox="0 0 70.098 53.605" ><use xlink:href="#cls-close"></use></svg></a>';
											// 		echo '<h4 class="spl-headd margin-top-5  margin-bottom-5" onclick="updateOpen(this)">' . $v . '<svg viewBox="0 0 70.098 53.605" class="button_icon-style5"><use xlink:href="#add-button"></use></svg></h4><div class="clearfix"></div>';
											// 		foreach ($amenities_array as $k => $v) {

											// 			// echo '<div class="form-check form-check-flat"  id="amnitm_'.$k.'"><label class="form-check-label"><input class="amnit" value="'.$k.'" id="amenities_'.$k.'" '; echo  in_array($k,(array) $model->amenities) ? 'checked' : '';  echo ' type="checkbox" name="amenities[]" onclick="expandthis(this)" >  '.$v.' <i class="input-helper"></i></label></div>';

											// 			if ($v->f_type == '0') {
											// 				echo '<div class="form-check form-check-flat"  id="amnitm_' . $v->amenities_id . '"><label class="form-check-label"><input class="amnit" value="' . $v->amenities_id . '" id="amenities_' . $v->amenities_id . '" ';
											// 				echo  in_array($v->amenities_id, (array) $model->amenities) ? 'checked' : '';
											// 				echo ' type="checkbox" name="amenities[' . $v->amenities_id . ']" onclick="expandthis(this)" >  ' . $v->amenities_name . ' <i class="input-helper"></i></label></div>';
											// 			} else if ($v->f_type == '1') {
											// 				echo '<div class="form-check form-check-flat padding-left-0 padding-right-15"    id="amnitm_' . $v->amenities_id . '"><div style="width:calc(100% - 78px);color: #72727d !important;font-size:14px;line-height:1.2;padding: 2px 0px;" class="pull-left">' . $v->amenities_name . '</div><div style="width:78px;" class="pull-left">' . CHtml::dropDownList('amenities[' . $v->amenities_id . '][inp_val]', @$model->amenities[$v->amenities_id], array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8+'), array('empty' => '0', 'class' => 'input-text  form-control')) . '</div></div>';
											// 			} else {
											// 				$vals =   isset($model->amenities[$v->amenities_id]['inp_val']) ?  $model->amenities[$v->amenities_id]['inp_val'] :  @$model->amenities[$v->amenities_id];
											// 				$on_input = ($v->i_o == '1') ? "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" : '';
											// 				echo '<div class="form-check form-check-flat padding-left-0 padding-right-15"    id="amnitm_' . $v->amenities_id . '"><div style="width:calc(100% - 78px);color: #72727d !important;font-size:14px;line-height:1.2;padding: 2px 0px;" class="pull-left">' . $v->amenities_name . '</div><div style="width:78px;" class="pull-left">' . CHtml::textField('amenities[' . $v->amenities_id . '][inp_val]', $vals, array('class' => 'input-text cmv  form-control', 'max-length' => '50', 'oninput' => $on_input)) . '</div></div>';
											// 			}
											// 		}

											// 		echo '</div>';

											// 		echo '</div>';
											// 	}
											// }



											//	echo CHtml::checkBoxList('amenities',$model->amenities ,$amenities_array,array('separator'=>'','labelOptions'=>array('class'=>''),'template'=>'<div class="form-check form-check-flat"><label class="form-check-label">{input}  {labelTitle} <i class="input-helper"></i></label></div>'));                                              
											?>
										</div> -->
										<!-- <div class="clearfix"></div>
										<div class="expandDiv hide" onclick="toggleClassExpand()"></div>
										<div class="clearfix"></div>
										<?php //echo $form->error($model, 'amenities'); ?> -->
									</div>
									<div class="clearfix"><!-- --></div>
								</div>


								<div class="clearfix"><!-- --></div>
							</div>



							<div class="insidecontent full-content">
								<h4 class="subheading_font row "><?php echo $this->tag->gettag('price', 'Price'); ?></h4>
								<div class="minimize_form">
									<div class="row">
										<div class="form-group col-lg-12">
											<label for="PlaceAnAd_price" class="required"><?php echo $this->tag->gettag('price', 'Price'); ?> <span class="required">*</span></label>

											<div class="clearfix"><!-- --></div>
											<style>
												html #place_an_ad .row label.or-labels {
													line-height: 35px;
													margin: 0;
													width: 35px;
													text-align: center;
													border-radius: 50%;
													color: var(--secondary-color) !important;
													background-size: contain;
													background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDc0IDc0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyIiB4bWw6c3BhY2U9InByZXNlcnZlIiBjbGFzcz0iIj48Zz48cGF0aCB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGQ9Im0zNyA3MmEzNSAzNSAwIDEgMSAzNS0zNSAzNS4wNCAzNS4wNCAwIDAgMSAtMzUgMzV6bTAtNjhhMzMgMzMgMCAxIDAgMzMgMzMgMzMuMDM3IDMzLjAzNyAwIDAgMCAtMzMtMzN6IiBmaWxsPSIjZjI3ZjUyIiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBzdHlsZT0iIiBjbGFzcz0iIj48L3BhdGg+PC9nPjwvc3ZnPg==);
													font-size: 11px;
													font-weight: 600;
												}

												#ck-button {
													height: 35px;
													margin: 0;
													background-color: #fff;
													border-radius: 0px;
													border: 1px solid #dfe0e3;
													overflow: auto;
													float: left;
													color: var(--black-color);
													width: calc(100% - 53px);
												}

												#ck-button:hover {
													background: var(--secondary-color);
													color: #fff
												}

												#ck-button:hover span {
													background: var(--secondary-color);
													color: #fff
												}

												#ck-button label {
													float: left;
													width: 100%;
													margin-bottom: 0
												}

												#ck-button label span {
													text-align: center;
													padding: 3px 0;
													display: block;
													line-height: 30px;
													line-height: 33px;
													padding: 0 10px !important;
													color: rgb(33, 37, 41);
													cursor: pointer
												}

												#ck-button label input {
													position: absolute;
													top: -20px;
													display: none
												}

												#ck-button input:checked+span {
													background-color: var(--secondary-color);
													color: #fff
												}

												.pr-ce-2 {
													max-width: 60px;
													min-width: 60px;
													background-repeat: no-repeat !important;
													background-position: center;
												}

												.pr-ce {
													flex: 1 !important;
												}
											</style>
											<script>
												function updateOpen(k) {
													$(k).closest('.amlabel').addClass('op-d')
												}

												function updateOpenClose(k) {
													$(k).closest('.amlabel').removeClass('op-d')
												}

												function disableinput(k) {
													if ($(k).is(':checked')) {
														$('#PlaceAnAd_price').val('');
													}
												}

												function disableCheckPor(k) {

													$('#PlaceAnAd_p_o_r').prop('checked', false);

												}
											</script>
											<div class="d-flex">
												<div class="pr-ce-1 pr-ce">
													<span class="lab-p"><?php echo $model->currencyTitle; ?></span>
													<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)'))); ?>
													<div class="clearfix"><!-- --></div>
												</div>
												<label class="pull-left or-labels pr-ce-2  pr-ce"><?php echo $this->tag->getTag('or', 'OR'); ?></label>

												<div id="ck-button" class="pr-ce-3  pr-ce">
													<label>
														<?php echo $form->checkBox($model, 'p_o_r', $model->getHtmlOptions('p_o_r', array('class' => 'form-control', 'onchange' => 'disableinput(this)'))); ?>
														<span><?php echo $this->tag->getTag('price_on_request', 'Price on Request'); ?></span>
													</label>
												</div>
											</div>

											<?php echo $form->error($model, 'price'); ?>


										</div>

										<div class="clearfix"></div>
										<div class="form-group col-lg-4 rent_paid <?php echo $model->section_id == $model::RENT_ID ? '' : 'hidden'; ?>">
											<label for="PlaceAnAd_rent_paid" class="required"><?php echo $this->tag->gettag('price', 'Rent Paid'); ?> <span class="required">*</span></label>
											<div class="clearfix"></div>
											<?php echo $form->dropDownList($model, 'rent_paid', $model->paidArray(), $model->getHtmlOptions('rent_paid', array('empty' => $this->tag->gettag('select', 'Select'), 'class' => 'form-control'))); ?>
											<?php echo $form->error($model, 'rent_paid'); ?>
										</div>


									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>


								<div class="clearfix"><!-- --></div>

								<div class="clearfix"><!-- --></div>
								<div class="clearfix"></div>
							</div>


							<div class="insidecontent">
								<div class="clearfix"><!-- --></div>
								<div class="clearfix"><!-- --></div>
								<div class="">
									<div class="col-lg-12">
										<?php
										$fileField = 'image';
										$title_text = $this->tag->getTag('add_photo', 'Add Photo');
										$types = '.png,.jpg,.jpeg';
										$maxFiles = '20';
										$maxFilesize = '5';

										$this->renderPartial('root.apps.frontend.new-theme.views.place_property._file_field_browse', compact('form', 'fileField', 'maxFilesize', 'types', 'maxFiles', 'model', 'title_text')); ?>
									</div>
								</div>
								<div class="clearfix"><!-- --></div>
							</div>

							<div class="clearfix"><!-- --></div>
							<div class="clearfix"></div>
							<div class="insidecontent">
								<?php $this->renderPartial('root.apps.frontend.new-theme.views.place_property.add_property_types'); ?>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
							<div class="insidecontent">
								<style>
									html #file_floor_plan .upload-btn-wrapper {
										max-width: 100% !important;
									}
								</style>
								<div class="">
									<?php
									$fileField = 'floor_plan';
									$title_text = '<i class="fa fa-file-image-o"></i> ' . $this->tag->getTag('click_to_upload_floor_plan', 'Click to upload Floor Plan');
									$types = '.pdf,.png,.jpg,.pdf';
									$maxFiles = '1';
									$maxFilesize = '5';

									$this->renderPartial('root.apps.frontend.new-theme.views.place_property._file_field_browse_plan', compact('form', 'fileField', 'maxFilesize', 'types', 'maxFiles', 'model', 'title_text')); ?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"><!-- --></div>

							<div class="_2ytqd"></div>
							<div class="clearfix"><!-- --></div>
							<?php
							if (Yii::App()->isAppName('frontend')) {  ?>
								<div class="insidecontent">

									<div class="clearfix"></div>
									<h3 class="subHeadh2"> Contact Details</h3>
									<div class="clearfix"></div>
									<div class="row">
										<div class="clearfix"></div>
										<div class="form-group col-lg-6">
											<?php
											echo $form->labelEx($model, 'contact_person'); ?>
											<?php echo $form->textField($model, 'contact_person', $model->getHtmlOptions('contact_person')); ?>
											<?php echo $form->error($model, 'contact_person'); ?>
										</div>
										<div class="form-group col-lg-6">
											<?php
											echo $form->labelEx($model, 'salesman_email'); ?>
											<?php echo $form->textField($model, 'salesman_email', $model->getHtmlOptions('salesman_email')); ?>
											<?php echo $form->error($model, 'salesman_email'); ?>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="row">
										<div class="form-group col-lg-4">
											<?php
											echo $form->labelEx($model, 'mobile_number'); ?>
											<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('mobile_number')); ?>
											<?php echo $form->error($model, 'mobile_number'); ?>
										</div>
										<div class="form-group col-lg-4">
											<?php

											echo $form->labelEx($model, 'landline'); ?>
											<?php echo $form->textField($model, 'landline', $model->getHtmlOptions('landline')); ?>
											<?php echo $form->error($model, 'landline'); ?>
										</div>
										<div class="form-group col-lg-4">
											<?php

											echo $form->labelEx($model, 'submited_by'); ?>
											<?php echo $form->dropDownList($model, 'submited_by', $model->getsubmited_by_array(), $model->getHtmlOptions('submited_by')); ?>
											<?php echo $form->error($model, 'submited_by'); ?>
										</div>


										<?php
										if (Yii::app()->isAppName('backend')) { ?>
											<div class="form-group col-lg-4">

												<?php echo $form->labelEx($model, 'user_id'); ?>
												<div></div>

												<?php echo $form->dropDownList($model, 'user_id', CHtml::listData(User::model()->findAll(), 'user_id', 'fullName'), $model->getHtmlOptions('user_id')); ?>
												<?php echo $form->error($model, 'user_id'); ?>
											</div>
										<?php } else {
										}

										?>



									</div>
								</div>

							<?php
							}
							if (Yii::App()->isAppName('frontend')) {  ?>
								<div class="insidecontent hide">
									<div class="clearfix"></div>

									<div class="row">
										<div class="form-group col-lg-6 hide">
											<?php if ($model->isNewRecord) {
												$model->user_id =  '31988';
											}  ?>
											<?php echo $form->labelEx($model, 'user_id'); ?>
											<?php echo $form->hiddenField($model, 'user_id'); ?>
											<?php echo $form->error($model, 'user_id'); ?>
											<?php echo $form->hiddenField($model, 'section_id'); ?>
											<?php echo $form->error($model, 'section_id'); ?>
											<?php echo $form->hiddenField($model, 'listing_type'); ?>
											<?php echo $form->error($model, 'listing_type'); ?>

											<?php echo $form->hiddenField($model, 'w_for'); ?>
											<?php echo $form->error($model, 'w_for'); ?>
											<?php echo $form->hiddenField($model, 'category_id'); ?>
											<?php echo $form->error($model, 'category_id'); ?>
										</div>
									</div>
									<div class="clearfix"><!-- --></div>
								</div>
								<div class="_2ytqd"></div>
							<?php } else {

								$this->renderPartial('root.apps.frontend.new-theme.views.place_property._admin_settings', compact('form'));
							}

							?>

							<div class="clearfix"><!-- --></div>


						</div>
						<div class="clearfix"><!-- --></div>
					</div>
				</div>
			</div>
			<div class="box-footer" style="border:0px;padding-top:0px; background:none;">
				<div class="pull-right">
					<?php
					if ($this->action->id == 'preview') {
					?>
						<a href="<?php echo Yii::App()->createUrl($this->id . '/create', array('preview' => $LocalStorage->cookie_name)); ?>" class="btn btn-primary  " style="background-color:var(--logo-color);border:1px solid var(--logo-color);"><?php echo $this->tag->getTag('update_property', 'Update Property'); ?></a>

					<?php
					}
					?>
					<button <?php if ($this->id == 'place_an_ad_no_login' and $this->action->id == 'preview') {
								echo 'type="button" onclick="OpenSignupRequiredNew(this)"';
							} else {
								echo 'type="submit"';
							} ?> id="bb" class="btn btn-primary  " data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...'); ?>"><?php echo Yii::t('app', $mainText); ?></button>
				</div>
				<div class="clearfix"><!-- --></div>
			</div>
		</div>
<?php
		$this->endWidget();
	}
	/**
	 * This hook gives a chance to append content after the active form.
	 * Please note that from inside the action callback you can access all the controller view variables 
	 * via {@CAttributeCollection $collection->controller->data}
	 * @since 1.3.3.1
	 */
	$hooks->doAction('after_active_form', new CAttributeCollection(array(
		'controller'      => $this,
		'renderedForm'    => $collection->renderForm,
	)));
}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
	'controller'        => $this,
	'renderedContent'   => $viewCollection->renderContent,
)));
?>


<script type="text/javascript">
	<?php
	if (!empty($model->category_id)) {
	?>
		$(function() {
			validateInputSector();
		})
	<?php
	}
	?>
</script>

<script>
	var location_text_url = '<?php echo Yii::App()->createUrl('place_an_ad/city_details'); ?>';
	var hiddenAmenities = '<?php echo Yii::App()->createUrl('ajax/hidden_ammenities'); ?>';

	function getCityDetails(k) {
		$.get(location_text_url, {
			'id': $(k).val()
		}, function(data) {
			var d = JSON.parse(data);
			location_text_details = d.city_name;
			$('#PlaceAnAd_enter_city').val(d.city);

			$('#PlaceAnAd_area_location').val($('#PlaceAnAd_area_location').val()).change();

		})
	}

	function emptyInput(k) {
		if ($('#select_from_list').val() == '') {
			$(k).val('');
		}
	}
</script>
<style>
	.autocomplete-suggestions {
		background-color: #fff;
		border-radius: 4px;
		border: 1px solid #ccc;
		box-shadow: 0 4px 6px 2px rgba(0, 0, 0, 0.1);
		font-size: .875em;
		margin-left: 1px;
		clear: both;
	}

	.autocomplete-suggestions {
		overflow: auto;
	}

	.autocomplete-suggestion {
		position: relative;
		cursor: pointer;
	}

	.suggestion-img {
		float: left;
		height: 40px;
		line-height: 40px;
		margin: 4px 8px 0 6px;
		overflow: hidden;
		text-align: center;
		vertical-align: middle;
		width: 40px;
	}

	.suggestion-img img {
		max-width: 100%;
		max-height: 40px;
		display: block;
	}

	.suggestion-wrapper {
		display: block;
		height: 48px;
		overflow: hidden;
		position: relative;
		text-overflow: ellipsis;
		vertical-align: middle;
		line-height: 16px;
		padding: 7px;
	}

	.suggestion-value {
		display: block;
		line-height: normal;
		font-weight: 700;
	}

	.sub-text {
		color: #999;
		font-size: 11px;
		font-weight: normal;
	}

	.sub-text {
		color: #999;
		font-size: 11px;
		font-weight: normal;
	}
</style>

<style>
	.card-body.mainb {
		padding-bottom: 0px;
	}

	.land-prop .bedroomsclass,
	.land-prop .bathroomsclass {
		display: none;
	}

	.amn-104,
	.for-land {
		display: flex;
	}

	.land-prop .amn-104,
	.land-prop .for-land {
		display: flex;
	}

	.land-prop .amn-99 {
		display: none;
	}
</style>

<?php
if (Yii::App()->isAppName('frontend') and $model->isNewRecord) { ?>

	<script>
		var saveCookiesUrl = '<?php echo Yii::app()->createUrl('place_an_ad/savecookies'); ?>';

		function savemycookies() {
			var formData = {};
			var frm = $('#post-property');
			frm.find(":input").each(function(index, node) {


				formData[node.name] = node.value;



			});
			var amn = $('.amnit:checked').map(function() {
				return this.value;
			}).get().join('-');

			formData['amn'] = amn;
			$.post(saveCookiesUrl, formData);
		}

		$(document).ready(function() {
			// setInterval(savemycookies,20000);
		});
	</script>
<?php } ?>
<Style>
	@media screen and (max-width: 600px) {


		table.m-responsivw thead {
			border: none;
			clip: rect(0 0 0 0);
			height: 1px;
			margin: -1px;
			overflow: hidden;
			padding: 0;
			position: absolute;
			width: 1px;
		}

		table.m-responsivw tr {
			border-bottom: 3px solid #ddd;
			display: block;
			margin-bottom: .625em;
		}

		table.m-responsivw td {
			border-bottom: 1px solid #ddd;
			display: block;
			font-size: .8em;

		}

		table.m-responsivw td::before {
			/*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
			content: attr(data-label);
			float: left;
			font-weight: bold;
			text-transform: uppercase;
		}

		html[dir="rtl"] table.m-responsivw td::before {
			float: right;
		}

		table.m-responsivw td:last-child {
			border-bottom: 0;
		}

		table.m-responsivw td .insinert {
			width: calc(100% - 100px);
			float: right;
		}

		html[dir="rtl"] table.m-responsivw td .insinert {
			float: left;
		}

		table.m-responsivw td {

			padding: 5px !important;
			line-height: 32px !important;
			padding-left: 7px !important;
			padding-right: 7px !important;
			text-align: left !important;
			vertical-align: middle !important;
			height: 47px;
		}

		html[dir="rtl"] table.m-responsivw td {
			text-align: right !important;
		}

		table.m-responsivw tr:last-child {
			margin-bottom: 0px;
			border-bottom: 0px;
		}
	}

	#inputcounter2,
	#inputcounter {
		font-size: 14px;
		color: green;
	}

	#inputcounter2.error,
	#inputcounter.error {
		color: red !important;
	}
</Style>
<script>
	var text_remaining = '<?php echo Yii::app()->tags->getTag('{n}_remaining', '{n} remaining'); ?>';
	var text_exceeded = '<?php echo Yii::app()->tags->getTag('{n}_exceeded', '{n} exceeded'); ?>';
	$(function() {
		checktitleCount();
		checkdescpCount();
		$('#PlaceAnAd_ad_title').keyup(function() {
			checktitleCount();

		});
		$('#PlaceAnAd_ad_description').keyup(function() {
			checkdescpCount()
		});

	})
	var set_text = '<?php echo $this->tag->getTag('set_cover', 'Set Cover'); ?>';
	var setect = '<?php echo $this->tag->getTag('select', 'Select'); ?>';
	$(function() {

		<?php
		if (Yii::app()->isAppName('backend')) { ?>
			$(function() {
				pickCustomer()
			})
		<?php } ?>

	})
</script>