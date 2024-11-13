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

$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

if ($viewCollection->renderContent) { ?>
<style>
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
}

.card-header-left {
    flex: 1;
}

.card-header-right {
    display: flex;
    gap: 10px;
}

.card-header-right .btn {
    margin-left: 5px;
}
</style>
<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h3 class="card-title">
                <span class="glyphicon glyphicon-star"></span>
                <?php echo Yii::t(Yii::app()->controller->id, "Image Library"); ?>
            </h3>
        </div>
        <div class="pull-right">
            <?php echo CHtml::link(Yii::t('app', 'Upload new'), '#', array(
                    'class' => 'btn btn-primary btn-xs',
                    'title' => Yii::t('app', 'Create new'),
                    'data-bs-toggle' => 'modal',
                    'data-bs-target' => '#uploadModal'
                )); ?>
            <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id . '/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh'))); ?>
        </div>
        <div class="clearfix">
            <!-- -->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="bulk-actions pull-right mb-4">
                <div class="form-group" style="width: 200px; display: inline-block;">
                    <select name="bulk-action" id="bulk-action-select" class="form-control input-xs">
                        <option value="">Select Action</option>
                        <option value="trash">Delete</option>
                    </select>
                </div>
                <button id="apply-bulk-action" type="button" class="btn btn-primary btn-sm"
                    style="height:50px;">Apply</button>
            </div>
            <table id="home-banner-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Image</th>
                        <th>Image Path</th>
                        <th>Alt Text</th>
                        <th>Title</th>
                        <th>Property</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="box-footer">

        </div>
    </div>
</div>
<style>
    .modal {
        z-index: 1050;
        /* Bootstrap default for modal */
    }

    .select2-container--default .select2-selection--single {
        z-index: 1060;
        /* Set this higher than the modal */
    }
