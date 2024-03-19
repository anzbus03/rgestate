 
					<div id="#" class="header">
					<h4><a href="#">Active Downloads (<?php echo  $adsCount ;?>)</a></h4>
					</div>
					<div class="profile-content">
					<div class="table">
					<table cellspacing='0' id="customers"> 
					  <tr>
    <th width="125px">Time</th>
    <th>Work</th>
  </tr>
					  <?php
					  foreach($ads as $k2=>$v2)
					  {
						  ?>
						 
						  <tr>
							        
									<td  >
									<i class="fa fa-clock-o" title="<?php echo $v2->dateAdded;  ?>"></i> <?php echo $v2->dateAdded;  ?>
									</td>
									
									<td  >
								  
									 
									<a href="<?php   echo Yii::app()->createUrl('details/index',array('slug'=>$v2->slug));   ;?>">
									<?php echo $v2->ad_title;?>
									</a>
									</td>
									
				 
						  </tr>
						 <?php     
							
					}
					?>
					<tr><td colspan="100%" class="paginator">
						<div class="pagingarea"  >
						<div class="actions"  >
						<?php 
						//if($pages->itemCount>3){


						$this->widget('frontend.components.web.widgets.SimplaPager', array(
						'pages'=>$pages,
						// 'route' => 'user/AjaxDetails',

						));  
						//}
						?>
						</div>
						</div>
				</td></tr>
					
					 
               
				</table>
				
				</div>
				</div>
			 
			 
