<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.4
 */

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.4.3
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
    $this->renderPartial('_customers_tabs');
    /**
     * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
     * in order to stop rendering the default content.
     * @since 1.3.4.3
     */
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm'); 
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo Yii::t('settings', 'Customer registration')?></h3>
            </div>
            <div class="card-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.4.3
                 */
                $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($model, 'enabled');?>
                    <?php echo $form->dropDownList($model, 'enabled', $model->getYesNoOptions(), $model->getHtmlOptions('enabled')); ?>
                    <?php echo $form->error($model, 'enabled');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($model, 'default_group');?>
                    <?php echo $form->dropDownList($model, 'default_group', CMap::mergeArray(array('' => Yii::t('app', 'Choose')), $model->getGroupsList()), $model->getHtmlOptions('default_group')); ?>
                    <?php echo $form->error($model, 'default_group');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($model, 'unconfirm_days_removal');?>
                    <?php echo $form->textField($model, 'unconfirm_days_removal', $model->getHtmlOptions('unconfirm_days_removal')); ?>
                    <?php echo $form->error($model, 'unconfirm_days_removal');?>
                </div>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($model, 'require_approval');?>
                    <?php echo $form->dropDownList($model, 'require_approval', $model->getYesNoOptions(), $model->getHtmlOptions('require_approval')); ?>
                    <?php echo $form->error($model, 'require_approval');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($model, 'company_required');?>
                    <?php echo $form->dropDownList($model, 'company_required', $model->getYesNoOptions(), $model->getHtmlOptions('company_required')); ?>
                    <?php echo $form->error($model, 'company_required');?>
                </div>
                <div class="form-group col-lg-4">
                    <?php echo $form->labelEx($model, 'tc_url');?>
                    <?php echo $form->textField($model, 'tc_url', $model->getHtmlOptions('tc_url')); ?>
                    <?php echo $form->error($model, 'tc_url');?>
                </div>
                <?php 
                /**
                 * This hook gives a chance to append content after the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.4.3
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
     * @since 1.3.4.3
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
 * @since 1.3.4.3
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));