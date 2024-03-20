
                    <div class="Listing_info">

                        <div class="Prop_img">
                            <a href="<?php echo Yii::app()->createUrl($v->slug.'/projectView');?>" style="cursor: pointer;text-decoration:none;">
                            
	
						<div class="loadingFlexslider1"> </div>
                                <div class="flexslider" style="display:none">
                                    <ul class="slides">
										<?php
										preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->description, $Images); 
										 
											 
												?>
										        <li style="width: 423px; float: left; "> <img    src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php echo Yii::app()->apps->getBaseUrl('').  @$Images['1'];?>&h=235&w=423&zc=1"  style="width: 423px; " class="img-vert-align lazy" onerror  alt="#"> </li>
										 
                                         

                                    </ul>
                                </div>
                            </a>
                        </div>

                        <div class="list_infiDiv">
                            <div class="property_info width100">
                                <strong><?php echo (strlen($v->name)>25) ? substr($v->name,0,25).'...' :$v->name ; ?></strong>
                                <div class="agp_detail colorAsh"> 
									<?php 
										echo strip_tags(substr($v->description,0,650)).'.. 	<a href="">Read more..</a>';
									?>
								</div>
                                 <div class="View_detail">
                                    <a href="<?php echo Yii::app()->createUrl($v->slug.'/projectView');?>">View Property Details</a>
                                </div>
                                <span style="display:none;" class="apprx-div-span"></span>
                            </div>
                            
                    </div>

                    <div class="line"></div>
<style>
.width100{ width:100%;}
.colorAsh{ color:#676a6b;}
</style>
