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
                <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                <?php echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Refresh')));?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
        <div class="box-body">
            <div class="col-sm-4">
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
           
             $form=$this->beginWidget('CActiveForm', array( 
			 'enableAjaxValidation'=>true,
			 ));  
			 
			
            // and render if allowed
            if ($collection->renderGrid) {
                $this->widget('zii.widgets.grid.CGridView', $hooks->applyFilters('grid_view_properties', array(
                    'ajaxUrl'           => $this->createUrl($this->route),
                    'ajaxUpdate'        =>$model->modelName.'-grid',
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
                            'name'  => 'date_added',
                            'value' => '@$data->SmallDate' ,
                            'htmlOptions'=>array("width"=>"80px","style"=>"text-align:right;"),
                            'filter'=>false,
                        ),
                           array(
                            'name'  => 'ad_title',
                            'value' => function($data){
                                echo CHtml::link($data->AdTitleWithIcons,Yii::app()->createUrl("place_an_ad/update",array("id"=>$data->id))) ;
                                echo'<div>'.$data->Tags.'</div>' ;
                                echo '<input type="hidden" class="propertyId"   value="'. $data->id.'" />' ;
                                echo '<input type="hidden" class="sId"   value="'. $data->section_id.'" />' ;  
                                echo '<input type="hidden" class="cId"   value="'. $data->category_id.'" />' ;  
                                echo '<input type="hidden" class="lId"   value="'. $data->listing_type.'" />' ;  
                                echo '<input type="hidden" id="meta_title-'.$data->id.'" class="meta_title"   value="'. $data->meta_title.'" />' ;  
                                echo '<input type="hidden" id="meta_description-'.$data->id.'" class="meta_description"   value="'. $data->meta_description.'" />' ;  
                                },
                             'filter'=>CHtml::activeTextField($model, 'ad_title').CHtml::activeHiddenField($model, 'tag_list2',array('id'=>'tag_list2')),
                              'type'  => 'raw',
                        ),
                        array(
                            
                            'name'  => 'user_name',
                            'value' => '@$data->userUrl' ,
                            'htmlOptions'=>array("width"=>"150px"),
                            'type'=>'raw',
                            
                        ),
                        array(
                            
                            'name'  => 'country_name',
                            'value' => '@$data->CountryNameSection' ,
                            'htmlOptions'=>array("width"=>"200px"),
                            'type'=>'raw',
                            
                        ),
                        array(
                            
                            'name'  => 'section_id',
                            'value' => '@$data->section->section_name' ,
                            'htmlOptions'=>array("width"=>"150px"),
                            'filter'=>Section::model()->getSection(),
                        ),
                        array(
                            
                            'name'  => 'category_id',
                            'value' => '@$data->category->category_name' ,
                            'htmlOptions'=>array("width"=>"150px"),
                            'filter'=>Category::model()->getCategory(),
                        ),
                      
                  
                        array(
                            'name'  => 'status',
                            'value' => '$data->statusLink',
                            'filter'=>$model->statusArray(),
                            'htmlOptions'=>array("width"=>"50px","style"=>"text-align:center;"),
                            'type'  => 'raw',
                        ),
                        
					
						array(
						'name'=>'priority',
						'type'=>'raw',
						'filter'=>false,
						'value'=>'CHtml::textField("priority[$data->id]",$data->priority,array("style"=>"width:50px;text-align:center","class"=>"form-controll"))',
						'htmlOptions'=>array("style"=>"width:50px;text-align:center","class"=>"form-controll"),
						),
                       
                      
                       
                        array(
                            'class'     => 'CButtonColumn',
                            'header'    => Yii::t('app', 'Options'),
                            'footer'    => $model->paginationOptions->getGridFooterPagination(),
                            'buttons'   => array(
                                'update' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-pencil"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/update", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => ''),
                                ),
                                 'statistics' => array(
                                    'label'     => ' &nbsp; <span class="fa-bar-chart"></span> &nbsp;', 
                                    'url'       => 'Yii::app()->createUrl("statistics/property_statistics", array("property_id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update'), 'class' => '','target'=>'_blank'),
                                ),
                            'view' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-eye"></span> &nbsp;', 
                                    'url'       => '$data->PreviewUrlTrash',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'View'), 'class' => '','target'=>'_blank'),
                                ),
                                'delete' => array(
                                    'label'     => ' &nbsp; <span class="fa fa-trash"></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/delete", array("id"=>$data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Delete'), 'class' => 'delete'),
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),    
                                'featured' => array(
                                    
                                    'label'     => ' &nbsp; <span class="glyphicon    glyphicon-star  "></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/featured",array("id"=>$data->id,"featured"=>$data->featured))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Featured'), 'class' => 'cssGridButton',
                      
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),  ),  
                                   'ban' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-ban-circle"></span> &nbsp; ', 
                                     'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/status",array("id"=>$data->id,"status"=>$data->status))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Inactive AD'), 'class' => 'Block',  
                                    ),
                                   'visible'   => '$data->status === "A"',
                                ),    
                                'app' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-ok-circle"></span> &nbsp; ', 
                                      'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/status",array("id"=>$data->id,"status"=>$data->status))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Activate AD'), 'class' => 'Enable',
                                     'ajax'=>array(
										'type'=>'POST',
										'url'=>"js:$(this).attr('href')",
										'success' => 'js:$.fn.yiiGridView.update("'.$model->modelName.'-grid")'
                     )
                                    ),
                                   'visible'   => '$data->status === "I"',
                                ),
                            
                                'image' => array(
                                    
                                    'label'     => ' &nbsp; <span class="glyphicon   glyphicon-picture  "></span> &nbsp; ', 
                                    'url'       => 'Yii::app()->createUrl("'.Yii::app()->controller->id.'/image_management", array("id" => $data->id))',
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Image Management'), 'class' => 'image',
 
                                   // 'visible'   => '$data->removable === User::TEXT_YES',
                                ),  ),  
                                  'meta' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-tags"></span> &nbsp;', 
                                    'url'       => function($data){ return "javascript:void(0)" ; },
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Update Meta Tag'), 'class' => '' , 'data-toggle'=>'modal', 'onclick'=>"javascript:void(0);openUp(this)", ),
                                   
                                ),
                                  'tag' => array(
                                    'label'     => ' &nbsp; <span class="glyphicon glyphicon-tags bg-yellow"></span> &nbsp;', 
                                    'url'       => function($data){ return "javascript:void(0)" ; },
                                    'imageUrl'  => null,
                                    'options'   => array('title' => Yii::t('app', 'Tag Your Property'), 'class' => '' , 'data-toggle'=>'modal', 'onclick'=>"javascript:void(0);openUp2(this)", ),
                                   
                                ),
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:150px;',
                            ),
                            'template' => '{view}{featured}{ban}{app}{image}{update}{delete}{meta}{tag} {statistics}'
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
function  saveFormFunction_grid_update_new(form, data, hasError ,Url )
{ if(!hasError) { $.ajax({  "type":"POST",
									"url": Url,
                                    "data":form.serialize(),
                                    "success":function(data){
										if(data==1){ 
											alert('Successfuly updated');
											$('#myModal').modal('hide');
				  
										}
										else{
										    
										 	
											$('#messager').html('<div class="alert alert-warning"><strong>Warning!</strong>  '+data+'.</div>');
										}
                                     },

                                  });
     }
      else
    { 
		form.find("button.btn-submit").button("reset");
        alert('error');
     }
 }
 </script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel"> Approval</h4>

            </div>
            <div id="preview_body">
            
            </div>
        </div>
    </div>
