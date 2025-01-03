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
if ($viewCollection->renderContent) { ?>
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('dashboard/my_statistics'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            		<form method="get" autocomplete="off" class="hide">
			<div class="row">
		
			<div class="col-sm-2">
			
		 
                              <?php
                              
                              
                               echo '<label style="margin-right:5px;">From Date</label><br />
                              ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'     => 'from_date',
                                'value'     => !empty($from_date) ? date('d-m-Y',strtotime($from_date)) : '',
                                'cssFile'   => null,
                                'language'  => 'en',
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => 'dd-mm-yy',
                                ),
                                'htmlOptions' => array('class' => 'form-control'),
                            ), true)  ;?>
			
			 
			</div>
			
			<div class="col-sm-2">
			
		 
                              <?php
                              
                              
                               echo '<label style="margin-right:5px;">To Date</label><br />
                              ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'     => 'to_date',
                                'value'     => !empty($to_date) ? date('d-m-Y',strtotime($to_date)) : '',
                                'cssFile'   => null,
                                'language'  => 'en',
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => 'dd-mm-yy',
                                ),
                                'htmlOptions' => array('class' => 'form-control'),
                            ), true)  ;?>
			
		 
			</div>
			<?php
			if(Yii::app()->user->getModel()->removable=='no'){ ?> 
			
			<div class="col-sm-2">
			<label>Select User</label><br />
			<?php echo CHtml::dropdownList('user_id',$user_id,CHtml::listData($sales_team,'user_id','fullName'),array('class'=>'form-control','empty'=>'Please select'));?>
			
			</div>
			<?php } ?> 
			<div class="col-sm-2"><label>&nbsp;</label><br /><button class="btn   btn-primary" type="submit">Search</button></div>
			
		 </div></form>
			<hr />
			
			<?php
			$this->renderPartial('statics_content');?>
            <?php
            	if(!empty($user_id)){
			    ?>
			       <div class="row">
  
        <div class="col-sm-6">
             <div class="card">
            <div class="box-header with-border" >
              

              <h3 class="box-title pull-left"  ><i class="fa fa-users"></i> Own Customers </h3>
              <div class="clearfix"></div>
             
            </div>
            <!-- /.box-header -->
            <div class="card-body" style="height:300px;overflow-y:scroll">
             <?php 
             echo $this->actionLatestCustomerByManager($user_id);
		     ?>
            </div>
            <!-- /.box-body -->
          </div>
          
       </div> 
       
       <div class="col-sm-6">
           
           <div class="card">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="card-title">Latest Uploaded properties by  agents</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body"  style="height:300px;overflow-y:scroll">
              <?php $this->actionLatestAdsByManager($user_id); ?>
            </div>
            <!-- /.box-body -->
          </div>
           
       </div>
       
       
        
         
        
        </div>
        
			    <?
			}
		
            ?>
		
			
			
			
			
			
			
			
			<div class="clearfix"></div>
			
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
?> 
