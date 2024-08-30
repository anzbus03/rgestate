<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// Render content if allowed
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
        .hide{
            display: none;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', '<i class="fa fa-keyboard-o"></i> Arabic Bulk Update'), Yii::app()->createUrl(Yii::app()->controller->id.'/index',array('bulk_update'=>'1','lan'=>'ar')), array('class' => 'btn btn-default btn-xs' , 'title' => Yii::t('app', 'Google Translate Arabic')));?>
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <div id="google_translate_element" class="pull-right"></div>
            <div class="table-responsive">
                <table id="category-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'Category Name'); ?></th>
                            <th><?php echo Yii::t('app', 'Plural'); ?></th>
                            <th><?php echo Yii::t('app', 'Slug'); ?></th>
                            <th><?php echo Yii::t('app', 'Image'); ?></th>
                            <th><?php echo Yii::t('app', 'Priority'); ?></th>
                            <th><?php echo Yii::t('app', 'Date Added'); ?></th>
                            <th><?php echo Yii::t('app', 'Last Updated'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { ?>
                        <tr>
                            <td><?php echo $data->category_name . '&nbsp;' . $data->getTranslateHtml("category_name"); ?></td>
                            <td><?php echo $data->plural . '&nbsp;' . $data->getTranslateHtml("plural"); ?></td>
                            <td><?php echo $data->slug . $data->SlugStr; ?></td>
                            <td><?php echo $data->CategoryImages; ?></td>
                            <td><?php echo CHtml::textField("priority[$data->category_id]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-control")); ?></td>
                            <td><?php echo $data->dateAdded; ?></td>
                            <td><?php echo $data->lastUpdated; ?></td>
                            <td>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/update')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->category_id)); ?>" class="btn btn-xs btn-primary" title="<?php echo Yii::t('app', 'Update'); ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                <?php } ?>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->category_id)); ?>" class="btn btn-xs btn-danger delete" title="<?php echo Yii::t('app', 'Delete'); ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#category-table').DataTable({
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
/**
 * This hook gives a chance to append content after the view file default content.
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
