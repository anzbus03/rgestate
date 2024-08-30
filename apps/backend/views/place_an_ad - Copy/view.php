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
                <h3 class="card-title"">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t('hotel_booking', 'View Ad Details');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array('hotel_booking/search'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('hotel_booking/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
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
            
            // and render if allowed
            ?>
             <table class="tg2" style="width:98.4%;">
				<tbody>
					<tr><th  colspan="100%">Ad Details</th></tr>
					<tr><td style="width:25%"><b>Ad title</b></td><td colspan="3"><?php echo $model->ad_title ?></td></tr>
					<tr><td style="width:25%"><b>Section</b></td><td style="width:25%"><?php echo $model->section->section_name ?></td><td style="width:25%"><b>Category</b></td><td style="width:25%"><?php echo $model->category->category_name; ?></td></tr>
					<tr><td style="width:25%"><b>price</b></td><td style="width:25%"><?php echo $model->price ?>  </td><td style="width:25%"><b>Added Date</b></td><td style="width:25%"><?php echo date('D d F Y g:i a', strtotime($model->added_date))  ?></td></tr>
				 </tbody>
				 </table>
				 
				     <?php
				     /*
				     if($booking->subcategory)
				     {
				     foreach($booking->subcategory as $k=>$v)
						  {
							  ?>
							  <tr><td><?php echo @$v->rooms->roomtype->room_type.','.@$v->rooms->roomclassifiction->classification_name; ?></td> 
							  <td>
							   <?php if(isset($v->rooms->relatedAmenities))
										{ 
										 $msg ="";
										 foreach($v->rooms->relatedAmenities as $k1=>$v1)
										 {
											 
											 $msg .= @$v1->amentises->amenities_name.",";
										 }
										}
										echo ($msg) ?  ' '.rtrim($msg,',').'  '  : "No Amenities Found ";
					               ?>
							  
							  </td>
							  <td><?php echo $v->guest_name; ?></td>
							  <td><?php echo $v->preference->bed_name; ?></td>
							  <td style="text-align:right;"><?php echo number_format($v->rooms->default_rate,2); ?></td><td style="text-align:right;"><?php echo  ($v->rooms->extra_tax=="Y") ? $v->rooms->tax : 'No VAT'; ?></td></tr>
							  <?
						  }
					  }
					  * */?>
				  
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
