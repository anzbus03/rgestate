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
        $form = $this->beginWidget('CActiveForm'); 
        ?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-book"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                 
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array($this->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
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
                <div class="form-group">
                    <?php echo $form->labelEx($article, 'title');?><?php echo $article->getTranslateHtml('title','ar');?>
                    <?php echo $form->textField($article, 'title', $article->getHtmlOptions('title', array('data-article-id' => (int)$article->article_id, 'data-slug-url' => $this->createUrl('articles/slug')))); ?>
                    <?php echo $form->error($article, 'title');?>
                </div>
                
                <div class="form-group">
                    <?php echo $form->labelEx($article, 'content');?><?php echo $article->getTranslateHtml('content','ar',false,'1200px');?>
                    <?php echo $form->textArea($article, 'content', $article->getHtmlOptions('content', array('rows' => 15))); ?>
                    <?php echo $form->error($article, 'content');?>
                </div>
                
                <div class="col-lg-4">
                      <div class="form-group">
                        <?php echo $form->labelEx($article, 'cords');?>
                        <?php echo $form->dropDownList($article, 'cords', $article->usedin(), $article->getHtmlOptions('cords')); ?>
                        <?php echo $form->error($article, 'cords');?>
                    </div>
                    <div class="form-group slug-wrapper"<?php if (empty($article->slug)){ echo ' style="display:none"';}?>>
                        <?php echo $form->labelEx($article, 'slug');?>
                        <?php echo $form->textField($article, 'slug', $article->getHtmlOptions('slug')); ?>
                        <?php echo $form->error($article, 'slug');?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($article, 'status');?>
                        <?php echo $form->dropDownList($article, 'status', $article->getStatusesArray(), $article->getHtmlOptions('status')); ?>
                        <?php echo $form->error($article, 'status');?>
                    </div>
                </div>
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
