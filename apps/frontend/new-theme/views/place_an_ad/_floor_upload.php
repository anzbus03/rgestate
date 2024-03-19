	   <div class="form-group col-lg-12">
										<?php echo $form->labelEx($model, 'floor_plan');?>
									   
										<?php echo $form->error($model, 'floor_plan');?>
								
									 <div class="clearfix"><!-- --></div>
									 <?php 
									$floor_array = array();
									if(isset($_POST['PlaceAnAd']['floor_plan'])){
										$exp =  explode(",",$_POST['PlaceAnAd']['floor_plan']);
										if($exp)
										{
											foreach($exp as $k=>$v)
											{
												if($v!="")
												{
													$floor_array[] = $v;
												}
											}
										}
									}
									else if(!$model->isNewRecord){
										$floor = $model->adFloorPlans;
										if(!empty($floor)){
											foreach($floor as $k=>$v)
											{
												$floor_array[] = $v->floor_file;
											}
										}
									}
									
									
									;
								   if(!empty($floor_array) )
								   {
									   
									   ?>
										<div class="property_img_box" style="margin-bottom:20px;">
											
											<?php
											$image2 = "";
											foreach($floor_array as $k=>$v)
											{
												$image2 .= ",".$v;
											?>
											<div id="property_img_<?php echo $k;?>" class="property_img">
											<img src="<?php echo Yii::app()->apps->getBaseUrl('uploads/floor_plan/'.@$v) ?>" style="width:140px;">
											<div class="property_img_overlay">
											<span class="isw-favorite" style="margin-right: 0px;"></span>
											</a>
											<a class="btn btn-danger btn-small" onclick="delete_floor_plan_image2('<?php echo $v;?>',this);">
											<span class="fa fa-remove" style="margin-right: 0px;"></span>
											</a>
											</div>
											</div>
											<?
											}
									   ?>
										</div>
										<?php
										$model->floor_plan = $image2;
								   }
								   ?>
									<?php echo $form->hiddenField($model, 'floor_plan', $model->getHtmlOptions('floor_plan')); ?>
									
									
									 <div class="clearfix"><!-- --></div>
									<div style="color:#4E4E4E;font-size:13px;background:#EAEAEA;padding:15px">Drag and drop Floor Plans here or click below to select photos from your computer <div class="clearfix"></div></div> 
									<div  style="color:#4E4E4E;font-size:12px; ;padding:10px 0px">Hint: File types allowed: <span style="font-size:13px;">(<?php echo Yii::t('setting',$model->generateFormat(),array('.'=>''));?>)</span> Upload ZIP file size : <b>4MB</b> Maximum</span><div class="clearfix"></div></div>
									<div id="floor_plan" class="dropzone" title="Click or Drag here to upload photos"></div>
									<script type="text/javascript">
									var myDropzone2 = new Dropzone("div#floor_plan", { url: "<?php echo Yii::app()->createUrl('place_an_ad/upload_floor_plan'); ?>",addRemoveLinks: true, maxFilesize: 4,  acceptedFiles: "<?php echo $model->generateFormat();?>",}) //according to your forms action
									 myDropzone2.on("removedfile", function(file, serverFileName) {
									 $.post("<?php echo Yii::app()->createUrl('place_an_ad/delete_floor_plan'); ?>",{file:file.serverId,inp:$("#PlaceAnAd_floor_plan").val()},function(data){  $("#PlaceAnAd_floor_plan").val(data) ; } );
									});
									myDropzone2.on("success", function(file,serverFileName) {
										 file.serverId =serverFileName;
										 var vals  = $("#PlaceAnAd_floor_plan").val();
										 vals += ","+serverFileName;
										 $("#PlaceAnAd_floor_plan").val(vals) ;
										 
									});
									var imgs2 = $("#PlaceAnAd_floor_plan").val(); 
								 
									function delete_floor_plan_image2(val,k)
									{
					 
										 $.post("<?php echo $this->createUrl('place_an_ad/delete_floor_plan'); ?>",{file:val,inp:imgs2},function(data){  $("#PlaceAnAd_floor_plan").val(data) ;imgs2=data; } );
										 $(k).parent().parent().remove();
									}
									</script>
	</div> 
