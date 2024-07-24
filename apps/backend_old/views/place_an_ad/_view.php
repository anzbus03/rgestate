<div class="modal-body" >
<table class="table table-bordered">
<tr><th>Preview Url</th><th><?php echo CHtml::link($model->ad_title,'javascript:void(0)',array("onclick"=>"openUrlFUll(this)","data-url"=>$model->PreviewUrlTrash));?></th></tr>
 
</table>

</div>
<div class="modal-footer">

<button type="button" class="btn bg-blue" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('place_an_ad/status_change2',array('val'=>'W','id'=>$model->id));?>" >Wait for Approval</button>
<button type="button" class="btn bg-red" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('place_an_ad/status_change2',array('val'=>'R','id'=>$model->id));?>" >Reject</button>
<button type="button" class="btn btn-warning" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('place_an_ad/status_change2',array('val'=>'I','id'=>$model->id));?>" >Inactive</button>
 
<button type="button" class="btn btn-success save" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('place_an_ad/status_change2',array('val'=>'A','id'=>$model->id));?>">Approve</button>
<hr />
<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
<hr />
</div>
