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

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
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
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, "Banner Advertisement");?>
                </h3>
            </div>
            <div class="card-header-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php 
                // Begin HTML Table
                echo '<table id="banner-advertisement-table" class="display table table-bordered table-hover table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Position</th>';
                echo '<th>Status</th>';
                echo '<th>Banner</th>';
                echo '<th>Options</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($model->search()->getData() as $data) {
                    echo '<tr>';
                    echo '<td>'.CHtml::encode($data->position->position_name).'</td>';
                    echo '<td>'.CHtml::encode($data->status).'</td>';
                    echo '<td>';
                    echo '<div class="property_img_box1">';
                    echo '<div id="property_img_1" class="property_imgdivborder_approve">';
                    echo Yii::app()->easyImage->thumbOf(Yii::app()->basePath . '/../../uploads/banner/'.$data->image,
                        array(
                            'resize' => array('width' => 140, 'height' =>130,"master"=>EasyImage::RESIZE_AUTO),
                            'sharpen' => 20,
                            'background' => '#E7ED67',
                            'type' => 'jpg',
                            'quality' => 100
                        )
                    );
                    echo '</div>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo CHtml::link('Update', $this->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->banner_id)), array('class' => 'btn btn-primary btn-xs'));
                    echo CHtml::link('Delete', $this->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->banner_id)), array('class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("Are you sure you want to delete this item?")'));
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                ?>
            </div>    
        </div>
    </div>

    <?php 
    // Initialize DataTables
    Yii::app()->clientScript->registerScript('initialize-dataTables', "
        $(document).ready(function() {
            $('#banner-advertisement-table').DataTable({
                createdRow: function(row, data, index) {
                    $(row).addClass('selected');
                },
                language: {
                    paginate: {
                        next: '<i class=\"fa fa-angle-double-right\" style=\"line-height:40px;\" aria-hidden=\"true\"></i>',
                        previous: '<i class=\"fa fa-angle-double-left\" style=\"line-height:40px;\" aria-hidden=\"true\"></i>'
                    }
                }
            });
        });
    ");
}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
