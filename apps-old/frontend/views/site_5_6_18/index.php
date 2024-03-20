<?php   $this->widget('frontend.components.web.widgets.home_banner.HomeBannerWidget'); ?>
 
<!-- Content
            ================================================== -->
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h3 class="headline  margin-top-40 col-md-12 no-margin-left "> Explore Askaan </h3>
               </div>
            </div>
         </div>
         <!-- Category Boxes -->
         <div class="container">
            <div class="row">
               <div class="col-md-12 home_exp_sec">
				   <a href="<?php echo Yii::app()->createUrl('listing/index',array('country'=>$this->default_country_slug,'type_of[]'=>'33'));?>">
                  <div class="col-md-3">
                     <div class="spanstyle">
                        <div class="col-md-4" style="padding: 0px;"><img src="<?php echo $this->appAssetUrl('images/Offices.jpg');?>" alt=""> </div>
                        <div class="col-md-8 spanfontstyle">
                           <h3>Offices</h3>
                           <p>
                           <i>Offices</i> in <?php echo $default_country_name;?>.
                           </p>
                        </div>
                     </div>
                  </div>
                  </a>
                   <a href="<?php echo Yii::app()->createUrl('listing/index',array('country'=>$this->default_country_slug,'type_of[]'=>'31'));?>">
                  <div class="col-md-3">
                     <div class="spanstyle">
                        <div class="col-md-4" style="padding: 0px;"><img src="<?php echo $this->appAssetUrl('images/Villas.jpg');?>" alt=""> </div>
                        <div class="col-md-8 spanfontstyle">
                           <h3>Villas</h3>
                            <p>
                           <i>Villas</i> in <?php echo $default_country_name;?>.
                           </p>
                        </div>
                     </div>
                  </div>   </a>
                   <a href="<?php echo Yii::app()->createUrl('listing/index',array('country'=>$this->default_country_slug,'type_of[]'=>'30'));?>">
                  <div class="col-md-3">
                     <div class="spanstyle">
                        <div class="col-md-4" style="padding: 0px;"><img src="<?php echo $this->appAssetUrl('images/Apartments.jpg');?>" alt=""> </div>
                        <div class="col-md-8 spanfontstyle">
                           <h3>Apartments  </h3>
                           <p>
                           <i>Apartments</i> in <?php echo $default_country_name;?>.
                           </p>
                        </div>
                     </div>
                  </div>
                  </a> <a href="<?php echo Yii::app()->createUrl('listing/index',array('country'=>$this->default_country_slug,'type_of[]'=>'32'));?>">
                  <div class="col-md-3">
                     <div class="spanstyle">
                        <div class="col-md-4" style="padding: 0px;"><img src="<?php echo $this->appAssetUrl('images/Land.jpg');?>" alt=""> </div>
                        <div class="col-md-8 spanfontstyle">
                           <h3>Land</h3>
                           <p>
							    <i>Lands</i> in <?php echo $default_country_name;?>.
                           </p>
                        </div>
                     </div>
                  </div> </a>
               </div>
            </div>
         </div>
       <style>  .item_ko:nth-child(4n+1){ clear:both; }  .developer_logo { position: absolute;right: 7px;bottom: 57px;z-index: 1111;}
       </style>
       <div class="home_section">
        <div class="item homer">
		<?php
			   if($featued_banners){ ?> 
               <section class="fullwidth  padding-top-40 padding-bottom-0" id="">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
						<?php 
						if(!empty($featured_text) and !empty($featured_text->header_text)){
							$header_text = unserialize($featured_text->header_text); 
							echo '<h3 class="headline margin-bottom-0 col-md-12 no-margin-left">'.@$header_text['row1'].'</h3>';
						}
						else{
							echo '<h3 class="headline margin-bottom-0 col-md-12 no-margin-left">Featured Projects  in MENA Region</h3>';
						}
						?>
                        </div>
                        <div class="col-md-12 col-sm-12">
                           <div class="simple-slick-carousel dots-nav spandots_01  " style="margin-bottom: 0px;">
                              <!-- Listing Item -->
                              <?php
                              foreach($featued_banners as $k=>$v){ ?> 
                              <div class="carousel-item featured_pro item_ko_100">
                                 <div class="listing-item spanimgsize">
									<?php   $image = $v->AdImage ;?>
                                    <a href="<?php echo $v->detailUrl;?>" ><img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=300&w=1110&zc=1" alt=""></a>
                                    <div class="listing-item-content spansec01">
                                       <h3> <?php echo $v->adTitle;?>.
                                       </h3>
                                       <a href="<?php echo $v->DetailUrl;?>" class="_16tkiskg" style="min-width:150px !important;">Find Out More</a> 
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
		</div>
		<div class="clearfix"></div>
		</div>
         
		<div class="home_section">
		<?php 
	    $Ar_ad = array();
		foreach($advertisement_layout as $k=>$v){
			$Ar_ad[$k] = array('advertisemen_id'=>$v->advertisemen_id,'title'=>$v->header_text);
		}
		 
		$i=0;
		foreach($countries_list as $k=>$country){
			if($k%2=='0' and $k!='0'){
				if(isset($Ar_ad[$i])){
				$row = $Ar_ad[$i];$i++;
				echo $this->renderPartial('_ad_section',compact('row'));
				}
			}
	    	echo $this->renderPartial('_section',compact('country','k'));
		}   
		?>
		<div class="clearfix"></div>
		</div>
         
