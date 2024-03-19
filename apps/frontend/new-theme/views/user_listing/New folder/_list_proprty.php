       <div class="container margin-top-40">
            <div class="row">.
                <div class="col-md-12">
                    <div>

                        <!-- Listing Item -->
                        <?php
                        foreach($works as $k=>$v){
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
                        <div class="col-sm-3"> <a href="<?php echo $v->detailUrl;?>" class="listing-item-container">
                            <div class="listing-item"> 
								 <?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
                                <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=175&w=250&zc=1" alt="">
                                <!--<span class="like-icon"></span>-->
                            </div>
                            <div class="listing-item-content spanfont">
                                <h5 style="color: #<?php echo $color;?>;"><?php echo $v->category_name ;?> <?php if(!empty($v->community_name)){ echo '. '.$v->community_name; } ?></h5>
                                <h3><?php echo $v->ad_title;?></h3>
                            </div>
                        </a> </div>
                        <?php
                        } 
                        ?> 

                    </div>

                </div>
            </div>
        </div>
       <?php
       if(!empty($property_of_featured_developers)){
		   ?>
		   
        <div class="container margin-top-40" id="">
            <div class="row">
                <div class="col-md-12 margin-bottom-10">
                    
					<?php
					 foreach($property_of_featured_developers as $k=>$v){ ?> 
                      <!-- Listing Item -->
                      <div class="col-sm-6"> <a href="#" class="listing-item-container">
                        <div class="listing-item spansizeimg"> 
							<?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
                                    <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=300&w=491&zc=1" alt="">
                                  
							 </div>
                        <div class="listing-item-content spanfont">
                          <h5 style="color: #F15B61; font-family: 'Roboto', sans-serif;">2,000+ homes</h5>
                          <h3><?php echo $v->ad_title;?></h3>
                        </div>
                      </a> </div>
                      <?php } ?> 
                      <!-- Listing Item / End --> 
                      <!-- Listing Item -->
                       
                      <!-- Listing Item / End --> 

                    
                </div>
            </div>
        </div>

		   <?
	   }
 
     
