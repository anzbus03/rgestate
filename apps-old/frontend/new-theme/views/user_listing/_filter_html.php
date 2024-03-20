  <form id="frmId" method="get" onSubmit="return false;" name="rwe">
   <div id="filterBarContainer" style="order: 2;" class="">
                <div id="filterBar" style="position: fixed;" class="">
                    <div data-reactroot="">
                        <div id="custom-app-download-banner" style="top: 0px;">
                            <!-- react-empty: 3 -->
                        </div>
                        <div class="container phn" data-auto-test-id="searchContainer">
                            <div class="row pvs phm" style="padding-left:0px !important;" >
                                <div id="defaultFilterBar">
                                    <div class="smlCol17 xsCol15 xxsCol24 miniCol24" style="padding-left:0px;">
                                        <div class="form mbn">
                                            <div class="field mbn" style="display:flex">
                                                <div class="fieldGroupInline">
                                                    <span id="filterToggles" data-auto-test-id="searchFilters">
                                                        <span>
                                                        
                                                            
                                                            <div style="display: inherit;">
																<span class="miniHidden xxsHidden mhxs">
																<a  class="btn btnDefault <?php echo $user_type=='A' ? 'rent_btn' : '';?> " href="<?php echo Yii::app()->createUrl('user_listing/index',array( 'user_type'=>'A'));?>">
																																Agent
																</a>
																</span>
																<a  class="btn btnDefault <?php echo $user_type=='C' ? 'rent_btn' : '';?> " href="<?php echo Yii::app()->createUrl('user_listing/index',array( 'user_type'=>'C'));?>">
																 
																Agencies
																 </a>
																</span>
                                                                 <div class="new_filter_option"><button data-auto-test-id="toggleButton" class="phs btn btnDefault btnFullWidth" onclick="showMoreFilters()" ><span>Filters++</span></button></div>
                                                                  
                                                            </div>
                                                        </span>
                                                             <span class="fieldItem fieldAppend text">
                                                    <div id="locationField">
                                                        <div class="horizontalContainer">
                                                            <div data-auto-test-id="searchAutosuggest" style="flex: 1 1 0%;">
                                                                <div style="position: relative;">
                                                                    <input value="<?php echo $title;?>" autocomplete="off" role="combobox"   aria-autocomplete="list" aria-owns="react-autowhatever-1" aria-expanded="false" aria-haspopup="false" placeholder="Enter a location" id="locationInputs" type="text">
                                                                    <div id="react-autowhatever-1"></div>
                                                                </div>
                                                            </div>
                                                            <div><button class="addOn btn btnDefault" aria-label="Search" id="dropdownBtn2" data-auto-test-id="searchButton"><i class="fa fa-search"></i></button></div>
                                                        </div>
                                                    </div>
                                                </span>
                                                    </span>
                                                </div>
                                             <div class="field">
                                           
                                            </div>
                                            </div>
                                        </div>
                                          <div class="form">
                                           
                                        </div>
                                   
                                    </div>
                                    <div class="smlCol7 xsCol9 xxsCol24 miniCol24">
                                   </div>
                                    
                                </div>
                            </div>
                                  <div id="filterFormContainer">
                                <div class="xsColOffset9 smlColOffset7 xsCol15 smlCol17">
                                    <div class="form mvn">
                                        <div id="filtersContainer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                          
                            <div id="layerForms">
                                <div></div>
                            </div>
                            
                        </div>
                        <!-- react-empty: 424 -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
	<div id="height-balance4"></div>
</form>
 
<script>
	$(function(){ var filter_bar_height =  $('#filterBar').height();  $('#height-balance4').css('height',filter_bar_height+'px')  })
function showMiniFilters(){
	$('.miniHidden').toggleClass('show')
}
function showMoreFilters(){
	$('#defaultFilterBar').find('.smlCol17').addClass('fullWHt');
}
</script>           
