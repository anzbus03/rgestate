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
    <div class="box box-primary savedUrl">
          <div class="box-header">
            <div class="pull-left">
                <h3 class="pageHeading">
                   <?php echo $this->tag->getTag('mortgage_-_application','Mortgage - Application');?>  
                
                </h3>
            </div>
            
            <div class="clearfix"><!-- --></div>
        </div>
     
           <div class="clearfix"><!-- --></div>
	 <style>
	 .owner { display:none !important; }
	 </style>
		 <div class="clearfix"><!-- --></div>
        <div class="box-body padding-bottom-50">
            <div class="table-responsive">
            <?php 
      
    
                
              $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                     'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                    'filter'            => $model,
                    'filterPosition'    => '',
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered border mb-0 align-items-center',
                    'selectableRows'    => 0,
                     'summaryText' => '',
                      'emptyText' => 'No results found.' ,
                             'emptyText' => $this->tag->getTag('no_results_found!','No results found.'),
                     'summaryText' => $this->tag->getTag('displaying_{start}-{end}_of_{c','Displaying {start}-{end} of {count} results.'),
               
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
                            'value' => '@$data->DateAddedShort' ,
                             'filter'=>false,
                        ),
                         array(
                            'name'  => 'reference',
                            'value' => '@$data->reference' ,
                        ),
                         array(
                            'name'  => 'company',
                            'value' => '@$data->bank->bank_name' ,
                              'filter'=>false,
                        ),
                         array(
                            'name'  => 'property_detail',
                            'value' => '@$data->MortgageDetails' ,
                              'filter'=>false,
                              'type'=>'raw'
                        ),
                       
                        array(
                            'name'  => 'statusm',
                            'value' => '@$data->statusTitle' ,
                            'filter' => array(''=>'All') + $model->status_array() 
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
         
            ?>
            <div class="clearfix"><!-- --></div>
            </div>    
             <div class="clearfix"><!-- --></div>
		 </div>
       
<?php 
 
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
 
?>
 
 
 <style>
 .fancybox-overlay { z-index:9999999999999 !important; }
 .fancybox-skin { background :#fff; }
 </style>
