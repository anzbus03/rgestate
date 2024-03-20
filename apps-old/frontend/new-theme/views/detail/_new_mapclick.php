<div class=" map-lt-finder">
<div class="pull-left lsid1"  >
	<div id="ifrmaer">
	<div class="clo-frmer" onclick="closeMpframe();"><img src="<?php echo $this->app->apps->getBaseUrl('assets/img/cancel.png');?>" style="width:30px;" /></div>
	<div id="map_canvas3" class="iframeMod"></div>
	</div>
<img src="<?php echo $this->app->apps->getBaseUrl('assets/img/mapdd.jpg');?>"  style="width:100%;border-radius: 50%;"/>
<button onclick="openIframemap()" id="mapi-pointer"><?php echo $this->tag->getTag('map','Map');?></button>
</div>
<div class="pull-left" style="width:calc(100% - 100px);">
<ul class="margin-left-35 padding-top-20 " style="font-size: 16px;">
	<li><?php echo $model->city_name;?></li>
	<li><?php echo $model->state_name;?></li>
	</ul>

</div>
<?php  
$lat = empty($model->location_latitude) ? $model->city_location_latitude : $model->location_latitude;
$long = empty($model->location_longitude) ? $model->city_location_longitude : $model->location_longitude;
?>
</div>
<script>
	var map_defined = false;
	var uniqumaplat  = '<?php echo $lat; ?>';
	var uniqumaplng  = '<?php echo $long; ?>';
	if(uniqumaplat=='' && uniqumaplat==''){ $('#mapi-pointer').remove(); }
</script>
