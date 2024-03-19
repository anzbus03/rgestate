   <div id="categoryTypeToggleDiv" style="display:none;padding:10px;top:10px;position:absolute; left:0px;max-height:300px;overflow-y:auto;width:280px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer pbs txtL">
                                                                    
                                                                    
                                                                    <div class="  ">
																			<?php 
                                                                    /*
																		$list_type = Category::model()->listingTypeArrayMainData();
																		  
																		?>
																		<div class="list_type">
																		<ul style="display: flex;" class="list_typeD">
																		<?php 
																		foreach($list_type as $k=>$v){
																			$checked = ( isset($formData['listing_type']) and $formData['listing_type'] == $k) ? 'checked="true"' : ''; 
																			echo '<input type="radio"  style="display:none;position:absolute;" '.$checked.' onchange="loadSubcategoriest(this)"  id="listing_type_'.$k.'" name="listing_type"  value="'.$k.'"><label for="listing_type_'.$k.'"><li>'.$v.'</li></label>';
																		}
																		?>
																		</ul>
																	 
																		</div>
																		*/
																		?>
                                                                          <div id="load_categories">
                                                                            <div class="miniCol12 smlCol24">
																				<?php 
																				$ids =  !empty($sec) ? $sec : ''; 
																				$categories = Category::model()->ListDataForJSON_ID_BySEctionNewSlug($ids );
																				 $time = rand(0,1000);
																				  
																				foreach($categories as $k=>$v){
																					$title_h = $v;
																					echo '<div class="pbs"><span class="fieldItem checkbox"><input id="homeType'.$k. $time.'"  class="h_type" name="type_of" ';  echo 'value="'.$k.'" type="radio"><label for="homeType'.$k. $time.'"><span class="melipsi">'.$title_h.'</span></label></span></div>'; 
																				} 
																				?>
																				</div>
                                                                     
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <script> var load_category_url = '<?php echo Yii::App()->createUrl('site/load_category_url');?>'</script>
