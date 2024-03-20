<!DOCTYPE html>
<html   lang="<?php echo $this->language;?>" dir="<?php echo $this->direction;?>"  class="memberSecure <?php echo $this->secure_header == '1' ? 'secure' : '';?> <?php echo $this->no_header  == '1' ? 'secure no-header' : '';?>" >
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title><?php echo Yii::t('app',$pageMetaTitle,array('::'=>' | ')) ;?></title>
   
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="google-site-verification" content="gYY9Itu5_ej42w0P_Wi9ISGUEFs_4gMA4yWC-QLVmpg" />
   <style>.for-mobile {
    display: none !important;
}
.img-xs , .img-md {
  
    object-fit: contain;
}
#member.addons .myaccount-menu.is-ended.n-mob,#member.topup_options  .myaccount-menu.is-ended.n-mob, #member.topup  .myaccount-menu.is-ended.n-mob, #member.topup_success  .myaccount-menu.is-ended.n-mob{ display:none; }
.main-panel {
     
    margin: auto !important;
}
</style>
   <link rel="shortcut icon" href="<?php echo  $this->app->apps->getBaseUrl('assets/img/favi.png');?>" type="image/x-icon" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('assets/css/member.min.css?q=17');?>" />
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('vendor/jquery-ias/dist/jquery-ias.min.js');?>"></script>
   <script type="text/javascript" src="<?php echo $this->appAssetUrl('scripts/custom.js');?>"></script> 
   
  <script> 
  
// Function to check whether webpage is in iFrame 
function iniFrame() { 
      
    if(window.self !== window.top) { 
         $('.destination-sr-header__col').hide();
         parent.closeIFrame();
    } 
     
}
var opener = window.opener;
if(opener != null && opener.windowpopup==true){
    window.opener.closeIFrame();
    window.close();
}
 
 //  console.log(window.opener.closeIFrame());
// Calling iniFrame function 
iniFrame(); 
</script> 
  <style> .errorMessage{color: red !important; }
  .user-dropdown img.rounded-circle, .newheader_useravatar_letter {
   
    box-shadow: rgba(32,33,36,.28) 0 1px 6px 0;border: 1px solid #eee;
}
        span.required {
   color: red !important;
    font-weight: bold!important;
    font-size: 19px!important;
}@media only screen and (max-width: 600px) {
  .not-for-mobile {
   display: none !important;
  }
  .det-sn { font-size:13px !important; display:block !important;white-space: nowrap;}
}
    </style>
