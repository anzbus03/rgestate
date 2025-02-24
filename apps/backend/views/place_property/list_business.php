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
        <?php
            function getCategoryName($categoryId, $categoriesArray)
            {
                return isset($categoriesArray[$categoryId]) ? $categoriesArray[$categoryId] : '';
            }

            // Retrieve ads and categories
            $db = Yii::app()->db;

            // Prepare the SQL query
            $sql = "SELECT category_id FROM mw_place_an_ad WHERE (section_id = 6)";

            // Execute the SQL query and fetch the results
            $command = $db->createCommand($sql);
            $ads = $command->queryAll();

            $categoryIds = array_unique(array_filter(array_column($ads, 'category_id')));
            $categories = Category::model()->findAllByAttributes(['category_id' => $categoryIds]);

            $categoriesArray = [];
            foreach ($categories as $category) {
                $categoriesArray[$category->category_id] = $category->category_name;
            }
            ?>

       
            <form method="post" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/business'); ?>">

                <!-- CSRF Protection -->
                    <?php if (Yii::app()->request->enableCsrfValidation) { ?>
                        <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                    <?php } ?>
                    <div class="row">
                        <!-- Select for Featured -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="featuredSelect">Featured</label>
                                <select name="featured" id="featuredSelect" class="form-control input-xs">
                                    <option value="">Select Featured</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="hotSelect">Hot</label>
                                <select name="hot" id="hotSelect" class="form-control input-xs">
                                    <option value="">Select Hot</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Select for Verified -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="verifiedSelect">Verified</label>
                                <select name="verified" id="verifiedSelect" class="form-control input-xs">
                                    <option value="">Select Verified</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Select for Category -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="categorySelect">Category</label>
                                <select class="form-control" name="property_category" id="propertyCategorySelect">
                                    <option value="">Select Property Category</option>
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->category_id; ?>">
                                        <?php echo ($category->category_name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <?php $locations = States::model()->AllStatesOfCountry(66124); ?>
                        <!-- Select for Location -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="locationSelect2">Location</label>
                                <select class="form-control" name="location" id="locationSelect2">
                                    <option value="">Select Location</option>
                                    <?php foreach ($locations as $location): ?>
                                    <option value="<?php echo $location->state_id; ?>">
                                        <?php echo CHtml::encode($location->state_name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 mt-2">
                            <div class="form-group">
                                <label for="StatusSelect">Status</label>
                                <select class="form-control" name="property_status" id="propertyStatusSelect">
                                    <option value="">Select Status</option>
                                    <option value="A">
                                        Active
                                    </option>
                                    <option value="I">
                                        Inactive
                                    </option>
                                    <option value="W">
                                        Waiting
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 text-right mt-4">
                            <button type="button" id="resetButton" class="btn btn-secondary btn-sm" style="margin-top: 20px;">
                                Reset
                            </button>
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
                                <th>Agent</th>
                                <th>Date Added</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <style>
                     #enquiryTable td {
                        white-space: nowrap; 
                        overflow: hidden; 
                        text-overflow: ellipsis; 
                        max-width: 200px; /* Adjust based on your requirement */
                    }

                    #enquiryTable td:hover {
                        overflow: visible; 
                        white-space: normal; 
                        word-wrap: break-word;
                        position: absolute;
                        background: #fff;
                        z-index: 10;
                        padding: 5px;
                        border: 1px solid #ddd;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                    }

                </style>
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
    <div id="assignAgent" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Agent</h5>
                    <button type="button" class="close btn" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="property_id">
                    <label for="agentSelect">Select an Agent:</label>
                    <select id="agentSelect" class="form-control"></select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="assignAgent()">Assign</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = new FormData(this); // Create FormData object from form

            // Handle Excel file
            var excelFile = $('#excelFile')[0].files[0];
            if (excelFile) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var data = new Uint8Array(event.target.result);
                    var workbook = XLSX.read(data, { type: 'array' });
                    var sheetName = workbook.SheetNames[0];
                    var sheet = workbook.Sheets[sheetName];

                    // Convert Excel data to JSON with line breaks handled
                    var json = XLSX.utils.sheet_to_json(sheet, { header: 1, raw: true });

                    // Replace \n with \\n in all cells to maintain spacing during transmission
                    json = json.map(row => 
                        row.map(cell => 
                            typeof cell === 'string' ? 
                            cell.replace(/["']/g, '') : cell
                        )
                    );

                    // Prepare the batches to send
                    var batchSize = 10; // Number of rows per batch
                    var totalRows = json.length;
                    var totalBatches = Math.ceil(totalRows / batchSize);
                    var currentBatch = 0;
                    let stack = 1; // Initialize stack counter
                    let updatedCount = 0;
                    let newCount = 0;
                    // Function to upload a batch of data
                    function sendBatch(batchIndex) {
                        var start = batchIndex * batchSize;
                        var end = Math.min(start + batchSize, totalRows)+1;
                        var batchData = json.slice(start, end);

                        var requestData = {
                            excelData: batchData, 
                            csrf_token: formData.get('csrf_token'),
                            batchIndex: batchIndex, // Batch index (1-based)
                            totalBatches: totalBatches // Total number of batches
                        };

                        // Make the AJAX request
                        $.ajax({
                            url: '<?php echo Yii::app()->createAbsoluteUrl("place_property/uploadExcelBusiness"); ?>',
                            type: 'POST',
                            contentType: 'application/json', // Set content type as JSON
                            data: JSON.stringify(requestData), // Convert the request data to JSON string
                            success: function(response) {
                                if (response.status === 'success') {
                                    newCount += response.newCount;
                                    updatedCount += response.updatedCount;
                                    $('#uploadStatus').html(`Stack ${stack}/${totalBatches} processed successfully.<br/>
                                        <strong>New properties: </strong> ${newCount}
                                        <strong>Updated properties: </strong> ${updatedCount}`);
                                } else {
                                    console.error(`Error in stack ${stack}:`, response.message);
                                }

                                if (stack < totalBatches) {
                                    stack++;
                                    setTimeout(() => {
                                        sendBatch(batchIndex + 1);
                                    }, 1300);
                                } else {
                                    $('#loadingBar').hide();
                                    $('#uploadStatus').html(`All stacks processed successfully.<br/>
                                        <strong>New properties: </strong> ${newCount}
                                        <strong>Updated properties: </strong> ${updatedCount}`);
                                    $('#enquiryTable').DataTable().ajax.reload();
                                }

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error('Error:', errorThrown);
                                $('#uploadStatus').text('Upload failed: ' + textStatus);
                                $('#loadingBar').hide();
                            }
                        });
                    }

                    // Start uploading from the first batch
                    $('#loadingBar').show();
                    $('#uploadStatus').text('Processing batch 1...');
                    sendBatch(0); // Start with the first batch
                };
                reader.readAsArrayBuffer(excelFile);
            }
        });

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

   
    function openUp3(propertyId) {
        $('#property_id').val(propertyId);

        $.ajax({
            url: '<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/getAgents'); ?>', // Adjust the URL based on your route structure
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                var userSelect = $('#agentSelect');
                userSelect.empty(); // Clear previous options

                if (response.length > 0) {
                    userSelect.append('<option value="">Select Agent</option>')
                    response.forEach(function (user) {
                        userSelect.append('<option value="' + user.id + '">' + user.name + '</option>');
                    });
                } else {
                    userSelect.append('<option value="">No agents available</option>');
                }

                $('#assignAgent').modal('show'); // Open the modal
            }
        });
    }
    function assignAgent() {
        var propertyId = $('#property_id').val();
        var userId = $('#agentSelect').val();

        if (!userId) {
            alert('Please select an agent.');
            return;
        }

        $.ajax({
            url: '<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/assignAgent'); ?>',
            type: 'POST',
            data: {
                property_id: propertyId,
                user_id: userId
            },
            success: function (response) {
                alert('Agent assigned successfully!');
                $('#assignAgent').modal('hide');
                $('#enquiryTable').DataTable().ajax.reload();
            }
        });
    }


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
            "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "<?php echo Yii::app()->createUrl('place_property/serverProcessingBusiness'); ?>", // Replace with your server URL
                "type": "POST",
                "data": function(d) {
                    var dateRangePicker = $('#dateRange').data('daterangepicker');
                    d.status            = $("#propertyStatusSelect").val();
                    d.featured          = $('#featuredSelect').val();
                    d.hot               = $('#hotSelect').val();
                    d.verified          = $('#verifiedSelect').val();
                    d.submited_by       = $('[name="submited_by"]').val();
                    d.property_category = $('#propertyCategorySelect').val();
                    d.location          = $('#locationSelect2').val();
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
                { "data": "agent","orderable": false  },
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
        $('#featuredSelect, #hotSelect, #verifiedSelect, #propertyStatusSelect, #preleasedSelect, #propertyCategorySelect, #locationSelect2, [name="submited_by"]').on('change', function () {
            table.ajax.reload();
        });

        // Reset Filters
        $('#resetButton').on('click', function (e) {
            e.preventDefault();
            $('#featuredSelect, #hotSelect, #verifiedSelect, #preleasedSelect,#propertyStatusSelect, #propertyCategorySelect, #locationSelect2, [name="submited_by"]').val('');
            table.ajax.reload();
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