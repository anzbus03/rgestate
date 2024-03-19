<?php
foreach($works as $k=>$v){
	?>
	 <!-- Listing Item -->
          <div class="item_ko col-sm-3 ajaxLoaded"  >
            <div class="listing-item-container"   >
				<?php
				   $image = $this->app->apps->getBaseUrl('uploads/images/'.$v->image);?>
					<a href="<?php echo $v->agentDetailUrl;?>"><div class="listing-item" style="background-image:url(<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=255&w=255&zc=1);background-size:cover;background-size:center center;background-position: top;">
				  
			 
					<!--<span class="like-icon"></span>-->
              </div></a>
              <div class="listing-item-content spanfont" style="magin-top:-100px;">
				  <div style="">
                <h3><a href="<?php echo $v->agentDetailUrl;?>"><?php echo $v->fullName;?></a></h3>
                <span class="ak_sub_heading"><?php echo $v->country_name;?></span>
                <div class="ak_agent_content">
                     <?php /*
                  <span class="ak_side_heading">Nationality:</span>
                  <p><?php echo $v->country_name;?></p>
             
                  <span class="ak_side_heading">Languages:</span>
                  <p><?php echo $v->Userall_languages;?></p>
                  <span class="ak_side_heading">Sold:</span>
                  <p>0</p>
                  */ ?>
                </div>
                <div class="ak_rent_sec">
                  <div class="ak_rent">
                    <span><?php echo $v->rent_total;?></span>
                    <p>for Rent</p>
                  </div>
                  <div class="ak_sales">
                    <span><?php echo $v->sale_total;?></span>
                    <p>for Sales</p>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          <!-- Listing Item / End -->
 
	<?
}
