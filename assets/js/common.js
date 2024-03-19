function  ajaxSubmitHappenlist(form, data, hasError,saveUrl)
{
if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":saveUrl,
                                    "data":form.serialize(),
                                    "success":function(data){
										var data = JSON.parse(data);
										if($("#requestBtn").length>0){  var hhtmk = $("#requestBtn").attr('data-html');  if(hhtmk !==undefined){  $("#requestBtn").attr('disabled',false); $("#requestBtn").html(hhtmk); } }
										if($("#bb2").length>0){  var hhtmk = $("#bb2").attr('data-html'); if(hhtmk !==undefined){  $("#bb2").attr('disabled',false); $("#bb2").html(hhtmk); } }
										 if(data.status=='1'){ 
										      $('#topThirdPlacementLeadFormContainer').hide();
										      $('.rms-data-h').addClass("hide")
										      
											 $('.success-modal').addClass('visible');
											 		  Moveit.put(popGroup, {
          start: '0%',
          end: '0%',
          visibility: 0
        });
        Moveit.put(tick, {
          start: '0%',
          end: '0%',
          visibility: 0
        });
        Moveit.put(tick2, {
          start: '0%',
          end: '0%',
          visibility: 0
        });
        Moveit.put(circle, {
          start: '0%',
          end: '0%',
          visibility: 0
        });

        Moveit.animate(circle, {
            visibility: 1,
            start: '0%',
            end: '100%',
            duration: 1,
            delay: 0,
            timing: 'ease-out'
        })
        Moveit.animate(tick, {
            visibility: 1,
            start: '0%',
            end: '100%',
            duration: 0.2,
            delay: 0.5,
            timing: 'ease-out'
        })
        Moveit.animate(tick2, {
            visibility: 1,
            start: '0%',
            end: '80%',
            duration: 0.2,
            delay: 0.7,
            timing: 'ease-out'
        })
        Moveit.animate(popGroup, {
            visibility: 1,
            start: '20%',
            end: '60%',
            duration: 0.2,
            delay: 1.,
            timing: 'ease-in'
        }).animate(popGroup, {
            visibility: 1,
            start: '100%',
            end: '100%',
            duration: 0.2,
            delay: 1.2,
            timing: 'ease-in-out'
        });
										}
										else{
											$("#msg_alert").html(data.msg).show();
											setTimeout(function() {
											$("#msg_alert").hide()
											}, 7000);
										}
										 
                                     },

                                  });
     }
      else
    { 
       alert('error');
     }
 }

function caroselSingle(e,b){
	var Obj = $("#"+e).find(".single-item");
	Obj.slick({lazyLoad:"ondemand",dots:!0,slidesToShow:1, slidesToScroll:1,appendArrows:"#"+e+" .arws",appendDots:"#"+e+" .dots"});
	 
	 
	  var s = e;
	  if(b==undefined){ 
		  
		$(window).resize(function(){  $("#"+e).find(".single-item").slick('resize');  });
	  }
	  else{
	 
	  
	  $("#"+s).find(".single-item").on('beforeChange', function(event, slick, currentSlide, nextSlide){
											if ( currentSlide !== nextSlide ) {
											lazyBgImg( $(slick.$slides.get(nextSlide)) );
											}
											});
											
	  }
	  }
function  ajaxSubmitHappen(form, data, hasError,saveUrl)
{
if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":saveUrl,
                                    "data":form.serialize(),
                                    "success":function(data){
										var data = JSON.parse(data);
										if(data.status=='1'){
											$("#msg_alert").html(data.msg).show();
											setTimeout(function() {
											$("#msg_alert").hide()
											}, 15000);
											 
										}
										else{
											$("#msg_alert").html(data.msg).show();
											setTimeout(function() {
											$("#msg_alert").hide()
											}, 7000);
										}
										 
                                     },

                                  });
     }
      else
    { 
       alert('error');
     }
 }
function  ajaxSubmitHappenAgent(form, data, hasError,saveUrl)
{
    if(!hasError)
{ 		
	 
			var saveUrl = saveUrl.replace("cn1", $('#Agents_country_slug').val() );
			var saveUrl = saveUrl.replace("cn2", $('#Agents_region').val() );
			var saveUrl = saveUrl.replace("cn3", $('#Agents_property').val() );
			 window.location= saveUrl;
			 return false;
     }
      else
    { 
       alert('error');
     }
 }
function  updateSearchHome()
{
	if($('#cn_picker').val()==''){
		$('#specialErromesaage').html('Please Select location');
		$('#cn_picker').focus();
		return false; 
	}
	else{
		var selctedVa = $('#search_type :selected').val();
		if(selctedVa!==undefined){
			var selctedVa = selctedVa.replace("LcountryL", $('#cn_picker').val() );
		}
		window.location= selctedVa;
		return false;
		
	}
		  
 }
