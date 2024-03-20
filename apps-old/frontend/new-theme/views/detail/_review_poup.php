 
<style>.smllgry{font-size:10px;color:#999;font-weight:400;display:block}span.cn-name-deetal{font-size:15px;ine-height:1.8}.listby-info{font-weight:600;font-size:16px}.listby-info-review{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-direction:normal;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start;-webkit-box-orient:horizontal;-ms-flex-direction:row;flex-direction:row}.mobile_bottom_filter-review{display:block;height:100%;background-color:#fff;width:420px;position:fixed;z-index:99;border-left:5px solid var(--logo-color);top:0;direction:ltr;right:-1050px;max-width:90%;padding:0 10px;transition:all .2s ease-in-out;-webkit-transform:translateZ(0)}.mobile_bottom_shortlisted_container-review .desktop-title-review{font-size:1.2em;font-weight:600;color:#222;display:block;margin-bottom:1em}.mobile_bottom_filter.mobile_bottom_filter-opened{z-index:9111111}.mobile_bottom_filter-review.mobile_bottom_filter-review-opened{right:0;z-index:9111111111}span.review-score-badge{background:var(--secondary-color);color:#fff;text-shadow:none;display:inline-block;text-align:center;font-weight:400;-webkit-box-shadow:none;box-shadow:none;padding:0;margin:0;border:0;vertical-align:baseline;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;font-size:16px;border-radius:6.4px 6.4px 6.4px 0;width:32px;line-height:2;text-decoration:none}.review_list_new_item_block{padding:16px 0;border-bottom:solid 1px #ececec}.review_list_new_item_block{margin-bottom:20px}.c-review-block{display:inline-block;width:100%;vertical-align:top}.c-review-block__row{width:100%;display:inline-block;padding-bottom:16px;vertical-align:top}.c-guest-with-score{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;width:100%}.c-guest-with-score__guest{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1}.bui-avatar-block{display:-webkit-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-align:center;-ms-flex-align:center;-webkit-align-items:center;align-items:center;font-size:14px;font-weight:700;line-height:1.4285714286em}.bui-avatar{position:relative;height:32px;width:32px;border-radius:50%}.bui-avatar__image{position:absolute;top:0;right:0;bottom:0;left:0;border-radius:50%;width:100%;height:100%;-o-object-fit:cover;object-fit:cover;background-color:#ededed}[class^=bui-],[class^=bui-]::after,[class^=bui-]::before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.bui-avatar-block__text{display:-webkit-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;-webkit-flex-direction:column;flex-direction:column;margin-left:8px}.bui-avatar-block__subtitle,.bui-avatar-block__title{display:block}.bui-review-score{display:-webkit-inline-box;display:-ms-inline-flexbox;display:-webkit-inline-flex;display:inline-flex;-webkit-box-align:center;-ms-flex-align:center;-webkit-align-items:center;align-items:center;font-weight:500}.bui-review-score__badge{background:var(--secondary-color);color:#fff;display:-webkit-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-align:center;-ms-flex-align:center;-webkit-align-items:center;align-items:center;font-size:16px;font-weight:500;-webkit-box-pack:center;-ms-flex-pack:center;-webkit-justify-content:center;justify-content:center;vertical-align:baseline;border-radius:6px 6px 6px 0;height:32px;width:32px}.c-review-block__date{display:inline;color:#707070;font-size:12px;line-height:18px;font-weight:400}.c-review-block__title{margin:0;padding:0;font-size:20px;line-height:28px;font-weight:500;color:#000}.c-review{display:inline-block;width:100%;vertical-align:top}.c-review__inner{padding:0;margin:0;font-size:14px;line-height:20px;font-weight:400}.c-review__body{padding:0;margin:0;font-size:14px;line-height:20px;font-weight:400;white-space:pre-line}.c-review-block__date{display:inline;color:#707070;font-size:12px;line-height:18px;font-weight:400} 
html[dir="rtl"] .mobile_bottom_filter-review {       border-left: 0px solid var(--logo-color);    border-right: 5px solid var(--logo-color);    direction: rtl;    left: -1050px;    right: unset; }
html[dir="rtl"] .mobile_bottom_filter-review.mobile_bottom_filter-review-opened {    left: 0;  right: unset ; }
.close-review { cursor:pointer;position:absolute;right:0px; }
html[dir="rtl"] .close-review {  left:0px; right:unset !important;  }
html[dir="rtl"] .bui-avatar-block__text{  margin-left:0px; margin-right:8px;  }

</style>

 <div class="mobile_bottom_filter-review">
   <div class="mobile_bottom_shortlisted_container-review">
      <div class="desktop-title-review margin-top-15 margin-bottom-0" >   <span class="pull-right close-review" style="" onclick="closeReviewPop(this)"><img src="<?php echo $this->app->apps->getBaseUrl('assets/img/closen.png');?>" style="width: 31px;padding: 5px;" ></span>
      
      <div class="clearfix"></div>
      <div class="agentSec margin-bottom-10">
							<div class="pull-left margin-right-10 text-center" style="width:50px;">
							<img src="<?php echo $model->UserImage;?>" style="  border-radius: 50%;border: 1px solid #d1d1d1;object-fit:contatin;width:100%;height:50px;width:50px;padding: 1px;  " >
							</div>
							<div class="pull-left text-left" style="width:calc(100% - 60px);">
							<span class="listby-info"><a href="<?php echo Yii::app()->createUrl('user_listing/detail',array('slug'=>$model->agent_slug));?>" class="_9900dbc4" aria-label="Agent name"><?php echo $model->first_name.' '.$model->last_name;?></a></span>
							
							<span class="listby-info-review"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 511.99898 511" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m479.460938 193.480469h-78.914063v-151.105469c0-23.089844-18.785156-41.875-41.875-41.875h-316.796875c-23.089844 0-41.875 18.785156-41.875 41.875v231.027344c0 23.089844 18.785156 41.875 41.875 41.875h30.785156l22.34375 89.359375c1.402344 5.628906 5.855469 9.980469 11.511719 11.261719 1.128906.253906 2.261719.378906 3.390625.378906 4.527344-.003906 8.894531-2.007813 11.847656-5.589844l78.714844-95.410156h41.210938v60.417968c0 17.941407 14.59375 32.539063 32.539062 32.539063h103.546875l49.375 59.847656c2.957031 3.582031 7.324219 5.585938 11.851563 5.585938 1.125 0 2.261718-.125 3.386718-.378907 5.65625-1.277343 10.109375-5.632812 11.515625-11.257812l13.449219-53.796875h12.117188c17.941406 0 32.539062-14.597656 32.539062-32.539063v-149.675781c0-17.945312-14.597656-32.539062-32.539062-32.539062zm-286.234376 91.074219c-4.585937 0-8.929687 2.046874-11.847656 5.585937l-63.953125 77.515625-17.867187-71.464844c-1.707032-6.839844-7.851563-11.636718-14.902344-11.636718h-42.78125c-6.148438 0-11.148438-5.003907-11.148438-11.152344v-231.027344c0-6.148438 5-11.152344 11.148438-11.152344h316.796875c6.148437 0 11.148437 5.003906 11.148437 11.152344v231.027344c0 6.148437-5 11.152344-11.148437 11.152344zm288.046876 91.140624c0 1-.8125 1.8125-1.8125 1.8125h-24.109376c-7.050781 0-13.195312 4.800782-14.902343 11.636719l-8.980469 35.902344-34.609375-41.953125c-2.917969-3.535156-7.265625-5.585938-11.847656-5.585938h-110.792969c-1 0-1.816406-.8125-1.816406-1.8125v-60.417968h86.269531c23.089844 0 41.871094-18.785156 41.871094-41.875v-49.199219h78.917969c1 0 1.8125.8125 1.8125 1.816406zm0 0" fill="#999" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m249.402344 245.082031c-2.445313 0-4.898438-.582031-7.148438-1.765625l-41.980468-22.070312-41.984376 22.070312c-5.175781 2.722656-11.445312 2.269532-16.179687-1.171875-4.730469-3.433593-7.097656-9.261719-6.109375-15.023437l8.019531-46.75-33.96875-33.105469c-4.183593-4.082031-5.691406-10.1875-3.886719-15.75 1.808594-5.558594 6.617188-9.613281 12.402344-10.453125l46.9375-6.820312 20.992188-42.535157c2.589844-5.242187 7.929687-8.5625 13.777344-8.5625 5.847656 0 11.1875 3.320313 13.773437 8.5625l20.992187 42.535157 46.9375 6.820312c5.789063.839844 10.597657 4.894531 12.402344 10.453125 1.808594 5.5625.300782 11.667969-3.886718 15.75l-33.964844 33.105469 8.015625 46.75c.988281 5.761718-1.378907 11.589844-6.109375 15.023437-2.675782 1.949219-5.84375 2.9375-9.03125 2.9375zm-95.613282-98.089843 17.457032 17.019531c3.621094 3.527343 5.273437 8.613281 4.417968 13.597656l-4.121093 24.027344 21.582031-11.34375c4.472656-2.355469 9.820312-2.355469 14.296875 0l21.578125 11.34375-4.121094-24.027344c-.855468-4.984375.796875-10.070313 4.417969-13.597656l17.457031-17.019531-24.125-3.507813c-5.003906-.726563-9.332031-3.867187-11.566406-8.402344l-10.789062-21.863281-10.789063 21.863281c-2.242187 4.535157-6.566406 7.675781-11.570313 8.402344zm0 0" fill="#999" data-original="currentColor" style=""/></g></svg>&nbsp;&nbsp; <span class="reviews-count " style="font-size:14px;line-height:18px;"><strong><?php echo (int) $model->total_reviews;?></strong> <?php echo $this->tag->getTag('reviews','reviews');?></span></span>
							</div>
							<div class="clearfix"></div>
							</div>
							
      <div class="clearfix"></div>
       </div>
      <div class="hide" id="emptyResults-review" ><img src="<?php echo $this->app->apps->getBaseUrl('assets/img/love2.png');?>" class="nofav-img"><span class="nofav-text"><?php echo $this->tag->getTag('no_reviews_yet','No Reviews Yet');?></span></div>
      <div class="list-review" style="display: block;">
		  <div id="lodivScro-review"></div>
         <ul id="shortlist_items-review" class="listings drawer-items text-left" style="max-height:calc(100vh - 135px);overflow-y:scroll;">
         </ul>
      </div>
      <div id="ldmore-review"></div>
   </div>
   <div class="clear"></div>
</div>

<script>
	var stopPaginationRev;
	var loadingHtmlRev    	= '<div style="position:relative;"><div class="loading "><div class="spinner rmsdf"><div class="bounce1"></div>  <div class="bounce2"></div>  <div class="bounce3"></div></div></div></div>';
	var	loadMoreHtmlRev 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right"   onclick="checkScrollRev();"  ><?php echo $this->tag->getTag('load_more','Load More') ;?></a>';  
	var afterFinishHtmlRev = '';   
	var scrollRev=true;
	var limitRev='20';
	var offsetRev ='0';
	var stopPaginationRev;
	var checkFutureRev = true ;
	var loadingDivRev ;
	$(document).ready(function () {
	loadingDivRev  =  $('#ldmore-review');
	});
	var currentPageRev = 1;
	var slugRev ='<?php echo $this->app->createUrl('detail/review_agents/agent/'.$model->user_id);?>';
</script>
