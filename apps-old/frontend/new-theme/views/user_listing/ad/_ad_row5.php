   <div class="margin-bottom-50" id="<?php echo $rw_ids;?>">
				   <div class=" ">
					 <?php
					 if(!empty( $header )){ ?>
                     <div class="col-md-12 padding-0">
                        <h3 class="headline  <?php echo  empty($sub_header)? 'margin-bottom-20':'margin-bottom-0';?>    col-md-12 no-margin-left padding-left-0 "> <?php echo Yii::t('app',$header,array('{s}'=>$secModel)); ?>  </h3>
                         
                        <?php
                        if(!empty($sub_header)){ ?>
                        <h4 class="_eclbxd    col-md-12 no-margin-left    padding-left-0 "><?php echo $sub_header; ?></h4>
                        <?php } ?> 
                     </div>
                     <?php } ?> 
                     
                     <div class="col-md-12 seperate_mar margin-0 padding-0 _add_row_5">
                          <div class="slide _ba2wq3 nssNxt" style="margin-bottom: 0px;">
							<?php 
							 $total_size = sizeOf($field);
							 
							 foreach($field  as $k=>$v){
								 ?>
								    <div class="carousel-item"> 
								     <div class="padding-left-8 padding-right-8 rmmssd    col-xs-5th-1" style="<?php  echo 'width:100%';  ?>">
												  <a href="<?php echo $v->agentDetailUrl;?>" class="listing-item-container  margin-bottom-0">
													 <div class="listing-item">
													   <?php   $image =  $v->MainImage;?>
													  <div style="background-image:url('<?php   echo  $image   ;?>');width:100px;height:100px;background-size:cover;border-radius: 50%;margin: 31px auto;background-repeat: no-repeat;background-position: center;background-color: #eee;"></div>
														
														<!--<span class="like-icon"></span>--> 
													 </div>
													 
													 <div class="listing-item-content spanfont absC padding-right-0">
														 <div class="_96n9kn"> 
														  <div class="_w1effmn"><?php echo $v->fullName;?></div>
														  <div class="_eiid8jn"><?php   echo  !empty($v->designation) ? $v->designation : 'Agent';?></div> 
														  </div>
													 </div>
												  </a>
											   </div>
											    
											   </div>
											   <?php } ?> 
								 <?
							 
							?>
		 </div>
                      </div>
                  </div>
				  <div class="clearfix"></div> 
				   </div>
		 
			 <script>  generateSliderC('<?php echo $rw_ids;?>',5,3 ,2);</script>
		 
   <div class="clearfix"></div>
