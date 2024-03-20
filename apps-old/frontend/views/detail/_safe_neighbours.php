 <?php 
  $order = '';
 if(!empty($model->community_id)){
	 $order .= '  t.community_id = "'.$model->community_id.'" desc  , ' ; 
 }
 $order .= 't.state = "'.$model->state.'" desc' ;
 
 $neighbours = PlaceAnAd::model()->findAds(array('sort'=>'custom','custom_order'=>$order),false,false,false,false);
 if(!empty($neighbours)){ ?> 
 
 <div class="col-lg-12 col-md-6 sfNeighbour" style="padding-left: 0px;padding-right: 0px;">
         <div class="container">
            <div class="row">
               <h3 class="margin-top-40"> Safe Neighborhoods </h3>
               <h5 style="margin-top: 0px;"><?php echo $model->LocationTitle;?> </h5>
               <div class="simple-slick-carousel0 dots-nav spandots  " style="margin-bottom: 0px;margin-left:-8px;margin-right:8px;">
				 
                  <?php 
                  foreach($neighbours  as $k=>$v){ ?>
                  <!-- Listing Item -->
                  <div class="carousel-item">
                     <div class="item">
                        <div class="positionRelative clickable" data-reactid="26">
                           <div class="card backgroundBasic" data-reactid="27">
                             <button data-test-id="CardSaveButton" class="saveHome pam hoverPulse typeReversed  <?php if(!empty($v->fav) ){ echo 'active';}?>" aria-label="Save Home" id="fav_button_<?php echo $v->id;?>" onclick="<?php if($this->app->user->getId()){ echo 'event.preventDefault();savetofavourite(this)'; }else{ echo 'event.preventDefault();OpenSignUp(this)';}?>" data-function="save_favourite" data-id="<?php echo $v->primaryKey;?>"  data-after="saved_fave"  data-reactid="<?php echo $v->id;?>">
                              <span><?php if(!empty($v->fav) ){ echo '<i class="iconHeart  typeReversed iconOnly" ></i>'; } else{ echo '<i class="iconHeartEmpty typeReversed iconOnly" ></i>';} ?></span>
                              </button>
                                <nav class="navbar navbar-fixed-left navbar-minimal animate" role="navigation"  >
		<div class="navbar-toggler " onclick="openShareButtons(this,event)">
			<span class="menu-icon"></span>
		</div>
		<ul class="navbar-menu    " style="padding:0px;margin:0px;" >
			<li>
				<a href="http://www.facebook.com/sharer.php?u=<?php echo $v->DetailUrlAbsolute;?>&p[title]=<?php echo $v->ad_title;?>;?>"  onclick="windowOpenNew(this,event)" class="animate">
					<span class="desc animate"> Facebbok </span>
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
                               <div data-reactid="46">
                                 <a href="<?php echo $v->detailUrl;?>" class="tileLink" alt="345 W 58th St #11JK" rel="noopener" target="_blank" data-reactid="47">
                                    <div class="overlayContainer" data-reactid="48">
                                       <div class="cardPhoto backgroundPulse " style="height:180px;width:100%;" data-reactid="49">
                                          <picture data-reactid="50">
											   <?php   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->ad_image);?>
											<img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=180&w=358&zc=1" class="cardPhoto backgroundPulse " alt="<?php echo $model->adTitle;?>">
                                  
                                          </picture>
                                          <div class="tagsListContainer" data-reactid="53">
                                             <!-- react-text: 54 --><!-- /react-text --><!-- react-text: 55 --><!-- /react-text -->
                                          </div>
                                       </div>
                                    </div>
                                    <div class="css-pgsj16 man pts pbs phm h6 typeWeightNormal tileLink backgroundBasic">
                                       <div class="h5 man pan typeEmphasize noWrap typeTruncate"><?php echo $v->PriceTitleSpan;?></div>
                                       <ul class="listInline typeTruncate mvn" style="min-height: 22px;">
												<?php
												if(!empty($v->bedrooms)){ ?>
												<li>
												<i class="fas fa-bed"></i> <!-- react-text: 124 --><?php echo $v->BedroomTitle;?><!-- /react-text -->
												</li>
												<?php } ?>
												<?php
												if(!empty($v->bathrooms)){ ?>
												<li>
												<i class="fas fa-bath"></i> <?php echo $v->BathroomTitle;?>
												</li>
												<?php
												}
												if(!empty($v->builtup_area)){ ?> 
												<li data-auto-test="sqft" data-reactid=""><?php echo  $v->BuiltUpAreaTitle;?> </li>
												<?php } ?> <li></li>
                                       </ul>
                                       <div class="noWrap typeTruncate typeLowlight"><?php echo $v->adTitle;?></div>
                                       <div class="noWrap typeTruncate typeLowlight">
                                          <?php echo $v->locationTitle;?>
                                       </div>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <!-- Listing Item / End --> 
                  
               </div>
            </div>
         </div>
      </div>
     
<?php } ?> 
