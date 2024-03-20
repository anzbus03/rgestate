
				 <style>#place_an_ad   .row {
    margin-left: 0px;
    margin-right: 0px;
 }
 
 .d-flex{ display:flex;}.padding-right-15{ padding-right:15px!important;}#ck-button input:checked+span {
    background-color: #f27f52;
    color: #fff;
}
 </style>
				        <div class="insidecontent">

<div class="clearfix"></div>
 <h3 class="subHeadh2"> Contact Details</h3>
<div class="clearfix"></div>
<div class="row">					  
 
										<div class="clearfix"></div>
											<div class="form-group col-lg-3">
										<?php 
									 	echo $form->labelEx($model, 'contact_person');?>
										<?php echo $form->textField($model, 'contact_person', $model->getHtmlOptions('contact_person')); ?>
										<?php echo $form->error($model, 'contact_person');?>
										</div> 
												<div class="form-group col-lg-6">
										<?php 
									 	echo $form->labelEx($model, 'salesman_email');?>
										<?php echo $form->textField($model, 'salesman_email', $model->getHtmlOptions('salesman_email')); ?>
										<?php echo $form->error($model, 'salesman_email');?>
										</div>
									
										<div class="clearfix"></div>
										</div>
										<div class="row">
										<div class="form-group col-lg-3">
										<?php 
									 	echo $form->labelEx($model, 'mobile_number');?>
										<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('mobile_number')); ?>
										<?php echo $form->error($model, 'mobile_number');?>
										</div> 
											<div class="form-group col-lg-3">
										<?php 
									 
										echo $form->labelEx($model, 'landline');?>
										<?php echo $form->textField($model, 'landline', $model->getHtmlOptions('landline')); ?>
										<?php echo $form->error($model, 'landline');?>
										</div> 
										
												<div class="form-group col-lg-3">
										<?php 
									 
										echo $form->labelEx($model, 'submited_by');?>
										<?php echo $form->dropDownList($model, 'submited_by',$model->getsubmited_by_array(), $model->getHtmlOptions('submited_by',array('empty'=>'Please Select'))); ?>
										<?php echo $form->error($model, 'submited_by');?>
										</div> 
									
										  <div class="form-group col-lg-6">
												 
										<?php echo $form->labelEx($model, 'user_id');?>
										<div></div>
										<?php
										if(Yii::App()->isAppName('backend') and !Yii::App()->request->isPostRequest and empty($model->user_id)){
										    $model->user_id ='31988' ;
										}
										?>
 
										<?php echo $form->dropDownList($model, 'user_id', CHtml::listData(ListingUsers::model()->findAllByPk($model->user_id),'user_id','fullName') , $model->getHtmlOptions('user_id') ); ?>
										<?php echo $form->error($model, 'user_id');?>
									</div>
							 
							 
							 <div class="clearfix"><!-- --></div>
							 	
										 	 <div class="form-group col-lg-6 hide">
									 <?php echo $form->hiddenField($model, 'p_url'   ); ?>
										<?php echo $form->hiddenField($model, 'p_id'   ); ?>
										<?php echo $form->hiddenField($model, 'section_id'   ); ?>
										<?php echo $form->error($model, 'section_id');?>
										<?php echo $form->hiddenField($model, 'listing_type'   ); ?>
										<?php echo $form->error($model, 'listing_type');?>
										<?php echo $form->hiddenField($model, 'w_for'   ); ?>
										<?php echo $form->error($model, 'w_for');?>
										<?php echo $form->hiddenField($model, 'category_id'   ); ?>
										<?php echo $form->error($model, 'category_id');?>
									</div>
		</div>					 
		</div>					 
                <div class="clearfix"><!-- --></div>
                </div>
                   <div class="_2ytqd"></div>
                
            
				  <div class="insidecontent">
				 <div class="clearfix"></div>
		<h3 class="subHeadh2">Admin Settings</h3>
		 <h2 class="main_head_purpose"></h2>
		<div class="clearfix"></div> 
		<div class="row">
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
		<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model, 'verified');?>
		<?php echo $form->dropDownList($model, 'verified', array('0'=>'Unverified' , '1'=>'Verified' )    , $model->getHtmlOptions('verified' ,array('class'=>'form-control selectt2') )); ?>
		<?php echo $form->error($model, 'verified');?>
		</div> 
			<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model, 'hot');?>
		<?php echo $form->dropDownList($model, 'hot', array('0'=>'--' , '1'=>'Hot' )    , $model->getHtmlOptions('hot' ,array('class'=>'form-control selectt2') )); ?>
		<?php echo $form->error($model, 'hot');?>
		</div> 
		<div class="form-group col-lg-6">
		<?php echo $form->labelEx($model, 'property_status');?><?php   $model->property_status = empty($model->property_status) ? '0' : '1'; ;?>
		<?php echo $form->dropDownList($model, 'property_status', array( '0'=>'For Sale','1'=>'Preleased'  )    , $model->getHtmlOptions('property_status' ,array('class'=>'form-control selectt2','onchange'=>'show_roi(this)') )); ?>
		<?php echo $form->error($model, 'property_status');?>
		</div> 
		<div class="clearfix"></div>
		<div class="<?php echo $model->property_status=='1'? : 'hide';?>" id="roi_values">
		        <script>
		            function show_roi(k){
		                if($(k).val()=='1'){
		                    $('#roi_values').removeClass('hide');
		                }
		                else{
		                    $('#roi_values').addClass('hide');
		                }
		            }
		            function changeVlauesThis(k){
		                if($(k).val()=='1'){
		                      $('#p_id_1').html('Current Net Income');
		                    $('#p_id_2').html('Current Net ROI')
		                    
		                }else{
		                    $('#p_id_1').html('Expected Net Income');
		                    $('#p_id_2').html('Expected Net ROI (%)')
		                }
		                
		            }
		        </script>
                <div class="form-group col-lg-12">
                <?php 
                echo $form->labelEx($model, 'lease_status');?>
                <?php echo $form->dropDownList($model, 'lease_status',$model->getlease_status(), $model->getHtmlOptions('lease_status',array('onchange'=>'changeVlauesThis(this)'))); ?>
                <?php echo $form->error($model, 'lease_status');?>
                </div> 
                <div class="form-group col-lg-6">
                <?php 
                echo $form->labelEx($model, 'income',array('id'=>'p_id_1'));?>
                <?php echo $form->textField($model, 'income', $model->getHtmlOptions('income',array('placeholder'=>''))); ?>
                <?php echo $form->error($model, 'income');?>
                </div> 
                <div class="form-group col-lg-6">
                <?php 
                echo $form->labelEx($model, 'roi',array('id'=>'p_id_2'));?>
                <?php echo $form->textField($model, 'roi', $model->getHtmlOptions('roi',array('placeholder'=>''))); ?>
                <?php echo $form->error($model, 'roi');?>
                </div> 
			</div>					
		</div>
		
		</div> 
		<div class="clearfix"></div> 
		<script>
var modelName = '<?php echo $model->modelName;?>';
var cityUrl   = '<?php echo Yii::App()->createUrl($this->id.'/getCityId');?>';
var customer_url = '<?php echo Yii::app()->createUrl('place_an_ad/Customer' );?>';
 
 
</script>
