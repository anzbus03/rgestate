<!DOCTYPE html>
<head>
   <title><?php $p_title =  !empty($pageTitle) ? $pageTitle.' | '.$this->options->get('system.common.home_meta_title') : 'Askaan #1 Property Buy Rent & Sell Real Estate Website';  ; echo $p_title; ?></title>
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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128091851-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-128091851-1');
    </script>
</head>
<body id="<?php echo $this->id;?>">
	<div id="base-container">
	<!-- Wrapper -->
	<div id="wrapper">
	<!-- Header Container
	================================================== -->
	<?php   $this->widget('frontend.components.web.widgets.header.HeaderWidget'); ?>
	<div class="clearfix"></div>
	<!-- Header Container / End --> 
	 <div id="notify-container">
                        <?php echo Yii::app()->notify->show();?>
                    </div>
	<?php echo $content;?>
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
   <?php $this->widget('frontend.components.web.widgets.footer.FooterWidget'); ?> 
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
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/jquery-ui.min.js');?>"></script> 
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/tooltips.min.js');?>"></script> 
    <script>
	user_login_url = '<?php echo $this->app->createUrl('user/load_signin_form');?>';
	add_to_fav = '<?php echo $this->app->createUrl('user/add_to_fav');?>';
   </script>
   <?php
   if(!$this->app->user->getId()){
	   ?>
	   <div id="loginModalNew" class="modal modalResponsive box backgroundBasic   phn beingModal" style="display: none;;padding-top: 0px;height:auto !important;;;overflow-y:auto;overflow-x:hidden;">
		<div class="boxBody pal">
		<h2 style="position: absolute; top: -5px; width: 100%; background: #eee; 	left: 3px; padding: 10px;">Sign In Or Register</h2>
		<button class="boxClose" data-role="popup_close" onclick="closePopUpThis()">
		<span class="typeLowlight loginModalNewClose" role="presentation">×</span>
		<span class="hideVisually">Close</span>
		</button>
		<div data-role="popupBody" style="margin-top:60px;">
		<div class="">

		<div class="mbl txtC h5">
		</div>
		<div class=" " id="raw_ht_ml" style=";max-height:400px">
		<p>Loading...</p>
		</div>
		</div>

		</div>
		<div style="clear:both"></div>
		</div>
		</div>
	   <?
   }
   ?> 
</body>
<script>alert(1)</script>
</html>

