							 
								<div class="form-group col-lg-12  no-padding">
								 
								<?php echo $form->dropDownList($model, 'receipeints',$model->modelRelatedValArray,$model->getHtmlOptions('receipeints',array('class'=>'emailSelect','placeholder'=>'Select Recipients','multiple'=>true,'data-href'=>Yii::app()->createUrl('ajax/search',array('selectTwo'=>'1','searchType'=>'email')),'style'=>'width:100%;' ))); ?>
								<?php echo $form->error($model, 'receipeints');?>
								<div class="clearfix"><!-- --></div>
								</div>
								<div class="clearfix"><!-- --></div>
							
								<div class="form-group">

								<?php echo $form->textField($model, 'subject',$model->getHtmlOptions('subject')); ?>
								<?php echo $form->error($model, 'subject');?>
								</div>
								<div class="clearfix"><!-- --></div>
								
								
								<div class="form-group col-lg-3 no-margin no-padding-left"> 
									<?php 
									if($model->sent_on){
										$model->sendAt = date('Y-m-d H:i:s',strtotime($model->sent_on));
									}
									?>	 
								<?php echo $form->labelEx($model, 'sent_on');?>
								<?php echo $form->hiddenField($model, 'sent_on', $model->getHtmlOptions('sent_on',array('readonly'=>true))); ?>
								   <?php echo $form->textField($model, 'sendAt', $model->getHtmlOptions('sent_on')); ?>
								<?php echo CHtml::textField('fake_send_at',  $model->sendAt , array(
								'data-date-format'  => 'yyyy-mm-dd hh:ii:ss', 
								'data-autoclose'    => true, 
								'data-language'     => LanguageHelper::getAppLanguageCode(),
								'data-syncurl'      => $this->createUrl('send_email/sync_datetime'),
								'class'             => 'form-control',
								'style'             => 'visibility:hidden; height:1px; margin:0; padding:0;',
								)); ?>
								<?php echo $form->error($model, 'sent_on');?>
								</div>
								<div class="form-group  col-lg-<?php echo (Yii::app()->request->isAjaxRequest)? '6':'3';?>">
								 <?php echo $form->labelEx($model, 'email_template');?>
								<?php echo $form->dropDownList($model, 'email_template',(array) CHtml::listData((array) CustomerEmailTemplate::model()->findAllByPk($model->email_template),'template_id','name'),$model->getHtmlOptions('email_template',array('empty'=>'Select Template ','placeholder'=>'Select Email Template ','class'=>'form-control selectTwo','style'=>'width:100%;','onchange'=>'return ChangeContent(this)','data-href'=>Yii::app()->createUrl('ajax/templateData')))); ?>
								</div>
							 	<div class="clearfix"><!-- --></div>
			 	
								<div class="form-group">
								 

								<?php echo $form->textArea($model, 'message', $model->getHtmlOptions('message', array('rows' => 8))); ?>
								<?php echo $form->hiddenField($model, 'status'); ?>
								<?php echo $form->error($model, 'message');?>
								</div> 
