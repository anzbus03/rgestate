 <div class="profile-p">

<ul class="large-9 columns breadcrumbs"  style="overflow: hidden;margin-bottom: 30px;">
<li class="angleright"><a href="<?php echo Yii::app()->createUrl('');?>/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
<li class="current"><a href="#">My Profile</a></li>
</ul>
<br />
<style>
.profile-p .profile-headline-right { position:relative;}
.profile-p .profile-controls { position:absolute;right:0px;}
.no-margin-left { margin-left:0px !important; }
</style>
<div class="profile-headline-right">
    <div class="profile-controls">
        <a href="<?php echo Yii::app()->createUrl('user/account_settings');?>" class="acc-settings"> <i class="fa fa-gear" aria-hidden="true"></i> Account Settings</a>
        
    </div>
</div>
 
<ul id="account-tabs" class="no-padding">
	<li class="active no-margin-left"><span class="lefttab">&nbsp;</span><span class="tabcontent"> <i class="fa fa-user"></i> <a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">  My Profile</a></span><span class="righttab">&nbsp;</span></li>
	<li class=" "> <span class="lefttab">&nbsp;</span> <span class="tabcontent"> <i class="fa fa-buysellads"></i>  <a href="<?php echo Yii::app()->createUrl('user/my_downloads');?>"> My Downloads </a> </span> <span class="righttab">&nbsp;</span> </li>
 
</ul>
<div style="clear:both"></div>


<div id="profile-content">

  <?php
							 
							if(Yii::app()->user->hasFlash("success_message"))
							{
								?>
								<div  class="confirmation"><?php echo Yii::app()->user->getFlash("success_message");?></div>
								<?
							}
							if(Yii::app()->user->hasFlash("success_message2"))
							{
								?>
								<div  class="confirmation"><?php echo Yii::app()->user->getFlash("success_message2");?></div>
								<?
							}
							?>

    
        <h3 class="no-padding" style="margin-bottom:16px;">
            Ahlan wa Sahlan, <strong><?php echo Yii::app()->user->username;?>!</strong> <span>(not <?php echo Yii::app()->user->username;?>? <a href='<?php echo Yii::app()->createUrl('user/logout');?>'> <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>)</span>
        </h3>
        <div class="clear"></div>
	 

    <div class="avatar-col no-padding-left no-margin-left"   >
        <div class="profile-photo" style="position:relative;background-image:url(<?php echo $user->getAvatarUrl( 124, '',  true); ?>);background-size:cover;background-position:center center;">
			<a href="<?php echo Yii::app()->createUrl("user/my_avatar");?>">
		   </a><span class="chng-avatar" style="margin-top: 0px;z-index:100"><a href="<?php echo Yii::app()->createUrl("user/my_avatar");?>" class="chng-avatar-link">Change</a></span></div>
    </div>
    <style>
    
    </style>

    <div class="content-col">
        

        <br class="clear" />
        
        <div>
       
			<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'profile-form',
			'method'=>'post',
			'htmlOptions' => array('class' => 'form-e'),
			)); ?>
            <div class="edit-profile-wrapper">
                    <div class="table">
                        <div class="basic-info-div" style="">
                            <div class="row">
                                <div class="col"><label><strong>Name:</strong></label></div>
                                <div class="col"><span><?php echo $user->fullName;?> </span></div>
                            </div>

                            <div class="row editable-row">
                                
							<div class="col"><label for="id_gender"><label for="id_gender">Gender</label>:</label></div>
							<div class="col fields">
							<?php $mer =  array('empty'=>'Select Gender',"class"=>"selectbox editable dropdown-widget",'id'=>'id_gender') ; ?>
							<?php echo $form->dropDownList($user, 'calls_me',array('M'=>'Habibi (M)','F'=>'Habibti (F)'), $mer); ?>
						
							 </div>
							 <?php /*
                             <div class="col checkbox make-private"><input type="checkbox" name="hide_gender" id="id_hide_gender" /> Make Private</div>
                             */ ?>
                            </div>

                            <div class="row editable-row">
                                
                                <div class="col"><label for="id_nationality">Nationality:</label></div>
                                <div class="col fields">
									<?php
									echo $form->dropDownList($user,'country',CHtml::listData(Countrieslist::model()->listData(),'id','name'),array("id"=>"id_nationality", "class"=>"selectbox editable dropdown-widget","empty"=>"- Select Country -","style"=>"width:200px;")); 
									?>
								</div>
								<?php
								/*
                                <div class="col checkbox make-private"><input type="checkbox" name="hide_nationality" id="id_hide_nationality" /> Make Private</div>
                                */
                                ?>
                            </div>
 

					

							<div class="row editable-row">

							<div class="col"><label for="id_role">Timezone:</label></div>
							<div class="col fields">
							 
							 
								<?php
								echo $form->dropDownList($user,'timezone',User::model()->getTimeZonesArray(),array("id"=>"timezone", "class"=>"selectbox editable dropdown-widget" ,"style"=>"width:200px;")); 
								?>
							</div>
							<?php /*
                             <div class="col checkbox make-private"><input checked="checked" type="checkbox" name="hide_role" id="id_hide_role" /> Make Private</div>
                            */ ?>
                            </div>

                            

                          
                            

                            
                        </div>
                        <div class="widgets-column">
                        
                            <ul class="stats">
                                <li class="first">
                                    <span id="prAds" class="col-title">My   Downloads </span>
                                    
                                    <span class="num-ads">#</span>
                                   
                                    
                                </li>
                                <li class="last">
                                    <span id="prWch" class="col-title">My Favuorite</span>
                                    <span class="num-ads">#</span>
                                     
                                </li>
                            </ul>
                         
                        </div>
                        
                        <br />
						<br />
						 
                       
                        
 
                     </div>
                    <div style="clear:both"></div>
					<button style="display:block; clear:both;margin-top:20px" class=" btn frebites_button" type="submit">Update <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> </button>
            </div>
          
      <?php $this->endWidget();?>
        </div>
        
        <input type="hidden" id="cv_in_progress" class="hidden" val="Your CV is currently being uploaded and will appear on this page shortly." />
        <input type="hidden" id="cv-error-ajax" class="hidden" val="" />
    </div>

</div>

                    <div class="clearfix"></div>
                </div>
            
</div>
<script>

$("input").change(function(){   $('.profile-p .hidden').css("display","block !important");})
</script>
