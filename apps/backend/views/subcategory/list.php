<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>

<?php
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
        .hide{
            display: none;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <?php 
            $hooks->doAction('before_grid_view', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'renderGrid'    => true,
            )));

            $form=$this->beginWidget('CActiveForm', array( 
                'enableAjaxValidation'=>true,
            ));  
            
            if ($collection->renderGrid) { ?>
                <table id="datatable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'Category'); ?></th>
                            <th><?php echo Yii::t('app', 'Sub Category'); ?></th>
                            <th><?php echo Yii::t('app', 'Parent Name'); ?></th>
                            <th style="text-align:right; width:150px;"><?php echo Yii::t('app', 'Date Added'); ?></th>
                            <th style="text-align:right; width:150px;"><?php echo Yii::t('app', 'Last Updated'); ?></th>
                            <th style="width:50px; text-align:center;"><?php echo Yii::t('app', 'Priority'); ?></th>
                            <th style="width:70px;"><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo @$data->category->category_name; ?></td>
                                <td><?php echo @$data->sub_category_name; ?></td>
                                <td><?php 
                                    $subcategory = Subcategory::model()->findByPk($data->parent_id);
                                    echo $subcategory ? $subcategory->sub_category_name : '';
                                ?></td>
                                <td style="text-align:right;"><?php echo @$data->dateAdded; ?></td>
                                <td style="text-align:right;"><?php echo @$data->lastUpdated; ?></td>
                                <td style="text-align:center;"><?php echo CHtml::textField("priority[$data->sub_category_id]", $data->priority, array("style"=>"width:50px;text-align:center","class"=>"form-controll")); ?></td>
                                <td>
                                    <?php echo CHtml::link('<span class="fa fa-pencil"></span>', Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->sub_category_id)), array('title' => Yii::t('app', 'Update'), 'class' => 'btn btn-xs btn-primary')); ?>
                                    <?php echo CHtml::link('<span class="fa fa-trash"></span>', Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->sub_category_id)), array('title' => Yii::t('app', 'Delete'), 'class' => 'btn btn-xs btn-danger delete')); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        $('#datatable').DataTable({
                            language: {
                                paginate: {
                                    next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                                    previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
                                }
                            }
                        });
                    });
                </script>
            <?php } ?>
            <div class="clearfix"></div>
            </div>    
            
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update');?></button>
                </div>
                <div class="clearfix"></div>
            </div>
          <?php $this->endWidget(); ?>
        </div>
    </div>
<?php 
}

$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
