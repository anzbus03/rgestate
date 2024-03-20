<!DOCTYPE html>
<html  lang="<?php echo $this->language;?>" dir="<?php echo $this->direction;?>" class="absolutehtml <?php echo $this->secure_header == '1' ? 'secure' : '';?> <?php echo defined('HIDEATIPHONE') ? 'hidemenuiphone' : '';?>  <?php echo defined('APLEDEVICE') ? 'appled' : '';?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
$meta_description =     !empty($pageMetaDescription) ? Yii::t('app',$pageMetaDescription,array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name)) :  Yii::t('app',$this->generateCommon('home_meta_description'),array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name));
$meta_keyword =     !empty($meta_keyword) ? Yii::t('app',$meta_keyword) : Yii::t('app',$this->generateCommon('home_meta_keywords'),array('{country}'=>COUNTRY_NAME,'{project_name}'=>$this->project_name)); 
$en = Yii::t('app',CURRENT_URL,array('rgestate.com/ar/'=>'rgestate.com/')); 
?>
<link rel="alternate" hreflang="en-AE" href="<?php echo $en;?>" />
<link rel="alternate" hreflang="en-gb" href="<?php echo $en;?>" />
<link rel="alternate" hreflang="en-us" href="<?php echo $en;?>" />
<link rel="alternate" hreflang="ar" href="<?php echo Yii::t('app',CURRENT_URL,array('rgestate.com/ar/'=>'rgestate.com/ar/','rgestate.com/'=>'rgestate.com/ar/'));?>" />
<link rel="canonical" href="<?php echo CURRENT_URL;?>" />
<link rel="icon" href="<?php echo  $this->app->apps->getBaseUrl('new_assets/images/favicon.png');?>" type="image/png" sizes="32x32">
<title><?php  echo  $pageTitle ;  ?></title>
<meta name = "viewport" content = "user-scalable=no, width=device-width">
<meta name="title" content="<?php  echo  $pageTitle ;  ?>"/>
<meta name="description" content="<?php echo $meta_description;?>" />
<meta name="keywords" content="<?php echo $meta_keyword;?>" /> 
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php  echo  $pageTitle ;  ?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="og:url" content="<?php echo CURRENT_URL;?>" />
<meta property="og:site_name" content="<?php echo $this->project_name;?>"/>
<meta property="og:email" content="sales@rgestate.com"/>
<meta property="og:phone_number" content="+971552792403"/>
<meta property="og:site_name" content="RGEstate.Com By Riveria Global Group" />
<meta property="article:publisher" content="https://www.facebook.com/RGEstateUAE"/>
<meta property="article:modified_time" content="2022-03-28T19:39:09+00:00" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@RGEstateUAE" />
<meta name="twitter:label1" content="Est. reading time" />
<meta name="twitter:data1" content="4 minutes" />
<meta name="Revisit-After" content="1 Days" />
<meta name="Language" content="<?php echo $this->language=='ar' ? 'Arabic':'English';?>" />
<meta name="distribution" content="Global" />
<meta name="geo.region" content="AE-DU" />
<meta name="geo.placename" content="Dubai" />
<meta name="geo.position" content="25.192529490878545, 55.26743257129561" />
<meta name="allow-search" content="yes" />
<meta name="expires" content="never" />
<meta name="YahooSeeker" content="INDEX, FOLLOW" />
<meta name="msnbot" content="INDEX, FOLLOW" />
<meta name="googlebot" content="index,follow" />
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<meta http-equiv="Content-Language" content="<?php echo $this->language;?>" />
<?php 
if($this->id=='detail' and in_array($this->action->id,array('index','project'))){
?>
<meta property="fb:app_id" content="<?php echo $this->options->get('system.common.facebook_app_id');?>">
<meta property="og:site_name" content="<?php echo $this->options->get('system.common.site_name');?>">
<meta property="og:title" content="<?php echo $title;?>">
<meta property="og:description" content="<?php echo $description;?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo  $shareUrl;?>">
<meta property="og:image" content="<?php echo $image;?>">
<meta property="og:image:width" content="">
<meta property="og:image:height" content="">
<meta property="og:locale" content="en_US">
<meta name="twitter:widgets:csp" content="on">
<meta name="twitter:card" content="photo">
<meta name="twitter:url" content="<?php echo  $shareUrl;?>">
<meta name="twitter:image" content="<?php echo $image;?>">
<meta name="twitter:title" content="<?php echo $title;?>">
<meta name="twitter:description" content="<?php echo $description;?>">
<meta name="twitter:site" content="<?php echo $this->options->get('system.common.site_name');?>">
<?php
}
$prefx = $this->language=='ar'?'ar/':''; 
?>  
<script>var baseid = '<?php echo ASKAAN_PATH_BASE;?>';var baseid2 = '<?php echo ASKAAN_PATH_BASE.$prefx;?>';$(function(){iniFrame()}); 
var CALLING_title =  '<?php echo Yii::t('app',$this->tag->getTag('please_quote_property_referenc','Please quote property reference{}when calling us'),array('{}'=>'<div dir="ltr" class="phone-div-tedifgar">[REFERENCENUMBER]</div>'));?>';
var Phone_title 	= '<?php echo $this->tag->getTag('phone','Phone');?>';
var Agent_title 	= '<?php echo $this->tag->getTag('agent2','Agent');?>';
var Close_title 	= '<?php echo $this->tag->getTag('close','Close');?>';
var call_statistics = '<?php echo $this->app->createUrl('articles/statistics/case/C');?>/';
var Contact_title 	= '<?php echo $this->tag->getTag('contact_us','Contact Us');?>';
</script>
<?php
if(!empty($schema)){ echo $schema; } ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DMQGQPSMZC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DMQGQPSMZC');
</script>
<?php echo LANGUAGE == 'ar' ? '<script>var isRtl = true;</script>' : '<script>var isRtl = false;</script>' ; ?>
<style>.closepopu {display:none; } .isOnFram  .closepopu {display:block; }.for-mobile { display: none;}</style>

