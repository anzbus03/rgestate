    
	
 
   
  <style>
  .cspmds_add_area,.cspmds_cancel_area	{
    position: absolute;
    z-index: 1;
    background: #fff;
 
    padding: 5px 10px;
    left: 15px;
    border-radius: 4px;cursor:pointer;
}
 .cspmds_cancel_area {
   
    left:0px;background:rgba(52, 168, 83, 0.7);top:0px;border-radius:0px;
    width:100%;
    right: 0px;
}.d-flex1sw{ display:flex;    display: flex;
    color: #fff;}
.mzl-15{ margin-left:15px;}
.cspmds_add_area {
  
  top:15px;
    color: var(--logo-color);
    border: 1px solid var(--logo-color);
}
.responsive-desktop-status-bar.cspmds_add_area{
    right: 0;
    width: auto;
    left: unset;
    background: rgba(0,0,0,0.7);
    color: #fff;
} 
html .gm-style-iw-d .h5.cardPrice {     font-weight: 600 !important;
    font-size: 16px !important;}
  </style>
    <div class="mapColumn"  style="position:relative;width:100%;"   >
        	<div id="post-detal"></div>
	 <div id="draw-btns" class="hide">
            <?php
            if(isset($_GET['p'])){
            ?>
            <div onclick ="removeBoundary() " style="    color: #fff;    background: red;    border: 1px solid red;    font-weight: bold;" class="cspmds_add_area cspmds_btn_left cspm_border_shadow cspm_border_radius" data-map-id="map4376" data-show-carousel="yes" data-ext="" data-drawing-method="freehand"> Remove Boundary </div>
              <div class="responsive-desktop-status-bar cspmds_add_area"><span class="Text-c11n-8-37-0__aiai24-0 srp__sc-1jixkgs-0 yVYRH">Showing <?php echo sizeOf($locations);?> of <?php echo $adsCount;?> results in this area</span></div>
          
            <?php
            }
            else{
            ?>
            <div onclick ="polylineCreate() " style="display:none;" class="cspmds_add_area cspmds_btn_left cspm_border_shadow cspm_border_radius"  style="font-weight:bold;"> Draw Search </div>
            <div class="responsive-desktop-status-bar cspmds_add_area" style="display:none;" ><span class="Text-c11n-8-37-0__aiai24-0 srp__sc-1jixkgs-0 yVYRH">Showing <?php echo sizeOf($locations);?> of <?php echo $adsCount;?> results in this area</span></div>
            <?php } ?>
            <div  class="cspmds_cancel_area cspmds_btn_left hide cspm_border_shadow cspm_border_radius" data-map-id="map4376" data-show-carousel="yes" data-ext="" data-drawing-method="freehand">
            <div class="d-flex1sw sp-appli">
            <div class="draw-search-action-bar-wide-screen-text "> <strong>Draw a shape</strong> around the region(s) you would like to live in</div>
            <button type="button" class="mzl-15" onclick="cancelCreate()">Cancel</button>
            <button type="button" class="mzl-15" onclick="search_byAjaxLocation()">Apply</button>
            </div>
            </div>
	</div>
    <div id="map-load"></div>
    
    </div>
	<?php 

 
 
	?>
	
 
<script>
	 var locations =  <?php echo json_encode($locations);?>;

   var mrar;
    
    var markerData = [];
    var infowindow;
    var n;
      var l = '123';
    var    overlay_default_style  = {
        fillColor: '#34A853',
        fillOpacity: '0.2',
        strokeColor: '#34A853',
        strokeOpacity: '0.9',
        strokePosition: google.maps.StrokePosition['CENTER'],
        strokeWeight: '2'
    };
    var a= $;
    var r  ; 
    var ti;
    var myStyles =[
    {
        featureType: "poi",
        elementType: "labels",
        stylers: [
              { visibility: "off" }
        ]
    }
];
var icon1 ={
      path: google.maps.SymbolPath.CIRCLE,
      scale: 6, //tama単o 0
      fillColor : '#FC384A',
      fillOpacity: 1,strokeWeight: 2,
        strokeColor: '#fff',
       
    };
   var icon2 ={
      path: google.maps.SymbolPath.CIRCLE,
      scale: 6, //tama単o 0
      fillColor : '#052286',
      fillOpacity: 1,strokeWeight: 2,
        strokeColor: '#fff',
       
    };     function easyload2Marker2(k){ 
 
    var e = 'details-page-container'; var t = $(k).attr('data-href'); 
    //window.location.href = t;
    
}
 function initMapView2() {
     
    var e, t, i, o = new google.maps.LatLngBounds;
        n = new google.maps.Map(document.getElementById("map-load"), {
            zoom: zoom,
            minZoom: 5,
            center: {
                lat: my_latitude2,
                lng: my_logitude1
            },
            disableDefaultUI: true ,
            mapTypeControl: !1,
            scaleControl: !0,
            zoomControl: !0,
            fullScreenControl: !1,
            draggable: !0,
            gestureHandling: "greedy", 
            zoomControl: true,clickableIcons: false,styles: myStyles ,
		zoomControlOptions: {
		style: google.maps.ZoomControlStyle.LARGE,
		position: google.maps.ControlPosition.RIGHT_BOTTOM
		},mapTypeControl:true,
	  mapTypeControlOptions: {
        mapTypeIds: ["satellite", "roadmap"],
        position: google.maps.ControlPosition.LEFT_BOTTOM,
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
      },
        });
        
      
       
       /*
     drawingManager =  new google.maps.drawing.DrawingManager({
                map: n,
                drawingControl: !1,
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                polygonOptions: {
					 fillColor: "#ffff00",
      fillOpacity: 1,
      strokeWeight: 5,
      clickable: false,
      editable: true,
      zIndex: 1,
                    clickable: !1,
                    editable: !1,
                    draggable: !1,
                    geodesic: !1,
                    zIndex: 1,
                    polygonID: '4',
                    polygonTag: "DMS"
                }
            }),    google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
				
				var HTML 	= "polygon points:" + "<br>";
        for (var i = 0; i < polygon.getPath().getLength(); i++) {
            HTML += polygon.getPath().getAt(i).toUrlValue(6) + "<br>";
        }
				console.log(HTML);
				var polygonArray = []; 
        polygonArray.push(polygon);
      
    });
    */
     r = n; 
    
       n.addListener('tilesloaded', function () {  $('#map-load').append($('#draw-btns').html()); })
    for (n.addListener("idlex", function() {
            var t = n.getBounds(),
                i = (t.getCenter(), t.getCenter().lat()),
                o = t.getCenter().lng();
            boundsNeLatLng = t.getNorthEast(), boundsSwLatLng = t.getSouthWest(), boundaries = {
                a: boundsSwLatLng.lat(),
                b: boundsSwLatLng.lng(),
                c: boundsNeLatLng.lat(),
                d: boundsNeLatLng.lng()
            };
            var s = t.getNorthEast(),
                a = t.getSouthWest();
            new google.maps.LatLng(s.lat(), a.lng()), new google.maps.LatLng(a.lat(), s.lng()), e ? ($("#a").val(boundsSwLatLng.lat()), $("#b").val(boundsSwLatLng.lng()), $("#c").val(boundsNeLatLng.lat()), $("#d").val(boundsNeLatLng.lng()), $("#lt").val(i), $("#lg").val(o), $("#zoom").val(n.getZoom()), search_byAjax()) : e = 1
        }), infowindow = new google.maps.InfoWindow({
            maxWidth: 200,
            disableAutoPan: !0
        }), 
        
        i = 0; i < locations.length; i++) t = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: n,
                    icon: icon1,
 
    }), markerData.push(t), o.extend(t.position), google.maps.event.addListener(t, "click", function(e, t) {
        return function() {
            var cnts = 'details-page-container';
              var htm = '<a class="cardPhoto backgroundPulse" href="javascript:void(0)" data-href="'+locations[t][5]+'"  onclick=easyload2Marker2(this) style="height:80px;width:100%; background-color:#ddd;background-image:url('+locations[t][6]+') ; background-position:center center;background-size:cover; background-repeat:no-repeat;"> <div class="tagsListContainer"></div></div><div class="cardDetails cardDetailsmm man pts pbn phm h6 typeWeightNormal"><div><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate">' + locations[t][7] + '</span></div><div data-reactid="61"> <ul class="listInline  typeTruncate mvn" data-reactid="62">'+locations[t][8]+'</ul></div><div class="cardDetails man pts pbn phm h6 typeWeightNormal"  ><div ><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate" data-reactid="59" style="width:120px;font-size:12px;">'+locations[t][9]+'</span></div></a>'
            if(width_screen<728){
                $('#post-detal').html(htm);
            }
             else{
             nfowindow.setContent(htm), infowindow.open(n, e)
             easyload2Marker("details-page-container", locations[t][5]), infowindow.setContent(locations[t][0]), infowindow.open(n, e)
             }
        }
    }(t, i)), google.maps.event.addListener(t, "mouseover", function(e, t) {
        return function() {
            var htm = '<div class="cardPhoto backgroundPulse" style="height:80px;width:100%; background-color:#ddd;background-image:url('+locations[t][6]+') ; background-position:center center;background-size:cover; background-repeat:no-repeat;"> <div class="tagsListContainer"></div></div><div class="cardDetails cardDetailsmm man pts pbn phm h6 typeWeightNormal"><div><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate">' + locations[t][7] + '</span></div><div data-reactid="61"> <ul class="listInline typeTruncate mvn prop_detailss" data-reactid="62">'+locations[t][8]+'</ul></div><div class="cardDetails man pts pbn phm h6 typeWeightNormal"  ><div ><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate" data-reactid="59" style="width:120px;font-size:12px;">'+locations[t][9]+'</span></div></div>'
            infowindow.setContent(htm), infowindow.open(n, e)
        }
    }(t, i)), google.maps.event.addListener(t, "mouseout", function() {
        
        
    }), my_bound && n.fitBounds(o);
  
} 
var height_screen;var width_screen;
$(function(){
      width_screen = window.innerWidth
            || (document && document.documentElement && document.documentElement.clientWidth)
            || (document && document.body && document.body.clientWidth);

          height_screen = window.innerHeight
            || (document && document.documentElement && document.documentElement.clientHeight)
            || (document && document.body && document.body.clientHeight);
    
      max_height = height_screen-170;
     
       if(width_screen<728){
     
       $('.mapColumn').css({'height':max_height+'px'}) ;
      $('#mainColumn').css({'height':max_height+'px'}) ;
       }
	initMapView2();
	
	  onhoverShowProp();
	
	
	})
	
	

