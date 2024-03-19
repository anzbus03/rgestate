<?php defined('MW_PATH') || exit('No direct script access allowed');  ?>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                         <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-star"></span> My Uploads Premium downloads
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/premium_downloads'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
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
            
            // and render if allowed
         
              $this->widget('zii.widgets.grid.CGridView',   array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'id'                => $order->modelName.'-grid',
                    'dataProvider'      => $order->searchPremium(),
                    'filter'            => $order,
                    'filterPosition'    => '',
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
                    'columns' =>   array(
                        array(
                            'name'  => 'order_uid',
                            'value' => '$data->uid',
                            'type'  => 'raw',
                        ),
                     
                        array(
                            'name'  => 'ad_id',
                            'value' => 'CHtml::link($data->ad->ad_title,$data->ad->PreviewUrlTrash,array("target"=>"_blank"))',
                            'type'  => 'raw',
                        ),
                       
                        array(
                            'name'  => 'total',
                            'value' => '$data->formattedTotal',
                        ),
                        array(
                            'name'  => 'status',
                            'value' => '$data->getStatusName()',
                            'filter'=> $order->getStatusesList(),
                        ),
                        array(
                            'name'  => 'date_added',
                            'value' => '$data->dateAdded',
                            'filter'=> false,
                        ),
                
                    ) ,
                ) );  
            
            /**
             * This hook gives a chance to append content after the grid view content.
             * Please note that from inside the action callback you can access all the controller view
             * variables via {@CAttributeCollection $collection->controller->data}
             * @since 1.3.3.1
             */
           
            ?>
               <div class="clearfix"><!-- --></div>
            </div>    
            
		 </div>
       
        </div>
    

                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>
     
      </div> 
 
 

