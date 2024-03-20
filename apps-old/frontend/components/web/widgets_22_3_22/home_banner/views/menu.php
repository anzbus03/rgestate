<?php
$tag = $conntroller->tag; 
//$city = CHtml::listData(States::model()->AllListingStatesOfCountry(COUNTRY_ID),'slug' , 'state_name'); 
$city = array();
$price_array = PlaceAnAd::model()->getPriceArray();
$for_sale = $conntroller->options->get('system.common.total_for_sale_'.COUNTRY_ID,'0');
$for_rent = $conntroller->options->get('system.common.total_for_rent_'.COUNTRY_ID,'0');
$for_sale_totle = $for_sale + $for_rent;$for_sale_totle = empty($for_sale_totle) ? '1000+' : $for_sale_totle;
$ban_titl = Yii::t('app',$conntroller->generateCommon('home_page_banner_title',''),array('{COUNTRY}'=>'<span class=ctry-bn>'.COUNTRY_NAME.'</span>','{n}'=>$for_sale_totle));                       
$ban_titl_r = Yii::t('app',$conntroller->generateCommon('home_page_banner_title_r',''),array('{COUNTRY}'=>'<span class=ctry-bn>'.COUNTRY_NAME.'</span>','{n}'=>$for_sale_totle));                       
?>
<script>
	var auto1 = false;
	var auto2 = false;
	var cn_code = '<?php echo COUNTRY_CODE;?>';
</script>

