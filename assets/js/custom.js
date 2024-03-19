var map;
var geocoder;
var markersArray = [];
function initMaps(lati,longi)
{
	var latlng = new google.maps.LatLng(lati,longi);
	var myOptions = {
        zoom: 17,
        center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControl: true,
		zoomControlOptions: {
		style: google.maps.ZoomControlStyle.LARGE,
		position: google.maps.ControlPosition.RIGHT_CENTER
		},

    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    geocoder = new google.maps.Geocoder();
    google.maps.event.addListener(map, "click", function(event)
    {
	 
        placeMarker(event.latLng);
        sun(event.latLng.lat(),event.latLng.lng())
		window.changelocation=false;
    });
}
function initMap(lati,longi)
{
	var input = document.getElementById('locate-add');
	var options = {  componentRestrictions: {country: 'ae' } 	};
 	var autocomplete  = new google.maps.places.Autocomplete(input, options);
	google.maps.event.addListener(autocomplete, 'place_changed', function() {  
		var place = autocomplete.getPlace();
		var lat = place.geometry.location.lat();
		var lng = place.geometry.location.lng();
		initMaps(lat,lng); 
		var latlng = new google.maps.LatLng(lat,lng);
		placeMarker(latlng);
		$("#PlaceAnAd_location_latitude").val(lat);
		$("#PlaceAnAd_location_longitude").val(lng);
		$(".btn").attr("disabled",false); 
	});
    var latlng = new google.maps.LatLng(lati, longi);
    var myOptions = {
        zoom: 17,
        center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControl: true,
		zoomControlOptions: {
		style: google.maps.ZoomControlStyle.LARGE,
		position: google.maps.ControlPosition.RIGHT_CENTER
		},

    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    geocoder = new google.maps.Geocoder();
    // add a click event handler to the map object
    google.maps.event.addListener(map, "click", function(event)
    {
		 
        // place a marker
        placeMarker(event.latLng);
        sun(event.latLng.lat(),event.latLng.lng())

        // display the lat/lng in your form's lat/lng fields
        //      document.getElementById("latFld").value = event.latLng.lat();
        //      document.getElementById("lngFld").value = event.latLng.lng();
      //  document.getElementById("locationLatLong").value = event.latLng.lat()+', '+event.latLng.lng();
       // $('form.form_step_3 .next').removeClass('disabled').removeAttr('disabled');
		window.changelocation=false;
    });
}
function initMap2(lati,longi)
{
    var latlng = new google.maps.LatLng(lati, longi);
    var myOptions = {
        zoom: 17,
        center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControl: true,
		zoomControlOptions: {
		style: google.maps.ZoomControlStyle.LARGE,
		position: google.maps.ControlPosition.RIGHT_CENTER
		},

    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    geocoder = new google.maps.Geocoder();
    // add a click event handler to the map object
  
}
function geocode(address) {
    //var address = document.getElementById("address").value;
    geocoder.geocode({
        'address': address,
        'partialmatch': true
    }, geocodeResult);
}
function placeMarker(location) {
    // first remove all markers if there are any
    deleteOverlays();
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });

    // add marker in markers array
    markersArray.push(marker);

//map.setCenter(location);
}

function deleteOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(null);
        }
        markersArray.length = 0;
    }
}
 
