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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">
                <span class="fa fa-star"></span> 
                <?php echo Yii::t(Yii::app()->controller->id, Yii::app()->controller->Controlloler_title." List");?>
            </h3>
            <div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-sm', 'title' => Yii::t('app', 'Create new')));?>
                    </div>
                    <!-- <div class="col-md-3">
                        <?php //echo CHtml::link(Yii::t('app', 'Refresh'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-sm', 'title' => Yii::t('app', 'Refresh')));?>
                    </div> -->
                    <div class="col-md-8">
                        <input type="text" id="dateRange" class="form-control" style="margin-left: 10px;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="col-sm-2 mb-5">
                <button type="button" id="exportExcel" class="btn btn-success btn-xs" style="margin-left: 10px;">Export to Excel</button>
            </div>
            <script>
                $(document).ready(function() {
                    $('#projectsList').DataTable({
                        createdRow: function (row, data, index) {
                            $(row).addClass('selected');
                        },
                        language: {
                            paginate: {
                                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                            }
                        }
                    });

                    // Handle select all checkbox
                    $('#selectAll').on('click', function() {
                        var rows = $('#projectsList').DataTable().rows({ 'search': 'applied' }).nodes();
                        $('input[type="checkbox"]', rows).prop('checked', this.checked);
                    });

                    $('#selectAllFoot').on('click', function() {
                        var rows = $('#projectsList').DataTable().rows({ 'search': 'applied' }).nodes();
                        $('input[type="checkbox"]', rows).prop('checked', this.checked);
                    });

                    $('#projectsList tbody').on('change', 'input[type="checkbox"]', function() {
                        if(!this.checked) {
                            var el = $('#selectAll').get(0);
                            var elFoot = $('#selectAllFoot').get(0);
                            if(el && el.checked && ('indeterminate' in el)) {
                                el.indeterminate = true;
                            }
                            if(elFoot && elFoot.checked && ('indeterminate' in elFoot)) {
                                elFoot.indeterminate = true;
                            }
                        }
                    });
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
                        var exportUrl = '<?php echo Yii::app()->createUrl('new_projects/exportExcel'); ?>';

                        if (startDate && endDate) {
                            exportUrl += '?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate);
                            if (currentUrl.includes("trash")) {
                                exportUrl += "&type=trash";
                            }
                        }
                            

                        // Redirect to the export URL
                        window.location.href = exportUrl;    
                    });
                });
            </script>
            <div class="table-responsive">
                <table id="projectsList" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Project Title</th>
                            <th>City</th>
                            <th>Section</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->search()->getData() as $data) { ?>
                        <tr>
                            <td><?php echo $data->date_added ?></td>
                            <td>
                                <?php echo CHtml::decode($data->AdTitleWithIcons2, Yii::app()->createUrl("place_property/update", array("id" => $data->id))); ?>
                                <div><?php echo $data->Tags; ?></div>
                                <input type="hidden" class="propertyId" value="<?php echo $data->id; ?>">
                                <input type="hidden" class="sId" value="<?php echo $data->section_id; ?>">
                                <input type="hidden" class="cId" value="<?php echo $data->category_id; ?>">
                                <input type="hidden" class="lId" value="<?php echo $data->listing_type; ?>">
                                <input type="hidden" id="meta_title-<?php echo $data->id; ?>" class="meta_title" value="<?php echo $data->metaTitleEnglish; ?>">
                                <input type="hidden" id="meta_title-ar-<?php echo $data->id; ?>" class="meta_title_ar" value="<?php echo $data->MetaTitleArabic; ?>">
                                <input type="hidden" id="meta_description-<?php echo $data->id; ?>" class="meta_description" value="<?php echo $data->MetaDescriptionEnglish; ?>">
                                <input type="hidden" id="meta_description-ar-<?php echo $data->id; ?>" class="meta_description_ar" value="<?php echo $data->MetaDescriptionArabic; ?>">
                            </td>
                            <td><?php echo CHtml::decode($data->CountryNameSection); ?></td>
                            <td><?php echo CHtml::encode($data->section->section_name); ?></td>
                            <td><?php echo $data->statusLink; ?></td>
                            <td><?php echo CHtml::textField("priority[$data->id]", $data->priority, array("style" => "width:50px;text-align:center", "class" => "form-controll")); ?></td>
                            <td>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/update')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/update', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Update'); ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                <?php } ?>
                                <a href="<?php echo Yii::app()->createUrl('statistics/property_statistics', array('property_id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Statistics'); ?>" target="_blank">
                                    <i class="fa fa-bar-chart text-red"></i>
                                </a>
                                <a href="<?php echo $data->PreviewUrlTrashB; ?>" title="<?php echo Yii::t('app', 'View'); ?>" target="_blank" class="text-green">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/delete')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/delete', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Delete'); ?>" class="delete">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                <?php } ?>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/featured')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/featured', array('id' => $data->id, 'featured' => $data->featured)); ?>" title="<?php echo Yii::t('app', 'Featured'); ?>">
                                        <i class="fa fa-star"></i>
                                    </a>
                                <?php } ?>
                                <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/verified', array('id' => $data->id, 'verified' => $data->verified)); ?>" title="<?php echo Yii::t('app', 'Verified'); ?>">
                                    <i class="fa fa-check-circle"></i>
                                </a>
                                <?php if ($data->status === "A") { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/status', array('id' => $data->id, 'status' => $data->status)); ?>" title="<?php echo Yii::t('app', 'Inactive AD'); ?>" class="Block">
                                        <i class="fa fa-ban"></i>
                                    </a>
                                <?php } ?>
                                <?php if ($data->status === "I") { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/status', array('id' => $data->id, 'status' => $data->status)); ?>" title="<?php echo Yii::t('app', 'Activate AD'); ?>" class="Enable" 
                                    onclick="event.preventDefault(); $.ajax({type:'POST', url:$(this).attr('href'), success: function() {$.fn.yiiGridView.update('<?php echo $model->modelName; ?>-grid');}});">
                                        <i class="fa fa-check-circle"></i>
                                    </a>
                                <?php } ?>
                                <?php if (AccessHelper::hasRouteAccess(Yii::app()->controller->id.'/image_management')) { ?>
                                    <a href="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/image_management', array('id' => $data->id)); ?>" title="<?php echo Yii::t('app', 'Image Management'); ?>">
                                        <i class="fa fa-picture-o"></i>
                                    </a>
                                <?php } ?>
                                <a href="javascript:void(0);" title="<?php echo Yii::t('app', 'Update Meta Tag'); ?>" data-toggle="modal" onclick="openUp(this)">
                                    <i class="fa fa-tags"></i>
                                </a>
                                <a href="javascript:void(0);" title="<?php echo Yii::t('app', 'Tag Your Property'); ?>" data-toggle="modal" onclick="openUp2(this)">
                                    <i class="fa fa-tags bg-yellow"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                
                </table>
          
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
		$('#<?php echo $model->modelName;?>_id').val($(k).parent().parent().find('.propertyId').val())
		$('#<?php echo $model->modelName;?>_meta_title').val($(k).parent().parent().find('.meta_title').val())
		$('#<?php echo $model->modelName;?>_meta_description').val($(k).parent().parent().find('.meta_description').val())
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
				// $('.cli').prop('disabled','disabled');
				 if(data.enabled !== undefined){
					// $.each(data.enabled,function(v){  $("input[type=checkbox][value="+v+"]").prop("disabled",false); })
				 }
				 if(data.items !==undefined){
					 
						 $.each(data.items,function(v){ $("input[type=checkbox][value="+v+"]").prop("checked",true);;})
					 
				 }
				$('#<?php echo $model->modelName;?>_id2').val(property_id); $('#extension-upload-modal2').modal();  })
			
		
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
				$('#meta_description-'+data).val($('#<?php echo $model->modelName;?>_meta_description').val());
				$('#meta_title-161'+data).val($('#<?php echo $model->modelName;?>_meta_title').val())
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
				<style>.cbox label { width:50%;float:left; }.cbox input { width:auto; float:left;margin-right: 10px;height:auto;}#<?php echo $model->modelName;?>_tags_list { display: block;

width: 100%;

clear: both; }.cbox br { clear:both;}</style>
				<div id="notify-container-success2" style="display:none;"><div class="alert alert-block alert-success"><button data-dismiss="alert" class="close" type="button">×</button><ul><li>Succesfully updated   tags!</li></ul></div></div>    
				<div id="notify-container-failure2" style="display:none;"><div class="alert alert-block alert-danger"><button data-dismiss="alert" class="close" type="button">×</button><ul><li>Failted to  Updated   tags!</li></ul></div></div>
				<div class="form-group cbox">
				<?php echo $form->labelEx($model, 'tags_list');?>
				<?php echo $form->checkBoxList($model, 'tags_list',$model->place_ad_tag(),$model->getHtmlOptions('tags_list',array('class'=>'form-control cli'))); ?>
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

