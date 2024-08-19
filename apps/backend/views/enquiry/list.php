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
            <input type="text" id="dateRange" class="form-control " style="margin-left: 10px;" />
            </div>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <div class="row">
                    <div class="col-md-3">
                        <?php
                            echo CHtml::dropDownList(
                                'section_id',
                                $model->section_id,
                                $model->SectionList(),
                                array(
                                    'empty' => 'Please select',
                                    'class' => 'form-control',
                                    'onchange' => 'updateTable(this.value)'
                                )
                            );
                        ?>
                    </div>
                    <div class="col-md-9">
                        <button type="button" id="exportExcel" class="btn btn-success btn-sm pull-right" style="margin-right: 10px;">Export to Excel</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="enquiries" class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>AD</th>
                            <th>IP Address</th>
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
                                <td><?php echo CHtml::decode($data->PropertyDetail); ?></td>
                                <td><?php echo CHtml::encode($data->IpInfo); ?></td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/update')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'View'); ?>" onclick="loadthis(this, event)">
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
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>AD</th>
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
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
 

<div class="modal fade" id="myModal-details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height:100vh;min-height:500px; ">
        <div class="modal-content">
        <div class="modal-header">
              <button aria-hidden="true" data-bs-dismiss="modal" class="btn close" type="button">×</button>
              <h4 class="modal-title">AD Preview</h4>
            </div>
            <div class="modal-body p-4" id="result">
                
                <div class="row" id="m_frame">
                     
               
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn close" data-bs-dismiss="modal">&times;</button>
        <h4 class="modal-title">Property Enquiry</h4>
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
function openUrlFUll(k){
    $('#myModal-details').modal('show');
    
    $('#m_frame').html('<iframe id="ifrm" src="" style="width:100%;height:100%;border:0px;min-height:100vh;background-image:url(<?php echo Yii::App()->apps->getBaseUrl('assets/img/Ring-Preloader.gif');?>)" ></iframe>')
    var el = document.getElementById('ifrm');
    el.src = $(k).attr('data-url');
}
function updateTable(sectionId) {
    $.ajax({
        url: '<?php echo Yii::app()->createUrl('enquiry/updateTable'); ?>', // Update with your actual URL
        type: 'GET',
        data: { section_id: sectionId },
        success: function(response) {
            
            $('#enquiries').DataTable().clear();
            $('#enquiries tbody').html(response);
            
        },
        error: function() {enquiries
            alert('Error loading data');
        }
    });
}
$(document).ready(function() {
    
    $('#enquiries').DataTable({
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
        $.ajax({
            url: '<?php echo Yii::app()->createUrl($this->route); ?>',
            type: 'GET',
            data: {
                startDate: startDate,
                endDate: endDate
            },
            success: function(data) {
                $('#enquiries').html($(data).find('#enquiries').html());
            }
        });
    }
    $('#exportExcel').click(function(e) {
        var dateRange = $('#dateRange').data('daterangepicker');
        var startDate = dateRange.startDate.format('YYYY-MM-DD');
        var endDate = dateRange.endDate.format('YYYY-MM-DD');
        var exportUrl = '<?php echo Yii::app()->createUrl('enquiry/exportExcel'); ?>';

        if (startDate && endDate) {
            exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate);
        }

        // Redirect to the export URL
        window.location.href = exportUrl;    
    });
});

function loadthis(k,e){
	e.preventDefault();
	var href_url  = $(k).attr('href');
	$('#myModal').modal('show');$('#html_content').html('<p>Loading..</p>');
	$.get(href_url,function(data){ $('#html_content').html(data); })
}

</script>
