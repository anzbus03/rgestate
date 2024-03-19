<style>
#wowslider-container1 .ws_images
{
	 max-width:580px !important;
	 margin-right: 25.3em !important;
}
#wowslider-container1 .ws_thumbs
{
	width: 27.3em !important;
}
#wowslider-container1 .ws_thumbs a
{
	  max-width: 234px!important;
	  width: 91%!important;
}
</style>
<div class="main-content">
  <div class="properties" style="top:0;">
    <div class="container">
      <div class="grid_full_width gird_sidebar">
        <div class="row">
         
         <!-- Main content -->
         <div class="span8">
           <!-- Property detail -->
           
           
           
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('assets/engine1/style.css');?>" />
<script type="text/javascript" src="<?php echo Yii::app()->apps->getBaseUrl('assets/engine1/jquery.js');?>"></script>

           
           <!-- Start WOWSlider.com BODY section -->

<!-- End WOWSlider.com BODY section -->
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
<div class="property_detail">
	<?php
	 
	if($model->adImages)
	{
	?>
	<div id="wowslider-container1">
			<div class="ws_images">
				<ul>
				<?php
				$place_ad =new PlaceAnAd;
				foreach($model->adImages as $k=>$v)
				{
					 
					$image =  $place_ad->renderImage(@$v->xml_image,$model->xml_type,@$v->image_name);

					?>
						<li><img src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  urlencode($image)  ;?>&h=360&w=580&zc=1" alt="noImage" title="<?php echo $v->Title;?>" id="wows1_<?php echo $k;?>"/></li>

					<?
				}
				 
				?>
				</ul>
			</div>
		<div class="ws_thumbs">
		<div>
		<?php
					foreach($model->adImages as $k=>$v)
					{
						$image =  $place_ad->renderImage(@$v->xml_image,$model->xml_type,@$v->image_name);
					
						?>
						   <a href="#wows1_<?php echo $k;?>" title="<?php echo $v->Title;?>"><img src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  urlencode($image)  ;?>&h=178&w=234&&zc=1" alt="" /></a>
		
	
						<?
					}
		?>
		</div>
		</div>
</div>	
	<script type="text/javascript" src="<?php echo Yii::app()->apps->getBaseUrl('assets/engine1/wowslider.js');?>"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->apps->getBaseUrl('assets/engine1/script.js');?>"></script>
	<?php
	
} 
?>
 
            <div class="infotext-detail">
				 
		       <h3 style="display:inline;width:200px;float:right;color:#333333;font-size:16px;font-weight:bold;text-align:right;">Unit Reference: <small><?php echo $model->RefNo;?></small></h3>
              <h3 style="display:inline;float:left;font-weight:bold;width:calc(100% - 220px);"><?php echo $model->ad_title;?> </h3>
             
              <span class="price"><?php echo  $model->currencyAbreviation($model->currency_abr);  ?>  <?php echo  $model->FomatMoney( ( $model->section_id == $model::SALE_ID ) ?  $model->price : $model->Rent )  ;?>  <?php echo  ( $model->section_id == $model::RENT_ID ) ? ' / Yr' : '';  ?></span>
              <div class="row">
				   
                <div class="span250px" >
				 <h3 class="small">Property Detail</h3>
                  <ul class="title-info" >
					<li>Category<span><?php echo @$model->category->category_name;?></span></li>
                    <?php
                    if(!empty($model->subCategory->sub_category_name))
                    {
					?>
                    <li>Subcategory<span><?php echo @$model->subCategory->sub_category_name;?></span></li>
                    <?php
					}
					?>
                    <?php
                    if(!empty($model->ReraStrNo))
                    {
					?>
						<li>Escrow number<span><?php echo $model->ReraStrNo;?></span></li>
                    <?php
					}
					?>
                    <li>Location<span><?php echo @$model->district0->district_name;?></span></li>
                    <li>Property<span><?php echo @$model->property_name;?> </span></li>
                    <li>Community<span><?php echo @$model->community->community_name;?></span></li>
                    <?php
                    if(!empty($model->subcommunity->sub_community_name))
                    {
					?>
						<li>Sub Community <span><?php echo @$model->subcommunity->sub_community_name;?></span></li>
                    <?php
					}
					?>
                    
            
                 
                  </ul>
                </div>
                <div class="span250px">
					<h3 class="small">Unit Detail</h3>
                  <ul class="title-info">
					
					<li>Bedrroms <span> <?php echo $model->bedrooms ;?></span></li>
					<li>Bathrooms <span> <?php echo $model->bathrooms ;?></span> </li>
					<li>Built up area (BUA) <span> <?php echo number_format($model->builtup_area,0,'2',',');?> <?php echo ($model->area_measurement=="")?'Sq.Ft.':$model->area_measurement ;?></span></li>
					<?php
					if(!empty($model->FloorNo))
					{
						?>
						<li>FloorNo<span><?php echo $model->FloorNo ;?></span></li>
						<?php
					}
					?>
                    <li>Parking<span><?php echo $model->parking ;?></span></li>
					<li>Unit view  <span> <?php echo $model->PrimaryUnitView ;?></span></li>
                    
                  </ul>
                </div>
                <div class="span250px">
					<h3 class="small">Sales Details</h3>
                  <ul class="title-info">
					
					<?php
					if($model->section_id==$model::SALE_ID)
					{
						?>
						<li>Selling Price <span><small> <?php echo  $model->currencyAbreviation($model->currency_abr);  ?>   </small><?php echo  $model->FomatMoney(    $model->price   )  ;?> </span></li>
						<?
					}
					if($model->section_id==$model::RENT_ID)
					{
						?>
						<li>Rent Annual <span><small> <?php echo  $model->currencyAbreviation($model->currency_abr);  ?>   </small><?php echo  $model->FomatMoney (  $model->Rent   )  ;?> </span></li>
						<?
					}
					?>
					<li>Transfer fee<span>  </span> </li>
					<li>Agency  fee<span>  </span> </li>
					 
                    
                  </ul>
                </div>
              </div>
              <?php
             if(!empty($model->adAmenities))
					 {
						 ?>
              <div class="excerpt">
				  <h3 class="small">Other Features</h3>
				 <ul class="title-info" style="width:100%;">
					 <?php
					     
					     $counter = 1;
						 foreach($model->adAmenities as $k=>$v)
						 {
							 ?>
							 <li   style="width:250px; float:left;<?php if((int)$counter%3 != 0 ){ echo 'margin-right:20px;'; } ?>"><?php echo $v->amenities->amenities_name;?></li>
							 <?
							 $counter++;
						 }
					
					 ?>
				 </ul>
               </div>
               <?php
		   }
		   ?>
               <div style="clear:both"></div>
              <div class="excerpt">
				  <h3 class="small">Unit Description</h3>
				  <?php echo $model->ad_description;?>
               </div>
                <div style="clear:both"></div>
              <div class="share ">
				   <?php   $this->widget('frontend.components.web.widgets.SocialShareButton.SocialShareButton');?> 
               
              </div>
               <div style="clear:both"></div>
            </div>
          </div>
          <!-- End Property -->
        </div>
        <!-- End Main content -->  
        
        
        <!-- Sidebar left  -->
        <div class="span4">
          <div class="box-siderbar-container">
            <!-- sidebar-box map-box -->
            
              <?php
           
				  if ($model->location_latitude!="" and $model->location_longitude!="") {
					  ?>
					  <div class="sidebar-box map-box">
						<h3>Map & Directions</h3>
					  <?php
					 $lat = $model->location_latitude;
					 $long = $model->location_longitude;	
					 ?>
					  <div style="height:285px;width:260px;"   id="map_canvas"></div> 
					    </div>
					 <?			 
				
				} 
		 ?>
        
            <!-- End sidebar-box map-box -->
            
            <!-- sidebar-box our-box -->
            
            <!-- End sidebar-box our-box -->
            
            
            <!-- sidebar-box product_list_wg -->
            <div class="sidebar-box">
                <?php   $this->widget('frontend.components.web.widgets.relatedproperties.RelatedPropertiesWidget',array('in_array'=>array($model->id),'section_id'=>$model->section_id));?>
            </div>
            <!-- End sidebar-box product_list_wg -->
            
            <!-- sidebar-box searchbox -->
        <?php
        if($model->section_id==$model::SALE_ID)
        {
			$mode="sale";
		}
        elseif($model->section_id==$model::RENT_ID)
        {
			$mode="sale";
		}
		else
		{
			$mode="";
		}
		?>
        <?php   $this->widget('frontend.components.web.widgets.subsearch.SubSearchWidget',array('mode'=>$mode));?>
            <!-- End sidebar-box searchbox -->
            
          </div>
        </div>
        <!-- End Sidebar left  -->
        
      </div>
    </div>
  </div>
</div>
</div>
</div>
<?php
if(!empty($lat) and !empty($long)) 
{
	?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>   
<script type="text/javascript">
var jQuery = $.noConflict();
initMap2(<?php echo $lat; ?>,<?php echo $long; ?>);
var latlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
placeMarker(latlng);
</script>
<?php
}
?>
<!-- Start WOWSlider.com HEAD section -->
 
 
