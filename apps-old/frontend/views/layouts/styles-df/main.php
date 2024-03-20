<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo  (Yii::app()->options->get('system.common.home_meta_title'))? Yii::app()->options->get('system.common.home_meta_title') :     Yii::app()->options->get('system.common.site_name');?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Your styles -->
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/flexslider/flexslider.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/tabber/tabber.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/styles.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/responsive.css" rel="stylesheet" media="screen">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".custom-select").each(function(){
            $(this).wrap("<span class='select-wrapper'></span>");
            $(this).after("<span class='holder'></span>");
        });
        $(".custom-select").change(function(){
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        }).trigger('change');
    })
</script>

</head>
<body>
<!-- BEGIN HEADER -->
<?php   $this->widget('frontend.components.web.widgets.headerhome.HeaderHomeWidget');?>

<!-- END HEADER --> 

<!-- BEGIN CONTENT -->
<?php echo $content; ?>
<!-- END CONTENT --> 

<!-- FOOTER -->
<?php   $this->widget('frontend.components.web.widgets.footer.FooterWidget');?>
<!-- END FOOTER --> 

<!-- Always latest version of jQuery--> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery-1.8.3.min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap.min.js"></script> 
<!-- Some scripts that are used in almost every page --> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/tinynav/tinynav.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/tabber/tabber.js"></script> 
<!-- Load template main javascript file --> 
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/main.js"></script> 

<!-- ===================================================== --> 
<!-- ================ Index page only scripts ============ --> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/flexflider/jquery.flexslider-min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/nicescroll/jquery.nicescroll.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/filterable/filterable.js"></script> 
<script type="text/javascript">
/* <![CDATA[ */
jQuery(function($){
  $('#main-slider').flexslider({controlNav:false, pauseOnHover : true, });

  jQuery('.box').niceScroll({
    autohidemode:false,
    scrollspeed: 100,
    cursorcolor: '#967930',
    cursorwidth: '15px',
    cursorborderradius: '0px',
    cursorborder: '0',
    background: '#dddddd'
  });
});
/* ]]> */
</script>
<style>

header .slider-home .flex-direction-nav {
    display: none !important;
}
</style>
</body>
</html>
