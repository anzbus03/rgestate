<style>
    .n-gen-c1 { margin-top:0px;   }
    .user_details {  padding:7px;border-radius:4px; }
    .sale_link { color:var(--color-sale) !important; text-decoration:underline; }
     .rent_link { color:var(--color-rent) !important; text-decoration:underline; }
     .propertypage_factsamenities.n-gen-c2 .facts_listitem{ width:33.3333333%;}
    @media only screen and (max-width: 600px) {
   .n-gen-c1.pull-right{ float:left; width:100%;padding:0px; margin-bottom:25px;  }
   .n-gen-c2 { width:100%;padding-right:0px !important; }
   .user_details.margin-top-15 { margin-top:0px !important; }
   
}
.facts_heading svg {
    color: var(--secondary-color);
}
#detail .margin-top-20.sec-head1 { margin-top:30px !important; }
 
 
</style>
<div class=" col-sm-12 no-padding-left pull-left spl-no-padding-mob">
				<div class="user_details only-mob margin-top-5 no-padding text-center">
				            							<?php
							// if(!empty($model->puser_id)){ 
							// echo '<div style="width:100%;">';
							// $this->renderPartial('_agentDetais');
							// echo '</div>';
							?>
							<?php // }else { ?>

							<div class="img_dev mobe  " style="width:100%;  text-align: center;    display: block;margin: auto;    width:55px!important;    height:55px!important;    ">
							<?php 

							$image = $model->companyImage; 
						

							$lnk = $model->DetLink  ; 
							if(!empty($image)){
							echo '<a href="'.$lnk.'"  style="    line-height: 1 !important;    display: inline-block !important;    height: 100%;    width: 100%;" ><img src="'.$image.'" style="box-shadow: 0 1px 6px 0 rgba(32,33,36,.28);    border-radius: 50%;object-fit:contain;width:100%;height:100%;padding:5px; " ></a>';
							} ?>
							</div>
						 
							<div class="img_dev_details pull-right margin-top-15 margin-left-15" style=" margin-top:5px !important;  ">
							<div class="_1p3joamp no-padding" style="margin-bottom: 2px !important;padding:0px!important"><a href="<?php echo $lnk;?>"class="<?php echo $model->enable_l_f=='1' ? 'link_color ' : '';?>" ><?php echo $model->companyName;?></a>

							</div> 
							<?php
							if(empty($model->companyName)){ ?> 
							<p class="margin-bottom-2" style="margin-bottom:2px;white-space: nowrap;"><i class="fa fa-user"></i>   <?php echo $model->first_name;?> </p>
							<?php } ?> 
								<?php
							 
							if(!empty($model->advertiser_character)){  
							?>
							 
							<span class="smllgry nowrap margin-top-5 hide"><i><?php echo $this->tag->getTag('advertiser-character','Advertiser Character');?></i> : <?php echo $model->ArabicCharacter;?> </span>
							<?php } ?>
							<div class="clearfix"></div>
							<?php
							 
							if(!empty($model->licence_no)){  
							?>
							 
							<span class="smllgry nowrap hide"><i><?php echo $this->tag->getTag('advertiser_license_number','Advertiser License Number');?></i> : <?php echo $model->licence_no;?> </span>
							<?php } ?>
							<div class="clearfix"></div>
							<?php
							if(!empty($model->cr_number)){  
							?>
							 
							<span class="smllgry nowrap hide"><i><?php echo $this->tag->getTag('commercial_registration_no.','Commercial Registration No.');?></i> : <?php echo $model->cr_number;?> </span>
							<?php } ?>
							<p class="margin-bottom-0 margin-top-5 sal-dec"><?php echo CHtml::link($this->tag->getTag('sale','Sale').'('.(int)$total_rest['sale_total'].')',Yii::app()->createUrl('listing/index',array('sec'=>'property-for-sale','dealer'=>$model->user_slug)),array('class'=>'sale_link'));?> ,    <?php echo CHtml::link($this->tag->getTag('rent','Rent').'('.(int)$total_rest['rent_total'].')',Yii::app()->createUrl('listing/index',array('sec'=>'property-for-rent','dealer'=>$model->user_slug)),array('class'=>'rent_link'));?></p>
							</div> 
                            <?php // } ?> 
							<div class="clearfix"></div>
							</div>
						
				
 
