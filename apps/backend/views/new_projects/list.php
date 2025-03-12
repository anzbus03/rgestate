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

.featured-property {
    color: #FFD700;
    /* Gold */
}

.verified-property {
    color: #28A745;
    /* Green */
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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                <span class="fa fa-star"></span> 
                <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
            </h3>
            <div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-sm', 'title' => Yii::t('app', 'Create new')));?>
                    </div>
                    <!-- <div class="col-md-3">
                        <?php //echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-sm', 'title' => Yii::t('app', 'Refresh')));?>
                    </div> -->
                    <div class="col-md-8">
                        <input type="text" id="dateRange" class="form-control" style="margin-left: 10px;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row" style="margin-bottom: 10px;margin-top: 10px;">

                <!-- Select for Featured -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="featuredSelect">Featured</label>
                        <select name="featured" id="featuredSelect" class="form-control input-xs">
                            <option value="">Select Featured</option>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
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
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="verifiedSelect">Verified</label>
                        <select name="verified" id="verifiedSelect" class="form-control input-xs">
                            <option value="">Select Verified</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <!-- <?php $locations = States::model()->AllStatesOfCountry(66124); ?> -->
                <!-- Select for Category -->
                <div class="col-sm-4 hide">
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
                <div class="col-sm-4 mt-2">
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
                <div class="col-sm-4 mt-2">
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
                    <button type="button" class="btn btn-primary btn-sm" style="margin-top: 20px;" onclick="$('#projectsList').DataTable().ajax.reload();">
                        Apply Filters
                    </button>
                    <button type="button" id="resetButton" class="btn btn-secondary btn-sm" style="margin-top: 20px;">
                        Reset
                    </button>
                </div>

            </div>
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
                    <table id="projectsList" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Date</th>
                                <th>Project Title</th>
                                <th>City</th>
                                <th>Section</th>
                                <th>Investment Range</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                    
                    </table>
            
                </div>  
            </form>  
        </div>
    </div>

 <script>
    function confirmDelete(url) {
        if (confirm('Are you sure you want to delete this project?')) {
            window.location.href = url;
        }
    }

    $(document).ready(function () {
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
            $('#projectsList').DataTable().ajax.reload();
            // window.location.href = '<?php // echo Yii::app()->createUrl($this->route); ?>?startDate=' + startDate +
            //     '&endDate=' + endDate;

        }
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
                            $('#projectsList').DataTable().ajax.reload(); // Reload the page to reflect changes
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
        var table = $('#projectsList').DataTable({
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
                "url": "<?php echo Yii::app()->createUrl('new_projects/serverProcessing'); ?>", // Replace with your server URL
                "type": "GET",
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
                }
            },
            "columns": [
                { "data": "id", "orderable": false, "className": "unsortable"  },
                { "data": "date", "orderable": false , "className": "unsortable" },
                { "data": "ad_title" },
                { "data": "city" },
                { "data": "section" },
                { "data": "investment_range" },
                { "data": "status" },
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
            var rows = $('#projectsList').DataTable().rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#selectAllFoot').on('click', function() {
            var rows = $('#projectsList').DataTable().rows({
                'search': 'applied'
            }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#projectsList tbody').on('change', 'input[type="checkbox"]', function() {
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
<?php 
}
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
 

