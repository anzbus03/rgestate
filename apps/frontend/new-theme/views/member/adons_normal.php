<?php 
$normal_packages = Package::model()->findFromCategoryID(1);
if(!empty($normal_packages)){ ?>       
<div class="row margin-bottom-15  margin-top-60">
	  <div class="col-sm-12">
				
		    
		          <div class="pageHeading   margin-bottom-25">
					<div class="desc-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/list.png');?>" alt="Normal Ads"  ></div>
					<div class="desc-det">
					   <div class="mm-d-h">Normal Ads</div>
					   <div class="small-desc  margin-top-0">&nbsp;</div>
					</div>
					 <div class="clearfix"></div>
					</div>
		     	 <div class="clearfix"></div>
			
		     <div class="clearfix"></div>
				 
				 <div class="pricing row">
 <?php
					 foreach($normal_packages as $k=>$v){ ?> 
						 <?php
						 if(empty($v->price_per_month) or $v->price_per_month=='0.00'){
							 ?>
							  <a href="javascript:void(0)"    >
							 <?
						 }else{?>
						  <a href="javascript:void(0)" onclick="processaddon(this)" data-p="<?php echo $v->price_per_month;?>" data-href="<?php echo Yii::app()->createUrl('member/add_package',array('id'=>$v->primaryKey));?>" >
						<?php }  ?> 
					<div class="[ price-option price-option--low  col-sm-3 <?php echo $v->active_package == $v->primaryKey ? 'active' : '' ;?> ]">
					<div class="price-option__detail">
					<span class="price-option__cost"><?php echo CURRENCY_CODE; echo number_format($v->price_per_month,0,'.',',');?></span>
					<span class="price-option__type"><?php echo $v->package_name;?></span>
						<?php
					if(!empty($v->validity_in_days)){ 
						
						if(!empty($v->active_package)){
							?>
							<span class="price-option__type validity text-green"><?php echo ($v->active_package_validity - $v->date_diff);?> days (<b><?php echo ($v->ads_allowed - $v->used_ad);?>ads</b>)  remaining</span>
						
							<?
						}
						else{
						?>
						<span class="price-option__type validity">Validitiy <?php echo $v->validity_in_days;?> days</span>
						<?php } ?> 
					<?php } ?> 
					</div>
					<div   class="price-option__purchase red">Add</div>
					</div>
					</a>
					<?php } ?> 
</div>
				 
				 <div class="clearfix"></div>
      </div>
</div>			 
   
<?php } ?>
