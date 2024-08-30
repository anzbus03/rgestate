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
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
            <div class="pull-right">
				<?php echo CHtml::link(Yii::t('app', '<i class="fa fa-keyboard-o"></i> Arabic Bulk Update'), Yii::app()->createUrl(Yii::app()->controller->id.'/index',array('bulk_update'=>'1','lan'=>'ar')), array('class' => 'btn btn-default btn-xs' , 'title' => Yii::t('app', 'Goole Translate Arabic')));?>
                
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
            <div id="google_translate_element" class="pull-right"></div>
            <div class="table-responsive">
                <?php 
                $hooks->doAction('before_grid_view', $collection = new CAttributeCollection(array(
                    'controller'    => $this,
                    'renderGrid'    => true,
                )));
                
                if ($collection->renderGrid) {
                    ?>
                <table id="datatable-grid" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('app', 'Name'); ?></th>
                            <th><?php echo Yii::t('app', 'Country'); ?></th>
                            <th><?php echo Yii::t('app', 'Priority'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->search()->getData() as $data) { ?>
                            <tr>
                                <td><?php echo CHtml::encode($data->name); ?></td>
                                <td><?php echo CHtml::encode($data->country_name); ?></td>
                                <td><?php echo CHtml::textField("priority[$data->region_id]", $data->priority, array("style"=>"width:50px;text-align:center","class"=>"form-control")); ?></td>
                                <td>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/update')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->region_id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                                    <?php } ?>
                                    <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')) { ?>
                                        <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->region_id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="btn btn-xs btn-danger delete"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                }
                $hooks->doAction('after_grid_view', new CAttributeCollection(array(
                    'controller'    => $this,
                    'renderedGrid'  => $collection->renderGrid,
                )));
                ?>
            </div>  
            <div class="box-footer">
			<div class="pull-right m-4" >
			<button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update Priority');?></button>
			</div>
			<div class="clearfix"><!-- --></div>
			</div>
		 
        </div>
    </div>
    <script>
          $(document).ready(function() {
            $('#datatable-grid').DataTable({
                language: {
                    paginate: {
                        next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                        previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
                    }
                }
            });
        });
    </script>
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
?>
 
 
