  <form id="frmId" method="get" class="blackheader2 ssprojectfltr" style="z-index: 112;position: relative;" autocomplete="off"  onSubmit="return false;" name="rwe">
  <style>#filterBarContainer span.miniHidden{position:relative;} #listing .ssprojectfltr #categoryTypeToggleDiv {
    top: 43px !important;
}
#listing .blackheader2 .slider-form { background:#eee; }
.slider-form.advamced .row.no-gutters {
    background: transparent; 
}
#listing .blackheader2 .slider-form .flx-1{ flex:1; }
#listing .blackheader2 .input-group   { background:#eee !important; }
#listing .slider-form #homeTypeToggle, #listing .slider-form #moreToggle, #listing .slider-form #priceToggle {
  
    background: #fff !important;
    padding-left: 15px !important;
}.right-r-v {
    border-top-left-radius: 8px!important;
    border-bottom-left-radius: 8px!important; 
    border-left: 1px solid #ccc !important;
}#listing .abs-left .input-groupn-prepend {
 
    background: transparent;
}
</style>
  
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
   <input type="hidden" id="reg" value="<?php echo @$formData['reg'] ;?>" name="reg" />
   <div  class="top_search-mob" >
	 <div style="display:flex">
  <div class="flx1 agentbr">
	 <?php
	 $cityDats = CHtml::listData(States::model()->AllListingStatesOfCountry(COUNTRY_ID),'slug' , 'state_name'); 
		 $placeholder ='Search by keyword';
		 
	 ?>
	 <div class="mldifil">
		 <label for="srchkeywrod" class="dispinl"><i class="fa fa-search"></i></label><input type="text" id="srchkeywrod" class="serchmob-input" placeholder="<?php echo $placeholder;?>" value="<?php echo @$formData['mkeyword'] ;?>" onclick="showfrm(this)" name="mkeyword" /></div>
  </div>
  
  <div class="flx1 flx-m-150" style="padding-left:15px; ">
	 <button type="button" onclick="showfrm(this)"  class="btn btn-secondary btn-block rnded font-weight-bold opener">Filter</button>
	 <button type="button" onclick="closerfrm(this)"  class="btn btn-black btn-block rnded font-weight-bold closer">Cancel</button>
	 </div>
 </div>
 </div>
 
   <div id="filterBarContainer" style="min-height: 60px; order: 2;">
               <div class="slider-form advamced">
            <div class="">
               
				     
                  <div class="tab-content hom-content" style="margin-top:0px;" data-select2-id="14">
                     <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" data-select2-id="home">
                        <div class="row no-gutters normal-listing" data-select2-id="13">
                         
                                  <div class="  only-show-when-scroll sm-d-flt" style="position:relative;" >
                                <a href="<?php echo Yii::app()->createUrl('site/index');?>" id="arablogo" onclick="easyload(this,event,'mainContainerClass')" style="display:block;">
				<img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/logo/ArabAvenue-Logo.png');?>" style="width:100%; border-bottom-right-radius: 3px;" class="black_logo" alt="<?php echo $conntroller->project_name;?>">
				<span></span>
			</a>
                          
                           </div>
                          
                            <div class="sm-d-flt  margin-right-10 city-selector flx-1" style="position:relative;" data-select2-id="12">
                                 <?php 
                                      
                                  echo  CHtml::dropDownList('state',$formData['state'],$cityDats,array('class'=>'form-control select2 no-radius' ,'data-url'=>Yii::App()->createUrl('site/select_location2') ,'empty'=>$this->tag->getTag('select_city','Select City'),'onchange'=>'search_byAjax()','style'=>'width:100%;max-height:43.9px;padding:0px 10px;')); ?> 
                               
                          
                           </div>
                             <div class="sm-d-flt  margin-right-10  city-selector  flx-1" id="cty-s" data-select2-id="12">
								  
								    <div class="input-groupn <?php echo (isset($formData['project_title']) and  !empty($formData['project_title'])) ? 'itmSelected' : '';?> abs-left">
   <div class="input-groupn-prepend">
    <span class="input-groupn-text" id="basic-addon1"><i class="fa fa-quote-left"></i></span>
  </div>
 
  <?php echo  CHtml::textField('project_title',@$formData['project_title'], array('class'=>'form-controln   right-r-v','placeholder'=>$this->tag->getTag('project_title','Project title') , 'onClick'=>'this.select();', 'onChange'=>'timuteChange()')); ?> 
 
