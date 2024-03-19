<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1">
           
             <h4 class="subheading_font row bold-style">Enter Verification Code</h4>
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
							'enableAjaxValidation'=>true,
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

							<div class="col-sm-5"><?php echo $form->labelEx($model ,'otp_false');?></div>

							<div class="col-sm-7">

							<?php  
							 
							echo $form->textField($model , 'otp_false' ,  $model->getHtmlOptions('otp_false',array('class'=>'input-text form-control','placeholder'=>'' ,'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"   )));  ?>

							<?php echo $form->error($model, 'otp_false');?>

							</div>

							</div>
		</div> 

							<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"  />Verify Code</button>
							<?php
							 $link = (!empty($email)) ? Yii::app()->createUrl('user/otp_verify_popup',array('email'=>$email)) : Yii::app()->createUrl('user/otp_verify' ) ; ?>
                            <a href="<?php echo  $link;?>" class="bld-link2">Resend Verification Code?</a>
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
