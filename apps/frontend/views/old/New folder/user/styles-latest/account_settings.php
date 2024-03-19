<style>
.settings-p .textbox
{
	text-indent:4px;
	height:26px;
}
</style>
 <div class="settings-p">
 
    <div class="breadcrumbs">
        <a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">My Profile</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('user/account_settings');?>" >Account Settings</a>
    </div>
 
<div style="clear:both; height:1px; font-size:1px">&nbsp;</div>

<fieldset id="account-settings" class="span12">
  <legend>Account Settings</legend>
	<?php
	if(Yii::app()->user->hasFlash('failure'))
	{
	?>
	<div class="error1"> Please fix the errors below</div>
	<?
	}
	 
	if(Yii::app()->user->hasFlash('success'))
	{
	?>
	<div class="information"> <?php echo Yii::app()->user->getFlash('success');?></div>
	<?
	}
	?>

  <div class="group" id="name">
    <div class="header  <?php echo (Yii::app()->request->getPost("sitesearch")=="Change Name")?'':'empty';?> " id="edit-name:expandable"  onclick="$('.content').hide(); $('.header').addClass('empty'); $(this).removeClass('empty');$('#content-name').show(); ;" >
      <h4><strong>Name:</strong> <?php echo $user->first_name;?> <?php echo $user->last_name;?></h4>
      <span id="edit-name-button:expandable:expandable-button">Edit</span></div>
    <div class="content " id="content-name" name="name" style="<?php echo (Yii::app()->request->getPost("sitesearch")=="Change Name")?'':'display:none;';?>" >
      <form method="post" action="">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>"top-websites-cr-form",
	'method'=>'post',
	'htmlOptions' => array('class' => 'form-e'),
	)); ?>

        
        <div class="col"><label for="id_first_name">First Name: &nbsp </label>
          
		<?php echo $form->textField($user, 'first_name', array_merge($user->getHtmlOptions('first_name'),array("id"=>"id_oldpassword","class"=>"textbox"))); ?> 
		<?php echo $form->error($user, 'first_name');?> 
         
         </div>
        
        
        <div class="col"><label for="id_last_name">Last Name: &nbsp </label>
         <?php echo $form->textField($user, 'last_name', array_merge($user->getHtmlOptions('last_name'),array("id"=>"id_oldpassword","class"=>"textbox"))); ?> 
		<?php echo $form->error($user, 'last_name');?> 
         
         </div>
        
        

        <div class="col">
          <input type="submit" name="sitesearch" alt="Change my name" title="Change my name"  value="Change Name" style="width:96px" class="settings_button" />
        </div>

      <?php $this->endWidget();?>
    </div>
  </div>

  <div class="group" id="password">
    <div class="header <?php echo (Yii::app()->request->getPost("sitesearch")=="Change Password")?'':'empty';?> " id="edit-password:expandable" onclick="$('.content').hide(); $('.header').addClass('empty'); $(this).removeClass('empty');$('#content-password').show();"><h4><strong>Password:</strong> ********** </h4><span id="edit-password-button:expandable:expandable-button">Edit</span></div>
    <div class="content " id="content-password" name="password" style="<?php echo (Yii::app()->request->getPost("sitesearch")=="Change Password")?'':'display:none;';?>">
      <form method="post" action="">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>"top-websites-cr-form",
	'method'=>'post',
	'htmlOptions' => array('class' => 'form-e'),
	)); ?>
	
		 
		
        
          <div class="col">
			  <label for="id_oldpassword">Old Password: &nbsp; </label>
           <?php echo $form->textField($user, 'old_password', array_merge($user->getHtmlOptions('old_password'),array("id"=>"id_oldpassword","class"=>"textbox"))); ?> 
		 <?php echo $form->error($user, 'old_password');?> 
         
         </div>
        
        
         <div class="col"><label for="id_new_password1">New Password: &nbsp; </label>
          <?php echo $form->textField($user, 'password', array_merge($user->getHtmlOptions('password'),array("id"=>"id_new_password1","class"=>"textbox"))); ?> 
		  <?php echo $form->error($user, 'password');?> 
         </div>
        
        
        <div class="col"><label for="id_new_password2">Confirm Password: &nbsp; </label> 
         <?php echo $form->textField($user, 'con_password', array_merge($user->getHtmlOptions('con_password'),array("id"=>"id_new_password2","class"=>"textbox"))); ?> 
		 <?php echo $form->error($user, 'con_password');?>
        </div>
        
        

        <div class="col">
          <input type="submit" name="sitesearch" alt="Change my password" title="Change my password" value="Change Password"  style="width:116px" class="settings_button" />
        </div>

    <?php  $this->endWidget();  ;?>
    </div>
  </div>

  
	<div id="email" class="group">
	<div id="edit-email:expandable" class="header empty">
	<h4>
	<strong>Email Address:</strong>
	<?php echo $user->email;?>
	</h4>
 
	</div>
	</div>
 

  <div class="group" id="deactivate">
    <div class="header empty" id="deactivate-box:expandable" onclick="$('.content').hide(); $('.header').addClass('empty'); $(this).removeClass('empty');$('#content-deactivate').show();"><h4><strong>Deactivation:</strong> Delete my account</h4><span id="deactivate-button:expandable:expandable-button">Delete</span></div>
    <div class="content" id="content-deactivate" name="deactivate" style="display:none;">
      <form method="post" action="">
        <p class="col"><strong>Are you sure you want to delete your account?</strong></p>
        <div class="col"><input type="button" name="deactivate" alt="Confirm" title="Confirm" value="Confirm"  class="settings_button" /> </div>
        <div class="col"><input type="button" name="deactivate" alt="Cancel" title="Cancel" value="Cancel" class="settings_button" /> </div>
      </form>

    </div>
  </div>
</fieldset>


                    
                </div>
            </div>
            </div>
