<?php defined('MW_PATH') || exit('No direct script access allowed');
 ?>
 <div class="edit-profile-pictures-p">
  <div class="breadcrumbs">
        <a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">My Profile</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('user/my_avatar');?>">Change Avatar</a>
    </div>
<div style="clear:both; height:1px; font-size:1px">&nbsp;</div>

<fieldset>
<legend>Change your picture</legend>
<div id="profile-top">
  <div id="avatar-form">
    <div class="block">Upload a new image or select an Avatar below</div>
    <div class="group">
  	<div>
  		 <?php 
  		 $thumb="";
  		 if($user->image!="")
  		 {
			  ?>
			  <div id="current-avatar">
				  <?php
				  if(ListingUsers::model()->is_image(Yii::app()->basePath . '/../../uploads/avatar/'.$user->image)=='1')
				  {
					  ?>
				  <img src="<?php echo Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/avatar/'.$user->image, array('scaleAndCrop' => array('width' => '140', 'height' => 140)));?>" alt="" />
			          <?php
				  }
				  else
				  {
					  ?>
					  <img src="" alt="" />
					  <?
				  }
			     ?>
			  </div><?
		 
		 }
		 else
		 {
			 ?><div id="current-avatar"><img src="" alt="" /></div><?
			 
		 }
  		 ?>
  		  
  			 
			<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'profile-form',
			'method'=>'post',
			'htmlOptions' => array('class' => 'form-e','enctype'=>'multipart/form-data'),
			)); ?>
  			  <div id="upload-form">
      			<h3>Upload an Image</h3>
      			<p>Images will be resized to 140 x 140 pixels</p>
                <input type="hidden" value="upload_photo" id="form_name" name="form_name" />
            <div style="position:relative">
      			<input type="file" name="photo" id="id_photo" />
      			</div>
      			<div class="buttons"><a class="awesome large maroon" href="/profile/">Cancel</a> 
    <input class="awesome btn red" type="submit" name="sitesearch" alt="Replace" title="Replace" value="Replace" />

</div>
          </div>

  		<?php $this->endWidget();?>
  		
  	</div>
    </div>
  </div>
</div>



<div id="profile-bottom">
  <div class="or"><span>OR</span></div>
  <h2>Select an Avatar</h2>
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
				<img class="profile_img" src="<?php echo Yii::app()->request->baseUrl;?>/uploads/avatar/<?php echo $v->avatar_name;;?>">
				<input id="<?php echo $k;?>" type="radio" name="photo" value="<?php echo $v->avatar_name;;?>">
				</label>
				</li>
			<?
		}
		?>
</ul>
    <input type="hidden" value="default_photo" id="form_name" name="form_name" />
    <div id="update-button">
    <input class="awesome large red" type="submit" name="sitesearch" alt="Update Avatar" title="Update Avatar" value="Update Avatar" />

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

