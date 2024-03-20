  
<?php $fileField = 'image';$types = '.pdf'; ?>
 <div class="  browse_type row" id="abc_<?php echo $fileField;?>" style="position:absolute;top:-10000px;">
				
				<div class="col-sm-12" style="padding:0px;">
				  
				
				<div class="">
									<div class="" style="padding:0px;float: left;width: auto;margin-right: 10px;" >
				<div id="file_<?php echo $fileField;?>" style="width:100% !important;" class="dropzone" title="Click or Drag here to upload photos"><div class="dz-message" data-dz-message><div class="upload-btn-wrapper"> <div class="drop_fil">Drop files here </div> <div><span class="div_od">or</span></div><div> <button class="btn btn-info" type="button"><i class="fa fa-camera"></i><?php echo $title_text;?></button></div><div class="accepted">Accepted File Formats : <b><?php echo $types;?></b></div> </div></div></div>
				 <input type="hidden" id="PricePlanOrder_img"></div>
				<div class="clearfix"><!-- --></div>
			 
			 
			 
				<!-- PHOTO Upload -->
				<div class="clearfix"><!-- --></div> 
				<div class="_2vNUv" aria-disabled="false">
					 <div class="q_7hS" data-aut-id="imagesPreview">
	<ul class="_3IhNg sortableList">
	 
	</ul>
	<?php
				for($i=0;$i<=1;$i++){
					?>
					<div class="_1SuBk <?php echo  $i==0 ? '_24pdo' :'';?>" onclick="uploadFile()"><div class="_36uzR"><span class="rui-3pJ6W" role="button" tabindex="0" data-aut-id=""><i class="rui-1XUas rui-32Azx" title=""></i></span> <?php echo $i=='0' ? '<div class="e22Bu"><span>'. $title_text.'</span></div>':'';?> </div></div>
					 
					<?
				}
				?>
 </div>
				
				
				</div>
				<div class="clearfix"><!-- --></div> 
				<!-- PHOTO Upload -->
				
				 
				</div>
				
										<div class="property_img_box" id="table_append_boc" style="margin-bottom:20px;">
											
										 </div>
										 
								   <div class="clearfix"></div>
	 
	</div>
				 
				</div>
				</div>
				  
		 
  <div class="clearfix"><!-- --></div>
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('assets/css/place_file.css?q=2');?>" />
 <script type="text/javascript">
	var file_array  = [];; 
	var successbucket  = [];; 
	var rand  =1; ;
	var country_id  = 'PK'; 
	var thumbnail ; 
	var mxFiles = '<?php echo $maxFiles;?>';
	var aFiles = '<?php echo $types;?>';
	var modelName = 'PricePlanOrder';
	var upload_url = '<?php echo Yii::app()->createUrl('place_an_ad/upload',array('width'=>'960')); ?>';
	var fileField = '<?php echo $fileField;?>';
	//according to your forms action
	var imgs = $("#"+modelName+"_image").val(); 
	var delete_image_url =  ''; 
	var myVar;
	var modelName  = '<?php echo $model->modelName;?>';
	var sort_url = '<?php echo Yii::app()->createUrl('place_an_ad/chnimge');?>';
	 
</script>
 <style>._1mplE.loading{ background-color: #eee; }</style>
  <Script>
    
var mdropZone = new Dropzone("div#file_image", { url: upload_url ,addRemoveLinks: true, maxThumbnailFilesize :40 ,timeout: 300000,    acceptedFiles: aFiles,
					
					init: function() {
					  	  
					 
						this.on('sending', function(file, xhr, formData){
							loadDiv.html(ldHtml)
						 
							
						}),
						this.on("success", function(file, serverFileName) {
							    successUpload1 =   successUpload; 
							    successUpload1 = successUpload1.replace("[ULINK]", 'https://www.arabavenue.com/site/Pdf_contract?f='+serverFileName);
							    successUpload1 = successUpload1.replace("[UDLINK2]", 'https://www.arabavenue.com/site/Pdf_contract?dw=1&f='+serverFileName);
							    successUpload1 = successUpload1.replace("[DUID]", loadDivuid);
							    $.get(update_pdf,{'uid':loadDivuid,'u_contract':serverFileName},function(data){ var dat = JSON.parse(data);if(dat.status=='1'){  loadDiv.html(successUpload1);   } })
							  return false; 
					 
						}),
						this.on("error", function(file,errorMessage) {
									  	mdropZone.removeFile(file);  
						errorAlert('Error',errorMessage);
						  

						})
					 
					}
					
					})
	  function uploadFile(){
				  $('#file_image').click();
			  }
			  
			   
  </Script>
 
