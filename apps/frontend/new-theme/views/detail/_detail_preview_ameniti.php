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
				 	
				
	<div style="position:relative" class="detail_page_gn d-none-sp" >
		<div   style="height:300px;width:100%; background-position:center;background-image:url('https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $model->location_latitude;?>,<?php echo  $model->location_longitude;?>&zoom=10&size=440x440&scale=16&key=<?php echo $this->options->get('system.common.google_map_api_key','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ');?>');"   id="map_canvas3" class="">
		
		<span style="position:absolute;left:0px;right:0px;top:0px;bottom:0px;width: 100px;height: 100px;background: rgba(0,0,0,0.5);background-position:center;background-image:url('<?php echo $this->app->apps->getBaseUrl('assets/img/pin.png');?>');background-repeat:no-repeat;cursor:pointer;margin: auto;text-align: center;border-radius: 50%;" ></span>
		</div>
	 
	</div>  

<div class="propertypage_factsamenities n-gen-c2  margin-top-30">
   <div class="facts">
      <div class="facts_container">
         <h3 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m1.75 15h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m1.75 24h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m22.25 8h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m22.25 17h-7.5c-.965 0-1.75.785-1.75 1.75v3.5c0 .965.785 1.75 1.75 1.75h7.5c.965 0 1.75-.785 1.75-1.75v-3.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m22.25 0h-12.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h12.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><circle xmlns="http://www.w3.org/2000/svg" cx="3" cy="3" r="3" fill="currentColor" data-original="#000000" style=""/></g></svg> <?php echo  $this->tag->getTag('facts','Facts') ;?>  </h3>
         <div class="facts_list">
            <div class="facts_listitem m-n-displ-h price lefticons" style="border-bottom:0px;">
               <div class="facts_label   " style="width:100%"> <?php echo $model->PriceTitleSpanL;?><?php if($model->section_id=='2'){ ?>/<span class="dura"><?php echo $model->getRentPaidL(1); ?> </span> <?php } ?>
           </div>
               <div class="facts_content">
                  </div>
            </div>
			<?php
			$listing_type = 'lst'.$model->listing_type;; 
			$category_ids  = 'cat'.$model->category_id; 
			$sect_ids  = 'sect'.$model->section_id; 
			if(defined('LANGUAGE') and LANGUAGE=='ar'){
			    
			    if(isset($array['builtup_area'])){ $array['builtup_area'] = Yii::t('app',$array['builtup_area'],array('Sq. M.'=>'متر مربع')); }
			    if(isset($array['interior_size'])){ $array['interior_size'] = Yii::t('app',$array['interior_size'],array('Sq. M.'=>'متر مربع')); }
			}
			foreach($array as $k=>$fld){
			if(!empty( $fld)) { 
			?>
			<div class="facts_listitem <?php echo $k.' '.$listing_type.' '.$category_ids.' '.$sect_ids;?> <?php echo in_array($k,array('bedrooms','bathrooms','builtup_area','listing_type','category_id','section_id','reference','client_ref','interior_size','l_no','plan_no','no_of_u','floor_no','unit_no','c_date','selling_price')) ? 'lefticons': '';?>" style="border-bottom:0px;">
               <div class="facts_label " style="width:100% !important;"><?php echo !in_array($k,array('listing_type','section_id')) ?  $model->getAttributeLabel($k).' <span style="font-weight:500;" dir="auto">'.$fld.'</span>': $fld;?> </div>
                
            </div>
			<?
			}
			}
			?>
           
         </div>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<?php 
if($hasedit and !empty($model->slug_z)){
?>
<a class="btn-block headfont btn-sm-s" href="<?php echo $model->RefereceWebUrl;?>" style="color:red !important;text-decoration:underline;" target="_blank">Reference URL</a>
<?php } ?>
<div class="clearfix"></div>
<div class="text-trimmer-wrapper   margin-top-60 sec-head1">
    <h3 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><path xmlns="http://www.w3.org/2000/svg" d="m22.25 0h-20.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h20.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m22.25 18h-20.5c-.965 0-1.75.785-1.75 1.75v2.5c0 .965.785 1.75 1.75 1.75h20.5c.965 0 1.75-.785 1.75-1.75v-2.5c0-.965-.785-1.75-1.75-1.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m.75 11.5h14.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75z" fill="currentColor" data-original="#000000" style=""/><path xmlns="http://www.w3.org/2000/svg" d="m.75 14.5h14.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75z" fill="currentColor" data-original="#000000" style=""/><circle xmlns="http://www.w3.org/2000/svg" cx="21" cy="12" r="3" fill="currentColor" data-original="#000000" style=""/></g></svg> <?php echo  $this->tag->getTag('description', 'Description') ;?> <?php if($hasedit){ ?> <a href="javascript:void(0)" style="color:red !important;text-decoration:underline;"  onclick="UpdatePropertyDetais(this)" data-href="<?php echo $model->BackendUpdateURl;?>" class="pull-right" ><i class="fa fa-edit"></i></a>
    <a href="#showUpdateEdit"  onclick="showUpdateEdit()" style="margin-right:10px;font-size:13px;color:red !important;text-decoration:underline;"  class="pull-right" >Modify Description</a> 
    <?php } ?> </h3>
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
		<?php echo nl2br($model->AdDescription);?>
		</div>
	<div>
	<a href="javascriipt:void(0)" class="a-v-viewmore arwdon"  onclick="OpenContenContent()"><?php echo $this->tag->getTag('read_more','Read More');?><span class="margin-left-5"></span></a>
	<a href="javascriipt:void(0)" class="a-v-vieless arwdon arwdonup"   onclick="CloseContenContent()" ><?php echo $this->tag->getTag('read_less','Read Less');?> <span class="margin-left-5"></span></a>
	</div>
	</div></div>
	<script>
		
	$(function(){ checkscriptHeight() } )
	
	</script>
 

