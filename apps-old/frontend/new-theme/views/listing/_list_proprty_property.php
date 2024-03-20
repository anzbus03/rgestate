                        <!-- Listing Item -->
                        <?php
                        $from = $this->tag->getTag('from','from');
                        $view_details = $this->tag->getTag('view_details','View Details');
                        $links_open_in  = $this->options->get('system.common.link_open_in','S');	
                        $apps = $this->app->apps;
                        $s_class_n = 'col-sm-4';$bg = true;
                        foreach($works as $k=>$v){ 
							?>
							    	<li class="col-xl-6 col-lg-6 col-md-6 project">
							    	    <div class="proj-info">
						    <a href="<?php echo $v->detailUrl;?>" >
						    <figure class="project-effect llod "  >
						        <img data-src="<?php echo $v->getAd_image_singlenew('600');?>"  alt="<?php echo $v->ad_title;?>"  title="<?php echo $v->ad_title;?>" class="img-fluid lozad" style="min-height:150px;z-index:1" >
								  
                 <figcaption>  
   <div class="hidden-info">
	   <?php
	   /*
  $all_property_types = $v->all_property_types();
  if(!empty($all_property_types)){  ?> 
      <div class="label">Categories</div>
      <div class="desc">
       <?php
       $str = '';
			 foreach($all_property_types as $k2=>$v2){  $str .= $v2->category_name.',';}
			echo rtrim( $str , ','); 	 
       ?>
      </div>
      <?php  } */  ?> 
    
      <div class="btn-details button button-secondary">
         <?php echo $view_details;?>
         <span class="_8kak1d rnt"  >
            <svg viewBox="0 0 18 18" role="presentation" aria-hidden="true" focusable="false" style="height: 10px; width: 10px; fill: #fff;">
               <path d="m4.29 1.71a1 1 0 1 1 1.42-1.41l8 8a1 1 0 0 1 0 1.41l-8 8a1 1 0 1 1 -1.42-1.41l7.29-7.29z" fill-rule="evenodd"></path>
            </svg>
         </span>
      </div>
   </div>
  
</figcaption>				
                </figure>
                <div class=" project-tile-info">
                 <div class="project-info-mob">
      <div class="logo"> <img src="<?php echo $v->CompanyImage;?>" alt="<?php echo $v->CompanyName;?>"> </div>
      <div class="dev-info">
         
         <h2 class="title"><?php echo $v->adTitle;  ; ?></h2>
           <h3 class="dev"><p class="add margin-top-10"><span class="flaticon-placeholder"></span><?php echo $v->stateName;?> <span class=""><b> . </b><?php echo $v->ProjectstatusTitle;?></span></p> </h3>
          <div class="price"><?php echo $from. ' '. $v->PriceTitleSpanL;?>  </div>
          
         <div class="clear"></div>
        
      </div>
      <div class="clear"></div>
   </div>
   <div class="price-m-info">
        <div class="price"><?php echo  $from. ' '.$v->PriceTitleSpanL;?>  </div>
   </div>
  </div>
                </a>
                <div class="clearfix"></div>
                </div>
                        </li> 
							<?
						 
						 }  

                 
