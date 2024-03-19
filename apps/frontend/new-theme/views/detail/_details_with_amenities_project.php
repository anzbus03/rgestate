<?php $unitIds = PlaceAnAdUnits::model()->getFullUnits($model->id);  ?>
<div id="m_about" class="padding-top-30"></div>
<div class="propertypage_factsamenities">
   <div class="facts">
      <div class="facts_container detail">
         <h2 class="headline" id="to_description"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="18" height="18" x="0" y="0" viewBox="0 0 502 502" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M176.062,232.224H54.963C24.656,232.224,0,207.567,0,177.261V56.162C0,25.855,24.656,1.199,54.963,1.199h121.099 c30.307,0,54.963,24.656,54.963,54.963v121.099C231.025,207.567,206.369,232.224,176.062,232.224z M54.963,21.199 C35.684,21.199,20,36.884,20,56.162v121.099c0,19.278,15.684,34.963,34.963,34.963h121.099c19.279,0,34.963-15.685,34.963-34.963 V56.162c0-19.278-15.684-34.963-34.963-34.963H54.963z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M46.9,182c-5.523,0-10-4.478-10-10v-23c0-5.522,4.477-10,10-10s10,4.478,10,10v23C56.9,177.522,52.423,182,46.9,182z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M46.9,122c-5.523,0-10-4.478-10-10V65.1c0-14.888,12.112-27,27-27H86c5.523,0,10,4.478,10,10s-4.477,10-10,10H63.9 c-3.86,0-7,3.141-7,7V112C56.9,117.522,52.423,122,46.9,122z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M447.037,232.224H325.938c-30.307,0-54.963-24.656-54.963-54.963V56.162c0-30.307,24.656-54.963,54.963-54.963h121.099 C477.344,1.199,502,25.855,502,56.162v121.099C502,207.567,477.344,232.224,447.037,232.224z M325.938,21.199 c-19.279,0-34.963,15.685-34.963,34.963v121.099c0,19.278,15.684,34.963,34.963,34.963h121.099 c19.279,0,34.963-15.685,34.963-34.963V56.162c0-19.278-15.684-34.963-34.963-34.963H325.938z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M176.062,500.801H54.963C24.656,500.801,0,476.145,0,445.838V324.739c0-30.307,24.656-54.963,54.963-54.963h121.099 c30.307,0,54.963,24.656,54.963,54.963v121.099C231.025,476.145,206.369,500.801,176.062,500.801z M54.963,289.776 C35.684,289.776,20,305.461,20,324.739v121.099c0,19.278,15.684,34.963,34.963,34.963h121.099 c19.279,0,34.963-15.685,34.963-34.963V324.739c0-19.278-15.684-34.963-34.963-34.963H54.963z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M447.037,500.801H325.938c-30.307,0-54.963-24.656-54.963-54.963V324.739c0-30.307,24.656-54.963,54.963-54.963h121.099 c30.307,0,54.963,24.656,54.963,54.963v121.099C502,476.145,477.344,500.801,447.037,500.801z M325.938,289.776 c-19.279,0-34.963,15.685-34.963,34.963v121.099c0,19.278,15.684,34.963,34.963,34.963h121.099 c19.279,0,34.963-15.685,34.963-34.963V324.739c0-19.278-15.684-34.963-34.963-34.963H325.938z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg> <?php echo $this->tag->getTag('about_the_project','About the project');?></h2>
         <div class="clearfix"></div>
         <ul>
   <li class="left">
      <div class="category left"><?php echo $model->getAttributeLabel('reference');?></div>
      <div class="value left"><?php echo $model->ReferenceNumberTitle;?></div>
   </li>
   <li class="left">
      <div class="category left"><?php echo $this->tag->getTag('title', 'Title') ;?></div>
      <div class="value left">
         <?php echo $model->ad_title;?>
      </div>
   </li>
   <li class="left">
      <div class="category left"><?php echo $this->tag->getTag('locality', 'Locality') ;?></div>
      <div class="value left"><?php echo $model->LocationTitle;?></div>
   </li>
   <li class="left">
      <div class="category left"><?php echo $this->tag->getTag('price', 'Price') ;?></div>
      <div class="value left" style="font-weight:600">
         <span>
         <?php echo $this->tag->getTag('price', 'Starting from') ;?>
         </span>
         <?php echo $model->PriceTitleSpanL; $model->price_to;   
         if(!empty($model->price_to) and  $model->price_to != '0.00'){
		  echo ' to '.$model->PriceTitleSpanT;
		  };?>
      </div>
   </li>
   <li class="left">
      <div class="category left"><?php echo $this->tag->getTag('Type', 'Type') ;?></div>
      <div class="value left">  <?php
  $all_property_types = $model->all_property_types();
  if(!empty($all_property_types)){  ?> 
    
       <?php
       $str = '';
			 foreach($all_property_types as $k2=>$v2){  $str .= $v2->category_name.',';}
			echo rtrim( $str , ','); 	 
		}
       ?> 
       </div>
   </li>
   <li class="left">
      <div class="category left"><?php echo $this->tag->getTag('developer', 'Developer') ;?></div>
      <div class="value left"><?php echo $model->companyName;?> </div>
   </li>
