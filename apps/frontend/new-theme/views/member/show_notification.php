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
	<div class="">
	<?php
		if($this->member->user_type == 'P' and (empty($this->member->property_t) or empty($this->member->property_a)) ){
		?>
		<div class="  margin-bottom-20">
		<div style="width:50px;height:50px;float:left;"><svg id="Capa_1" enable-background="new 0 0 512 512" height="100%" viewBox="0 0 512 512" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0"><stop offset="0" stop-color="#ffe59a"/><stop offset="1" stop-color="#ffffd5"/></linearGradient><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="407" y2="105"><stop offset="0" stop-color="#ffde00"/><stop offset="1" stop-color="#fd5900"/></linearGradient><g><g><circle cx="256" cy="256" fill="url(#SVGID_1_)" r="256"/></g><g><g><path d="m309.25 105.898v52.396h52.353c-3.929-27.125-25.25-48.463-52.353-52.396zm-71 150.102v44.412h35.5v-44.412c0-4.91 3.969-8.882 8.875-8.882h5.2l-31.825-31.852-31.825 31.852h5.2c4.906 0 8.875 3.972 8.875 8.882zm62.125-79.941c-4.906 0-8.875-3.973-8.875-8.882v-62.177h-133.125c-4.906 0-8.875 3.973-8.875 8.882v284.235c0 4.91 3.969 8.882 8.875 8.882h195.25c4.906 0 8.875-3.973 8.875-8.882v-222.058zm-103.9 73.661 53.25-53.294c3.467-3.47 9.083-3.47 12.55 0l53.25 53.294c2.54 2.542 3.302 6.358 1.924 9.68-1.369 3.322-4.611 5.482-8.199 5.482h-17.75v44.412c0 4.909-3.969 8.882-8.875 8.882h-53.25c-4.906 0-8.875-3.973-8.875-8.882v-44.412h-17.75c-3.588 0-6.83-2.16-8.199-5.482-1.378-3.322-.615-7.139 1.924-9.68zm130.525 95.103c0 4.91-3.969 8.882-8.875 8.882h-124.25c-4.906 0-8.875-3.973-8.875-8.882v-17.765c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882v8.882h106.5v-8.882c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882z" fill="url(#SVGID_2_)"/></g></g></g></svg></div>
		<div style="width:calc(100% - 60px);float:right;"><div class="warning"><?php echo $this->tag->getTag('warning','Warning');?>:</div><p>
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
	else if(in_array($this->member->user_type,array('A','C','D','M')) and (empty($this->member->cr_number) or empty($this->member->u_crdoc)) ){
		?>
		<div class="  margin-bottom-20">
		<div style="width:50px;height:50px;float:left;"><svg id="Capa_1" enable-background="new 0 0 512 512" height="100%" viewBox="0 0 512 512" width="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="512" y2="0"><stop offset="0" stop-color="#ffe59a"/><stop offset="1" stop-color="#ffffd5"/></linearGradient><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="407" y2="105"><stop offset="0" stop-color="#ffde00"/><stop offset="1" stop-color="#fd5900"/></linearGradient><g><g><circle cx="256" cy="256" fill="url(#SVGID_1_)" r="256"/></g><g><g><path d="m309.25 105.898v52.396h52.353c-3.929-27.125-25.25-48.463-52.353-52.396zm-71 150.102v44.412h35.5v-44.412c0-4.91 3.969-8.882 8.875-8.882h5.2l-31.825-31.852-31.825 31.852h5.2c4.906 0 8.875 3.972 8.875 8.882zm62.125-79.941c-4.906 0-8.875-3.973-8.875-8.882v-62.177h-133.125c-4.906 0-8.875 3.973-8.875 8.882v284.235c0 4.91 3.969 8.882 8.875 8.882h195.25c4.906 0 8.875-3.973 8.875-8.882v-222.058zm-103.9 73.661 53.25-53.294c3.467-3.47 9.083-3.47 12.55 0l53.25 53.294c2.54 2.542 3.302 6.358 1.924 9.68-1.369 3.322-4.611 5.482-8.199 5.482h-17.75v44.412c0 4.909-3.969 8.882-8.875 8.882h-53.25c-4.906 0-8.875-3.973-8.875-8.882v-44.412h-17.75c-3.588 0-6.83-2.16-8.199-5.482-1.378-3.322-.615-7.139 1.924-9.68zm130.525 95.103c0 4.91-3.969 8.882-8.875 8.882h-124.25c-4.906 0-8.875-3.973-8.875-8.882v-17.765c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882v8.882h106.5v-8.882c0-4.91 3.969-8.882 8.875-8.882s8.875 3.973 8.875 8.882z" fill="url(#SVGID_2_)"/></g></g></g></svg></div>
		<div style="width:calc(100% - 60px);float:right;"><div class="warning"><?php echo $this->tag->getTag('warning','Warning');?>:</div><p>
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
	else{
		if(!empty($this->member->parent_user) ){
			if(empty($this->parent_member->is_verified)){
			 ?>
			 <div class="  margin-bottom-20">
		<div style="width:50px;height:50px;float:left;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="100%" height="100%" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <path xmlns="http://www.w3.org/2000/svg" style="" d="M149.944,101.607l-29.896-29.958c-6.935-6.949-16.16-10.775-25.977-10.775 c-9.817,0-19.042,3.827-25.976,10.775L46.424,93.367c-14.265,14.293-14.265,37.551,0,51.845l29.959,30.021 c2.93,2.936,6.773,4.404,10.618,4.404c3.833,0,7.668-1.461,10.596-4.382c5.864-5.852,46.47-46.591,52.326-52.435 C155.786,116.969,155.796,107.472,149.944,101.607z" fill="#105c6e" data-original="#105c6e"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,3c-8.284,0-15,6.716-15,15v48c0,8.284,6.716,15,15,15c8.284,0,15-6.716,15-15V18 C271,9.716,264.284,3,256,3z" fill="#26879c" data-original="#26879c"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M293,0h-74c-8.284,0-15,6.716-15,15s6.716,15,15,15h74c8.284,0,15-6.716,15-15S301.284,0,293,0z" fill="#de513c" data-original="#de513c"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,0h-37c-8.284,0-15,6.716-15,15s6.716,15,15,15h37V0z" fill="#fc6249" data-original="#fc6249"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M418.645,118.615C375.203,75.083,317.441,51.108,256,51.108S136.797,75.083,93.355,118.615 c-43.434,43.524-67.354,101.391-67.354,162.939s23.92,119.415,67.354,162.939C136.797,488.025,194.559,512,256,512 s119.203-23.975,162.645-67.507c43.434-43.524,67.354-101.391,67.354-162.939S462.079,162.139,418.645,118.615z" fill="#de513c" data-original="#de513c"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,51.108c-61.441,0-119.203,23.975-162.645,67.507c-43.434,43.524-67.354,101.391-67.354,162.939 s23.92,119.415,67.354,162.939C136.797,488.025,194.559,512,256,512V51.108z" fill="#fc6249" data-original="#fc6249"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,108.538c-95.218,0-172.684,77.614-172.684,173.015S160.782,454.569,256,454.569 s172.684-77.615,172.684-173.016S351.218,108.538,256,108.538z" fill="#96d1d9" data-original="#96d1d9"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,108.538c-95.218,0-172.684,77.614-172.684,173.015S160.782,454.569,256,454.569V108.538z" fill="#f4f2e6" data-original="#f4f2e6"/> <g xmlns="http://www.w3.org/2000/svg"> <path style="" d="M256,146.007c8.284,0,15-6.716,15-15v-21.808c-4.945-0.428-9.946-0.66-15-0.66 c-5.054,0-10.055,0.232-15,0.66v21.808C241,139.291,247.716,146.007,256,146.007z" fill="#105c6e" data-original="#105c6e"/> <path style="" d="M256,417.101c-8.284,0-15,6.716-15,15v21.808c4.945,0.428,9.946,0.66,15,0.66 c5.054,0,10.055-0.232,15-0.66v-21.808C271,423.817,264.284,417.101,256,417.101z" fill="#105c6e" data-original="#105c6e"/> <path style="" d="M428.028,266.554h-21.481c-8.284,0-15,6.716-15,15s6.716,15,15,15h21.481 c0.426-4.945,0.656-9.946,0.656-15S428.454,271.499,428.028,266.554z" fill="#105c6e" data-original="#105c6e"/> <path style="" d="M120.453,281.554c0-8.284-6.716-15-15-15H83.972c-0.426,4.945-0.656,9.946-0.656,15 s0.23,10.055,0.656,15h21.481C113.737,296.554,120.453,289.838,120.453,281.554z" fill="#105c6e" data-original="#105c6e"/> <path style="" d="M293,272.897h-21.162V212.23c0-8.284-6.716-15-15-15c-8.284,0-15,6.716-15,15v75.667 c0,8.284,6.716,15,15,15H293c8.284,0,15-6.716,15-15S301.284,272.897,293,272.897z" fill="#105c6e" data-original="#105c6e"/> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg></div>
		<div style="width:calc(100% - 60px);float:right;"><div class="warning text-danger"><?php echo $this->tag->getTag('info','Info');?>:</div><p  class="text-danger"><?php echo $this->tag->getTag('account_waiting_for_admin_veri','Account Waiting for Admin Verification');?></p></div>
		<div class="clearfix"></div>
		</div>
			 
			 <?php
			}
		}
		else if(empty($this->member->is_verified)){
			 ?>
			 	 <div class="  margin-bottom-20">
		<div style="width:50px;height:50px;float:left;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="100%" height="100%" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"><g> <path xmlns="http://www.w3.org/2000/svg" style="" d="M149.944,101.607l-29.896-29.958c-6.935-6.949-16.16-10.775-25.977-10.775 c-9.817,0-19.042,3.827-25.976,10.775L46.424,93.367c-14.265,14.293-14.265,37.551,0,51.845l29.959,30.021 c2.93,2.936,6.773,4.404,10.618,4.404c3.833,0,7.668-1.461,10.596-4.382c5.864-5.852,46.47-46.591,52.326-52.435 C155.786,116.969,155.796,107.472,149.944,101.607z" fill="#105c6e" data-original="#105c6e"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,3c-8.284,0-15,6.716-15,15v48c0,8.284,6.716,15,15,15c8.284,0,15-6.716,15-15V18 C271,9.716,264.284,3,256,3z" fill="#26879c" data-original="#26879c"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M293,0h-74c-8.284,0-15,6.716-15,15s6.716,15,15,15h74c8.284,0,15-6.716,15-15S301.284,0,293,0z" fill="#de513c" data-original="#de513c"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,0h-37c-8.284,0-15,6.716-15,15s6.716,15,15,15h37V0z" fill="#fc6249" data-original="#fc6249"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M418.645,118.615C375.203,75.083,317.441,51.108,256,51.108S136.797,75.083,93.355,118.615 c-43.434,43.524-67.354,101.391-67.354,162.939s23.92,119.415,67.354,162.939C136.797,488.025,194.559,512,256,512 s119.203-23.975,162.645-67.507c43.434-43.524,67.354-101.391,67.354-162.939S462.079,162.139,418.645,118.615z" fill="#de513c" data-original="#de513c"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,51.108c-61.441,0-119.203,23.975-162.645,67.507c-43.434,43.524-67.354,101.391-67.354,162.939 s23.92,119.415,67.354,162.939C136.797,488.025,194.559,512,256,512V51.108z" fill="#fc6249" data-original="#fc6249"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,108.538c-95.218,0-172.684,77.614-172.684,173.015S160.782,454.569,256,454.569 s172.684-77.615,172.684-173.016S351.218,108.538,256,108.538z" fill="#96d1d9" data-original="#96d1d9"/> <path xmlns="http://www.w3.org/2000/svg" style="" d="M256,108.538c-95.218,0-172.684,77.614-172.684,173.015S160.782,454.569,256,454.569V108.538z" fill="#f4f2e6" data-original="#f4f2e6"/> <g xmlns="http://www.w3.org/2000/svg"> <path style="" d="M256,146.007c8.284,0,15-6.716,15-15v-21.808c-4.945-0.428-9.946-0.66-15-0.66 c-5.054,0-10.055,0.232-15,0.66v21.808C241,139.291,247.716,146.007,256,146.007z" fill="#105c6e" data-original="#105c6e"/> <path style="" d="M256,417.101c-8.284,0-15,6.716-15,15v21.808c4.945,0.428,9.946,0.66,15,0.66 c5.054,0,10.055-0.232,15-0.66v-21.808C271,423.817,264.284,417.101,256,417.101z" fill="#105c6e" data-original="#105c6e"/> <path style="" d="M428.028,266.554h-21.481c-8.284,0-15,6.716-15,15s6.716,15,15,15h21.481 c0.426-4.945,0.656-9.946,0.656-15S428.454,271.499,428.028,266.554z" fill="#105c6e" data-original="#105c6e"/> <path style="" d="M120.453,281.554c0-8.284-6.716-15-15-15H83.972c-0.426,4.945-0.656,9.946-0.656,15 s0.23,10.055,0.656,15h21.481C113.737,296.554,120.453,289.838,120.453,281.554z" fill="#105c6e" data-original="#105c6e"/> <path style="" d="M293,272.897h-21.162V212.23c0-8.284-6.716-15-15-15c-8.284,0-15,6.716-15,15v75.667 c0,8.284,6.716,15,15,15H293c8.284,0,15-6.716,15-15S301.284,272.897,293,272.897z" fill="#105c6e" data-original="#105c6e"/> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> <g xmlns="http://www.w3.org/2000/svg"> </g> </g></svg></div>
		<div style="width:calc(100% - 60px);float:right;"><div class="warning text-danger"><?php echo $this->tag->getTag('info','Info');?>:</div><p  class="text-danger"><?php echo $this->tag->getTag('account_waiting_for_admin_veri','Account Waiting for Admin Verification');?></p></div>
		<div class="clearfix"></div>
		</div>
			 <?
		}
	}
	 
	?>	
	</div>
	<div class="clearfix"></div>
 
 
   
