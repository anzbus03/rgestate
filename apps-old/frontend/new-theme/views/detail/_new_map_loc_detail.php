	<?php $im = 'https://maps.googleapis.com/maps/api/staticmap?center='.$model->location_latitude.','.$model->location_longitude.'&zoom=10&size=440x440&scale=16&key='.$this->options->get('system.common.google_map_api_key','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ'); 
	?>
	<div style="position:relative" class="detail_page_gn" >
		<div onclick="$('#myModal-nearbyLocation').modal('show');$('#thisschools').click();   " style="height:300px;width:100%; background-position:center;background-image:url('<?php echo  $im ;?>');"   id="map_canvas3" class="mpmaper2">
		
		<span style="position:absolute;left:0px;right:0px;top:0px;bottom:0px;width: 100px;height: 100px;background: rgba(0,0,0,0.5);background-position:center;background-image:url('<?php echo $this->app->apps->getBaseUrl('assets/img/pin.png');?>');background-repeat:no-repeat;cursor:pointer;margin: auto;text-align: center;border-radius: 50%;" ></span>
		</div>
	 
	</div>    
	<?php 
	$lat = $model->location_latitude;
	$long = $model->location_longitude;
	?>
	<?php if(!empty($lat) and !empty( $long)){ ?> 
 
<?php } ?> 
  <?php 
  
  $this->renderPartial('//detail/_nearest_locations');
 
 ?>
 
