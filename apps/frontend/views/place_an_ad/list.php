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
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo $title;?>
                </h3>
            </div>
            
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
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
                    'ajaxUpdate'        =>$model->modelName.'-grid',
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                    'filter'            => $model,
                    'filterPosition'    => 'body',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table  table-striped',
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
                            'name'  => 'date_added',
                            'value' => '@$data->SmallDate' ,
                            'htmlOptions'=>array("width"=>"120px","style"=>"text-align:center;"),
                            'filter'=>false,
                        ),
                        array(
                            'name'  => 'ad_title',
                            'value' => 'CHtml::Link(@$data->AdTitleWithIcons,Yii::app()->createUrl("place_an_ad/update",array("id"=>$data->id)))' ,
                            'type' => 'raw' ,
                        ),
                        
                        array(
                            
                            'name'  => 'country_name',
                            'value' => '@$data->CountryNameSection' ,
                            'htmlOptions'=>array("width"=>"200px"),
                            'type'=>'raw',
                            
                        ),
                        array(
                            
                            'name'  => 'section_id',
                            'value' => '@$data->section->section_name' ,
                            'htmlOptions'=>array("width"=>"150px"),
                            'filter'=>false,
                        ),
                        array(
                            
                            'name'  => 'category_id',
                            'value' => '@$data->category->category_name' ,
                            'htmlOptions'=>array("width"=>"150px"),
                            'filter'=>false,
                        ),
                      
                   array(
                            'name'  => 'status',
                            'value' => '$data->StatusLinkFront',
                            'filter'=>false,
                            'htmlOptions'=>array("width"=>"50px","style"=>"text-align:center;"),
                            'type'  => 'raw',
                        ),
                       
                              
                         
                       
                        
					
					 
                      
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'buttons'   => array(
                                    'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-edit"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/update", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                   'view' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-eye"></span> &nbsp;', 
                                    'url'       =>'Yii::app()->createUrl("details/index",array("slug"=>$data->slug))."?showTrash=1"',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'View'), 'class' => ''    ),
                                   
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-trash-o"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id"=>$data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            
                                   'ban' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-ban"></span> &nbsp; ', 
                                     'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/status",array("id"=>$data->id,"status"=>$data->status))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Inactive AD'), 'class' => 'Block',  
                                    ),
                                    
                                ),    
                            
                             
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:150px;',
                            ),
                            'template' => '{ban} {update}{delete}'
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
             <div class="clearfix"><!-- --></div>
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
?>
 
