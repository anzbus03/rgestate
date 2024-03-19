$(function(){
	//	initAutocomplete()
		selectText()
		})
		
	 	 function setthishtml(k){
		 var type_html = $(k).html();
		 $('#'+modelName+'_ad_title').val(type_html)
	 }
	function changeMap(){
	   
			 var location_text ='';
			 if($('#'+modelName+'_state').val() != ''){
			   
			   location_text +=  $('#'+modelName+'_state option:selected').text();
			    var suggestHtml = '';
					$('.suggest-city').remove();
					 suggestHtml += '<li class="suggest suggest-city"><a href="javascript:void(0)" onclick="setthishtml(this)" class="pull-left margin-left-2">'+listy+' '+p_typy+' '+in_text+' '+location_text+'</a></li>';
					 suggestHtml += '<li class="suggest suggest-city"><a href="javascript:void(0)" onclick="setthishtml(this)" class="pull-left margin-left-2">'+' '+p_typy+' '+section_title2+' '+in_text+' '+location_text+'</a></li>';
					  $('#option-suggest').append(suggestHtml);  
			 }
			 if($('#'+modelName+'_city').val() != ''){
			   location_text +=   ',';
			   location_text +=  $('#'+modelName+'_city option:selected').text();
			 }
			  if(location_text !=''){
			  codeAddressInitial(location_text);
			 }
	}
	
	function changeMap2(k){
	 
			 if(location_text_details !=''){
			      
			        codeAddressInitial(location_text_details);
			      
			 }
	}
	
	
//	$(function(){ $('.select2').select2();   }) 
	function load_via_ajax(k,id){
	var url_load = $(k).attr('data-url') 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
	 
		 $('#'+modelName+'_'+id).val('');
		 $('#'+modelName+'_'+id).html('<option value="">Loading...</option>').select2();
		 var attr_id = $(k).attr('id');
		 var st_id = modelName+'_state'; 
		 if(attr_id== st_id){
			changeMap()
		 }
		 $('.loader_p').addClass('open')
		 $.get(url_load,function(data){ $('.loader_p').removeClass('open'); var data = JSON.parse(data) ;   $('#'+modelName+'_'+id).html(data.data).select2(); if(data.size != '0') {    $('#'+modelName+'_'+id).closest('.form-group').removeClass('hidden') }else{  $('#'+modelName+'_'+id).closest('.form-group').addClass('hidden') }  })
	}
}
function openSelectedSection(){
	 $('#section_picker').removeClass('open-second');
}
function load_via_ajax_category(k,id){
	var url_load = $(k).attr('data-url') ;
    if($(k).val()=='2'){
			$('.rent_paid').removeClass('hidden');
		}
		else{
			$('.rent_paid').addClass('hidden');
		}
   sectid = $(k).val(); 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
		$('#selected_text').html($(k).parent().find('label').text()); 
	 $('#boxdy').addClass('loading')
		// $('#'+modelName+'_l_type_main_div').addClass('hidden');
		 $('#'+modelName+'_l_type_main_div').addClass('hidden');
		 $('#'+modelName+'_category_id_main_div').addClass('hidden');
	 
		 $.get(url_load,function(data){  $('#boxdy').removeClass('loading'); var data = JSON.parse(data) ;    if(data.size != '0') {  
			  $('#'+modelName+'_l_type_main_div').find('.listli').html(data.data);   $('#'+modelName+'_l_type_main_div').removeClass('hidden');  }else{   $('#'+modelName+'_l_type_main_div').addClass('hidden'); }  })
	}
}
function load_via_ajax_main_category(k,id){
    
    if(sectid=='6'){
        location.href = business_url+'/cat/'+$(k).val(); 
    } 
    
	var url_load = $(k).attr('data-url') ;
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
		
 
		
	 $('#boxdy').addClass('loading')
		 $('#'+modelName+'_category_id_main_div').addClass('hidden');
		 $('#section_picker').addClass('open-second');
	 
		 $.get(url_load,function(data){  $('#boxdy').removeClass('loading'); var data = JSON.parse(data) ;    if(data.size != '0') {  
			  $('#'+modelName+'_category_id_main_div').find('.listli').html(data.data);   $('#'+modelName+'_category_id_main_div').removeClass('hidden');  }else{   $('#'+modelName+'_category_id_main_div').addClass('hidden'); }  })
	}
}
function sun(lat,lan)
{
	 
$("#"+modelName+"_location_latitude").val(lat);
$("#"+modelName+"_location_longitude").val(lan);
 
}
 function codeAddress() { 
			}
			 function codeAddressInitial(adress) {
		 
		 
			var address = adress;
		 
			geocoder = new google.maps.Geocoder();		
			if(geocoder )	{ 
			geocoder.geocode( { 'address': address}, function(results, status) {
			 console.log(status);
			if (status == google.maps.GeocoderStatus.OK) {
		 
			initMapN(results[0].geometry.location.lat().toFixed(6),results[0].geometry.location.lng().toFixed(6));
			} else {

			}
			});
			}
			}
				function initAutocomplete() {
	var input = document.getElementById(modelName+'_mandate');
	var options = { 
	componentRestrictions: {country: 'ae' },
	 
	};

 	  autocomplete  = new google.maps.places.Autocomplete(input, options);
 	//autocomplete.setFields(['address_component', 'geometry']);

	 autocomplete.addListener('place_changed', fillInAddress);
}

