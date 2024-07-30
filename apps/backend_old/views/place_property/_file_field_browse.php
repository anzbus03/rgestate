  

 <div class="browse_type row" id="abc_<?php echo $fileField;?>">
				
				<div class="col-sm-12" style="padding:0px;">
					<h3 class="subHeadh2 padding-bottom-0"> Upload Images <br /><span class="rui-qvKkT1">Hint: File types allowed:<?php echo $types;?>, Maximum filesize : <?php echo $maxFilesize;?>MB </span> </h3>
				
				<div class="">
									<div class="" style="padding:0px;float: left;width: auto;margin-right: 10px;" >
				<div id="file_<?php echo $fileField;?>" style="width:100% !important;" class="dropzone" title="Click or Drag here to upload photos"><div class="dz-message" data-dz-message><div class="upload-btn-wrapper"> <div class="drop_fil">Drop files here </div> <div><span class="div_od">or</span></div><div> <button class="btn btn-info" type="button"><i class="fa fa-camera"></i><?php echo $title_text;?></button></div><div class="accepted">Accepted File Formats : <b><?php echo $types;?></b></div><div class="maximum_size">Maximum   file size must  be less than <b><?php echo $maxFilesize;?>MB</b>  </div></div></div></div>
				<div class="alert alert-info" style="width:50%;float: right;display:none !important">
			 
				</div>
				<div class="clearfix"><!-- --></div>
			 
				<div class="clearfix"><!-- --></div> 
				   
				</div>
				
										<div class="property_img_box" id="table_append_boc" style="margin-bottom:20px;">
											<?php 
											$image = "";
											if(!empty($image_array) )
											{
											?>
											<?php
											
											foreach($image_array as $k=>$v)
											{
												$image .= ",".$v;
											?>
											<div id="property_img_<?php echo $k;?>" class="property_img">
											<img src="<?php echo ENABLED_AWS_PATH.$v  ?>" style="width:140px;">
											<div class="property_img_overlay">
											<span class="isw-favorite" style="margin-right: 0px;"></span>
										 
											<a class="btn btn-danger btn-small" onclick="delete_property_image2('<?php echo $v;?>',this);">
											<span class="isw-delete2" style="margin-right: 0px;"></span>
											</a>
											</div>
											</div>
											<?
											}
											}
									   ?>
										 </div>
										<?php
										$model->image = $image;
								    
								   ?>
								   <div class="clearfix"></div>
	<?php echo $form->error($model,  $fileField );?> 
	</div>
				<?php echo $form->hiddenField($model,  $fileField , $model->getHtmlOptions( $fileField )); ?>
				</div>
				</div>
				  
			  
                <div class="clearfix"><!-- --></div>
 <script type="text/javascript">
				var <?php echo $fileField;?><?php echo $fileField;?> = new Dropzone("div#file_<?php echo $fileField;?>", { url: "<?php echo Yii::app()->createUrl('place_an_ad/upload'); ?>",addRemoveLinks: true, maxFilesize: <?php echo $maxFilesize;?> ,maxFiles:<?php echo $maxFiles;?>,  acceptedFiles: "<?php echo $types;?>",}) //according to your forms action
				/*
				<?php echo $fileField;?><?php echo $fileField;?>.on("removedfile", function(file, serverFileName) {
				$.post("<?php echo Yii::app()->createUrl('place_an_ad/delete_image'); ?>",{file:file.serverId,inp:$("#<?php echo $model->modelName;?>_<?php echo $fileField;?>").val()},function(data){  $("#<?php echo $model->modelName;?>_<?php echo $fileField;?>").val(data) ; } );
				});
				*/
				<?php echo $fileField;?><?php echo $fileField;?>.on("success", function(file,serverFileName) {
								 
									var vals  = $("#<?php echo $model->modelName;?>_image").val();
									vals += ","+serverFileName;
									$("#<?php echo $model->modelName;?>_image").val(vals) ;
										 
			//	$("#<?php echo $model->modelName;?>_<?php echo $fileField;?>").val(serverFileName) ;
				
				//$("#table_append_<?php echo $fileField;?>").closest('table').removeClass('hide');
				//alert($("#table_append_<?php echo $fileField;?>").closest('table').find('tr').length);
				//$("#table_append_<?php echo $fileField;?>").before('<tr><td><input type="text" class="form-control"  maxlength="150"   name="<?php echo $fileField;?>[title][]"/></td><td><input type="hidden" class="form-control" name="<?php echo $fileField;?>[file][]" value="'+serverFileName+'" /><a class="btn btn-xs btn-primary" target="_blank" style="width:100%" href="<?php echo ENABLED_AWS_PATH ;?>'+serverFileName+'">View</a></td><td><a href="javascript:remove()" data-id="<?php echo $fileField;?>" onclick="removeThisRow(this)" ><i class="fa fa-trash"></i></a></td></tr>')
				$("#table_append_boc").append('<div id="property_img_0" class="property_img"><img src="<?php echo ENABLED_AWS_PATH ;?>'+serverFileName+'" style="width:140px;"><div class="property_img_overlay"><span class="isw-delete" style="margin-right: 0px;"></span> <a class="btn btn-danger btn-small" onclick=delete_property_image2("'+serverFileName+'",this) ><span class="isw-delete2" style="margin-right: 0px;"></span></a></div></div>')
				<?php echo $fileField;?><?php echo $fileField;?>.removeAllFiles();  

				});
				<?php echo $fileField;?><?php echo $fileField;?>.on("error", function(file,errorMessage) {
				   
    errorAlert('Error',errorMessage);

        // i remove current file
        <?php echo $fileField;?><?php echo $fileField;?>.removeFile(file);
     
				});
				</script>
				<style>
					.browse_type .upload-btn-wrapper .btn {

    width: 100%;
    height: 100px;

}
					div.property_img_box div.property_img {
    line-height: 90px !important;margin-right:10px;
}
i.fa-camera{

    display: block;
    
    font-size: 24px;
    margin-bottom: 10px;

}
#file_image .btn.btn-info{ padding:10px; font-size:13px;}
div.property_img_box div.property_img {
    width: 100px;
    height: 100px;
    display: inline-block;
    overflow: hidden;
}
				#file_<?php echo $fileField;?>.dropzone { width:100px; min-height:unset !important;padding:10px;background:transparent;border: 0px;padding: 0px !important; }
				#file_<?php echo $fileField;?>.dropzone a.dz-remove {  margin-top: 0px; width:100%;}
				#file_<?php echo $fileField;?>.dropzone.dz-started .dz-message {  display:none;;}
				#file_<?php echo $fileField;?>.dropzone .dz-preview,#file_<?php echo $fileField;?> .dropzone-previews .dz-preview{ border:0px !important; margin: 0px;}
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
			    .browse_type .dropzone .dz-message .upload-btn-wrapper { padding:0px; box-shadow:unset; max-width:100px;}
			    .browse_type .upload-btn-wrapper .btn { width:100%}
			    .browse_type .dropzone .dz-preview,.browse_type .dropzone-previews .dz-preview {width: 100px;  box-shadow:unset !important; padding:0px; }
			    .browse_type .dropzone .dz-preview .dz-details, .browse_type .dropzone-previews .dz-preview .dz-details {   display:none !important;  position: absolute !important;   height: 50px !important;  right: 0px; }
			    .browse_type  .dropzone .dz-preview .dz-details img,.browse_type .dropzone-previews .dz-preview .dz-details img { display:none; }
			   .browse_type  .dropzone .dz-preview .dz-progress,.browse_type .dropzone-previews .dz-preview .dz-progress {    top: 30px !important;    left: 0px !important;    right: 6px !important; }
			  .browse_type label { margin-bottom:0px; line-height: 1.5;}
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
}
.textFields2.error {
    background: 
    #F9E0EF;
}
				</style>
				              
<script>
function removeThisRow(k,){
	var ids = $(k).attr('data-id')
	$(k).parent().parent().remove();
	if($('#table_'+ids).find('tr').length==2){
	 
		$('#table_'+ids).addClass('hide');
	}
}
	var imgs = $("#<?php echo $model->modelName;?>_image").val(); 
function delete_property_image2(val,k)
									{
										imgs = $("#<?php echo $model->modelName;?>_image").val(); 
										$.post("<?php echo  Yii::app()->createUrl($this->id.'/delete_image'); ?>",{file:val,inp:imgs},function(data){  $("#PlaceAnAd_image").val(data) ;imgs=data; } );
										$(k).parent().parent().remove();
									}
</script>
