<!DOCTYPE html>
<html   lang="<?php echo $this->language;?>" dir="<?php echo $this->direction;?>"  class="memberSecure  <?php echo $this->secure_header == '1' ? 'secure' : '';?> <?php echo $this->no_header  == '1' ? 'secure no-header' : '';?>" >
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title><?php echo Yii::t('app',$pageMetaTitle,array('::'=>' | ')) ;?></title>
   
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="google-site-verification" content="gYY9Itu5_ej42w0P_Wi9ISGUEFs_4gMA4yWC-QLVmpg" /ara>
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
var CALLING_title =   '<?php echo Yii::t('app','Please quote property reference{}when calling us',array('{}'=>'<div dir="ltr" class="phone-div-tedifgar">[REFERENCENUMBER]</div>'));?>';
var Phone_title 	=   'Phone' ;
var Agent_title 	=  'Agent' ;
var Close_title 	=  'Close' ;
var call_statistics = '<?php echo $this->app->createUrl('articles/statistics/case/C');?>/';
var Contact_title 	=  'Contact Us';
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
              <li class=" margin-left-15">
              <a class="nav-link count-indicator"   id="messageDropdown" href="<?php echo Yii::app()->createUrl('member/favourite');?>"  >
                <i class="fa fa-heart" style="color:var(--logo-color);"></i>
              </a>
           
            </li>
			  <li class=" margin-left-15"><a href="<?php echo Yii::App()->createUrl('place_an_ad/create');?>" style="height:auto;" class="margin-left-0 margin-right-0 submit-pop transparentWhite text-uppercase  fwBold noShrink hidden-xs"><i class="fa fa-plus"></i> <span class=""><?php echo $this->tag->getTag('submit_property','Submit Property');?></span></a></li>
			 
		 
            <li class="nav-item dropdown  d-xl-inline-block user-dropdown margin-left-15">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="<?php echo $member->getAvatarUrl( 125, '',  true); ?>" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="<?php echo $member->getAvatarUrl( 125, '',  true); ?>" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $member->FirstNameN;?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo $member->TypeTile;?></p>
                </div>
                 
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('member/dashboard');?>"><?php echo $this->tag->getTag('dashboard','Dashboard');?><i class="dropdown-item-icon ti-location-arrow"></i></a>
                <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('member/update_profile');?>"><?php echo $this->tag->getTag('account_settings','Account Settings');?><i class="dropdown-item-icon ti-location-arrow"></i></a>
                <?php 
                if(in_array( $this->mem->user_type,array('A','C','D')) and $this->mem->status=='A' and $this->member->enable_l_f=='1'   ){ 
                
                ?> 
                <a href="<?php echo $member->status=='A' ?  $member->AgentDetailUrl : 'javascript:void(0)';?>" class="dropdown-item" ><?php echo $this->tag->getTag('my_page','My Page');?></a>
                <?php } ?> 
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
              <a class="nav-link" href="<?php echo Yii::app()->createUrl('place_an_ad/index');?>">
               
                <span class="menu-title"><?php echo $this->tag->getTag('my_ads','My Ads');?></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo Yii::app()->createUrl('member/enquiry');?>">
              
                <span class="menu-title"><?php echo $this->tag->getTag('inquiries','Inquiries');?></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo Yii::app()->createUrl('member/statistics');?>">
               
                <span class="menu-title"><?php echo $this->tag->getTag('statistics','Statistics');?></span>
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
             
                <span class="menu-title"><?php echo $this->tag->getTag('sign_out','Sign out');?></span>
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
			<ul class="list-unstyled myaccount-menu-navigation tmpl <?php echo (in_array( $this->member->user_type,array('M','C','D'))) ? 'member-7' : '';?>">
			    <?php $actid = $this->action->id;?>
				<li class="<?php echo $actid=='dashboard' ? 'active' : '';?>" >
					<a href="<?php echo Yii::App()->createUrl('member/dashboard');?>"> <span class="circle2">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%"  x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m197.332031 170.667969h-160c-20.585937 0-37.332031-16.746094-37.332031-37.335938v-96c0-20.585937 16.746094-37.332031 37.332031-37.332031h160c20.589844 0 37.335938 16.746094 37.335938 37.332031v96c0 20.589844-16.746094 37.335938-37.335938 37.335938zm-160-138.667969c-2.941406 0-5.332031 2.390625-5.332031 5.332031v96c0 2.945313 2.390625 5.335938 5.332031 5.335938h160c2.945313 0 5.335938-2.390625 5.335938-5.335938v-96c0-2.941406-2.390625-5.332031-5.335938-5.332031zm0 0" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m197.332031 512h-160c-20.585937 0-37.332031-16.746094-37.332031-37.332031v-224c0-20.589844 16.746094-37.335938 37.332031-37.335938h160c20.589844 0 37.335938 16.746094 37.335938 37.335938v224c0 20.585937-16.746094 37.332031-37.335938 37.332031zm-160-266.667969c-2.941406 0-5.332031 2.390625-5.332031 5.335938v224c0 2.941406 2.390625 5.332031 5.332031 5.332031h160c2.945313 0 5.335938-2.390625 5.335938-5.332031v-224c0-2.945313-2.390625-5.335938-5.335938-5.335938zm0 0" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m474.667969 512h-160c-20.589844 0-37.335938-16.746094-37.335938-37.332031v-96c0-20.589844 16.746094-37.335938 37.335938-37.335938h160c20.585937 0 37.332031 16.746094 37.332031 37.335938v96c0 20.585937-16.746094 37.332031-37.332031 37.332031zm-160-138.667969c-2.945313 0-5.335938 2.390625-5.335938 5.335938v96c0 2.941406 2.390625 5.332031 5.335938 5.332031h160c2.941406 0 5.332031-2.390625 5.332031-5.332031v-96c0-2.945313-2.390625-5.335938-5.332031-5.335938zm0 0" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m474.667969 298.667969h-160c-20.589844 0-37.335938-16.746094-37.335938-37.335938v-224c0-20.585937 16.746094-37.332031 37.335938-37.332031h160c20.585937 0 37.332031 16.746094 37.332031 37.332031v224c0 20.589844-16.746094 37.335938-37.332031 37.335938zm-160-266.667969c-2.945313 0-5.335938 2.390625-5.335938 5.332031v224c0 2.945313 2.390625 5.335938 5.335938 5.335938h160c2.941406 0 5.332031-2.390625 5.332031-5.335938v-224c0-2.941406-2.390625-5.332031-5.332031-5.332031zm0 0" fill="currentColor" data-original="currentColor" style=""/></g></svg>

					</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $this->tag->getTag('dashboard','Dashboard');?></font></font></span>
					</a>
				</li>
				<?php
				if(in_array( $this->member->user_type,array('M','C','D'))) { ?> 
				<li class="<?php echo in_array($actid,array('list_agents','add_agents')) ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/list_agents');?>"> <span class="circle2">
		 		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 477.869 477.869" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M387.415,233.496c48.976-44.029,52.987-119.424,8.958-168.4C355.991,20.177,288.4,12.546,239.02,47.332 c-53.83-37.99-128.264-25.149-166.254,28.68c-34.859,49.393-27.259,117.054,17.689,157.483 c-55.849,29.44-90.706,87.481-90.453,150.613v51.2c0,9.426,7.641,17.067,17.067,17.067h443.733 c9.426,0,17.067-7.641,17.067-17.067v-51.2C478.121,320.976,443.264,262.935,387.415,233.496z M307.201,59.842 c47.062-0.052,85.256,38.057,85.309,85.119c0.037,33.564-19.631,64.023-50.237,77.799c-1.314,0.597-2.628,1.143-3.959,1.707 c-4.212,1.699-8.556,3.051-12.988,4.045c-0.853,0.188-1.707,0.29-2.577,0.461c-4.952,0.949-9.977,1.457-15.019,1.519 c-2.27,0-4.557-0.171-6.827-0.375c-0.853,0-1.707,0-2.56-0.171c-9.7-1.142-19.136-3.923-27.904-8.226 c-0.324-0.154-0.7-0.137-1.024-0.273c-1.707-0.819-3.413-1.536-4.932-2.458c0.137-0.171,0.222-0.358,0.358-0.529 c7.826-10.056,13.996-21.296,18.278-33.297l0.529-1.434c1.947-5.732,3.459-11.602,4.523-17.562c0.154-0.87,0.273-1.707,0.41-2.645 c0.987-6.067,1.506-12.2,1.553-18.347c-0.049-6.135-0.568-12.257-1.553-18.313c-0.137-0.887-0.256-1.707-0.41-2.645 c-1.064-5.959-2.576-11.83-4.523-17.562l-0.529-1.434c-4.282-12.001-10.453-23.241-18.278-33.297 c-0.137-0.171-0.222-0.358-0.358-0.529C277.449,63.831,292.19,59.843,307.201,59.842z M85.335,145.176 c-0.121-47.006,37.886-85.21,84.892-85.331c22.034-0.057,43.232,8.434,59.134,23.686c0.99,0.956,1.963,1.911,2.918,2.901 c2.931,3.071,5.634,6.351,8.09,9.813c0.751,1.058,1.434,2.185,2.133,3.277c2.385,3.671,4.479,7.523,6.263,11.52 c0.427,0.973,0.751,1.963,1.126,2.935c1.799,4.421,3.215,8.989,4.233,13.653c0.12,0.512,0.154,1.024,0.256,1.553 c2.162,10.597,2.162,21.522,0,32.119c-0.102,0.529-0.137,1.041-0.256,1.553c-1.017,4.664-2.433,9.232-4.233,13.653 c-0.375,0.973-0.7,1.963-1.126,2.935c-1.786,3.991-3.88,7.837-6.263,11.503c-0.7,1.092-1.382,2.219-2.133,3.277 c-2.455,3.463-5.159,6.742-8.09,9.813c-0.956,0.99-1.929,1.946-2.918,2.901c-6.91,6.585-14.877,11.962-23.569,15.906 c-1.382,0.631-2.782,1.212-4.198,1.707c-4.114,1.633-8.347,2.945-12.663,3.925c-1.075,0.239-2.185,0.375-3.277,0.563 c-4.634,0.863-9.333,1.336-14.046,1.417h-1.877c-4.713-0.08-9.412-0.554-14.046-1.417c-1.092-0.188-2.202-0.324-3.277-0.563 c-4.316-0.98-8.55-2.292-12.663-3.925c-1.417-0.563-2.816-1.143-4.198-1.707C105.013,209.057,85.374,178.677,85.335,145.176z M307.201,418.242H34.135v-34.133c-0.25-57.833,36.188-109.468,90.76-128.614c29.296,12.197,62.249,12.197,91.546,0 c5.698,2.082,11.251,4.539,16.623,7.356c3.55,1.826,6.827,3.908,10.24,6.007c2.219,1.382,4.471,2.731,6.605,4.25 c3.294,2.338,6.4,4.881,9.455,7.492c1.963,1.707,3.908,3.413,5.751,5.12c2.816,2.662,5.461,5.478,8.004,8.363 c1.826,2.082,3.601,4.198,5.291,6.383c2.236,2.867,4.369,5.803,6.349,8.823c1.707,2.56,3.226,5.222,4.727,7.885 c1.707,2.935,3.277,5.871,4.71,8.926c1.434,3.055,2.697,6.4,3.925,9.66c1.075,2.833,2.219,5.649,3.106,8.533 c1.195,3.959,2.031,8.055,2.867,12.151c0.512,2.423,1.178,4.796,1.553,7.253c1.011,6.757,1.53,13.579,1.553,20.412V418.242z M443.735,418.242h-102.4v-34.133c0-5.342-0.307-10.633-0.785-15.872c-0.137-1.536-0.375-3.055-0.546-4.591 c-0.461-3.772-0.99-7.509-1.707-11.213c-0.307-1.581-0.631-3.169-0.973-4.762c-0.819-3.8-1.769-7.566-2.85-11.298 c-0.358-1.229-0.683-2.475-1.058-3.686c-4.779-15.277-11.704-29.797-20.565-43.127l-0.666-0.973 c-2.935-4.358-6.07-8.573-9.404-12.646l-0.119-0.154c-3.413-4.232-7.117-8.346-11.008-12.237c0.222,0,0.461,0,0.7,0 c4.816,0.633,9.666,0.975,14.524,1.024h0.939c4.496-0.039,8.985-0.33,13.449-0.87c1.399-0.171,2.782-0.427,4.181-0.649 c3.63-0.557,7.214-1.28,10.752-2.167c1.007-0.256,2.031-0.495,3.055-0.785c4.643-1.263,9.203-2.814,13.653-4.642 c54.612,19.127,91.083,70.785,90.829,128.649V418.242z" fill="currentColor" data-original="currentColor" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>
					</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $this->tag->gettag('users','Users');?></font></font></span>
					</a>
				</li>
		        <?php } ?>
			  
				<li class="<?php echo $this->id=='place_an_ad' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('place_an_ad/index');?>"> <span class="circle2">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><path d="m253.219 407h-80c-8.285 0-15 6.716-15 15s6.715 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z" fill="currentColor" data-original="currentColor" style=""/><path d="m253.219 347h-80c-8.285 0-15 6.716-15 15s6.715 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z" fill="currentColor" data-original="currentColor" style=""/><path d="m489.388 295.328-49.496-49.498c-5.853-5.854-15.357-5.857-21.213 0l-10.46 10.46v-196.29c0-8.284-6.716-15-15-15h-90v-30c0-8.284-6.716-15-15-15h-150c-8.285 0-15 6.716-15 15v30h-90c-8.285 0-15 6.716-15 15v437c0 8.284 6.715 15 15 15h360c8.284 0 15-6.716 15-15v-99.29l81.169-81.17c5.858-5.857 5.858-15.355 0-21.212zm-216.169-265.328v60h-120v-60zm105 452h-330v-407h75v30c0 8.284 6.715 15 15 15h150c8.284 0 15-6.716 15-15v-30h75v211.29l-75.607 75.606c-2.814 2.813-4.393 6.628-4.393 10.607v49.497c0 8.284 6.715 15 15 15h49.498c3.979 0 7.794-1.58 10.606-4.394l4.896-4.896zm-21.715-75h-28.285v-28.284l101.066-101.066 28.283 28.284z" fill="currentColor" data-original="currentColor" style=""/><path d="m306.635 216.708c3.705-7.41.702-16.42-6.708-20.125l-80-40c-4.223-2.111-9.193-2.111-13.416 0l-80 40c-7.41 3.705-10.413 12.715-6.708 20.125 3.424 6.849 11.379 9.921 18.416 7.422v70.87c0 8.284 6.715 15 15 15h120c8.284 0 15-6.716 15-15v-70.861c7.102 2.521 15.018-.634 18.416-7.431zm-78.416 63.292v-15c0-8.284-6.716-15-15-15-8.285 0-15 6.716-15 15v15h-30v-70.73l45-22.5 45 22.5v70.73z" fill="currentColor" data-original="currentColor" style=""/></g></g></svg>
										</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $this->tag->getTag('my_properties','My Properties');?></font></font></span>
					</a>
				</li>
					 
				    	<li class="">
					<a href="<?php echo Yii::app()->createUrl('place_an_ad/create');?>"> <span class="circle2">
		 		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " fill="currentColor" data-original="currentColor" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" fill="currentColor" data-original="currentColor" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>
					</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $this->tag->getTag('submit_property','Submit Property');?></font></font></span>
					</a>
				</li>
				     
				<li class="<?php echo $actid=='statistics' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/Statistics');?>" class=""> <span class="circle2">
					    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1"  class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><path d="m512 482h-30v-302h-91v302h-30v-182h-90v182h-30v-242h-90v242h-30v-152h-91v152h-30v30h512z" fill="currentColor" data-original="currentColor" style=""/><path d="m512 120v-120h-121v30h69.789l-144.789 143.789-120-120-191.605 190.606 21.21 21.21 170.395-169.394 120 120 166-165v68.789z" fill="currentColor" data-original="currentColor" style=""/></g></g></svg>
 						
						</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                       <?php echo $this->tag->getTag('statistics','Statistics');?>             </font></font></span>
					</a>
				</li> 
				 
			 
				<li class="<?php echo $actid=='enquiry' ? 'active' : '';?>">
					<a href="<?php echo Yii::app()->createUrl('member/enquiry');?>" class=""> <span class="circle2">
					    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 496 496" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m392 279.499v-172c0-26.467-21.533-48-48-48h-296c-26.467 0-48 21.533-48 48v172c0 26.467 21.533 48 48 48h43.085l.919 43.339c.275 13.021 15.227 20.281 25.628 12.438l73.983-55.776h152.385c26.467-.001 48-21.534 48-48.001zm-205.74 16c-3.476 0-6.856 1.132-9.632 3.224l-53.294 40.179-.588-27.741c-.185-8.702-7.292-15.661-15.996-15.661h-58.75c-8.822 0-16-7.178-16-16v-172c0-8.822 7.178-16 16-16h296c8.822 0 16 7.178 16 16v172c0 8.822-7.178 16-16 16h-157.74zm309.74-88v132c0 26.468-21.532 48-48 48h-43.153l-.852 33.408c-.222 8.694-7.347 15.592-15.994 15.592-6.385 0-2.83 1.107-82.856-49h-73.145c-8.837 0-16-7.163-16-16s7.163-16 16-16c84.866 0 80.901-.898 86.231 2.438l54.489 34.117.534-20.964c.222-8.675 7.317-15.592 15.995-15.592h58.751c8.822 0 16-7.178 16-16v-132c0-8.822-7.178-16-16-16-8.837 0-16-7.163-16-16s7.163-16 16-16c26.468.001 48 21.533 48 48.001zm-200-43c0 8.837-7.163 16-16 16h-168c-8.837 0-16-7.163-16-16s7.163-16 16-16h168c8.837 0 16 7.163 16 16zm-29 70c0 8.837-7.163 16-16 16h-110c-8.837 0-16-7.163-16-16s7.163-16 16-16h110c8.837 0 16 7.163 16 16z" fill="currentColor" data-original="currentColor" style=""/></g></svg>
 						
						</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        <?php echo $this->tag->getTag('inquiries','Inquiries');?>            </font></font></span>
					</a>
				</li>
				<li>
					<a href="<?php echo Yii::app()->createUrl('member/update_profile');?>" class=""> 
					<span class="circle2">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" class="menu-icon" width="100%" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m255.997 477.327 47.003-10.847-36.157-36.156z" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m246.722 446.363 7.777-33.7c.019-.083.047-.161.069-.242.037-.139.074-.278.118-.415s.088-.252.135-.376.088-.234.138-.349c.059-.137.124-.27.19-.4.049-.1.1-.195.151-.29.077-.14.159-.274.243-.408.054-.085.108-.169.165-.252.092-.134.189-.263.289-.39.061-.079.122-.157.186-.233.1-.123.213-.241.323-.357.045-.047.085-.1.131-.144l104.805-104.807c-29.258-60.181-83.362-96-145.442-96-45.522 0-87.578 19.485-118.421 54.865-31.062 35.633-48.565 85.3-49.536 140.291 18.364 9.261 93.769 44.844 167.957 44.844a298.024 298.024 0 0 0 30.722-1.637z" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m270.461 342.863h176v64h-176z" transform="matrix(.707 -.707 .707 .707 -160.078 363.266)" fill="currentColor" data-original="currentColor" style=""/><circle xmlns="http://www.w3.org/2000/svg" cx="216" cy="112" r="80" fill="currentColor" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m464 301.324a32 32 0 0 0 -54.627-22.624l45.254 45.254a31.785 31.785 0 0 0 9.373-22.63z" fill="currentColor" data-original="currentColor" style=""/></g></svg>
					</span>	<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                  <?php echo $this->tag->getTag('account_settings','Account Settings');?>                                 </font></font></span>
					</a>
				</li>
				 
					 
				 
			</ul>
		</nav>
	</div>

	<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow mob-row-z">
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
				<li class="bg-2-mob">
					<a href="<?php echo Yii::App()->createUrl('member/dashboard');?>"> <span class="circle2">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <g> <path d="M366.292,215.99L241.417,325.781c-0.167,0.146-0.333,0.292-0.479,0.448c-4.042,4.021-6.271,9.385-6.271,15.104 c0,11.76,9.563,21.333,21.333,21.333c5.667,0,11.021-2.208,15.563-6.75l109.792-124.875c3.708-4.219,3.5-10.604-0.479-14.583 C376.896,212.49,370.542,212.281,366.292,215.99z" fill="currentColor" data-original="#000000" style=""/> <path d="M256,85.333c-141.167,0-256,114.844-256,256c0,26.479,4.104,52.688,12.167,77.917c1.417,4.417,5.521,7.417,10.167,7.417 h467.333c4.646,0,8.75-3,10.167-7.417C507.896,394.021,512,367.813,512,341.333C512,200.177,397.167,85.333,256,85.333z M458.667,352h31.26c-0.824,18.04-3.237,35.947-8.177,53.333H30.25c-4.94-17.387-7.353-35.293-8.177-53.333h31.26 C59.229,352,64,347.229,64,341.333c0-5.896-4.771-10.667-10.667-10.667h-31.46c1.581-34.919,10.68-67.865,25.948-97.208 l27.324,15.781c1.688,0.969,3.521,1.427,5.333,1.427c3.667,0,7.271-1.906,9.229-5.333c2.958-5.104,1.208-11.625-3.896-14.573 l-27.263-15.746c18.323-28.539,42.602-52.816,71.142-71.138l15.746,27.28c1.958,3.417,5.563,5.333,9.229,5.333 c1.813,0,3.646-0.458,5.333-1.427c5.104-2.948,6.854-9.469,3.896-14.573l-15.777-27.332c29.345-15.27,62.293-24.37,97.215-25.951 v31.46c0,5.896,4.771,10.667,10.667,10.667s10.667-4.771,10.667-10.667v-31.46c34.922,1.581,67.87,10.681,97.215,25.951 l-15.777,27.332c-2.958,5.104-1.208,11.625,3.896,14.573c1.688,0.969,3.521,1.427,5.333,1.427c3.667,0,7.271-1.917,9.229-5.333 l15.746-27.28c28.54,18.322,52.819,42.599,71.142,71.138l-27.263,15.746c-5.104,2.948-6.854,9.469-3.896,14.573 c1.958,3.427,5.563,5.333,9.229,5.333c1.812,0,3.646-0.458,5.333-1.427l27.324-15.781c15.268,29.344,24.367,62.289,25.948,97.208 h-31.46c-5.896,0-10.667,4.771-10.667,10.667C448,347.229,452.771,352,458.667,352z" fill="currentColor" data-original="#000000" style=""/> </g> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>
					</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                   <?php echo $this->tag->getTag('dashboard','Dashboard');?>                                </font></font></span>
					</a>
				</li>
			  
				<li class="bg-3-mob">
					<a href="<?php echo Yii::app()->createUrl('place_an_ad/index');?>"> <span class="circle2">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 343.5 343.5" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M322.05,161.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10C332.05,166.3,327.65,161.8,322.05,161.8 z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M57.95,125.3c-25.7,0-46.5,20.8-46.5,46.5s20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5S83.65,125.3,57.95,125.3z M57.95,198.3c-14.7,0-26.5-11.9-26.5-26.5c0-14.7,11.9-26.5,26.5-26.5c14.6,0,26.5,11.9,26.5,26.5S72.55,198.3,57.95,198.3z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M322.05,36.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10C332.05,41.3,327.65,36.8,322.05,36.8z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M57.95,0c-25.7,0-46.5,20.8-46.5,46.5c0,25.7,20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5C104.45,20.9,83.65,0.1,57.95,0z M57.95,73.1c-14.7,0-26.5-11.9-26.5-26.5c0-14.6,11.9-26.5,26.5-26.5c14.7,0,26.5,11.9,26.5,26.5 C84.45,61.2,72.55,73.1,57.95,73.1z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M322.05,286.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10S327.65,286.8,322.05,286.8z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M57.95,250.5c-25.7,0-46.5,20.8-46.5,46.5c0,25.7,20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5 C104.45,271.4,83.65,250.5,57.95,250.5z M57.95,323.6c-14.7,0-26.5-11.9-26.5-26.5c0-14.7,11.9-26.5,26.5-26.5 c14.7,0,26.5,11.9,26.5,26.5S72.55,323.6,57.95,323.6z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>
										</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                   <?php echo $this->tag->getTag('my_ads','My Ads');?>                                    </font></font></span>
					</a>
				</li>
				 
				 
			 
					<li class="bg-4-mob">
					<a href="<?php echo Yii::app()->createUrl('member/Statistics');?>"  > <span class="circle2">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 375.148 375.148" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <g> <path d="M222.076,218.936h-68.963c-5.771,0-10.449,4.678-10.449,10.449v135.314c0,5.771,4.678,10.449,10.449,10.449h68.963 c5.771,0,10.449-4.678,10.449-10.449V229.385C232.525,223.614,227.847,218.936,222.076,218.936z M211.627,354.25h-48.065V239.834 h48.065V354.25z" fill="currentColor" data-original="#000000" style=""/> <path d="M358.958,136.911h-69.486c-5.771,0-10.449,4.678-10.449,10.449v217.339c0,5.771,4.678,10.449,10.449,10.449h69.486 c5.771,0,10.449-4.678,10.449-10.449V147.36C369.407,141.59,364.729,136.911,358.958,136.911z M348.509,354.25h-48.588V157.809 h48.588V354.25z" fill="currentColor" data-original="#000000" style=""/> <path d="M85.717,269.613H16.231c-5.771,0-10.449,4.678-10.449,10.449v84.637c0,5.771,4.678,10.449,10.449,10.449h69.486 c5.771,0,10.449-4.678,10.449-10.449v-84.637C96.166,274.292,91.488,269.613,85.717,269.613z M75.268,354.25H26.68v-63.739 h48.588V354.25z" fill="currentColor" data-original="#000000" style=""/> <path d="M370.452,10.479c-1.589-2.19-4.089-3.536-6.792-3.657L268.574,0.03c-5.771-0.433-10.8,3.895-11.233,9.665 c-0.433,5.771,3.894,10.8,9.665,11.233l67.297,4.57l-123.721,96.786l-94.563-74.188c-4.038-3.198-9.803-2.976-13.584,0.522 L5.26,141.613c-4.131,3.919-4.363,10.425-0.522,14.629c1.864,2.419,4.786,3.783,7.837,3.657c2.756-0.039,5.385-1.166,7.314-3.135 l90.384-86.727l93.518,73.665c3.817,3.056,9.244,3.056,13.061,0L350.601,39.624l-5.227,64.896 c-0.026,5.674,4.279,10.431,9.927,10.971h0.522c5.386,0.027,9.91-4.045,10.449-9.404l6.792-88.294 C373.447,15.074,372.471,12.34,370.452,10.479z" fill="currentColor" data-original="#000000" style=""/> </g> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg> 						
						</span>
						<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        <?php echo $this->tag->getTag('statistics','Statistics');?>            </font></font></span>
					</a>
				 
					
				</li>
				<li>
					<a href="<?php echo Yii::App()->createUrl('place_an_ad/create');?>" class=""> 
					<span class="circle2">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="14" height="14" x="0" y="0" viewBox="0 0 448 448" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0" fill="currentColor" data-original="#000000" style=""></path></g></svg>
					 </span>	<span class="myaccount-menu__label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                 <?php echo $this->tag->getTag('property','Property');?>                                   </font></font></span>
					</a>
				</li>
				 
					 
				 
			</ul>
		</nav>
		<div class="clearfix"></div>
	</div>
	
	
	 
  <script>
    function openUrlFUll(k){
       $('#myModal-details').modal('show');
      
      $('#m_frame').html('<iframe id="ifrm" src="" style="width:100%;height:100%;border:0px;min-height:calc(100vh - 210px);background-image:url(/assets/img/Ring-Preloader.gif);background-position: center;background-size: 250px;background-repeat: no-repeat;" ></iframe>')
        var el = document.getElementById('ifrm');
          el.src = $(k).attr('data-url');
    }
    var unfeatured_url = '<?php echo $this->app->createUrl('member/make_unfeature');?>/id/';
    
