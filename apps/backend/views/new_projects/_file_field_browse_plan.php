 
<?php 
$html = '';
$post = array();
      if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
				 
					$pTypes =  $model->adFloorPlans ;
					if(!empty($pTypes )){
					foreach($pTypes as $pos){
						$post['title'][] =  $pos->floor_title;
						$post['file'][] =  $pos->floor_file;
						$post['sqft'][] =  $pos->sqft;
						$post['file_type'][] =  $pos->file_type;
						 
					}
					}
					
					
					}else{
					$post =  Yii::App()->request->getPost($fileField,array());
		}
      if(!empty($post)){ 
		 
		for($i= 0 ; $i< sizeOf($post['title']);$i++){
			$i_class = '';
				if(empty( $post['title'][$i]))
						{
							$i_class = 'error';
						
					}
						if (strpos($post['file'][$i] ,'/') !== false) { 
						$path_file = Yii::app()->apps->getBaseUrl('uploads/files/'.	$post['file'][$i] );
					}
					else{
						$path_file = ENABLED_AWS_PATH.$post['file'][$i];
					}
			$html .= '<tr class="'; $html .= empty( $post['title'][$i]) ? 'textFields2 error' : '';  $html .='"><td><input type="text" class="form-control" name="'.$fileField.'[title][]" style="float: left;width: calc(100% - 100px);" maxlength="150"  value="'. $post['title'][$i].'" /><select  class="form-control" style="max-width: 100px;float: left;"  name="'.$fileField.'[file_type][]"><option value="0">Normal</option><option value="1" ' ; if(isset($post['file_type'][$i]) and $post['file_type'][$i] =='1' ) { $html .=' selected '; } $html .='>3D</option></select></td><td><input type="hidden" class="form-control" name="'.$fileField.'[file][]" value="'. $post['file'][$i].'" /><input type="text" class="form-control" name="'.$fileField.'[sqft][]" value="'. $post['sqft'][$i].'" /></td><td><a href="javascript:remove()" data-id="'.$fileField.'" onclick="removeThisRow(this)" ><i class="fa fa-trash"></i></a> &nbsp; &nbsp;<a class="fa fa-eye" target="_blank"   href="'.$path_file.'"></a></td></tr>';
		};  
	  }


 ?>
<div class="">
 <div class="<?php echo !empty($model->$fileField) ? 'hidden' : '';?> browse_type row" id="abc_<?php echo $fileField;?>">
				
				<div class="col-sm-12" style="padding:0px;">
				<div class="subhead font_s ros subhead_img" style="padding-right:10px;">Add <?php echo $model->getAttributeLabel( $fileField);?> <span class="pull-right">Hint: File types allowed:<?php echo $types;?>, Maximum filesize : <?php echo $maxFilesize;?>MB </span></div>
				<div class="col-lg-12">
<table class="table table-bordered  table-striped  " style="margin-bottom:10px;" id="table_<?php echo $fileField ;?>" >
	<tr><th>Floor Plan Title</th><th width="100px">SQFT</th><th width="50px">Options</th></tr>
	<?php echo $html;?>
	<tr id="table_append_<?php echo $fileField;?>"><th colspan="100%" >
	<div class="col-sm-12" style="padding:0px;" >
				<div id="file_<?php echo $fileField;?>" style="width:100% !important;" class="dropzone" title="Click or Drag here to upload photos"><div class="dz-message" data-dz-message><div class="upload-btn-wrapper"> <div class="drop_fil">Drop files here </div> <div><span class="div_od">or</span></div><div> <button class="btn btn-default"  style="height:auto;" type="button"><?php echo $title_text;?></button></div><div class="accepted">Accepted File Formats : <b><?php echo $types;?></b></div><div class="maximum_size">Maximum   file size must  be less than <b><?php echo $maxFilesize;?>MB</b>  </div></div></div></div>
				<div class="alert alert-info" style="width:50%;float: right;display:none !important">
			 
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
			//	$("#<?php echo $model->modelName;?>_<?php echo $fileField;?>").val(serverFileName) ;
				
				$("#table_append_<?php echo $fileField;?>").closest('table').removeClass('hide');
				//alert($("#table_append_<?php echo $fileField;?>").closest('table').find('tr').length);
				$("#table_append_<?php echo $fileField;?>").before('<tr><td><input type="text" class="form-control"  maxlength="150" style="float: left;width: calc(100% - 100px);"    name="<?php echo $fileField;?>[title][]"/><select  class="form-control" style="max-width: 100px;float: left;"  name="<?php echo $fileField;?>[file_type][]"><option value="0">Normal</option><option value="1"  >3D</option></select></td><td><input type="text" class="form-control"  maxlength="50"   name="<?php echo $fileField;?>[sqft][]"/><input type="hidden" class="form-control" name="<?php echo $fileField;?>[file][]" value="'+serverFileName+'" /></td><td><a href="javascript:remove()" data-id="<?php echo $fileField;?>" onclick="removeThisRow(this)" ><i class="fa fa-trash"></i></a>&nbsp;&nbsp;<a class="fa fa-eye" target="_blank"  href="<?php echo Yii::app()->apps->getBaseUrl('uploads/files');?>'+'/'+serverFileName+'"></a></td></tr>')
				<?php echo $fileField;?><?php echo $fileField;?>.removeAllFiles();  

				});
				<?php echo $fileField;?><?php echo $fileField;?>.on("error", function(file,errorMessage) {
				   
    errorAlert('Error',errorMessage);

        // i remove current file
        <?php echo $fileField;?><?php echo $fileField;?>.removeFile(file);
     
				});
				</script>
				<style>
					#table_floor_plan td { padding:1px; text-align:center;vertical-align:middle;  }
				#file_<?php echo $fileField;?>.dropzone { width:200px; min-height:unset !important;padding:10px;background:transparent;border: 0px;padding: 0px !important; }
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
			    .browse_type .dropzone .dz-message .upload-btn-wrapper { padding:0px; box-shadow:unset; max-width:200px;}
			    .browse_type .upload-btn-wrapper .btn { width:100%}
			    .browse_type .dropzone .dz-preview,.browse_type .dropzone-previews .dz-preview {width: 200px;  box-shadow:unset !important; padding:0px; }
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
				<div class="clearfix"><!-- --></div> 
				   
				</div>
				
	</th></tr>
	
	</table>
	<?php echo $form->error($model,  $fileField );?> 
	</div>
				<?php echo $form->hiddenField($model,  $fileField , $model->getHtmlOptions( $fileField )); ?>
				</div>
				</div>
				  
	</div>		  
                <div class="clearfix"><!-- --></div>
               
<script>
function removeThisRow(k,){
	var ids = $(k).attr('data-id')
	$(k).parent().parent().remove();
	if($('#table_'+ids).find('tr').length==2){
	 
	//	$('#table_'+ids).addClass('hide');
	}
}
</script>

