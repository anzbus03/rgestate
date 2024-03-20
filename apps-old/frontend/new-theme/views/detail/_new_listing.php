<?php 
$order = '';
$order .= '  t.id desc    ' ; $apps= Yii::app()->apps;
$new_listing = PlaceAnAd::model()->findAds(array('sort'=>'custom','custom_order'=>$order,'_state_id'=>''),false,false,false,false);
if(!empty($new_listing)){?>
    <div class="col-md-12" style="">
         <div class="container topBSafeer">
            <div class="row">
               <h3 class="margin-top-40"><?php echo 'New Listings' ;?> </h3>
               <h5 style="margin-top: 0px;"><?php $model->state_name;?></h5>
               <div class="simple-slick-carousel0 dots-nav spandots" style="margin-bottom: 0px;margin-left:-8px;margin-right:8px;">
                 <?php 
                  foreach($new_listing  as $k=>$v){		  $s_id = "ecomwerended_item".$v->id ;  
							  ?> 
                                         <div class="carousel-item featured_pro item_ko_100 mul_sliderh featred_p" id="<?php echo $s_id;?>" style="position:relative;" >
                                 <div class="arws"></div> 
                                    <button data-test-id="CardSaveButton" class="saveHome pam hoverPulse typeReversed  <?php echo !empty($v->fav) ?  'active' : '';?>" aria-label="Save Home" id="fav_button_<?php echo $v->id;?>" onclick="<?php if($this->app->user->getId()){ echo 'event.preventDefault();savetofavourite(this)'; }else{ echo 'event.preventDefault();OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $v->primaryKey;?>"  data-after="saved_fave"  data-reactid="<?php echo $v->id;?>">
                                    <span><?php if(!empty($v->fav) ){ echo '<i class="iconHeart active  typeReversed iconOnly" ></i>'; } else{ echo '<i class="iconHeartEmpty typeReversed iconOnly" ></i>';} ?></span>
                                    </button>
                                      <div class="kkNHOn"><a href="<?php echo $v->detailUrl;?>" style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;z-index: 115"></a> 
                                 <div class="listing-item">   <div class="tagsListContainer"  ><ul class="tagList tags listInlineBulleted man h7 typeEmphasize"><?php echo $v->getTagList('F');?></ul></div>
                                    
                                    	<div class="single-item-hover"></div>
								<div class='single-item' >
									<?php $bg= false;  echo $v->generateImage($apps,$h=380,$w=570,$s_id,$bg);?> 
								</div>
							 
								<?php
									if(!empty($v->ad_images_g)){
								//	echo "<script>$(document).ready(function(){ caroselSingle('".$s_id."',{$bg});});</script>";
									}
									?>
                                       
                                   
                                 </div>
									<div class="residential-card__content-wrapper" role="presentation">
									   <div class="residential-card__content" role="presentation">
										  <div>
											 <div class="residential-card__price rui-truncate" role="presentation"><?php echo $v->listRow1();?></div>
											
										  </div>
                                        <div>
                                        <?php echo $v->listRow3();?>
                                        </div>
                                        <?php echo $v->listRow2();?>
									   </div>
									  
									</div>
                              </div>  
                       
										
							
							 
                                </div>
							 
                       
                              <?php  } ?>
               </div>
            </div>
         </div>
      </div>
<?php } ?>   
