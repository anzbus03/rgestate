            <ul class="mvn row list container" id="d_column"  data-reactid="24" style="background:#fff;width:100%;">
												<?php
												 $apps = $this->app->apps;
												foreach($ads as $k=>$v){ 
													$s_id ="map_item".$v->id ; $bg = true; 
												?> 
                                                	<div class="col-sm-4 lst-prop  propli  mul_sliderh smsec_<?php echo $v->section_id;?>" id="<?php echo $s_id;?>"  data-price="<?php echo $v->price;?>">
							<a href="<?php echo $v->detailUrl;?>" onclick="easyload(this,event,'mainContainerClass')" class="lsproplink"> </a> 
							<div class="arws"></div> 
							 <div class="listing-item" data-image="<?php echo $v->getSingleImage("150");?>" > 
										
										<div class="tagsListContainer"  >
										<ul class="tagList tags listInlineBulleted man h7 typeEmphasize"><?php echo $v->getTagList('F');?></ul>
										</div>
                                     
                                    	<div class="single-item-hover"></div>
										<div class='single-item' >
											<?php  echo $v->generateImage2($apps,$h=380,$w=570,$s_id,$bg);?> 
										</div>
										 
                                       
                                   <span class="pull-right sm-d-date2 margin-left-5"><?php echo $v->ShowDateFrontend;?></span>
                                 </div>
                            
                                 	
            <div class="wrapper">
				<div class="price"><?php echo $v->listRowPrice();?><span class="forgrid pull-right"><?php echo  $v->SectionCategoryFullTitle;?></span></div>
              <div class="smartad_infoarea">
                <h2 class="smartad_title smartad_title-link"><a href="<?php echo $v->detailUrl;?>" ><?php echo  $v->AdTitle2;?></a></h2>
               <div class="sh-mobile"><?php echo $v->listRowPrice();?></div>
                <div class="smartad_detail">
                   
                    <?php echo $v->listRowFeatures();?>
                    </div>
                <div class="smartad_location-area">
                  <div class="smartad_location"><span class="svg">
                    <svg viewBox="0 0 1792 1792" class="smartad_locationicon">
                      <use xlink:href="#svg-location"></use>
                    </svg>
                    </span><span class="smartad_locationtext"><?php echo $v->listRowLocation();?></span>
                        
                    </div>
                </div>
              </div>
            </div>
               <?php echo $v->footerLinkNew();?>
          
          <div class="clearfix"></div>
          </div>
           
                                                <?php } ?>
                                    </ul>
                                
<div class="backgroundBasic" data-reactid="1442">
													<div class="paginationContainer pls mtl ptl mbm" data-reactid="1443">
														<div class="pagingarea">
																<nav class="navigation pagination d-flex justify-content-end" role="navigation">
																<div class="actions">
																	<?php 

																	$this->widget('frontend.components.web.widgets.SimplaPagerN', array(
																	'pages'=>$pagesad,
																	'maxButtonCount'=>3, 
																	));  
																	?>
																</div>
																</nav>
														</div>  

													</div>
												</div>
