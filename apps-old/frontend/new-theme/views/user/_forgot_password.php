						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'action'=>Yii::app()->createUrl('user/forgot_password'),
							'enableAjaxValidation'=>true,
						 
							'clientOptions' => array(
							   'validateOnSubmit'=>true,
								'validateOnChange'=>false,
								'validateOnType'=>false,

							),
							 
							)); ?>
	 
	
		<div id="right-col">
			 
			 
			<div id="signin-form">
				 
				 
						    	<div class="clearfix"></div> 
		<div class="form-group  ">

						    <div class="row">


							<div class="col-sm-12">

							<?php  	echo $form->textField($model , 'email' ,  $model->getHtmlOptions('email',array( 'class'=>'input-text form-control LJB','placeholder'=>$this->tag->getTag('email_*','Email *') )));  ?>

							<?php echo $form->error($model, 'email');?>

							</div>

							</div>
		</div> 

	<div class="clear"></div>
				 	<div class="form-group  margin-bottom-0 ">

						    <div class="row">
 
							<div class="col-sm-12">
	 
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n margin-top-0"  id="bb" style="clear: both;width:100%;max-width: unset !important;"    ><?php echo $this->tag->getTag('submit','Submit');?></button>
	 
							</div>
		</div> 
							</div><!-- end #signin-form -->
						
				<div class="fbsignin-button-block">
				 
					 	 
					<div class="clear"></div>
				</div>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
	<?php $this->endWidget();?>
