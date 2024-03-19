<?php defined('MW_PATH') || exit('No direct script access allowed');
 ?>
  <div class="breadcrumbs">
        <a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('user/my_watchlist');?>">My Watchlist</a>
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

        <li class="active"><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_watchlist');?>">My Watchlist</a></span><span class="righttab">&nbsp;</span></li>

		<li class=""><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_searches');?>">My Searches</a></span><span class="righttab">&nbsp;</span></li>

		
	
</ul>
<div style="clear:both"></div>




    <?php
    /*
        
        <div id="empty-list">
          <div id="empty-message">Your watch list is empty</div>
          <div id="fill-message">To fill your watch list, click the "Add to watch list" button while viewing an ad</div>
        </div>
        
      */
      ?>
      

      
        
        <?php
        if($categories)
			{
				$watchFound= false;
				$inserted  = false;
				foreach($categories as $k=>$v)
				{
				?>
                          <?php
                          if($v->watchlists)
                          {
							 $watchFound= false;
							 $inserted  = false;
							 
							 //Found Result Show Else not
							 if(!$inserted)
							 {
								 ?>
									<div class="watchlist-p ">
										<?php $form = $this->beginWidget('CActiveForm',array("id"=>"ss_delete_form"));;?>
									<div class="profile-bottom group">
									<div class="header"><h3><i class="u-icon u-icon--star"></i> Watch List</h3></div>  
									<div class="profile-content">
									<div class="table">
									<div class="warning">Please note, expired and deleted listings will automatically be removed from your Watch List.</div>
									<input class="awesome small red del-watchlist-btn" type="submit" name="deleteselected" alt="Stop Watching Selected Ads" title="Stop Watching Selected Ads" value="Stop Watching Selected Ads" />
								 <?
								 $inserted=true;
							 }
							  ?><div class="category-name"><?php echo $v->category_name;?></div><?
							  foreach($v->watchlists as $k2=>$v2)
							  {
							  ?>
								<div class="row">
								<div class="col checkboxes"><input type="checkbox" name="wl-select[]" value="<?php echo $v2->id;?>" class="item-select" /></div>
								<div class="col text">
								   <strong><a href='<?php echo Yii::app()->createUrl("details/".$v2->Ad->slug);?>'><?php echo $v2->Ad->ad_title;?></a></strong> in <?php echo $v2->Ad->country0->country_name;?>
								</div>
								<div class="col price">
										AED <span id="actualprice"><?php echo number_format($v2->Ad->price,2,'.',',');?></span>
  							    </div>        
							      
						  </div>
         
         
                        <?php
							}
					}
				 }
			 }
			 if($inserted)
			 {
			 ?>
      
      
				<div class="watchlist-delete">
				<input type="hidden" name="delete-ads" value="1">
				<input class="awesome small red del-watchlist-btn" type="submit" name="deleteselected" alt="Stop Watching Selected Ads" title="Stop Watching Selected Ads" value="Stop Watching Selected Ads" />
				</div>
				</div>
				</div>
				</div>
				<?php $this->endWidget();?>
				</div>
             <?php
			}
			else
			{
				?>
				<div id="empty-list">
				<div id="empty-message">Your watch list is empty</div>
				<div id="fill-message">To fill your watch list, click the "Add to watch list" button while viewing an ad</div>
				</div>
				<?
			}
			?>
