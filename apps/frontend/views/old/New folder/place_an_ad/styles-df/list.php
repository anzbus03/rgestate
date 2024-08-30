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
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
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
           
             $form=$this->beginWidget('CActiveForm', array( 
			 'enableAjaxValidation'=>true,
			 ));  
			 
			
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
                            'name'  => 'ad_title',
                            'value' => '@$data->ad_title' ,
                        ),
                        array(
                            
                            'name'  => 'section_id',
                            'value' => '@$data->section->section_name' ,
                            'htmlOptions'=>array("width"=>"150px"),
                            'filter'=>Section::model()->getSection(),
                        ),
                        array(
                            
                            'name'  => 'category_id',
                            'value' => '@$data->category->category_name' ,
                            'htmlOptions'=>array("width"=>"150px"),
                            'filter'=>Category::model()->getCategory(),
                        ),
                        array(
                            
                            'name'  => 'sub_category_id',
                            'value' => '@$data->subCategory->sub_category_name' ,
                            'htmlOptions'=>array("width"=>"150px"),
                            'filter'=>Subcategory::model()->getSubCategory(),
                        ),
                        array(
                            'name'  => 'added_date',
                            'value' => '@$data->added_date' ,
                            'htmlOptions'=>array("width"=>"150px","style"=>"text-align:right;"),
                            'filter'=>false,
                        ),
                        array(
                            'name'  => 'status',
                            'value' => function($data){
								      if($data->status==="A")
								            {
												 
										      echo "<span class='glyphicon glyphicon-ok'></span>";
										   }
										   else
										   {
											   
											    echo "<span class='glyphicon glyphicon-remove'></span>" ; 
											}
											 
										},
                            'filter'=>array("A"=>"Active","I"=>"Inactive"),
                            'htmlOptions'=>array("width"=>"50px","style"=>"text-align:center;"),
                            
                        ),
                       
                             array(
						'name'=>'featured',
						'type'=>'raw',
						'filter'=>false,
						'value'=>
						function($data){
								      if($data->featured==="Y")
								            {
												 
										      echo "<span class='glyphicon glyphicon-heart'></span>";
										   }
										   
											 
										},
						'filter'=>array("Y"=>"Featured","N"=>"Not Featured"),
						'htmlOptions'=>array("style"=>"width:50px;text-align:center","class"=>"form-controll"),
						),
                             array(
            'name'=>'priority',
            'type'=>'raw',
             'filter'=>false,
            'value'=>'CHtml::textField("priority[$data->id]",$data->priority,array("style"=>"width:50px;text-align:center","class"=>"form-controll"))',
            'htmlOptions'=>array("style"=>"width:50px;text-align:center","class"=>"form-controll"),
        ),
                      
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/update", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                 'view' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-eye-open"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/view", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'View'), 'class' => ''),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-remove-circle"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id"=>$data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                                'featured' => array(
                                    
                                    'label'     => ' &nbsp; <span class="glyphicon    glyphicon-star  "></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/featured",array("id"=>$data->id,"featured"=>$data->featured))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Featured'), 'class' => 'cssGridButton',
                      
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),  ),  
                                   'ban' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-ban-circle"></span> &nbsp; ', 
                                     'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/status",array("id"=>$data->id,"status"=>$data->status))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Inactive AD'), 'class' => 'Block',  
                                    ),
                                   'visible'   => '$data->status === "A"',
                                ),    
                                'app' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-ok-circle"></span> &nbsp; ', 
                                      'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/status",array("id"=>$data->id,"status"=>$data->status))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Activate AD'), 'class' => 'Enable',
                                     'ajax'=>array(
										'type'=>'POST',
										'url'=>"js:$(this).attr('href')",
										'success' => 'js:$.fn.yiiGridView.update("'.$model->modelName.'-grid")'
                     )
                                    ),
                                   'visible'   => '$data->status === "I"',
                                ),
                            
                                'image' => array(
                                    
                                    'label'     => ' &nbsp; <span class="glyphicon   glyphicon-picture  "></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/image_management", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Image Management'), 'class' => 'image',
 
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),  ),  
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:180px;',
                            ),
                            'template' => '{update}  {delete}{featured}{ban}{app}{image}'
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
            
			<div class="box-footer">
			<div class="pull-right">
			<button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update Priority');?></button>
			</div>
			<div class="clearfix"><!-- --></div>
			</div>
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
 
 

