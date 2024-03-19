   		<div class="clearfix"><!-- --></div>    
		<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'nearest_metro');?>
										<?php echo $form->textArea($model, 'nearest_metro', array_replace($model->getHtmlOptions('nearest_metro'),array("rows"=>"6"))); ?>
										<?php echo $form->error($model, 'nearest_metro');?>
									</div>
									  
									<div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'nearest_railway');?>
										<?php echo $form->textArea($model, 'nearest_railway', array_replace($model->getHtmlOptions('nearest_railway'),array("rows"=>"6"))); ?>
										<?php echo $form->error($model, 'nearest_railway');?>
									</div>     		        
 
			<div class="clearfix"><!-- --></div>  
									<div style="font-weight:bold;color:#6B6B6B;font-size:16px;margin-bottom:20px;">Amenities and price</div> 
									<div class="clearfix"><!-- --></div>
									<div class="form-group col-lg-6">
									   <div class="form-group col-lg-12 no-padding-left">
										<?php echo $form->labelEx($model, 'amenities');?>
										<div class="container34">
										  <?php
											 $amenities_array=	 CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_name');
											 
											echo CHtml::checkBoxList('amenities',$model->amenities ,$amenities_array);                                              
											?>
										</div>
										<?php echo $form->error($model, 'amenities');?>
									</div>    
									<div class="clearfix"><!-- --></div>    
									</div>    
									  
								  <div class="form-group col-lg-6">
									  
										
											
											    <div class="clearfix"><!-- --></div>
											
											    <div class="clearfix"><!-- --></div>
										 
							
									 <div class="clearfix"></div> 
									 <div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'mobile_number');?>
										<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('mobile_number')); ?>
										<?php echo $form->error($model, 'mobile_number');?>
										</div> 
										 <div class="clearfix"><!-- --></div>
										 	 <div class="form-group col-lg-6">
										<?php echo $form->labelEx($model, 'user_id');?>
										<?php $mer =  array_merge($model->getHtmlOptions('user_id'),array('empty'=>"Select Customer",'class'=>"autoSelect_customer form-control")); ?>
										<?php echo $form->dropDownList($model, 'user_id',  CHtml::listData(ListingUsers::model()->findAll(array("condition"=>"status='A' and isTrash='0'")),'user_id','first_name') , $mer ); ?>
										<?php echo $form->error($model, 'user_id');?>
									</div>  
										 <div class="clearfix"><!-- --></div> 
										<div class="col-lg-6">
										<?php echo $form->labelEx($model, 'price');?><label>[<?php echo $model->currencyTitle;?>]</label>
										<div class="clearfix"><!-- --></div> 
										<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price')); ?>
										<?php echo $form->error($model, 'price');?>
										</div>
										 <?php
										if($model->section_id==$model::RENT_ID){
										 ?>
										<div class="col-lg-6">
										<?php echo $form->labelEx($model, 'rent_paid');?>
										<?php echo $form->dropDownList($model, 'rent_paid', array("monthly"=>"Monthly","yearly"=>"Yearly")   , $model->getHtmlOptions('rent_paid',array('class'=>'form-control selectt2')) ); ?>
										<?php echo $form->error($model, 'rent_paid');?>
										</div>
										 <?php }  ?>
								 
                       
									<div class="clearfix"><!-- --></div> 
									  </div>
                 
                 
