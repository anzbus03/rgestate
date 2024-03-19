<?php 
	$price_array =  $filterModel->getPriceArrayFrom();
	$price_array2 =  $filterModel->getPriceArrayTo();
	
$min_html = '';
$max_html = '';
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
foreach( $price_array as $k=>$v){
	$checked = '';$min_class_active  = '';
	$v =  !empty($currency_value) ?  Yii::t('app',bcdiv( $k / $currency_value ,1,'0'),array('.00'=>''))  : $v ; 
	if($k==$min_price){ $min_price_val = $v;  $checked = 'checked'; $min_class_active  = 'select2-results__option--highlighted'; }
	$min_value_html .= '<option value="'.$k.'" '.$checked.'>'.$v.'</option>';
	$min_html .= '<li class="select2-results__option '.$min_class_active.'" dir="auto" onclick="setthisValuefrom(this)" data-price="'.$k.'"  role="treeitem" aria-selected="false">'.$v.'</li>'; 
}

foreach( $price_array2 as $k=>$v){
	$checked2 = '';$max_class_active  = '';
	$v =  !empty($currency_value) ?  Yii::t('app',bcdiv( $k / $currency_value ,1,'0'),array('.00'=>''))  : $v ; 
	if($k==$max_price){ $checked2 = 'checked'; $max_price_val = $v; $max_class_active  = 'select2-results__option--highlighted'; }
	$max_value_html .= '<option value="'.$k.'"  '.$checked.'>'.$v.'</option>';
	$max_html .= '<li class="select2-results__option  '.$max_class_active.'" dir="auto"  onclick="setthisValueto(this)" data-price="'.$k.'"  role="treeitem" aria-selected="false">'. $v .'</li>'; 
}

if(empty($min_price) and empty($max_price)  ){
	$price_title = $this->tag->getTag('price_range','Price Range');
}
else if(!empty($min_price) and !empty($max_price) ){
	$min_price = !empty($currency_value) ?  Yii::t('app',bcdiv( $min_price / $currency_value ,1,'0'),array('.00'=>''))  : $min_price ; 
	$max_price = !empty($currency_value) ?  Yii::t('app',bcdiv( $max_price / $currency_value ,1,'0'),array('.00'=>''))  : $max_price ; 
	$price_title = $min_price.' to '.$max_price;
}
else if(empty($min_price)   ){
	$max_price = !empty($currency_value) ?  Yii::t('app',bcdiv( $max_price / $currency_value ,1,'0'),array('.00'=>''))  : $max_price ; 
	$price_title =  '0 to '.$max_price;
}
else{
	$min_price = !empty($currency_value) ?  Yii::t('app',bcdiv( $min_price / $currency_value ,1,'0'),array('.00'=>''))  : $min_price ; 
	$price_title =  $min_price.'  to Any';
}
?> 
<button id="priceToggle" class="btn btnDefault prm toggleDive" onclick=" openDivThis(this);" data-open="priceToggleDiv" >
                                                                        <!-- react-text: 493 --><span id="textr" class="ttlec"><?php echo $price_title ;?></span> <!-- /react-text --><i class="mls iconDownOpen"></i>
                                                                    </button>
<div id="priceToggleDiv" style="display: none; padding: 10px ; top:  0px; position: absolute; width: 300px; height: 308px; " class="box boxCard boxBasic backgroundBasic zIndexNavigation filterContainer">
                                                           
                                                           <div class="" style="position:relative;">
                                                           <div class="col-sm-6 no-padding padding-0">
                                                       
