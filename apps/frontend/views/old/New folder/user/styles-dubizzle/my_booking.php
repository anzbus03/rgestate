<?php defined('MW_PATH') || exit('No direct script access allowed');
 ?>
		
    <div class="breadcrumbs">
        <a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('user/my_ads');?>">My Ads</a>
    </div>


 

<ul id="account-tabs">
	<li class=" "><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">My Profile</a></span><span class="righttab">&nbsp;</span></li>

	
		<li class="active dropdown">
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

		<li class=""><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_searches');?>">My Searches</a></span><span class="righttab">&nbsp;</span></li>

		
	
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
				  if($v->MyAds)
				  {
					  ?>
					<div id="#" class="header">
					<h4><a href="<?php  echo  Yii::app()->createUrl("searchlist/index", array_filter($newRoute));?>"><?php echo $v->category_name;?> (<?php echo sizeOf($v->adsCount);?>)</a></h4>
					</div>
					<div class="profile-content">
					<div class="table">
					 
						<?php $form = $this->beginWidget('CActiveForm',array("id"=>"ss_delete_form", 'htmlOptions'=>array("class"=>"delete-form")));;?>
					<input class="awesome red small del-search-btn" onclick="return SubmitBtn()" type="buton" style="cursor:pointer;" value="X Delete Selected Adds" name="multiple_delete">
			
					  <?php
					  foreach($v->MyAds as $k2=>$v2)
					  {
						  ?>
								<div class="group">
								<div class="row">
								<div class="col checkboxes">
								<input id="" class="item-select" type="checkbox" value="<?php echo $v2->id;?>" name="delete_selected[]">
								</div>
								<div class="col time">
								<label for=""><?php echo Searchlist::model()->time_elapsed_string($v2->added_date); ?></label>
								</div>
								<span class="ea-magnifier">
								
								 
								<a href="<?php echo Yii::app()->createUrl("details/".$v2->slug);?>">
								
								 
								<i class="u-icon u-icon--search"></i>
								</a>
								</span>
								<div class="col info">
								 
								<a href="<?php echo Yii::app()->createUrl("details/".$v2->slug);?>">
								<?php echo $v2->ad_title;?>
                                </a>
								<br>
								 
								<br>
								 
								</div>
								<div class="col">
								 
								<b><?php if($v2->status=='A'){ echo 'Active';}else{ echo 'Inactive'; };?></b>  
								</div>
								<div class="col ea-switch">
								 
								<span class="ea-actions">
								<button class="delete" name="delete" value="<?php echo $v2->id ;?>" button="button" onclick="return SubmitBtn()" >
								<i class="u-icon u-icon--trash"></i>
								Delete
								</button>
								</span>
								<span class="ea-actions">
								<a class="delete"  href='<?php echo  Yii::app()->createUrl("place_an_ad/update",array("id"=>$v2->id));?>' >
								<i class="u-icon u-icon--edit"></i>
								Edit
								</a>
								</span>
								</div>
								</div>
								</div>
                <?php 
				}
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
				 
		
 
<script type="text/javascript">

function SubmitBtn()
{
	var con = confirm("Are you sure to delete selected Ad");
	if(con)
	{
		$(".delete-form").submit();
	}
	else
	{
		return false;
	}
}
</script>
	 
