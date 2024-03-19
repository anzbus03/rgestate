	<div style="position:relative" class="detail_page_gn"><div style="height:300px;width:100%;"   id="map_canvas3"></div></div>    
	<?php 
	$lat = $model->location_latitude;
	$long = $model->location_longitude;
	?>
	<?php if(!empty($lat) and !empty( $long)){ ?> 
<script type="text/javascript" src="<?php echo  'https://maps.googleapis.com/maps/api/js?libraries=places&key='.$this->options->get('system.common.google_map_api_keys','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ');?>"></script>   
<script type="text/javascript">
$(function(){
initMap2(<?php echo $lat; ?>,<?php echo $long; ?>);
var latlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
placeMarker(latlng);})
</script>
<?php } ?> 
	 <script type="text/javascript">
		 function placeMarker(location) {
    // first remove all markers if there are any
 
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });

    // add marker in markers array
     

//map.setCenter(location);
}

	 function initMap2(lati,longi)
{
    var latlng = new google.maps.LatLng(lati, longi);
    var myOptions = {
        zoom: 12,
        center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControl: true,
		zoomControlOptions: {
		style: google.maps.ZoomControlStyle.LARGE,
		position: google.maps.ControlPosition.RIGHT_CENTER
		},

    };
    map = new google.maps.Map(document.getElementById("map_canvas3"), myOptions);
    geocoder = new google.maps.Geocoder();
    // add a click event handler to the map object
  
}
	</script>
