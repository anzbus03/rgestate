<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @version 1.0
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with custom content.
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
                <span class="fa fa-star"></span> <?php echo $pageHeading;?>
            </h3>
            <div>
                <input type="text" id="dateRange" class="form-control " style="margin-left: 10px;" />
            <!-- <?php // echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-sm', 'title' => Yii::t('app', 'Refresh')));?> -->
            </div>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <div class="row">
                    <div class="col-md-12">

                        <a href="javascript:void(0)" class="pull-right">
                            <button 
                                type="button" 
                                class="btn btn-primary btn-sm float-right" 
                                style="margin-right:0px;" 
                                data-id="<?php echo $template_id='az3438eqlm2fc';$template_id;?>" 
                                onclick="UpdateEmailReceivers(this)">
                                <i class="fa fa-pencil-square-o"></i>
                                Update Email Receivers
                            </button>
                        </a>
                        <button type="button" id="exportExcel" class="btn btn-success btn-sm pull-right" style="margin-right: 10px;">Export to Excel</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="contactUs" class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>IP Address</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo CHtml::encode($data->name); ?></td>
                                <td><?php echo CHtml::encode($data->email); ?></td>
                                <td><?php echo CHtml::encode($data->phone); ?></td>
                                <td><?php echo CHtml::encode($data->date); ?></td>
                                <td><?php echo CHtml::encode($data->IpInfo); ?></td>
                                <td>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/view')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/view', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'View'); ?>" onclick="loadthis(this, event)">
                                        <span class="fa fa-eye"></span>
                                    </a>
                                <?php } ?>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                <?php } ?>
                            </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>IP Address</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
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

<!-- Update Email Receivers Modal -->
<div id="email_receivers" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn close" data-bs-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Email Receivers</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="email_list">Add Email address:</label>
          <textarea id="email_list" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label><b>How to add</b></label>
          <p>Add receivers email address separated with <b>comma</b>.<br /> eg:- admin@rgestate.com, support@rgestate.com </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-id="<?php echo $template_id;?>" onclick="updateReceiveList(this)">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Contact Us Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn close" data-bs-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Us</h4>
      </div>
      <div class="modal-body" id="html_content">
        <p>Loading...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function loadthis(element, event) {
    event.preventDefault();
    var hrefUrl = $(element).attr('href');
    $('#myModal').modal('show');
    $('#html_content').html('<p>Loading...</p>');
    $.ajax({
        url: hrefUrl,
        type: 'GET',
        success: function(data) {
            $('#html_content').html(data);
        },
        error: function() {
            $('#html_content').html('<p>An error occurred while loading the content.</p>');
        }
    });
}
$(document).ready(function() {
    $('#contactUs').DataTable({
        createdRow: function (row, data, index) {
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
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, function(start, end, label) {
        fetchFilteredData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });

    function fetchFilteredData(startDate, endDate) {
        window.location.href = '<?php echo Yii::app()->createUrl($this->route); ?>?startDate=' + startDate + '&endDate=' + endDate; 
        $.ajax({
            url: '<?php echo Yii::app()->createUrl($this->route); ?>',
            type: 'GET',
            data: {
                startDate: startDate,
                endDate: endDate
            },
            success: function(data) {
                $('#contactUs').html($(data).find('#contactUs').html());
            }
        });
    }

    $('#exportExcel').click(function(e) {
        var dateRange = $('#dateRange').data('daterangepicker');
        var startDate = dateRange.startDate.format('YYYY-MM-DD');
        var endDate = dateRange.endDate.format('YYYY-MM-DD');
        var exportUrl = '<?php echo Yii::app()->createUrl('contact_us/exportExcel'); ?>';

        if (startDate && endDate) {
            exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate);
        }

        window.location.href = exportUrl;
    });
});

function UpdateEmailReceivers(elem){
    var template_id = $(elem).attr("data-id");
    $("#email_receivers .btn-primary").attr("data-id",template_id);
    $("#email_receivers").modal("show");
}

function updateReceiveList(elem){
    var emails = $("#email_list").val();
    var template_id = $(elem).attr("data-id");

    $.ajax({
        url: '<?php echo Yii::app()->createUrl($this->route.'/UpdateEmailReceivers'); ?>',
        type: 'POST',
        data: {
            template_id: template_id,
            email_list: emails
        },
        success: function(response) {
            if(response.status == "success") {
                $("#email_receivers").modal("hide");
                alert("Email receivers updated successfully.");
            } else {
                alert("An error occurred. Please try again.");
            }
        }
    });
}
</script>
