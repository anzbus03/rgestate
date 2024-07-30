<div class="clearfix"><!-- --></div>
								
								 
 
 <div class="form-group col-lg-6 no-padding-left">
									 
									 	<div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'ad_title');?>
										<?php echo $form->textField($model, 'ad_title', $model->getHtmlOptions('ad_title')); ?>
										<?php echo $form->error($model, 'ad_title');?>
									</div>      
									  
									 <div class="clearfix"><!-- --></div> 
									 
									<div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'ad_description');?>
										<?php echo $form->textArea($model, 'ad_description', array_replace($model->getHtmlOptions('ad_description'),array("rows"=>"10"))); ?>
										<?php echo $form->error($model, 'ad_description');?>
									</div>        
									<?php
										
									if($model->checkFieldsShow('builtup_area')){ ?> 
									<div class="clearfix"><!-- --></div> 
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'builtup_area');?>
										<?php echo $form->textField($model, 'builtup_area', $model->getHtmlOptions('builtup_area')); ?>
										<?php echo $form->error($model, 'builtup_area');?>
									</div> 
									<?php } ?> 
								   <?php
								   if($model->checkFieldsShow('plot_area')){ ?>  
								   <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'plot_area');?>
										<?php echo $form->textField($model, 'plot_area', $model->getHtmlOptions('plot_area')); ?>
										<?php echo $form->error($model, 'plot_area');?>
									</div>       
									<?php } ?> 
								 <div class="clearfix"><!-- --></div> 
									 <?php
								    if($model->checkFieldsShow('bathrooms')){ ?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bathrooms');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bathrooms'),array('empty'=>"Select bathrooms",'class'=>'form-control selectt2')); ?>
										<?php echo $form->dropDownList($model, 'bathrooms',  $model->bathrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bathrooms');?>
									</div>  
									<?php } ?>
									<?php
								    if($model->checkFieldsShow('bedrooms')){ ?> 
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'bedrooms');?>
										<?php $mer =  array_merge($model->getHtmlOptions('bedrooms'),array('empty'=>"Select bedrooms",'class'=>'form-control selectt2')); ?>
										<?php echo $form->dropDownList($model, 'bedrooms',  $model->bedrooms() , $mer ); ?>
										<?php echo $form->error($model, 'bedrooms');?>
									</div> 
									<?php } ?>
									 		<?php
								    if($model->checkFieldsShow('balconies')){ ?> 
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'balconies');?>
										<?php $mer =  array_merge($model->getHtmlOptions('balconies'),array( 'class'=>'form-control selectt2')); ?>
										<?php echo $form->dropDownList($model, 'balconies',  $model->balconiesArray() , $mer ); ?>
										<?php echo $form->error($model, 'balconies');?>
									</div> 
									<?php } ?>
									 <?php
								    if($model->checkFieldsShow('FloorNo')){ ?> 
									 	<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'FloorNo');?>
										<?php echo $form->dropDownList($model, 'FloorNo',$model->FloorNoArray(),$model->getHtmlOptions('FloorNo',array('class'=>'form-control selectt2'))); ?>
									    <?php echo $form->error($model, 'FloorNo');?>
									</div> 
								    <?php } ?> 
								    	 <?php
								    if($model->checkFieldsShow('total_floor')){ ?> 
									 	<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'total_floor');?>
										<?php echo $form->dropDownList($model, 'total_floor',$model->TotalFloorArray(),$model->getHtmlOptions('total_floor',array('class'=>'form-control selectt2'))); ?>
										<?php echo $form->error($model, 'total_floor');?>
									</div> 
								    <?php } ?>
								     <?php
								    if($model->checkFieldsShow('parking')){ ?> 
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'parking');?>
										<?php echo $form->dropDownList($model, 'parking',$model->parkingArray(),$model->getHtmlOptions('parking',array('class'=>'form-control selectt2'))); ?>
										<?php echo $form->error($model, 'parking');?>
									</div> 
									<?php } ?> 
									  
									<div class="clearfix"><!-- --></div>
									  <?php /*
									 <?php if(in_array("property_name",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'property_name');?>
										<?php echo $form->textField($model, 'property_name',$model->getHtmlOptions('property_name')); ?>
										<?php echo $form->error($model, 'property_name');?>
									</div> 
									 <?php }  ?>        
									 <?php if(in_array("PrimaryUnitView",$fields)){?>
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'PrimaryUnitView');?>
										<?php echo $form->textField($model, 'PrimaryUnitView',$model->getHtmlOptions('PrimaryUnitView')); ?>
										<?php echo $form->error($model, 'PrimaryUnitView');?>
									</div> 
									 <?php }  ?>        
							      */?>
								 
									  
											<div class="clearfix"></div> 
										<?php
										
										 
										if($model->checkFieldsShow('construction_status')){
											if($model->isNewRecord and empty($model->construction_status) and $model->section_id=='3'){
										        $model->construction_status = 'N';
									    	}
										
										?> 	
									
										<div class="form-group col-lg-6"> 
										<?php echo $form->labelEx($model, 'construction_status');?>
										<?php echo $form->dropDownList($model, 'construction_status',$model->constructionArray(), $model->getHtmlOptions('construction_status',array('empty'=>'Select','class'=>'form-control selectt2'))); ?>
										<?php echo $form->error($model, 'construction_status');?>
										</div> 	
										<?php } ?> 
									 	
										<?php
										if($model->checkFieldsShow('transaction_type')){ 
											if($model->isNewRecord and empty($model->transaction_type) and $model->section_id=='3'){
										        $model->transaction_type = 'N';
									    	}
										
										?>
										<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'transaction_type');?>
										<?php echo $form->dropDownList($model, 'transaction_type',$model->TransactionType(), $model->getHtmlOptions('transaction_type',array('empty'=>'Select','class'=>'form-control selectt2'))); ?>
										<?php echo $form->error($model, 'transaction_type');?>
										</div> 	
										<?php } ?>
											 	<?php
										if($model->checkFieldsShow('year_built')){ ?> 
									 <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'year_built');?>
										<?php $mer =  array_merge($model->getHtmlOptions('year_built'),array('empty'=>"Select Year",'class'=>'form-control selectt2')); ?>
										<?php echo $form->dropDownList($model, 'year_built',  $model->year() , $mer ); ?>
										<?php echo $form->error($model, 'year_built');?>
									</div>  
									<?php } ?> 
										<?php
										if($model->checkFieldsShow('rera_no')){ ?> 
										<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'rera_no');?>
										<?php echo $form->textField($model, 'rera_no',$model->getHtmlOptions('rera_no')); ?>
										<small>(Required for Dubai UAE Listings Only)</small>
										<div class="clearfix"></div> 	
										<?php echo $form->error($model, 'rera_no');?>
										</div> 
										<?php } ?> 
										<div class="clearfix"></div> 		
										<?php
										if($model->checkFieldsShow('furnished')){ ?> 
										 <div class="col-lg-6">
									<?php echo $form->labelEx($model, 'furnished');?>
									<div class="form-group">
									<?php
									$user_type_array = $model->YesNoArray2();
									foreach( $user_type_array as $k=>$v){
									$checked =  $k==$model->furnished ? true :false ; 
									echo '<div class="form-radio " style="width:56px;float:left;margin:0px;"><label class="form-check-label" style="padding-left:0px;" >'.$form->radioButton($model, 'furnished',$model->getHtmlOptions('furnished',array('class'=>'form-check-input', 'uncheckValue'=>null,'value'=>$k,'checked'=>$checked,'style'=>''))).'&nbsp;'.$v.'&nbsp;&nbsp;<i class="input-helper"></i></label></div>';
									}
									?>

									</div>
									
									<div class="clearfix"></div> 
									<?php echo $form->error($model, 'furnished');?>
									 </div>
									 <?php } ?> 
									 	<?php
										if($model->checkFieldsShow('maid_room')){ ?> 
								 <div class="col-lg-6">
									<?php echo $form->labelEx($model, 'maid_room');?>
									<div class="form-group">
									<?php
									$user_type_array = $model->YesNoArray2();
									foreach( $user_type_array as $k=>$v){
									$checked =  $k==$model->maid_room ? true :false ; 
									echo '<div class="form-radio " style="width:56px;float:left;margin:0px;"><label class="form-check-label" style="padding-left:0px;">'.$form->radioButton($model, 'maid_room',$model->getHtmlOptions('furnished',array('class'=>'form-check-input', 'uncheckValue'=>null,'value'=>$k,'checked'=>$checked,'style'=>''))).'&nbsp;'.$v.'&nbsp;&nbsp;<i class="input-helper"></i></label></div>';
									}
									?>

									</div>
									<div class="clearfix"></div> 
									<?php echo $form->error($model, 'maid_room');?>
									 </div>	
									 <?php } ?> 
									 
									  <div class="clearfix"></div> 
									 <br /> 
									 <div class="clearfix"></div> 
								
                       
									  		        
										       <div class="clearfix"><!-- --></div>
									            <?php
								    if($model->checkFieldsShow('PrimaryUnitView')){ ?> 
									        	<div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'PrimaryUnitView');?>
										<?php echo $form->textField($model, 'PrimaryUnitView',$model->getHtmlOptions('PrimaryUnitView',array('placeholder'=>'e.g. Full sea view, Marina View, etc...'))); ?>
										<?php echo $form->error($model, 'PrimaryUnitView');?>
										
									</div>  
									<?php } ?> 
										<div class="clearfix"></div> 
										<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'community_id');?>
										<?php echo $form->dropDownList($model, 'community_id', CHtml::listData( Community::model()->findAllByAttributes(array('community_id'=>$model->community_id)) ,'community_id','community_name')    , $model->getHtmlOptions('community_id' ,array('empty'=>"Select Communtiy", "onChange"=>"getSubCommunity(this)",'class'=>'autoSelect_community form-control') )); ?>
										<?php echo $form->error($model, 'community_id');?>
										</div> 
										<div class="form-group col-lg-6">		
										<?php echo $form->labelEx($model, 'sub_community_id');?>
										
										<?php echo $form->dropDownList($model, 'sub_community_id',  CHtml::listData( SubCommunity::model()->findAllByAttributes(array('sub_community_id'=>$model->sub_community_id)) ,'sub_community_id','sub_community_name')   ,$model->getHtmlOptions('sub_community_id',array('empty'=>"Select SubCommunity" , 'class'=>'autoSelect_sub_community form-control' ) )); ?>
										<?php echo $form->error($model, 'sub_community_id');?>
										</div>	
										<div class="clearfix"></div>
									    <div class="clearfix"></div> 
										<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'status');?>
										<?php echo $form->dropDownList($model, 'status', $model->statusArray()    , $model->getHtmlOptions('community_id' ,array('class'=>'form-control selectt2') )); ?>
										<?php echo $form->error($model, 'status');?>
										</div> 
											<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'featured');?>
										<?php echo $form->dropDownList($model, 'featured', array('N'=>'Not Featured' , 'Y'=>'Featured' )    , $model->getHtmlOptions('featured' ,array('class'=>'form-control selectt2') )); ?>
										<?php echo $form->error($model, 'featured');?>
										</div> 
										<div class="clearfix"></div> 
														        
</div>
 <div class="form-group col-lg-6 no-padding-right">
	 <?php $this->renderPartial('_image_upload',compact('form'));?> 
	 <?php
	 if($model->checkFieldsShow('floor_plan')){ ?>
	 <?php $this->renderPartial('_floor_upload',compact('form'));?>
	 <?php } ?>  
<div class="clearfix"></div> 		

<div class="clearfix"><!-- --></div> 
</div> 
