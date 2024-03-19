<style>
label.validation-text{ color:#CE1137 !important; }
</style>
<?php if(Yii::app()->user->hasFlash("forgotsuccess"))
{
	?>
<fieldset id="registeration-complete" class="span12">
<legend>Register</legend>
<div class="fieldset-content">
<h3>You're almost done!</h3>
<p><?php echo Yii::app()->user->getFlash("forgotsuccess");?></p>
 
</div>
</fieldset>
<?php 
}
else
{
	?>
<fieldset id="fbsignin-form" class="span12">
	<legend>Forgot Password</legend>

	<div id="content-col">
		
		

		


		<h4 class="headline">Already have a <span><?php echo   Yii::app()->options->get('system.common.site_name');?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		<h4 class="headline1" style="display:none">Don't have a <span><?php echo   Yii::app()->options->get('system.common.site_name');?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signup");?>' onclick='return false;' id='register-link'>register</a>. (It's FREE!)</h4>
		<h4 class="headline2" style="display:none">Already have a <span><?php echo   Yii::app()->options->get('system.common.site_name');?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		
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
							'method'=>'post',
							'focus'=>"first_name",
							'action'=>Yii::app()->createUrl("user/forgot_password_new")
							)); ?>
		<div id="register-head">
			<h4>Sign in with Facebook</h4>
			<p class="note2">Use Facebook to sign in to <?php echo   Yii::app()->options->get('system.common.site_name');?></p>
			<a class="fbbtn-login-sprite" href="<?php echo Yii::app()->createUrl("hybridauth");?>" ></a>
			<div class="clear"></div>
		</div>
	
		<div id="right-col">
			<div id="signin-vsep">
				<span><img src="http://m.dbzstatic.com/assets/images/fbconnect/or.jpg" /></span>
			</div>
			 
			<div id="signin-form">
				<h4>Forgot your password?</h4>
				<?php
				if(Yii::app()->user->hasFlash('forgotfail'))
				{
					?>   
				 <div class="error">Please enter a valid email address .</div>
				 <?php
			 }
			 ?>
				<div class="form-row " hint="username@provider.com">
					<label for="id_username">Email address</label>
					<input id="id_username" type="text" class="textbox required email" name="username" tabindex="1" value="" />
					<div class="clear"></div>
				</div>
				 
				<div class="fbsignin-button-block">
					<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
					<input type="submit" class="red awesome fbsignin-button" value="Submit" tabindex="3" />
					<p>Don't have an account? <a href="<?php echo Yii::app()->createUrl('user/signup');?>" onclick="return false;" id="register-link">Register</a></p>
					<div class="clear"></div>
				</div>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
	<?php $this->endWidget();?>
</div><!-- end #tab1 -->

		 
		</div><!-- end .tab_container -->
	</div><!-- end #content-col -->
</fieldset>
<?php
}
?>
<div style="display:none;">

	<!-- Google Code for Place an Ad Conversion Page -->
	<script type="text/javascript">
		/* <![CDATA[ */
			
				var google_conversion_id = 975003292;
				var google_conversion_language = "en";
				var google_conversion_label = "DBqwCJz__QIQnL310AM";
			
			
			
			var google_conversion_format = "2";
			var google_conversion_color = "ffffff";
			var google_conversion_value = 0;
		/* ]]> */
	</script>
	<script type="text/javascript" src="#"></script>
	
	<noscript>
		<div style="display:inline;">
			
				<img height="1" width="1" style="border-style:none;" alt="" src="#"/>
			
			
			
		</div>
	</noscript>
</div>

                    
                </div>
