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
        <div>
            <div class="row">
                <div class="col-md-3 mt-2">
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id . '/create'), array('class' => 'btn btn-primary btn-sm', 'title' => Yii::t('app', 'Create new'))); ?>
                </div>
                <div class="col-md-3 mt-2">
                    <button type="button" id="exportExcel" class="btn btn-success btn-sm" style="">Export Excel</button>
                </div>
                <div class="col-md-6">
                    <input type="text" id="dateRange" class="form-control" style="margin-left: 10px;" />
                </div>
            </div>
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
        <form method="post" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/index'); ?>">

            <!-- CSRF Protection -->
            <?php if (Yii::app()->request->enableCsrfValidation) { ?>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <?php } ?>
            <div class="card-body">
                <!-- Checkboxes and Dropdown -->
                <div class="row" style="margin-bottom: 10px;">
                    <!-- Checkbox for Featured -->
                    <div class="col-sm-2">

                        <button type="button" class="btn btn-secondary btn-xs" data-bs-toggle="modal"
                            style="margin-top: -5px;" data-bs-target="#uploadModal">
                            Upload By Excel
                        </button>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="featured">
                                Featured
                            </label>
                            <input type="checkbox" value="1"
                                style="width:auto;height:auto;float:left; margin-right:10px;margin-top:2px;"
                                id="featured">
                        </div>
                    </div>
                    <!-- Checkbox for Verified -->
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="verified">
                                <input type="checkbox" value="1" id="verified"
                                    style="width:auto;height:auto;float:left; margin-right:10px;margin-top:2px;">
                                Verified
                            </label>
                        </div>
                    </div>
                    <!-- Checkbox for Preleased -->
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="preleased">
                                <input type="checkbox" value="1"
                                    style="width:auto;height:auto;float:left; margin-right:10px;margin-top:2px;"
                                    id="preleased">
                                Preleased
                            </label>
                        </div>
                    </div>
                    <!-- Checkbox for Submitted Properties -->
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="f_properties">
                                <input type="checkbox" value="1"
                                    style="width:auto;height:auto;float:left; margin-right:10px;margin-top:2px;"
                                    id="f_properties">
                                Submitted Properties
                            </label>
                        </div>
                    </div>
                    <style>
                    .input-xs,
                    select.input-xs {
                        height: 40px;
                        line-height: 20px;
                    }
                    </style>
                    <!-- Dropdown for Submitted By -->
                    <div class="col-sm-3">
                        <div class="form-group">
                            <?php echo CHtml::dropDownList('submited_by', $model->submited_by, $model->getsubmited_by_array(), array('empty' => 'Submitted By', 'class' => 'form-control input-xs')); ?>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="enquiryTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Reference Number</th>
                                <th>Ad Title</th>
                                <th>Country Name</th>
                                <th>Section</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Date Added</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model->search()->getData() as $data) {
                                    $isSold = in_array($data->id, $soldPropertyIds); ?>
                            <tr>
                                <td><?php echo CHtml::decode($data->ReferenceNumberTitleP); ?></td>
                                <td>
                                    <?php echo CHtml::encode($data->AdTitleWithIcons2, Yii::app()->createUrl("place_property/update", array("id" => $data->id))); ?>
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
                                <td><?php echo CHtml::decode($data->CountryNameSection2); ?></td>
                                <td><?php echo CHtml::encode($data->section->section_name); ?></td>
                                <td><?php echo CHtml::encode($data->price); ?></td>
                                <td><?php echo getCategoryName($data->category_id, $categoriesArray); ?></td>
                                <td style="text-align:center;"><?php echo $data->statusLink; ?></td>
                                <td><?php echo CHtml::textField("priority[$data->id]", $data->priority, array("style" => "width:50px; text-align:center; display:block; margin:auto;", "class" => "form-controll")); ?>
                                </td>
                                <td><?php echo CHtml::encode($data->Sdate); ?></td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->id)); ?>"
                                        title="<?php echo Yii::t('app', 'Update'); ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <?php } ?>
                                    <!-- <a href="<?php echo Yii::app()->createUrl('statistics/property_statistics', array('property_id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Statistics'); ?>" target="_blank">
                                            <i class="fa fa-bar-chart text-red"></i>
                                        </a> -->
                                    <a href="<?php echo $data->PreviewUrlTrashB; ?>"
                                        title="<?php echo Yii::t('app', 'View'); ?>" target="_blank" class="text-green">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array('id' => $data->id)); ?>"
                                        title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/featured')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/featured', array('id' => $data->id, 'featured' => $data->featured)); ?>"
                                        title="<?php echo Yii::t('app', 'Featured'); ?>">
                                        <i class="fa fa-star"></i>
                                    </a>
                                    <?php } ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/verified', array('id' => $data->id, 'verified' => $data->verified)); ?>"
                                        title="<?php echo Yii::t('app', 'Verified'); ?>">
                                        <i class="fa fa-check-circle"></i>
                                    </a>
                                    <?php if ($data->status === "A") { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/status', array('id' => $data->id, 'status' => $data->status)); ?>"
                                        title="<?php echo Yii::t('app', 'Inactive AD'); ?>" class="Block">
                                        <i class="fa fa-ban"></i>
                                    </a>
                                    <?php } ?>
                                    <?php if ($data->status === "I") { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/status', array('id' => $data->id, 'status' => $data->status)); ?>"
                                        title="<?php echo Yii::t('app', 'Activate AD'); ?>" class="Enable"
                                        onclick="event.preventDefault(); $.ajax({type:'POST', url:$(this).attr('href'), success: function() {$.fn.yiiGridView.update('<?php echo $model->modelName; ?>-grid');}});">
                                        <i class="fa fa-check-circle"></i>
                                    </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/image_management')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/image_management', array('id' => $data->id)); ?>"
                                        title="<?php echo Yii::t('app', 'Image Management'); ?>">
                                        <i class="fa fa-picture-o"></i>
                                    </a>
                                    <?php } ?>
                                    <a href="javascript:void(0);"
                                        title="<?php echo Yii::t('app', 'Update Meta Tag'); ?>" data-bs-toggle="modal"
                                        onclick="openUp(this)">
                                        <i class="fa fa-tags"></i>
                                    </a>
                                    <?php if ($isSold): ?>
                                    <a href="#" class="text-green"><i class='fas fa-check'
                                            title="This property is already sold"></i></a>

                                    <?php else: ?>
                                    <!-- If the property is not sold, show the clickable icon -->
                                    <a href="javascript:void(0);" title="<?php echo Yii::t('app', 'Sold property'); ?>"
                                        onclick="openUp2(<?php echo $data->id; ?>)">
                                        <i class='far fa-handshake'></i>
                                    </a>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- priority update button  -->
                <div class="box-footer">
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

