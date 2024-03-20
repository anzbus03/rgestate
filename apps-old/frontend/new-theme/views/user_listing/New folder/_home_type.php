   <div id="homeTypeToggleDiv" style="display:none;padding:10px;top:10px;position:absolute; right:0px;height:300px;overflow-y:scroll;width:250px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer pbs txtL">
                                                                    <div class="containerFluid ">
                                                                        <div>
                                                                            <div class="miniCol12 smlCol24">
																				<?php 
																				$categories = Category::model()->ListData();
																				foreach($categories as $k=>$v){
																					echo '<div class="pbs"><span class="fieldItem checkbox"><input id="homeType'.$v->category_id.'" name="type_of[]" ';if(is_array($filterModel->type_of) and in_array($v->category_id,$filterModel->type_of)){ echo 'checked="true"'; } echo 'value="'.$v->category_id.'" type="checkbox"><label for="homeType'.$v->category_id.'">'.$v->category_name.'</label></span></div>'; 
																				} 
																				?>
																				</div>
                                                                     
                                                                        </div>
                                                                    </div>
                                                                </div>
