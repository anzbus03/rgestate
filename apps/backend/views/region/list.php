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
                <table id="<?php echo $model->modelName; ?>-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'State Name'); ?></th>
                            <th><?php echo Yii::t('app', 'Region'); ?></th>
                            <th><?php echo Yii::t('app', 'Country'); ?></th>
                            <th><?php echo Yii::t('app', 'Priority'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->search()->getData() as $data) { ?>
                        <tr>
                            <td><?php echo "<span>".$data->state_name."</span>&nbsp;".$data->getTranslateHtml("state_name"); ?></td>
                            <td><?php echo $data->region_name; ?></td>
                           
                            <td><?php echo $data->con->country_name; ?></td>
                            <td><?php echo CHtml::textField("priority[$data->state_id]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-controll")); ?></td>
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
                            "ordering": true,
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
    <?php 
    $this->endWidget();
}

$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
