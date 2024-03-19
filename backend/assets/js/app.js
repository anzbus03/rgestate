jQuery(document).ready(function($){
	
	ajaxData = {};
	if ($('meta[name=csrf-token-name]').length && $('meta[name=csrf-token-value]').length) {
			var csrfTokenName = $('meta[name=csrf-token-name]').attr('content');
			var csrfTokenValue = $('meta[name=csrf-token-value]').attr('content');
			ajaxData[csrfTokenName] = csrfTokenValue;
	}
	
	// input/select/textarea fields help text
	$('.has-help-text').popover();
	$(document).on('blur', '.has-help-text', function(e) {
		if ($(this).data('bs.popover')) {
			// this really doesn't want to behave correct unless forced this way!
			$(this).data('bs.popover').destroy();
			$('.popover').remove();
			$(this).popover();
		}
	});
	
	// buttons with loading state
	$('button.btn-submit').button().on('click', function(){
		$(this).button('loading');
	});
	
    $('.left-side').on('mouseenter', function(){
        $('.timeinfo').stop().fadeIn();
    }).on('mouseleave', function(){
        $('.timeinfo').stop().fadeOut();
    });
});
var allowSubmit = true;
function showAjaxModal(k)
        {
			if(baseUrl == undefined){   return false; }
            dataId = $(k).attr('data-id');
           
			var dataWidth = $(k).attr('data-width');
			if(dataWidth !== undefined){
				$('#modal-7').find('.modal-dialog').css('width',dataWidth);
			}
			else{
				$('#modal-7').find('.modal-dialog').css('width','800px');
			}
	 
			fieldid = $(k).attr('data-fieldid');
			dataRelation = $(k).attr('data-relation');
			dataRelation_id = $(k).attr('data-relation_id');
			disableEditer = $(k).attr('data-disableediter');
			fieldid = $(k).attr('data-fieldid');
			lan = ($(k).data('lan') == undefined) ? 'ar': $(k).data('lan') ;
			 
			$('#text').html($('#'+fieldid).val());
		 
			if(dataId==undefined) return false; 
            $('#modal-7').find('#modelContent').html('loading..');
            jQuery('#modal-7').modal('show', {backdrop: 'static'});

            jQuery.ajax({
                url: baseUrl+'/translate/addTerm/id/' + dataId+'/relation/'+dataRelation+'/relationID/'+dataRelation_id+'/disableEditer/'+disableEditer+'/lan/'+lan,
                success: function(response)
                {
					
				 
                    jQuery('#modal-7 #modelContent').html(response);
                }
            });
        }
var translatingFieldsObject;
function  saveFormFunction_grid_update(form, data, hasError )
{
	 
	form.find("button.btn-submit").html("loading");
    if(!hasError)
{

                                 $.ajax({

                                    "type":"POST",
									"url":form.attr('action'),
                                    "data":form.serialize(),
                                    "success":function(data){
										 
										if(parseInt(data) >= parseInt(1)){ 
											
										 
											if(translatingFieldsObject != undefined){
												var existingValues = translatingFieldsObject.val();
												translatingFieldsObject.val(existingValues+'|'+data);
											}
											form.find(".messageDiv").html('<div class="bg-success padding5px marginbottom5px" style=" margin:5px 16px;padding:8px 5px ">Successfully Translated </div>').show() ;
										    setTimeout(function(){   $('#modal-7').modal('hide'); }, 1000);
											 
										}
										else{
										    
										 	
											form.find("button.btn-submit").html("Save Changes");
											form.find(".messageDiv").html('<div class="bg-danger padding5px marginbottom5px"><input type="text" style="opacity:0; ;height: 0px;width:0px;" value="#" id="focuser">'+data+'</div>').show().focus();
										    $("#focuser").focus();
										    $(window).scrollTop(0);
										}
                                     },

                                  });
     }
      else
    { 
		form.find("button.btn-submit").button("reset");
        alert('error');
     }
 }
 function checkAllFunction(k,e){
	 e.stopPropagation();
	 e.preventDefault()
	 if($(k).is(':checked')){
		 $('.chk').prop('checked',true);
	 }
	 else{
		 	 $('.chk').prop('checked',false)
	 }
 }
  function applyTanslation(){
      $('tbody tr').each(function(){  
          var string_input = $(this).find("td:first").find('span').text() ; 
       
				 if( $(this).find('.chk').is(':checked')){
						 
							$(this).find('.inps').val(string_input);
						 
				 }
             
      })
         
    }
