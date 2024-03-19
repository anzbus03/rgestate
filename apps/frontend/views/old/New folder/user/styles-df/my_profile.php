 <div class="profile-p">

    <div class="breadcrumbs">
        <a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">My Profile</a>
    </div>


<div class="profile-headline-right">
    <div class="profile-controls">
        <a href="<?php echo Yii::app()->createUrl('user/account_settings');?>" class="acc-settings">Account Settings</a>
        
    </div>
</div>






<ul id="account-tabs">
	<li class="active "><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">My Profile</a></span><span class="righttab">&nbsp;</span></li>

	
		<li class=" dropdown">
			<span class="lefttab">&nbsp;</span>
			<span class="tabcontent">
				<a href="<?php echo Yii::app()->createUrl('user/my_ads');?>">
					My Ads
					
				</a>
			</span>
			<span class="righttab">&nbsp;</span>

			<ul>
				

		        
			</ul>
		</li>

        <li class=""><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_watchlist');?>">My Watchlist</a></span><span class="righttab">&nbsp;</span></li>

		<li class=""><span class="lefttab">&nbsp;</span><span class="tabcontent"><a href="<?php echo Yii::app()->createUrl('user/my_searches');?>">My Searches</a></span><span class="righttab">&nbsp;</span></li>

		
	
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

    
        <h3>
            Ahlan wa Sahlan, <strong><?php echo Yii::app()->user->username;?>!</strong> <span>(not <?php echo Yii::app()->user->username;?>? <a href='<?php echo Yii::app()->createUrl('user/logout');?>'>Logout</a>)</span>
        </h3>
        <div class="clear"></div>
		<?php
		function is_image($path)
		{
		@$a = getimagesize($path);
		$image_type = $a[2];

		if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
		{
		return true;
		}
		return false;
		}
		 if(is_image(Yii::app()->basePath . '/../../uploads/avatar/'.$user->image)=='1')
		 {
			 $image =Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/avatar/'.$user->image, array('scaleAndCrop' => array('width' => '50', 'height' => 50)));
		 }
		 else
		 {
			  $image = Yii::app()->request->baseUrl . '/uploads/avatar/default_avatar.png';
			//   $image =Yii::app()->easyImage->thumbSrcOf(Yii::app()->basePath . '/../../uploads/avatar/default_avatar.png', array('scaleAndCrop' => array('width' => '124', 'height' => 124)));
		
		 }
		?>

    <div class="avatar-col">
        <div class="profile-photo">
			<a href="#commingsoon">
			<img src="<?php echo $image;?>"  style="width:124px;height:auto !important;"  />
		   </a><span class="chng-avatar"><a href="<?php echo Yii::app()->createUrl("user/my_avatar");?>" class="chng-avatar-link">Change</a></span></div>
    </div>

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
                        <div class="basic-info-div" style="margin-top:16px;">
                            <div class="row">
                                <div class="col"><label><strong>Name:</strong></label></div>
                                <div class="col"><span><?php echo $user->first_name;?><?php echo $user->last_name;?></span></div>
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

							<div class="col"><label for="id_role">Career Level:</label></div>
							<div class="col fields">
							 
								<?php
								echo $form->dropDownList($user,'position_level',CHtml::listData(Occupation::model()->listData(),'occupation_id','occupation_name'),array("id"=>"id_role", "class"=>"selectbox editable dropdown-widget", "empty"=>"- Select One -","style"=>"width:200px;")); 
								?>
							
							</div>
							<?php /*
                             <div class="col checkbox make-private"><input checked="checked" type="checkbox" name="hide_role" id="id_hide_role" /> Make Private</div>
                            */ ?>
                            </div>

                            

                            <div class="row editable-row">
                                
                                <div class="col"><label for="id_current_position">Education Level:</label></div>
                                <div class="col fields">
								<?php
								echo $form->dropDownList($user,'education_level',CHtml::listData(EducationLevel::model()->listData(),'education_id','education_name'),array("id"=>"id_education", "class"=>"selectbox editable dropdown-widget", "empty"=>"- Select One -","style"=>"width:200px;"));
								?>
                                </div>
                                <?php 
                                /*
                                <div class="col checkbox make-private"><input checked="checked" type="checkbox" name="hide_role" id="id_hide_role" /> Make Private</div>
                                */
                                ?>
                            </div>

                          
                            

                            
                        </div>
                        <div class="widgets-column">
                        
                            <ul class="stats">
                                <li class="first">
                                    <span id="prAds" class="col-title">My Ads</span>
                                    
                                    <span class="num-ads"><?php echo $user->adsCount;?></span>
                                    <span class="num-views">ads viewed <strong>0</strong> times</span>
                                    
                                </li>
                                <li>
                                    <span id="prSrch" class="col-title">My Searches</span>
                                    <span class="num-ads"><?php echo $user->searchCount;?></span>
                                    <span class="num-views">saved searches</span>
                                </li>
                                <li class="last">
                                    <span id="prWch" class="col-title">My Watchlist</span>
                                    <span class="num-ads"><?php echo $user->watchCount;?></span>
                                    <span class="num-views">ads saved</span>
                                </li>
                            </ul>
                         
                        </div>
                        <div class="clear"></div>
                        <ul class="user-info user-info-col">
                           
                            <li class="user-info-col-item">
                                <div class="clear">
                                    
                                  
                                </div>
                                <div class="update-profile-container"><input type="submit" class="awesome red large   hidden" value="Update"/></div>
                            </li>
                            <li class="user-info-col-item">
                                <div id="cover-letter-container">
                                    <span class="your-cv">Your default cover letter</span><br class="clear" />
                                    <?php echo $form->textArea($user, 'cover_letter', array('rows' => 10,'id'=>'id_cover_letter','placeholder'=>'Type your cover letter and will be used during apply for jobs. Say something pertinent to the job, you are apply for, keep it honest, concise and individual','cols'=>'30','class'=>'textarea')); ?>
                              
                                </div>
                                <div class="update-profile-container"><input type="submit" class="awesome red large   hidden" value="Update"/></div>
                            </li>
                        </ul>
                        
                        
