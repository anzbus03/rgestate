 <div class="form-group col-lg-12 float-left <?php echo !empty($user->image) ? 'hidden' : '';?>" id="avatar_updator">
 <?php 
 $options = Yii::app()->options; 
 $resize_width  = $options->get('system.upload.avatar_resize_width','100');
 $resize_height = $options->get('system.upload.avatar_resize_height','100');
 ?>
				<div class="col-lg-12  no-padding">
				<?php echo $form->labelEx($user, 'image');?>
				<?php echo $form->hiddenField($user, 'image', $user->getHtmlOptions('image')); ?>
				<div class="clearfix"><!-- --></div>

				<div id="largeImage" class="dropzone" title="Click or Drag here to upload photos"></div>
				<div class="clearfix"><!-- --></div>
				<div class="alert alert-info" style="width:200px;">
				<ul>
				<li>Maximum size : <b>1MB</b></span></li>
				<li>Format : <b>gif , jpg , jpeg , png</b></li>
				<?php
				if(!empty($resize_width)){
					if(empty($resize_height)){
						echo '<li>Resized : <b>'.$resize_width.'px width</b> size </li>';
					}
					else{
						echo '<li>Resized : <b>'.$resize_width.'px X '.$resize_height.'px</b> size </li>';
					}
				}
				?>
				</ul>
				</div>
				<div class="clearfix"><!-- --></div>
			 
				<script type="text/javascript">
				var largeImageDropzone = new Dropzone("div#largeImage", { url: "<?php echo Yii::app()->createUrl('place_an_ad/upload',array('width'=>$resize_width,'height'=>$resize_height)); ?>",addRemoveLinks: true, maxFilesize:1 ,maxFiles:1,  acceptedFiles: ".gif,.jpg,.jpeg,.png",}) //according to your forms action
				largeImageDropzone.on("removedfile", function(file, serverFileName) {
				$.post("<?php echo Yii::app()->createUrl('place_an_ad/delete_image'); ?>",{file:file.serverId,inp:$("#<?php echo $user->modelName;?>_long_img").val()},function(data){  $("#<?php echo $user->modelName;?>_image").val(data) ;$('#cropEnable').addClass('hidden'); } );
				});
				largeImageDropzone.on("success", function(file,serverFileName) {
				$("#<?php echo $user->modelName;?>_image").val(serverFileName) ;
				$('#cropEnable').removeClass('hidden');
				var saveUrl2 = $('#cropEnable').attr('data-com-img');
				  saveUrl2 = saveUrl2.replace("image_name", serverFileName );
				alert(saveUrl2)
				$('#cropEnable').attr('data-img',saveUrl2)
				

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
				<?php echo $form->error($user, 'image');?>    
				</div>
				  
				</div>  
                <div class="clearfix"><!-- --></div>
               
