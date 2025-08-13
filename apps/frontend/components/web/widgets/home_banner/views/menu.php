<?php
  $tag = $conntroller->tag; 
  //$city = CHtml::listData(States::model()->AllListingStatesOfCountry(COUNTRY_ID),'slug' , 'state_name'); 
  $city = array();
  $price_array = PlaceAnAd::model()->getPriceArray();
  
$heading = Yii::t('app',$conntroller->generateCommonHeading('banner_heading_h1',''));  
   
   ?>
<script>
  var auto1 = false;
  var auto2 = false;
  var cn_code = '<?php echo COUNTRY_CODE;?>';
</script>
<style>
.home_headings{ text-align: center;margin-bottom: 25px; }
.home_headings h1 {     font-size: 32px;    color: #fff;    font-weight: 700;    margin-bottom: 40px;    margin-top: 25px;}
.home_headings h2 {     font-size: 19px;    margin-bottom: 10px;    font-weight: 500 !important;}
.home_headings p {    font-size: 17px;    color: #fff;    margin-bottom: 0px;}
@media only screen and (min-width: 1024px){ html .main-search-container.home {   min-height: 500px!important; } } 
.nav-tabs--search-mobile { display:none !important;}
@media only screen and (max-width: 768px){ 
.home_headings h1 {    font-size: 20px; }
.nav-tabs--search{display:none;}
.nav-tabs--search.nav-tabs--search-mobile { display:flex !important;}
html #site .main-search-container.dark-overlay h2 {        font-size: 16px !important;    margin-bottom: 10px !important;    line-height: 1;    font-weight: 400 !important;}
.home_headings p {    font-size: 14px;    color: #fff;    margin-bottom: 0px;    line-height: 1;}
}
</style>
<div class="home-banner-outer">
  <div class="main-search-container dark-overlay home" >
    <div class="main-search-inner">
      <div class="slider-form advamced">
        <div class="container">
          <div class="home_headings">
          <h1 class="" id="nban_tit"><?php echo $heading;?></h1> 
          </div>
          <ul class="nav-tabs--search nav-tabs--search-mobile" role="tablist">
            <li class="nav-item active">
              <a class="nav-link active show"      href="javascript:void(0)" role="tab"    data-href="<?php echo $conntroller->createUrl('listing/filter',array('sec'=>SALE_SLUG,'quick'=>'1'));?>" onclick="load_filter(this)" ><?php echo $tag->getTag('property','Property');?></a>
            </li>
            <li class="nav-item"> <a class="nav-link r "  href="javascript:void(0)"  data-href="<?php echo $conntroller->app->createUrl('listing/filter',array('sec'=>'new-development'));?>" onclick="load_filter(this)"><?php echo $tag->getTag('new_projects','New Projects');?> </a> </li>
            <li class="nav-item nav-tabs--searchh"> <a class="nav-link  "  href="javascript:void(0)"  data-href="<?php echo $conntroller->createUrl('business_listing/filter',array('sec'=>'business-opportunities'));?>" onclick="load_filter(this)"><?php echo $tag->getTag('businesses_for_sale','Businesses Opportunities');?> </a> </li>
            <li class="nav-item nav-tabs--searchh"> <a class="nav-link  "  href="javascript:void(0)"  data-href="<?php echo $conntroller->app->createUrl('listing/filter',array('sec'=>'investments'));?>" onclick="load_filter(this)"><?php echo $tag->getTag('preleased','Investment Options');?> </a> </li>
          </ul>
          
          <ul class="nav-tabs--search" role="tablist">
            <li class="nav-item active">
              <a class="nav-link active show" id="home-tab" data-toggle="tab" data-href="home" data-ban-title="<?php echo $ban_titl;?>" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true" data-title="Buy" data-url="<?php echo Yii::App()->createUrl('listing/index/sec/property-for-sale');?>"  onclick="activateTab(this)"><?php echo $tag->getTag('property','Property');?></a>
            </li>
            <li class="nav-item"> <a class="nav-link r "  href="<?php echo $conntroller->app->createUrl('listing/index',array('sec'=>'new-development'));?>"><?php echo $tag->getTag('new_projects','New Projects');?> </a> </li>
            <li class="nav-item nav-tabs--searchh"> <a class="nav-link  "   href="<?php echo $conntroller->createUrl('business_listing/index',array('sec'=>'business-opportunities'));?>"><?php echo $tag->getTag('businesses_for_sale','Businesses Opportunities');?> </a> </li>
            <li class="nav-item nav-tabs--searchh"> <a class="nav-link  "   href="<?php echo $conntroller->app->createUrl('listing/index',array('sec'=>'investments'));?>"><?php echo $tag->getTag('preleased','Investment Options');?> </a> </li>
          </ul>
          <div class="tab-content hom-content" id="tab-home-srch" data-select2-id="14">
            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
              <div class="atmobile-click" onclick="openListing(this,event)"></div>
              <?php $this->render('_property_search',compact('areaData','city','city_array','city_array','price_array','conntroller','filterModel'));?>
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
    <div class="tiles-home" style="position:relative">
      <div class="container home_container sts" style="">
        <div class="container  ">
          <div class="row   margin-top-40 list-prop">
            <div class="col-md-12 home_exp_sec ">
              <div class="  homechange" style="display:flex" >
                <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'warehouse'));?>"   data-id="127" , class="a-flx-auto" >
                  <div class="col-sm-4 nevrsh">
                    <div class="spanstyle hovereffect">
                      <div class="col-md-4 " style="padding: 0px;width:80px;">
                        <img class="on_live" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im381Warehouse.svg');?>" alt="">
                        <img  class="on_hover" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im381Warehouse.svg');?>" data-id="114" alt=""> 
                      </div>
                      <div class="col-md-8 spanfontstyle">
                        <h3><?php echo $conntroller->tag->getTag('warehouse','Warehouse');?></h3>
                      </div>
                    </div>
                  </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale', 'category'=>'commercial' ,'type_of'=>'retail' ));?>"  onclick="easyload(this,event,'mainContainerClass')" data-id="114" class="a-flx-1">
                  <div class="col-sm-4 nevrsh">
                    <div class="spanstyle hovereffect">
                      <div class="col-md-4" style="padding: 0px;width:80px;">
                        <img  class="on_live" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im716Retail.svg');?>" data-id="114" alt=""> 
                        <img  class="on_hover" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im716Retail.svg');?>" data-id="114" alt=""> 
                      </div>
                      <div class="col-md-8 spanfontstyle">
                        <h3><?php echo $conntroller->tag->getTag('retail','Retail');?></h3>
                      </div>
                    </div>
                  </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'labour-camps'   ));?>"  onclick="easyload(this,event,'mainContainerClass')" data-id="127" class="a-flx-1" >
                  <div class="col-sm-4">
                    <div class="spanstyle hovereffect">
                      <div class="col-md-4 " style="padding: 0px;width:80px;">
                        <img class="on_live" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im174Staff Accommodation.svg');?>" alt="">
                        <img  class="on_hover" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im174Staff Accommodation.svg');?>" data-id="114" alt=""> 
                      </div>
                      <div class="col-md-8 spanfontstyle">
                        <h3><?php echo $conntroller->tag->getTag('accomodation','Accomodation');?></h3>
                      </div>
                    </div>
                  </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','type_of'=>'land','category'=>'commercial' ));?>"  onclick="easyload(this,event,'mainContainerClass')" data-id="121" class="a-flx-1">
                  <div class="col-sm-4">
                    <div class="spanstyle hovereffect">
                      <div class="col-md-4" style="padding: 0px;">
                        <img  class="on_live" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im769Land.svg');?>" alt="">  
                        <img  class="on_hover" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im769Land.svg');?>" alt=""> 
                      </div>
                      <div class="col-md-8 spanfontstyle">
                        <h3><?php echo $conntroller->tag->getTag('land','Land');?></h3>
                      </div>
                    </div>
                  </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','category'=>'commercial' ,'type_of'=>'hospital'   ));?>"  onclick="easyload(this,event,'mainContainerClass')" data-id="123" class="a-flx-1">
                  <div class="col-sm-4">
                    <div class="spanstyle hovereffect">
                      <div class="col-md-4" style="padding: 0px;">
                        <img  class="on_live" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/hospital.png');?>" alt="">  
                        <img  class="on_hover" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/hospital.png');?>" alt=""> 
                      </div>
                      <div class="col-md-8 spanfontstyle">
                        <h3><?php echo $conntroller->tag->getTag('hospitals','Hospitals');?></h3>
                      </div>
                    </div>
                  </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale' ,'category'=>'commercial' ,'type_of'=>'schools'   ));?>"  onclick="easyload(this,event,'mainContainerClass')" data-id="122" class="a-flx-1">
                  <div class="col-sm-4">
                    <div class="spanstyle hovereffect">
                      <div class="col-md-4" style="padding: 0px;">
                        <img  class="on_live" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/school.png');?>" alt="">  
                        <img  class="on_hover" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/school.png');?>" alt=""> 
                      </div>
                      <div class="col-md-8 spanfontstyle">
                        <h3><?php echo $conntroller->tag->getTag('school','School');?></h3>
                      </div>
                    </div>
                  </div>
                </a>
                <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale' ,'category'=>'commercial' ,'type_of'=>'building'    ));?>"  onclick="easyload(this,event,'mainContainerClass')" data-id="121" class="a-flx-auto" >
                  <div class="col-sm-4 ">
                    <div class="spanstyle hovereffect">
                      <div class="col-md-4" style="padding: 0px;">
                        <img  class="on_live" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im729building.svg');?>" alt="">  
                        <img  class="on_hover" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im729building.svg');?>" alt=""> 
                      </div>
                      <div class="col-md-8 spanfontstyle">
                        <h3><?php echo $conntroller->tag->getTag('full_buildings','Full Buildings');?></h3>
                      </div>
                    </div>
                  </div>
                </a>
                       <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale' ,'category'=>'commercial' ,'type_of'=>'hotel-apartment'    ));?>"  onclick="easyload(this,event,'mainContainerClass')" data-id="121" class="a-flx-auto" >
                  <div class="col-sm-4 no-border">
                    <div class="spanstyle hovereffect">
                      <div class="col-md-4" style="padding: 0px;">
                        <img  class="on_live" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im469hotel.svg');?>" alt="">  
                        <img  class="on_hover" src="<?php echo Yii::app()->apps->getBaseUrl('uploads/category/im469hotel.svg');?>" alt=""> 
                      </div>
                      <div class="col-md-8 spanfontstyle">
                        <h3><?php echo $conntroller->tag->getTag('hotels','Hotels');?></h3>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
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