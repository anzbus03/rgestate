<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.5.4
 */
?>
<?php if (!empty($bulkActions)) { 
    $form = $this->beginWidget('CActiveForm', array(
        'action'      => $formAction,
        'id'          => 'bulk-action-form',
        'htmlOptions' => array('style' => 'display:none'),
    )); 
    $this->endWidget(); 
?>
<div class="col-lg-6" id="bulk-actions-wrapper" style="display: none;">
    <div class="col-lg-4">
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
    <div class="col-lg-2">
        <a href="javascript:;" class="btn btn-sm btn-primary" id="btn-run-bulk-action" style="display:none"><?php echo Yii::t('app', 'Run bulk action');?></a>
    </div>
</div>
<div class="clearfix"><!-- --></div>
<?php } ?>
