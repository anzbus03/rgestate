 <?php  $options= $app->options;$tag=  $conntroller->tag; ?>
 <div id="header" class="clearfix" style="box-shadow: none;">
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col col-sm-2 topbar-left" style="    display: flex;    align-items: center;    padding-top: 3px;">
            <div class="social-icons"> 
				<a href="<?php echo $options->get('system.common.facebook_url','#');?>" class="social-icon social-facebook" target="_blank" rel="nofollow"> <i class="fa fa-facebook"></i> </a>
				 <a href="<?php echo $options->get('system.common.twitter_url','#');?>" class="social-icon social-twitter" target="_blank" rel="nofollow"> <i class="fa fa-twitter"></i></a>
				  <a href="<?php echo $options->get('system.common.pinterest_url','#');?>" class="social-icon social-instagram" target="_blank" rel="nofollow"> <i class="fa fa-instagram"></i></a>
				   <a href="<?php echo $options->get('system.common.google_plus_url','#');?>" class="social-icon social-youtube" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i></a> 
				   </div>
          </div>
            
          <div class="col col-sm-10 topbar-right">
              
               <div class="row">
                    
                   <div class="col col-sm-12 d-flex-top" >
            <ul id="menu-top-links" class="menu margin-right-10">
              <li id="menu-item-5987" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5987"> <a href="<?php echo $app->createUrl('about-us');?>"><?php echo $tag->getTag('about_us','About Us');?></a> </li>
              <li id="menu-item-5986" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5986"><a href="<?php echo $app->createUrl('bloglist/index');?>"><?php echo $tag->getTag('blog','Blog');?></a></li>
              <li id="menu-item-5986" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5986"><a href="<?php echo $app->createUrl('careers');?>"><?php echo $tag->getTag('careers','Careers');?></a></li>
              <li id="menu-item-5985" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5985"><a href="<?php echo $app->createUrl('contact/index');?>"><?php echo $tag->getTag('contact_us','Contact Us');?></a></li>
             </ul>
            
           
                 <?php
                 $property_id = $tag->getTag('property_id','Property ID');
                 $validating  = $tag->getTag('validating','Validating..');
                 $invalid_id  = $tag->getTag('invalid_id','Invalid ID');
                 ?>
                 
                 <script>
                 var get_property='<?php echo $app->createUrl('site/get_property');?>';
                     function removecls1(e){$(e).removeClass("lding"),$(e).parent().find('#property_id').focus()}function submitids(k){var propId = $(k).parent().find('#property_id');    var e=propId.val();  if(e==''){ propId.focus();return false;}  $(".val-loa").addClass("lding"),$.get(get_property,{val:e},function(e){"0"==(e=JSON.parse(e)).status&&($(".val-loa").removeClass("lding"),$(".val-error").addClass("lding"),propId.val("")),"1"==e.status&&($(".val-loa").html("Please Wait.."),location.href=e.url)})}$(function(){$("#property_id").on("keyup",function(e){"Enter"!==e.key&&13!==e.keyCode||submitids(e)})});
                 </script>
                 <div class="dspflxn">
                 <div class="post-rltiv ">
					<div class="val-loa"><?php echo $validating;?></div>
					<div class="val-error" onclick="removecls1(this)"><?php echo $invalid_id;?></div>
				<div class="style_searchByIdNav__1JHLu"><input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required="" value="" maxlength="9" id="property_id" name="property_id" placeholder="<?php echo $property_id;?>" autocomplete="off"><span onclick="submitids(this)"><img src="/assets/img/searchnn.png" alt="searchicon"></span></div>
				</div>
				<style>
				    #messageDropdown i.fa{color:#fc7d00 !important;}.mobile_bottom_filter-opened .srtbtn {  background: transparent !important;  }
				    .spnnwhatsapp {   display: none; }@media only screen and (max-width: 600px) {.spnnwhatsapp {   display: block; } }
				</style>
				<a class="nav-link count-indicator margin-right-10" style="color:#fc7d00 !important" id="messageDropdown" href="javascript:void(0)" onclick="openShortlistPop(this)" style="position:relative;">
				  <p class="color-grey  " style="color:#fc7d00 !important;margin-bottom:0px;"><i class="fa fa-heart" aria-hidden="true"></i> (<span class="  dataCounter-fav" id="dataCounter" ><?php echo $conntroller->fav_count;?></span>)</p>
				</a>	
				 <li id="footer-selector" style="display: inline-flex;    align-items: center;" class="nborder">
