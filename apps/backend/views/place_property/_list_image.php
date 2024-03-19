          <?php
	foreach($profileList as $k=>$v){  
		
		 
		?>
       <div class="masonry-item  sta_<?php echo $v->status;?>" style="position:relative">
       <label for="img_<?php echo $v->id;?>">
		   <span class="float-right operation-tools"  > <input type="checkbox" id="img_<?php echo $v->id;?>" name="select_action[]" class="select_action" value="<?php echo $v->id;?>">    </span>
                        
                          <div class="clear"></div>
                        </span>
                        
                        <img src="<?php echo $v->getdetailImages($v->image_name);?>" style="width:230px;">
               </label>      
     </div>
  
           
    <?php } ?>
 
