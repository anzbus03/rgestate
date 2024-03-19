<style>
    #myTab .nav-item div.label {
    
    display: block;
}
</style>
	<div style="position:relative" class="detail_page_gn"><div style="height:300px;width:100%;"   id="map_canvas3"></div>
	  <?php 
  if($model->section_id=='3'){ ?> 
	 <a class="button mp-near" onclick="$('#myModal-nearbyLocation').modal('show');$('#thisschools').click();   "><?php echo $this->tag->getTag('view_near_by_locations','View Near By Locations');?></a>
	 <?php } ?> 
	</div>    
	<?php 
	$lat = $model->location_latitude;
	$long = $model->location_longitude;
	?>
	<?php if(!empty($lat) and !empty( $long)){ ?> 
<script type="text/javascript">
$(function(){
    
    var lt = '<?php echo $lat; ?>';
    var lg = '<?php echo $long; ?>';
    if ("undefined" == typeof google) {
    var o = document.createElement("script");
    document.getElementById("dynamicScripts").appendChild(o), o.src = mpaurl, o.onload = callbackopenfirstnew(lt,lg), o.onreadystatechange = function() {
        callbackopenfirstnew(lt,lg)
    }
} else initMap224(lt,lg)
}
)

function callbackopenfirstnew(lt,lg) {
    setInterval(function() {
        console.log('test'); 
        "undefined" == typeof google || gloeded || (gloeded = !0, initMap224(lt,lg))
    }, 500)
}
function initMap224(lt,lg){
    initMap2(lt,lg);
    var latlng = new google.maps.LatLng(lt,lg);
    placeMarker(latlng); 
} 
</script>
<?php } ?> 
  <?php 
  if($model->section_id=='3'){
 $this->renderPartial('_nearest_locations');
  }
 ?>
