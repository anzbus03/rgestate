<div class="warning pageHead"><?php echo $message;?></div>
<hr />
<div class="accounb-dic">
<div class="accounb-dic-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/star.png');?>"></div>
<div class="accounb-dic-details">
<?php
if(!$success){ ?> 
<div class="accounb-dic-details-head" style="font-size:18px;font-weight:normal">Subscribe Package</div>
<div class="accounb-dic-details-price"><a class="toppcls" href="<?php echo Yii::app()->createUrl('member/addons',array('option'=>'featured'));?>"><?php echo $this->tag->getTag('click_here_to_subscribe','Click here to subscribe');?></a></div>
<?php }
else{
	?>
<div class="accounb-dic-details-price"><a class="toppcls" href="javascript;void(0)"><?php echo $this->tag->getTag('successfully_moved_from','Successfully  moved from featured list.');?></a></div>

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
	<a class="close_popup_p"  href="javascript:void(0)" onclick="closePoputifsuccess()"><?php echo $this->tag->getTag('close','Close');?></a>
	<?
}else{ ?> 
<a class="close_popup_p" href="javascript:void(0)" onclick="closePoputif()" ><?php echo $this->tag->getTag('close','Close');?></a>
<?php } ?> 
