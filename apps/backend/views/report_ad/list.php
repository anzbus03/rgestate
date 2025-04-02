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
                <span class="fa fa-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
            </h3>
            <div>
            <!-- <input type="text" id="dateRange" class="form-control " style="margin-left: 10px;" /> -->
            </div>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <button type="button" id="exportExcel" class="btn btn-success btn-sm pull-right" style="margin-right: 10px;">Export to Excel</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="spamReportList" class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>AD</th>
                            <th>Report Reason</th>
                            <th>Reported By</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { 
                            ?>
                            
                            <tr>
                                <td><?php echo CHtml::decode($data->PropertyDetail); ?></td>
                                <td><?php echo CHtml::encode($data->master->master_name); ?></td>
                                <td><?php echo CHtml::encode($data->name); ?></td>
                                <td><?php echo CHtml::encode($data->statusTitle); ?></td>
                                <td><?php echo CHtml::encode($data->dateAdded); ?></td>
                                <td>    
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/update')) { ?>
                                        <a class="btn btn-sm p-1" href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'View'); ?>" onclick="loadthis(this, event)">
                                            <span class="fa fa-eye"></span>
                                        </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')) { ?>
                                        <a class="btn btn-sm p-1" href="javascript:void(0)" onclick="confirmDelete('<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->id)); ?>')" title="<?php echo Yii::t('app', 'Delete'); ?>">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>AD</th>
                            <th>Report Reason</th>
                            <th>Reported By</th>
                            <th>Status</th>
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

    $('#exportExcel').click(function(e) {
        var exportUrl = '<?php echo Yii::app()->createUrl('report_ad/exportExcel'); ?>';
        window.location.href = exportUrl;
    });
    function confirmDelete(url) {
        if (confirm('Are you sure you want to delete?')) {
            window.location.href = url;
        }
    }
    $(document).ready(function() {
        $('#spamReportList').DataTable({
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
    });
    $("#iframe").fancybox({
        'width'         : '600px',
        'title'			:"View",
        'autoScale'     : false,
        'transitionIn'  : 'none',
        'transitionOut' : 'none',
        'type'          : 'iframe',
        'titleShow'		: false,
    });
</script>

