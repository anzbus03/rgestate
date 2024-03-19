    <div class="mapColumn" id="map-load"  >
                <div class="map backgroundControls" id="map">
                    <div id="notificationBanner"></div>
                    <div id="googleMap"></div>
                </div>
            </div>
	<?php 
	$locations = array();
	$avg_latitude ='';
	$avg_longitude ='';
	$count = 0; 
	$latitude = '25.266666';
	$longitude = '55.316666';
	foreach($ads as $k=>$v){
		if($k==0){
			$latitude = $v->location_latitude;
			$longitude =$v->location_longitude;;
		}
	   
		$locations[] = array($v->MapHtml,$v->location_latitude,$v->location_longitude,$k+1);	 
	}
	
	 
	 
	?>
<script type="text/javascript">
	
    var locations =  <?php echo json_encode($locations);?>;
    var my_logitude = '<?php echo $longitude;?>';
    var my_latitude = '<?php echo $latitude;?>';

   var map = new google.maps.Map(document.getElementById('map-load'), {
      zoom: 11,
      center: new google.maps.LatLng(my_latitude,my_logitude),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i, markerData = [];

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });
	  markerData.push(marker);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
          
        }
      })(marker, i));

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
          
        }
      })(marker, i));

      google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
        return function() {
          infowindow.close();
        }
      })(marker, i));


      
    }
	
      $(".xsCol12Landscape").mouseover(function() {
		var i = $(this).index();
		var marker = markerData[i];
	// $('.cardPhoto source').attr('srcset', '#image');
	// $('.cardPhoto img').attr('src', '#image').alt('#address');
	// $('.cardDetails .cardPrice').attr('text', '#price');
	
		var imgsrcset = $(this).find('.cardPhoto source').attr('srcset');
		
		var imgsrc = $(this).find('.cardPhoto img').attr('src');
		
		var imgalt = $(this).find('.cardPhoto img').attr('alt');
		
		var price = $(this).find('.cardDetails .cardPrice').text();
		
		
		var locationHTML = '<div class="cardPhoto backgroundPulse" style="height:80px;width:auto;"><picture><source srcset="' + imgsrcset + '" media="(min-resolution: 192dpi)" /><img class="cardPhoto backgroundPulse " src="' + imgsrc + '" style="height:80px;width:auto;" alt="' + imgalt + ' +" /></picture><div class="tagsListContainer"></div></div><div class="cardDetails man pts pbn phm h6 typeWeightNormal"><div><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate">' + price + '</span></div></div>';		
		
		
		//console.log(i);
		if(marker && locations[i]) {
			infowindow.setContent(locationHTML);
			infowindow.open(map, marker);
		}        
      });
  </script>
 
