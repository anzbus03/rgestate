<?php
$timthumb =  Yii::app()->apps->getBaseUrl('timthumb.php');
$read_more =  'Read more'  ;
$last_updated_on = 'Last updated on' ;
 $langaugae = 'en';
 $commonModel = new OptionCommon();
 
foreach($ads as $k=>$v){
	   preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $imges);
									 
									 
			  ?>
		<li aria-hidden="false" class="mb-15 col-sm-4 brkr "  >
		    <div class="f-ull-height">
		        <a href="<?php echo $this->app->createUrl('bloglist/details',array('slug'=>$v->slug));?>"     class="_xvt7x" aria-busy="false"></a>
		        <div class="blog-img">
		            	<img class=" lozad" style="object-fit: cover;" alt="<?php echo $v->title;?>" decoding="async" data-src="<?php echo @$imges['1'];?>">
		        </div>
		         <div class="blog-text">
		             <?php echo $v->title;?>
		         </div>
		    </div>
		 
		</li> 
		<?php } ?>
