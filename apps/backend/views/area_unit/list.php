<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>

<?php
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) { ?>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
                <?php echo CHtml::link(Yii::t('app', 'Update Cache'), Yii::app()->createUrl(Yii::app()->controller->id.'/index',array('update_cache'=>'1')), array('class' => 'btn btn-success btn-xs', 'title' => Yii::t('app', 'Update Cache')));?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- HTML Table for DataTables -->
                <table id="dataTable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Master Name</th>
                            <th>Value</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data): ?>
                        <tr>
                            <td><?php echo CHtml::encode($data->master_name); ?> <?php echo $data->getTranslateHtml("master_name"); ?></td>
                            <td><?php echo CHtml::encode($data->value); ?></td>
                            <td>
                                <?php echo CHtml::link('<span class="fa fa-pencil"></span>', Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->master_id)), array('title' => Yii::t('app', 'Update'))); ?>
                                <?php echo CHtml::link('<span class="fa fa-trash"></span>', Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->master_id)), array('title' => Yii::t('app', 'Delete'), 'class' => 'delete')); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update');?></button>
                </div>
            </div>
        </div>
    </div>
<?php 
}
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>

<!-- Include DataTables JS and CSS -->
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
            }
        }
    });
});
</script>
