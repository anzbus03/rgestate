 <ul class="t-Cards t-Cards--featured t-Cards--4cols t-Cards--animRaiseCard" id="R970151010597278858_cards" style="padding-top:10px !important;">
	                 <?php
	                 foreach($featured_developers as $k=>$v){ 
						if($k==5){
							?>
							<li class="t-Cards-item extrainfo" style="width: 50%;    justify-content: center;">
							<div style="margin:65px auto;">Featured Developers</div>
							</li>
							<?
						} 
				      ?> 
                     <li class="t-Cards-item #CARD_MODIFIERS#">
                        <div class="t-Card">
                           <div class="t-Card-wrap">
                              <div class="t-Card-titleWrap">
                                 <h3 class="t-Card-title">
                                    <div style="height:120px;"><a href="<?php echo $v->developerDetailUrl;?>" class="top_dev_a">
										  <?php
										 $image = $this->app->apps->getBaseUrl('uploads/resized/'.$v->image);?>
										<span  style="background-image:url(<?php   echo  $image   ;?>);"></span>
 
										</a></div>
                                 </h3>
                              </div>
                              <div class="t-Card-body">
                                 <div class="t-Card-desc">-</div>
                                 <div class="t-Card-info">-</div>
                              </div>
                           </div>
                        </div>
                     </li>
                   <?php } ?> 
                  </ul>
                 