<div class="propertypage_factsamenities n-gen-c2  onscrol" id="facts">
   <div class="facts">
      <div class="facts_container">
         <h2 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m1.75 15h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m1.75 24h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m22.25 8h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m22.25 17h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m22.25 0h-12.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h12.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><circle xmlns="http://www.w3.org/2000/svg" cx="3" cy="3" r="3" fill="currentColor" data-original="#000000" style=""/></g></svg> <?php echo  $this->tag->getTag('facts','Facts') ;?>  </h2>
         <div class="facts_list">
                
		        <span class="frch-btn">
		            <?php echo $model->ListingTypeCategory;?>
		        </span>
            <?php
									    
										echo '<ul class="spl-leased row margin-top-15 margin-bottom-0" style="">'; 
										   echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$model->getAttributeLabel('reference').'</label><span>'.$model->ReferenceNumberTitle.'</span></li>';
										 
										if($model->category_id=='194'){
										     $f_fee = $model->getPriceTitleSpanLNee('category_id',$model->f_fee,'');
										    if(!empty($f_fee)){
										    echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$model->getAttributeLabel('f_fee').'</label><span>'.$f_fee.'</span></li>';
										    }
										     $asking_price = $model->getPriceTitleSpanLNee('p_o_r',$model->price,$model->price_to);
										    if(!empty($asking_price)){
										    echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$model->getAttributeLabel('investment').'</label><span>'.$asking_price.'</span></li>';
										    }
										    
										}else{
										    $asking_price = $model->getPriceTitleSpanLNee('p_o_r',$model->price,$model->price_to);
										    if(!empty($asking_price)){
										    echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$model->getAttributeLabel('price').'</label><span>'.$asking_price.'</span></li>';
										    }
										    $revenue = $model->getPriceTitleSpanLNee('request_r',$model->price_false,$model->price_to_false);
										    if(!empty($revenue)){
									         echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$model->getAttributeLabel('price_false').'</label><span>'.$revenue.'</span></li>';
										    }
										    $b1= $model->getPriceTitleSpanLNee('p_b_r',$model->price_b,$model->price_b_to);
										    if(!empty($b1)){
									         echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$model->getAttributeLabel('price_b').'</label><span>'.$b1.'</span></li>';
										    }
										    $modelaluation = $model->getPriceTitleSpanLNee('p_v_r',$model->price_v,$model->price_v_to);
										    if(!empty($modelaluation)){
									             echo '<li  class="col-sm-6 margin-bottom-15" ><label>'.$model->getAttributeLabel('price_v').'</label><span>'.$modelaluation.'</span></li>';
										    }
										}
										
											echo '</ul>';
										
									  ?>
         </div>
      </div>
   </div>
</div>



<div class="clearfix"></div>
	<?php $property_information = $model->property_information(); 
	$val_array =  array_values($property_information);
	if(!empty($val_array)){
	?> 
   <div class="propertypage_factsamenities margin-top-60 sec-head1 onscrol " id="property_information">
      <div class="amenities  margin-top-0">
      <div class="amenities_container col-sm-12 no-padding">
         <h2 class="facts_heading  "><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><g><path d="m497 512h-301c-8.291 0-15-6.709-15-15v-301c0-8.291 6.709-15 15-15h301c8.291 0 15 6.709 15 15v301c0 8.291-6.709 15-15 15z" fill="currentColor" data-original="#000000" style=""/></g><path d="m151 196c0-24.814 20.186-45 45-45h135v-136c0-8.291-6.709-15-15-15h-301c-8.291 0-15 6.709-15 15v301c0 8.291 6.709 15 15 15h136z" fill="currentColor" data-original="#000000" style=""/></g></g></svg> <?php echo  $this->tag->getTag('property_information','Property information') ;?></h2>
         <div class="amenities_list1 nnea margin-top-0"  >
			 <?php
		            echo '<ul>';
                     foreach($property_information as $k=>$v){
                         if(empty($v)){ continue; }
                         echo '<li class="row"><span class="col-sm-6 margin-bottom-10"><strong>'.$model->getAttributeLabel($k).'</strong><span class="pull-right">:</span></span><span class="col-sm-6">'.$v.'</span></li>';
                     }
                 echo '</ul>';
              
             
            
            ?> 
         </div>
      </div>
   </div>
</div>
   
    <?php } ?> 
