<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
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
    ?>
    <div class="box box-primary" id="glance-box" data-source="<?php echo $this->createUrl('dashboard/glance');?>">
      
        <div class="box-body">
            <div class="clearfix"><!-- --></div>
     
          
           <div class="col-lg-2 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 data-bind="text: glance.subscribersCount"></h3>
                        <p><?php echo Yii::t('dashboard', 'Active for Sale');?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-image"></i>
                    </div> 
                    <a href="<?php echo Yii::app()->createUrl('place_property/index',array('PlaceAnAd[status]'=>'A','PlaceAnAd[section_id]'=>'1'));?>" class="small-box-footer">
                        <?php echo Yii::t('dashboard', 'More info');?> <i class="fa fa-exclamation-circle"></i>
                    </a>
                </div>
            </div>
            
            
            <div class="col-lg-2 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 data-bind="text: glance.deliveryServers"></h3>
                        <p><?php echo Yii::t('dashboard', 'Active for Rent');?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-image"></i>
                    </div>
                    <a href="<?php echo Yii::app()->createUrl('place_property/index',array('PlaceAnAd[status]'=>'A','PlaceAnAd[section_id]'=>'2'));?>" class="small-box-footer">
                        <?php echo Yii::t('dashboard', 'More info');?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
             <div class="col-lg-2 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 data-bind="text: glance.a_userCount"></h3>
                        <p><?php echo Yii::t('dashboard', 'Business for Sale');?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-briefcase"></i>
                    </div>
                    <a href="<?php echo Yii::app()->createUrl('place_property/index',array('PlaceAnAd[status]'=>'A','PlaceAnAd[section_id]'=>'6'));?>" class="small-box-footer">
                        <?php echo Yii::t('dashboard', 'More info');?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
                  
            <div class="col-lg-2 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3 data-bind="text: glance.customersCount"></h3>
                        <p><?php echo Yii::t('dashboard', 'New Projects');?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-building"></i>
                    </div>
                    <a href="<?php echo Yii::app()->createUrl('new_projects/index',array('NewDevelopment[status]'=>'A'));?>" class="small-box-footer">
                        <?php echo Yii::t('dashboard', 'More info');?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
           
                <div class="col-lg-2 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 data-bind="text: glance.listsCount"></h3>
                        <p><?php echo Yii::t('dashboard', 'Preleased');?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-image"></i>
                    </div>
                     <a href="<?php echo Yii::app()->createUrl('place_property/index',array('PlaceAnAd[status]'=>'A','PlaceAnAd[preleased]'=>'1'));?>" class="small-box-footer">
                        <?php echo Yii::t('dashboard', 'More info');?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 data-bind="text: glance.campaignsCount"></h3>
                        <p><?php echo Yii::t('dashboard', 'Enquiries');?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-contrast"></i>
                    </div>
                     <a href="<?php echo $this->createUrl('contact_us/index');?>" class="small-box-footer">
                        <?php echo Yii::t('dashboard', 'More info');?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
          
            <div class="clearfix"><!-- --></div>    
       <div class="clearfix"><!-- --></div>
        </div>
   
     </div>  
   
        <div class="clearfix"><!-- --></div>
        
        <div class="row">
        <?php // $this->renderPartial('_notification');?> 
        <div class="col-sm-6 hide d-none">
             <div class="box box-primary">
            <div class="box-header with-border" >
              

              <h3 class="box-title pull-left"  ><i class="fa fa-users"></i> Latest Agents </h3>
              <div class="pull-right"><a class="btn btn-success btn-sm" style="color:#fff" href="<?php echo Yii::app()->createUrl('login_history/index');?>">Login History</a> <a class="btn btn-primary btn-sm" href="<?php echo Yii::app()->createUrl('listingusers/visitors');?>">View Visitors</a></div>
              <div class="clearfix"></div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height:300px;overflow-y:scroll">
             <?php 
             echo $this->actionLatestCustomer();
		     ?>
            </div>
            <!-- /.box-body -->
          </div>
          
       </div> 
    
       <div class="col-sm-12">
           
           <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">Latest Ads </h3>
              <div class=" pull-right">
              <a class="btn btn-warning" style="color:#fff!important" href="<?php echo Yii::app()->createUrl('place_property/unpublished');?>">Unpublished Properties</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body"  style="height:300px;overflow-y:scroll">
              <?php $this->actionLatestAds(); ?>
            </div>
            <!-- /.box-body -->
          </div>
           
       </div>
       
       
        
         
        
        </div>
        
           <div class="clearfix"><!-- --></div>
         <div class="clearfix"><!-- --></div>
       
      
  
 <?php
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
?>
 <script>
	 function OpenAddTagOption(k,e){
		e.preventDefault();
		var url_d = $(k).attr('href') ;
		$('#myModal2').modal('show');
		$('#preview_body2').html('loading...');
	 	$.get(url_d,function(data){ if(data){ $('#preview_body2').html(data); } })
	 }
	 var lilink  ;
 function previewthis(k,e)
{
    
	e.preventDefault();lilink  = $(k) ;

	var url_d = $(k).attr('href') ;
	$('#myModal').modal('show');
	$('#preview_body').html('loading...');
	$.get(url_d,function(data){ if(data){ $('#preview_body').html(data); } })
}
function updateStatus(k)
{
	 
	var url_d = $(k).attr('data-url') ;
	var id =  $(k).attr('data-id')
	var shorts =  $(k).attr('data-short')
	var clas =  $(k).attr('class');
	 
	
	$.get(url_d,function(data){ var data = JSON.parse(data);  lilink.closest('td').html(data.html);alert("Succesfully Updated");$('#myModal').modal('hide');   })
} 
function  saveFormFunction_grid_update_new(form, data, hasError ,Url )
{ if(!hasError) { $.ajax({  "type":"POST",
									"url": Url,
                                    "data":form.serialize(),
                                    "success":function(data){
										if(data==1){ 
											alert('Successfuly updated');
											$('#myModal').modal('hide');
				  
										}
										else{
										    
										 	
											$('#messager').html('<div class="alert alert-warning"><strong>Warning!</strong>  '+data+'.</div>');
										}
                                     },

                                  });
     }
      else
    { 
		form.find("button.btn-submit").button("reset");
        alert('error');
     }
 }
 </script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel"> Approval</h4>

            </div>
            <div id="preview_body">
            
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel"> Update Tags</h4>

            </div>
            <div id="preview_body2">
            
            </div>
        </div>
    </div>
</div>
<style>
a.strike , a.covr { text-decoration: line-through; }

</style>
 <style>
     
     thead, tbody tr {
    
}ul.yiiPager {
    font-size: 11px;
    border: 0;
    margin: 0;
    padding: 0;
    line-height: 100%;
    display: inline-block;
    overflow: hidden;
    line-height: 1.5;
    vertical-align: middle;
}
.legendColorBox > div { display:none; }
     </style>
