<form method="get"  action ="<?php echo Yii::app()->createUrl(RENTTITLE);?>"  onsubmit="callprevet(event,this)"  id="for_sale">
<input type="hidden" id="latitude2" value="" name="lat" />
<input type="hidden" id="longitude2" value="" name="lng" />
<input type="hidden" id="word2" value="" name="word" />
                        <div class="row no-gutters" data-select2-id="13">
							<div class="col-md-3 hide not-at-mobile padding-right-15" data-select2-id="12">
							    <input type="hidden" name="sec" value="to-rent">
									<?php 
									echo  CHtml::hiddenField('rent_paid','yearly');
									//,'onchange'=>'load_via_ajax23(this,"locality")'
									echo  CHtml::dropDownList('state','',$city,array('class'=>'form-control select2 no-radius' ,'data-url'=>Yii::App()->createUrl('site/select_location2') ,'empty'=>'Select City')); ?> 
							</div>
                         
							<div class="col-md-7 padding-right-15 special-at-mob  not-at-mobile new-h-cls new-multiple" data-select2-id="12">
									<div class="dropdown-mul-1">
							<select style="display:none"  name="state" id="" multiple placeholder="Search by location"></select>
							</div>
							</div>
							 
									
									
                           <div class="col-md-3 padding-right-15   not-at-mobile home-home-type miniHidden proptyp proptypsale" data-select2-id="73">
							  <div class="input-group" data-select2-id="72">
                                  
                                 <button id="homeTypeToggle"  type="button" class="btn btnDefault prm"   data-open="categoryTypeToggleDiv" style="width: 100% !important;border-radius: 0px;background-color: #fff;border: 1px solid #D4D4D4 ;padding: 0px 5px 0px 15px;line-height: 40px;"   >
                                                                        <span class="nthem"><!-- react-text: 501 --><?php echo $conntroller->tag->getTag('type','Type');?></span><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                    <div id="categoryTypeToggleDiv" style="display:none;padding:10px;top:10px;position:absolute; right:0px;overflow-y:auto;width:120%;top: 41px !important; " class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer pbs txtL">
                                                                    
                                                                    
                                                                    <div class="  ">
																		 
																		  
                                                                          <div id="load_categories">
                                                                            <div class="miniCol12 smlCol24">
																				<?php 
																				$ids = 2; 
																				$categories = Category::model()->ListDataForJSON_ID_BySEctionNewSlugCache($ids );
																				 $time = rand(0,1000);
																		
																				foreach($categories as $k2=>$v2){
																					
																					if(is_array($v2)){
																						$title_h = $k2;
																						$count=0;
																								
																						foreach($v2 as $k=>$v){
																							 
																									if($count=='0'){  $time = rand(0,1000);
																									echo '<div class="pbs"><span class="fieldItem  checkbox spnblock"><input id="homeType'.$k2. $time.'" name="type_of"   onclick="propertytypechange(this,event)" ';  echo 'value="'.$k2.'" type="radio"><label for="homeType'.$k2. $time.'"><span class="melipsi">'.$title_h.'<i class="mls iconDownOpen"></i></span></label></span></div>'; 
																					
																									}
																							 $time = rand(0,1000);
																							$title_h = $v;
																						echo '<div class="pbs category_tt cat_'.$k2.' hide"><span class="fieldItem checkbox"><input id="homeType'.$k. $time.'"  class="h_type" name="type_of" ';  echo 'value="'.$k.'" type="radio"><label for="homeType'.$k. $time.'"><span class="melipsi">'.$title_h.'</span></label></span></div>'; 
																						$count++;
																						}
																					}
																				} 
																				?>
																				</div>
                                                                     
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                           
                              </div>


    
							</div>
                            <div class="col-md-2 not-at-mobile">  
									<button type="submit"   class="btn btn-secondary btn-block no-radius font-weight-bold"><?php echo $conntroller->tag->getTag('search','SEARCH');?></button>
                           </div>
                                                        <div class="special-submit-button" style="display:none">  
                              <button type="submit"   class="btn btn-secondary btn-block no-radius font-weight-bold"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/search.png');?>"></button>
                           </div>
                        </div>
						</form>
   <div style="position:relative"> 
               <div class="top-search">
                  <strong><i class="mdi mdi-keyboard"></i> <?php echo $conntroller->tag->getTag('top_search','Top Search');?> : </strong>
                  
                   <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-rent','type_of'=>'residential_Land','state'=>'all'));?>" data-id="Lands_Plots"><?php echo $conntroller->tag->getTag('land','Land');?></a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-rent','type_of'=>'residential_Villa','state'=>'all'));?>"  data-id="Villas"><?php echo $conntroller->tag->getTag('villas','Villas');?></a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-rent','type_of'=>'residential_Apartment','state'=>'all'));?>"  data-id="Apartments_Flats"><?php echo $conntroller->tag->getTag('apartments','Apartments');?></a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-rent','type_of'=>'commercial_Office','state'=>'all'));?>"  data-id="Offices"><?php echo $conntroller->tag->getTag('offices','Offices');?></a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-rent','type_of'=>'commercial_whole-building','state'=>'all'));?>"  data-id="Offices"><?php echo $conntroller->tag->getTag('buildings','Buildings');?></a> 
               </div>
			</div>
