   <div class="margin-bottom-25" id="<?php echo $rw_ids;?>">
				   <div class="    ">
					 <?php
					 if(!empty( $header )){ ?>
                     <div class="col-md-12 padding-0">
                        <h3 class="headline  <?php echo  empty($sub_header)? 'margin-bottom-20':'margin-bottom-0';?>   padding-left-0   col-md-12 no-margin-left  "> <?php echo Yii::t('app',$header,array('{s}'=>$secModel)); ?>  </h3>
                         
                        <?php
                        if(!empty($sub_header)){ ?>
                        <h4 class="_eclbxd    margin-bottom-10  col-md-12 no-margin-left padding-left-0  "><?php echo $sub_header; ?></h4>
                        <?php } ?> 
                     </div>
                     <?php } ?> 
                     
                     <div class="col-sm-12 seperate_mar margin-0 padding-0 _add_row_3">
                          <div class="slide _ba2wq3  nssNxt" style="margin-bottom: 0px;">
							<?php 
							 $total_size = sizeOf($field);
							 
							 foreach($field  as $k=>$v){
								  ?> <div class="carousel-item"> 
												<div class="item_ko col-sm-4 padding-right-0 " style="<?php   echo 'width:100% !important';  ?>">
												  <a href="<?php echo $v->agentDetailUrl;?>" class="listing-item-container margin-bottom-0">
													 <div class="listing-item">
													   <?php   $image = $v->MainImage;?>
														<img src="<?php echo $this->app->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=208&w=370&zc=1" alt="">
														<!--<span class="like-icon"></span>--> 
													 </div>
													 <div class="listing-item-content spanfont">
														<h3 class="margin-top-10"><?php echo $v->fullName;?></h3>
														<div class="margin-top-10"><div class="_wbsbxz"><div class="_12n1ibqr"><span class="_1jj7gf6"><?php echo $v->ShortDescription;?></span></div></div></div>
													 </div>
												  </a>
											   </div>
											   <?php
											     ?>
											   </div>
											   <?php   ?> 
								 <?
							 }
							?>
		 </div>
                      </div>
                  </div>
				   <div class="clearfix"></div>
				   </div>
			 
		 
			 <script>  generateSliderC('<?php echo $rw_ids;?>',3,2,2);</script>
			 