function selectText(){
	 $("input:text").focus(function() { $(this).select(); } );
}
function fillInAddress() {
 
  // Get the place details from the autocomplete object.
		var place = autocomplete.getPlace();
		 var country_code = '';
        var country_name = '';
        var city_name    = '';
        var street_name  = '';
        // var postal_code  = '';
        var area         = '';
        // console.log(JSON.stringify(place.address_components));
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            /* country */
            if (addressType == "country") {
                country_code = place.address_components[i].short_name;
                country_name = place.address_components[i].long_name;
                // console.log("country name:"+country_name+", country code:"+country_code);
            }
            /*
            if (addressType == "locality") {
                city_name = place.address_components[i].long_name;   
                console.log("city name:"+city_name); 
            }
            if (addressType == "sublocality_level_1") {
                street_name = place.address_components[i].long_name;   
                console.log("street name:"+street_name); 
            }
            
            */
            /* city */
            
            if (addressType == "locality" && city_name=='') {
                city_name = place.address_components[i].long_name;   
                // console.log("city name:"+city_name); 
            }
            else if (addressType == "administrative_area_level_2" && city_name=='') {
                city_name = place.address_components[i].long_name;   
                // console.log("city name:"+city_name); 
            }
            else if(addressType == "administrative_area_level_1" && city_name=='') {
                city_name = place.address_components[i].long_name;   
                // console.log("city name:"+city_name); 
            }
            /* street */
            if (addressType == "route" && street_name=='') {
                street_name = place.address_components[i].long_name;   
                // console.log("street name:"+street_name); 
            } 
            else if (addressType == "sublocality_level_1" && street_name=='') {
                street_name = place.address_components[i].long_name;   
                // console.log("street name:"+street_name); 
            } 
            else if (addressType == "locality" && street_name=='') {
                street_name = place.address_components[i].long_name;   
                // console.log("street name:"+street_name); 
            }
            /* postal_code */
            /*
            if (addressType == "postal_code") {
                postal_code = place.address_components[i].long_name;   
            }
            */
            /* area */
            if (addressType == "sublocality_level_1") {
                area = place.address_components[i].short_name; 
                console.log(place.address_components[i])  
            }
     
        
 

        }
        if(country_code != 'PK'){
				alert('Please select a location from United Arab emirates');return false; 
			}
			
              // alert(country_code);
      //  alert(country_name);
       // $('#city_name').html(city_name);
        if(street_name == area){
            area = '';
		}
       // $('#street_name').html(street_name);
      //  alert(street_name);
       
   //   $('#PlaceAnAd_location_attribute_country_a2').val(country_code);
    //  $('#PlaceAnAd_location_attribute_state_name').val(city_name);
    //  $('#PlaceAnAd_location_attribute_city_name').val(area);
    $.get(cityUrl,{city:city_name},function(data){ var dat = JSON.parse(data);if(dat.status=='1'){   $('#'+modelName+'_state').val(dat.state_id).change(); } })
      $('#'+modelName+'_area_location').val(street_name);
      		var lat = place.geometry.location.lat();
		var lng = place.geometry.location.lng();
		initMap(lat,lng); 		
		var latlng = new google.maps.LatLng(lat,lng);
	    placeMarker(latlng);
		$('#'+modelName+'_location_latitude').val(lat);
		$('#'+modelName+'_location_longitude').val(lng);
		 
    }
    function openFields1(k){
  
		if($(k).val()=='2'){
			$('.rent_paid').removeClass('hidden');
		}
		else{
			$('.rent_paid').addClass('hidden');
		}
		 $('.w_for').find('input:checked').prop('checked', false);;
	
		if($(k).val()==4){
			$('.w_for').removeClass('hide');
			$('.l_type').addClass('hide');
			$('.c_type').addClass('hidden');
		}
		else{
			 
			 $('.l_type').find('input:checked').prop('checked', false);;
			$('.w_for').addClass('hide');
			$('.l_type').removeClass('hide');
			$('.c_type').addClass('hidden');
		}
		
		 
	 
}
function openFields2(k){
 
		 
		  $('.l_type').find('input:checked').prop('checked', false);;
			$('.l_type').removeClass('hide');
		 
		
		 
	 
}
 var section_title2 = ''; 
	 var listy = ''; 
	 var p_typy = '';
