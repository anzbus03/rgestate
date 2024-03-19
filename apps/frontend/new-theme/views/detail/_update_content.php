 <script>
 function showUpdateEdit(){
	 $('#showUpdateEdit').removeClass("hide");
	 $('#showUpdateEdit').find("textarea").focus();
 }
 </script>
 <div class="hide padding-top-60" id="showUpdateEdit">
 <?php
							
							$model->scenario ='update_content'; 
							$form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form2',
							'enableAjaxValidation'=>true,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'validateOnType'=>false,
							),
							)); ?>
							<div class="row">
                            <div class="col-sm-12">
                            <label for="<?php echo $model->modelName;?>_ad_description" class="required">Description <span class="required">*</span></label>
                            </div>
                            
                            <div class="col-sm-12">
                            	<?php  	echo $form->textArea($model , 'ad_description' ,  $model->getHtmlOptions('ad_description',array('class'=>'input-text form-control','placeholder'=>'','rows'=>'10' )));  ?>

                            <?php echo $form->error($model, 'ad_description');?>
                            
                            
                            </div>
                           
                           
                           <div class="col-sm-12">

						 
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s" style="background:var(--logo-color);border:1px solid var(--logo-color);color:#fff;width:150px;float:right"  id="bb7" >Update</button>

							 
							</div>
						 
                           
                           
                            </div><!-- end #signin-form -->
							 
							<?php $this->endWidget();?>

</div>			 
		