<link media="all" href="<?php echo $this->app->apps->getBaseUrl('new_assets/css/style.css?q=2122');?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $this->app->apps->getBaseUrl('new_assets/css/stylee.css?q=600');?>">
<link rel="stylesheet" href="<?php echo $this->app->apps->getBaseUrl('new_assets/css/responsive.css');?>">
<link rel="stylesheet" href="<?php echo $this->app->apps->getBaseUrl('assets/css/new_responsive.css?q=234');?>">
<script>
    $(function(){$(".btn-menu").click(function(){$(this).toggleClass('open');$('.mobile-nav').toggleClass('open');$('body').toggleClass('fix');return false;})})
</script>
<?php   $this->renderPartial('//layouts/_seo_scripts');

if($this->id=='detail'){
    $this->renderPartial('//layouts/_breadcrumbscript');
}

?>
</head>
<style>
.list_details a,#footer-selector a { color:var(--black-color);}.list_details a:hover{ color:var(--secondary-color);}
.dropdown-chose {
    display: none;
}  
.selcted-val .dropdown-search input::placeholder {  color: #fff;   opacity: 1; }

.selcted-val .dropdown-search input:-ms-input-placeholder {  color:  #fff; }

.selcted-val .dropdown-search input::-ms-input-placeholder {  color:  #fff; }
.selcted-val .dropdown-search input{    position: relative;    top: -5px;}
.new-multiple {  border: 0px !important; }
.new-multiple  .dropdown-display-label {   padding-top: 4px !important; }
#listing input[type="radio"]:checked + label span {
	font-weight: bold;
	color: var(--secondary-color) !important;
}
    .btnnc {
   
    position: relative;
    z-index: 2;
}
@media only screen and (max-width: 600px) {
  .video-container .slick-slide {
    margin: 0px 0px;
} .video-container .slick-dots{ display:none !important; }
.main-search-inner .nav-tabs--search { flex-wrap: wrap; }
.main-search-inner .nav-tabs--search li { min-width: 50% !important;   margin: 5px 0px; }
.main-search-inner  .slider-form .nav-link { line-height: 2 !important; }
.main-search-inner .nav-tabs--search li.active a::before { content: unset;}
#site .home_container.d-hm { display: block !important;height:150px!important; }
.homechange { flex-wrap: wrap;justify-content: center;align-items:center;border-bottom: 1px solid #eee; }.homechange a {    min-width: 23%;flex: unset;}
#site .list-prop {  box-shadow: unset !important;     }
#footer {  display: none; } 
#place_an_ad_no_login .banner ,#submited_preq  .banner,#submited_jvproposal  .banner,#new_projects  .banner{  height: 200px; }
#place_an_ad_no_login .bloghead ,#submited_preq  .bloghead ,#submited_jvproposal  .bloghead,#new_projects .bloghead {  max-width: 90%; }
#place_an_ad_no_login .bloghead .fancy-title , #submited_preq .bloghead .fancy-title, #submited_jvproposal .bloghead .fancy-title , #new_projects .bloghead .fancy-title {  font-size: 25px; }
#place_an_ad_no_login .site-blocks-wrapper ,#new_projects .site-blocks-wrapper {  padding: 0px 0px;  top: unset; box-shadow:unset !important; }
#place_an_ad_no_login .site-block,#new_projects .site-block {  text-align: center;}
html body #place_an_ad .box.place-property ,html   #new_projects .box { box-shadow:unset !important;border-radius:0px !important;    border: 0px !important; }
#post-property {   margin-top: 0px!important; }
html   #new_projects .box.box-primary {    margin-top: 0px; } 
#submited_preq .main-div ,#submited_jvproposal .main-div  {   border: 0px;  border-radius:0px;  box-shadow: unset !important; background: #fff;   z-index: 1; margin-top: 0px !important;}
#submited_preq .main-div  .text-right,#submited_jvproposal .main-div  .text-right {    text-align: left;}
.mob-category-selector { display:block !important ; }
.hide-f-m {   display: none !important;  }
.new-select2 {  padding-left: 9px; }html .mobile-nav {  line-height: initial; }
.mobile-nav li {    font-size: 15px;    font-weight: 500;      }
.foot-items .social-icon { background: #eee !important;  margin-bottom: 12px; }
.foot-items .spfoot a {    color: #fff;}
.foot-items .social-icons a {  line-height: 29px; } 
#detail #frm_ctnt .col-sm-7 {    width: 100% !important;    text-align: right;}
.modal#myModal2 {  z-index: 1111111111; } 
#listing .breadcrumb_content.style2 b{ display:flex !important;}
}
@media only screen and (min-width: 992px){
    .arab-drop-down button > span { width:100%; }
.shringage-div {
 
    max-width: 98%; 
    width: max-content;
    white-space: nowrap; 
    text-overflow: ellipsis; 
    width: 100%;
}
.dropdown-main {
    top: calc(100% + 5px);
    -webkit-box-shadow: 0 3px 6px 0 rgb(0 0 0 / 25%);
    box-shadow: 0 3px 6px 0 rgb(0 0 0 / 25%);
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border-radius: 5px;
    background-color: #fff;
}.zsg-popover-arrow { 
    display: none;
} 
}
.srp__sc-1scjcmt-0 {    display: none !important;}
.min-width-300 { min-width:300px !important;}.min-width-200 { min-width:200px !important;} .min-width-250 { min-width:250px !important;}.right-handle .search-popup-cntainer { right:0px; left:unset !important; }
</style>
<body id="<?php echo $this->id;?>" class="<?php echo !empty($openFilter) ? 'openfilter' : '';?>"    >
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q8V4GM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

     <a href="javascript:void(0)" class="closepopu"  onclick="parent.closePopup();" style="background:#fff !important"><img style="width: 64%;vertical-align: bottom;margin-top: 11px;" src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/cancel.png');?>"/></a>

	<div id="base-container">
	      <div class="" hidden>
       
<svg id="new_bed" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M9.196 14.603h15.523v.027h1.995v10.64h-3.99v-4.017H9.196v4.017h-3.99V6.65h3.99v7.953zm2.109-1.968v-2.66h4.655v2.66h-4.655z" fill="currentColor"/></svg>

<svg id="new_bath" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M23.981 15.947H26.6v1.33a9.31 9.31 0 0 1-9.31 9.31h-2.66a9.31 9.31 0 0 1-9.31-9.31v-1.33h16.001V9.995a2.015 2.015 0 0 0-2.016-2.015h-.67c-.61 0-1.126.407-1.29.965a2.698 2.698 0 0 1 1.356 2.342H13.3a2.7 2.7 0 0 1 1.347-2.337 4.006 4.006 0 0 1 3.989-3.63h.67a4.675 4.675 0 0 1 4.675 4.675v5.952z" fill="currentColor"/></svg>

<svg  id="new_area" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M13.748 21.276l-3.093-3.097v3.097h3.093zm12.852 5.32H10.655v.004h-5.32v-.004H5.32v-5.32h.015V5.32L26.6 26.596z" fill="currentColor"/></svg>
       
       </div>
	<!-- Wrapper -->
	<div id="wrapper">
	    <?php
		if($this->can_open_cookie){
		if($this->secure_header  != '1' and $this->no_header !='1'){ ?>
		<div class="b-cookies-notification js-cookies-notification active" id="s-cookies-notification">
        <div class="b-cookies-notification__container ">
            <div class="b-cookies-notification__description">
                    <div>
                       
                       <?php
                       $cookie_test = $this->options->get('system.common.cookie_text'); 
                       $cookie_url = $this->options->get('system.common.cookie_url_more'); 
                       echo $cookie_test;
                       if(!empty($cookie_url)){ ?> 
                        Learn more by clicking on "More information".
                        <a class="b-cookies-notification__terms" href="<?php echo $cookie_url;?>" target="_blank">
                            More Information
                        </a>
                        <?php } ?> 
                    </div>
            </div>
            <div class="b-cookies-notification__wrapper-buttons ">        
                <div class="b-cookies-notification__container-button">
                    <button type="button" class="b-button  b-cookies-notification__accept js-cookies-notification__accept " data-url="<?php echo Yii::app()->createUrl('site/accept_cookie');?>" onclick="setAcceptCookiex(this)" >
                        Accept
                    </button>
                </div>
                    <div class="b-cookies-notification__close js-cookies-notification__accept">
                        
 <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/rrclose.png');?>" onclick="removethisCookie()" class="b-img">
                    </div>
            </div>
     
			<div class="clearfix"></div>
        </div>
        
    </div>
		<?php } 
		
		} ?> 
	<!-- Header Container
	================================================== -->
	<?php 
	if($this->no_header=='1'){
	    ?>
	    <?	 
	}else{
        if($this->secure_header  == '1'){ 
            $this->widget('frontend.components.web.widgets.header_new2.SecureWidget');
        }
        else{
            $this->widget('frontend.components.web.widgets.header_new2.HeaderWidget');
        }
	}
	
	 ?>
	<div class="clearfix"></div>
	<!-- Header Container / End --> 
	  <div class="container_class no_header<?php echo $this->no_header;?>" id="mainContainerClass">
				<div id="notify-container"><?php echo Yii::app()->notify->show();?></div>
				<?php 
				if($this->no_header=='1'){
				$this->renderPartial('//layouts/_no_header_layout' );

				?>
				<?php } else { 
				echo $content; } ?>
				<div class="clearfix"></div>
        </div>
	</div>
   
   <?php 
   if($this->secure_header !=  '1' and $this->no_header!='1'){ 
            $this->widget('frontend.components.web.widgets.footer.FooterWidget');    
   } 
   ?> 
   <div id="backtotop"><a href="#"></a></div>
   </div>
<link rel="stylesheet" type="text/css" href="<?php echo $this->app->apps->getBaseUrl('assets/js/build/css/intlTelInput.min.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->app->apps->getBaseUrl('assets/js/rangeslider/rangeslider.css?q=1516');?>" />
 <script>
function OpenPopupthis(k,e) {
 
	var open_u = $(k).attr('href');e.preventDefault();
	$("#myModal3").modal("show"), $("#raw_ht_ml").html('<iframe id="ifrm"   class="mframe" ></iframe>'), document.getElementById("ifrm").src = open_u;
}
var mpaurl= "<?php echo  'https://maps.googleapis.com/maps/api/js?libraries=places&key='.$this->options->get('system.common.google_map_api_key','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ');?>&language=<?php echo LANGUAGE;?>";
var cn_code  = '<?php echo COUNTRY_CODE;?>';
</script>
<?php
if($this->id != 'contact'){ ?> 
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=<?php echo $this->app->options->get('system.common.re_captcha_key','6Ldsl2IaAAAAAGSkGrL7xUeucC9yKthmDsYWdTmy');?>"></script>
<?php } ?> 
<!-- Modal -->
<style>
    .modal-open .modal.modal-new {
    overflow-x: hidden;
    overflow-y: auto;
}
.modal.modal-new.fade.show {
    opacity: 1;
}
 
.modal.modal.modal-new {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: hidden;
    outline: 0;    margin: auto;
}
.modal.modal.modal-new .modal-content {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: .3rem;
    outline: 0;
}.modal-backdrop.in {
    opacity: 0.5;
    display: block;
}
.modal.modal.modal-new:before {
  
    content: unset; 
} 
.close.close-ne {
    color: red;
    opacity: 1;
    font-size: 35px;
    line-height: 1;
    padding: 0;
    margin: 0;
    position: absolute;
    right: 30px;
    top: 22px;
}
.sb-btn {
    margin: 0px 0px 20px;
    background: #fff;
    color: var(--secondary-color);;
    width: 100%;
    font-weight: 600;
    line-height: 2.5;
    font-size: 16p;
    box-shadow: 0 1px 6px 0 rgb(32 33 36 / 28%) !important;
    border-radius: 25px;
    height: auto !important;text-transform:initial;
}.btn.sb-btn:hover.btn.sb-btn:active,.btn.sb-btn:focus{ color:#fff !important;background: #000 !important;}
</style>
<div class="modal modal-new fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
          
        <button type="button" class="close close-ne" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
         <script type="text/javascript" src="https://app.getresponse.com/view_webform_v2.js?u=t9lxl&webforms_id=zzsSd" data-webform-id="zzsSd"></script>
             
      </div>
    
    </div>
  </div>
</div>
    
<div id="dynamicScripts"></div>
</body>
</html>
