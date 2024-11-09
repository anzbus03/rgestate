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
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', '<i class="fa fa-keyboard-o"></i> Arabic Bulk Update'), Yii::app()->createUrl(Yii::app()->controller->id.'/index',array('bulk_update'=>'1','lan'=>'ar')), array('class' => 'btn btn-default btn-xs' , 'title' => Yii::t('app', 'Goole Translate Arabic')));?>
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="amenities-table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'Amenities Name'); ?></th>
                            <th><?php echo Yii::t('app', 'Category'); ?></th>
                            <th><?php echo Yii::t('app', 'Priority'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo "<span>".$data->AmentiesValid."</span>&nbsp;".$data->getTranslateHtml("amenities_name"); ?></td>
                              
                                <td><?php echo CHtml::encode($data->master->master_name); ?></td>
                                <td><?php echo CHtml::textField("priority[$data->amenities_id]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-control")); ?></td>
                                <td>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->amenities_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->amenities_id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete">
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
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update');?></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#amenities-table').DataTable({
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

// Hook after view file content
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
