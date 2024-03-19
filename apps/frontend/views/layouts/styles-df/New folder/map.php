<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=7" />



<meta name="robots" content="index, follow" />
<link rel="image_src" href="" />
<meta name="keywords" content="<?php echo   Yii::app()->options->get('system.common.home_meta_keywords');?>" />
<meta name="description" content="<?php echo   Yii::app()->options->get('system.common.home_meta_description');?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl.'/uploads/';?><?php echo   Yii::app()->options->get('system.common.fav_ico');?>">
<title>Change Your Country and State :: <?php echo (Yii::app()->options->get('system.common.site_name')) ? Yii::app()->options->get('system.common.site_name') :   Yii::app()->options->get('system.common.site_name');?> </title>

<!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->

<!-- Media Queries Script for IE8 and Older -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
 
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/map2.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg__01  english">
<?php echo $content;?>
<script type='text/javascript'>
<?php echo Yii::app()->options->get('system.common.google_analytics_code');?>
</script>

</body>
</html>
