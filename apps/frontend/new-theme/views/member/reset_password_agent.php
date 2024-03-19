 
 <style>
 .sub_header_in h1 { text-align:center; }
 #login aside form .form-group i, #register aside form .form-group i { top :8px;font-weight:normal; }
 .signupDiv .rui-input .rui-icon{
	 position: absolute;

right: 10px;

left: unset !important;

top: 16px !important;
 }
 #user_signup #signup3-form .form-group label {

    font-size: 13px;
    font-weight: normal;

}
html #UserLogin_remember_me {
    display: none !important;
}
.rui-select-list input[value=""]{ display:none !important; }
.errorMessage { font-size:13px; }
 </style>
		<div class="container margin_60_35" style="padding-top:0px; ">
<div id="register" class="row">
	
	<div class="" style="width:100%;">
		<div class="col-md-12 signupDiv" style=" margin:00px auto;">
	<aside class="  " style="padding-top:0px;">
		<div class="page-header bx"  style="margin-top:0px;"> <h4 class="page-title"  style="min-width:100%;"><?php echo  'User - Reset Password';?> 
			<a href="<?php echo Yii::App()->createUrl('member/list_agents');?>" class="btn btn-secondary pull-right"><i class="fa fa-plus"></i> List Users</a>
		</h4> 
            <div class="clearfix"><!-- --></div>
        </div>
				<?php 
				$text = 'Reset Password'; 
				$form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl("member/user_reset_password",array('id'=>@$id)),
				'id'=>'signup3-form',
				'enableAjaxValidation'=>true,

				'clientOptions' => array(
				'validateOnSubmit'=>true,
				'validateOnChange'=>false,
					'beforeValidate' => 'js:function(form) {

								form.find("#bb").html("'. 'Validating...' .'");
								return true;
								}',
								'afterValidate' => 'js:function(form, data, hasError) { 

								if(hasError) {
								form.find("#bb").html("'. $text .'");
								return false;
								}
								else
								{
								form.find("#bb").html("'. 'please wait..' .'");	return true;
								}
								}',
				),
'htmlOptions'=>array('autocomplete'=>'off')
				));  
				
				 
				?>
				<div class="row" style="padding-top:15px;">
					<div class="row" style="width:100%">
			       <div class="form-group col-lg-9">
                  <div class="clearfix"></div>
                      <div class="clearfix"><!-- --></div>
						    
							<?php
							/*
							if(  $model->user_type != 'U') { ?> 
							<div class="form-group col-sm-6">
							 <?php echo $form->labelEx($model, 'log_not');?>
							<?php echo $form->checkbox($model, 'log_not', $model->getHtmlOptions('log_not',array('value'=>'1','uncheckvalue'=>'','style'=>'width:auto;',  'onchange'=>'hideloginIf(this)' ))); ?>
							<?php echo $form->error($model, 'log_not');?>
							</div> 
							<?php 
							    
							    
							} */ ?> 
							
							<div class="clearfix"></div>
	 		   
						    
						    
							<div class="loginf <?php echo  $model->log_not=="1" ? 'hide' : '';?>">
							
						 
							<div class="form-group col-lg-3">
							<?php if($model->isNewRecord){ echo CHtml::activeLabel($model, 'password', array('required' => true)); }else{ echo $form->labelEx($model, 'password'); }  ?>
						
							<?php echo $form->passwordField($model, 'password', $model->getHtmlOptions('password')); ?>
							<?php echo $form->error($model, 'password');?>
							</div> 
							<div class="form-group col-lg-3">
							 <?php if($model->isNewRecord){ echo CHtml::activeLabel($model, 'con_password', array('required' => true)); }else{ echo $form->labelEx($model, 'con_password'); }  ?>
						
							<?php echo $form->passwordField($model, 'con_password', $model->getHtmlOptions('con_password')); ?>
							<?php echo $form->error($model, 'con_password');?>
							</div> 
							</div>
					<div class="clearfix"><!-- --></div>  
				 
                  <div class="clearfix"></div>
	
	 
	 
	 
	
 			 
		 
					 
		
		</div>	
 	</div></div>
				<div id="" class="clearfix"></div>
				<a href="javascript:void(0)" onclick="$('#signup3-form').submit();" class="btn btn_1 rounded full-width container_signup_form   "  style="float:left; max-width:300px; " id="bb"><?php echo $text ;?>  </a>
				<?php $this->endWidget();?>
					<div id="" class="clearfix"></div>
				<div id="" class="clearfix" style="margin-top:20px; "></div>
					 <div class="form-group focusbox">
					<div class="col-sm-12 nopaddingLR">
							<div class="df_line" style="padding: 0;">
						 
						</div>
						 
					</div>
				</div>
			
  </aside>
	</div>

	</div>
	</div> 
	 
<style>
.select2  { width:100% !important; }
</style>
 
	
   <style>
     .pwdopsdiv { display:none ; } .pwdstrengthstr , .pwdstrength { height:auto; }
       
   </style>
