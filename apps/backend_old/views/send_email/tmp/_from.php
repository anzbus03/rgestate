	<div class="form-group">
								<?php
								if($model->status=='S'){
								echo '<div class="pull-right"><a href="javascript:void(0)" data-title="Delivery Status" data-href="'.Yii::app()->createUrl('send_email/view_status',array('id'=>$model->primaryKey)).'" onclick="loadPajax(this);">View Delivery   Status</a></div>';
								}
								?>

								<?php echo $form->dropDownList($model, 'receipeints',$model->modelRelatedValArray,$model->getHtmlOptions('receipeints',array('class'=>'selectTwo','multiple'=>true,'data-href'=>Yii::app()->createUrl('ajax/search',array('selectTwo'=>'1','searchType'=>'email')),'style'=>'width:100%;' ))); ?>
								<?php echo $form->error($model, 'receipeints');?>
								<div class="clearfix"><!-- --></div>
								</div>
								<div class="clearfix"><!-- --></div>
								<div class="form-group">

								<?php echo $form->textField($model, 'subject',$model->getHtmlOptions('subject')); ?>
								<?php echo $form->error($model, 'subject');?>
								</div>
								<div class="form-group">
								<div class="pull-right">
								<?php echo CHtml::activeDropDownList($model, 'email_template', CHtml::listData(CustomerEmailTemplate::model()->findAll(array('select'=>'template_id,name')),'template_id','name'), $model->getHtmlOptions('email_template',array('empty'=>'Default Template','onchange'=>'return ChangeContent(this)'))); ?>

								</div>

								<?php echo $form->textArea($model, 'message', $model->getHtmlOptions('message', array('rows' => 8))); ?>
								<?php echo $form->hiddenField($model, 'status'); ?>
								<?php echo $form->error($model, 'message');?>
								</div>
								<div class="form-group"  onClick="$('.VissibleHiiden').css('display','block');$(this).hide(); ">
								<div class="btn btn-default btn-file">
								<i class="fa fa-paperclip"></i>   Attachment
								</div>
								</div>

								<div class="form-group">

								<?php echo $form->labelEx($model, 'attach_crm_files'); ?>
								<?php echo $form->dropDownList($model, 'attach_crm_files',CHtml::listData(Files::model()->ListFilesFromArray((array) $model->attach_crm_files),'note_id','description'),$model->getHtmlOptions('attach_crm_files',array('class'=>'selectTwo','multiple'=>true,'data-href'=>Yii::app()->createUrl('ajax/filesData'),'style'=>'width:100%;' ))); ?>
								<?php echo $form->error($model, 'attach_crm_files');?>
								<div class="clearfix"><!-- --></div>
								</div>
								<div class="clearfix"><!-- --></div>
								<?php 
								if(!empty($model->imageArray))
								{
								?>
								<div class="property_img_box" style="margin-bottom:20px;">

								<?php
								$image = "";
								foreach($model->imageArray as $k=>$v)
								{

								$image .= ",".$v;
								?>
								<div id="property_img_<?php echo $k;?>" class="property_img">
								<img src="<?php echo Email::model()->getImageThumb($v);?>"  >
								<div class="property_img_overlay">
								<span class="isw-favorite" style="margin-right: 0px;"></span>
								</a>
								<a class="btn btn-danger btn-small" onclick="delete_property_image2('<?php echo $v;?>',this,'<?php echo $model->id;?>');">
								<span class="isw-delete2" style="margin-right: 0px;"><i class="glyphicon glyphicon-trash"></i></span>
								</a>
								</div>
								</div>
								<?
								}
								?>
						 
								<?php
								$model->image = $image;
								}
								?>
								<div class="VissibleHiiden" style="display:none;">
								<?php echo $form->hiddenField($model, 'image', $model->getHtmlOptions('image')); ?>
								<div class="clearfix"><!-- --></div>
								<div style="height:20px;color:#4E4E4E;font-size:16px;background:#EAEAEA;padding:15px 0px 35px 15px;">Drag and drop Photos here or click below to select photos from your computer </div> 
								<div  style="height:15px;color:#4E4E4E;font-size:12px; ;padding:12px 0px 25px 7px;">Hint: <font color="#cc0001">File types allowed</font>: <?php echo OptionCommon::ExtensionArray() ;?> <font color="#cc0001"> Max Fiie size </font> <?php echo  Yii::app()->options->get('system.common.document_maximum_file_size_in_MB',2);?>  MB</div>
								<div id="myId" class="dropzone" title="Click or Drag here to upload photos"></div>

								<script type="text/javascript">

								var myDropzone = new Dropzone("div#myId", { url: "<?php echo $this->createUrl('send_email/upload'); ?>",addRemoveLinks: true, maxFilesize: <?php echo  Yii::app()->options->get('system.common.document_maximum_file_size_in_MB',2);?> , acceptedMimeTypes: '<?php echo OptionCommon::MimeTypesList() ;?>',}) //according to your forms action
								myDropzone.on("removedfile", function(file, serverFileName) {
								$.post("<?php echo $this->createUrl('send_email/delete_image'); ?>",{file:file.serverId,inp:$("#<?php echo $model->modelName;?>_image").val()},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ; } );
								});
								myDropzone.on("error", function(file, message) { 
								alert(message);
								this.removeFile(file); 
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
								$.post("<?php echo $this->createUrl('send_email/delete_image'); ?>",{file:img,inp:val},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ;imgs = data; } );
								$(k).parent().parent().remove();
								}
								function delete_property_image2(val,k,leadid)
								{

								$.post("<?php echo $this->createUrl('send_email/delete_image'); ?>",{file:val,inp:imgs,lead:leadid},function(data){  $("#<?php echo $model->modelName;?>_image").val(data) ;imgs=data; } );
								$(k).parent().parent().remove();
								}
selectTwo();
								</script>
								</div>
