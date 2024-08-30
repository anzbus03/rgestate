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
                <span class="fa fa-star"></span>
                <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title . " List"); ?>
            </h3>
            <div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id . '/create'), array('class' => 'btn btn-primary btn-sm', 'title' => Yii::t('app', 'Create new'))); ?>
                    </div>
                    <!-- <div class="col-md-3">
                        <?php //echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-sm', 'title' => Yii::t('app', 'Refresh')));
                        ?>
                    </div> -->
                    <div class="col-md-8">
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
            <form method="post" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/business'); ?>">

                <!-- CSRF Protection -->
                <?php if (Yii::app()->request->enableCsrfValidation) { ?>
                    <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                <?php } ?>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="featured">
                                    <input type="checkbox" value="1" style="width:auto;height:auto;float:left; margin-right:10px;margin-top:2px;" id="featured">
                                    Featured
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="verified">
                                    <input type="checkbox" value="1" style="width:auto;height:auto;float:left; margin-right:10px;margin-top:2px;" id="verified">
                                    Verified
                                </label>
                            </div>
                        </div>
                    </div>
                <div class="table-responsive">
                    <table id="enquiryTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Reference Number</th>
                                <th>Ad Title</th>
                                <th>Username</th>
                                <th>Country Name</th>
                                <th>Section</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Date Added</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model->search()->getData() as $data) { ?>
                                <tr>
                                    <td><?php echo CHtml::decode($data->ReferenceNumberTitleP); ?></td>
                                    <td>
                                        <?php echo CHtml::encode($data->AdTitleWithIcons2, Yii::app()->createUrl("place_property/update", array("id" => $data->id))); ?>
                                        <div><?php echo $data->Tags; ?></div>
                                        <input type="hidden" class="propertyId" value="<?php echo $data->id; ?>">
                                        <input type="hidden" class="sId" value="<?php echo $data->section_id; ?>">
                                        <input type="hidden" class="cId" value="<?php echo $data->category_id; ?>">
                                        <input type="hidden" class="lId" value="<?php echo $data->listing_type; ?>">
                                        <input type="hidden" id="meta_title-<?php echo $data->id; ?>" class="meta_title" value="<?php echo $data->metaTitleEnglish; ?>">
                                        <input type="hidden" id="meta_title-ar-<?php echo $data->id; ?>" class="meta_title_ar" value="<?php echo $data->MetaTitleArabic; ?>">
                                        <input type="hidden" id="meta_description-<?php echo $data->id; ?>" class="meta_description" value="<?php echo $data->MetaDescriptionEnglish; ?>">
                                        <input type="hidden" id="meta_description-ar-<?php echo $data->id; ?>" class="meta_description_ar" value="<?php echo $data->MetaDescriptionArabic; ?>">
                                    </td>
                                    <td><?php echo $data->userUrl ?></td>
                                    <td><?php echo CHtml::decode($data->CountryNameSection2); ?></td>
                                    <td><?php echo CHtml::encode($data->section->section_name); ?></td>
                                    <td><?php echo CHtml::encode($data->price); ?></td>
                                    <td style="text-align:center;"><?php echo $data->statusLink; ?></td>
                                    <td><?php echo CHtml::textField("priority[$data->id]", $data->priority, array("style" => "width:50px; text-align:center; display:block; margin:auto;", "class" => "form-controll")); ?></td>
                                    <td><?php echo CHtml::encode($data->Sdate); ?></td>
                                    <td>
                                        <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) { ?>
                                            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        <?php } ?>
                                        <a href="<?php echo Yii::app()->createUrl('statistics/property_statistics', array('property_id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Statistics'); ?>" target="_blank">
                                            <i class="fa fa-bar-chart text-red"></i>
                                        </a>
                                        <a href="<?php echo $data->PreviewUrlTrashB; ?>" title="<?php echo Yii::t('app', 'View'); ?>" target="_blank" class="text-green">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) { ?>
                                            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete">
                                                <i class="fa fa-times-circle"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/featured')) { ?>
                                            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/featured', array('id' => $data->id, 'featured' => $data->featured)); ?>" title="<?php echo Yii::t('app', 'Featured'); ?>">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        <?php } ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/verified', array('id' => $data->id, 'verified' => $data->verified)); ?>" title="<?php echo Yii::t('app', 'Verified'); ?>">
                                            <i class="fa fa-check-circle"></i>
                                        </a>
                                        <?php if ($data->status === "A") { ?>
                                            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/status', array('id' => $data->id, 'status' => $data->status)); ?>" title="<?php echo Yii::t('app', 'Inactive AD'); ?>" class="Block">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if ($data->status === "I") { ?>
                                            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/status', array('id' => $data->id, 'status' => $data->status)); ?>" title="<?php echo Yii::t('app', 'Activate AD'); ?>" class="Enable"
                                                onclick="event.preventDefault(); $.ajax({type:'POST', url:$(this).attr('href'), success: function() {$.fn.yiiGridView.update('<?php echo $model->modelName; ?>-grid');}});">
                                                <i class="fa fa-check-circle"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/image_management')) { ?>
                                            <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/image_management', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Image Management'); ?>">
                                                <i class="fa fa-picture-o"></i>
                                            </a>
                                        <?php } ?>
                                        <a href="javascript:void(0);" title="<?php echo Yii::t('app', 'Update Meta Tag'); ?>" data-toggle="modal" onclick="openUp(this)">
                                            <i class="fa fa-tags"></i>
                                        </a>
                                        <a href="javascript:void(0);" title="<?php echo Yii::t('app', 'Tag Your Property'); ?>" data-toggle="modal" onclick="openUp2(this)">
                                            <i class="fa fa-tags bg-yellow"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

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
      function submitFilters() {
        var selectedFilters = {};

        // Collect selected checkbox values
        if ($('#featured').is(':checked')) {
            selectedFilters['PlaceAnAd[featured]'] = $('#featured').val();
        }
        if ($('#verified').is(':checked')) {
            selectedFilters['PlaceAnAd[verified]'] = $('#verified').val();
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


<script>
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
        $('#enquiryTable').DataTable({
            createdRow: function(row, data, index) {
                $(row).addClass('selected');
            },
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" style="line-height:40px;" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" style="line-height:40px;" aria-hidden="true"></i>'
                }
            }
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