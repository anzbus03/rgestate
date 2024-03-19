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
         <div class="clearfix"><!-- --></div>
	 
		 <div class="clearfix"><!-- --></div>
        <div class="box-body">
            <div class="table-responsive">
            <?php 
      
            
         
                $this->widget('zii.widgets.grid.CGridView',   array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'ajaxUpdate'        =>$model->modelName.'-grid',
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                    'filter'            => $model,
                    'filterPosition'    => '',
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
                    'columns' =>  array(
                    	 
                        array(
                            'name'  => 'url',
                            'value' => 'CHtml::Link(@$data->DetailUrl,$data->DetailUrl)' ,
                            'type' => 'raw' ,
                        ),
                        
                        
					 
                      
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'buttons'   => array(
                                     
                                   'view' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-eye"></span> &nbsp;', 
                                    'url'       =>'$data->DetailUrl',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'View'), 'class' => '' ,'target'=>'_blank'   ),
                                   
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa  fa-trash-o"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete_save", array("id"=>$data->date_added))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            
                               
                            
                             
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:100px;',
                            ),
                            'template' => '{view}{delete}'
                        ),
                     ),
                ) ); 
            }
            /**
             * This hook gives a chance to append content after the grid view content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * @since 1.3.3.1
             */
         
            ?>
            <div class="clearfix"><!-- --></div>
            </div>    
             <div class="clearfix"><!-- --></div>
		 </div>
        </div>
    </div>
<?php 
 
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
 
?>
 
