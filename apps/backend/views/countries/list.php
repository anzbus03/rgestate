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

$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) { 
	
	$form=$this->beginWidget('CActiveForm', array( 
			 'enableAjaxValidation'=>true,
			 ));  
	?>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t('hotel', 'Country List');?>
                </h3>
            </div>
            <div class="pull-right">
                    <?php echo CHtml::link(Yii::t('app', '<i class="fa fa-keyboard-o"></i> Arabic Bulk Update'), Yii::app()->createUrl('countries/index',array('bulk_update'=>'1','lan'=>'ar')), array('class' => 'btn btn-default btn-xs' , 'title' => Yii::t('app', 'Goole Translate Arabic')));?>
           
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array('countries/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('countries/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
				      
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body"><div id="google_translate_element" class="pull-right"></div>
            <div class="table-responsive">
            <?php 
            $hooks->doAction('before_grid_view', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'renderGrid'    => true,
            )));
            
            if ($collection->renderGrid) {
                ?>
                <table id="country-list" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('hotel', 'Country Name');?></th>
                            <th><?php echo Yii::t('hotel', 'Bulk Update');?></th>
                            <th><?php echo Yii::t('hotel', 'Country ID');?></th>
                            <th><?php echo Yii::t('hotel', 'Default Currency');?></th>
                            <th><?php echo Yii::t('hotel', 'Show on Listing');?></th>
                            <th><?php echo Yii::t('hotel', 'Priority');?></th>
                            <th><?php echo Yii::t('hotel', 'Options');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user->search()->data as $data) { ?>
                            <tr>
                                <td><?php echo $data->country_name; ?>&nbsp;<?php echo $data->getTranslateHtml("country_name"); ?></td>
                                <td>
                                    <input type="checkbox" class="select_all" checked="true" onchange="checkAllFunction(this, event)" />
                                    <?php echo Yii::t('app', 'Click to check / uncheck all'); ?>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-primary" title="<?php echo Yii::t('app', 'All Checked inputs with google translate values'); ?>" onclick="applyTanslation()" ><?php echo Yii::t('app', 'Apply Translation'); ?></a>
                                </td>
                                <td><?php echo $data->country_id; ?></td>
                                <td><?php echo $data->DefaultCurrencyTitle; ?></td>
                                <td><?php echo $data->show_on_listingHtml; ?></td>
                                <td>
                                    <?php echo CHtml::textField("priority[$data->country_id]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-control")); ?>
                                </td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/update')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl("countries/update", array("id" => $data->country_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl("countries/delete", array("id" => $data->country_id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="btn btn-sm btn-danger delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
            }
            $hooks->doAction('after_grid_view', new CAttributeCollection(array(
                'controller'    => $this,
                'renderedGrid'  => $collection->renderGrid,
            )));
            ?>
            <div class="clearfix"><!-- --></div>
            </div>    
        </div>
   
   	<div class="box-footer">
			<div class="pull-right m-4" >
			<button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update Priority');?></button>
			</div>
			<div class="clearfix"><!-- --></div>
			</div>
		
   
    </div>
	 <?php $this->endWidget(); ?>
<?php 
}
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
<script>
$(document).ready(function() {
    $('#country-list').DataTable({
        language: {
            paginate: {
                next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
            }
        }
    });
});

function ChangeListing(k){
	if($(k).is(':checked')){
		show_on_listing = 1;
	}
	else{
		show_on_listing = 0;
	}
	$.get('<?php echo Yii::app()->createUrl('countries/show_on_listing');?>/id/'+$(k).val()+'/show_on_listing/'+show_on_listing, function(data){
		var data = JSON.parse(data);
		if(data.status == '1'){
			alert(data.msg);
		}
	});
}
</script>
