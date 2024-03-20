      <div  id="allForSaleToggleDiv" style="display:none;padding:10px;top:10px;position:absolute;left:0px;height:auto;overflow-y:auto;width:330px;" class="box boxCard boxBasic backgroundBasic zIndexNavigation xxsHidden   pam txtC">
                                                <div id="filterForm" class="moredetailsFrm phm" >
                                                   
                                                    <div class="row">
                                                         
                                                             <div class="xxsCol24 margin-top-15">
                                                                <div id="moreFilters">
															<div class="row  form-group bedroomsclass">
																	         <div id="bedrooms" class="field pbxxl">
                                                                        <label class="fieldLabel"><?php echo  $this->tag->getTag('bedrooms','Bedrooms') ;?></label>
                                                                        <div class="zIndexNavigation filterContainer">
                                                                            <div class="field man">
                                                                                <div class="btnGroup bedCls">
																					<?php
																					$bath_rooms = $filterModel->bedroomSearchIndex();
																					foreach($bath_rooms  as $k=>$v){
																					echo '<button dir="ltr" class="btn btnDefault margin-right-2 btnTouch ';echo  ( $filterModel->bedrooms== $k ) ?'btnSecondary':'' ; echo '" onclick="setThisBedroomVal(this)" data-value="'.$k.'">'.$v.'</button>';

																					}
																					?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
																	</div>
															<div class="clearfix"></div>

																	<div class="row  form-group bedroomsclass margin-top-15">
																	 <div id="bathrooms" class="field pbxxl">
                                                                        <label class="fieldLabel"><?php echo  $this->tag->getTag('bathrooms','Bathrooms') ;?></label>
                                                                        <div class="zIndexNavigation filterContainer">
                                                                            <div class="field man">
                                                                                <div class="btnGroup BathCls">
																					<?php
																					$bath_rooms = $filterModel->bathroomSearchIndex();
																					foreach($bath_rooms  as $k=>$v){
																					echo '<button dir="ltr" class="btn btnDefault margin-right-2 btnTouch ';echo  ( $filterModel->bathrooms== $k ) ?'btnSecondary':'' ; echo '" onclick="setThisBathroomVal(this)" data-value="'.$k.'">'.$v.'</button>';

																					}
																					?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
																	</div>
                                                                
                                                                    
                                                                     <div class="row  form-group bedroomsclass margin-top-15 margin-bottom-15 " style="margin-bottom:15px !important">
                                                                        <div class="col-sm-12 padding-left-0">
                                                                            <label class="fieldLabel"><?php echo Yii::t('app',$this->tag->getTag('land_size','Land Size'));?>   </label>
                                                                                         
                                                                            <div>
																				 <div style="width:calc(100% - 110px);" class="pull-left">
																						<div class="fieldGroupInline" style="display:flex">
																							<div class="fieldItem text"  ><input class="input-text  form-control slect" inputmode="numeric"   name="minSqft"  value="<?php echo $filterModel->minSqft;?>"  id="minSqft" placeholder="<?php echo $this->tag->getTag('min','Min') ;?>" type="text"></div><!-- react-text: 323 --><div style="width: 30px;vertical-align: middle;margin: 0px 0px;text-align:center">&nbsp;–&nbsp;</div><!-- /react-text --><div class="fieldItem text"  ><input class="input-text  form-control slect" inputmode="numeric"  id="maxSqft"  name="maxSqft"  value="<?php echo $filterModel->maxSqft;?>" placeholder="<?php echo  $this->tag->getTag('max','Max')  ;?>" type="text"></div>
																						</div>
                                                                                </div>
																				 <div style="width:100px;position:relative;" class="pull-right">
																				 <?php 
$paid_array =  AreaUnit::model()->ListDataSort();  ?> 
<style>
  .opened   .home-home-type-areauunit .boxCard.a-unit-open { display:none !important; }
    .home-home-type-areauunit.opened .boxCard.a-unit-open { display:block !important; }
    #listing .opened .home-home-type-areauunit #sectTypeToggle  {    border: 1px solid #d4d4d4 !important;    border-bottom: 1px solid #d4d4d4 !important; }
     #listing .opened .home-home-type-areauunit.opened #sectTypeToggle  {    border: 2px solid var(--logo-color) !important;    border-bottom: 0px !important; }
</style>
<script>
function openDivThis2(){
 $('.home-home-type-areauunit').toggleClass('opened')
}
    
