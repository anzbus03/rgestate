<?php  $app = Yii::app(); $options = $app->options;  
if($conntroller->quicklinks=='1'){  
$this->render('quicklinks');
}

$this->render('_new_footer',compact('app','options','conntroller'));
$this->render('svg');
// $this->render('_old_footer');
 ?>

<script>
	user_login_url = '<?php echo Yii::app()->createUrl('user/load_signin_form');?>';
	add_to_fav = '<?php echo Yii::app()->createUrl('user/add_to_fav');?>';
   </script>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close rd-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo  'Send Enquiry' ;?></h4>
      </div>
      <div class="modal-body" id="cn_property">
        <p><?php echo  'loading....' ;?></p>
      </div>
    
    </div>
  </div>
</div>  
<script>
	var loading_results = 'loading results. Please wait...';
    function OpenFormClick(k){
    var idAd = $(k).attr('data-reactid');
    if(idAd===undefined){ return false;}
    $('#myModal2').modal('show');$('#cn_property').html('<?php echo  'loading....' ;?>');
    $.get('<?php echo Yii::App()->createUrl('detail/contact_property');?>/id/'+idAd,function(data){ $('#cn_property').html(data);  })
    }
</script>
 
  <script>
	user_login_url = '<?php echo $conntroller->app->createUrl('user/load_signin_form');?>';
	add_to_fav = '<?php echo $conntroller->app->createUrl('user/add_to_fav');?>';
	 
   </script>
   <?php
   if(!$conntroller->app->user->getId()){
	   ?>
	   <div id="loginModalNew" class="modal modalResponsive box backgroundBasic   phn beingModal" style="display: none;;padding-top: 0px;height:auto !important;;;overflow-y:auto;overflow-x:hidden;">
		<div class="boxBody pal" style="position:relative;">
		<h2 style="position: absolute; top: -5px; width: 100%; background: 	left: 0px; padding: 10px;"> </h2>
		<button class="boxClose" data-role="popup_close" onclick="closePopUpThis()">
		<span class="typeLowlight loginModalNewClose" role="presentation">×</span>
		<span class="hideVisually">Close</span>
		</button>
		<div data-role="popupBody" >
		<div class="">
		<div style="text-align: center;">
			<img src="<?php echo Yii::App()->apps->getBaseUrl('assets/img/logo-white.jpg');?>" style="height:37px;margin-bottom:10px;">
			<div></div>
			<span style="font-size: 33px;">Sign in or register</span><br />
<span style="font-size: 18px;border-bottom:1px solid #333;">to save your favorite property</span></div>
		<div class="mbl txtC h5">
		</div>
		<div class=" " id="raw_ht_ml" style="">
		<p>Loading...</p>
		</div>
		</div>

		</div>
		<div style="clear:both"></div>
		</div>
		</div>
	   <?
   }
   else{
	   ?><script>   user_defined = true; </script><?
   }
   ?> 
<script>
function toggleBody() {

  if (jQuery('body').hasClass('menuIsActive')) {
    jQuery('body').removeClass('menuIsActive');
  } else {
    jQuery('body').addClass('menuIsActive');
  }
}
</script>