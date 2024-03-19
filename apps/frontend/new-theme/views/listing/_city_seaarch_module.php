<li class="arab-drop-down  arab-li-1 sectionFilter margin-right-10  port-city <?php echo (isset($formData['sort']) and !empty($formData['state']) and $formData['state']!= 'best-asc' ) ? 'sort-active' : '' ;?>">
	 
	<button id="city-button" class="StyledButton-c11n-8-27-0__wpcbcc-0 hnSTQE srp__fdiad6-0 hlkFos filter-button srtmbtn <?php echo (isset($formData['state']) and !empty($formData['state'])) ? '  filter-button_active-m ' : '';?>  filter-button_active " onclick="openDropDown(this)" tabindex="0" aria-expanded="true"><span id="sec_state_html" class="shringage-div"><span class="iner-b"><svg viewBox="0 0 70.098 53.605" class="smartad_bedicon"> <use xlink:href="#select-city"></use> </svg> <?php echo $this->tag->getTag('select_city','Select City');?></span></span>
	<span class="StyledButton-c11n-8-27-0__wpcbcc-0 ffvkXH srp__y1ikih-0 guZoSs mb-on-dro"><i class="flaticontype-download"></i></span>
	</button>
    <div class="arab-drop-down.popover popoversect filter-button-popover">
    <span class="zsg-popover-arrow"  ></span>
    <style>
    .active-regions .row-items{ display:none;  }
    .active-regions .row-items.active{ display:flex;  }
    .popular-regin { display:flex;flex-wrap:wrap}.popular-regin li{ flex: 1;
    min-width: 49%;
    padding:7px 6px;cursor:pointer;
    margin-bottom:  1%;
  line-height:1.2;
    margin-right: 1%;}.popular-regin li:hover,.popular-regin li.active{background-color: #D2E0E8;
color: var(--secondary-color);
font-weight: 600; }
    .popular{ color: var(--black-color);font-size:17px;font-weight:600;display:none;    padding-left: 10px;
    padding-right: 10px;     background: #fafbfc;padding-bottom: 7px;}
    #city-d-mdiv.active .popular{ display:block !important; }
     .popular-regin li.active {display:block !important; }
     .popular-regin li.active::before{ content:' '; }
     .back-button { color:var(--black-color);font-size:12px;cursor:pointer;}
     @media only screen and (max-width: 600px){
html #city-button {    display: block;}
         .port-city .city-flt-opt {
   
    max-height: unset !important;
}
         
     }
.back-button { color: var(--secondary-color);}
.xity-list{ display:flex;flex-wrap:wrap;}
.xity-list .row-items{ flex:1;min-width:50%;}.xity-list .row-items input[type="checkbox"]{ display:none;}
.xity-list .row-items label>span.txt-c {
    font-size: 15px;
    line-height: 1.2 !important;
}
    </style>
    <script>

    </script>
    <div id="city-d-mdiv" class="filter-sector filter-sector-350 city-flt-opt <?php echo !empty($regions) ? 'active-regions' : '';?> <?php echo !empty($formData['reg']) ? 'active' : '';?> ">
		<ul class="popular-regin">
		<?php
		if(!empty($regions)){
			if(isset($formData['reg'])){
			}
			foreach($regions as $k=>$v){
				$avtiveCls1 =  ''; 
				if(isset($formData['reg'])){
				$avtiveCls1 = ($v['slug']==@$formData['reg']) ? 'active' : 'hide';
					}
				if($avtiveCls1=='active'){   echo '<script>$("#sec_state_html").html("'.trim($v['name']).'");</script>';
					   echo '<script>$("#city-button").addClass("filter-button_active-m");</script>';
					}
				echo '<li data-slug="'.$k.'" data-slug-original="'.$v['slug'].'" class="'.$avtiveCls1.'" onclick="showthisregion(this)"><span class="iner-b"><svg viewBox="0 0 70.098 53.605" class="smartad_bedicon"> <use xlink:href="#select-city"></use> </svg> '.$v['name'].'</span></li>';
			}
		}
		?>
		</ul>
		<div class="clearfix"></div>
		<div class="popular">
			<div class="back-button" onclick="gback()"><i class="fa fa-chevron-left  "></i> <?php echo $this->tag->getTag('back','Back');?></div>
			<?php echo $this->tag->getTag('popular-neighborhoods','Popular Neighborhoods');?> </div>
		<div class="clearfix"></div>
		<?php
		$checked = ''; $checkCity = !empty($formData['state']) ? true : false;$more =array();$checked2 = ''; $apeend='';
		if(isset($formData['more']) and !empty($formData['more'])){
			$more= explode('|',$formData['more']);$apeend='++';
		}
		echo '<div class="xity-list">';
		foreach($cityDats as $k=>$v){ 
			 $checked = '';$checked2 ='';
			 if($checkCity ) { 
					 $checked = $formData['state']==$k ? 'checked="true"' : ''; 
					
					if($checked){ $txt_see=$v.$apeend ; echo '<script>$("#sec_state_html").html("'.trim($txt_see).'");</script>';}
					else{   $checked2 = in_array($k,$more) ? 'checked="true"' : ''; }
				  } 
				$checked3 =  empty($checked) ? $checked2 : $checked;
				$reg_id = $region_list[$k]; $slug_region = ''; $slug_region_Active_class ='';
				if(isset($formData['reg']) and !empty($formData['reg'])){
					$slug_region = $regions[$reg_id]['slug'];
					$slug_region_Active_class = ($slug_region==@$formData['reg']) ? 'active' : '';
				}
		 
			?> 
    <div class="row-items arab-separator_secondary citlist <?php echo $slug_region_Active_class;?>" data-value="<?php echo $reg_id;?>" 	>
    <input type="checkbox" <?php echo $checked3;?> onchange="getSelectedTextNew(this);"  class="inpsCity StyledFormControl-c11n-8-27-0__sc-18qgis1-0 PECat Radio-c11n-8-27-0__yicu80-0 srp__dimomh-3 iesges"   data-value="<?php echo $v;?>" id="state<?php echo  $k;?>"   value="<?php echo  $k;?>" />
	<div  hidden>
	 <input type="radio" <?php echo $checked;?> onchange="getSelectedText(this);"  class="StyledFormControl-c11n-8-27-0__sc-18qgis1-0 PECat Radio-c11n-8-27-0__yicu80-0 srp__dimomh-3 iesges" name="state" data-value="<?php echo $v;?>" id="state<?php echo  $k;?>"   value="<?php echo  $k;?>" />
	 <input type="checkbox" <?php echo $checked2;?>     class="more-statefilter StyledFormControl-c11n-8-27-0__sc-18qgis1-0 PECat Radio-c11n-8-27-0__yicu80-0 srp__dimomh-3 iesges "   data-value="<?php echo $v;?>" id="state<?php echo  $k;?>"   value="<?php echo  $k;?>" />
   
	</div>
    <label for="state<?php echo  $k;?>" ><span class="txt-c"  ><?php echo $v;?></span></label>
    <div class="clearfix"></div>
    </div>
      <?php }
      echo '</div>';
       echo '<input type="radio" name="state" value="" style="display:none;">';
       echo '<input  type="hidden" name="more" value="'.$formData['more'].'"  >';
     
      
      ?> 
    </div>
    <div class="srp__sc-1scjcmt-0 eFpjEy"><button aria-describedby="listing-type-form" class="StyledButton-c11n-8-27-0__wpcbcc-0 hnSTQE srp__sc-1scjcmt-2 fkEYux" onclick="search_byAjax()" ><?php echo $done;?></button></div>
    </div>

</li>

<li class="nm-fltr  arab-li-1 margin-right-10  port-search">
		 			  <div tabindex="-1" class="sc-chAAoq lgJTPn"  >
   <div class="sc-cBdUnI jNhpJt <?php echo (!empty($formData['word'])) ? ' filter-button_active-m ' : '';?>">
      <div class="sc-18n4g8v-0 gAhmYY sc-hdPSEv gaQgjK" style="width:100% !important;">
         <i class="rbbb40-1 MxLSp pointer" color="var(--secondary-color)" onclick="search_byAjax23n()" style="color:var(--secondary-color);cursor:pointer" size="20" > <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 339.921 339.921" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <path style="" d="M335.165,292.071l-81.385-84.077c-5.836-6.032-13.13-8.447-16.29-5.363 c-3.171,3.062-10.47,0.653-16.306-5.379l-1.164-1.207c36.425-47.907,32.89-116.499-10.851-160.24 c-47.739-47.739-125.142-47.739-172.875,0c-47.739,47.739-47.739,125.131,0,172.87c44.486,44.492,114.699,47.472,162.704,9.045 l0.511,0.533c5.825,6.032,7.995,13.402,4.814,16.469c-3.166,3.068-1.012,10.443,4.83,16.464l81.341,84.11 c5.836,6.016,15.452,6.195,21.49,0.354l22.828-22.088C340.827,307.735,340.99,298.125,335.165,292.071z M182.306,181.81 c-32.852,32.857-86.312,32.857-119.159,0.011c-32.852-32.852-32.847-86.318,0-119.164c32.847-32.852,86.307-32.847,119.148,0.005 C215.152,95.509,215.152,148.964,182.306,181.81z" fill="currentColor" data-original="#010002"/> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg></i>
         <div class="typeahead__container" id="form-user_v2" style="width:100%;">
        <div class="typeahead__field">
            <div class="typeahead__query">
				<?php
				if(isset($formData['locality'])){ $value = $formData['locality']; }else if(isset($formData['word'])){  $value = $formData['word']; }else {  $value='';  } ?> 
                <input class="js-typeahead-user_v2" id="js-typeahead-user_v2"  onclick="generateAutocomlist(this);$(this).select();" onchange="unsetlats()"  value="<?php echo  $value;?>"  placeholder="<?php echo $this->tag->getTag('enter_city,_neighborhood_or_bu','Enter City, Neighborhood or Building');?>" autocomplete="off">
            </div>
        </div>
    </div>
    
        
        </div>
        
    </div>
</div>
					 <div class="mb-btn-mo-only">
					 <button class="btn btn-red slpcls" onclick="closeFilteronly()"><img src="<?php echo $this->app->apps->getBaseUrl('assets/img/close.png');?>"></button>
					 </div>
</li>