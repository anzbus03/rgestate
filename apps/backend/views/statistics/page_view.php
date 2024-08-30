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
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t('hotel', $pageHeading);?>
                </h3>
            </div>
              <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
		 
           <a href="javascript:void(0)" data-href="<?php echo Yii::app()->createUrl($this->id.'/delete_page_view',array('opt'=>'all'));?>" onclick="deletefunction(this)" class="btn btn-danger">Delete All</a>
		 <a href="javascript:void(0)" class="btn btn-warning" data-href="<?php echo Yii::app()->createUrl($this->id.'/delete_page_view',array('opt'=>'30'));?>" onclick="deletefunction(this)">Keep 30 days Delete All</a>
		 <script>
		 function deletefunction(k){
			 var conf = confirm('Are you sure to delete?');
			 if(conf){
				 var urlload = $(k).attr('data-href');
				 if(urlload!== undefined ){
					 $(k).html('Processing...')
					 $.get(urlload,function(data){ if(data=='1'){  location.reload(); 	 }  })
				 }
			 }
		 }
		 </script>
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
                    'ajaxUrl'           => $this->createUrl($this->id.'/'.$this->action->id),
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
                            'name'  => 'pid',
                            'value' => '@$data->previewUrlTrashB' ,
                            'type'=>'raw',
                        ),
                        array(
                            'name'  => 'ip',
                            'value' => '@$data->IpDetail' ,
                             'type'=>'raw',
                            'filter'=>false
                        ),
                          array(
                            'name'  => 'user_id',
                            'value' => '@$data->userDetails' ,
                            'type'=>'raw',
                        ),
                        
                        array(
                            'name'  => 'date',
                            'value' => '@$data->DateDetail' ,
                             'filter'=>false
                        ),
                        
                      
                        array(
                            'name'  => 'count',
                            'value' => '@$data->count' ,
                              'filter'=>false
                        ),
                        
                        
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $user->paginationOptions->getGridFooterPagination(),
                            'template' =>'',
                          
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
