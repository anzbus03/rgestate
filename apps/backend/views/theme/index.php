<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3
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
    <ul class="nav nav-tabs" style="border-bottom: 0px;">
        <?php foreach ($apps as $appName) {?>
        <li class="<?php echo $app == $appName ? 'active' : 'inactive';?>"><a href="<?php echo $this->createUrl('theme/index', array('app' => $appName))?>"><?php echo CHtml::encode(Yii::t('app', ucfirst($appName)));?></a></li>
        <?php } ?>
    </ul>
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-plus-sign"></span> <?php echo Yii::t('themes', 'Available themes');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('themes', 'Upload theme'), '#theme-upload-modal', array('class' => 'btn btn-primary btn-xs', 'data-toggle' => 'modal', 'title' => Yii::t('themes', 'Upload theme')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('theme/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <?php 
            /**
             * This hook gives a chance to prepend content or to replace the default grid view content with a custom content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderGrid} to false 
             * in order to stop rendering the default content.
             * @since 1.3.3.1
             */
            $hooks->doAction('before_grid_view', $collection = new CAttributeCollection(array(
                'controller'    => $this,
                'renderGrid'    => true,
            )));
            
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $model->modelName . '-grid',
                    'dataProvider'      => $model->getDataProvider($app),
                    'filter'            => null,
                    'filterPosition'    => 'body',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered table-hover table-striped',
                    'selectableRows'    => 0,
                    'enableSorting'     => false,
                    'cssFile'           => false,
                    'pager'             => false,
                    'columns' => $hooks->applyFilters('grid_view_columns', array(
                        array(
                            'name'  => Yii::t('themes', 'Name'),
                            'value' => '$data["name"]',
                            'type'  => 'raw',
                        ),
                        array(
                            'name'  => Yii::t('themes', 'Description'),
                            'value' => '$data["description"]',
                            'type'  => 'raw',
                        ),
                        array(
                            'name'  => Yii::t('themes', 'Version'),
                            'value' => '$data["version"]',
                        ),
                        array(
                            'name'  => Yii::t('themes', 'Author'),
                            'value' => '$data["author"]',
                            'type'  => 'raw',
                        ),
                        array(
                            'name'  => Yii::t('themes', 'Website'),
                            'value' => '$data["website"]',
                            'type'  => 'raw',
                        ),
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'afterDelete'=> 'function(){window.location.reload();}',
                            'buttons'    => array(
                                'page' => array(
                                    'label'     => '<i class="fa fa-eye"></i>', 
                                    'url'       => '$data["pageUrl"]',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('themes', 'Extension detail page'), 'class'=>'btn btn-xs'),
                                    'visible'   => '$data["enabled"] && !empty($data["pageUrl"])',
                                ),
                                'enable' => array(
                                    'label'     => '<i class="glyphicon glyphicon-ok"></i>', 
                                    'url'       => '$data["enableUrl"]',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Enable'), 'class'=>'btn btn-xs'),
                                    'visible'   => '!$data["enabled"]',
                                ),
                                'disable' => array(
                                    'label'     => '<i class="glyphicon glyphicon-ban-circle"></i>', 
                                    'url'       => '$data["disableUrl"]',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Disable'), 'class'=>'btn btn-xs'),
                                    'visible'   => '$data["enabled"] && $data["canDisable"]',
                                ),   
                                'delete' => array(
                                    'label'     => '<i class="glyphicon glyphicon-remove"></i>', 
                                    'url'       => '$data["deleteUrl"]',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class'=>'btn btn-xs delete'),
                                     'visible'   => '$data["canDelete"]',
                                ),   
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:110px;',
                            ),
                            'template' => '{enable} {disable} {delete}'
                        ),
                    ), $this),
                ), $this));  
            }
            /**
             * This hook gives a chance to append content after the grid view content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * @since 1.3.3.1
             */
            $hooks->doAction('after_grid_view', new CAttributeCollection(array(
                'controller'    => $this,
                'renderedGrid'  => $collection->renderGrid,
            )));
            ?>
            <div class="clearfix"><!-- --></div>
            </div>    
        </div>
    </div>
    
    <div class="modal fade" id="theme-upload-modal" tabindex="-1" role="dialog" aria-labelledby="theme-upload-modal-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><?php echo Yii::t('themes', 'Upload theme archive.')?></h4>
            </div>
            <div class="modal-body">
                 <div class="callout callout-info">
                     <?php echo Yii::t('themes', 'Please note that only zip files are allowed for upload.')?>
                 </div>
                <?php 
                $form = $this->beginWidget('CActiveForm', array(
                    'action'        => array('theme/upload', 'app' => $app),
                    'id'            => $model->modelName.'-upload-form',
                    'htmlOptions'   => array('enctype' => 'multipart/form-data'),
                ));
                ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'archive');?>
                    <?php echo $form->fileField($model, 'archive', $model->getHtmlOptions('archive')); ?>
                    <?php echo $form->error($model, 'archive');?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app', 'Close');?></button>
              <button type="button" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>" onclick="$('#<?php echo $model->modelName;?>-upload-form').submit();"><?php echo Yii::t('app', 'Upload archive');?></button>
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