</ul>
         <div class="clearfix"></div>
<div class="text-trimmer-wrapper  ">
 <div  class="padding-top-30"></div>
   
	<style>.top-desc    span  {white-space:initial !important; }  #txttrim ul {overflow: initial;    margin: 0px 20px;}  #txttrim  li{display: list-item;float: none;background: transparent;line-height: 1.8;list-style-type: disc;margin: 0px !important;height: auto;list-style: initial !important;} </style>
	<div data-qs="text-trimmer"  id="txttrim" class=" "  ><div class="top-desc"><?php echo $model->adDescription2;?></div>
	<?php
						  if(!empty($model->video)){
						      preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->video, $match);
$youtube_id = @$match[1];
 
							  echo '<div class="clearfix"></div> ';
							  ?>
							  <style>
							      .video-container3 {
position: relative;
padding-bottom: 56.25%;margin-top:15px;
padding-top: 30px; height: 0; overflow: hidden;
}
 
.video-container3 iframe,
.video-container3 object,
.video-container3 embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
							      
							  </style>
							  <?php 
							   
			//  echo '<div style="position:relative;margin-top:15px;width:100%"><div class="video-container2" style="width:100%; "><iframe class="video"   src="https://www.youtube.com/embed/'.@$youtube_id.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" style="height:100%;" allowfullscreen></iframe></div> </div>';
					 
					 echo '<div class="video-container3"><iframe width="853" height="480"   src="https://www.youtube.com/embed/'.@$youtube_id.'" frameborder="0" allowfullscreen></iframe></div>';
					 	  echo '<div class="clearfix"></div> ';
						  ?>
						  
						  <?
							}
					 	?>
	
	</div></div>
 
<div class="clearfix"></div>
      </div>
   </div>
</div>
<?php /*
<div class="propertypage_factsamenities  margin-top-40">
   <div class="facts">
      <div class="facts_container">
    
         <h3 class="facts_heading">Facts</h3>
         <div class="facts_list">
            <div class="facts_listitem">
               <div class="facts_label"><?php echo $model->getAttributeLabel('price');?></div>
               <div class="facts_content">
                 <?php echo $model->PriceTitleSpan;?>
               </div>
            </div>
			<?php
			foreach($array as $k=>$fld){
			if(!empty( $fld)) { 
			?>
			<div class="facts_listitem">
               <div class="facts_label"><?php echo $model->getAttributeLabel($k);?></div>
               <div class="facts_content"><?php echo $fld;?></div>
            </div>
			<?
			}
			}
			?>
           
         </div>
      </div>
   </div>
</div>
*/
?>

<script>
function showWithoutTrim(k){
	if($('#txttrim').hasClass('texttrim-enabled')){
		$('#txttrim').removeClass('texttrim-enabled');
		$('#asss2').focus();
		$(k).html('Read Less')
	}
	else{
		$('#txttrim').addClass('texttrim-enabled');
		$('#asss').focus();
		$(k).html('Read More')
	}
}
</script>
 


<div class="clearfix"></div>
 
