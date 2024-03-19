<?php
foreach($works as $k=>$v){
	?>
	 <li class="t-Cards-item ajaxLoaded #CARD_MODIFIERS#">
                     <div class="t-Card">
                        <div class="t-Card-wrap">
                           <div class="t-Card-icon u-color hide"><span class="t-Icon fa #CARD_ICON#"><span class="t-Card-initials" role="presentation">#CARD_INITIALS#</span></span></div>
                           <div class="t-Card-titleWrap">
                              <h3 class="t-Card-title"  style="height:136px !important"><a href="<?php echo $v->developerDetailUrl;?>" title="<?php echo $v->fullName;?>">
                              <a href="<?php echo $v->developerDetailUrl;?>" title="<?php echo $v->fullName;?>"> 
                                <?php
								$image = $this->app->apps->getBaseUrl('uploads/resized/'.$v->image);?>
				
                              <img src="<?php echo $image;?>">
                            
                              
                                 </a>
                              </h3>
                           </div>
                           <div class="t-Card-body">
                              <div class="t-Card-desc" style="height:200px;">
                                 <h3><?php echo $v->CompanyName;?></h3>
                                 <p><span itemprop="description"><?php echo $v->getShortDescription(150);?></span></p>
 
                              </div>
                              <div class="t-Card-info"><a href="<?php echo $v->developerDetailUrl;?>" title="View Projects" class="t-Button t-Button--icon t-Button--iconLeft">View Projects <span aria-hidden="true" class="t-Icon t-Icon--left fa fa-angle-right"></span></a></div>
                           </div>
                           <span class="t-Card-colorFill u-color hide"></span>
                        </div>
                     </div>
                  </li>
					
	
 
	<?
}
