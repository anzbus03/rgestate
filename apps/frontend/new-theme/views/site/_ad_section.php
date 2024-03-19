 
   <div id="aks_<?php echo $row['advertisemen_id'];?>_top" style="display:none;" >
			<div class="ak_loader" id="aks_<?php echo $row['advertisemen_id'];?>_loader"></div>
         <div  style="min-height:50px;  "  id="aks_<?php echo $row['advertisemen_id'];?>" data-url="<?php echo $this->app->createUrl('site/load_data_ads',array('layout_id'=>$row['advertisemen_id']));?>" class="fixed_loaders">
         </div>
   </div>
 
