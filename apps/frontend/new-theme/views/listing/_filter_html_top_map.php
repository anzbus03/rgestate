  <form id="frmId" method="get" onSubmit="return false;" name="rwe">
  <style>#filterBarContainer span.miniHidden{position:relative;}</style>
  <input type="hidden" name="state" id="state" value="<?php echo $state;?>">
  <?php /* 
  <input type="hidden" name="country"  id="country" value="<?php echo $country;?>">
  * */
  ?>
  <input type="hidden" name="city"  id="city" value="<?php echo $city;?>">
  <input type="hidden" name="community"  id="community_id" value="<?php echo @$community;?>">
  <input type="hidden" id="bed_val" value="<?php echo @$filterModel->bedrooms ;?>" name="bedrooms" />
  <input type="hidden" id="section_val" value="<?php echo @$filterModel->section_id ;?>" name="sec" />
  <input type="hidden" id="bath_val" value="<?php echo @$filterModel->bathrooms ;?>" name="bathrooms" />
  <input type="hidden" id="sort_val" value="<?php echo @$filterModel->sort ;?>" name="sort" />
  <input type="hidden" id="recommended_val" value="<?php echo @$filterModel->recmnded ;?>" name="recommended" />
  <input type="hidden" id="poplar_area_val" value="<?php echo @$filterModel->poplar_area ;?>" name="poplar_area" />
  <input type="hidden" id="keyword_val" value="<?php echo @$formData['keywords'] ;?>" name="keywords" />
   <div id="filterBarContainer" style="min-height: 60px; order: 2;">
                <div id="filterBar" style="position: fixed;" class="">
                    <div data-reactroot="">
                        <div id="custom-app-download-banner" style="top: 0px;">
                            <!-- react-empty: 3 -->
                        </div>
                        <div class="containerFluid phn" data-auto-test-id="searchContainer">
                            <div class="row pvs phm">
                                <div id="defaultFilterBar">
                                    <div class="smlCol5  xsCol9 xxsCol24 miniCol24">
                                        <div class="form">
                                            <div class="field">
                                                <span class="fieldItem fieldAppend text">
                                                    <div id="locationField">
                                                        <div class="horizontalContainer">
                                                            <div data-auto-test-id="searchAutosuggest" style="flex: 1 1 0%;">
                                                                <div style="position: relative;">
                                                                    <input value="<?php echo @$formData['keywords'];?>" class="ajx"  autocomplete="off" role="combobox"   aria-autocomplete="list" aria-owns="react-autowhatever-1" aria-expanded="false" aria-haspopup="false" placeholder="<?php echo  'Search apartment , flat for sale / rent etc.' ;?>" id="locationInputs23" type="text">
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
                                             <div class="hidden filterd"><button data-auto-test-id="toggleButton"    class="phs btn btnDefault btnFullWidth"  onclick="showMiniFilters()"><span><?php echo  'Filters' ;?></span></button></div>
                                   
                                    <div class="smlCol19 xsCol15 xxsCol24 miniCol24">
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
                                                                                <div style="display: inherit;"><button data-auto-test-id="toggleButton" id="toggleButtonv" class="phs btn btnDefault btnFullWidth"  onclick="showMiniFilters()"><span><?php echo  'Filters' ;?></span></button></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </span>
                                                            
                                                            <div style="display: inherit;">
                                                                <span class="miniHidden xxsHidden mhxs section_picker hide">
                                                                    <button id="sectionToggle" class="btn btnDefault prm toggleDive rent_btn" onclick="openDivThis(this)" data-open="sectionToggleDiv" >
                                                                        <!-- react-text: 493 --><?php echo $filterModel->SectionViewTitle ;?> <!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                    <?php $this->renderPartial('_section_picker',compact('formData'));?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden mhxs price_picker">
                                                                    <button id="priceToggle" class="btn btnDefault prm toggleDive" onclick="openDivThis(this)" data-open="priceToggleDiv" >
                                                                        <!-- react-text: 493 --><?php echo $filterModel->PriceViewTitle ;?> <!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                    <?php $this->renderPartial('_price_picker',compact('formData'));?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden smlVisibleInline mdVisibleInline lrgVisibleInline mhxs  spl-clas-six">
                                                                    <button id="bedroomsToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="bedroomsToggleDiv"  >
                                                                        <!-- react-text: 497 --><?php echo $filterModel->BedRoomTitleIndex;?><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button> 
                                                                    <?php $this->renderPartial('_bed_picker');?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden xsHidden smlHidden mhxs  spl-clas-six">
                                                                    <button id="homeTypeToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="homeTypeToggleDiv" >
                                                                        <!-- react-text: 501 --><?php echo $filterModel->HomeTypeTitle ;?><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_home_type');?>
                                                                </span>
                                                                <span class="miniHidden xxsHidden xsHidden smlHidden mhxs  spl-clas-six">
                                                                    <button id="homeTypeToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="categoryTypeToggleDiv" >
                                                                        <!-- react-text: 501 --><?php echo $filterModel->CategoryTypeTitle ;?><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_category_type');?>
                                                                </span>
                                                                
                                                                <span class="miniHidden xxsHidden mhxs  spl-clas-six">
                                                                    <button id="moreToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="allForSaleToggleDiv">
                                                                        <!-- react-text: 513 --><?php echo $filterModel->MoreTitle ;?><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_more_filter');?>
                                                                </span>
                                                                 <div class="new_filter_option"><button data-auto-test-id="toggleButton" class="phs btn btnDefault btnFullWidth" onclick="showMoreFilters()" ><span><?php echo  'Filters' ;?>++</span></button></div>
                                                                  
                                                            </div>
                                                        </span>
                                                        <div style="display: inherit;">
                                                            <span class="saveSearchContainer   mhxs xxsHidden miniHidden abc_sec " >
                                                               <button title="Remove filters" style="width:50px;" class="btn btnTertiary mrs mbs" onclick="removeAllFilters()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </span>
                                                              <span class="saveSearchContainer mhxs xxsHidden miniHidden abc_sec  srch ">
                                                                <button class="btn btnSecondary sssrv"  id="fav_button_url" onclick="search_byAjax()"  >
                                                                  <?php echo 'Search' ;?>
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
                            <div class="row pvs phm hidden">
                           
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
                            
                            <div id="layerForms">
                                <div></div>
                            </div>
                            
                        </div>
                        <!-- react-empty: 424 -->
                    </div>
                </div>
            </div>
</form>
           
<script>
function showMiniFilters(){
	$('.miniHidden').toggleClass('show')
}
function showMoreFilters(){
	$('#defaultFilterBar').find('.smlCol17').addClass('fullWHt');
}
</script>   
<style>
    .form .fieldGroupInline .fieldItem, .form .fieldGroupInline label{ display:inline; }
    #homeTypeToggleDiv .pbs input[type="checkbox"] { vertical-align: middle !important;}
</style>
