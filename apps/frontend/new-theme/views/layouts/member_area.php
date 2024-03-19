<!DOCTYPE html>
<head>

   <title><?php echo $pageMetaTitle ;?></title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <link rel="icon" type="image/x-icon" href="<?php echo $this->appAssetUrl('images/fav.png');?>" />
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('vendor/jquery-ias/dist/jquery-ias.min.js');?>"></script>
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/custom.js');?>"></script> 
</head>
<body>
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
	<?php $this->renderPartial('//layouts/_left_sidebar');?>
	<!-- partial -->
	<?php    echo $content;?>
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