<div class="clearfix"></div>
	<?php $business_descp = $model->business_descp(); 
	$val_array =  array_values($property_information);
	if(!empty($val_array)){
	?> 
   <div class="propertypage_factsamenities margin-top-60 sec-head1 onscrol " id="business_descp">
      <div class="amenities  margin-top-0">
      <div class="amenities_container col-sm-12 no-padding">
         <h2 class="facts_heading  "><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><g><path d="m497 512h-301c-8.291 0-15-6.709-15-15v-301c0-8.291 6.709-15 15-15h301c8.291 0 15 6.709 15 15v301c0 8.291-6.709 15-15 15z" fill="currentColor" data-original="#000000" style=""/></g><path d="m151 196c0-24.814 20.186-45 45-45h135v-136c0-8.291-6.709-15-15-15h-301c-8.291 0-15 6.709-15 15v301c0 8.291 6.709 15 15 15h136z" fill="currentColor" data-original="#000000" style=""/></g></g></svg> <?php echo  $this->tag->getTag('Business Operation','Business Operation') ;?></h2>
         <div class="amenities_list1 nnea margin-top-0"  >
			 <?php
		            echo '<ul>';
                     foreach($business_descp as $k=>$v){
                         if(empty($v)){ continue; }
                         echo '<li class="row"><span class="col-sm-6 margin-bottom-10"><strong>'.$model->getAttributeLabel($k).'</strong><span class="pull-right">:</span></span><span class="col-sm-6">'.$v.'</span></li>';
                     }
                 echo '</ul>';
              
             
            
            ?> 
         </div>
      </div>
   </div>
</div>
   
    <?php } ?> 

<?php 
if($hasedit and !empty($model->slug_z)){
?>
<a class="btn-block headfont btn-sm-s" href="<?php echo $model->RefereceWebUrl;?>" style="color:red !important;text-decoration:underline;" target="_blank">Reference URL</a>
<?php } ?>
<div class="clearfix"></div>
<div class="text-trimmer-wrapper   margin-top-60 sec-head1 onscrol" id="description">
    <h2 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m22.25 0h-20.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h20.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m22.25 18h-20.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h20.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m.75 11.5h14.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m.75 14.5h14.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75z" fill="currentColor" data-original="#000000" style=""/><circle xmlns="http://www.w3.org/2000/svg" cx="21" cy="12" r="3" fill="currentColor" data-original="#000000" style=""/></g></svg> <?php echo  $this->tag->getTag('description', 'Description') ;?> <?php if($hasedit){ ?> <a href="javascript:void(0)" style="color:red !important;text-decoration:underline;"  onclick="UpdatePropertyDetais(this)" data-href="<?php echo $model->BackendUpdateURl;?>" class="pull-right" ><i class="fa fa-edit"></i></a>
    <a href="#showUpdateEdit"  onclick="showUpdateEdit()" style="margin-right:10px;font-size:13px;color:red !important;text-decoration:underline;"  class="pull-right" >Modify Description</a> 
    <?php } ?> </h2>
	<input type="text" id="asss"  style="position:absolute;left:-999999px;height:1px;visinility:hidden;"/>
	<input type="text" id="asss2"  style="position:absolute;left:-999999px;height:1px;visinility:hidden;"/>
	<style>
	 .a-v-viewmore { display:none; color:var(--secondary-color) !important;margin-top:10px;font-weight:600;}
	 .a-v-vieless { display:none;color:var(--secondary-color)  !important;margin-top:10px;font-weight:600;}
	.conjusted.detail-desc .a-v-viewmore { display:block;}
	.conjusted.detail-desc .a-v-vieless { display:none;}
	.conjusted  .a-v-viewmore { display:none;}
	.conjusted  .a-v-vieless { display:block;}

	</style>
	<div data-qs="text-trimmer"  id="txttrim" class="  propertydescription_texttrim "  >
		<div class="txtcnt1" dir="auto">
		<?php echo nl2br($model->AdDescription2);?>
		</div>
	<div>
	<a href="javascript:void(0)" class="a-v-viewmore arwdon"  onclick="OpenContenContent()"><?php echo $this->tag->getTag('read_more','Read More');?><span class="margin-left-5"></span></a>
	<a href="javascript:void(0)" class="a-v-vieless arwdon arwdonup"   onclick="CloseContenContent()" ><?php echo $this->tag->getTag('read_less','Read Less');?> <span class="margin-left-5"></span></a>
	</div>
	</div></div>
	
 
	
	<script>
		
	$(function(){ checkscriptHeight() } )
	
	</script>