function validateInputSector(){
	 var text_enter = ''; 
	 
	$('.picker_class').each(function(){ 
		var objn = $(this).find('input:checked'); 
		if(objn.val()=='121'){ $('#boxdy').addClass('land-prop'); }else{ $('#boxdy').removeClass('land-prop'); };
		 var name =  objn.attr('name') ;
		 var objectfield = $('#'+modelName+'_'+name) ;
		 if (objectfield.length=='1') {
			 objectfield.val(objn.val())
		
		text_enter +=  '<li><a>'+objn.closest('.inputGroup').find('label').text()+'</a><span class="rui-Yp1c-">/</span>';
		  
		  if ( typeof isnewrecord !== 'undefined' && isnewrecord == 1 ) {
	  if(objn.closest('.sect_select').length =='1' ) { section_title2 = objn.closest('.inputGroup').find('label').text(); } 
	  if(objn.closest('.l_type').length =='1' ) { listy = objn.closest('.inputGroup').find('label').text() ;   } 
	  if(objn.closest('.c_type').length =='1' ) { p_typy = objn.closest('.inputGroup').find('label').text() ;  } 
		  if(listy!='' && section_title2 != '' && p_typy !=''){
			  $('#'+modelName+'_ad_title').val(listy+' '+p_typy+' '+section_title2);
			  if(cName!=""){
					var suggestHtml = '<li id="suggestion-word"   class="pull-left margin-right-5">'+suggestionst+'</li>';
					 suggestHtml += '<li class="suggest"><a href="javascript:void(0)"  onclick="setthishtml(this)" class="pull-left margin-left-2">'+listy+' '+p_typy+' '+section_title2+'</a></li>';
					 suggestHtml += '<li class="suggest"><a href="javascript:void(0)"  onclick="setthishtml(this)" class="pull-left margin-left-2">'+' '+p_typy+' '+section_title2+'</a></li>';
					 suggestHtml += '<li class="suggest"><a href="javascript:void(0)"  onclick="setthishtml(this)" class="pull-left margin-left-2">'+listy+' '+p_typy+' '+section_title2+' '+in_text+' '+cName+'</a></li>';
					 $('#option-suggest').html(suggestHtml);
				}
				checktitleCount(); checkdescpCount(); 
		  }
	  }
		  
		 }
		//alert(text_enter)
		//alert($(this).find('input:checked').val());
		//console.log();
		
		 })
		  $('#boxdy').addClass('loading');
		    
	  fetchHiddenAmenities();
		 setTimeout(function(){ 
			 $('#boxdy').removeClass('loading')
			  $('.sector1').addClass('sector2');
		 $('.place-property').removeClass('sector1');
			 
			  $("html, body").animate({
        scrollTop:0 
    }, 1000);
			 
			   }, 1000);
		
		 $('#textChanger').html(text_enter);
}
function movingtoStep1(){
	 	  $('#boxdy').addClass('loading')
		 setTimeout(function(){ 
			 $('#boxdy').removeClass('loading')
		 $('.place-property').removeClass('sector2');
		 $('.place-property').addClass('sector1');
		 
		   $("html, body").animate({
        scrollTop:0 
    }, 2000);
		   }, 1000);
		 
}
function toggleClassExpand(){
	$('.amn1').toggleClass('expanded');
}
function expandthis(k){
	if($(k).is(':checked')){
	 
	$('.amn1').addClass('expanded');
	}
}
function pickCustomer(){
 
$("#"+modelName+"_user_id").select2({
								placeholder: 'Select User',
								 allowClear: true,
								ajax: {
								url:  customer_url ,
								dataType: 'json',
								delay: 250,
								data: function (params) {
								return {
								q: params.term, // search term
								page: params.page
								};
								},
								processResults: function (data, params) {
								// parse the results into the format expected by Select2
								// since we are using custom formatting functions we do not need to
								// alter the remote JSON data, except to indicate that infinite
								// scrolling can be used
								params.page = params.page || 1;
								return {
								results: data.items,
								pagination: {
								more: (params.page * 30) < data.total_count
								}
								};
								},
								cache: true
								},
								escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
								minimumInputLength: 0,
								//templateResult: formatRepo, // omitted for brevity, see the source of this page
								//templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
								}) ;

}
function initMapN(lati,longi)
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
		$("#"+modelName+"_location_latitude").val(lat);
		$("#"+modelName+"_location_longitude").val(lng);
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
      placeMarker(latlng);
        sun(lati,longi)
}
  function  fetchHiddenAmenities(){
	  var catd = $('#'+modelName+'_category_id').val();
	  if(catd !== undefined){
	  
			$.get(hiddenAmenities,{'id':catd},function(data){
				 var d = JSON.parse(data);
				 $('.amn1').find('.form-check').removeClass('hidden');
				 if(d.status=='1'){
					   if(d.cat_hide.h_bd !== undefined && d.cat_hide.h_bd =='1'){  $('#h_bd').addClass('hide'); $('#PlaceAnAd_bedrooms').val('').change(); }else{ $('#h_bd').removeClass('hide');  }
					   if(d.cat_hide.h_bth !== undefined && d.cat_hide.h_bth =='1'){  $('#h_bth').addClass('hide');$('#PlaceAnAd_bathrooms').val('').change(); }else{ $('#h_bth').removeClass('hide');  }
					   if(d.cat_hide.h_in !== undefined && d.cat_hide.h_in =='1'){  $('#h_in').addClass('hide');$('#PlaceAnAd_interior_size').val('')  }else{ $('#h_in').removeClass('hide');  }
					 	if(d.cat_hide.h_is_mor !== undefined && d.cat_hide.h_is_mor =='1'){  $('#h_is_mor').addClass('hide');$('#PlaceAnAd_is_mor').val('')  }else{ $('#h_is_mor').removeClass('hide');  }
						if(d.cat_hide.h_r_facade !== undefined && d.cat_hide.h_r_facade =='1'){  $('#h_r_facade').addClass('hide');$('#PlaceAnAd_r_facade').val('')  }else{ $('#h_r_facade').removeClass('hide');  }
						if(d.cat_hide.h_rights !== undefined && d.cat_hide.h_rights =='1'){  $('#h_rights').addClass('hide');$('#PlaceAnAd_rights').val('')  }else{ $('#h_rights').removeClass('hide');  }
						if(d.cat_hide.h_may_affect !== undefined && d.cat_hide.h_may_affect =='1'){  $('#h_may_affect').addClass('hide');$('#PlaceAnAd_may_affect').val('')  }else{ $('#h_may_affect').removeClass('hide');  }
						if(d.cat_hide.h_disputes !== undefined && d.cat_hide.h_disputes =='1'){  $('#h_disputes').addClass('hide');$('#PlaceAnAd_disputes').val('')  }else{ $('#h_disputes').removeClass('hide');  }
						if(d.cat_hide.h_expiry_date !== undefined && d.cat_hide.h_expiry_date =='1'){  $('#h_expiry_date').addClass('hide');$('#PlaceAnAd_expiry_date').val('')  }else{ $('#h_expiry_date').removeClass('hide');  }
						if(d.cat_hide.h_l_no !== undefined && d.cat_hide.h_l_no =='1'){  $('#h_l_no').addClass('hide');$('#PlaceAnAd_l_no').val('')  }else{ $('#h_l_no').removeClass('hide');  }
						if(d.cat_hide.h_plan_no !== undefined && d.cat_hide.h_plan_no =='1'){  $('#h_plan_no').addClass('hide');$('#PlaceAnAd_plan_no').val('')  }else{ $('#h_plan_no').removeClass('hide');  }
						if(d.cat_hide.h_no_of_u !== undefined && d.cat_hide.h_no_of_u =='1'){  $('#h_no_of_u').addClass('hide');$('#PlaceAnAd_no_of_u').val('')  }else{ $('#h_no_of_u').removeClass('hide');  }
						if(d.cat_hide.h_floor_no !== undefined && d.cat_hide.h_floor_no =='1'){  $('#h_floor_no').addClass('hide');$('#PlaceAnAd_floor_no').val('')  }else{ $('#h_floor_no').removeClass('hide');  }
						if(d.cat_hide.h_unit_no !== undefined && d.cat_hide.h_unit_no =='1'){  $('#h_unit_no').addClass('hide');$('#PlaceAnAd_unit_no').val('')  }else{ $('#h_unit_no').removeClass('hide');  }
                        if(d.cat_hide.h_p_limits !== undefined && d.cat_hide.h_p_limits =='1'){  $('#h_p_limits').addClass('hide');$('#PlaceAnAd_p_limits').val('')  }else{ $('#h_p_limits').removeClass('hide');  }
					 
					 $.each(d.amenities_list,function(k,v){
						 
						 $('#amnitm_'+v).addClass('hidden');
						 $('#amnitm_'+v).find('input').prop('checked',false);
						  $('#amnitm_'+v).find('select').val('');$('#amnitm_'+v).find('input.cmv').val('');
						  
						 })
						 if($('.amn').find('.amlabel').length >= 1){
						  var lbj =$('.amn').find('.amlabel') ; 
						  $.each(lbj,function(){
						      $(this).find('.spl-headd').addClass('hide');
						       if($(this).find('.form-check').not('.hidden').length >=1){
						            $(this).find('.spl-headd').removeClass('hide');
						       }
						      
						  })
						 }
				 } 
				 
       
	  })
	  }
  }
