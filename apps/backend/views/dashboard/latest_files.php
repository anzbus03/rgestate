<div class="container-fluid">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="table-responsive">
                <script>
                    function setTagThis(k, id) {
                        $('#<?php echo $model->modelName; ?>_' + id).val($(k).val()).change();
                    }
                </script>
                <style>
                    .grid-filter-cell {
                        display: none;
                    }
                </style>
                <?php
                /**
                 * This hook gives a chance to prepend content or to replace the default grid view content with a custom content.
                 * Please note that from inside the action callback you can access all the controller view
                 * variables via {@CAttributeCollection $collection->controller->data}
                 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderGrid} to false
                 * in order to stop rendering the default content.
                 * @since 1.3.3.1
                 */

                // and render if allowed

                $this->widget('zii.widgets.grid.CGridView', array(
                    'ajaxUrl' => $this->createUrl('dashboard/LatestCustomer'),
                    'ajaxUpdate' => $model->modelName . '-grid',
                    'id' => $model->modelName . '-grid',
                    'dataProvider' => $model->latestFiles2(10),
                    'filter' => $model,
                    'summaryText' => '',
                    'filterPosition' => 'body',
                    'filterCssClass' => 'grid-filter-cell',
                    'itemsCssClass' => 'table table-bordered table-striped',
                    'selectableRows' => 0,
                    'enableSorting' => false,
                    'cssFile' => false,

                    'columns' => array(
                        array(
                            'name' => 'date',
                            'value' => '@$data->TitleSectD2',
                            'filter' => false,
                            'type' => 'raw',
                            'htmlOptions' => array('style' => 'width:120px;')
                        ),
                        array(
                            'name' => 'ad_title',
                            'value' => 'CHtml::Link(@$data->AdTitleWithIcons,"javascript:void(0)",array("onclick"=>"openUrlFUll(this)","data-url"=>$data->PreviewUrlTrash))',
                            'type' => 'raw',
                        ),
                        array(
                            'name' => 'status',
                            'value' => '$data->statusLink',
                            'filter' => $model->statusArray(),
                            'htmlOptions' => array("width" => "80px", "style" => "text-align:center;"),
                            'type' => 'raw',
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'header' => Yii::t('app', '-'),
                            // 'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons' => array(
                                'delete' => array(
                                    'label' => ' &nbsp; <span class="fa fa-trash-o"></span> &nbsp; ',
                                    'url' => 'Yii::app()->createUrl("place_an_ad/delete", array("id"=>$data->id))',
                                    'imageUrl' => null,
                                    'options' => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                    // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:50px;',
                            ),
                            'template' => ' {delete} '
                        ),
                    ),
                ));
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
