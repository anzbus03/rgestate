<?php $section_name = empty($state) ? $country->country_name : $state->state_name ; ?>
<?php 
$href_url = '';
if(!empty($state)){
	$location['state']  =  $state->slug ;
	$href_url = '/state/'.$state->slug;
} 
else{
	$location['country']  =  $country->slug ;
	$href_url = '/country/'.$country->slug;
}

$apps = Yii::app()->apps;  $bg = true ; 
  ?>
    <div class="item homer">
               <?php
               if(!empty($new_developments)){ ?>
               <div class="container margin-top-0" id="">
                  <div class="row margin-bottom-40">
                     <div class="col-md-12">
                        <h3 class="headline  margin-bottom-5  col-md-12 no-margin-left  "> New Developments in <?php echo  $section_name;?> </h3>
                     </div>
                     <div class="col-md-12 seperate_mar">
                        <div class="_ba2wq3">
						   <?php
						  
						   foreach($new_developments as $k=>$v){
							$mod_value =     $k%4 ;
							switch($mod_value){
								case '0':
								$color =  'A52B03';
								break;
								case '1':
								$color =  '734F21';
								break;
								case '2':
								$color =  '231341';
								break;
								case '3':
								$color =  '441A05';
								break;
								default:							 
								$color =  '517537';
								break;
							}
							 $s_id ="new_item1".$v->id ; 
						    ?> 
                           <!-- Listing Item -->
                              <div class="item_ko col-sm-3 ajaxLoaded2 mul_sliderh " id="<?php echo $s_id;?>">
                              <div class="arws"></div>  <div class="dots"></div>
                              <a href="<?php echo $v->detailUrl;?>" class="listing-item-container"  target="_blank" >
                                 <div class="listing-item">
                                    <button data-test-id="CardSaveButton" class="saveHome pam hoverPulse typeReversed  <?php echo !empty($v->fav) ?  'active' : '';?>" aria-label="Save Home" id="fav_button_<?php echo $v->id;?>" onclick="<?php if($this->app->user->getId()){ echo 'event.preventDefault();savetofavourite(this)'; }else{ echo 'event.preventDefault();OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $v->primaryKey;?>"  data-after="saved_fave"  data-reactid="<?php echo $v->id;?>">
                                    <span><?php if(!empty($v->fav) ){ echo '<i class="iconHeart active  typeReversed iconOnly" ></i>'; } else{ echo '<i class="iconHeartEmpty typeReversed iconOnly" ></i>';} ?></span>
                                    </button>

                                    <div class="single-item-hover"></div>
                                    <div class='single-item' >
                                    <?php echo $v->generateImage($apps,$h=190,$w=285,$s_id,$bg);?> 
                                    </div>
                                    <!--<span class="like-icon"></span>--> 
                                 </div>
                                 <div class="listing-item-content spanfont">
                                    <h5 style="color: #<?php echo $color;?> !important;"><?php echo $v->category_name ;?> <?php if(!empty($v->community_name)){ echo '. '.$v->community_name; } ?> </h5>
                                    <h3><?php echo $v->ad_title;?></h3>
                                 </div>
                              </a>
                           </div>
                           <?php } ?> 
                           <!-- Listing Item / End --> 
                            <div class="clearfix"></div>
                        </div>
                        <div class="_ttoj70 s_all">
                           <a type="button" class="_3uc7cf" href="<?php echo $this->app->createUrl('new-development');?><?php echo $href_url;?>" aria-busy="false">
                              <span class="_e4n64j">Show all  </span>
                              <div class="_s2tar8">
                                 <svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 10px; width: 10px; fill: currentcolor;">
                                    <path d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z" fill-rule="evenodd"></path>
                                 </svg>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?> 
               <?php
               if(!empty($new_homes) or !empty($new_properties_forrent)){ ?> 
               <div class="container margin-top-0" id=""  >
				  <?php
				  if(!empty($new_homes)){
					 $class_n = 'for_sale_p'; $s_class_n = 'col-sm-6';
					if(empty($new_properties_forrent)){ $class_n = ''; $s_class_n = 'col-sm-3'; } 
				   ?>
                  <div class="row margin-bottom-40 <?php echo  $class_n;?>"   >
                     <div class="col-md-12 seperate_mar2"  >
                        <h3 class="headline  margin-bottom-5  col-md-12 no-margin-left  "> New Properties For Sale in <?php echo  $section_name;?> </h3>
                     </div>
                     <div class="col-md-12 seperate_mar"  >
                        <div class="_ba2wq3">
                           <!-- Listing Item -->
                           <?php
                           foreach($new_homes as $k=>$v){ 
							$mod_value =     $k%4 ;
							switch($mod_value){
								case '0':
								$color =  'A52B03';
								break;
								case '1':
								$color =  '734F21';
								break;
								case '2':
								$color =  '231341';
								break;
								case '3':
								$color =  '441A05';
								break;
								default:							 
								$color =  '517537';
								break;
							}
							$s_id ="sale_item1".$v->id ; 
						    ?>    
                           <div class="item_ko  mul_sliderh ajaxLoaded2 <?php echo $s_class_n;?>" id="<?php echo $s_id;?>">
                              <div class="arws"></div><div class="dots"></div>
                              <a href="<?php echo $v->detailUrl;?>" class="listing-item-container"  target="_blank"  >
                                 <div class="listing-item">
                                    <button data-test-id="CardSaveButton" class="saveHome pam hoverPulse typeReversed  <?php echo !empty($v->fav) ?  'active' : '';?>" aria-label="Save Home" id="fav_button_<?php echo $v->id;?>" onclick="<?php if($this->app->user->getId()){ echo 'event.preventDefault();savetofavourite(this)'; }else{ echo 'event.preventDefault();OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $v->primaryKey;?>"  data-after="saved_fave"  data-reactid="<?php echo $v->id;?>">
                                    <span><?php if(!empty($v->fav) ){ echo '<i class="iconHeart active  typeReversed iconOnly" ></i>'; } else{ echo '<i class="iconHeartEmpty typeReversed iconOnly" ></i>';} ?></span>
                                    </button>
                                    <div class="single-item-hover"></div>
                                    <div class='single-item' >
                                    <?php echo $v->generateImage($apps,$h=190,$w=285,$s_id,$bg);?> 
                                    </div>
                                      <span class="block_tag for_sale_tag">Sale</span>
                                    <!--<span class="like-icon"></span>--> 
                                 </div>
                                 <div class="listing-item-content spanfont">
                                    <h5 style="color: #<?php echo $color;?>;"><?php echo $v->category_name ;?> <?php if(!empty($v->community_name)){ echo '. '.$v->community_name; } ?> </h5>
                                    <h3><?php echo$v->getShortName(30);?></h3>
                                 </div>
								<div data-reactid="61">
								<ul class="listInline typeTruncate mvn" data-reactid="62">
								<li data-auto-test="sqft" data-reactid="" class="_doc79r" ><?php echo $v->PriceTitleSpan;?></li>
								<?php
								if(!empty($v->bedrooms)){ ?>
								<li data-auto-test="beds" data-reactid="">  <i class="fas fa-bed" data-reactid=""></i><?php echo $v->BedroomTitle;?></li>
								<?php } ?>
								<?php
								if(!empty($v->bathrooms)){ ?>
								<li data-auto-test="baths" data-reactid=""><i class="fas fa-bath" data-reactid=""></i><?php echo $v->BathroomTitle;?></li>
								<?php } ?> 
								</ul>
								</div>
                              </a>
                           </div>
                           <?php } ?> 
                           <!-- Listing Item / End --> 
                          
                        </div>
                        <div class="_ttoj70 s_all" >
                           <a type="button" class="_3uc7cf" href="<?php echo $this->app->createUrl('property-for-sale');?><?php echo $href_url;?>" aria-busy="false">
                              <span class="_e4n64j">Show all  </span>
                              <div class="_s2tar8">
                                 <svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 10px; width: 10px; fill: currentcolor;">
                                    <path d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z" fill-rule="evenodd"></path>
                                 </svg>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <?php
				  if(!empty($new_properties_forrent)){
					 $class_n = 'for_sale_p1'; $s_class_n = 'col-sm-6';
					if(empty($new_homes)){ $class_n = ''; $s_class_n = 'col-sm-3'; }   
				   ?> 
                  <div class="row margin-bottom-40 <?php echo $class_n;?>"    >
                     <div class="col-md-12 seperate_mar2"  >
                        <h3 class="headline  margin-bottom-5  col-md-12 no-margin-left  "> New Properties For Rent in <?php echo  $section_name;?> </h3>
                     </div>
                     <div class="col-md-12 seperate_mar" >
                        <div  class="_ba2wq3">
                           <!-- Listing Item -->
                           <?php
                           foreach($new_properties_forrent as $k=>$v){ 
							$mod_value =     $k%4 ;
							switch($mod_value){
								case '0':
								$color =  'A52B03';
								break;
								case '1':
								$color =  '734F21';
								break;
								case '2':
								$color =  '231341';
								break;
								case '3':
								$color =  '441A05';
								break;
								default:							 
								$color =  '517537';
								break;
								 
							}
							 $s_id ="rent_item1".$v->id ; 
						    ?>    
                            <div class="item_ko ajaxLoaded2 mul_sliderh   <?php echo $s_class_n;?>"  id="<?php echo $s_id;?>">
                          <div class="arws"></div> <div class="dots"></div>
                              <a href="<?php echo $v->detailUrl;?>" class="listing-item-container"  target="_blank" >
                                 <div class="listing-item">
                                    <button data-test-id="CardSaveButton" class="saveHome pam hoverPulse typeReversed  <?php echo !empty($v->fav) ?  'active' : '';?>" aria-label="Save Home" id="fav_button_<?php echo $v->id;?>" onclick="<?php if($this->app->user->getId()){ echo 'event.preventDefault();savetofavourite(this)'; }else{ echo 'event.preventDefault();OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $v->primaryKey;?>"  data-after="saved_fave"  data-reactid="<?php echo $v->id;?>">
                                    <span><?php if(!empty($v->fav) ){ echo '<i class="iconHeart active  typeReversed iconOnly" ></i>'; } else{ echo '<i class="iconHeartEmpty typeReversed iconOnly" ></i>';} ?></span>
                                    </button>

                                     									<div class="single-item-hover"></div>
									<div class='single-item' >
									<?php echo $v->generateImage($apps,$h=190,$w=285,$s_id,$bg);?> 
									</div>                                   <span class="block_tag for_rent_tag">Rent</span>

                                   <span class="block_tag for_rent_tag">Rent</span>
                                    <!--<span class="like-icon"></span>--> 
                                 </div>
                                 <div class="listing-item-content spanfont">
                                    <h5 style="color: #<?php echo $color;?> !important;"><?php echo $v->category_name ;?> <?php if(!empty($v->community_name)){ echo '. '.$v->community_name; } ?> </h5>
                                    <h3><?php echo $v->getShortName(30);?></h3>
                                 </div>
								<div data-reactid="61">
								<ul class="listInline typeTruncate mvn" data-reactid="62">
								<li data-auto-test="sqft" data-reactid="" class="_doc79r" ><?php echo $v->PriceTitleSpan;?></li>
								<?php
								if(!empty($v->bedrooms)){ ?>
								<li data-auto-test="beds" data-reactid="">  <i class="fas fa-bed" data-reactid=""></i><?php echo $v->BedroomTitle;?></li>
								<?php } ?>
								<?php
								if(!empty($v->bathrooms)){ ?>
								<li data-auto-test="baths" data-reactid=""><i class="fas fa-bath" data-reactid=""></i><?php echo $v->BathroomTitle;?></li>
								<?php } ?> 
								</ul>
								</div>
                              </a>
                           </div>
                           <?php } ?> 
                           <!-- Listing Item / End --> 
                          
                        </div>
                        <div class="_ttoj70 s_all" >
                           <a type="button" class="_3uc7cf" href="<?php echo $this->app->createUrl('property-for-rent');?><?php echo $href_url;?>" aria-busy="false">
                              <span class="_e4n64j _for_rent_a">Show all  </span>
                              <div class="_s2tar8">
                                 <svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 10px; width: 10px; fill: currentcolor;color:#008489;">
                                    <path d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z" fill-rule="evenodd"></path>
                                 </svg>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               
				  <?php } ?> 
               </div>
               <?php } ?> 
               
               <?php
               if(!empty($featured_developments)){
				   ?>
				     <div class="container margin-top-40" id="">
				   <div class="row  margin-bottom-40">
                     <div class="col-md-12">
                        <h3 class="headline  margin-bottom-5  col-md-12 no-margin-left  "> Featured Developments in <?php echo  $section_name;?> </h3>
                     </div>
                     <div class="col-md-12 seperate_mar">
                        <div class="margin-bottom-40 new_developments featured">
							  <div  class="_ba2wq3">
                           <!-- Listing Item -->
                           <?php
                           foreach($featured_developments as $k=>$v){
							
							$mod_value =     $k%4 ;
							switch($mod_value){
								case '0':
								$color =  '517537';
								break;
								case '1':
								$color =  '4d53a7';
								break;
							 
								case '2':
								$color =  'f16678';
								break;
								default:							 
								$color =  '517537';
								break;
							}   
							 $s_id ="feat_item1".$v->id ; 
						   ?>    
                                <div class="item_ko col-sm-4  ajaxLoaded2 mul_sliderh"  id="<?php echo $s_id;?>">
                            <div class="arws"></div>  <div class="dots"></div>
                              <a href="<?php echo $v->detailUrl;?>" class="listing-item-container"  target="_blank"  >
                                 <div class="listing-item">
                                <button data-test-id="CardSaveButton" class="saveHome pam hoverPulse typeReversed  <?php echo !empty($v->fav) ?  'active' : '';?>" aria-label="Save Home" id="fav_button_<?php echo $v->id;?>" onclick="<?php if($this->app->user->getId()){ echo 'event.preventDefault();savetofavourite(this)'; }else{ echo 'event.preventDefault();OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $v->primaryKey;?>"  data-after="saved_fave"  data-reactid="<?php echo $v->id;?>">
                                <span><?php if(!empty($v->fav) ){ echo '<i class="iconHeart active  typeReversed iconOnly" ></i>'; } else{ echo '<i class="iconHeartEmpty typeReversed iconOnly" ></i>';} ?></span>
                                </button>
							<div class="single-item-hover"></div>
							<div class='single-item' >
							<?php echo $v->generateImage($apps,$h=198,$w=385,$s_id,$bg);?> 
							</div>             <!--<span class="like-icon"></span>--> 

								     <!--<span class="like-icon"></span>--> 
                                 </div>
                                 <div class="listing-item-content spanfont">
									<h5 style="color: #<?php echo $color;?> !important;"><?php echo $v->category_name ;?> <?php if(!empty($v->community_name)){ echo '. '.$v->community_name; } ?> </h5>
									<h3><?php echo $v->ad_title;?></h3>

                                    <div style="margin-bottom: 8px;"><div class="_wbsbxz"><div class="_12n1ibqr"><span class="_1jj7gf6"><?php echo $v->ShortDescription;?></span></div></div></div>
                                 </div>
                              </a>
                           </div>
                          <?php } ?> 
                             </div>
                           <!-- Listing Item / End --> 
                          
                        </div>
                      </div>
                  </div>
				   
				   </div>
				   <?
			   }
               ?>
               <?php
               if(!empty($property_of_featured_developers)){ ?>
               <div class="container margin-top-40" id="">
                  <div class="row margin-bottom-40">
                     <div class="col-md-12">
                        <h3 class="headline  margin-bottom-5 col-md-12 no-margin-left"> Featured Developers in <?php echo  $section_name;?> </h3>
                     </div>
                     <div class="col-md-12">
                        <div>
                           <!-- Listing Item -->
                           <?php
                           foreach($property_of_featured_developers as $k=>$v){ ?>
                           <div class="item_ko_50 col-sm-12 col-md-6">
                              <span class="listing-item-container">
                                 <div class="listing-item spansizeimg">
									<?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
									<a href="<?php echo $v->detailUrl;?>">
                                    <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=300&w=489&zc=1" alt="">
                                  </a>
									 </div>
									 <div class="developer_logo">
									 <?php   $image = $this->app->apps->getBaseUrl('uploads/resized/'.$v->image);?>
                                    <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=50&zc=1" alt="">
                                  
									 </div>
                                 <div class="listing-item-content spanfont">
                                    <h5 style="color: #F15B61; font-family: 'Roboto', sans-serif;"><a  style="color:#F15B61 !important;text-transform:none !important;" href="<?php echo $v->DeveloperDetailUrl;?>" >Show all properties</a> </h5>
                                    <h3><a href="<?php echo $v->detailUrl;?>"><?php echo $v->ad_title;?> </a></h3>
                                 </div>
                              </span>
                           </div>
                           <?php } ?>
                          
                           <!-- Listing Item / End --> 
                           <!-- Listing Item -->
                        
                           <!-- Listing Item / End --> 
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>
               <?php
               if(!empty($featured_developers)){ ?> 
               <section class="fullwidth    padding-bottom-0 list_developers" id="">
                  <div class="container">
                     <div class="row  margin-bottom-40">
                        <div class="col-md-12">
                           <h3 class="headline  margin-bottom-13  col-md-12 no-margin-left"> Featured Developers in <?php echo  $section_name;?>  </h3>
                        </div>
                        <div class="col-md-12" style="position:relative;"> 
                        
                        <div style="position: absolute;width: 100vw;height: 90px;background: #272727;left: 84px;right: -50px;margin-left: -50vw;left: 50%;"></div>
                        <div class="_ba2wq3">
                           <div class="simple-slick-carousel0 dots-nav spandots col-md-12" style="margin-bottom: 0px;border-right:1px solid #506663; ">
							   
							  <?php 
							  foreach($featured_developers as $k=>$v){ ?> 
								 
                              <!-- Listing Item -->
                              <div class="carousel-item" title="<?php echo $v->first_name;?>" style="border-left:1px solid #506663; "> <a href="<?php echo $v->DeveloperDetailUrl;?>"  target="_blank"   >
								   <?php 
								    $im = !empty($v->transparent) ? $v->transparent : $v->image; 
								   $image = $this->app->apps->getBaseUrl('uploads/resized/'.$im);?> 
                                 <div class="listing-item "  style="height:70px; background-image:url('<?php echo $image;?>');background-repeat: no-repeat;background-position: center; background-size:contain " >
									 
                                 
                                    <div class="listing-item-content spansec033">
                                
                                    </div>
                                 </div></a>
                              </div>
                              <!-- Listing Item / End --> 
                             <?php } ?>  </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
               <?php } ?> 
            </div>
        <script > $(function(){  caroselSingleAfter(); })</script>