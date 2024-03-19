
<div id="map_locator">
<div class="t-Body-main" style="margin-top: 20px;">
<div id="R148698535418114705" class="t-BreadcrumbRegion container-max t-BreadcrumbRegion--showBreadcrumb t-BreadcrumbRegion--useBreadcrumbTitle"> 
  <div class="t-BreadcrumbRegion-body"> 
    <div class="t-BreadcrumbRegion-breadcrumb"   >
      <ul class="t-Breadcrumb custom-breadcrumb-v1">
<li class="t-Breadcrumb-item is-active"  ><link itemprop="url"  ><span class="t-Breadcrumb-label" itemprop="title"><?php echo $title ;?> Real Estate Developers   &nbsp;<a href="javascript:void(0)" style="color:#82addc;font-size:13px;" onclick="$('#show_country').toggleClass('hiddens')">Change Country</a></span></li>
</ul>
</div>
    </div>
    
  </div>
  
  <div class="t-BreadcrumbRegion-buttons"></div>
</div>




 <div class="container">
	 <script>
	 $(function(){
		 
		 	$('.simple-slick-carousel02').slick({
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 4,
			dots: false,
			arrows: true,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow:2,
					slidesToScroll: 2
				}
			}, {
				breakpoint: 769,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		});
		 })
	 
	 </script>
	 <style>
	 .slick-slide {  width:200px; }
	.simple-slick-carousel02 .slick-arrow { top:45% !important; z-index:1 !important;}
	.hiddens{height:0px !important; overflow: hidden; }
	  </style>
            <div class="row hiddens" id="show_country" style="max-width:600px;margin:auto;height:60px;">
               <div class="col-md-12 simple-slick-carousel02">
				   
				   <?php
				   $countries =   Countries::model()->listingCountries();
				   foreach($countries as $k=>$v){ ?> 
				   <a href="<?php echo Yii::App()->createUrl('user_listing_developers/index',array('country'=>$v->slug));?>" style="display:inline"  >
                  <div class="col-md-12" style="padding:0px">
                     <div class="spanstyle" style="width:100%">
                        <div class="col-md-12 spanfontstyle">
                           <h3 style="width:100%;text-align:center;"><?php echo $v->country_name;?></h3>
                        </div>
                     </div>
                  </div>
                  </a> 
                  <?php } ?> 
               </div>
            </div>
         </div>
    


<div class="t-Body-contentInner">
   <div class="container">
	   <span id="lodr"></span>
     <?php
      if(!empty($featured_developers)){ ?>
      <div class="row">
         <div class="col col-12 ">
            <div id="R970151010597278858" style="padding-bottom:20px;" class="container-max top_developer sdev_lm_device top_dev2" aria-live="polite">
               <div id="report_970151010597278858_catch">
                  <?php 
                  $this->renderPartial('_top_8_developers');
                  ?>
                  <table class="t-Report-pagination" role="presentation"></table>
               </div>
            </div>
         </div>
      </div>
       <?php } ?>
      <div class="row">
         <div class="col col-12 ">
            <div id="slideSheet" class="container-max new_dev_list shadow_cards_boxs_in  t-Form--labelsAbove margin-top-lg" aria-live="polite">
               <ul class="t-Cards t-Cards--featured t-Cards--4cols t-Cards--animRaiseCard" id="suggestionList" >
                 <li id="suggest_friends_last_id" style="display:none;"></li>
               </ul>
               <table class="t-Report-pagination" role="presentation"></table>
               <div style="clear:both;margin-top:20px;"></div>
	<div class="bar-results bottom">
	<div class="paging-holder">
	<div class="paging"><div class="text-center loadingDiv marTop15 no-margin"> </div> </div>
	</div>
	</div>
	<div class="clearfix"></div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="clearfix"></div>
 </div>
 <script>
 $(document).ready(function () {
		scrollPagination2(); 
	});
 </script>