<!-- to upload excel file and image  -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Excel and Images</h5>
                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button id="downloadTemplateBtn" class="btn btn-secondary btn-xs pull-right mb-2">Download
                    Template</button>
                <form id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="excelFile">Excel File</label>
                        <input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xlsx,.xls">
                    </div>
                    <div class="form-group mt-2">
                        <label for="zipFile">ZIP File</label>
                        <input type="file" class="form-control" id="zipFile" name="zipFile" accept=".zip">
                    </div>
                    <button type="submit" class="pull-right btn btn-primary mt-4">Upload</button>
                </form>
                <div id="uploadStatus"></div>
            </div>
        </div>
    </div>
</div>

<!-- Sold Property Modal -->
<div class="modal fade" id="soldPropertyModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sold Property</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="soldPropertyForm" method="POST">
                    <!-- Hidden input to store property_id -->
                    <input type="hidden" id="propertyIdInput" name="SoldProperty[property_id]">
                    <div class="form-group">
                        <label for="soldPriceInput">Sold Price</label>
                        <input type="text" id="soldPriceInput" name="SoldProperty[sold_price]" class="form-control"
                            required>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
function openUp2(propertyId) {
    // Set the property ID in the hidden input field of the form
    $('#propertyIdInput').val(propertyId);
    // Show the modal
    $('#soldPropertyModal').modal('show');
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
                var workbook = XLSX.read(data, {
                    type: 'array'
                });
                var sheetName = workbook.SheetNames[0];
                var sheet = workbook.Sheets[sheetName];
                var json = XLSX.utils.sheet_to_json(sheet, {
                    header: 1
                });

                // Add Excel data to FormData
                formData.append('excelData', JSON.stringify(json));

                uploadFiles(formData); // Call function to upload files
            };
            reader.readAsArrayBuffer(excelFile);
        }
        $('#downloadTemplateBtn').click(function() {
            // Create a new workbook and add a worksheet
            var workbook = XLSX.utils.book_new();
            var worksheet_data = [
                [
                    'Category (For Sale / For Rent)', 
                    'Type (1-> Commercial / 2-> Residential)', 
                    'Ref No',
                    'Ad Title',
                    'Permit Number',
                    'Description',
                    'Location',
                    'Size',
                    'Price',
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


    });

    function uploadFiles(formData) {
        $.ajax({
            // Yii::app()->controller->id here refers to place_propertyController and the function name is uploadExcel, you can also get controller name from url
            // place_property
            url: '<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/uploadExcel'); ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == "success") {
                    $('#uploadStatus').text("Success");
                    location.reload();
                } else {
                    $('#uploadStatus').text(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#uploadStatus').text('Upload failed: ' + textStatus);
            }
        });
    }
    $('#downloadTemplateBtn').click(function() {
        // Create a new workbook and add a worksheet
        var workbook = XLSX.utils.book_new();
        var worksheet_data = [
            [
                'Category (1 -> For Sale / 2 -> For Rent)',
                'Type (1-> Commercial / 2-> Residential)',
                'Ref No',
                'Ad Title',
                'Permit Number',
                'Description',
                'Location',
                'Size',
                'Price',
                'Plot Area',
                'Furnished',
                'Construction Date',
                'Contact Name',
                'Contact Email',
                'Mobile Number',
                "Images (image1.png,image2.png,etc..)"
            ]
        ];
        var worksheet = XLSX.utils.aoa_to_sheet(worksheet_data);

        // Add the worksheet to the workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Template');

        // Write the workbook and download it
        XLSX.writeFile(workbook, 'template.xlsx');
    });
});
</script>


