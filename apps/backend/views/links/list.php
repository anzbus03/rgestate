<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>

<?php
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

if ($viewCollection->renderContent) { ?>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title . " List"); ?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create'), array(Yii::app()->controller->id . '/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create'))); ?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id . '/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh'))); ?>
                <?php echo CHtml::link(Yii::t('app', '<i class="fa fa-keyboard-o"></i> Arabic Bulk Update'), Yii::app()->createUrl($this->id . '/index', array('bulk_update' => '1', 'lan' => 'ar')), array('class' => 'btn btn-default btn-flat', 'title' => Yii::t('app', 'Google Translate Arabic'))); ?>
            </div>
        </div>
        <div class="card-body">
            <div id="google_translate_element" class="pull-right"></div>
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'Name'); ?></th>
                            <th><?php echo Yii::t('app', 'Type'); ?></th>
                            <th><?php echo Yii::t('app', 'Priority'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) : ?>
                            <tr>
                                <td><?php echo CHtml::decode($data->nameWithParent); ?></td>
                               
                                <td><?php echo CHtml::encode($data->f_typeTitle); ?></td>
                                <td><?php echo CHtml::textField("priority[$data->master_id]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-controll")); ?></td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/update')) : ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array("id" => $data->master_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                                    <?php endif; ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id . '/delete')) : ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array("id" => $data->master_id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="btn btn-xs btn-danger delete"><i class="fa fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...'); ?>"><?php echo Yii::t('app', 'Update'); ?></button>
                </div>
            </div>
        </div>
    </div>
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
<?php
}
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
