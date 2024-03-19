   <div class="margin-bottom-25" id="<?php echo $rw_ids;?>">
				   <div class="    ">
					 <?php
					 if(!empty( $header )){ ?>
                     <div class="col-md-12 padding-0">
                        <h3 class="headline  <?php echo  empty($sub_header)? 'margin-bottom-20':'margin-bottom-0';?>   padding-left-0   col-md-12 no-margin-left  "> <?php echo $header; ?> </h3>
                         
                        <?php
                        if(!empty($sub_header)){ ?>
                        <h4 class="_eclbxd    margin-bottom-10  col-md-12 no-margin-left padding-left-0  "><?php echo $sub_header; ?></h4>
                        <?php } ?> 
                     </div>
                     <?php } ?> 
                     
                     
                     
                     <div class="col-md-12 seperate_mar margin-0 padding-0 _add_row_3">
                        <div class="_ba2wq3 rrf">
						   <?php
						  $apps = Yii::app()->apps;$bg = true; 
						   foreach($field as $k=>$v){
							$mod_value =     $k%4 ;
							switch($mod_value){
								case '0':
								$color =  'A52B03';
								break;
								case '1':
								$color =  '734F21';
								break;
								case '2':
								$color =  '231341';
								break;
								case '3':
								$color =  '441A05';
								break;
								default:							 
								$color =  '517537';
								break;
							}
							 $s_id ="new_item1".$v->user_id ; 
						    ?> 
                           <!-- Listing Item -->
                               <div class="col-sm-4 ajaxLoaded2 mul_sliderh" id="<?php echo $s_id;?>"> 
                         <div class="arws"></div>  <div class="dots"></div> 
                          
                        
                        <a href="<?php echo $v->agentDetailUrl;?>" target="_blank" class="listing-item-container">
                            <div class="listing-item"> 
								                                    
                                                           
								 								<div class="single-item-hover"></div>
								<div class='single-item' >
								<?php echo $v->generateImage($apps,$h=208,$w=333,$s_id,$bg);?> 
								</div>
 
                                <!--<span class="like-icon"></span>-->
                            </div>
                            <div class="listing-item-content spanfont">
                                <h5 style="color: #<?php echo $color;?> !important;"><?php echo $v->country_name ;?></h5>
                                <h3><?php echo $v->fullName;?></h3>
                            </div>
                            	<div data-reactid="61">
								<ul class="listInline typeTruncate mvn" data-reactid="62">
								<li data-auto-test="beds" data-reactid=""> for Rent  <?php echo $v->rent_total;?></li>
								<li data-auto-test="baths" data-reactid=""> for Sales <?php echo $v->sale_total;?></li>
							
								</ul>
								</div>
                        </a>
                             
                        </div>
                        
                        
                           <?php } ?> 
                           <!-- Listing Item / End --> 
                       </div>
				   <div class="clearfix"></div>
				   </div>
				   <div class="clearfix"></div>
				   </div>
				   <div class="clearfix"></div>
				   </div>
			 
