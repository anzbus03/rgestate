 
					<div id="#" class="header">
					<h4><a href="#"><?php echo $v->section_name;?> (<?php echo  $adsCount ;?>)</a></h4>
					</div>
					<div class="profile-content">
					<div class="table">
					 
					 <?php $form = $this->beginWidget('CActiveForm',array("id"=>"ss_delete_form", 'htmlOptions'=>array("class"=>"delete-form")));;?>
					<input class="awesome red small del-search-btn" onclick="return SubmitBtn(this)" type="buton" style="cursor:pointer;" value="X Delete selected Ads" name="multiple_delete">
					<table cellspacing='0' id="unseen"> 
					 
					  <?php
					  foreach($ads as $k2=>$v2)
					  {
						  ?>
						 
						 <tr>
							   <td style="text-align:center;">
								  <span class="ea-magnifier">
									 
									<a href="<?php echo $v2->referal;?>">
									
									 <?php echo $v2->referal;?>
									<i class="u-icon u-icon--search"></i>
									</a>
									</span>
						      </td>
							  <td style="text-align:center;"><input id="" class="item-select" type="checkbox" value="<?php echo $v2->id;?>" name="delete_selected[]"></td>
						      <td><?php echo Searchlist::model()->time_elapsed_string($v2->date_added); ?></td>
						     
						      <td>
							 
								 
									<a href="<?php echo $v2->referal;?>">
									 
									 
								   <?php echo str_replace(Yii::app()->apps->getBaseUrl('','', false ,false).'index.php/','',$v2->referal);?>
									<i class="u-icon u-icon--search"></i>
									</a>
								 
						       
								
								 
						      </td>
						      <td style="width:300px;">
						      <i id="heart-status-off" class="u-icon u-icon--email"></i>
								 
								 Email Alerts are <?php echo  ($v2->alert=='Y') ? ' OFF ' : ' ON ';?> 
								 
								(<a href="<?php echo Yii::app()->createUrl("user/email_subcription",array("id"=>$v2->id));?>">Turn <?php echo  ($v2->alert=='Y') ? ' ON ' : ' OFF ';?></a>)
								 
								<button class="delete" name="delete" value="<?php echo $v2->id ;?>" type="submit">
								<i class="u-icon u-icon--trash"></i>
								Delete
								</button>
								 
						      </td>
						  </tr>
						 <?php     
							
					}
					?>
					<tr><td></td><td colspan="4" class="paginator">
						<div class="pagingarea"  >
						<div class="actions" data-category="<?php echo $v->section_id;?>">
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
					
					<?
					
				   $this->endWidget();?>
               
				</table>
				
				</div>
				</div>
			 
			 
