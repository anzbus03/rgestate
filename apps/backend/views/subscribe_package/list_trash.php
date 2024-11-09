<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.3.1
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
     * @since 1.3.9.2
     */
    $itemsCount = PricePlanOrder::model()->count();
    ?>
    <div class="box box-primary borderless">
        <div class="card-header">
             <div class="pull-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo  $pageHeading;?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/trash'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
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

            /**
             * This widget renders default getting started page for this particular section.
             * @since 1.3.9.2
             */
         $form=$this->beginWidget('CActiveForm', array( 
			 'enableAjaxValidation'=>true,
			 ));  
			 
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $order->modelName.'-grid',
                    'dataProvider'      => $order->search(),
                    'filter'            => $order,
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
                            'name'  => 'date_added',
                            'value' => '$data->DateAdded2',
                            'filter'=> false,
                        ),
                        array(
                            'name'  => 'validity',
                            'value' => '$data->Validity_in_days',
                              'filter'=>CHtml::activeTextField($order, 'validity').CHtml::activeHiddenField($order, 'from_date').CHtml::activeHiddenField($order, 'to_date'),
                           
                         
                        ), 
                        array(
                            'name'  => 'user_id',
                            'value' => '$data->user->getFullName()',
                            'type'  => 'raw',
                        ),
                        array(
                            'name'  => 'category_id',
                            'value' => '$data->package->CTitle',
                            'type'  => 'raw',
                            'filter'=>Package::model()->castegoryPackage()
                        ),
                       
                        array(
                            'name'  => 'package_id',
                            'value' => '$data->package->packageTitle2',
                            'type'  => 'raw',
                        ),
                       
                        array(
                            'name'  => 'ends_on',
                            'value' => '$data->EndsOnHtml',
                            'type'  => 'raw',
                            'filter'=>false
                        ),
                       
                            array(
                            'name'  => 'deleted_by',
                            'value' => '$data->deletedby->fullName',
                            'filter'=> false,
                        ),
                           array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $order->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                               'restore' => array(
                                    'label'     => ' &nbsp; Restore &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("subscribe_package/restore", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'View'), 'class' => '','onclick'=>'restoreItem(this,event)'),
                                     'visible'   => 'AccessHelper::hasRouteAccess("subscribe_package/restore")',
                                   
                                ),
                                'update' => array(
                                     'label'     => ' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("subscribe_package/update", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
									'visible'   => 'AccessHelper::hasRouteAccess("subscribe_package/update")',
                                ),
                                'delete' => array(
                                     'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp;',  
                                    'url'       => 'Yii::app()->createUrl("subscribe_package/delete_permanent", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                     'visible'   => 'AccessHelper::hasRouteAccess("subscribe_package/delete_permanent")',
                                ),    
                            ),
                            'headerHtmlOptions' => array('style' => 'text-align: right'),
                            'footerHtmlOptions' => array('align' => 'right'),
                            'htmlOptions'       => array('align' => 'right', 'class' => 'options'),
                            'template'          => ' {restore} {update} {delete}'
                        ),
                  
               
                  
                    ), $this),
                ), $this));  
            }
           $this->endWidget();  
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
    </div>
     <script>
    function restoreItem(k,e){
		e.preventDefault(); 
		var href = $(k).attr('href'); 
		var conf = confirm('Are you sure to Restore this item?');
		if(conf){
			
			$.get(href,function(data){  $.fn.yiiGridView.update("<?php echo $order->modelName.'-grid';?>"); })
			
			}
		 
	}
    </script>
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
