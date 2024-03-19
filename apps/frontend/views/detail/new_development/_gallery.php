<!-- work start -->
<section id="_gallery">
    <div class="portfolio  mid-level-padding" style="padding-bottom:0px;padding-top:0px;">
        <div id="project" class="wow fadeInUp section-padding" data-wow-duration="500ms" data-wow-delay="900ms">
            <div class="container">
                <div class="section-top-heading text-center" style="padding-top:25px;padding-bottom:25px;margin-bottom:0px;"> <h2>Gallery</h2></div>

                

                </div>
            </div>


            <div class="container-fluid project-wrapper" id="MixItUp218D4D">
                <div class="zerogrid">
                    <div class="wrap-container clearfix">
                        <div class="row wrap-content">
						<?php
						$images = $model->all_images();
						$whenCheck = 100;
						if($images){  
						$total_image = 	sizeOf($images);
						
						$checkClass = false;
						if($total_image=='1'){
							$grid_class = 'col-1-1';
						}
						else{
							$grid_class = 'col-1-2';
							$mod_val = $total_image%2;
							if($mod_val=='1'){
								$checkClass = true;
								$whenCheck = $total_image-3;
							}
						}
						
						
						foreach ($images as $k=>$image){
						$image_url = $this->app->apps->getBaseUrl('timthumb.php').'?src='.$this->app->apps->getBaseUrl('uploads/images/'.$image->image_name).'&h=553&w=864&zc=1' ;	
						if($checkClass and ($k >= $whenCheck)){
							$grid_class = 'col-1-3';
						}
						?>
						<div class="<?php echo $grid_class;?>">
						<div class="col-full mix work-item video" style="display: inline-block;">
						<div class="wrap-col">
						<div class="item-container">
						<a class="fancybox overlay text-center" data-fancybox-group="gallery"    href="<?php echo $this->app->apps->getBaseUrl('uploads/images/'.$image->image_name);?>">
						<div class="overlay-inner">
						<h4 class="base"><?php echo $model->category_name;?> </h4>
						<div class="line"></div>
						<p><?php echo $model->locationTitle;?></p>
						</div>
						</a>
						<img src="<?php echo $image_url;?>" alt="work">
						</div>
						</div>
						</div>

						</div>
						<?php }  } ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>



</section>
<!-- work end -->
