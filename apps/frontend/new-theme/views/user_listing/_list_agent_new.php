<?php
$call = $this->tag->getTag('call','Call');
$Email  = $this->tag->getTag('email2','Email');
$properties = $this->tag->getTag('properties','Properties');
$Designtion = $this->tag->getTag('designtion','Designtion');
 
	foreach($works as $k=>$v){
		?>
		<li class="user-li-list">
		<div>
		
		<div class="photose" style="position:relative;">
				<div class="user-li-list-agent"><a href="<?php echo $v->agentDetailUrl;?>"    ></a></div>
	
			<picture><img src="<?php echo $v->getSingleImage(400,400); ;?>" /></picture>
			</div>
		<div class="ui-det">
			<div  style="position:relative;">	<div class="user-li-list-agent"><a href="<?php echo $v->agentDetailUrl;?>"   title="<?php echo $v->first_name;?>"></a></div>
	
		<div class=""><h1 class="p-head3 margin-top-10 margin-bottom-0" dir="auto"><?php echo $v->FirstNameN;?></h1></div>
		<div class="propert-cnt"><span class="_2c6bf98f"><?php echo $properties;?>:&nbsp;</span><?php echo $v->sale_total;?><div></div></div>
		<div class="propert-cnt"><span class="_2c6bf98f"><?php echo $properties;?>:&nbsp;</span><?php echo $v->role_id;?><div></div></div>
		
		</div>
		
		<div class="call-btn-div-bot margin-top-10" style="padding:0px;width:100% !important">
								<a type="button" style="color:#fff; " onclick="OpenCallNew(this)" data-phone="<?php echo base64_encode($v->contactPhone);?>" data-testid="lead-form-submit" class="b-l-l-m br-black-1-dot Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA  pull-left " dir="auto" ><i class="fa fa-phone" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $call ;?></a>
								<a type="button" onclick="OpenFormAgentClickNew(this)" data-reactid="<?php echo $v->user_id;?>" data-testid="lead-form-submit" class="b-r-r-m Button__ButtonBase-sc-1ea9wz-0 TertiaryButton-sc-1ve5gq4-0 fENbfA pull-right  "><i class="fa fa-envelope" style="font-size: 20px;margin-right: 3px;"></i> <?php echo $Email ;?></a>
																									 
								<div class="clearfix"></div>
					 </div>
		
		
		</div>
		
		</div>
		
		</li>
		<?php 
	}
 
?>
		 
