<?php
if (isset($_GET['type']) and !empty($_GET['type'])) {
	if ($_GET['type'] == 'business') {
		$titpe = 'Submit Business';
	} else {
		$titpe = 'Submit Property';
	}
?>
	<style>
		html #place_an_ad .sector1 .box-footer {
			display: block !important;
		}

		html #place_an_ad .form-control {

			padding: 0px;
		}

		.box {
			background: transparent !important;
		}

		html body #place_an_ad .place-property {
			padding: 0px 13px;
			background: transparent !important;
			box-shadow: 0 1px 6px 0 rgba(32, 33, 36, 0.28) !important;
			border-radius: 10px;
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

		#post-property {
			margin-top: -71px;
			z-index: 1;
			position: relative;
		}

		html .place_ad {
			min-height: 300px;
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

		html body #place_an_ad .place-property {
			background: #fff !important;
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

	?>

<?php

}
?>
<div id="place_an_ad">
	<style>
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

		._2ytqd {

			border-bottom: 0px solid rgba(0, 47, 52, .2) !important;
		}

		.box {

			background: #fff;
			margin: auto;
			overflow: hidden !important;
			border: 1px solid #eee !important;
			padding: 0px 10px;
			max-width: 650px;
		}

		.minimize_form {

			margin: auto;
		}

		.minimize_form {
			max-width: 100%;

		}
	</style>
	<div id="cat_info" data-id="<?php echo $model->category_id; ?>">
		<style>
			.for-franch {
				display: none;
			}

			#cat_info[data-id="194"] .for-franch {
				display: block;
			}

			#cat_info[data-id="194"] #business_operation,
			#cat_info[data-id="194"] .not-for-franch {
				display: none;
			}

			#member .select2-container .select2-selection--single,
			#place_an_ad .select2-container .select2-selection--single {
				height: 25px;
			}

			#place_an_ad .sector1 #moredetails {
				display: block !important;
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

			#select2-BusinessForSale_area_unit-container,
			#select2-BusinessForSale_area_unit_1-container {
				font-size: 12px;
			}

			[id^="select2-BusinessForSale_state"] li:first-child {
				display: block !important;
			}

			[id^="select2-BusinessForSale_area_unit"] li:first-child {
				display: block !important;
			}

			[id^="select2-BusinessForSale_rent_paid-result"] li:first-child {
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
				max-width: 800px;
				margin: auto;
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


				padding: 0px 0px;

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
				padding: 0px 13px !important;
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

			#place_an_ad .row {
				margin-left: -15px !important;
				margin-right: -15px !important;
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
				margin-left: -15px;

				margin-right: -15px;
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

			.col-sm-12 {
				padding-left: 15px !important;
				padding-right: 15px !important;
				;
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
		</style>
		<style>
			html #BusinessForSale_ad_title::placeholder {
				color: #b6b6b6 !important;
				opacity: 1;
				/* Firefox */
			}

			html #BusinessForSale_ad_description::placeholder {
				color: #b6b6b6 !important;
				opacity: 1;
				/* Firefox */
			}
		</style>

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

			html #place_an_ad .row label.or-labels {
				display: flex;
				align-items: center;
				justify-content: center;

			}
		</style>
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
				display: none;
			}

			.land-prop .amn-104,
			.land-prop .for-land {
				display: block;
			}

			.land-prop .amn-99 {
				display: none;
			}

			.box .col-lg-1,
			.box .col-lg-2,
			.box .col-lg-3,
			.box .col-lg-4,
			.box .col-lg-5,
			.box .col-lg-6,
			.box .col-lg-7,
			.box .col-lg-8,
			.box .col-lg-9,
			.box .col-lg-10,
			.box .col-lg-11,
			.box .col-lg-12 {

				padding-left: 15px !important;
			}

			#ck-button {
				max-width: 150px;
			}
		</style>
		<?php 
		    $subCategory = new Subcategory();
		?>
		<script>
			var modelName = '<?php echo $model->modelName; ?>';
			var sectid = '<?php echo $model->section_id; ?>';
			var business_url = '<?php echo Yii::app()->createUrl($this->id . '/create_business'); ?>';
			var cName = '<?php echo defined('COUNTRY_NAME') ? COUNTRY_NAME : ""; ?>';
			var suggestionst = '<?php echo $this->tag->getTag('suggestions', 'Suggestions'); ?>';
			var in_text = '<?php echo $this->tag->getTag('in', 'in'); ?>';
			var cityUrl = '<?php echo YIi::App()->createUrl($this->id . '/getCityId'); ?>';
			var customer_url = '<?php echo Yii::app()->createUrl('place_an_ad/Customer'); ?>';

			function changefld(k) {
				$('#cat_info').attr('data-id', $(k).val());
			    var selectedCategoryId = k.value;
                document.getElementById('hidden_category_id').value = selectedCategoryId;
			}
			function setNestedIf(k){
                 console.log("Parent ID:", k.value); // Debug statement
			}
		</script>

		<script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/place_ad_script.js?q=72'); ?>"></script>
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
				if (!$model->isNewRecord) {
					$ars = array(
						'RentPerMonth',
						'interior_size',
						'Rent',
						'price_v',
						'price_v_to',
						'price_b',
						'price_b_to',
						'price_false',
						'price_to_false',
						'price',
						'price_to',
					);
					foreach ($ars as $k) {
						$model->$k = ($model->$k) == '0.00' ? '' : Yii::t('app', $model->$k, array('.00' => ''));
					}
				}
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

				<div class="box box-primary place_ad place-property <?php echo $model->isNewRecord ? 'sector1' : 'sector2'; ?> margin-bottom-50">
					<h3 class="box-title hide"><?php echo $model->isNewRecord ? 'Post your Property' : 'Update your Property'; ?></h3>
					<div class="box-header" style="border: 0px;">

                

						<div class="clearfix"><!-- --></div>
					</div>
					<div class="box-body <?php echo $model->category_id == '121' ? 'land-prop' : ''; ?>" id="boxdy" style="padding:0px;">
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



						<div id="moredetails">



							<div class="_2ytqd"></div>
							<div class="rui-2SwH7 rui-1JF_2">

								<div class="clearfix"><!-- --></div>

								<div class="insidecontent padding-top-0">
									<?php
									if ($this->id == 'update_property' and $this->functionality == 'picture') {
									?>
										<div class="col-sm-5 text-right">
											<label for="BusinessForSale_sub_category_id" class="required">Property</label>

										</div>

										<div class="col-sm-7">
											<?php echo $model->ad_title; ?>
										</div>
									<?
									}
									?>
									<div class="minimize_form full-content">

										<div class="row for-land  form-group">
											<?php
											/* $sub_category =  CHtml::listData(Subcategory::model()->ListDataForCategory(121),'sub_category_id','sub_category_name'); */
											$sub_category = $model->subcategoriesarray();
											?>
											<div class="clearfix"><!-- --></div>

											<div class="col-sm-5 text-right">
												<label for="BusinessForSale_sub_category_id" class="required"><?php echo $this->tag->getTag('subcategory', 'Subcategory'); ?> <span class="required">*</span></label>

											</div>
											<div class="col-sm-7">
											    
												<?php $mer =  array_merge($model->getHtmlOptions('sub_category_id'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
												<?php echo $form->dropDownList($model, 'sub_category_id', $sub_category, $mer); ?>
												<?php echo $form->error($model, 'sub_category_id'); ?>
											</div>
										</div>
										<div class="row  form-group hide">
											<?php
											if (!Yii::app()->request->isPostRequest and   empty($model->client_ref)) {
												$model->client_ref = date('ymdHis') . '-' . rand(1, 100);
											}
											?>

											<div class="col-sm-5 text-right"> <?php echo $form->labelEx($model, 'client_ref'); ?></div>
											<div class="col-sm-7">
												<div class=" ">

													<?php echo $form->textField($model, 'client_ref', $model->getHtmlOptions('client_ref', array('placeholder' => '', 'class' => 'input-text form-control'))); ?>
													<span class="rui-qvKkT"></span>
													<?php echo $form->error($model, 'client_ref'); ?>
												</div>

											</div>
										</div>

										<h4 class="subheading_font row ">Business Description</h4>
										<div class="row  form-group">
											<?php
											/* $sub_category =  CHtml::listData(Subcategory::model()->ListDataForCategory(121),'sub_category_id','sub_category_name'); */
											$category =    Category::model()->ListDataForJSON_ID_BySEctionNew($model->section_id);


											?>
											<div class="clearfix"><!-- --></div>

											<div class="col-sm-5 text-right">
												<?php echo $form->labelEx($model, 'category_id'); ?>

											</div>
											<div class="col-sm-7">
											    <?php echo $form->hiddenField($model, 'category_id', array('id' => 'hidden_category_id', 'name' => 'BusinessForSale[hidden_category_id]')); ?>
												<?php $mer =  array_merge($model->getHtmlOptions('category_id'), array('class' => 'input-text  form-control', 'onchange' => 'changefld(this)', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
												<?php echo $form->dropDownList($model, 'category_id', $category, $mer); ?>
												<?php echo $form->error($model, 'category_id'); ?>
											</div>
										</div>

								    	<div class="row form-group">
                                            <div class="clearfix"><!-- --></div>
                                            <div class="col-sm-5 text-right">
                                                <?php echo $form->labelEx($model, 'sub_category'); ?>
                                            </div>
                                            <div class="col-sm-7">
                                                <?php
                                                $subCategoryD = Subcategory::model()->findAllByAttributes(array('parent_id' => null));
                                                $options = array('' => 'Select'); // Initialize options with a default empty value
                                                foreach ($subCategoryD as $subcategory) {
                                                    $options[$subcategory->sub_category_id] = $subcategory->sub_category_name;
                                                }
                                                $mer = array_merge($model->getHtmlOptions('sub_category_id'), array('class' => 'input-text form-control', 'onchange' => 'populateNestedSubcategories(this)'));
                                                echo $form->dropDownList($model, 'sub_category_id', $options, $mer);
                                                echo $form->error($model, 'sub_category_id');
                                                ?>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var subCategoryId = "<?php echo $model->sub_category_id; ?>";
                                                populateNestedSubcategoriesOnLoad(subCategoryId);
                                            });
                                            function populateNestedSubcategories(subCategoryId) {
                                                var parentId = $(subCategoryId).val();
                                                console.log(parentId)
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo CController::createUrl("place_property/dynamicNestedSubcategories"); ?>',
                                                    data: {parentId: parentId},
                                                    success: function(data) {
                                                        $('#BusinessForSale_nested_sub_category').html(data);
                                                    }
                                                });
                                            }
                                            function populateNestedSubcategoriesOnLoad(subCategoryId) {
                                                var parentId = subCategoryId;
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo CController::createUrl("place_property/dynamicNestedSubcategories"); ?>',
                                                    data: {parentId: parentId, nestedSubcategoryId: "<?php echo $model->nested_sub_category; ?>"},
                                                    success: function(data) {
                                                        $('#BusinessForSale_nested_sub_category').html(data);
                                                    }
                                                });
                                            }
                                        </script>
                                        <div class="row form-group">
                                            <div class="clearfix"><!-- --></div>
                                            <div class="col-sm-5 text-right">
                                                <?php echo $form->labelEx($model, 'nested_sub_category'); ?>
                                            </div>
                                            <div class="col-sm-7">
                                                <?php
                                                $options = array();
                                                $mer = array_merge($model->getHtmlOptions('nested_sub_category'), array('class' => 'input-text form-control', 'empty' => 'Select Nested Sub Category'));
												echo $form->dropDownList($model, 'nested_sub_category', $options, $mer);
                                                echo $form->error($model, 'nested_sub_category');
                                                ?>
                                            </div>
                                        </div>
                                        
                                     

										<div class="row  form-group">

											<div class="clearfix"><!-- --></div>

											<div class="col-sm-5 text-right">
												<?php echo $form->labelEx($model, 'ad_title'); ?>

											</div>
											<div class="col-sm-7">
												<?php $mer =  array_merge($model->getHtmlOptions('ad_title'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
												<?php echo $form->textField($model, 'ad_title',  $mer); ?>
												<?php echo $form->error($model, 'ad_title'); ?>
											</div>
										</div>
										<div class="clearfix"><!-- --></div>
										<div class="row  form-group  ">

											<div class="col-sm-5 text-right">

												<?php echo $form->labelEx($model, 'RefNo'); ?>

											</div>
											<div class="col-sm-7">
												<?php $mer =  array_merge($model->getHtmlOptions('RefNo'), array('placeholder' => $this->tag->getTag('ref_no', 'Refrence No.'), 'class' => 'input-text  form-control')); ?>
												<?php echo $form->textField($model, 'RefNo',   $mer); ?>
												<?php echo $form->error($model, 'RefNo'); ?>
											</div>

										</div>

										<div class="clearfix"><!-- --></div>
										<div class="row">
											<div class="form-group col-sm-12">
												<div style="width:100%;height:15px;"></div>
												<?php echo $form->labelEx($model, 'ad_description'); ?>
												<?php
												if (Yii::App()->isAppName('backend') and !$model->isNewRecord) {
													echo $model->getTranslateHtml('ad_description');
												}
												?>
												<?php echo $form->textArea($model, 'ad_description', array_replace($model->getHtmlOptions('ad_description'), array("rows" => "5", 'dir' => 'auto', 'placeholder' => $this->tag->getTag('mention_the_key_feature_of_you', 'Mention the key feature of your property (short description of your property)')))); ?>
												<div class="text-warning small hide pull-left"><?php echo Yii::t('app', $this->tag->getTag('recommanded_length_{s}{min}_-_', 'Recommanded length {s}{min} - {max}{e}'), array('{s}' => '<span dir="ltr" style="white-space:nowrap;">', '{e}' => '</span>', '{min}' => $model::DESC_MIN, '{max}' => $model::DESC_MAX));; ?></div>
												<div class="pull-right text-warning" style="font-size: 12px;"><span id="inputcounter2"></span></div>
												<div class="clearfix"></div>
												<?php echo $form->error($model, 'ad_description'); ?>
											</div>
										</div>
										<script>
											function disableinput(k) {
												if ($(k).is(':checked')) {
													$(k).closest('.pricefrm').find('input[type="text"]').val('');
												}
											}

											function disableCheckPor(k) {

												$(k).closest('.pricefrm').find('input:checked').prop('checked', false);

											}
										</script>
										<div class="insidecontent full-content">
											<h4 class="subheading_font row "><?php echo $this->tag->gettag('price', 'Price'); ?></h4>

											<div class="row  form-group hide" style="max-width:300px;">
												<?php
												$currency =    Currency::model()->systemCurrencies();
												$ar_c = array();
												foreach ($currency as $k => $v) {
													$ar_c[$k] = $v['name'];
												}


												?>
												<div class="clearfix"><!-- --></div>

												<div class="col-sm-5  ">
													<label for="BusinessForSale_currency_id" class="required"><?php echo $model->getAttributeLabel('currency_id'); ?> <span class="required">*</span></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('currency_id'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->dropDownList($model, 'currency_id', $ar_c, $mer); ?>
													<?php echo $form->error($model, 'currency_id'); ?>
												</div>
											</div>

											<div class="clearfix"><!-- --></div>
											<?php
											$max = $this->tag->getTag('max_rang', 'Max. Range'); ?>

											<div class="minimize_form">
												<div class="row  form-group for-franch" style="max-width:400px;">

													<div class="clearfix"><!-- --></div>
													<div class="col-sm-5 ">
														<label for="BusinessForSale_f_fee" class="required"><?php echo $model->getAttributeLabel('f_fee'); ?><span class="required">*</span> (AED)</label>
													</div>
													<div class="col-sm-7">
														<?php $mer =  array_merge($model->getHtmlOptions('f_fee'), array('placeholder' => '', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
														<?php echo $form->textField($model, 'f_fee',  $mer); ?>
														<?php echo $form->error($model, 'f_fee'); ?>
													</div>
												</div>

												<div class="row pricefrm">
													<div class="form-group col-sm-12">

														<label for="BusinessForSale_price" class="required not-for-franch"><?php echo $model->getAttributeLabel('price'); ?><span class="required">*</span> (AED)</label>
														<label for="BusinessForSale_price" class="required  for-franch"><?php echo $model->getAttributeLabel('investment'); ?><span class="required">*</span> (AED)</label>

														<div class="clearfix"><!-- --></div>
														<div class="d-flex">
															<div class="price_ranger d-flex">
																<div class="pr-ce-1 pr-ce">

																	<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)', 'placeholder' => ''))); ?>
																	<div class="clearfix"><!-- --></div>
																</div>
																<div class="pr-ce-1 pr-ce">

																	<?php echo $form->textField($model, 'price_to', $model->getHtmlOptions('price_to', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)', 'placeholder' => $max))); ?>
																	<div class="clearfix"><!-- --></div>
																</div>


															</div>
															<label class="pull-left or-labels pr-ce-2  pr-ce d-flex"><?php echo $this->tag->getTag('or', 'OR'); ?></label>

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


												</div>
												<div class="clearfix"></div>



												<!-- Revenue -->
												<div class="row pricefrm not-for-franch ">
													<div class="form-group col-sm-12">

														<label for="BusinessForSale_price_false" class="required"><?php echo $model->getAttributeLabel('price_false'); ?><span class="required">*</span> (AED)</label>

														<div class="clearfix"><!-- --></div>

														<div class="d-flex">
															<div class="price_ranger d-flex">
																<div class="pr-ce-1 pr-ce">

																	<?php echo $form->textField($model, 'price_false', $model->getHtmlOptions('price_false', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)', 'placeholder' => ''))); ?>
																	<div class="clearfix"><!-- --></div>
																</div>
																<div class="pr-ce-1 pr-ce">

																	<?php echo $form->textField($model, 'price_to_false', $model->getHtmlOptions('price_to_false', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)', 'placeholder' => $max))); ?>
																	<div class="clearfix"><!-- --></div>
																</div>


															</div>
															<label class="pull-left or-labels pr-ce-2  pr-ce d-flex"><?php echo $this->tag->getTag('or', 'OR'); ?></label>

															<div id="ck-button" class="pr-ce-3  pr-ce">
																<label>
																	<?php echo $form->checkBox($model, 'request_r', $model->getHtmlOptions('request_r', array('class' => 'form-control', 'onchange' => 'disableinput(this)'))); ?>
																	<span><?php echo $this->tag->getTag('Price on Request', 'Price on Request'); ?></span>
																</label>
															</div>
														</div>

														<?php echo $form->error($model, 'price_false'); ?>


													</div>




												</div>

												<!--Revenue End -->

												<!---Prise Business -->
												<div class="row pricefrm not-for-franch">
													<div class="form-group col-sm-12">

														<label for="BusinessForSale_price_b" class="required"><?php echo $model->getAttributeLabel('price_b'); ?><span class="required">*</span> (AED)</label>

														<div class="clearfix"><!-- --></div>

														<div class="d-flex">
															<div class="price_ranger d-flex">
																<div class="pr-ce-1 pr-ce">

																	<?php echo $form->textField($model, 'price_b', $model->getHtmlOptions('price_b', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)', 'placeholder' => $this->tag->getTag('minimum', 'Minimum')))); ?>
																	<div class="clearfix"><!-- --></div>
																</div>
																<div class="pr-ce-1 pr-ce">

																	<?php echo $form->textField($model, 'price_b_to', $model->getHtmlOptions('price_b_to', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)', 'placeholder' => $this->tag->getTag('maximum', 'Maximum')))); ?>
																	<div class="clearfix"><!-- --></div>
																</div>


															</div>
															<label class="pull-left or-labels pr-ce-2  pr-ce d-flex"><?php echo $this->tag->getTag('or', 'OR'); ?></label>

															<div id="ck-button" class="pr-ce-3  pr-ce">
																<label>
																	<?php echo $form->checkBox($model, 'p_b_r', $model->getHtmlOptions('p_b_r', array('class' => 'form-control', 'onchange' => 'disableinput(this)'))); ?>
																	<span><?php echo $this->tag->getTag('Price on Request', 'Price on Request'); ?></span>
																</label>
															</div>
														</div>

														<?php echo $form->error($model, 'price_b'); ?>


													</div>




												</div>

												<!--- Price business end -->


												<!---Pricevaluation --->
												<div class="row pricefrm not-for-franch">
													<div class="form-group col-sm-12">

														<label for="BusinessForSale_price_v" class="required"><?php echo $model->getAttributeLabel('price_v'); ?><span class="required">*</span> (AED)</label>

														<div class="clearfix"><!-- --></div>

														<div class="d-flex">
															<div class="price_ranger d-flex">
																<div class="pr-ce-1 pr-ce">

																	<?php echo $form->textField($model, 'price_v', $model->getHtmlOptions('price_v', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)', 'placeholder' => $this->tag->getTag('minimum', 'Minimum')))); ?>
																	<div class="clearfix"><!-- --></div>
																</div>
																<div class="pr-ce-1 pr-ce">

																	<?php echo $form->textField($model, 'price_v_to', $model->getHtmlOptions('price_v_to', array('oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onchange' => 'disableCheckPor(this)', 'placeholder' => $this->tag->getTag('maximum', 'Maximum')))); ?>
																	<div class="clearfix"><!-- --></div>
																</div>


															</div>
															<label class="pull-left or-labels pr-ce-2  pr-ce d-flex"><?php echo $this->tag->getTag('or', 'OR'); ?></label>

															<div id="ck-button" class="pr-ce-3  pr-ce">
																<label>
																	<?php echo $form->checkBox($model, 'p_v_r', $model->getHtmlOptions('p_v_r', array('class' => 'form-control', 'onchange' => 'disableinput(this)'))); ?>
																	<span><?php echo $this->tag->getTag('Price on Request', 'Price on Request'); ?></span>
																</label>
															</div>
														</div>

														<?php echo $form->error($model, 'price_v'); ?>


													</div>




												</div>

												<!-- Price Valuation End --->




											</div>

										</div>
										<div id="property-nformation">
											<h4 class="subheading_font row not-for-franch">Property Information</h4>
											<h4 class="subheading_font row for-franch">Location Information</h4>

											<div class="row  form-group not-for-franch">
												<?php
												$property_type =    Category::model()->ListDataForJSON_ID_ByListingType('151');


												?>
												<div class="clearfix"><!-- --></div>

												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_listing_type" class="required"><?php echo $model->getAttributeLabel('listing_type'); ?><span class="required">*</span></label>
												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('listing_type'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->dropDownList($model, 'listing_type', $property_type, $mer); ?>
													<?php echo $form->error($model, 'listing_type'); ?>
												</div>
											</div>

											<div class="row  form-group not-for-franch">
												<?php $ow_type =    Chtml::listData(Master::model()->listData('8'), 'master_id', 'master_name');  ?>
												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_ow_type" class="required"><?php echo $model->getAttributeLabel('ow_type'); ?><span class="required">*</span></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('ow_type'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->dropDownList($model, 'ow_type', $ow_type, $mer); ?>
													<?php echo $form->error($model, 'ow_type'); ?>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="row  form-group not-for-franch">

												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">

													<label for="BusinessForSale_Rent" class="required"><?php echo $model->getAttributeLabel('Rent'); ?> (AED)</label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('Rent'), array('placeholder' => '', 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->textField($model, 'Rent',  $mer); ?>
													<?php echo $form->error($model, 'Rent'); ?>
												</div>
											</div>



											<div class="clearfix"></div>
											<?php
											$cities =  CHtml::listData(States::model()->AllListingStatesOfCountry((int) $model->country), 'state_id', 'state_name');
											$m_class = empty($cities) ? 'hidden' : '';
											?>


											<div class="clearfix"><!-- --></div>
											<div class="row  form-group">
												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_state" class="required"><?php echo $model->getAttributeLabel('state'); ?><span class="required">*</span></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge(); ?>
													<?php echo $form->dropDownList($model, 'state', $cities, $model->getHtmlOptions('country', array('empty' => $this->tag->getTag('select', 'Select'), 'class' => 'input-text  form-control', 'onchange' => 'changeMap(); $("#map_canvas").css({"height":"400px"});'))); ?>
													<?php echo $form->error($model, 'state'); ?>
												</div>
											</div>
											<div class="insidecontent full-content">
												<div class="clearfix"><!-- --></div>
												<?php $this->renderPartial('root.apps.frontend.new-theme.views.place_property._ad_location_business', compact('form')); ?>

												<div class="clearfix"><!-- --></div>

											</div>

											<div class="clearfix"></div>
											<div class="row  form-group not-for-franch">

												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">

													<label for="BusinessForSale_mandate" class="required"><?php echo $model->getAttributeLabel('mandate'); ?><span class="required">*</span></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('mandate'), array('placeholder' => '', 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->textArea($model, 'mandate',  $mer); ?>
													<?php echo $form->error($model, 'mandate'); ?>
												</div>
											</div>

										</div>



										<div id="business_operation">

											<h4 class="subheading_font row ">Business Operation</h4>

											<div class="row  form-group">
												<?php
												$YesNoArray =    $model->YesNoArray2();


												?>
												<div class="clearfix"><!-- --></div>

												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_maid_room" class="required"><?php echo $model->getAttributeLabel('maid_room'); ?><?php echo in_array('maid_room', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('maid_room'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->dropDownList($model, 'maid_room', $YesNoArray, $mer); ?>
													<?php echo $form->error($model, 'maid_room'); ?>
												</div>
											</div>

											<div class="row  form-group">
												<?php
												$YesNoArray =    $model->Competitionmarket();


												?>
												<div class="clearfix"><!-- --></div>

												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_transaction_type" class="required"><?php echo $model->getAttributeLabel('transaction_type'); ?><?php echo in_array('transaction_type', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('transaction_type'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->dropDownList($model, 'transaction_type', $YesNoArray, $mer); ?>
													<?php echo $form->error($model, 'transaction_type'); ?>
												</div>
											</div>


											<div class="row  form-group">

												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_p_limits" class="required"><?php echo $model->getAttributeLabel('p_limits'); ?><?php echo in_array('p_limits', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('p_limits'), array('placeholder' => '', 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->textArea($model, 'p_limits',  $mer); ?>
													<?php echo $form->error($model, 'p_limits'); ?>
												</div>
											</div>

											<div class="row  form-group">

												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_disputes" class="required"><?php echo $model->getAttributeLabel('disputes'); ?><?php echo in_array('disputes', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('disputes'), array('placeholder' => '', 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->textArea($model, 'disputes',  $mer); ?>
													<?php echo $form->error($model, 'disputes'); ?>
												</div>
											</div>

											<div class="row  form-group">

												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_RetUnitCategory" class="required"><?php echo $model->getAttributeLabel('RetUnitCategory'); ?><?php echo in_array('RetUnitCategory', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('RetUnitCategory'), array('placeholder' => '', 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->textField($model, 'RetUnitCategory',  $mer); ?>
													<?php echo $form->error($model, 'RetUnitCategory'); ?>
												</div>
											</div>
											<div class="row  form-group">

												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_c_date" class="required"><?php echo $model->getAttributeLabel('c_date'); ?><?php echo in_array('c_date', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('c_date'), array('placeholder' => '', 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->dropDownList($model, 'c_date', $model->getPublishedYear(),  $mer); ?>
													<?php echo $form->error($model, 'c_date'); ?>
												</div>
											</div>


											<div class="row  form-group">
												<?php
												$YesNoArray =    $model->YesNoArray2();


												?>
												<div class="clearfix"><!-- --></div>

												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_w_for" class="required"><?php echo $model->getAttributeLabel('w_for'); ?><?php echo in_array('w_for', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('w_for'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->dropDownList($model, 'w_for', $YesNoArray, $mer); ?>
													<?php echo $form->error($model, 'w_for'); ?>
												</div>
											</div>


											<div class="row  form-group">

												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_RentPerMonth" class="required"><?php echo $model->getAttributeLabel('RentPerMonth'); ?><?php echo in_array('RentPerMonth', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?> (AED)</label>
												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('RentPerMonth'), array('placeholder' => '', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->textField($model, 'RentPerMonth',  $mer); ?><div class="pull-right"><?php echo $form->checkbox($model, 'fur_i',   array('style' => "    width: auto;    height: auto;    display: inline;    margin-right: 10px;")); ?><label for="BusinessForSale_fur_i"><?php echo $model->getAttributeLabel('fur_i'); ?></label></div>
													<?php echo $form->error($model, 'RentPerMonth'); ?>
												</div>
											</div>

											<div class="row  form-group">

												<div class="clearfix"><!-- --></div>
												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_interior_size" class="required"><?php echo $model->getAttributeLabel('interior_size'); ?><?php echo in_array('interior_size', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?> (AED)</label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('interior_size'), array('placeholder' => '', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->textField($model, 'interior_size',  $mer); ?><div class="pull-right"><?php echo $form->checkbox($model, 'inv_i',  array('style' => "    width: auto;    height: auto;    display: inline;    margin-right: 10px;")); ?><label for="BusinessForSale_inv_i"><?php echo $model->getAttributeLabel('inv_i'); ?></label></div>
													<?php echo $form->error($model, 'interior_size'); ?>
												</div>
											</div>
											<div class="row  form-group">
												<?php
												$YesNoArray =    $model->YesNoArray2();


												?>
												<div class="clearfix"><!-- --></div>

												<div class="col-sm-5 text-right">
													<label for="BusinessForSale_construction_status" class="required"><?php echo $model->getAttributeLabel('construction_status'); ?><?php echo in_array('construction_status', $model->businessrequirement()) ? '<span class="required">*</span>' : ''; ?></label>

												</div>
												<div class="col-sm-7">
													<?php $mer =  array_merge($model->getHtmlOptions('construction_status'), array('class' => 'input-text  form-control', 'empty' => $this->tag->getTag('select', 'Select'))); ?>
													<?php echo $form->dropDownList($model, 'construction_status', $YesNoArray, $mer); ?>
													<?php echo $form->error($model, 'construction_status'); ?>
												</div>
											</div>


										</div>




										<div class="clearfix"></div>
										<div class="row  form-group" id="h_expiry_date">



											<div class="col-sm-5 text-right">
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

										<div class="hide d-none" id="amn-features">
											<div class="clearfix"><!-- --></div>

											<h4 class="subheading_font row "><?php echo $this->tag->getTag('features_/_amenities', 'Features / Amenities'); ?></h4>
											<div class="clearfix"><!-- --></div>

											<div class="amn1">
												<style>
													.amlabel .form-check {
														width: 50% !important;
														float: left;
													}

													.amlabel .form-check:nth-child(2n+1) {
														clear: both;
													}
												</style>
												<div class="amn">
													<?php
													$categoris =   CHtml::listData(Master::model()->listData(2), 'master_id', 'master_name');
													//print_r($model->amenities) ;exit; 

													foreach ($categoris as $k => $v) {
														//$amenities_array=	 CHtml::listData(Amenities::model()->findAllCategories($k),'amenities_id','amenities_name');
														$amenities_array =	 Amenities::model()->findAllCategories($k);

														//echo $k.''. print_r($amenities_array); echo '<br />';echo '<br />';echo '<br />';echo '<br />';
														if (!empty($amenities_array)) {
															echo '<div class="col-sm-12 amlabel amn-' . $k . '" style="">';

															echo '<h4 class="spl-headd margin-top-5  margin-bottom-5">' . $v . '</h4><div class="clearfix"></div>';
															foreach ($amenities_array as $k => $v) {

																// echo '<div class="form-check form-check-flat"  id="amnitm_'.$k.'"><label class="form-check-label"><input class="amnit" value="'.$k.'" id="amenities_'.$k.'" '; echo  in_array($k,(array) $model->amenities) ? 'checked' : '';  echo ' type="checkbox" name="amenities[]" onclick="expandthis(this)" >  '.$v.' <i class="input-helper"></i></label></div>';

																if ($v->f_type == '0') {
																	echo '<div class="form-check form-check-flat"  id="amnitm_' . $v->amenities_id . '"><label class="form-check-label"><input class="amnit" value="' . $v->amenities_id . '" id="amenities_' . $v->amenities_id . '" ';
																	echo  in_array($v->amenities_id, (array) $model->amenities) ? 'checked' : '';
																	echo ' type="checkbox" name="amenities[' . $v->amenities_id . ']" onclick="expandthis(this)" >  ' . $v->amenities_name . ' <i class="input-helper"></i></label></div>';
																} else if ($v->f_type == '1') {
																	echo '<div class="form-check form-check-flat padding-left-0 padding-right-15"    id="amnitm_' . $v->amenities_id . '"><div style="width:calc(100% - 78px);color: #72727d !important;font-size:14px;line-height:1.2;padding: 2px 0px;" class="pull-left">' . $v->amenities_name . '</div><div style="width:78px;" class="pull-left">' . CHtml::dropDownList('amenities[' . $v->amenities_id . '][inp_val]', @$model->amenities[$v->amenities_id], array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8+'), array('empty' => '0', 'class' => 'input-text  form-control')) . '</div></div>';
																} else {
																	$vals =   isset($model->amenities[$v->amenities_id]['inp_val']) ?  $model->amenities[$v->amenities_id]['inp_val'] :  @$model->amenities[$v->amenities_id];
																	$on_input = ($v->i_o == '1') ? "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" : '';
																	echo '<div class="form-check form-check-flat padding-left-0 padding-right-15"    id="amnitm_' . $v->amenities_id . '"><div style="width:calc(100% - 78px);color: #72727d !important;font-size:14px;line-height:1.2;padding: 2px 0px;" class="pull-left">' . $v->amenities_name . '</div><div style="width:78px;" class="pull-left">' . CHtml::textField('amenities[' . $v->amenities_id . '][inp_val]', $vals, array('class' => 'input-text cmv  form-control', 'max-length' => '50', 'oninput' => $on_input)) . '</div></div>';
																}
															}



															echo '</div>';
														}
													}



													//	echo CHtml::checkBoxList('amenities',$model->amenities ,$amenities_array,array('separator'=>'','labelOptions'=>array('class'=>''),'template'=>'<div class="form-check form-check-flat"><label class="form-check-label">{input}  {labelTitle} <i class="input-helper"></i></label></div>'));                                              
													?>
												</div>
												<div class="clearfix"></div>
												<div class="expandDiv hide" onclick="toggleClassExpand()"></div>
												<div class="clearfix"></div>
												<?php echo $form->error($model, 'amenities'); ?>
											</div>
											<div class="clearfix"><!-- --></div>
										</div>


										<div class="clearfix"><!-- --></div>
									</div>






									<div class="insidecontent">
										<div class="clearfix"><!-- --></div>
										<div class="clearfix"><!-- --></div>
										<div class="">
											<div class="col-sm-12">
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


									<div class="_2ytqd"></div>
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
											<?php
											if (Yii::app()->isAppName('backend')) { ?>
												<div class="form-group col-lg-4">

													<?php echo $form->labelEx($model, 'user_id'); ?>
													<?php echo $form->dropDownList($model, 'user_id', CHtml::listData(ListingUsers::model()->findAll(), 'user_id', 'fullName'), $model->getHtmlOptions('user_id')); ?>
													<?php echo $form->error($model, 'user_id'); ?>
												</div>
											<?php } else {
											}

											?>



										</div>
									</div>

									<div class="clearfix"><!-- --></div>
									<?php
									if (Yii::App()->isAppName('frontend')) {  ?>
										<div class="insidecontent hide">
											<div class="clearfix"></div>

											<div class="row">
												<div class="form-group col-sm-6 wewqe hide">
													<?php if ($model->isNewRecord) {
														$model->user_id = '31988';
													}    ?>
													<?php echo $form->labelEx($model, 'user_id'); ?>
													<?php echo $form->hiddenField($model, 'user_id'); ?>
													<?php echo $form->error($model, 'user_id'); ?>
													<?php echo $form->hiddenField($model, 'section_id'); ?>
													<?php echo $form->error($model, 'section_id'); ?>


													<?php echo $form->hiddenField($model, 'w_for'); ?>
													<?php echo $form->error($model, 'w_for'); ?>

												</div>
											</div>
											<div class="clearfix"><!-- --></div>
										</div>
										<div class="_2ytqd"></div>
									<?php } else {

										$this->renderPartial('root.apps.frontend.new-theme.views.place_property._admin_settings_business', compact('form'));
									}

									?>

									<div class="clearfix"><!-- --></div>


								</div>
								<div class="clearfix"><!-- --></div>
							</div>
						</div>
					</div>
					<div class="box-footer  " style="border:0px;padding-top:0px;display:block !important ">
						<div class="pull-right">
							<?php
							if ($this->action->id == 'preview') {
							?>
								<a href="<?php echo Yii::App()->createUrl($this->id . '/create', array('preview' => $LocalStorage->cookie_name)); ?>" class="btn btn-primary  " style="background-color:var(--logo-color);border:1px solid var(--logo-color);"><?php echo $this->tag->getTag('update_property', 'Update Property'); ?></a>

							<?
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
					// validateInputSector();
				})
			<?
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
					$('#BusinessForSale_enter_city').val(d.city);

					$('#BusinessForSale_area_location').val($('#BusinessForSale_area_location').val()).change();

				})
			}

			function emptyInput(k) {
				if ($('#select_from_list').val() == '') {
					$(k).val('');
				}
			}
		</script>


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
				$('#BusinessForSale_ad_title').keyup(function() {


				});
				$('#BusinessForSale_ad_description').keyup(function() {

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
		<div class="clearfix"></div>
	</div>
</div>