<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
<?php

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
         <div class="breadcrumbs mar4" >
		<a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('place_an_ad/create');?>">Place Ad</a>
		</div>
        <div class="clear"></div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                      <h1 id="innerhead">Place Your Ad</h1> 
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
                <ul class="fourStep stepNavigation" style="width:100%;">
					<li  class="done"><a title=""><em>Step 1: Ad Type</em><span>Choose Ad Type</span></a></li>
					<li class="done" ><a title=""><em>Step 2: Details</em><span>Enter Ad details</span></a></li>
					<li class="lastDone"><a title=""><em>Step 3: Location</em><span>Choose Location</span></a></li>
					<li class="lastStep current"><a title=""><em>Step 4: Done</em><span>Completed</span></a></li>
	           </ul>
	           <div style="clear:both;"></div>
                <div class="content_place_an_ad">
					
				 <div class="content_head"  >Step 4 : Completed </div>
				  <div style="text-align: center; padding: 100px;padding-bottom:150px; font-weight:bold;font-size:25px;color:#22731A;text-aign:center;">
				  Successfully placed your Ad..
				   <div class="clearfix"><!-- --></div>
				   <div class="pull-right" style="margin-top:30px;">
                    <?php /*
                    <a href="#" class="btn btn-primary btn-submit"> <?php echo Yii::t('app', 'View Ad');?></a>*/ ?>&nbsp;
                    <a href="<?php echo Yii::app()->createUrl("place_an_ad/update",array("id"=>$model->id));?>" class="btn btn-primary btn-submit btn_my"> <?php echo Yii::t('app', 'Edit Ad');?></a>
                    <a href="<?php echo Yii::app()->createUrl("details/".$model->slug);?>" class="btn btn-primary btn-submit btn_my"> <?php echo Yii::t('app', 'View Ad');?></a>
                </div>
				  </div>
                
            
            </div>
            <div class="box-footer">
               
                
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
 </div>
 </div>
 <div style="clear:both;"></div>
  
