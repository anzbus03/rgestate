   
                 
                 
                
                 
                 
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">General Enquiry</h4>
      </div>
      <div class="modal-body" id="html_content3">
        <p>Loading...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
function loadthis3(k,e){
	e.preventDefault();
	var href_url  = $(k).attr('href');
	var par = $(k).parent().parent().find('.fa-envelope-o'); 
 
	$('#myModal3').modal('show');$('#html_content3').html('<p>Loading..</p>');
	$.get(href_url,function(data){ $('#html_content3').html(data);par.removeClass('fa-envelope-o');par.addClass('fa-envelope-open-o') ;  })
}

</script>
                 	 <?php 
				if(!empty($general_enquiry)){
					$this->renderPartial('_list_general_enquiry',array('works'=>$general_enquiry));
					
				 
				 
				echo '<div id="suggest_friends_last_id3"></div><div class="clearfix"></div>	';
				if(sizeOf($general_enquiry) >= $limit){
				echo '<p class="text-center loadingDiv3"><a href="javascript:void(0)" onclick="checkScroll3();" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right">'. 'Load More' .'</a></p>';
				}
				}
				else{
				 	echo '<p class="text-center  ">No Data found</p>';
			
				}
			?>
                 
                 <script>
						var currentPage3 = 1;
 
	var slug3 ='<?php echo Yii::app()->createUrl('dashboard/fetch_general');?>';

                 	var stopPagination3;
	var loadingHtml3    	= '<a href="javascript:void(0)" class="disabled">Loading..</a>';
	var	loadMoreHtml3 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right" onclick="checkScroll3();"  id="refresh_list" > Load More </a>';  
 
	var elementId3='slideSheet3';
	var appendId3='suggest_friends_last_id3';
	var scroll3=true;
	var limit3='<?php echo $limit;?>';
	var offest3='0';
	var formID3  = 'frmId';
	var checkFuture3 = true ;
	var stopPagination3  ;
	var loadingDiv3 ;
		$(document).ready(function () {
	loadingDiv3  =  $('.loadingDiv3');
	});
                 function checkScroll3() {
					  
						currentPage3++;
					 
						offset3 =  (currentPage3 - 1) * limit3   ;
					 
					jQuery.ajax(slug3+'?offset=' + offset3 + '&limit='+limit3,  { data		 : {formData: encodeURIComponent( $('#frmId').serialize()) } ,asynchronous:true, evalScripts:true, method:'get', 
						beforeSend: function(){
							  scroll3 = false;
							loadingDiv3.html(loadingHtml3);               
						},
						success: function(data, textStatus, jqXHR) {
							   
							if(data=='1') { stopPagination3 = false; loadingDiv3.html('');    }
							else{
							data = JSON.parse(data);
							$('#suggest_friends_last_id3').before(data.dataHtml);
						 loadingDiv3.html(loadMoreHtml3);   
							//$('#items_container').append(jQuery(data).find('#items_container').html());
							  scroll3 = true;
					 
							 
							}
							 
						 
					},});
					 
					}
                 
                 </script>
                 
                 
                 
