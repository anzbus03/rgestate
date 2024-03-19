							<script>
							var detect_location = '<?php echo Yii::app()->createUrl('user/detectlocation');?>';
							function opendetectLocation(){

							$("#myModal3").modal("show");

							$("#raw_ht_ml").html('<iframe id="ifrm"   class="mframe" ></iframe>'),document.getElementById("ifrm").src=detect_location;


							}
							adreesField  = ''; successtest  = '';

							function closePopup2(){  $('#myModal3').modal('hide');  $('#ListingUsers_address').val(adreesField); setTimeout(function(){  successAlert('success',successtest); }, 1500); }

							</script>
 <div id="myModal3" class="modal fade" data-backdrop="static"  role="dialog" aria-labelledby="myModal3Label" aria-hidden="true" style="margin-right:0px">
     
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
     
      <div class="modal-body" id="cn_propertys">
       <div class=" " id="raw_ht_ml" style="">
		<p>Loading...</p>
		</div>
		<div class="clearfix"></div>
      </div>
    
    </div>
  </div>
</div>  
 <style>.mframe {
    min-height: 550px;
}
.isOnFram .container.card-1 { padding:0px !important; }
</style>