function checktitleCount(){
	var value =$('#'+modelName+'_ad_title').val();
    // get MAX chars from textarea
    var maxlength = 50;
if (value.length > maxlength){
      //  $("#PlaceAnAd_ad_title").val(value.substring(0, maxlength));return false;
}
    var compare = maxlength - value.length;
    // decide if chars is under/over
    if (compare >= 0) {
        var tct = text_remaining.replace("{n}", parseInt(compare));
        $("#inputcounter").removeClass('error').html(tct);
    } else if (compare < 0) {
        //$("#inputcounter").addClass('error').html(compare);
        var tct = text_exceeded.replace("{n}", parseInt(compare));
        $("#inputcounter").addClass('error').html(tct);
    }
}
function checkdescpCount(){
	 var value =$('#'+modelName+'_ad_description').val();
    // get MAX chars from textarea
    var maxlength = 1000;
if (value.length > maxlength){
       // $("#PlaceAnAd_ad_description").val(value.substring(0, maxlength));return false;
}
    var compare = maxlength - value.length;
    // decide if chars is under/over
    if (compare >= 0) {
        //$("#inputcounter2").removeClass('error').html(compare);
        var tct = text_remaining.replace("{n}", parseInt(compare));
        $("#inputcounter2").removeClass('error').html(tct);
    } else if (compare < 0) {
        //$("#inputcounter2").addClass('error').html(compare);
        var tct = text_exceeded.replace("{n}", parseInt(compare));
        $("#inputcounter2").addClass('error').html(tct);
    }
}