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
                <span class="fa fa-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title . " List"); ?>
            </h3>
            <div>
                <!-- <input type="text" id="dateRange" class="form-control " style="margin-left: 10px;" /> -->
            </div>
            <div class="pull-right">
                  <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
          <div class="clearfix"><!-- --></div>
      		 <div class="clearfix">
        <div class="box-body">
            <div class="table-responsive">
                <table id="careerList" class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date Added</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) {
                        ?>

                            <tr>
                                <td><?php echo CHtml::encode($data->name); ?></td>
                                <td><?php echo CHtml::encode($data->email); ?></td>
                                <td><?php echo CHtml::encode($data->phone); ?></td>
                                <td><?php echo CHtml::encode($data->dateAdded); ?></td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'View'); ?>" onclick="loadthis(this, event)">
                                            <span class="fa fa-eye"></span>
                                        </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete">
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
                            <th>Date Added</th>
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
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>




<script>
    $(document).ready(function() {
        $('#careerList').DataTable({
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

    function UpdateEmailReceivers(k) {
        var id = $(k).attr('data-id');
        if (id !== undefined) {
            $.get('<?php echo Yii::app()->createUrl('dashboard/get_email_receicers'); ?>/id/' + id, function(data) {
                var data = JSON.parse(data);
                if (data.status == '0') {
                    alert('No Email Template Found');

                } else if (data.status == '1') {
                    $('#email_receivers').modal('show');
                    $('#email_list').val(data.receiver_list);
                }
            })
        }

    }

    function updateReceiveList(k) {
        var id = $(k).attr('data-id');
        if ($('#email_list').val() == '') {
            alert('Please enter atleast one email address');
            $('#email_list').focus();
            return false;
        }
        if (id !== undefined) {
            $.post('<?php echo Yii::app()->createUrl('dashboard/set_email_receicers'); ?>/id/' + id, {
                val: $('#email_list').val()
            }, function(data) {
                var data = JSON.parse(data);
                if (data.status == '0') {
                    alert('No Email Template Found');

                } else if (data.status == '1') {
                    alert('Updated email receivers');
                }
            })
        }

    }
</script>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn close" data-bs-dismiss="modal">&times;</button>
                <h4 class="modal-title">Contact Us</h4>
            </div>
            <div class="modal-body" id="html_content">
                <p>Loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
    function loadthis(k, e) {
        e.preventDefault();
        var href_url = $(k).attr('href');
        $('#myModal').modal('show');
        $('#html_content').html('<p>Loading..</p>');
        $.get(href_url, function(data) {
            $('#html_content').html(data);
        })
    }
</script>