<li class="arab-drop-down  arab-li-1 sectionFilter margin-right-10  port-bed">
	
	<button id="bet-bt" class="StyledButton-c11n-8-27-0__wpcbcc-0 hnSTQE srp__fdiad6-0 hlkFos filter-button  filter-button_active <?php echo (!empty($filterModel->bedrooms) or !empty($filterModel->bathrooms)) ? 'filter-button_active-m' : '';?> " onclick="openDropDown(this)" tabindex="0" aria-expanded="true">
	    <span>
	        <span id="bedhtml"><?php echo $bed_html;?></span>
	        <span style="display: inline-flex;align-items: center;" class="splfnt-a"><?php echo $this->tag->getTag('&','&');?> </span> 
	        <span id="bathhtml"><?php echo $bath_html;?></span>
	   </span>
	    
	  </button>
    <div class="arab-drop-down.popover popoversect filter-button-popover">
    <span class="zsg-popover-arrow"  ></span>
    
    <div class="filter-sector  filter-sector-padding">
   <div class="fltr-hd margin-top-15"><?php echo $bedrooms;?></div>
   
  
	<div name="beds-options" aria-label="Beds Select" class="StyledButtonGroup-c11n-8-27-0__sc-12tlbte-0 kfxgnd srp__zit8we-0 cVSuZi cVSuZibed " direction="row" role="group">
	    <?php
		$bath_rooms = $filterModel->bedroomSearchIndex();
		foreach($bath_rooms  as $k=>$v){
			if($filterModel->bedrooms== $k and $k!= ''){
				$bed_html = $v.'<span class="svg"><svg viewBox="0 0 70.098 53.605" class="smartad_bedicon"> <use xlink:href="#svg-bed1"></use> </svg> </span>';
				 echo '<script>$("#bedhtml").html("'.addslashes($bed_html).'");</script>';
			}
		echo '<button dir="ltr" class="StyledButton-c11n-8-27-0__wpcbcc-0 iBaOPD ';echo  ( $filterModel->bedrooms== $k ) ? ' btnSelected ':'' ; echo '" onclick="setThisBedroomVal2(this)" data-value="'.$k.'">'.$v.'</button>';

		}
		?>
		<div class="clearfix"></div>
		</div>


   
     <div class="fltr-hd margin-top-15"><?php echo $bathrooms;?></div>
   
				<div class="clearfix"></div>
  <div name="bath-options" aria-label="Beds Select" class="StyledButtonGroup-c11n-8-27-0__sc-12tlbte-0 kfxgnd srp__zit8we-0 cVSuZi cVSuZibbath" direction="row" role="group">
	 <?php
			$bath_rooms = $filterModel->bathroomSearchIndex();
			foreach($bath_rooms  as $k=>$v){
				if( $filterModel->bathrooms== $k and $k!= ''){
					$bath_html = $v.'<svg viewBox="0 0 70.098 53.605" class="smartad_bathicon"><use xlink:href="#svg-bath1"></use> </svg>  ';
					echo '<script>$("#bathhtml").html("'.addslashes($bath_html).'");</script>';
				}
			echo '<button dir="ltr" class="StyledButton-c11n-8-27-0__wpcbcc-0 iBaOPD cVSuZi ';echo  ( $filterModel->bathrooms== $k ) ?'btnSelected':'' ; echo '" onclick="setThisBathroomVal2(this)" data-value="'.$k.'">'.$v.'</button>';
			
			}
			?>
 	<div class="clearfix"></div>
	  </div>  
   	<div class="clearfix"></div>
   
    </div>
    
    
    <div class="srp__sc-1scjcmt-0 eFpjEy"><button aria-describedby="listing-type-form" class="StyledButton-c11n-8-27-0__wpcbcc-0 hnSTQE srp__sc-1scjcmt-2 fkEYux" onclick="search_byAjax()" ><?php echo $done;?></button></div>
    </div>

</li>