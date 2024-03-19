
<style>
#mainContainerClass {width:100%; max-width:100%;}
.tp_banner {height:150px;background-color:var(--secondary-color);color:#fff;display: flex;align-items: center;justify-content: center; margin-bottom:50px;}
.tp_banner .h2{ color:#fff}
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
}.site-block h1 {
	margin: 0;
	font-weight: 600;
	font-size: 16px;
	line-height: 20px;
}.site-block:hover {
	border: 1px solid var(--secondary-color);
	color:var(--secondary-color);
	box-shadow: 0 20px 40px 0 rgba(0,0,0,.1);
}




/* -------- PROPERTY SEARCH  ------- */
.property-query-area.property-page-bg,
.query-title,
.single-query select {
    position: relative;
}
.query-title {
    margin-top: -70px;
    text-align: center;
    z-index: 20;
}
.single-query option,
.query-title > h2 a {
    color: #fff;
}
.query-title > h2 {
    font-size: 18px;
    font-weight: bold;
    padding: 21px 0;
    text-transform: uppercase;
}
.single-query label,
.single-query-slider label {
    font-size: 14px;
    margin-bottom: 7px;
    font-weight: 500;
}
.single-query {
    margin-bottom: 10px;
}
.single-query {
    margin-bottom: 10px;
}
.single-query .keyword-input {
    border: 1px solid rgba(229, 229, 229, 1);
    height: 40px;
    border-radius: 0;
    padding-left: 10px;
    width: 100%;
    background: #fff;
}
.single-query input,
.single-query select {
    text-transform: normal;
    background: transparent;
}
.search-2 .intro .zelect,
.intro .zelect,
.single-query input,
.single-query select {
    width: 100%;
}
.single-query select {
    -moz-appearance: none;
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: rgba(0, 0, 0, 0) url("https://logicsforest.com/themeforest/idea-homes/ideahomes_demo_files/images/select-icon.png") no-repeat scroll right center;
    border-bottom: 1px solid rgba(229, 229, 229, 1);
    border-image: none;
    border-left: 1px solid rgba(229, 229, 229, 1);
    border-radius: 5px;
    border-top: 1px solid rgba(229, 229, 229, 1);
	border-right: 1px solid rgba(229, 229, 229, 1);
    color: #999999;
    height: 40px;
    padding: 10px;
    margin-bottom: 15px;
    width: 100%;
}
.single-query option {
    border-bottom: 1px solid #ddd;
    padding: 10px;
}
.toggle-btn button {
    background: rgba(0, 0, 0, 0.2);
    border: 0 none;
    border-radius: 2px 2px 0 0;
    font-size: 24px;
    height: 36px;
    line-height: 24px;
    margin: 0;
    padding: 0;
    width: 65px;
}
.nstSlider {
    height: 2px;
    top: 8px;
    background-color: #efefef;
    position: relative;
    z-index: 1;
}
.query-submit-button {
    display: inline-block;
}
.nstSlider .rightGrip,
.nstSlider .leftGrip {
    width: 12px;
    height: 12px;
    top: -6px;
    background-color: #676767;
}
.nstSlider .bar {
    height: 2px;
    top: 0;
    background-color: #454040;
    width: 100%;
}
.leftLabel,
.rightLabel {
    color: #676767;
    display: inline-block;
}
.single-query-slider .price {
    display: inline-block;
    float: right;
    font-size: 14px;
}
.white .nstSlider {
    background-color: #5D6D7E;
}
.white .nstSlider .bar,
.white .nstSlider .rightGrip,
.white .nstSlider .leftGrip {
    background-color: #fff;
}
.white .leftLabel,
.white .rightLabel,
.toggle-btn button,
.btn-slide,
.search-properties .group-button-search .more-filter .text-1,
.search-properties .group-button-search .more-filter .text-2,
.search-properties .group-button-search .more-filter .icon {
    color: #fff;
}
.user-properties-filters {
    background-color: #fcfcfd;
}
.user-properties-filters .wrapper-filters {
    padding-top: 40px;
    padding-bottom: 15px;
    margin-left: 0;
    margin-right: 0;
}
.btn-slide:hover {
    border-color: #2aacff;
}
.btn-slide {
    border: medium none;
    border-radius: 4px;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    height: 48px;
    line-height: 48px;
    text-align: center;
    text-transform: uppercase;
    width: 160px;
}
.search-properties .group-button-search {
    width: 100%;
}
.search-properties .group-button-search .more-filter {
    display: inline-block;
    line-height: 50px;
}
.search-properties .group-button-search .more-filter .text-1,
.search-properties .group-button-search .more-filter .text-2,
.search-properties .group-button-search .more-filter .icon {
    display: inline-block;
    margin-bottom: 0;
    text-transform: uppercase;
    transition: all 0.5s ease;
}
.search-properties .group-button-search .more-filter .text-1,
.search-properties .group-button-search .more-filter .text-2 {
    padding-right: 15px;
    font-weight: 700;
    cursor: pointer;
}
.search-properties .group-button-search .more-filter .text-2 {
    letter-spacing: 0.045em;
}
.search-properties .group-button-search .more-filter .icon {
    font-size: 1.14em;
}
.search-properties .group-button-search .more-filter.show-more .icon {
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
}
.search-properties .group-button-search .btn-search {
    display: inline-block;
    float: right;
}
.search-properties.search-page {
    padding: 60px 0;
}
.search-properties.search-page .btn-search {
    margin-top: 30px;
}
.search-properties.bg-gray {
    background-color: #fcfdfd;
}
.search-properties.bg-gray .title-search-property {
    font-size: 24px;
    font-weight: 700;
    text-align: left;
    text-transform: capitalize;
    margin-bottom: 30px;
}
.search-properties.bg-gray .group-button-search .more-filter .text-1,
.search-properties.bg-gray .group-button-search .more-filter .text-2,
.search-properties.bg-gray .group-button-search .more-filter .icon {
    color: #838e95;
}
.search-propertie-filters {
    background-color: #f4f4f4;
    position: relative;
    margin-top: 20px;
}
.search-propertie-filters .container-2 {
    padding: 20px 0 0 20px;
}
.search-propertie-filters.bg-gray {
    background-color: #fcfdfd;
}
.group-button-search {
    margin-top: 30px;
    position: relative;
    border-radius: 4px;
    display: inline-block;
    padding: 8px 20px 8px 10px;
}
.group-button-search a {
    display: block;
    font-size: 12px;
}
.more-filter i {
    border-radius: 100%;
    color: #191919 !important;
    font-size: 12px;
    height: 30px;
    line-height: 31px;
    text-align: center;
    width: 30px;
    background: #fff;
}
.search-form-group {
    display: inline-block;
    margin-bottom: 25px;
    width: 100%;
}
.more-filter .text-1,
.more-filter .text-2 {
    cursor: pointer;
    padding-right: 0;
}
.more-filter .text-1,
.more-filter .text-2,
.more-filter .icon {
    color: #fff;
    display: inline-block;
    margin-bottom: 0;
    vertical-align: middle;
    text-transform: capitalize;
    font-weight: 500;
    margin-right: 6px;
}
.search-form-group .type-checkbox {
    cursor: pointer;
    font-weight: normal;
    letter-spacing: 0.1em;
    margin-bottom: 0;
}
.search-form-group input[type=checkbox] {
    display: none;
}
.search-form-group input[type=checkbox] + label:before {
    font-family: FontAwesome;
    display: inline-block;
}
.search-form-group input[type=checkbox] + label:before {
    content: "\f096";
}
.search-form-group input[type=checkbox] + label:before {
    letter-spacing: 10px;
}
.search-form-group input[type=checkbox]:checked + label:before {
    content: "\f14a";
}
.search-form-group input[type=checkbox]:checked + label:before {
    letter-spacing: 9px;
}
.search-form-group.white .type-checkbox {
    color: #999999;
}
.single-query .zelected::after,
.search-2 .single-query .zelected::after {
    content: url(../images/select-icon.png);
    position: absolute;
    right: 0;
    top: 0;
}
.intro .zelect {
    display: inline-block;
    background-color: #fff;
    min-width: 100%;
    cursor: pointer;
    border: 1px solid #dbdece;
    border-radius: 0;
    position: relative;
}
.intro .zelected {
    font-weight: normal;
    height: 40px;
    padding-left: 15px;
    padding-top: 9px;
    color: #ccc;
}
.intro .zelect.open {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.intro .dropdown {
    background-color: #fff;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    border: 1px solid #dbdece;
    border-top: none;
    position: absolute;
    left: -1px;
    right: -1px;
    top: 36px;
    z-index: 2;
    padding: 3px 5px 3px 3px;
}
.intro .dropdown input {
    font-family: sans-serif;
    outline: none;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #dbdece;
    color: #ccc;
    box-sizing: border-box;
    width: 100%;
    padding: 7px 0 7px 10px;
}
.intro .dropdown ol {
    padding: 0;
    margin: 3px 0 0 0;
    list-style-type: none;
    max-height: 150px;
    overflow-y: scroll;
}
.intro .dropdown li {
    padding: 8px 12px;
}
.zearch-container {
    margin: 10px;
}
.zearch-container::after {
    content: "";
    font-family: FontAwesome;
    position: absolute;
    right: 25px;
    top: 20px;
    color: #999999;
}
.intro .dropdown li.current {
    color: #fff;
}
.intro .dropdown li:hover {
    background-color: #b7b7b7;
    color: #fff;
}
.intro .dropdown .no-results {
    margin-left: 10px;
    color: #cccc;
}
.search-2 .zearch-container {
    display: none;
}
/*Custom checkbox*/

.check-box {
    width: 22px;
    height: 22px;
    cursor: pointer;
    display: inline-block;
    margin: 2px 7px 0 0;
    position: relative;
    overflow: hidden;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    background: rgb(255, 255, 255);
    border: 1px solid #dbdbdb !important;
}
.check-box i {
    background: url("../images/check_mark.png") no-repeat center center;
    position: absolute;
    left: 3px;
    bottom: -15px;
    width: 16px;
    height: 16px;
    opacity: .5;
    -webkit-transition: all 400ms ease-in-out;
    -moz-transition: all 400ms ease-in-out;
    -o-transition: all 400ms ease-in-out;
    transition: all 400ms ease-in-out;
    -webkit-transform: rotateZ(-180deg);
    -moz-transform: rotateZ(-180deg);
    -o-transform: rotateZ(-180deg);
    transform: rotateZ(-180deg);
}
.checkedBox {
    -moz-box-shadow: inset 0 0 5px 1px #ccc;
    -webkit-box-shadow: inset 0 0 5px 1px #ccc;
    box-shadow: inset 0 0 5px 1px #ccc;
    border-bottom-color: #fff;
}
.checkedBox i {
    bottom: 2px;
    -webkit-transform: rotateZ(0deg);
    -moz-transform: rotateZ(0deg);
    -o-transform: rotateZ(0deg);
    transform: rotateZ(0deg);
}
/*Custom radio button*/

.radio-btn {
    width: 20px;
    height: 20px;
    display: inline-block;
    float: left;
    margin: 3px 7px 0 0;
    cursor: pointer;
    position: relative;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 1px solid #ccc;
    box-shadow: 0 0 1px #ccc;
    background: rgb(255, 255, 255);
    background: -moz-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(255, 255, 255, 1)), color-stop(47%, rgba(246, 246, 246, 1)), color-stop(100%, rgba(237, 237, 237, 1)));
    background: -webkit-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
    background: -o-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
    background: -ms-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
    background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
    filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed', GradientType=0);
}
.checkedRadio {
    -moz-box-shadow: inset 0 0 5px 1px #ccc;
    -webkit-box-shadow: inset 0 0 5px 1px #ccc;
    box-shadow: inset 0 0 5px 1px #ccc;
}
.radio-btn i {
    border: 1px solid #E1E2E4;
    width: 10px;
    height: 10px;
    position: absolute;
    left: 4px;
    top: 4px;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
}
.checkedRadio i {
    background-color: #898A8C;
}
.search-form-group.white > span {
    vertical-align: super;
}

