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
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <span class="fa fa-star"></span>
            <?php echo ("Users List"); ?>
        </h3>

        <div>
            <div class="row">
                <div class="col-md-6">
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id . '/create'), array('class' => 'btn btn-primary', 'title' => Yii::t('app', 'Create new'))); ?>
                </div>
                <div class="col-md-6">
                    <input type="text" id="dateRange" class="form-control" style="margin-left: 10px;" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- Form to wrap the table and submit the priority updates -->
            <!-- <form method="post" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/index'); ?>"> -->

            <!-- CSRF Protection -->
            <!-- <?php if (Yii::app()->request->enableCsrfValidation) { ?>
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <?php } ?> -->
            <table id="usersList" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>User Group</th>
                        <th>Status</th>
                        <th>Date Added</th>
                        <th>Last Updated</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user->search()->getData() as $data) { ?>
                    <tr>
                        <td><?php echo CHtml::decode($data->first_name); ?></td>
                        <td><?php echo CHtml::decode($data->last_name); ?></td>
                        <td><?php echo CHtml::encode($data->email); ?></td>
                        <td><?php echo CHtml::encode($data->phone_number); ?></td>
                        <td>
                            <?php 
                                $groupNames = $user->getRulesArray();
                                $groupId = $data->rules;
                                echo CHtml::encode($groupNames[$groupId]); 
                            ?>
                        </td>                        <td><?php echo CHtml::encode($data->status); ?></td>
                        <td><?php echo CHtml::encode($data->dateAdded); ?></td>
                        <td><?php echo CHtml::encode($data->lastUpdated); ?></td>
                        <td>
                            <!-- <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/impersonate')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/impersonate', array('id' => $data->user_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>">
                                            <i class="fa fa-bar-chart"></i>
                                        </a>
                                    <?php } ?> -->
                            <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) { ?>
                            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->user_id)); ?>"
                                title="<?php echo Yii::t('app', 'Update'); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <?php } ?>

                            <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) { ?>
                            <a href="javascript:void(0);" data-id="<?php echo $data->user_id; ?>" class="delete-btn"
                                title="<?php echo Yii::t('app', 'Delete'); ?>" data-toggle="modal"
                                data-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- </form> -->
        </div>
    </div>
</div>
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
?>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="delete-form" method="post" action="">
                    <input type="hidden" name="<?php echo Yii::app()->request->csrfTokenName; ?>"
                        value="<?php echo Yii::app()->request->csrfToken; ?>" />
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- delete method  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('.delete-btn').click(function() {
        var userId = $(this).data('id');
        var actionUrl = '<?php echo Yii::app()->createUrl(Yii::app()->controller->id . "/delete"); ?>' +
            '?id=' + userId;
        $('#delete-form').attr('action', actionUrl);
    });
});
</script>


<!-- pagination  -->
<script>
$(document).ready(function() {
    $('#usersList').DataTable({
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
    // Initialize the date range picker
    $('#dateRange').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf('month')
            ]
        }
    }, function(start, end, label) {
        fetchFilteredData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });

    // Function to fetch filtered data
    function fetchFilteredData(startDate, endDate) {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl($this->route); ?>',
            type: 'GET',
            data: {
                startDate: startDate,
                endDate: endDate
            },
            success: function(data) {
                $('#<?php echo $model->modelName; ?>-grid').html($(data).find(
                    '#<?php echo $model->modelName; ?>-grid').html());
            }
        });
    }
    $('#exportExcel').click(function(e) {
        var dateRange = $('#dateRange').data('daterangepicker');
        var startDate = dateRange.startDate.format('YYYY-MM-DD');
        var endDate = dateRange.endDate.format('YYYY-MM-DD');
        var exportUrl = '<?php echo Yii::app()->createUrl('new_projects/exportExcel'); ?>';

        if (startDate && endDate) {
            exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' +
                encodeURIComponent(endDate);
            if (currentUrl.includes("trash")) {
                exportUrl += "&type=trash";
            }
        }


        // Redirect to the export URL
        window.location.href = exportUrl;
    });
});
</script>