function onhoverShowProp(){ 
	  $(".lst-prop").mouseover(function() {
 
		var i = $(this).index();
		var marker = markerData[i];
	 
		 
		var imgsrc =  $(this).find('.listing-item').attr('data-image');
		if(imgsrc===undefined){
			var imgsrc = $(this).find('.img-whp').attr('src');
		}
		
		var imgalt = '';
		
		var price =''; $(this).find('.fp_price').text();
		var ad_title = $(this).find('h2.prce').text();
		var li_title = $(this).find('.prop_detailss').html();
		if($(this).hasClass('.prop-status-11')){
		 var li_title = '';  
		}
	var li_title = ''; 		var price =''
		
		var locationHTML = '<div class="cardPhoto backgroundPulse" style="height:80px;width:100%; background-color:#ddd;background-image:url('+imgsrc+') ; background-position:center center;background-size:cover; background-repeat:no-repeat;"> <div class="tagsListContainer"></div></div><div class="cardDetails cardDetailsmm man pts pbn phm h6 typeWeightNormal"><div><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate">' + price + '</span></div><div data-reactid="61"> <ul class="listInline typeTruncate mvn prop_detailss" data-reactid="62">'+li_title+'</ul></div><div class="cardDetails man pts pbn phm h6 typeWeightNormal"  ><div ><span class="cardPrice h5 man pan typeEmphasize noWrap typeTruncate" data-reactid="59" style="width:120px;font-size:12px;">'+ad_title+'</span></div></div>';		
		
		
		//console.log(i);
		if(marker && locations[i]) {
		 
			infowindow.setContent(locationHTML);
			infowindow.open(map, marker);
		}        
      });
}
function checkScrollMpa(){currentPage++,offset=(currentPage-1)*limit,jQuery.ajax(slug+"&offset="+offset+"&limit="+limit+"&is_form=1",{data:{formData:encodeURIComponent($("#frmId").serialize())},asynchronous:!0,evalScripts:!0,method:"get",beforeSend:function(){scroll=!1,loadingDiv.html(loadingHtml)},success:function(e,t,i){loadingDiv.html(""),"1"==e?stopPagination=!1:(loadingDiv.html(loadMoreHtml),e=JSON.parse(e),$("#suggest_friends_last_id").before(e.dataHtml),caroselSingle3(),onhoverShowProp(),lozad().observe(),scroll=!0)}})}
</script>
<style>
#map-load .gm-style {
    top: 0px !important;
    bottom: 0 !important;
    
}.man .h5 {
    font-weight: var(--weight-600);
    font-size: 13px !important;
    line-height: 1;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    display: block;
    width: 100% !important;
}.cardDetails ul {
    display: flex;
    margin-bottom: 5px;
    font-size: 12px !important;
}.cardDetails ul  li{  font-size: 14px !important;
line-height: 1.2 !important;
}.cardDetails.h6 { margin:2px 0px ; }
</style>
<script>
	function setMapOnAll(map) {
  for (let i = 0; i < markerData.length; i++) {
    markerData[i].setMap(map);
  }
}
	function cancelCreate(){
	    /*
		 mrar =  new MarkerClusterer(n, markerData, {
        imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m"
    })
    */
    	  for (let i = 0; i < markerData.length; i++) {
    markerData[i].setVisible(true);
  }
		$('.cspmds_add_area').removeClass('hide');
		$('.cspmds_cancel_area').addClass('hide');
		 n.setOptions({draggable: true}); 
		google.maps.event.clearListeners(r.getDiv(), "mouseover"), r.setOptions({
                draggableCursor: "auto"
            })
          
          //  ti.setMap(null);
	}
