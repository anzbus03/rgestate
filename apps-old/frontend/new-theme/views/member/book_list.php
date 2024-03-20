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
            <div class="row">
            <div class="col-sm-12">
                <h3 class="pageHeading"><?php echo $this->tag->getTag('book_an_appointment','Book an appointment');?>                 </h3>
            </div>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
           
                
            	 
				 
            </ul>
         <div class="clearfix"><!-- --></div>
	 
		 <div class="clearfix"><!-- --></div>
        <div class="box-body padding-bottom-50">
            <div class="table-responsive">
            <?php 
      
     $name =  $model->getAttributeLabel('name');$ad_title =  $model->getAttributeLabel('package_id');
            $email =  $model->getAttributeLabel('email');
            $phone =  $model->getAttributeLabel('phone');
            $date_added =  $model->getAttributeLabel('date_added');
           
                
              $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                     'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->search(),
                    'filter'            => $model,
                    'filterPosition'    => '',
                       'emptyText' => $this->tag->getTag('no_results_found!','No results found.'),
                     'summaryText' => $this->tag->getTag('displaying_{start}-{end}_of_{c','Displaying {start}-{end} of {count} results.'),
                 
                    'filterCssClass'    => 'grid-filter-cell',
                    'itemsCssClass'     => 'table table-bordered border mb-0 align-items-center',
                    'selectableRows'    => 0,
                     'summaryText' => '',
                      'emptyText' => 'No results found.' ,
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
                            'name'  => 'date',
                            'value' => '$data->DateAddedShort' ,
                            'type'=>'raw',
                            'filter' => false,
                             'htmlOptions'=>array('data-title'=> $ad_title),
                           
                        ),
                        array(
                            'name'  => 'package_id',
                            'value' => '$data->PackageDetail' ,
                            'type'=>'raw',
                             'htmlOptions'=>array('data-title'=> $ad_title),
                           
                        ),
                        array(
                            'name'  => 'name',
                            'value' => '@$data->name' ,
                            'htmlOptions'=>array('data-title'=> $name),
                        ),
                        array(
                            'name'  => 'email',
                            'value' => '@$data->email' ,
                             'htmlOptions'=>array('data-title'=> $email),
                            
                        ),
                        array(
                            'name'  => 'phone',
                            'value' => '"<span dir=ltr>".@$data->phone."</span>"' ,
                             'htmlOptions'=>array('data-title'=> $phone),
                             'type'=>'raw'
                            
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
 
 <script>
 
 $("#iframe").fancybox({
    'width'         : '600px',
    'title'			:"View",
    'autoScale'     : false,
    'transitionIn'  : 'none',
    'transitionOut' : 'none',
    'type'          : 'iframe',
    'titleShow'		: false,
});
 </script>
 <style>
 .fancybox-overlay { z-index:9999999999999 !important; }
 .fancybox-skin { background :#fff; }
 ::after, ::before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
} 
.fancybox-slide--iframe .fancybox-content {
    background: #fff;
    max-width: 500px;
    overflow: hidden;
    max-height: 81vh;
}.sml-header.owner{ display:none; }
 </style>