function  ajaxSubmitHappenDeveloper(form, data, hasError,saveUrl)
{
    if(!hasError)
{ 		
			var saveUrl = saveUrl.replace("cn1", $('#Developer_country_slug').val() );
			var saveUrl = saveUrl.replace("cn2", $('#Developer_region').val() );
			var saveUrl = saveUrl.replace("cn3", $('#Developer_property').val() );
	 
			 window.location= saveUrl;
			 return false;
     }
      else
    { 
       alert('error');
     }
 }
function  ajaxSubmitHappen2(form, data, hasError,saveUrl)
{
    if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
                                    "url":saveUrl,
                                    "data":form.serialize(),
                                    "success":function(data){
										var data = JSON.parse(data);
										if(data.status=='1'){
											$("#msg_alert2").html(data.msg).show();
											setTimeout(function() {
											$("#msg_alert2").hide()
											}, 15000);
											 
										}
										else{
											$("#msg_alert2").html(data.msg).show();
											setTimeout(function() {
											$("#msg_alert2").hide()
											}, 7000);
										}
										 
                                     },

                                  });
     }
      else
    { 
       alert('error');
     }
 }
 var emptyResult ='';
	function scrollPagination2(){
											  $('#slideSheet').find('.ajaxLoaded').remove(); 
										  $('.loadingDiv').html('loading...'); 
												delay = 1000;	 
										       clearInterval(scroll_Pagination5);
										   	   scroll_Pagination5 = setTimeout(function() {
												jQuery('#slideSheet').scrollPagination(
												{
												nop 			: limit,
												offset  		: '0',
												error   		: 'You have reached the end of the post.',   
												loadingHtml     : loadingHtml,   
												loadMoreHtml 	: loadMoreHtml,   
												afterFinishHtml : afterFinishHtml,   
												appendId		: appendId,
												delay 			: 500,
												formID			: formID,
												slug   			: slug,
												scroll 			: false,
												checkFuture		: true,
											    afterLoad       :  function(data){   if(data=='1' &&  emptyResult != '' ){  if($('#slideSheet').find('.ajaxLoaded').length == '0'){ $('.loadingDiv').html('');  $('#suggest_friends_last_id').before(emptyResult); }}else{ caroselSingleAfter(); } },
												});
										   	   }, delay);
 
}			
function setChangeSession(k){
	var data_id =  $(k).attr('data-id');
	if(data_id !==undefined){
		if($(k).closest('li').hasClass('active')){
			return false; 
		}
		else{
			 $('#user_tab_filter').find('li').removeClass('active')
			 $(k).closest('li').addClass('active');
			  $('#sec_id').val(data_id);
			  scrollPagination2();		 
			
		}
	}
}		
		function  ajaxSubmitHappenFav(form, data, hasError,saveUrl)
		{
		if(!hasError)
		{

		$.ajax({

		"type":"POST",
		"url":saveUrl,
		"data":form.serialize(),
		"success":function(data){
		var data = JSON.parse(data);
		if(data.status=='1'){
			
		$('.when_show_no_login').remove(); 
			$('.when_show_show_login').removeClass('hidden') ;
		 
		user_defined = true; 
		if(data.after!=''){

				if(data.after=='saved_fave'){
				closePopUpThis();
				var obj = $('#fav_button_'+data.id) ;
				if(data.class!=''){
				obj.addClass('active')
				obj.find('i').removeClass('iconHeartEmpty').addClass('iconHeart')
				}
				else{
				obj.removeClass('active');
				obj.find('i').removeClass('iconHeart').addClass('iconHeartEmpty')
				}
				successAlert('Success!',  data.message   );

				}
				if(data.after=='saved_search'){
				closePopUpThis();
				var obj = $('#fav_button_url') ;
				if(data.class!=''){
				obj.addClass('active')
				obj.html('Remove Search')
				}
				else{
				obj.html('Save Search')
				}
				successAlert('Success!',  data.message   );

				}
		}


		}
		else{
		alert('logged in failed ') 
		}

		},

		});
		}
		else
		{ 
		alert('error');
		}
		}


		function loadSetAcount(k){
		$('#ajax_signin').find('li').removeClass('active');
		$(k).closest('li').addClass('active');
		$('#tabs-container').find('.tab-content').hide();
		$('#tab2').show();
		}
		function loadSetAcountSign(k){
		$('#ajax_signin').find('li').removeClass('active');
		$(k).closest('li').addClass('active');
		$('#tabs-container').find('.tab-content').hide();
		$('#tab1').show();
		}
