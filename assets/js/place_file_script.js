function removeUpload(k){
	var fileiddelete = $(k).attr('data-id');
	if(fileiddelete != undefined){
		
		
		if($('#li_'+fileiddelete).length != 0 ) {
			$('#li_'+fileiddelete).remove();rowCountCalc();
		   mdropZone.removeFile(file_array[fileiddelete]);
		   
		
	   }
	}
}
function afterSuccessdelete(k){
	var fileiddelete = $(k).attr('data-id');
	if(fileiddelete != undefined){
		if($('#li_'+fileiddelete).length != 0 ) {
			 delete_property_image3(successbucket[fileiddelete]);
		   $('#li_'+fileiddelete).remove();rowCountCalc()
		   mdropZone.removeFile(file_array[fileiddelete]);
		   
	   }
	}
}
function updateImage2(){
	   var inp_field = ''; ;
	   $('.ove').show();
	   var count = $( "ul.sortableList li" ).length;
	   $( "ul.sortableList li" ).each(function(i) {
	   var imgAttr =  $( this ).attr('data-image');
	   if(imgAttr!==undefined){
	   inp_field += ','+imgAttr; 
	   }
	   if (i+1 === count   ) {
	   if(inp_field!=''){
		   $('#'+modelName+'_image').val(inp_field);
			
	   }
	   else{
		$('.ove').hide();
	   }
	   }

	   });
}
function sortable2(){
$(".sortableList").sortable({
   revert: false,
   /*update: function (event, ui) {
	   // Some code to prevent duplicates
   }*/
	 stop         : function(event,ui){   
		
					   clearTimeout(myVar);
					   myVar =	setTimeout(function(){  
								   updateImage2()
								   
							}, 1000);
					   /*
					   $( "ul.sortableList li" ).each(function() {
						  alert( $( this ).attr('data-image') )  ;
					   });
					   */
		   }
});
$(".draggable").draggable({
   connectToSortable: '.sortableList',
   cursor: 'pointer',
   helper: 'clone',
   revert: 'invalid',
  
});
}
function removeThisRow(k,){
var ids = $(k).attr('data-id')
$(k).parent().parent().remove();
if($('#table_'+ids).find('tr').length==2){

   $('#table_'+ids).addClass('hide');
}
}
function resizedataURL(datas, wantedWidth, wantedHeight)
{
   // We create an image to receive the Data URI
   var img = document.createElement('img');

   // When the event "onload" is triggered we can resize the image.
   img.onload = function()
	   {        
		   // We create a canvas and get its context.
		   var canvas = document.createElement('canvas');
		   var ctx = canvas.getContext('2d');

		   // We set the dimensions at the wanted size.
		   canvas.width = wantedWidth;
		   canvas.height = wantedHeight;

		   // We resize the image with the canvas method drawImage();
		   ctx.drawImage(this, 0, 0, wantedWidth, wantedHeight);

		   var dataURI = canvas.toDataURL();

		   /////////////////////////////////////////
		   // Use and treat your Data URI here !! //
		   /////////////////////////////////////////
	   };

   // We put the Data URI in the image's src attribute
   img.src = datas;
   return datas;
}
function setThiscover(k){
   var cls = $(k).closest('._1mplE');
   //$('li#'+cls.attr('id')).remove();
   $('._3IhNg').prepend('<li class="_1mplE prepended"  data-image="'+cls.attr('data-image')+'"><div class="_3BJtT" data-aut-id="listSortable">'+cls.html()+'</li>');
   cls.remove();
   setTimeout(function(){   updateImage2() 	 }, 1000);
}
function delete_property_image2(val,k)
							   {
								   imgs = $("#"+modelName+"_image").val(); 
								   $.post(delete_image_url,{file:val,inp:imgs},function(data){  $("#PlaceAnAd_image").val(data) ;imgs=data; } );
								   $(k).parent().parent().remove();rowCountCalc();		
							   }
function delete_property_image3(val,k)
							   {
								   imgs = $("#"+modelName+"_image").val(); 
								   $.post(delete_image_url,{file:val,inp:imgs},function(data){  $("#PlaceAnAd_image").val(data) ;imgs=data; } );
									
							   }
