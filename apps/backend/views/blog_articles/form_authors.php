<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @autor Serban George Cristian <cristian.serban@mailwizz.com> 
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
            'htmlOptions' => array('enctype' => 'multipart/form-data'), // Ensure form supports file uploads
        ));
        ?>
        <style>
            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
            }

            .card-header-left {
                flex: 1;
            }

            .card-header-right {
                display: flex;
                gap: 10px;
            }

            .card-header-right .btn {
                margin-left: 5px;
            }
        </style>
        <div class="card card-primary">
            <div class="card-header">
                <div class="card-header-left">
                    <h3 class="card-title">
                        <span class="glyphicon glyphicon-book"></span> 
                        <?php echo $pageHeading;?>
                    </h3>
                </div>
                <div class="pull-right">
                    <?php if (!$article->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array('blog_articles/create_author'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array('blog_articles/index_authors'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo $form->labelEx($article, 'name');?><?php echo $article->getTranslateHtml('name');?>
                            <?php echo $form->textField($article, 'name', $article->getHtmlOptions('name', array('placeholder' => "Enter Author Name"))); ?>
                            <?php echo $form->error($article, 'name');?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($article, 'description');?><?php echo $article->getTranslateHtml('description','ar',false,'1200px');?>
                            <?php echo $form->textArea($article, 'description', $article->getHtmlOptions('description', array('rows' => 5))); ?>
                            <?php echo $form->error($article, 'description');?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($article, 'image');?>
                            <?php echo $form->fileField($article, 'image', array('class' => "form-control")); ?>
                            <?php echo $form->error($article, 'image');?>
                        </div>
                       
                    </div>
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
<script>
    function showCountries(k){
        if($(k).val()=='1'){
            $('.amn').removeClass('hide')
        }
        else{
            $('.amn').addClass('hide')
        }
    }
</script>