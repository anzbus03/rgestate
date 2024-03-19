<?php defined('MW_PATH') || exit('No direct script access allowed');
 ?>
  <div class="breadcrumbs">
        <a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('user/my_searches');?>">My Searches</a>
    </div>

<div style="clear:both; height:1px; font-size:1px">&nbsp;</div>

<ul id="account-tabs">
	<li class=" "><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">My Profile</a></span><span class="righttab">&nbsp;</span></li>

	
		<li class=" dropdown">
			<span class="lefttab">&nbsp;</span>
			<span class="tabcontent">
				<a href="<?php echo Yii::app()->createUrl('user/my_ads');?>">
					My Ads
					
				</a>
			</span>
			<span class="righttab">&nbsp;</span>

			<ul>
				

		        
			</ul>
		</li>

        <li class=""><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_watchlist');?>">My Watchlist</a></span><span class="righttab">&nbsp;</span></li>

		<li class="active"><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_searches');?>">My Searches</a></span><span class="righttab">&nbsp;</span></li>

		
	
</ul>
<div style="clear:both"></div>
 

		 <div class="mysearches-p" style="height:0px;padding:0px;margin-0px;">
		
 

		

		<div class="profile-bottom group" style="padding-top:10px;">
			<?php
			if($categories)
			{
				foreach($categories as $k=>$v)
				{
					$newRoute["category_id"]=$v->category_id; 
					$newRoute["user_id"]=Yii::app()->user->getId(); 
					?>
						<?php 
				  if($v->searchLists)
				  {
					  ?>
					<div id="#" class="header">
					<h4><a href="<?php  echo  Yii::app()->createUrl("searchlist/index", array_filter($newRoute));?>"><?php echo $v->category_name;?> (<?php echo sizeOf($v->searchLists);?>)</a></h4>
					</div>
					<div class="profile-content">
					<div class="table">
					
					<?php $form = $this->beginWidget('CActiveForm',array("id"=>"ss_delete_form"));;?>
					<input class="awesome red small del-search-btn" type="submit" style="cursor:pointer;width:auto;" value="X Delete Selected Searches" name="multiple_delete">
					 <br />
					<table cellspacing='0' id="unseen"> 
					  <?php
					  foreach($v->searchLists as $k2=>$v2)
					  {
						  ?>
						  <tr>
							   <td style="text-align:center;">
								  <span class="ea-magnifier">
									<?php 
									//IF SESSION MISMATCH WITH COUNTRY
									if(Yii::app()->request->cookies['country']->value!=$v2->country_id || Yii::app()->request->cookies['state']->value!=$v2->state_id)
									{
										 
										?>
										 <a href="<?php echo  Yii::app()->createUrl("country/session_alter",array("country"=>$v2->country_id,"state"=>$v2->state_id,"return_url"=>$v2->id));  ?>"> 
										<?php
									}
									else
									{
										?>
									<a href="<?php echo $v2->referal;?>">
									
									<?php
								   }
								   ?>
									<i class="u-icon u-icon--search"></i>
									</a>
									</span>
						      </td>
							  <td style="text-align:center;"><input id="" class="item-select" type="checkbox" value="<?php echo $v2->id;?>" name="delete_selected[]"></td>
						      <td><?php echo Searchlist::model()->time_elapsed_string($v2->date); ?></td>
						     
						      <td>
							 
									<?php 
									//IF SESSION MISMATCH WITH COUNTRY
									if(Yii::app()->request->cookies['country']->value!=$v2->country_id || Yii::app()->request->cookies['state']->value!=$v2->state_id)
									{
										 
										?>
										 <a href="<?php echo  Yii::app()->createUrl("country/session_alter",array("country"=>$v2->country_id,"state"=>$v2->state_id,"return_url"=>$v2->id));  ?>"> 
										<?php
									}
									else
									{
										?>
									<a href="<?php echo $v2->referal;?>">
									
									<?php
								   }
								   ?>
									<i class="u-icon u-icon--search"></i>
									</a>
								 
						      <?php 
								//IF SESSION MISMATCH WITH COUNTRY
								if(Yii::app()->request->cookies['country']->value!=$v2->country_id || Yii::app()->request->cookies['state']->value!=$v2->state_id)
								{
									 
									?>
									 <a href="<?php echo  Yii::app()->createUrl("country/session_alter",array("country"=>$v2->country_id,"state"=>$v2->state_id,"return_url"=>$v2->id));  ?>"> 
									<?php
								}
								else
								{
									?>
								<a href="<?php echo $v2->referal;?>">
								
								<?php
							   }
							   ?>
								
								
								 <?php echo $v2->category_seraches->category_name;?> <?php if(isset($v2->subCategory_searches->sub_category_name)) { echo '   ‪> ‪ '.$v2->subCategory_searches->sub_category_name.' ‪ ';}?> </a>
							in <?php echo @$v2->country_seraches->country_name;?>,<?php echo @$v2->state_searches->state_name;?>
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
							
							<!--
								<div class="group">
								<div class="row">
								<div class="col checkboxes">
								<input id="" class="item-select" type="checkbox" value="<?php echo $v2->id;?>" name="delete_selected[]">
								</div>
								<div class="col time">
								<label for=""><?php echo Searchlist::model()->time_elapsed_string($v2->date); ?></label>
								</div>
								<span class="ea-magnifier">
								
								<?php 
								//IF SESSION MISMATCH WITH COUNTRY
								if(Yii::app()->request->cookies['country']->value!=$v2->country_id || Yii::app()->request->cookies['state']->value!=$v2->state_id)
								{
									 
									?>
									 <a href="<?php echo  Yii::app()->createUrl("country/session_alter",array("country"=>$v2->country_id,"state"=>$v2->state_id,"return_url"=>$v2->id));  ?>"> 
									<?php
								}
								else
								{
									?>
								<a href="<?php echo $v2->referal;?>">
								
								<?php
							   }
							   ?>
								<i class="u-icon u-icon--search"></i>
								</a>
								</span>
								<div class="col info">
								 	<?php 
								//IF SESSION MISMATCH WITH COUNTRY
								if(Yii::app()->request->cookies['country']->value!=$v2->country_id || Yii::app()->request->cookies['state']->value!=$v2->state_id)
								{
									 
									?>
									 <a href="<?php echo  Yii::app()->createUrl("country/session_alter",array("country"=>$v2->country_id,"state"=>$v2->state_id,"return_url"=>$v2->id));  ?>"> 
									<?php
								}
								else
								{
									?>
								<a href="<?php echo $v2->referal;?>">
								
								<?php
							   }
							   ?>
								
								
								 <?php echo $v2->category_seraches->category_name;?> <?php if(isset($v2->subCategory_searches->sub_category_name)) { echo '   ‪> ‪ '.$v2->subCategory_searches->sub_category_name.' ‪ ';}?> </a>
								<br>
								No price range
								<br>
								in <?php echo @$v2->country_seraches->country_name;?>,<?php echo @$v2->state_searches->state_name;?>
								</div>
								<div class="col ea-switch">
								<i id="heart-status-off" class="u-icon u-icon--email"></i>
								<span class="ea-onoff-actions">
								<span class="ea-title">Email Alerts are <?php echo  ($v2->alert=='Y') ? ' OFF ' : ' ON ';?></span>
								<br>
								<a href="<?php echo Yii::app()->createUrl("user/email_subcription",array("id"=>$v2->id));?>">Turn <?php echo  ($v2->alert=='Y') ? ' ON ' : ' OFF ';?></a>
								</span>
								<span class="ea-actions">
								<button class="delete" name="delete" value="<?php echo $v2->id ;?>" type="submit">
								<i class="u-icon u-icon--trash"></i>
								Delete
								</button>
								</span>
								</div>
								</div>
								</div>
								-->
                <?php 
				}
				?>
				</table>
				<?
			}
			else
			{
				?>
				<div id="#" class="header empty">
					<h4><a href="<?php  echo  Yii::app()->createUrl("searchlist/index", array_filter($newRoute));?>"><?php echo $v->category_name;?> (0)</a></h4>
					</div>
					 <div>
					 <div>
					 	<?php $form = $this->beginWidget('CActiveForm',array("id"=>"ss_delete_form"));;?>
			
				<?
			}
			?>
					<?php $this->endWidget();?>
					
					
					
					
					
					</div>
					</div>
					<?
				}
			}
				 ?>
					
				
			
			
				
					
				
			
		</div>
	

      
</div>



      
