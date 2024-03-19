<script>
var ad_picker_url_base = '<?php echo Yii::app()->createUrl('advertisement_listing/select_ad/ad_section');?>';
var ad_picker_url = '<?php echo Yii::app()->createUrl('advertisement_listing/select_ad/ad_section/A');?>';
var deleteurl = '<?php echo Yii::app()->createUrl('advertisement_listing/delete_items/layout_id/'.$model->primaryKey);?>';
var refreUrl = '<?php echo Yii::app()->createUrl('advertisement_listing/add_values/id/'.$model->primaryKey);?>';
var saveHeadUrl = '<?php echo Yii::app()->createUrl('advertisement_listing/save_heads/id/'.$model->primaryKey);?>';
</script>
<style>
.select2-container .select2-selection--single { height:auto !important; }
</style>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
		<?php
		$contact = new AdvertisementItems();
		$contact->layout_id = $model->primaryKey;
		$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl('advertisement_listing/validate_ad'),
		'enableAjaxValidation'=>true,
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'afterValidate' => 'js:function(form, data, hasError) { 
		if(hasError) {
		return false;
		}
		else
		{

		ajaxSubmitHappen3(form, data, hasError,"'.Yii::app()->createUrl('advertisement_listing/save_ad').'"); 
		}
		}',
		),
		'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
		));
		?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Your AD.</h4>
      </div>
      <div class="modal-body"  >
        <div id="msg_alert2"></div>
<div class="form-group col-lg-12">
<?php echo $form->labelEx($contact, 'section');?>
<?php echo $form->dropDownList($contact, 'section',array('A'=>'Ad Module','B'=>'Banner module','Bl'=>'Blog Module'),$contact->getHtmlOptions('section', array('onchange'=>'changeAjaxUrl(this)'))); ?>
<?php echo $form->error($contact, 'section');?>
</div>  
<div class="clearfix"></div>
<div class="form-group col-lg-12">
<?php echo $form->labelEx($contact, 'main_ad');?>
<?php echo $form->dropDownList($contact, 'main_ad',array(''=>'Select '),$contact->getHtmlOptions('main_ad',array('style'=>'width:100%;'))); ?>
<?php echo $form->error($contact, 'main_ad');?>
</div>                   
 <div class="clearfix"></div>
 <div class="form-group col-lg-12">
<?php echo $form->hiddenField($contact, 'layout_id',$contact->getHtmlOptions('layout_id')); ?>
<?php echo $form->error($contact, 'layout_id');?>
</div>
 <div class="form-group col-lg-12">
<?php echo $form->hiddenField($contact, 'row_id',$contact->getHtmlOptions('row_id')); ?>
<?php echo $form->error($contact, 'row_id');?>
</div>
 <div class="form-group col-lg-12">
<?php echo $form->hiddenField($contact, 'row_number',$contact->getHtmlOptions('row_number')); ?>
<?php echo $form->error($contact, 'row_number');?>
</div>
 
                  
               <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"  >Submit</button>
      </div>
    </div>
<?php $this->endWidget();?>
  </div>
</div>
