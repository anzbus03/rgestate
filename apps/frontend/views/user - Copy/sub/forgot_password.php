<fieldset id="fbsignin-form" class="span12">
	<legend>Forgot Password</legend>
	<div id="content-col">
		<h4 class="headline">Already have a <span><?php echo   Yii::app()->options->get('system.free_bites.site_name');?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>'   >Login</a>.</h4>
		<h4 class="headline1" style="display:none">Don't have a <span><?php echo   Yii::app()->options->get('system.free_bites.site_name');?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signup");?>' onclick='return false;' id='register-link'>register</a>. (It's FREE!)</h4>
		<h4 class="headline2" style="display:none">Already have a <span><?php echo   Yii::app()->options->get('system.free_bites.site_name');?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		
		<div class="clear"></div>
		
		<ul class="tabs">
			<li id="logintab"   class="active" >
				<span class="lefttab"></span>
				<a href="<?php echo Yii::app()->createUrl("user/forgot_password");?>" onclick='return false;'>Forgot Password</a>
				<span class="righttab"></span>
			</li>
			 
		</ul>

		<div class="tab_container">
			



<div id="tab1" class="tab_content active_content">
	<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'enableAjaxValidation'=>true,
						 
							'clientOptions' => array(
							   'validateOnSubmit'=>true,
								'validateOnChange'=>true,
								'validateOnType'=>true,

							),
							 
							)); ?>
		<div id="register-head">
			<h4>Sign in with Facebook</h4>
			<p class="note2">Use Facebook to sign in to <?php echo   Yii::app()->options->get('system.free_bites.site_name');?></p>
			<a class="fbbtn-login-sprite" href="<?php echo Yii::app()->createUrl("hybridauth");?>" ></a>
			<div class="clear"></div>
		</div>
	
		<div id="right-col">
			<div id="signin-vsep">
				<span><img src="https://www.247zoom.com/frontend/themes/styles-yellow/images/or.jpg" /></span>
			</div>
			 
			<div id="signin-form">
				<h4>Forgot your password?</h4>
				 
				<div class="form-row " hint="">
					<label for="id_username">Email address</label>
					 
					<?php 
					echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array("placeholder"=>"username@provider.com" ,'class'=>''))); 
					?>
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
</div><!-- end #tab1 -->

		 
		</div><!-- end .tab_container -->
	</div><!-- end #content-col -->
</fieldset>
</div>
<style>
				#fbsignin-form form #ListingUsers_password, #fbsignin-form form #ListingUsers_con_password {
				margin: 0 2px;
				width: 117px;
				}
				#fbsignin-form .errorMessage
				{
					font-size:10px; 
				}
		</style>
