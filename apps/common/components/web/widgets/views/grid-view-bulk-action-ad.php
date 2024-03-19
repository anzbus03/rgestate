<?php defined('MW_PATH') || exit('No direct script access allowed');

 
?>
<?php if (!empty($bulkActions)) { 
 
?>
<div class="col-lg-4" id="bulk-actions-wrapper" style="display: none;">
    <div class="col-lg-8">
        <?php echo CHtml::dropDownList('bulk_action', null, CMap::mergeArray(array('' => 'With Selected'), $bulkActions), array(
            'class'           => 'form-control',
            'data-delete-msg' => Yii::t('app', 'Are you sure you want to remove the selected items?'),
        ));?>
    </div>
     <?php
    if(Yii::app()->controller->route=='applications/index'){ ?> 
    <div class="col-lg-4"  style="display: none;" id="change_status">
        <?php echo CHtml::dropDownList('bulk_action_status', null, CMap::mergeArray(array('' => 'Select Status'), ApplyJob::model()->statusArray()), array(
            'class'           => 'form-control',
            
        ));?>
    </div>
    <?php }?>
    <div class="col-lg-4">
        <a href="javascript:;" onclick="$('#bulk-action-form').attr('action','<?php echo $formAction;?>')" class="btn btn-sm btn-primary" id="btn-run-bulk-action" style="display:none"><?php echo Yii::t('app', 'Run bulk action');?></a>
    </div>
</div>
<div class="clearfix"><!-- --></div>
<?php } ?>
