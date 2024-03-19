   <div id="homeTypeToggleDiv" style="display:none;padding:10px;top:10px;position:absolute; right:0px;max-height:300px;height:auto;overflow-y:auto;width:180px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer pbs txtL">
                                                                    <div class="containerFluid ">
																		
																	
																		
                                                                        <div>
                                                                            <div class="miniCol12 smlCol24">
																				<?php 
																				$categories =  Category::model()->listingTypeArray();
																				foreach($categories as $k=>$v){
																					$title_h = $v;
																					echo '<div class="pbs"><span class="fieldItem checkbox"><input id="homeType'.$k.'" name="type_of[]" ';if(is_array($filterModel->type_of) and in_array($k,$filterModel->type_of)){ echo 'checked="true"'; } echo 'value="'.$k.'" type="checkbox"><label for="homeType'.$k.'">'.$v.'</label></span></div>'; 
																				} 
																				?>
																				</div>
                                                                     
                                                                        </div>
                                                                    </div>
                                                                </div>