<?php
	if($hasedit){
	$this->renderPartial('_update_content');
	}
	?>
		  <?php  if($b_1){ echo ' <div class="ad_section"><div class="margin-top-60 margin-bottom-0" >'. $b_1.'<div class="clearfix"></div></div></div>';; } ?>
                    

<div class="clearfix"></div>
<?php
	if(!empty($model->video)){
	$this->renderPartial('_youtube_video'); 
	}			 	 
	if(Yii::app()->options->get('system.common.enable_featured','0') == '11' and Yii::app()->user->getId() and $model->user_id== Yii::app()->user->getId()){
	   	?>
	 
		<div class="video_container_ad">
		<div class="video_container_image">
		
		<img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/multimedia.png');?>">
		</div>
		<div class="video_container_button"><span>Give more description via Youtube video</span>
				<div class="clearfix"></div>
			<a href="javascript:void(0)"  onclick="processvideo(this)"  data-href="<?php echo Yii::app()->createUrl('member/add_video',array('id'=>$model->id));?>" >Add Youtube Link</a>
			
		</div>
		 <div class="clearfix"></div>
		</div>
		 <div class="clearfix"></div>
	
	<?php } ?> 
 
<?php
  $amentites = $model->all_amentitie();
 
if(!empty( $amentites)){ 
    ?>  
	<style>.openimagediv2 {display:none; }
	  .openimagediv2 {height:100vh !important;overflow-y:scroll; width:100%;position:fixed;z-index:99999;left:0;right:0;top:0;bottom:0;background:#fff; }
	  .openamenity  .openimagediv2 { display:block; }
	  .amn-cntai .orange-item { display:none!important; }
	   .openimagediv2 .amenities_listitem.listiu { display:none; }
	  .amn-cntai {  margin-top: 80px;max-width: 1100px;margin-left: auto; }
	  .popupdisplay { display:none; }.openimagediv2 .popupdisplay { display:block; }
	  .sml-titl { width:100% ;display:block; }.popupdisplay { width:100% ;}
	 </style>          
	<script>
	function openAmentiesPopup(){
		$('body').addClass('openamenity');
		$('#header-amenities').html($('#main-header-top').html());
		$('#amn-cntai').html($('#nnea').html());
	}
	</script>
   
<div class="propertypage_factsamenities margin-top-60 sec-head1  ">
      <div class="amenities  margin-top-0">
      <div class="amenities_container col-sm-12 no-padding">
         <h2 class="facts_heading hide"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><g><path d="m497 512h-301c-8.291 0-15-6.709-15-15v-301c0-8.291 6.709-15 15-15h301c8.291 0 15 6.709 15 15v301c0 8.291-6.709 15-15 15z" fill="currentColor" data-original="#000000" style=""/></g><path d="m151 196c0-24.814 20.186-45 45-45h135v-136c0-8.291-6.709-15-15-15h-301c-8.291 0-15 6.709-15 15v301c0 8.291 6.709 15 15 15h136z" fill="currentColor" data-original="#000000" style=""/></g></g></svg> <?php echo  $this->tag->getTag('amenities','Amenities') ;?></h2>
         <div class="amenities_list nnea margin-top-0" id="nnea">
			 <?php
		 
                    echo '<div class="clearfix"></div><h2 class="facts_heading margin-top-20" style="width:100%"><span class="am_svg" id="am_svg_99" ></span> '.$this->tag->getTag('amenities','Amenities').'</h2>';
                    foreach($amentites as $k=>$v){
                    if($v->inp_val=='8'){ $v->inp_val ='8+';};
                    $mn = ': '.$v->inp_val; 
                    $vals = !empty($v->inp_val) ?  $mn : ''; 
                    echo '<div class="amenities_listitem listiu " style="border-bottom:0px;"><i class="amen_dis  amenities_icon amen_'.$v->primaryKey.'"></i><div class="amenities_content amenc_'.$v->primaryKey.'">'.$v->amenities_name.$vals.'</div></div>' ;
                    }
                 
              
             
            
            ?> 
         </div>
      </div>
   </div>
</div>


	 <div class="openimagediv2">
  <div class="container">
	  
	 <div id="header-amenities" style="position:fixed;top:0px;/* width:100%; */left: 0px;right: 0px;width: 90%;margin: auto;padding:0px;;z-index:11;background:#fff;"> </div>
	
 <div class="clearfix"></div>
	<div class="amn-cntai"><div class="amenities_list nnea"  id="amn-cntai"></div></div>
  
  </div>
  
  </div>


<?php } ?> 
 
<div class="clearfix"></div>
	<?php
 
	if(!empty($floor)){
	?> 
		<div id="m_floor_plan" class="padding-top-40"></div>
<div class="margin-top-0" id="to_florr" style="position: relative;">
	 
 <h2 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 330.004 330.004" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <path xmlns="http://www.w3.org/2000/svg" d="M315.002,0h-300c-8.284,0-15,6.716-15,15v300.004c0,8.284,6.716,15,15,15h170c8.284,0,15-6.716,15-15 c0-8.284-6.716-15-15-15h-155v-130h70V225c0,8.284,6.716,15,15,15s15-6.716,15-15V85c0-8.284-6.716-15-15-15s-15,6.716-15,15v55.004 h-70V30h150v75.004c0,8.284,6.716,15,15,15h70c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-55V30h90v180.004h-105 c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h105v60h-25c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h40 c8.284,0,15-6.716,15-15V15C330.002,6.716,323.286,0,315.002,0z" fill="currentColor" data-original="#000000" style=""/> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg> <?php echo  $this->tag->getTag('floor_plan','Floor Plan') ;?> <span style="font-weight: 400 !important;display: inline;font-size: 18px;margin-left: 15px;" id="show_3d" class="hide"><?php echo $this->tag->gettag('show_3d','Show 3D');?> <label class="switch">  <input type="checkbox" onchange = "Setthisinput(this)" >  <span class="slider round"></span></label></span></h2>
   
	  <?php    $this->renderPartial('_floor_plan');?>
   </div>
	<?php }
	else if(in_array($model->section_id,array('1','2'))){
	?>
	<div class="hide">
 	<div id="m_floor_plan" class="padding-top-40"></div>
<div class="margin-top-0" id="to_florr" style="position: relative;">
	 
 <h2 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 330.004 330.004" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <path xmlns="http://www.w3.org/2000/svg" d="M315.002,0h-300c-8.284,0-15,6.716-15,15v300.004c0,8.284,6.716,15,15,15h170c8.284,0,15-6.716,15-15 c0-8.284-6.716-15-15-15h-155v-130h70V225c0,8.284,6.716,15,15,15s15-6.716,15-15V85c0-8.284-6.716-15-15-15s-15,6.716-15,15v55.004 h-70V30h150v75.004c0,8.284,6.716,15,15,15h70c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-55V30h90v180.004h-105 c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h105v60h-25c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h40 c8.284,0,15-6.716,15-15V15C330.002,6.716,323.286,0,315.002,0z" fill="currentColor" data-original="#000000" style=""/> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg> <?php echo  $this->tag->getTag('floor_plan','Floor Plan') ;?> <span style="font-weight: 400 !important;display: inline;font-size: 18px;margin-left: 15px;" id="show_3d" class="hide"><?php echo $this->tag->gettag('show_3d','Show 3D');?> <label class="switch">  <input type="checkbox" onchange = "Setthisinput(this)" >  <span class="slider round"></span></label></span></h2>
   
	<div class="cotact-row">
		<div class="textraa1"><?php echo $this->tag->getTag('contact_the_agent_to_get_the_r', 'Contact the agent to get the relevant floor plan for this listing') ;?></div>
		 <div class="textraa2"><a href="javascript:void(0)" style="width:auto;padding:0px 40px; " onclick="OpenFormClickNewFloorplan(this)" data-reactid="<?php echo $model->id;?>"><?php echo $this->tag->getTag('request_floorplan', 'Request Floorplan') ;?></a></div>
		 </div>
		  </div>
		  </div>
	<?
	
}
?> 
	</div>
	

                        
 
<div class="clearfix"></div>
