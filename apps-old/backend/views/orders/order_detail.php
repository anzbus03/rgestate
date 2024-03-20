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


<div class="price-plan-payment">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-credit-card"></i> <?php echo $pricePlan->package_name;?>
                <small class="pull-right">
                    <?php echo $order->getAttributeLabel('order_uid');?> <b><?php echo $order->uid;?></b>, 
                    <?php echo $order->getAttributeLabel('date_added')?>: <?php echo $order->dateAdded;?>
                </small>
            </h2>                            
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <?php echo Yii::t('app', 'From');?>
            <address>
                <?php echo $order->htmlPaymentFrom;?>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <?php echo Yii::t('app', 'To');?>
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
                        <th><?php echo Yii::t('orders', 'Top Up - Account' );?></th>
                    </tr>                                    
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $pricePlan->description;?></td>
                    </tr>
                </tbody>
            </table>                            
        </div>
    </div>
 
    <hr />
    
    <div class="row no-print">
        <div class="col-xs-12">
            <p class="lead" style="margin-bottom: 0px;"><?php echo Yii::t('orders', 'Notes');?>:</p>
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
                        'name'  => 'author',
                        'value' => '$data->getAuthor()',
                    ),
                    array(
                        'name'  => 'note',
                        'value' => '$data->note',
                    ),
                    array(
                        'name'  => 'date_added',
                        'value' => '$data->dateAdded',
                    ),
                ), $this),
            ), $this));  
            ?>    
            </div>
        </div>
    </div>

    <hr />
    
    <div class="row">
        <div class="col-xs-6 no-print">
            <div class="table-responsive">
             
            </div>
        </div>
        <div class="col-xs-6">
            <p class="lead"><?php echo Yii::t('orders', 'Amount')?>:</p>
            <div class="table-responsive">
                <table class="table">
                  
                     <tr>
                        <th><?php echo Yii::t('orders', 'Sub Total')?>:</th>
                        <td><?php echo $order->formattedTotal;?></td>
                    </tr>
                    <?php
                    if(!empty($order->tax_id)) { ?> 
                         <tr>
                        <th><?php echo Yii::t('orders', $order->tax->name);?>:</th>
                        <td><?php echo $order->formattedTaxValue;?></td>
                    </tr>
                    <?php } ?> 
                    <tr>
                        <th><?php echo Yii::t('orders', 'Discount')?>:</th>
                        <td><?php echo $order->formattedDiscount;?></td>
                    </tr>
                   
                    <tr>
                        <th><?php echo Yii::t('orders', 'Paid Amount')?>:</th>
                        <td><?php echo $order->formattedTotalPaid;?></td>
                    </tr>
                    <tr>
                    <tr>
                        <th><?php echo Yii::t('orders', 'Topup Amount')?>:</th>
                        <td><?php echo $order->formattedTotalTopup;?></td>
                    </tr>
                    <tr>
                        <th><?php echo Yii::t('orders', 'Status')?>:</th>
                        <td><?php echo $order->statusName;?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <hr />
    
    <div class="row no-print">
        <div class="col-xs-12">
            <div class="pull-right">
                <button class="btn btn-success btn-flat" onclick="window.print();"><i class="fa fa-print"></i> <?php echo Yii::t('app', 'Print');?></button>
                <a href="<?php echo $this->createUrl('orders/email_invoice', array('id' => $order->order_id));?>" class="btn btn-success btn-flat"><i class="fa fa-envelope"></i> <?php echo Yii::t('orders', 'Email invoice');?></a>
                <a target="_blank" href="<?php echo $this->createUrl('orders/pdf', array('id' => $order->order_id));?>" class="btn btn-success btn-flat"><i class="fa fa-clipboard"></i> <?php echo Yii::t('orders', 'View invoice');?></a>
                <a href="<?php echo $this->createUrl('orders/update', array('id' => $order->order_id));?>" class="btn btn-primary btn-flat"><?php echo     Yii::t('orders', 'Update this order');?></a>
                <a href="<?php echo $this->createUrl('orders/index');?>" class="btn btn-primary btn-flat"><?php echo     Yii::t('orders', 'Back to orders');?></a>    
            </div>
        </div>
    </div>
</div>
