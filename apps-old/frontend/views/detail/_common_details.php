        <div class="row mbm" data-auto-test-id="home-details-overview">
            <?php $this->renderPartial('_full_details'); ?> 
           
           </div>
            <div class="bbs mbl homeDetailsHeading">
               <span class="h5 prm backgroundBasic">Description</span>
            </div>
            <div id="descriptionContainer" class="mbl pbm">
               <div class="row">
                  <div class="xsColOffset4 xxsCol24 xsCol20">
                     <p id="propertyDescriptions">
                                <?php echo nl2br($model->ad_description);?>
                     </p>
                  </div>
               </div>
            </div>
            
            <div class="bbs mbl homeDetailsHeading">
               <span class="h5 prm backgroundBasic">Features</span>
            </div>
            <div data-role="contentWithToggle">
               <div class="row" data-auto-test-id="home-details-features">
                  <div class="xsCol4 smlCol4 mdCol4 lrgCol4"></div>
                  <div class="miniCol24 xsCol10 smlCol10  mdCol10 lrgCol10 mbl">
                     <div class="mbm">
                        <span class="typeEmphasize">LISTING INFORMATION</span>
                        <br>
                        <span class="typeLowlight h6">Updated:  <?php echo $model->lastUpdated ;?></span>
                     </div>
                     <ul class="man">
                          <?php
						 if(!empty($model->bedrooms)){ ?>
                        <li><?php echo $model->BedroomTitle;?> Bedrooms</li>
                        <?php } ?> 
                         <?php
						 if(!empty($model->bathrooms)){ ?>
                        <li><?php echo $model->BathroomTitle;?> Bathroom</li> <?php } ?> 
                           <?php
						 if(!empty($model->builtup_area)){ ?>
                        <li><?php echo $model->BuiltUpArea;?>  </li>
                        <?php } ?> 
                     </ul>
                     <?php 
                     $amentites = $model->all_amentitie();
					 if(!empty( $amentites)){
						?>
						<ul data-role="toggledContent" class=" man"><?php
					 	foreach($amentites as $k=>$v){
						 echo  '<li>'.$v->amenities_name.'</li>' ;
							 
					  }
					  ?></ul><?php
					 }
					?>
                     
                       
                  </div>
                  <div class="miniCol24 xsCol10 smlCol10  mdCol10 lrgCol10 mbl maXxsHidden">
                     <div class="mbm">
                        <span class="typeEmphasize">PUBLIC RECORDS</span>
                        <br>
                        <span class="typeLowlight h6"> </span>
                     </div>
                     <ul class="man">
                         <?php
                         if(!empty($model->builtup_area)){ ?> 
                        <li><?php echo $model->getAttributeLabel('builtup_area');?> : - <?php echo $model->BuiltUpArea;?></li>
                        <?php } ?>
                        <?php
                        if(!empty($model->plot_area) and  $model->plot_area != '0.00'){ ?>
                        <li><?php echo $model->getAttributeLabel('plot_area');?> : - <?php echo $model->PloatArea;?>  </li>
                        <?php } ?>
                     </ul>
                     <ul data-role="toggledContent" class=" man">
                        <li>Property Type: <?php echo $model->category_name?>
                        <?php
                        if(!empty($model->sub_category_id)){
                          echo '/'.$model->sub_category_name;
                        }
                        ?>
                        </li>
                        <?php
                        if(!empty($model->FloorNo)){ ?>
                        <li><?php echo $model->getAttributeLabel('FloorNo');?>: <?php echo $model->FloorNoTitle;?></li>
                        <?php } ?> 
                          <?php
                        if(!empty($model->total_floor)){ ?>
                        <li><?php echo $model->getAttributeLabel('total_floor');?>: <?php echo $model->total_floorTitle;?></li>
                        <?php } ?> 
                        <?php 
                        if(!empty($model->parking)){ ?> 
                        <li><?php echo $model->getAttributeLabel('parking');?>: <?php echo  $model->parkingTitle ; ?></li>
                        <?php } ?> 
                        <?php
                        if(!empty( $model->community_id)){?>
                        <li>Community: <?php echo  $model->community_name; ?></li>
                        <?php } ?>
                         <?php
                        if(!empty( $model->sub_community_id)){?>
                        <li>Sub Community: <?php echo  $model->sub_community_name; ?></li>
                        <?php } ?> 
                     </ul>
                  </div>
               </div>
			<?php
			if(!empty($model->nearest_metro) or !empty($model->nearest_railway)){ ?>
                  <div class="row" data-auto-test-id="home-details-features">
                  <div class="xsCol4 smlCol4 mdCol4 lrgCol4"></div>
                  <?php
                  if(!empty($model->nearest_metro)){ 
                  $skuList = explode(PHP_EOL,$model->nearest_metro);
                  ?>
                  <div class="miniCol24 xsCol10 smlCol10  mdCol10 lrgCol10 mbl">
                     <div class="mbm">
                        <span class="typeEmphasize">Nearest MetroStations</span>
                     </div>
                     <ul class="man">
						 <?php 
						 foreach($skuList as $station){ ?>
                        <li><?php echo $station;?>  </li>
                        <?php } ?>
                     </ul>
                  </div>
                  <?php } ?>
                  <?php
                  if(!empty($model->nearest_railway)){ 
                  $skuList = explode(PHP_EOL,$model->nearest_railway);
                  ?>
                  <div class="miniCol24 xsCol10 smlCol10  mdCol10 lrgCol10 mbl maXxsHidden">
                     <div class="mbm">
                        <span class="typeEmphasize">Nearest Schools</span>
                     </div>
					<ul class="man">
						 <?php 
						 foreach($skuList as $schools){ ?>
                        <li><?php echo $schools;?>  </li>
                        <?php } ?>
                     </ul>
                  </div>
				 <?php } ?> 
               </div>
			<?php } ?> 
            </div>
       