function polylineCreate() {
      /*
	mrar.clearMarkers();
	*/
	  for (let i = 0; i < markerData.length; i++) {
    markerData[i].setVisible(false);
  }
 
	$('.body').addClass('drawing-active');
	$('.cspmds_add_area').addClass('hide');
	$('.cspmds_cancel_area').removeClass('hide');
	 n.setOptions({draggable: false}); 
 
    
}
$(function(){
     
    setTimeout(function(){
       // nextEvent() 
        
    }, 3000);
})
function nextEvent(){
        (google.maps.event.addDomListener(r.getDiv(), "mouseover", function() {
                r.setOptions({
                    draggableCursor: "crosshair"
                })
            }),  google.maps.event.addDomListener(r.getDiv(), "mousedown", function() {
                r.setOptions({
                    gestureHandling: "none",
                    clickableIcons: !1
                });
                var t = new google.maps.Polyline({
                    map: r
                });ti = t;
                t.setOptions(a.extend(overlay_default_style, {
                    clickable: !1,
                    editable: !1,
                    draggable: !1,
                    geodesic: !1,
                    zIndex: 1
                }));
                var s = google.maps.event.addListener(r, "mousemove", function(a) {
                    t.getPath().push(a.latLng)
                });
                google.maps.event.addListenerOnce(r, "mouseup", function() {
                    google.maps.event.removeListener(s);
                    var d = t.getPath();
                    if (t.setMap(null), d.getArray().length < 3) return o.removeClass("fadeIn"), void setTimeout(function() {
                        o.addClass("flash"), o.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function() {
                            o.removeClass("flash")
                        })
                    }, 100);
                    var i = t.simplifyLine();
                    if (i.length > 3) {
                        var p = new google.maps.Polygon({
                            map: r,
                            paths: i
                        });
                        p.setOptions(a.extend(overlay_default_style, {
                            clickable: !1,
                            editable: !1,
                            draggable: !1,
                            geodesic: !1,
                            zIndex: 1,
                            polygonID: l,
                            polygonTag: "DMS"
                        }))
                    } else {
						console.log("success");
					}
                    google.maps.event.clearListeners(r.getDiv(), "mousedown"), google.maps.event.clearListeners(r.getDiv(), "mouseover"), r.setOptions({
                        gestureHandling:   "auto"  ,
                        draggableCursor: "auto",
                        clickableIcons: "false" != "true"
                    });
                    var HTML 	= "";  var insideMarker = []; 
        for (var i = 0; i < t.getPath().getLength(); i++) {
            HTML += t.getPath().getAt(i).toUrlValue(6) + "|";
        }
					//$('#p').val(HTML);
					$("#frmId").append('<input type="hidden"  class="polilines" value="'+HTML+'" name="p[]" />')
					//search_byAjax()
                   
                })
            }))
}

