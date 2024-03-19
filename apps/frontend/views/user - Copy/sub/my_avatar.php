<?php defined('MW_PATH') || exit('No direct script access allowed');
 ?>
 <div class="edit-profile-pictures-p">
 
    <ul class="large-9 columns breadcrumbs">
		<li class="angleright"><a href="<?php echo Yii::app()->createUrl('');?>/">Home</a></li>
		<li class="angleright"><a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">My Profile</a></li>
		<li class="current"><a href="#">Change Avatar</a></li>
		</ul>
<div style="clear:both; height:1px; font-size:1px">&nbsp;</div>

<fieldset class="span12">
<legend>Change your picture</legend>
<div id="profile-top">
  <div id="avatar-form">
    <div class="block"><h3></h3>Upload a new image or select an Avatar below</div>
    <div class="group">
  	<div>
  		 <?php 
  		 $thumb="";
  		 
			  ?>
			  <div id="current-avatar" style="height:140px;width:140px;background:#eee; position:absolute ;background-image:url(<?php echo $user->getAvatarUrl( 124, '',  true); ?>);background-size:cover;background-position:center center;">
		 
 
			  </div> 
  		  
  			 
			<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'profile-form',
			'method'=>'post',
			'htmlOptions' => array('class' => 'form-e','enctype'=>'multipart/form-data'),
			)); ?>
  			  <div id="upload-form">
      			<h3>Upload an Image</h3>
      			<p>Images will be resized to 50 x 50 pixels</p>
                <input type="hidden" value="upload_photo" id="form_name" name="form_name" />
            <div style="position:relative">
      			<input type="file" name="photo" id="id_photo" />
      			</div>
      			<div class="buttons">
					<a class="awesome large maroon" href="<?php echo Yii::app()->createUrl("user/my_profile");?>">Cancel</a> 
					<a class="awesome large maroon frebites_button" href="javascript:" onclick="$('#profile-form').submit();" style="margin-left:10px;">Replace</a> 
    
</div>
          </div>

  		<?php $this->endWidget();?>
  		
  	</div>
    </div>
  </div>
</div>



<div id="profile-bottom">
  <div class="or"><span>OR</span></div>
  <h3>Select an Avatar</h3>
 	<?php $form=$this->beginWidget('CActiveForm', array(
			 
			'method'=>'post',
			 
			)); ?>
    <ul>
		<?php
		 
		foreach($avatar as $k=>$v)
		{
			?>
			 
				<li>
				<label for="<?php echo $k;?>">
				<img class="profile_img" src="https://247zoom.com/uploads/avatar/<?php echo $v->avatar_name;;?>" style="width:50px;height:50px;">
				<input id="<?php echo $k;?>" type="radio" name="photo" style="width:65px;" value="<?php echo $v->avatar_name;;?>">
				</label>
				</li>
			<?
		}
		?>
</ul>
    <input type="hidden" value="default_photo" id="form_name" name="form_name" />
    <div id="update-button">
    <input class="awesome large red frebites_button" type="submit" name="sitesearch" alt="Update Avatar" title="Update Avatar" value="Update Avatar" />

</div>
 <?php $this->endWidget();?>

</div>
</fieldset>

</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
  $("#avatars img").hover(
    function () {$(this).css("border","1px solid #333")},
    function () {$(this).css("border","1px solid #CCC")}
  );
});
</script>

