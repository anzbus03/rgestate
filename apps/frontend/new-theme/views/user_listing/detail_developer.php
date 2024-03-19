<style>
footer h3.widget-title , footer .menu li { text-align:left; } 
a.zfoot-footer-logo{     display: inline-block; }
span.managed_by { float: left;    position: absolute;    left: 0;    line-height: 70px;}
.communities-menu-featured img {
    height: 320px;
    max-width: 100%;
    object-fit:cover;
}
.foot-img{
    display: inline-block;
    
    width: 80px;
    line-height: 70px;
}
.col-md-12 .prop-block:hover img {
    -webkit-transition: all .8s ease-in-out;
    -moz-transition: all .8s ease-in-out;
    -ms-transition: all .8s ease-in-out;
    transition: all .8s ease-in-out;
    transform: scale(1.01);
}
     .jumbotron , #about_developer , footer #footer-widget ,.footer-bottom , header .container { max-width:1100px;margin:auto !important; }
     footer#colophon ,html .footer-bottom{ background-color: #fff !important; }
     .zfoot-footer-logo {
 
    text-align: right;
     }
     .prop-block section:after{ content:unset; }
      .seci_0 , .seci_1    { height : 166px;  overflow: hidden;  }
   
 .seci_2  { height : 345px;  overflow: hidden;  }
 .prop-block {
    margin-bottom: 15px;
}
.prop-block section a {
   
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
@media only screen and (min-width: 1000px) {
    .size-of-project-2 .slick-initialized .slick-slide{ min-width:50%; }
    .size-of-project-2  .slick-list.draggable { padding-right:0px !important; }
     .size-of-project-3 .slick-initialized .slick-slide{ min-width:33.33333333333333%; }
    .size-of-project-3  .slick-list.draggable { padding-right:0px !important; }
     .size-of-project-4 .slick-initialized .slick-slide{ min-width:25%; }
    .size-of-project-4  .slick-list.draggable { padding-right:0px !important; }
     .size-of-project-1 .slick-initialized .slick-slide{ min-width:25%; }
    .size-of-project-1  .slick-list.draggable { padding-right:0px !important; }
}
@media only screen and (min-width: 720px) {
	.n-pading-right { padding-right:0px; }
	.seci_2 img {    height:  100%   !important;   object-fit: cover ; }
.seci_0 img , .seci_1 img {     height: 100%  !important;  object-fit: cover ; }

}
@media only screen and (max-width: 600px) {
  .zfoot-footer-logo{ text-align:right; }
  .sticky-prop-bar .get-touch-btn {
 
    max-width: calc(100% - 70px) !important;
    float: left;
}
.wa__btn_popup {
   
    bottom: 20px !important;
}
.not-mobile { display:none; }
span.managed_by {
    float: left;
    position: absolute;
    left: 0;
    line-height: 1.7;
}
.foot-img {
    display: block;
     
    line-height: 1;
    float: left;
    clear: both;
    width: auto;
}
footer .menu li {
    line-height: 30px;
}
#masthead .container { padding:0px; }
#about_developer .col-12 { padding:0px !important; }
footer h3.widget-title {  line-height: 1.4; }
}

</style>
 <header id="masthead" class="site-header navbar-static-top navbar-light" role="banner">
    <div class="container">
      <nav class="row navbar navbar-expand-xl p-lg-0">
        <div class="col-2 col-sm-1 col-md-1 d-lg-none"> <a href="#mobile_nav" class="hamburger-menu"> <span></span> </a> </div>
		  
        <div class="col-4 col-sm-3 col-lg-2 col-md-2 navbar-brand animatedParent"> 
			<?php
			$developerLogo    =  $model->generateLogoImage();
			if(!empty($developerLogo)){ ?> 
			<a href="<?php echo Yii::app()->createUrl('user_listing/detail_developer',array('slug'=>$model->slug));?>"> <img src="<?php echo $developerLogo;?>" alt="" title="" class="animated growIn" height="50"> </a>
			<?php } ?> 
			 </div>
        <div class="col-6 col-sm-8 col-lg-10 col-md-9 nav-band pl-0">
          <div class="row">
            <div id="main-nav" class="col-lg-5 pl-0 d-none d-lg-block">
              <ul id="menu-top-menu" class="navbar-nav">
                <li class="communities-tab menu-item menu-item-type-custom menu-item-object-custom menu-item-58 nav-item"><a title="" href="#" onclick="moveTo2('about_developer','54')" class="nav-link">About Us</a></li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2136 nav-item"><a title=""   href="#"  onclick="moveTo2('explore','54')" class="nav-link">Our <?php echo $model->user_type=='D' ? 'Projects':'Properties';?></a></li>
              </ul>
            </div>
            <div class="col-lg-7 d-flex nav-band-right justify-content-end">
              <ul>
                <!-- <li class="lang-tab">
                                      </li> -->
                <li class="phone-tab"> <a href="tel:<?php echo $model->full_number;?>"><i class="far fa-phone"></i> <span> Call <span class="phone-number-dir"><?php echo $model->full_number;?></span> </span> </a> </li>
                <?php 
                if(!empty($model->whatsapp)){ 
                $link =  Yii::t('app','https://wa.me/{number}?text=Hi',array('{number}'=>Yii::t('app',$model->whatsapp,array('+'=>'',' '=>''))  ));?>
                <li class="watsapp-tab"> <a href="<?php echo  $link ;?>" target="_blank"> <i class="fab fa-whatsapp"></i> <span>Sales &amp; Support</span> </a> </li>
                <?php }?> 
                <li class="register-tab"> <a href="#" class="btn btn-blue get-touch-btn" onclick="moveTo2('cotact_details','1')"  data-reactid="<?php echo $model->user_id;?>" data-formname="contact">Contact</a> </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
    
    <!-- Modal --> 
    <style>
    .loadinf#mobile_nav {height:0px !important;  }
    </style>
    <script>$(function(){ $('#mobile_nav').removeClass('loadinf'); })</script>
    <!-- Community Menu Mobile -->
    <div class="mobile-nav loadinf" id="mobile_nav"  >
		<a class="spahjkmobiles" href="<?php echo Yii::app()->createUrl('site/index');?>">Back to Feeta website</a>
      <div class="mobile-nav-list">
		  
        <ul class="row mobile-comm-list">
          <li><a href="#" onclick=" moveTo2('about_developer','54')" class="get-touch-btn">About Us</a></li>
          <li><a href="#"    onclick="moveTo2('explore','1')"  class="get-touch-btn">Our <?php echo $model->user_type=='D' ? 'Projects':'Properties';?></a></li>
        </ul>
        <ul class="bottom-block">
          <!-- <li class="lang-tab">
              <div class="topbar-lang-switcher" id="languagephone">
                              </div>
            </li> -->
          <li class="phone-tab"> <a href="tel:800-11223">Call <span><?php echo $model->full_number;?></span></a> </li>
          <li class="register-tab"> <a href="#" class="btn btn-blue get-touch-btn"   onclick="moveTo2('cotact_details','1')" data-reactid="<?php echo $model->user_id;?>"  data-formname="Contact">Contact</a> </li>
        </ul>
      </div>
    </div>
    
    <!-- Overlay on form submit -->
    <div class="booking-overlay overlay-effect">
      <div class="emaarspinner"></div>
    </div>
    <!-- End overlay --> 
  </header>
  <!-- #masthead -->
  
  <div id="content" class="site-content">
    <div class="home-hero-section">
		 <img src="<?php echo $model->BannerImage;?>" alt="" title=""  class="w-100 d-none d-md-block " />
		  <img src="<?php echo $model->BannerImageMobile;?>" alt="" title=""  class="w-100 d-block d-md-none" /> 
</div>
    
    <!-- LATEST LAUNCHES  -->
     <?php 
  $order = '';
 
 $order .= 't.id  desc' ;
 $apps= Yii::app()->apps;
 $formDa = array('sort'=>'custom','custom_order'=>$order,'s_limit'=>'6');
 if($model->user_type=='D'){
     $formDa['sec'] = 'new-development';
 }
 $projects = PlaceAnAd::model()->findAds($formDa,false,false,false,$model->user_id);
 $gallery =  DeveloperGallery::model()->fetchGallery($model->user_id,$limit=3);
 $sizprofgallery= sizeOf( $gallery);
 ?>
 
 
    <div class="jumbotron container latest-launches pb-0">
      <div class="container">
        <div class="row" >
          <div class="col-12 col-md-4  mb-3 mb-md-0">
            <h1><?php  echo Yii::t('app',!empty($model->e_h_t) ? $model->e_h_t :  'Explore {b}Our {p}',array('{b}'=>'<br />','{p}'=> $model->user_type=='D' ? 'Projects' : 'Properties'));?> </h1>
            <p><?php echo $model->explore_title;?> </p>
            <?php
            if($model->user_type=='D'){
             $link_detail =  Yii::app()->createUrl('listing/index',array('sec'=>'new-development')).'?dealer='.$model->slug;
             }
             else{
                 $link_detail =  Yii::app()->createUrl('listing/index').'?dealer='.$model->slug;
             }
             ?>
           
            <div class="d-none d-md-block"> <a href="<?php echo  $link_detail;?>" class="btn btn-blue d-block w-75"><?php  echo Yii::t('app',!empty($model->v_a_ti) ? $model->v_a_ti :  'View All {p}',array('{p}'=> $model->user_type=='D' ? 'Projects' : 'Properties'));?></a> </div>
          </div>
          <div class="col-12 col-md-8">
			  <?php
			  if(!empty( $sizprofgallery)){ ?> 
            <div class="row">
			 
              <div class="col-12 col-md-6 n-pading-right">
				<?php
				$partail = $sizprofgallery/2 ; 
				$partail_mode = $sizprofgallery%2 ; 
				$divider = $partail  ; 
				foreach($gallery as $k=>$v){ 
					if($k>=2  ) continue;
					unset($gallery[$k]);
					
					?> 
			    <div class="prop-block scroll-animate seci_<?php echo $k;?>"> <a href="#"> <img class="d-none d-md-block" src="<?php echo $v->getGenerateBannerLink($v->image);?>" alt="" title=""  class="w-100" /> <img class="d-block d-md-none" src="<?php echo $v->getGenerateBannerLink($v->image);?>" alt="" title=""  class="w-100" /> </a>
                  <section> <a href="<?php echo $v->link_url;?>" class="prop-name"><?php echo $v->title;?></a>   </section>
                </div>
                <?php } ?> 
                
              </div>
              <div class="col-12 col-md-6">
                <?php
				foreach($gallery as $k=>$v){ ?> 
                <div class="prop-block scroll-animate seci_<?php echo $k;?>"> <a href="#"> <img class="d-none d-md-block" src="<?php echo $v->getGenerateBannerLink($v->image);?>" alt="" title=""  class="w-100" /> <img class="d-block d-md-none" src="<?php echo $v->getGenerateBannerLink($v->image);?>" alt="" title=""  class="w-100" /> </a>
                  <section class="hide" style="display: none;"> <a href="<?php echo $v->link_url;?>" class="prop-name"><?php echo $v->title;?></a>   </section>
                </div>
               
              </div>
             <?php } 
            ?>
            
            </div>
			 <?php } ?> 
          </div>
          <div class="col-12 d-block d-md-none mt-3"> <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'new-development'));?>?dealer=<?php echo $model->slug;?>" class="btn btn-blue d-block w-100">View All Projects</a> </div>
        </div>
      </div>
    </div>
 
