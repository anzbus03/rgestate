<style>
.settings-p .textbox
{
	text-indent:4px;
	height:26px;
}
#account-settings .header h4 { font-size:13px !important;}
</style>
 <div class="settings-p" style="width:100% !important;">
 
 
<div style="clear:both; height:1px; font-size:1px">&nbsp;</div>

<fieldset id="account-settings" class="span12" style="width:100% !important;border:0px;font-size:14px;padding:0px;">
  
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

  <div class="group" id="name" style="margin:20px 0px">
    <div class="header  <?php echo (Yii::app()->request->getPost("sitesearch")=="Change Name")?'':'empty';?> " id="edit-name:expandable"  onclick="$('.content').hide(); $('.header').addClass('empty'); $(this).removeClass('empty');$('#content-name').show(); ;" >
      <h4><strong>Name:</strong> <?php echo $user->first_name;?> <?php echo $user->last_name;?></h4>
      <span id="edit-name-button:expandable:expandable-button"><a href="javascript:void(0)"><i class="fa fa-edit"></i>  Edit</a></span></div>
    <div class="content " id="content-name" name="name" style="<?php echo (Yii::app()->request->getPost("sitesearch")=="Change Name")?'':'display:none;';?>" >
     
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>"top-websites-cr-form1",
	'method'=>'post',
	'enableAjaxValidation'=>true,
							'clientOptions' => array(
							   'validateOnSubmit'=>true,
								'validateOnChange'=>true,
			 
							),
	'htmlOptions' => array('class' => 'form-e'  ),
	)); ?>

        
        <div class="col"><label for="id_first_name">Full Name: &nbsp </label>
          
		<?php echo $form->textField($user, 'first_name', array_merge($user->getHtmlOptions('first_name'),array( "class"=>"textbox"))); ?> 
		<?php echo $form->error($user, 'first_name');?> 
         
         </div>
        
        
        
        
        

        <div class="col">
          <input type="submit" name="sitesearch" alt="Change my name" title="Change my name"  value="Change Name" style="width:96px" class="awesome2 frebites_button" />
        </div>

      <?php $this->endWidget();?>
    </div>
  </div>

  <div class="group" id="password">
    <div class="header <?php echo (Yii::app()->request->getPost("sitesearch")=="Change Password")?'':'empty';?> " id="edit-password:expandable" onclick="$('.content').hide(); $('.header').addClass('empty'); $(this).removeClass('empty');$('#content-password').show();"><h4><strong>Password:</strong> ********** </h4><span id="edit-password-button:expandable:expandable-button"><a href="javascript:void(0)"><i class="fa fa-edit"></i> Edit</a></span></div>
    <div class="content " id="content-password" name="password" style="<?php echo (Yii::app()->request->getPost("sitesearch")=="Change Password")?'':'display:none;';?>">
 
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>"top-websites-cr-form2",
			'enableAjaxValidation'=>true,
			'clientOptions' => array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>true,
			),
			'htmlOptions' => array('class' => 'form-e'),
	)); ?>
	
		 
		
        
          <div class="col">
			  <label for="id_oldpassword" style="width:200px;display:inline-block;">Old Password: &nbsp; </label>
				<?php echo $form->passwordField($user, 'old_password', array_merge($user->getHtmlOptions('old_password'),array( "class"=>"textbox"))); ?> 
				<?php echo $form->error($user, 'old_password');?> 
		  
         
         </div>
        
        
         <div class="col"><label for="id_new_password1"  style="width:200px;display:inline-block;">New Password: &nbsp; </label>
          <?php echo $form->passwordField($user, 'password', array_merge($user->getHtmlOptions('password'),array( "class"=>"textbox"))); ?> 
		  <?php echo $form->error($user, 'password');?> 
         </div>
        
        
        <div class="col"><label for="id_new_password2"  style="width:200px;display:inline-block;">Confirm Password: &nbsp; </label> 
         <?php echo $form->passwordField($user, 'con_password', array_merge($user->getHtmlOptions('con_password'),array( "class"=>"textbox"))); ?> 
		 <?php echo $form->error($user, 'con_password');?>
        </div>
        
        

        <div class="col">
          <input type="submit" name="sitesearch" alt="Change my password" title="Change my password" value="Change Password"  style="width:116px" class="awesome2 frebites_button" />
        </div>

    <?php  $this->endWidget();  ;?>
    </div>
  </div>

  
	<div id="email" class="group">
	<div id="edit-email:expandable" class="header empty" onclick="$('.content').hide(); $('.header').addClass('empty'); $(this).removeClass('empty');$('#content-email').show(); ;">
	<h4><strong>Email Address:</strong> <?php echo $user->email;?> </h4>
	<span class="edit-name-button:expandable:expandable-button frebites_button hide"><a href="javascript:void(0)" ><i class="fa fa-edit"></i> Edit</a></span> 
	</div>
	  <div class="content " id="content-email" style="<?php echo (Yii::app()->request->getPost("sitesearch")=="Change Email")?'':'display:none;';?>" >
     
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>"top-websites-cr-form_email",
			'method'=>'post',
			'enableAjaxValidation'=>true,
			'clientOptions' => array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>true,
			),
			'htmlOptions' => array('class' => 'form-e'  ),
	)); ?>

        
        <div class="col"><label for="id_first_name">Email: &nbsp </label>
		<?php echo $form->textField($user, 'email', array_merge($user->getHtmlOptions('email' ,array( "class"=>"textbox" ,'style'=>'width:200px;')))); ?> 
		<?php echo $form->error($user, 'email');?> 
         </div> 
        

        <div class="col">
          <input type="submit" name="sitesearch" alt="Change Email" title="Change Email"  value="Change Email" style="width:96px" class="awesome2 frebites_button" />
        </div>

      <?php $this->endWidget();?>
    </div>
	</div>
 

  <div class="group hidden" id="deactivate">
    <div class="header empty" id="deactivate-box:expandable" onclick="$('.content').hide(); $('.header').addClass('empty'); $(this).removeClass('empty');$('#content-deactivate').show();"><h4><strong>Deactivation:</strong> Delete my account</h4><span id="deactivate-button:expandable:expandable-button"><a href="javascript:void(0)"><i class="fa fa-times"></i> Delete</a></span></div>
    <div class="content" id="content-deactivate" name="deactivate" style="display:none;">
      <form method="post" action="">
        <p class="col" style="margin-bottom:0px;position:relative;top:5px"><strong>Deactivate your account?</strong></p>
        <div class="col"><input type="button" name="deactivate" id="delete_bt" alt="Confirm" onclick="showConfinBtns(this)" title="Confirm" value="Delete"  onclick="saveEmail(event)" class="settings_button" /> </div>
        <div class="col"><input type="button" name="deactivate" id="confirm_btn" alt="Cancel" onclick="romoveUser(this)" title="Are you sure to deactivte account?" value="Are you sure to deactivte account?" class="settings_button dipNone" /> </div>
        <div class="col"><input type="button" name="deactivate" id="cancen_btn"  alt="Cancel" onclick="hideConfinBtns(this)"  title="Cancel" value="Cancel" class="settings_button dipNone" /> </div>
      </form>

    </div>
  </div>
</fieldset>


                    
                </div>
            </div>
           
            <style>
            .settings_button{
				border:0px;
				background:#ffd400;
				color:#311f13;
				padding:5px 8px; 
			}
			.dipNone{
				display:none;
			}
			#cancen_btn{
				background:#eee;
			}
			#confirm_btn{
				background:#ac0000;
				color:#fff;
			}
			.settings-p .group .header span:hover{ background: #e6da00;  }
            </style>
              <script>
								  
						function showConfinBtns(k)
						{
							 $(k).addClass('dipNone');
							 $('#confirm_btn,#cancen_btn').removeClass('dipNone');
								 
						}
					
						function hideConfinBtns(k)
						{
							
								  $('#confirm_btn,#cancen_btn').addClass('dipNone');
								  $('#delete_bt').removeClass('dipNone');
						}
						function romoveUser(k){
							$(k).val('Removing.Please wait...');
							$.get('<?php echo Yii::app()->createUrl('user/removeAccount');?>',function(data){ if(data=='1'){ 
								window.location.href = '<?php echo Yii::app()->createUrl('user/signin');?>';
								
							}
							else{
								alert('Unable to delete Please try again');
							}
							})
						}
					
					</script>
					<style>
	
					</style>
