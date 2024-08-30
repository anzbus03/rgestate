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
    
  
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('class'=>'form-horizontal','enctype' => 'multipart/form-data'),'focus'=>array($user,'hotel_name'))); 
        ?>
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$user->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array('countries/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array('countries/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
                <div class="row">


                    <div class="form-group col-sm-6">
                        <?php echo $form->labelEx($user, 'country_name');?>
                        <?php echo $form->textField($user, 'country_name', $user->getHtmlOptions('country_name')); ?>
                        <?php echo $form->error($user, 'country_name');?>
                    </div>        
                    <div class="form-group col-sm-6">
                        <?php echo $form->labelEx($user, 'cords');?>
                        <?php echo $form->textField($user, 'cords', $user->getHtmlOptions('cords')); ?>
                        <?php echo $form->error($user, 'cords');?>
                    </div>        
                    <div class="form-group col-lg-6">
                        <?php echo $form->labelEx($user, 'desfualt_currency');?>
                        <?php echo $form->dropDownList($user, 'default_currency', CHtml::listData(Currency::model()->listData(),'currency_id','NameWithCode'), $user->getHtmlOptions('desfualt_currency')); ?>
                        <?php echo $form->error($user, 'desfualt_currency');?>
                    </div>        
                    <div class="form-group col-lg-6">
                        <?php echo $form->labelEx($user, 'country_code');?>
                        <?php echo $form->textField($user, 'country_code', $user->getHtmlOptions('country_code')); ?>
                        <?php echo $form->error($user, 'country_code');?>
                    </div>        
                   
                      <?php
                    if(!$model->isNewRecord){ ?>
                       <div class="form-group col-lg-12">
                        <?php echo $form->labelEx($user, 'footer_links');?><?php echo $user->getTranslateHtml('footer_links','ar',false,'1200px');?>
                        <?php echo $form->textArea($user, 'footer_links', $user->getHtmlOptions('footer_links', array('rows' => 15))); ?>
                        <?php echo $form->error($user, 'footer_links');?>
                    </div>
                       <div class="form-group col-lg-12">
                        <?php echo $form->labelEx($user, 'popular_links_sale');?><?php echo $user->getTranslateHtml('popular_links_sale','ar',false,'1200px');?>
                        <?php echo $form->textArea($user, 'popular_links_sale', $user->getHtmlOptions('popular_links_sale', array('rows' => 8))); ?>
                        <?php echo $form->error($user, 'popular_links_sale');?>
                    </div>
                       <div class="form-group col-lg-12">
                        <?php echo $form->labelEx($user, 'popular_links_rent');?><?php echo $user->getTranslateHtml('popular_links_rent','ar',false,'1200px');?>
                        <?php echo $form->textArea($user, 'popular_links_rent', $user->getHtmlOptions('popular_links_rent', array('rows' => 8))); ?>
                        <?php echo $form->error($user, 'popular_links_rent');?>
                    </div>
                </div>
                <?php } ?> 
                <div class="clearfix"><!-- --></div> 
                <div class="clearfix"><!-- --></div>     
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
            <div class="box-footer">
                <div class="pull-right" style="margin: 20px;">
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
<script type="text/javascript">

function sun(lat,lan)
{
	 
$("#Countries_location_latitude").val(lat);
$("#Countries_location_longitude").val(lan);
}
$(function(){
    
    CKEDITOR.config.allowedContent = true;
    
})
</script>
