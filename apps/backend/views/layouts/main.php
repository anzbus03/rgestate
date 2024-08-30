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
    <!-- PAGE TITLE HERE -->
    <title><?php echo ucfirst($this->getUniqueId());?>&nbsp;| <?php echo   Yii::app()->options->get('system.common.site_name');?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

  
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/images/favicon.png') ?>">

    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/nouislider/nouislider.min.css');?>"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/jquery-nice-select/css/nice-select.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/css/style.css');?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/datatables/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="<?php echo Yii::app()->apps->getBaseUrl('theme'); ?>/assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->apps->getBaseUrl('theme'); ?>/assets/lib/slick/slick.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/swiper/css/swiper-bundle.min.css');?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('theme'); ?>/assets/js/build/css/intlTelInput.min.css" />

    <?php
    if($this->id=='place_property' or $this->id=='listingusers'){ ?> 
    <script>  function iniFrame() { if(window.self !== window.top) {   $('html').addClass("isOnFram");   }  }  iniFrame();</script>
    <style>html.isOnFram ul.breadcrumb {display:none; } html.isOnFram .closepopu {display:block !important; position: fixed;top: 0px;z-index: 1;right: 0;display: block;background: #fafafa;padding: 5px;text-align: center;} html.isOnFram aside.left-side,html.isOnFram header{display:none}html.isOnFram aside.right-side{width:100%;margin-left:0}html.isOnFram textarea.form-control{height:400px}html.isOnFram .col-sm-5{width:41.66666667%;float:left}html.isOnFram .col-sm-7{width:58.33333333%;float:left}html.isOnFram .box-header{display:none}html.isOnFram .box-footer{border:0;padding-top:0;position:fixed;z-index:11111;bottom:0;width:100%;left:0;padding:10px!important;background:#eee}html.isOnFram .col-sm-2{width:16.66666667%;float:left}html.isOnFram .col-lg-9{width:75%;float:left}html.isOnFram .col-lg-3{width:25%;float:left}html.isOnFram .col-sm-6{width:50%;float:left}html.isOnFram .box-danger .col-sm-2{width:25%;float:left}html.isOnFram .col-sm-3{width:25%;float:left} </style>
	<?php } ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

 
</head>
<body class="skin-blue">
    <a href="javascript:void(0)" style="display:none; " class="closepopu" onclick="parent.closePopupAdm();"><img style="width: 66%;" src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/closeme.png');?>"></a>
   
    <header class="header">
            <a href="<?php echo $this->createUrl('dashboard/index');?>" class="logo icon">
                <?php echo Yii::t('app', 'Backend area');?>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-left">
					<?php
					if(AccessHelper::hasRouteAccess('statistics/page_view')){ /*  ?> 
                    <ul class="nav navbar-nav">
                        <li> <a href="https://www.stats.feeta.pk/customer/index.php/Statistics/overview/slug/feeta-pk" target="_blank" style="background: #34A853;color: #fff;">Stats - Feeta</a> </li>
                            
                        
                    </ul>
                    <?php */ } ?> 
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo ($fullName = Yii::app()->user->getModel()->getFullName()) ? CHtml::encode($fullName) : Yii::t('app', 'Welcome');?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo Yii::app()->user->getModel()->getGravatarUrl(90);?>" class="img-circle"/>
                                    <p>
                                        <?php echo ($fullName = Yii::app()->user->getModel()->getFullName()) ? CHtml::encode($fullName) : Yii::t('app', 'Welcome');?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo $this->createUrl('account/index');?>" class="btn btn-default btn-flat"><?php echo Yii::t('app', 'My Account');?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo $this->createUrl('account/logout');?>" class="btn btn-default btn-flat"><?php echo Yii::t('app', 'Logout');?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                     <?php $this->widget('backend.components.web.widgets.LeftSideNavigationWidget');?>      
                    <?php if (Yii::app()->options->get('system.common.show_backend_timeinfo', 'no') == 'yes' && version_compare(MW_VERSION, '1.3.4.4', '>=')) { ?> 
                    <div class="timeinfo">
                        <div class="pull-left"><?php echo Yii::t('app', 'Local time')?></div>
                        <div class="pull-right"><?php echo Yii::app()->user->getModel()->dateTimeFormatter->formatDateTime();?></div>
                        <div class="clearfix"><!-- --></div>
                        <div class="pull-left"><?php echo Yii::t('app', 'System time')?></div>
                        <div class="pull-right"><?php echo date('Y-m-d H:i:s');?></div>
                        <div class="clearfix"><!-- --></div>
                    </div>             
                    <?php } ?> 
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1><?php echo !empty($pageHeading) ? $pageHeading : '&nbsp;';?></h1>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'tagName'               => 'ul',
                        'separator'             => '',
                        'htmlOptions'           => array('class' => 'breadcrumb'),
                        'activeLinkTemplate'    => '<li><a href="{url}">{label}</a>  <span class="divider"></span></li>',
                        'inactiveLinkTemplate'  => '<li class="active">{label} </li>',
                        'homeLink'              => CHtml::tag('li', array(), CHtml::link(Yii::t('app', 'Dashboard'), $this->createUrl('dashboard/index')) . '<span class="divider"></span>' ),
                        'links'                 => $hooks->applyFilters('layout_page_breadcrumbs', $pageBreadcrumbs),
                    ));
                    ?>
                </section>
                <section class="content" id="<?php echo $this->id=='place_property' ? 'place_an_ad' : '';?>">
                    <div id="notify-container">
                        <?php echo Yii::app()->notify->show();?>
                    </div>
                    <?php echo $content;?>
                </section>
            </aside>
        </div>
        <footer>
            <div class="pull-right">
                 All rights reserved. <?php echo Yii::t('app',Yii::app()->options->get('system.common.copywrite_name',''),array('[YEAR]' => date('Y'))) ;?>
            </div>
            <div class="clearfix"><!-- --></div>
        </footer>
        <script>
    function openUrlFUll(k){
       $('#myModal-details').modal('show');
      
      $('#m_frame').html('<iframe id="ifrm" src="" style="width:100%;height:100%;border:0px;min-height:100vh;background-image:url(<?php echo Yii::App()->apps->getBaseUrl('assets/img/Ring-Preloader.gif');?>)" ></iframe>')
        var el = document.getElementById('ifrm');
        el.src = $(k).attr('data-url');
    }
    
