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
if ($viewCollection->renderContent) { ?>
	<style>
	
	.panel-template-box {
    float: left;
    margin-right: 10px;
    max-width: 190px;
}
	</style>
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-text-width"></span> <?php echo $pageHeading;?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array('templates/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'New')));?>
                <?php echo CHtml::link(Yii::t('email_templates', 'Upload template'), '#template-upload-modal', array('class' => 'btn btn-primary btn-xs', 'data-toggle' => 'modal', 'title' => Yii::t('email_templates', 'Upload template')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('templates/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <?php foreach ($templates as $model) { ?>
				<div class="col-sm-4">
            <div class="box box-primary panel-template-box " style="min-width:100%;"  >
                <div class="card-header"><h3 class="card-title" style="display: block;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $model->name;?></h3></div>
         
                <div class="box-footer">
                    <div class="pull-left">
                        <a href="<?php echo Yii::app()->createUrl("templates/delete", array("template_uid" => $model->template_uid));?>" class="btn btn-danger btn-xs btn-delete-template" data-confirm-text="<?php echo Yii::t('app', 'Are you sure you want to remove this item?')?>"><span class="fa fa-trash"></span> <?php echo Yii::t('app', 'Delete');?></a>
                    </div>
                    <div class="pull-right">
                        <a href="<?php echo Yii::app()->createUrl("templates/update", array("template_uid" => $model->template_uid));?>" class="btn btn-primary btn-xs"><span class="fa fa-pencil"></span> <?php echo Yii::t('app', 'Update');?></a>
                    </div>
                    <div class="clearfix"><!-- --></div>
                </div>
            </div>
            <div class="clearfix"><!-- --></div>
            </div>
            <?php } ?>
          
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
            <?php $this->widget('CLinkPager', array(
                'pages'         => $pages,
                'htmlOptions'   => array('id' => 'templates-pagination', 'class' => 'pagination'),
                'header'        => false,
                'cssFile'       => false                    
            )); ?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
    </div>
    <div class="modal fade" id="template-upload-modal" tabindex="-1" role="dialog" aria-labelledby="template-upload-modal-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><?php echo Yii::t('email_templates',  'Upload template archive');?></h4>
            </div>
            <div class="modal-body">
                 <div class="callout callout-info">
                    <?php
                    $text = '
                    Please see <a href="{templateArchiveHref}">this example archive</a> in order to understand how you should format your uploaded archive!
                    Also, please note we only accept zip files.';
                    echo Yii::t('email_templates',  StringHelper::normalizeTranslationString($text), array(
                        '{templateArchiveHref}' => Yii::app()->apps->getAppUrl('customer', 'assets/files/example-template.zip', false, true),
                    ));
                    ?>
                 </div>
                <?php 
                $form = $this->beginWidget('CActiveForm', array(
                    'action'        => array('templates/upload'),
                    'id'            => $templateUp->modelName.'-upload-form',
                    'htmlOptions'   => array(
                        'id'        => 'upload-template-form', 
                        'enctype'   => 'multipart/form-data'
                    ),
                ));
                ?>
                <div class="form-group">
                    <?php echo $form->labelEx($templateUp, 'archive');?>
                    <?php echo $form->fileField($templateUp, 'archive', $templateUp->getHtmlOptions('archive')); ?>
                    <?php echo $form->error($templateUp, 'archive');?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($templateUp, 'inline_css');?>
                    <?php echo $form->dropDownList($templateUp, 'inline_css', $templateUp->getInlineCssArray(), $templateUp->getHtmlOptions('inline_css')); ?>
                    <div class="help-block"><?php echo $templateUp->getAttributeHelpText('inline_css');?></div>
                    <?php echo $form->error($templateUp, 'inline_css');?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($templateUp, 'minify');?>
                    <?php echo $form->dropDownList($templateUp, 'minify', $templateUp->getYesNoOptions(), $templateUp->getHtmlOptions('minify')); ?>
                    <div class="help-block"><?php echo $templateUp->getAttributeHelpText('minify');?></div>
                    <?php echo $form->error($templateUp, 'minify');?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app', 'Close');?></button>
              <button type="button" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>" onclick="$('#upload-template-form').submit();"><?php echo Yii::t('email_templates',  'Upload archive');?></button>
            </div>
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