</div>
<div class="clearfix"></div>

 
<?php
  $amentites = $model->all_amentitie();
if(!empty( $amentites)){ ?>  
<div id="m_features" class="padding-top-40"></div>
<div class="propertypage_factsamenities">
      <div class="amenities margin-top-0">
      <div class="amenities_container">
         <h2 class="headline" id="t_features" ><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 502.001 502.001" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M83.497,0c-5.523,0-10,4.478-10,10v143.574c0,5.522,4.477,10,10,10h44.125V492c0,4.199,2.624,7.952,6.568,9.393 c3.944,1.442,8.369,0.264,11.077-2.946L251,373.054l105.733,125.393c1.938,2.298,4.755,3.555,7.647,3.555 c1.148,0,2.309-0.198,3.43-0.608c3.944-1.44,6.568-5.193,6.568-9.393V163.574h44.125c5.523,0,10-4.478,10-10V10 c0-5.522-4.477-10-10-10H83.497z M127.053,143.574H93.497V20h33.556V143.574z M354.379,464.628l-95.733-113.533 c-1.9-2.253-4.698-3.554-7.645-3.554s-5.745,1.301-7.645,3.554l-95.733,113.533V20h206.757V464.628z M408.504,143.574h-33.556V20 h33.556V143.574z" fill="currentColor" data-original="#000000" style=""/> <path d="M180.353,374.378c5.523,0,10-4.478,10-10v-47.857c0-5.522-4.477-10-10-10s-10,4.478-10,10v47.857 C170.353,369.9,174.83,374.378,180.353,374.378z" fill="currentColor" data-original="#000000" style=""/> <path d="M180.353,280.94c5.523,0,10-4.478,10-10V68.113c0-5.522-4.477-10-10-10s-10,4.478-10,10V270.94 C170.353,276.463,174.83,280.94,180.353,280.94z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg> <?php echo  $this->tag->getTag('features_/_amenities','Features / Amenities') ;?></h2>
         <div class="amenities_list">
			 <?php
			 foreach($amentites as $k=>$v){ ?> 
            <div class="amenities_listitem">
               <i class="fa fa-check amenities_icon"></i>
               <div class="amenities_content"><?php echo $v->amenities_name;?></div>
            </div>
            <?php } ?> 
         </div>
      </div>
   </div>
</div>
<?php } ?> 
 
<style>
    .button.orangeb {
    border-radius: 4px;
    background: #FC6645;
    box-shadow: 0 1px 6px 0 rgba(32,33,36,.28);
    font-weight: 400;
    position: relative;
    line-height: 1;
    display: inline-block;
    vertical-align: middle;
    margin-left: 15px;
    padding: 5px 8px;
    font-size: 14px;
}
.button.mp-near { line-height:1 ; border-radius:8px !important;}
    .button.mp-near:hover {
    color: var(--link-color);
    background: #f8f8f8;
}
</style>
<div class="clearfix"></div>
<div id="m_map" class="padding-top-40"></div>
   <div class="   margin-top-0">
						   <h2 class="headline" id="to_map"    ><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 502 502" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <g xmlns="http://www.w3.org/2000/svg"> <g> <path d="M251,502c-3.443,0-6.645-1.771-8.473-4.689C236.212,487.236,87.87,249.582,87.87,163.13C87.87,73.18,161.05,0,251,0 s163.13,73.18,163.13,163.13c0,86.452-148.342,324.106-154.657,334.181C257.645,500.229,254.443,502,251,502z M251,20 c-78.922,0-143.13,64.208-143.13,143.13c0,32.929,26.05,99.093,75.333,191.34c27.067,50.662,54.401,96.442,67.797,118.444 c13.396-22.001,40.729-67.782,67.797-118.444c49.283-92.247,75.333-158.412,75.333-191.34C394.13,84.208,329.922,20,251,20z M251,249.181c-47.448,0-86.051-38.603-86.051-86.051S203.552,77.079,251,77.079s86.051,38.602,86.051,86.051 S298.448,249.181,251,249.181z M251,97.079c-36.421,0-66.051,29.63-66.051,66.051c0,36.421,29.63,66.051,66.051,66.051 s66.051-29.63,66.051-66.051C317.051,126.709,287.421,97.079,251,97.079z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M133.949,173.13c-5.522,0-10-4.477-10-10c0-24.107,6.783-47.57,19.617-67.852c12.482-19.727,30.113-35.633,50.985-46 c4.945-2.458,10.947-0.438,13.404,4.508s0.438,10.948-4.508,13.404c-36.7,18.229-59.499,54.991-59.499,95.939 C143.949,168.653,139.472,173.13,133.949,173.13z" fill="currentColor" data-original="#000000" style=""/> </g> <g> <path d="M302.994,68.238c-1.494,0-3.012-0.336-4.44-1.046C283.708,59.818,267.709,56.079,251,56.079c-5.522,0-10-4.477-10-10 s4.478-10,10-10c19.823,0,38.815,4.441,56.45,13.2c4.946,2.457,6.965,8.458,4.508,13.404 C310.211,66.201,306.672,68.238,302.994,68.238z" fill="currentColor" data-original="#000000" style=""/> </g> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg>  <?php echo  $this->tag->getTag('map','Map') ;?><a class="button orangeb" onclick="$('#myModal-nearbyLocation').modal('show');$('#thisschools').click();   "> <img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/locationg.png');?>"> <?php echo $this->tag->getTag('view_near_by_locations','View Near By Locations');?></a></h2>
						   <div></div>
						</div>
						<div class="clearfix"></div>
						<div   class="" style="margin-bottom: 0px;width:100%;">
							 <?php $this->renderPartial('_detail_map_view');?>
						</div>
					
