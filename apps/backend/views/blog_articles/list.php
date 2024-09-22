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
</style>
<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h3 class="card-title">
                <span class="glyphicon glyphicon-book"></span> <?php echo Yii::t('articles', 'Blogs'); ?>
            </h3>
        </div>
        <div class="pull-right">
            <?php echo CHtml::link(Yii::t('app', 'Create new'), array('blog_articles/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new'))); ?>
            <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('blog_articles/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh'))); ?>
        </div>
        <div class="clearfix">
            <!-- -->
        </div>
    </div>
    <div class="card-body">
        <!-- Form to wrap the table and submit the priority updates -->
        <form method="post"
            action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id . '/blog_articles'); ?>">

            <!-- CSRF Protection -->
            <?php if (Yii::app()->request->enableCsrfValidation) { ?>
            <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
            <?php } ?>
            <div class="table-responsive">
                <table id="blogs-datatable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><?php echo Yii::t('articles', 'Title'); ?></th>
                            <th><?php echo Yii::t('articles', 'Status'); ?></th>
                            <th><?php echo Yii::t('articles', 'Date Added'); ?></th>
                            <th><?php echo Yii::t('articles', 'Last Updated'); ?></th>
                            <th><?php echo Yii::t('app', 'Options'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($article->search()->getData() as $data) { ?>
                        <tr>
                            <td><?php echo $data->title; ?></td>
                            <td><?php echo $data->statusText; ?></td>
                            <td><?php echo $data->dateAdded; ?></td>
                            <td><?php echo $data->lastUpdated; ?></td>
                            <td>
                                <a href="<?php echo $data->permalink; ?>" title="<?php echo Yii::t('app', 'View'); ?>"
                                    target="_blank" class="btn btn-xs btn-info">
                                    <span class="fa fa-eye"></span>
                                </a>
                                <a href="<?php echo Yii::app()->createUrl('blog_articles/update', array('id' => $data->article_id)); ?>"
                                    title="<?php echo Yii::t('app', 'Update'); ?>" class="btn btn-xs btn-warning">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                <a href="javascript:void(0);" data-id="<?php echo $data->article_id; ?>"
                                    title="<?php echo Yii::t('app', 'Delete'); ?>"
                                    class="btn btn-xs btn-danger delete-article">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#blogs-datatable').DataTable({
        "pagingType": "full_numbers",
        "order": [], // Disable initial sorting
        "columnDefs": [{
                "orderable": false,
                "targets": 4
            } // Disable sorting for the Options column
        ],
        language: {
            paginate: {
                next: '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',
                previous: '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>'
            }
        }
    });
});
</script>


<!-- generate post method to delete data  -->
<script>
$(document).ready(function() {
    var csrfToken = '<?php echo Yii::app()->request->csrfToken; ?>'; // Get CSRF token

    // Handle delete action using AJAX
    $('.delete-article').on('click', function(e) {
        e.preventDefault();

        var articleId = $(this).data('id');
        var deleteUrl = '<?php echo Yii::app()->createUrl("blog_articles/delete"); ?>';

        $.ajax({
            type: 'POST',
            url: deleteUrl,
            data: {
                id: articleId,
                YII_CSRF_TOKEN: csrfToken // Send CSRF token along with the request
            },
            success: function(response) {
                // alert('Article deleted successfully');
                location.reload(); // Optionally, refresh the page
            },
            error: function(xhr, status, error) {
                // alert('Failed to delete the article');
            }
        });

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