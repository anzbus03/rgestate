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
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'), // This is necessary for file uploads
        ));        ?>
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-user"></span> <?php echo $pageHeading; ?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$user->isNewRecord) { ?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array('users/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel'))); ?>
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
                <div class="row">

                    <div class="form-group col-lg-6 ">
                        <?php echo $form->labelEx($user, 'first_name'); ?>
                        <?php echo $form->textField($user, 'first_name', $user->getHtmlOptions('first_name')); ?>
                        <?php echo $form->error($user, 'first_name'); ?>
                    </div>
                    <div class="form-group col-lg-6 ">
                        <?php echo $form->labelEx($user, 'last_name'); ?>
                        <?php echo $form->textField($user, 'last_name', $user->getHtmlOptions('last_name')); ?>
                        <?php echo $form->error($user, 'last_name'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'phone_number'); ?>
                        <?php echo $form->textField($user, 'phone_number', $user->getHtmlOptions('phone_number')); ?>
                        <?php echo $form->error($user, 'phone_number'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'email'); ?>
                        <?php echo $form->textField($user, 'email', $user->getHtmlOptions('email')); ?>
                        <?php echo $form->error($user, 'email'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'age'); ?>
                        <?php echo $form->textField($user, 'age', $user->getHtmlOptions('age')); ?>
                        <?php echo $form->error($user, 'age'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'confirm_email'); ?>
                        <?php echo $form->textField($user, 'confirm_email', $user->getHtmlOptions('confirm_email')); ?>
                        <?php echo $form->error($user, 'confirm_email'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'alt_email'); ?>
                        <?php echo $form->textField($user, 'alt_email', $user->getHtmlOptions('alt_email')); ?>
                        <?php echo $form->error($user, 'alt_email'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'fake_password'); ?>
                        <?php echo $form->textField($user, 'fake_password', $user->getHtmlOptions('password')); ?>
                        <?php echo $form->error($user, 'fake_password'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'profile_image'); ?>
                        <?php echo CHtml::activeFileField($user, 'profile_image', $user->getHtmlOptions('profile_image')); ?>
                        <?php echo $form->error($user, 'profile_image'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'confirm_password'); ?>
                        <?php echo $form->textField($user, 'confirm_password', $user->getHtmlOptions('confirm_password')); ?>
                        <?php echo $form->error($user, 'confirm_password'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'timezone'); ?>
                        <?php echo $form->dropDownList($user, 'timezone', $user->getTimeZonesArray(), $user->getHtmlOptions('timezone')); ?>
                        <?php echo $form->error($user, 'timezone'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'language_id'); ?>
                        <?php echo $form->dropDownList($user, 'language_id', CMap::mergeArray(array('' => Yii::t('app', 'Application default')), Language::getLanguagesArray()), $user->getHtmlOptions('language_id')); ?>
                        <?php echo $form->error($user, 'language_id'); ?>
                    </div>
                    <div class="form-group col-lg-6 mt-4">
                        <?php echo $form->labelEx($user, 'status'); ?>
                        <?php echo $form->dropDownList($user, 'status', $user->getStatusesArray(), $user->getHtmlOptions('status')); ?>
                        <?php echo $form->error($user, 'status'); ?>
                    </div>
                    <div class="form-group col-lg-6 mb-2 mt-4">
                        <div class="">
                            <?php $options = [2 => "Agency", 3 => "Agent"] ?>
                            <?php echo $form->labelEx($user, 'rules'); ?>
                            <?php echo $form->dropDownList($user, 'rules', CMap::mergeArray(array('' => 'Select Role'), $options), $user->getHtmlOptions('rules')); ?>
                            <?php echo $form->error($user, 'rules'); ?>
                        </div>
                    </div>

                    <!-- Multi-select form for agents, initially hidden -->
                    <div class="form-group col-lg-6 mb-2 mt-4" id="agent-select-group" style="display:none;">
                        <div class="">
                            <?php echo $form->labelEx($user, 'agents'); ?>

                            <?php
                            // Fetch all agents where rules == 3
                            $agents = User::model()->findAllByAttributes(['rules' => 3]);

                            // Generate the agent list with first_name and last_name
                            $agentList = CHtml::listData($agents, 'user_id', function ($agent) {
                                return $agent->first_name . ' ' . $agent->last_name;
                            });

                            // If this is an update, get the selected agents from the database
                            $selectedAgents = explode(',', $user->agents); // Assuming agents are stored as a comma-separated string

                            // Render the multi-select dropdown with the selected agents
                            echo $form->dropDownList($user, 'agents', $agentList, [
                                'multiple' => 'multiple',
                                'class' => 'form-control',
                                'options' => array_combine($selectedAgents, array_fill(0, count($selectedAgents), ['selected' => true])) // Pre-select the saved agents
                            ]);
                            ?>
                        </div>
                    </div>

                </div>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
                <script>
                    $(function() {
                        $("#User_agents").select2({
                            placeholder: "Select Agent"
                        });
                    })
                    document.getElementById('User_rules').addEventListener('change', function() {
                        var selectedRole = this.value;
                        var agentSelectGroup = document.getElementById('agent-select-group');

                        if (selectedRole == 2) {
                            // Show multi-select for agents when "Agency" is selected
                            agentSelectGroup.style.display = 'block';
                        } else {
                            // Hide multi-select when any other role is selected
                            agentSelectGroup.style.display = 'none';
                        }
                    });
                    var selectedRole = document.getElementById('User_rules').value;
                    var agentSelectGroup = document.getElementById('agent-select-group');

                    if (selectedRole == 2) {
                        // Show multi-select for agents when "Agency" is selected
                        agentSelectGroup.style.display = 'block';
                    } else {
                        // Hide multi-select when any other role is selected
                        agentSelectGroup.style.display = 'none';
                    }
                </script>
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
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit m-4"
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