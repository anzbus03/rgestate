	 <div class="subhead font_s ros subhead_img" style="padding-right:10px;">Add Images 856X550 <span class="pull-right">Hint: File types allowed: jpg, gif, png, Maximum filesize : 2MB </span></div>
	   <div class="form-group col-lg-12">
									   
										<?php echo $form->error($model, 'image');?>
								
									 <div class="clearfix"><!-- --></div>
									 <?php 
								   if(!empty($image_array) )
								   {
								 
									   
									   ?>
										<div class="property_img_box" style="margin-bottom:20px;">
											
											<?php
											$image = "";
											foreach($image_array as $k=>$v)
											{
												$image .= ",".$v;
											?>
											<div id="property_img_<?php echo $k;?>" class="property_img">
											<?php
												if (strpos(	$v , '/' ) !== false) {
													?>
													<img src="<?php echo   Yii::app()->apps->getBaseUrl('uploads/files/'.$v );  ?>" style="width:140px;">
													<?php
												}else{ ?> 
				
											<img src="<?php echo ENABLED_AWS_PATH.$v  ?>" style="width:140px;">
											<?php } ?> 
											<div class="property_img_overlay">
											<span class="isw-favorite" style="margin-right: 0px;"></span>
											 
											<a class="btn btn-danger btn-small" onclick="delete_property_image2('<?php echo $v;?>',this);">
											<span class="isw-delete2" style="margin-right: 0px;"></span>
											</a>
											</div>
											</div>
											<?php
											}
									   ?>
									   </div>
										 
										<?php
										$model->image = $image;
								   }
								   ?>
									<?php echo $form->hiddenField($model, 'image', $model->getHtmlOptions('image')); ?>
									<style>
									    .dz-button { display:none; }.dropzone  svg { display:none ;}
									</style>
									
									 <div class="clearfix"><!-- --></div>
									<div id="myId" class="dropzone" title="Click or Drag here to upload photos"></div>
									<script type="text/javascript">
									var myDropzone = new Dropzone("div#myId", { url: "<?php echo Yii::app()->createUrl('place_an_ad/upload',array('no_resize'=>'1')); ?>",addRemoveLinks: true, maxFilesize: 40  , resizeWidth : 856   , acceptedMimeTypes: 'image/jpeg,image/gif,image/webp',}) //according to your forms action
									 myDropzone.on("removedfile", function(file, serverFileName) {
									 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:file.serverId,inp:$("#<?php echo $model->modelName;?>_image").val()},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ; } );
									});
									myDropzone.on("success", function(file,serverFileName) {
										 file.serverId =serverFileName;
										 var vals  = $("#<?php echo $model->modelName;?>_image").val();
										 vals += ","+serverFileName;
										 $("#<?php echo $model->modelName;?>_image").val(vals) ;
										 
									});
									var imgs = $("#<?php echo $model->modelName;?>_image").val(); 
									function delete_property_image(img, val,k)
									{
										 $.post("<?php echo  Yii::app()->createUrl('place_an_ad/delete_image'); ?>",{file:img,inp:val},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ;imgs = data; } );
										 $(k).parent().parent().remove();
									}
									function delete_property_image2(val,k)
									{
					 
										 $.post("<?php echo  Yii::app()->createUrl('place_an_ad/delete_image'); ?>",{file:val,inp:imgs},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ;imgs=data; } );
										 $(k).parent().parent().remove();
									}
									</script>
	</div> 
	 
