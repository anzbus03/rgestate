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

            $categoryIds = array_column($ads, 'category_id');

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
                    <div class="col-sm-3">
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

                    <!-- <?php $locations = States::model()->AllListingStatesOfCountry(66124); ?> -->
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

                    <?php $locations = States::model()->AllListingStatesOfCountry(66124); ?>
                    <!-- Select for Location -->
                    <div class="col-sm-3 mt-2">
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
                    <div class="col-sm-3 text-right mt-4">
                        <!-- Submit button for form submission -->
                        <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 20px;">Apply
                            Filters</button>
                        <button type="submit" class="btn btn-secondary btn-sm" style="margin-top: 20px;"
                            onclick="resetFilters()">Reset</button>
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
                                <th>Priority</th>
                                <th>Refresh Date</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($placeAds as $data) {
                                    $isSold = in_array($data->id, $soldPropertyIds); ?>
                            <tr>
                                <td><input type="checkbox" class="bulk-item" value="<?php echo $data->id; ?>"></td>
                                <td><?php echo CHtml::decode($data->ReferenceNumberTitleP); ?></td>
                                <td>
                                    <?php echo CHtml::decode($data->AdTitle, Yii::app()->createUrl("place_property/update", array("id" => $data->id))); ?>
                                    <div><?php echo $data->Tags; ?></div>
                                    <input type="hidden" class="propertyId" value="<?php echo $data->id; ?>">
                                    <input type="hidden" class="sId" value="<?php echo $data->section_id; ?>">
                                    <input type="hidden" class="cId" value="<?php echo $data->category_id; ?>">
                                    <input type="hidden" class="lId" value="<?php echo $data->listing_type; ?>">
                                    <input type="hidden" id="meta_title-<?php echo $data->id; ?>" class="meta_title"
                                        value="<?php echo $data->metaTitleEnglish; ?>">
                                    <input type="hidden" id="meta_title-ar-<?php echo $data->id; ?>"
                                        class="meta_title_ar" value="<?php echo $data->MetaTitleArabic; ?>">
                                    <input type="hidden" id="meta_description-<?php echo $data->id; ?>"
                                        class="meta_description" value="<?php echo $data->MetaDescriptionEnglish; ?>">
                                    <input type="hidden" id="meta_description-ar-<?php echo $data->id; ?>"
                                        class="meta_description_ar" value="<?php echo $data->MetaDescriptionArabic; ?>">
                                </td>
                                <!-- <td><?php // echo CHtml::decode($data->CountryNameSection2); 
                                                    ?></td> -->
                                <td><?php echo CHtml::encode($data->section->section_name); ?></td>
                                <td><?php echo CHtml::encode($data->price); ?></td>
                                <td><?php echo getCategoryName($data->category_id, $categoriesArray); ?></td>
                                <td style="text-align:center;"><?php echo $data->statusLink; ?></td>
                                <td><?php echo CHtml::textField("priority[$data->id]", $data->priority, array("style" => "width:50px; text-align:center; display:block; margin:auto;", "class" => "form-controll")); ?>
                                </td>
                                <td>
                                    <span class="date-display" style="margin-right: 3px;">
                                        <?php echo CHtml::encode(date('d-M-Y', strtotime($data->date_added))); ?>
                                    </span>

                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/refresh_date', array('id' => $data->id)); ?>" class="refresh-date" data-id="<?php echo $data->id; ?>"
                                        data-ldate="<?php echo CHtml::encode($data->Ldate); ?>"
                                        style="text-decoration: none; color: blue; cursor: pointer;">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->id)); ?>"
                                        title="<?php echo Yii::t('app', 'Update'); ?>" class="edit-icon">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <?php } ?>
                                   

                                    <?php 
                                    if ($data->section_id == 2){
                                        $PreviewURL = ('/rent/'.$data->slug);    
                                    }else if ($data->section_id == 1){
                                        $PreviewURL = ('/sale/'.$data->slug);    
                                    }
                                        ?>
                                    <a href="<?php echo $PreviewURL; ?>" title="<?php echo Yii::t('app', 'View'); ?>"
                                        target="_blank" class="view-icon">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) { ?>
                                        <a href="javascript:void(0);"
                                        title="<?php echo Yii::t('app', 'Delete'); ?>"
                                        class="delete delete-icon"
                                        onclick="confirmDelete('<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array('id' => $data->id)); ?>')">
                                            <i class="fa fa-times-circle"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/featured')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/featured', array('id' => $data->id, 'featured' => $data->featured)); ?>"
                                        title="<?php echo Yii::t('app', 'Featured'); ?>"
                                        class="<?php echo ($data->featured === 'Y') ? 'featured-property' : ''; ?>">
                                        <i class="fa fa-star"></i>
                                    </a>
                                    <?php } ?>

                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/verified', array('id' => $data->id, 'verified' => $data->verified)); ?>"
                                        title="<?php echo Yii::t('app', 'Verified'); ?>"
                                        class="<?php echo ($data->verified === '1') ? 'verified-property' : ''; ?>">
                                        <i class="fa fa-check-circle"></i>
                                    </a>
                                    <?php if ($data->status === "A") { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/status_change', array('id' => $data->id, 'val' => "I")); ?>"
                                        title="<?php echo Yii::t('app', 'Inactive AD'); ?>" class="Block"
                                        >
                                        <i class="fa fa-ban"></i>
                                    </a>
                                    <?php } ?>
                                    <?php if ($data->status === "I") { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/status_change', array('id' => $data->id, 'val' => "A")); ?>"
                                        title="<?php echo Yii::t('app', 'Activate AD'); ?>"
                                        class="Enable active-property">
                                        <i class="fa fa-check-circle"></i>
                                    </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/hot')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/hot', array('id' => $data->id, 'hot' => $data->hot)); ?>"
                                        title="<?php echo Yii::t('app', 'Hot'); ?>"
                                        class="<?php echo ($data->hot === '1') ? 'hot-property' : ''; ?>">
                                        <i class="fas fa-sun"></i>
                                    </a>
                                    <?php } ?>

                                    <a href="javascript:void(0);"
                                        title="<?php echo Yii::t('app', 'Update Meta Tag'); ?>" data-bs-toggle="modal"
                                        onclick="openUp(this)">
                                        <i class="fa fa-tags"></i>
                                    </a>
                                    <?php if ($isSold): ?>
                                    <a href="#" class="sold-property">
                                        <i class='fas fa-check' title="This property is already sold"></i></a>

                                    <?php else: ?>
                                    <!-- If the property is not sold, show the clickable icon -->
                                    <?php if ($data->status == "A"){ ?>
                                        
                                        <a href="javascript:void(0);" title="<?php echo Yii::t('app', 'Sold property'); ?>"
                                            onclick="openUp2(<?php echo $data->id; ?>)">
                                            <i class='far fa-handshake'></i>
                                        </a>
                                    <?php } ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
            <!-- priority update button  -->
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit"
                        data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...'); ?>"><?php echo Yii::t('app', 'Update Priority'); ?></button>
                </div>
            </div>

        </div>
    </div>

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
                        <div class="form-group">
                            <label for="excelFile">Excel File</label>
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
    $(document).ready(function() {
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
                            typeof cell === 'string' ? cell.replace(/\n/g, '\\n') : cell
                        )
                    );

                    // Add processed Excel data to FormData
                    formData.append('excelData', JSON.stringify(json));

                    // Function to upload files to backend
                    uploadFiles(formData); 
                };
                reader.readAsArrayBuffer(excelFile);
            }


        });

        function uploadFiles(formData) {
            $('#loadingBar').show();

            const excelData = JSON.parse(formData.get('excelData')); // Parse the Excel data
            const totalRows = excelData.length - 1; // Exclude the header row
            const batchSize = 10; // Rows per batch
            const totalBatches = Math.ceil(totalRows / batchSize); // Calculate total batches (including remainder)
            let stack = 1; // Initialize stack counter
            let updatedCount = 0;
            let newCount = 0;
            function sendBatch(batchIndex) {
                const start = batchIndex * batchSize + 1; // Skip header row
                const end = Math.min(start + batchSize, excelData.length); // Ensure we don't go out of bounds
                const batchData = excelData.slice(start, end);

                if (batchData.length === 0) {
                    $('#loadingBar').hide();
                    $('#uploadStatus').text('All data processed.');
                    return;
                }

                const batchFormData = new FormData();
                batchFormData.append('excelData', unescape(encodeURIComponent(JSON.stringify([excelData[0], ...batchData])))); // Include header row
                batchFormData.append('stack', stack);
                batchFormData.append('final', totalBatches);

                $.ajax({
                    url: '<?php echo Yii::app()->createUrl(Yii::app()->controller->id . "/uploadExcel"); ?>',
                    type: 'POST',
                    data: batchFormData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            newCount = newCount + response.newCount;
                            updatedCount = updatedCount + response.updatedCount;
                            $('#uploadStatus').html(`Stack ${stack}/${totalBatches} processed successfully.<br/>
                            <strong>New properties: </strong> ${newCount}
                            <strong>Updated properties: </strong> ${updatedCount}`);
                        } else {
                            console.error(`Error in stack ${stack}:`, response.message);
                        }

                        if (stack < totalBatches) {
                            stack++;
                            sendBatch(batchIndex + 1);
                        } else {
                            $('#loadingBar').hide();
                            $('#uploadStatus').text('All stacks processed successfully.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loadingBar').hide();
                        $('#uploadStatus').text('Upload failed: ' + textStatus);
                        console.error('Error:', errorThrown);
                    }
                });
            }

            sendBatch(0); // Start processing from the first batch
        }
    });
    </script>


    <script>
    function reloadTable() {
        $('#enquiryTable').DataTable().ajax.reload();
    }

    // function submitFilters() {
    //     var selectedFilters = {};

    //     // Collect selected checkbox values
    //     if ($('#featured').is(':checked')) {
    //         selectedFilters['PlaceAnAd[featured]'] = $('#featured').val();
    //     }
    //     if ($('#verified').is(':checked')) {
    //         selectedFilters['PlaceAnAd[verified]'] = $('#verified').val();
    //     }
    //     if ($('#preleased').is(':checked')) {
    //         selectedFilters['PlaceAnAd[preleased]'] = $('#preleased').val();
    //     }
    //     if ($('#f_properties').is(':checked')) {
    //         selectedFilters['PlaceAnAd[f_properties]'] = $('#f_properties').val();
    //     }
    //     var submitedByValue = $('#submited_by').val();
    //     if (submitedByValue) {
    //         selectedFilters['PlaceAnAd[submited_by]'] = submitedByValue;
    //     }
    //     // Convert the selected filters to query string parameters
    //     var queryString = $.param(selectedFilters, true);

    //     // Reload the page with the query parameters
    //     window.location.href = window.location.pathname + '?' + queryString;
    // }


    // Attach the function to the checkboxes' change event
    // $('#featured, #verified, #preleased, #f_properties, #submited_by').change(submitFilters);
    $(document).ready(function() {
        // Initialize the date range picker
        $('#dateRange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: moment('2020-01-01'), // Set default start date for "All Time"
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
            
            $('#dateRange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
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
                "url": "<?php echo Yii::app()->createUrl('place_property/serverProcessing'); ?>", // Replace with your server URL
                "type": "POST",
                "data": function(d) {
                    var dateRangePicker = $('#dateRange').data('daterangepicker');
                    d.startDate = dateRangePicker.startDate ? dateRangePicker.startDate.format('YYYY-MM-DD') : '';
                    d.endDate = dateRangePicker.endDate ? dateRangePicker.endDate.format('YYYY-MM-DD') : '';
                }
            },
            "columns": [
                { "data": "id" },
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