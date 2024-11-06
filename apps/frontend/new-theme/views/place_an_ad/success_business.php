<style>
    .bg-bk.card-1 {
  
    box-shadow: unset !important;
}
.bg-bk {
  
    width: 100% !important; 
}#place_an_ad .place-property {
    max-width:  650px!important;
    box-shadow: unset !important;
    border: 1px solid #eee!important;
    width: 100% !important ;
}
.d-flex { display:flex; }
#place_an_ad .row label.or-labels {
    display: flex;
    align-items: center;
    justify-content: center;
}.box {
  
    background: #fff;
}
</style>
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
        <div class="box box-primary">
            <div class="box-header">
               
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
             
                <div class="content_place_an_ad clb">
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
				     }.card-1 h3 {
  
     text-align: center !important; 
}
					</style>
                    <div id="header_title" class="span12 text-center">
							<h2 class="listing-question">Finished!</h2>
							<?php
							if($model->status=='A'){
								?>
								<h3>Your ad's now live and being read by squabillions of people</h3>
								<?
							}
							else { ?>
							<h3 class="pre-select-cat">Thanks <?php echo $name; ?> <span class="email"><?php echo $email; ?></span> for listing your   business on <?php echo $this->app->options->get('system.common.site_name');?> . <br /> After administrator valiadation , your listing  will active on main website. </h3>
							<?php } ?> 
							
							<br /> 
							<a href="<?php echo $this->app->createUrl('site/index');?>" class="btn btn-primary btn-submit checkit-live" style="min-width: 300px;background: var(--secondary-color) !important;;"   >Back to home</a>
							<br /> 
							<br /> 
							<br /> 

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
 
