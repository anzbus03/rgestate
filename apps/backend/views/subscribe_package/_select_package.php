<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
    /**
     * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
     * in order to stop rendering the default content.
     * @since 1.3.3.1
     */
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm'); ?>
        <style>
        .margin-bottom-25 { margin-bottom: 25px; }
        </style>
        <div class="box box-primary  ">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$order->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/'.$index), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body">
				
				   <?php 
$video_packages = Package::model()->findFromCategoryID(2);
 
if(!empty($video_packages)){ ?> 
<div class="row margin-bottom-15 margin-top-60 first-marg">
	  <div class="col-sm-12">
				
		        <div class="pageHeading   margin-bottom-25">
					<div class="desc-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/film.png');?>" alt="Video Package / Per Ad"  ></div>
					<div class="desc-det">
					   <div class="mm-d-h">Video Package / Per Ad</div>
					   <div class="small-desc  margin-top-0">Advertiser will be able to upload Property Video. Video will be uploaded Per Property Ad</div>
					</div>
					 <div class="clearfix"></div>
					</div>
		     	 <div class="clearfix"></div>
				 
				 <div class="pricing row">
					 <?php
					 foreach($video_packages as $k=>$v){ ?> 
						 <a  href="<?php echo Yii::app()->createUrl('subscribe_package/create',array('package_id'=>$v->primaryKey));?>" >
					<div class="[ price-option price-option--low  col-sm-3 <?php echo $v->active_package == $v->primaryKey ? 'active' : '' ;?> ]">
					<div class="price-option__detail">
					<span class="price-option__cost">Rs.<?php echo number_format($v->price_per_month,0,'.',',');?></span>
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
					<div  class="price-option__purchase">Add</div>
					</div>
					</a>
					<?php } ?> 
 


</div>
				 
				 <div class="clearfix"></div>
      </div>
</div>			 
<?php } ?>

<hr />
<?php 
$featured_packages = Package::model()->findFromCategoryID(3);
if(!empty($featured_packages)){ ?>     
<div class="row margin-bottom-15  margin-top-60">
	  <div class="col-sm-12">
				
		        <div class="pageHeading   margin-bottom-25">
					<div class="desc-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/star.png');?>" alt="Featured Ads"  ></div>
					<div class="desc-det">
					   <div class="mm-d-h">Featured Ads</div>
					   <div class="small-desc  margin-top-0">Quick way to get leads and show your Ad on top listing. Your ad will be highlighted. </div>
					</div>
					 <div class="clearfix"></div>
					</div>
		     	 <div class="clearfix"></div>
				 <div class="clearfix"></div>
				 
				 <div class="pricing row">
		
		 <?php
					 foreach($featured_packages as $k=>$v){ ?>
						 		 <a href="<?php echo Yii::app()->createUrl('subscribe_package/create',array('package_id'=>$v->primaryKey));?>" >
				
					<div class="[ price-option price-option--low  col-sm-3 <?php echo $v->active_package == $v->primaryKey ? 'active' : '' ;?> ]">
					<div class="price-option__detail">
					<span class="price-option__cost">Rs.<?php echo number_format($v->price_per_month,0,'.',',');?></span>
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
					<div   class="price-option__purchase green">Add</div>
					</div>
					</a>
					<?php } ?> 
 
 </div>
				 
				 <div class="clearfix"></div>
      </div>
</div>			 
<?php } ?>    
<hr />


           <div class="clearfix"></div>
           
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
							  <a    >
							 <?
						 }else{?>
						  <a  href="<?php echo Yii::app()->createUrl('subscribe_package/create',array('package_id'=>$v->primaryKey));?>" >
						<?php }  ?> 
					<div class="[ price-option price-option--low  col-sm-3 <?php echo $v->active_package == $v->primaryKey ? 'active' : '' ;?> ]">
					<div class="price-option__detail">
					<span class="price-option__cost">Rs.<?php echo number_format($v->price_per_month,0,'.',',');?></span>
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
				 
				 <div class="clearfix"></div>
				 <hr />
				 <?php 
$featured_packages = Package::model()->findFromCategoryID(5);
if(!empty($featured_packages)){ ?>     
<div class="row margin-bottom-15  margin-top-60">
	  <div class="col-sm-12">
				
		        <div class="pageHeading   margin-bottom-25">
					<div class="desc-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/sticker.png');?>" alt="Featured Ads"  ></div>
					<div class="desc-det">
					   <div class="mm-d-h">Owners Exclusive Properties</div>
					   <div class="small-desc  margin-top-0">Quick way to get leads and show your Ad on top listing. Your ad will be highlighted. </div>
					</div>
					 <div class="clearfix"></div>
					</div>
		     	 <div class="clearfix"></div>
				 <div class="clearfix"></div>
				 
				 <div class="pricing row">
		
		 <?php
					 foreach($featured_packages as $k=>$v){ ?>
						 		 <a href="<?php echo Yii::app()->createUrl('subscribe_package/create',array('package_id'=>$v->primaryKey));?>" >
				
					<div class="[ price-option price-option--low  col-sm-3 <?php echo $v->active_package == $v->primaryKey ? 'active' : '' ;?> ]">
					<div class="price-option__detail">
					<span class="price-option__cost">Rs.<?php echo number_format($v->price_per_month,0,'.',',');?></span>
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
					<div   class="price-option__purchase yellow">Add</div>
					</div>
					</a>
					<?php } ?> 
 
 </div>
				 
				 <div class="clearfix"></div>
      </div>
</div>			 
<?php } ?>    


<hr />
<?php 
$featured_packages = Package::model()->findFromCategoryID(4);
if(!empty($featured_packages)){ ?>     
<div class="row margin-bottom-15  margin-top-60">
	  <div class="col-sm-12">
				
		        <div class="pageHeading   margin-bottom-25">
					<div class="desc-img"><img src="<?php echo Yii::app()->apps->getBaseUrl('assets/img/exchange.png');?>" alt="Featured Ads"  ></div>
					<div class="desc-det">
					   <div class="mm-d-h">Refresh Quota</div>
					   <div class="small-desc  margin-top-0">Quick way to get leads and show your Ad on top listing.   </div>
					</div>
					 <div class="clearfix"></div>
					</div>
		     	 <div class="clearfix"></div>
				 <div class="clearfix"></div>
				 
				 <div class="pricing row">
		
		 <?php
					 foreach($featured_packages as $k=>$v){ ?>
						 		 <a href="<?php echo Yii::app()->createUrl('subscribe_package/create',array('package_id'=>$v->primaryKey));?>" >
				
					<div class="[ price-option price-option--low  col-sm-3 <?php echo $v->active_package == $v->primaryKey ? 'active' : '' ;?> ]">
					<div class="price-option__detail">
					<span class="price-option__cost">Rs.<?php echo number_format($v->price_per_month,0,'.',',');?></span>
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
					<div   class="price-option__purchase blue1">Add</div>
					</div>
					</a>
					<?php } ?> 
 
 </div>
				 
				 <div class="clearfix"></div>
      </div>
</div>			 
<?php } ?>    

				 <div class="clearfix"></div>
      </div>
</div>			 
   
<?php } ?>

           
           <div class="clearfix"></div>
            </div>
           
         
         </div>
        <!-- modals -->
   

      
      
      
      
      
         <?php 
        $this->endWidget(); 
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));
}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
