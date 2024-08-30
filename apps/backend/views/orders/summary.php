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
         ?>
        <div class="box box-primary borderless">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                   
                    <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/summary'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body">
			
			
			<div class="row">

                        <!-- Area Chart -->
                        <div class="col-sm-12">
                            <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
				<div class="col-sm-4">
				    
              <h3 class="box-title">Order Summary</h3>
				</div>
				<div class="col-sm-8">
					<form method="get" autocomplete="off">
			<div class="row  " style="padding-top:10px;">
		
			<div class="col-sm-3">
			<label style="display:inline-block;width:40px;float:left;">From</label>
		 
                              <?php
                              
                               
                               echo '
                              ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'     => 'from_date',
                                'value'     => $from_date,
                                'cssFile'   => null,
                                'language'  => 'en',
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => 'dd-mm-yy',
                                ),
                                'htmlOptions' => array('class' => 'form-control' ,'placeholder'=>'From date','style'=>"width:calc(100% - 40px);float:left;"),
                            ), true)  ;?>
			
			 
			</div>
			
			<div class="col-sm-3">
			
		 	<label style="display:inline-block;width:25px;float:left;">To</label>
                              <?php
                              
                              
                               echo '
                              ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'     => 'to_date',
                                'value'     => $to_date,
                                'cssFile'   => null,
                                'language'  => 'en',
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => 'dd-mm-yy',
                                ),
                                'htmlOptions' => array('class' => 'form-control' ,'placeholder'=>'To date' ,'style'=>"width:calc(100% - 25px);float:left;"),
                            ), true)  ;?>
			
		 
			</div> 
			<div class="col-sm-2"><button class="btn btn-primary" type="submit">Submit</button></div>
		 
			 <div class="clearfix"></div>
		 </div></form>
	
				</div>
           
              <!-- tools box -->
            
              <!-- /. tools -->
            </div>
            <div class="box-body">
            		<div class="row">
					<div class="col-sm-12">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo (int) @$orderStatisticsdatewise['total_payment'];?></h3>

              <p>Topup Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
           <a href="<?php echo Yii::app()->createUrl('orders/index',array('PricePlanOrder[status]'=>'complete','PricePlanOrder[from_date]'=>$from_date,'PricePlanOrder[to_date]'=>$to_date));?>" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo  (int) @$orderStatisticsdatewise['discount'];?></h3>

              <p>Discount Allowed</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
              <a href="<?php echo Yii::app()->createUrl('orders/index',array('PricePlanOrder[status]'=>'complete','PricePlanOrder[d_allowed]'=>'1','PricePlanOrder[from_date]'=>$from_date,'PricePlanOrder[to_date]'=>$to_date));?>" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
       
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo  (int) @$orderStatisticsdatewise['tax_value'];?></h3>

              <p>Tax Payable</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
               <a href="<?php echo Yii::app()->createUrl('orders/index',array('PricePlanOrder[status]'=>'complete','PricePlanOrder[t_allowed]'=>'1','PricePlanOrder[from_date]'=>$from_date,'PricePlanOrder[to_date]'=>$to_date));?>" target="_blank" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
       
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo @$orderStatisticsdatewise['total_payment']-@$orderStatisticsdatewise['discount']-@$orderStatisticsdatewise['tax_value'] ;?></h3>

              <p>Total Income</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">&nbsp;</a>
          </div>
        </div>
        <!-- ./col -->
        </div>
      </div>
      
            
            </div>
            
          
          </div>
                        </div>

                  </div>
			
		
      <div class="row">
		  <div class="col-sm-12">
				<?php $this->renderPartial('_graphical_represenaion');  ?> 
		  </div>
      </div>
      
      
      
      
              </div>
               </div>
        <!-- modals -->
         <?php 
        
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
 
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

