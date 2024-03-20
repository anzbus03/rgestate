 
 <div class=" browse_type row col-sm-12  form-group" style="display:block;" id="abc_<?php echo $fileField;?>">
				
				<div class="row"  >
						
				<div class="col-sm-12">
				<div class="clearfix"></div>
				<?php echo $form->labelEx($user, $fileField);?>
				<div class="clearfix"></div>
									<div class="pull-left margin-right-10" style="padding:0px; width: auto; " >
				<div id="file_<?php echo $fileField;?>"  class="dropzone" title="Click or Drag here to upload photos"><div class="dz-message" data-dz-message><div class="upload-btn-wrapper"> <div class="drop_fil">Drop files here </div> <div><span class="div_od">or</span></div><div> <button class="btn btn-info" type="button"><i class="fa fa-camera"></i><?php echo $title_text;?></button></div><div class="accepted">Accepted File Formats : <b><?php echo $types;?></b></div><div class="maximum_size">   </div></div></div></div>
				<div class="alert alert-info" style="width:50%;float: right;display:none !important">
			 
				</div>
				<div class="clearfix"><!-- --></div>
			 
				<div class="clearfix"><!-- --></div> 
				   
				</div>
				
										<div class="property_img_box" id="table_append_<?php echo $fileField;?>"  >
											<?php 
											$image = "";
											if(!empty($user->$fileField) )
											{
											?>
											<?php
											
										 
												$image .= $user->$fileField;
											?>
											<div id="property_img_<?php echo $fileField;?>" class="property_img">
											 <?php
											 if($fileField=='image')
											 {
											     ?>
											 	<img src="<?php echo  $user->SingleImage ;?>" style="width:140px;">
										    	 <?
											  
											 }else{ ?> 
											<img src="<?php echo $user->detailFile($user->$fileField) ;?>" style="width:140px;">
											<?php } ?> 
											<div class="property_img_overlay">
											<span class="isw-favorite" style="margin-right: 0px;"></span>
										 
											<a class="btn btn-danger btn-small" onclick="delete_property_image2('<?php echo $user->$fileField;?>',this);">
											<span class="isw-delete2" style="margin-right: 0px;"></span>
											</a>
											</div>
											</div>
											<?
											}
											 
									   ?>
										 </div>
										<?php
										$user->$fileField = $image;
								    
								   ?>
								   <div class="clearfix"></div>
								   
		
								   <div class="clearfix"></div>
	<?php echo $form->error($user,  $fileField );?> 
	</div>
				<?php echo $form->hiddenField($user,  $fileField , $user->getHtmlOptions( $fileField )); ?>
				</div>
				</div>
				  
			  
                <div class="clearfix"><!-- --></div>
 <script type="text/javascript">
				var <?php echo $fileField;?><?php echo $fileField;?> = new Dropzone("div#file_<?php echo $fileField;?>", { url: "<?php echo Yii::app()->createUrl('place_an_ad/upload',array('width'=>'400','height'=>'400')); ?>",addRemoveLinks: true,  maxFiles:<?php echo $maxFiles;?>, maxThumbnailFilesize :40 ,timeout: 300000,   resizeWidth :400,   acceptedFiles: "<?php echo $types;?>",}) //according to your forms action
				 
				<?php echo $fileField;?><?php echo $fileField;?>.on("success", function(file,serverFileName) {
								 
									var vals  = $("#<?php echo $user->modelName;?>_<?php echo $fileField;?>").val();
									vals  =  serverFileName;
									$("#<?php echo $user->modelName;?>_<?php echo $fileField;?>").val(vals) ;
										 
										 var fileExt = serverFileName.split('.').pop();
										 if(fileExt=='pdf' || fileExt=='pdf' ){
											 var imgstring  = 'pdf.png';;
										 }
										 else{
											 var imgstring  = serverFileName;
										 }
		 
				$("#table_append_<?php echo $fileField;?>").html('<div id="property_img_0" class="property_img"><img src="<?php echo Yii::app()->apps->getBaseUrl('uploads/files/');?>/'+imgstring+'" style="width:140px;"><div class="property_img_overlay"><span class="isw-delete" style="margin-right: 0px;"></span> <a class="btn btn-danger btn-small" onclick=delete_property_image2("'+serverFileName+'",this) ><span class="isw-delete2" style="margin-right: 0px;"></span></a></div></div>')
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

}#file_image .btn.btn-info {
    
    min-width: 105px;
}
#file_<?php echo $fileField;?> .btn.btn-info{ padding:10px; font-size:13px;}
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
	var imgs = $("#<?php echo $user->modelName;?>_<?php echo $fileField;?>").val(); 
function delete_property_image2(val,k)
									{
										imgs = $("#<?php echo $user->modelName;?>_<?php echo $fileField;?>").val(''); 
										$(k).parent().parent().remove();
									}
</script>
		  
