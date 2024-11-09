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

// and render if allowed
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
                    <span class="glyphicon glyphicon-book"></span> <?php echo Yii::t('areaguides', 'Listing Contents');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array($this->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="areaguide-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('areaguides', 'Area');?></th>
                            <th><?php echo Yii::t('areaguides', 'City');?></th>
                            <th><?php echo Yii::t('areaguides', 'Section');?></th>
                            <th><?php echo Yii::t('areaguides', 'Property Type');?></th>
                            <th><?php echo Yii::t('areaguides', 'Date Added');?></th>
                            <th><?php echo Yii::t('app', 'Options');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($areaguide->search()->getData() as $data): ?>
                            <tr>
                                <td><?php echo $data->getAreaText(); ?></td>
                                <td><?php echo $data->getCityText(); ?></td>
                                <td><?php echo CHtml::encode($data->sectionName); ?></td>
                                <td><?php echo CHtml::encode($data->p_typeName); ?></td>
                                <td><?php echo CHtml::encode($data->dateAdded); ?></td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess($this->id.'/view')): ?>
                                        <a href="<?php echo $data->permalink; ?>" target="_blank" title="<?php echo Yii::t('app', 'View'); ?>">
                                            <span class="fa fa-eye"></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (AccessHelper::hasRouteAccess($this->id.'/update')): ?>
                                        <a href="<?php echo Yii::app()->createUrl($this->id.'/update', array('id' => $data->areaguides_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (AccessHelper::hasRouteAccess($this->id.'/delete')): ?>
                                        <a href="<?php echo Yii::app()->createUrl($this->id.'/delete', array('id' => $data->areaguides_id)); ?>" class="delete" title="<?php echo Yii::t('app', 'Delete'); ?>">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#areaguide-table').DataTable({
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
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
