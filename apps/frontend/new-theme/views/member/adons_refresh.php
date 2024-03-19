<?php 
$video_packages = Package::model()->findFromCategoryID(4);
 
if(!empty($video_packages)){ ?> 
<div class="row margin-bottom-15 margin-top-60 first-marg">
	  <div class="col-sm-12">
				
		        <div class="pageHeading   margin-bottom-25">
					<div class="desc-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/exchange.png');?>" alt="Video Package / Per Ad"  ></div>
					<div class="desc-det">
					   <div class="mm-d-h">Refresh Quota</div>
					   <div class="small-desc  margin-top-0">Quick way to get leads and show your Ad on top listing. </div>
					</div>
					 <div class="clearfix"></div>
					</div>
		     	 <div class="clearfix"></div>
				 
				 <div class="pricing row">
					 <?php
					 foreach($video_packages as $k=>$v){ ?> 
						 <a href="javascript:void(0)" onclick="processaddon(this)" data-href="<?php echo Yii::app()->createUrl('member/add_package',array('id'=>$v->primaryKey));?>" >
					<div class="[ price-option price-option--low  col-sm-3 <?php echo $v->active_package == $v->primaryKey ? 'active' : '' ;?> ]">
					<div class="price-option__detail">
					<span class="price-option__cost"><?php echo CURRENCY_CODE;  echo number_format($v->price_per_month,0,'.',',');?></span>
					<span class="price-option__type"><?php echo $v->package_name;?></span>
					<?php
					if(!empty($v->validity_in_days)){ 
						
						if(!empty($v->active_package)){
							?>
								<span class="price-option__type validity text-green"><?php echo ($v->validity_in_days - $v->date_diff);?> days remaining</span>
						
						
							<?
						}
						else{
						?>
						<span class="price-option__type validity">Validitiy <?php echo $v->validity_in_days;?> days</span>
						<?php } ?> 
					<?php } ?> 
					</div>
					<div  class="price-option__purchase blue1">Add</div>
					</div>
					</a>
					<?php } ?> 
 


</div>
				 
				 <div class="clearfix"></div>
      </div>
</div>			 
<?php } ?>