<div class="home-banner-outer">
         <div class="main-search-container dark-overlay home" >
            
					
            <div class="main-search-inner">
            <div class="slider-form advamced">
            <div class="container">
               <h2 class="text-center mb-5" id="nban_tit"><?php echo $ban_titl;?></h2>
            
                  <ul class="nav-tabs--search" role="tablist">
                <li class="nav-item active">
                        <a class="nav-link active show" id="home-tab" data-toggle="tab" data-href="home" data-ban-title="<?php echo $ban_titl;?>" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true" data-title="Buy" data-url="<?php echo Yii::App()->createUrl('listing/index/sec/property-for-sale');?>"  onclick="activateTab(this)"><?php echo $tag->getTag('for_sale','For Sale');?></a>
                     </li>
                     <li class="nav-item rentaldww">
                        <a class="nav-link " id="profile-tab" data-toggle="tab" data-href="profile" data-ban-title="<?php echo $ban_titl_r;?>"   href="javascript:void(0)" role="tab" aria-controls="profile" aria-selected="false"  data-title="Rent" data-url="<?php echo Yii::App()->createUrl('listing/index/sec/property-for-rent');?>" onclick="activateTab(this)"><?php echo $tag->getTag('for_rent','For Rent');?>
                       
					
                        </a>
                      
                     </li>
                     	 <li class="nav-item"> <a class="nav-link r "  href="<?php echo $conntroller->app->createUrl('listing/index',array('sec'=>'new-development'));?>"><?php echo $tag->getTag('off_plan_projects','Off Plan Projects');?> </a> </li>
              <li class="nav-item nav-tabs--searchh"> <a class="nav-link  "   href="<?php echo $conntroller->app->createUrl('all/business/for-sale');?>"><?php echo $tag->getTag('business_for_sale','Business for Sale');?> </a> </li>
                   
                 </ul>
                   <div class="tab-content hom-content" id="tab-home-srch" data-select2-id="14">
                     <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
                         <div class="atmobile-click" onclick="openListing(this,event)"></div>
						<?php $this->render('_for_sale_search',compact('areaData','city','city_array','city_array','price_array','conntroller'));?>
                     </div>
                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
                         <div class="atmobile-click" onclick="openListing(this,event)"></div>
						<?php $this->render('_for_rent_search',compact('areaData','city','city_array','city_array','price_array','conntroller'));?>
                     </div>
                 
                  </div>
            </div>
         </div>
         
            
             </div>
            <!-- Video -->
            <div class="video-container">
              <?php 
              
              $banners =   $conntroller->banners;
              $bannerModel = new HomeBanner();
               if( $banners){
				 ?>
				<div class="row fullwidth">
				<div class="columns small-12 slider">
				 
					<?php 
					foreach($banners as $k=>$v){
						$mag= $v['image'];
						$mob= !empty($v['mobile']) ? $v['mobile'] :  $v['image'];
					?>
                            <picture class=" skrollable skrollable-between" style="    height: 100%;    width: 100%;    display: flex;    display: block;    height: 100%;    width: 100%;    display: -webkit-box;    display: -webkit-flex;    display: -ms-flexbox;    display: flex;">
                            <source srcset="<?php echo Yii::app()->apps->getBaseUrl('uploads/files/'.$mag);?>" media="(min-width:640px)" />
                            <img class="lozad" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/files/'.$mob);?>"  style="background:url('data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/AABEIAAUACgMBEQACEQEDEQH/xAGiAAABBQEBAQEBAQAAAAAAAAAAAQIDBAUGBwgJCgsQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+gEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoLEQACAQIEBAMEBwUEBAABAncAAQIDEQQFITEGEkFRB2FxEyIygQgUQpGhscEJIzNS8BVictEKFiQ04SXxFxgZGiYnKCkqNTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqCg4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2dri4+Tl5ufo6ery8/T19vf4+fr/2gAMAwEAAhEDEQA/APH9Nt/jf4ts/gB8cvBv7Qvjf4b2HxKitvh1r3w40WO5j8Py6bqVinhXxNJLqHhzXPB9/cx69p8UMjB1TVbe6iWebW76QKyfNUXVzHDwxcqrw0swjUyyp9VhTozjhptKrT54xtUp1YrlqUqkGppLmcldPLEYyarxoOKq0qVSjiYwrP2kPbKK5aiSUGpxbbUua6bbW59Ny/Ejx/4elk0CG90GeHQ5H0eKeSHx6Xmj0xjZJK5uPiTdTl5FgDsZrm4lJJMk8r7pG8Ofh/lLnN/2jnkbyl7tPGYanTjq/dp04YFQpwW0YRSjCNoxSSR1/wCtuNh7jo024e7dVKqvy6XtKU5a2+1OT7yk9X//2Q==');background-size:cover" />
                             </picture>
				 	 
					<?php } ?>
				  
		 
				</div>
				</div>
					   <?
				   
				}; ?>

 
            </div>
		
         </div>
            <script>
			var load_city_url = '<?php echo Yii::App()->createUrl('site/load_city');?>';
			$(function(){ homefn();	ResizeWin(); })
			if(window.innerWidth < 768) {  $(function(){ hm_tab()}) }
		
			</script>
         
         <div class="clearfix"></div>
