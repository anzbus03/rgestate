
                    <div class="Listing_info">

                        <div class="Prop_img">
                            <a href="<?php echo $property->propertyDatilUrl;?>" style="cursor: pointer;text-decoration:none;">
                            
	
						<div class="loadingFlexslider1"> </div>
                                <div class="flexslider" style="display:none">
                                    <ul class="slides">
										<?php
										$images = $property->adImagesOnView(array('limit'=>8));
										if($images){
											foreach($images as $k2=>$v2){
												$image =  $property->renderImageNew($v2->image_name);
												?>
												 
												<li clas="QWERWR"> <img    src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=234&w=423&zc=1"   class="img-vert-align  "   alt="<?php echo $property->property_name;?>"> </li>
											<?php 
                                        }
                                        } ?>
                                         

                                    </ul>
                                </div>
                            </a>
                        </div>

                        <div class="list_infiDiv">
                            <div class="property_info">
                                <?php echo $property->priceHtml;?> 
                                <div class="txt1-div"><?php echo $property->category->category_name;?></div><span class="txt1-div-span"></span>
                                <div class="txt2-div"><?php echo $property->property_name ;?></div><span class="txt2-div-span"></span>
                                <div class="loctxt-div"><strong>Location</strong>   <?php echo $property->locationString;?> </div><span class="loctxt-div-span"></span>
                                <div class="apprx-div"><strong>Approx.size</strong> <?php echo $property->builtupAreaString;?></div><span class="apprx-div-span"></span>
                                <div class="ref-div"><strong>Ref No.</strong> <?php echo $property->systemRefNo;?></div><span style="display:none;" class="apprx-div-span"></span>
                                <?php echo $property->readyString;?>
                                 <?php
                                if(!empty($property->localBedString)){
									?>
										<div class="bed_bath_park"><?php echo $property->localBedString;?></div>
									<?php 
								}
                                ?>
                                <span style="display:none;" class="apprx-div-span"></span>
                            </div>
                            <div class="Agent_div Agent_div21">
                                <div class="save_rate">
                                    
                                    <div class="rate_str_sep"></div>
                                    <div class="agp_detail"><span style="margin: 0 0 0 28px;" class="agent_name">Property Listed by </span>
                                        <a style="cursor:text; margin: 0 0 0 28px;" href="javascript:void(0);"> <?php echo $property->Customer->fullName;?></a>
                                    </div>
                                </div>
                                <div class="View_detail">
                                    <a href="<?php echo $property->propertyDatilUrl;?>">View Property Details</a>
                                </div>
                              
                                <span style="display:none;" class="apprx-div-span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="line"></div>
