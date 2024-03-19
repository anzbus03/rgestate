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
			var saveUrl = saveUrl.replace("cn2", $('#Agents_property_type').val() );
	 
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
			var saveUrl = saveUrl.replace("cn2", $('#Developer_property_type').val() );
	 
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
											    afterLoad       :  function(data){   if(data=='1' &&  emptyResult != '' ){  if($('#slideSheet').find('.ajaxLoaded').length == '0'){ $('.loadingDiv').html('');  $('#suggest_friends_last_id').before(emptyResult); }}},
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
	if(user_defined){
		savetofavourite(k);return false; 
	}
	$('#loginModalNew').show();
	var fun = $(k).attr('data-function');
	var id = $(k).attr('data-id');
	var after = $(k).attr('data-after');
	 
	$('#loginModalNew').after('<div class="modalCover modalCover_dark" id="mn_cver"></div>');
	$.get(user_login_url,{'id':id,'fun':fun,'after':after},function(data){ $('#raw_ht_ml').html(data);  })
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
							obj.addClass('active')
							obj.find('i').removeClass('iconHeartEmpty').addClass('iconHeart')
						}
						else{
							obj.removeClass('active');
							obj.find('i').removeClass('iconHeart').addClass('iconHeartEmpty')
						}
						successAlert('Success!',  data.message   );

				}
			}
			else{
				errorAlert('Success!',  data.message   );
			}
				 
	 })

}
var user_defined = false; 
var user_login_url ; 
var add_to_fav ; 
function closePopUpThis(){
	$('#loginModalNew').hide();
	$('#mn_cver').remove();
 }
function setHeight() {
windowHeight = $(window).innerHeight()-50;
$('.main-search-container.home').css('min-height', windowHeight);
};
