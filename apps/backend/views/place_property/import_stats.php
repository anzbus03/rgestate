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
<div class="row spl-row" style="margin-left: -15px;margin-right: -15px;">
    <style>
       .spl-row .bg-info {
    background-color: #17a2b8!important;color:#fff;
}.spl-row .bg-success {
    background-color: #28a745!important;color:#fff;
}.spl-row .bg-warning {
    background-color: #ffc107!important;color:#fff;
}
.spl-row .bg-danger {
    background-color: #dc3545!important;color:#fff;
}
    </style>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo (int) $total_imported;?></h3>

                <p>Total Imported</p>
              </div>
          
               
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box  bg-warning">
              <div class="inner">
                <h3><?php echo (int) $total_imported_today;?></h3>

                <p>Total Imported Today</p>
              </div>
             
            
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box  bg-danger">
              <div class="inner">
                <h3><?php echo $total_imported_finder;?></h3>

                <p>Total PropertyFinder</p>
              </div>
    
               
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box  bg-success">
              <div class="inner">
                <h3><?php echo $total_imported_bayut;?></h3>

                <p>Total Bayut</p>
              </div>
            
               
            </div>
          </div>
          <!-- ./col -->
        </div>
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?>
                </h3>
            </div>
            <div class="pull-right">
                  <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/import_stats'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
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
                    'ajaxUpdate'           =>false,
                    'id'                => $model->modelName.'-grid',
                    'dataProvider'      => $model->import_stats(),
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
                            'name'  => 'company_name',
                            'value' => '@$data->company_name' ,
                            'type'=>'raw'
                        ),
                          array(
                            'name'  => 'propertyFinder_properties',
                            'value' => '@$data->PropertyFinderCount' ,
                            'filter'=>false,
                            'type'=>'raw'
                        ),
                        array(
                            'name'  => 'bayut_properties',
                            'value' => '@$data->BayutCount' ,
                               'filter'=>false,
                               'type'=>'raw',
                                'footer'    => $model->paginationOptions->getGridFooterPagination(),
                        ),
                     
                      //more code heere
                        
                      
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
    <style>
        #openIframe{ display:none;}
       .opendIframe #openIframe {
    display: block;position:relative;
    height: 90vh;
    width: 90%;
    background-color: #fff;
    position: fixed;
    z-index: 11111;
    left: 0;
    right: 0;
    top: 0;
    border: 0;
    margin: auto;
    top: 5vh;
    bottom: 5vh;
        box-shadow: 0 1px 6px 0 rgb(32 33 36 / 28%);
        max-width:800px;
   
}  html.opendIframe  {     overflow:hidden; min-height:!00vh;height:100vh;}
  .opendIframe body:before {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: rgba(0,0,0,0.3);
    z-index: 1111;
}
    </style>
 <iframe src="" id="openIframe"></iframe>
 <script>
     
     function openIframe(k){
      var datauri =$(k).attr('data-link');
      if(datauri!=undefined){
          document.getElementById("openIframe").src=datauri;
          $('html').addClass('opendIframe');
      }
     }
      function closePopupAdm(k){
          $('html').removeClass('opendIframe');
       $('#openIframe').html('');
     }
     function openLink(k){
           var datauri =$(k).attr('datalink');window.open(datauri, "_blank")
           
     }
 </script>

