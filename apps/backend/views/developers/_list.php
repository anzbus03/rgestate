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
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t('hotel', 'Developers List');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array($this->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
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
            $form=$this->beginWidget('CActiveForm');  
            // and render if allowed
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
                            'name'  => 'user_name',
                            'value' => '@$data->first_name." ".@$data->last_name' ,
                        ),
                        array(
                            'name'  => 'email',
                            'value' => '@$data->email'
                        ),
                        array(
                            'name'  => 'phone',
                            'value' => '@$data->phone'
                        ),
                        
                       
                        array(
                            'name'  => 'country_id',
                            'value' => '@$data->country_name',
                            
                        ),
                              array(
                            'name'  => 'status',
                              'value' => '$data->MemebrApproved',
                             'filter'=> $user->activeArray(),
                             'type'=>'raw'
                            
                        ),
					
                      	array(
						'name'=>'priority',
						'type'=>'raw',
						'filter'=>false,
						'value'=>'CHtml::textField("priority[$data->user_id]",$data->priority,array("style"=>"width:50px;text-align:center","class"=>"form-controll"))',
						'htmlOptions'=>array("style"=>"width:50px;text-align:center","class"=>"form-controll"),
						),
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $user->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl( "developers/update", array("id" => $data->user_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("developers/delete", array("id" => $data->user_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),   
                               'featured' => array(
                                    
                                    'label'     => ' &nbsp; <span class="glyphicon    glyphicon-star  "></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("developers/featured",array("id"=>$data->user_id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Featured'), 'class' => 'cssGridButton',
                      
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),  ),   
                                	'impersonate' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-random"></span> &nbsp;', 
                                    'url'       => '@$data->ImpersonateLink',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Login as this user'),'target'=>'_blank', 'class' => ''),
                                ), 
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:120px;',
                            ),
                            'template' => '{delete}{update}{featured}{impersonate}'
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
			<button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Update Priority');?></button>
			</div>
			<div class="clearfix"><!-- --></div>
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
function previewthis(k,e)
{
	e.preventDefault();
	var url_d = $(k).attr('href') ;
	$('#myModal').modal('show');
	$('#preview_body').html('loading...');
	$.get(url_d,function(data){ if(data){ $('#preview_body').html(data); } })
}
function updateStatus(k)
{
	 
	var url_d = $(k).attr('data-url') ;
	$.get(url_d,function(data){ if(data=='1'){  alert("Succesfully Updated");$('#myModal').modal('hide'); } })
}
</script>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">Member Preview</h4>

            </div>
            <div id="preview_body">
            
            </div>
        </div>
    </div>
</div>
