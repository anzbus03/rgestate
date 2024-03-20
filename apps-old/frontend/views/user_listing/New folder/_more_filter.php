      <div  id="allForSaleToggleDiv" style="display:none;padding:10px;top:10px;position:absolute;right:0px;height:300px;overflow-y:scroll;width:330px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation xxsHidden miniHidden pam txtC">
                                                <div id="filterForm" class="containerFluid phm">
                                                   
                                                    <div class="row">
                                                         
                                                            <div class="miniCol24">
                                                                <label class="lrgHidden fieldLabel">Keywords</label>
                                                                <div id="keywordsDropdown" class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer box boxBasic backgroundBasic txtL">
                                                                    <div>
                                                                        <div class="field mvn" >
                                                                            <div class="fieldItem text line pbs">
                                                                                <div class="col cols19 pln">
                                                                                    <div class="suggestions" style="text-align:center;" >
                                                                                        <input style="width:70%;;"  autocomplete="off" role="combobox" aria-autocomplete="list" aria-owns="react-autowhatever-1" aria-expanded="false" aria-haspopup="false" id="keywordInput" placeholder="Pool, Parking..." name="keyword" value="<?php echo $filterModel->keyword;?>" class="fieldTouch" type="text">
                                                                                        <div id="react-autowhatever-1"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- react-empty: 301 -->
                                                                    </div>
                                                                </div>
                                                                <div class="lrgHidden pbxl"></div>
                                                            </div>
                                                            <div class="xxsCol24">
                                                                <div id="moreFilters">
                                                                    <div id="bathrooms" class="field pbxxl">
                                                                        <label class="fieldLabel">Bathrooms</label>
                                                                        <div class="zIndexNavigation filterContainer">
                                                                            <div class="field man">
                                                                                <div class="btnGroup bedCls">
																					<?php
																					$bath_rooms = $filterModel->bathroomSearchIndex();
																					foreach($bath_rooms  as $k=>$v){
																					echo '<button class="btn btnDefault btnTouch ';echo  ( $filterModel->bathrooms== $k ) ?'btnSecondary':'' ; echo '" onclick="setThisBathroomVal(this)" data-value="'.$k.'">'.$v.'</button>';

																					}
																					?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="currentSquareFeetRangeField" class="pbxxl">
                                                                        <div class="field">
                                                                            <label class="fieldLabel">Square Feet</label>
                                                                            <div>
                                                                                <div class="fieldGroupInline">
                                                                                    <span class="fieldItem text" style="width: 85px;"><input class="fieldTouch" inputmode="numeric"   name="minSqft"  value="<?php echo $filterModel->minSqft;?>"  id="minSqft" placeholder="Min sqft" type="text"></span><!-- react-text: 323 -->&nbsp;–&nbsp;<!-- /react-text --><span class="fieldItem text" style="width: 85px;"><input class="fieldTouch" inputmode="numeric"  id="maxSqft"  name="maxSqft"  value="<?php echo $filterModel->maxSqft;?>" placeholder="Max sqft" type="text"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="lotSize" class="pbxxl hidden">
                                                                        <label class="fieldLabel">Lot Size</label>
                                                                        <span class="fieldItem fieldTouch select">
                                                                            <div class="selectPretty">
                                                                                <select id="lotSize">
                                                                                    <option value="">No Min</option>
                                                                                    <?php
                                                                                    /*
                                                                                    $min_text = 'No Min';
                                                                                    $squarefeet = $filterModel->squareFeetSearch() ;
                                                                                    foreach($squarefeet as $k=>$v){
																						$selected ='';
																						if($formData->minSqft==$k ){
																							 $min_text =  $v;$selected ='selected=true';  
																						}
																						echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
																					}
																					* */
																					?>
                                                                                </select>
                                                                                <div class="selectDisplay btn btnTouch btnDefault"><span class="selectLabel">No Min</span><span class="selectTrigger"><i class="iconDownOpen"></i></span></div>
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                    <div id="yearBuilt" class="pbxxl hidden">
                                                                        <div class="field">
                                                                            <label class="fieldLabel">Year Built</label>
                                                                            <div>
                                                                                <div class="fieldGroupInline">
                                                                                    <span class="fieldItem text" style="width: 85px;"><input class="fieldTouch" inputmode="numeric" maxlength="4" value="" id="minYearBuilt" placeholder="Min Yr" type="text"></span><!-- react-text: 355 -->&nbsp;–&nbsp;<!-- /react-text --><span class="fieldItem text" style="width: 85px;"><input class="fieldTouch" inputmode="numeric" maxlength="4" value="" id="maxYearBuilt" placeholder="Max Yr" type="text"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- react-empty: 358 -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mbxxl">&nbsp;</div>
                                                    </div>
                                                </div>
                                   
                                      
