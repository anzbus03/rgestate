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
		<?php   $form=$this->beginWidget('CActiveForm', array( 
			 
			 ));   ?> 
        <div class="card-header">
            <div class="pull-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
         
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
			<div class="alert alert-info">
			<strong>Info!</strong> <a href="<?php echo Yii::app()->createUrl('countries/index');?>">Click here to add more listing countries.</a>
			</div>
            <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
				<tr><th width="80px">Disable Country</th><th width="80px">Priority</th><th>Listing Country</th></tr>
				<?php
				foreach($countries as $k=>$v){
					$checked = $v->enable_all_cities=='1' ? 'checked=true' : '' ; 
					$checked_region =  empty($v->show_region) ? 'checked=true' : '' ; 
	 
					echo '<tr><td ><input type="checkbox" classs="form-control" style="width:100%" name="disable_country['.$v->country_id.']" /></td><td ><input type="text" classs="form-control" style="width:100%;text-align:center" name="priority['.$v->country_id.']"  value="'.$v->priority.'"/></td><td>'.$v->country_name.'&nbsp;<input type="checkbox" classs="form-control" style="width:auto" '.$checked.' name="enable_all_cities['.$v->country_id.']" onclick="checkall_child(this)" data-id="'.$v->country_id.'" /> Enable All Cities  &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" classs="form-control" style="width:auto;" name="show_state['.$v->country_id.']" value="" '.$checked_region.' /> Show Main Country </td></tr>';
					$criteria = new CDbCriteria();
					$criteria->select= 't.state_name,t.state_id,t.country_id,enable_listing,priority';
					$criteria->compare('t.isTrash','0');
					$criteria->compare('t.country_id',$v->country_id);
					$states = States::model()->findAll($criteria);
					if($states){
						echo '<tr><td></td><td></td><td  >';
						?>
						 <table class="table">
						<tr><th width="80px">Enable City</th><th width="80px">Show Region</th><th width="80px">Priority</th><th>Region</th></tr>
						<?php
						$checked_region2 = '';
						foreach($states as $k2=>$v2){
							if($checked_region==''){
								$checked_region2 = ($v->show_region==$v2->state_id)    ? 'checked=true' : '' ; 
							}
							if($v->enable_all_cities=='1'){
								$checked = 'checked=true';
							}
							else{
								$checked = $v2->enable_listing=='1' ? 'checked=true' : '' ; 
							}
							echo '<tr><td>
							<input type="checkbox" classs="form-control" style="width:100%" '.$checked.' value="'.$v->country_id.'" class="enable_listing_'.$v2->country_id.'"  name="enable_listing['.$v2->state_id.']['.$v2->country_id.']" /><input type="hidden"  value="'.$v->country_id.'"  name="enable_listing_country['.$v2->state_id.']"  /></td><td ><input type="radio" classs="form-control" style="width:100%" '.$checked_region2.' name="show_state['.$v2->country_id.']" value="'.$v2->state_id.'" /></td><td ><input type="text" classs="form-control" style="width:100%;text-align:center" name="priority_state['.$v2->state_id.']"  value ="'.$v2->priority.'"/></td><td>'.$v2->state_name.'</td></tr>';
						}
						echo'</table></td></tr>
						';
					}
				
				
				}
				?>
       <tr><td colspan="100%" class="paginator">
						<div class="pagingarea"  >
						<div class="actions"  >
						<?php 
						//if($pages->itemCount>3){


						$this->widget('CLinkPager', array(
						'pages'=>$pages,
						// 'route' => 'user/AjaxDetails',

						));  
						//}
						?>
						</div>
						</div>
						</td></tr>
            </table>
            <div class="clearfix"><!-- --></div>
            </div>    
            
			<div class="box-footer">
			<div class="pull-right">
			<button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update');?></button>
			</div>
			<div class="clearfix"><!-- --></div>
			</div>
			</div>
          <?php $this->endWidget(); ?>
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
 
 <script>
 function checkall_child(k){
	 var data_id = $(k).attr('data-id');
 
	 if($(k).is(':checked')){
		 $('.enable_listing_'+data_id).attr('checked',true)
	 }
 }
 </script>

