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


  ?>
    <div class="item homer">
			<?php
			   if($featured_projects){ ?> 
               <section class="fullwidth  padding-top-40 padding-bottom-0" id="">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <h3 class="headline margin-bottom-0 col-md-12 no-margin-left"> Featured Project in <?php echo  $section_name;?> </h3>
                        </div>
                        <div class="col-md-12 col-sm-12">
                           <div class="simple-slick-carousel dots-nav spandots_01  " style="margin-bottom: 0px;">
                              <!-- Listing Item -->
                              <?php
                              foreach($featured_projects as $k=>$v){ ?> 
                              <div class="carousel-item featured_pro item_ko_100">
                                 <div class="listing-item spanimgsize">
									<?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
                                    <a href="<?php echo $v->detailUrl;?>" ><img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=300&w=1044&zc=1" alt=""></a>
                                    <div class="listing-item-content spansec01">
                                       <h3> <?php echo $v->ad_title;?>.
                                       </h3>
                                       <a href="<?php echo $v->detailUrl;?>" class="button">Explore Askaan Plus project</a> 
                                    </div>
                                 </div>
                              </div>
                              <?php 
                              }
                              ?> 
                              
                              <!-- Listing Item / End --> 
                              <!-- Listing Item --> 
                              <!-- Listing Item / End --> 
                              <!-- Listing Item --> 
                              <!-- Listing Item / End --> 
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
               <?php } ?> 
               <?php
               if(!empty($new_developments)){ ?>
               <div class="container margin-top-40" id="">
                  <div class="row">
                     <div class="col-md-12">
                        <h3 class="headline  margin-bottom-10  col-md-12 no-margin-left  "> New Developments in <?php echo  $section_name;?> </h3>
                     </div>
                     <div class="col-md-12 seperate_mar">
                        <div>
						   <?php
						  
						   foreach($new_developments as $k=>$v){
							$mod_value =     $k%4 ;
							switch($mod_value){
								case '0':
								$color =  '517537';
								break;
								case '1':
								$color =  '4d53a7';
								break;
								case '2':
								$color =  '485969';
								break;
								case '3':
								$color =  'f16678';
								break;
								default:							 
								$color =  '517537';
								break;
							}
						    ?> 
                           <!-- Listing Item -->
                           <div class="item_ko col-sm-3">
                              <a href="<?php echo $v->detailUrl;?>" class="listing-item-container">
                                 <div class="listing-item">
                                   <?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
                                    <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=175&w=218&zc=1" alt="">
                                   
                                    <!--<span class="like-icon"></span>--> 
                                 </div>
                                 <div class="listing-item-content spanfont">
                                    <h5 style="color: #<?php echo $color;?>;"><?php echo $v->category_name ;?> <?php if(!empty($v->community_name)){ echo '. '.$v->community_name; } ?> </h5>
                                    <h3><?php echo $v->ad_title;?></h3>
                                 </div>
                              </a>
                           </div>
                           <?php } ?> 
                           <!-- Listing Item / End --> 
                            
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
               if(!empty($new_homes)){ ?> 
               <div class="container margin-top-40" id="">
                  <div class="row">
                     <div class="col-md-12">
                        <h3 class="headline  margin-bottom-10  col-md-12 no-margin-left  "> New Properties in <?php echo  $section_name;?> </h3>
                     </div>
                     <div class="col-md-12 seperate_mar">
                        <div>
                           <!-- Listing Item -->
                           <?php
                           foreach($new_homes as $k=>$v){ 
							$mod_value =     $k%4 ;
							switch($mod_value){
								case '0':
								$color =  '517537';
								break;
								case '1':
								$color =  '4d53a7';
								break;
								case '2':
								$color =  '485969';
								break;
								case '3':
								$color =  'f16678';
								break;
								default:							 
								$color =  '517537';
								break;
							}
						    ?>    
                           <div class="item_ko col-sm-3">
                              <a href="<?php echo $v->detailUrl;?>" class="listing-item-container">
                                 <div class="listing-item">
                                    <?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
                                    <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=175&w=218&zc=1" alt="">
                                  
                                    <!--<span class="like-icon"></span>--> 
                                 </div>
                                 <div class="listing-item-content spanfont">
                                    <h5 style="color: #<?php echo $color;?>;"><?php echo $v->category_name ;?> <?php if(!empty($v->community_name)){ echo '. '.$v->community_name; } ?> </h5>
                                    <h3><?php echo $v->ad_title;?></h3>
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
               </div>
               <?php } ?> 
               <?php
               if(!empty($property_of_featured_developers)){ ?>
               <div class="container margin-top-40" id="">
                  <div class="row">
                     <div class="col-md-12">
                        <h3 class="headline  margin-bottom-10 col-md-12 no-margin-left"> Featured Developers in <?php echo  $section_name;?> </h3>
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
               <section class="fullwidth  padding-top-10 padding-bottom-0 list_developers" id="">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <h3 class="headline  margin-bottom-0  col-md-12 no-margin-left"> Featured Developers in <?php echo  $section_name;?>  </h3>
                        </div>
                        <div class="col-md-12">
                           <div class="simple-slick-carousel0 dots-nav spandots col-md-12" style="margin-bottom: 0px;">
							  <?php 
							  foreach($featured_developers as $k=>$v){ ?> 
								 
                              <!-- Listing Item -->
                              <div class="carousel-item"> <a href="<?php echo $v->DeveloperDetailUrl;?>">
								   <?php   $image = $this->app->apps->getBaseUrl('uploads/resized/'.$v->image);?>
                                 <div class="listing-item "  style="background-image:url( <?php   echo  $image   ;?>);background-size:cover; background-position: center;border:1px solid #eee; " >
									
                                 
                                    <div class="listing-item-content spansec033">
                                       <!--<h3>Homes in Dubai</h3>-->
                                       <!--<div class="_m7c9y" style="color: rgb(255, 180, 0);">
                                          <svg class="_6yl2zq" viewBox="0 0 87 5" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="currentColor" d="M85.84 2.324a660.672 660.672 0 0 0-13.71-.092 9.425 9.425 0 0 1 1.648.585c.374.174.685.63.57 1.252-.114.612-.53.734-.91.553-2.173-1.04-4.4-1.053-6.596-1.092l-7.08-.125c-4.72-.082-9.44-.16-14.16-.24-6.202-.103-12.405-.214-18.607-.318-1.889.043-3.777.087-5.665.132-6.029.146-12.054.352-18.084.483-.392.008-.574-.599-.453-.972l-1.684-.024C.658 2.459.548 1.45 1.006 1.454c5.186.04 10.372.077 15.557.111 6.243-.241 12.49-.418 18.738-.576C46.039.716 56.784.539 67.536.452 73.569.404 79.609.447 85.64.384c.35-.004.72.328.78.903.053.523-.23 1.044-.581 1.037"></path>
                                          </svg>
                                          </div>-->
                                    </div>
                                 </div></a>
                              </div>
                              <!-- Listing Item / End --> 
                             <?php } ?> 
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
               <?php } ?> 
            </div>
        
