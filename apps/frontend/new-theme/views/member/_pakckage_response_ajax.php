<div class="warning pageHead"><?php echo $message;?></div>
<hr />
<div class="accounb-dic">
<div class="accounb-dic-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/money.png');?>"></div>
<div class="accounb-dic-details">
<div class="accounb-dic-details-head">Account Balance</div>
<div class="accounb-dic-details-price"><span class=""><?php echo $this->member->AccountBalance;?></span><a class="toppcls" href="<?php echo Yii::app()->createUrl('member/topup_options');?>">Top-up</a></div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<hr />
<?php
if($success){
	?>
	<a class="close_popup_p" href="<?php echo Yii::app()->createUrl('member/addons');?>" >Close</a>
	<?
}else{ ?> 
<a class="close_popup_p" href="javascript:void(0)" onclick="closePoputi()" >Close</a>
<?php } ?> 