<?php
if(!empty($projects)){ ?>   
<div class="jumbotron home-featured-communities size-of-project-<?php echo sizeof($projects);?> pb-0" id="explore">
   <div class="communities-menu-featured">
      <div class="container">
         <span class="section-tagline"><?php  echo Yii::t('app',!empty($model->p_he) ? $model->p_he :  '{p}',array('{p}'=> $model->user_type=='D' ? 'Projects' : 'Properties'));?></span>
         <h2><?php  echo Yii::t('app',!empty($model->l_h_t) ? $model->l_h_t :  'Latest');?></h2>
         <div class="  slider-nav  row text-center  ">
         
            <?php 
            foreach($projects as $k=>$v){ ?> 
            <div class="col-12 col-md-3 communities-featured-block" >
               <a href="<?php echo $v->detailUrl;?>" tabindex="0">
               <img src="<?php echo $v->SingleImage;?>" alt="" title="<?php echo $v->ad_title;?>"  >
               </a>
               <h3 class="mt-4 mb-2"><a href="<?php echo $v->detailUrl;?>" tabindex="0"><?php echo $v->ad_title;?></a></h3>
               <span class="bhk-number"> <?php echo $v->city_name;?> , <?php echo $v->state_name;?></span>
            </div>
           
           <?php } ?> 
         </div>
      </div>
       
   </div>
</div>

 <?php } ?> 
  </div>
  <!-- #content -->
  <div class="spansecnew" style="margin-top: 40px;">
    <div class="container">
      <div class="row" id="about_developer">
		  <?php
		    $download_profile =  $model->company_profile; 
		    $youtube =  $model->youtube; 
		    ?> 
        <div class="col-12 col-md-12 col-lg-<?php echo empty($youtube ) ? '12' : '8';?>">
          <h2><?php echo $model->companyName;?></h2>
          <div style="text-align:justify;">
			  <p>
          <?php echo nl2br($model->description);?></p>
          </div>
				<?php

				if(!empty($download_profile )){ 

				$path = Yii::App()->createUrl('site/download_profile',array('file'=>base64_encode($download_profile))); 

				?> 
				<div class="d-none d-md-block" style="margin-top: 15px;"> <a href="<?php echo $path;?>" class="btn btn-grey d-block w-100"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
				Download Company Profile</a> </div>
				<div class="col-12 d-block d-md-none mt-3"> <a href="<?php echo $path;?>" class="btn btn-grey d-block w-100"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
				Download Company Profile</a> </div>

				<?php } ?> 
        </div>
        <?php
        if(!empty($youtube)) { ?> 
		  <div class="col-12 col-md-12 col-lg-4">
		        <h2 class="not-mobile">&nbsp;</h2>
		  	<?php
						  if(!empty($model->youtube)){
						      preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->youtube, $match);
$youtube_id = @$match[1];
 
							  echo '<div class="clearfix"></div> ';
							  ?>
							  <style>
							      .video-container3 {
position: relative;
padding-bottom: 56.25%;margin-top:0px;
padding-top: 30px; height: 0; overflow: hidden;
}
 
.video-container3 iframe,
.video-container3 object,
.video-container3 embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
							      
							  </style>
							  <?php 
							   
			//  echo '<div style="position:relative;margin-top:15px;width:100%"><div class="video-container2" style="width:100%; "><iframe class="video"   src="https://www.youtube.com/embed/'.@$youtube_id.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" style="height:100%;" allowfullscreen></iframe></div> </div>';
					 
					 echo '<div class="video-container3"><iframe width="853" height="480"   src="https://www.youtube.com/embed/'.@$youtube_id.'" frameborder="0" allowfullscreen></iframe></div>';
					 	  echo '<div class="clearfix"></div> ';
						  ?>
						  
						  <?
							}
					 	?>
	
		  </div>
		  <?php } ?> 
		  
      </div>
		<hr class="mt-3 mt-sm-5 spantop30" style="margin-bottom: 0px;">
    </div>
  </div>
  <footer id="colophon" class="site-footer navbar-light text-center text-md-left" role="contentinfo">
    <div id="footer-widget" class="row m-0">
      <div class="container">
        <div class="row">
			
          <div class="col-12 col-md-6 col-lg-6">
			  <?php
			$frame =  $model->iframe_map;
			if(!empty($frame )){ ?> 
            <iframe src="<?php echo $frame;?>" width="100%" height="370" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			<?php } ?>
          
          </div>
          <div class="col-12 col-md-6 col-lg-6" id="cotact_details">
            <section id="nav_menu-2" class="widget widget_nav_menu spnmobile">
             <?php echo $model->cover_letter;?>
            </section>
          </div>
         
        </div>
      </div>
    </div>
	  <div class="footer-bottom">
      <div class="container text-center" >
        <div class="menu-legal-menu-container" style="position:relative;"><span class="managed_by">managed by :   <a href="<?php echo Yii::app()->createUrl('site/index');?>"><img class="foot-img" src="<?php echo Yii::app()->apps->getBaseUrl('assets/developer/images/feetapk2.svg');?>"></a> </span><a href="<?php echo Yii::app()->createUrl('site/index');?>" class="  zfoot-footer-logo"> <img src="<?php echo $developerLogo;?>" style="height:70px;"> </a></div>      </div>
    </div>
    <div class="sticky-prop-bar d-md-none">
      <div class="pr-3 pl-3"> <a href="#" class="btn btn-blue get-touch-btn w-100"  onclick="moveTo2('cotact_details','1')"  data-reactid="<?php echo $model->user_id;?>" data-formname="Contact">Contact</a> </div>
    </div>
  </footer>
 <?php
 if(!empty($model->whatsapp)){ ?> 
 <div class="wa__btn_popup" onclick="openthisfn(this)">
    <div class="wa__btn_popup_txt" style="display:none;">Need Help? <strong>Chat with us  </strong></div>
    <div class="wa__btn_popup_icon"></div>
</div>
<!--  wa__pending wa__active wa__lauch -->
 <div class="wa__popup_chat_box">
    <div class="wa__popup_heading">
        <div class="wa__popup_title" >Start a Conversation </div>
     
    </div>
    <!-- /.wa__popup_heading -->
    <div class="wa__popup_content wa__popup_content_left">
        <div class="wa__popup_notice">The team typically replies in a few minutes.</div>
        
                
        <div class="wa__popup_content_list">
                            <?php
                            if(!empty($model->whatsapp_c_image)){
								$image = Yii::app()->apps->getBaseUrl('uploads/files/'.$model->whatsapp_c_image);
							}
							else{
									$image = Yii::app()->apps->getBaseUrl('uploads/default/f1.png');
							}
							if(!empty($model->whatsapp_c_link)){
							 $lin = $model->whatsapp_c_link ; 
							}
							else{
							  $lin = Yii::t('app','https://wa.me/{number}?text=Hi',array('{number}'=>Yii::t('app',$model->whatsapp,array('+'=>'',' '=>''))  ));
							}
                            ?>
            				<div class="wa__popup_content_item ">
				<a target="_blank" href="<?php echo $lin;  ?>" class="wa__stt wa__stt_online">
				    				        <div class="wa__popup_avatar">
				            <div class="wa__cs_img_wrap" style="background: url('<?php echo $image ;?>') center center no-repeat; background-size: cover;"></div>
				                </div>
					        
                        <div class="wa__popup_txt">
                            <div class="wa__member_name"><?php echo  !empty($model->whatsapp_c_name) ? $model->whatsapp_c_name : $model->companyName ;?></div>
                            <!-- /.wa__member_name -->
                            <div class="wa__member_duty"><?php echo  !empty($model->whatsapp_c_text) ? $model->whatsapp_c_text : 'Project? Let\'s discuss!';?> </div>
                            <!-- /.wa__member_duty -->
                                                    </div>
                        <!-- /.wa__popup_txt -->
                    </a>
                </div>
                             
            
        </div>
        <!-- /.wa__popup_content_list -->
    </div>
    <!-- /.wa__popup_content -->
</div>

<style>
    .wa__btn_popup {
    position: fixed;
    right: 30px;
    bottom: 30px;
    cursor: pointer;
    
    z-index: 999;
}.wa__btn_popup_txt {
    position: absolute;
    width: 163px;
    right: 100%;
    background-color: #f5f7f9;
    font-size: 12px;
    color: #43474e;
    top: 15px;
    padding: 7px 7px 7px 12px;
    margin-right: 7px;
    letter-spacing: -.03em;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    transition: .4s ease all;
    -webkit-transition: .4s ease all;
    -moz-transition: .4s ease all;
}
.wa__btn_popup_icon {
    background: #2db742;
        width: 56px;
    height: 56px;
    background: #2db742;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    box-shadow: 0 6px 8px 2px rgba(0,0,0,.14);
    -webkit-box-shadow: 0 6px 8px 2px rgba(0,0,0,.14);
    -moz-box-shadow: 0 6px 8px 2px rgba(0,0,0,.14);
}
    .wa__btn_popup_icon::before {
    content: '';
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: transparent url('<?php echo Yii::App()->apps->getBaseUrl('assets/img/whatsapp_logo.svg');?>') center center no-repeat;
        background-size: auto;
    background-size: 30px auto;
    -webkit-background-size: 30px auto;
    -moz-background-size: 30px auto;
    transition: .4s ease all;
    -webkit-transition: .4s ease all;
    -moz-transition: .4s ease all;
}
.wa__btn_popup_icon::after {
    content: '';
    opacity: 0;
    position: absolute;
    z-index: 2;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: transparent url('<?php echo Yii::App()->apps->getBaseUrl('assets/img/x_icon.svg');?>') center center no-repeat;
        background-size: auto;
    background-size: 14px auto;
    -webkit-background-size: 14px auto;
    -moz-background-size: 14px auto;
    transition: .4s ease all;
    -webkit-transition: .4s ease all;
    -moz-transition: .4s ease all;
    -ms-transform: scale(0) rotate(-360deg);
    transform: scale(0) rotate(-360deg);
    -webkit-transform: scale(0) rotate(-360deg);
    -moz-transform: scale(0) rotate(-360deg);
}
.wa__popup_chat_box {
    font-family: Arial,Helvetica,sans-serif;
    width: 351px;
    border-radius: 5px 5px 8px 8px;
    -webkit-border-radius: 5px 5px 8px 8px;
    -moz-border-radius: 5px 5px 8px 8px;
    position: fixed;
    overflow: hidden;
    box-shadow: 0 10px 10px 4px rgba(0,0,0,.04);
    -webkit-box-shadow: 0 10px 10px 4px rgba(0,0,0,.04);
    -moz-box-shadow: 0 10px 10px 4px rgba(0,0,0,.04);
    bottom: 102px;
    right: 25px;
    z-index: 998;
    opacity: 0;
    visibility: hidden;
    -ms-transform: translate(0,50px);
    transform: translate(0,50px);
    -webkit-transform: translate(0,50px);
    -moz-transform: translate(0,50px);
    transition: .4s ease all;
    -webkit-transition: .4s ease all;
    -moz-transition: .4s ease all;
    will-change: transform,visibility,opacity;
    max-width: calc(100% - 50px);
}
.wa__popup_chat_box.wa__active {
    -ms-transform: translate(0,0);
    transform: translate(0,0);
    -webkit-transform: translate(0,0);
    -moz-transform: translate(0,0);
    visibility: visible;
    opacity: 1;
}
.wa__popup_chat_box .wa__popup_heading {
    background: #2db742;
}
.wa__popup_chat_box .wa__popup_heading {
    position: relative;
    padding: 15px 43px 17px 74px;
    color: #d9ebc6;
    background: #2db742;
}
.wa__popup_chat_box .wa__popup_heading::before {
    content: '';
    background: url(<?php echo Yii::App()->apps->getBaseUrl('assets/img/whatsapp_logo.svg');?>) center top no-repeat;
        background-size: auto;
    background-size: 33px;
    display: block;
    width: 55px;
    height: 33px;
    position: absolute;
    top: 12px;
    left: 12px;
}.wa__popup_chat_box .wa__popup_heading .wa__popup_title {
    padding-top: 2px;
    padding-bottom: 3;
    color: #fff;
    font-size: 18px;color: #fff;
    line-height: 24px;
}.wa__popup_chat_box .wa__stt {
    border-left: 2px solid #2db742;
        border-left-color: rgb(45, 183, 66);
}
.wa__popup_chat_box .wa__stt {
    padding: 13px 40px 12px 74px;
    position: relative;
    text-decoration: none;
    display: table;
    width: 100%;
    border-left: 2px solid #2db742;
    background: #f5f7f9;
    border-radius: 2px 4px 2px 4px;
    -webkit-border-radius: 2px 4px 2px 4px;
    -moz-border-radius: 2px 4px 2px 4px;
}
.wa__popup_content {
    background: #fff;
    padding: 13px 20px 21px 19px;
    text-align: center;
}
.wa__popup_content_left {
    text-align: left;
}.wa__popup_notice {
    font-size: 11px;
    color: #a5abb7;
    font-weight: 500;
    padding: 0 3px;
}.wa__popup_content_left {
    text-align: left;
}.wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(1) {
    transition-delay: .3s;
    -webkit-transition-delay: .3s;
    -moz-transition-delay: .3s;
}.wa__popup_chat_box.wa__lauch .wa__popup_content_list .wa__popup_content_item {
    opacity: 1;
    transform: translate(0,0);
    -webkit-transform: translate(0,0);
    -moz-transform: translate(0,0);
}.wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item {
    transition: .4s ease all;
    -webkit-transition: .4s ease all;
    -moz-transition: .4s ease all;
        transition-delay: 0s;
    transition-delay: 2.1s;
    -webkit-transition-delay: 2.1s;
    -moz-transition-delay: 2.1s;
}.wa__popup_content_list .wa__popup_content_item {
    margin: 14px 0 0;
    transform: translate(0,20px);
    -webkit-transform: translate(0,20px);
    -moz-transform: translate(0,20px);
    will-change: opacity,transform;
    opacity: 0;
}.wa__stt_offline {
    pointer-events: none;
}
.wa__stt_offline {
    background: #ebedf0;
    color: #595b60;
    box-shadow: none;
    cursor: initial;
}.wa__popup_chat_box .wa__popup_avatar {
    position: absolute;
    overflow: hidden;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    left: 12px;
    top: 12px;
}.wa__popup_content_item .wa__cs_img_wrap {
    width: 48px;
    height: 48px;
}.wa__popup_content_list .wa__popup_content_item .wa__popup_txt {
    display: table-cell;
    vertical-align: middle;
    min-height: 48px;
    height: 48px;
}.wa__popup_content_list .wa__popup_content_item .wa__member_name {
    font-size: 14px;
    color: #363c47;
    line-height: 1.188em !important;
}.wa__popup_content_list .wa__popup_content_item .wa__member_duty {
    font-size: 11px;
    color: #989b9f;
    padding: 2px 0 0;
    line-height: 1.125em !important;
}.wa__popup_content_list .wa__popup_content_item .wa__member_status {
    color: #f5a623;
    font-size: 10px;
    padding: 5px 0 0;
    line-height: 1.125em !important;
}.wa__btn_popup.wa__active .wa__btn_popup_icon::before {
    opacity: 0;
    -ms-transform: scale(0) rotate(360deg);
    transform: scale(0) rotate(360deg);
    -webkit-transform: scale(0) rotate(360deg);
    -moz-transform: scale(0) rotate(360deg);
}
.wa__btn_popup.wa__active .wa__btn_popup_icon::before {
    opacity: 0;
    -ms-transform: scale(0) rotate(360deg);
    transform: scale(0) rotate(360deg);
    -webkit-transform: scale(0) rotate(360deg);
    -moz-transform: scale(0) rotate(360deg);
}.wa__btn_popup.wa__active .wa__btn_popup_icon::after {
    opacity: 1;
    -ms-transform: scale(1) rotate(0deg);
    transform: scale(1) rotate(0deg);
    -webkit-transform: scale(1) rotate(0deg);
    -moz-transform: scale(1) rotate(0deg);
}
.wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(2) {
    transition-delay: .5s;
    -webkit-transition-delay: .5s;
    -moz-transition-delay: .5s;
}
.wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(1) {
    transition-delay: .3s;
    -webkit-transition-delay: .3s;
    -moz-transition-delay: .3s;
}
@media only screen and (max-width: 600px) {
  .wa__btn_popup {
 
    right: 10px;
    bottom: 50px;
     
}
}
</style>
<script>
    function openthisfn(k){
      if($(k).hasClass('wa__active')){ $(k).removeClass('wa__active') ;$('.wa__popup_chat_box').removeClass('wa__pending wa__active wa__lauch') ; }else{  $(k).addClass('wa__active') ;$('.wa__popup_chat_box').addClass('wa__pending wa__active wa__lauch') ; }
    }
    
</script>
<?php } ?> 