/******** AGENT PROFILE - 2 ******/

#agent-p-2 .property-query-area {
    background: #fff;
}
#agent-p-2 .agetn-contact-2 p {
    color: #676767;
    font-size: 15px !important;
    padding-bottom: 24px;
    text-align: right;
}
#agent-p-2 .agetn-contact h6 {
    color: #676767;
    padding-bottom: 20px;
}
.agent-p-contact {
    border-bottom: 1px solid #e5e5e5 !important;
    padding-bottom: 10px;
}
.single-query textarea {
    border: 1px solid rgba(229, 229, 229, 1);
    border-radius: 0;
    height: 140px;
    width: 100%;
    margin-bottom: 15px;
    padding-left: 10px;
    padding-top: 15px;
    transition: all 0.3s ease 0s;
}
#agent-p-2 .single-query > input[type="text"] {
    width: 100%;
    background: #fff;
}
#agent-p-2 .single-query .intro .zelect {
    width: 100%;
}
#agent-p-2 .single-query .intro::after {
    right: 20px;
}
#agent-p-2 .search-2 .single-query .intro::after {
    left: 115px;
}
#agent-p-2 .single-query .intro {
    margin-bottom: 15px;
}
#agent-p-2 .group-button-search a.more-filter .fa {
    color: #000 !important;
}
#agent-p-2 .search-propertie-filters {
    background-color: transparent;
}
#agent-p-2 .search-form-group {
    margin-bottom: 20px;
    margin-left: -17px;
}
#agent-p-2 .search-form-group .check-box i {
    opacity: 1;
}
#agent-p-2 .search-form-group .check-box {
    border: none;
    box-shadow: none;
}
#agent-2-peperty .property_item .property_head {
    padding: 20px 0 20px 20px;
}
#agent-2-peperty .property_item .price {
    position: absolute;
    top: 80%;
}
#agent-2-peperty .property_item .price .tag {
    padding: 15px 30px;
}
#agent-2-peperty .favroute p {
    font-size: 12px;
}
#agent-2-peperty .feature .tag-2 {
    right: 4%;
}
#agent-2-peperty .feature .tag {
    left: 15px;
}
.p-image > img {
    width: 100%;
}
.feature-p-text > a {
    color: #fff;
    padding: 8px 16px;
}
.feature-p-text > h4 a {
    font-size: 18px;
    color: #1f1f1f;
}
.feature-p-text > p {
    font-size: 12px;
}
#agent-2-slider .item {} #agent-2-slider .item img {
    display: block;
    width: 100%;
    height: auto;
}
#agent-2-slider .property_meta {
    padding: 15px;
    font-weight: bold;
}
#agent-2-slider .property_meta,
#agent-2-slider .property_meta h4 {
    color: #fff;
    display: inline-block;
    font-family: 'Roboto';
}
#agent-p-2 .our-agent-box > h3 {
    margin-bottom: 15px;
}
#agent-2-peperty .property_item {
    margin-bottom: 40px;
}
#agent-2-peperty .media {
    margin-bottom: 30px;
}
.property_meta > p {
    display: inline-block;
    font-size: 12px;
    margin-left: 30px;
}
/* ================================= */
/* ------ FAVORITE PROPERTIES ------ */
/* ================================= */

