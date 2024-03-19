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
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/map.css" rel="stylesheet" type="text/css" media="all" />
<title>Change Your Country and State :: <?php echo (Yii::app()->options->get('system.common.site_name')) ? Yii::app()->options->get('system.common.site_name') : Yii::app()->name;?></title>


<!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script><![endif]-->

<!-- Media Queries Script for IE8 and Older -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

<style type="text/css">
 
</style>

<!--[if IE 6]>
<style type="text/css">
	html {position:absolute; height:100%}
	body {height:100%}
	#map {margin:50px 0 50px 35px}
	.countries {height:265px}
	.countries li span {left:-38px}
	.countries ul li strong a {padding-top:0}
	.modal {position:absolute; height:100% !important; background:#999}
	.modal h2 {margin-top:-21px}
	.modal div p {position:absolute !important; right:-19px; top:0; padding:10px 5px 11px 5px}
	.guy-plane, .guy-sboard, .guy-swing, .guy-rclimb, .guy-mclimb {display:none !important}
	#hint{display:none !important}
	#tag {background-image:url('http://m.dbzstatic.com/assets/images/landing/tag-en.gif');}
	.arabic #tag {background-image:url('http://m.dbzstatic.com/assets/images/landing/tag-ar.gif')}
</style>
<![endif]-->

<!--[if IE 7]>
<style type="text/css">
	.countries ul li strong a {padding-top:0}
	.modal h2 {margin-top:-21px}
	.modal div p {right:-19px; top:0; padding:10px 5px 11px 5px}
</style>
<![endif]-->

<!--[if IE 8]>
<style type="text/css">
	.modal div p {right:-18px; top:0; padding:10px 5px 11px 5px}
</style>
<![endif]-->
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
</head>

<body class="english">
 <?php echo $content;?>

</body>
</html>
