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

if ($viewCollection->renderContent) { ?>
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
    }

    .card-header-left {
        flex: 1;
    }

    .card-header-right {
        display: flex;
        gap: 10px;
    }

    .card-header-right .btn {
        margin-left: 5px;
    }
</style>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, "Home Banner");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <?php echo CHtml::link(Yii::t('app', 'Update Banner Cache'), Yii::app()->createUrl(Yii::app()->controller->id.'/index',array('update_cache'=>'1')), array('class' => 'btn btn-success btn-xs mb-4', 'title' => Yii::t('app', 'Update Cache')));?>
            <div class="table-responsive">
                <table id="home-banner-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { ?>
                            <tr>
                                <td>
                                    <div class='property_img_box1'>
                                        <div id='property_img_1' class='property_imgdivborder_approve' style='background-image:url(<?php echo $data->BannerLink; ?>); width:100px; height:60px; background-position: center top; background-size: cover; background-repeat: no-repeat;'></div>
                                    </div>
                                </td>
                                <td><?php echo CHtml::encode($data->FTitle); ?></td>
                                <td><?php echo CHtml::encode($data->country->country_name); ?></td>
                                <td><?php echo CHtml::encode($data->status); ?></td>
                                <td><?php echo CHtml::textField("priority[$data->banner_id]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-control")); ?></td>
                                <td>
                                    <?php echo CHtml::link(' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->banner_id)), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Update'))); ?>
                                    <?php echo CHtml::link(' &nbsp; <span class="fa fa-trash"></span> &nbsp;', Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->banner_id)), array('class' => 'btn btn-danger btn-xs', 'title' => Yii::t('app', 'Delete'), 'onclick' => 'return confirm("Are you sure you want to delete this item?")')); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update Priority');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
    </div>

    <?php 
    Yii::app()->clientScript->registerScript('initialize-dataTables', "
        $(document).ready(function() {
            $('#home-banner-table').DataTable({
                language: {
                    paginate: {
                        next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                        previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
                    }
                }
            });
        });
    ");
}
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
