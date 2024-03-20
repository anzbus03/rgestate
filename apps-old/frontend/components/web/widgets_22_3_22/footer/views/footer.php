<?php  $app = Yii::app(); $options = $app->options;  
$this->render('_new_footer2',compact('app','options','conntroller'));
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
        <button type="button" class="close" style="opacity:1;width:30px;" data-dismiss="modal"><img src="<?php echo $app->apps->getBaseUrl('assets/img/cancel.png');?>"></button>
        <h4 class="modal-title" id="myModal2-title"><?php echo $conntroller->tag->getTag('contact_for_more_information', 'Contact For more information.') ;?></h4>
      </div>
      <div class="modal-body" id="cn_property">
        <p><?php echo   $conntroller->tag->getTag('loading','loading...') ;?></p>
      </div>
    
    </div>
  </div>
</div>  

<div id="myModal6" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close rd-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModal2-title" style="text-align: center;"><?php echo  $conntroller->tag->getTag('home_finance_calculator','HOME FINANCE') ;?></h4>
      </div>
      <div class="modal-body" id="cn_application">
        <p><?php echo    $conntroller->tag->getTag('loading','Loading....') ;?></p>
      </div>
    
    </div>
  </div>
</div>  

<script>
	var loading_results = 'loading results. Please wait...';
	var propertyUrl = '<?php echo $conntroller->app->createUrl('detail/contact_property');?>';
	var agentUrl = '<?php echo $conntroller->app->createUrl('user_listing/contact_agent');?>';
	var reportUrl = '<?php echo $conntroller->app->createUrl('user_listing/report_ad');?>';
   var windowpopup = false;
     var other_statistics = '<?php echo $conntroller->app->createUrl('articles/statistics');?>';
	user_login_url = '<?php echo $conntroller->app->createUrl('user/load_signin_form');?>';
	var login_option = '<?php echo $conntroller->app->createUrl('user/signin_popup');?>';
	var login_option1 = '<?php echo  $conntroller->app->createUrl('user/signin');?>';
	var statistics  = '<?php echo Yii::app()->createUrl('articles/statistics');?>';
	var user_details_info_url = '<?php echo $conntroller->app->createUrl('user/partialInfo');?>';
	add_to_fav = '<?php echo $conntroller->app->createUrl('user/add_to_fav');?>';
	 
   </script>
   <div class="loadCnter"><div class="nspinerr"></div></div>
   <div id="myModal3" class="modal fade" data-backdrop="static"  role="dialog" aria-labelledby="myModal3Label" aria-hidden="true">
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
   <div id="myModal31" class="modal fade" data-backdrop="static"  role="dialog" aria-labelledby="myModal31Label" aria-hidden="true">
     
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close rd-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModal2-title"><?php echo  'Report AD' ;?></h4>
      </div>
      <div class="modal-body" id="report_porperty">
       <div class=" " id="report_porperty_ht_ml" style="">
		<p>Loading...</p>
		</div>
		<div class="clearfix"></div>
      </div>
    
    </div>
  </div>
</div>  

   <?php
   if($conntroller->app->user->getId()){
	   if($conntroller->mem->o_verified=='1'){ 
	   ?><script>   user_defined = true; </script><?
	   }
   }
   ?> 
  
