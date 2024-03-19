<?php 
$form=$this->beginWidget('CActiveForm', array(
'id'=>'signup-form',
'enableAjaxValidation'=>true,
 
'clientOptions' => array(
'validateOnSubmit'=>true,
'validateOnChange'=>true,
),
'action'=>Yii::app()->createUrl("member/my_avatar",array('return'=>@$return ))
)); 
	
			   
 ?> 

 <div class="form-group col-lg-12 float-left " style="width:237px">
 <?php 
 $options = Yii::app()->options; 
 if($user->user_type=='D'){
	  $resize_width  = $options->get('system.upload.developer_avatar_resize_width','100');
 $resize_height = $options->get('system.upload.developer_avatar_resize_height','100');
 }
 
 else if($user->user_type=='A'){
	  $resize_width  = $options->get('system.upload.agent_avatar_resize_width','100');
 $resize_height = $options->get('system.upload.agent_avatar_resize_width','100');
 }
 else{ 
 $resize_width  = $options->get('system.upload.avatar_resize_width','100');
 $resize_height = $options->get('system.upload.avatar_resize_height','100');
 }
 
  $resize_width  = 500;
 $resize_height = 500;
	$class="hidden";
	$image_name="";
	if(!empty($user->image)){
	$image_name=Yii::app()->apps->getBaseUrl('uploads/images/'.$user->image);
	$class="";
	}

 ?>
				<div class="col-lg-12  no-padding">
				<?php echo $form->labelEx($user, 'image');?>
				<?php echo $form->hiddenField($user, 'image', $user->getHtmlOptions('image')); ?>
				<?php 	echo '<a href="javascript:void(0)" data-width="'.$resize_width.'" data-height="'.$resize_height.'" class="pull-right btn btn-xs btn-primary '.$class.'" id="cropEnable" onclick="showCropp(this)" data-com-img="'.Yii::app()->apps->getBaseUrl('uploads/images/image_name').'"  data-img="'.$image_name.'" >Crop</a>';;
?>
				<div class="clearfix"><!-- --></div>
                <div class="<?php echo !empty($user->image) ? 'hidden' : '';?>"  id="avatar_updator">
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
				$('#cropEnable').attr('data-img',saveUrl2)
				

				});
				var newCropUrl = '<?php echo Yii::app()->createUrl('site/image_crop');?>'
				 function openUpdator(){
					 $('#imgd').addClass('hidden');
					 $('#change_div').addClass('hidden');
					 $('#avatar_updator').removeClass('hidden');
				 }
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
				  
				 
                <div class="clearfix"><!-- --></div>
                  <div class="box-footer"  style="width:200px" >
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
                </div> 
				</div>
				<?php
				 if(!empty($user->image)){
				 echo '<div id="imgd" style="width:210px;height:210px;border:1px solid #eee; margin-top:10px; margin-bottom:10px;"><div style="background-image:url('.$user->UserAvatarUrl.');background-size:ccontain;background-size: contain;width:200px;height:200px;margin:auto;background-repeat:  no-repeat;background-position: center center;" /></div><div class="clearfix"><!-- --></div></div>';
				 echo '<div class="clearfix"><!-- --></div><div style="width:200px;text-align:center;margin-top:10px;" id="change_div"><a href="javascript:void(0)" onclick="openUpdator()" class="btn btn-primary btn-xs" >Change</a></div>';
				 
 
				 
			 }
			 ?>
				
            </div>
            
               
<?php $this->endWidget(); ?> 