var mdropZone = new Dropzone("div#file_image", { url: upload_url ,addRemoveLinks: true, maxThumbnailFilesize :40 ,timeout: 300000,  maxFiles:mxFiles,resizeWidth :960,  acceptedFiles: aFiles,
			   
			   init: function() {
					 
				   this.on("thumbnail", function(file, dataUrl) {
							   //    console.log('uploading...'); 
							   //	$('#li_'+rand).find('._20pqz').css({'background-image':'url("'+dataUrl+'")'}) ; 
									  
							
				   }),
				   this.on('sending', function(file, xhr, formData){
					   rand = rand+1;
					   formData.append('rand',rand);
						 
								 // file_id= file.lastModified;
								  file_array[rand] = file;
								  file_id  = rand;
								   
								  var set_text = "Set Cover";
								 $('._3IhNg').append('<li class="_1mplE loading" id="li_'+file_id+'"  ><div class="_3BJtT" data-aut-id="listSortable"><div class="_20pqz"   data-aut-id="image"></div><a class="_1cS9Q" id="liremove_'+file_id+'" data-id="'+file_id+'" onclick="afterSuccessdelete(this)"  ><span class="rui-1XUas rui-3_XwO"></span></a><a id="link_'+file_id+'" data-id="'+file_id+'" onclick="removeUpload(this)"  class="rmlink">Cancel</a></div><a href="javascript:void(0)" class="coverimg" onclick="setThiscover(this)" >'+set_text+'</a></li>')
								   
								   rowCountCalc();
					   
				   }),
				   this.on("success", function(file, serverFileName) {
							
							
							var data = JSON.parse(serverFileName);
							serverFileName = data.img;
							
							   file_id= data.rand;
							   $('#li_'+file_id).removeClass('loading');
								var bgn = "https://www.rgestate.com/uploads/files/"+serverFileName;
								$('#li_'+file_id).find('._20pqz').css({'background-image':'url("'+bgn+'")'}) ; 
							   $('#li_'+file_id).attr('data-image',serverFileName);
									   successbucket[file_id] = serverFileName;
								
							
								var vals  = $("#"+modelName+"_image").val();
							   vals += ","+serverFileName;
							   $("#"+modelName+"_image").val(vals) ;
									
							   //	$("#table_append_boc").append('<div id="property_img_0" class="property_img"><img src="<?php echo ENABLED_AWS_PATH ;?>'+serverFileName+'" style="width:140px;"><div class="property_img_overlay"><span class="isw-delete" style="margin-right: 0px;"></span> <a class="btn btn-danger btn-small" onclick=delete_property_image2("'+serverFileName+'",this) ><span class="isw-delete2" style="margin-right: 0px;"></span></a></div></div>')
		
			
				
				
				   }),
				   this.on("error", function(file,errorMessage) {
									 mdropZone.removeFile(file);  
				   errorAlert('Error',errorMessage);
					 

				   })
				
			   }
			   
			   })
 function uploadFile(){
			 $('#file_image').click();
		 }
		 
		  function rowCountCalc(){
			  var uploaded_length = $('._3IhNg li._1mplE').length;
			  var pseude_length = $('._1SuBk').length;
			  var total_can_upload = parseInt(mxFiles);
			  var total_showing = parseInt(uploaded_length) + parseInt(pseude_length);
			  if(total_showing > total_can_upload){
				 
				  
				needtohide =   total_showing-total_can_upload;
				hidefromcount = total_can_upload-needtohide;
				 
				 
				 
				var counter= 1; total_can_upload;
				var loper =$('.q_7hS').find('._1SuBk');
				loper.each(function(k,v){
							if(counter > hidefromcount){
								$(this).addClass('hidden');
								console.log('hidden:'); 
							}else{
								 $(this).removeClass('hidden');
								  console.log('not hidden:'); 
							}
						   counter++;
					})
			  }
		  } 
