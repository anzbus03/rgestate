       <div class="container margin-top-40">
            <div class="row">.
                <div class="col-md-12">
                    <div>

                        <!-- Listing Item -->
                        <?php
                        $apps = Yii::app()->apps;$bg =true; 
                        foreach($works as $k=>$v){
							$mod_value =     $k%4 ;
							switch($mod_value){
									case '0':
								$color =  'A52B03';
								break;
								case '1':
								$color =  '734F21';
								break;
								case '2':
								$color =  '39577C';
								break;
								case '3':
								$color =  '441A05';
								break;
								default:							 
								$color =  '517537';
								break;
							}
							 $s_id ="list_item".$v->id ; 
						    ?> 	
                        <div class="col-sm-3 ajaxLoaded2 mul_sliderh" id="<?php echo $s_id;?>"> 
                         <div class="arws"></div>  <div class="dots"></div> 
                          
                        
                        <a href="<?php echo $v->detailUrl;?>" class="listing-item-container">
                            <div class="listing-item"> 
								                                                     <button data-test-id="CardSaveButton" class="saveHome <?php echo !empty($v->fav) ?  'active' : '';?> pam   typeReversed" aria-label="Save Home" id="fav_button_<?php echo $v->id;?>" onclick="<?php if($this->app->user->getId()){ echo 'event.preventDefault();savetofavourite(this)'; }else{ echo 'event.preventDefault();OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $v->primaryKey;?>"  data-after="saved_fave"  data-reactid="<?php echo $v->id;?>">
                                                            <span><?php if(!empty($v->fav) ){ echo '<i class="iconHeart  typeReversed iconOnly" ></i>'; } else{ echo '<i class="iconHeartEmpty typeReversed iconOnly" ></i>';} ?></span>
                                                            <i class="descsss"><?php echo !empty($v->fav) ?  'Saved' : 'Save';?></i>
                                                            </button>
                                                           
								 								<div class="single-item-hover"></div>
								<div class='single-item' >
								<?php echo $v->generateImage($apps,$h=200,$w=269,$s_id,$bg);?> 
								</div>

                                <!--<span class="like-icon"></span>-->
                            </div>
                            <div class="listing-item-content spanfont">
                                <h5 style="color: #<?php echo $color;?> !important;"><?php echo $v->category_name ;?> <?php if(!empty($v->community_name)){ echo '. '.$v->community_name; } ?></h5>
                                <h3><?php echo $v->ad_title;?></h3>
                            </div>
                            	<div data-reactid="61">
								<ul class="listInline typeTruncate mvn" data-reactid="62">
								<li data-auto-test="sqft" data-reactid="" class="_doc79r" ><?php echo $v->PriceTitleSpan;?></li>
								<?php
								if(!empty($v->bedrooms)){ ?>
								<li data-auto-test="beds" data-reactid="">  <i class="fas fa-bed" data-reactid=""></i> <?php echo $v->BedroomTitle;?></li>
								<?php } ?>
								<?php
								if(!empty($v->bathrooms)){ ?>
								<li data-auto-test="baths" data-reactid=""><i class="fas fa-bath" data-reactid=""></i> <?php echo $v->BathroomTitle;?></li>
								<?php } ?> 
								</ul>
								</div>
                        </a>
                              <nav class="navbar navbar-fixed-left navbar-minimal animate" role="navigation"  >
		<div class="navbar-toggler " onclick="openShareButtons(this,event)">
			<span class="menu-icon"></span>
		</div>
		<ul class="navbar-menu    " style="padding:0px;margin:0px;" >
			<li>
				<a href="http://www.facebook.com/sharer.php?u=<?php echo $v->DetailUrlAbsolute;?>&p[title]=<?php echo $v->ad_title;?>;?>"  onclick="windowOpenNew(this,event)" class="animate">
					<span class="desc animate"> Facebook </span>
					<span class="fa fa-facebook"></span>
				</a>
			</li>
			<li>
				<a href="http://twitter.com/share?text=<?php echo $v->ad_title;?>&url=<?php echo $v->DetailUrlAbsolute;?>" class="animate"   onclick="windowOpenNew(this,event)"  >
					<span class="desc animate"> Twitter</span>
					<span class="fa fa-twitter"></span>
				</a>
			</li>
			<li>
				<a href="https://plus.google.com/share?url=<?php echo $v->DetailUrlAbsolute;?>" class="animate"  onclick="windowOpenNew(this,event)" >
					<span class="desc animate"> Google+ </span>
					<span class="fa fa-google-plus"></span>
				</a>
			</li>
		</ul>
	</nav>
                        </div>
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
                      <div class="col-sm-6"> <span class="listing-item-container">
                        <div class="listing-item spansizeimg"> 
							<a href="<?php echo $v->detailUrl;?>"><?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
                                    <img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=300&w=491&zc=1" alt="">
                                  </a>
							 </div>
                        <div class="listing-item-content spanfont">
                          <h5 style="color: #F15B61; font-family: 'Roboto', sans-serif;"><a  style="color:#F15B61 !important;text-transform:none !important;" href="<?php echo $v->DeveloperDetailUrl;?>" >Show all properties</a></h5>
                          <h3><a href="<?php echo $v->detailUrl;?>"><?php echo $v->ad_title;?></a></h3>
                        </div>
                      </span> </div>
                      <?php } ?> 
                      <!-- Listing Item / End --> 
                      <!-- Listing Item -->
                       
                      <!-- Listing Item / End --> 

                    
                </div>
            </div>
        </div>

		   <?
	   }
 
     