.f-p-links {
    margin-bottom: 50px;
}
.f-p-links > li {
    display: inline-block;
    margin: -2px;
}
.f-p-links > li a {
    background: #454040;
    color: #fff;
    display: block;
    font-size: 15px;
    height: 57px;
    line-height: 57px;
    text-align: center;
    width: 228px;
}
.f-p-links > li a.active {
    color: #fff;
}
.f-p-links > li a:hover {
    color: #fff;
}
.f-p-links > li + li {
    border-left: 1px solid #dbdbdb;
}
.f-p-links li a i {
    font-size: 22px;
    vertical-align: sub;
    margin-right: 5px;
}
.custom-checkbox input[type="radio"] {
    margin: 4px 5px 0 !important;
    width: 12px;
    height: 12px;
}
.main-div{
	border: 1px solid gainsboro;
    border-radius: 15px;
    padding:  30px; margin-top:-100px;
	   
		box-shadow: 0 1px 6px 0 rgb(32 33 36 / 28%) !important;background: #fff;
    z-index: 1;
}



.alert.alert-block.alert-success{
	position: absolute !important;
	top: 165px !important;
    width: 550px !important;
    left: 475px !important;
}
.alert .close{
	width: 22px !important;
	float: right !important;
    font-size: 21px !important;
}.banner {
    margin-left: -15px;
    margin-right: -15px;
    width: calc(100% + 30px);
    position: relative;
    height: 20.56vw;
    background-color: rgba(0,0,0,0.8);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;margin-bottom:0px;
}.abs-banner {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    color: #fff;
    z-index: 1;
    content: '';background: rgba(0,0,0,0.2);
}.bloghead {
    align-items: center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
    font-weight: 300;
    display: flex;
    z-index: 1;
    position: relative;
} .fancy-title {
    color: #fff;
    font-size: 33px;
    font-weight: 900;
    text-shadow: 1px 1px #000;margin-bottom:0px;padding:0px;
}
#signUpForm { max-width:500px;margin:auto;}#signUpForm  h2{ font-size:20px;    margin-bottom: 25px;}
#signUpForm .form-group {
    margin-bottom: 15px;
}
.iti{ width:100%;}
</style>
 