</script>
<style>
   html[dir="rtl"] .modal-header .close {   margin: -25px auto -25px -15px; }
</style>
<div class="modal fade" id="myModal-details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height:97vh;min-height:200px;margin: 0 auto; ">
        <div class="modal-content">
         <div class="modal-header">
                <h5 class="modal-title"><?php echo $this->tag->getTag('preview','Preview');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4" id="result">
                
                <div class="row" id="m_frame">
                     
               
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->tag->getTag('close','Close');?></button>
            </div>
        </div>
    </div>
</div>
<style>
			.slpbtn.btn.btn-xs {
    padding: 5px 15px;}
    .ms-package-select {    line-height: 30px;    background: #eee;    margin: 10px 0px;}
			</style>
			<script>
			var yes_text = '<?php echo $this->tag->getTag('yes','Yes');?>';
			var no_text  = '<?php echo $this->tag->getTag('no','No');?>';
			var add_feat  = '<?php echo $this->tag->getTag('are_you_sure_to_add_this_featu','Are you sure to add this Featured?');?>';
				var un_feat  = '<?php echo $this->tag->getTag('are_you_sure_to_remove_this_f','Are you sure to remove  this Featured?');?>';
			</script>
			<div class="modal fade" id="modal_komplain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo $this->tag->getTag('select_your_boost_option','Select Your Boost Option');?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="html_b">
				<div class="text-center"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->tag->getTag('close','Close');?></button>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo $this->app->apps->getBaseUrl('assets/js/build/css/intlTelInput.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->app->apps->getBaseUrl('assets/js/rangeslider/rangeslider.css?q=1516');?>" />

</body>
</html>

