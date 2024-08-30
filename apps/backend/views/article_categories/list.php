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
            .hide{
                display: none;
            }
        </style>
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-book"></span> <?php echo Yii::t('articles', 'Article categories');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array('article_categories/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('article_categories/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
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
                
                echo '<table id="categories-table" class="table table-bordered table-hover table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>' . CHtml::encode($category->getAttributeLabel('name')) . '</th>';
                echo '<th>' . CHtml::encode($category->getAttributeLabel('status')) . '</th>';
                echo '<th>' . CHtml::encode($category->getAttributeLabel('date_added')) . '</th>';
                echo '<th>' . CHtml::encode($category->getAttributeLabel('last_updated')) . '</th>';
                echo '<th>' . Yii::t('app', 'Options') . '</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($category->search()->getData() as $data) {
                    echo '<tr>';
                    echo '<td>' . $data->getParentNameTrail() . $data->getTranslateHtml('name') . '</td>';
                    echo '<td>' . $data->statusText . '</td>';
                    echo '<td>' . $data->dateAdded . '</td>';
                    echo '<td>' . $data->lastUpdated . '</td>';
                    echo '<td>';
                    if (AccessHelper::hasRouteAccess("article_categories/update")) {
                        echo CHtml::link('<span class="fa fa-pencil"></span>', Yii::app()->createUrl("article_categories/update", array("id" => $data->category_id)), array('class' => 'btn btn-xs btn-primary', 'title' => Yii::t('app', 'Update')));
                    }
                    if (AccessHelper::hasRouteAccess("article_categories/delete")) {
                        echo CHtml::link('<span class="fa fa-trash"></span>', Yii::app()->createUrl("article_categories/delete", array("id" => $data->category_id)), array('class' => 'btn btn-xs btn-danger delete', 'title' => Yii::t('app', 'Delete')));
                    }
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
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
    <script>
        $(document).ready(function() {
            $('#categories-table').DataTable({
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
