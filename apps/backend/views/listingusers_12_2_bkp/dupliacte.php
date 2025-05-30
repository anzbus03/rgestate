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
	
	 <div id="export_generator" class="hide">
            <div style="width:100%;display:block;">
				<form   action="<?php echo Yii::app()->createUrl('listingusers/export_user');?>">
             <div class="row"  >
				 <div class="col-sm-3 form-group">
  <label for="fr_date">From Date (Date - Added):</label>
 <?php
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'datepicker',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
    ),
    'htmlOptions'=>array(
    'class'=>'form-control'
         
    ),
));
?>
  
  </div>
  <div class="col-sm-3 form-group">
	   <label for="fr_date">User Type</label>
	   <?php echo CHtml::dropDownList('u_type','',$user->getUserType(),array('class'=>'form-control','empty'=>'All Types'));?>
	  </div>
 <div class="col-sm-3 form-group">
	 <label for="pwd" style="display:block;">&nbsp;  </label>
  <button type="submit" class="btn btn-info">Export</button>
  <a href="javascript:void(0)" onclick="$('#export_generator').toggleClass('hide')" class="btn btn-default">Hide </a>
  </div>
</div> 
            <div class="clearfix"></div>
            </form>
            </div>
            </div>
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <h3 class="card-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t('hotel', $pageHeading);?>
                </h3>
            </div>
            <div class="pull-right">
                 <div class="dropdown pull-left">
					         <?php echo CHtml::link(Yii::t('app', 'Export'),  'javascript:void(0)' , array('class' => 'btn btn-info btn-xs', 'onclick'=>'$("#export_generator").toggleClass("hide")', 'title' => Yii::t('app', 'Export')));?>
         
  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown" style="margin-right:10px;">Create New
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
      <?php $tyes = $user->getUserType(); 
      foreach($tyes as $k=>$v){
       echo '<li><a href="'.Yii::app()->createUrl($this->id.'/create/type/'.$k).'">'.$v.'</a></li>';
      }
     ?> 
  </ul>
</div> 
                  <?php echo CHtml::link(Yii::t('app', 'Refresh'), Yii::app()->createUrl($this->id.'/index/type/'.$type), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="card-body">
			<div class="col-sm-4" style="padding-left:0px;">
			<label></label>
			<?php
			
			if($type != 'U'){
			 echo CHtml::checkbox('featured','' ,array('class'=>'form-control','value'=>'Y','uncheckValue'=>'','onchange'=>'setTagThis(this,"featured")','style'=>'width:auto;display:inline;vertical-align: middle;')).'<label for="featured" style="display: inline;display: inline-block;vertical-align: middle;margin-left: 10px;padding-top: 10px;">Featured</label>'; 
			 echo CHtml::checkbox('premium','' ,array('class'=>'form-control','value'=>'1','uncheckValue'=>'','onchange'=>'setTagThis(this,"premium")','style'=>'width:auto;display:inline;vertical-align: middle;')).'<label for="featured" style="display: inline;display: inline-block;vertical-align: middle;margin-left: 10px;padding-top: 10px;">Premium</label>'; 
		 }
			?>
		
			</div>
           
           <div class="col-sm-4">       <?php echo CHtml::link(Yii::t('app', 'Update Featured cache'), Yii::app()->createUrl($this->id.'/update_cache'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'cache')));?>
          </div>
          	<script>
			function setTagThis(k,id){
				if($(k).is(':checked')){
				$('#<?php echo $user->modelName;?>_'+id).val($(k).val()).change(); 
				}else{
					$('#<?php echo $user->modelName;?>_'+id).val('').change(); 
				}
			}
			</script>
           <style>
               .rounded-circle[class*="img"] {
    position: relative;
    overflow: hidden;
}
.img-xs {
    width: 32px;
    min-width: 32px;
    height: 32px;
}
.rounded-circle {
    border-radius: 50% !important;
}
           </style>
        
           
        
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
			
            $form=$this->beginWidget('CActiveForm');  
            
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->id.'/'.$this->action->id,array('type'=>$type)),
                    'id'                => $user->modelName.'-grid',
                     'ajaxUpdate'        =>false,
                    'dataProvider'      => $user->duplicate(),
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
                            'name'  => 'user_type',
                            'value' => '@$data->typeTile' ,
                            'filter' => $user->getUserType()
                        ),
                        array(
                            'name'  => 'first_name',
                            'value' => '@$data->first_name." -   ".@$data->UpdateAdFields' ,
                        ),
                        
                        array(
                            'name'  => 'city',
                            'value' => '@$data->city' ,
                        ),
                        
                        array(
                            'name'  => 'company_name',
                            'value' => '@$data->CompanyImageHtml." ".@$data->company_name." ".$data->IsFeatured',
                            'type'=>'raw',
                           'visible' =>  $type== 'U' ? false : 'true' ,
                              'filter'=>CHtml::activeTextField($user, 'company_name').
                                     CHtml::activeHiddenField($user, 'featured' ) .' '.
                                     CHtml::activeHiddenField($user, 'premium' ) 
                                     ,
                        ),
                        
                       
                   
                        array(
                            'name'  => 'email',
                            'value' => '@$data->CheckEmailVerified',
                             'type'=>'raw'
                        ),
                        array(
                            'name'  => 'phone',
                            'value' => '@$data->CheckMobileVerified',
                            'type'=>'raw'
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
                                    'url'       => 'Yii::app()->createUrl( "listingusers/update", array("id" => $data->user_id,"type"=>"$data->user_type"))',
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
                              
                                	'impersonate' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-random"></span> &nbsp;', 
                                    'url'       => '@$data->ImpersonateLink',
                                    'imageUrl'  => null,
                                    'visible'   => '@$data->canLogin',
                                    'options'   => array('title' => Yii::t('app', 'Login as this user'),'target'=>'_blank', 'class' => ''),
                                ), 
                                 'featured' => array(
                                    
                                    'label'     => ' &nbsp; <span class="glyphicon    glyphicon-star  "></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/featured",array("id"=>$data->user_id,"featured"=>$data->featured))',
                                    'imageUrl'  => null,
                                    
                                    'options'   => array('title' => Yii::t('app', 'Featured'), 'class' => 'cssGridButton',
                                    
                                ),  
                                ),
                                 'tag' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-tags bg-yellow"></span> &nbsp;', 
                                    'url'       => function($data){ return "javascript:void(0)" ; },
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Tag Your Property'), 'class' => '' , 'data-toggle'=>'modal', 'onclick'=>"javascript:void(0);openUp2(this)", ),
                                   
                                ),
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:120px;',
                            ),
                            'template' => '{delete}{update} {impersonate} {featured} '
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
