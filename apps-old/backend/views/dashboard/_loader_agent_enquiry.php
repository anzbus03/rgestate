   
                 
                 
                
                 
                 
<div id="myModal6" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Realtor Enquiry</h4>
      </div>
      <div class="modal-body" id="html_content6">
        <p>Loading...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
function loadthis6(k,e){
	e.preventDefault();
	var href_url  = $(k).attr('href');
	var par = $(k).parent().parent().find('.fa-envelope-o'); 
 
	$('#myModal6').modal('show');$('#html_content6').html('<p>Loading..</p>');
	$.get(href_url,function(data){ $('#html_content6').html(data);par.removeClass('fa-envelope-o');par.addClass('fa-envelope-open-o') ;  })
}

</script>
                 	 <?php 
				if(!empty($agent_enquiry)){
					$this->renderPartial('_list_agent_enquiry',array('works'=>$agent_enquiry));
					
				 
				 
				echo '<div id="suggest_friends_last_id6"></div><div class="clearfix"></div>	';
				if(sizeOf($agent_enquiry) >= $limit){
				echo '<p class="text-center loadingDiv6"><a href="javascript:void(0)" onclick="checkScroll6()" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right">'. 'Load More' .'</a></p>';
				}
				}
				else{
				 	echo '<p class="text-center  ">No Data found</p>';
			
				}
			?>
                 
                 <script>
						var currentPage6 = 1;
 
	var slug6 ='<?php echo Yii::app()->createUrl('dashboard/fetch_agent_enquiry');?>';

                 	var stopPagination6;
	var loadingHtml6    	= '<a href="javascript:void(0)" class="disabled">Loading..</a>';
	var	loadMoreHtml6 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right" onclick="checkScroll6()"  id="refresh_list" > Load More </a>';  
 
	var elementId6='slideSheet6';
	var appendId6='suggest_friends_last_id6';
	var scroll6=true;
	var limit6='<?php echo $limit;?>';
	var offest6='0';
	var formID6  = 'frmId';
	var checkFuture6 = true ;
	var stopPagination6  ;
	var loadingDiv6 ;
		$(document).ready(function () {
	loadingDiv6  =  $('.loadingDiv6');
	});
 
                 function checkScroll6() {
						currentPage6++;
					 
						offset6 =  (currentPage6 - 1) * limit6   ;
					 
					jQuery.ajax(slug6+'?offset=' + offset6 + '&limit='+limit6,  { data		 : {formData: encodeURIComponent( $('#frmId').serialize()) } ,asynchronous:true, evalScripts:true, method:'get', 
						beforeSend: function(){
							  scroll6 = false;
							loadingDiv6.html(loadingHtml6);               
						},
						success: function(data, textStatus, jqXHR) {
							   
							if(data=='1') { stopPagination6 = false; loadingDiv6.html('');    }
							else{
							data = JSON.parse(data);
							$('#suggest_friends_last_id6').before(data.dataHtml);
						 loadingDiv6.html(loadMoreHtml6);   
							//$('#items_container').append(jQuery(data).find('#items_container').html());
							  scroll6 = true;
					 
							 
							}
							 
						 
					},});
					 
					}
                 
                 </script>
                 
                 
                 
