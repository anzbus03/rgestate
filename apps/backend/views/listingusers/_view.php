<div class="modal-body" >
 <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#registraion" aria-controls="registraion" role="tab" data-toggle="tab">Registraion Information</a>

                        </li>
                         
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="registraion">
                        <table class="table table-bordered">
							<?php $items = $user->getDetails_items();
							foreach( $items as $k=>$v){
								if(!empty($v)){
								?>
								<tr><th><?php echo $user->getAttributeLabel($k);?></th><td><?php echo $v ;?></td></tr>
								<?
								}
							}
							 ?>
						</table>
                        
                        
                        </div>
                  
                        <div role="tabpanel" class="tab-pane" id="browseTab">
                         <table class="table table-bordered">
							 
						 	<tr><th><?php echo $user->getAttributeLabel('description');?></th><td><?php echo $user->description ;?></td></tr>
						 
					  
						</table>
                        
                        
                        </div>
                    </div>
                </div>
            
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-warning" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('listingusers/status_change2',array('val'=>'R','id'=>$user->user_id));?>" >Reject</button>
                <button type="button" class="btn btn-warning" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('listingusers/status_change2',array('val'=>'I','id'=>$user->user_id));?>" >Inactive</button>
                <button type="button" class="btn btn-success save" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('listingusers/status_change2',array('val'=>'A','id'=>$user->user_id));?>">Approve</button>
            </div>
