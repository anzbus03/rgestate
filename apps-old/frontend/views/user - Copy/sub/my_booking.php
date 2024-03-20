<?php defined('MW_PATH') || exit('No direct script access allowed');  ?> 
<div class="profile-p"  id="main">

<ul class="large-9 columns breadcrumbs" style="overflow: hidden;margin-bottom: 30px;">
<li class="angleright"><a href="<?php echo Yii::app()->createUrl('');?>/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
<li class="current"><a href="#">My Ads</a></li>
</ul>
<br />
<style>
.no-margin-left { margin-left:0px !important; }
.mysearches-p a { color:#333;}
#customers {
    
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color:  #3F96D3;
    color: white;
}
</style>
<ul id="account-tabs" class="no-padding" >
	<li class="no-margin-left"><span class="lefttab">&nbsp;</span><span class="tabcontent"> <i class="fa fa-user"></i> <a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">  My Profile</a></span><span class="righttab">&nbsp;</span></li>
	<li class="active"> <span class="lefttab">&nbsp;</span> <span class="tabcontent"> <i class="fa fa-buysellads"></i>  <a href="<?php echo Yii::app()->createUrl('user/my_ads');?>"> My Downloads </a> </span> <span class="righttab">&nbsp;</span> </li>

		
	
</ul>
<div style="clear:both"></div>

		 
					 
			
		
		 <div class="mysearches-p" style="height:0px;padding:0px;margin-0px;">
		
 
<style>

	</style>
		<div class="alert alert-info">
  <strong>Info!</strong> Inactive or deleted download automtically remove from your list.
</div>

		<div class="profile-bottom group no-margin-left" style="padding-top:10px;margin:0px"  >
			<?php
			 
					   
					$criteria = new CDbCriteria();
					$criteria->select= 'ad.ad_title,ad.slug';
					$criteria->compare('t.user_id',Yii::app()->user->getId());
					$criteria->join=' INNER JOIN {{place_an_ad}} ad on ad.id=t.ad_id and ad.isTrash="0" and ad.status="A"';
					$criteria->order='t.date_added desc';
				    $adsCount = FreebitesDownloadIformation::model()->count($criteria);
					$pages = new CPagination($adsCount);
					$pages->pageSize = 1;
					$pages->applyLimit($criteria);
					$ads = FreebitesDownloadIformation::model()->findAll($criteria);
					
					  
				 
			if($adsCount==0){
				?>
				<div id="#" class="header">
					<h4>No Downloads Yet !!! 	
				</h4>
				<div style="clear:both"></div>
				 </div>
				 <div style="clear:both"></div>
				<?
			}
			else{
				$this->renderPartial('_list_booking_ads',compact('ads','pages','adsCount','v'));
			}
			
			
				 ?>
					
				
			</div>
					
			
				
					
				
			
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
function pageclicker(){
$('.actions').find('a').live('click',function(event ){     event.preventDefault(); 
	var url = $(this).attr('href');
	var category_id = ($(this).closest('.actions').data('category'));
	if(url!= undefined && category_id!= undefined ){
		url+= '/category_id/'+category_id;
		$.get(url,function(data){  if(data){
			
			$('#category_'+category_id).html(data)
			
			} })
	}
	
	  })
  }
  pageclicker();
</script>
<div class="clear-fix"></div>	 
</div>
<script>
	function setMinHeight(doc,to){
	  var windowheight = parseInt($(window).height()) ;
	  var documentheight = parseInt($('#'+doc).height()) ;
	  var minHeight = windowheight-documentheight; ; 
	  var minHeight = (parseInt(documentheight)+parseInt(minHeight)-parseInt(265))+'px'; ; 
	  $('#'+to).css('min-height',minHeight);
}
$(function(){ setMinHeight('main1','main');  });
</script>
