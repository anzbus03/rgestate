 <div class="form-group col-lg-12 float-left <?php echo !empty($model->image) ? 'hidden' : '';?>" id="avatar_updator">
				<div class="col-lg-12  no-padding">
				<?php echo $form->labelEx($model, 'image');?>
				<?php echo $form->hiddenField($model, 'image', $model->getHtmlOptions('image')); ?>
				<div class="clearfix"><!-- --></div>

				<div id="largeImage" class="dropzone" title="Click or Drag here to upload photos"></div>
				<div class="clearfix"><!-- --></div>
				<div class="alert alert-info" style="width:200px;">
				<ul>
				<li>Maximum size : <b>2MB</b></span></li>
				<li>Format : <b>gif , jpg , jpeg , png</b></li>
				<li>Resized : <b>400px X 400px</b> size </li>
				</ul>
				</div>
				<div class="clearfix"><!-- --></div>
			 
				<script type="text/javascript">
				var largeImageDropzone = new Dropzone("div#largeImage", { url: "<?php echo Yii::app()->createUrl('place_an_ad/upload',array('width'=>'400','height'=>'400')); ?>",addRemoveLinks: true, maxFilesize: 2 ,maxFiles:1,  acceptedFiles: ".gif,.jpg,.jpeg,.png",}) //according to your forms action
				largeImageDropzone.on("removedfile", function(file, serverFileName) {
				$.post("<?php echo Yii::app()->createUrl('place_an_ad/delete_image'); ?>",{file:file.serverId,inp:$("#<?php echo $model->modelName;?>_long_img").val()},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ; } );
				});
				largeImageDropzone.on("success", function(file,serverFileName) {
				$("#<?php echo $model->modelName;?>_image").val(serverFileName) ;

				});
				</script>
				<style>
				#largeImage.dropzone { width:200px; min-height:200px; }
				#largeImage.dropzone .dz-default.dz-message	{
				width: 100%;
				height: 100%;
				margin-left:0px; 
				margin-top: 0px; 
				top: 0px;
				left: 0px;  
				background-size: contain;
				background-repeat: no-repeat;
				background-position: center;
				background-image:url('<?php echo Yii::app()->apps->getBaseUrl('uploads/default/F1.png');?>');
				}
				</style>
				<div class="clearfix"><!-- --></div> 
				<?php echo $form->error($model, 'image');?>    
				</div>
				  
				</div>  
                <div class="clearfix"><!-- --></div>
               