<div class="clearfix"></div>
<div class="clearfix"></div> 
					<?php $this->renderPartial('_property_types');?>
<div class="clearfix"></div>
<?php 
					if(!empty($unitIds)){
					$this->renderPartial('available_units',compact('unitIds')); } ?>
					<div class="clearfix"></div>
<style>
    .tabcontent {display:none; } .tabcontent.active {display:block; }.tab button { color: #fff;}
</style>
	<?php
 
	if(!empty($payment_plan)){
	?> 
	<div id="m_payment_plan" class="padding-top-40"></div>
<div class="margin-top-0" id="payment_plan" style="position: relative;">
	 

	 <h2 class="headline" ><?php echo  $this->tag->getTag('payment_plan','Payment Plan') ;?><?php echo '' ;?></h2>
	  <?php $this->renderPartial('_payment_plan');?>
	
	 
  
   </div>
	<?php } 
	?>			
<div class="clearfix"></div>
	<?php
 
	if(!empty($floor)){
	?> 
		<div id="m_floor_plan" class="padding-top-40"></div>
<div class="margin-top-0" id="to_florr" style="position: relative;">
	 

	 <h2 class="headline" id="t_floor" ><?php echo  $this->tag->getTag('floor_plan','Floor Plan') ;?><span style="font-weight: 400 !important;display: inline;font-size: 18px;margin-left: 15px;" id="show_3d" class="hide"><?php echo $this->tag->gettag('show_3d','Show 3D');?> <label class="switch">  <input type="checkbox" onchange = "Setthisinput(this)" >  <span class="slider round"></span></label></span></h2>
	  <?php $this->renderPartial('_floor_plan');?>
	
	 
  
   </div>
	<?php } 
	?>			
	
<div class="clearfix"></div>
	<div id="m_developer" class="padding-top-40"></div>
<div class="propertypage_factsamenities margin-top-0 margin-bottom-15  ">
   <div class="facts">
      <div class="facts_container">
         <h2 class="headline"  id="to_developer"><?php echo  $this->tag->getTag('contact','Contact') ;?></h2>
         <div class="clearfix"></div>
         <style>
             .m-mob-dip1 .mbtn-div {     max-width: 378px;; }
             #detail  .m-mob-dip1 .mbtn-div .fENbfA {
    background-color: #fff !important;
}       #detail  .m-mob-dip1 .mbtn-div .fENbfA {
    background-color: #fff !important;
    color: #222!important;
    border: 1px solid #222!important;
    margin-right: 6px !important;
}
         </style>
         			<div class="m-mob-dip1">
 
