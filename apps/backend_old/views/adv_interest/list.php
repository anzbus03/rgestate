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
                  <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
                  <input type="text" id="dateRange" class="btn btn-default btn-xs" style="margin-left: 10px;" />
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
        <button type="button" id="exportExcel" class="btn btn-success btn-xs" style="margin-left: 10px;margin-top:10px;">Export to Excel</button>
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
                            'name'  => 'id',
                            'value' => '@$data->id' , 
                            'htmlOptions' => array('style'=>'max-width:50px;width:100px;')
                         
                        ),
                                                array(
                            'name'  => 'm_id1',
                            'value' => '@$data->master->master_name' ,
                            'filter' => CHtml::listData(Master::model()->listData(6),'master_id','master_name'),
                            'htmlOptions' => array('style'=>'max-width:150px;')
                         
                        ),

                        array(
                            'name'  => 'name',
                            'value' => '@$data->name' ,
                         
                        ),
                        array(
                            'name'  => 'email',
                            'value' => '@$data->email' ,
                         
                        ),
                        array(
                            'name'  => 'phone',
                            'value' => '@$data->phone' ,
                         
                        ),
                    
                        array(
                            'name'  => 'date',
                            'value' => '@$data->SDate' ,
                             'filter'=>false,
                        ),
                        
                          
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                               'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-eye"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/update", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                   'options'   => array('title' => Yii::t('app', 'View'), 'id' => 'iframe'),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:70px;',
                            ),
                            'template' => ' {update}{delete}'
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
			</div>
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
 
  
<script>
$(document).ready(function() {
  // Initialize the date range picker
  $('#dateRange').daterangepicker({
      locale: {
          format: 'YYYY-MM-DD'
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment(),
      ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, function(start, end, label) {
      fetchFilteredData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
  });

  // Function to fetch filtered data
  function fetchFilteredData(startDate, endDate) {
        window.location.href = '<?php echo Yii::app()->createUrl($this->route); ?>?startDate=' + startDate + '&endDate=' + endDate;

        $.ajax({
          url: '<?php echo Yii::app()->createUrl($this->route); ?>',
          type: 'GET',
          data: {
              startDate: startDate,
              endDate: endDate
          },
          success: function(data) {
              $('#<?php echo $model->modelName; ?>-grid').html($(data).find('#<?php echo $model->modelName; ?>-grid').html());
          }
      });
  }
  $('#exportExcel').click(function(e) {
    var dateRange = $('#dateRange').data('daterangepicker');
    var startDate = dateRange.startDate.format('YYYY-MM-DD');
    var endDate = dateRange.endDate.format('YYYY-MM-DD');
    var exportUrl = '<?php echo Yii::app()->createUrl('adv_interest/exportExcel'); ?>';

    if (startDate && endDate) {
        exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate);
    }

    // Redirect to the export URL
    window.location.href = exportUrl;    
  });
});
 
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
.grid-filter-cell input, .grid-filter-cell select {
 
    max-width: 200px;
}

</style>
