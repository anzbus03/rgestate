<?php 
$form=$this->beginWidget('CActiveForm', array(
'id'=>'signup-form',
'enableAjaxValidation'=>true,
'htmlOptions'=>array('enctype'=>'multipart/form-data'),
'clientOptions' => array(
'validateOnSubmit'=>true,
'validateOnChange'=>true,
),
'action'=>Yii::app()->createUrl("member/billing_settings",array('return'=>@$return ))
));  ?> 

	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'full_name');?> 
	<?php echo $form->textField($model,'full_name', $model->getHtmlOptions('full_name') ); ?>
	<?php echo $form->error($model, 'full_name');?>
	</div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'id_number');?> 
	<?php echo $form->textField($model,'id_number', $model->getHtmlOptions('id_number') ); ?>
	<?php echo $form->error($model, 'id_number');?>
	</div>
	<div class="clearfix"><!-- --></div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'address');?> 
	<?php echo $form->textField($model,'address', $model->getHtmlOptions('address') ); ?>
	<?php echo $form->error($model, 'address');?>
	</div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'zip_code');?> 
	<?php echo $form->textField($model,'zip_code', $model->getHtmlOptions('zip_code') ); ?>
	<?php echo $form->error($model, 'zip_code');?>
	</div>
	<div class="clearfix"><!-- --></div>
	<div class="clearfix"><!-- --></div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'city');?> 
	<?php echo $form->textField($model,'city', $model->getHtmlOptions('city') ); ?>
	<?php echo $form->error($model, 'city');?>
	</div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'phone_number');?> 
	<?php echo $form->textField($model,'phone_number', $model->getHtmlOptions('phone_number') ); ?>
	<?php echo $form->error($model, 'phone_number');?>
	</div>
	<div class="clearfix"><!-- --></div>
	<div class="clearfix"><!-- --></div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'payment_method');?> 
	<?php echo $form->dropDownlIst($model,'payment_method',$model->paymentMethods(), $model->getHtmlOptions('payment_method') ); ?>
	<?php echo $form->error($model, 'payment_method');?>
	</div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'country_id');?> 
	<?php echo $form->dropDownlIst($model,'country_id', CHtml::listData(Countrieslist::model()->listData(),'id','name'), $model->getHtmlOptions('country_id') ); ?>
	<?php echo $form->error($model, 'country_id');?>
	</div>
	<div class="clearfix"><!-- --></div>
		<div class="clearfix"><!-- --></div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'email_payment');?> 
	<?php echo $form->textField($model,'email_payment', $model->getHtmlOptions('email_payment') ); ?>
	<?php echo $form->error($model, 'email_payment');?>
	</div>
	<div class="form-group col-lg-6 float-left">
	<?php echo $form->labelEx($model, 'id_doc');?> 
	<?php echo $form->fileField($model,'id_doc', $model->getHtmlOptions('id_doc') ); ?>
	<?php echo $form->error($model, 'id_doc');?>
	</div>
	<div class="form-group col-lg-12">
	<?php echo $form->labelEx($model, 'address');?>
	<?php echo $form->textArea($model, 'address',$model->getHtmlOptions('address')); ?>
	<?php echo $form->error($model, 'address');?>
	</div>       
 
	  
 
							<button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
							<div class="clear"></div>
						 
					<?php $this->endWidget();?>
		 

