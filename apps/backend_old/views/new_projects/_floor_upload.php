	   <style>
	   .floorp .dropzone {
    min-height: 200px !important;
    border: 3px dashed #42c3ac;
    background: #fff;margin-top: 10px;
}
.floorp .dropzone .dz-default.dz-message { background: unset; }
.floorp  .dropzone .dz-default.dz-message span  {display:block !important;
}
.floorp .dz-message  .upload-image { height: 66px;display:inline-block !important;}
.floorp .dz-message h4 {
    font-size: 22px;
    font-weight: 600;
    margin-top: 15px;
    margin-bottom: 15px;
}
.floorp  .row_insert { display:none !important; }
.floorp  .dz-started  .dz-message { display:none; }
.floorp  .dropzone .dz-message { text-align:center; }
	   </style>
	   <div class="form-group col-lg-12 floorp">
										<?php echo $form->labelEx($model, 'floor_plan');?>
									   
									   <span class="pull-right"  style="color:#4E4E4E;font-size:12px; ">
										   <?php echo  'Hint: File types allowed' ?>:
										    <span style="font-size:13px;">(<?php echo Yii::t('setting',$model->generateFormat(),array('.'=>''));?>)</span> . 
										     <?php echo  'Maximum File Size' ?> : <b>4MB</b>
										     <div class="clearfix"></div></span>
									   
										
								
									 <div class="clearfix"><!-- --></div>
									 <?php 
									$floor_array = array();
								 
									if(isset($model->floor_plan) and !empty($model->floor_plan)){
										$exp =  explode(",",$model->floor_plan);
										if($exp)
										{
											foreach($exp as $k=>$v)
											{
												if($v!="")
												{
													$floor_array[] = $v;
												}
											}
										}
									}
									else if(!$model->isNewRecord){
										$floor = $model->adFloorPlans;
										if(!empty($floor)){
											foreach($floor as $k=>$v)
											{
												//$v->FileDetails ;
												$floor_array[] = $v->floor_file;
											}
										}
									}
									
									
									;
								   if(!empty($floor_array) )
								   {
									   
									   ?>
										<div class="property_img_box" style="margin-bottom:20px;">
											
											<?php
											$image2 = "";
											foreach($floor_array as $k=>$v)
											{
												
												
												$image2 .= ",".$v;
												$items = explode('|||',$v);
												if(isset($items['2'])){
													
													$v 	 = $items['2'];
												}
												else if(isset($items['1'])){
													
													$v 	 = $items['1'];
												}
											?>
											<div id="property_img_<?php echo $k;?>" class="property_img">
											<img src="<?php echo   ENABLED_AWS_PATH.@$v  ?>" style="width:140px;">
											<div class="property_img_overlay">
										 
											<a class="btn btn-danger btn-small" onclick="delete_floor_plan_image2('<?php echo $v;?>',this);">
											<span class="isw-delete2" style="margin-right: 0px;"></span>
											</a>
											</div>
											</div>
											<?
											}
									   ?>
										</div>
										<?php
										$model->floor_plan = $image2;
								   }
								   ?>
									<?php echo $form->textField($model, 'floor_plan', $model->getHtmlOptions('floor_plan')); ?>
									
	<div id="myModal2" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	<div class="modal-header">
	<h4 class="modal-title">Enter Floor Plan Details</h4>
	</div>
	<div class="modal-body">
				<div class="form-group">
				<label for="floor_category">Floor Title</label>
				<input type="text" class="form-control" id="floo_category"  placeholder="eg. 1 Bedroom - Type A"  list="anrede">
				<datalist id="anrede">
				</datalist>
				</div>
 	</div>
	<div class="modal-footer">
	    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeFile()" >Close Without Saving</button>
	<button type="button" class="btn btn-primary"  onclick="updateValues(this)" >Submit</button>
	<script>
	function updateValues(k){
		if($('#floo_category').val()==''){ alert('Please enter title');return false; }
	//	if($('#floor_title').val()==''){ alert('Please enter floor plan title');return false; }
		options  = '<option value="'+$('#floo_category').val()+'" />';
		$('#anrede').append(options);

		upated_values =  $('#floo_category').val()+'|||'+last_value;


		var vals  = $("#<?php echo $model->modelName;?>_floor_plan").val();
		vals += ","+upated_values;
		$("#<?php echo $model->modelName;?>_floor_plan").val(vals) ;$('#floo_category').val('') ;
		$('#myModal2').modal('hide'); 
 
	}
    function closeFile(){
		//myDropzone2.removeFile(last_value);
		 $('#document-'+last_id).parent().remove() ;
	}
	</script>
	</div>
	</div>

	</div>
	</div>
	 
									 <div class="clearfix"><!-- --></div>
									
									<div id="floor_plan" class="dropzone" title="Click or Drag here to upload floor plan"><div class="dz-message" data-dz-message><img src="https://www.reduceimages.com/img/ico-frame-upload.png" alt="Upload image" class="upload-image"><h4>Drop your image here!</h4></div>
									<script type="text/javascript">
									var myDropzone2 = new Dropzone("div#floor_plan", { url: "<?php echo Yii::app()->createUrl('place_property/upload_floor_plan'); ?>",addRemoveLinks: true, maxFilesize: 4,  acceptedFiles: "<?php echo $model->generateFormat();?>",}) //according to your forms action
									 myDropzone2.on("removedfile", function(file, serverFileName) {
									 $.post("<?php echo Yii::app()->createUrl('place_property/delete_floor_plan'); ?>",{file:file.serverId,inp:$("#<?php echo $model->modelName;?>_floor_plan").val()},function(data){  $("#<?php echo $model->modelName;?>_floor_plan").val(data) ; } );
									});
									var last_value = '';var last_id = '';
									myDropzone2.on("success", function(file,serverFileName) {
										
										
										 file.serverId =serverFileName;
										 last_value = serverFileName;
										 last_id =  file.lastModified;
										 $(file.previewTemplate).find('.dz-details').attr('id', "document-" + file.lastModified);
										 $('#myModal2').modal('show', {backdrop: 'static', keyboard: false});
										 
										 /*
										 var vals  = $("#PlaceAnAd_floor_plan").val();
										 vals += ","+serverFileName;
										 $("#PlaceAnAd_floor_plan").val(vals) ;
										 
										 */
										 
									});
									var imgs2 = $("#<?php echo $model->modelName;?>_floor_plan").val(); 
									function delete_floor_plan_image2(val,k)
									{
										
										 $.post("<?php echo  Yii::app()->createUrl('place_property/delete_floor_plan'); ?>",{file:val,inp:imgs2},function(data){    $("#<?php echo $model->modelName;?>_floor_plan").val(data) ;imgs2 = data; } );
										 $(k).parent().parent().remove();
									}
									 
									</script>
									 <div class="clearfix"><!-- --></div>
									<?php echo $form->error($model, 'floor_plan');?>
	</div> 
	</div> 
