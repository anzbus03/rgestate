<div id="notify-container">
<?php echo Yii::app()->notify->show();?>
</div>
<fieldset id="fbsignin-form" class="span12 <?php echo $this->action->id;?>">
	<legend class="nobackground"><i class="fa fa-check-square-o"></i> Verify Email</legend>

	<div id="content-col">
 
	    <h4 class="headline1" style="font-size:14px;color:#ac0000" > **If not received email , please try  with another  email  .</h4>
	
		<div class="clear"></div>
		
		<ul class="tabs">
			<li id="logintab"   class="active" >
				<span class="lefttab"></span>
				<a href="#" onclick='return false;'>Verify Email</a>
				<span class="righttab"></span>
			</li>
			 
		</ul>

		<div class="tab_container no-margin no-padding">

<div id="tab1" class="tab_content active_content" id="fbsignin-form">
	 <div class="form">
							<span id="login-form"> </span>
		<div id="register-head">
			<h4><i class="fa fa-paper-plane"></i> Resent Verification Email</h4>
			    <?php  
				
				$form = $this->beginWidget('CActiveForm',array( 
				'enableAjaxValidation'=>true,
				'htmlOptions' =>array('id'=>'form-account-logina','data-abide'=>'','style'=>''),
				'clientOptions' => array(
				'validateOnSubmit'=>true,
				),
				)); 
				;?>
				<button data-layer-action="login" style="margin-top:0px; background-color:green" class="red awesome fbsignin-button" name="resent" value="resent" type="submit"  ><i class="fa fa-mail-forward"></i> Resent Verification Email</button>
				<?php $this->endWidget();?>
			<div class="clear"></div>
		</div>
	
		<div id="right-col">
			<div id="signin-vsep">
				<span><img src="https://www.247zoom.com/frontend/themes/styles-yellow/images/or.jpg" /></span>
			</div>
			 <style>
			 #fbsignin-form #right-col .error { width:auto !important; }
			 </style> 
			<div id="signin-form">
				<h4><i class="fa fa-inbox"></i> Change Email Address</h4>
				
				<div class="form-row "  >
					<?php  
					$form = $this->beginWidget('CActiveForm',array( 
					'enableAjaxValidation'=>true,
					'htmlOptions' =>array('id'=>'form-account-loginasd','data-abide'=>'','style'=>''),
					'clientOptions' => array(
					'validateOnSubmit'=>true,
					),
					)); 
					;?>
					<label for="id_username">Email address</label>
					<?php 
						echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array( "class"=>"user-email" ,"placeholder"=>"Your email address" ))); 
					?>
					<?php echo $form->error($model, 'email');?>
					<div class="clear"></div>
				</div>
				 
				<div class="fbsignin-button-block" style="width:100%;">
					<button type="submit" class="red awesome fbsignin-button frebites_button" value=""  style="width:100%;" ><i class="fa fa-exchange"></i> Change Email </button>
					 
					<div class="clear"></div>
				</div>
				<?php $this->endWidget();?>
			</div><!-- end #signin-form -->
		</div><!-- end #right-col -->
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div><!-- end #tab1 -->

		 
		</div><!-- end .tab_container -->
	</div><!-- end #content-col -->
</fieldset>