function OpenSignUp(k){
    savetofavourite(k);return false;
	if(user_defined){
		savetofavourite(k);return false; 
	}
	$('#myModal3').modal('show');
	var fun = $(k).attr('data-function');
	var id = $(k).attr('data-id');
	var after = $(k).attr('data-after');
	 
	//$('#loginModalNew').after('<div class="modalCover modalCover_dark" id="mn_cver"></div>');
	$.get(user_login_url,{'id':id,'fun':fun,'after':after},function(data){ $('#raw_ht_ml').html(data);   })
}
function savetofavourite(k){
	var fun = $(k).attr('data-function');
	var id = $(k).attr('data-id');
	var after = $(k).attr('data-after');
	$.get(add_to_fav,{'id':id,'fun':fun,'after':after},function(data){  
				var data = JSON.parse(data);
				
				if(data.status=='1'){
				if(data.after=='saved_fave'){
						var obj = $('#fav_button_'+data.id) ;
						if(data.class!=''){
							obj.addClass('active');
							var current = parseInt($('.UserLinksListSingle').find('#dataCounter').html());
							 
							if(!isNaN(current)){ $('.dataCounter-fav').html(current+1);   }
							obj.find('i').removeClass('iconHeartEmpty').addClass('iconHeart')
						}
						else{
							obj.removeClass('active');
							var current = parseInt($('.UserLinksListSingle').find('#dataCounter').html());
						 
							if(!isNaN(current)){ $('.dataCounter-fav').html(current-1);   }
							obj.find('i').removeClass('iconHeart').addClass('iconHeartEmpty')
						}
						successAlert('Success!',  data.message   );

				}
				else if(data.after=='saved_search'){
				var obj = $('#fav_button_url') ;
				if(data.class!=''){
				obj.addClass('active')
				obj.html('Remove Search')
				}
				else{
				obj.html('Save Search')
				}
				successAlert('Success!',  data.message   );

				}
			}
			else{
				errorAlert('Success!',  data.message   );
			}
				 
	 })

} 

/*
function savetofavourite(k){
	var fun = $(k).attr('data-function');
	var id = $(k).attr('data-id');
	var after = $(k).attr('data-after');
	$.get(add_to_fav,{'id':id,'fun':fun,'after':after},function(data){  
				var data = JSON.parse(data);
				if(data.status=='1'){
				if(data.after=='saved_fave'){
						var obj = $('#fav_button_'+data.id) ;
						if(data.class!=''){
							obj.addClass('active')
							obj.find('i').removeClass('iconHeartEmpty').addClass('iconHeart')
						}
						else{
							obj.removeClass('active');
							obj.find('i').removeClass('iconHeart').addClass('iconHeartEmpty')
						}
						successAlert('Success!',  data.message   );

				}
				else if(data.after=='saved_search'){
				var obj = $('#fav_button_url') ;
				if(data.class!=''){
				obj.addClass('active')
				obj.html('Remove Search')
				}
				else{
				obj.html('Save Search')
				}
				successAlert('Success!',  data.message   );

				}
			}
			else{
				errorAlert('Success!',  data.message   );
			}
				 
	 })

} 
*/
var user_defined = false; 
var user_login_url ; 
var add_to_fav ; 
function closePopUpThis(){
	$('#myModal3').modal('hide');
	//$('#mn_cver').remove();
 }
 function load_via_ajax6(k,id){
	var url_load = $(k).attr('data-url') 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
	 
		 $('#'+modelName5+'_'+id).val('');
		 $('#'+modelName5+'_'+id).html('<option value="">Loading...</option>');
		 var attr_id = $(k).attr('id');
		 
		 $.get(url_load,function(data){ var data = JSON.parse(data) ;   $('#'+modelName5+'_'+id).html(data.data)   })
	}
}

