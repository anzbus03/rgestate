<div class="modal-body" >
<table class="table table-bordered">
<tr><th>Preview Url</th><th><?php echo CHtml::link($model->ad_title,$model->PreviewUrlTrash,array('target'=>'_blank'));?></th></tr>
 
</table>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
<button type="button" class="btn bg-blue" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('place_an_ad/status_change',array('val'=>'W','id'=>$model->id));?>" >Wait for Approval</button>
<button type="button" class="btn bg-red" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('place_an_ad/status_change',array('val'=>'R','id'=>$model->id));?>" >Reject</button>
<button type="button" class="btn btn-warning" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('place_an_ad/status_change',array('val'=>'I','id'=>$model->id));?>" >Inactive</button>
<button type="button" class="btn btn-success save" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('place_an_ad/status_change',array('val'=>'A','id'=>$model->id));?>">Approve</button>
</div>
