       <div class="margin-bottom-40">
            <div class="">
                <div class="col-md-12 padding-0">
                    <div>

                        <!-- Listing Item -->
                        <?php
                        $apps = Yii::app()->apps;$bg =false; 
                        foreach($works as $k=>$v){
							$mod_value =     $k%4 ;
							switch($mod_value){
									case '0':
								$color =  'A52B03';
								break;
								case '1':
								$color =  '734F21';
								break;
								case '2':
								$color =  '39577C';
								break;
								case '3':
								$color =  '441A05';
								break;
								default:							 
								$color =  '517537';
								break;
							}
							 $s_id ="list_items_s".$v->user_id ;
							 
						    ?> 	
                        <div class="col-sm-3 ajaxLoaded2 mul_sliderh" id="<?php echo $s_id;?>"> 
                         <div class="arws"></div>  <div class="dots"></div> 
                        <a href="<?php echo $v->developerDetailUrl;?>" class="listing-item-container">
                            <div class="listing-item"> 
								                                   
                                                           
								 								<div class="single-item-hover"></div>
								<div class='single-item' >
								<?php echo $v->generateImage($apps,$h=164,$w=246,$s_id,$bg);?> 
								</div>
<div class="_wyr5tw" style="height:100% !important;"></div>
                                <!--<span class="like-icon"></span>-->
                            </div>
                            <div class="listing-item-content spanfont">
                                <h5 style="color: #<?php echo $color;?> !important;"><?php echo $v->country_name ;?></h5>
                                <h3><?php echo $v->fullName;?></h3>
                            </div>
                            	<div data-reactid="61">
							 
								</div>
                        </a>
                         </div>
                        <?php
                        } 
                        ?> 

                    </div>

                </div> <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        
 
     
