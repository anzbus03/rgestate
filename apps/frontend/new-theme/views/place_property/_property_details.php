
								   <?php
								   if($model->checkFieldsShow2('plot_area')){ ?>  
								   <div class="form-group col-lg-4">
										<?php echo $form->labelEx($model, 'plot_area');?>
										<?php echo $form->textField($model, 'plot_area', $model->getHtmlOptions('plot_area')); ?>
										<?php echo $form->error($model, 'plot_area');?>
									</div>       
									<?php } ?> 
							 
									
									 		<?php
								    if($model->checkFieldsShow2('balconies')){ ?> 
									<div class="form-group col-lg-4">
										<?php echo $form->labelEx($model, 'balconies');?>
										<?php $mer =  array_merge($model->getHtmlOptions('balconies'),array( 'class'=>'form-control select2')); ?>
										<?php echo $form->dropDownList($model, 'balconies',  $model->balconiesArray() , $mer ); ?>
										<?php echo $form->error($model, 'balconies');?>
									</div> 
									<?php } ?>
									 <?php
								    if($model->checkFieldsShow2('FloorNo')){ ?> 
									 	<div class="form-group col-lg-4">
										<?php echo $form->labelEx($model, 'FloorNo');?>
										<?php echo $form->dropDownList($model, 'FloorNo',$model->FloorNoArray(),$model->getHtmlOptions('FloorNo',array('class'=>'form-control select2'))); ?>
									    <?php echo $form->error($model, 'FloorNo');?>
									</div> 
								    <?php } ?> 
								    <div class="clearfix"></div>
								    	 <?php
								    if($model->checkFieldsShow2('total_floor')){ ?> 
									 	<div class="form-group col-lg-4">
										<?php echo $form->labelEx($model, 'total_floor');?>
										<?php echo $form->dropDownList($model, 'total_floor',$model->TotalFloorArray(),$model->getHtmlOptions('total_floor',array('class'=>'form-control select2'))); ?>
										<?php echo $form->error($model, 'total_floor');?>
									</div> 
								    <?php } ?>
								     <?php
								    if($model->checkFieldsShow2('parking')){ ?> 
									<div class="form-group col-lg-4">
										<?php echo $form->labelEx($model, 'parking');?>
										<?php echo $form->dropDownList($model, 'parking',$model->parkingArray(),$model->getHtmlOptions('parking',array('class'=>'form-control select2'))); ?>
										<?php echo $form->error($model, 'parking');?>
									</div> 
									<?php } ?> 
									  
								 
									  
									 
											 	<?php
										if($model->checkFieldsShow2('year_built')){ ?> 
									 <div class="form-group col-lg-4">
										<?php echo $form->labelEx($model, 'year_built');?>
										<?php $mer =  array_merge($model->getHtmlOptions('year_built'),array('empty'=>"Select Year",'class'=>'form-control select2')); ?>
										<?php echo $form->dropDownList($model, 'year_built',  $model->year() , $mer ); ?>
										<?php echo $form->error($model, 'year_built');?>
									</div>  
									<?php } ?> 
									 <div class="clearfix"></div>
									 		
										<?php
										if($model->checkFieldsShow2('furnished')){ ?> 
										 <div class="col-lg-3">
									<?php echo $form->labelEx($model, 'furnished');?>
									<div class="form-group">
									<?php
									$user_type_array = $model->YesNoArray2();
									foreach( $user_type_array as $k=>$v){
									$checked =  $k==$model->furnished ? true :false ; 
									echo '<div class="form-radio " style="width:56px;float:left;margin:0px;"><label class="form-check-label"   >'.$form->radioButton($model, 'furnished',$model->getHtmlOptions('furnished',array('class'=>'form-check-input', 'uncheckValue'=>null,'value'=>$k,'checked'=>$checked,'style'=>''))).'&nbsp;'.$v.'&nbsp;&nbsp;<i class="input-helper"></i></label></div>';
									}
									?>

									</div>
									
									<div class="clearfix"></div> 
									<?php echo $form->error($model, 'furnished');?>
									 </div>
									 <?php } ?> 
									 	<?php
										if($model->checkFieldsShow2('maid_room')){ ?> 
								 <div class="col-lg-3">
									<?php echo $form->labelEx($model, 'maid_room');?>
									<div class="form-group">
									<?php
									$user_type_array = $model->YesNoArray2();
									foreach( $user_type_array as $k=>$v){
									$checked =  $k==$model->maid_room ? true :false ; 
									echo '<div class="form-radio " style="width:56px;float:left;margin:0px;"><label class="form-check-label" >'.$form->radioButton($model, 'maid_room',$model->getHtmlOptions('furnished',array('class'=>'form-check-input', 'uncheckValue'=>null,'value'=>$k,'checked'=>$checked,'style'=>''))).'&nbsp;'.$v.'&nbsp;&nbsp;<i class="input-helper"></i></label></div>';
									}
									?>

									</div>
									<div class="clearfix"></div> 
									<?php echo $form->error($model, 'maid_room');?>
									 </div>	
									 <?php } ?> 
									 
									  
									  		        
										      
									            <?php
								    if($model->checkFieldsShow2('PrimaryUnitView')){ ?> 
									        	<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'PrimaryUnitView');?>
										<?php echo $form->textField($model, 'PrimaryUnitView',$model->getHtmlOptions('PrimaryUnitView',array('placeholder'=>'e.g. Full sea view, Marina View, etc...'))); ?>
										<?php echo $form->error($model, 'PrimaryUnitView');?>
										
									</div>  
									<?php } ?> 
										  <div class="clearfix"><!-- --></div>
<div class="subhead font_s ros subhead_img">Amenities</div>
									<div class="clearfix"><!-- --></div>
									<div class="form-group col-lg-12">
									   <div class="">
										<div class="container34">
										  <?php
											 $amenities_array=	 CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_name');
											 
											echo CHtml::checkBoxList('amenities',$model->amenities ,$amenities_array,array('separator'=>'','labelOptions'=>array('class'=>''),'template'=>'<div class="form-check form-check-flat"><label class="form-check-label">{input}  {labelTitle} <i class="input-helper"></i></label></div>'));                                              
											?>
										</div>
										<?php echo $form->error($model, 'amenities');?>
									</div>    
									<div class="clearfix"><!-- --></div>    
									</div>  
									
										<div class="clearfix"><!-- --></div>  
