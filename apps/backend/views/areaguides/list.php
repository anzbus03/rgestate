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

// Include DataTables CSS and JS
Yii::app()->clientScript->registerCssFile('//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css');
Yii::app()->clientScript->registerScriptFile('//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js', CClientScript::POS_END);

$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

if ($viewCollection->renderContent) { 
?>
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
        .hide{
            display: none;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-book"></span> <?php echo Yii::t('areaguides', 'Area Guides');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array('areaguides/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('areaguides/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="area-guides-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'City'); ?></th>
                            <th><?php echo Yii::t('app', 'Area'); ?></th>
                            <th><?php echo Yii::t('app', 'Image'); ?></th>
                            <th><?php echo Yii::t('app', 'Status'); ?></th>
                            <th><?php echo Yii::t('app', 'Date Added'); ?></th>
                            <th><?php echo Yii::t('app', 'Last Updated'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($areaguide->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo $data->getAreaText(); ?></td>
                                <td><?php echo $data->getCityText(); ?></td>
                                <td><?php echo $data->CategoryImages; ?></td>
                                <td><?php echo $data->statusText; ?></td>
                                <td><?php echo $data->dateAdded; ?></td>
                                <td><?php echo $data->lastUpdated; ?></td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/view')) { ?>
                                        <a href="<?php echo $data->permalink; ?>" title="<?php echo Yii::t('app', 'View'); ?>" target="_blank" class="btn btn-xs btn-secondary">
                                            <span class="fa fa-eye"></span>
                                        </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl('areaguides/update', array('id' => $data->areaguides_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>" class="btn btn-xs btn-primary">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl('areaguides/delete', array('id' => $data->areaguides_id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="btn btn-xs btn-danger delete">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>    
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#area-guides-table').DataTable({
                language: {
                    paginate: {
                        next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                        previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
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
