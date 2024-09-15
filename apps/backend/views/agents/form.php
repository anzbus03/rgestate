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
        // Modify this beginWidget to include htmlOptions
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableClientValidation' => true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'), // Important for file uploads
        ));
?>
<div class="card">
    <div class="card-header">
        <div class="pull-left">
            <h3 class="card-title"><span class="glyphicon glyphicon-user"></span> <?php echo $pageHeading; ?></h3>
        </div>
        <div class="pull-right">
            <?php if (!$user->isNewRecord) { ?>
            <?php
                        //echo CHtml::link(Yii::t('app', 'Create new'), array('users/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));
                        ?>
            <?php } ?>
            <?php echo CHtml::link(Yii::t('app', 'Cancel'), array('users/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel'))); ?>
        </div>
        <div class="clearfix">
            <!-- -->
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
                ?>
        <div class="clearfix">
            <!-- -->
        </div>
        <!-- is agent field  -->
        <div class="form-group col-lg-6">
            <?php echo $form->hiddenField($user, 'is_agent', array_merge($user->getHtmlOptions('is_agent'), ['value' => 1])); ?>
        </div>
        <div class="row">


            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'first_name'); ?>
                <?php echo $form->textField($user, 'first_name', $user->getHtmlOptions('first_name')); ?>
                <?php echo $form->error($user, 'first_name'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'last_name'); ?>
                <?php echo $form->textField($user, 'last_name', $user->getHtmlOptions('last_name')); ?>
                <?php echo $form->error($user, 'last_name'); ?>
            </div>

            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'profile_image'); ?>
                <?php echo CHtml::activeFileField($user, 'profile_image', $user->getHtmlOptions('profile_image')); ?>
                <?php echo $form->error($user, 'profile_image'); ?>
            </div>
            <div class="clearfix">
                <!-- -->
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'phone_number'); ?>
                <?php echo $form->textField($user, 'phone_number', $user->getHtmlOptions('phone_number')); ?>
                <?php echo $form->error($user, 'phone_number'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'age'); ?>
                <?php echo $form->textField($user, 'age', $user->getHtmlOptions('age')); ?>
                <?php echo $form->error($user, 'age'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'gender'); ?>
                <?php echo $form->dropDownList($user, 'gender', array('Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'), $user->getHtmlOptions('gender')); ?>
                <?php echo $form->error($user, 'gender'); ?>
            </div>

            <!-- <div class="clearfix">
          
        </div> -->
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'email'); ?>
                <?php echo $form->textField($user, 'email', $user->getHtmlOptions('email')); ?>
                <?php echo $form->error($user, 'email'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'confirm_email'); ?>
                <?php echo $form->textField($user, 'confirm_email', $user->getHtmlOptions('confirm_email')); ?>
                <?php echo $form->error($user, 'confirm_email'); ?>
            </div>
            <!-- <div class="clearfix">
           
        </div> -->
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'alt_email'); ?>
                <?php echo $form->textField($user, 'alt_email', $user->getHtmlOptions('alt_email')); ?>
                <?php echo $form->error($user, 'alt_email'); ?>
            </div>
            <!-- <div class="clearfix">
           
        </div> -->
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'fake_password'); ?>
                <?php echo $form->textField($user, 'fake_password', $user->getHtmlOptions('password')); ?>
                <?php echo $form->error($user, 'fake_password'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'confirm_password'); ?>
                <?php echo $form->textField($user, 'confirm_password', $user->getHtmlOptions('confirm_password')); ?>
                <?php echo $form->error($user, 'confirm_password'); ?>
            </div>
            <!-- <div class="clearfix">
   
        </div> -->
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'description'); ?>
                <?php echo $form->textField($user, 'description', $user->getHtmlOptions('description')); ?>
                <?php echo $form->error($user, 'description'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'service_id'); ?>
                <?php echo $form->dropDownList($user, 'service_id', Chtml::listData(AgentRole::model()->listData(), 'service_id', 'service_name'), $user->getHtmlOptions('service_id', array('empty' => 'Select Designation'))); ?>
                <?php echo $form->error($user, 'service_id'); ?>
            </div>
            <!-- Target for Sale field -->
            <div class="form-group col-lg-6 target-fields" style="display:none;">
                <?php echo $form->labelEx($user, 'target_for_sale'); ?>
                <?php echo $form->textField($user, 'target_for_sale', $user->getHtmlOptions('target_for_sale')); ?>
                <?php echo $form->error($user, 'target_for_sale'); ?>
            </div>

            <!-- Target for Rent field -->
            <div class="form-group col-lg-6 target-fields" style="display:none;">
                <?php echo $form->labelEx($user, 'target_for_rent'); ?>
                <?php echo $form->textField($user, 'target_for_rent', $user->getHtmlOptions('target_for_rent')); ?>
                <?php echo $form->error($user, 'target_for_rent'); ?>
            </div>

            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'target_period'); ?>
                <?php
                        echo $form->dropDownList(
                            $user,
                            'target_period',
                            array(
                                'yearly' => Yii::t('app', 'Yearly'),
                                'monthly' => Yii::t('app', 'Monthly'),
                                'weekly' => Yii::t('app', 'Weekly')
                            ),
                            array('empty' => 'Select Period', 'class' => 'form-control')
                        );
                        ?>
                <?php echo $form->error($user, 'target_period'); ?>
            </div>



            <!-- <div class="clearfix">
           
        </div> -->
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'licence_no'); ?>
                <?php echo $form->textField($user, 'licence_no', $user->getHtmlOptions('licence_no', array('class' => '  form-control'))); ?>
                <?php echo $form->error($user, 'licence_no'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'timezone'); ?>
                <?php echo $form->dropDownList($user, 'timezone', $user->getTimeZonesArray(), $user->getHtmlOptions('timezone')); ?>
                <?php echo $form->error($user, 'timezone'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php

                        echo $form->labelEx($user, 'country_id'); ?>
                <?php $dropdwn =   array_merge($user->getHtmlOptions('country_id'), array(
                            'empty' => 'Select Country ',
                            "style" => "1",
                            'ajax' =>
                            array(
                                'type' => 'GET',
                                'url' => Yii::app()->createUrl('city/loadStates'), //url to call.
                                'update' => '#' . $user->modelName . '_state_id', //selector to update
                                'data' => array('country_id' => 'js:this.value'),
                                'beforeSend' => 'function(){
							$("#myDiv").addClass("grid-view-loading");}',
                                'complete' => 'function(){
						    $("#myDiv").removeClass("grid-view-loading");
						   }',
                            )
                        ));  ?>

                <span id="myDiv" style="padding-left:20px;"></span>
                <?php echo $form->dropDownList($user, 'country_id', CHtml::listData(Countries::model()->Countrylist(), "country_id", "country_name"), $dropdwn); ?>
                <?php echo $form->error($user, 'country_id'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'state_id'); ?>
                <?php $dropdwn =   array_merge($user->getHtmlOptions('state_id'), array('empty' => 'Select Region ', "style" => "1"));  ?>
                <?php echo $form->dropDownList($user, 'state_id', CHtml::listData(States::model()->getStateWithCountry_2($user->country_id), "state_id", "state_name"), $dropdwn); ?>
                <?php echo $form->error($user, 'state_id'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'city'); ?>
                <?php echo $form->textField($user, 'city', $user->getHtmlOptions('city')); ?>
                <?php echo $form->error($user, 'city'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'language_id'); ?>
                <?php echo $form->dropDownList($user, 'language_id', CMap::mergeArray(array('' => Yii::t('app', 'Application default')), Language::getLanguagesArray()), $user->getHtmlOptions('language_id')); ?>
                <?php echo $form->error($user, 'language_id'); ?>
            </div>
            <div class="form-group col-lg-6">
                <?php echo $form->labelEx($user, 'status'); ?>
                <?php echo $form->dropDownList($user, 'status', $user->getStatusesArray(), $user->getHtmlOptions('status')); ?>
                <?php echo $form->error($user, 'status'); ?>
            </div>
            <div class="form-group col-lg-12">
                <?php echo $form->labelEx($user, 'address'); ?>
                <?php echo $form->textField($user, 'address', $user->getHtmlOptions('address')); ?>
                <?php echo $form->error($user, 'address'); ?>
            </div>


            <!-- <div class="clearfix">
            
        </div> -->
            <div class="row">
                <?php if ($user->removable == User::TEXT_YES && ($options = UserGroup::getAllAsOptions())) { ?>
                <div class="form-group col-lg-6">
                    <div class="">
                        <?php echo $form->labelEx($user, 'group_id'); ?>
                        <?php echo $form->dropDownList($user, 'group_id', CMap::mergeArray(array('' => ''), $options), $user->getHtmlOptions('group_id')); ?>
                        <?php echo $form->error($user, 'group_id'); ?>
                    </div>
                </div>
                <div class="form-group col-lg-6">
                    <div class="">
                        <?php echo $form->labelEx($user, 'bank_id'); ?>
                        <?php echo $form->dropDownList($user, 'bank_id', Bank::model()->ListDataAll(), $user->getHtmlOptions('bank_id', array('empty' => 'Select All'))); ?>
                        <?php echo $form->error($user, 'bank_id'); ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix">
            <!-- -->
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
        <div class="clearfix">
            <!-- -->
        </div>
    </div>
    <div class="box-footer">
        <div class="pull-right">
            <button type="submit" class="btn btn-primary btn-submit"
                data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...'); ?>"><?php echo Yii::t('app', 'Save changes'); ?></button>
        </div>
        <div class="clearfix">
            <!-- -->
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
$(function() {
    $('#User_timezone').select2();
})
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery script to show/hide fields based on service_id -->
<script type="text/javascript">
$(document).ready(function() {
    function toggleTargetFields() {
        var selectedService = $('#User_service_id').val();
        if (selectedService == '9') {
            $('.target-fields').show();
        } else {
            $('.target-fields').hide();
        }
    }

    // Initial check on page load
    toggleTargetFields();

    $('#User_service_id').on('change', function() {
        console.log('Service ID changed');
        toggleTargetFields();
    });
});
</script>