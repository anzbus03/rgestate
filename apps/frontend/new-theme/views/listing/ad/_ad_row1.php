 <div class="margin-bottom-25" id="<?php echo $rw_ids;?>">
                   
                     <div class="">
                        <div class="col-md-12  padding-0">
						<?php 
						if(!empty($header)){
					 
							 ?> <h3 class="headline  <?php echo  empty($sub_header)? 'margin-bottom-20':'margin-bottom-0';?>   padding-left-0   col-md-12 no-margin-left  "> <?php echo $header; ?> </h3><?
						}
						else if(!empty($sub_header)) {
							 ?><h4 class="_eclbxd    margin-bottom-10  col-md-12 no-margin-left padding-left-0  "><?php echo $sub_header; ?></h4><?
						}
						?>
                        </div>
                        <div class="col-md-12 seperate_mar margin-0 padding-0 _add_row_1">
                           <div class="simple-slick-carousel dots-nav spandots_01  " style="margin-bottom: 0px;">
                              <!-- Listing Item -->
                              <?php
                              foreach($field  as $k=>$v){ ?> 
                              <div class="carousel-item   padding-0">
                                 <div class="listing-item spanimgsize">
									<?php   $image = $v->AdImage ;?>
                                    <a href="<?php echo $v->detailUrl;?>" ><img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=350&w=1189&zc=1" alt=""></a>
                                    <div class="listing-item-content spansec01">
                                       <h3 class="hidden"> <?php echo $v->adTitle;?>. </h3>
                                         
                                    </div>
                                 </div>
                              </div>
                              <?php 
                              }
                              ?> 
                             
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
 </div>
             
             