<?php
if(isset($_GET['p']))
{		
	    $multiple ='[';
		foreach($_GET['p'] as $p){
		$ar = array();
		$polylies = array_filter(explode('|', $p)) ;
		$polylies[sizeOf($polylies)] = $polylies[0];
		$str1 ='[';
		foreach($polylies as $lines){
			$line = explode(',', $lines);
			 
			$str1 .='{ lat: '.@$line['0'].', lng:  '.@$line['1'].' },';
			//$ar[] = array('lat'=>@$line['0'],'lng'=>@$line['1']);
		}
		$str1 = rtrim($str1,',');
		$str1 .=']';
		$multiple .= $str1.',';
		}
		$multiple .=']';
		//$p_lines_cord = json_encode($ar);
		?>
		var js_code = <?php echo $multiple;?>;
		/*
		 const bermudaTriangle = new google.maps.Polygon({
    paths: js_code,
    
  });
  */ 
$(function(){
    
    
    
	//bermudaTriangle.setOptions( overlay_default_style )
 // bermudaTriangle.setMap(n);})
		<?php
		
	
}
?>
function search_byAjaxLocation() {
    var e = document.getElementById("leftColumn");
    formData = $("#frmId :input").serializeArray();
    var t, i = "",
        o = "",
        n = "",
        s = "?";
    $.each(formData, function(e, t) {
        "sec1" == t.name || "" != t.value && ("sec" == t.name || ("type_of" == t.name ? i += "Property_" + t.value + "/" : "state" == t.name ? o += t.value + "/" : "locality" == t.name ? n += "Locality_" + t.value + "/" : s += "&" + t.name + "=" + t.value))
    }), t = mainListUrl + i + o + n + s, NProgress.start();
    //window.location.href=  t ;
}
function removeBoundary(){
	$('input.polilines').remove();search_byAjaxLocation()
}

 
</script>

