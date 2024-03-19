   <div class="container margin-top-40" id="<?php echo $rw_ids;?>">
				   <div class="row  margin-bottom-40">
					 <?php
					 if(!empty( $header )){ ?>
                     <div class="col-md-12">
                        <h3 class="headline  <?php echo  empty($sub_header)? 'margin-bottom-10':'margin-bottom-0';?>    col-md-12 no-margin-left  "> <?php echo $header; ?> </h3>
                         
                        <?php
                        if(!empty($sub_header)){ ?>
                        <h4 class="_eclbxd    margin-bottom-10  col-md-12 no-margin-left  "><?php echo $sub_header; ?></h4>
                        <?php } ?> 
                     </div>
                     <?php } ?> 
                     
                     <div class="col-md-12 seperate_mar">
                          <div class="slide _ba2wq3" style="margin-bottom: 0px;">
							<?php 
							 $total_size = sizeOf($field);
							 
							 foreach($field  as $k=>$v){
								   if($total_size>3){  ?> <div class="carousel-item"><?php } ?> 
												<div class="item_ko col-sm-4" style="<?php  if($total_size>3){ echo 'width:100%';} ?>">
												  <a href="<?php echo $v->detailUrl;?>" class="listing-item-container">
													 <div class="listing-item">
													   <?php   $image = $v->AdImage;?>
														<img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=175&w=358&zc=1" alt="">
														<!--<span class="like-icon"></span>--> 
													 </div>
													 <div class="listing-item-content spanfont">
														<h3><?php echo $v->adTitle;?></h3>
														<div style="margin-bottom: 8px;"><div class="_wbsbxz"><div class="_12n1ibqr"><span class="_1jj7gf6"><?php echo $v->ShortDescription;?></span></div></div></div>
													 </div>
												  </a>
											   </div>
											   <?php
											    if($total_size>3){  ?>
											   </div>
											   <?php } ?> 
								 <?
							 }
							?>
		 </div>
                      </div>
                  </div>
				   
				   </div>
		 <?php
		 if($total_size>3){
			 ?>
			 <script>  generateSlider1('<?php echo $rw_ids;?>');</script>
			 <?php
		 }
