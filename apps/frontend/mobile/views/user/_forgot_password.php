						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'enableAjaxValidation'=>true,
						 
							'clientOptions' => array(
							   'validateOnSubmit'=>true,
								'validateOnChange'=>true,
								'validateOnType'=>true,

							),
							 
							)); ?>
	 
	
		<div id="right-col">
			 
			 
			<div id="signin-form">
				 
				 
				<div class="form-row " hint="">
					<label for="id_username">Email address : <i class="im im-icon-Mail-Inbox"></i>
					 
					<?php 
					echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array("placeholder"=>"username@provider.com" ,'class'=>''))); 
					?>
					</label>
					<?php echo $form->error($model, 'email');?>
					<div class="clear"></div>
				</div>
				 
				<div class="fbsignin-button-block">
				 
					<input type="submit" class="red awesome fbsignin-button" value="Submit" tabindex="3" />
					<p>Don't have an account? <a href="<?php echo Yii::app()->createUrl('user/signup');?>"   id="register-link">Register</a></p>
					<div class="clear"></div>
				</div>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
	<?php $this->endWidget();?>
