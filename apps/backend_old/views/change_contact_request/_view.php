<div class="modal-body" >
 <div role="tabpanel">
                    <!-- Nav tabs -->
                   
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="registraion">
							<h4 class="page-head">Old Contact Information</h4>
                        <table class="table table-bordered">
							<?php $items = array('full_name'=>$user->first_name,'mobile'=>$user->mobile,'phone'=>$user->phone);
							foreach( $items as $k=>$v){
								if(!empty($v)){
								?>
								<tr><th><?php echo $user->getAttributeLabel($k);?></th><td><?php echo $v ;?></td></tr>
								<?
								}
							}
							 ?>
					 	</table>
                        
							<h4 class="page-head">New Contact Information</h4>
                        <table class="table table-bordered">
							<?php $items = array('full_name'=>$request->contact_name,'phone'=>$request->phone,'landline'=>$request->landline);
							foreach( $items as $k=>$v){
								if(!empty($v)){
								?>
								<tr><th><?php echo $request->getAttributeLabel($k);?></th><td><?php echo $v ;?></td></tr>
								<?
								}
							}
							 ?>
							 <tr><th colspan="100%"> <a title="Update" class="btn btn-primary" target="_blank" href="<?php echo Yii::app()->createUrl('listingusers/update',array('id'=>$user->user_id,'type'=>$user->user_type));?>"> &nbsp;  View User Details &nbsp;</a></td></tr>
						</table>
                        
                        
                        </div>
                  
                     </div>
                </div>
            
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                <?php
                $statusList = UserDetailsChange::model()->activeArray();
                foreach($statusList as $k=>$v){
						$cl = 'bg-blue';
	        if($k=='W'){
				$cl = 'bg-yellow';
			}
					echo '<button type="button" class="btn '.$cl.'" onclick="updateStatus(this)" data-url="'.Yii::app()->createUrl($this->id.'/status_change',array('val'=>$k,'id'=>$request->id)).'" >'.$v.'</button>'; 
				}
                ?> 
            </div>
