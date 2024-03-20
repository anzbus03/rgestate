<!DOCTYPE html>
<head>
   <title><?php echo $pageMetaTitle ;?></title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="google-site-verification" content="gYY9Itu5_ej42w0P_Wi9ISGUEFs_4gMA4yWC-QLVmpg" />
   <link rel="icon" type="image/x-icon" href="<?php echo $this->appAssetUrl('images/fav.png');?>" />
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('vendor/jquery-ias/dist/jquery-ias.min.js');?>"></script>
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/custom.js');?>"></script> 
   	 <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128091851-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-128091851-1');
    </script>
    <style>
        .errorMessage, span.required {
   color: red !important;
    font-weight: bold!important;
    font-size: 19px!important;
}
    </style>
</head>
<body  id="<?php echo $this->id;?>">
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
	<div class="mem_arae">
	    	<script>
	function openMenu(){
		var mmenuAPI2 = $('html');
		if(mmenuAPI2.hasClass('openSidbar')){
			mmenuAPI2.removeClass('openSidbar')
		}
		else{
			mmenuAPI2.addClass('openSidbar')
		}
	 
	}
	</script>
	    	<a href="javascript:void(0)" class="openerH" onclick="openMenu()" style="" ></a> 
	<?php $this->renderPartial('//layouts/_left_sidebar');?>
  <div class="main-panel">
        <div class="content-wrapper">	
	<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
	<!-- partial -->
	<?php    echo $content;?>
	
	
	
	      </div>
                  </div>
                </div>
              </div>
            </div>
     
       
            </div><div class="clearfix" ></div>   
        
       
        

	
	
	
	
	
	
	
	
	
	
	
	</div>
	</div>
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
   <?php // $this->widget('frontend.components.web.widgets.footer.FooterWidget',array('setMargin'=>'10px')); ?> 
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

