<!DOCTYPE html>
<html  lang="en" class="absolutehtml <?php echo $this->secure_header == '1' ? 'secure' : '';?>">
<head>
   <title><?php  echo  $pageTitle.' | '.$this->project_name;  ?></title>
   <link rel="shortcut icon" href="<?php echo  $this->app->apps->getBaseUrl('assets/img/favicon.ico');?>" type="image/x-icon" />
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   	<meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
	<meta name="keywords" content="<?php echo $this->app->options->get('system.common.home_meta_keywords');?>">
	<meta name="google-site-verification" content="gYY9Itu5_ej42w0P_Wi9ISGUEFs_4gMA4yWC-QLVmpg" />
  <meta property="og:image" content="<?php echo 'https://www.rgestate.com/theme/assets/images/logo.svg'; ?>"/>
      <meta property="og:image:secure_url" content="<?php echo 'https://www.rgestate.com/theme/assets/images/logo.svg'; ?>"/>
      <meta property="og:image:width" content="1200">
      <meta property="og:image:height" content="420">
      
 <?php
  if($this->id=='detail' and in_array($this->action->id,array('index','project'))){
    ?>
      <meta property="fb:app_id" content="<?php echo $this->options->get('system.common.facebook_app_id');?>">
      <meta property="og:site_name" content="<?php echo $this->options->get('system.common.site_name');?>">
      <meta property="og:title" content="<?php echo $title;?>">
      <meta property="og:description" content="<?php echo $description;?>">
      <meta property="og:type" content="article">
      <meta property="og:url" content="<?php echo  $shareUrl;?>">
      
      <meta property="og:locale" content="en_US">
      
        <meta name="twitter:widgets:csp" content="on">
        <meta name="twitter:card" content="photo">
        <meta name="twitter:url" content="<?php echo  $shareUrl;?>">
        <meta name="twitter:image" content="https://www.askaan.com/uploads/images/<?php echo $image;?>">
        <meta name="twitter:title" content="<?php echo $title;?>">
        <meta name="twitter:description" content="<?php echo $description;?>">
        <meta name="twitter:site" content="<?php echo $this->options->get('system.common.site_name');?>">
       
    <?php
  }
  ?>
   <!-- CSS
      ================================================== -->
   <link rel="icon" type="image/x-icon" href="<?php echo $this->appAssetUrl('images/fav.png');?>" />
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('vendor/jquery-ias/dist/jquery-ias.min.js');?>"></script>
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/custom.js?q=15');?>"></script> 
    <!-- Global site tag (gtag.js) - Google Analytics -->
    
</head>
<body id="<?php echo $this->id;?>">
	<div id="base-container">
	<!-- Wrapper -->
	<div id="wrapper">
	<!-- Header Container
	================================================== -->
	<?php 
	if($this->secure_header  == '1'){ 

	$this->widget('frontend.components.web.widgets.header_new2.SecureWidget');

	}
	else{
	$this->widget('frontend.components.web.widgets.header_new2.HeaderWidget');
	}
	
	 ?>
	<div class="clearfix"></div>
	<!-- Header Container / End --> 
	  <div class="container_class">
	 <div id="notify-container">
                        <?php echo Yii::app()->notify->show();?>
                    </div>
	<?php echo $content;?>
	   <div class="clearfix"></div>
        </div>
        
	</div>
	<?php 
	if(!empty($_show_agent)){
		$this->renderPartial('//user_listing/top_agents');
	} 
	if(!empty($_show_developer)){
		$this->renderPartial('//user_listing_developers/top_agents');
	} 
	?>
   <!-- Footer
      ================================================== -->
   <?php 
   if($this->secure_header !=  '1'){ 
   
   $this->widget('frontend.components.web.widgets.footer.FooterWidget'); 
   
   } 
   ?> 
   <!-- Footer / End --> 
   <!-- Back To Top Button -->
   <div id="backtotop"><a href="#"></a></div>
   </div>
   <!-- Wrapper / End --> 
   <!-- Scripts
      ================================================== --> 
   <!--<script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script> -->
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/mmenu.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/chosen.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/slick.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/rangeslider.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/magnific-popup.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/waypoints.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/counterup.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/tooltips.min.js');?>"></script> 
    <div id="area_unitChanger" class="zoom-anim-dialog mfp-hide">
  <div class="small-dialog-header">
    <h3>Change Area</h3>
  </div>
   <div id="raw_ht_ml1" style="min-height:95px;">
		<div class="form-group">
		<form action="<?php echo Yii::app()->createUrl('site/change_area_unit',array('action'=>base64_encode(Yii::app()->request->requestUri)));?>">
		<?php echo CHtml::dropDownList('unit',AREAUNIT,CHtml::listData(AreaUnit::model()->listData(),'master_id','master_name'),array('class'=>'form-control'));?>
		 <button type="submit" class="btn_1 full-width" style="margin-top:10px;">Save</button>
		 </form> 
		 		</div>
   </div>
    <!--form --> 
</div>

</body>
</html>
