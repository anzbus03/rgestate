 

 <div class="form-group col-lg-12 float-left " style="width:237px">
 <?php 
 $options = Yii::app()->options; 
 
	$resize_width  = $options->get('system.upload.agent_avatar_resize_width','100');
	$resize_height = $options->get('system.upload.agent_avatar_resize_width','100');
 
	 
	$image_name="";
	$class="hidden";
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
				<li>Maximum size : <b>1MB</b></li>
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
			 
				
				<div class="clearfix"><!-- --></div> 
				<?php echo $form->error($user, 'image');?>    
				</div>
				  
				 
                <div class="clearfix"><!-- --></div>
               </div>
				<?php
				if(!empty($user->image)){
				echo '<div id="imgd" style="width:210px;height:210px;border:1px solid #eee; margin-top:10px; margin-bottom:10px;"><div style="background-image:url('.$user->UserAvatarUrl.');background-size:ccontain;background-size: contain;width:200px;height:200px;margin:auto;background-repeat:  no-repeat;background-position: center center;" /></div><div class="clearfix"><!-- --></div></div>';
				echo '<div class="clearfix"><!-- --></div><div style="width:200px;text-align:center;margin-top:10px;" id="change_div"><a href="javascript:void(0)" onclick="openUpdator()" class="btn btn-primary btn-xs" >Change</a></div>';
				}
			 ?>
				
            </div>
            </div>
            
               
 
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
				var newCropUrl = '<?php echo Yii::app()->createUrl('developers/image_crop');?>'
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
<div class="modal fade" id="modal_cropper" style="width:90%;margin:auto;background:unset !important; " aria-labelledby="modalLabel" role="dialog" tabindex="-1">
      <div class="modal-dialog" role="document" style="width:100%;">
        <div class="modal-content">
          <div class="modal-header">
			  <h4 class="modal-title" id="modalLabel" style="width:100%;">Crop the image
			   <button type="button"  style="float:right" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 
			  </h4>
            
            
            <div class="clearfix"></div>
          </div>
          <div class="modal-body no-padding-left" style="padding-left:10px !important;">
        <form id="cropImage"> 
           
      <div class="  docs-buttons" style="width:120px;float:left">
        <!-- <h3>Toolbar:</h3> -->
		<div class="btn-group">
          <button type="button" class="btn btn-primary fullWidth main" data-method="crop" title="Crop" onclick="SaveCropedImage()">
            Crop & Save
          </button>
         
        </div>

		<div class="btn-group " style="width:100%;padding:0px ">
          <button type="button" class="btn btn-primary  col-sm-6" data-method="crop" title="Crop" onclick="$('#crp_image').cropper('crop')">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$().cropper(&quot;crop&quot;)">
              <span class="fa fa-check"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary  col-sm-6" style="float:right:important;"data-method="clear" title="Clear" onclick="$('#crp_image').cropper('clear')">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$().cropper(&quot;clear&quot;)">
              <span class="fa fa-remove"></span>
            </span>
          </button>
        </div>

        <div class="btn-group"  style="width:100%;padding:0px ">
          <button type="button" class="btn btn-primary col-sm-6" data-method="zoom" data-option="0.1" title="Zoom In" onclick="$('#crp_image').cropper('zoom', 0.1)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('zoom', 0.1)">
              <span class="fa fa-search-plus"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary col-sm-6" data-method="zoom" data-option="-0.1" title="Zoom Out"  onclick="$('#crp_image').cropper('zoom', -0.1)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('zoom', -0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
          </button>
        </div>

        <div class="btn-group" style="width:100%;padding:0px ">
          <button type="button" class="btn btn-primary col-sm-6" data-method="move" data-option="-10" data-second-option="0" onclick="$(#crp_image).cropper('move', -10, 0)" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$(#crp_image).cropper('move', -10, 0)">
              <span class="fa fa-arrow-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary col-sm-6" data-method="move" data-option="10" data-second-option="0" title="Move Right" onclick="$('#crp_image').cropper('move', 10, 0)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 10, 0)">
              <span class="fa fa-arrow-right"></span>
            </span>
          </button>
        
        </div>

        <div class="btn-group" style="width:100%;padding:0px ">
			  <button type="button" class="btn btn-primary col-sm-6" data-method="move" data-option="0" data-second-option="-10" title="Move Up"  onclick="$('#crp_image').cropper('move', 0, -10)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 0, -10)">
              <span class="fa fa-arrow-up"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary col-sm-6" data-method="move" data-option="0" data-second-option="10" title="Move Down"  onclick="$('#crp_image').cropper('move', 0, 10)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 0, 10)">
              <span class="fa fa-arrow-down"></span>
            </span>
          </button>
           </div>
        <div class="btn-group" style="width:100%;padding:0px ">
          <button type="button" class="btn btn-primary col-sm-6" data-method="rotate" data-option="-45" title="Rotate Left"  onclick="$('#crp_image').cropper('rotate', -45)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate', -45)">
              <span class="fa fa-rotate-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary col-sm-6" data-method="rotate" data-option="45" title="Rotate Right"  onclick="$('#crp_image').cropper('rotate', 45)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate', 45)">
              <span class="fa fa-rotate-right"></span>
            </span>
          </button>
        </div>




        <div class="btn-group" style="width:100%;padding:0px ">
          <button type="button" class="btn btn-primary col-sm-6" data-method="scaleX" data-option="-1" title="Flip Horizontal"  onclick="$('#crp_image').cropper('scaleX', -1)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('scaleX', -1)">
              <span class="fa fa-arrows-h"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary col-sm-6" data-method="scaleY" data-option="-1" title="Flip Vertical" onclick="$('#crp_image').cropper('scaleY', -1)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('scaleY', -1)">
              <span class="fa fa-arrows-v"></span>
            </span>
          </button>
        </div>

     
  
 
		<div class="btn-group"  style="width:100%;padding:0px ">
				<button type="button" class="btn btn-primary col-sm-12" data-method="moveTo" data-option="0"  onclick="$('#crp_image').cropper('move',0)" >
				<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper.moveTo(0)">
				Move   [0,0]
				</span>
				</button>
	    </div>
	 
		<div class="btn-group"  style="width:100%;padding:0px ">
				<button type="button" class="btn btn-primary col-sm-12" data-method="rotateTo" data-option="180"  onclick="$('#crp_image').cropper('rotate',180)" >
				<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate',180)">
				Rotate 180°
				</span>
				</button>
	    </div>
        
       
       
       
        
      </div><!-- /.docs-buttons -->

      <div class="col-md-10" style=" width: calc(100% - 120px) ! important;float:left">
              <img id="crp_image" src="" alt="Picture">
            </div>
            
            <div class="clearfix"></div>
            
            </form> 
          </div>
         
        </div>
      </div>
    </div>

