<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
?>

<?php $form = $this->beginWidget('CActiveForm'); ?>
<div class="box box-primary">
    <div class="box-header">
        <div class="pull-left">
            <h3 class="box-title">
                <span class="glyphicon glyphicon-floppy-saved"></span> <?php echo $pageHeading;?>
            </h3>
        </div>
        <div class="pull-right"></div>
        <div class="clearfix"><!-- --></div>
    </div>
    <div class="box-body">
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($model, 'storage_path');?>
            <?php echo $form->textField($model, 'storage_path', $model->getHtmlOptions('storage_path', array('data-placement' => 'right'))); ?>
            <?php echo $form->error($model, 'storage_path');?>
        </div> 
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($model, 'auto_backup');?>
            <?php echo $form->dropDownList($model, 'auto_backup', $model->getAutoBackupDropDown(), $model->getHtmlOptions('auto_backup')); ?>
            <?php echo $form->error($model, 'auto_backup');?>
        </div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($model, 'auto_backup_frequency');?>
            <?php echo $form->textField($model, 'auto_backup_frequency', $model->getHtmlOptions('auto_backup_frequency')); ?>
            <?php echo $form->error($model, 'auto_backup_frequency');?>
        </div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($model, 'keep_max_backups');?>
            <?php echo $form->textField($model, 'keep_max_backups', $model->getHtmlOptions('keep_max_backups')); ?>
            <?php echo $form->error($model, 'keep_max_backups');?>
        </div>
        <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($model, 'success_notifications');?>
            <?php echo $form->textField($model, 'success_notifications', $model->getHtmlOptions('success_notifications')); ?>
            <?php echo $form->error($model, 'success_notifications');?>
        </div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($model, 'error_notifications');?>
            <?php echo $form->textField($model, 'error_notifications', $model->getHtmlOptions('error_notifications')); ?>
            <?php echo $form->error($model, 'error_notifications');?>
        </div>
        <div class="clearfix"><!-- --></div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
        </div>
        <div class="clearfix"><!-- --></div>
    </div>
</div>
<?php $this->endWidget(); ?>