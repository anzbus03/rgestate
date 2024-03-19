<div id="m_available" class="padding-top-40"></div>
<div class="available_units   margin-top-0  np_view_tabs_data" id="available_type" style="position: relative;">
   <h3 class="headline" >Available Units</h3>
    <ul class="content">
     
         <?php
         $nitItemsCriteria = $model->findAds(array(), false,true ,$calculate=false,$user_id=false);
         $nitItemsCriteria->addInCondition('t.id',CHtml::listData($unitIds,'unit_id','unit_id'));
         $items = PlaceAnAd::model()->findAll($nitItemsCriteria);
        
         
         foreach($items as $k2=>$v3){
			 
			 ?>
			    	<li class="col-sm-6 lst-prop smsec_<?php echo $v3->section_id;?>">
							<div class="strip grid">
            <figure><a href="<?php echo $v3->detailUrl;?>" onclick="easyload(this,event,'mainContainerClass')"><img  src="<?php echo $v3->SingleImage;?>"  alt="<?php echo  $v3->ad_title;?>" class="img-fluid" alt="">
              
              </a>  <?php echo $v3->listRowPrice();?>
                 
              </figure>
            <div class="wrapper">
              <div class="smartad_infoarea">
                <h2 class="smartad_title smartad_title-link"><a href="<?php echo $v3->detailUrl;?>"  onclick="easyload(this,event,'mainContainerClass')"><?php echo  $v3->AdTitle;?></a></h2>
               <div class="sh-mobile"><?php echo $v3->listRowPrice();?></div>
                <div class="smartad_detail">
                   
                    <?php echo $v3->listRowFeatures();?>
                    </div>
                <div class="smartad_location-area">
                  <div class="smartad_location"><span class="svg">
                    <svg viewBox="0 0 1792 1792" class="smartad_locationicon">
                      <use xlink:href="#svg-location"></use>
                    </svg>
                    </span><span class="smartad_locationtext"><?php echo $v3->listRowLocation();?></span>
                     <span class="cat-info-f"><?php echo  $v3->SectionCategoryFullTitle;?></span> 
                    </div>
                </div>
              </div>
            </div>
               <?php echo $v3->footerLinkNew();?>
          </div>
          </li>
                         
							
      <?php } ?> 
         
         </ul>
    <!--Property types end -->
</div>
 
