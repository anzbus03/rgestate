<?php defined('MW_PATH') || exit('No direct script access allowed'); ?>
	
	<ul class="large-9 columns breadcrumbs">
	<li class="angleright"><a href="<?php echo Yii::app()->createUrl('');?>/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
	<li class="current"><a href="#">My Job Applications</a></li>
	</ul>
	<br />

 
	<div style="clear:both"></div>

		 
					 
			
		
		 <div class="mysearches-p" style="height:0px;padding:0px;margin-0px;">

			<div class="profile-bottom group" style="padding-top:10px;">
			<?php
			$count=0; 
			if($model)
			{
				
			?>		 
			 <div id="category_1">
				 
				 <div class="table">

							<table id="unseen" cellspacing="0">

								<tr><th>Ad Title</th><th>Status</th><th>Total Applicants</th><th>Date Of Posting</th><th>Applied On</th></tr>
								<tbody>
									<?php
									foreach($model as $k=>$v)
									{
										$count++;
										?>
										<tr><td></td><td><?php echo $v->ad->ad_title;?> <a href="<?php echo Yii::app()->createUrl('details',array($v->ad->slug));?>"><i class="u-icon u-icon--eye"  style="position: relative; top: 4px;"></i></a></td><td style="width:150px;;"><?php echo $v->statusTitle;?></td><td  style="text-align:center;"><?php echo $v->ad->countApp;?></td><td><?php echo $v->ad->added_date;?></td><td><?php echo Searchlist::model()->time_elapsed_string($v->date_added);?></td></tr>
										<?
									}
									?>


								</tbody>
							</table>

					 
				</div>


			<div style="clear:both;"></div>
			</div>
			 
			<?php
					  
			 
		 
			  
			}
			if($count==0){
				?>
				<div id="#" class="header"> <h4>No Jobs Applied Yet  !!! 	 </h4> </div>
				<?
			}
			?>
			</div>
		</div>
 	
 