function setHeight() {
windowHeight = $(window).innerHeight()-50;
$('.main-search-container.home').css('min-height', windowHeight);
};
 
	function openShareButtons(k,e){
		e.preventDefault();
		$(k).closest('.navbar-minimal').toggleClass('open');
	}
	function windowOpenNew(k,e){
                                                                    e.preventDefault();
                                                                    window.open($(k).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
                                                                    return false;
                                                             }
                                                                    
function checkScroll() {
				 
						currentPage++;
					 
						offset =  (currentPage - 1) * limit   ;
					 
					jQuery.ajax(slug+'?offset=' + offset + '&limit='+limit+'&is_form=1',  { data		 : {formData: encodeURIComponent( $('#frmId').serialize()) } ,asynchronous:true, evalScripts:true, method:'get', 
						beforeSend: function(){
							  scroll = false;
							loadingDiv.html(loadingHtml);               
						},
						success: function(data, textStatus, jqXHR) {
							loadingDiv.html('');     
							if(data=='1') { stopPagination = false;   }
							else{
							data = JSON.parse(data);
							$('#suggest_friends_last_id').before(data.dataHtml);
							caroselSingleAfter() ;
							  const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();
		   
							//$('#items_container').append(jQuery(data).find('#items_container').html());
							  scroll = true;
					 
							 
							}
							 
						 
					},});
					 
					}
function checkScrollUser() {
				 
						currentPage++;
					 
						offset =  (currentPage - 1) * limit   ;
					 
					jQuery.ajax(slug+'?offset=' + offset + '&limit='+limit+'&is_form=1',  { data		 : {formData:  '' } ,asynchronous:true, evalScripts:true, method:'get', 
						beforeSend: function(){
							console.log('loading'+slug);
							  scroll = false;
							loadingDiv.html(loadingHtml);               
						},
						success: function(data, textStatus, jqXHR) {
							loadingDiv.html('');     
							if(data=='1') { stopPagination = false;   }
							else{
							data = JSON.parse(data);
							$('#suggest_friends_last_id').before(data.dataHtml);
						 
							//$('#items_container').append(jQuery(data).find('#items_container').html());
							  scroll = true;
					 
							 
							}
							 
						 
					},});
					 
					}
function generateSliderC(ids,count,seven,five ){
 
    var slickObj = $('#'+ids).find('.slide');
    
	  slickObj.slick({
  infinite: true,
  slidesToShow: count,
  slidesToScroll: count,
  	responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: seven,
					slidesToScroll:seven
				}
			}, 
			 , {
				breakpoint: 767,
				settings: {
					slidesToShow: seven,
					slidesToScroll: seven
				}
			}
			 , {
				breakpoint: 568,
				settings: {
					slidesToShow: five,
					slidesToScroll: five
				}
			}
			 , {
				breakpoint: 479,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			  
			]
});
	   
 }
 function generateLinksSlider2( ){
 
    var slickObj2 = $('#ids') ;
    
	  slickObj2.slick({
  infinite: false,
  slidesToShow: 4,
  slidesToScroll: 1,
  	responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
					slidesToScroll:1
				}
			}, 
			 , {
				breakpoint: 767,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			}
			 , {
				breakpoint: 568,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			}
			 , {
				breakpoint: 479,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			  
			]
});
	   
 }
function activateTab(k){
					var attr =    $(k).attr('aria-selected');
					var attrId =    $(k).attr('data-href');
					if(window.innerWidth < 768) {
						var varurl =    $(k).attr('data-url');
						window.location= varurl;
						return false;
					}
					if(attr=='false'){
						$('.hom-tab').find('.nav-link').removeClass('active show');
						$('.hom-content').find('.tab-pane').removeClass('active show');
						$('.hom-tab').find('.nav-link').attr('aria-selected','false') ;
						$(k).attr('aria-selected','true') ;
						$(k).addClass('active show');
						$('#'+attrId).addClass('active show');
						var idMain = ($('#'+attrId).find('form').attr('action'));
						if(idMain !==undefined){
							var hrefUrl = $('.top-search').find('a');
							if(hrefUrl.length>0){
								$.each(hrefUrl,function(){ $(this).attr('href',idMain+'/'+$(this).attr('data-id'));})
							}
							var hrefUrl2 = $('.homechange').find('a');
							/*
							if(hrefUrl2.length>0){
								var tit = $(k).attr('data-title')
								$('#sec_change').html(tit)
								$.each(hrefUrl2,function(){ $(this).attr('href',idMain+'/type_of[]/'+$(this).attr('data-id'));})
							}*/
							var bantit = $(k).attr('data-ban-title')
							 
							$('#nban_tit').html(bantit)
						}
					}
				   }
	var timer1;
                                                            function openDivThis(k){
																  
																var dataOpen = $(k).attr('data-open');
																
																if(dataOpen !== undefined){
																	 openDiv = $(k).closest('.miniHidden'); 
																	 
																	 clearTimeout(timer1);
																	 timer1 = setTimeout(function(){ 
																			$('#filterBarContainer').find('.miniHidden').not(openDiv).removeClass('opened');																	 
																			if(!openDiv.hasClass('opened')){
																				openDiv.addClass('opened');
																			}
																			else{
																				openDiv.removeClass('opened');
																			 
																			}
																	 }, 50);
																	
																}
															}
															 
                                                            function openDivThislatest(k){
																var dataOpen = $(k).attr('data-open');
																
																if(dataOpen !== undefined){
																	 
																	 openDiv = $(k).closest('.miniHidden'); 
																	 
																	 clearTimeout(timer1);
																	 timer1 = setTimeout(function(){ 
																			$('#filterBarContainer').find('.miniHidden').not(openDiv).removeClass('opened');																	 
																			if(!openDiv.hasClass('opened')){
																				openDiv.addClass('opened');
																			}
																			else{
																				openDiv.removeClass('opened');
																			 
																			}
																	 }, 50);
																	
																}
															}
															function loadSubcategoriest(k){
																$(k).closest('form').find("#load_categories").html("loading..")
																 $.get(load_category_url+'/listing_type/'+$(k).val(),function(data){ $(k).closest('form').find("#load_categories").html(data) })
															}
 function moveTo2(id,off){ $([document.documentElement, document.body]).animate({ scrollTop: $("#"+id).offset().top-off }, 2000);   }
      
