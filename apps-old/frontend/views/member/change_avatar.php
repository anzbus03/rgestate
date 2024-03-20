<?php defined('MW_PATH') || exit('No direct script access allowed');  ?>
 
	 
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title"><?php if($model->user_type=='D'){ echo 'Change Logo'; }else{ echo 'Change Avatar';};?></h4>
                   
                      <?php  ; ?> 
                      <?php $this->renderPartial('_change_avatar',array('user'=>$model));?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
       
                

 
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

