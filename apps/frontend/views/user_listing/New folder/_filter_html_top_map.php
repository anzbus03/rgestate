  <form id="frmId" method="get" onSubmit="return false;" name="rwe">
  <style>#filterBarContainer span.miniHidden{position:relative;}</style>
  <input type="hidden" name="state" id="state" value="<?php echo $state;?>">
  <input type="hidden" name="country"  id="country" value="<?php echo $country;?>">
  <input type="hidden" name="community"  id="community_id" value="<?php echo @$community;?>">
  <input type="hidden" id="bed_val" value="<?php echo @$filterModel->bedrooms ;?>" name="bedrooms" />
  <input type="hidden" id="section_val" value="<?php echo @$filterModel->section_id ;?>" name="section_id" />
  <input type="hidden" id="bath_val" value="<?php echo @$filterModel->bathrooms ;?>" name="bathrooms" />
  <input type="hidden" id="sort_val" value="<?php echo @$filterModel->sort ;?>" name="sort" />
   <div id="filterBarContainer" style="min-height: 106px; order: 2;">
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
                                                                                <div style="display: inherit;"><button data-auto-test-id="toggleButton" class="phs btn btnDefault btnFullWidth"><span>Filters</span></button></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                            
                                                            <div style="display: inherit;">
                                                                <span class="miniHidden xxsHidden mhxs">
                                                                    <button id="sectionToggle" class="btn btnDefault prm toggleDive" onclick="openDivThis(this)" data-open="sectionToggleDiv" >
                                                                        <!-- react-text: 493 --><?php echo $filterModel->SectionViewTitle ;?> <!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button>
                                                                    <?php $this->renderPartial('_section_picker',compact('formData'));?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden mhxs">
                                                                    <button id="priceToggle" class="btn btnDefault prm toggleDive" onclick="openDivThis(this)" data-open="priceToggleDiv" >
                                                                        <!-- react-text: 493 --><?php echo $filterModel->PriceViewTitle ;?> <!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button>
                                                                    <?php $this->renderPartial('_price_picker',compact('formData'));?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden smlVisibleInline mdVisibleInline lrgVisibleInline mhxs">
                                                                    <button id="bedroomsToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="bedroomsToggleDiv"  >
                                                                        <!-- react-text: 497 --><?php echo $filterModel->BedRoomTitleIndex;?><!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button> 
                                                                    <?php $this->renderPartial('_bed_picker');?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden xsHidden smlHidden mhxs">
                                                                    <button id="homeTypeToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="homeTypeToggleDiv" >
                                                                        <!-- react-text: 501 --><?php echo $filterModel->HomeTypeTitle ;?><!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_home_type');?>
                                                                </span>
                                                                
                                                                <span class="miniHidden xxsHidden mhxs">
                                                                    <button id="moreToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="allForSaleToggleDiv">
                                                                        <!-- react-text: 513 --><?php echo $filterModel->MoreTitle ;?><!-- /react-text --><i class="mls fa fa-chevron-down"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_more_filter');?>
                                                                </span>
                                                            </div>
                                                        </span>
                                                        <div style="display: inherit;">
                                                            <span class="saveSearchContainer mhxs xxsHidden miniHidden" >
                                                               <button title="Remove filters" style="width:50px;" class="btn btnTertiary mrs mbs" onclick="removeAllFilters()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </span>
                                                        </div>
                                                        <div style="display: inherit;">
                                                            <span class="saveSearchContainer mhxs xxsHidden miniHidden">
                                                                <button class="btn btnSecondary">
                                                                    <!-- react-text: 518 --><!-- /react-text --><!-- react-text: 519 --> <!-- /react-text --><!-- react-text: 520 -->Save Search<!-- /react-text -->
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
                                     
									<?php } ?> 
									 </div>
                                   <?php } ?> 
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
                            <!-- react-empty: 368 --><!-- react-empty: 369 --><!-- react-empty: 370 -->
                            <?php /*
                            <div class=" layerMenu xxsHidden miniHidden xsHiddenLandscape">
                                <div class="box boxCard boxBasic backgroundBasic mas" style="display: inline-block;">
                                    <div class="boxBody pan">
                                        <ul class="noWrap lhn man listInline listHover">
                                            <li>
                                                <div class="txtC h6 phm pvn clickable pll">
                                                    <i class="fas fa-subway"></i>
                                                    <div class="ptxs h8">Transport</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="txtC h6 phm pvn clickable ">
                                                    <i class="fas fa-graduation-cap"></i>
                                                    <div class="ptxs h8">Schools</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="txtC h6 phm pvn clickable ">
                                                    <i class="fas fa-briefcase-medical"></i>
                                                    <div class="ptxs h8">HealthCare</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="txtC h6 phm pvn clickable miniHidden xxsHidden xsHidden">
                                                    <i class="fas fa-utensils"></i>
                                                    <div class="ptxs h8">Restaurants</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="txtC h6 phm pvn clickable miniHidden xxsHidden xsHidden smlHidden">
                                                    <i class="fas fa-leaf"></i>
                                                    <div class="ptxs h8">Parks</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="txtC h6 phm pvn clickable miniHidden xxsHidden xsHidden smlHidden">
                                                    <i class="fas fa-shopping-bag"></i>
                                                    <div class="ptxs h8">Food stores</div>
                                                </div>
                                            </li>
                                            
                                            <li>
                                                <div class="txtC h6 phm pvn clickable mdHidden prl lrgHidden xlHidden">
                                                    <i class="iconOnly iconMap"></i>
                                                    <div class="ptxs h8">More Maps</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            * */
                            ?>
                            <div id="layerForms">
                                <div></div>
                            </div>
                            <!-- react-empty: 521 --><!-- react-empty: 522 --><!-- react-empty: 523 --><!-- react-empty: 524 --><!-- react-empty: 525 --><!-- react-empty: 526 --><!-- react-empty: 527 --><!-- react-empty: 528 -->
                            <!-- <div id="mapBottomToggle">
                                <button id="mapBoundaryToggle" class="btn btnDefault h7 typeEmphasize xsVisible smlVisible mdVisible lrgVisible">Remove Map Boundary</button>
                                <div id="mapResultsCountMessage" class="h7 pvxs mvn typeWeightNormal typeReversed overlayLowlight miniCol24 xxsCol24 xsCol24Landscape mapOpen">Showing 30 of 7717, zoom to see more</div>
                            </div> -->
                        </div>
                        <!-- react-empty: 424 -->
                    </div>
                </div>
            </div>
</form>
           