function load_via_ajax2(k,id){
	var url_load = $(k).attr('data-url') 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
	 
		 $('#'+modelName+'_'+id).val('');
		 $('#'+modelName+'_'+id).html('<option value="">Loading...</option>').select2();
		 var attr_id = $(k).attr('id');
		 
		 $.get(url_load,function(data){ var data = JSON.parse(data) ;   $('#'+modelName+'_'+id).html(data.data).select2();  })
	}
}
function load_via_ajax5(k,id){
	var url_load = $(k).attr('data-url') 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
	 
		 $('#'+modelName5+'_'+id).val('');
		 $('#'+modelName5+'_'+id).html('<option value="">Loading...</option>').select2();
		 var attr_id = $(k).attr('id');
		 
		 $.get(url_load,function(data){ var data = JSON.parse(data) ;   $('#'+modelName5+'_'+id).html(data.data).select2();  })
	}
}
function search_byAjax_agent(){ 
			var containerID =  document.getElementById('map_locator');
			formData = $('#frmId :input').serializeArray();
			  var mainListUrl3 = '/';
			 $.each(formData,function(k,v){
						if(v.value!=''){
							
							mainListUrl3+= v.name+'/'+v.value+'/'; 
						}
						});
			mainListUrl3 = mainListUrl2 + mainListUrl3 ;	   
			$('#dropdownBtn2').html('<i class="iconSpinner" style="margin-bottom:-2px;"></i>')
			$('#loader_againn').html('<i class="iconSpinner" style="margin-bottom:-2px;"></i> '+loading_results)
			$.pjax({url: mainListUrl3 , container:containerID,  timeout: 110000 ,cache:false   }).complete(function(){		});
			 
			
			
			}
