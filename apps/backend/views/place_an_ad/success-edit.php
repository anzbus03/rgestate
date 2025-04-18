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
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
             
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="card-body">
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
					<li class="progtrckr-done">Edit Location</li> 
					<li class="progtrckr-done">Done</li> 
				</ol>
               <div class="content_place_an_ad">
					<style>
					 #header_title 
					{
					 	font-size	: 16px;
						font-weight	: 600;
						font-style	:normal;
						color	:  #7C7C7C;
						line-height :	24px;
						text-align	: center;
					}
					 #header_title h2
					 {
						margin-top:40px;
						color:#595959;
						font-weight:bold;
						font-size	: 18px;
					 }
					 .checkit-live
					 {
					 background: #a9a9a9 !important;
					 border: #a9a9a9 !important;
				     }
					</style>
				 <div class="content_head"  >Step 4 : Completed </div>
 
                    <div id="header_title" class="span12">
							<h2 class="listing-question">Finished!</h2>
							<?php
							if($model->status=='A'){
								?>
								<h3>Your ad's now live and being read by squabillions of people</h3>
								<?
							}
							else { ?>
							<h3 class="pre-select-cat">Successfully updated your  listing  property on <?php echo Yii::app()->options->get('system.common.site_name');?> . <br /> After administrator valiadation , your listing  will active on main website. </h3>
							<?php } ?> 
							
							<br /> 
							<a href="<?php echo $model->PreviewUrlTrash;?>" class="btn btn-primary btn-submit checkit-live" style="min-width:416px;" target="_blank" >Check it live</a>
							<br /> 
							<br /> 
							<br /> 

							<a href="<?php echo Yii::app()->createUrl("place_an_ad/create");?>" class="btn btn-primary btn-submit" style="min-width:206px;">Post another ad</a>
							<a href="<?php echo Yii::app()->createUrl("place_an_ad/update",array("id"=>$model->id));?>" class="btn btn-primary btn-submit" style="min-width:206px;">Edit your ad</a>
							</div>
							</div>
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
 
