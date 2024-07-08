<div class="clearfix"><!-- --></div>  
<div class="form-group" id="message">
<?php echo CHtml::activeLabelEx($model, 'message');?>
<?php echo CHtml::activeTextArea($model, 'message', $model->getHtmlOptions('message', array('rows' => 15))); ?>
<?php echo CHtml::error($model, 'message');?>
</div>
<div class="clearfix"><!-- --></div>  
