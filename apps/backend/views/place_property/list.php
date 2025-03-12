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
    <?php if (isset($_GET['message'])): ?>
    <div class="alert alert-success">
        <?php echo CHtml::encode($_GET['message']); // Display the success message 
                ?>
    </div>
    <?php endif; ?>
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

    <div class="card-body" style="padding-top: 0px;">

        <?php
            function getCategoryName($categoryId, $categoriesArray)
            {
                return isset($categoriesArray[$categoryId]) ? $categoriesArray[$categoryId] : '';
            }

            // Retrieve ads and categories
            $db = Yii::app()->db;

            // Prepare the SQL query
            $sql = "SELECT category_id FROM mw_place_an_ad WHERE (section_id = 1 OR section_id = 2)";

            // Execute the SQL query and fetch the results
            $command = $db->createCommand($sql);
            $ads = $command->queryAll();

            $categoryIds = array_unique(array_filter(array_column($ads, 'category_id')));
            // echo "<pre>";
            // print_r($categoryIds);
            // exit;
            // Fetch categories based on category IDs
            $categories = Category::model()->findAllByAttributes(['category_id' => $categoryIds]);

            // Build the categories array
            $categoriesArray = [];
            foreach ($categories as $category) {
                $categoriesArray[$category->category_id] = $category->category_name;
            }
        ?>

        <!-- Form to wrap the table and submit the priority updates -->
        <div class="card-body">
            <!-- Checkboxes and Dropdown -->
            <form method="GET" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/index'); ?>">

                <div class="row" style="margin-bottom: 10px;margin-top: 10px;">
                    <!-- Upload by Excel Button -->

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

                    <!-- Select for Preleased -->
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="preleasedSelect">Preleased</label>
                            <select name="preleased" id="preleasedSelect" class="form-control input-xs">
                                <option value="">Select Preleased</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <!-- Dropdown for Submitted Properties -->
                    <div class="col-sm-3 mt-2">
                        <div class="form-group">
                            <label for="f_properties">Submitted By</label>
                            <?php echo CHtml::dropDownList('submited_by', $model->submited_by, $model->getsubmited_by_array(), array('empty' => 'Please select', 'class' => 'form-control')); ?>

                        </div>
                    </div>

                    <!-- Select for Category -->
                    <div class="col-sm-3 mt-2">
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

                    <!-- <?php $locations = States::model()->AllStatesOfCountry(66124); ?> -->
                    <!-- Select for Category -->
                    <div class="col-sm-3 mt-2 hide">
                        <div class="form-group">
                            <label for="locationSelect">Location</label>
                            <select class="form-control" name="location" id="locationSelect">
                                <option value="">Select Location</option>
                                <?php foreach ($locations as $location): ?>
                                <option value="<?php echo $location->state_id; ?>">
                                    <?php echo CHtml::encode($location->state_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <?php $locations = States::model()->AllStatesOfCountry(66124); ?>
                    <!-- Select for Location -->
                    <div class="col-sm-3 mt-2">
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
                      <!-- Select for Category -->
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
                        <button type="button" class="btn btn-primary btn-sm" style="margin-top: 20px;" onclick="$('#enquiryTable').DataTable().ajax.reload();">
                            Apply Filters
                        </button>
                        <button type="button" id="resetButton" class="btn btn-secondary btn-sm" style="margin-top: 20px;">
                            Reset
                        </button>
                    </div>

                </div>

            </form>


            <form method="post" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/index'); ?>">

                <!-- CSRF Protection -->
                <?php if (Yii::app()->request->enableCsrfValidation) { ?>
                <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <?php } ?>

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
                    <!-- <div class="bulk-actions pull-right mb-4">
                        <select id="bulk-action-select" class="form-control-sm"
                            style="width: 200px; display: inline-block;">
                            <option value="">Select Action</option>
                            <option value="trash">Trash</option>
                            <option value="restore">Restore</option>
                            <option value="unpublish">Unpublish</option>
                            <option value="publish">Publish</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button id="apply-bulk-action" type="button" class="btn btn-primary btn-sm">Apply</button>
                    </div> -->


                    <table id="enquiryTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Reference Number</th>
                                <th>Ad Title</th>
                                <!-- <th>Country Name</th> -->
                                <th>Section</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>State</th>
                                <th>Refresh Date</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </form>
            <!-- priority update button  -->
            <div class="box-footer">
                <div class="pull-right">
                    <!-- <button type="submit" class="btn btn-primary btn-submit"
                        data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...'); ?>"><?php echo Yii::t('app', 'Update Priority'); ?></button> -->
                </div>
            </div>

        </div>
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


    <!-- to upload excel file and image  -->
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
                        <?php echo CHtml::hiddenField(Yii::app()->request->csrfTokenName, Yii::app()->request->csrfToken); ?>

                        <div class="form-group">
                            <label for="    ">Excel File</label>
                            <input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xlsx,.xls">
                        </div>
                        <button type="submit" class="pull-right btn btn-primary mt-4">Upload</button>
                    </form>
                    <div id="uploadStatus"></div>

                    <!-- Loading bar (hidden initially) -->
                    <div id="loadingBar" style="display: none; margin-top: 20px;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Uploading...</span>
                        </div>
                        <span class="ml-2">Uploading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sold Property Modal -->
    <!-- Modal for changing property availability -->
    <div class="modal fade" id="availabilityModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Property Availability</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="availabilityForm" method="POST" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/updateavailability'); ?>">
                        <!-- Hidden input to store property_id -->
                        <input type="hidden" id="propertyIdInput" name="Property[place_an_ad_id]">

                        <!-- Availability Dropdown -->
                        <div class="form-group">
                            <label for="availabilitySelect">Availability</label>
                            <select id="availabilitySelect" name="Property[availability]" class="form-control" required>
                                <option value="">Select Availability</option>
                                <option value="available">Available</option>
                                <option value="not_available">Not Available</option>
                            </select>
                        </div>

                        <!-- Reason Dropdown (shown when not available) -->
                        <div class="form-group d-none mt-2" id="reasonContainer">
                            <label for="reasonSelect">Reason</label>
                            <select id="reasonSelect" name="Property[reason]" class="form-control">
                                <option value="">Select Reason</option>
                                <option value="sold_out">Sold Out</option>
                                <option value="lease_out">Lease Out</option>
                                <option value="not_available">Not Available</option>
                            </select>
                        </div>

                        <!-- Sold Price Input (shown when reason is sold out) -->
                        <div class="form-group d-none mt-2 mb-2" id="soldPriceContainer">
                            <label for="soldPriceInput">Sold Price</label>
                            <input type="text" id="soldPriceInput" placeholder="Sold Price" name="Property[sold_price]" class="form-control">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(url) {
            // Show confirmation dialog
            if (confirm('Are you sure you want to delete this property?')) {
                // If confirmed, proceed to the URL for deletion
                window.location.href = url;
            }
        }
        document.getElementById('availabilitySelect').addEventListener('change', function () {
            const reasonContainer = document.getElementById('reasonContainer');
            const soldPriceContainer = document.getElementById('soldPriceContainer');

            if (this.value === 'not_available') {
                reasonContainer.classList.remove('d-none');
            } else {
                reasonContainer.classList.add('d-none');
                soldPriceContainer.classList.add('d-none');
            }
        });

        document.getElementById('reasonSelect').addEventListener('change', function () {
            const soldPriceContainer = document.getElementById('soldPriceContainer');
            if (this.value === 'sold_out') {
                soldPriceContainer.classList.remove('d-none');
            } else {
                soldPriceContainer.classList.add('d-none');
            }
        });
    </script>


    <style>
        /* Select2 Container Styles */
        .select2-selection--single {
            background-color: #ffffff !important;
            /* White background */
            border: 1px solid #ced4da !important;
            /* Light border color */
            border-radius: 4px !important;
            /* Rounded corners */
            height: 40px !important;
            /* Height of the select box */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
            /* Subtle shadow */
            transition: border-color 0.2s !important;
        }

        /* Focus and Hover Styles */
        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--single:hover {
            border-color: #007bff;
            /* Border color on focus/hover */
        }

        /* Selected Item Styles */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057;
            /* Text color */
            line-height: 38px;
            /* Vertically center the text */
        }

        /* Placeholder Styles */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6c757d;
            /* Placeholder color */
            line-height: 38px;
            /* Vertically center the placeholder */
        }

        /* Dropdown Arrow Styles */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px;
            /* Adjust height of arrow */
        }

        /* Dropdown Menu Styles */
        .select2-container--default .select2-results__option {
            color: #495057;
            /* Text color for dropdown options */
            padding: 10px 15px;
            /* Padding for options */
            cursor: pointer;
            /* Pointer cursor on options */
        }

        /* Hover Effect on Dropdown Options */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #007bff;
            /* Highlight background color */
            color: #ffffff;
            /* Highlight text color */
        }

        /* Disabled State Styles */
        .select2-container--default .select2-selection--single .select2-selection__clear {
            display: none;
            /* Hide clear option for single selection */
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
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
                                $('#enquiryTable').DataTable().ajax.reload(); // Reload the page to reflect changes
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
            $('#locationSelect').select2({
                placeholder: 'Select Location',
                allowClear: true
            });
        });

        function resetFilters() {
            document.getElementById('filterForm').reset();
            filterProperties('all'); // Show all properties again
        }

        function openUp2(propertyId) {
            // Set the property ID in the hidden input field of the form
            $('#propertyIdInput').val(propertyId);
            // Show the modal
            $('#availabilityModal').modal('show');
        }

        // AJAX form submission for creating a new sold property record
        $('#soldPropertyForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var $submitButton = $(this).find('button[type="submit"]'); // Find the submit button
            var originalButtonText = $submitButton.text(); // Store the original button text

            // Update the button text to indicate the processing state
            $submitButton.text('Please wait, processing...');
            $submitButton.prop('disabled', true); // Disable the button to prevent multiple submissions

            $.ajax({
                url: '<?php echo Yii::app()->createUrl("place_property/markAsSold"); ?>', // Controller action URL for markAsSold action
                type: 'POST',
                data: $(this).serialize(), // Serialize the form data
                success: function(response) {
                    // Close the modal after successful submission
                    $('#soldPropertyModal').modal('hide');

                    // Redirect to place_property/index after successful creation
                    window.location.href =
                        '<?php echo Yii::app()->createUrl("place_property/index", array('message' => 'Property marked as sold successfully.')); ?>';
                },
                error: function() {
                    alert('An error occurred while marking the property as sold.');

                    // Re-enable the button and revert the text in case of an error
                    $submitButton.text(originalButtonText);
                    $submitButton.prop('disabled', false);
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
    ?>

    <!-- for button loading text  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
    $(document).ready(function() {
        // On form submit, change button text
        $('form').on('submit', function() {
            var $btn = $('.btn-submit');
            $btn.text($btn.data('loading-text')).prop('disabled', true);
        });
    });
    $(document).ready(function () {

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
                                url: '<?php echo Yii::app()->createAbsoluteUrl("place_property/uploadExcel"); ?>',
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


    });

    function reloadTable() {
        $('#enquiryTable').DataTable().ajax.reload();
    }

    $(document).ready(function() {
        function getPathParameter(key) {
            const path = window.location.pathname.split('/');
            const index = path.indexOf(key);
            return index !== -1 && path[index + 1] ? path[index + 1] : ''; // Return the value if found
        }


        const status = getPathParameter('status');
        const sectionId = getPathParameter('section_id');
        const preleased = getPathParameter('preleased');

        $(document).on('click', '.refresh-date', function(e) {
            e.preventDefault(); // Prevent the default link behavior

            const adId = $(this).data('id'); // Get the ad ID from data attribute
            const url = $(this).attr('href'); // Get the URL from the href attribute

            // Show a loading state or spinner if needed
            const $dateDisplay = $(`#date-display-${adId}`);
            $dateDisplay.text('Updating...');

            // Perform the AJAX request
            $.ajax({
                url: url,
                type: 'POST', // or 'GET' if your backend expects GET
                dataType: 'json', // Expect a JSON response
                success: function(response) {
                    if (response.success) {
                        // Update the date display with the new date
                        $dateDisplay.text(response.newDate);
                    } else {
                        // Handle error, e.g., show a message
                        $dateDisplay.text('Error');
                        alert(response.message || 'Failed to refresh date.');
                    }
                },
                error: function() {
                    // Handle server or network error
                    $dateDisplay.text('Error');
                    alert('An error occurred while refreshing the date.');
                }
            });
        });

        // Initialize the date range picker
        $('#dateRange').daterangepicker({
            locale: {
                format: 'DD-MMM-YYYY'
            },
            startDate: moment('1900-01-01'), // Set default start date for "All Time"
            endDate: moment(),
            ranges: {
                'Today': [moment().startOf('day'), moment().endOf('day')],
                'Yesterday': [moment().startOf('day').subtract(1, 'days'), moment().endOf('day').subtract(1, 'days')],
                'Last 7 Days': [moment().startOf('day').subtract(6, 'days'), moment().endOf('day')],
                'Last 30 Days': [moment().startOf('day').subtract(29, 'days'), moment().endOf('day')],
                'This Month': [moment().startOf('day').startOf('month'), moment().endOf('day').endOf('month')],
                'Last Month': [moment().startOf('day').subtract(1, 'month').startOf('month'), moment().endOf('day').subtract(1, 'month').endOf('month')],
                'All Time': [moment('2020-01-01'), moment()]
            }
        }, function(start, end, label) {
            
            $('#dateRange').val(start.format('DD-MMM-YYYY') + ' - ' + end.format('DD-MMM-YYYY'));
            fetchFilteredData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });


        // Function to fetch filtered data
        function fetchFilteredData(startDate, endDate) {
            $('#enquiryTable').DataTable().ajax.reload();
            // window.location.href = '<?php // echo Yii::app()->createUrl($this->route); ?>?startDate=' + startDate +
            //     '&endDate=' + endDate;

        }
        $('#exportExcel').click(function(e) {
            e.preventDefault(); // Prevent default behavior

            var $button = $(this); // Reference to the button
            $button.prop('disabled', true); // Disable the button
            $button.text('Loading...'); // Change button text to indicate loading

            var dateRange = $('#dateRange').data('daterangepicker');
            var startDate = dateRange.startDate.format('YYYY-MM-DD');
            var endDate = dateRange.endDate.format('YYYY-MM-DD');
            var exportUrl = '<?php echo Yii::app()->createUrl('place_property/exportData'); ?>'; // New action for JSON data

            // Build URL with date range
            if (startDate && endDate) {
                exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate);

                // Check if the current page has a type filter (e.g., trash)
                var currentUrl = window.location.href;
                if (currentUrl.includes("trash")) {
                    exportUrl += "&type=trash";
                }
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

        
        var table = $('#enquiryTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false, 
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "<?php echo Yii::app()->createUrl('place_property/serverProcessing'); ?>", // Replace with your server URL
                "type": "POST",
                "data": function(d) {
                    var dateRangePicker = $('#dateRange').data('daterangepicker');
                    d.startDate         = dateRangePicker.startDate ? dateRangePicker.startDate.format('YYYY-MM-DD') : '';
                    d.endDate           = dateRangePicker.endDate ? dateRangePicker.endDate.format('YYYY-MM-DD') : '';
                    d.featured          = $('#featuredSelect').val();
                    d.hot               = $('#hotSelect').val();
                    d.verified          = $('#verifiedSelect').val();
                    d.preleased         = $('#preleasedSelect').val();
                    d.submited_by       = $('[name="submited_by"]').val();
                    d.property_category = $('#propertyCategorySelect').val();
                    d.status            = $('#propertyStatusSelect').val();
                    d.location          = $('#locationSelect2').val();
                    d.section_id        = sectionId;
                    d.preleasedR        = preleased;
                }
            },
            "columns": [
                { "data": "id", "orderable": false, "className": "unsortable"  },
                { "data": "RefNo" },
                { "data": "ad_title" },
                { "data": "section" },
                { "data": "price" },
                { "data": "category" },
                { "data": "status" },
                { "data": "priority" },
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


    <!-- update latest date -->
    <script>
    $(document).ready(function() {
        // $('.refresh-date').on('click', function(e) {
        //     e.preventDefault(); // Prevent the default action of the anchor tag

        //     // Get the new date from the data attribute
        //     var newDate = $(this).data('ldate');

        //     // Update the displayed date
        //     $(this).closest('td').find('.date-display').text(newDate);
        // });
    });
    </script>
    <style>
        th.unsortable {
            background-image: none !important;
        }
    </style>