<section class="panel1 panel-bg banner" style="background-image:url(<?php echo $img;?>);">
    <div class="abs-banner"> 
            <div class="bloghead container"> 
                <div class="fancy-title-hold text-initial clearfix">
                   <h3 class="fancy-title animate animated"><span class="title"><?php echo $this->tag->getTag('submit__jv_proposal','Submit  JV Proposal');?></span></h3>
                </div>
            </div> 
    </div> 
</section>
<section class="property-details padding">
  <div class="container">
    
    <div class="row">
    
      <div class="col-md-1"></div>
      
      <div class="col-md-10 col-sm-12 col-xs-12 main-div">
      
        <div class="property-query-area">
     
          
         	<?php
						$maintTaxt = $this->tag->getTag('submit_proposal','Submit Proposal');
	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
					$form = $this->beginWidget('CActiveForm', array(
					       'id' =>'signUpForm',
					'action'=>Yii::app()->createUrl($this->id.'/index'),
					'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {
				     
						form.find("#bb").val("'.$Validating.'");
						return true;
					}',
					'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb").val("'.$maintTaxt.'");
							 
							return false;
							}
							else
							{
							form.find("#bb").val("'. $please_wait .'"); 
					return true;
							  
							}
							}',
							),
					));
					?>
          <style>
              #PostRequirements_p_for ,#PostRequirements_owner_type{ display:flex; }
              .m-btu { display:flex; margin-right:15px; }
              .form-control { 
    border: 1px solid #eee !important;
}
.note {   font-size:12px; color:#bbb; border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:15px;}
.col-sm-4 label {
     
    margin-bottom: 0px;
    font-weight: normal;
    font-size: 14px;
}.form-control {
    height: 40px;
    text-indent: 10px;
}
          </style>
          <div class="note"><?php echo $this->tag->getTag('please_fill_the_below_given_fo','Please fill the below given form, so that we can assist your specific needs.');?></div>
        
     
<h2 ><?php echo $this->tag->getTag('your_contact_details','Your Contact Details');?></h2>
	 
        <div class="row form-group">
        <div class="col-sm-4 text-right">
        <?php echo $form->labelEX($model, 'name');?>
        
        </div>
        <div class="col-sm-8">
        <?php   
        
        echo $form->textField($model, 'name',  $model->getHtmlOptions('name',array('placeholder'=>'' ))); ; ?>
        <?php echo $form->error($model, 'name');?>
        </div>
        </div>
<div class="row form-group">
        <div class="col-sm-4 text-right">
        <?php echo $form->labelEX($model, 'email');?>
        
        </div>
        <div class="col-sm-8">
        <?php   
        
        echo $form->textField($model, 'email',  $model->getHtmlOptions('email',array('placeholder'=>'' ))); ; ?>
        <?php echo $form->error($model, 'email');?>
        </div>
        </div>
	    <div class="row form-group">
        <div class="col-sm-4 text-right">
        <?php echo $form->labelEX($model, 'mobile');?>
        
        </div>
        <div class="col-sm-8">
        <?php   
        
        echo $form->textField($model, 'mobile',  $model->getHtmlOptions('mobile',array('placeholder'=>'','onchange'=>'validateThisInp()', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ))); ; ?>
        	<?php 
							$model->is_phone_validated = '1'; 
							echo $form->hiddenField($model, 'is_phone_validated');  
							echo $form->error($model, 'is_phone_validated'); ?>
						
        <?php echo $form->error($model, 'mobile');?>
        </div>
        </div>


  <h2 class="margin-top-40"><?php echo $this->tag->getTag('jv_details','JV Details');?></h2>
    <div class="row form-group">
						<div class="col-sm-4 text-right">
						    <?php echo $form->labelEX($model, 'jv_business_cat');?>
						
						</div>
							<div class="col-sm-8">
								<?php    
								echo $form->dropDownList($model, 'jv_business_cat',   MainCategory::model()->generateOptBusiness(), $model->getHtmlOptions('jv_business_cat',array('empty'=>$this->tag->getTag('please_select','Please Select')))); ; ?>
								<?php echo $form->error($model, 'jv_business_cat');?>
							</div>
	    </div>

	 <div class="row form-group">
						<div class="col-sm-4 text-right">
						    <label for="<?php echo $model->modelName;?>_investment_amount_min" class="required"><?php echo   $this->tag->getTag('investment_amount_involved','Investment Amount Involved');?> <span class="required">*</span></label>
						
						</div>
							<div class="col-sm-8">
							    <div class="row">
                                        <div class="col-sm-6">
                                        <?php    
                                        echo $form->textField($model, 'investment_amount_min',  $model->getHtmlOptions('investment_amount_min',array('placeholder'=>$this->tag->getTag('min','Minimum'), 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"))); ; ?>
                                        <?php echo $form->error($model, 'investment_amount_min');?>
                                        </div>
                                        <div class="col-sm-6">
                                        <?php    
                                        echo $form->textField($model, 'investment_amount_max',  $model->getHtmlOptions('investment_amount_max',array('placeholder'=>$this->tag->getTag('max','Maximum'), 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"))); ; ?>
                                        <?php echo $form->error($model, 'investment_amount_max');?>
                                        </div>
								</div>
								
							</div>
	    </div>
		
		
		  <div class="row form-group">
						<div class="col-sm-4 text-right">
						    <?php echo $form->labelEX($model, 'description');?>
						
						</div>
							<div class="col-sm-8">
								<?php    
								echo $form->textArea($model, 'description',  $model->getHtmlOptions('description',array('empty'=>'Please Select'))); ; ?>
								<?php echo $form->error($model, 'description');?>
							</div>
	    </div>
           <div class="row </div>">
                    <div class="col-sm-6">
                        <div class="row">
                        
                                  
											   <div class="col-lg-10">
						<div class="form-group  ">
						<style>
						#div_view_whatsapp_c_image img { width:100px !important; }
						</style>
						<?php  
						$fileField = 'attachment1';
						$types = '.pdf,.doc,.docx,.pptx,.jpg,.png';
						$maxFiles = '1';
						$maxFilesize = '2';
					 	$title_text =   $this->tag->getTag('upload','Upload') ;
						$this->renderPartial('_file_field_browse3',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
						?>

						</div>
                            	<div class=" ">
							    
							<div class="rui-qvKkT1 margin-bottom-10 bg-warning" style="font-size: 12px;padding: 5px;line-height:1;  display:inline;"><span style="white-space: nowrap;align-items: center;"><?php echo $this->tag->getTag('allowed','Allowed');?>: <b><?php echo $types;?></b></span><br /><span>Size upto <b><?php echo $maxFilesize;?>MB</b></span></div>
						 
							    
							</div>

							</div> 
						</div>
						<style>#abc_banner .btn {width:100% !important;height: auto !important; } #abc_banner.browse_type .dropzone .dz-message .upload-btn-wrapper{ padding: 0px;box-shadow: unset;max-width: 200px;}
						#abc_image  .dz-preview { display:none !important; }
						#file_image .upload-btn-wrapper .drop_fil{ margin-top:15px !important; }
						</style>
						<div class="clearfix"></div>
                  
						 
	
                        </div>
                    </div>
                    </div>
        <div class="row">
            	<div class="pop_boxone">
						<?php
						$min_error_count  = 1 ; 
					  
									$min_error_count  = 2 ; 
									?> 
									<div class="form-group  margin-bottom-0">
									 
									<script src="https://www.google.com/recaptcha/api.js?render=explicit&onload=onRecaptchaLoadCallback"></script>
								 
					<script>
    function onRecaptchaLoadCallback() {
        var clientId = grecaptcha.render('inline-badge', {
            'sitekey': '<?php echo Yii::app()->options->get('system.common.re_captcha_key','6Ldsl2IaAAAAAGSkGrL7xUeucC9yKthmDsYWdTmy');?>',
            'badge': 'bottomleft',
            'size': 'invisible'
        });

        grecaptcha.ready(function() {
            grecaptcha.execute(clientId, {
                    action: 'action_name'
                })
                .then(function(token) {
                    $('#signUpForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                    // Verify the token on the server.
                });
        });
    }
</script>			   
								 
									<?php echo $form->error($model, '_recaptcha',array('style'=>'top:0px !important;'));?>
								 
					            	</div>
					  
						<div class="clear_div"></div>
						</div>
          </div>
            <div class="row">
                    <div class="col-sm-4"> </div>                 
                    <div class="col-sm-8">
                         <div class="row">
		 				        <script>
		 				        function setAgree(k){
		 				            if($(k).is(':checked')){
		 				                $('#bb2').prop("disabled",false);
		 				            }
		 				            else{
		 				                 $('#bb2').prop("disabled",true);
		 				            }
		 				        }
		 				        </script>
                             <style>.btn-primary.disabled, .btn-primary:disabled {
    color: #fff;
    background-color: #666;
    border-color: #666;
    cursor: not-allowed;
    opacity: 0.3;
}.container_check .checkmark {  background-color: #fff; }.checkboxes label {  color: #000; margin-top: 15px;  font-weight: 300; }</style>
							<div class="col-sm-12 margin-top-10 text-center">
							    <?php $model->agree = '1'; ?>
				        	<div class="checkboxes"  >
						<label class="container_check mb-0 text-left" style="white-space: nowrap;" for="<?php echo $model->modelName;?>_agree"><?php echo Yii::t('app', $this->tag->getTag('by_clicking_you_agree_our_{lin','By clicking you agree our {link1} ') ,array('{link1}'=>'<a href="'.Yii::app()->createUrl('terms').'" target="_blank" class="link_color ml-1" style="position:relative;z-index:1;">  '.$this->tag->getTag('terms_and_conditions','terms and conditions').'</a>' ));?>
						<?php  echo $form->checkBox($model , 'agree',  $model->getHtmlOptions('agree',array('uncheckValue'=>'', 'value'=>'1','onchange'=>'setAgree(this)' )) );  ?> 
						  <span class="checkmark"></span>
						</label>
					
					</div>	<?php echo $form->error($model, 'agree');?>
					</div>
					</div>
			
					<input type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n" style="color:#fff;width:100% !important;margin-bottom:40px;" id="bb" value="<?php echo $maintTaxt;?>" />
                    </div>
                
            </div>
            
      

          <?php $this->endWidget(); ?>
          
			
          
        </div>
      </div>
      
      <div class="col-md-1"></div>
      
    </div>
    
  </div>
</section> 
<script>
			var iti; 
			function validateThisInp(){
if(!iti.isValidNumber()){
 
	$('#<?php echo $model->modelName;?>_is_phone_validated').val('');
	 
}
else{
 
	$('#<?php echo $model->modelName;?>_is_phone_validated').val('1'); 
	 
}
}
 
			$(function(){
    var input = document.querySelector("#<?php echo $model->modelName;?>_mobile");
     
    window.intlTelInput(input, {
       
    hiddenInput: "phone_false",
       initialCountry: "ae",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
     
       placeholderNumberType: "MOBILE",
    //   preferredCountries: ['ae', 'kw' ],
        separateDialCode: true,
      utilsScript: "<?php echo Yii::app()->apps->getBaseUrl('assets/js/build/js/utils.js');?>",
    });
    
     iti = window.intlTelInputGlobals.getInstance(input);
 
    });
    
    
  </script>
<div id="inline-badge"></div>