<script>
function reloadTable() {
    $('#enquiryTable').DataTable().ajax.reload();
}

function submitFilters() {
    var selectedFilters = {};

    // Collect selected checkbox values
    if ($('#featured').is(':checked')) {
        selectedFilters['PlaceAnAd[featured]'] = $('#featured').val();
    }
    if ($('#verified').is(':checked')) {
        selectedFilters['PlaceAnAd[verified]'] = $('#verified').val();
    }
    if ($('#preleased').is(':checked')) {
        selectedFilters['PlaceAnAd[preleased]'] = $('#preleased').val();
    }
    if ($('#f_properties').is(':checked')) {
        selectedFilters['PlaceAnAd[f_properties]'] = $('#f_properties').val();
    }
    var submitedByValue = $('#submited_by').val();
    if (submitedByValue) {
        selectedFilters['PlaceAnAd[submited_by]'] = submitedByValue;
    }
    // Convert the selected filters to query string parameters
    var queryString = $.param(selectedFilters, true);

    // Reload the page with the query parameters
    window.location.href = window.location.pathname + '?' + queryString;
}


// Attach the function to the checkboxes' change event
$('#featured, #verified, #preleased, #f_properties, #submited_by').change(submitFilters);
$(document).ready(function() {

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
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                'month').endOf('month')]
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
        var exportUrl = '<?php echo Yii::app()->createUrl('place_property/exportExcel'); ?>';

        if (startDate && endDate) {
            exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' +
                encodeURIComponent(endDate);
            var currentUrl = window.location.href;
            if (currentUrl.includes("trash")) {
                exportUrl += "&type=trash";
            }
        }


        // Redirect to the export URL
        window.location.href = exportUrl;
    });
    var table = $('#enquiryTable').DataTable({
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
