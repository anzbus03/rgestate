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
    
       <style>
       .item_ko:nth-child(4n+1){ clear:both; }
      .developer_logo { position: absolute;right: 7px;bottom: 57px;z-index: 1111;}
       </style>
       <div class="home_section">
	<?php 
	foreach($countries_list as $k=>$country){
		echo $this->renderPartial('_section',compact('country','k'));
	}   
	?>
	<div class="clearfix"></div>
	 </div>
         
