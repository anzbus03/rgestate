 <style>
     #detail .topBSafe .listing-item { height:257px;}
      #detail .topBSafe  .slick-prev,   #detail .topBSafe   .slick-next { top :128px !important ;}
   #detail .topBSafe     button.saveHome { 
    right: 20px;
    top: 20px; 
}
    #detail .topBSafeer .listing-item { height:257px;}
      #detail .topBSafeer  .slick-prev,   #detail .topBSafe   .slick-next { top :128px !important ;}
   #detail .topBSafeer     button.saveHome { 
    right: 20px;
    top: 20px; 
}
 </style>
 <?php 
  $order = '';
 
 $order .= 't.id  desc' ;
 $apps= Yii::app()->apps;
 $neighbours = PlaceAnAd::model()->findAds(array('sort'=>'custom','custom_order'=>$order),false,false,false,$model->user_id);
 if(!empty($neighbours)){ ?> 
 
 <div class="col-md-12 topBSafe no-padding" style="">
         <div class=" ">
            <div class=" ">
               <h3 class="headline margin-top-40" style="margin-left:0px;"><?php echo  'Recent Properties by '.$model->companyName ;?> </h3>
               <div class="simple-slick-carousel0 dots-nav spandots  " style="margin-bottom: 0px;margin-left:-8px;margin-right:-8px;">
				 
                  <?php 
                  
                  foreach($neighbours  as $k=>$v){ 
								  $s_id = "ecomended_item".$v->id ;  
							  ?> 
                                       	      	<div class="col-xl-4 col-lg-4 col-md-4">
							<div class="strip grid">
            <figure>            
                        <a href="<?php echo $v->detailUrl;?>"  onclick="easyload(this,event,'mainContainerClass')"><img src="<?php echo $v->SingleImage;?>" class="img-fluid" alt="">
              <div class="read_more"><span>Read more</span></div>
              </a>  <?php echo $v->listRowPrice();?>
                 
              </figure>
            <div class="wrapper">
              <div class="smartad_infoarea">
                <h2 class="smartad_title smartad_title-link"><a href="<?php echo $v->detailUrl;?>"  onclick="easyload(this,event,'mainContainerClass')"><?php echo  $v->AdTitle;?></a></h2>
                <div class="smartad_detail">
                   
                    <?php echo $v->listRowFeatures();?>
                    </div>
                <div class="smartad_location-area">
                  <div class="smartad_location"><span class="svg">
                    <svg viewBox="0 0 1792 1792" class="smartad_locationicon">
                      <use xlink:href="#svg-location"></use>
                    </svg>
                    </span><span class="smartad_locationtext"><?php echo $v->listRowLocation();?></span>
                     <span class="cat-info-f"><?php echo  $v->SectionCategoryFullTitle;?></span> 
                    </div>
                </div>
              </div>
            </div>
               <?php echo $v->footerLinkNew();?>
          </div>
          </div>
                      
                              <?php  } ?>
                  <!-- Listing Item / End --> 
                  
               </div>
            </div>
         </div>
      </div>
     
<?php } ?> 
