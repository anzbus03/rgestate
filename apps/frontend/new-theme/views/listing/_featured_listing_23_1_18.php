<?php 
$order	 	  = '';
$order		 .= '  t.id desc    ' ;
$category_idF =  '';
 $titleF =  '';
$links_open_in  = $this->options->get('system.common.link_open_in','S');	 
$new_listing = PlaceAnAd::model()->findAds(array('sort'=>'featured','custom_order'=>$order,'section_id'=>$_sec_id,'cat'=>array($category_idF)),false,false,false,false,'F');
if(!empty($new_listing)){?>
    <div class="col-lg-12 col-md-6 rmyror  loader-initiated fetaredSlider " id="featuredO"  >
		 
		<script>$(function(){ $('#featuredO').removeClass('loader-initiated'); })</script>
         <div class="">
			 
		
            <div class="row"  >
				<div class="ak_loader2"></div>
				<style>.ftred {color: #5c6872;font-weight: 600;font-size: 17px;}</style>
				<h3 class="ftred  margin-bottom-15  margin-top-15">Featured Properties <?php echo !empty($titleF ) ? 'for '.$titleF :''; ?></h3>
               <div class="simple-slick-carousel2 dots-nav spandots" style="margin-bottom: 0px;margin-left:-8px;margin-right:8px;"  >
                 <?php 
                  $apps = $this->app->apps;
                  $json_array = array();
                  foreach($new_listing  as $k=>$v){
					  $s_id ="featured_item".$v->id ; 
					   $json_array[] = $s_id;
					   ?>
                  <!-- Listing Item -->
                  <div class="carousel-item mul_sliderh frs" id="<?php echo $s_id;?>" style="position:relative;" >
                   <div class="arws"></div><div class="dots"></div>
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
                                 <a href="<?php echo $v->detailUrl;?>" class="tileLink" alt="" rel="noopener"  target="<?php echo $links_open_in=='N' ? '_blank':'_self';?>"  data-reactid="47">
                                    <div class="overlayContainer" data-reactid="48">
										  <div class="tagsListContainer"  ><ul class="tagList tags listInlineBulleted man h7 typeEmphasize"><?php echo $v->tagList;?></ul></div>
                                       <div class="cardPhoto backgroundPulse " style="width:100%;" data-reactid="49">
                                          
											<div class="single-item-hover"></div>
											<div class='single-item' >
											<?php  echo $v->generateImage($apps,$h=380,$w=570,$s_id,1);?> 
											</div>
											<?php
											if(!empty($v->ad_images_g)){
										  
											}
											?>
                                           <?php echo $v->SectionBanner;?>
                                          <div class="tagsListContainer" data-reactid="53">
                                             <!-- react-text: 54 --><!-- /react-text --><!-- react-text: 55 --><!-- /react-text -->
                                          </div>
                                       </div>
                                    </div>
                                    <div class="css-pgsj16 man pts pbs phm h6 typeWeightNormal tileLink backgroundBasic">
                                       <div class="h5 man pan typeEmphasize noWrap typeTruncate"> <span class="pull-right spanfonth5"><?php echo $v->category_name ;?></span> <?php echo $v->PriceTitleSpan;?></div>
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
                                       <div class="noWrap typeTruncate typeLowlight"><?php echo $v->adTitle2;?></div>
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
               </div>
            </div>
         </div>
      </div>
<?php } ?>
<style>.simple-slick-carousel2 .slick-prev.slick-arrow{ display:none; } .single-item img{ height:100%; width:100%; }</style>   
<script> var jsA = <?php echo json_encode($json_array);?>; var  featuredCount = '<?php echo sizeOf($new_listing)-1;?>';var  total_show = '<?php echo $total_slide_show;?>'; $(function(){ 
	 featuredSlider(featuredCount,total_show); }) 
	 
	 $(document).ready(function(){
		 
		   $.each(jsA,function(k,v){   caroselSingle(v,1);  })
		//  caroselSingle('".$s_id."');
		  
		  }); 
	 </script>
