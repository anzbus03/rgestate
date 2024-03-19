<!DOCTYPE html>
<head>
   <title><?php echo $pageTitle ;?></title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <!-- CSS
      ================================================== -->
   <link rel="icon"type=" image/x-icon"href="<?php echo $this->appAssetUrl('images/fav.png');?>" />
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
        <?php echo $content;?>
            </div>

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

