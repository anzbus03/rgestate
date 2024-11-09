<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.5
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
if ($viewCollection->renderContent) {
    /**
     * @since 1.3.9.2
     */
    $itemsCount = UserGroup::model()->count();
    ?>
    <div class="card  ">
        <div class="card-header">
             <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-user"></span> <?php echo Yii::t('users', 'User Groups');?>
                </h3>
            </div>
              <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array($this->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            
        </div>
        <div class="card-body">
        
            <div class="table-responsive">
                <table id="groupsList" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Users Count</th>
                            <th>Date Added</th>
                            <th>Last Updated</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($group->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo CHtml::encode($data->name); ?></td>
                                <td><?php echo CHtml::encode($data->usersCount); ?></td>
                                <td><?php echo CHtml::encode($data->dateAdded); ?></td>
                                <td><?php echo CHtml::encode($data->lastUpdated); ?></td>
                                <td>
                                    <!-- Update Button -->
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl('user_groups/update', array('id' => $data->group_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    <?php } ?>
            
                                    <!-- Delete Button -->
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) { ?>
                                        <a href="javascript:void(0);" data-id="<?php echo $data->group_id; ?>" class="delete-btn" title="<?php echo Yii::t('app', 'Delete'); ?>" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fa fa-trash"></i>
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
    <script>
        $(document).ready(function() {

            $('#groupsList').DataTable({
                createdRow: function(row, data, index) {
                    $(row).addClass('selected');
                },
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
