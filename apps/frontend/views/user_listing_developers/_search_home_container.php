		<div class="row banner-row  row-banner-row-agent find-b">



		<!-- Banner
		================================================== -->
		<div class="main-search-container dark-overlay home">
		<div class="main-search-inner">
		<div class="container">


		<?php

		$form = $this->beginWidget('CActiveForm', array( 'id'=>'agent_search_frm',
		'action'=>Yii::app()->createUrl('user_listing_developers/find_agent_validate'),
		'enableAjaxValidation'=>true,
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>false,
		'afterValidate' => 'js:function(form, data, hasError) { 
		if(hasError) {
		return false;
		}
		else
		{
		$("#form-slider-submit").text("Loading..");
		ajaxSubmitHappenDeveloper(form, data, hasError,"'.Yii::app()->createUrl('user_listing_developers/index',array('country'=>'cn1','reg'=>'cn2','property'=>'cn3')).'"); 
		}
		}',
		),
		'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
		));
		$model->country_slug = $this->default_country_slug;
		?>
		<div class="col-md-8 col-sm-8">

		</div>

		<div class="col-md-4 col-sm-4  slider-banner">
		<div class="form-slider-wrapper">
		<header>
		<h3>Find Your  Developer</h3>
		</header>
		<hr>
		 
		<div class="form-group">
		<?php echo $form->dropDownList($model, 'country_slug',CHtml::listData(Countries::model()->listingCountries(),'slug','country_name'),$model->getHtmlOptions('country_slug',array('class'=>'form-control','empty'=>'Select Country', 'onchange'=>'findCities(this)'  ))); ?>
		<?php echo $form->error($model, 'country_slug');?>
		</div>                                
		<div class="form-group">
		<?php echo $form->dropDownList($model, 'region',CHtml::listData(States::model()->findListingCountries($model->country_slug),'slug','state_name'),$model->getHtmlOptions('region',array('class'=>'form-control','empty'=>'Select region' ))); ?>
		</div>                                
		<div class="form-group">
		<?php echo $form->textField($model, 'property',$model->getHtmlOptions('property',array('class'=>'form-control','placeholder'=>'Search developers ,  property ..' ))); ?>

		</div><!-- /.form-group -->
		<div class="form-group">
		<div id="form-slider-status"></div>
		<button type="submit" id="form-slider-submit" class="btn btn-default" data-loading-text="Processing..">Search!</button>
		</div><!-- /.form-group -->
		</div><!-- /.form-slider-wrapper -->
		</div>




		<?php $this->endWidget();?>



		</div>
		</div>
		<!-- Video -->
		<div class="video-container myKenburns">
		<?php 

		$banners =   $this->banners;
		if( $banners){
		?>
		<div class="row fullwidth">
		<div class="columns small-12 slider">
		<?php 
		foreach($banners as $k=>$v){
		?>
		<div class="text-center slide" style="  background-image: url('<?php echo Yii::app()->apps->getBaseUrl('uploads/banner/'.$v->image);?>'); "></div>
		<?php } ?> 

		</div>
		</div>
		<?

		}; ?>
		</div>
		<script>
		var nodelT = '<?php echo $model->modelName;?>';
		function findCities(k){
		$('#'+nodelT+'_region').attr('disabled',true);
		$.get('<?php echo Yii::app()->createUrl('site/loadCityByCountry');?>',{country_id:$(k).val()},function(data){
		$('#'+nodelT+'_region').select2('destroy'); 
		$('#'+nodelT+'_region').html(data).select2();$('#'+nodelT+'_region').attr('disabled',false);

		})
		}
		</script>
		<style>
		.video-container .slider { border-radius:  0px; background:#000;} 
		</style>
		<script>

		$(function(){
		$('.slider').slick({
		dots: false,
		autoplay: true,
		autoplaySpeed: 7000,

		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear',
		lazyLoad: 'ondemand',
		lazyLoadBuffer: 0,
		mobileFirst: true,
		prevArrow: false,
		nextArrow: false
		});

		})


		</script>
		</div>
		</div>