<ul class="skill-list">
    
        
    

    <span id="max_experience_fields" class="hidden">5</span>
    <span id="add-experience-enable" class="hidden">Add Another Industry</span>
    <span id="add-experience-disable" class="hidden">You've added maximum number of industries</span>
</ul> <?php /*
                        <div class="add-experience-div">
                            <input type="submit" class="awesome red medium add-experience" value="Add Industry" id="add-experience" name="add-experience" />
                        </div>
                        * */
                        ?>
                        <div class="clear"></div>
                        <ul id="subscriptions">
                            <li class="heading">Please send me:</li>
                            <li class="clear">
                                <span class="subs-tick">
                                     <?php 
                                     $check = ($user->updates=='on')?'checked=true':'';
                                     $check2 = ($user->advertisement=='on')?'checked=true':'';
                                     echo $form->checkBox($user,'updates',array('value'=>'on','uncheckValue'=>0,  $check , 'id'=>'id_dubizzle_email_updates')); ?>
                                </span>
                                <span class="subs-text"><label for="id_dubizzle_email_updates">The weekly    newsletter of the most popular steals across the   site.</label></span>
                            </li>
                            <li class="clear">
                                <span class="subs-tick">
									<?php echo $form->checkBox($user,'advertisement',array('value'=>'on','uncheckValue'=>0,$check2, 'id'=>'id_third_party_emails')); ?>
                                
                                </span>
                                <span class="subs-text"><label for="id_third_party_emails">Amazing offers and bargains from our advertising partners.</label></span>
                            </li>
                        </ul><!--subscriptions ends-->
                    </div>
            </div>
            <div class="terms-block">
    <input class="awesome large red" style="display:block;background:#ca0008;color:#fff;" type="submit" name="sitesearch" alt="Update" title="Update" value="Update" />

</div>
      <?php $this->endWidget();?>
        </div>
        
        <input type="hidden" id="cv_in_progress" class="hidden" val="Your CV is currently being uploaded and will appear on this page shortly." />
        <input type="hidden" id="cv-error-ajax" class="hidden" val="" />
    </div>

</div>

                    
                </div>
            
</div>
<script>

$("input").change(function(){   $('.profile-p .hidden').css("display","block !important");})
</script>
