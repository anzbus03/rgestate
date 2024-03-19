<?php
if($k==0){   ?>   
   <div id="ak_<?php echo $country->country_id;?>_top" >
         
         <div  style="min-height:100px"  id="ak_<?php echo $country->country_id;?>" data-url="<?php echo $this->app->createUrl('site/load_data',array('country_id'=>$country->country_id,'state_id'=>$country->show_region));?>" class="loaded">
         <?php echo $this->actionLoad_data($country->country_id,$country->show_region);?>
         </div>
   </div>
<?php }
else{
	?>
	<div id="ak_<?php echo $country->country_id;?>_top" style="display:none;">
         <div class="ak_loader" id="ak_<?php echo $country->country_id;?>_loader"></div>
         <div  style="min-height:100px"  id="ak_<?php echo $country->country_id;?>" data-url="<?php echo $this->app->createUrl('site/load_data',array('country_id'=>$country->country_id,'state_id'=>$country->show_region));?>" class="fixed_loaders">
         </div>
   </div>
	<?
}

 ?>
