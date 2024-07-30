     <div class="col-lg-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
              <li  class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Ads for Approval</a><?php echo  !empty($ads) ? '<span class="label label-danger">'.sizeOf($ads).'</span>': '';?></li>
              <li  class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Customer for  Approval</a><?php echo  !empty($usr) ? '<span class="label label-danger">'.sizeOf($usr).'</span>': '';?></li>
              <li  class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Property Enquiry</a><?php echo  !empty($pro_enquiry_unread) ? '<span class="label label-danger">'.$pro_enquiry_unread.'</span>': '';?></li>
              <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="true">Realtors Enquiry</a><?php echo  !empty($agent_enquiry_unread) ? '<span class="label label-danger">'.$agent_enquiry_unread.'</span>': '';?></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true">General Enquiry</a><?php echo  !empty($general_enquiry_unread) ? '<span class="label label-danger">'.$general_enquiry_unread.'</span>': '';?></li>
            
            </ul>
                <style>
					.nav-tabs .label.label-danger{ position: absolute;right: 0;top: 0;}
					.timeline > li > .timeline-item > .timeline-header > a { color:#333; font-size:13px; }
					.timeline > li > .timeline-item > .timeline-header >  .fa-envelope-open-o { color:green; }
					.timeline > li > .timeline-item > .timeline-header >  .fa-envelope-o { color:red; }
					.timeline::before{ content:unset; }
					.timeline-item{ margin-left:0px !important;  }
					.nav-tabs-custom > .tab-content {
					background: #fff;
					padding: 10px;
					max-height: 330px;
					height: 330px;
					overflow-y: scroll;
					}
					.timeline > li > .timeline-item{ margin-right: 0px;}
					.timeline > li {
					position: relative;
					margin-right: 0px;
					margin-bottom: 2px;
					}
                 </style>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane active timeline" id="tab_1">
            
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th  style="width:80px;">Date</th>
                    <th>Ad Title</th>
                    <th   style="width:100px;">User</th>
                    <th style="width:40px;">&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody  >
				  <?php
				  if($ads){
					  foreach($ads as $k=>$v){ ?> 
                  <tr>
                    <td  style="width:80px;"><?php echo $v->SmallDate;?></td>
                    <td> 
                    <a href="<?php echo $v->PreviewUrlTrash;?>" target="_blank"><?php echo $v->ad_title;?></a>
                    </td>
                    <td   style="width:100px;"><?php echo $v->userUrl;?></td>
                    <td style="width:40px;">
					<?php echo $v->statusLink;?>
                    </td>
                  </tr>
                  <?php } } 
                  else{
					  ?>
					  <tr><td colspan="100%">No Ads for 'Pending Approval'</td></tr>
					  <?
				  }
                  ?>  
                  
                  </tbody>
                </table>
             
                </div>
              <div class="tab-pane   timeline" id="tab_6">
                  <table class="table no-margin">
                  <thead>
                  <tr>
                    <th  style="width:100px;">Date</th>
                    <th>Name</th>
                    <th style="width:100px;">Type</th>
                    <th style="width:80px;">&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody  >
				  <?php
				  if($usr){
					  foreach($usr as $k=>$v){ ?> 
                  <tr>
                    <td  style="width:100px;"><?php echo $v->smalDale;?></td>
                    <td> <?php echo $v->fullName;?></td>
                    <td   style="width:100px;"><?php echo $v->TypeTile;?></td>
                    <td style="width:80px;">
					<?php echo $v->MemebrApproved;?>
                    </td>
                  </tr>
                  <?php } } 
                  else{
					  ?>
					  <tr><td colspan="100%">No Agents for 'Pending Approval'</td></tr>
					  <?
				  }
                  ?>  
                  
                  </tbody>
                </table>
              </div>
              <div class="tab-pane   timeline" id="tab_2">
                 <?php $this->renderPartial('_loader_pro_enquiry');?> 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane timeline" id="tab_3">
                 <?php $this->renderPartial('_loader_general_enquiry');?> 
              </div>
              <div class="tab-pane timeline" id="tab_4">
                 <?php $this->renderPartial('_loader_agent_enquiry');?> 
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
   </div>
        
