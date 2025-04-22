<?php defined('MW_PATH') || exit('No direct script access allowed');

$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

if ($viewCollection->renderContent) { 
    $form = $this->beginWidget('CActiveForm', array(
        'enableAjaxValidation' => true,
    ));  
    ?>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title . " List");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', '<i class="fa fa-keyboard-o"></i> Arabic Bulk Update'), Yii::app()->createUrl(Yii::app()->controller->id.'/index', array('bulk_update'=>'1', 'lan'=>'ar')), array('class' => 'btn btn-default btn-xs', 'title' => Yii::t('app', 'Google Translate Arabic')));?>
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body"><div id="google_translate_element" class="pull-right"></div>
            <div class="table-responsive">
            <?php 
            $hooks->doAction('before_grid_view', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'renderGrid'    => true,
            )));
           
            if ($collection->renderGrid) {
                ?>
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
                <table id="<?php echo $model->modelName; ?>-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th><?php echo Yii::t('app', 'State Name'); ?></th>
                            <th><?php echo Yii::t('app', 'Region'); ?></th>
                            <th><?php echo Yii::t('app', 'Properties'); ?></th>
                            <th><?php echo Yii::t('app', 'Country'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->search()->getData() as $data) { ?>
                        <tr>
                            <td><input type="checkbox" class="bulk-item" value="<?php echo $data->state_id; ?>"></td>
                            <td><?php echo "<span>".$data->state_name."</span>&nbsp;".$data->getTranslateHtml("state_name"); ?></td>
                            <td><?php echo $data->region_name; ?></td>
                            <td>
                                <?php 
                                    echo PlaceAnAd::model()->countByAttributes([
                                        'state' => $data->state_id
                                    ]);
                                ?>
                            </td>
                            <td><?php echo $data->con->country_name; ?></td>
                            <td style="width:70px;">
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->state_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>" class=""><span class="fa fa-pencil"></span></a>
                                <?php } ?>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array('id' => $data->state_id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete"><span class="fa fa-trash"></span></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        $('#<?php echo $model->modelName; ?>-table').DataTable({
                            "paging": true,
                            "searching": true,
                            "ordering": false,
                            "info": true,
                            "lengthChange": true,
                            "autoWidth": false,
                            "responsive": true,
                            language: {
                                paginate: {
                                    next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                                    previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
                                }
                            }
                        });
                    });
                </script>
                <?php
            }

            $hooks->doAction('after_grid_view', new CAttributeCollection(array(
                'controller'    => $this,
                'renderedGrid'  => $collection->renderGrid,
            )));
            ?>
            <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
    </div>
    <script>
        // Handle select all checkbox
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
                            window.location.reload();
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
    </script>
    <?php 
    $this->endWidget();
}

$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
