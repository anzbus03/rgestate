<!DOCTYPE html>
<head>
    <title><?php $p_title =  !empty($pageMetaTitle) ? $pageMetaTitle.' | ' : ''; $p_title .= $this->options->get('system.common.home_meta_title') ; echo $p_title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
    <meta name="keywords" content="<?php echo $this->app->options->get('system.common.home_meta_keywords');?>">
    <meta name="google-site-verification" content="gYY9Itu5_ej42w0P_Wi9ISGUEFs_4gMA4yWC-QLVmpg" />
    <link rel="icon" type="image/x-icon" href="<?php echo $this->appAssetUrl('images/fav.png');?>" />
    <link href="<?php echo $this->appAssetUrl('css/icons.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->appAssetUrl('css/search-web.css');?>" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $this->appAssetUrl('scripts/custom.js');?>" type="text/javascript"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128091851-1"></script>
       <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/slick.min.js');?>"></script> 
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
          
           <?php   $this->widget('frontend.components.web.widgets.header.HeaderWidget'); ?>
            <div class="clearfix"></div>
 
		<?php echo $content;?>

		<!-- Detail Container / END -->
        <!-- Footer
        ================================================== -->
        <?php 
        if(empty($noFooter)) {  
        $this->widget('frontend.components.web.widgets.footer.FooterWidget'); ?> 
        <!-- Footer / End --> 
        <!-- Back To Top Button -->
        <div id="backtotop"><a href="#"></a></div>
        <?php } ?> 
    </div>
    <!-- Wrapper / End --> 

  
</div>

<!-- Scripts
 ================================================== --> 
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
</html>
