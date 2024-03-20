<form id="frmId" method="get" class="blackheader2" style="z-index: 112;position: relative;" autocomplete="off" onSubmit="return false;" name="rwe">
 
  <style>#filterBarContainer span.miniHidden{position:relative;}.price_picker button{ min-width:unset !important; }
  #listing .itmSelected .select2-selection {    border-color: var(--secondary-color) !important;  }
  #listing .itmSelected  .select2-container--open .select2-selection {    border-color: var(--logo-color) !important;  }
  #listing .itmSelected .select2-container--default .select2-selection--single .select2-selection__arrow b::before {
    color: var(--secondary-color) !important;
  }
  #listing .slider-form.advamced .itmSelected .jNhpJt{  border: 1px solid  var(--secondary-color); }
  #listing .itmSelected .pbs .mls {
    color: var(--black-color);
}
#listing .newheader_dropdown_action.srter.active.itmSelected .newheader_useravatar_name  {
    color: var(--secondary-color) !important;
}
#listing .slider-form.advamced .newheader_dropdown_action.srter.active.itmSelected  {
   
    border-color:  var(--secondary-color) !important;
}#listing .slider-form.advamced .newheader_dropdown_action.srter.active.itmSelected:hover{    border-color:  var(--logo-color) !important;}
#listing .itmSelected #js-typeahead-user_v2{color:var(--secondary-color) !important; }
  #listing  .slider-form.advamced .itmSelected .select2-container--default .select2-selection--single .select2-selection__rendered{ color:var(--secondary-color) !important;} 
  
  .form-container-list.f-end-s.hide-for-mobile {
    justify-content: flex-start !important;
}
  </style>
   <?php /*
  <input type="hidden" name="country"  id="country" value="<?php echo @$formData['country'] ;?>">
  * */
  ?>
  <input type="hidden" name="city"  id="city" value="<?php echo $city;?>">
  <input type="hidden" name="community"  id="community_id" value="<?php echo @$community;?>">
  <input type="hidden" id="bed_val" value="<?php echo @$filterModel->bedrooms ;?>" name="bedrooms" />
  <input type="hidden" id="section_val" value="<?php echo @$filterModel->section_id ;?>" name="sec" />
  <input type="hidden" id="bath_val" value="<?php echo @$filterModel->bathrooms ;?>" name="bathrooms"   />
  <input type="hidden" id="sort_val" value="<?php echo @$filterModel->sort ;?>" name="sort" />
  <input type="hidden" id="recommended_val" value="<?php echo @$filterModel->recmnded ;?>" name="recommended" />
  <input type="hidden" id="poplar_area_val" value="<?php echo @$filterModel->poplar_area ;?>" name="poplar_area" />
  <input type="hidden" id="keyword_val" value="<?php echo @$formData['keywords'] ;?>" name="keywords" />
  <input type="hidden" id="city_ids_val" value="<?php echo @$formData['city_ids'] ;?>" name="city_ids" />
  <input type="hidden" id="category_ids_val" value="<?php echo @$formData['category_ids'] ;?>" name="category_ids" />
  <input type="hidden" id="locality" value="<?php echo @$formData['locality'] ;?>" name="locality" />
  <input type="hidden" id="word" value="<?php echo @$formData['word'] ;?>" name="word" />
  <input type="hidden" id="term" value="<?php echo @$formData['term'] ;?>" name="term" />
  <input type="hidden" id="view" value="<?php echo @$formData['view'] ;?>" name="view" />
  <input type="hidden" id="latitude" value="<?php echo @$formData['lat'] ;?>" name="lat" />
  <input type="hidden" id="longitude" value="<?php echo @$formData['lng'] ;?>" name="lng" />
    <input type="hidden" id="a" value="<?php echo @$formData['a'] ;?>" name="a" />
  <input type="hidden" id="b" value="<?php echo @$formData['b'] ;?>" name="b" />
  <input type="hidden" id="c" value="<?php echo @$formData['c'] ;?>" name="c" />
  <input type="hidden" id="d" value="<?php echo @$formData['d'] ;?>" name="d" />
    <input type="hidden" id="lt" value="" name="lt" />
  <input type="hidden" id="lg" value="" name="lg" />
  <input type="hidden" id="zoom" value="<?php echo @$formData['zoom'] ;?>" name="zoom" />
   
   <div  class="top_search-mob"  style="height:0px;paddding:0px; display:none !important">
	 
	 <div style="display:flex">
  <div class="flx1 agentbr">
	 <?php
	 $cityDats = CHtml::listData(States::model()->AllListingStatesOfCountry(COUNTRY_ID),'slug' , 'state_name'); 
	 switch($this->sec_id){
		 case SALE_SLUG :
		 $placeholder ='Search   for sale.';
		 break; 
		 case RENT_SLUG :
		 $placeholder ='Search   for rent.';
		 break; 
		 case BUSINESS_SLUG :
		 $placeholder ='Search business   for sale.';
		 break; 
		 default:
		 $placeholder ='Search properties by keyword.';
		 break;
	 }
	 ?>
	 <div class="mldifil">
		 <label for="srchkeywrod" class="dispinl"><i class="fa fa-search"></i></label><input type="text" id="srchkeywrod" class="serchmob-input" placeholder="<?php echo $placeholder;?>" value="<?php echo @$formData['mkeyword'] ;?>" onclick="showfrm(this)" /></div>
  </div>
 
  
  <div class="flx1 flrbr" style="padding-left:15px; ">
      <?php 
	  $has_filter_open = false; $total_s_items = 0; 
      if(isset($formData['state']) and  !empty($formData['state'])){ $has_filter = true;$total_s_items++; } 
      if(isset($formData['word']) and  !empty($formData['word'])){ $has_filter = true;$total_s_items++; } 
      if(!empty($filterModel->type_of)){ $has_filter = true;$total_s_items++; } 
      if(isset($formData['minPrice']) and  !empty($formData['minPrice'])){ $has_filter = true;$total_s_items++; } 
      if($title_more =='More Search++'){ $has_filter = true; $total_s_items++;} 
      ?> 
	 <button type="button" onclick="showfrm(this)"  class="btn btn-secondary btn-block rnded font-weight-bold opener  <?php echo !empty($has_filter) ? 'opend_filter' :'' ;?>">Filter<i class='fa  fa-check'></i></button>
	 
	 </div>
 </div>
 </div>
  
   <div id="filterBarContainer" style="  ">
               <div class="slider-form advamced ">
            <div class="">
                  <style>  .mx-152 { max-width:115px; } .mx-82 { max-width:82px; }.select2-selection__placeholder { color:#535353 !important; }  </Style>
			
				     
                  <div class="tab-content hom-content" data-select2-id="14" style="margin:0px; ">
                     <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
                        <div class="row no-gutters  normal-listing" data-select2-id="13"  >
                     
                            <div class="  only-show-when-scroll sm-d-flt" style="position:relative;width:90px;" >
                                <a href="<?php echo Yii::app()->createUrl('site/index');?>" id="arablogo" onclick="easyload(this,event,'mainContainerClass')" style="display:block;">
				<img src="<?php echo Yii::app()->apps->getBaseUrl($this->logo_path);?>" style="width:100%; border-bottom-right-radius: 3px;" class="black_logo" alt="<?php echo $conntroller->project_name;?>">
				<span></span>
			</a>
                          
                           </div>
                           <?php $this->renderPartial('//listing/_sector');?>
                            <div class=" city-selector  margin-right-10 sm-d-flt <?php echo (!empty($formData['state'])) ? 'itmSelected' : '';?>" style="position:relative;" data-select2-id="12">
                                 <?php 
                                      
                                  echo  CHtml::dropDownList('state',$formData['state'],$cityDats,array('class'=>'form-control select2 select2 js-example-placeholder-single  no-radius' ,'data-placeholder'=>$this->tag->getTag('select_city','Select City') ,'empty'=>'','onchange'=>'search_byAjax()','style'=>'width:100%;max-height:43.9px;padding:0px 10px;')); ?> 
                               
                          
                           </div>
                              <div class="  city-selector margin-right-10 sm-d-flt <?php echo (!empty($formData['word'])) ? 'itmSelected' : '';?>" id="cty-s" data-select2-id="12" style="min-width:217px;">
								  
							 			  <div tabindex="-1" class="sc-chAAoq lgJTPn"  >
   <div class="sc-cBdUnI jNhpJt">
      <div class="sc-18n4g8v-0 gAhmYY sc-hdPSEv gaQgjK" style="width:100% !important;">
         <i class="rbbb40-1 MxLSp pointer" color="var(--secondary-color)" onclick="search_byAjax23n()" style="color:var(--secondary-color);cursor:pointer" size="20" > <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 339.921 339.921" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <path style="" d="M335.165,292.071l-81.385-84.077c-5.836-6.032-13.13-8.447-16.29-5.363 c-3.171,3.062-10.47,0.653-16.306-5.379l-1.164-1.207c36.425-47.907,32.89-116.499-10.851-160.24 c-47.739-47.739-125.142-47.739-172.875,0c-47.739,47.739-47.739,125.131,0,172.87c44.486,44.492,114.699,47.472,162.704,9.045 l0.511,0.533c5.825,6.032,7.995,13.402,4.814,16.469c-3.166,3.068-1.012,10.443,4.83,16.464l81.341,84.11 c5.836,6.016,15.452,6.195,21.49,0.354l22.828-22.088C340.827,307.735,340.99,298.125,335.165,292.071z M182.306,181.81 c-32.852,32.857-86.312,32.857-119.159,0.011c-32.852-32.852-32.847-86.318,0-119.164c32.847-32.852,86.307-32.847,119.148,0.005 C215.152,95.509,215.152,148.964,182.306,181.81z" fill="currentColor" data-original="#010002"/> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg></i>
         <div class="typeahead__container" id="form-user_v2" style="width:100%;">
        <div class="typeahead__field">
            <div class="typeahead__query">
				<?php
				if(isset($formData['locality'])){ $value = $formData['locality']; }else if(isset($formData['word'])){  $value = $formData['word']; }else {  $value='';  } ?> 
                <input class="js-typeahead-user_v2" id="js-typeahead-user_v2"  onclick="$(this).select();" onchange="unsetlats()"  value="<?php echo  $value;?>"  placeholder="<?php echo $this->tag->getTag('type_keywords_/_location','Type Keywords / Location');?>" autocomplete="off">
            </div>
        </div>
    </div>
    
        
        </div>
        
    </div>
</div>
								  
                           </div>
                         
                                
                         
							   <div style="" class="home-home-type miniHidden ctthype proptyp sm-d-flt" onmouseleave="closeOpened(this)">
                               			<?php 	$ids =  $filterModel->section_id; 
									$categories = Category::model()->ListDataForJSON_ID_BySEctionNewSlugNtCache($ids );
									
									
								 
									
									?>
										  <div class="input-group <?php echo (!empty($filterModel->type_of)) ? 'itmSelected' : '';?>" data-select2-id="72"  >
                                  
                                 <button id="homeTypeToggle"  type="button" class="btn btnDefault prm homeTypeToggleqq"   onclick="openDivThis(this)" data-open="categoryTypeToggleDiv" style=""  onclick="openDivThislatest(this)" >
                                                                        <!-- react-text: 501 --><span id="ct_title"><?php echo $this->tag->getTag('type','Type');?></span><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                    <div id="categoryTypeToggleDiv" style="display:none;padding: 0px;top:10px;position:absolute; right:0px; overflow-y:auto;width:100%;top: 40px !important;" class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer pbs txtL ">
                                                                    
                                                                    
                                                                    <div class="  ">
																		 
					 
                                                                          <div id="load_categories">
                                                                            <div class="miniCol12 smlCol24">
																				<?php 
																			 	 $time = rand(0,1000);
																		
																				foreach($categories as $k2=>$v2){
																					
																					if(is_array($v2)){
																						$title_h = $k2;
																						$count=0;
																								
																						foreach($v2 as $k=>$v){
																							 
																									if($count=='0'){  $time = rand(0,1000);
																									echo '<div class="pbs"><span class="fieldItem  checkbox spnblock"><input id="homeType'.$k2. $time.'" name="type_of"   onclick="propertytypechange(this,event)" ';  echo 'value="'.$k2.'" type="radio"><label for="homeType'.$k2. $time.'"><span class="melipsi">'.$title_h.'<i class="mls iconDownOpen"></i></span></label></span></div>'; 
																					
																									}
																							 $time = rand(0,1000);
																							$title_h = $v;
																							if($k==$filterModel->type_of){  $checked =  'checked="true"'; echo "<script>$('#ct_title').html('".$title_h."');openClassAdd('cat_".$k2."');</script>"; }else{ $checked = '';  }
																							
																						echo '<div class="pbs category_tt cat_'.$k2.' hide"><span class="fieldItem checkbox"><input id="homeType'.$k. $time.'"  class="h_type flabele" name="type_of" '.$checked.' value="'.$k.'" onchange="search_byAjax()" type="radio"><label for="homeType'.$k. $time.'"><span class="melipsi">'.$title_h.'</span></label></span></div>'; 
																						$count++;
																						}
																					}
																				} 
																				?>
																				</div>
                                                                     
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                              </div>

                                  </div>
                               
                           
                               <div class="  price_picker miniHidden smalh  sm-d-flt" onmouseleave="closeOpened(this)">  
                                <div class="input-group <?php echo (isset($formData['minPrice']) and  !empty($formData['minPrice'])) ? 'itmSelected' : '';?> <?php echo (isset($formData['maxPrice']) and  !empty($formData['maxPrice'])) ? 'itmSelected' : '';?>" data-select2-id="72">
                                                                    
                                                                    <?php $this->renderPartial('_price_picker',compact('formData'));?>
                                                             
								</div>
							</div>
                           
                           
                         
                           <?php $title_more = $filterModel->MoreTitle ;?>
                           <div class="  more-selector miniHidden smalh <?php echo (!empty($filterModel->keyword) or !empty($filterModel->bedrooms) or !empty($filterModel->bathrooms) or !empty($filterModel->minSqft) or !empty($filterModel->maxSqft)) ? 'itmSelected' : '';?>" onmouseleave="closeOpened(this)">  
                              <button id="moreToggle" class="btn btnDefault prm" style=" border-radius: 0px;background-color:transparent;border: 0px;"  onclick="openDivThislatest(this)" data-open="allForSaleToggleDiv">
                                                                        <!-- react-text: 513 --><span class="ttlec mrettit"><?php echo $title_more  ;?></span>
                                                                        <span class="showatonscrolonly"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="30" height="30" x="0" y="0" viewBox="0 0 436.873 436.873" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <g> <path d="M65.96,284.391C29.595,284.391,0,254.805,0,218.428c0-36.362,29.595-65.945,65.96-65.945s65.96,29.583,65.96,65.945 C131.914,254.805,102.325,284.391,65.96,284.391z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M214.443,284.391c-36.365,0-65.947-29.586-65.947-65.963c0-36.362,29.583-65.945,65.947-65.945 c36.365,0,65.957,29.583,65.957,65.945C280.4,254.805,250.809,284.391,214.443,284.391z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M370.929,284.391c-36.365,0-65.957-29.586-65.957-65.963c0-36.362,29.592-65.945,65.957-65.945 s65.944,29.583,65.944,65.945C436.873,254.805,407.294,284.391,370.929,284.391z" fill="currentColor" data-original="#000000" style=""/> </g> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg></span>
                                                                        
                                                                        <!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_more_filter');?>
                           </div>
                            
                        <div class="call-header  disp-on-scroll">
							 <a class="nav-link count-indicator" title="My favourite" id="messageDropdown" href="javascript:void(0)" onclick="openShortlistPop(this)" style="position:relative;">
                            <p class="color-grey"><i class="fa fa-heart" aria-hidden="true"></i> (<span class="  dataCounter-fav" id="dataCounter"><?php echo $this->fav_count;?></span>)</p>
							</a>
                        </div> 
				   <div class="    padding-right-0 the-head-sorter text-right mcheckboxSorter pull-right">
					   <div  style="display:flex;" class="a_<?php echo $l_view;?>">
					    <?php
					    if($l_view=='map'){ ?> 
							    <a href="javascript:void(0)"    onclick="changeViewN4(this)" data-href="<?php echo   Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" data-val="list"   class="newheader_dropdown_action_item header_link viewersp  <?php echo   $l_view==   'list'    ? 'active' : '';?>" data-ui-id="user-account">
                        <svg enable-background="new 0 0 24 24" class="newheader_dropdown_arrow" height="15" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m5 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 0h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 9h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 18h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/></svg>
                        </a>
                       <a href="javascript:void(0)"  data-href="<?php echo   Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" data-val="grid" onclick="changeViewN4(this)"  class="newheader_dropdown_action_item header_link   viewersp <?php echo   $l_view==   'grid'    ? 'active' : '';?>" data-ui-id="user-account"> 
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="newheader_dropdown_arrow" x="0px" y="0px" width="15"   height="15" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <g> <path fill="currentColor" d="M187.628,0H43.707C19.607,0,0,19.607,0,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C231.335,19.607,211.728,0,187.628,0z"/> <path fill="currentColor" d="M468.293,0H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C512,19.607,492.393,0,468.293,0z"/> <path fill="currentColor" d="M187.628,280.665H43.707C19.607,280.665,0,300.272,0,324.372v143.921C0,492.393,19.607,512,43.707,512h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C231.335,300.272,211.728,280.665,187.628,280.665z"/> <path fill="currentColor" d="M468.293,280.665H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C512,300.272,492.393,280.665,468.293,280.665z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>     </a>
                        
                     
				        <a data-val="map"   class="newheader_dropdown_action_item header_link listh viewersp active" data-ui-id="user-account">  
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="newheader_dropdown_arrow" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M400,0c-61.76,0-112,50.24-112,112c0,57.472,89.856,159.264,100.096,170.688c3.04,3.36,7.36,5.312,11.904,5.312 s8.864-1.952,11.904-5.312C422.144,271.264,512,169.472,512,112C512,50.24,461.76,0,400,0z M400,160c-26.496,0-48-21.504-48-48 c0-26.496,21.504-48,48-48c26.496,0,48,21.504,48,48C448,138.496,426.496,160,400,160z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M10.048,187.968C4,190.4,0,196.288,0,202.848V496c0,5.312,2.656,10.272,7.04,13.248C9.728,511.04,12.832,512,16,512 c2.016,0,4.032-0.384,5.952-1.152L160,455.616V128L10.048,187.968z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M435.712,304.064C426.624,314.176,413.6,320,400,320c-13.6,0-26.624-5.824-35.712-15.936 c-3.264-3.616-7.456-8.384-12.288-14.048V512l149.952-59.968c6.08-2.4,10.048-8.32,10.048-14.848V201.952 C485.792,246.336,450.752,287.296,435.712,304.064z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M266.08,157.632L192,128v327.616l128,51.2v-256.96C299.552,222.304,278.208,189.12,266.08,157.632z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>  </a>
                      
						<?php }
						else { ?> 
				        <a href="javascript:void(0)"    onclick="changeViewN2(this)" data-val="list"  class="newheader_dropdown_action_item header_link viewersp  <?php echo   $l_view==   'list'    ? 'active' : '';?>" data-ui-id="user-account">
                        <svg enable-background="new 0 0 24 24" class="newheader_dropdown_arrow" height="15" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m5 0h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 0h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 9h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 9h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m5 18h-4c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h4c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/><path fill="currentColor" d="m23 18h-14c-.552 0-1 .448-1 1v4c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-4c0-.552-.448-1-1-1z"/></svg>
                        </a>
                       <a href="javascript:void(0)"   onclick="changeViewN2(this)" data-val="grid"  class="newheader_dropdown_action_item header_link   viewersp <?php echo   $l_view==   'grid'    ? 'active' : '';?>" data-ui-id="user-account"> 
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="newheader_dropdown_arrow" x="0px" y="0px" width="15"   height="15" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <g> <path fill="currentColor" d="M187.628,0H43.707C19.607,0,0,19.607,0,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C231.335,19.607,211.728,0,187.628,0z"/> <path fill="currentColor" d="M468.293,0H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V43.707C512,19.607,492.393,0,468.293,0z"/> <path fill="currentColor" d="M187.628,280.665H43.707C19.607,280.665,0,300.272,0,324.372v143.921C0,492.393,19.607,512,43.707,512h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C231.335,300.272,211.728,280.665,187.628,280.665z"/> <path fill="currentColor" d="M468.293,280.665H324.372c-24.1,0-43.707,19.607-43.707,43.707v143.921c0,24.1,19.607,43.707,43.707,43.707h143.921 c24.1,0,43.707-19.607,43.707-43.707V324.372C512,300.272,492.393,280.665,468.293,280.665z"/> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>     </a>
                        
                     
				        <a data-val="map" onclick="changeViewN2(this)" data-href="<?php echo   Yii::app()->createUrl('listing/index',array('sec'=>!empty($filterModel->section_id) ? $filterModel->section_id : 'Property'));?>" class="newheader_dropdown_action_item header_link listh viewersp" data-ui-id="user-account">  
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="newheader_dropdown_arrow" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M400,0c-61.76,0-112,50.24-112,112c0,57.472,89.856,159.264,100.096,170.688c3.04,3.36,7.36,5.312,11.904,5.312 s8.864-1.952,11.904-5.312C422.144,271.264,512,169.472,512,112C512,50.24,461.76,0,400,0z M400,160c-26.496,0-48-21.504-48-48 c0-26.496,21.504-48,48-48c26.496,0,48,21.504,48,48C448,138.496,426.496,160,400,160z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M10.048,187.968C4,190.4,0,196.288,0,202.848V496c0,5.312,2.656,10.272,7.04,13.248C9.728,511.04,12.832,512,16,512 c2.016,0,4.032-0.384,5.952-1.152L160,455.616V128L10.048,187.968z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M435.712,304.064C426.624,314.176,413.6,320,400,320c-13.6,0-26.624-5.824-35.712-15.936 c-3.264-3.616-7.456-8.384-12.288-14.048V512l149.952-59.968c6.08-2.4,10.048-8.32,10.048-14.848V201.952 C485.792,246.336,450.752,287.296,435.712,304.064z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M266.08,157.632L192,128v327.616l128,51.2v-256.96C299.552,222.304,278.208,189.12,266.08,157.632z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>  </a>
                          <?php } ?> 
                       
                        
				       </div>
				       <script>var list_view_url =  '<?php echo Yii::app()->createUrl('site/setview_list');?>';</script>
				      
			 </div>
             	 
                           	<?php 
				$sortArray = $filterModel->sortArray();
				if(!isset($formData['sort'])){$formData['sort'] = 'best-asc'; }
				/*
				foreach($sortArray as $k=>$v){
				?><input class="checkbox-tools" type="radio" name="order" id="tool-<?php echo $k;?>" <?php echo  (isset($formData['sort']) and  $formData['sort']==  $k ) ?   'checked': ''; ?>  onchange="changeOrderN(this)" value="<?php echo  $k;?>" ><label class="for-checkbox-tools <?php echo ($k=='sqft-desc' or $k=='title-asc')? 'n-p-r-0' : '';?>" for="tool-<?php echo $k;?>"> <?php echo $v;?> </label>
				<?php }*/ ?>  
                <?php
                 $sortOrder = ''; $title_sort = '' ; 
                foreach($sortArray as $k=>$v){ 
                   $title_sort = (isset($formData['sort']) and  $formData['sort']==  $k ) ?   $v : $title_sort; 
    			   $sortOrder .= '<li class="newheader_dropdown_item text-left"><a class="newheader_dropdown_item_link header_link" data-val="'.$k.'"   href="javascript:void(0)">'.$v.'</a></li>'; 
    			} ?>
                <div class="newheader_dropdown_action <?php echo (isset($formData['sort']) and $formData['sort'] != 'best-asc') ? 'itmSelected' : '';?>  srter text-right pull-right <?php echo  !empty($title_sort) ? 'active' : ''; ?>"    data-tr-event-name="header_user_account"  onclick="closeSelect2(this)" onmouseleave="closeOpened(this)"  data-header-id="profile"  >
						<a href="javascript:void(0)" class="newheader_dropdown_action_item header_link padding-right-20" data-ui-id="user-account" ><span class="newheader_useravatar_name"><span class="srttitle"></span> <span style=";line-height: 19px;"><?php echo  $title_sort;?></span></span><div class="newheader_dropdown_action_item_after"></div></a>
					 <i class="mls iconDownOpen"></i>	<div class="newheader_dropdown_container newheader_dropdown">
						<ul class="newheader_dropdown_items" id="">
						     <?php echo  $sortOrder ;?>
						</ul>
						</div>
				</div>
              
                           <div class="col-sm-2 open-selector">  
                              <button type="button"  onclick="openPropertySearchMore(this)" class="btn btn-default btn-block no-radius font-weight-bold">More<img style="width:20px;" src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDQ1OSA0NTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ1OSA0NTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48Zz4KCTxnIGlkPSJ1bmZvbGQtbW9yZSI+CgkJPHBhdGggZD0iTTIyOS41LDcxLjRsODEuNiw4MS42bDM1LjctMzUuN0wyMjkuNSwwTDExMi4yLDExNy4zbDM1LjcsMzUuN0wyMjkuNSw3MS40eiBNMjI5LjUsMzg3LjZMMTQ3LjksMzA2bC0zNS43LDM1LjdMMjI5LjUsNDU5ICAgIGwxMTcuMy0xMTcuM0wzMTEuMSwzMDZMMjI5LjUsMzg3LjZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojQzNDOEQwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" /></button>
                           </div>
                           <button type="button" onclick="closerfrm(this)"  class="btn btn-black btn-block rnded font-weight-bold closer">Show Properties</button>  
                       
                        </div>
                     </div>
                  </div>
              </div>
         </div>
      
        
            
            </div>
</form>
 <style>
	.closer { display:none}
	.flx1 { flex:1 ; } .btn-default { background: #fff; } .btn-black { color: #fff;background: #000; }
	.form .fieldGroupInline .fieldItem, .form .fieldGroupInline label{ display:inline; }
	#homeTypeToggleDiv .pbs input[type="checkbox"] { vertical-align: middle !important;}
 
#listing .rbbb40-1 { right:8px; left:unset; }
html[dir='rtl'] #listing .rbbb40-1 { left:8px !important;right :unset; }
#listing #js-typeahead-user_v2 { padding-right:27px; padding-left:0px; }
html[dir='rtl'] #listing #js-typeahead-user_v2 { padding-left:27px; padding-right:0px; }
</style>
<script>
var load_city_url = '<?php echo Yii::App()->createUrl('site/load_city');?>';
var load_city_ajax = '<?php echo Yii::App()->createUrl('listing/autocompleteNew');?>';
var load_location_ajax = '<?php echo Yii::App()->createUrl('listing/autocompleteLocation');?>';
var load_location_ajax_json = '<?php echo Yii::app()->apps->getBaseUrl('json/pakcities.json',1);?>';
if(typeof autoComplete2 === "undefined"){
var autoComplete2 = [];
}
$(function(){
	listJs();
	loadListJs2(); 
})
</script>
<script>
	var st_slug  = $('#city_d_a').val() ; var selectted_city  ;
		 var FindCities = "<?php echo Yii::app()->createUrl('ajax/FindCities',array('country_id'=>COUNTRY_ID));?>";
		 
		 var searchbtn = '<a href="javascript:void(0)" onclick="submitKeyword()" class="apply-button" >Apply Keyword</a>';
		  var cn_code = '<?php echo COUNTRY_CODE;?>';
       
$(function(){
      selectted_city = $('#city_d').val() ; initAutocomplete22() ;
	//autocompleteCity();
    //autocompleteLocationJson()
  		})
		


</script>
 
 