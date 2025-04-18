<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
?>
<!DOCTYPE html>
<html dir="<?php echo Yii::app()->locale->orientation;?>">
<head>
    <meta charset="<?php echo Yii::app()->charset;?>">
    <title><?php echo CHtml::encode($pageMetaTitle);?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo CHtml::encode($pageMetaDescription);?>">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/nouislider/nouislider.min.css');?>"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/jquery-nice-select/css/nice-select.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/css/style.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/datatables/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="" rel="stylesheet" type="text/css"/>
</head>
    <body class="skin-blue">
        <header class="header">
            <a href="<?php echo $this->createUrl('dashboard/index');?>" class="logo icon">
                <?php // echo Yii::t('app', 'Backend area');?>
            </a>
            <nav class="navbar navbar-static-top" role="navigation"></nav>
        </header>
        <div id="notify-container">
            <?php echo Yii::app()->notify->show();?>
        </div>
        <?php echo $content;?>
        <div class="wrapper">
            <div class="row" style="height: 50px;"><!-- --></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4"></div>
            <div class="clearfix"><!-- --></div>
        </div>
    </body>
</html>
