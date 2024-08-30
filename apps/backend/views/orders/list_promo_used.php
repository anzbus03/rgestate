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
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/promo_usage'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
             	<form method="get" autocomplete="off">
			<div class="row">
		
			<div class="col-sm-2">
			
		 
                              <?php
                              
                              
                               echo '<label style="margin-right:5px;">From Date</label><br />
                              ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'     => 'from_date',
                                'value'     => !empty($order->from_date) ? date('d-m-Y',strtotime($order->from_date)) : '',
                                'cssFile'   => null,
                                'language'  => 'en',
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => 'dd-mm-yy',
                                ),
                                'htmlOptions' => array('class' => 'form-control','onchange'=>'assignthival2(this)'),
                            ), true)  ;?>
			
			 
			</div>
			
			<div class="col-sm-2">
			
		 
                              <?php
                              
                              
                               echo '<label style="margin-right:5px;">To Date</label><br />
                              ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'     => 'to_date',
                                'value'     => !empty($order->to_date) ? date('d-m-Y',strtotime($order->to_date)) : '',
                                'cssFile'   => null,
                                'language'  => 'en',
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => 'dd-mm-yy',
                                ),
                                'htmlOptions' => array('class' => 'form-control','onchange'=>'assignthival(this)'),
                            ), true)  ;?>
			
		 
			</div> 
			<script>
			    function assignthival(k){
			     $('#PricePlanOrder_to_date').val($(k).val()).change();
			    }
			    function assignthival2(k){
			     $('#PricePlanOrder_from_date').val($(k).val()).change();
			    }
			       function assignthival3(k){
			     $('#PricePlanOrder_created_by').val($(k).val()).change();
			    }
			</script>
				<?php
			if(Yii::app()->user->getModel()->removable=='no'){ 
            $criteria=new CDbCriteria;
            $criteria->compare('t.group_id', User::SALES_TEAM);
            $sales_team = User::model()->findAll($criteria);
			
			?> 
			
			<div class="col-sm-2">
			<label>Used by Sales Team  </label><br />
			<?php echo CHtml::dropdownList('created_By',$order->created_by,CHtml::listData($sales_team,'user_id','fullName'),array('class'=>'form-control','onchange'=>'assignthival3(this)','empty'=>'Please select'));?>
			
			</div>
			<?php } ?> 
		 </div></form>
	
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
                    'ajaxUpdate'        =>false,
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
                            'name'  => 'order_uid',
                            'value' => 'CHtml::link($data->uid, array("orders/update", "id" => $data->order_id), array("fallbackText" => true))',
                            'type'  => 'raw',
                        ),
                       
                       
                         array(
                            'name'  => 'customer_id',
                            'value' => 'CHtml::link($data->customer->getFullName(), array("listingusers/update", "id" => $data->customer_id), array("fallbackText" => true))',
                            'type'  => 'raw',
                        ),
                          array(
                            'name'  => 'promo_code_id',
                            'value' => '!empty($data->promo_code_id) ? $data->promoCode->code  : "-"',
                            'type'  => 'raw',
                        ),
                         array(
                            'name'  => 'total1',
                            'value' => '$data->formattedTotal',
                               'filter'=>CHtml::activeTextField($order, 'total').
                                     
                                      CHtml::activeHiddenField($order, 'from_date' ).
                                       CHtml::activeHiddenField($order, 'to_date' ).
                                       CHtml::activeHiddenField($order, 't_allowed' ).
                                       CHtml::activeHiddenField($order, 'd_allowed' ).
                                        CHtml::activeHiddenField($order, 'created_by' )
                                     ,
                        ),
                        array(
                            'name'  => 'discount',
                            'value' => '$data->formattedDiscount',
                               'filter'=> false, 
                        ),
                        array(
                            'name'  => 'status',
                            'value' => '$data->getStatusName()',
                            'filter'=> $order->getStatusesList(),
                        ),
                        array(
                            'name'  => 'payment_type',
                            'value' => '$data->getPaymentName()',
                            'filter'=> $order->paymentArray(),
                        ),
                        array(
                            'name'  => 'date_added',
                            'value' => '$data->DateAdded2',
                            'filter'=> false,
                        ),
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $order->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'view' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-eye"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("orders/view", array("id" => $data->order_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'View'), 'class' => ''),
                                     'visible'   => 'AccessHelper::hasRouteAccess("orders/view")',
                                   
                                ),
                                'update' => array(
                                     'label'     => ' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("orders/update", array("id" => $data->order_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                     'visible'   => 'AccessHelper::hasRouteAccess("orders/update")',
                               
                                ),
                                'delete' => array(
                                     'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp;',  
                                    'url'       => 'Yii::app()->createUrl("orders/delete", array("id" => $data->order_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                     'visible'   => 'AccessHelper::hasRouteAccess("orders/delete")',
                                    
                                ),    
                            ),
                            'headerHtmlOptions' => array('style' => 'text-align: right'),
                            'footerHtmlOptions' => array('align' => 'right'),
                            'htmlOptions'       => array('align' => 'right', 'class' => 'options'),
                            'template'          => '{view} {update} '
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
