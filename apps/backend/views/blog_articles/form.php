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
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">
                        <span class="glyphicon glyphicon-book"></span> 
                        <?php echo $pageHeading;?>
                    </h3>
                </div>
                <div class="pull-right">
                    <?php if (!$article->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array('blog_articles/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array('blog_articles/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <?php echo $form->labelEx($article, 'title');?><?php echo $article->getTranslateHtml('title');?>
                            <?php echo $form->textField($article, 'title', $article->getHtmlOptions('title', array('data-article-id' => (int)$article->article_id, 'data-slug-url' => $this->createUrl('articles/slug')))); ?>
                            <?php echo $form->error($article, 'title');?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($article, 'content');?><?php echo $article->getTranslateHtml('content','ar',false,'1200px');?>
                            <?php echo $form->textArea($article, 'content', $article->getHtmlOptions('content', array('rows' => 15))); ?>
                            <?php echo $form->error($article, 'content');?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($article, 'meta_title');?>
                            <?php echo $form->textField($article, 'meta_title', $article->getHtmlOptions('meta_title')); ?>
                            <?php echo $form->error($article, 'meta_title');?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($article, 'meta_description');?>
                            <?php echo $form->textArea($article, 'meta_description', $article->getHtmlOptions('meta_description', array('rows' => 4))); ?>
                            <?php echo $form->error($article, 'meta_description');?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($articleToCategory, 'category_id');?>
                            <div class="article-categories-scrollbox">
                                <style>
                                    .article-categories-scrollbox .list-group-item:first-child  { display: none; }
                                </style>
                                <script>
                                    $(function(){ $('.list-group-item:first-child').find('input').prop('checked', true) })
                                </script>
                                <ul class="list-group">
                                <?php echo CHtml::checkBoxList($articleToCategory->modelName, $article->getSelectedCategoriesArray(), $article->getAvailableCategoriesArray(), $articleToCategory->getHtmlOptions('category_id', array(
                                    'class'        => '',
                                    'template'     => '<li class="list-group-item">{beginLabel}{input} <span>{labelTitle}</span> {endLabel}</li>',
                                    'container'    => '',
                                    'separator'    => '',
                                    'labelOptions' => array('style' => 'margin-right: 10px;')
                                ))); ?>
                                </ul>
                            </div>
                            <?php echo $form->error($articleToCategory, 'category_id');?>
                        </div>
                        <div class="form-group slug-wrapper"<?php if (empty($article->slug)) { echo ' style="display: none"'; } ?>>
                            <?php echo $form->labelEx($article, 'slug'); ?>
                            <?php echo $form->textField($article, 'slug', array('class' => 'form-control', 'maxlength' => 1100)); ?>
                            <?php echo $form->error($article, 'slug'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-secondary">
                            <div class="box-header">
                                <h3 class="box-title">Additional Settings</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <?php echo $form->labelEx($article, 'status');?>
                                    <?php echo $form->dropDownList($article, 'status', $article->getStatusesArray(), $article->getHtmlOptions('status')); ?>
                                    <?php echo $form->error($article, 'status');?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($article, 'blan');?>
                                    <?php echo $form->dropDownList($article,'blan',$article->blanArray(), $article->getHtmlOptions('blan')); ?>
                                    <?php echo $form->error($article, 'blan');?>
                                </div> 
                                <div class="form-group">
                                    <?php echo $form->labelEx($article, 'show_all');?>
                                    <?php echo $form->dropDownList($article,'show_all',$article->countryOption(), $article->getHtmlOptions('show_all',array('onchange'=>'showCountries(this)'))); ?>
                                    <?php echo $form->error($article, 'show_all');?>
                                </div> 
                                <div class="amn row <?php echo $article->show_all=='1' ? '' : 'hide';?>" style="margin-left: 0px; margin-right: 0px;">
                                    <?php
                                        $categoris = CHtml::listData(Countries::model()->listingCountries(),'country_id','country_name');
                                        foreach($categoris as $k => $v) {
                                            echo '<div class="col-sm-2" style="">';
                                            echo '<div class="form-check form-check-flat"><label class="form-check-label"><input value="'.$k.'" id="amenities_'.$k.'" '; echo in_array($k, (array) $article->listing_countries) ? 'checked' : ''; echo ' type="checkbox" name="listing_countries[]" > '.$v.' <i class="input-helper"></i></label></div>';
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($article, 'publish_date'); ?>
                                    <?php echo $form->dateField($article, 'publish_date', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($article, 'publish_date'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo $form->labelEx($article, 'publish_time'); ?>
                                    <?php echo $form->timeField($article, 'publish_time', array('class' => 'form-control')); ?>
                                    <?php echo $form->error($article, 'publish_time'); ?>
                                </div>
                            </div>
                            <div class="box box-secondary" style="margin-top: 2%;">
                                <div class="box-header">
                                    <h3 class="box-title">Featured Image & Tags</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($article, 'featured_image');?>
                                        <?php echo $form->fileField($article, 'featured_image'); ?>
                                        <?php echo $form->error($article, 'featured_image');?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo $form->labelEx($article, 'tags');?>
                                        <?php echo $form->textField($article, 'tags', array('class' => 'form-control', 'placeholder' => 'Enter tags separated by commas')); ?>
                                        <?php echo $form->error($article, 'tags');?>
                                    </div>
                                </div>
                            </div>
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