<select class="form-control select23 no-radius select2-hidden-accessible" style="position: relative !important;width:100px;  " name="minPrice" id="minPrice"   tabindex="-1" aria-hidden="true">
<?php
echo $min_value_html; 
?>
</select><span class="select2 select2-container select2-container--default select2-container--below frs-1 select2-container--open fisedopeb" dir="ltr" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="true" tabindex="0" aria-labelledby="select2-minPrice-container" aria-owns="select2-minPrice-results" aria-activedescendant="select2-minPrice-result-zdyq-10000"><span class="select2-selection__rendered" id="select2-minPrice-container"> <?php echo $this->tag->gettag('min_price','Min Price');?></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
                                
															<span id="my_amazing_modal"><span class="select2-container select2-container--default select2-container--open fisedopeb" style="position: absolute; top: 44px; left: 0px;"><span class="select2-dropdown select2-dropdown--below" dir="ltr"  ><span class="select2-search select2-search--dropdown"><input class="select2-search__field" id="min_price_input" type="search" value="<?php echo $min_price_val;?>" readonly  tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox"></span><span class="select2-results">
																<ul class="select2-results__options" role="tree" id="select2-minPrice-results" aria-expanded="true" aria-hidden="false">
																	 <?php echo $min_html;?></ul></span></span></span></span>
                                <div class="clearfix"></div>
                                                           </div>
                                                           <div class="col-sm-6  no-padding padding-0" id="my_amazing_modal2">
                                                             <select class="form-control select25  no-radius select2-hidden-accessible" style="  position: relative !important; width:100px;	" name="maxPrice" id="maxPrice" tabindex="-1" aria-hidden="true">
<?php echo $max_value_html;?>
</select><span class="select2 select2-container select2-container--default select2-container--below frs-2 select2-container--open fisedopeb" dir="ltr" style="width: 100px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="true" tabindex="0" aria-labelledby="select2-maxPrice-container" aria-owns="select2-maxPrice-results" aria-activedescendant="select2-maxPrice-result-t2bb-10000"><span class="select2-selection__rendered" id="select2-maxPrice-container" title="Max Price"><?php echo $this->tag->gettag('max_price','Max Price');?> </span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
                                <div class="clearfix"></div>
                                                           <span class="select2-container select2-container--default select2-container--open fisedopeb" style="position: absolute; top: 44px; left: 0px;"><span class="select2-dropdown select2-dropdown--below" dir="ltr" ><span class="select2-search select2-search--dropdown"><input class="select2-search__field" type="search" tabindex="0" id="max_price_input"  value="<?php echo $max_price_val;?>" readonly  autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox"></span><span class="select2-results"><ul class="select2-results__options" role="tree" id="select2-maxPrice-results" aria-expanded="true" aria-hidden="false"><?php echo $max_html;?></ul></span></span></span></div>
                                                           <div class="clearfix"></div>
                                                           </div>
                                                           <button type="button" class="ornge-cl"  style="position: absolute;bottom: 8px;z-index: 1111;width: calc(100% - 20px);border: 1px solid var(--logo-color);background: #fff;color: var(--logo-color);padding: 3px;font-weight: bold;" onclick="timuteChange()"><?php echo $this->tag->getTag('apply','Apply');?></button>
                                                           <div class="clearfix"></div>
                                                           
                                                             </div>
 
<style>
    html[dir="ltr"] #listing .frs-1.select2-container--open .select2-dropdown,html[dir="ltr"]  #listing  .frs-1.select2-container--open .select2-selection { border-right:0px !important; }
  html[dir="ltr"]   #listing span#my_amazing_modal .select2-container--open .select2-dropdown{     border-right: 0px !important;    border-bottom-right-radius: 0px !important; }
     html[dir="rtl"]  #listing  .frs-1.select2-container--open .select2-selection { border-left:0px !important; }
     html[dir="rtl"] #my_amazing_modal .select2-container { left: 0px !important; }
     #listing #priceToggleDiv .select2-container--open .select2-dropdown { padding: 4px !important; }
     @media only screen and (max-width: 720px) {
 #listing select#maxPrice, #listing select#minPrice {
 
    margin: 0px !important
 }
     }
    #priceToggleDiv .select2-search__field {
 
    height: 23px;
    border-radius: 5px;
}
</style>
