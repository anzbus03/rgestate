		<div class="spansecform">
		<?php
						    $contact = new SendEnquiry();
							$contact->ad_id = $model->id ;
							$form = $this->beginWidget('CActiveForm', array(
							'action'=>Yii::app()->createUrl('detail/validateEnquiry'),
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,
							'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							return false;
							}
							else
							{

							ajaxSubmitHappen(form, data, hasError,"'.Yii::app()->createUrl('detail/SendEnquiry').'"); 
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
							));
							?>
		<h5 class="spansectopform" style="font-size:21px;color:#888;margin-bottom:5px;">Register your interest</h5>

		<div class="row">
		 

		<div class="col-sm-12">
		<div class="form-group">
		<?php echo $form->textField($contact, 'name',$model->getHtmlOptions('name',array('class'=>'form-control'))); ?>
		<?php echo $form->error($contact, 'name');?>
		<?php echo $form->hiddenField($contact, 'ad_id'); ?>
		<?php echo $form->error($contact, 'name');?>
		</div>
		</div>
		 
		<div class="col-sm-12">
		<div class="form-group">
	<?php echo $form->textField($contact, 'email',$contact->getHtmlOptions('email',array('class'=>'form-control'))); ?>
	<?php echo $form->error($contact, 'email');?>
		</div>
		</div>

		<div class="col-sm-12">
		<div class="form-group">
		<?php echo $form->textField($contact, 'phone',$contact->getHtmlOptions('phone',array('class'=>'form-control'))); ?>
		<?php echo $form->error($contact, 'phone');?>
		</div>
		</div>
		<div class="col-sm-12">
		<div class="form-group">
		 <?php
										  $contact->meassage = Yii::t('tran',' I am interested in {ad} ',array('{ad}'=>$model->AdTitle) ); 
										  echo $form->textArea($contact, 'meassage',$contact->getHtmlOptions('meassage',array('class'=>'form-control','rows'=>'1'))); ?>
										 <?php echo $form->error($contact, 'meassage');?>
		</div>
		</div>



		</div>

<div id="msg_alert"></div>
		<button type="submit" class="btn button spanhover" id="submit_btn">Submit</button>
	 <?php $this->endWidget(); ?>
		</div>
