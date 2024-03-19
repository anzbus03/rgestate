var ajaxCommunityUrl;
var ajaxCustomerUrl;
var ajaxDistrictUrl;
var ajaxSubCommunityUrl;
function RemoteAPI(){
	return ajaxCommunityUrl;
}
$(function(){
 
					 
		  $(".autoSelect_community").select2({
			  ajax: {
				url: function () {
				return  RemoteAPI();
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
		  $(".autoSelect_district").select2({
			  ajax: {
			  url:  ajaxDistrictUrl,
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
		  $(".autoSelect_customer").select2({
			  ajax: {
			  url:  ajaxCustomerUrl,
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
		$(".autoSelect_sub_community").select2();
	
	
	})
	function getSubCommunity(k){
			UrlForAjx =  ajaxSubCommunityUrl+'/id/'+$(k).val();
		 
		   $(".autoSelect_sub_community").empty();
		   $(".autoSelect_sub_community").select2({
			  ajax: {
			  url:  UrlForAjx,
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
	}