</script>
  <div   class="home-home-type-areauunit miniHidden proptyp sm-d-flt sctorSect mx-82" onmouseleave="closeOpened(this)"  style="margin: 0px !important;max-width: 100% !important;min-width: 100% !important;">
                               			 
										  <div class="input-group " data-select2-id="72">
                          
                     
                                 <button id="sectTypeToggle"  type="button" class="btn btnDefault prm"  onclick="openDivThis2(this)" data-open="sectTypeToggleDiv" style=""    >
                                                                        <!-- react-text: 501 -->
                                                                        
                                                                        <span id="st_title2"><?php
                                                                         echo isset($paid_array[@$_GET['area_unit']]) ? $paid_array[@$_GET['area_unit']]: $paid_array[AREAUNIT] 
                                                                        ?></span><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                    <div id="sectTypeToggleDiv"   class="box boxCard boxBasic aunit backgroundBasic a-unit-open zIndexNavigation filterContainer pbs txtL">
                                                                    
                                                                    
                                                                    <div class="  " style="    max-height: 57px;    overflow-y: auto;">
																	 
					
                                                                          <div id="load_categories">
                                                                            <div class="miniCol12 smlCol24">
																					 
																						<?php
																						
																					 	foreach($paid_array as $k=>$v){ 
																							$checked ='';  		 
																								if($k==$filterModel->area_unit){  $checked =  'checked="true"';}else{ $checked = '';  }
																						
																						echo '<div class="pbs category_tt cati_'.$k.'  "><span class="fieldItem checkbox"><input id="area_unit'.$k.'"  class="h_type flabele" name="area_unit" '.$checked.' value="'.$k.'" onchange="setAreaUnit(this)" data-value="'.$v.'" type="radio"><label for="area_unit'.$k.'"><span class="melipsi">'.$v.'</span></label></span></div>'; 
																						 
																						}	
																						?>
																				</div>
                                                                     
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                              </div>

                                  </div>
                               
                           

																				</div>
                                                                                
                                                                                
                                                                            </div>
                                                                        </div>
                                                                       	<div class="clearfix"></div>
                                                                        <div id="currentSquareFeetRangeField" class="pbxxl" style="display: none;">
                                                                        <div class="field">
                                                                            <label class="fieldLabel"><?php echo 'Agency' ;?></label>
                                                                            <div>
                                                                                <div class="fieldGroupInline fulld">
                                                                                    <span class="fieldItem text" style="width: 185px;">
                                                                                    <select id="user_select" name="dealer"   style="width:100%;" data-url="<?php echo Yii::app()->createUrl('site/customer');?>" >
																						<option value="">Select Agency</option>
																						<?php
																						if(!empty($userM)){ ?> 
																							<option value="<?php echo $userM->slug;?>"  selected="true" ><?php echo $userM->fullName;?></option>
																						<?php } ?> 
																						</select>
																						<script>
																				         $(function(){
																							// load_user('Select Agency') ;                                                                         
																						 })
                                                                                    </script>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    </div>
                                                                    
                                                                    <?php
                                                                    /*
                                                                    <div id="currentSquareFeetRangeField" class="pbxxl hide">
                                                                        <div class="field">
                                                                            <label class="fieldLabel"><?php echo 'Agents/Company' ;?></label>
                                                                            <div>
                                                                                <div class="fieldGroupInline">
                                                                                    <span class="fieldItem text" style="width: 185px;">
                                                                                    <select id="user" name="dealer" style="width:100%;">
																						<option value="">Select Dealer</option>
																						<?php
																						if(!empty($userM)){ ?> 
																							<option value="<?php echo $userM->slug;?>"  selected="true" ><?php echo $userM->fullName;?></option>
																						<?php } ?> 
																						</select>
																						<script>
																						var agent_Developer = '<?php echo Yii::App()->createUrl('site/search_agent');?>'
																				         $(function(){
																							 userSelect() ;                                                                         var agent_Developer = '<?php echo Yii::App()->createUrl('site/search_agent');?>'
																						 })
                                                                                    </script>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    * */
                                                                    ?>
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
                                                        <div class="clearfix"></div>
                                                        <div class="row  form-group bedroomsclass margin-top-0 margin-bottom-15 ">
															<div class="col-sm-12 padding-left-0"> 
                                                        <button type="button" class="ornge-cl" style="width: 100%;border: 1px solid var(--logo-color);margin:auto;background: #fff;color: var(--logo-color);padding: 0px;font-weight: bold;" onclick="timuteChange()"><?php echo $this->tag->getTag('apply','Apply');?></button>
                                                       </div>
                                                       </div>
                                                    </div>
                                                </div>
                                   
                                      
