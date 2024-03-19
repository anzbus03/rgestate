function easyload(k,e,id){
				e.preventDefault();
			 
				var containerID =  document.getElementById(id);
				var page_url = $(k).attr('href');
				NProgress.start(); $('#hmmenu').find('li').removeClass('active');
if ($('select').data('select2')) {
   $('select.select2').select2('destroy');
 }
  
 $('#pageHeader').removeClass('boxshdw');
				$.pjax({url: page_url , container:'#'+id,scrollTo: 0,  timeout: 110000 ,cache:false   }).complete(function(){
					NProgress.done();	activateVoxShadow2();
					if($('form.recapt').length > 0 ){
										
										onloadCallback() ;
									} 
									if($('#bs-example-navbar-collapse-1').length >0 )
									{
									 
										 $('#bs-example-navbar-collapse-1').css({'height':'0px'});
										 $('#bs-example-navbar-collapse-1').removeClass('in');
										 $('body').removeClass('menuIsActive');
									}
					
						});
}
function toggleBody() {

  if (jQuery('body').hasClass('menuIsActive')) {
    jQuery('body').removeClass('menuIsActive');
  } else {
    jQuery('body').addClass('menuIsActive');
  }
}
function showMiniFilters(){
	$('.miniHidden').toggleClass('show')
}
function showMoreFilters(){
	$('#defaultFilterBar').find('.smlCol17').addClass('fullWHt');
}
	 function eventScript(){
		  if ($('select').data('select2')) {
				  $('.select2-container').remove()
			 }
			  $('select.select2').select2();
			 $eventSelect = $('#dynamicCities') ; 
			 $eventSelect.select2({
								placeholder: 'Select Locations',
								 allowClear: true,
								ajax: {
								url: function () {
									var load_city_url2 = load_city_url+'/state/'+$('#state').val(); 
								return load_city_url2;
								},
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
			 $eventSelect.on("select2:select", function (e) { console.log("select2:select", e.params.data.id ); });
		 }
 function showfrm(k){ $('body').addClass('openfilter') }
	function closerfrm(k){ $('body').removeClass('openfilter') }
function loadListJs2(){
					 if ($('select').data('select2')) {
				  $('.select2-container').remove()
			 }
			 
			 	  $('select.select2').select2();
			 $eventSelect = $('#dynamicCities') ; 
			 $eventSelect.select2({
								placeholder: 'Select Locations',
								  'dropdownCssClass' : 'specialdropDown',
								ajax: {
								url: function () {
									var load_city_url2 = load_city_url+'/state/'+$('#state').val(); 
								return load_city_url2;
								},
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
								
								$eventSelect.on('select2:close', function (evt) {
								var uldiv = $(this).siblings('span.select2').find('ul')
								var count = uldiv.find('li').length - 1;
								if(count>=1){  
										$(this).siblings('span.select2').addClass('selecteditems')
								}
								else{  $(this).siblings('span.select2').removeClass('selecteditems') } 


								});
								
								var uldiv = $eventSelect.siblings('span.select2').find('ul')
		var count = uldiv.find('li').length - 1;
		if(count>=1){  
		$eventSelect.siblings('span.select2').addClass('selecteditems')
		}
		else{   $eventSelect.siblings('span.select2').removeClass('selecteditems') } 
								
					}
		 
function showfrm(k){ $('body').addClass('openfilter') }
	function closerfrm(k){ $('body').removeClass('openfilter') }
function showMiniFilters(){
	$('.miniHidden').toggleClass('show')
}
function showMoreFilters(){
	$('#defaultFilterBar').find('.smlCol17').addClass('fullWHt');
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
function placeMarker(location) {
    // first remove all markers if there are any
 
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
 
}
function setEmptyval(k){ $(k).val('');$('#frm_sec').val('');
						$('#frm_type').val('');
						$('#frm_cat').val(''); }
						function submitFrmTop(){
							$('#detail_form').submit();
							}
 function nslider(){
                	$('.nslider').slick({
					infinite: false,
					slidesToShow: 1,
					slidesToScroll: 1,
				 
					dots: false,
					swipeToSlide: true,
					swipe: true,
					arrows: true,
				 
			 
					}) 
				}
				 function fancyclgroup(){
  $('[data-fancybox="cl-group"]').fancybox({
    baseClass: "fancybox-custom-layout",
    infobar: false,
    touch: {
      vertical: false
    },
    buttons: ["close", "thumbs", "share"],
    animationEffect: "fade",
    transitionEffect: "fade",
    preventCaptionOverlap: false,
    idleTime: false,
    gutter: 0,
    
  });
  
}
  function homeBlog(){
	    $('#frsBlogSlider').sluck({
					infinite: false,
					slidesToShow: 6,
					slidesToScroll: 1,
				 
					dots: false,
					swipeToSlide: true,
					swipe: true,
					arrows: true,
					responsive: [
					{
							breakpoint: 1240,
							settings: {
								slidesToShow: 6,
								slidesToScroll: 1
							}
						},
					{
							breakpoint: 1024,
							settings: {
								slidesToShow: 6,
								slidesToScroll: 1
							}
						},
					{
							breakpoint: 768,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1
							}
						}, 
						 
						{
							breakpoint: 380,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1
							}
						}]
			 
					}) 
  }
  				 function onloadCallback() {
					 
					if( $('form.recapt').length > 0 ){ 
				 
											    grecaptcha.ready(function() {
      
            // do request for recaptcha token
            // response is promise with passed token
            grecaptcha.execute('6Ld3ZsYUAAAAAF0GkEfg-s4vNYDb2u3K3pGucQA7' ).then(function(token) {
                // add token to form
                $('form.recapt').find('button').removeProp("disabled",false)
                $('form.recapt').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                   
            });;
        });
        	$("body").addClass('recap');
	}else{
		$("body").removeClass('recap');
	}
        /* Place your recaptcha rendering code here */
				 
    }
function closeIFrame(){
     $('#ifrm').remove();
     
     $('#myModal3').modal('hide');
     
     loadDetails();
}
var userCase ; 
  function loadDetails(){
		 
		   $('.loadCnter').addClass('fetching'); 
		   $.get(user_details_info_url,function(data){
			    $('.loadCnter').removeClass('fetching'); 
			    if(data != '0'){
					user_defined = true; 
					$('#no_userli').html(data);
					switch(userCase){
						case 'email':
						$(current_val_k).click(); 
						break;
					}
				}
			   })
	  }
function iniFrame() { 
      
    if(window.self !== window.top) { 
         $('html').addClass("isOnFram");
    } 
     
} 
var mscrol = false; 
function activateVoxShadow2(){
	 
	
												if($('#pageHeader.boxshdw').length > 0 ){
									 mscrol = true;
													$(document).scroll(function() {
														if(mscrol){
													var pos =  $(document).scrollTop();
												
													if (pos >= 64) {
														$('.headerAbsolute').removeClass('boxshdw')
														 
													}
													else{
														$('.headerAbsolute').addClass('boxshdw')
													}
													}
													});
												}
												else {
														mscrol = false; 
														$('#pageHeader').removeClass('boxshdw');  
														 
												}
											}
	function openCity2(event,k,id,par){
	var tabm = $('#'+par) ;
	tabm.find('.tabcontent').removeClass('active');
	tabm.find('.tablinks').removeClass('active');
	$(k).addClass("active");
	$('#'+id).addClass("active");
	}
var current_val_k; 
   function OpenFormClickNew(k){
	 if(!user_defined){
		 current_val_k = k ; userCase = 'email';
	  OpenLogin(k);return false; 
    }
	  
	
    var idAd = $(k).attr('data-reactid');
    if(idAd===undefined){ return false;}
    $('#myModal2').modal('show');$('#cn_property').html('loading...');
    $.get(propertyUrl+'/id/'+idAd,function(data){ $('#cn_property').html(data);  })
    }
   
    function	OpenLogin(k)	{
	$('#myModal3').modal('show');
 
	$('#raw_ht_ml').html('<iframe id="ifrm"   class="mframe" ></iframe>')
         var el = document.getElementById('ifrm');
  
        el.src = login_option;
    
}	
 function  hm_tab(){

	 	$('#ids').slick({
					infinite: false,
					slidesToShow: 5,
					slidesToScroll: 1,
				 
					dots: false,
					swipeToSlide: true,
					swipe: true,
					arrows: true,
					responsive: [
					 
					{
							breakpoint: 768,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						}, 
						
						{
							breakpoint: 450,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1
							}
						}]
			 
					}) 
	 }
	 function ResizeWin(){
		  $(window).resize(function(e){
    if(window.innerWidth < 768) {
        if(!$('#ids').hasClass('slick-initialized')){
            hm_tab();
        }

    }else{
        if($('#ids').hasClass('slick-initialized')){
           
            $('#ids').slick('unslick');
        }
    }
});
	 
	 
	 }