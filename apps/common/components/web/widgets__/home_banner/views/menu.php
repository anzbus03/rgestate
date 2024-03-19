<?php
$city = CHtml::listData(States::model()->AllListingStatesOfCountry((int) $conntroller->project_country_id),'slug' , 'state_name'); 
$city_array = array();
$price_array = PlaceAnAd::model()->getPriceArray();
$ban_titl = $conntroller->options->get('system.common.home_page_banner_title','');                       
$ban_titl_r = $conntroller->options->get('system.common.home_page_banner_title_r','');                       
$ban_titl_w = $conntroller->options->get('system.common.home_page_banner_title_w','');                       
$ban_titl_n = $conntroller->options->get('system.common.home_page_banner_title_n','');                       
?> 
<div class="home-banner-outer">
                         
         <div class="main-search-container dark-overlay home" >
            <div class="main-search-inner">
            <div class="slider-form">
            <div class="container">
               <h2 class="text-left mb-5" id="nban_tit"><?php echo $ban_titl;?></h2>
            
                  <ul class="nav nav-tabs hom-tab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active show" id="home-tab" data-toggle="tab" data-href="home" data-ban-title="<?php echo $ban_titl;?>" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true" data-title="Buy"  onclick="activateTab(this)">For Sale</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" data-href="profile" data-ban-title="<?php echo $ban_titl_r;?>"   href="javascript:void(0)" role="tab" aria-controls="profile" aria-selected="false"  data-title="Rent" onclick="activateTab(this)">For Rent</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" data-href="wanted" data-ban-title="<?php echo $ban_titl_w;?>" href="javascript:void(0)" role="tab" aria-controls="profile" aria-selected="false"  data-title="Wanted" onclick="activateTab(this)">Wanted</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" data-href="new_project" data-ban-title="<?php echo $ban_titl_n;?>" href="javascript:void(0)" role="tab" aria-controls="profile" aria-selected="false"  data-title="Projects" onclick="activateTab(this)">Projects</a>
                     </li>
                  </ul>
                   <div class="tab-content hom-content" data-select2-id="14">
                     <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
						<?php $this->render('_for_sale_search',compact('city','city_array','city_array','price_array','conntroller'));?>
                     </div>
                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
						<?php $this->render('_for_rent_search',compact('city','city_array','city_array','price_array','conntroller'));?>
                     </div>
                     <div class="tab-pane fade" id="wanted" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
						<?php $this->render('_for_wanted_search',compact('city','city_array','city_array','price_array','conntroller'));?>
                     </div>
                     <div class="tab-pane fade" id="new_project" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
						<?php $this->render('_for_project_search',compact('city','city_array','city_array','price_array','conntroller'));?>
                     </div>
                  </div>
             
               <div class="top-search">
                  <strong><i class="mdi mdi-keyboard"></i> Top Search</strong>
                  <a href="<?php echo Yii::app()->createUrl('listing/index/sec/property-for-sale/type_of[]/114/');?>" data-id="114">House</a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index/sec/property-for-sale/type_of[]/115/');?>"  data-id="115">Flat</a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index/sec/property-for-sale/type_of[]/121/');?>"  data-id="121">Residential Plot</a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index/sec/property-for-sale/type_of[]/122/');?>"  data-id="122">Commercial Plot</a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index/sec/property-for-sale/type_of[]/127/');?>"  data-id="127">Office</a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index/sec/property-for-sale/type_of[]/128/');?>"  data-id="128">Shop</a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index/sec/property-for-sale/type_of[]/131/');?>"  data-id="131">Building</a>
               </div>
            </div>
         </div>
         <style>
			.main-search-inner { top:40%; }
			.slider-form {
			left: 15%;
			position: absolute;
			right: 15%;
			top:27%;
			} 
         </style>
            
             </div>
            <!-- Video -->
            <div class="video-container">
              <?php 
              
              $banners =   $conntroller->banners;
               if( $banners){
				 ?>
				<div class="row fullwidth">
				<div class="columns small-12 slider">
					<?php 
					foreach($banners as $k=>$v){
					?>
					<div class="text-center slide" style="  background-image: url('<?php echo $v->BannerLink;?>'); "></div>
					<?php } ?> 
		 
				</div>
				</div>
					   <?
				   
				}; ?>

     <style>
 .video-container .slider { border-radius:  0px; background:#000;} 
  </style>
  <script>
  
  $(function(){
	  $('.slider').slick({
      dots: false,
        autoplay: true,
        autoplaySpeed: 7000,
     
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        lazyLoad: 'ondemand',
        lazyLoadBuffer: 0,
      mobileFirst: true,
       prevArrow: false,
    nextArrow: false
    });
	  
	  })
  
  
  </script>
            </div>
		
         </div>
         <script>
			 var load_city_url = '<?php echo Yii::App()->createUrl('site/load_city');?>';
         $(function(){ $('select.select2').select2();
			 $eventSelect = $('.dynamicCities') ; 
			 $eventSelect.select2({
								placeholder: 'Select Locations',
								 allowClear: true,
								ajax: {
								url: function () {
									var stid =  $(this).closest('form').find('#state').val();
									 
									var load_city_url2 = load_city_url+'/state/'+stid; 
								return load_city_url2;
								},
								dataType: 'json',
								delay: 250,
								data: function (params) {
								return {
								q: params.term, // search term
								page: params.page
								};
								},
								processResults: function (data, params) {
								// parse the results into the format expected by Select2
								// since we are using custom formatting functions we do not need to
								// alter the remote JSON data, except to indicate that infinite
								// scrolling can be used
								params.page = params.page || 1;
								return {
								results: data.items,
								pagination: {
								more: (params.page * 30) < data.total_count
								}
								};
								},
								cache: true
								},
								escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
								minimumInputLength: 0,
								//templateResult: formatRepo, // omitted for brevity, see the source of this page
								//templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
								}) ;
			 $eventSelect.on("select2:select", function (e) { console.log("select2:select", e.params.data.id ); });
			  })
			  
			  $(function(){
				  closeOpendDiv()
				  
				  })
         </script>
         
         <div class="clearfix"></div>
</div>
