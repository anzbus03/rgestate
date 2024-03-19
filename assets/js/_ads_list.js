function openPopup(k){
	var r_val = $(k).attr('data-id');
	var r_number = $(k).attr('data-number');
	$("#AdvertisementItems_row_id").val(r_val);
	$("#AdvertisementItems_row_number").val(r_number);
	$('#myModal').modal('show');
}
function removeThisItem(k){
	var r_val = $(k).attr('data-id');
	var conf = confirm('Are you sure to remove this advertisement?');
	if(conf){
		$.get(deleteurl,{id:r_val},function(data){ var data = JSON.parse(data); alert(data.message);refreshUrl(); })
	} 
}
function RemoteAPI2 (){
	return ad_picker_url;
}
function changeAjaxUrl(k){
	$("#AdvertisementItems_main_ad").val('').change();
	ad_picker_url  = ad_picker_url_base+'/'+$(k).val() ; 
}
$(function(){
$("#AdvertisementItems_main_ad").select2({
			  ajax: {
				url: function () {
				return  RemoteAPI2();
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
		});
		})
function  ajaxSubmitHappen3(form, data, hasError,saveUrl)
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
											$('#myModal').modal('hide');
											refreshUrl();
										 
											 
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
	function refreshUrl(){
	var containerID =  document.getElementById('upate');
	var page_url = refreUrl;
	if(page_url !== undefined){

	$.pjax({url: page_url , container:containerID,  timeout: 110000 ,cache:false   }).complete(function(){		});
	}
	}
function saveHead(k){
	$.get(saveHeadUrl,{value:$('.'+k).serialize()},function(data){ 
		var data = JSON.parse(data);
		if(data.status=='1'){
			alert(data.msg);
		}
	})
}
