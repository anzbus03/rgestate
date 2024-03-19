<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1"   >
          			<div class="clearfix"></div>
			<div class="onlyforpoupuplog">
			<div><img src="<?php echo $this->app->apps->getBaseUrl($this->logo_without);?>"></div>
			</div>
			<div class="onlyforpoupuplogrelative"></div>
          <div class="tabs-container alt" > 
           <h4 class="subheading_font row bold-style"> <a href="<?php echo Yii::app()->createUrl('user/signin_popup');?>" style="display:inline-block;margin-right:5px;" onclick="easyload(this,event,'pajax')" class="bld-link2" ><span data-aut-id="enteruser-click-back" class="_2uUJF"><svg width="14px" height="14px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-22SD7" d="M196.267 469.333l315.733-320-59.733-59.733-422.4 422.4 422.4 422.4 59.733-59.733-320-320h759.467l42.667-42.667-42.667-42.667h-755.2z"></path></svg></span></a> <?php echo $this->tag->getTag('enter_your_password','Enter your password');?></h4>
		 
			<p class="sentacode  margin-top-20  margin-bottom-20"><?php echo Yii::t('app',$this->tag->getTag('welcome_back_{e}','Welcome back {e}'),array('{e}'=>'<strong style="white-space: nowrap;">'.$user->email.'</strong>'));?></p>
            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0;">
				
				<?php
				
					$signin_text = $this->tag->getTag('next','Next');
	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
	
				 $form=$this->beginWidget('CActiveForm', array(
							'id'=>'signin-form',
								'action'=>Yii::app()->createUrl('user/signin',array('t'=>'c')),
								'enableAjaxValidation'=>true,
							
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {
				     
						form.find("#bb").html("'.$Validating.'");
						return true;
					}',
					'afterValidate' => 'js:function(form, data, hasError) { 
					 
					if(hasError) {
					 
				 
						
							form.find("#bb").html("'.$signin_text.'");
							return false;
					}
					else
					{
							form.find("#bb").html("'.$please_wait.'");	return true;
					}
					}',
					
					
							),
							'htmlOptions'=>array('autocomplete'=>'off','class'=>'recapt')
							));  ?>
							<style>
							#fbsignin-form #right-col #signin-form {
    float: none;
    border-left: 0px solid #cacaca;
    padding-left:  0px; margin:auto; 
}
							</style>
							
	<div class="clearfix"></div>
 
	<div class="clearfix"></div>
	
		 <div id="right-col" style="float:none !important;;border-left:0px !important; margin:auto;  max-width:280px;    margin: auto;    width: 100%;display:block;">
			 
			 
			<div id="signin-form" style="">
			    
			    	<div class="clearfix"></div> 
		<div class="form-group hide ">

						    <div class="row">

							<div class="col-sm-12"><?php echo $form->labelEx($user ,'email');?></div>

							<div class="col-sm-12">

							<?php  	echo $form->textField($user , 'email' ,  $user->getHtmlOptions('email',array('class'=>'input-text form-control  LJB ','placeholder'=>'' )));  ?>

							<?php echo $form->error($user, 'email');?>

							</div>

							</div>
		</div> 

	<div class="clear"></div>

 	<div class="clearfix"></div> 
		<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  	echo $form->passwordField($user , 'password' ,  $user->getHtmlOptions('password',array( 'class'=>'input-text form-control  LJB ','placeholder'=>$this->tag->getTag('password_*','Password *') )));  ?>

							<?php echo $form->error($user, 'password');?>
			
							</div>

							</div>
		</div>
			<div class="form-group hide margin-bottom-5">

						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">

						<div class="checkboxes">
						<label class="container_check" for="<?php echo $user->modelName;?>_remember_me" style="margin-right:0px;"> Remeber Me
						<?php  echo $form->checkBox($user , 'remember_me',  $user->getHtmlOptions('remember_me',array(  'value'=>'1', 'uncheckValue'=>'',)) );  ?> 
						  <span class="checkmark"></span>
						</label>
					</div>
					<?php echo $form->error($user, 'remember_me');?>
					<div class="clear"></div>
			
							</div>

							</div>
		</div> 
	 
	   	<div class="clearfix"></div> 
				<div class="form-group  margin-bottom-5">

						    <div class="row">
 
							<div class="col-sm-12">
	  
							<div class="form-group  margin-bottom-0 ">

						    <div class="row">
 
							<div class="col-sm-12">
		<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n" disabled id="bb" style="clear: both;width:100%;max-width: unset !important;"    ><?php echo $signin_text;?></button>
		<span class="forgotpassword   " style="display:block;"><a href="<?php echo  $this->app->createUrl('user/forgot_password');?>" onclick="easyload(this,event,'pajax')" style="clear: both;width:100%;max-width: unset !important;"  class="link_color text-right"><?php echo $this->tag->getTag('forgot_password?','Forgot Password?');?></a></span>
							</div>
		</div> 
							</div><!-- end #signin-form -->
						
	
							</div>
		</div> 

	<div class="clear"></div>
	<div class="clear"></div>

  
					<div class="clearfix"></div>
				</div>
		 	<div class="clearfix"></div> 
			
				<div class="clearfix"></div> 
				<div class="form-group   margin-bottom-0  ">

						    <div class="row">
 	<div class="form-group  margin-bottom-0 ">

						    <div class="row">

						 
							<div class="col-sm-12  ">
	 						
			                <div class="col-sm-6  ">

							</div>
		</div> 
							</div><!-- end #signin-form -->
						
</div>
			</div>
			</div>
				<div class="clearfix"></div> 
			<div class="pop_boxone">
						<?php
						$min_error_count  = 1 ; 
					  
									$min_error_count  = 2 ; 
									?> 
									<div class="form-group">
							 		<div class="clearfix"></div>
								 
									<div class="clearfix"></div>
									<?php echo $form->hiddenField($user, '_recaptcha' );?>
									<?php echo $form->error($user, '_recaptcha',array('style'=>'top:0px !important;'));?>
									 </div>	
									<div class="clearfix"></div>
										</div>	
	
	<?php $this->endWidget();?>
 						<div class="clear_div"></div>
						</div>
        
 

			</div>

			<!-- Register -->
			 		<div class="clearfix"></div>
			 	<div class="clearfix"></div>
			
            </div>
          </div>
       

		

		</div>
		 
		
 	</div>

</div> 
 
