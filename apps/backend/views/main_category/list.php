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
                <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
            </h3>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo CHtml::link(Yii::t('app', '<i class="fa fa-keyboard-o"></i> Arabic Bulk Update'), Yii::app()->createUrl(Yii::app()->controller->id.'/index',array('bulk_update'=>'1','lan'=>'ar')), array('class' => 'btn btn-default btn-xs' , 'title' => Yii::t('app', 'Goole Translate Arabic')));?>
                    </div>
                    <div class="col-md-6 mt-2">
                        <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
			<div id="google_translate_element" class="pull-right"></div>
            <div class="table-responsive">
                <table id="categoryTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <!-- <th>Bulk Update</th> -->
                            <th>Date Added</th>
                            <th>Last Updated</th>
                            <th>Priority</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->data as $data): ?>
                            <tr>
                                <td>
                                    <span><?php echo $data->category_name; ?></span>
                                    <?php// echo $data->getTranslateHtml("category_name"); ?>
                                </td>
                                <td><?php echo $data->slug; ?></td>
                                <!-- <td style="width:250px;text-align:center;<?php $data->BulkUpdateText ? 'display:block;' : 'display:block;'; ?>" class="form-control">
                                    <?php //echo $data->BulkUpdateText; ?>
                                </td> -->
                                <td style="width:150px;text-align:right;"><?php echo $data->dateAdded; ?></td>
                                <td style="width:150px;text-align:right;"><?php echo $data->lastUpdated; ?></td>
                                <td style="width:50px;text-align:center">
                                    <?php echo CHtml::textField("priority[{$data->category_id}]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-control")); ?>
                                </td>
                                <td style="width:70px;">
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->category_id)); ?>" title="Update">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array('id' => $data->category_id)); ?>" title="Delete" class="delete">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
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
        $('#categoryTable').DataTable({
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

        // Function to fetch filtered data
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
                    $('#<?php echo $model->modelName; ?>-grid').html($(data).find('#<?php echo $model->modelName; ?>-grid').html());
                }
            });
        }
        $('#exportExcel').click(function(e) {
            var dateRange = $('#dateRange').data('daterangepicker');
            var startDate = dateRange.startDate.format('YYYY-MM-DD');
            var endDate = dateRange.endDate.format('YYYY-MM-DD');
            var exportUrl = '<?php echo Yii::app()->createUrl('new_projects/exportExcel'); ?>';

            if (startDate && endDate) {
                exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate);
                if (currentUrl.includes("trash")) {
                    exportUrl += "&type=trash";
                }
            }
                

            // Redirect to the export URL
            window.location.href = exportUrl;    
        });
    });
 </script>
 

