<!DOCTYPE html>
<head>
	<title><?php echo $pageTitle ;?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="<?php echo $this->app->options->get('system.common.home_meta_description');?>">
	<meta name="keywords" content="<?php echo $this->app->options->get('system.common.home_meta_keywords');?>">
	<meta name="google-site-verification" content="gYY9Itu5_ej42w0P_Wi9ISGUEFs_4gMA4yWC-QLVmpg" />
	<!-- CSS
	================================================== -->
	<link rel="icon" type="image/x-icon" href="<?php echo $this->appAssetUrl('images/fav.png');?>" />
	<script type="text/javascript" src="<?php echo $this->appAssetUrl('vendor/jquery-ias/dist/jquery-ias.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/custom.js?q=2');?>"></script> 
	 <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128091851-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-128091851-1');
    </script>
</head>
<body>
	<div id="base-container">
	<!-- Wrapper -->
	<div id="wrapper">
	<!-- Header Container
	================================================== -->
	<?php   $this->widget('frontend.components.web.widgets.header.BlogHeaderWidget'); ?>
	<div class="clearfix"></div>
	<!-- Header Container / End --> 
	 <div id="notify-container">
                        <?php echo Yii::app()->notify->show();?>
                    </div>
	<?php   echo $content;?>
	</div>
 
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
 
</body>
</html>