<?php
								$currencies = $conntroller->currencies;
								?>
								  
								<a   class="margin-right-10" style="    padding: 4px 7px;    line-height: 1;    border-radius: 8px;    background: #fff;"><?php echo SELECT_CURRENCY_TITLE;?> <span class="_56540a28 spantitl"><span class="fa fa-angle-down"></span></span></a>
								<ul class="  ">
								<?php
								foreach($currencies as $k=>$v){
									if($k==SELECTED_CURRENCY){ continue;}
									echo '<li class="_4eec698b undefined"  ><a href="'.$app->createUrl('site/change_currency',array('id'=>$k)).'"> '.$v['name'].' </a></li>';
								}
								?>
								</ul>


								</li>
               
                   <p class="language"><?php
			$ret = defined('RETURN_URL')?     RETURN_URL   : '' ;
			foreach($languages as $k=>$v){
				if($conntroller->language==$k){ continue; } 
				echo '<a href="'.$app->createUrl('site/changeLanguage',array('val'=>$k,'ret'=>$ret)).'"   class="lng-convertor change-language" style="font-weight: 600;font-size: 17px;" class="color-grey"    >'.$v.'</a>';
			}					 
			?>	
                   </p>
                   </div>
                    </div>
            </div>
              
          </div>
            
        </div>
      </div>
    </div>
     <div class="header">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-3 header-left"> <a href="<?php echo $app->createUrl('site/index');?>" class="logo"> <img width="710" height="96" src="<?php echo $app->apps->getBaseUrl($conntroller->logo_path);?>" class="attachment-full size-full" alt="" /> </a>
            <div class="mobile-buttons">  <a href="#" class="btn-menu"> <span class="menu-icon"><span></span><span></span><span></span><span></span></span> </a> </div>
          </div>
          <div class="col-sm-9 col-md-9 header-right">
            <div class="nav">
              <ul id="menu-main-menu" class="menu">
                <li id="menu-item-5980" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5980"> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>SALE_SLUG));?>"><?php echo $tag->getTag('sale','Sale');?></a> </li>
                <li id="menu-item-5980" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5980"> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>RENT_SLUG));?>"><?php echo $tag->getTag('rent','Rent');?></a> </li>
                <li id="menu-item-5980" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5980"> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>'investments'));?>"><?php echo $tag->getTag('preleased','Investment Options');?></a> </li>
                <li id="menu-item-5982" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5982"> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>'new-development'));?>"><?php echo $tag->getTag('new_projects','New Projects');?></a> </li>
                <li id="menu-item-5983" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5983"> <a href="<?php echo $app->createUrl('business_listing/index',array('sec'=>'business-for-sale'));?>"><?php echo $tag->getTag('business_for_sale','Business For Sale');?></a> </li>
              </ul>
              <a href="<?php echo $app->createUrl('place_an_ad_no_login/create');?>" class="btn btn-border-white dansss"  ><?php echo $tag->getTag('submit_property','Submit Property');?></a> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="full-block mobile-nav" style="background-image: url(<?php echo $app->apps->getBaseUrl('new_assets/images/hero-08-xl.jpg');?>);">
      <div class="full-block overlay">
        <div class="mobile-nav-inner">
          <ul id="menu-mobile-menu" class="menu">
              <li  id="menu-item-246531" style="    padding-top: 0px;"> 
              
              <div class="dspflxn mbt">
                 <div class="post-rltiv ">
					<div class="val-loa"><?php echo $validating;?></div>
					<div class="val-error" onclick="removecls1(this)"><?php echo $invalid_id;?></div>
				<div class="style_searchByIdNav__1JHLu"><input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required="" maxlength="9" id="property_id" name="property_id" placeholder="<?php echo $property_id;?>" autocomplete="off"><span onclick="submitids(this)"><img src="/assets/img/searchnn.png" alt="searchicon"></span></div>
				</div>
			 
				<ul>
				 <li id="footer-selector" style="display: inline-flex;    align-items: center;" class="nborder">
