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
        $form = $this->beginWidget('CActiveForm'); ?>
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
 
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo Yii::t('settings', 'Common settings')?></h3>
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
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, '_meesage_after_register');?>
            <?php echo $form->textField($commonModel, '_meesage_after_register', $commonModel->getHtmlOptions('_meesage_after_register')); ?>
            <?php echo $form->error($commonModel, '_meesage_after_register');?>
        </div>
           <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, '_message_after_register_if_confirmed');?>
            <?php echo $form->textField($commonModel, '_message_after_register_if_confirmed', $commonModel->getHtmlOptions('_message_after_register_if_confirmed')); ?>
            <?php echo $form->error($commonModel, '_message_after_register_if_confirmed');?>
        </div>
              <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'successfully_verified_email_msg');?><?php echo $commonModel->createTransLink('successfully_verified_email_msg');?>
            <?php echo $form->textField($commonModel, 'successfully_verified_email_msg', $commonModel->getHtmlOptions('successfully_verified_email_msg')); ?>
            <?php echo $form->error($commonModel, 'successfully_verified_email_msg');?>
        </div>
              <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'successfully_saved_personal_information');?>
            <?php echo $form->textField($commonModel, 'successfully_saved_personal_information', $commonModel->getHtmlOptions('successfully_saved_personal_information')); ?>
            <?php echo $form->error($commonModel, 'successfully_saved_personal_information');?>
        </div>
             <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, 'successfully_changed_avatar');?>
            <?php echo $form->textField($commonModel, 'successfully_changed_avatar', $commonModel->getHtmlOptions('successfully_changed_avatar')); ?>
            <?php echo $form->error($commonModel, 'successfully_changed_avatar');?>
        </div>
              <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, '_message_after_resent');?>
            <?php echo $form->textField($commonModel, '_message_after_resent', $commonModel->getHtmlOptions('_message_after_resent')); ?>
            <?php echo $form->error($commonModel, '_message_after_resent');?>
        </div>
            <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, '_meesage_after_forgot_password');?><?php echo $commonModel->createTransLink('_meesage_after_forgot_password');?>
            <?php echo $form->textField($commonModel, '_meesage_after_forgot_password', $commonModel->getHtmlOptions('_meesage_after_forgot_password')); ?>
            <?php echo $form->error($commonModel, '_meesage_after_forgot_password');?>
        </div>
            <div class="clearfix"><!-- --></div>
        <div class="form-group col-lg-12">
            <?php echo $form->labelEx($commonModel, '_meesage_after_login_info_sent');?>
            <?php echo $form->textField($commonModel, '_meesage_after_login_info_sent', $commonModel->getHtmlOptions('_meesage_after_login_info_sent')); ?>
            <?php echo $form->error($commonModel, '_meesage_after_login_info_sent');?>
        </div>
        <?php 
        /**
         * This hook gives a chance to append content after the active form fields.
         * Please note that from inside the action callback you can access all the controller view variables 
         * via {@CAttributeCollection $collection->controller->data}
         * @since 1.3.3.1
         */
        $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
            'controller'    => $this,
            'form'          => $form    
        )));
        ?>
        <div class="clearfix"><!-- --></div>
    </div>
</div>
 
        <div class="card">
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
    <!-- MODAL HTACCESS -->
    <div class="modal fade" id="writeHtaccessModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
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
