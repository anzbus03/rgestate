<?php defined('MW_PATH') || exit('No direct script access allowed'); 
 ?>
 

		<ul class="large-9 columns breadcrumbs">
		<li class="angleright"><a href="<?php echo Yii::app()->createUrl('');?>/"><i class="fa fa-home" aria-hidden="true"></i>  Home</a></li>
		<li class="current"><a href="#">My Searches</a></li>
		</ul>

<div style="clear:both; height:1px; font-size:1px">&nbsp;</div>

<ul id="account-tabs">
	 <li class=" "><span class="lefttab">&nbsp;</span><span class="tabcontent"> <i class="fa fa-user"></i> <a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">  My Profile</a></span><span class="righttab">&nbsp;</span></li>
	<li class=" dropdown"> <span class="lefttab">&nbsp;</span> <span class="tabcontent"> <i class="fa fa-buysellads"></i>  <a href="<?php echo Yii::app()->createUrl('user/my_ads');?>"> My Ads </a> </span> <span class="righttab">&nbsp;</span> </li>
	<li class=""><span class="lefttab">&nbsp;</span><span class="tabcontent"> <i class="fa fa-eye"></i>  <a href="<?php echo Yii::app()->createUrl('user/my_watchlist');?>">My Watchlist</a></span><span class="righttab">&nbsp;</span></li>
	<li class="active"><span class="lefttab">&nbsp;</span><span class="tabcontent"><i class="fa fa-search"></i>  <a href="<?php echo Yii::app()->createUrl('user/my_searches');?>">  My Searches</a></span><span class="righttab">&nbsp;</span></li>

	
</ul>
<div style="clear:both"></div>
 

		 <div class="mysearches-p" style="height:0px;padding:0px;margin-0px;">
		
 

		

		<div class="profile-bottom group" style="padding-top:10px;">
			<?php
			$count = 0;
			if($section)
			{
				foreach($section as $k=>$v)
				{
					    
					$criteria = new CDbCriteria();
					$criteria->compare('t.user_id',Yii::app()->user->getId());
					$criteria->compare('t.section_id',$v->section_id );
					$criteria->order = 'date_added desc';
				    $adsCount = Searchlist::model()->count($criteria);
    	
					$pages = new CPagination($adsCount);
					$pages->pageSize = 1;
				 
					$pages->applyLimit($criteria);
					 
					$ads = Searchlist::model()->findAll($criteria);
        
        
					 
					 
					 
				  if($adsCount)
				  {
					  $count++;
					  echo '<div id="category_'.$v->primaryKey.'">';
					  $this->renderPartial('_list_search',compact('ads','pages','adsCount','v'));
					  echo '<div style="clear:both;"></div></div>';
				  }
		 
			}
			 
			if($count==0){
				?>
				<div id="empty-message" class="header">
					<i class="fa fa-search"></i> No Searches Found  Yet !!! 	
				 
				 </div>
				 
				<?
			}
		  }
				 ?>
					
					
				
			
		</div>
	

      
</div>

<style>
.mysearches-p .empty{ display:none ; }
</style>
<script>

function pageclicker(){
$('.actions').find('a').live('click',function(event ){     event.preventDefault(); 
	var url = $(this).attr('href');
	var category_id = ($(this).closest('.actions').data('category'));
	if(url!= undefined && category_id!= undefined ){
		url+= '/section_id/'+category_id;
		$.get(url,function(data){  if(data){
			
			$('#category_'+category_id).html(data)
			
			} })
	}
	
	  })
  }
  function SubmitBtn(k)
{
	var con = confirm("Are you sure to delete selected ");
	if(con)
	{
		$(k).closest("form").submit();
	}
	else
	{
		return false;
	}
}
  pageclicker();
</script>
 
