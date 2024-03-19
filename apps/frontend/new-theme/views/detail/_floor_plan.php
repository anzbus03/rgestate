 <script> $(function(){   openFaboxFloorPlan(); florrPlanSlick();  })  </script>     
  <style>  .np_box_list li{margin-right:15px; }label.switch input:checked+.slider::before{transform:translateX(15px)}label.switch{position:relative;top:5px;width:42px;height:22px}label.switch .slider::before{height:15px;width:15px}html[dir='rtl'] .np_box_list li{margin-right:0px;margin-left:15px;float:right; } 
   </style>
  <?php 
  $normal_floor_plan = ''; 
  $d_floor_plan = ''; $apps = $this->app->apps;
    foreach($floor as $k=>$v){
         $ext = ''; 
     	 $file = $apps->getBaseUrl('uploads/files/'.	$v->floor_file );
     	$file2 =  $file;
		$ext = pathinfo($v->floor_file,PATHINFO_EXTENSION);
		if (strtolower($ext) == 'pdf') {
	    	$file2 = $apps->getBaseUrl('assets/img/pdfi1.png');
		}

         $fancy =  $v->file_type=='0' ? ' rel="normal-group" data-fancybox1="normal-group"' : 'rel="d-group"  data-fancybox1="d-group"' ;
		 $html = '<li class="wrwer  "   >
          <a class="thumbnail fancybox"  '.$fancy.' data-src="'.$file.'"  rel="ligthbox" href="'.$file.'" style="display: block;    height: 100%;width:100%;">
                        <div class="pro-img img-container-adj"  style="position: static; overflow: hidden; background-color: rgba(0, 0, 0, 0);text-align: center;">
                            <img class="fullscreen-img defaultSize" src="'.$file2.'"   style="width: 100%; height: 100%; position: relative; top: 0px;object-fit: contain;object-position: top;  ">
                        </div>
                        <div class="pro-content">
                            <p class="text-capitalize margin-bottom-0 ftiti">'.$v->floor_title.'</p>';
                             
                            if(!empty($v->sqft)){ 
                            $html .= '<p class="text-capitalize margin-bottom-0 ftitisqm" dir="ltr">'.$v->sqft.' SQM.</p>';
                             }  
                        $html .= '</div> <div class="clearfix"></div>
                        </a>
                    </li>'; 
		 
		 if($v->file_type=='1'){
			 $d_floor_plan  .= $html ; 
		 }
		 else{
			 $normal_floor_plan  .= $html ; 
		 
		 } 
    }
    ?>
 
<div class=" np_box_list   " id="slickFrs"  >
 
              <?php
              if(!empty($d_floor_plan) and empty($normal_floor_plan)){
				  echo $d_floor_plan;
			  }
			  else {
				   echo $normal_floor_plan;
			  }  
			  ?>                  
           

     </div>
 
	 		
 <?php
              if(!empty($d_floor_plan) and !empty($normal_floor_plan)){
				 
				  ?>
				  <div class="payment-plans np_box_list slider-zoom flex-container flex-wrap flex-center hide" id="slickFrs2" style="display:block;  width:100% !important;">
					<?php echo $d_floor_plan; ?> 
				   </div>
				   <script>$('#show_3d').removeClass('hide');</script>
				   <?php 
			  }             
           ?>

 <?php
if(in_array($model->section_id,array('121','154','159'))){
	?>
 
	<div class="cotact-row hide">
		<div class="textraa1"><?php echo $this->tag->getTag('contact_the_agent_to_get_the_r', 'Contact the agent to get the relevant floor plan for this listing') ;?></div>
		 <div class="textraa2"><a href="javascript:void(0)" onclick="OpenFormClickNewFloorplan(this)" data-reactid="<?php echo $model->id;?>"><?php echo $this->tag->getTag('request_floorplan', 'Request Floorplan') ;?></a></div>
		 </div>
	<?
	
}
?>