<div class="col-sm-12  padding-right-0 call-btn-div  mbtn-div" style="padding:0px;width:100% !important">
    <a type="button"    style="color:#fff;padding-left: 2px;padding-right: 2px; " onclick="OpenCallNew(this)" data-prop="<?php echo $model->id;?>" data-phone="<?php echo base64_encode($model->mobile_number);?>"   data-testid="lead-form-submit" style="margin-bottom:8px" class="b-l-l-m    Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA" dir="ltr"><i class="fa fa-phone" style="font-size: 20px;margin-right: 3px;"></i> <?php echo  $this->tag->getTag('call','Call')  ;?></a>
    <?php $w_share_url = Yii::t('app','https://wa.me/{number}?text={text}',array('{number}'=>Yii::t('app',!empty($model->whatsapp) ? $model->whatsapp : $model->mobile_number,array('+'=>'',' '=>'')) ,'{text}'=>  'I would like to inquire about your property Feeta - '.$model->ReferenceNumberTitle.'. Please contact me at your earliest convenience. %0aProperty Link %0a' .   urlencode(Yii::app()->createAbsoluteUrl('detail/index_project',array('slug'=>$model->slug))) ));?>
 
    <a type="button"    target="_blank" style="color:#fff; "  onclick="OpenWhatsappNew(this)" data-href="<?php echo  $w_share_url;?>"    data-testid="lead-form-submit" style="margin-bottom:8px" class="   Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA wtspp"><i class="fa fa-whatsapp" style="font-size: 20px;margin-right: 3px;"></i> </a>
    <button type="button" onclick="OpenFormClickNew(this)" data-reactid="<?php echo $model->id;?>" data-testid="lead-form-submit" style=" " class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA"><i class="fa fa-envelope"  style="font-size: 20px;margin-right: 3px;"></i> <?php echo  $this->tag->getTag('email','Email') ;?></button>
    
    </div>
 
</div>

         <div class="hide">
				 <div class="img_dev mobe pull-left" style="width:90px;height:90px;border:1px solid #eee;text-align: center; ">
				 <?php 
								   
								$image = $model->companyImage; 
								$profile_url = ($model->premium_u=='1') ? 'detail_developer'  : 'detail'; 
								$lnk = $model->enable_l_f=='1' ?  Yii::app()->createUrl('user_listing/'.$profile_url ,array('slug'=>$model->user_slug)) : 'javascript:void(0)' ; 
								if(!empty($image)){
								echo '<a href="'.$lnk.'"  style="display: block;margin: 0 auto;line-height:90px;" ><img src="'.$image.'" style="object-fit:contain;width:90%;height:90%;" ></a>';
								 } ?>
				 </div>
				   <div class="img_dev_details  pull-right" style="width:calc(100% - 105px); ">
					   <div class="_1p3joamp" style="margin-bottom: 5px !important;"><a href="<?php echo $lnk;?>"class="<?php echo $model->enable_l_f=='1' ? 'link_color ' : '';?>" ><?php echo $model->companyName;?></a>
					   
					   </div> 
					   <p class="margin-bottom-5"><span style="font-weight:600"><?php echo  $this->tag->getTag('contact_person','Contact Person') ;?></span> : <?php echo $model->first_name;?> </p>
					   <?php
					   if(!empty($model->user_address)){ ?> 
					   <p class="margin-bottom-5"><span style="font-weight:600"><?php echo  $this->tag->getTag('address','Address') ;?></span> : <?php echo $model->user_address;?> </p>
					   <?php } ?> 
					</div> 
         </div>
       
         <div class="clearfix"></div>
<div class="text-trimmer-wrapper  margin-top-20">
	<input type="text" id="asss"  style="position:absolute;left:-999999px;height:1px;visinility:hidden;"/>
	<input type="text" id="asss2"  style="position:absolute;left:-999999px;height:1px;visinility:hidden;"/>
	<div data-qs="text-trimmer"  id="txttrim" class=" "  ><?php echo nl2br($model->user_description);?></div></div>
 
<div class="clearfix"></div>
      </div>
   </div>
</div>
