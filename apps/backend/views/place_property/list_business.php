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
        /* Property Status Colors */
        .hot-property {
            color: #FF4500;
            /* Red or choose another suggested color */
        }

        .featured-property {
            color: #FFD700;
            /* Gold */
        }

        .verified-property {
            color: #28A745;
            /* Green */
        }

        .active-property {
            color: #007BFF;
            /* Blue */
        }

        .sold-property {
            color: #DC3545;
            /* Red */
        }

        /* Action Icon Colors */
        .edit-icon {
            color: #FFC107;
            /* Orange */
        }

        .delete-icon {
            color: #FF0000;
            /* Red */
        }

        .view-icon {
            color: #6C757D;
            /* Gray */
        }
    </style>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                <span class="fa fa-star"></span>
                <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title . " List"); ?>
            </h3>
            <div class="d-flex flex-wrap align-items-center">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id . '/create'), array('class' => 'btn btn-primary btn-sm me-2', 'title' => Yii::t('app', 'Create new'))); ?>
                <button type="button" id="exportExcel" class="btn btn-success btn-sm me-2">Export Excel</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    Excel Upload
                </button>
                <input type="text" id="dateRange" class="form-control ms-3 mt-2 mt-md-0" style="width: auto;" />
            </div>
        </div>
        <div class="card-body">

            <!-- Form to wrap the table and submit the priority updates -->
            <form method="post" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/business'); ?>">

                <!-- CSRF Protection -->
                <?php if (Yii::app()->request->enableCsrfValidation) { ?>
                    <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <?php } ?>
                    <div class="row">
                        <div class="col-sm-2" style="margin-bottom: 15px;">

                            <!-- <button type="button" class="btn btn-success btn-xs" data-bs-toggle="modal"
                                style="margin-top: -5px;" data-bs-target="#uploadModal">
                                Upload By Excel
                            </button> -->
                        </div>
                        <div class="col-sm-2">
                            <!-- <div class="form-group">
                                <label for="featured">
                                    <input type="checkbox" value="1" style="width:auto;height:auto;float:left; margin-right:10px;margin-top:2px;" id="featured">
                                    Featured
                                </label>
                            </div> -->
                        </div>
                        <div class="col-sm-2">
                            <!-- <div class="form-group">
                                <label for="verified">
                                    <input type="checkbox" value="1" style="width:auto;height:auto;float:left; margin-right:10px;margin-top:2px;" id="verified">
                                    Verified
                                </label>
                            </div> -->
                        </div>
                    </div>
                <div class="table-responsive">
                    <div class="bulk-actions pull-right mb-4">
                        <div class="form-group" style="width: 200px; display: inline-block;">
                            <select name="bulk-action" id="bulk-action-select" class="form-control input-xs">
                                <option value="">Select Action</option>
                                <option value="trash">Trash</option>
                                <option value="restore">Restore</option>
                                <option value="unpublish">Unpublish</option>
                                <option value="publish">Publish</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>
                        <button id="apply-bulk-action" type="button" class="btn btn-primary btn-sm"
                            style="height:50px;">Apply</button>
                    </div>
                    <table id="enquiryTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Reference Number</th>
                                <th>Ad Title</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Date Added</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- priority update button  -->
                <div class="box-footer" style="margin-top: 10px;">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-submit"
                            data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...'); ?>"><?php echo Yii::t('app', 'Update Priority'); ?></button>
                    </div>
                    <div class="clearfix">
                        <!-- -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Excel</h5>
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="excelFile">Excel File</label>
                            <input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xlsx,.xls">
                        </div>
                        
                        <button type="submit" class="pull-right btn btn-primary mt-4">Upload</button>
                    </form>
                    <div id="uploadStatus"></div>
                </div>
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

