  <?php defined('MW_PATH') || exit('No direct script access allowed'); 
 ?>
 
<fieldset id="fbsignin-form" class="span12">
	<legend>Sign In / Register</legend>
	<div id="content-col">
		<?php $common_name = Yii::app()->options->get('system.free_bites.site_name') ; ?> 
		<h4 class="headline">Already have a <span><?php echo  $common_name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		<h4 class="headline1" style="display:none">Don't have a <span><?php echo  $common_name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signup");?>' onclick='return false;' id='register-link'>register</a>. (It's FREE!)</h4>
		<h4 class="headline2" style="display:none">Already have a <span><?php echo   $common_name;?></span> account? Please <a href='<?php echo Yii::app()->createUrl("user/signin");?>' onclick='return false;' id='signin-link'>sign in</a>.</h4>
		<?php
		if(Yii::app()->user->hasFlash("success"))
		{
			?>
			<div class="error1" ><?php echo Yii::app()->user->getFlash("success");?></div>
			<?
		}
		?>
		
		<div class="clear"></div>
		<div style="position:relative;">
<a href="<?php echo Yii::app()->createUrl('members/signin');?>" style="position:absolute;right: 0px;" class="btn btn-xs pull-right">Sign In as Member</a>
  </div>
		<ul class="tabs">
			<li id="tab1_li"   class="active" >
				<span class="lefttab"></span>
				<a href="javascript:void(0)" onclick='activateTab(this,"tab1");return false;'>Sign In</a>
				<span class="righttab"></span>
			</li>
			<li id="tab2_li">
				<span class="lefttab"></span>
				<a href="javascript:void(0)"  onclick='activateTab(this,"tab2");return false;'>Register</a>
				<span class="righttab"></span>
			</li>
		</ul>

		<div class="tab_container">
			<script>
			function activateTab(k,tab){
				$('.tabs').find('li').removeClass('active');
				$('.tab_container').find('.tab_content').removeClass('active_content');
				$('#'+tab+'_li').addClass('active');
				$('#'+tab).addClass('active_content')
				
			}
			</script>


				<div id="tab1" class="tab_content active_content">
					 <?php $this->renderPartial('_login_section',compact('common_name'));?>
				</div><!-- end #tab1 -->

			
				<div id="tab2" class="tab_content">
						  <?php $this->renderPartial('_register_partial',array('model'=>$user,'common_name'=>$common_name));?>
				</div><!-- end #tab2.tab_content -->
			
		</div><!-- end .tab_container -->
	</div><!-- end #content-col -->
</fieldset>
 </div>  
<script>
 
</script>
