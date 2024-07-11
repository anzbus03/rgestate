<div class="col-md-9  no-padding-left">
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
       $form = $this->beginWidget('CActiveForm',array('focus'=>'name' 	,
        
        
         'enableClientValidation' => true,
					'clientOptions' => array(
					'validateOnSubmit' => true,
					
					'afterValidate' => 'js:function(form, data, hasError) { 
					if(hasError) {
						 form.find("button.btn-submit").button("reset");
						var focus = false;
						for(var i in data){ if(!focus){$("#"+i).focus() ; focus =true; }  $("#"+i).addClass("error") } ;
					 
						return false;			
					}
					else{
					form.find("button.btn-submit").button("reset");
					form.submit();
					return true; 
				}
					
					}'
					 ))); ; 
        ?>    
        <div class="card">
            <div class="card-header">
                 <div class="pull-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-text-width"></span>  <?php  echo ($template->isNewRecord) ? 'Update   Template' : 'Create   Template' ; ?>
                </h3>
            </div>
            <div class="pull-right">
				
                <?php
                 if(!$template->isNewRecord){
					echo CHtml::link(Yii::t('app', 'Create new'), array('send_email/email_template_create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'New'))); 
                  ?> <a href="javascript:;" onclick="window.open('<?php echo $previewUrl;?>', '<?php echo Yii::t('email_templates',  'Preview');?>', 'height=600, width=600'); return false;" class="btn btn-primary btn-xs"><?php echo Yii::t('email_templates',  'Preview');?></a> 
		 
					<?php 
					} 
					echo CHtml::link(Yii::t('app', 'List Templates'), array('send_email/email_template'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'List Templates')));?>
            </div>
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
                $this->renderPartial('//templates/_form',compact('form','template'));
                ?>
               
                <div class="clearfix"><!-- --></div>
                <?php 
                /**
                 * This hook gives a chance to append content after the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * 
                 * @since 1.3.3.1
                 */
                $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                ))); 
                ?>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
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
    ?>
    <?php if(!$template->isNewRecord) { ?>
    <div class="modal fade" id="template-test-email" tabindex="-1" role="dialog" aria-labelledby="template-test-email-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><?php echo Yii::t('email_templates',  'Send a test email');?></h4>
            </div>
            <div class="modal-body">
                 <div class="callout callout-info">
                     <strong><?php echo Yii::t('app', 'Notes');?>: </strong><br />
                    <?php 
                    $text = '
                    * if multiple recipients, separate the email addresses by a comma.<br />
                    * the email tags will not be parsed while sending test emails.<br />
                    * make sure you save the template changes before you send the test.';
                    echo Yii::t('email_templates',  StringHelper::normalizeTranslationString($text));
                    ?>
                 </div>
                 <?php echo CHtml::form(array('templates/test', 'template_uid' => $template->template_uid), 'post', array('id' => 'template-test-form'));?>
                 <?php echo CHtml::textField('email', null, array('class' => 'form-control'));?>
                 <?php CHtml::endForm();?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app', 'Close');?></button>
              <button type="button" class="btn btn-primary btn-submit" onclick="$('#template-test-form').submit();"><?php echo Yii::t('email_templates',  'Send test');?></button>
            </div>
          </div>
        </div>
    </div>
    <?php } ?>
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
 </div>