<?php
								$currencies = $conntroller->currencies;
								?>
								  
								<a   class="margin-right-10 lngchanger" style="    "><?php echo SELECT_CURRENCY_TITLE;?> <span class="_56540a28 spantitl margin-left-3"><span class="fa fa-angle-down"></span></span></a>
								<ul class="  ">
								<?php
								foreach($currencies as $k=>$v){
									if($k==SELECTED_CURRENCY){ continue;}
									echo '<li class="_4eec698b undefined"  ><a href="'.$app->createUrl('site/change_currency',array('id'=>$k)).'"> '.$v['name'].' </a></li>';
								}
								?>
								</ul>


								</li>
               </ul>
                   <p class="language"><?php
			$ret = defined('RETURN_URL')?     RETURN_URL   : '' ;
			foreach($languages as $k=>$v){
				if($conntroller->language==$k){ continue; } 
				echo '<a href="'.$app->createUrl('site/changeLanguage',array('val'=>$k,'ret'=>$ret)).'"   class="lng-convertor change-language" style="font-weight: 600;font-size: 17px;" class="color-grey"    >'.$v.'</a>';
			}					 
			?>	
                   </p>
                   </div>
              </li>
            <li id="menu-item-24653" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5967 current_page_item menu-item-24653"> <a href="<?php echo $app->createUrl('site/index');?>" aria-current="page"><?php echo $tag->getTag('home','Home');?></a> </li>
            <li id="menu-item-24656" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24656"> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>SALE_SLUG));?>"><?php echo $tag->getTag('sale','Sale');?></a> </li>
            <li id="menu-item-24657" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24657"> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>RENT_SLUG));?>"><?php echo $tag->getTag('rent','Rent');?></a> </li>
            <li id="menu-item-5980" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5980"> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>'investments'));?>"><?php echo $tag->getTag('preleased','Investment Options');?></a> </li>
            <li id="menu-item-24655" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24655"> <a href="<?php echo $app->createUrl('listing/index',array('sec'=>'new-development'));?>"><?php echo $tag->getTag('new_projects','New Projects');?></a> </li>
            <li id="menu-item-24659" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24659"> <a href="<?php echo $app->createUrl('business_listing/index',array('sec'=>'business-for-sale'));?>"><?php echo $tag->getTag('business_for_sale','Business For Sale');?></a> </li>
            <li id="menu-item-24658" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24658"> <a href="<?php echo $app->createUrl('about-us');?>"><?php echo $tag->getTag('about_us','About Us');?></a> </li>
            <li id="menu-item-24658" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24658"> <a href="<?php echo $app->createUrl('bloglist/index');?>"><?php echo $tag->getTag('blog','Blog');?></a> </li>
            <li id="menu-item-24659" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24659"> <a href="<?php echo $app->createUrl('careers');?>"><?php echo $tag->getTag('careers','Careers');?></a> </li>
            <li id="menu-item-24654" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-24654"> <a href="<?php echo $app->createUrl('contact/index');?>"><?php echo $tag->getTag('contact_us','Contact Us');?></a> </li>
          </ul>
          <a href="<?php echo $app->createUrl('place_an_ad_no_login/create');?>" class="btn btn-border-white"  ><?php echo $tag->getTag('submit_property','Submit Property');?></a> </div>
      </div>
    </div>
  </div>
  <div class="mobile_bottom_filter">
   <div class="mobile_bottom_shortlisted_container">
      <div class="desktop-title"> <?php echo $conntroller->tag->getTag('my_favorite_properties','My Favorite Properties');?> <span class="fa fa-close srtbtn pull-right" onclick="closeShortlistPop(this)"></span> </div>
      <div class="hide" id="emptyResults" ><img src="<?php echo $app->apps->getBaseUrl('assets/img/love2.png');?>" class="nofav-img"><span class="nofav-text"><?php echo $conntroller->tag->getTag('no_favorite_properties','No Favorite Properties');?></span></div>
      <div class="list" style="display: block;">
		  <div id="lodivScro"></div>
         <ul id="shortlist_items" class="listings drawer-items" style="max-height:calc(100vh - 65px);">
         </ul>
      </div>
      <div id="ldmore"></div>
   </div>
   <div class="clear"></div>
</div>
<style>
    .style_searchByIdNav__1JHLu input {
  
    background: #fff; 
}
</style>
 <script>
	var stopPaginationFav;
	var loadingHtmlFav    	= '<div style="position:relative;"><div class="loading "><div class="spinner rmsdf"><div class="bounce1"></div>  <div class="bounce2"></div>  <div class="bounce3"></div></div></div></div>';
	var	loadMoreHtmlFav 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right"   onclick="checkScrollFav();"  ><?php echo $conntroller->tag->getTag('load_more','Load More') ;?></a>';  
	var afterFinishHtmlFav = '';   
	var scrollFav=true;
	var limitFav='20';
	var offsetFav ='0';
	var stopPaginationFav;
	var checkFutureFav = true ;
	var loadingDivFav ;
	$(document).ready(function () {
	loadingDivFav  =  $('#lodivScro');
	});
	var currentPageFav = 1;
	var slugFav ='<?php echo $app->createUrl('listing/fav_properties');?>';
	var deleteFav ='<?php echo $app->createUrl('user/remove_properties');?>';
</script>