<!-- for button loading text  -->
<script>
    function confirmDelete(url) {
        // Show confirmation dialog
        if (confirm('Are you sure you want to delete this business opportiunity?')) {
            // If confirmed, proceed to the URL for deletion
            window.location.href = url;
        }
    }   
    $('#exportExcel').click(function(e) {
        e.preventDefault(); // Prevent default behavior

        var $button = $(this); // Reference to the button
        $button.prop('disabled', true); // Disable the button
        $button.text('Loading...'); // Change button text to indicate loading

        var dateRange = $('#dateRange').data('daterangepicker');
        var startDate = dateRange.startDate.format('YYYY-MM-DD');
        var endDate = dateRange.endDate.format('YYYY-MM-DD');
        var exportUrl = '<?php echo Yii::app()->createUrl('place_property/exportDataBusiness'); ?>'; // New action for JSON data

        // Build URL with date range
        if (startDate && endDate) {
            exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate);

            // Check if the current page has a type filter (e.g., trash)
            var currentUrl = window.location.href;
            exportUrl += "&type=business";
        }

        // Make AJAX request to retrieve JSON data
        $.ajax({
            url: exportUrl,
            type: 'GET',
            success: function(response) {
                // Convert JSON to Excel format using SheetJS
                var ws = XLSX.utils.json_to_sheet(response); // Convert JSON to sheet
                var wb = XLSX.utils.book_new(); // Create a new workbook
                XLSX.utils.book_append_sheet(wb, ws, "Sheet1"); // Append sheet to workbook

                // Trigger download of the Excel file
                XLSX.writeFile(wb, "ExportedData_" + new Date().toISOString().slice(0, 10) + ".xlsx");
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error); // Log any errors for debugging
                alert("An error occurred while exporting the data."); // Alert the user
            },
            complete: function() {
                $button.prop('disabled', false); // Re-enable the button
                $button.text('Export Excel'); // Reset button text
            }
        });
    });

    $(document).ready(function (){
        $('#select-all').on('change', function() {
            $('.bulk-item').prop('checked', this.checked);
        });

        $('#apply-bulk-action').on('click', function() {
            const action = $('#bulk-action-select').val();
            const selectedItems = $('.bulk-item:checked').map(function() {
                return $(this).val();
            }).get();
            var csrfToken = '<?php echo Yii::app()->request->csrfToken; ?>';
            if (action && selectedItems.length) {
                if (confirm('Are you sure you want to proceed with this action?')) {

                    // Perform an AJAX request to the backend
                    $.ajax({
                        url: '<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/bulk_action'); ?>', // Update with your action URL
                        type: 'GET',
                        data: {
                            bulk_action: action,
                            bulk_item: selectedItems,
                            YII_CSRF: csrfToken
                        },
                        success: function(response) {
                            // Handle successful response
                            window.location.reload(); // Reload the page to reflect changes
                        },
                        error: function(xhr) {
                            // Handle error
                            alert(
                                'An error occurred while processing your request. Please try again.'
                            );
                        }
                    });
                }
            } else {
                alert('Please select an action and at least one item.');
            }
        });
    });
    function submitFilters() {
        var selectedFilters = {};

        // Collect selected checkbox values
        if ($('#featured').is(':checked')) {
            selectedFilters['featured'] = $('#featured').val();
        }
        if ($('#verified').is(':checked')) {
            selectedFilters['verified'] = $('#verified').val();
        }
       
        // Convert the selected filters to query string parameters
        var queryString = $.param(selectedFilters, true);

        // Reload the page with the query parameters
        window.location.href = window.location.pathname + '?' + queryString;
    }


    // Attach the function to the checkboxes' change event
    $('#featured, #verified').change(submitFilters);
    $(document).ready(function() {
        // On form submit, change button text
        $('form').on('submit', function() {
            var $btn = $('.btn-submit');
            $btn.text($btn.data('loading-text')).prop('disabled', true);
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize the date range picker
        $('#dateRange').daterangepicker({
            locale: {
                 format: 'DD-MMM-YYYY'
            },
            startDate: moment('1900-01-01'),
            endDate: moment(),
            ranges: {
                'All Time': [moment('2020-01-01'), moment()],
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
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
                    $('#<?php echo $model->modelName; ?>-grid').html($(data).find(
                        '#<?php echo $model->modelName; ?>-grid').html());
                }
            });
        }
        $('#downloadTemplateBtn').click(function() {
            // Create a new workbook and add a worksheet
            var workbook = XLSX.utils.book_new();
            var worksheet_data = [
                [ 
                    'Category', 
                    'Sub Category', 
                    'Nested Sub Category', 
                    'Property Type',
                    'Ref No',
                    'Ad Title',
                    'Permit Number',
                    'Description',
                    'Location',
                    'Size',
                    'Asking Price',
                    'Revenue',
                    'Business Cash Flow',
                    'Business Valuation',
                    'Plot Area',
                    'Furnished',
                    'Construction Date',
                    'Contact Name',
                    'Contact Email',
                    'Mobile Number',
                    "Images (image1.png,image2.png,etc..)" 
                ]
            ];
            
            // Create worksheet from the data
            var worksheet = XLSX.utils.aoa_to_sheet(worksheet_data);

            // Define data validation for the 'Category' column ('For Sale' or 'For Rent')
            worksheet['A2'] = { v: '', t: 's' };
            worksheet['!ref'] = 'A1:P100'; // Define the range of the sheet
            worksheet['!dataValidations'] = [
                {
                    type: 'list',            // Set type to "list" for dropdowns
                    sqref: 'A2:A100',        // Apply the validation to the cells in column A (rows 2-100)
                    formulas: ['"For Sale,For Rent"'], // Only allow these two options
                    showDropDown: true       // Enable dropdown menu in Excel
                }
            ];

            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Template');

            // Write the workbook and download the Excel file
            XLSX.writeFile(workbook, 'template.xlsx');
        });
        
        var table = $('#enquiryTable').DataTable({
            "paging": true, // Enable pagination
            "lengthChange": true, // Allow users to change page length
            "searching": true, // Enable searching
            "ordering": true, // Enable sorting on columns
            "info": true, // Display table information
            "autoWidth": false, // Disable auto column width calculation
            "pageLength": 10,
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "<?php echo Yii::app()->createUrl('place_property/serverProcessingBusiness'); ?>", // Replace with your server URL
                "type": "POST",
                "data": function(d) {
                    var dateRangePicker = $('#dateRange').data('daterangepicker');
                    d.startDate         = dateRangePicker.startDate ? dateRangePicker.startDate.format('YYYY-MM-DD') : '';
                    d.endDate           = dateRangePicker.endDate ? dateRangePicker.endDate.format('YYYY-MM-DD') : '';
                }
            },
            "columns": [
                { "data": "id", "orderable": false, "className": "unsortable"  },
                { "data": "RefNo" },
                { "data": "ad_title" },
                { "data": "location" },
                { "data": "price" },
                { "data": "status" },
                { "data": "date_added" },
                { "data": "options" }
            ],
            createdRow: function(row, data, index) {
                $(row).addClass('selected');
            },
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" style="line-height:40px;" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" style="line-height:40px;" aria-hidden="true"></i>'
                }
            },


        });

        // Handle select all checkbox
        $('#selectAll').on('click', function() {
            var rows = $('#enquiryTable').DataTable().rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#selectAllFoot').on('click', function() {
            var rows = $('#enquiryTable').DataTable().rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#enquiryTable tbody').on('change', 'input[type="checkbox"]', function() {
            if (!this.checked) {
                var el = $('#selectAll').get(0);
                var elFoot = $('#selectAllFoot').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
                if (elFoot && elFoot.checked && ('indeterminate' in elFoot)) {
                    elFoot.indeterminate = true;
                }
            }
        });
    });
</script>