</script>
<div class="modal fade" id="myModal-details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height:100vh;min-height:500px; ">
        <div class="modal-content">
        <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">AD Preview</h4>
            </div>
            <div class="modal-body p-4" id="result">
                
                <div class="row" id="m_frame">
                     
               
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
      <div class="modal fade" id="modal-7"  >
    <div class="modal-dialog" style="width:800px;">
        <div class="modal-content">

    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/global/global.min.js');?>" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/jquery-nice-select/js/jquery.nice-select.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/chart-js/chart.bundle.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/apexchart/apexchart.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/nouislider/nouislider.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/wnumb/wNumb.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/dashboard/dashboard-1.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/custom.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/dlabnav-init.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/demo.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/styleSwitcher.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/dashboard/cms.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/datatables/js/jquery.dataTables.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/js/plugins-init/datatables.init.js');?>" type="text/javascript"></script>
   
    <script src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/swiper/js/swiper-bundle.min.js');?>" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 5,
            spaceBetween: 30,
            
            breakpoints: {
                360: {
                slidesPerView: 1,
                spaceBetween: 30,
                },
                600: {
                slidesPerView: 2,
                spaceBetween: 30,
                },
                1024: {
                slidesPerView: 2,
                spaceBetween: 30,
                },
                1200: {
                slidesPerView: 3,
                spaceBetween: 30,
                },
                1600: {
                slidesPerView: 4,
                spaceBetween: 30,
                },
                1920: {
                slidesPerView: 5,
                spaceBetween: 30,
                },
            }
            });
        
    </script>
</body>
</html>
