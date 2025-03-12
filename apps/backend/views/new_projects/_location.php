    <div class="form-group col-lg-12 mt-2"  >
										 <div style="clear:both;padding:5px 5px 5px 0px;color:#004A8F;font-weight:bold;font-size:15px;">Enter your location , where the map to point..</div>
										<?php    echo $form->hiddenField($model, 'area_location',array("onchange"=>"codeAddress()",'class'=>'form-control'));  ?>
										 <input id="locate-add" autofocus type="text"  onkeyup="codeAddress()" placeholder="Locate your add" class="form-control mb-2">
										
										<?php echo $form->error($model, 'area_location' );?>
								 
						    </div>
						   <div style="clear:both"></div>
				 
				  <div  class="form-group col-lg-12">
								<?php
							 
							
					   ?>
					   <div style="height:200px;width: calc(100% - 15px);"   id="map_canvas"></div>
                 
				 </div>
				 <?php
				     echo $form->hiddenField($model, 'location_latitude');
                   echo $form->hiddenField($model, 'location_longitude');
                
                ?>
   <?php echo $form->error($model, 'location_latitude');?>
