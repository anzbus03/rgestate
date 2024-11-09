<!-- 			
							<div class="agentSec margin-bottom-10">
							<div class="pull-left margin-right-10 text-center" style="width:50px;">
							<img src="<?php echo $model->UserImage;?>" style="  border-radius: 50%;border: 1px solid #d1d1d1;object-fit:contatin;width:100%;height:50px;width:50px;padding: 1px;  " >
							</div>
							<div class="pull-left text-left" style="width:calc(100% - 60px);">
							<span class="listby-info"><?php echo $this->tag->getTag('listing_by','Listing by');?> <a href="<?php echo Yii::app()->createUrl('user_listing/detail',array('slug'=>$model->agent_slug));?>" class="_9900dbc4" aria-label="Agent name"><?php echo $model->OwnerName ;?></a></span>
							
							<span class="listby-info-review"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 511.99898 511" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m479.460938 193.480469h-78.914063v-151.105469c0-23.089844-18.785156-41.875-41.875-41.875h-316.796875c-23.089844 0-41.875 18.785156-41.875 41.875v231.027344c0 23.089844 18.785156 41.875 41.875 41.875h30.785156l22.34375 89.359375c1.402344 5.628906 5.855469 9.980469 11.511719 11.261719 1.128906.253906 2.261719.378906 3.390625.378906 4.527344-.003906 8.894531-2.007813 11.847656-5.589844l78.714844-95.410156h41.210938v60.417968c0 17.941407 14.59375 32.539063 32.539062 32.539063h103.546875l49.375 59.847656c2.957031 3.582031 7.324219 5.585938 11.851563 5.585938 1.125 0 2.261718-.125 3.386718-.378907 5.65625-1.277343 10.109375-5.632812 11.515625-11.257812l13.449219-53.796875h12.117188c17.941406 0 32.539062-14.597656 32.539062-32.539063v-149.675781c0-17.945312-14.597656-32.539062-32.539062-32.539062zm-286.234376 91.074219c-4.585937 0-8.929687 2.046874-11.847656 5.585937l-63.953125 77.515625-17.867187-71.464844c-1.707032-6.839844-7.851563-11.636718-14.902344-11.636718h-42.78125c-6.148438 0-11.148438-5.003907-11.148438-11.152344v-231.027344c0-6.148438 5-11.152344 11.148438-11.152344h316.796875c6.148437 0 11.148437 5.003906 11.148437 11.152344v231.027344c0 6.148437-5 11.152344-11.148437 11.152344zm288.046876 91.140624c0 1-.8125 1.8125-1.8125 1.8125h-24.109376c-7.050781 0-13.195312 4.800782-14.902343 11.636719l-8.980469 35.902344-34.609375-41.953125c-2.917969-3.535156-7.265625-5.585938-11.847656-5.585938h-110.792969c-1 0-1.816406-.8125-1.816406-1.8125v-60.417968h86.269531c23.089844 0 41.871094-18.785156 41.871094-41.875v-49.199219h78.917969c1 0 1.8125.8125 1.8125 1.816406zm0 0" fill="#999" data-original="currentColor" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m249.402344 245.082031c-2.445313 0-4.898438-.582031-7.148438-1.765625l-41.980468-22.070312-41.984376 22.070312c-5.175781 2.722656-11.445312 2.269532-16.179687-1.171875-4.730469-3.433593-7.097656-9.261719-6.109375-15.023437l8.019531-46.75-33.96875-33.105469c-4.183593-4.082031-5.691406-10.1875-3.886719-15.75 1.808594-5.558594 6.617188-9.613281 12.402344-10.453125l46.9375-6.820312 20.992188-42.535157c2.589844-5.242187 7.929687-8.5625 13.777344-8.5625 5.847656 0 11.1875 3.320313 13.773437 8.5625l20.992187 42.535157 46.9375 6.820312c5.789063.839844 10.597657 4.894531 12.402344 10.453125 1.808594 5.5625.300782 11.667969-3.886718 15.75l-33.964844 33.105469 8.015625 46.75c.988281 5.761718-1.378907 11.589844-6.109375 15.023437-2.675782 1.949219-5.84375 2.9375-9.03125 2.9375zm-95.613282-98.089843 17.457032 17.019531c3.621094 3.527343 5.273437 8.613281 4.417968 13.597656l-4.121093 24.027344 21.582031-11.34375c4.472656-2.355469 9.820312-2.355469 14.296875 0l21.578125 11.34375-4.121094-24.027344c-.855468-4.984375.796875-10.070313 4.417969-13.597656l17.457031-17.019531-24.125-3.507813c-5.003906-.726563-9.332031-3.867187-11.566406-8.402344l-10.789062-21.863281-10.789063 21.863281c-2.242187 4.535157-6.566406 7.675781-11.570313 8.402344zm0 0" fill="#999" data-original="currentColor" style=""/></g></svg>&nbsp;&nbsp; <span class="reviews-count " style="font-size:14px;line-height:18px;" ><span <?php if(!empty($model->total_reviews)){ ?> onclick="openReviewPop(this)" style="cursor:pointer" <?php } ?>><strong><?php echo (int) $model->total_reviews;?></strong> <?php echo $this->tag->getTag('reviews','reviews');?></span><span class="seprt- margin-left-5 margin-right-5">-</span><a href="<?php echo $this->app->createUrl('forms/review_agent',array('slug'=>$model->agent_slug));?>" aria-label="Write review" class="margin-left-0"><?php echo $this->tag->getTag('write_a_review','Write a review');?></a></span></span>
							</div>
							<div class="clearfix"></div>
							</div>
							
							<?php
							
							$image = $model->companyImage; 
							//$total_rest = $model->activePropertys; 

							$lnk = $model->DetLink  ; 
							if(!empty($image)){
							echo '<a href="'.$lnk.'"   class="margin-bottom-5" style="display: block;margin: 0 auto;line-height:1;" ></a>';
							} 	
							?>
							<div class="clearfix"></div>
							<div class="img_dev_details " style="width:100% !important; ">
							<div class="_1p3joamp padding-0" style="margin-bottom: 2px !important;width:100%;padding:0px !important"><a href="<?php echo $lnk;?>" style="width:100%;display:block;" class="<?php echo $model->enable_l_f=='1' ? '  ' : '';?>" >
							<div class="pull-left margin-right-10 text-left" style="width:calc(100% - 60px);">
							<span class="cn-name-deetal"><?php echo $model->companyName; ?></span>
							
							<?php
							 
							if(!empty($model->advertiser_character)){  
							?>
							 
							<span class="smllgry nowrap"><i><?php echo $this->tag->getTag('advertiser-character','Advertiser Character');?></i> : <?php echo $model->ArabicCharacter;?> </span>
							<?php } ?>
							<div class="clearfix"></div>
								<?php
							 
							if(!empty($model->licence_no)){  
							?>
							 
							<span class="smllgry nowrap"><i><?php echo $this->tag->getTag('advertiser_license_number','Advertiser License Number');?></i> : <?php echo $model->licence_no;?> </span>
							<?php } ?>
							<div class="clearfix"></div>
							<?php
							if(!empty($model->cr_number)){  
							?>
							 
							<span class="smllgry nowrap"><i><?php echo $this->tag->getTag('commercial_registration_no.','Commercial Registration No.');?></i> : <?php echo $model->cr_number;?> </span>
							<?php } ?>
							</div>
							<div class="pull-right" style="width:50px;">
							<img src="<?php echo $image;?>" style="object-fit:contain;width:100%;height:50px;width:50px;padding: 1px;  " >
							</div>
							
							
							<div class="clear:both"></div>
							</a>
							<div class="clear:both"></div>
							</div> 
							<div class="clearfix"></div>
							<?php
							if(empty($model->companyName)){ ?>
							 
							<p class="margin-bottom-2" style="margin-bottom:2px;white-space: nowrap;"><i class="fa fa-user"></i>   <?php echo $model->first_name;?> </p>
							<?php } ?> 
								<hr />
							<p class="margin-bottom-0  sal-dec"><?php echo CHtml::link($this->tag->getTag('sale','Sale').'('.(int)$total_rest['sale_total'].')',Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','dealer'=>$model->user_slug)),array('class'=>'sale_link'));?> ,    <?php echo CHtml::link($this->tag->getTag('rent','Rent').'('.(int)$total_rest['rent_total'].')',Yii::app()->createUrl('listing/index',array('sec'=>'property-for-rent','dealer'=>$model->user_slug)),array('class'=>'rent_link'));?></p>
							</div> 
					 -->
