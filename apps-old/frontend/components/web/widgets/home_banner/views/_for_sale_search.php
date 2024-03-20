<?php
$sec_t = $conntroller->tag->getTag('buy','Buy');
?>
<style>
.form-container-list-item {
    position: relative;
    border-radius: 4px;
    color: #222;
    font-weight: 400;
    background-color: #fff;
    width: 160px;
    margin-right: 10px;
}

</style>
<form method="get"  action ="<?php echo Yii::App()->createUrl(SALETITLE);?>"  onsubmit="callprevet(event,this)"  id="for_sale">
<input type="hidden" id="latitude" value="" name="lat" />
<input type="hidden" id="longitude" value="" name="lng" />
<input type="hidden" id="word" value="" name="word" />
                        <div class="row no-gutters" data-select2-id="13">
							<div class="arab-drop-down arab-li-1 sectionFilter margin-right-10 port-sector">
	
	<button id="sectortype" class="StyledButton-c11n-8-27-0__wpcbcc-0 hnSTQE srp__fdiad6-0 hlkFos filter-button <?php echo  filter-button_active-m  ;?>" onclick="openDropDown(this)" tabindex="0" aria-expanded="true"><span><span class="zsg-icon-for-sale"></span> <?php echo $sec_t;?></span></button>
    <div class="arab-drop-down.popover popoversect filter-button-popover  ">
    <span class="zsg-popover-arrow"  ></span>
    
    <div class="filter-sector sector-for-mb  sector-for-mb-brder">
		<div class="sml-blk-sector">
    <div class="row-items arab-separator_secondary no-input-radio sector-for-mb-brder1">
    <input type="radio" onclick="opencheckbox(this)" class="StyledFormControl-c11n-8-27-0__sc-18qgis1-0 PECat Radio-c11n-8-27-0__yicu80-0 srp__dimomh-3 iesges"  <?php echo   'checked=true' ; ?>   name="sec1" id="sale<?php echo SALE_SLUG;?>" data-refresh="1" data-mailistUrl='<?php echo Yii::app()->createUrl('listing/index',array('sec'=>SALE_SLUG));?>/'  onchange="changemainlisturl(this)"   value="<?php echo SALE_SLUG;?>" />
    <label for="sale<?php echo SALE_SLUG;?>" ><span class="txt-c"><i class="flaticontype-key  margin-right-5"></i><?php echo $conntroller->tag->getTag('buy','Buy');?></span></label>
    <div class="clearfix"></div>
    </div>
    <div class="row-items bottom-gris no-input-radio sector-for-mb-brder1">
    <input type="radio"  onclick="opencheckbox(this)"  data-mailistUrl='<?php echo Yii::app()->createUrl('listing/index',array('sec'=>RENT_SLUG));?>/'  onchange="changemainlisturl(this)" class="StyledFormControl-c11n-8-27-0__sc-18qgis1-0 PECat Radio-c11n-8-27-0__yicu80-0 srp__dimomh-3 iesges"    name="sec1" id="rent<?php echo RENT_SLUG;?>"   value="<?php echo RENT_SLUG;?>" />
    <label for="rent<?php echo RENT_SLUG;?>" ><span class="txt-c"><i class="flaticontype-key-1 margin-right-5"></i><?php echo $conntroller->tag->getTag('rent','Rent');?></span> <button class="StyledButton-c11n-8-27-0__wpcbcc-0 ffvkXH srp__y1ikih-0 guZoSs"><i class="flaticontype-download"></i></button></label>
    <div class="clearfix"></div>
    
   <div class="clearfix"></div>
    
    </div>
    <div class="clearfix"></div>
    </div>
     <div class="srp__c4q7hm-0 uwXfj filter-checkbox-list checkbox-grid  " id="checkbox-grid-1">
    
    </div>
    
    </div>
    <div class="srp__sc-1scjcmt-0 eFpjEy"><button aria-describedby="listing-type-form" class="StyledButton-c11n-8-27-0__wpcbcc-0 hnSTQE srp__sc-1scjcmt-2 fkEYux" onclick="search_byAjax()" ><?php echo $done;?></button></div>
    </div>

