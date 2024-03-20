  <form id="frmId" method="get" onSubmit="return false;" name="rwe">
  <style>#filterBarContainer span.miniHidden{position:relative;}</style>
  <input type="hidden" name="state" id="state" value="<?php echo $state;?>">
  <input type="hidden" name="country"  id="country" value="<?php echo $country;?>">
  <input type="hidden" name="community"  id="community_id" value="<?php echo @$community;?>">
  <input type="hidden" id="bed_val" value="<?php echo @$filterModel->bedrooms ;?>" name="bedrooms" />
  <input type="hidden" id="section_val" value="<?php echo @$filterModel->section_id ;?>" name="sec" />
  <input type="hidden" id="listing_type" value="<?php echo @$filterModel->listing_type ;?>" name="listing_type" />
  <input type="hidden" id="bath_val" value="<?php echo @$filterModel->bathrooms ;?>" name="bathrooms" />
  <input type="hidden" id="sort_val" value="<?php echo @$filterModel->sort ;?>" name="sort" />
   <div id="filterBarContainer" style="order: 2;">
                <div id="filterBar" style="position: fixed;" class="">
                    <div data-reactroot="">
                        <div id="custom-app-download-banner" style="top: 0px;">
                            <!-- react-empty: 3 -->
                        </div>
                        <div class="containerFluid phn" data-auto-test-id="searchContainer">
                            <div class="row pvs phm">
                                <div id="defaultFilterBar">
                                    <div class="smlCol7 xsCol9 xxsCol24 miniCol24">
                                        <div class="form">
                                            <div class="field">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="smlCol17 xsCol15 xxsCol24 miniCol24">
                                        <div class="form mbn">
                                            <div class="field mbn">
                                                <div class="fieldGroupInline">
                                                    <span id="filterToggles" data-auto-test-id="searchFilters">
                                                        <span>
                                                            <span class="miniVisible xxsVisible">
                                                                <div class="form mvn">
                                                                    <div class="horizontalContainer">
                                                                        <div style="flex: 4 1 0%;">
                                                                            <div class="field mtn pln">
                                                                             
                                                                            </div>
                                                                        </div>
                                                                        <div style="flex: 1 1 0%;">
                                                                            <div class="field plm mtn">
                                                                                <div style="display: inherit;"><button data-auto-test-id="toggleButton" class="phs btn btnDefault btnFullWidth"  onclick="showMiniFilters()"><span>Filters</span></button></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                            
                                                            <div style="display: inherit;">
                                                                <span class="miniHidden xxsHidden mhxs section_picker  " >
                                                                    <button id="sectionToggle" class="btn btnDefault prm toggleDive rent_btn" onclick="openDivThis(this)" data-open="sectionToggleDiv" >
                                                                        <!-- react-text: 493 --><?php echo $filterModel->SectionViewTitle ;?> <!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button>
                                                                    <?php $this->renderPartial('_section_picker',compact('formData'));?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden mhxs price_picker">
                                                                    <button id="priceToggle" class="btn btnDefault prm toggleDive" onclick="openDivThis(this)" data-open="priceToggleDiv" >
                                                                        <!-- react-text: 493 --><?php echo $filterModel->PriceViewTitle ;?> <!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button>
                                                                    <?php $this->renderPartial('_price_picker',compact('formData'));?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden smlVisibleInline mdVisibleInline lrgVisibleInline mhxs  spl-clas-six">
                                                                    <button id="bedroomsToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="bedroomsToggleDiv"  >
                                                                        <!-- react-text: 497 --><?php echo $filterModel->BedRoomTitleIndex;?><!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button> 
                                                                    <?php $this->renderPartial('_bed_picker');?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden xsHidden smlHidden mhxs  spl-clas-six">
                                                                    <button id="homeTypeToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="homeTypeToggleDiv" >
                                                                        <!-- react-text: 501 --><?php echo $filterModel->HomeTypeTitle ;?><!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_home_type');?>
                                                                </span>
                                                                
                                                                <span class="miniHidden xxsHidden mhxs  spl-clas-six">
                                                                    <button id="moreToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="allForSaleToggleDiv">
                                                                        <!-- react-text: 513 --><?php echo $filterModel->MoreTitle ;?><!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_more_filter');?>
                                                                </span>
                                                                 <div class="new_filter_option"><button data-auto-test-id="toggleButton" class="phs btn btnDefault btnFullWidth" onclick="showMoreFilters()" ><span>Filters++</span></button></div>
                                                                  
                                                            </div>
                                                        </span>
                                                        
                                                       <div style="display: inherit;position:relative;">
															<span class="saveSearchContainer mhxs xxsHidden miniHidden abc_sec" >
                                                               <button title="Remove filters" style="width:50px;" class="btn btnTertiary mrs mbs" onclick="removeAllFilters()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </span>
                                                             <span class="saveSearchContainer mhxs xxsHidden miniHidden abc_sec srch pull-right">
                                                                <button class="btn btnSecondary"  id="fav_button_url" onclick="<?php if($this->app->user->getId()){ echo 'event.preventDefault();savetofavourite(this)'; }else{ echo 'event.preventDefault();OpenSignUp(this)';}?>" data-function="save_search" data-id="<?php echo base64_encode($search_url);?>"  data-after="saved_search" style="min-width:  139px;" data-reactid="<?php echo $search_url;?>">
                                                                    <!-- react-text: 518 --><!-- /react-text --><!-- react-text: 519 --> <!-- /react-text --><!-- react-text: 520 --><?php if(!empty($found_search)){ echo 'Remove Search'; }else{ echo 'Save Search'; }?><!-- /react-text -->
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pvs phm">
                            <!-- <div class="smlCol6 xsCol4 xxsCol8 miniCo8">
                            <span class="miniHidden xxsHidden mhxs">
	                                <button class="btn btnDefault btn-dev prm">
	                                    Developers
	                                </button>
	                            </span>
	                            <span class="miniHidden xxsHidden mhxs">
	                                <button class="btn btnSecondary prm">
	                                    Agents
	                                </button>
	                            </span>
	                       	</div> -->
	                       	<?php
									if(!empty($load_location)){ ?> 
                                    <div class="smlCol16 xsCo20 xxsCol40 miniCol40">
										<?php
										foreach($load_location as $k=>$v){ ?>
                                       <span class="miniHidden xxsHidden mhxs">
                                           <button class="btn btnDefault prm <?php echo $v->state_id==$active_state ? 'rent_btn':'';?>" onclick="setSteThis(this)" data-state="<?php echo $v->slug;?>" data-country="<?php echo $v->country_slug;?>" >
                                               <?php echo $v->state_name;?>
                                           </button>
                                       </span>
                                     
									<?php }
									
									
									 ?> 
									 </div>
                                   <?php }
                                   else{
										?>
										<style>
										#map-load .gm-style {
										top: 128px !important;
										bottom: 0px !important;
										height: calc(100% - 128px) !important;
										}
										</style>
										<?
									}
                                   
                                    ?> 
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
