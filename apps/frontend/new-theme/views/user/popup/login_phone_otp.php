<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1">
           
             
              <h4 class="subheading_font row bold-style"> <a href="<?php echo Yii::app()->createUrl('user/signin_phone_popup');?>" style="display:inline-block;margin-right:5px;" onclick="easyload(this,event,'pajax')" class="bld-link2" ><span data-aut-id="enteruser-click-back" class="_2uUJF"><svg width="14px" height="14px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-22SD7" d="M196.267 469.333l315.733-320-59.733-59.733-422.4 422.4 422.4 422.4 59.733-59.733-320-320h759.467l42.667-42.667-42.667-42.667h-755.2z"></path></svg></span></a> Login Verification Code</h4>
		 
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
 
            <!-- Login -->
							<div class="tab-content padding-top-0" id="tab1" style="border-top:0px;">
							<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'enableAjaxValidation'=>false,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'validateOnType'=>true,
							),
							)); ?>
							<div id="right-col">


							<div id="signin-form">


								<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5"><?php echo $form->labelEx($user ,'otp_false');?></div>

							<div class="col-sm-7">

							<?php  
							 
							echo $form->textField($user , 'otp_false' ,  $user->getHtmlOptions('otp_false',array('class'=>'input-text form-control','placeholder'=>'' ,'maxlength'=>'4' ,'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');")));  ?>

							<?php echo $form->error($user, 'otp_false');?>

							</div>

							</div>
		</div> 

							<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"  />Verify Code</button>

							</div>
		</div> 
							</div><!-- end #signin-form -->
							</div><!-- end #right-col -->
							<?php $this->endWidget();?>

			</div>

			<!-- Register -->
		 
            </div>
         	</div>

			<!-- Register -->
		 
            </div>
          </div>
       

		

		</div>
		 
		
	 </div>

</div>
<?php $this->renderPartial('popup/_benefits');?>
