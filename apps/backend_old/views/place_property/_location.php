<div class="row">  
	<div class="form-group col-lg-12"  >
										 <label style="width: 100%;clear: both !important;display: block;">Enter your location <span class="required">*</span></label>
										  <span class="location-picker"></span>
										  <?php
				     echo $form->textField($model, 'mandate', $model->getHtmlOptions('mandate',array('placeholder'=>'e.g. Al-Asif Square, Karachi, Pakistan' ,'class'=>'form-control form_have_placeholder'))); ?> 
										 <span class="arrow-picker" onclick="setFocusLocation()"></span>
									  <?php echo $form->error($model, 'location_latitude');?>	
								 
						    </div>
						    </div>  
						   <div style="clear:both"></div>
				 
				  <div  class="form-group col-lg-12 hide">
								<?php
							 
							
					   ?>
					   <div style="height:0px;width: 100%  "   id="map_canvas"></div>
                 
				 </div>
				 <?php
				     echo $form->hiddenField($model, 'location_latitude');
                   echo $form->hiddenField($model, 'location_longitude');
                
                ?>
                <script>function setFocusLocation(){ $('#PlaceAnAd_mandate').focus(); }</script>