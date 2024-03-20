<?php   

echo "Herere"; exit;


$this->widget('frontend.components.web.widgets.home_banner.HomeBannerWidget'); ?>
<script>var is_home=true; </script>
<style>
@media only screen and (min-width: 1024px) {
.slider-form .top-search {    margin-top: 0;    margin-bottom: 15px;    display: flex;    align-items: center;    white-space: nowrap;} 
}
</style>
<div class ="container home_container">
<!-- Content
            ================================================== -->
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h3 class="headline margin-bottom-15   margin-top-40 col-md-12 no-margin-left "> Explore Askaan </h3>
               </div>
            </div>
         </div>
       
       	<?php
		/*	if(!empty($load_location)){ ?> 
		<div class="container margin-top-20">
			 <div class="col-md-12  padding-0">
						  <h3 class="headline  margin-bottom-20   padding-left-0   col-md-12 no-margin-left  "> Top Cities</h3> 
			  </div>
			  <div class="clearfix"></div>
		<div class="_ba2wq3" id="ids">
                                     <?php
                                     $country_get = Yii::App()->request->getQuery('country','');
										foreach($load_location as $k=>$v){ ?>
  <a href="<?php echo Yii::app()->createUrl('listing/index',array('section_id'=>$filterModel->section_id,'country'=> $country_get));?>">
                  <div class="col-md-3">
                     <div class="spanstyle">
                        <div class="col-md-4" style="padding: 0px;width:80px;"><img src="<?php echo $this->appAssetUrl('images/Villas.jpg');?>" alt=""> </div>
                        <div class="col-md-8 spanfontstyle">
                           <h3><?php echo $v->state_name;?></h3>
                            <p>
                           <i><?php echo !empty( $country_name) ?  $country_name : '';?></i>    .
                           </p>
                        </div>
                     </div>
                  </div>   </a>
                                                        <?php } ?>
									
									<div class="clearfix"></div></div>
									<div class="clearfix"></div>
		</div>
		  
         <script> $(function(){ generateLinksSlider2(); })
         </script>
		<?php }  */
		?> 
       
       
       <div class="home_section">
        <div class="item homer">
		<?php
			   if($featued_banners){ ?> 
               <section class="fullwidth  padding-top-0 padding-bottom-0 margin-bottom-40 featuredB" id="">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
						<?php 
						if(!empty($featured_text) and !empty($featured_text->header_text)){
							$header_text = unserialize($featured_text->header_text); 
							echo '<h3 class="headline margin-bottom-5 col-md-12 no-margin-left">'.@$header_text['row1'].'</h3>';
						}
						else{
							echo '<h3 class="headline margin-bottom-5 col-md-12 no-margin-left">Featured Projects  in MENA Region</h3>';
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
                                    <a href="<?php echo $v->detailUrl;?>" ><img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=350&w=1189&zc=1" alt=""></a>
                                    <div class="listing-item-content spansec01">
                                       <h3 class="hidden"> <?php echo $v->adTitle;?>. </h3>
                                         
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
        <style>
        .for_sale_p1 .col-md-12 { padding:0px !important; }
        </style>
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
         
<div class="clearfix"></div>
</div>
