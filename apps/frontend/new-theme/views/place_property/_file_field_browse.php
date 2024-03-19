  

 <div class="  browse_type row" id="abc_<?php echo $fileField;?>">
				
				<div class="col-sm-12" style="padding:0px;">
				    <h4 class="subheading_font row "><?php echo Yii::t('app',$this->tag->getTag('upload_up_to_{n}_photos','Upload up to {n} photos'),array('{n}'=>$maxFiles));?> <br /><span class="rui-qvKkT1"><?php echo $this->tag->getTag('hint:_file_types_allowed','Hint: File types allowed');?>:<span dir="ltr"><?php echo $types;?></span> </span>  </h4>
				 
				
				<div class="">
									<div class="" style="padding:0px;float: left;width: auto;margin-right: 10px;" >
				<div id="file_<?php echo $fileField;?>" style="width:100% !important;" class="dropzone" title="Click or Drag here to upload photos"><div class="dz-message" data-dz-message><div class="upload-btn-wrapper"> <div class="drop_fil">Drop files here </div> <div><span class="div_od">or</span></div><div> <button class="btn btn-info" type="button"><i class="fa fa-camera"></i><?php echo $title_text;?></button></div><div class="accepted">Accepted File Formats : <b><?php echo $types;?></b></div><div class="maximum_size">Maximum   file size must  be less than <b><?php echo $maxFilesize;?>MB</b>  </div></div></div></div>
				<div class="alert alert-info" style="width:50%;float: right;display:none !important">
			 
				</div>
				<div class="clearfix"><!-- --></div>
			 
			 
			 
				<!-- PHOTO Upload -->
				<div class="clearfix"><!-- --></div> 
				<div class="_2vNUv" aria-disabled="false">
					 <div class="q_7hS" data-aut-id="imagesPreview">
	<ul class="_3IhNg sortableList">
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
											<li class="_1mplE" data-image="<?php echo $v;?>" draggable="true"><div class="_3BJtT" data-aut-id="listSortable"><div class="_20pqz" style="background-image: url('<?php echo $model->detailView($v)  ?>');" data-aut-id="image"></div><a class="_1cS9Q" onclick="delete_property_image2('<?php echo $v;?>',this);"><span class="rui-1XUas rui-3_XwO"></span></a></div><a href="javascript:void(0)" class="coverimg" onclick="setThiscover(this)" ><?php echo $this->tag->getTag('set_cover','Set Cover');?></a></li>
											 
											<?php
											}
											}
									   ?>
	</ul>
	<?php
				for($i=0;$i<=19;$i++){
					?>
					<div class="_1SuBk <?php echo  $i==0 ? '_24pdo' :'';?>" onclick="uploadFile()"><div class="_36uzR"><span class="rui-3pJ6W" role="button" tabindex="0" data-aut-id=""><i class="rui-1XUas rui-32Azx" title=""></i></span> <?php echo $i=='0' ? '<div class="e22Bu"><span>'. $title_text.'</span></div>':'';?> </div></div>
					 
					<?php
				}
				?>
 </div>
				
				
				</div>
				<div class="clearfix"><!-- --></div> 
				<!-- PHOTO Upload -->
				
				 
				</div>
				
										<div class="property_img_box" id="table_append_boc" style="margin-bottom:20px;">
											
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
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->apps->getBaseUrl('assets/css/place_file.css?q=2');?>" />
 <script type="text/javascript">
	var file_array  = [];; 
	var successbucket  = [];; 
	var rand  =1; ;
	var country_id  = 'AE'; 
	var thumbnail ; 
	var mxFiles = '<?php echo $maxFiles;?>';
	var aFiles = '<?php echo $types;?>';
	var modelName = '<?php echo $model->modelName;?>';
	var upload_url = '<?php echo Yii::app()->createUrl('place_an_ad/upload',array('width'=>'960')); ?>';
	var fileField = '<?php echo $fileField;?>';
	//according to your forms action
	var imgs = $("#"+modelName+"_image").val(); 
	var delete_image_url =  '<?php echo  Yii::app()->createUrl($this->id.'/delete_image'); ?>'; 
	var myVar;
	var modelName  = '<?php echo $model->modelName;?>';
	var sort_url = '<?php echo Yii::app()->createUrl('place_an_ad/chnimge');?>';
	$(document).ready(function () {										 
		sortable2();	
		rowCountCalc();								 
	});
</script>
 <style>._1mplE.loading{ background-color: #eee; }</style>
 <script type="text/javascript" src="<?php echo Yii::app()->apps->getBaseUrl('assets/js/place_file_script.js?q=204');?>"></script>
 
