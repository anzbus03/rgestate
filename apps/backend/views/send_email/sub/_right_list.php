<div class="col-md-12 no-padding-left">
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <h3 class="card-title">
                    <?php
                    if(Yii::app()->request->getQuery('draft','0')=='1'){
                        echo '<span class="fa fa-file-text-o"></span> Mail Draft';
                    }
                    else{
                        echo '<span class="fa fa-inbox"></span> Mail Queue';
                    }
                    ?>
                </h3>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="mailTable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Subject</th>
                            <th>Recipients</th>
                            <th>Sent On</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) : ?>
                        <tr>
                            <td><input type="checkbox" name="bulk_item[]" value="<?php echo $data->id; ?>"></td>
                            <td><?php echo CHtml::encode($data->subject); ?></td>
                            <td><?php echo CHtml::encode($data->ReceipeintsTilte); ?></td>
                            <td><?php echo CHtml::encode($data->sent_on); ?></td>
                            <td><?php echo CHtml::decode($data->StatusTitle); ?></td>
                            <td>
                                <a href="<?php echo Yii::app()->createUrl('send_email/delete', array('id' => $data->id)); ?>" class="btn btn-danger btn-sm">
                                    <span class="fa fa-trash"></span>
                                </a>
                                <a href="<?php echo Yii::app()->createUrl('send_email/preview', array('id' => $data->id)); ?>" class="btn btn-info btn-sm" onclick="windowOpen(this,event)">
                                    <span class="fa fa-eye"></span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
    </div>
    <div class="clearfix"><!-- --></div>
</div>

<script>
$(document).ready(function() {
    $('#mailTable').DataTable({
        language: {
            paginate: {
                next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
            }
        }
    });

    // Select/Deselect all checkboxes
    $('#select-all').click(function(){
        $('input[name="bulk_item[]"]').prop('checked', this.checked);
    });
});
</script>
