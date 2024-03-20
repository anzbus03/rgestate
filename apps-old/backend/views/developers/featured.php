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
	 
    <div class="box box-primary">
		<?php   $form=$this->beginWidget('CActiveForm', array( 
			 
			 ));   ?> 
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo  $user->fullName .' Feature Settings';?>
                </h3>
            </div>
         
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
			 
            <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
				<tr><th>Listing Country</th></tr>
				<?php
				foreach($countries as $k=>$v){
					$checked =   ($v->show_region!=null) ? 'checked=true' : '' ; 
					 
					echo '<tr><td>'.$v->country_name.'&nbsp;<input type="checkbox" classs="form-control" style="width:auto" '.$checked.' name="enable_all_cities['.$v->country_id.']" onclick="checkall_child(this)" data-id="'.$v->country_id.'" /> Make All Featured   &nbsp;&nbsp;&nbsp;&nbsp;  </td></tr>';
					 
					$criteria = new CDbCriteria();
					$criteria->select= 't.state_name,t.state_id,t.country_id,featured_state.state_id as enable_listing,priority';
					$criteria->join  = ' INNER JOIN {{listing_user_more_state}} st on st.state_id = t.state_id and st.user_id=:thisUser';
					$criteria->join  .= ' LEFT JOIN {{listing_users_state_featured}} featured_state on featured_state.state_id = t.state_id  and featured_state.user_id = :thisUser  ';
					$criteria->params[':thisUser'] = $user->user_id;
					$criteria->compare('t.isTrash','0');
					$criteria->compare('t.country_id',$v->country_id);
					$criteria->distinct  = 't.state_id ';
					$states = States::model()->findAll($criteria);
					if(empty($states)){
						$criteria = new CDbCriteria();
						$criteria->select= 't.state_name,t.state_id,t.country_id,featured_state.state_id as enable_listing,priority';
						$criteria->join  .= ' LEFT JOIN {{listing_users_state_featured}} featured_state on featured_state.state_id = t.state_id and featured_state.user_id = :thisUser  ';
						$criteria->compare('t.isTrash','0');
						$criteria->distinct  = 't.state_id ';
						$criteria->params[':thisUser'] = $user->user_id;
						$criteria->compare('t.country_id',$v->country_id);
						$criteria->compare('t.enable_listing','1');
						$states = States::model()->findAll($criteria);
					}
					if($states){
						echo '<tr> <td>';
						?>
						 <table class="table">
						<tr><th>Make Featured  City</th></tr>
						<?php
						$checked = '';
						foreach($states as $k2=>$v2){
							 
							if($v->show_region!=null){
								$checked = 'checked=true';
							}
							else{
								$checked = $v2->enable_listing!=null ? 'checked=true' : '' ; 
							} 
							echo '<tr><td>
							<input type="checkbox"  style="width:auto" '.$checked.' value="'.$v2->state_id.'" class="enable_listing_'.$v2->country_id.'"  name="enable_listing['.$v2->country_id.'][]" /><input type="hidden"  value="'.$v->country_id.'"  name="enable_listing_country['.$v2->state_id.']"  /> '.$v2->state_name.'</td></tr>';
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

