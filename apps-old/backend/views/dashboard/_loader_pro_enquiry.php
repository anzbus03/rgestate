   
                 
                 
                
                 
                 
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Property Enquiry</h4>
      </div>
      <div class="modal-body" id="html_content2">
        <p>Loading...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
function loadthis2(k,e){
	e.preventDefault();
	var par = $(k).parent().parent().find('.fa-envelope-o'); 
 
	var href_url  = $(k).attr('href');
	$('#myModal2').modal('show');$('#html_content2').html('<p>Loading..</p>');
    
	$.get(href_url,function(data){ $('#html_content2').html(data);par.removeClass('fa-envelope-o');par.addClass('fa-envelope-open-o') ;  })
}

</script>
                 	 <?php 
				if(!empty($pro_enquiry)){
				  
					$this->renderPartial('_list_pro_enquiry',array('works'=>$pro_enquiry));
					
				 
				 
				echo '<div id="suggest_friends_last_id2"></div><div class="clearfix"></div>	';
				if(sizeOf($pro_enquiry) >= $limit){
				echo '<p class="text-center loadingDiv2"><a href="javascript:void(0)" onclick="checkScroll2();" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right">'. 'Load More' .'</a></p>';
				}
				}
				else{
				 	echo '<p class="text-center  ">No Data found</p>';
			
				}
			?>
                 
                 <script>
						var currentPage2 = 1;
 
	var slug2 ='<?php echo Yii::app()->createUrl('dashboard/fetch_pro');?>';

                 	var stopPagination;
	var loadingHtml2    	= '<a href="javascript:void(0)" class="disabled">Loading..</a>';
	var	loadMoreHtml2 	= '<a href="javascript:void(0)" class="btn   btn-primary  btn-shadow btn-rounded btn-icon-right" onclick="checkScroll2();"  id="refresh_list" > Load More </a>';  
	var afterFinishHtml2 = '';   
	var elementId2='slideSheet2';
	var appendId2='suggest_friends_last_id2';
	var scroll2=true;
	var limit2='<?php echo $limit;?>';
	var offest2='0';
	var formID2  = 'frmId';
	var checkFuture2 = true ;
	var stopPagination2  ;
	var loadingDiv2 ;
		$(document).ready(function () {
	loadingDiv2  =  $('.loadingDiv2');
	});
                 function checkScroll2() {
					  
						currentPage2++;
					 
						offset2 =  (currentPage2 - 1) * limit2   ;
					 
					jQuery.ajax(slug2+'?offset=' + offset2 + '&limit='+limit2,  { data		 : {formData: encodeURIComponent( $('#frmId').serialize()) } ,asynchronous:true, evalScripts:true, method:'get', 
						beforeSend: function(){
							  scroll2 = false;
							loadingDiv2.html(loadingHtml2);               
						},
						success: function(data, textStatus, jqXHR) {
							   
							if(data=='1') { stopPagination2 = false; loadingDiv2.html('');    }
							else{
							data = JSON.parse(data);
							$('#suggest_friends_last_id2').before(data.dataHtml);
						 loadingDiv2.html(loadMoreHtml2);   
							//$('#items_container').append(jQuery(data).find('#items_container').html());
							  scroll2 = true;
					 
							 
							}
							 
						 
					},});
					 
					}
                 
                 </script>
                 
                 
                 
