 <style>
 .dasbrd .col-xl-4 { width:33.333333% !important;}
 span.det-sn { color:#bbb; font-weight:normal; font-size:15px; }
     @media only screen and (max-width: 600px) {
  .posingpackge  a.button7{
     width:100%!important;max-width:100% !important;margin-bottom:0px;
  }
  .margin-bottom-15.mob-no-m{ margin-bottom:0px!important; }
  .posingpackge .col-sm-6 { margin-bottom:20px; }
  .accounb-dic {
    float: none;
    background: #eee;
    padding: 15px 10px;
    border-radius: 4px;
}
}
     .border-left-primary {
    border-left: .25rem solid #4e73df !important;
}.border-left-success {
    border-left: .25rem solid #1cc88a !important;
}.border-left-info {
    border-left: .25rem solid #36b9cc !important;
}.border-left-warning {
    border-left: .25rem solid #f6c23e !important;
}
.dasbrd .card .card-body {
    padding: 6px 20px;
}#js-legend2 ul li {
       width: auto !important;
    line-height: 1.5;
    margin-right:5px !important;
    float: left;
}#js-legend2 ul li span{
    
    display: inline-block;
    width: 29px;
    height: 11px;
    margin-right: 5px;
}
.dasbrd .card { border:0px !important; box-shadow:unset !important; }
.card-body-sep { min-height:320px; }.warning{ font-weight:600;}
 </style>
	<div class="clearfix"></div>
	<?php
	if(!empty($this->member->parent_user) ){ ?> 
	<div class="  margin-bottom-20">
		<div style="width:50px;height:50px; " class="pull-left"><img src="<?php echo $this->parent_member->getAvatarUrl( 124, '',  true); ?>" /></div>
		<div style="width:calc(100% - 60px);" class="pull-right"><div class="warning"><?php echo $this->tag->getTag('company','Company');?>:</div><p><?php echo $this->parent_member->companyName;?></p></div>
		<div class="clearfix"></div>
		</div>
	<?php } ?> 
	
	<div class="clearfix"></div>
	<div class="">
	<?php
	if(empty($this->member->parent_user)){
	if($this->member->user_type == 'P' and (empty($this->member->property_t) or empty($this->member->property_a)) ){
		?>
		<div class="  margin-bottom-20">
		<div style="width:50px;height:50px;" class="pull-left"><svg id="Capa_1" enable-background="new 0 0 512 512" height="100%" viewBox="0 0 512 512" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0"><stop offset="0" stop-color="#ffe59a"/><stop offset="1" stop-color="#ffffd5"/></linearGradient><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="407" y2="105"><stop offset="0" stop-color="#ffde00"/><stop offset="1" stop-color="#fd5900"/></linearGradient><g><g><circle cx="256" cy="256" fill="url(#SVGID_1_)" r="256"/></g><g><g><path d="m309.25 105.898v52.396h52.353c-3.929-27.125-25.25-48.463-52.353-52.396zm-71 150.102v44.412h35.5v-44.412c0-4.91 3.969-8.882 8.875-8.882h5.2l-31.825-31.852-31.825 31.852h5.2c4.906 0 8.875 3.972 8.875 8.882zm62.125-79.941c-4.906 0-8.875-3.973-8.875-8.882v-62.177h-133.125c-4.906 0-8.875 3.973-8.875 8.882v284.235c0 4.91 3.969 8.882 8.875 8.882h195.25c4.906 0 8.875-3.973 8.875-8.882v-222.058zm-103.9 73.661 53.25-53.294c3.467-3.47 9.083-3.47 12.55 0l53.25 53.294c2.54 2.542 3.302 6.358 1.924 9.68-1.369 3.322-4.611 5.482-8.199 5.482h-17.75v44.412c0 4.909-3.969 8.882-8.875 8.882h-53.25c-4.906 0-8.875-3.973-8.875-8.882v-44.412h-17.75c-3.588 0-6.83-2.16-8.199-5.482-1.378-3.322-.615-7.139 1.924-9.68zm130.525 95.103c0 4.91-3.969 8.882-8.875 8.882h-124.25c-4.906 0-8.875-3.973-8.875-8.882v-17.765c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882v8.882h106.5v-8.882c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882z" fill="url(#SVGID_2_)"/></g></g></g></svg></div>
		<div style="width:calc(100% - 60px); " class="pull-right"><div class="warning"><?php echo $this->tag->getTag('warning','Warning');?>:</div><p>
			<?php 
			if(empty($this->member->property_t) and empty($this->member->property_a)){
			echo  $this->tag->getTag('upload_property_title_deed,_au','Upload Property Title Deed, Authorization Letter.');
			}
			else if(empty($this->member->property_t)){
				echo  $this->tag->getTag('upload_property_title_deed. ','Upload Property Title Deed.');
			}
			else if(empty($this->member->property_a)){
				echo  $this->tag->getTag('upload_authorization_letter.','Upload Authorization Letter.');
			}
			?>
			 <a href="<?php echo Yii::app()->createUrl('member/update_profile');?>"><?php echo  $this->tag->getTag('click_here_to_update','Click here to update');?></a></p></div>
		<div class="clearfix"></div>
		</div>
		<?php
	}
	if(in_array($this->member->user_type,array('A','C','D','M')) and (empty($this->member->cr_number) or empty($this->member->u_crdoc)) ){
		?>
		<div class="  margin-bottom-20">
		<div style="width:50px;height:50px;" class="pull-left"><svg id="Capa_1" enable-background="new 0 0 512 512" height="100%" viewBox="0 0 512 512" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0"><stop offset="0" stop-color="#ffe59a"/><stop offset="1" stop-color="#ffffd5"/></linearGradient><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="407" y2="105"><stop offset="0" stop-color="#ffde00"/><stop offset="1" stop-color="#fd5900"/></linearGradient><g><g><circle cx="256" cy="256" fill="url(#SVGID_1_)" r="256"/></g><g><g><path d="m309.25 105.898v52.396h52.353c-3.929-27.125-25.25-48.463-52.353-52.396zm-71 150.102v44.412h35.5v-44.412c0-4.91 3.969-8.882 8.875-8.882h5.2l-31.825-31.852-31.825 31.852h5.2c4.906 0 8.875 3.972 8.875 8.882zm62.125-79.941c-4.906 0-8.875-3.973-8.875-8.882v-62.177h-133.125c-4.906 0-8.875 3.973-8.875 8.882v284.235c0 4.91 3.969 8.882 8.875 8.882h195.25c4.906 0 8.875-3.973 8.875-8.882v-222.058zm-103.9 73.661 53.25-53.294c3.467-3.47 9.083-3.47 12.55 0l53.25 53.294c2.54 2.542 3.302 6.358 1.924 9.68-1.369 3.322-4.611 5.482-8.199 5.482h-17.75v44.412c0 4.909-3.969 8.882-8.875 8.882h-53.25c-4.906 0-8.875-3.973-8.875-8.882v-44.412h-17.75c-3.588 0-6.83-2.16-8.199-5.482-1.378-3.322-.615-7.139 1.924-9.68zm130.525 95.103c0 4.91-3.969 8.882-8.875 8.882h-124.25c-4.906 0-8.875-3.973-8.875-8.882v-17.765c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882v8.882h106.5v-8.882c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882z" fill="url(#SVGID_2_)"/></g></g></g></svg></div>
		<div style="width:calc(100% - 60px); " class="pull-right"><div class="warning"><?php echo $this->tag->getTag('warning','Warning');?>:</div><p>
			<?php if(empty($this->member->cr_number) and empty($this->member->u_crdoc)){ 
				echo $this->tag->getTag( 'update_commercial_registration','Update Commercial Registration No., Upload Commercial Registration.');
				}else if(empty($this->member->cr_number)){
					echo $this->tag->getTag( 'update_commercial_registrati_2','Update Commercial Registration No.');
				}
				else if(empty($this->member->u_crdoc)){
					echo $this->tag->getTag('upload_commercial_registration', 'Upload Commercial Registration.');
				}
				?>
				 <a href="<?php echo Yii::app()->createUrl('member/update_profile');?>"><?php echo  $this->tag->getTag('click_here_to_update','Click here to update');?></a></p></div>
		<div class="clearfix"></div>
		</div>
		<?php
	}
	}
	if(empty($plans)){
		?>
			<div class="  margin-bottom-20">
		<div style="width:50px;height:50px; " class="pull-left"><svg id="Capa_1" enable-background="new 0 0 512 512" height="100%" viewBox="0 0 512 512" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0"><stop offset="0" stop-color="#ffe59a"/><stop offset="1" stop-color="#ffffd5"/></linearGradient><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="407" y2="105"><stop offset="0" stop-color="#ffde00"/><stop offset="1" stop-color="#fd5900"/></linearGradient><g><circle cx="256" cy="256" fill="url(#SVGID_1_)" r="256"/><g><g><path d="m300.412 247.118c-29.388 0-53.294 23.906-53.294 53.294s23.906 53.294 53.294 53.294 53.294-23.906 53.294-53.294-23.906-53.294-53.294-53.294zm25.12 65.854c3.47 3.47 3.47 9.091 0 12.56s-9.09 3.47-12.56 0l-12.56-12.56-12.56 12.56c-3.47 3.469-9.09 3.47-12.56 0s-3.47-9.091 0-12.56l12.56-12.56-12.56-12.56c-3.47-3.47-3.47-9.091 0-12.56 3.47-3.47 9.091-3.47 12.56 0l12.56 12.56 12.56-12.56c3.47-3.47 9.09-3.47 12.56 0s3.47 9.091 0 12.56l-12.56 12.56zm-65.559-135.976 22.674 11.337v-83.333h-53.294v83.333l22.674-11.337c2.498-1.249 5.448-1.249 7.946 0zm138.145-71.996h-97.706v97.758c0 4.901-3.973 8.882-8.882 8.882-1.744 0-3.374-.503-4.745-1.37l-30.785-15.397-31.557 15.778c-2.767 1.362-6.029 1.24-8.639-.39-2.62-1.622-4.216-4.476-4.216-7.555v-97.706h-97.706c-4.91 0-8.882 3.973-8.882 8.882v284.235c0 4.91 3.973 8.882 8.882 8.882h284.235c4.91 0 8.882-3.973 8.882-8.882v-284.235c.001-4.909-3.972-8.882-8.881-8.882zm-213.177 266.471h-35.529c-4.91 0-8.882-3.973-8.882-8.882s3.973-8.882 8.882-8.882h35.529c4.91 0 8.882 3.973 8.882 8.882.001 4.909-3.972 8.882-8.882 8.882zm0-35.53h-35.529c-4.91 0-8.882-3.973-8.882-8.882 0-4.91 3.973-8.882 8.882-8.882h35.529c4.91 0 8.882 3.973 8.882 8.882.001 4.909-3.972 8.882-8.882 8.882zm115.471 35.53c-39.181 0-71.059-31.878-71.059-71.059s31.878-71.059 71.059-71.059 71.059 31.878 71.059 71.059-31.878 71.059-71.059 71.059z" fill="url(#SVGID_2_)"/></g></g></g></svg></div>
		<div style="width:calc(100% - 60px);" class="pull-right"><div class="warning"><?php echo $this->tag->getTag('warning','Warning');?>:</div><p><?php echo  $this->tag->getTag('no_subscription_plan_active.','No Subscription plan active.');?> <a href="<?php echo Yii::app()->createUrl('member/addons');?>"><?php echo  $this->tag->getTag('click_here_to_subscribe','Click here to subscribe');?></a></p></div>
		<div class="clearfix"></div>
		</div>
		<?
	}
	?>	
	</div>
	<div class="clearfix"></div>
 <?php
  if(empty($this->member->latitude) and $this->member->user_type !='U'){
	  /*
	 ?><script>$(function(){ opendetectLocation(); })</script><?
	 $this->renderPartial('//user/_update_location_script');
	 * */
 }
 
 if(!empty($plans)){
	 $this->renderPartial('_active_plan_dashboard');
 }
 else{
	 ?>
	  <div class="margin-bottom-15 mob-no-m">
	 <div class="row  posingpackge">
 <div class="col-sm-3 ">
	<a href="<?php echo Yii::app()->createUrl('member/addons');?>" class="button7"  >
					<span ><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/afav.png');?>"></span>
					<?php echo $this->tag->getTag('subscribe_packages','Subscribe Packages');?>
				</a>
			 <a href="<?php echo Yii::app()->createUrl('member/orders');?>" style="display: block;text-decoration: underline;/*! letter-spacing: 1.1px; */font-size: 16px;color:#000"><i class="fa fa-history"></i> <?php echo $this->tag->getTag('order_history','Order History');?></a>
				
				</div>
		</div>		
		</div>		
	 <?php
 }
 
   
