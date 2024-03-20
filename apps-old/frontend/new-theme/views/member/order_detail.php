<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
?>

     <style>
                .sml-header{ font-size:14px; margin-top:0px;margin-bottom:5px;font-weight:600;}
                .ordr-det p{ margin-bottom:5px;}
                span.pricecls { margin-left: 0px; font-weight:500;  margin-left:5px; }
                span.pricecls1 {width:100px;display:inline-block;  }
                .package-detail-ul { margin-left:0px; padding:0px;}
                .opts a {white-space:nowrap; line-height:30px;}
                a.cls-danger{ color:red; }
                a.cls-succes{ color:green; }
                .pricecls.failed { color:red; }
                .pricecls.terminate { color:red; }
                .pricecls.due { color:red; }
                .pricecls.trash { color:red; }
                .pricecls.pending { color:red; }
                .pricecls.refunded { color:green; }
                .pricecls.complete { color:green; }
                </style>
<div class="price-plan-payment">
    <div class="row">
        <div class="col-xs-12">
               
              <div class="box-header">
            <div class="row">
            <div class="col-sm-12">
                <div  style="font-size:25px; " ><?php echo $this->tag->getTag('order_details','Order Details');?> <a href="<?php echo Yii::App()->createUrl('member/orders');?>" style="line-height: 25px !important;display: inline !important;vertical-align: middle;font-size: 16px; margin-top: 17px;" class="pull-right"><?php echo $this->tag->getTag('back_to_orders','Back to Orders');?></a></div>
           
            </div>
           
          </div>
           <hr />
            <div class="clearfix"><!-- --></div>
        </div>
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <?php echo Yii::t('app',  $this->tag->getTag('from','From'));?>
            <address>
                <?php echo $order->htmlPaymentFrom;?>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <?php echo Yii::t('app', $this->tag->getTag('to','To') );?>
            <address>
                <?php echo $order->htmlPaymentTo;?>
            </address>
        </div>
        <div class="col-sm-4 invoice-col"></div>
    </div>

    <hr />
    
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="3"><?php echo Yii::t('orders', $this->tag->getTag('this_order_applies_for_the_"{p','This order applies for the "{planName}" package.'), array('{planName}' => $order->plan->package_name));?></th>
                    </tr>                                    
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $order->OrderStatusLi ;?></td>
                        <td><?php echo $order->OrderLi ;?></td>
                        <td><?php echo $order->PackageDetails ;?></td>
                    </tr>
               
                </tbody>
            </table>                            
        </div>
    </div>
    
    <hr />
    
    <div class="row no-print">
        <div class="col-xs-12">
            <p class="lead" style="margin-bottom: 0px;"><?php echo Yii::t('orders', $this->tag->getTag('notes','Notes'));?>:</p>
        </div>
        <div class="form-group col-lg-12"> 
            <div class="table-responsive">
            <?php 
            $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                'ajaxUrl'           => $this->createUrl($this->route, array('id' => (int)$order->order_id)),
                'id'                => $note->modelName.'-grid',
                'dataProvider'      => $note->search(),
                'filter'            => null,
                'filterPosition'    => 'body',
                'filterCssClass'    => 'grid-filter-cell',
                'itemsCssClass'     => 'table table-hover',
                   'emptyText' => $this->tag->getTag('no_results_found!','No results found.'),
                     'summaryText' => $this->tag->getTag('displaying_{start}-{end}_of_{c','Displaying {start}-{end} of {count} results.'),
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
                        'name'  => 'author',
                        'value' => '$data->getAuthor()',
                    ),
                    array(
                        'name'  => 'note',
                        'value' => '$data->note',
                    ),
                    array(
                        'name'  => 'date',
                        'value' => '$data->DateAddedShort',
                    ),
                ), $this),
            ), $this));  
            ?>    
            </div>
        </div>
    </div>
    
    <hr />
    
    <div class="row">
         <div class="col-xs-6">
            <p class="lead"><?php echo Yii::t('orders', $this->tag->getTag('','Amount'))?>:</p>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%"><?php echo Yii::t('orders', $order->getAttributeLabel('subtotal'))?>:</th>
                        <td><?php echo $order->formattedSubtotal;?></td>
                    </tr>
                    <tr>
                        <th><?php echo Yii::t('orders', $order->getAttributeLabel('tax_value'))?>:</th>
                        <td><?php echo $order->formattedTaxValue;?></td>
                    </tr>
                    <tr>
                        <th><?php echo Yii::t('orders', $order->getAttributeLabel('discount'))?>:</th>
                        <td><?php echo $order->formattedDiscount;?></td>
                    </tr>
                    <tr>
                        <th><?php echo Yii::t('orders', $order->getAttributeLabel('total'))?>:</th>
                        <td><?php echo $order->formattedTotal;?></td>
                    </tr>
                    <tr>
                        <th><?php echo Yii::t('orders', $order->getAttributeLabel('statusm') )?>:</th>
                        <td><?php echo $order->statusName;?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
 </div>
