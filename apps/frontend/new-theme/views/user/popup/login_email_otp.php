<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1">
           	<div class="clearfix"></div>
			<div class="onlyforpoupuplog">
			<div><img src="<?php echo $this->app->apps->getBaseUrl($this->logo_without);?>"></div>
			</div>
			<div class="onlyforpoupuplogrelative"></div>
             <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('we_sent_you_a_code.','We sent you a code.');?></h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
		    	<p class="col-sm-12 col-sm-12 text-center" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size:14px;font-weight:400;color: #727272;"><?php echo  Yii::t('app',$this->tag->getTag('enter_it_below_to_verify_your_','Enter it below to verify your email account {e}'),array('{e}'=>'<br /><span style="white-space: nowrap;"> ('.$model->email.')</span>'))  ;?></font></font><span style="display:block;">
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
							'htmlOptions'=>array('class'=>'sign-in-form','style'=>'margin-top: 5px;max-width:95%;width:340px;margin:auto;' ),
							)); ?>
							<div id="right-col">


							<div id="signin-form">


								<div class="form-group  ">

						    <div class="row">

						 
							<div class="col-sm-12">

							<?php  
							 
							echo $form->textField($user , 'otp_false' ,  $user->getHtmlOptions('otp_false',array('style'=>'border-color: #ddd;
    appearance: none;
    border-radius: 16px;
    border-style: solid;
    border-width: 2px;
    line-height: 36px;
    min-height: 48px;
    width: 100%;
    text-indent: 18px;
    font-size: 16px !important;text-align:center;','class'=>'input-text form-control  LJB','placeholder'=>'' ,'maxlength'=>'6' ,'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');")));  ?>

							<?php echo $form->error($user, 'otp_false');?>

							</div>

							</div>
		</div> 

							<div class="form-group  ">

						    <div class="row">

							 
							<div class="col-sm-12">

							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s" style=" clear: both;border: 0 none;
    height: 40px;
    display: inline-block;
    border-radius: 20px;
    padding: 0 18px;
    font-size: 15px;
    font-weight: 700;
    outline: currentcolor none medium;
    box-shadow: none;
    cursor: pointer;
    margin-top: 10px;
    vertical-align: middle;
    text-align: center;
    background-color: var(--secondary-color);
    color: #fff;
    width: 100%;max-width: unset !important;"  /><?php echo $this->tag->getTag('verify_code','Verify Code');?></button>
			<?php
							 $link =   Yii::app()->createUrl('user/Resend_otop_email',array('email'=>$email))  ; ?>
                            <a href="javascript:void(0)" data-href="<?php echo  $link;?>" onclick="sendOtpAgain(this)" class="bld-link2"><?php echo $this->tag->getTag('resend_verification_code?','Resend Verification Code?');?></a>
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
 
<script>
function sendOtpAgain(k){
	var hrf =  $(k).attr('data-href') ;
	$(k).html('<?php echo $this->tag->getTag('sending..','Sending..');?>') 
    $(k).removeAttr('onclick');
	$.get(hrf,function(data){ 
		if(data=='1'){
			$(k).hide();
		}
		else{
			alert("Failed to send code!!!")
		}
		
		})
}
</script>