</div>
 <style>
     @media only screen and (max-width: 600px){
      .a-view-more-home { 
    background-color: var(--secondary-color)!important;     font-size: 18px!important;    line-height: 1.3;   margin: 15px auto;  padding: 5px 25px;  color: #fff !important; border-radius: 5px;}
     html #site .row.no-gutters     .new-h-cls { max-width:60%; }
     html[dir="rtl"] #site .row.no-gutters .new-h-cls {    max-width: 54%;}
     html #site .row.no-gutters     .new-h-cls input { max-width:calc(100% - 13px); }
html #site .row.no-gutters .col-md-3.home-home-type {
    display: block !important;
   
}html #site .main-search-inner .row.no-gutters{ display:flex;    background: #fff}
 #site .slider-form .tab-content .not-at-mobile.special-at-mob { 
     padding: 0px !important;flex: 1;
}
html #site .home-home-type:hover #categoryTypeToggleDiv {
    display: block!important;
   
}
html #site .home-home-type:hover #categoryTypeToggleDiv {
    border-radius: 0px !important;
    /* border-top-left-radius: 0px !important; */
    /* border-bottom-left-radius: 0px !important; */
    background: #fff !important;
    z-index: 111111111111;
    top: 51px !important;
}
html #site .slider-form #homeTypeToggle{ line-height:51px !important;border: 0px !important;}
html #site .typeahead__query {
    width: 100%!important;
}
html .gaQgjK{ min-width:205px; }
html[dir="ltr"] #site .row.no-gutters .col-md-3.home-home-type {
    display: block !important;
    padding-right: 53px !important;
}
html[dir="rtl"] #site .row.no-gutters .col-md-3.home-home-type {
    display: block !important;
    padding-left: 53px !important;
}
html #site .slider-form #categoryTypeToggleDiv {
    border:0px!important;
    top: 54px !important;right:0px !important;
    min-width: 195px;
}
html #site .home-home-type:hover #homeTypeToggle {
 
    border: 0px solid var(--logo-color)!important;
}#site .row.no-gutters .col-md-3.home-home-type{
      flex: 1;
    max-width: calc(100% - 205px);display: block; 
}
html[dir="ltr"] #site .slider-form #homeTypeToggle{    padding-left: 0px !important;}
 #site .slider-form #homeTypeToggle {
    
    display: flex;
    align-items: center;
}
#homeTypeToggle span{ flex:1; }#homeTypeToggle i{ max-width:15px; }
html[dir="rtl"]  #site .slider-form #categoryTypeToggleDiv {
  
    right: unset !important;
    left: -8px;
    z-index: 1111111;
}
html[dir="rtl"] #site .slider-form #homeTypeToggle {
   
    min-width: 94px;
    margin-right: -7px;
}
html[dir="rtl"] #site .main-search-inner .row.no-gutters {
    
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}
html .main-search-container.home {
 
    z-index: 111!important;
}
html #site .home-home-type:hover #categoryTypeToggleDiv {
 
    border-radius: 0px !important;
}
html #site .slider-form.advamced .row.no-gutters {
    padding: 8px 7px 8px 7px !important
}
html #site .slider-form.advamced .jNhpJt , html[dir=ltr] #site .slider-form.advamced .jNhpJt {
    border: 1px solid #d4d4d4 !important;
   
}
html #site .slider-form.advamced .jNhpJt {
    height: 38px;
}
html #site .slider-form #homeTypeToggle
{
        border: 1px solid #D4D4D4;
    padding: 0px 5px 0px 15px;
    line-height: 34px;
}
html[dir="ltr"] #site .row.no-gutters .col-md-3.home-home-type {
    display: block !important;
    padding-right: 36px !important;
}
html[dir="rtl"] #site .row.no-gutters .col-md-3.home-home-type {
    display: block !important;
    padding-left: 36px !important;
}
html .slider-form .special-submit-button button.btn {
    border-top-left-radius: 0!important;
    border-bottom-left-radius: 0!important;
    padding: 0px 6px!important;
    margin-top: 0;
    line-height: 43px;
    height: 37px !important;
}
html .slider-form .special-submit-button button.btn {
    FONT-VARIANT: JIS83;
    width: 45px!important;
    text-align: center;
}
html .special-submit-button img {
    object-fit: contain;
    width: 20px;
    margin: 0 0px;
    vertical-align: middle;
}

html #site .main-search-inner .row.no-gutters {
   
    align-items: center;
}
html[dir="ltr"] #site .slider-form #homeTypeToggle {
    border: 1px solid #D4D4D4 !important;
    padding: 0px 5px 0px 15px;
    line-height: 34px !important;
    padding-left: 10px !important;
    margin-left: 5px !important;
}
html[dir="rtl"] #site .slider-form #homeTypeToggle {
    border: 1px solid #D4D4D4 !important;
    padding: 0px 15px 0px  5px;
    line-height: 34px !important;
    padding-right: 10px !important;
    margin-right: 5px !important;
}
html[dir="ltr"] .special-submit-button {
    
    right: 4px;
    top: 8px;
     
}html[dir="rtl"] .special-submit-button {
    
    left: 4px;
    top: 8px;
     
}
html[dir="rtl"] .gaQgjK {
    min-width: 177px;
 
}
html[dir="rtl"] #site .row.no-gutters .col-md-3.home-home-type {
   
    max-width: calc(100% - 190px);
    
}
}
 </style>
 
