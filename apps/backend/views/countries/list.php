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
	
	$form=$this->beginWidget('CActiveForm', array( 
			 'enableAjaxValidation'=>true,
			 ));  
	?>
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
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
            /**
             * This hook gives a chance to prepend content or to replace the default grid view content with a custom content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderGrid} to false 
             * in order to stop rendering the default content.
             * @since 1.3.3.1
             */
            $hooks->doAction('before_grid_view', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'renderGrid'    => true,
            )));
            
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $user->modelName.'-grid',
                    'dataProvider'      => $user->search(),
                    'filter'            => $user,
                    'filterPosition'    => 'body',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered table-hover table-striped',
                    'selectableRows'    => 0,
                    'enableSorting'     => false,
                    'cssFile'           => false,
                    'pagerCssClass'     => 'pagination pull-right',
                    'pager'             => array(
                        'class'         => 'CLinkPager',
                        'cssFile'       => false,
                        'header'        => false,
                        'htmlOptions'   => array('class' => 'pagination')
                    ),
                    'columns' => $hooks->applyFilters('grid_view_columns', array(
                       array(
                            'name'  => 'country_name',
                            'value' => '"<span>".$data->country_name."</span>&nbsp;".$data->getTranslateHtml("country_name")',
                            'type'=>'raw'
                             
                        ),
						array(
						'name'=>'bulk_update',
						'type'=>'raw',
						'filter'=> '<input type="checkbox" class="select_all" checked="true"  onchange="checkAllFunction(this,event)" /> Click to check / uncheck all <a href="javascript:void(0)" class="btn btn-xs btn-primary" title="All Checked inputs with google translate values" onclick="applyTanslation()" >Apply Translation</a> ' ,
						'value'=>'$data->BulkUpdateText',
						'htmlOptions'=>array("style"=>"width:250px;text-align:center","class"=>"form-controll"),
						  'visible' => $user->BulkcanVisibleBulk
						),
                    
                             array(
                            'name'  => 'country_id',
                            'value' => '$data->country_id',
                             
                        ),
                        array(
                            'name'  => 'default_currency',
                            'value' => '$data->DefaultCurrencyTitle',
                            'filter' => false , 
                             
                        ),
                      
                        array(
                            'name'  => 'show_on_listing',
                            'value' => '$data->show_on_listingHtml',
                            'type' => 'raw',
                                 'filter' => false , 
                        ),
                        
						array(
						'name'=>'priority',
						'type'=>'raw',
						'filter'=>false,
						'value'=>'CHtml::textField("priority[$data->country_id]",$data->priority,array("style"=>"width:50px;text-align:center","class"=>"form-controll"))',
						'htmlOptions'=>array("style"=>"width:50px;text-align:center","class"=>"form-controll"),
						),
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $user->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("countries/update", array("id" => $data->country_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                    'visible'   => 'AccessHelper::hasRouteAccess("'.Yii::app()->controller->id.'/update")',
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-remove-circle"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("countries/delete", array("id" => $data->country_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                    'visible'   => 'AccessHelper::hasRouteAccess("'.Yii::app()->controller->id.'/delete")',
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:70px;',
                            ),
                            'template' => '{update} {delete}'
                        ),
                    ), $this),
                ), $this)); 
            }
            /**
             * This hook gives a chance to append content after the grid view content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * @since 1.3.3.1
             */
            $hooks->doAction('after_grid_view', new CAttributeCollection(array(
                'controller'    => $this,
                'renderedGrid'  => $collection->renderGrid,
            )));
            ?>
            <div class="clearfix"><!-- --></div>
            </div>    
        </div>
   
   	<div class="box-footer">
			<div class="pull-right">
			<button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update Priority');?></button>
			</div>
			<div class="clearfix"><!-- --></div>
			</div>
		
   
    </div>
	 <?php $this->endWidget(); ?>
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
function ChangeListing(k){
	if($(k).is(':checked')){
		show_on_listing = 1;
	}
	else{
		show_on_listing =0;
	}
	$.get('<?php echo Yii::app()->createUrl('countries/show_on_listing');?>/id/'+$(k).val()+'/show_on_listing/'+show_on_listing,function(data){
		var data = JSON.parse(data);
		if(data.status=='1'){
			alert(data.msg);
		}
		
		 })
}

</script>
