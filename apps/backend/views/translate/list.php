<?php defined('MW_PATH') || exit('No direct script access allowed');

 

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
            <div class="pull-left">
                <h3 class="card-title">
                    <span class="<?php echo OptionCommon::mastercommonIcon();?>"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
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
           
             $form=$this->beginWidget('CActiveForm', array( 
			 'enableAjaxValidation'=>true,
			 ));  
			 
			
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                    'filter'            => $model,
                    'filterPosition'    => 'body',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered table-hover table-striped',
                    'selectableRows'    => 0,
                    'enableSorting'     => false,
                    'cssFile'           => false,
                    'pagerCssClass'     => 'pagination pull-right',
                    'pager'             => array(
                        'class'         => 'CLinkPager',
                        'cssFile'       => false,
                        'header'        => false,
                        'htmlOptions'   => array('class' => 'pagination')
                    ),
                    'columns' => $hooks->applyFilters('grid_view_columns', array(
                        
                        array(
                            'name'  => 'name',
                            'value' => '@$data->name' ,
                        ),
                        array(
                            'name'  => 'name_ar',
                            'value' => '@$data->name_ar' ,
                        ),
                        array(
                            'filter'=>false,
                            'name'  => 'date_added',
                            'value' => '@$data->dateAdded' ,
                            'htmlOptions'=>array("width"=>"150px","style"=>"text-align:right;"),
                        ),
                        array(
                            'name'  => 'last_updated',
                            'value' => '@$data->lastUpdated' ,
                            'htmlOptions'=>array("width"=>"150px","style"=>"text-align:right;"),
                            'filter'=>false,
                        ),
                       
                      
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/update", array("id" => $data->rank_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id" => $data->rank_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),  
                                 'ban' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-ban-circle"></span> &nbsp; ', 
                                     'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/status",array("id"=>$data->rank_id,"status"=>$data->status))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Inactive Category'), 'class' => 'Block',  
                                    ),
                                   'visible'   => '$data->status === "A"',
                                ),    
                                'app' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-ok-circle"></span> &nbsp; ', 
                                      'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/status",array("id"=>$data->rank_id,"status"=>$data->status))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Activate Category'), 'class' => 'Enable',
                                     'ajax'=>array(
										'type'=>'GET',
										'url'=>"js:$(this).attr('href')",
										'success' => 'js:function(){$.fn.yiiGridView.update("'.$model->modelName.'-grid")}' ,
										
                     )
                                    ),
                                   'visible'   => '$data->status === "I"',
                                ),
                              
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:100px;',
                            ),
                            'template' => '{update} {delete}{ban}{app}'
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
            
			 
          <?php $this->endWidget(); ?>
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
?>
 
 

