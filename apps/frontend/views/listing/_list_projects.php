<?php
                        foreach($works as $k=>$v){
						    ?> 	
                          <li class="t-Cards-item"  >
                           <div class="t-Card">
                              <div class="t-Card-wrap">
                                 <div class="t-Card-icon u-color hide"><span class="t-Icon fa #CARD_ICON#"><span class="t-Card-initials" role="presentation">#CARD_INITIALS#</span></span></div>
                                 <div class="t-Card-titleWrap">
                                    <h3 class="t-Card-title">
                                       <div class="project_title"><?php echo $v->adTitle;?> </div>
                                       <div style="position: relative;" class="promage">
                                          <a href="<?php echo $v->detailUrl;?>">
											  
											<?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
											<img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=250&w=554&zc=1" title="<?php echo $v->AdTitle;?>"  alt="">
													</a>
                                          <!--<div class="gallery-container"> Gallery 
                                             ImageImageImageImageImageImageImageImageImageImage</div>-->
                                          <div>
                                             <!--<div class="p_price">
                                                AED <span itemprop="price" content="24465">#PRICE#</span><meta itemprop="priceCurrency" content="AED"> <span style="display:none;"><span style="font-weight:normal;color:#ccc">&nbsp; | &nbsp;</span><span style="font-size:1.5rem"> AED 35 <span style="font-weight:normal;">per Sqft</span></span></span>
                                                </div>-->
                                          </div>
                                       </div>
                                    </h3>
                                 </div>
                                 <div class="t-Card-body" style="border-top:0px;">
                                    <div class="t-Card-desc">
                                       
                                       <div style="position: relative;" class="pro_info">
                                          <h3 style="" class="location_name">Located in <a href="javascript:void(0)" target="_blank" style="font-size: 16px;line-height: 24px;"><?php echo $v->locationTitle;?></a></h3>
                                          <div class="developer_img">
                                             <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                                <div class="flipper">
                                                   <div class="front">
                                                      <div class="img-wrap">
                                                         <!--<div class="thumb_img" style="background-image:url(&#x2F;property&#x2F;realestate-developer&#x2F;emaar-properties-2.png);">-->
                                                         <div class="thumb_img" style="background-color:#eee;">
															 <?php
								$image = $this->app->apps->getBaseUrl('uploads/resized/'.$v->user_image);?>
				
                              <img src="<?php echo $image;?>">
                                                            <!--<a href="&#x2F;real-estate-developers-in-dubai&#x2F;emaar-properties">--> <!--</a>-->
                                                         </div>
                                                      </div>
                                                      <div class="name_title hidden" style="color:#404040;">
                                                         <!--<a href="&#x2F;real-estate-developers-in-dubai&#x2F;emaar-properties">-->By  <?php echo $v->UserName;?><!--</a>-->
                                                      </div>
                                                   </div>
                                                   <div class="back">
                                                      <div class="img-wrap">
                                                         <!--<div class="thumb_img" style="background-image:url(&#x2F;property&#x2F;realestate-developer&#x2F;emaar-properties-2.png);">-->
                                                         <div class="thumb_img back_dev_name" style="justify-content: center;">
                                                            <div>
                                                               <span style="display:block;font-size: 1.4rem;padding: 0px 10px;line-height: 1.3rem;"><?php echo $v->UserName;?>   </span>
                                                               <a href="#" style="font-size:1.2rem;display:none">View all Projects</a>  
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <!--<div class="name_title">
                                                         <a href="&#x2F;real-estate-developers-in-dubai&#x2F;emaar-properties">By Emaar</a>
                                                         </div>-->
                                                   </div>
                                                </div>
                                                <!-- End flipper -->
                                             </div>
                                             <!-- End flip-container -->
                                          </div>
                                          <div>
                                             <!-- #EXTRA_INFO# -->
                                          </div>
                                       </div>
                                    </div>
                                    <div class="t-Card-info">
                                       <div style="clear:both;margin-top:5px;">
                                          <div style="float: right;font-size:18px;">  
                                             <a class="t-Button t-Button--icon t-Button--hot t-Button--small t-Button--primary t-Button--iconRight" href="<?php echo $v->detailUrl;?>">
                                             <span aria-hidden="true" class="fa fa-info-circle" style="font-size: 19px;"></span> <span class="icon_title">Details</span>
                                             </a>    
                                             <a href="<?php echo $v->detailUrl;?>" title="Map" class="t-Button t-Button--icon t-Button--hot t-Button--small t-Button--primary t-Button--iconRight" style="font-size:12px;">
                                             <span aria-hidden="true" class="fa fa-map-marker"></span> <span class="icon_title">Map</span> </a>
                                             <a href="<?php echo $v->detailUrl;?>" title="Floor Plans" class="t-Button t-Button--icon t-Button--hot t-Button--small t-Button--primary t-Button--iconRight" style="font-size:12px;">
                                             <span aria-hidden="true" class="fa fa-fit-to-size"></span> <span class="icon_title">Floor Plans</span> </a>
                                          <div class="clearfix"></div>
                                          </div><div class="clearfix"></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li> 
                   
                        <?php
                        } 
                        ?> 
