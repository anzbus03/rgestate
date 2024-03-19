<div>
	<?php 
if(!empty($model->$fileField)){
				 echo '<div class="row"><div id="div_view_'.$fileField.'" class="">'.$form->labelEx($model,$fileField,array('class'=>'col-sm-12')).'<a class="btn_vie"  target="_blank" style="margin-left:15px;" href="'.Yii::app()->apps->getBaseUrl('ajax/'.$model->$fileField).'">View</a><a href="javascript:void(0)" class="btn_vie margin-left-10" onclick=openUpdatorN("'.$fileField.'")  ><i class="fa fa-pencil"></i></a><a href="javascript:void(0)" class="btn_vie margin-left-10" style="background-color: #ee3524 !important;" onclick=deleteUpdatorN("'.$fileField.'")  >'. '<i class="fa fa-remove"></i>' .'</a><div class="clearfix"></div></div></div>';
			 }
			 ?>
</div>
 <div class="<?php echo !empty($model->$fileField) ? 'hidden' : '';?> browse_type  " id="abc_<?php echo $fileField;?>">
				
				<div class="col-sm-12" style="padding:0px;">
				<?php echo $form->labelEx($model,  $fileField );?> 
				<?php echo $form->hiddenField($model,  $fileField , $model->getHtmlOptions( $fileField )); ?>
				</div>
				<div class="col-sm-12" style="padding:0px;" >
				<div id="file_<?php echo $fileField;?>"   class="dropzone" title="Click or Drag here to upload photos"><div class="dz-message" data-dz-message><div class="upload-btn-wrapper"> <div class="drop_fil">Drop files here </div> <div><span class="div_od">or</span></div><div> <button class="btn  btn-info" type="button"><i class="fa fa-camera"></i><?php echo !empty($title_text) ? $title_text : '' ;?></button></div><div class="accepted">Accepted File Formats : <b><?php echo $types;?></b></div><div class="maximum_size">Maximum   file size must  be less than <b><?php echo $maxFilesize;?>MB</b> 1920X800 </div></div></div></div>
				<div class="alert alert-info" style="width:50%;float: right;display:none !important">
			 
				</div>
				<div class="clearfix"><!-- --></div>
			 
				<script type="text/javascript">
				var <?php echo $fileField;?><?php echo $fileField;?> = new Dropzone("div#file_<?php echo $fileField;?>", { url: "<?php echo Yii::app()->createUrl('ajax/upload'); ?>",addRemoveLinks: true, maxFilesize: <?php echo $maxFilesize;?>,resizeWidth : 600 ,maxFiles:<?php echo $maxFiles;?>,  acceptedFiles: "<?php echo $types;?>",}) 	
				<?php echo $fileField;?><?php echo $fileField;?>.on("removedfile", function(file, serverFileName) {
				$.post("<?php echo Yii::app()->createUrl('ajax/delete_image'); ?>",{file:file.serverId,inp:$("#<?php echo $model->modelName;?>_<?php echo $fileField;?>").val()},function(data){  $("#<?php echo $model->modelName;?>_<?php echo $fileField;?>").val(data) ; } );
				});
				<?php echo $fileField;?><?php echo $fileField;?>.on("success", function(file,serverFileName) {
				$("#<?php echo $model->modelName;?>_<?php echo $fileField;?>").val(serverFileName) ;

				});
				<?php echo $fileField;?><?php echo $fileField;?>.on("error", function(file,errorMessage) {
				   
    alert('Error',errorMessage);

        // i remove current file
        <?php echo $fileField;?><?php echo $fileField;?>.removeFile(file);
     
				});
				</script>
				<style>i.fa-camera {
    display: block;
    font-size: 24px;
    margin-bottom: 10px;
}.fa-camera:before {
    content: "\f1c1";
}.browse_type .upload-btn-wrapper .btn {
    width: 100%;
    height: auto !important;
}#file_attachment1.dropzone {
    width: 100px;
    min-height: unset !important;
    padding: 10px;
    background: transparent;
    border: 0px;
    padding: 0px !important;
}#file_attachment1 .btn.btn-info {
    padding: 10px !important;
    font-size: 13px;
}
				#file_<?php echo $fileField;?>.dropzone { width:200px !important;; min-height:unset !important;padding:10px; }
				#file_<?php echo $fileField;?>.dropzone .dz-default.dz-message	{
				width: 100%;
				height: 100%;
				margin-left:0px; 
				margin-top: 0px; 
				top: 0px;
				left: 0px;  
				background-size: contain;
				background-repeat: no-repeat;
				background-position: center;
				}
			.browse_type .drop_fil ,  .browse_type .div_od,  .browse_type .accepted,  .browse_type .maximum_size { display:none; }
			    .browse_type .dropzone .dz-message .upload-btn-wrapper { padding:0px; box-shadow:unset; max-width:200px;}
			    .browse_type .upload-btn-wrapper .btn { width:100%}
			    .browse_type .dropzone .dz-preview .dz-details, .browse_type .dropzone-previews .dz-preview .dz-details {   display:none !important;  position: absolute !important;   height: 50px !important;  right: 0px; }
			    .browse_type  .dropzone .dz-preview .dz-details img,.browse_type .dropzone-previews .dz-preview .dz-details img { display:none; }
			   .browse_type  .dropzone .dz-preview .dz-progress,.browse_type .dropzone-previews .dz-preview .dz-progress {    top: 30px !important;    left: 0px !important;    right: 6px !important; }
			  .browse_type label { margin-bottom:0px; line-height: 1.5;}
			  .dropzone .dz-preview, .dropzone-previews .dz-preview{ margin:0px !important; }
.browse_type .dropzone a.dz-remove,.browse_type .dropzone-previews a.dz-remove {
    
    float: left;
}.btn_vie {
    border: 1px solid 
#4cacdf;
color:
#fff;
background-color:
    #4cacdf;
    padding: 6px 20px;
    border-radius: 0px;
    font-size: 15px;
    font-weight: normal;
    text-decoration: none !important;
}.btn_vie.margin-left-10 {
    margin-left: 10px;
}#file_banner.dropzone {
   
    padding: 0px;
    background: transparent;
    border: 0;
}
.dz-max-files-reached .btn { display:none; }
.dropzone a.dz-remove, .dropzone-previews a.dz-remove { margin-top:5px; }
				</style>
				<div class="clearfix"><!-- --></div> 
				<?php echo $form->error($model,  $fileField );?>    
				</div>
				</div>
				  
			  
                <div class="clearfix"><!-- --></div>
               
  <script>
            function openUpdatorN(id){
					// $('#imgd').addClass('hidden');
					 $('#abc_'+id).removeClass('hidden');
					 $('#div_view_'+id).addClass('hidden');
				 }  function deleteUpdatorN(id){
					// $('#imgd').addClass('hidden');
					 $('#<?php echo $model->modelName;?>_'+id).val('');
					 $('#abc_'+id).removeClass('hidden');
					 $('#div_view_'+id).addClass('hidden');
				 }
        </script>
