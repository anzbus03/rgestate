function changeForm(){
				$("form#frmId :input").change(function() {
				clearTimeout(timer_ajax);
				timer_ajax = setTimeout(function(){
						search_byAjax()
				}, 1500);
				});
				$('#locationInputs').autocomplete({
				serviceUrl: autoCompleteUrl,
				onSelect: function (suggestion) {
				$('#state').val(suggestion.state_id)
				$('#country').val(suggestion.country_id)
				$('#community_id').val(suggestion.community_id)

				}
				});
				$('#locationInputs').focus(function(){ $(this).select();})
				$(document).click(function(e) {
				if (!$(e.target).parents().andSelf().is('#frmId')) {
				$('#filterBarContainer').find('.miniHidden').removeClass('opened');
				}
				});
}
 
function removeAllFilters(){
			var  val_state = $('#state').val();
			var val_country = $('#country').val();
			$("form#frmId :input").val('');
			$('#state').val(val_state);
			 search_byAjax();alert(1)
}
$(function(){
			if($.fn.pjax){
				$.pjax.defaults.maxCacheLength = 0;
			}
	})
			function clickPginate(k,e){
				e.preventDefault();
				var containerID =  document.getElementById('map_locator');
				var page_url = $(k).attr('href');
						$('#dropdownBtn2').html('<i class="iconSpinner" style="margin-bottom:-2px;"></i>')
			$('#loader_againn').html('<i class="iconSpinner" style="margin-bottom:-2px;"></i> loading resiluts.Please wait...')
				if(page_url !== undefined){
				
					$.pjax({url: page_url , container:containerID,  timeout: 110000 ,cache:false   }).complete(function(){		});
				}
			}
				function search_byAjax(){ 
					console.log(5);
			var containerID =  document.getElementById('map_locator');
			formData = $('#frmId :input').serializeArray();
			  var mainListUrl1 = '';
			   var sec = ''; 
			   var category = ''; 
			  var city = ''; 
			  var locality = ''; 
			  var prime2 = '?'; 
			 
			 $.each(formData,function(k,v){
						if(v.value!=''){
							 if(v.name=='sec'){  }
							else  if(v.name=='type_of'){ category +=  'Property_'+v.value+'/'; ; }
							else if(v.name=='state'){ city +=  v.value+'/'; ; }
							else if(v.name=='locality'){ locality +=  'Locality_'+v.value+'/'; ; }
							else {
							// prime2+=  v.value+'/';
							prime2+= '&'+v.name+'='+v.value+'/';  
							}
							 
						}
						});
			mainListUrl1 = mainListUrl +      category+city+locality+prime2  ;	   
			$('#dropdownBtn2').html('<i class="iconSpinner" style="margin-bottom:-2px;"></i>')
			$('#loader_againn').html('<i class="iconSpinner" style="margin-bottom:-2px;"></i> '+loading_results)
			$.pjax({url: mainListUrl1 , container:containerID,  timeout: 110000 ,cache:false   }).complete(function(){		});
			 
			
			
			}
			
			
		 
			function setThisBedrromVal(k){
				var bdVal = $(k).attr('data-value');
				$('.bdtCls').find('.btnDefault').removeClass('btnSecondary');
				$(k).addClass('btnSecondary');
				$('#bed_val').val(bdVal).change();;
			}
            
			function setThisSEctionVal(k){
				var bdVal = $(k).attr('data-value');
				$('.secCls').find('.btnDefault').removeClass('btnSecondary');
				$(k).addClass('btnSecondary');
				$('#section_val').val(bdVal).change();;
			}
			function setThisBathroomVal(k){
				var bdVal = $(k).attr('data-value');
				$('.bedCls').find('.btnDefault').removeClass('btnSecondary');
				$(k).addClass('btnSecondary');
				$('#bath_val').val(bdVal).change();;
			}
			function setThisValueSort(k){
				var bdVal = $(k).val();
				$('#sort_val').val(bdVal).change();;
			}
			function setSteThis(k){
				var state = $(k).attr('data-state');
				var country = $(k).attr('data-country'); 
				$('#state').val(state);
				$('#country').val(country).change();;
			}
			function alertthisVal(k){
																	 $(k).parent().find('.selectLabel').text($(k).find("option:selected").text()) 
															 
																}
															
															 
														 
													
 	function scrollPagination(){
											 
										 
												delay = 1000;	 
										       clearInterval(scroll_Pagination5);
										   	   scroll_Pagination5 = setTimeout(function() {
										   	    $('#ldr').show();
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
												scroll 			: true,
												checkFuture		: true,
											 
                 
												});
										   	   }, delay);
 
}															
/* Mpa Section */
 
      
/* Mpa Section */
function setThisListingVal(k){
				var bdVal = $(k).attr('data-value');
				$('.bedCls').find('.btnDefault').removeClass('btnSecondary');
				$(k).addClass('btnSecondary');
				$('#listing_type').val(bdVal).change();;
			}