</div>
							<div id="keyword_a" style="position: relative;"></div>	  
								  
                           </div>
                         
                            
                            <div class="  property-selector  flx-1 proptyp miniHidden" data-select2-id="73" onmouseleave="closeOpened(this)">
                              <div class="input-group <?php echo    !empty($filterModel->type_of) ? 'itmSelected' : '';?>" data-select2-id="72">
                                 
                                 <button id="homeTypeToggle" class="btn btnDefault prm"  onclick="openDivThis(this)" data-open="categoryTypeToggleDiv" style=" border-radius: 0px;background-color: transparent;border: 0px;"  onclick="openDivThislatest(this)" >
                                                                        <!-- react-text: 501 --><span class="ttlec" id="ct_title"><?php echo $this->tag->getTag('type','Type');?></span><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                     <div id="categoryTypeToggleDiv" style="display:none;padding:10px;top:10px;position:absolute; left:0px;max-height:300px;overflow-y:auto;width:280px;"  class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer pbs txtL">
                                                                    <div class="  ">
																			
																	 
                                                                        <div class="miniCol12 smlCol24">
																				<?php 
																				  
																				$ids =  !empty($filterModel->section_id) ? $filterModel->section_id : ''; 
																	 
																				$categories = Category::model()->ListDataForJSON_ID_BySEctionSlugNewN($ids );
																				foreach($categories as $k=>$v){
																					$title_h = $v;
																					if($k==$filterModel->type_of){ $checked =  'checked="true"';?><script>$('#ct_title').html('<?php echo $title_h;?>')</script><?php }else{ $checked = ''; }
																					echo '<div class="pbs"><span class="fieldItem checkbox"><input id="homeType'.$k.'"  class="h_type" name="type_of" '. $checked; echo ' value="'.$k.'" type="radio" onChange = "timuteChange()"><label for="homeType'.$k.'"><span class="melipsi">'.$title_h.'</span></label></span></div>'; 
																				} 
																				?>
																				</div>
                                                                    </div>
                                                                </div>
<script> var load_category_url = '<?php echo Yii::App()->createUrl('site/load_category_url');?>'</script>

                                  
                              </div>
                           </div>
                           
                            <div class="  flx-1 price_picker miniHidden proptyp smalh"  onmouseleave="closeOpened(this)">  
                                <div class="input-group <?php echo (isset($formData['minPrice']) and  !empty($formData['minPrice'])) ? 'itmSelected' : '';?> <?php echo (isset($formData['maxPrice']) and  !empty($formData['maxPrice'])) ? 'itmSelected' : '';?>" data-select2-id="72">
                                                                    
                                                                    <?php $this->renderPartial('_price_picker',compact('formData'));?>
                                                             
								</div>
							</div>
                           
                           <?php /*
                           <div class="  more-selector miniHidden smalh">  
                              <button id="moreToggle" class="btn btnDefault prm" style="width: 100% !important;border-radius: 0px;background-color: #fff;border: 0px;"  onclick="openDivThislatest(this)" data-open="allForSaleToggleDiv">
                                                                        <!-- react-text: 513 --><?php echo $filterModel->MoreTitle ;?><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                     <?php $this->renderPartial('_more_filter_project');?>
                           </div>
                           * */
                           ?>
                            <div class="  open-selector">  
								     <button type="button"  onclick="openPropertySearchMore(this)" class="btn btn-default btn-block no-radius font-weight-bold">More<img style="width:20px;" src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDQ1OSA0NTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ1OSA0NTk7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48Zz4KCTxnIGlkPSJ1bmZvbGQtbW9yZSI+CgkJPHBhdGggZD0iTTIyOS41LDcxLjRsODEuNiw4MS42bDM1LjctMzUuN0wyMjkuNSwwTDExMi4yLDExNy4zbDM1LjcsMzUuN0wyMjkuNSw3MS40eiBNMjI5LjUsMzg3LjZMMTQ3LjksMzA2bC0zNS43LDM1LjdMMjI5LjUsNDU5ICAgIGwxMTcuMy0xMTcuM0wzMTEuMSwzMDZMMjI5LjUsMzg3LjZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIiBzdHlsZT0iZmlsbDojQzNDOEQwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" /></button>
                        
                           </div>
                           
                          
                           
                           
                           
                        </div>
                     </div>
                  </div>
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

  <script>
			 var load_city_url = '<?php echo Yii::App()->createUrl('site/load_city');?>';
         $(function(){
			 if ($('select').data('select2')) {
				  $('.select2-container').remove()
			 }
			 	  	listJs();
			  $('select.select2').select2();
			 $eventSelect = $('#dynamicCities') ; 
			 $eventSelect.select2({
								placeholder: 'Select Locations',
							  'dropdownCssClass' : 'specialdropDown',
								ajax: {
								url: function () {
									var load_city_url2 = load_city_url+'/state/'+$('#state').val(); 
								return load_city_url2;
								},
								dataType: 'json',
								delay: 250,
								data: function (params) {
								return {
								q: params.term, // search term
								page: params.page
								};
								},
								processResults: function (data, params) {
								// parse the results into the format expected by Select2
								// since we are using custom formatting functions we do not need to
								// alter the remote JSON data, except to indicate that infinite
								// scrolling can be used
								params.page = params.page || 1;
								return {
								results: data.items,
								pagination: {
								more: (params.page * 30) < data.total_count
								}
								};
								},
								cache: true
								},
								escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
								minimumInputLength: 0,
								//templateResult: formatRepo, // omitted for brevity, see the source of this page
								//templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
								}) ;
			 $eventSelect.on("select2:select", function (e) { console.log("select2:select", e.params.data.id ); });
			  })
         </script>
<script>
	var st_slug  = $('#city_d_a').val() ; 
	var load_city_ajax = '<?php echo Yii::App()->createUrl('listing/autocompleteNew');?>';
$(function(){
	//autocompleteCity();
     
  		})
		
		 

</script>