function initMap2(lati,longi)
{


var latlng = new google.maps.LatLng(lati, longi);
var myOptions = {
   zoom: zoomIndex,
   center: latlng,
   mapTypeId: google.maps.MapTypeId.ROADMAP,
   zoomControl: true,
   zoomControlOptions: {
   style: google.maps.ZoomControlStyle.LARGE,
   position: google.maps.ControlPosition.LEFT_TOP
   },

};
map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
geocoder = new google.maps.Geocoder();
// add a click event handler to the map object
google.maps.event.addListener(map, "click", function(event)
{
	
   // place a marker
   placeMarker(event.latLng);
   GetAddress3(event.latLng.lat(),event.latLng.lng())
   sun(event.latLng.lat(),event.latLng.lng())

   // display the lat/lng in your form's lat/lng fields
   //      document.getElementById("latFld").value = event.latLng.lat();
   //      document.getElementById("lngFld").value = event.latLng.lng();
 //  document.getElementById("locationLatLong").value = event.latLng.lat()+', '+event.latLng.lng();
  // $('form.form_step_3 .next').removeClass('disabled').removeAttr('disabled');
   window.changelocation=false;
});
}

function GetAddress3(lat,lng) {
	   var lat = lat;
	   var lng = lng;
	   var latlng = new google.maps.LatLng(lat, lng);
	   var geocoder = geocoder = new google.maps.Geocoder();
	   geocoder.geocode({ 'latLng': latlng }, function (responses, status) {
		   if (status == google.maps.GeocoderStatus.OK) {
			   //console.log(responses[0].formatted_address);
			   res = responses[0].address_components[0].short_name.concat(' ').concat(responses[0].address_components[1].short_name) 

CountryCode = '';var res1 = '';
for (var i = 0; i < responses[0].address_components.length; i++) {
	
   if (responses[0].address_components[i].types[0] == "country") {
	   CountryCode =responses[0].address_components[i].short_name ;
	   
   }
	
}
if(String(CountryCode) != String(country_id)){
		   $('#'+modelName+'_location_latitude').val('');
		   $('#'+modelName+'_location_longitude').val('');
		   deleteOverlays()
		   alert('Please select a location from '+country_id);return false; 
	   }

		   }
	   });
   }
   var autocomplete2; 
	   function initAutocomplete2() {
				
			
var input = document.getElementById(modelName+'_area_location');
var options = {
   // types: ['address,(regions)'], 
componentRestrictions: {country: country_id },

};

 var autocomplete2  = new google.maps.places.Autocomplete(input, options);
//autocomplete.setFields(['address_component', 'geometry']);

autocomplete2.addListener('place_changed', function(){
	 var place =   autocomplete2.getPlace(); 
	 var lat = place.geometry.location.lat();
   var lng = place.geometry.location.lng();
   initMap(lat,lng); 		
   var latlng = new google.maps.LatLng(lat,lng);
   
   $('#'+modelName+'_area_location').val(place.name);
   $('#'+modelName+'_location_latitude').val(lat);
   $('#'+modelName+'_location_longitude').val(lng);
   placeMarker(latlng);
   GetAddress2(lat,lng,1);
	 
	  });
}
function GetAddress2(lat,lng) {
	   var lat = lat;
	   var lng = lng;
	   var latlng = new google.maps.LatLng(lat, lng);
	   var geocoder = geocoder = new google.maps.Geocoder();
	   geocoder.geocode({ 'latLng': latlng }, function (responses, status) {
		   if (status == google.maps.GeocoderStatus.OK) {
			   //console.log(responses[0].formatted_address);
			   res = responses[0].address_components[0].short_name.concat(' ').concat(responses[0].address_components[1].short_name) 

CountryCode = '';var res1 = '';
for (var i = 0; i < responses[0].address_components.length; i++) {

   if (responses[0].address_components[i].types[0] == "country") {
	   CountryCode =responses[0].address_components[i].short_name ;
	   
   }
   
   
}


	
if(String(CountryCode) != String(country_id)){
		   $('#'+modelName+'_location_latitude').val('');
		   $('#'+modelName+'_location_longitude').val('');
   deleteOverlays()
		   alert('Please select a location froms '+country_id);return false; 
	   }
	   
	   
	   
	   

		   }
	   });
   }

function fillInAddress3() {

// Get the place details from the autocomplete object.
   var place = autocomplete2.getPlace();
	alert(place)
	console.log(place);
	
		 var lat = place.geometry.location.lat();
   var lng = place.geometry.location.lng();
   initMap(lat,lng); 		
   var latlng = new google.maps.LatLng(lat,lng);
   
   $('#'+modelName+'_area_location').val(place.name);
   $('#'+modelName+'_location_latitude').val(lat);
   $('#'+modelName+'_location_longitude').val(lng);
   placeMarker(latlng);
   GetAddress2(lat,lng,1)
	 

  
	
}
