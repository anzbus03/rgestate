<?php defined('MW_PATH') || exit('No direct script access allowed');

 
?>

<?php defined('MW_PATH') || exit('No direct script access allowed');  ?>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                       
                   
<div class="price-plan-payment">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="page-header">
                <i class="fa fa-credit-card"></i> Invoice
                <small class="float-right">
                    <?php echo $order->getAttributeLabel('id');?> <b><?php echo $order->id;?></b>, 
                    <?php echo $order->getAttributeLabel('date_added')?>: <?php echo $order->dateAdded;?>
                </small>
            </h2>                            
        </div>
    </div>

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <?php echo Yii::t('app', 'From');?>
            <address>
               <b><?php echo Yii::App()->options->get('system.free_bites.site_name');?></b>
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
                        <th><?php echo Yii::t('orders', 'This payments  applies for the commission period  "{planName}"  .', array('{planName}' => $order->GeneratedPeriod2));?></th>
                    </tr>                                    
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo nl2br($order->description);?></td>
                    </tr>
                </tbody>
            </table>                            
        </div>
    </div>
 
    <hr />
      <div class="col-xs-6">
            <p class="lead"><?php echo Yii::t('orders', 'Amount')?>:</p>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%"><?php echo Yii::t('amount', 'Total Commission released')?>:</th>
                        <td><?php echo $order->getformattedTotal($order->amount);?></td>
                    </tr>
                    <tr>
                        <th style="width:50%"><?php echo Yii::t('amount', 'Invoice Sttaus')?>:</th>
                        <td><?php echo  $order->StatusesTitle ;?></td>
                    </tr>
                
                </table>
            </div>
        </div>
   
    <div class="clearfix"></div>
    
    <hr />
 
 
    <div class="row no-print">
        <div class="col-xs-12">
            <div class="pull-right">
                <button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> <?php echo Yii::t('app', 'Print');?></button>
                <a href="<?php echo $this->createUrl('member/invoices');?>" class="btn btn-primary"><?php echo Yii::t('orders', 'Back to invoices');?></a>    
            </div>
        </div>
    </div>
</div>

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>
     
      </div> 
                

 
