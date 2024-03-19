<div class="mainDiv">
 
<div id="headerNewplace" style="display: none;"></div>
<div id="pageContainer" class="container" style="margin-top: 54px;">
<div role="main" class="unitpage_imageGallerySlider" id="imageGallerySlider">
    <section class="slider">
        <div class="loadingFlexslider1"> </div>
                 <div class="flexslider" style="display:none">
                <ul class="slides">
					<?php
					if($model->adImagesOnView)
					{
						
						foreach($model->adImagesOnView as $k=>$v){echo $v->image_name;
								$image =  $model->renderImageNew(@$v->image_name);
								 
						?>
						<li class="img-unit-li"  > <img src="<?php echo  Yii::app()->apps->getBaseUrl('timthumb.php');?>?src=<?php   echo  $image   ;?>&h=499&w=965&zc=1"   class="img-vert-align" ></li>
						<?php
						}
                     }
                    ?>
                  
                </ul>
        </div>
    </section>
</div>
 
<div id="map_canvas" class="unitpage_map-canvas"></div>
 
<div class="bluestrip-unitpage">
                <div class="back-search"><a href="<?php echo Yii::app()->createUrl('searchlist/index');?>">Back to search results</a></div>
                <div class="right-tab-div">
                    <div id="PhotoGalleryClick" class="cam-div photo-active">
                        <ul>
                            <li><a href="javascript:void(0);" onclick="return showGallery();">Photo Gallery</a></li>
                        </ul>
                    </div>
                    <div class="unitdetail-map" id="MapClick">
                        <ul>
                            <li><a href="javascript:void(0);" onclick="return showMap();">Map</a></li>
                        </ul>
                    </div><div style="display:none;" class="View360-tab" id="View360Click">
                        <ul>
                            <li><a>360° View</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
           <div class="agent-unit-pro-details-div">
    <div class="left-div-cntrol-unit">
        <div class="pro-price-unit1" style="font-size: 16px;">
            <h1><?php echo $model->ad_title;?>   , <ref><?php echo @$model->systemRefNo;?></ref>  - <?php echo @$model->locationString;?></h1>
        </div>
        <div class="pro-price-unit2"><?php echo @$model->detailsPriceHtml;?> </div>
        <div class="broom-ref-control-div-unit">
            <div class="bed-aprtmnt-unit"><?php echo @$model->category->category_name;?></div>
			<?php
			if(!empty($model->sub_category_id)){
			?>
			<div class="bed-aprtmnt-unit"><?php echo @$model->subCategory->sub_category_name;?></div>
			<?}
			?>
		
            <div class="loc-size-refno-unit"> Location <span><?php echo @$model->locationString;?></span></div>
           
			 	<?php if(!empty( $model->community_id)){
				 ?>
            <div class="loc-size-refno-unit"> Community <span><?php echo @$model->community->community_name;?></span></div>
              <?
			 }
			 ?>
             <?php if(!empty( $model->sub_community_id)){
				 ?>
				 <div class="loc-size-refno-unit"> Sub Community <span><?php echo @$model->subcommunity->sub_community_name;?></span></div>
				 <?
			 }
			 ?>
            <?php
            if(!empty($model->builtup_area_sqft)){
				?>
            <div id="measurementDiv" class="loc-size-refno-unit"> Approx size <span> <?php echo @$model->BuiltUpArea;?>  </span>
            </div>
            <?php } ?>
            <div class="loc-size-refno-unit"> Reference No<span> <?php echo @$model->systemRefNo;?></span>
            </div>
            <?php echo $model->readyString2;?>
            <div class="readynow-div2"></div>
        </div>
    </div>
    <?php 
    $this->renderPartial('pop',compact('model'));?>
    <div class="Agent_div2 Agent_div22">
   
        <div class="agent_name-2">Property Listed by </div>
        <div class="agent_name-3"><a href="#"><?php echo @$model->Customer->fullName;?></a> </div>
        
        <div class="make-offer-btn"><a href="javascript:void(0)" onclick="return ShowEnquiryPopup()" >Send Enquiry</a> </div>   
         </div>
        
        <script>
        function ShowEnquiryPopup(){
			
			$('#enquiry-form-black-background,#send-enquiry-form-wrapper').slideDown();
			$('#send-enquiry-left-block,#send-enquiry-right-block').show();
											$('#send-enquiry-success-outer').hide();
			//$('#enquiry-form-black-background').slideDown();
		}
        function hidePopup(){
			$('#enquiry-form-black-background,#send-enquiry-form-wrapper').slideUp();
			//$('#enquiry-form-black-background').slideDown();
		}
        </script>
        <div class="unit_lower">
     <?php
                                if(!empty($model->localBedString)){
									?>

        <div class="div-hr4-unit"></div>
        <div class="rating-email-control-div-unit">
           
										<div class="bed_bath_park-2"><?php echo $model->localBedString;?></div>
									
            <div class="icons-cntrol-div-unit2">
                 
        </div>
    </div>
    <?php 
								}
                                ?>
    <div class="div-hr1-unit"></div>
    <div class="overview-control-div"><span class="ovr-vw-txt">Unit Overview</span>
        <div class="stagc-loc-txt"><span class="stagc-loc-txt-span1"><?php echo $model->PrimaryUnitView ;?></span>
        <span class="stagc-loc-txt-span2"><?php echo nl2br($model->ad_description);?></span>
        </div>
    </div>
    <div class="div-hr2-unit"></div>
    <div class="faci-txt-control-div">
        <div class="faci-txt"><span class="faci-txt-span1">Facilities and Amenities</span>
        <span class="faci-txt-span2">
			<?php 
			if($model->adAmenities){
				foreach($model->adAmenities as $k=>$v){
				 echo  $v->amenities->amenities_name.'<br />';
					 
			  }
			}
			?>
			</span>
        </div>
        <div class="fit-txt"><span class="nearest-school-img">Nearest school</span><span class="nearest-school-txt"> <?php echo nl2br($model->nearest_railway);?></span>  </div>
        <div class="nearest-main-div">
            <div class="nearest-metro-div"><span class="nearest-metro-img">Nearest metro stations</span><span class="nearest-metro-txt"> <?php echo nl2br($model->nearest_metro);?></span> </div>
            <div class="nearest-metro-div">
            </div>
        </div>
    </div>
    <div class="div-hr3-unit"></div>
    <div class="share-control-div">  <?php   $this->widget('frontend.components.web.widgets.SocialShareButton.SocialShareButton');?> 
    </div>
</div>
</div>
</div>
</div>
<?php 
$lat = $model->location_latitude;
$long = $model->location_longitude;
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>   
<script type="text/javascript">
function showMap(){
	$('#MapClick').addClass('map-div-active');
	$('#PhotoGalleryClick').removeClass('photo-active');
	$('#imageGallerySlider').hide();
	$('#map_canvas').show();
initMap(<?php echo $lat; ?>,<?php echo $long; ?>);
var latlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
placeMarker(latlng);
}
function showGallery(){
	
	$('#PhotoGalleryClick').addClass('photo-active');
	$('#MapClick').removeClass('map-div-active');
	$('#map_canvas').hide();
	$('#imageGallerySlider').show();
 
}
</script>