</div>
<style>
a.strike { text-decoration: line-through; }
</style>

 <script>
   function  openUp(k)
    {
		$('#PlaceAnAd_id').val($(k).parent().parent().find('.propertyId').val())
		$('#PlaceAnAd_meta_title').val($(k).parent().parent().find('.meta_title').val())
		$('#PlaceAnAd_meta_description').val($(k).parent().parent().find('.meta_description').val())
		$('#extension-upload-modal').modal();
	 
	}
	function  openUp2(k)
    {
		var property_id = $(k).parent().parent().find('.propertyId').val();
		var section_id = $(k).parent().parent().find('.sId').val();
		var category_id = $(k).parent().parent().find('.cId').val();
		var listing_type = $(k).parent().parent().find('.lId').val();
		 
		if(property_id !=undefined){
			$('.cli').prop('checked', false);
			$.get('<?php echo Yii::app()->createAbsoluteUrl("place_an_ad/get_tag_list"); ?>',{id:property_id,sect_id:section_id,category_id:category_id,listing_type:listing_type},function(data){ 
				 var data = JSON.parse(data);
				//  alert(data.enabled)
				 $('.cli').prop('disabled','disabled');
				 if(data.enabled !== undefined){
					 $.each(data.enabled,function(v){  $("input[type=checkbox][value="+v+"]").prop("disabled",false); })
				 }
				 if(data.items !==undefined){
					 
						 $.each(data.items,function(v){ $("input[type=checkbox][value="+v+"]").prop("checked",true);;})
					 
				 }
				$('#PlaceAnAd_id2').val(property_id); $('#extension-upload-modal2').modal();  })
			
		
		}
		
	 
	}
	$(function(){
	$('.ajax-Smit').click(function(){
		  
		 var data=$("#miscellaneous-pages-form").serialize();
 

		$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("place_an_ad/updatemetatag"); ?>',
		data:data,
		success:function(data){
		
		 $(".ajax-Smit").removeClass("disabled");
		 $(".ajax-Smit").removeAttr("disabled");
		 $(".ajax-Smit").text("Update Meta Tag");
		 if(parseInt(data)>0)
		 {
				$('#meta_description-'+data).val($('#PlaceAnAd_meta_description').val());
				$('#meta_title-161'+data).val($('#PlaceAnAd_meta_title').val())
				$("#notify-container-success").show();
				setTimeout(function(){ $("#notify-container-success").hide();$('#extension-upload-modal').modal('hide'); }, 2000);
			 
		 }
		 else
		 {
			   $("#notify-container-failure").show();
		 }
		},
		error: function(data) { // if error occured
		alert("Error occured.please try again");
		alert(data);
		},

		dataType:'html'
		});
		
		})
			$('.ajax-Smit2').click(function(){
		  
		 var data=$("#miscellaneous-pages-form2").serialize();
 

		$.ajax({
		type: 'POST',
		url: '<?php echo Yii::app()->createAbsoluteUrl("place_an_ad/savetaglist"); ?>',
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
 
<div aria-hidden="false" aria-labelledby="extension-upload-modal-label" role="dialog" tabindex="-1" id="extension-upload-modal" class="modal fade in" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">Update Meta Tags.</h4>
            </div>
            <div class="modal-body">
				
				
                     
				<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'miscellaneous-pages-form',
				'enableAjaxValidation'=>false,
				)); ?>
				<div id="notify-container-success" style="display:none;"><div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button">×</button><ul><li>Succesfully updated meta tag!</li></ul></div></div>    
				<div id="notify-container-failure" style="display:none;"><div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><ul><li>Failted to  Updated Meta Tag!</li></ul></div></div>
				<div class="form-group">
				<?php echo $form->labelEx($model, 'meta_title');?>
				<?php echo $form->textField($model, 'meta_title',$model->getHtmlOptions('meta_title')); ?>
				<?php echo $form->error($model, 'meta_title');?>
				<?php echo $form->hiddenField($model, 'id',$model->getHtmlOptions('id')); ?>
				</div>   
                  
                <div class="clearfix"><!-- --></div>  
				<div class="form-group">
				<?php echo $form->labelEx($model, 'meta_description');?>
				<?php echo $form->textArea($model, 'meta_description',$model->getHtmlOptions('meta_description')); ?>
				<?php echo $form->error($model, 'meta_description');?>
				</div>   
                <div class="clearfix"><!-- --></div>  
                <?php 
				$this->endWidget();
				?>
                </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
              <button onclick="" data-loading-text="Please wait, processing..." class="btn btn-primary btn-submit ajax-Smit" type="button">Update Meta Tag</button>
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
				<div id="notify-container-success2" style="display:none;"><div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button">×</button><ul><li>Succesfully updated   tags!</li></ul></div></div>    
				<div id="notify-container-failure2" style="display:none;"><div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><ul><li>Failted to  Updated   tags!</li></ul></div></div>
				<div class="form-group cbox">
				<?php echo $form->labelEx($model, 'tags_list');?>
				<?php echo $form->checkBoxList($model, 'tags_list',$tags,$model->getHtmlOptions('tags_list',array('class'=>'form-control cli'))); ?>
				<?php echo $form->error($model, 'tags_list');?>
				<?php echo $form->hiddenField($model, 'id2',$model->getHtmlOptions('id2')); ?>
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

