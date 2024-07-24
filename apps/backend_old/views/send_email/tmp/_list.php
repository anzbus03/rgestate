	<div class="clearfix"  ></div>
    <div class="col-md-12 no-padding detail activityDetail streamWidget" id="viewmode-data" > 
 
<?php
 
             
            // and render if allowed
            if ($collection->renderGrid) {
				 $gridId = $model->gridId;
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                =>  $gridId,
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
						'name'=>'email', 
						'value'=>'@$data->PrimaryEmail',
						'type'=>'raw',
						'filter'=>false,
					 
						),
                     
                      
                        array(
                            'name'  => 'status',
                            'value' => '$data->StatusTitle',
                            'filter'=> false,
                               
                        ),
                     
                          
                      
                    ), $this),
                ), $this)); 
            }
             ?>
       </div> 
 
