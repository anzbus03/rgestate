 
						    <div class="row form-group">
                   
									<div class="col-sm-5 text-right">	<?php echo $form->labelEx($model, 'area_location');?></div>
									<div class="col-sm-12">
									 
										<?php echo $form->textField($model, 'area_location', $model->getHtmlOptions('area_location',array( 'class'=>'input-text form-control form_have_placeholder','style'=>'width:405px; max-width:100%;' ))); ?>
										<span class="rui-qvKkT"></span>
										<?php echo $form->error($model, 'area_location');?>
									 
									</div> 
					</div>	
			  
				  <div  class="form-group col-lg-12 hide " style="border:1px solid #002f34;padding:10px !important;margin-bottom:0px">
								<?php
							 
							
					   ?>
					   <style>
					       .blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: #000;    }
    49%{    color: #000; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}

					   </style>
					   <div style="height:150px;width: 100%  "   id="map_canvas"></div>
								<p class="flame-text flame-text--medium" style="line-height: 1.5;margin-top: 15px;font-size: 13px;letter-spacing: 1.2px;font-weight: 300;margin-bottom: 0px;">
               <i class="fa fa-circle-o text-yellow"></i> <b  class="blinking"><span style="color:red">Click and drag the pin to the exact spot.</span></b> Users are more likely to respond to ads that are correctly shown on the map
              </p> 
				 </div>
				 <div class="">
				 <div>
				     	<div class="form-group">
									   <?php echo $form->hiddenField($model, 'location_latitude', $model->getHtmlOptions('location_latitude')); ?>
									   <?php echo $form->hiddenField($model, 'location_longitude', $model->getHtmlOptions('location_longitude')); ?>
									 </div>
				 <?php echo $form->error($model, 'location_latitude');?>
				 </div>
				 <div class="clearfix"></div>
				 </div>
				 <?php /*
                <script>
					 var zoomIndex  = 17;
					 
					 function codeAddressInitial(adress) {
		 
		 
			var address = adress;
			geocoder = new google.maps.Geocoder();		
			if(geocoder )	{ 
			geocoder.geocode( { 'address': address}, function(results, status) {
			 
			if (status == google.maps.GeocoderStatus.OK) {
			
			initMap2(results[0].geometry.location.lat().toFixed(6),results[0].geometry.location.lng().toFixed(6));
			} else {

			}
			});
			}
			}
<?php
			 if ($model->location_latitude!="" and $model->location_longitude!="") {
									  ?>
									  $(function(){
									   initMap2('<?php echo $model->location_latitude; ?>','<?php echo $model->location_longitude; ?>');
										var latlng = new google.maps.LatLng('<?php echo $model->location_latitude; ?>','<?php echo $model->location_longitude; ?>');
										placeMarker(latlng);
										})
									  <?
									 
								}
								else{
							 
										 ?>
										zoomIndex = 17;
										$(function(){
										codeAddressInitial('Lahore,Pakistan');;
									});
										<?
									 
									 
								}  
								?>
							
								$(function(){ 	  initAutocomplete2();})
</script>
 */
 ?>
