<?php
					if(!empty($images )){ ?>
					  
						   <?php 
           
           if(!empty($images) and sizeOf($images)>1 ){ ?>
            <div class="property-slider default spanwth" id="right2" style="width:100%;">
				<?php 
				foreach($images as $k2=> $image){
					if($k2==0){continue;}
					$image_url1 =  ENABLED_AWS_PATH.$image->image_name  ;	
						$image_url =  ENABLED_AWS_PATH.$image->image_name;
				//	$image_url =   $this->app->apps->getBaseUrl('timthumb.php').'?src='. $this->app->apps->getBaseUrl('uploads/images/'.$image->image_name)  .'&h=450&w=1000&zc=1' ;  ;	
			
				?>
               <a href="<?php echo $image_url1;?>" data-background-image="<?php echo $image_url;?>" class="item mfp-gallery"></a> 
               <?php } ?>
            </div>
            <?php } ?> 
							 <?php 
			 ;
			if(!empty($images) and sizeOf($images)>1 ){ ?>
			<div class="property-slider-nav"  >
			<?php 
			foreach($images as $k2=> $image){
				if($k2==0){continue;}
				$image_url =  ENABLED_AWS_PATH.$image->image_name; ;	
			?>
			 <div class="item"><img src="<?php echo $image_url;?>" alt=""></div>   
			<?php } ?>
			</div>
			<?php } ?> 
			   
						<div class="clearfix"></div>
						 
						<?php } ?> 
						
					
