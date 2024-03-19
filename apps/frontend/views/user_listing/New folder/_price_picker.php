   <div id="priceToggleDiv" style="display:none;padding:10px;top:10px;position:absolute;width:250px;left:0px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer">
                                                                <ul class="listInline">
                                                                    <li class="miniCol11 pln pbxs">
                                                                        <span class="fieldItem fieldTouch select3">
                                                                            <div class="selectPretty">
                                                                                <select id="minPrice1" name="minPrice" onchange="alertthisVal(this)">
                                                                                    <option value="">No Min</option>
                                                                                    <?php 
                                                                                    $price_array =  $filterModel->getPriceArray();
                                                                                    $min_text = 'No Min';
                                                                               
                                                                                    foreach($price_array as $k=>$v){
																						$selected ='';
																						if(isset($formData['minPrice']) and $formData['minPrice']==$k ){
																							 $min_text =  $v;$selected ='selected=true';  
																						}
																						echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
																					}
                                                                                    ?>
                                                                                     
                                                                                </select>
                                                                                <div class="selectDisplay btn btnTouch btnDefault"><span class="selectLabel"><?php echo $min_text;?></span><span class="selectTrigger"><i class="fa fa-chevron-down"></i></span></div>
                                                                            </div>
                                                                        </span>
                                                                    </li>
                                                                    <li class="miniCol2 prs">
                                                                        <div class="pts">–</div>
                                                                    </li>
                                                                    <li class="miniCol11 prn">
                                                                        <span class="fieldItem fieldTouch select">
                                                                            <div class="selectPretty">
                                                                                <select id="maxPrice"  name="maxPrice" onchange="alertthisVal(this)">
																					<option value="">No Max</option>
                                                                                    <?php 
                                                                                    $price_array =  $filterModel->getPriceArray();
                                                                                    $max_text = 'No Max';
                                                                                    foreach($price_array as $k=>$v){
																						$selected ='';
																						if(isset($formData['maxPrice']) and $formData['maxPrice']==$k ){
																							  $max_text =  $v;$selected ='selected=true';  
																						}
																						echo '<option value="'.$k.'" '.$selected .'>'.$v.'</option>';
																					}
                                                                                    ?>
                                                                                </select>
                                                                                <div class="selectDisplay btn btnTouch btnDefault"><span class="selectLabel"><?php echo $max_text;?></span><span class="selectTrigger"><i class="iconDownOpen"></i></span></div>
                                                                            </div>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            
