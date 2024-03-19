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
</head>
<body  id="<?php echo $this->id;?>">
	<div id="base-container">
	<!-- Wrapper -->
	<div id="wrapper">
	<!-- Header Container
	================================================== -->
	
	<?php  $member =    $this->member;?>
	 <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" >
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background: #fff;">
          <a class="navbar-brand brand-logo" href="<?php echo Yii::App()->createUrl('site/index');?>">
            <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/logo-white.jpg');?>" alt="logo"> </a>
         
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block"><a href="<?php echo Yii::app()->createUrl('member/dashboard');?>">Dashboard</a></li>
            <li class="nav-item dropdown language-dropdown">
              <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="d-inline-flex mr-0 mr-md-3">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-us"></i>
                  </div>
                </div>
                <span class="profile-text font-weight-medium d-none d-md-block font-weight-semibold">Property Management</span>
              </a>
              <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/W');?>">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-us"></i>
                  </div>Waiting Approval
                </a>
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/R');?>">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-fr"></i>
                  </div>Rejections
                </a>
                <a class="dropdown-item"  href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/A');?>">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-ae"></i>
                  </div>Published
                </a>
                <a class="dropdown-item"  href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/I');?>">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-ru"></i>
                  </div>Inactive
                </a>
              </div>
            </li>
          </ul>
       
          <ul class="navbar-nav ml-auto">
			  <li><a href="<?php echo Yii::App()->createUrl('place_an_ad/create');?>" style="height:auto;" class="headerModalOpener transparentWhite text-uppercase  fwBold noShrink hidden-xs"><i class="openerIcon"></i> <span class="headfont">Submit Property</span></a></li>
			  <li class="nav-item dropdown  ">
              <a class="nav-link count-indicator" title="My favourite" id="messageDropdown" href="<?php echo Yii::app()->createUrl('member/favourite');?>"  >
                <i class="fa fa-star"></i>
              </a>
           
            </li>
		 
           
           
            <li class="nav-item dropdown hide">
              <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count">7</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../../assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic"> </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../../assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic"> </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="../../../assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic"> </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown hide">
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-email-outline"></i>
                <span class="count bg-success">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-alert m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                    <p class="font-weight-light small-text mb-0"> Just now </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-settings m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                    <p class="font-weight-light small-text mb-0"> Private message </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-airballoon m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                    <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="<?php echo $member->getAvatarUrl( 124, '',  true); ?>" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="<?php echo $member->getAvatarUrl( 124, '',  true); ?>" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $member->fullName;?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo $member->TypeTile;?></p>
                </div>
                <?php
				if($member->FillPersonalInformation){ ?>
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('member/profile_settings',array('slug'=>$member->slug));?>">Profile Settings</a>
                <?php } ?> 
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('member/account_settings',array('slug'=>$member->slug));?>">Account Settings<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item hide"  href="<?php echo Yii::app()->createUrl('member/my_avatar',array('slug'=>$member->slug));?>">Change Avatar<i class="dropdown-item-icon ti-help-alt"></i></a>
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('user/logout',array('slug'=>$member->slug));?>">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
	 
	 <div class="clearfix"></div>
	<!-- Header Container / End --> 

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
	<?php //  $this->renderPartial('//layouts/_left_sidebar');?>
  <div class="main-panel col-sm-9" style="padding-top:60px;padding-left:0px;padding-right:0px;">
        <div class="content-wrapper abc">	
				<div id="notify-container">
	<?php echo Yii::app()->notify->show();?>
	</div>
	<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body mainb"  >
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


<div class="col-sm-3 stretch-card pull-right" style="padding-top:70px">
                <div class="card">
                  <div class="card-body" style="background: #fff;">
                     
                    <div class="list d-flex align-items-center border-bottom py-3">
                      <img class="img-sm rounded-circle" src="<?php echo $member->getAvatarUrl( 124, '',  true); ?>" alt="">
                      <div class="wrapper w-100 ml-3">
                        <p class="mb-0">
                          <b><?php echo $member->fullName;?> </b><?php echo $member->TypeTile;?></p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                            <p class="mb-0">  <a class="link_color" href="<?php echo Yii::app()->createUrl('member/account_settings',array('slug'=>$member->slug));?>">Account Settings</a></p>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <div class="list d-flex align-items-center border-bottom py-3">
                      <img class="img-sm rounded-circle" src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/user.png');?>" alt="">
                      <div class="wrapper w-100 ml-3">
                        <p class="mb-0">
                          <b>Profile </b></p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                            <p class="mb-0">  <a class="link_color" href="<?php echo Yii::app()->createUrl('member/profile_settings',array('slug'=>$member->slug));?>">Update Profile</a></p>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <div class="list d-flex align-items-center border-bottom py-3">
                      <img class="img-sm rounded-circle" src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/desktop.png');?>" alt="">
                      <div class="wrapper w-100 ml-3">
                        <p class="mb-0">
                          <b>Published  </b>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                            <p class="mb-0"> <a class="link_color"  href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/A');?>">View published properties</a></p>
                          </div>
                           
                        </div>
                      </div>
                    </div> 
                    <div class="list d-flex align-items-center border-bottom py-3">
                      <img class="img-sm rounded-circle" src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/no-waiting.png');?>" alt="">
                      <div class="wrapper w-100 ml-3">
                        <p class="mb-0">
                          <b>Waiting Approval  </b>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                            <p class="mb-0"> <a class="link_color"  href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/W');?>">View waiting properties</a></p>
                          </div>
                           
                        </div>
                      </div>
                    </div> 
                    <div class="list d-flex align-items-center border-bottom py-3">
                      <img class="img-sm rounded-circle" src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/logout.png');?>" alt="">
                      <div class="wrapper w-100 ml-3">
                        <p class="mb-0">
                          <b>Logout  </b>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                            <p class="mb-0"> <a class="link_color"  href="<?php echo Yii::app()->createUrl('user/logout');?>">Click here to logout</a></p>
                          </div>
                           
                        </div>
                      </div>
                    </div> 
                  </div>
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
   <style>
   .modal-open .fade{ opacity:1 !important;margin:auto !important }
   .form-control{line-height: 25.85px !important;;font-size:14px !important; } 
   td a { white-space: break-spaces;}
   </style>
</body>
</html>

