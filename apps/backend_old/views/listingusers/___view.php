<div class="modal-body" >
 <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#registraion" aria-controls="registraion" role="tab" data-toggle="tab">Registraion Information</a>

                        </li>
                         
                        <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">Personal Information</a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="registraion">
                        <table class="table table-bordered">
							<tr><th><?php echo $user->getAttributeLabel('user_type');?></th><td><?php echo $user->TypeTile ;?></td></tr>
							<tr><th><?php echo $user->getAttributeLabel('slug');?></th><td><?php echo $user->slug ;?></td></tr>
							<tr><th><?php echo $user->getAttributeLabel('email');?></th><td><?php echo $user->email ;?></td></tr>
							<tr><th><?php echo $user->getAttributeLabel('first_name');?></th><td><?php echo $user->first_name ;?></td></tr>
							<tr><th><?php echo $user->getAttributeLabel('last_name');?></th><td><?php echo $user->last_name ;?></td></tr>
							<tr><th><?php echo $user->getAttributeLabel('calls_me');?></th><td><?php echo $user->calls_me ;?></td></tr>
							<tr><th><?php echo $user->getAttributeLabel('country');?></th><td><?php echo !empty($user->country_id)? $user->countries->country_name : '' ;?></td></tr>
						</table>
                        
                        
                        </div>
                  
                        <div role="tabpanel" class="tab-pane" id="browseTab">
                         <table class="table table-bordered">
							 <?php
							if(!empty($personal)){ ?>
							<tr><th><?php echo $personal->getAttributeLabel('slug');?></th><td><?php echo $user->slug ;?></td></tr>
							<tr><th><?php echo $personal->getAttributeLabel('website');?></th><td><?php echo $user->website ;?></td></tr>
							<tr><th><?php echo $personal->getAttributeLabel('bio');?></th><td><?php echo $user->description ;?></td></tr>
							<tr><th colspan="2">Professional Portfolio</th></tr>
							<?php if(!empty($personal->shutterstock_id)){  ?>
							<tr><th colspan="2"><?php echo CHtml::link($personal->Shutterstock,$personal->Shutterstock,array('target'=>'_blank'));?></th></tr>
							<?php } ?>
							<?php if(!empty($personal->istockphoto_id)){  ?>
							<tr><th colspan="2"><?php echo CHtml::link($personal->Istockphoto,$personal->Istockphoto,array('target'=>'_blank'));?></th></tr>
							<?php } ?> 
							<?php if(!empty($personal->stock_adobe)){  ?>
							<tr><th colspan="2"><?php echo CHtml::link($personal->stockAdobe,$personal->stockAdobe,array('target'=>'_blank'));?></th></tr>
							<?php } ?> 
							<tr><th colspan="2">Social</th></tr>
							<?php if(!empty($personal->facebook)){  ?>
							<tr><th colspan="2"><?php echo CHtml::link($personal->Fb,$personal->Fb,array('target'=>'_blank'));?></th></tr>
							<?php } ?> 
							<?php if(!empty($personal->dribbble)){  ?>
							<tr><th colspan="2"><?php echo CHtml::link($personal->Ddb,$personal->Ddb,array('target'=>'_blank'));?></th></tr>
							<?php } ?> 
							<?php if(!empty($personal->twitter)){  ?>
							<tr><th colspan="2"><?php echo CHtml::link($personal->Twt,$personal->Twt,array('target'=>'_blank'));?></th></tr>
							<?php } ?> 
							<?php if(!empty($personal->pinterest)){  ?>
							<tr><th colspan="2"><?php echo CHtml::link($personal->Pint,$personal->Pint,array('target'=>'_blank'));?></th></tr>
							<?php } ?> 
					 
							<?php }
							else{
								?>
								<tr><th colspan="2">Not Filled Personal Information</th></tr>
								<?
							}
							 ?> 
						</table>
                        
                        
                        </div>
                    </div>
                </div>
            
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-warning" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('listingusers/status_change',array('val'=>'R','id'=>$user->user_id));?>" >Reject</button>
                <button type="button" class="btn btn-success save" onclick="updateStatus(this)" data-url="<?php echo Yii::app()->createUrl('listingusers/status_change',array('val'=>'A','id'=>$user->user_id));?>">Approve</button>
            </div>