</div>
                         <div class="col-md-3 hide not-at-mobile padding-right-15" data-select2-id="12">
                             <input type="hidden" name="sec" value="for-sale">
										<?php 
									 
										//,'onchange'=>'load_via_ajax23(this,"locality")'
										echo  CHtml::dropDownList('state','',$city,array('class'=>'form-control select2 no-radius' ,'data-url'=>Yii::App()->createUrl('site/select_location2') ,'empty'=>'Select City')); ?> 
                               
                           </div>
                           <style>
							   .new-multiple{
                               background: #fff;
    margin-right: 15px;
    border: 1px solid #D4D4D4;
    padding: 0px !important;
    line-height: 40px;
    border-radius: 4px;
}.slider-form.advamced .row.no-gutters {
    display: flex;
    max-height: 64px;
}.dropdown-display-label { 
    z-index: 1;min-height:43px;     display: flex;
    align-items: center;
}
.hide-bg-border{ background: transparent;border:0px solid #D4D4D4; ;}
 .new-multiple { min-width:360px;min-height: 41px;}
.slider-form form .no-gutters {
    border-bottom: 0px;
    max-height:63px;
    align-items: flex-start;
    padding-top: 11px;
}.dropdown-display-label {
      align-items:center;
    display: flex;
      align-items:center;
        max-height: 88px;
    overflow-y: scroll; 
}.dropdown-multiple-label.active .dropdown-display-label {
   
    max-height: unset;
    overflow: initial;
}.slider-form.advamced .btn{ line-height:40px !important; } 
                           </style>
                           <div class="col-md-7 padding-right-15  special-at-mob  not-at-mobile new-h-cls new-multiple" data-select2-id="12">
									 	<div class="dropdown-mul-1">
							<select style="display:none"  name="state" id="" multiple placeholder="Search by location"></select>
							</div>
                            <script>
                            /*
                            var data2 =   <?php echo json_encode($areaData);?> 
                            $(function(){
                            $('.dropdown-mul-1').dropdown({
                            data: data2,
                            limitCount: 40,
                             input: '<input type="text" maxLength="20" placeholder="Search by location">',
                            multipleMode: 'label',
                            init:  function () {
                            $('.new-multiple').addClass('hide-bg-border')
                            },
                            choice: function () {
                            // console.log(arguments,this);
                            }
                            });
                            
                            })
                            */
                            </script>
                           
                            </div>
                           <div class="col-md-3 padding-right-15   not-at-mobile home-home-type miniHidden proptyp proptypsale" data-select2-id="73">
							  <div class="input-group" data-select2-id="72">
                                  
                                 <button id="homeTypeToggle"  type="button" class="btn btnDefault prm"    data-open="categoryTypeToggleDiv" style="width: 100% !important;border-radius: 0px;background-color: #fff;border: 1px solid #D4D4D4 ;padding: 0px 5px 0px 15px;line-height: 40px;"    >
                                                                       <span class="nthem"> <!-- react-text: 501 --><?php echo $conntroller->tag->getTag('property_type','Property Type');?></span><!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
                                                                    <div id="categoryTypeToggleDiv" style="display:none;padding:10px;top:10px;position:absolute; right:0px;overflow-y:auto;width:120%;top: 41px !important; " class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer pbs txtL">
                                                                    
                                                                    
                                                                    <div class="  ">
																		 
																		  
                                                                          <div id="load_categories">
                                                                            <div class="miniCol12 smlCol24">
																				<?php 
																				$ids = 1; 
																				$categories = Category::model()->ListDataForJSON_ID_BySEctionNewSlugCache($ids );
																				 $time = rand(0,1000);
																				echo '<ul class="pr-selector">';
																				$tab_id = 1; 
																				foreach($categories as $k2=>$v2){
																					if($k2=='Mixed Use'){ continue; }
																					$cls = $tab_id=='1' ? 'active' : '';
																					echo '<li id="select'.$tab_id.'" class="'.$cls.'" >'.$k2.'</li>';
																					$tab_id++;
																					/*
																					if(is_array($v2)){
																						$title_h = $k2;
																						$count=0;
																								
																						foreach($v2 as $k=>$v){
																							 
																									if($count=='0'){  $time = rand(0,1000);
																									echo '<div class="pbs"><span class="fieldItem  checkbox spnblock"><input id="homeType'.$k2. $time.'" name="type_of"   onclick="propertytypechange(this,event)" ';  echo 'value="'.$k2.'" type="radio"><label for="homeType'.$k2. $time.'"><span class="melipsi">'.$title_h.'<i class="mls iconDownOpen"></i></span></label></span></div>'; 
																					
																									}
																							 $time = rand(0,1000);
																							$title_h = $v;
																						echo '<div class="pbs category_tt cat_'.$k2.' hide"><span class="fieldItem checkbox"><input id="homeType'.$k. $time.'"  class="h_type" name="type_of" ';  echo 'value="'.$k.'" type="radio"><label for="homeType'.$k. $time.'"><span class="melipsi">'.$title_h.'</span></label></span></div>'; 
																						$count++;
																						}
																					}
																					* */
																				} 
																				echo '</ul>';
																				$tab_id = 1; 
																				foreach($categories as $k2=>$v2){
																					if($k2=='Mixed Use'){ continue; }
																					$cls = $tab_id=='1' ? 'active' : '';
																					echo '<li id="cnt-select'.$tab_id.'" class="contns '.$cls.'" >';
																					$tab_id++;
																					 
																					if(is_array($v2)){
																						$title_h = $k2;
																						$count=0;
																								
																						foreach($v2 as $k=>$v){
																						 
																							 $time = rand(0,1000);
																							$title_h = $v;
																						echo '<div class="pbs category_tt cat_'.$k2.'  "><span class="fieldItem checkbox"><input id="homeType'.$k. $time.'"  class="h_type" name="type_of" ';  echo 'value="'.$k.'" type="radio"><label for="homeType'.$k. $time.'"><span class="melipsi">'.$title_h.'</span></label></span></div>'; 
																						$count++;
																						}
																					}
																					 
																					echo '</li>';
																				} 
																				?>
																				</div>
                                                                     
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              
                              </div>


    
							</div>
                         <div class="special-submit-button" style="display:none">  
                              <button type="submit"   class="btn btn-secondary btn-block no-radius font-weight-bold"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/search.png');?>"></button>
                           </div>
                           
                        </div>
						<div class="row no-gutters">
						
						<div class="arab-drop-down  arab-li-1 sectionFilter margin-right-10  port-price">
	<?php
	$min_html = '';
$max_html = '';
$to = $conntroller->tag->getTag('to','to');
$min_value_html = '';
$max_value_html = '';$min_price_val = '';$max_price_val = '';
if(isset($formData['minPrice']) and !empty($formData['minPrice'])){ $min_price = isset($price_array[$formData['minPrice']]) ? $price_array[$formData['minPrice']] : $formData['minPrice'];  }else{ $min_price ='';  }
if(isset($formData['maxPrice']) and !empty($formData['maxPrice'])){ $max_price = isset($price_array2[$formData['maxPrice']]) ? $price_array2[$formData['maxPrice']] : $formData['maxPrice'];  }else{ $max_price ='';  }
$currency_value = ''; 
$currency_Symbol = CURRENCY_CODE; 
if(defined('SYSTEM_CURRENCY') and SYSTEM_CURRENCY=='usd'){
	$currency_value = $filterModel->UsdValue;
	$currency_Symbol = '$' ; 
} 

if(empty($min_price) and empty($max_price)  ){
	$price_title = $conntroller->tag->getTag('price_range','Price Range');
}
else if(!empty($min_price) and !empty($max_price) ){
	$min_price = !empty($currency_value) ?  Yii::t('app',bcdiv( $min_price / $currency_value ,1,'0'),array('.00'=>''))  : $min_price ; 
	$max_price = !empty($currency_value) ?  Yii::t('app',bcdiv( $max_price / $currency_value ,1,'0'),array('.00'=>''))  : $max_price ; 
	$price_title = $min_price.' '.$to.' '.$max_price;
}
else if(empty($min_price)   ){
	$max_price = !empty($currency_value) ?  Yii::t('app',bcdiv( $max_price / $currency_value ,1,'0'),array('.00'=>''))  : $max_price ; 
	$price_title =  '0 '.$to.' '.$max_price;
}
else{
	$min_price = !empty($currency_value) ?  Yii::t('app',bcdiv( $min_price / $currency_value ,1,'0'),array('.00'=>''))  : $min_price ; 
	$price_title =  $min_price.'  to Any';
}
?>
	<button id="price-btn1" class="StyledButton-c11n-8-27-0__wpcbcc-0 hnSTQE srp__fdiad6-0 hlkFos filter-button  filter-button_active <?php  echo ((isset($formData['minPrice']) and !empty($formData['minPrice']))  or  (isset($formData['maxPrice']) and !empty($formData['maxPrice'])) or (isset($formData['por']) and $formData['por']=='1') ) ? ' filter-button_active-m ' : '' ;?>" onclick="openDropDown(this)" tabindex="0" aria-expanded="true"><span class="shringage-div"><?php echo  $price_title;?></span></button>
    <div class="arab-drop-down.popover popoversect filter-button-popover">
    <span class="zsg-popover-arrow"  ></span>
    <div class="filter-sector filter-sector-padding">
    <div class="fltr-hd p-range"><?php echo $price_range;?> <div class="pull-right"><div id="ck-button-list"><label><input type="checkbox" name="por" class="form-control" <?php echo  (isset($formData['por']) and $formData['por']=='1') ? 'checked=:true' :'';?>  value="1" ><span><?php echo $conntroller->tag->getTag('price_on_request','Price on Request');?></span></label></div></div></div>
    <div>
    

<div class="srp__zhk15p-1 hGxEuL text-input-range-inner zsg-content-item">
   <div class="">
      <label for="price-exposed-min">
         <div class="VisuallyHidden-c11n-8-27-0__t8tewe-0 ibszwt">Price Range min</div>
         <div class="StyledFormField-c11n-8-27-0__sc-24oslp-0 gdSSaw"><input type="tel"  oninput = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  id="price-exposed-min" aria-invalid="false" class="StyledFormControl-c11n-8-27-0__sc-18qgis1-0 PECat Input-c11n-8-27-0__sc-4ry0fw-0 qAEFn zsg-content_collapsed filter_applied" value="<?php echo @$formData['minPrice'];?>" name="minPrice" placeholder="<?php echo  $conntroller->tag->gettag('min_price','Min Price');?>" role="combobox" aria-expanded="true" aria-owns="min-options" aria-activedescendant="min-100000"></div>
      </label>
      <ul id="min-options" class="filter-options filter-sector-250" role="listbox" style="display:block">
         <?php
         foreach($price_array as $k=>$v){ ?>
         <li id="min-null" role="option" data-val="<?php echo $k;?>" onclick="setMinimum(this)"  aria-selected="false"><button class="StyledTextButton-c11n-8-27-0__n1gfmh-0 eTzLnr srp__ipk15i-0 kjGEAo"><?php echo $v;?></button></li>
         <?php } ?> 
 
      </ul>
   </div>
   <span class="text-input-range-dash">–</span>
   <div class="">
      <label for="price-exposed-max">
         <div class="VisuallyHidden-c11n-8-27-0__t8tewe-0 ibszwt">Price Range max</div>
         <div class="StyledFormField-c11n-8-27-0__sc-24oslp-0 gdSSaw"><input type="tel" oninput = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  id="price-exposed-max" aria-invalid="false" class="StyledFormControl-c11n-8-27-0__sc-18qgis1-0 PECat Input-c11n-8-27-0__sc-4ry0fw-0 qAEFn zsg-content_collapsed filter_applied" value="<?php echo @$formData['maxPrice'];?>" name="maxPrice" placeholder="<?php echo  $conntroller->tag->gettag('max_price','Max Price');?>" role="combobox" aria-expanded="false" aria-owns="max-options" aria-activedescendant="max-600000"></div>
      </label>
      <ul id="max-options" class="filter-options filter-sector-250" role="listbox" style="display:block">
		<?php
		foreach($price_array2 as $k=>$v){ ?>
		<li id="min-null" role="option" data-val="<?php echo $k;?>" onclick="setMaximum(this)"  aria-selected="false"><button class="StyledTextButton-c11n-8-27-0__n1gfmh-0 eTzLnr srp__ipk15i-0 kjGEAo"><?php echo $v;?></button></li>
		<?php } ?> 
    
      </ul>
   </div>
</div>


     </div>
    </div>
    <div class="srp__sc-1scjcmt-0 eFpjEy"><button aria-describedby="listing-type-form" class="StyledButton-c11n-8-27-0__wpcbcc-0 hnSTQE srp__sc-1scjcmt-2 fkEYux" onclick="search_byAjax()"><?php echo $done;?></button></div>
    </div>

</div>
 
			 			<div class="form-container-list-item location-flex last-itm"  id="price-parent" data-input="" data-function=""  >
								<div class="list-item-p list-item-purpose" onclick="openthisBpx(this)">
								   <label class="list-item-p-label" for="filter-title">price(<?php echo CURRENCY;?>)</label>
								   <div    class="list-item-p-label-button">
									  <span class="list-item-p-label-button-container">
										<span class="price-changer">
										<span class="price-changer-from"  id="price-changer-from">0</span>
										<span class="price-changer-to-text">to</span>
										<span class="price-changer-to" id="price-changer-to">Any</span>
										</span>
									 </span>
									  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6" class="eedc221b">
										 <path class="cls-1" d="M12 6L6 0 0 6h12z"></path>
									  </svg>
								   </div>
								</div>
								
								<div class="search-popup-cntainer price-list-row">
									<div class="search-popup-cntainer-wrapper" role="listbox">
											<div class="only-for-mobile">
										<div class="row m-0">
										<div class="col-sm-61">
										
											<div class="two-sect-selct">
											<span class="divvisee"  >Minimum:</span>
											<select class=""  id="mobile-minPrice" onchange="changeValuedropDownSelect(this,'mobile-maxPrice','<','minPrice')">
												<option value="0">0</option>
												<?php
												foreach($price_sec as $k=>$v){ 
												echo '<option value="'.$k.'">'.$v.'</option>';
												} ?>
												 </select>
											</div>
										
										</div>
										
										
										<div class="col-sm-61">
										
											<div class="two-sect-selct">
											<span class="divvisee">Maximum:</span>
											<select class="" id="mobile-maxPrice" onchange="changeValuedropDownSelect(this,'mobile-minPrice','>','maxPrice')">
												<option value="0">Any</option>
												<?php
												foreach($price_sec as $k=>$v){ 
												echo '<option value="'.$k.'">'.$v.'</option>';
												} ?>
												 </select>
											</div>
										
										</div>
										
										
										</div>
										
										</div>
											
											<div>
												<div>
   <div class="price-frm-selct" id="minPrice" data-input="min-price" data-parent-input="price-changer-from">
      <span class="price-frm-selct1">min:</span>
      <div class="a0c631cb price-frm-selct2">
         <div class="price-frm-selct3">
            
         </div>
         <input placeholder="0" class="_12173fb7"  value="">
      </div>
      <div class="price-frm-selct4" >
		    <span><button aria-label="0" aria-value="" onclick="changeValuedropDown(this,'maxPrice','<','minPrice')"    class="search-popup-cntainer-btn1 indeividual price-changer search-popup-cntainer-btn active">0</button></span>
		
		<?php
		foreach($price_sec as $k=>$v){ ?>
		<span><button aria-label="<?php echo $v;?>" aria-value="<?php echo $k;?>" onclick="changeValuedropDown(this,'maxPrice','<','minPrice')"   class="search-popup-cntainer-btn1 indeividual price-changer search-popup-cntainer-btn"><?php echo $v;?></button></span>
		<?php } ?>
      </div>
   </div>
   <div class="price-frm-selct"  id="maxPrice" data-input="max-price" data-parent-input="price-changer-to">
      <span class="price-frm-selct1">max:</span>
      <div class="a0c631cb price-frm-selct2">
         <div class="price-frm-selct3">
           
         </div>
         <input placeholder="Any"  class="_12173fb7" value="">
      </div>
      <div class="price-frm-selct4"> 
		  <span><button aria-label="Any" aria-value="" onclick="changeValuedropDown(this,'minPrice','>','maxPrice')"    class="search-popup-cntainer-btn1 indeividual search-popup-cntainer-btn active">Any</button></span>
		 
      		<?php
		foreach($price_sec as $k=>$v){ ?>
		<span><button aria-label="<?php echo $v;?>" aria-value="<?php echo $k;?>" onclick="changeValuedropDown(this,'minPrice','>','maxPrice')"   class="search-popup-cntainer-btn1 indeividual search-popup-cntainer-btn"><?php echo $v;?></button></span>
		<?php } ?>

      
      </div>
   </div>
</div>
												<div class="search-cls-cntainer"><button class="search-cls-btn"  onclick="openthisBpxInside(this)" >Close</button></div>
											</div>
									</div>
								
								</div>
					</div>
				
					<div class="form-container-list-item _area_filter"  id="area-parent" data-input="" data-function=""  >
								<div class="list-item-p list-item-purpose" onclick="openthisBpx(this)">
								   <label class="list-item-p-label" for="filter-title">Area (<?php echo AREANAME;?>)</label>
								   <div    class="list-item-p-label-button">
									  <span class="list-item-p-label-button-container">
										<span class="price-changer">
										<span class="price-changer-from"  id="area-changer-from">0</span>
										<span class="price-changer-to-text">to</span>
										<span class="price-changer-to" id="area-changer-to">Any</span>
										</span>
									 </span>
									  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6" class="eedc221b">
										 <path class="cls-1" d="M12 6L6 0 0 6h12z"></path>
									  </svg>
								   </div>
								</div>
								
								<div class="search-popup-cntainer price-list-row">
									<div class="search-popup-cntainer-wrapper" role="listbox">
											<div class="only-for-mobile">
										<div class="row m-0">
										<div class="col-sm-61">
										
											<div class="two-sect-selct">
											<span class="divvisee"  >Minimum:</span>
											<select class=""  id="mobile-minsqft" onchange="changeValuedropDownSelect(this,'mobile-maxsqft','<','minSqft')">
												<option value="0">0</option>
												<?php
												foreach($area_aray_sec as $k=>$v){ 
												echo '<option value="'.$k.'">'.$v.'</option>';
												} ?>
												 </select>
											</div>
										
										</div>
										
										
										<div class="col-sm-61">
										
											<div class="two-sect-selct">
											<span class="divvisee">Maximum:</span>
											<select class="" id="mobile-maxsqft" onchange="changeValuedropDownSelect(this,'mobile-minsqft','>','maxSqft')">
												<option value="0">Any</option>
												<?php
												foreach($area_aray_sec as $k=>$v){ 
												echo '<option value="'.$k.'">'.$v.'</option>';
												} ?>
												 </select>
											</div>
										
										</div>
										
										
										</div>
										
										</div>
											
											<div>
												<div>
   <div class="price-frm-selct" id="minSqft" data-input="min-sqft" data-parent-input="area-changer-from">
      <span class="price-frm-selct1">min:</span>
      <div class="a0c631cb price-frm-selct2">
         <div class="price-frm-selct3">
            
         </div>
         <input placeholder="0" class="_12173fb7"  value="">
      </div>
      <div class="price-frm-selct4" >
		    <span><button aria-label="0" aria-value="" onclick="changeValuedropDown(this,'maxSqft','<','minSqft','area-parent')"    class="search-popup-cntainer-btn1 indeividual price-changer search-popup-cntainer-btn active">0</button></span>
		
		<?php
		foreach($area_aray_sec as $k=>$v){ ?>
		<span><button aria-label="<?php echo $v;?>" aria-value="<?php echo $k;?>" onclick="changeValuedropDown(this,'maxSqft','<','minSqft','area-parent')"   class="search-popup-cntainer-btn1 indeividual price-changer search-popup-cntainer-btn"><?php echo $v;?></button></span>
		<?php } ?>
      </div>
   </div>
   <div class="price-frm-selct"  id="maxSqft" data-input="max-sqft" data-parent-input="area-changer-to">
      <span class="price-frm-selct1">max:</span>
      <div class="a0c631cb price-frm-selct2">
         <div class="price-frm-selct3">
           
         </div>
         <input placeholder="Any"  class="_12173fb7" value="">
      </div>
      <div class="price-frm-selct4"> 
		  <span><button aria-label="Any" aria-value="" onclick="changeValuedropDown(this,'minSqft','>','maxSqft','area-parent')"    class="search-popup-cntainer-btn1 indeividual search-popup-cntainer-btn active">Any</button></span>
		 
      		<?php
		foreach($area_aray_sec as $k=>$v){ ?>
		<span><button aria-label="<?php echo $v;?>" aria-value="<?php echo $k;?>" onclick="changeValuedropDown(this,'minSqft','>','maxSqft','area-parent')"   class="search-popup-cntainer-btn1 indeividual search-popup-cntainer-btn"><?php echo $v;?></button></span>
		<?php } ?>

      
      </div>
   </div>
</div>
												<div class="search-cls-cntainer"><button class="search-cls-btn"  onclick="openthisBpxInside(this)" >Close</button></div>
											</div>
									</div>
								
								</div>
					</div>
			      
			     <div class="col-md-2 not-at-mobile">  
                              <button type="submit"   class="btn btn-secondary btn-block no-radius font-weight-bold"><?php echo $conntroller->tag->getTag('search','SEARCH');?></button>
                           </div>
                           
                          			
						
						</div>
						
						
						</form>
			<div style="position:relative"> 
               <div class="top-search">
                  <strong><i class="mdi mdi-keyboard"></i> <?php echo $conntroller->tag->getTag('top_search','Top Search');?> : </strong>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-sale','type_of'=>'commercial_warehouse','state'=>'all'));?>" data-id="Lands_Plots"><?php echo $conntroller->tag->getTag('warehouse','Warehouse');?></a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-sale','type_of'=>'commercial_retail','state'=>'all'));?>"  data-id="Villas"><?php echo $conntroller->tag->getTag('retail','Retail');?></a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-sale','type_of'=>'commercial_staff-accommodation','state'=>'all'));?>"  data-id="Apartments_Flats"><?php echo $conntroller->tag->getTag('staff_accomodation','Staff/Labour Accomodation');?></a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-sale','type_of'=>'commercial_Land','state'=>'all'));?>"  data-id="Offices"><?php echo $conntroller->tag->getTag('plots','Plots');?></a>
             
                  <a href="@update_category"  data-id="Offices"><?php echo $conntroller->tag->getTag('hospitals','Hospitals');?></a>
                  <a href="<?php echo Yii::app()->createUrl('listing/index',array('sec'=>'for-sale','type_of'=>'commercial_whole-commercial_building','state'=>'all'));?>"  data-id="Offices"><?php echo $conntroller->tag->getTag('full_buildings','Full Buildings');?></a>
				       <a href="#update_category"  data-id="Offices"><?php echo $conntroller->tag->getTag('schools','Schools');?></a>
               </div>
			</div>
