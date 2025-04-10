<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.3
 */
 
?>
<?php
/*
<div class="card">
    <div class="card-header">
        <div class="pull-left">
            <h3 class="card-title"><span class="glyphicon glyphicon-user"></span> <?php echo Yii::t('servers', 'Customer');?></h3>
        </div>
        <div class="pull-right"></div>
        <div class="clearfix"><!-- --></div>
    </div>
    <div class="card-body">
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($server, 'customer_id');?>
            <?php echo $form->hiddenField($server, 'customer_id', $server->getHtmlOptions('customer_id')); ?>
            <?php
            /*
            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                'name'          => 'customer',
                'value'         => !empty($server->customer) ? ($server->customer->getFullName() ? $server->customer->getFullName() : $server->customer->email) : null,
                'source'        => $this->createUrl('customers/autocomplete'),
                'cssFile'       => false,
                'options'       => array(
                    'minLength' => '2',
                    'select'    => 'js:function(event, ui) {
                        $("#'.CHtml::activeId($server, 'customer_id').'").val(ui.item.customer_id);
                    }',
                    'search'    => 'js:function(event, ui) {
                        $("#'.CHtml::activeId($server, 'customer_id').'").val("");
                    }',
                    'change'    => 'js:function(event, ui) {
                        if (!ui.item) {
                            $("#'.CHtml::activeId($server, 'customer_id').'").val("");
                        }
                    }',
                ),
                'htmlOptions'   => $server->getHtmlOptions('customer_id'),
            ));
            
            ?>
            <?php echo $form->error($server, 'customer_id');?>
        </div>
        <div class="form-group col-lg-3">
            <?php echo $form->labelEx($server, 'locked');?>
            <?php echo $form->dropDownList($server, 'locked', $server->getYesNoOptions(), $server->getHtmlOptions('locked')); ?>
            <?php echo $form->error($server, 'locked');?>
        </div>
        <div class="clearfix"><!-- --></div>           
    </div>
</div>
* */
?>
