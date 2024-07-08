<?php defined('MW_PATH') || exit('No direct script access allowed');
?>
<div id="remooover" style="text-align:nenter;margin-top:10px;"> Loading...</div>
<link href="<?php echo Yii::app()->apps->getBaseUrl('assets/js/datetimepicker/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet"> 
<script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/datetimepicker/js/bootstrap-datetimepicker.min.js');?>"></script>
<script src="<?php echo Yii::app()->apps->getBaseUrl('assets/js//ckeditor/ckeditor.js');?>"></script>
<div id="remoooverNext" style="display:none">
<?
$this->renderPartial('sub/_form');
?>
<?php 
$model->status = 'Q';
echo $form->hiddenField($model, 'status',$model->getHtmlOptions('status')); ?>
  
 </div>

<script>
 $(function(){
	 CKEDITOR.basePath = '<?php echo Yii::app()->apps->getBaseUrl('assets/js');?>/ckeditor/';
 
CKEDITOR.plugins.basePath = '<?php echo Yii::app()->apps->getBaseUrl('assets/js');?>/ckeditor/plugins/';
	 var editor = CKEDITOR.replace('Email_message',{toolbar:'Simple'});
	 
	  $('#remooover').remove();
	  $('#remoooverNext').show();
 
	 })
	
</script>
 
