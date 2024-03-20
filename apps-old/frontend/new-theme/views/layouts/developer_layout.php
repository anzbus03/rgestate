<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php  echo  $pageTitle ;  ?></title>
<link rel="shortcut icon" href="<?php echo  $this->app->apps->getBaseUrl('assets/img/favicon.ico');?>" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="<?php echo !empty($pageMetaDescription) ? $pageMetaDescription : $this->app->options->get('system.common.home_meta_description');?>">
<meta name="keywords" content="<?php echo $this->app->options->get('system.common.home_meta_keywords');?>">
<link rel='stylesheet' id='custom-google-fonts-css'  href='https://fonts.googleapis.com/css?family=Karla%7CLato%3A300%2C400%2C700&#038;display=swap&#038;ver=5.4.1' type='text/css' media='all' />
<link rel='stylesheet' id='wp-bootstrap-starter-bootstrap-css-css'  href='<?php echo Yii::app()->apps->getBaseUrl('assets/developer/css/bootstrap.min.css');?>' type='text/css' media='all' />
<link rel='stylesheet' id='mmenu-css'  href='<?php echo Yii::app()->apps->getBaseUrl('assets/developer/css/mmenu.css');?>' type='text/css' media='all' />
<link rel='stylesheet'  href='<?php echo Yii::app()->apps->getBaseUrl('assets/developer/css/style.css?q=1');?>' type='text/css' media='all' />
	<link rel="stylesheet" href="<?php echo Yii::app()->apps->getBaseUrl('assets/developer/css/animations.css');?>" type="text/css">
<script>iniFrame();</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '243429403423483');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=243429403423483&ev=PageView&noscript=1"
/></noscript>
</head>

<body class="home page-template page-template-front-page page-template-front-page-php page page-id-141">
<div id="page" class="site">
 <?php echo $content;?>
  <!-- #colophon --> 
</div>
<!-- #page --> 
  	<script type="text/javascript" src="<?php echo Yii::app()->apps->getBaseUrl('assets/developer/js/css3-animate-it.js');?>"></script>
  	<Style>
  	.fade.in {
      opacity: 1 !important;display:block !important; 
}
.mframe {
    border-radius: 6px !important;
}

.mframe {
    width: 100%;
    height: auto;
    border: 0px;
    min-height: 400px;
    background-image:url(../../assets/img/Ring-Preloader.gif);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 250px;
}.mframe {
    min-height: 500px;
}#myModal3 .modal-body {
    overflow-x: hidden;
    width: 100%;
}
#myModal3 .modal-body {
    padding: 0;
}html .modal-backdrop.in {
    opacity: .5 !important;
}
  	</Style>
<script>
$(document).ready(function(){
	$.doTimeout(2500, function(){
		$(".repeat.go").removeClass("go");

		return true;
	});
	$.doTimeout(2520, function(){
		$(".repeat").addClass("go");
		return true;
	});
	
});

</script>
<script type='text/javascript' src='<?php echo Yii::app()->apps->getBaseUrl('assets/developer/js/scripts.js');?>'></script> 
<script type='text/javascript' src='<?php echo Yii::app()->apps->getBaseUrl('assets/developer/js/slick.min.js');?>'></script> 
<script type='text/javascript' src='<?php echo Yii::app()->apps->getBaseUrl('assets/developer/js/mmenu.polyfills.js');?>'></script> 
<script type='text/javascript' src='<?php echo Yii::app()->apps->getBaseUrl('assets/developer/js/mmenu.js');?>'></script> 
<script type='text/javascript' src='https://kit.fontawesome.com/2551a6c49e.js?ver=3'></script> 
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js?ver=4'></script> 
<script type='text/javascript' src='<?php echo Yii::app()->apps->getBaseUrl('assets/developer/js/swiper.min.js');?>'></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-165848119-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-165848119-1');
</script>
<div style="display:none;">
<script type="text/javascript" src="https://www.stats.feeta.pk/track/index?u=feeta-pk"></script>
</div>
</body>
</html>
