<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.4
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('views_before_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
    /**
     * @since 1.3.9.2
     */
    $itemsCount = PricePlanPromoCode::model()->count();
    ?>
    <div class="box box-primary borderless">
        <div class="box-header">
    		<div class="pull-left">
                 <h3 class="box-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo  $pageHeading;?>
                </h3>
            </div>
    		<div class="pull-right">
                             <?php echo CHtml::link(Yii::t('app', 'Create'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create')));?>
                 <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
      
    		</div>
            <div class="clearfix"><!-- --></div>
    	</div>
        <div class="box-body">
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
            $hooks->doAction('views_before_grid', $collection = new CAttributeCollection(array(
                'controller'   => $this,
                'renderGrid'   => true,
            )));

            /**
             * This widget renders default getting started page for this particular section.
             * @since 1.3.9.2
             */
          
            
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $promoCode->modelName.'-grid',
                    'dataProvider'      => $promoCode->search(),
                    'filter'            => $promoCode,
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
                    'beforeAjaxUpdate'  => 'js:function(id, options){
                        window.dpStartSettings = $("#PricePlanPromoCode_date_start").data("datepicker").settings;
                        window.dpEndSettings = $("#PricePlanPromoCode_date_end").data("datepicker").settings;
                    }',
                    'afterAjaxUpdate'   => 'js:function(id, data) {
                        $("#PricePlanPromoCode_date_start").datepicker(window.dpStartSettings);
                        $("#PricePlanPromoCode_date_end").datepicker(window.dpEndSettings);
                        window.dpStartSettings = null;
                        window.dpEndSettings = null;
                    }',
                    'columns' => $hooks->applyFilters('grid_view_columns', array(
                        array(
                            'name'  => 'code',
                            'value' => '$data->code',
                            'filter' => CHtml::activeTextField($promoCode, 'code'),
                        ),
                       
                        array(
                            'name'  => 'discount',
                            'value' => '$data->formattedDiscount',
                            'filter' => CHtml::activeTextField($promoCode, 'discount'),
                        ),
                        array(
                            'name'  => 'total_amount',
                            'value' => '$data->formattedTotalAmount',
                            'filter' => CHtml::activeTextField($promoCode, 'total_amount'),
                        ),
                        array(
                            'name'  => 'assigned_to',
                            'value' => '@$data->AssignedOwner',
                            'filter'=>  CHtml::listData(User::model()->allAssigned(),'user_id','fullName') ,
                        ),
                        array(
                            'name'  => 'status',
                            'value' => '$data->statusName',
                            'filter'=> CHtml::activeDropDownList($promoCode, 'status',  array_merge(array('' => ''), $promoCode->getStatusesList())),
                        ),
                        array(
                            'name'  => 'date_start',
                            'value' => '$data->dateStart',
                            'filter'=> '<div class="input-group">
                              <span class="input-group-btn">'. CHtml::activeDropDownList($promoCode, 'pickerDateStartComparisonSign', $promoCode->getComparisonSignsList()) .'</span>
                              ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'     => $promoCode,
                                'attribute' => 'date_start',
                                'cssFile'   => null,
                                'language'  => $promoCode->getDatePickerLanguage(),
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => $promoCode->getDatePickerFormat(),
                                ),
                                'htmlOptions' => array('class' => ''),
                            ), true) . '</div>',
                        ),
                        array(
                            'name'  => 'date_end',
                            'value' => '$data->dateEnd',
                            'filter'=> '<div class="input-group">
                              <span class="input-group-btn">'. CHtml::activeDropDownList($promoCode, 'pickerDateEndComparisonSign', $promoCode->getComparisonSignsList()) .'</span>
                              ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'     => $promoCode,
                                    'attribute' => 'date_end',
                                    'cssFile'   => null,
                                    'language'  => $promoCode->getDatePickerLanguage(),
                                    'options'   => array(
                                        'showAnim'   => 'fold',
                                        'dateFormat' => $promoCode->getDatePickerFormat(),
                                    ),
                                    'htmlOptions' => array('class' => ''),
                                ), true) . '</div>',
                        ),
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $promoCode->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                        'label'     => ' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("promo_codes/update", array("id" => $data->promo_code_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                    'visible'   => 'AccessHelper::hasRouteAccess("promo_codes/update")',
                                ),
                                'delete' => array(
                                     'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp;',
                                    'url'       => 'Yii::app()->createUrl("promo_codes/delete", array("id" => $data->promo_code_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                    'visible'   => 'AccessHelper::hasRouteAccess("promo_codes/delete")',
                                ),    
                            ),
                            'headerHtmlOptions' => array('style' => 'text-align: right'),
                            'footerHtmlOptions' => array('align' => 'right'),
                            'htmlOptions'       => array('align' => 'right', 'class' => 'options'),
                            'template'          => '{update} {delete}'
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
            $hooks->doAction('views_after_grid', new CAttributeCollection(array(
                'controller'   => $this,
                'renderedGrid' => $collection->renderGrid,
            )));
            ?>
            </div>   
            <div class="clearfix"><!-- --></div> 
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
$hooks->doAction('views_after_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