</head>
<body  id="<?php echo $this->id;?>"  class="<?php echo $this->action->id;?>">
	<div id="base-container">
	    <div class="loaderi"><div class="cntr"><div class="loaderispin"></div></div><div class="bg"></div></div>
	<!-- Wrapper -->
	<div id="wrapper">
	<!-- Header Container
	================================================== -->
	
	
	<?php  $member =    $this->member;
	  
        if($this->no_header!='1'){ 
         
        ?>
        <style>
            html a#arablogo img {
    height: 84.5px;width:auto !important;
    margin: auto;
        margin-top: auto;
    margin-top: auto;
    margin-top: -4px !important;
    position: relative;
}html a#arablogo::after {
    position: absolute;
    bottom: 0px;
}
            
        </style>
       
	 <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" >
         <div class="container"> 
        <div class="text-center navbar-brand-wrapper d-flex align-items-top  " style="background: #fff;">
          <a class="navbar-brand brand-logo" id="arablogo" href="<?php echo Yii::App()->createUrl('site/index');?>" style="position: relative;">
            <img src="<?php echo Yii::app()->apps->getBaseUrl($this->logo_path);?>"   > </a>
         
        </div>
        
            
        <?php  if($this->secure_header != '1'){ ?> 
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none "><a href="<?php echo Yii::app()->createUrl('member/dashboard');?>"><?php echo $this->tag->getTag('dashboard','Dashboard');?></a></li>
            <li class="nav-item dropdown language-dropdown  d-none">
              <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="d-inline-flex mr-0 mr-md-3">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-us"></i>
                  </div>
                </div>
                <span class="profile-text font-weight-medium d-none d-md-block font-weight-semibold">Property Management</span>
              </a>
              <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" style="width: 100px !important;right: 11px !important;min-width: 186px;left: unset !important;" aria-labelledby="LanguageDropdown">
                 <a class="dropdown-item"  href="<?php echo Yii::app()->createUrl('place_an_ad/index');?>">
                  <div class="flag-icon-holder">
                    <i class="mdi mdi-folder-image text-teal icon-lg"></i>
                  </div>All Properties
                </a>
                <a class="dropdown-item"  href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/A');?>">
                  <div class="flag-icon-holder">
                    <i class="mdi mdi-folder-image text-teal icon-lg"></i>
                  </div>Published
                </a>
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/W');?>">
                  <div class="flag-icon-holder">
                    <i class="mdi mdi-folder-image text-teal icon-lg"></i>
                  </div>Waiting Approval
                </a>
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/R');?>">
                  <div class="flag-icon-holder">
                    <i class="mdi mdi-folder-image text-teal icon-lg"></i>
                  </div>Rejected
                </a>
               
                <a class="dropdown-item"  href="<?php echo Yii::app()->createUrl('place_an_ad/index/status/I');?>">
                  <div class="flag-icon-holder">
                    <i class="mdi mdi-folder-image text-teal icon-lg"></i>
                  </div>Inactive
                </a>
              </div>
            </li>
          </ul>
       
          <ul class="navbar-nav ml-auto">
               <li class=" margin-left-15">
				<?php
				$languages = OptionCommon::systemLanguages(); 
			foreach($languages as $k=>$v){
				if($this->language==$k){ continue; } 
				echo '<a href="'.$this->app->createUrl('site/changeLanguage',array('val'=>$k)).'"   class="lng-convertor" style="font-weight: 600;" class="color-grey"     >'.$v.'</a>';
			}					 
			?>	
				</li>
             
 
			  <li class="nav-item dropdown margin-left-15 ">
              <a class="nav-link count-indicator" title="My favourite" id="messageDropdown" href="<?php echo Yii::app()->createUrl('member/favourite');?>"  >
                <i class="fa fa-heart" style="color:var(--logo-color);"></i>
              </a>
           
            </li>
		 
            <li class="nav-item dropdown  d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="<?php echo $member->getAvatarUrl( 124, '',  true); ?>" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="<?php echo $member->getAvatarUrl( 124, '',  true); ?>" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $member->fullName;?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo $member->TypeTile;?></p>
                </div>
                 
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('member/enquiry_user');?>">Enquiries<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('member/update_profile');?>">Account Settings<i class="dropdown-item-icon ti-location-arrow"></i></a>
                <?php 
                if(in_array( $this->mem->user_type,array('A','C','D')) and $this->mem->status=='A' and $this->member->enable_l_f=='1'   ){ 
                
                ?> 
                <a href="<?php echo $member->status=='A' ?  $member->AgentDetailUrl : 'javascript:void(0)';?>" class="dropdown-item" >My Page</a>
                <?php } ?> 
                <a class="dropdown-item hide"  href="<?php echo Yii::app()->createUrl('member/my_avatar',array('slug'=>$member->slug));?>">Change Avatar<i class="dropdown-item-icon ti-help-alt"></i></a>
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('user/logout',array('slug'=>$member->slug));?>"><?php echo $this->tag->getTag('sign_out','Sign Out');?><i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
      
        </div>
		<?php } ?> 
		</div>
      </nav>
	
	<?php } ?> 
	 <div class="clearfix"></div>
	<!-- Header Container / End --> 

	<div class="mem_arae">
	    <span class="opener-slide"></span>
	    	<script>
	    	
	function openMenu(){
		var mmenuAPI2 = $('html');
		if(mmenuAPI2.hasClass('openSidbar')){
			mmenuAPI2.removeClass('openSidbar');
				$('#sidebar').removeClass('active')
		}
		else{
			mmenuAPI2.addClass('openSidbar')
			$('#sidebar').addClass('active')
		}
	 
	}
	</script>
	    	<a href="javascript:void(0)" class="openerH" onclick="openMenu()" style="" ></a> 
	<?php //  $this->renderPartial('//layouts/_left_sidebar');?>
	<nav class="sidebar sidebar-offcanvas for-mobile" id="sidebar">
	    <div   class="m-clo-di" style="z-index: 111;cursor: pointer;" aria-expanded="false" onclick="openMenu()">
					<img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/closen.png');?>" class=" ">
				</div>
          <ul class="nav">
             <li class="nav-item">
              <a class="nav-link" href="<?php echo Yii::app()->createUrl('member/dashboard');?>">
                
                <span class="menu-title"><?php echo $this->tag->getTag('dashboard','Dashboard');?></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo Yii::app()->createUrl('member/update_profile');?>">
                <i class="menu-icon typcn typcn-user-outline"></i>
                <span class="menu-title"><?php echo $this->tag->getTag('account_settings','Account Settings');?></span>
              </a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="<?php echo Yii::app()->createUrl('user/logout');?>">
             
                <span class="menu-title"><?php echo $this->tag->getTag('sign_out','Sign Out');?></span>
              </a>
            </li>
          </ul>
        </nav>
	
  <div class="main-panel container  " style=" ">
        <div class="content-wrapper abc">	
			  <div id="notify-container" class="col-sm-12"> <?php echo Yii::app()->notify->show();?> </div>
	    <div class="clearfix"></div>
		<div class="myaccount-menu is-ended container n-mob">
		<nav class="clearfix margin-bottom-15">
		    <style>
		    .shadow {    -webkit-box-shadow:unset !important;  box-shadow: unset !important; }
		     .col-12.padding-right-0{ padding-right:0px !important;}
		     .table.table-bordered thead {    border: 1px solid var(--secondary-color);  }
		     .table > thead > tr > th {    background-color: var(--secondary-color) !important;    color: #fff !important;}
		     html[dir="rtl"]  .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation li:last-child {   margin-left: 0 !important; }
		     .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation.tmpl.member-7 li {   width: 13.417%; }
		     .main-panel ,.content-wrapper.abc,  .card-body.mainb,.myaccount-menu.is-ended.container.n-mob,.card .card-body.mainb{  padding-left: 0px; padding-right: 0px; }
		     .list-unstyled.myaccount-menu-navigation.tmpl a { color : var(--logo-color); }
		     .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation.tmpl li:hover, .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation.tmpl li.active {    background-color: #fff !important;    border-color: var(--secondary-color);}
		     .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation.tmpl li:hover a, .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation.tmpl li.active a { color : var(--secondary-color); font-weight:600; } 
		     .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation li {  border: 1px solid var(--logo-color);  border-radius: 4px; }
		        .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation.tmpl li:hover,.myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation.tmpl li.active{ background-color:#eee; } 
		    @media only screen and (min-width: 600.1px)  and (max-width: 1024px) { 
		        .main-panel ,.content-wrapper.abc{  padding-left: 0px; padding-right: 0px; }
		        .myaccount-menu.is-ended.for-mobile { display:none !important; }
		        .card .card-body.mainb ,.myaccount-menu.is-ended.container.n-mob{ padding-left: 0px; padding-right: 0px; }
		    }
		    @media only screen and (min-width: 600.1px)  and (max-width: 900px) { 
		    
		      .dashboard   .row.posingpackge { flex-direction: column; }
		       .row.posingpackge .col-sm-3  { min-width:100% !important; } .row.posingpackge .col-sm-5  { min-width:100% !important; }
		     .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation  li {  width: 23.417% !important; margin-bottom: 10px; }
		    }
		    @media only screen and (max-width: 600px)  {
		        .content-wrapper.abc { padding-left:15px !important; padding-right:15px !important;}
		        .mob-row-z.row{ margin-left:0px !important; margin-right:0px !important; }
		        .col-12.padding-right-0 { padding-left:0px !important; padding-right:0px !important;}
		        a.button7 span{ float:left; } html[dir="rtl"] a.button7 span{ float:right; }
		    }
		    </style>
			<ul class="list-unstyled myaccount-menu-navigation tmpl">
			    <?php $actid = $this->action->id;?>
				<li class="<?php echo $actid=='dashboard' ? 'active' : '';?>" >
					<a href="<?php echo Yii::App()->createUrl('member/dashboard');?>"> <span class="circle2">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 477.869 477.869" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M387.415,233.496c48.976-44.029,52.987-119.424,8.958-168.4C355.991,20.177,288.4,12.546,239.02,47.332 c-53.83-37.99-128.264-25.149-166.254,28.68c-34.859,49.393-27.259,117.054,17.689,157.483 c-55.849,29.44-90.706,87.481-90.453,150.613v51.2c0,9.426,7.641,17.067,17.067,17.067h443.733 c9.426,0,17.067-7.641,17.067-17.067v-51.2C478.121,320.976,443.264,262.935,387.415,233.496z M307.201,59.842 c47.062-0.052,85.256,38.057,85.309,85.119c0.037,33.564-19.631,64.023-50.237,77.799c-1.314,0.597-2.628,1.143-3.959,1.707 c-4.212,1.699-8.556,3.051-12.988,4.045c-0.853,0.188-1.707,0.29-2.577,0.461c-4.952,0.949-9.977,1.457-15.019,1.519 c-2.27,0-4.557-0.171-6.827-0.375c-0.853,0-1.707,0-2.56-0.171c-9.7-1.142-19.136-3.923-27.904-8.226 c-0.324-0.154-0.7-0.137-1.024-0.273c-1.707-0.819-3.413-1.536-4.932-2.458c0.137-0.171,0.222-0.358,0.358-0.529 c7.826-10.056,13.996-21.296,18.278-33.297l0.529-1.434c1.947-5.732,3.459-11.602,4.523-17.562c0.154-0.87,0.273-1.707,0.41-2.645 c0.987-6.067,1.506-12.2,1.553-18.347c-0.049-6.135-0.568-12.257-1.553-18.313c-0.137-0.887-0.256-1.707-0.41-2.645 c-1.064-5.959-2.576-11.83-4.523-17.562l-0.529-1.434c-4.282-12.001-10.453-23.241-18.278-33.297 c-0.137-0.171-0.222-0.358-0.358-0.529C277.449,63.831,292.19,59.843,307.201,59.842z M85.335,145.176 c-0.121-47.006,37.886-85.21,84.892-85.331c22.034-0.057,43.232,8.434,59.134,23.686c0.99,0.956,1.963,1.911,2.918,2.901 c2.931,3.071,5.634,6.351,8.09,9.813c0.751,1.058,1.434,2.185,2.133,3.277c2.385,3.671,4.479,7.523,6.263,11.52 c0.427,0.973,0.751,1.963,1.126,2.935c1.799,4.421,3.215,8.989,4.233,13.653c0.12,0.512,0.154,1.024,0.256,1.553 c2.162,10.597,2.162,21.522,0,32.119c-0.102,0.529-0.137,1.041-0.256,1.553c-1.017,4.664-2.433,9.232-4.233,13.653 c-0.375,0.973-0.7,1.963-1.126,2.935c-1.786,3.991-3.88,7.837-6.263,11.503c-0.7,1.092-1.382,2.219-2.133,3.277 c-2.455,3.463-5.159,6.742-8.09,9.813c-0.956,0.99-1.929,1.946-2.918,2.901c-6.91,6.585-14.877,11.962-23.569,15.906 c-1.382,0.631-2.782,1.212-4.198,1.707c-4.114,1.633-8.347,2.945-12.663,3.925c-1.075,0.239-2.185,0.375-3.277,0.563 c-4.634,0.863-9.333,1.336-14.046,1.417h-1.877c-4.713-0.08-9.412-0.554-14.046-1.417c-1.092-0.188-2.202-0.324-3.277-0.563 c-4.316-0.98-8.55-2.292-12.663-3.925c-1.417-0.563-2.816-1.143-4.198-1.707C105.013,209.057,85.374,178.677,85.335,145.176z M307.201,418.242H34.135v-34.133c-0.25-57.833,36.188-109.468,90.76-128.614c29.296,12.197,62.249,12.197,91.546,0 c5.698,2.082,11.251,4.539,16.623,7.356c3.55,1.826,6.827,3.908,10.24,6.007c2.219,1.382,4.471,2.731,6.605,4.25 c3.294,2.338,6.4,4.881,9.455,7.492c1.963,1.707,3.908,3.413,5.751,5.12c2.816,2.662,5.461,5.478,8.004,8.363 c1.826,2.082,3.601,4.198,5.291,6.383c2.236,2.867,4.369,5.803,6.349,8.823c1.707,2.56,3.226,5.222,4.727,7.885 c1.707,2.935,3.277,5.871,4.71,8.926c1.434,3.055,2.697,6.4,3.925,9.66c1.075,2.833,2.219,5.649,3.106,8.533 c1.195,3.959,2.031,8.055,2.867,12.151c0.512,2.423,1.178,4.796,1.553,7.253c1.011,6.757,1.53,13.579,1.553,20.412V418.242z M443.735,418.242h-102.4v-34.133c0-5.342-0.307-10.633-0.785-15.872c-0.137-1.536-0.375-3.055-0.546-4.591 c-0.461-3.772-0.99-7.509-1.707-11.213c-0.307-1.581-0.631-3.169-0.973-4.762c-0.819-3.8-1.769-7.566-2.85-11.298 c-0.358-1.229-0.683-2.475-1.058-3.686c-4.779-15.277-11.704-29.797-20.565-43.127l-0.666-0.973 c-2.935-4.358-6.07-8.573-9.404-12.646l-0.119-0.154c-3.413-4.232-7.117-8.346-11.008-12.237c0.222,0,0.461,0,0.7,0 c4.816,0.633,9.666,0.975,14.524,1.024h0.939c4.496-0.039,8.985-0.33,13.449-0.87c1.399-0.171,2.782-0.427,4.181-0.649 c3.63-0.557,7.214-1.28,10.752-2.167c1.007-0.256,2.031-0.495,3.055-0.785c4.643-1.263,9.203-2.814,13.653-4.642 c54.612,19.127,91.083,70.785,90.829,128.649V418.242z" fill="currentColor" data-original="currentColor" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>
			
					</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                   <?php echo $this->tag->getTag('dashboard','Dashboard');?>                                </font></font></span>
					</a>
				</li>
				<li class="<?php echo $actid=='enquiry_user' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/enquiry_user');?>" class=""> <span class="circle2">
					     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 496 496" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m392 279.499v-172c0-26.467-21.533-48-48-48h-296c-26.467 0-48 21.533-48 48v172c0 26.467 21.533 48 48 48h43.085l.919 43.339c.275 13.021 15.227 20.281 25.628 12.438l73.983-55.776h152.385c26.467-.001 48-21.534 48-48.001zm-205.74 16c-3.476 0-6.856 1.132-9.632 3.224l-53.294 40.179-.588-27.741c-.185-8.702-7.292-15.661-15.996-15.661h-58.75c-8.822 0-16-7.178-16-16v-172c0-8.822 7.178-16 16-16h296c8.822 0 16 7.178 16 16v172c0 8.822-7.178 16-16 16h-157.74zm309.74-88v132c0 26.468-21.532 48-48 48h-43.153l-.852 33.408c-.222 8.694-7.347 15.592-15.994 15.592-6.385 0-2.83 1.107-82.856-49h-73.145c-8.837 0-16-7.163-16-16s7.163-16 16-16c84.866 0 80.901-.898 86.231 2.438l54.489 34.117.534-20.964c.222-8.675 7.317-15.592 15.995-15.592h58.751c8.822 0 16-7.178 16-16v-132c0-8.822-7.178-16-16-16-8.837 0-16-7.163-16-16s7.163-16 16-16c26.468.001 48 21.533 48 48.001zm-200-43c0 8.837-7.163 16-16 16h-168c-8.837 0-16-7.163-16-16s7.163-16 16-16h168c8.837 0 16 7.163 16 16zm-29 70c0 8.837-7.163 16-16 16h-110c-8.837 0-16-7.163-16-16s7.163-16 16-16h110c8.837 0 16 7.163 16 16z" fill="currentColor" data-original="currentColor" style=""/></g></svg>
 					
						</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        <?php echo $this->tag->getTag('enquiries','Enquiries');?>            </font></font></span>
					</a>
				</li>
				<li class="<?php echo $actid=='insurance' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/insurance');?>" class=""> <span class="circle2">
					   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 56 56" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><!-- Generator: Sketch 51.3 (57544) - http://www.bohemiancoding.com/sketch --><title xmlns="http://www.w3.org/2000/svg">006 - Home Insurance</title><desc xmlns="http://www.w3.org/2000/svg">Created with Sketch.</desc><defs xmlns="http://www.w3.org/2000/svg"/><g xmlns="http://www.w3.org/2000/svg" id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="006---Home-Insurance" fill="currentColor" fill-rule="nonzero"><path d="M23,48 L12,48 L12,56 L23,56 L23,48 Z M20,53 L19,53 C18.4477153,53 18,52.5522847 18,52 C18,51.4477153 18.4477153,51 19,51 L20,51 C20.5522847,51 21,51.4477153 21,52 C21,52.5522847 20.5522847,53 20,53 Z" id="Shape" fill="currentColor" data-original="currentColor" style=""/><path d="M4.028,36.515 C4.45843454,37.4632009 5.05633569,38.3260078 5.793,39.062 L12.731,46 L21,46 L21,44.139 C21.0302912,42.2250013 20.4121078,40.3570584 19.246,38.839 C18.6363375,38.0239969 17.8023175,37.4043895 16.846,37.056 C14.4961067,36.0998389 12.3358599,34.7316939 10.467,33.016 C9.53164741,32.2448902 8.18752962,32.2224882 7.227,32.962 C7.58731535,33.501316 7.99998241,34.0037515 8.459,34.462 L13.028,39.031 C13.2879566,39.2820745 13.3922126,39.6538779 13.3006972,40.0035073 C13.2091817,40.3531368 12.9361368,40.6261817 12.5865073,40.7176972 C12.2368779,40.8092126 11.8650745,40.7049566 11.614,40.445 L7.041,35.876 C5.97010296,34.8070447 5.11429336,33.5425105 4.52,32.151 L2.283,26.934 C2.09636921,26.4961017 1.66600986,26.2122141 1.19,26.213 C0.785820495,26.2131465 0.409394408,26.4186059 0.190637144,26.7584681 C-0.0281201206,27.0983304 -0.0592467293,27.5260467 0.108,27.894 L4.028,36.515 Z" id="Shape" fill="currentColor" data-original="currentColor" style=""/><path d="M33,56 L44,56 L44,48 L33,48 L33,56 Z M36,51 L37,51 C37.5522847,51 38,51.4477153 38,52 C38,52.5522847 37.5522847,53 37,53 L36,53 C35.4477153,53 35,52.5522847 35,52 C35,51.4477153 35.4477153,51 36,51 Z" id="Shape" fill="currentColor" data-original="currentColor" style=""/><path d="M36.754,38.838 C35.5876776,40.3563283 34.9694822,42.2246601 35,44.139 L35,46 L43.269,46 L50.207,39.062 C50.9436643,38.3260078 51.5415655,37.4632009 51.972,36.515 L55.892,27.893 C56.0587931,27.5251433 56.0274348,27.0977685 55.8087347,26.7581971 C55.5900345,26.4186257 55.213904,26.2133006 54.81,26.213 C54.3343096,26.2123087 53.90415,26.495671 53.717,26.933 L51.48,32.151 C50.8857066,33.5425105 50.029897,34.8070447 48.959,35.876 L44.39,40.445 C43.9976211,40.8239722 43.3739152,40.8185524 42.9881814,40.4328186 C42.6024476,40.0470848 42.5970278,39.4233789 42.976,39.031 L47.545,34.462 C48.0037905,34.0038142 48.4161315,33.5013678 48.776,32.962 C47.8160886,32.2232657 46.4732202,32.2452459 45.538,33.015 C43.6686575,34.730555 41.5081096,36.0986763 39.158,37.055 C38.2002215,37.4027104 37.364735,38.0223745 36.754,38.838 Z" id="Shape" fill="currentColor" data-original="currentColor" style=""/><polygon id="Shape" points="18 2 16 2 16 6.75 18 5.25" fill="currentColor" data-original="currentColor" style=""/><path d="M28,3 C28.2163702,3 28.4269038,3.07017787 28.6,3.2 L43,14 L43,11.5 L28,0.25 L13,11.5 L13,14 L27.4,3.2 C27.5730962,3.07017787 27.7836298,3 28,3 Z" id="Shape" fill="currentColor" data-original="currentColor" style=""/><path d="M40,30 L40,14.25 L28,5.25 L16,14.25 L16,30 L22,30 L22,22 C22,18.6862915 24.6862915,16 28,16 C31.3137085,16 34,18.6862915 34,22 L34,30 L40,30 Z" id="Shape" fill="currentColor" data-original="currentColor" style=""/><path d="M24,22 L24,30 L32,30 L32,22 C32,19.790861 30.209139,18 28,18 C25.790861,18 24,19.790861 24,22 Z" id="Shape" fill="currentColor" data-original="currentColor" style=""/></g></g></g></svg>
						</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        <?php echo $this->tag->getTag('insurance','Insurance');?>             </font></font></span>
					</a>
				</li>
				<li class="<?php echo $actid=='valuation' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/valuation');?>" class=""> <span class="circle2">
					    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 510 510" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><path d="m480 272h-146c-15.805 0-28.785 12.288-29.911 27.811l-34.089-8.522v-199.758c18.58-6.276 32-23.86 32-44.531 0-25.916-21.084-47-47-47s-47 21.084-47 47c0 20.671 13.42 38.255 32 44.531v192.258l-34-8.5v-5.289c0-16.542-13.458-30-30-30h-146c-16.542 0-30 13.458-30 30v34c0 16.542 13.458 30 30 30h146c15.805 0 28.785-12.288 29.911-27.811l34.089 8.522v101.289h-98c-16.542 0-30 13.458-30 30v34c0 16.542 13.458 30 30 30h226c16.542 0 30-13.458 30-30v-34c0-16.542-13.458-30-30-30h-98v-93.789l34 8.5v5.289c0 16.542 13.458 30 30 30h146c16.542 0 30-13.458 30-30v-34c0-16.542-13.458-30-30-30zm-304 32h-146v-34h146c.02 34.829.1 34 0 34zm192 142c.019 34.735.1 34 0 34h-226v-34zm-113-382c-9.374 0-17-7.626-17-17s7.626-17 17-17 17 7.626 17 17-7.626 17-17 17zm225 272h-146v-34h146c.019 34.735.1 34 0 34z" fill="currentColor" data-original="currentColor" style=""/><path d="m358 238h98c16.542 0 30-13.458 30-30 0-88.041.304-82.434-.74-85.64-1.377-4.244 1.105-.653-55.838-64.713-11.886-13.374-32.875-13.466-44.844-.001-57.318 64.483-53.961 60.247-55.318 63.347-1.788 4.085-1.26-.7-1.26 87.007 0 16.542 13.458 30 30 30zm49-160.422 30.597 34.422h-61.194zm-49 64.422h98.004l.015 65.999c-.101.017-5.861.001-98.019.001z" fill="currentColor" data-original="currentColor" style=""/><path d="m51.91 174.39c14.49 7.975 23.793 10.286 35.06 11.221v5.389c0 9.497 8.778 15.971 16.03 14.96.01.01.01.01.02 0 5.708-.398 9.005-3.86 9.05-3.86 5.69-4.935 4.9-11.443 4.9-17.729 51.309-11.47 63.472-75.997 10.97-95.25-3.46-1.272-42.928-12.27-47.95-20.02-1.219-1.219-1.994-6.023 1-11.15 6.411-10.69 26.372-11.21 37.92-6.98 7.592 2.642 8.629 5.746 13.99 6.81 15.748 2.766 25.127-17.82 10.4-27.83-.101-.052-10.499-7.646-26.33-10.33 0-4.537.187-6.069-.62-8.9-4.66-15.289-26.109-13.548-29.06 1.19-.427 2.132-.32 2.786-.32 8.59-37.357 8.807-47.537 47.684-29.14 69 9.338 10.946 30.964 18.585 45.17 23.21 11.975 3.868 21.188 5.411 26.31 12.5 7.712 10.698-2.584 30.026-26.31 30.771-16.015.46-23.57-.6-36.57-7.851-7.25-4-16.38-1.38-20.39 5.87s-1.38 16.379 5.87 20.389z" fill="currentColor" data-original="currentColor" style=""/></g></g></svg>
					</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                       <?php echo $this->tag->getTag('valuation','Valuation');?>              </font></font></span>
					</a>
				</li>
				<li class="<?php echo $actid=='mortgage' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/mortgage');?>" class=""> <span class="circle2"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M511.862,216.774c-0.538-3.945-2.62-7.516-5.789-9.927L265.089,23.582c-5.371-4.084-12.807-4.084-18.178,0L5.926,206.847 c-3.17,2.41-5.252,5.982-5.789,9.927c-0.537,3.946,0.516,7.944,2.926,11.114l33.783,44.422l210.065-159.752 c5.371-4.084,12.806-4.084,18.178,0L475.154,272.31l33.782-44.422C511.346,224.718,512.398,220.721,511.862,216.774z" fill="currentColor" data-original="currentColor" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M320.216,356.886c-11.592,0-21.023,9.431-21.023,21.023c0,11.591,9.43,21.023,21.023,21.023s21.023-9.431,21.023-21.023 C341.238,366.317,331.807,356.886,320.216,356.886z" fill="currentColor" data-original="currentColor" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M191.785,265.003c-11.592,0-21.023,9.431-21.023,21.023c0,11.591,9.43,21.023,21.023,21.023 c11.592,0,21.023-9.431,21.023-21.023C212.808,274.434,203.376,265.003,191.785,265.003z" fill="currentColor" data-original="currentColor" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M256,143.372L72.016,283.289v193.176c0,8.292,6.723,15.015,15.015,15.015h337.931c8.292,0,15.015-6.723,15.015-15.015 V283.284L256,143.372z M140.733,286.026c0-28.15,22.901-51.052,51.052-51.052s51.052,22.901,51.052,51.052 c0,28.151-22.901,51.052-51.052,51.052S140.733,314.176,140.733,286.026z M208.942,428.963c-2.534,0-5.103-0.644-7.459-1.995 c-7.193-4.127-9.676-13.303-5.549-20.496l94.089-163.957c4.127-7.193,13.303-9.675,20.496-5.549 c7.193,4.127,9.676,13.303,5.549,20.496l-94.089,163.957C219.203,426.256,214.145,428.963,208.942,428.963z M320.216,428.96 c-28.15,0-51.052-22.901-51.052-51.052c0-28.151,22.901-51.052,51.052-51.052c28.151,0,51.052,22.901,51.052,51.052 C371.267,406.059,348.365,428.96,320.216,428.96z" fill="currentColor" data-original="currentColor" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg></span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        <?php echo $this->tag->getTag('mortgage','Mortgage');?>                </font></font></span>
					</a>
				</li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('member/update_profile');?>" class=""> 
					<span class="circle2">
				 	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m255.997 477.327 47.003-10.847-36.157-36.156z" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m246.722 446.363 7.777-33.7c.019-.083.047-.161.069-.242.037-.139.074-.278.118-.415s.088-.252.135-.376.088-.234.138-.349c.059-.137.124-.27.19-.4.049-.1.1-.195.151-.29.077-.14.159-.274.243-.408.054-.085.108-.169.165-.252.092-.134.189-.263.289-.39.061-.079.122-.157.186-.233.1-.123.213-.241.323-.357.045-.047.085-.1.131-.144l104.805-104.807c-29.258-60.181-83.362-96-145.442-96-45.522 0-87.578 19.485-118.421 54.865-31.062 35.633-48.565 85.3-49.536 140.291 18.364 9.261 93.769 44.844 167.957 44.844a298.024 298.024 0 0 0 30.722-1.637z" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m270.461 342.863h176v64h-176z" transform="matrix(.707 -.707 .707 .707 -160.078 363.266)" fill="currentColor" data-original="currentColor" style=""/><circle xmlns="http://www.w3.org/2000/svg" cx="216" cy="112" r="80" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m464 301.324a32 32 0 0 0 -54.627-22.624l45.254 45.254a31.785 31.785 0 0 0 9.373-22.63z" fill="currentColor" data-original="currentColor" style=""/></g></svg>
				
				 	</span>	<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                  <?php echo $this->tag->getTag('account_settings','Account Settings');?>                                </font></font></span>
					</a>
				</li>
				 
					 
				 
			</ul>
		</nav>
	</div>

	<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow  mob-row-z">
                <div class="col-12 padding-right-0">
                  <div class="card no-shadow no-border">
                    <div class="card-body mainb" id="<?php echo ($this->id=='update_property') ? 'place_an_ad' : '';?>"  >
	<!-- partial -->
	   	<?php 
	if($this->no_header=='1'){
	    $this->renderPartial('//layouts/_no_header_layout' );
	  
	    ?>
	    <?php } else { 
  echo $content; } ?>
	
	
	      </div>
                  </div>
                </div>
              </div>
            </div>
     
       
            </div><div class="clearfix" ></div>   
        
       
        

	
	
	
	
	
	
	
	
	
	
	
	</div>
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
   td a { white-space: normal;
display: inline-block;
vertical-align: middle;
word-break: break-word;
max-width: calc(100% - 40px);}


   </style>
   <div id="myModal2" class="modal reqsender fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display:block;">
        <button type="button" class="close rd-close" data-dismiss="modal"></button>
        <h4 class="modal-title" id="myModal2-title" >Request for Change Contact Details   </h4>
      </div>
      <div class="modal-body" id="cn_property">
        <p>loading....</p>
      </div>
    
    </div>
  </div>
		</div> 
		<div class="myaccount-menu is-ended container for-mobile">
		    <style>
		        
		         
    .myaccount-menu.is-ended.for-mobile{ position:fixed !important;}
    .myaccount-menu.is-ended .list-unstyled.myaccount-menu-navigation li .myaccount-menu__label {
   
    line-height: 28px;
}
		    </style>
		<nav class="clearfix margin-bottom-15">
			<ul class="list-unstyled myaccount-menu-navigation  ">
				<li class="bg-2-mob  <?php echo $actid=='dashboard' ? 'active' : '';?>">
					<a href="<?php echo Yii::App()->createUrl('member/dashboard');?>"> <span class="circle2">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <g> <path d="M366.292,215.99L241.417,325.781c-0.167,0.146-0.333,0.292-0.479,0.448c-4.042,4.021-6.271,9.385-6.271,15.104 c0,11.76,9.563,21.333,21.333,21.333c5.667,0,11.021-2.208,15.563-6.75l109.792-124.875c3.708-4.219,3.5-10.604-0.479-14.583 C376.896,212.49,370.542,212.281,366.292,215.99z" fill="currentColor" data-original="#000000" style=""/> <path d="M256,85.333c-141.167,0-256,114.844-256,256c0,26.479,4.104,52.688,12.167,77.917c1.417,4.417,5.521,7.417,10.167,7.417 h467.333c4.646,0,8.75-3,10.167-7.417C507.896,394.021,512,367.813,512,341.333C512,200.177,397.167,85.333,256,85.333z M458.667,352h31.26c-0.824,18.04-3.237,35.947-8.177,53.333H30.25c-4.94-17.387-7.353-35.293-8.177-53.333h31.26 C59.229,352,64,347.229,64,341.333c0-5.896-4.771-10.667-10.667-10.667h-31.46c1.581-34.919,10.68-67.865,25.948-97.208 l27.324,15.781c1.688,0.969,3.521,1.427,5.333,1.427c3.667,0,7.271-1.906,9.229-5.333c2.958-5.104,1.208-11.625-3.896-14.573 l-27.263-15.746c18.323-28.539,42.602-52.816,71.142-71.138l15.746,27.28c1.958,3.417,5.563,5.333,9.229,5.333 c1.813,0,3.646-0.458,5.333-1.427c5.104-2.948,6.854-9.469,3.896-14.573l-15.777-27.332c29.345-15.27,62.293-24.37,97.215-25.951 v31.46c0,5.896,4.771,10.667,10.667,10.667s10.667-4.771,10.667-10.667v-31.46c34.922,1.581,67.87,10.681,97.215,25.951 l-15.777,27.332c-2.958,5.104-1.208,11.625,3.896,14.573c1.688,0.969,3.521,1.427,5.333,1.427c3.667,0,7.271-1.917,9.229-5.333 l15.746-27.28c28.54,18.322,52.819,42.599,71.142,71.138l-27.263,15.746c-5.104,2.948-6.854,9.469-3.896,14.573 c1.958,3.427,5.563,5.333,9.229,5.333c1.812,0,3.646-0.458,5.333-1.427l27.324-15.781c15.268,29.344,24.367,62.289,25.948,97.208 h-31.46c-5.896,0-10.667,4.771-10.667,10.667C448,347.229,452.771,352,458.667,352z" fill="currentColor" data-original="#000000" style=""/> </g> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>
					</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                   Dashboard                                </font></font></span>
					</a>
				</li>
			  
				<li class="bg-3-mob <?php echo $actid=='insurance' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/insurance');?>"> <span class="circle2">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 60 60" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><!-- Generator: Sketch 51.3 (57544) - http://www.bohemiancoding.com/sketch --><title xmlns="http://www.w3.org/2000/svg">006 - Home Insurance</title><desc xmlns="http://www.w3.org/2000/svg">Created with Sketch.</desc><defs xmlns="http://www.w3.org/2000/svg"/><g xmlns="http://www.w3.org/2000/svg" id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="006---Home-Insurance" fill="currentColor" fill-rule="nonzero"><path d="M4.208,39.342 C4.73717222,40.5088011 5.47263195,41.5704919 6.379,42.476 L12.543,48.639 C12.195395,49.0070336 12.0012041,49.4937624 12,50 L12,58 C12,59.1045695 12.8954305,60 14,60 L25,60 C26.1045695,60 27,59.1045695 27,58 L27,50 C27,48.8954305 26.1045695,48 25,48 L25,46.139 C25.0305304,43.7708534 24.2582606,41.4621509 22.809,39.589 C21.9586309,38.4707591 20.7996995,37.6257195 19.475,37.158 C17.3691733,36.2730283 15.4325476,35.0299879 13.751,33.484 C12.1903615,32.1942997 9.9712756,32.0726393 8.279,33.184 L6.121,28.146 C5.66102057,27.1040349 4.68010027,26.3866155 3.54774229,26.2639868 C2.4153843,26.1413582 1.30362076,26.6321504 0.631242243,27.5514869 C-0.0411362773,28.4708233 -0.171979482,29.6790349 0.288,30.721 L4.208,39.342 Z M25,58 L14,58 L14,50 L25,50 L25,58 Z M2.191,28.758 C2.40759322,28.4155579 2.78582545,28.2094213 3.191,28.213 C3.66700986,28.2122141 4.09736921,28.4961017 4.284,28.934 L6.52,34.151 C7.11429336,35.5425105 7.97010296,36.8070447 9.041,37.876 L13.61,42.445 C13.8610745,42.7049566 14.2328779,42.8092126 14.5825073,42.7176972 C14.9321368,42.6261817 15.2051817,42.3531368 15.2966972,42.0035073 C15.3882126,41.6538779 15.2839566,41.2820745 15.024,41.031 L10.455,36.462 C9.99598241,36.0037515 9.58331535,35.501316 9.223,34.962 C10.1835296,34.2224882 11.5276474,34.2448902 12.463,35.016 C14.3318599,36.7316939 16.4921067,38.0998389 18.842,39.056 C19.7983175,39.4043895 20.6323375,40.0239969 21.242,40.839 C22.4095377,42.3565354 23.0291468,44.2245266 23,46.139 L23,48 L14.731,48 L7.793,41.062 C7.05633569,40.3260078 6.45843454,39.4632009 6.028,38.515 L2.108,29.894 C1.93781717,29.5263749 1.96918987,29.0969847 2.191,28.758 Z" id="Shape" fill="currentColor" data-original="#000000" style=""/><path d="M22,53 L21,53 C20.4477153,53 20,53.4477153 20,54 C20,54.5522847 20.4477153,55 21,55 L22,55 C22.5522847,55 23,54.5522847 23,54 C23,53.4477153 22.5522847,53 22,53 Z" id="Shape" fill="currentColor" data-original="#000000" style=""/><path d="M40.525,37.158 C39.2003005,37.6257195 38.0413691,38.4707591 37.191,39.589 C35.7417394,41.4621509 34.9694696,43.7708534 35,46.139 L35,48 C33.8954305,48 33,48.8954305 33,50 L33,58 C33,59.1045695 33.8954305,60 35,60 L46,60 C47.1045695,60 48,59.1045695 48,58 L48,50 C47.9987959,49.4937624 47.804605,49.0070336 47.457,48.639 L53.621,42.476 C54.5271174,41.5706634 55.2625517,40.509348 55.792,39.343 L59.712,30.721 C60.1719794,29.6790349 60.0411362,28.4708233 59.3687577,27.5514869 C58.6963792,26.6321505 57.5846157,26.1413582 56.4522577,26.2639869 C55.3198997,26.3866156 54.3389794,27.1040349 53.879,28.146 L51.721,33.181 C50.0292133,32.0691473 47.8100729,32.190833 46.25,33.481 C44.5681362,35.0278327 42.6312098,36.2718638 40.525,37.158 Z M46,58 L35,58 L35,50 L46,50 L46,58 Z M50.776,34.962 C50.4161315,35.5013678 50.0037905,36.0038142 49.545,36.462 L44.976,41.031 C44.5970278,41.4233789 44.6024476,42.0470848 44.9881814,42.4328186 C45.3739152,42.8185524 45.9976211,42.8239722 46.39,42.445 L50.959,37.876 C52.029897,36.8070447 52.8857066,35.5425105 53.48,34.151 L55.717,28.933 C55.90415,28.495671 56.3343096,28.2123087 56.81,28.213 C57.213904,28.2133006 57.5900345,28.4186257 57.8087347,28.7581971 C58.0274348,29.0977685 58.0587931,29.5251433 57.892,29.893 L53.972,38.515 C53.5415655,39.4632009 52.9436643,40.3260078 52.207,41.062 L45.269,48 L37,48 L37,46.139 C36.9697088,44.2250013 37.5878922,42.3570584 38.754,40.839 C39.3636625,40.0239969 40.1976825,39.4043895 41.154,39.056 C43.5041096,38.0996763 45.6646575,36.731555 47.534,35.016 C48.4697191,34.2438309 49.815084,34.221422 50.776,34.962 Z" id="Shape" fill="currentColor" data-original="#000000" style=""/><path d="M39,53 L38,53 C37.4477153,53 37,53.4477153 37,54 C37,54.5522847 37.4477153,55 38,55 L39,55 C39.5522847,55 40,54.5522847 40,54 C40,53.4477153 39.5522847,53 39,53 Z" id="Shape" fill="currentColor" data-original="#000000" style=""/><path d="M13.553,18.9 C13.8927613,19.0677128 14.2981287,19.0289957 14.6,18.8 L16,17.75 L16,32 C16,33.1045695 16.8954305,34 18,34 L42,34 C43.1045695,34 44,33.1045695 44,32 L44,17.75 L45.4,18.8 C45.7030176,19.0272632 46.1084296,19.0638192 46.4472136,18.8944272 C46.7859976,18.7250352 47,18.3787721 47,18 L47,13 C47,12.6852427 46.8518058,12.3888544 46.6,12.2 L30.6,0.2 C30.2444444,-0.0666666667 29.7555556,-0.0666666667 29.4,0.2 L22,5.75 L22,4 C22,2.8954305 21.1045695,2 20,2 L18,2 C16.8954305,2 16,2.8954305 16,4 L16,10.25 L13.4,12.2 C13.1481942,12.3888544 13,12.6852427 13,13 L13,18 C12.9979212,18.3808256 13.2123306,18.7297741 13.553,18.9 Z M26,32 L26,24 C26,21.790861 27.790861,20 30,20 C32.209139,20 34,21.790861 34,24 L34,32 L26,32 Z M42,32 L36,32 L36,24 C36,20.6862915 33.3137085,18 30,18 C26.6862915,18 24,20.6862915 24,24 L24,32 L18,32 L18,16.25 L30,7.25 L42,16.25 L42,32 Z M18,4 L20,4 L20,7.25 L18,8.75 L18,4 Z M15,13.5 L30,2.25 L45,13.5 L45,16 L30.6,5.2 C30.2444444,4.93333333 29.7555556,4.93333333 29.4,5.2 L15,16 L15,13.5 Z" id="Shape" fill="currentColor" data-original="#000000" style=""/></g></g></g></svg>

										</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                   Insurance                                </font></font></span>
					</a>
				</li>
				 
				 
			 
					<li class="bg-4-mob <?php echo $actid=='valuation' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/valuation');?>"  > <span class="circle2">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 375.148 375.148" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <g> <path d="M222.076,218.936h-68.963c-5.771,0-10.449,4.678-10.449,10.449v135.314c0,5.771,4.678,10.449,10.449,10.449h68.963 c5.771,0,10.449-4.678,10.449-10.449V229.385C232.525,223.614,227.847,218.936,222.076,218.936z M211.627,354.25h-48.065V239.834 h48.065V354.25z" fill="currentColor" data-original="#000000" style=""/> <path d="M358.958,136.911h-69.486c-5.771,0-10.449,4.678-10.449,10.449v217.339c0,5.771,4.678,10.449,10.449,10.449h69.486 c5.771,0,10.449-4.678,10.449-10.449V147.36C369.407,141.59,364.729,136.911,358.958,136.911z M348.509,354.25h-48.588V157.809 h48.588V354.25z" fill="currentColor" data-original="#000000" style=""/> <path d="M85.717,269.613H16.231c-5.771,0-10.449,4.678-10.449,10.449v84.637c0,5.771,4.678,10.449,10.449,10.449h69.486 c5.771,0,10.449-4.678,10.449-10.449v-84.637C96.166,274.292,91.488,269.613,85.717,269.613z M75.268,354.25H26.68v-63.739 h48.588V354.25z" fill="currentColor" data-original="#000000" style=""/> <path d="M370.452,10.479c-1.589-2.19-4.089-3.536-6.792-3.657L268.574,0.03c-5.771-0.433-10.8,3.895-11.233,9.665 c-0.433,5.771,3.894,10.8,9.665,11.233l67.297,4.57l-123.721,96.786l-94.563-74.188c-4.038-3.198-9.803-2.976-13.584,0.522 L5.26,141.613c-4.131,3.919-4.363,10.425-0.522,14.629c1.864,2.419,4.786,3.783,7.837,3.657c2.756-0.039,5.385-1.166,7.314-3.135 l90.384-86.727l93.518,73.665c3.817,3.056,9.244,3.056,13.061,0L350.601,39.624l-5.227,64.896 c-0.026,5.674,4.279,10.431,9.927,10.971h0.522c5.386,0.027,9.91-4.045,10.449-9.404l6.792-88.294 C373.447,15.074,372.471,12.34,370.452,10.479z" fill="currentColor" data-original="#000000" style=""/> </g> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg> 						
						</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        Valuation            </font></font></span>
					</a>
				 
					
				</li>
				<li class="bg-5-mob <?php echo $actid=='mortgage' ? 'active' : '';?>">
					<a href="<?php echo Yii::App()->createUrl('member/mortgage');?>" class=""> 
					<span class="circle2">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="24" height="24" x="0" y="0" viewBox="0 0 464.001 464.001" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M216,144c-17.673,0-32,14.327-32,32s14.327,32,32,32s32-14.327,32-32S233.673,144,216,144z M216,192 c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S224.837,192,216,192z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M312,240c-17.673,0-32,14.327-32,32c0,17.673,14.327,32,32,32c17.673,0,32-14.327,32-32C344,254.327,329.673,240,312,240z M312,288c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S320.837,288,312,288z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <rect x="173.491" y="215.999" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -81.0676 252.2835)" width="181.017" height="16" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M453.024,132.4L398.4,96h1.6V40c0-4.418-3.582-8-8-8h-40c-4.418,0-8,3.582-8,8v19.72l-75.56-50.4 c-2.688-1.794-6.192-1.794-8.88,0L74.976,132.4c-11.324,7.549-14.385,22.848-6.836,34.172 c7.549,11.324,22.848,14.385,34.172,6.836L128,156.288V312h-16c0-4.418-3.582-8-8-8H40c-4.418,0-8,3.582-8,8H0v16h32v80H0v16h32 c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-3.048l59.728,24.8c32.56,13.298,68.961,13.702,101.808,1.128l123.584-47.128 c7.321-2.782,13.213-8.397,16.344-15.576c3.233-7.28,3.4-15.555,0.464-22.96c-2.616-6.621-7.572-12.05-13.928-15.256V156.288 l25.688,17.12c11.324,7.549,26.623,4.488,34.172-6.836C467.409,155.248,464.348,139.948,453.024,132.4z M96,416H48v-96h48V416z M360,48h24v38.4l-24-16V48z M398.792,377.728c-1.413,3.266-4.084,5.825-7.408,7.096L267.8,431.944 c-29.039,11.124-61.223,10.778-90.016-0.968L112,403.624V328h20.28c26.526,0.031,52.684,6.206,76.424,18.04 c7.839,3.913,16.479,5.953,25.24,5.96H296c6.627,0.043,11.965,5.45,11.922,12.077c-0.036,5.551-3.875,10.354-9.282,11.611 c-1.048,0.096-2.072,0.312-3.136,0.312H200v16h95.504c0.168,0,0.328,0,0.496,0c0.16,0,0.312-0.048,0.48-0.048 c6.349-0.102,12.619-1.431,18.464-3.912l66.888-28.392c3.186-1.36,6.79-1.36,9.976,0c3.314,1.399,5.914,4.088,7.2,7.448 C400.367,370.525,400.289,374.357,398.792,377.728z M296,336h-62.056c-6.278-0.009-12.469-1.472-18.088-4.272 c-22.423-11.17-46.855-17.742-71.856-19.328V145.6l120-80l120,80v197.28c-2.894,0.244-5.735,0.926-8.424,2.024l-51.872,22.024 c0.151-0.97,0.25-1.947,0.296-2.928C324,348.536,311.464,336,296,336z M439.353,161.561c-1.706,0-3.373-0.504-4.793-1.449 L268.44,49.344c-2.688-1.794-6.192-1.794-8.88,0L93.44,160.096c-3.976,2.647-9.344,1.569-11.991-2.407 c-0.945-1.42-1.449-3.087-1.449-4.793c-0.005-2.893,1.44-5.597,3.848-7.2L264,25.6l180.152,120.112 c2.408,1.604,3.853,4.307,3.848,7.2C448.001,157.688,444.129,161.56,439.353,161.561z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <rect x="64" y="384" width="16" height="16" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>
						</span>	<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                  Mortgage                                  </font></font></span>
					</a>
				</li>
				 
					 
				 
			</ul>
		</nav>
		<div class="clearfix"></div>
	</div>
	
	
	 
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
                <h5 class="modal-title">Ad Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
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
<style>
			.slpbtn.btn.btn-xs {
    padding: 5px 15px;}
    .ms-package-select {    line-height: 30px;    background: #eee;    margin: 10px 0px;}
			</style>
			<div class="modal fade" id="modal_komplain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Select Your Boost Option</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="html_b">
				<div class="text-center"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

</body>
</html>
