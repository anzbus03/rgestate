<div class="warning pageHead">Add Youtube URL</div>
<hr />
<div class="accounb-dic">

 <?php
						   $mainTex =  'Ad Video' ; 
					
							$form = $this->beginWidget('CActiveForm', array(
							'id'=>'frm_ctnts',
							'action'=>Yii::app()->createUrl('member/add_video',array('id'=>$model->id)),
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
							'validateOnSubmit'=>true,'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {

							form.find("#bb2").html("'. 'Validating...' .'");
							return true;
							}',
							'afterValidate' => 'js:function(form, data, hasError) { 
							if(hasError) {
							form.find("#bb2").html("'.$mainTex.'");
							return false;
							}
							else
							{
							form.find("#bb2").val("'. 'Please wait..' .'"); 
				
							saveVideo(form, data, hasError,"'.Yii::app()->createUrl('member/add_video',array('id'=>$model->id)).'"); 
							}
							}',
							),
							'htmlOptions'=>array('class'=>'form leadContact right_leadContact phs','style'=>'margin-top: 5px;' ),
							));
							?>
							
							<div class="clearfix"></div>
							<div class="form-group  ">
									<div class="row">
										<div class="col-sm-12"><?php  	echo $form->textField($videoModel , 'video' ,  $videoModel->getHtmlOptions('video',array('class'=>'input-text form-control' ,'style'=>'width:100%;text-indent:5px;' )));  ?>
										<?php echo $form->error($videoModel, 'video');?>
										</div>
									</div>
							</div> 


							
							<div class="row margin-top-20">
									<div class="col-sm-12">
									<div class="form-group  ">
											<div class="row">
														<div class="col-sm-12">
														<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"  id="bb2" style="  clear: both;background: var(--logo-color);color: #fff;border: 1px solid var(--logo-color);border-radius: 4px;padding: 10px 10px;font-size: 13px;max-width: 100px;display: inline-block;float: left;" data-html="<?php echo $mainTex;?>"><?php echo $mainTex;?></button>
														<a class="close_popup_p" href="javascript:void(0)" onclick="closePoputif()" style="float:right;" >Close</a>
														</div>
											</div> 
									</div> 
									</div>
							</div> 

							<?php $this->endWidget();?>

<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<hr />
 

  
