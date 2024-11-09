<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }
    .card-title {
        margin: 0;
    }
    .dataTables_wrapper .dt-buttons {
        float: right;
        margin: 10px;
    }
</style>

<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-title">
                <span class="glyphicon glyphicon-send"></span> <?php echo Yii::t('servers', 'Delivery servers');?>
            </h3>
        </div>
        <div>
            <?php if (AccessHelper::hasRouteAccess('delivery_servers/create')) { ?>
            <div class="btn-group" style="margin-right: 10px;">
                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown"> <?php echo Yii::t('servers', 'Create new server');?> <span class="caret"></span> </button>
                <ul class="dropdown-menu" role="menu">
                    <?php foreach (DeliveryServer::getTypesList() as $type => $name) { ?>
                    <li><a href="<?php echo $this->createUrl('delivery_servers/create', array('type' => $type));?>"><?php echo $name;?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>

            <?php echo CHtml::link(Yii::t('app', 'Export'), array('delivery_servers/export'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Export')));?>
            <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('delivery_servers/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="delivery-servers-table" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th><?php echo Yii::t('app', 'Server ID');?></th>
                        <th><?php echo Yii::t('app', 'Name');?></th>
                        <th><?php echo Yii::t('app', 'Hostname');?></th>
                        <th><?php echo Yii::t('app', 'Username');?></th>
                        <th><?php echo Yii::t('app', 'From Email');?></th>
                        <th><?php echo Yii::t('app', 'Type');?></th>
                        <th><?php echo Yii::t('app', 'Status');?></th>
                        <th><?php echo Yii::t('app', 'Options');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($server->search()->data as $data) { ?>
                    <tr>
                        <td><?php echo CHtml::link($data->server_id, Yii::app()->createUrl("delivery_servers/update", array("type" => $data->type, "id" => $data->server_id))); ?></td>
                        <td><?php echo CHtml::link($data->name, Yii::app()->createUrl("delivery_servers/update", array("type" => $data->type, "id" => $data->server_id))); ?></td>
                        <td><?php echo CHtml::link($data->hostname, Yii::app()->createUrl("delivery_servers/update", array("type" => $data->type, "id" => $data->server_id))); ?></td>
                        <td><?php echo $data->username; ?></td>
                        <td><?php echo $data->from_email; ?></td>
                        <td><?php echo DeliveryServer::getNameByType($data->type); ?></td>
                        <td><?php echo ($data->getIsActive2())? "Active" : "Inactive"; ?></td>
                        <td>
                            <a href="<?php echo Yii::app()->createUrl("delivery_servers/update", array("type" => $data->type, "id" => $data->server_id));?>" title="<?php echo Yii::t('app', 'Update');?>"><span class="fa fa-pencil"></span></a>
                            <a href="<?php echo Yii::app()->createUrl("delivery_servers/copy", array("id" => $data->server_id));?>" title="<?php echo Yii::t('app', 'Copy');?>"><span class="glyphicon glyphicon-subtitles"></span></a>
                            <a href="<?php echo Yii::app()->createUrl("delivery_servers/enables", array("id" => $data->server_id));?>" title="<?php echo Yii::t('app', 'Enable');?>"><span class="glyphicon glyphicon-open"></span></a>
                            <a href="<?php echo Yii::app()->createUrl("delivery_servers/disables", array("id" => $data->server_id));?>" title="<?php echo Yii::t('app', 'Disable');?>"><span class="fa fa-times-circle-o"></span></a>
                            <a href="<?php echo Yii::app()->createUrl("delivery_servers/delete", array("id" => $data->server_id));?>" title="<?php echo Yii::t('app', 'Delete');?>"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="csv-import-modal" tabindex="-1" role="dialog" aria-labelledby="csv-import-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo Yii::t('servers', 'Import from CSV file');?></h4>
            </div>
            <div class="modal-body">
                <div class="callout callout-info">
                    <?php echo Yii::t('servers', 'Please note, the csv file must contain a header with proper columns.');?><br />
                    <?php echo Yii::t('servers', 'If unsure about how to format your file, do an export first and see how the file looks.');?>
                </div>
                <?php 
                $form = $this->beginWidget('CActiveForm', array(
                    'action'        => array('delivery_servers/import'),
                    'htmlOptions'   => array(
                        'id'        => 'import-csv-form', 
                        'enctype'   => 'multipart/form-data'
                    ),
                ));
                ?>
                <div class="form-group">
                    <?php echo $form->labelEx($csvImport, 'file');?>
                    <?php echo $form->fileField($csvImport, 'file', $csvImport->getHtmlOptions('file')); ?>
                    <?php echo $form->error($csvImport, 'file');?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app', 'Close');?></button>
                <button type="button" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>" onclick="$('#import-csv-form').submit();"><?php echo Yii::t('app', 'Import file');?></button>
            </div>
        </div>
    </div>
</div>
<script>
     $(document).ready(function() {
        $('#delivery-servers-table').DataTable({
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