<div class="clearfix"></div>
 
<?php
  $amentites = $model->all_amentitie_by_id();
if(!empty( $amentites)){ ?>  
	<style>.openimagediv2 {display:none; }
	  .openimagediv2 {height:100vh;overflow-y:scroll; width:100%;position:fixed;z-index:99999;left:0;right:0;top:0;bottom:0;background:#fff; }
	  .openamenity  .openimagediv2 { display:block; }
	  .amn-cntai .orange-item { display:none!important; }
	  .amn-cntai .amenities_listitem.hide { display:flex !important  }
	  .amn-cntai {  margin-top: 140px;max-width: 1100px;margin-left: auto; }
	 </style>          
	<script>
	function openAmentiesPopup(){
		$('body').addClass('openamenity');
		$('#header-amenities').html($('#main-header-top').html());
		$('#amn-cntai').html($('#nnea').html());
	}
	</script>
	<style>
	    .amenities_list.nnea .amenities_listitem { height: 8.8rem; }
	    
	</style>
	         
<div class="propertypage_factsamenities margin-top-60 sec-head1  ">
      <div class="amenities  margin-top-0">
      <div class="amenities_container col-sm-12 no-padding">
         <h3 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g><g xmlns="http://www.w3.org/2000/svg"><g><path d="m497 512h-301c-8.291 0-15-6.709-15-15v-301c0-8.291 6.709-15 15-15h301c8.291 0 15 6.709 15 15v301c0 8.291-6.709 15-15 15z" fill="currentColor" data-original="#000000" style=""/></g><path d="m151 196c0-24.814 20.186-45 45-45h135v-136c0-8.291-6.709-15-15-15h-301c-8.291 0-15 6.709-15 15v301c0 8.291 6.709 15 15 15h136z" fill="currentColor" data-original="#000000" style=""/></g></g></svg> <?php echo  $this->tag->getTag('amenities','Amenities') ;?></h3>
         <div class="amenities_list nnea" id="nnea">
			 <?php
			 foreach($amentites as $k=>$v){
			 
					 ?> 
            <div class="amenities_listitem " style="border-bottom:0px;">
              
               <div class="amenities_content"><?php echo $v->amenities_name;?></div>
            </div>
            <?php } ?> 
         </div>
      </div>
   </div>
</div>


	 <div class="openimagediv2">
  <div class="container">
	  
	 <div id="header-amenities" style="position:fixed;top:0px;/* width:100%; */left: 0px;right: 0px;width: 90%;margin: auto;max-width: 1100px;z-index:11;background:#fff;"> </div>
	
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
	 
 <h3 class="facts_heading"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 330.004 330.004" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <path xmlns="http://www.w3.org/2000/svg" d="M315.002,0h-300c-8.284,0-15,6.716-15,15v300.004c0,8.284,6.716,15,15,15h170c8.284,0,15-6.716,15-15 c0-8.284-6.716-15-15-15h-155v-130h70V225c0,8.284,6.716,15,15,15s15-6.716,15-15V85c0-8.284-6.716-15-15-15s-15,6.716-15,15v55.004 h-70V30h150v75.004c0,8.284,6.716,15,15,15h70c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-55V30h90v180.004h-105 c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h105v60h-25c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h40 c8.284,0,15-6.716,15-15V15C330.002,6.716,323.286,0,315.002,0z" fill="currentColor" data-original="#000000" style=""/> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg> <?php echo  $this->tag->getTag('floor_plan','Floor Plan') ;?> <span style="font-weight: 400 !important;display: inline;font-size: 18px;margin-left: 15px;" id="show_3d" class="hide"><?php echo $this->tag->gettag('show_3d','Show 3D');?> <label class="switch">  <input type="checkbox" onchange = "Setthisinput(this)" >  <span class="slider round"></span></label></span></h3>
   
	  <?php    $this->renderPartial('_floor_plan');?>
   </div>
	<?php } 
	?>
	</div>
	

                        
 
<div class="clearfix"></div>
