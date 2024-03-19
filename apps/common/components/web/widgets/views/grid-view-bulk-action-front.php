<?php defined('MW_PATH') || exit('No direct script access allowed');

 
?>
<?php if (!empty($bulkActions)) { 
    $form = $this->beginWidget('CActiveForm', array(
        'action'      => $formAction,
        'id'          => 'bulk-action-form',
        'htmlOptions' => array('style' => 'display:none'),
    )); 
    $this->endWidget(); 
?>
<div class="col-lg-12 no-padding" id="bulk-actions-wrapper" style="display: none;">
   
   <div class="margin-bottom-10">
    <div class="col-lg-3 no-padding"   id="change_status">
        <?php echo CHtml::dropDownList('bulk_action_status', null, CMap::mergeArray(array('empty' => $tag->getTag('select_agent','Select Agent')), CHtml::listData($child_user,'user_id','FirstNameN')), array(
            'class'           => 'form-control select2','style'=>'width:100%;'
            
        ));?>
    </div>
 
    <div class="col-lg-3">
        <a href="javascript:;" onclick="$('#bulk-action-form').attr('action','<?php echo $formAction;?>')" class="btn btn-sm btn-primary" id="btn-run-bulk-action" style="display:none"><?php echo Yii::t('app', $tag->getTag('transfer_listings','Transfer Listings') );?></a>
    </div>
    <div class="clearfix"><!-- --></div>
    </div>
</div>
<div class="clearfix"><!-- --></div>
<?php } ?>
