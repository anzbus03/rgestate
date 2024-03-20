<?php
		if(!empty($news)){ ?> 
		<script>
		$(document).ready(function(){ $('.container2').removeClass('hidden');  $(".news-slider").slick({slidesToShow:2,slidesToScroll:1,autoplay:!0,autoplaySpeed:8e3,arrows:!0,prevArrow:$(".prev"),nextArrow:$(".next"),dots:!1,pauseOnHover:!1,responsive:[{breakpoint:768,settings:{slidesToShow:1}},{breakpoint:520,settings:{slidesToShow:1}}]})});
		</script>	
        <div class="container2 container hidden newsSliderss">
			<div style="max-width:1080px;margin:auto;">
  <div class="" style="display:flex;max-height:70px;">
	<div class="section-new" style="width:50px;flex:1;">News</div>
    <div class="col-sm-12 news-slider" style="flex:1;" >
	<?php 
	foreach($news as $k=>$v){ ?> 
	<div class="slide">
		<a href="<?php echo Yii::app()->createUrl( $v->slug.'/blog');?>">
		<div class="span-cal"><?php echo date('M d/y',strtotime($v->date_added));?></div>
		<div class="span-news"><?php echo $v->title;?></div>
		</a>
	</div> 
	<?php } ?> 
	 
    </div>
  
		<div class="section-view-more" style="">
			<a href="<?php echo Yii::app()->createUrl('blog/news');?>" title="View More">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="37" viewBox="0 0 20 37">
			<defs>
			<style>
			.cls-1 {
			fill: #fff;
			fill-rule: evenodd;
			}
			</style>
			</defs>
			<path id="read-more-arrow.svg" class="cls-1" d="M1343.01,798.5l-19.11,18.493-0.91-.882,18.2-17.611-18.2-17.611,0.91-.882Zm0,0" transform="translate(-1323 -780)"/>
			</svg>
			</a>
		</div>
  </div>	
<div class="clearfix"></div>
</div>
</div>
		<?php } ?> 