</style>
<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload New Images</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    <?php echo CHtml::hiddenField(Yii::app()->request->csrfTokenName, Yii::app()->request->csrfToken); ?>

                    <div class="form-group">
                        <label for="fileUpload">Choose Images</label>
                        <input type="file" class="form-control" id="fileUpload" name="files[]" multiple>
                    </div>
                    <div id="uploadedFiles" class="uploaded-files-box"
                        style="border: 1px solid #ccc; padding: 10px; margin-top: 10px;"></div>

                    <!-- Floor Plan Upload -->
                    <div class="form-group mt-4">
                        <label for="floorPlanUpload">Upload Floor Plan</label>
                        <input type="file" class="form-control" id="floorPlanUpload" name="floorPlans[]" multiple>
                    </div>
                    <div id="uploadedFloorPlans" class="uploaded-files-box"
                        style="border: 1px solid #ccc; padding: 10px; margin-top: 10px;"></div>

                    <!-- Video Link Input -->
                    <div class="form-group mt-4">
                        <label for="videoLink">Video Link</label>
                        <input type="text" class="form-control" id="videoLink" name="video_link"
                            placeholder="Enter video link">
                    </div>

                    <div class="form-group mt-4">
                        <select class="form-control" id="propertySelect" name="property_id">
                            <?php foreach ($properties as $property): ?>
                            <option value="<?php echo $property->id; ?>">
                                <?php echo $property->RefNo . ' - ' . $property->ad_title; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- New Input Fields for Image Alt and Title -->
                    <div class="form-group mt-4">
                        <label for="imageAlt">Image Alt Text</label>
                        <input type="text" class="form-control" id="imageAlt" name="image_alt"
                            placeholder="Enter alt text for image">
                    </div>

                    <div class="form-group mt-4">
                        <label for="imageTitle">Image Title</label>
                        <input type="text" class="form-control" id="imageTitle" name="image_title"
                            placeholder="Enter title for image">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="uploadFilesButton">Upload</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade editModal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Image Details</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" enctype="multipart/form-data">
                    <input type="hidden" id="editId" name="id">
                    <?php echo CHtml::hiddenField(Yii::app()->request->csrfTokenName, Yii::app()->request->csrfToken); ?>
                    <div class="form-group">
                        <label for="editAlt">Alt Text:</label>
                        <input type="text" id="editAlt" name="alt" class="form-control">
                    
                    </div>
                    <!-- Video Link Input -->
                    <div class="form-group mt-4">
                        <label for="editTitle">Title Text:</label>
                        <input type="text" id="editTitle" name="title" class="form-control">
                
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editFormButton">Upload</button>
            </div>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    function openEditModal(id, currentAlt, currentTitle) {
        document.getElementById('editId').value = id;
        document.getElementById('editAlt').value = currentAlt;
        document.getElementById('editTitle').value = currentTitle;
        $("#editModal").modal('toggle')
    }

    $("#editFormButton").on('click', function() {
        var $uploadButton = $(this);
        var formData = new FormData($('#editForm')[0]);
        $.ajax({
            url: '<?php echo Yii::app()->createUrl(Yii::app()->controller->id . "/updateImageDetails"); ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (JSON.parse(response).success) {
                    $('#editModal').modal('toggle');
                    $('#home-banner-table').DataTable().ajax.reload(); // Reload DataTable
                }
            },
            error: function () {
                alert('An error occurred.');
            }
        });
    });

    function copyToClipboard(text) {
        var tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = text;
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('URL copied to clipboard!');
    }
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
$(document).ready(function() {
    // Initialize Select2 for property selection
    $('#propertySelect').select2({
        placeholder: 'Select Property (optional)',
        allowClear: true,
        dropdownParent: $('#uploadModal') // Ensure the dropdown is contained within the modal
    });

    // Handle file input change for general file upload
    $('#fileUpload').on('change', function() {
        var files = $(this).get(0).files; // Get the general files
        $('#uploadedFiles').empty(); // Clear the previous entries

        // Loop through selected files and append to the box
        for (var i = 0; i < files.length; i++) {
            $('#uploadedFiles').append('<div>' + files[i].name + '</div>');
        }
    });

    // Handle file input change for Floor Plan upload
    $('#floorPlanUpload').on('change', function() {
        var floorPlanFiles = $(this).get(0).files; // Get the floor plan files
        $('#uploadedFloorPlans').empty(); // Clear the previous entries

        // Loop through selected floor plan files and append to the box
        for (var i = 0; i < floorPlanFiles.length; i++) {
            $('#uploadedFloorPlans').append('<div>' + floorPlanFiles[i].name + '</div>');
        }
    });

    // Handle upload button click
    $('#uploadFilesButton').on('click', function() {
        var $uploadButton = $(this);
        $uploadButton.text('Please wait...').prop('disabled', true); // Change text and disable button
        var formData = new FormData($('#uploadForm')[0]); // Create form data from the form

        // Optionally: Add any additional parameters here
        $.ajax({
            url: '<?php echo Yii::app()->createUrl(Yii::app()->controller->id . "/uploadFiles"); ?>', // Your upload URL
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success (e.g., refresh the table)
                $uploadButton.text('Upload').prop('disabled', false); // Revert text and enable button
                if(JSON.parse(response).status == "success"){
                    window.history.back();
                    $('#home-banner-table').DataTable().ajax.reload();
                    $('#uploadModal').modal('hide'); // Hide the modal
                }
            },
            error: function() {
                alert('Error uploading files');
                $uploadButton.text('Upload').prop('disabled', false); // Revert text and enable button
            }
        });
    });
});
</script>
<?php
    Yii::app()->clientScript->registerScript('initialize-dataTables', "
            $(document).ready(function() {
                $('#home-banner-table').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: '" . Yii::app()->createUrl(Yii::app()->controller->id . '/ajaxData') . "',
                        type: 'GET',
                        data: function (d) {
                            // Add any additional parameters you might want to send here
                        }
                    },
                    language: {
                        paginate: {
                            next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                            previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
                        }
                    },
                    columnDefs: [
                        {
                            targets: 0, 
                            orderable: false,
                             searchable: false
                        }
                    ]
                });
            });
        ");
}

$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>