  <div style="" class="home-home-type miniHidden proptyp sm-d-flt sctorSect mx-82" onmouseleave="closeOpened(this)">
                               			 
										  <div class="input-group  <?php echo (!empty($filterModel->section_id)) ? 'itmSelected' : '';?>" data-select2-id="72">
                          
                     
                                 <button id="sectTypeToggle"  type="button" class="btn btnDefault prm"  onclick="openDivThislatest(this)" data-open="sectTypeToggleDiv" style=""   >
                                                                        <!-- react-text: 501 -->
                                                                        <?php
                                                                        switch($filterModel->section_id){
																			case SALE_SLUG:
																			$sec_t = $this->tag->getTag('buy','Buy');
																			break; 
																			case RENT_SLUG:
																			$sec_t = $this->tag->getTag('rent','Rent');
																			break; 
																			default:
																			$sec_t = $this->tag->getTag('sector','Sector');
																			break;
																		}
                                                                        ?>
                                                                        <span id="st_title"><?php echo $sec_t;?></span><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                    <div id="sectTypeToggleDiv"   class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer pbs txtL">
                                                                    
                                                                    
                                                                    <div class="  ">
																	 
					 
                                                                          <div id="load_categories">
                                                                            <div class="miniCol12 smlCol24">
																						<div class="pbs"><span class="fieldItem  checkbox spnblock"><input id="sale<?php echo SALE_SLUG;?>" name="sec1"     value="<?php echo SALE_SLUG;?>" <?php echo ($filterModel->section_id==SALE_SLUG) ? 'checked=true': ''; ?> data-mainlistUrl='<?php echo Yii::app()->createUrl('listing/index',array('sec'=>SALE_SLUG));?>/' ; onchange="search_byAjax11(this)" type="radio"><label for="sale<?php echo SALE_SLUG;?>"><span class="melipsi"><?php echo $this->tag->getTag('buy','Buy');?></span></label></span></div>  
																						<div class="pbs"><span class="fieldItem  checkbox spnblock"><input id="rent<?php echo RENT_SLUG;?>" name="sec1"      value="<?php echo RENT_SLUG;?>"  <?php echo ($filterModel->section_id==RENT_SLUG) ? 'checked=true': ''; ?> onclick="propertytypechange1(this,event)"  type="radio"><label for="rent<?php echo RENT_SLUG;?>"><span class="melipsi"><?php echo $this->tag->getTag('rent','Rent');?><i class="mls iconDownOpen"></i></span></label></span></div>  
																					
																						<?php
																						$paid_array = $filterModel->paidArray(); 
																						$datamainlistUrl= Yii::app()->createUrl('listing/index',array('sec'=>RENT_SLUG)).'/' ;
																						foreach($paid_array as $k=>$v){ 
																							$checked ='';  		 
																								if($k==$filterModel->rent_paid){  $checked =  'checked="true"';echo "<script>openClassAdd('cat_".RENT_SLUG."');</script>";   }else{ $checked = '';  }
																						
																						echo '<div class="pbs category_tt cat_'.RENT_SLUG.' hide"><span class="fieldItem checkbox"><input id="rent_paid'.$k.'"  class="h_type flabele" name="rent_paid" '.$checked.' value="'.$k.'" onchange="search_byAjaxsub(this)" data-mailistUrl='.$datamainlistUrl.' type="radio"><label for="rent_paid'.$k.'"><span class="melipsi">'.$v.'</span></label></span></div>'; 
																						 
																						}	
																						?>
																				</div>
                                                                     
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                              </div>

                                  </div>
                               
                           
