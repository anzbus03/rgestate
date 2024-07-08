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
</head>
    <body class="skin-blue" style="width:600px;max-width:100%;margin:auto;background:#fff;">
        <header class="header">
            <a href="<?php echo $this->createUrl('dashboard/index');?>" class="logo icon">
                <?php echo Yii::t('app', Yii::app()->options->get('system.common.site_name').' Image');?>
            </a>
            <nav class="navbar navbar-static-top " role="navigation">
                <ul class="nav navbar-nav pull-right">
            <li class="active"><a href="<?php echo $this->createUrl('dashboard/index');?>" style="color:#fff"><b><i class="fa  fa-arrow-left"></i> Back to dashboard</b></a></li>
            
             
          </ul>
            </nav>
        </header>
        <div class="wrapper">
            <div class="row" style="height: 50px;"><!-- --></div>
      
            <div class="col-lg-12">
                <div id="notify-container">
                    <?php echo Yii::app()->notify->show();?>
                </div>
                <?php echo $content;?>
            </div>
        
            <div class="clearfix"><!-- --></div>
        </div>
    </body>
</html>
