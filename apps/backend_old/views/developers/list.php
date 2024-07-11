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
    <div class="box box-primary">
        <div class="box-header">
            <div class="pull-left">
                <h3 class="box-title">
                    <span class="glyphicon glyphicon-star"></span> <?php echo Yii::t('hotel', 'Developers List');?>
                </h3>
            </div>
            <div class="pull-right">
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array($this->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
			<div class="col-sm-4" style="padding-left:0px;">
			<label>Listing Tags</label>
			<?php echo CHtml::dropDownList('tags','',$tags,array('class'=>'form-control','empty'=>'Select Tag','onchange'=>'setTagThis(this)'));
			foreach($tags_short as $k=>$v){
				$v_code = explode('|',$v);
				echo '<style>.tag_short_'.$k.'{ display:inline-block;background:'.@$v_code[1].'; padding:2px 5px; margin-right:2px; }.tag_short_'.$k.':before{ content:"'.@$v_code[0].'"; color:#fff; } </style>';
			}
			?>
			<script>
			function setTagThis(k){
				$('#tag_list2').val($(k).val()).change()
			}
			</script>
			</div>
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
                            'name'  => 'company_name',
                            'value' => '@$data->company_name." ".@$data->company_name' ,
                        ),
                            array(
                            'name'  => 'email',
                            'value' => function($data){
                              echo   $data->email  ;
                              echo'<div>'.$data->Tags.'</div>' ;
                                echo '<input type="hidden" class="propertyId"   value="'. $data->user_id.'" />' ;  
                                },
                             'filter'=>CHtml::activeTextField($user, 'email').CHtml::activeHiddenField($user, 'tag_list2',array('id'=>'tag_list2')),
                              'type'  => 'raw',
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
                            'template' => '{delete}{update}{featured}{impersonate} {tag}'
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
function  openUp2(k)
    {
		var property_id = $(k).parent().parent().find('.propertyId').val();
 
		 
		if(property_id !=undefined){
			$('.cli').prop('checked', false);
			$.get('<?php echo Yii::app()->createAbsoluteUrl("place_an_ad/get_tag_list2"); ?>',{id:property_id,listing_type:'D'},function(data){ 
				 var data = JSON.parse(data);
				//  alert(data.enabled)
				 $('.cli').prop('disabled','disabled');
				 if(data.enabled !== undefined){
					 $.each(data.enabled,function(v){  $("input[type=checkbox][value="+v+"]").prop("disabled",false); })
				 }
				 if(data.items !==undefined){
					 
						 $.each(data.items,function(v){ $("input[type=checkbox][value="+v+"]").prop("checked",true);;})
					 
				 }
				$('#<?php echo $user->modelName;?>_id2').val(property_id); $('#extension-upload-modal2').modal();  })
			
		
		}
		
	 
	}
	$(function(){
		$('.ajax-Smit2').click(function(){
		  
		 var data=$("#miscellaneous-pages-form2").serialize();
 

		$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("place_an_ad/savetaglist2",array('model'=>$user->modelName)); ?>',
		data:data,
		success:function(data){
		
		 $(".ajax-Smit2").removeClass("disabled");
		 $(".ajax-Smit2").removeAttr("disabled");
		 $(".ajax-Smit2").text("Update   Tag");
		 if(parseInt(data)>0)
		 {
				 	$("#notify-container-success2").show();
				setTimeout(function(){ $("#notify-container-success2").hide();$('#extension-upload-modal2').modal('hide'); }, 2000);
			 
		 }
		 else
		 {
			   $("#notify-container-failure2").show();
		 }
		},
		error: function(data) { // if error occured
		alert("Error occured.please try again");
		alert(data);
		},

		dataType:'html'
		});
		
		})
		
		})
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
<div aria-hidden="false" aria-labelledby="extension-upload-modal2-label" role="dialog" tabindex="-1" id="extension-upload-modal2" class="modal fade in" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">Update   Tags.</h4>
            </div>
            <div class="modal-body">
				
				
                     
				<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=> Yii::app()->createUrl('place_an_ad/save_tags'),
				'id'=>'miscellaneous-pages-form2',
				'enableAjaxValidation'=>false,
				)); ?>
				<style>.cbox label { width:50%;float:left; }.cbox input { width:auto; float:left;margin-right: 10px;height:auto;}#PlaceAnAd_tags_list { display: block;

width: 100%;

clear: both; }.cbox br { clear:both;}</style>
				<div id="notify-container-success2" style="display:none;"><div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button">×</button><ul><li>Succesfully updated meta tag!</li></ul></div></div>    
				<div id="notify-container-failure2" style="display:none;"><div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><ul><li>Failted to  Updated Meta Tag!</li></ul></div></div>
				<div class="form-group cbox">
				<?php echo $form->labelEx($user, 'tags_list');?>
				<div class="clearfix"></div>
				<?php echo $form->checkBoxList($user, 'tags_list',$tags,$user->getHtmlOptions('tags_list',array('class'=>'form-control cli'))); ?>
				<?php echo $form->error($user, 'tags_list');?>
				<?php echo $form->hiddenField($user, 'id2',$user->getHtmlOptions('id2')); ?>
				</div>   
                  
                <div class="clearfix"><!-- --></div>  
				 
                <div class="clearfix"><!-- --></div>  
                <?php 
				$this->endWidget();
				?>
                </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
              <button onclick="" data-loading-text="Please wait, processing..." class="btn btn-primary btn-submit ajax-Smit2" type="button">Update   Tags</button>
            </div>
          </div>
        </div>
    </div>

		<style>.cbox label { width:50%;float:left; }.cbox input { width:auto; float:left;margin-right: 10px;height:auto;}#PlaceAnAd_tags_list { display: block;

width: 100%;

clear: both; }.cbox br { clear:both;}</style>
