<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) { ?>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', '<i class="fa fa-keyboard-o"></i> Arabic Bulk Update'), Yii::app()->createUrl(Yii::app()->controller->id.'/index',array('bulk_update'=>'1','lan'=>'ar')), array('class' => 'btn btn-default btn-xs' , 'title' => Yii::t('app', 'Goole Translate Arabic')));?>
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
        </div>
        <div class="card-body">
            <div id="google_translate_element" class="pull-right"></div>
            <div class="table-responsive">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'enableAjaxValidation' => true,
                ));
                ?>
                <table id="data-table" class="display table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'Master Name'); ?></th>
                            <th><?php echo Yii::t('app', 'Category'); ?></th>
                            <th><?php echo Yii::t('app', 'Parent Name'); ?></th>
                            <th><?php echo Yii::t('app', 'Priority'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data): ?>
                        <tr>
                            <td><?php echo CHtml::encode($data->master_name); ?></td>
                         
                            <td><?php echo CHtml::encode($data->category_name); ?></td>
                            <td><?php echo CHtml::encode($data->parent_name); ?></td>
                            <td><?php echo CHtml::textField("priority[$data->master_id]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-control")); ?></td>
                            <td>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/update')): ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/update', array("id" => $data->master_id)); ?>" class="btn btn-xs btn-primary" title="<?php echo Yii::t('app', 'Update'); ?>">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')): ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array("id" => $data->master_id)); ?>" class="btn btn-xs btn-danger delete" title="<?php echo Yii::t('app', 'Delete'); ?>">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php $this->endWidget(); ?>
            </div>    
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update');?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                language: {
                    paginate: {
                        next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    }
                }
            });
        });
    </script>
<?php 
}
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
