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
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
          <div class="clearfix"><!-- --></div>
      		 <div class="clearfix">
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
                    'id'                => $model->modelName.'-grid',
                           'ajaxUpdate'           =>false,
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
                            'name'  => 'name',
                            'value' => '@$data->name' ,
                            'filter'=>false,
                        ),
                        array(
                            'name'  => 'email',
                            'value' => '@$data->email' ,
                             'filter'=>false,
                        ),
                        array(
                            'name'  => 'phone',
                            'value' => '@$data->phone' ,
                             'filter'=>false,
                        ),
                     
                        array(
                            'name'  => 'type',
                            'value' => '@$data->type ' ,
                             
                        ),
                    
                        array(
                            'name'  => 'date_added',
                            'value' => '@$data->dateAdded' ,
                             'filter'=>false,
                        ),
                        
                       
                        
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                               'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-eye-open"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/update", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                   'options'   => array('title' => Yii::t('app', 'View'), 'id' => 'iframe1','onclick'=>'loadthis(this,event)'),
                                        'visible'   => 'AccessHelper::hasRouteAccess("'.Yii::app()->controller->id.'/update")',
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-remove-circle"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                        'visible'   => 'AccessHelper::hasRouteAccess("'.Yii::app()->controller->id.'/delete")',
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
function UpdateEmailReceivers(k){
	var id = $(k).attr('data-id');
	if(id !==undefined){
	$.get('<?php echo Yii::app()->createUrl('dashboard/get_email_receicers');?>/id/'+id,function(data){ 
					var data = JSON.parse(data);
					if(data.status=='0'){
						alert('No Email Template Found');
						
					}
					else if(data.status=='1'){
						$('#email_receivers').modal('show');
						$('#email_list').val(data.receiver_list);
					}
		})
	}
	
}
function updateReceiveList(k){
	var id = $(k).attr('data-id');
	if($('#email_list').val()==''){ alert('Please enter atleast one email address');$('#email_list').focus(); return false; }
	if(id !==undefined){
	$.post('<?php echo Yii::app()->createUrl('dashboard/set_email_receicers');?>/id/'+id,{val:$('#email_list').val()},function(data){ 
					var data = JSON.parse(data);
					if(data.status=='0'){
						alert('No Email Template Found');
						
					}
					else if(data.status=='1'){
						 alert('Updated email receivers');
					}
		})
	}
	
}
</script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Us</h4>
      </div>
      <div class="modal-body" id="html_content">
        <p>Loading...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
function loadthis(k,e){
	e.preventDefault();
	var href_url  = $(k).attr('href');
	$('#myModal').modal('show');$('#html_content').html('<p>Loading..</p>');
	$.get(href_url,function(data){ $('#html_content').html(data); })
}

</script>