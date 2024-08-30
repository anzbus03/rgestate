<?php defined('MW_PATH') || exit('No direct script access allowed');

// Render content if allowed
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

if ($viewCollection->renderContent) { ?>
    <div class="card card-primary borderless">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, $pageHeading);?>
            </h3>
            <div>
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
                <?php echo CHtml::link(Yii::t('app', 'Export'), array('language_tags/export'), array('class' => 'btn btn-info btn-xs', 'title' => Yii::t('app', 'Export')));?>
            </div>
            <style>
                td a::after {
                    content: unset!important;
                }
            </style>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="dataTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'Conversion Tag');?></th>
                            <th><?php echo Yii::t('app', 'Translation');?></th>
                            <th><?php echo Yii::t('app', 'Is Verified');?></th>
                            <th><?php echo Yii::t('app', 'Options');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo $data->conversion_tag . "&nbsp;" . $data->getTranslateHtml("conversion_tag", "ar"); ?></td>
                                <td><span dir="rtl"><?php echo $data->translation; ?></span></td>
                                <td><span dir="rtl"><?php echo $data->is_verifiedText; ?></span></td>
                                <td>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/update', array('id' => $data->primaryKey)); ?>" class="btn btn-primary btn-xs" title="<?php echo Yii::t('app', 'Update');?>"><span class="fa fa-pencil"></span></a>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/delete', array('id' => $data->primaryKey)); ?>" class="btn btn-danger btn-xs delete" title="<?php echo Yii::t('app', 'Delete');?>"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php 
}

// After content hook
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
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
});
</script>
    