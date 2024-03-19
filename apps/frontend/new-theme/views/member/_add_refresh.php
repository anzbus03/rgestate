<div class="warning pageHead"><?php echo $message;?></div>
<hr />
<div class="accounb-dic">
<div class="accounb-dic-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/star.png');?>"></div>
<div class="accounb-dic-details">
<?php
if(!$success){ ?> 
<div class="accounb-dic-details-head" style="font-size:18px;font-weight:normal">Select Refresh Package</div>
<div class="accounb-dic-details-price"><a class="toppcls" href="<?php echo Yii::app()->createUrl('member/addons',array('option'=>'refresh'));?>">Click here to subscribe</a></div>
<?php }
else{
	?>
<div class="accounb-dic-details-price"><a class="toppcls" href="javascript;void(0)">Successfully refreshed your AD.</a></div>

	<?
}
 ?> 
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<hr />
<?php
if($success){
	?>
	<a class="close_popup_p"  href="javascript:void(0)" onclick="closePoputifsuccess()">Close</a>
	<?
}else{ ?> 
<a class="close_popup_p" href="javascript:void(0)" onclick="closePoputif()" >Close</a>
<?php } ?> 
