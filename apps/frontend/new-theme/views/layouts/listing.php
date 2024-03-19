<!DOCTYPE html>
<html  lang="en" class="absolutehtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php if(isset($newMetaTitle)){echo $newMetaTitle;} else {echo $pageMetaTitle;}?></title>
     <link rel="shortcut icon" href="<?php echo  $this->app->apps->getBaseUrl('assets/img/favicon.ico');?>" type="image/x-icon" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <meta name="keywords" content="<?php if(isset($newMetaKeywords)){echo @$newMetaKeywords ;}?>">
<meta name="description" content="<?php if(isset($newMetaDescription)){ echo @$newMetaDescription ;} ?>">
    <meta name="google-site-verification" content="gYY9Itu5_ej42w0P_Wi9ISGUEFs_4gMA4yWC-QLVmpg" />
    <link rel="icon" type="image/x-icon" href="<?php echo $this->appAssetUrl('images/fav.png');?>" />
    <link href="<?php echo $this->appAssetUrl('css/icons.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->appAssetUrl('css/search-web.css?q=1111');?>" rel="stylesheet" type="text/css"/>
    <script src="<?php echo $this->appAssetUrl('scripts/custom.js');?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/slick.min.js');?>"></script> 
    <!-- Global site tag (gtag.js) - Google Analytics -->
   
</head>
<body id="<?php echo $this->id;?>">
    <div id="base-container" class="listing_page">
        <!-- Wrapper -->
        <div id="wrapper">
          
           <?php   $this->widget('frontend.components.web.widgets.header_new2.HeaderWidget'); ?>
            <div class="clearfix"></div>
 	  <div class="container_class">
		<?php echo $content;?>
 <div class="clearfix"></div>
        </div>
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
</body>
</html>
