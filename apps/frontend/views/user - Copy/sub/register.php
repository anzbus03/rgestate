 <?php defined('MW_PATH') || exit('No direct script access allowed'); 
 ?>
 
<style>
label.validation-text{ color:#CE1137 !important; }
#signin-content form label{ font-weight:bold !important;color:#fff !important; }
#signin-content #email, #signin-content #password{ color:#000 !important; }
</style>
<?php if(Yii::app()->user->hasFlash("registered"))
{
	?>
<fieldset id="registeration-complete" class="span12">
<legend>Register</legend>
<div class="fieldset-content">
<?php 
if(Yii::app()->user->hasFlash("sendFail"))
{
	echo '<h3> '.Yii::app()->user->getFlash("sendFail"). '</h3>';
}
else
{
	?>
<h3>You're almost done!</h3>
<p>We've just sent you a verification email. Click on the verification link inside to finish registering your account.</p>
<p>
Once you've finished your account registration,
<a href="<?php echo Yii::app()->createUrl("user/signin");?>">click here to log in</a>
.
</p>
<?php
}
?>
</div>
</fieldset>
<?php 
}
else
{
	?>
<fieldset id="fbsignin-form" class="span12">
	<legend>Sign In / Register</legend>

	<div id="content-col">
		 <?php $common_name = Yii::app()->options->get('system.free_bites.site_name') ; ?> 
		<h4 class="headline">Already have a <span><?php echo  $common_name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		<h4 class="headline1" style="display:none">Don't have a <span><?php echo  $common_name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl('user/signup');?>' onclick='return false;' id='register-link'>register</a>. (It's FREE!)</h4>
		<h4 class="headline2" style="display:none">Already have a <span><?php echo  $common_name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		
		<div class="clear"></div>
			<div style="position:relative;">
<a href="<?php echo Yii::app()->createUrl('members/join');?>" style="position:absolute;right: 0px;" class="btn btn-xs pull-right">Join as Member</a>
  </div>
			<ul class="tabs">
			<li id="tab1_li"   >
				<span class="lefttab"></span>
				<a href="javascript:void(0)" onclick='activateTab(this,"tab1");return false;'>Sign In</a>
				<span class="righttab"></span>
			</li>
			<li id="tab2_li" class="active" >
				<span class="lefttab"></span>
				<a href="javascript:void(0)"  onclick='activateTab(this,"tab2");return false;'>Register</a>
				<span class="righttab"></span>
			</li>
		</ul>
	<script>
			function activateTab(k,tab){
				$('.tabs').find('li').removeClass('active');
				$('.tab_container').find('.tab_content').removeClass('active_content');
				$('#'+tab+'_li').addClass('active');
				$('#'+tab).addClass('active_content')
				
			}
			</script>
		<div class="tab_container">
				<div id="tab1" class="tab_content">
					 <?php $this->renderPartial('_login_section',array('user'=>$user ,'common_name'=>$common_name));?>
				</div><!-- end #tab1 -->

			
				<div id="tab2" class="tab_content  active_content">
						  <?php $this->renderPartial('_register_partial',array('model'=>$model,'common_name'=>$common_name ));?>
				</div>


 <!-- end #tab2.tab_content -->
			
		</div><!-- end .tab_container -->
	</div><!-- end #content-col -->
</fieldset>
<?php
}
?>
 

                    
                </div>
                

 
