<div id="map_locator">
<div class="container margin-top-40 ak_lisitng_agents">
    <div class="row">
      <div class="col-md-12">
        <h3 class="headline  margin-bottom-10 col-md-12 n0-padding-left"><link itemprop="url"  ><span class="t-Breadcrumb-label" itemprop="title"><?php echo $title ;?> Real Estate Agents   &nbsp;<a href="javascript:void(0)"  onclick="$('#show_country').toggleClass('hiddens')" style="color:#82addc;font-size:13px;">Change Country</a></span></h3>
      </div>
      <div class="col-md-12"><span id="lodr"></span><div>


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
				   <a href="<?php echo Yii::app()->createUrl('user_listing/index',array('country'=>$v->slug));?>" style="display:inline"  >
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
    


	<div id="slideSheet"  >
	<ul class="list-group  no-margin no-padding" id="suggestionList">
	<li id="suggest_friends_last_id" style="display:none;"></li>
	</ul>

	<div style="clear:both"></div>
	<div class="bar-results bottom">
	<div class="paging-holder">
	<div class="paging"><div class="text-center loadingDiv marTop15 no-margin"> </div> </div>
	</div>
	</div>
	<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
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



 
