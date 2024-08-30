<?php defined('MW_PATH') || exit('No direct script access allowed');

// Hooks and actions before rendering the view
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// Render if allowed
if ($viewCollection->renderContent) { ?>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-usd"></span> <?php echo Yii::t('currencies', 'Currencies');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array('currencies/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('currencies/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="currencies-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('currencies', 'Name');?></th>
                            <th><?php echo Yii::t('currencies', 'Code');?></th>
                            <th><?php echo Yii::t('currencies', 'Base Rate');?></th>
                            <th><?php echo Yii::t('currencies', 'Is Default');?></th>
                            <th><?php echo Yii::t('currencies', 'Status');?></th>
                            <th><?php echo Yii::t('currencies', 'Date Added');?></th>
                            <th><?php echo Yii::t('currencies', 'Options');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($currency->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo CHtml::encode($data->name); ?></td>
                                <td><?php echo CHtml::encode($data->code); ?></td>
                                <td><?php echo (strtolower($data->is_default) != strtolower("Yes")) ? CHtml::textField("rate[$data->currency_id]", $data->base_rate, array("style" => "width:50px;text-align:center", "class" => "form-control")) : "1 $data->code"; ?></td>
                                <td><?php echo ucfirst(Yii::t("app", $data->is_default)); ?></td>
                                <td><?php echo CHtml::encode($data->statusName); ?></td>
                                <td><?php echo CHtml::encode($data->dateAdded); ?></td>
                                <td>
                                    <a href="<?php echo Yii::app()->createUrl('currencies/update', array('id' => $data->currency_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <?php if ($data->isRemovable) { ?>
                                        <a href="<?php echo Yii::app()->createUrl('currencies/delete', array('id' => $data->currency_id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>    
            <div class="box-footer">
                <div class="pull-right m-2">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update Rate');?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#currencies-table').DataTable({
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
/**
 * Hook after view file content
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
