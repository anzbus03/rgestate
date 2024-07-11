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
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t('hotel', 'Customers List');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array('listingusers/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array('listingusers/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
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
           
			$this->widget('common.components.web.widgets.GridViewBulkAction', array(
			'model'      => $user,
			'formAction' => $this->createUrl('listingusers/bulk_action'),
			));
			 
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $user->modelName.'-grid',
                    'dataProvider'      => $user->search(),
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
                            'class'               => 'CCheckBoxColumn',
                            'name'                => 'user_id',
                            'selectableRows'      => 100,  
                            'checkBoxHtmlOptions' => array('name' => 'bulk_item[]'),
                        ),
                         array(
                            'name'  => 'date',
                            'value' => '@$data->dateAdded' ,
                            'filter'=>false,
                            'htmlOptions'=>array('style'=>'text-align:center;width:70px;')
                        ),
                        array(
                            'name'  => 'user_name',
                            'value' => '@$data->first_name." ".@$data->last_name' ,
                        ),
                        array(
                            'name'  => 'email',
                            'value' => '@$data->email." ".@$data->checkVerifiedLink',
                            'type'=>'raw',
                        ),
                    
                             array(
                            'name'  => 'package_id',
                            'value' => '@$data->Package->name',
                            'filter'=> PricePlan::model()->listData(),
                        ),
                        array(
                            'name'  => 'package_expiry_date',
                            'value' => '$data->expire',
                            'type' => 'raw',
                            'filter'=> array('1'=>'Expired 1-30 days','2'=>'Expired 30-60 days','3'=>'60+ days',),
                        ),
                   
                        
                       
                        array(
                            'name'  => 'registered_via',
                            'value' => '@$data->registered_via',
                            'filter'=> array('ON_SITE'=>'MANUAL','FACEBOOK'=>'FACEBOOK'),
                            
                        ),
                        array(
                            'name'  => 'status',
                              'value' => '$data->getStatusWithStats($data->status)',
                             'filter'=> $user->activeArray(),
                            
                        ),
                      
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $user->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                            	'impersonate' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-random"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("listingusers/impersonate", array("id" => $data->user_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Login as this user'),'target'=>'_blank', 'class' => ''),
                                ), 
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("listingusers/update", array("id" => $data->user_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("listingusers/delete", array("id" => $data->user_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:100px;',
                            ),
                            'template' => '{impersonate}{update} {delete}'
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
function resentEmail(k){
	var ID = $(k).attr('data-id');
	if(ID !== undefined ){
		$(k).button('loading');
		$.get('<?php echo Yii::App()->createUrl('listingusers/resentEmail');?>/id/'+ID,function(data){ 
					var data = JSON.parse(data);
					if(data.status=='success'){
						$(k).text('Sent'); 
					}
					else{
						alert(data.message);
					}
			 } )
	}
}
</script>