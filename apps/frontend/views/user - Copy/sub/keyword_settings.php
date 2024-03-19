<style>
.settings-p .textbox
{
	text-indent:4px;
	height:26px;
}
#account-settings .header h4 { font-size:13px !important;}
.textarea {
 
	border: 1px solid #cccccc;
	padding: 5px;
	 
	background-image: url(bg.gif);
	background-position: bottom right;
	background-repeat: no-repeat;
	
	}
</style>
 <div class="settings-p">
 
    

		<ul class="large-9 columns breadcrumbs">
		<li class="angleright"><a href="<?php echo Yii::app()->createUrl('');?>/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
		<li class="angleright"><a href="<?php echo Yii::app()->createUrl('user/my_profile');?>">My Profile</a></li>
		<li class="current"><a href="#">Keyword Settings</a></li>
		</ul>
<div style="clear:both; height:1px; font-size:1px">&nbsp;</div>

<fieldset id="account-settings" class="span12">
  <legend class="nobackground"><i class="fa fa-gear" aria-hidden="true"></i> Keyword Settings</legend>
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
    <div class="header  " id="edit-name:expandable"   >
      <h4><strong>Meta tag:</strong> Updating   meta tag , will help in SEO . </h4>
      </div>
    <div class="content " id="content-name" name="name" >
     
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

        
        <div class="col" style="width:100%;"><label for="id_first_name" style="margin-bottom:10px;color:#000 !important;">Default Keyword: &nbsp </label>
        <div class="clearfix"></div>  
		<?php echo $form->textArea($user, 'meta_keyword', array_merge($user->getHtmlOptions('meta_keyword'),array( "class"=>"textarea",'style'=>'width:100%'))); ?> 
		<?php echo $form->error($user, 'meta_keyword');?> 
         
         </div>
        <div class="clearfix"></div>
        
        <div class="col" style="width:100%;"><label for="id_last_name" style="margin-bottom:10px;color:#000 !important;margin-top:10px;">Default Description: &nbsp </label>
        <div class="clearfix"></div>
         <?php echo $form->textArea($user, 'meta_description', array_merge($user->getHtmlOptions('meta_description'),array( "class"=>"textarea",'style'=>'width:100%'))); ?> 
		<?php echo $form->error($user, 'meta_description');?> 
         
         </div>
        
        <div class="clearfix" style="margin-bottom:10px;"></div>

        <div class="col"  style="float:right;margin-right:0px;padding-right:0px">
          <input type="submit" name="sitesearch" alt="Change my name" title="Update Meta"  value="Update Meta" style="width:96px;float:right;margin-right:0px;" class="awesome2" />
        </div>

      <?php $this->endWidget();?>
    </div>
  </div>
 </fieldset>


                    
                </div>
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
