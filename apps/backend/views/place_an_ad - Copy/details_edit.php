<style>.select2-container .select2-selection--single{ height:36px; }.select2-container--default .select2-selection--single .select2-selection__rendered { line-height:35px; } </style>

<?php defined('MW_PATH') || exit('No direct script access allowed');

 
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
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus))); 
        ?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
             
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
          
                
                <div class="clearfix"><!-- --></div>
                <ol class="progtrckr" data-progtrckr-steps="4">
					<li class="progtrckr-done">Edit Ad Type</li> 
					<li class="progtrckr-done">Edit Details</li> 
					<li class="progtrckr-todo">Edit Location</li> 
					<li class="progtrckr-todo">Done</li> 
				</ol>
                 <div class="content_place_an_ad">
					
				 	<div class="content_head"  >Step 2 : Edit Details</div>
					 
				   <div style="clear:both"></div>
				    <div class="content_content">
				      <div class="clearfix"><!-- --></div>
									  <div style="font-weight:bold;color:#6B6B6B;font-size:16px;margin-bottom:20px;">Ad Type :
									   <?php 
									  if(!empty($subcategory))
									  {
									  echo $subcategory->category->category_name;?>/<?php echo $subcategory->sub_category_name;?>&nbsp;<a href="<?php echo Yii::app()->createUrl("place_an_ad/create"); ?>" class="my_link">Change</a>
									  <?php
									  }	
									  else
									  {
										    echo $category->category_name;?>  &nbsp;<a href="<?php echo Yii::app()->createUrl("place_an_ad/create"); ?>" class="my_link">Change</a>
									   <?php
									  }
									  ?>
									  </div>
				    <?php $this->renderPartial('_detail_field',compact('form'));?>
									 
									  
								 
									  
									  
								 
									 
									 
									 
									 <?php echo $form->hiddenField($model,'section_id');?>
									 <?php echo $form->hiddenField($model,'category_id');?>
									 <?php echo $form->hiddenField($model,'sub_category_id');?>
									 <?php echo $form->hiddenField($model,'country');?>
									 <?php echo $form->hiddenField($model,'listing_type');?>
									   <?php echo $form->hiddenField($model, 'state', $model->getHtmlOptions('state')); ?>
									 
										        
									   <?php $this->renderPartial('_moredetails',compact('form'));?>
                 
                 
                 <div class="clearfix"><!-- --></div> 
					 
				   </div>
				 
            
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Go To Next');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        </div>
        
        <?php 
        $this->endWidget(); 
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));
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
ajaxCommunityUrl = "<?php echo Yii::app()->createUrl('place_an_ad/community');?>/state_id/<?php echo $model->state;?>";
ajaxDistrictUrl = "<?php echo Yii::app()->createUrl('place_an_ad/district');?>/state_id/<?php echo $model->state;?>";
ajaxCustomerUrl = "<?php echo Yii::app()->createUrl('place_an_ad/customer');?>";
ajaxSubCommunityUrl = "<?php echo Yii::app()->createUrl('place_an_ad/subCoummunity');?>";
$(function(){ $('select.selectt2').select2(); })
</script>