function changeForm2(){
				$("form#frmId :input").change(function() {
				clearTimeout(timer_ajax);
				timer_ajax = setTimeout(function(){
						search_byAjax_agent()
				}, 1500);
				});
			 
				$('#locationInputs').focus(function(){ $(this).select();})
				$(document).click(function(e) {
				if (!$(e.target).parents().andSelf().is('#frmId')) {
				$('#filterBarContainer').find('.miniHidden').removeClass('opened');
				}
				});
}
function closeOpendDiv(){
 
	$(document).on('click',function(e) {
				if (!$(e.target).parents().andSelf().is('.miniHidden')) {
					 
				$('.miniHidden').removeClass('opened');
				}
				});
}
 function load_user(p){
$("#user_select").select2({
								placeholder: p ,
								 allowClear: true,
								ajax: {
								url:  function(){
									
									return $(this).attr('data-url');
									} ,
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
 function showCallPopup(k,e) { 
	   e.preventDefault();
 
  e.stopPropagation();

	 $('.phone-tooltip').addClass('phone-tooltip--hide').not( $(k).find('.phone-tooltip'));
	 $(k).find('.phone-tooltip').removeClass('phone-tooltip--hide') }
function closeToolTip(k,e){   e.preventDefault();e.stopPropagation(); $('.phone-tooltip').addClass('phone-tooltip--hide') }
window.onscroll = function() { $('.phone-tooltip').addClass('phone-tooltip--hide'); };
function activateVoxShadow(){
													$(document).scroll(function() {
													var pos =  $(document).scrollTop();
												
													if (pos >= 64) {
														$('.headerAbsolute').removeClass('boxshdw')
														 
													}
													else{
														$('.headerAbsolute').addClass('boxshdw')
													}
													});
											}
	 function activateOpen(){
										 $('.mainme').toggleClass('underbuy')
										 }
function activatePropertyDetail(){
													$(document).scroll(function() {
													var pos =  $(document).scrollTop();
												$('.profile-tabs li').removeClass('active')
															$('#to_description_a').addClass('active')
													if (pos >= sec_filter) {
														$('#sec_filter').addClass('absolute')
														if (pos >= t_features) {
															$('.profile-tabs li').removeClass('active')
															$('#t_features_a').addClass('active')
														}
														if (pos >= to_map) {
															$('.profile-tabs li').removeClass('active')
															$('#to_map_a').addClass('active')
														}
														if (pos >= prop_type) {
															$('.profile-tabs li').removeClass('active')
															$('#prop_type_a').addClass('active')
														}
														if (pos >= payment_plan) {
															$('.profile-tabs li').removeClass('active')
															$('#payment_plan_a').addClass('active')
														}
														if (pos >= to_florr) {
															$('.profile-tabs li').removeClass('active')
															$('#to_florr_a').addClass('active')
														}
														if (pos >= to_developer) {
															$('.profile-tabs li').removeClass('active')
															$('#to_developer_a').addClass('active')
														}
														
														 
													}
													else{
														$('#sec_filter').removeClass('absolute')
													}
													});
											}
 function OpenFormClick(k){
	  
    var idAd = $(k).attr('data-reactid');
    if(idAd===undefined){ return false;}
    $('#myModal2').modal('show');$('#cn_property').html('loading...');
    $.get(propertyUrl+'/id/'+idAd,function(data){ $('#cn_property').html(data);  })
    }
     function OpenFormAgentClick(k){
    var idAd = $(k).attr('data-reactid');
    if(idAd===undefined){ return false;}
    $('#myModal2').modal('show');$('#cn_property').html('loading...');
    $.get(agentUrl+'/id/'+idAd,function(data){ $('#cn_property').html(data);  })
    }
function  featureddevelopers(){
    $('#frsSlider').sluck({
					infinite: false,
					slidesToShow: 20,
					slidesToScroll: 1,
				 
					dots: false,
					swipeToSlide: true,
					swipe: true,
					arrows: true,
					responsive: [
					{
							breakpoint: 1240,
							settings: {
								slidesToShow: 16,
								slidesToScroll: 1
							}
						},
					{
							breakpoint: 1024,
							settings: {
								slidesToShow: 13,
								slidesToScroll: 1
							}
						},
					{
							breakpoint: 768,
							settings: {
								slidesToShow: 7,
								slidesToScroll: 1
							}
						}, 
						 
						{
							breakpoint: 380,
							settings: {
								slidesToShow: 6,
								slidesToScroll: 1
							}
						}]
			 
					}) 
					/*
	 	$('#frsSlider').sluck({
					infinite: false,
					slidesToShow: 5,
					slidesToScroll: 1,
				 
					dots: false,
					swipeToSlide: true,
					swipe: true,
					arrows: true,
					responsive: [
					{
							breakpoint: 1240,
							settings: {
								slidesToShow: 4,
								slidesToScroll: 1
							}
						},
					{
							breakpoint: 1024,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 1
							}
						},
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
						},
						{
							breakpoint: 340,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}]
			 
					}) 
					*/
	 }
	 
	 	function featuredSliderhome(featuredCount,total_show){
				var sliderm =	$('.werew');
		 	 
				sliderm.sluck({
					infinite: false,
					slidesToShow: parseFloat(total_show),
					slidesToScroll: 1,
				 
					dots: false,
					swipeToSlide: true,
					swipe: true,
					arrows: true,
					responsive: [{
							breakpoint: 992,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						}, {
							breakpoint: 600,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}]
			 
					}) 
	 
			 
			 }
function activatelistSearchFixed(){
													$(document).scroll(function() {
													var pos =  $(document).scrollTop();
												
													if (pos >= 64) {
														$('.slider-form').addClass('onscrol')
														 
													}
													else{
														$('.slider-form').removeClass('onscrol')
													}
													});
											}
	
function  featureddevelopers2(){
	 	$('#projectSlider').sluck({
					infinite: false,
					slidesToShow:3 ,
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
							breakpoint: 580,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1
							}
						}]
			 
					}) 
	 }
	
function openPropertySearchMore(k){
		$('.smalh').toggleClass('opens')
	}

function setthisValuefrom(k){
	var price = $(k).attr('data-price');
	if(price !== undefined){
	$('#minPrice').val(price);
	$('#min_price_input').val($(k).text());
	$('#select2-minPrice-results').find('.select2-results__option--highlighted').removeClass('select2-results__option--highlighted');
	$(k).addClass('select2-results__option--highlighted');priceTexter();
	}
}
function setthisValueto(k){
	var price = $(k).attr('data-price');
	if(price !== undefined){
		$('#maxPrice').val(price);
		$('#max_price_input').val($(k).text());
	$('#select2-maxPrice-results').find('.select2-results__option--highlighted').removeClass('select2-results__option--highlighted');
	$(k).addClass('select2-results__option--highlighted');priceTexter();
	}
}

function priceTexter(){ 
var maxPriceT = $("#maxPrice option:selected").text();
var minPriceT =  $("#minPrice option:selected").text();
 if(minPriceT=='' && maxPriceT==''){
	 var ttit = 'Any Price'
 }
 else{
	  var ttit =  minPriceT+' to '+maxPriceT;
 }
 $('span#textr').html(ttit);
}
function areaUnitChanger(){
	$.magnificPopup.open({
        items: {
            src: '#area_unitChanger' 
        },
        type: 'inline'
    });
}

 function showPop(k){
			propertyUrl = $(k).attr('data-href');
    $('#myModal2').modal('show');$('#cn_property').html('loading...');
    $.get(propertyUrl,function(data){ $('#cn_property').html(data);  })
    } 
    
function load_via_ajax23(k,id){
	var url_load = $(k).attr('data-url') 
	if(url_load !== undefined){
		url_load += '/id/'+$(k).val(); 
	 var parent1 = $(k).closest('form');
		 parent1.find('#'+id).val('');
		  parent1.find('#'+id).html('<option value="">Loading...</option>').select2();
		 var attr_id = $(k).attr('id');
		  
		 $('.loader_p').addClass('open')
		 $.get(url_load,function(data){ $('.loader_p').removeClass('open'); var data = JSON.parse(data) ;    parent1.find('#'+id).html(data.data).select2(); if(data.size != '0') {    parent1.find('#'+id).closest('.form-group').removeClass('hidden') }else{   parent1.find('#'+'_'+id).closest('.form-group').addClass('hidden') }  })
	}
}
function homefn(){ 
	 $(function(){
	  $('.slider').slick({
      dots: true,
        autoplay: true,
        autoplaySpeed: 7000,
     
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        lazyLoad: 'ondemand',
        lazyLoadBuffer: 0,
      mobileFirst: true,
       prevArrow: false,
    nextArrow: false
    });
	  
	  })
  
		 
			 
			 $('.slider-form').find("select").on("change", function() {   if($(this).val()==''){ $(this).closest('div').removeClass('itmSelected') }else{  $(this).closest('div').addClass('itmSelected') }    });
			  $.each($('.tab-pane'),
			  function(){
			  $(this).find('#categoryTypeToggleDiv').find("input").on("change", function() {  
				  var abHtml = '';    
				  var clsD = $(this).closest('#categoryTypeToggleDiv'); 
				  var clsD2 = clsD.parent().find('#homeTypeToggle'); 
				 
				  if( clsD.find("input:checked").length  > 0 ) {
					  clsD.closest('.input-group').addClass('itmSelected');
					  var count =  1; 
					  $.each(clsD.find("input:checked"),function(){ 
						  if(count=='1'){
						  abHtml += $(this).next('label').text()+ ' ';  
						  clsD2.html('<span class="nthem">'+abHtml+'</span>'+'<i class="mls iconDownOpen"></i>'); 
						  }
						  else{
							 clsD2.html('<span class="nthem">'+abHtml+'++</span>'+'<i class="mls iconDownOpen"></i>');
						  }
						   
						  
						  count++;;
						  
						  })
				  }else{
					   clsD.closest('.input-group').removeClass('itmSelected');
					   clsD2.html('Property Type <i class="mls iconDownOpen"></i>');
			  }
				  
				  
				   })
			   })
		//	 $('.slider-form').find(".input-group").on("mouseover",function(){ $(this).addClass("activehover")  })
		//	 $('.slider-form').find(".input-group").on("mouseleave",function(){ $(this).removeClass("activehover")  })
			$(document).on('mouseenter', '.select2-container', function(e) {
			$(this).prev("select").select2("open");
			});

		$(document).on("mouseleave", ".select2-container", function(e) {
    if ($(e.toElement || e.relatedTarget).closest(".select2-container").length == 0) {
        $('select.select2').select2("close");
    }    
});
         $(function(){ $('select.select2').select2(); 		  })
			  
			  $(function(){
				  closeOpendDiv()
				  
				  })
			  }
			  function openDivThisBelow(k){ $(k).find('#homeTypeToggle').click();  } 
			  
function listJs(){
	 $('.slider-form').find("select").on("change", function() {   if($(this).val()==''){ $(this).closest('div').removeClass('itmSelected') }else{  $(this).closest('div').addClass('itmSelected') }    });
		var wi = $(window).width();
			if (wi >= '1024') {
			$(document).on('mouseenter', '.select2-container', function(e) {
			$(this).prev("select.select2").select2("open");
			});

		$(document).on("mouseleave", ".select2-container", function(e) {
    if ($(e.toElement || e.relatedTarget).closest(".select2-container").length == 0) {
        $('select.select2').select2("close");
    }    
});
}

  $.each($('.tab-pane'),
			  function(){
			  $(this).find('#categoryTypeToggleDiv').find("input").on("change", function() {  
				  var abHtml = '';    
				  var clsD = $(this).closest('#categoryTypeToggleDiv'); 
				  var clsD2 = clsD.parent().find('#homeTypeToggle'); 
				 
				  if( clsD.find("input:checked").length  > 0 ) {
					  clsD.closest('.input-group').addClass('itmSelected');
					  var count =  1; 
					  $.each(clsD.find("input:checked"),function(){ 
						  if(count=='1'){
						  abHtml += $(this).next('label').text()+ ' ';  
						  clsD2.html('<span class="nthem">'+abHtml+'</span>'+'<i class="mls iconDownOpen"></i>'); 
						  }
						  else{
							 clsD2.html('<span class="nthem">'+abHtml+'++</span>'+'<i class="mls iconDownOpen"></i>');
						  }
						   
						  
						  count++;;
						  
						  })
				  }else{
					   clsD.closest('.input-group').removeClass('itmSelected');
					   clsD2.html('Property Type <i class="mls iconDownOpen"></i>');
			  }
				  
				  
				   })
			   })
			

		
}
   function checkScrollFav() {
				 
						currentPageFav++;
						 
						if(currentPageFav > 2){
						offsetFav =  (currentPageFav - 2) * limitFav   ;
						}
					 
					jQuery.ajax(slugFav+'?offset=' + offsetFav + '&limit='+limitFav+'&is_form=1',  { data		 : {formData:  ''  } ,asynchronous:true, evalScripts:true, method:'get', 
						beforeSend: function(){
							scrollFav = false;
							loadingDivFav.html(loadingHtmlFav);               
						},
						success: function(data, textStatus, jqXHR) {
							loadingDivFav.html('');     
							if(data=='1') {
								
								if(currentPageFav=='2'){ $('#emptyResults').removeClass('hide');  };
								 stopPaginationFav = false; $('#ldmore').html('');  }
							else{
							data = JSON.parse(data);
							$('#shortlist_items').append(data.dataHtml);
							 $('#emptyResults').addClass('hide'); 
							scrollFav = true; if(data.future=='1'){ $('#ldmore').html(loadMoreHtmlFav);  } 
					 
							 
							}
							 
						 
					},});
					 
					}
function openShortlistPop(k){
	$('.mobile_bottom_filter').addClass('mobile_bottom_filter-opened'); $('#emptyResults').addClass('hide'); 
	offsetFav = 0 ; currentPageFav= 1; stopPaginationFav = true; scrollFav = false;
	$('#shortlist_items').html('');
	 checkScrollFav();
}
function closeShortlistPop(k){
	$('.mobile_bottom_filter').removeClass('mobile_bottom_filter-opened')
}
function removethisShortlist(k){
	var id_delete   = $(k).attr('data-id');
	if(id_delete != undefined){
		$.get(deleteFav,{id:id_delete},function(data){ $(k).closest('.lst-prop').remove(); 
			var totalf = $('#shortlist_items').find('.lst-prop').length;
			if(totalf=='0'){  $('#emptyResults').removeClass('hide');  }
			var current = parseInt($('.UserLinksListSingle').find('#dataCounter').html());
						 
							if(!isNaN(current)){ $('.dataCounter-fav').html(current-1);   }
			  })
	}
	
}
function callprevet(e,k){
	e.preventDefault();
	formData = $(k).find(':input').serializeArray();
			  var mainListUrl3 = $(k).attr('action')+'/';
			  var category = ''; 
			  var city = ''; 
			  var locality = ''; 
			  var prime2 = ''; 
			 $.each(formData,function(k,v){
						if(v.value!=''){
							if(v.name=='type_of'){ category +=  'Property_'+v.value+'/'; ; }
							else if(v.name=='state'){ city +=  v.value+'/'; ; }
							else if(v.name=='locality'){ locality +=  'Locality_'+v.value+'/'; ; }
							else {
							prime2+=  v.value+'/'; 
							}
							
							
						}
						});
						
						location.href = mainListUrl3+category+city+locality+prime2 ;
}
