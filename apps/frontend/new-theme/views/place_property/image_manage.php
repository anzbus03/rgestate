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
                    <span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?>
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
            ?>
            
            <?
             $form=$this->beginWidget('CActiveForm', array( 
			 'enableAjaxValidation'=>true,
			 "id"=>"MyForm"
			 ));  
			 
			
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl("place_an_ad/image_management",array("id" => $id)),
                    'id'                => $user->modelName.'-grid',
                    'dataProvider'      => $user->listImage($id),
                    'filter'            => $user,
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
                            'name'  => 'id',
                             'type'  => 'raw',
                             'value' =>  'CHtml::checkbox("id[$data->id]",false,array("style"=>"width:10px;text-align:center","class"=>"dis"))' ,
                             'filter'=>false,
                             'htmlOptions'=>array("style"=>"width:10px;text-align:center","class"=>"form-controll"),
                        ),
                        array(
                            'name'  => 'image_name',
                             'type'  => 'raw',
                            'value' =>  'CHtml::image( $data->imageLink   ,"no Image Found",array("style"=>"width:50px;height:50px"))' ,
                             'filter'=>false,
                        ),
                      
                        array(
                            'name'  => 'status',
                             'type'  => 'raw',
                             'value' =>  function($data){
								      if($data->status==="A")
								            {
												 
										      echo "<span class='glyphicon glyphicon-ok'></span>";
										    }
										    else
										   {
											   
											    echo "<span class='glyphicon glyphicon-remove'></span>" ; 
											}
											 
										},
                             'filter'=> $user->activeArray(),
                            'htmlOptions'=>array("style"=>"width:150px;text-align:center","class"=>"form-controll"),
                             'filter'=>false,
                        ),
                             array(
            'name'=>'priority',
            'type'=>'raw',
             
            'value'=>'CHtml::textField("priority[$data->id]",$data->priority,array("style"=>"width:50px;text-align:center","class"=>"form-controll"))',
            'htmlOptions'=>array("style"=>"width:50px;text-align:center","class"=>"form-controll"),
        ),
                      
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $user->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                 
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-remove-circle"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete_image_db", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                                'ban' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-ban-circle"></span> &nbsp; ', 
                                    'url'       => ' Yii::app()->createUrl("'.Yii::app()->controller->id.'/approve", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Block Image'), 'class' => 'Block',
                                    
                                    ),
                                   'visible'   => '$data->status === "A"',
                                ),    
                                'app' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-ok-circle"></span> &nbsp; ', 
                                    'url'       => ' Yii::app()->createUrl("'.Yii::app()->controller->id.'/approve", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Enable Image'), 'class' => 'Enable',
                                    
                                    
                                    
                                    ),
                                   'visible'   => '$data->status === "I"',
                                ),    
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:70px;',
                            ),
                            'template' => ' {delete}{ban}{app}'
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
			<button type="button" class="btn btn-primary  btn-xs  approve-button" ><?php echo Yii::t('app', 'Approve selected');?></button>
			<button type="button" class="btn btn-primary btn-xs disaaprove-button" ><?php echo Yii::t('app', 'Disapprove selected');?></button>
			<button type="button" class="btn btn-primary btn-xs approve-all" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Approve all');?></button>
			<button type="button" class="btn btn-primary btn-xs diapprove-all" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Disapprove all');?></button>
			<button type="submit" class="btn btn-primary btn-xs btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update priority');?></button>
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
 <script>
 
 $('.disaaprove-button').click(function(event){
       event.preventDefault();
        var atLeastOneIsChecked = $('.dis:checked').length > 0;

        if (!atLeastOneIsChecked)
        {
                alert('Please select atleast one Image to disapprove');
        }
        else 
        {
                document.getElementById('MyForm').action='<?php echo $this->createUrl("place_an_ad/disapprove",array("id" => $id));?>';
                document.getElementById('MyForm').submit();
        }
});
 $('.approve-button').click(function(event){
       event.preventDefault();
        var atLeastOneIsChecked = $('.dis:checked').length > 0;

        if (!atLeastOneIsChecked)
        {
                alert('Please select atleast one Image to Approve');
        }
        else  
        {
                document.getElementById('MyForm').action='<?php echo $this->createUrl("place_an_ad/approve_selected",array("id" => $id));?>';
                document.getElementById('MyForm').submit();
        }
});
 $('.approve-all').click(function(event){
              event.preventDefault();
              window.location='<?php echo $this->createUrl("place_an_ad/approve_all",array("id" => $id));?>';
        
});
 $('.diapprove-all').click(function(event){
              event.preventDefault();
              window.location='<?php echo $this->createUrl("place_an_ad/dispprove_all",array("id" => $id));?>';
        
});
 

 </script>
 

