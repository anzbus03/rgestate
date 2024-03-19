<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 
 <style>
 .card-1 .subheading_font {
 
    line-height: 50px;
}
		.isOnFram .closepopu {
    display: block;
    height: 64px;
    width: 50px;
    line-height: 50px;
}			
 </style>
 <style>
.OTP__resendOTP--2UolI {
    cursor: pointer;
    color: #304ffe;
}.OTP__resendDiv--50fyT {
    padding: 7px 24px 0;
    text-align: center;
    color: #49ad49;
    width:100%; 
}	.OTP__otpSentText--26PEz {
    line-height: 20px;
    font-size: 12px;
    color: #757575;
    margin: 9px 0 0;display: block;text-align:center;
width: 100%;
}
#UserLoginPhone_otp_false {
  padding-left: 15px;
  letter-spacing: 42px;
  border: 0;
  background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
  background-position: bottom;
  background-size: 50px 1px;
  background-repeat: repeat-x;
  background-position-x: 35px;
width: 198px !important;
margin: auto;
}.mlabe {
    text-align: center;
    line-height: 26px;
    font-size: 18px;
    color: #212121;
    margin: 0;
}
</style>

<script>
function resendthisOtp(k){
	$('#mycounter').removeAttr('onclick',"resendthisOtp(this)");
	i = 60;
	
	var phnumber = $(k).attr('data-phone');
	$.get('<?php echo Yii::app()->createUrl('user/resendOtp2');?>/phone/'+phnumber ,function(data){
		onTimer();
		var data = JSON.parse(data);
		if(data.status=='0'){
		    $('#mycounter').remove();
		//	errorAlert('error',data.msg)
		      
		       	$('#messageDiv').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
		        	  //setTimeout(function(){ 	$('#messageDiv').html('');  }, 10000);
		        
			}
		else{
		    	$('#messageDiv').html('<div class="alert alert-success" role="alert">'+data.msg+'</div>');
		     	// setTimeout(function(){ 	$('#messageDiv').html('');  }, 10000);
		//	successAlert('success',data.msg)
		}
		
		 })
}
i = 60;
function onTimer() {
  document.getElementById('otp_setter').innerHTML = i;
  i--;
  if (i < 0) {
    $('#otp_setter').html('Resend Code')
    $('.besend').addClass('hide');
    $('#mycounter').attr('onclick',"resendthisOtp(this)")
  }
  else {
       $('.besend').removeClass('hide');
    setTimeout(onTimer, 1000);
  }
}
$(function(){
onTimer();
    
    
    
})
</script>
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1" >
           
             <h4 class="subheading_font row bold-style"><a href="<?php echo $this->app->createUrl('user/signin_phone');?>" style="display:inline-block;margin-right:5px;" onclick="easyload(this,event,'pajax')" class="bld-link2"><span data-aut-id="enteruser-click-back" class="_2uUJF"><svg width="14px" height="14px" viewBox="0 0 1024 1024" data-aut-id="icon" class="" fill-rule="evenodd"><path class="rui-22SD7" d="M196.267 469.333l315.733-320-59.733-59.733-422.4 422.4 422.4 422.4 59.733-59.733-320-320h759.467l42.667-42.667-42.667-42.667h-755.2z"></path></svg></span></a>Login Verification Code</h4>
          <div class="tabs-container alt"> 
<div class="clearfix"></div>
				<div class="clearfix"></div>
				
            <!-- Login -->
			<div class="tab-content  pt-0" id="tab1" style="border-top: 0px solid #e0e0e0;">
		   <div class=" "> 
 
            <!-- Login -->
							<div class="tab-content padding-top-0 pt-0" id="tab1" style="border-top:0px;">
							<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'enableAjaxValidation'=>false,
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'validateOnType'=>false,
							'beforeValidate' => 'js:function(form) {
				     
						setinptuval();return true;
					}',
							),
							)); ?>
							<div id="right-col">


							<div id="signin-form" style="    max-width:290px;    margin: auto;    width: 90%; ">
                            

								<div class="form-group  ">

						    <div class="row">

							<div class="col-sm-12  text-center"><?php echo $form->labelEx($user ,'otp_false');?></div>
	<p class="OTP__otpSentText--26PEz">We have sent you a 4 digit OTP</p>
							<p class="OTP__otpSentText--26PEz mb-3"  >on <strong style="font-size: 14px;"><?php echo $user->phone;?></strong></p>
						
							<div class="col-sm-12">
<div class="OTP__otpField--2PmLv">
   <div class="OTP__inputContainer--3QOBj"><input class="OTP__inputClass--25QHh" id="abc_1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');counttheNumber2(this)" pattern="^[0-9]$" type="tel" value=""></div>
   <div class="OTP__inputContainer--3QOBj"><input class="OTP__inputClass--25QHh"  id="abc_2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');counttheNumber2(this)" pattern="^[0-9]$" type="tel" value=""></div>
   <div class="OTP__inputContainer--3QOBj"><input class="OTP__inputClass--25QHh"  id="abc_3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');counttheNumber2(this)" pattern="^[0-9]$" type="tel" value=""></div>
   <div class="OTP__inputContainer--3QOBj"><input class="OTP__inputClass--25QHh"  id="abc_4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');counttheNumber2(this)" pattern="^[0-9]$" type="tel" value=""></div>
</div>
<script>
	function setinptuval(){
		if($('#abc_1').val()!='' && $('#abc_2').val()!='' && $('#abc_3').val()!='' && $('#abc_4').val()!=''){
			var idv = $('#abc_1').val()+ $('#abc_2').val()+ $('#abc_3').val()+ $('#abc_4').val();
			$('#UserLoginPhone_otp_false').val(idv);
			$('#messageDiv').html('');
		//	alert(	$('#UserLoginPhone_otp_false').val())
			$('#verifyBtnm2').click();
		}
		else{
		   if($('#abc_1').val()==''){$('#abc_1').focus(); return false;}
		   if($('#abc_2').val()==''){$('#abc_2').focus(); return false;}
		   if($('#abc_3').val()==''){$('#abc_3').focus(); return false;}
		   if($('#abc_4').val()==''){$('#abc_4').focus(); return false;}
		}
	}
function counttheNumber2(k){
	if($(k).val().length=='1'){
	vid = $(k).attr('id');
	switch(vid){
		case 'abc_1':
		$('#abc_2').focus();setinptuval();
		break;
		case 'abc_2':
		$('#abc_3').focus();setinptuval();
		break;
		case 'abc_3':
		$('#abc_4').focus();setinptuval();
		break;
		case 'abc_4':
		setinptuval();
		break;
	}
	}
}

</script>
<style>
.OTP__otpField--2PmLv {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 0px;
}.OTP__inputContainer--3QOBj {
    padding: 0 6px;
} .OTP__inputClass--25QHh {
    width: 48px;
    height: 48px;
    border-radius: 4px;
    border: 1px solid #eaeaea;
    background-color: #fff;
    line-height: 24px;
    font-size: 18px;
    color: #212121;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    -moz-appearance: textfield;
}  .OTP__inputClass--25QHh:active,   .OTP__inputClass--25QHh:focus {
    border-color: #212121;
}
</style>
							<?php  
							 
							echo $form->hiddenField($user , 'otp_false' ,  $user->getHtmlOptions('otp_false',array('style'=>'font-size: 16px;line-height: 24px;padding: 12px;height: auto;width: auto;','class'=>'input-text form-control','placeholder'=>'' ,'maxlength'=>'4' ,'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');counttheNumber(this)")));  ?>

							<?php echo $form->error($user, 'otp_false');?>

							</div>

							</div>
		</div> <div id="messageDiv"></div>
			<div class="form-group  ">
						<div class="row">
						    <?php
						     if(!isset(Yii::app()->request->cookies['disable_login'])){  ?> 
								<div class="OTP__resendDiv--50fyT"  id="mycounter"   data-phone="<?php echo base64_encode($model->phone);?>" ><span class="OTP__resendOTP--2UolI"><span class="besend">Resend Code after (</span><span id="otp_setter"></span><span class="besend">)</span></span></div>
					        <?php } 
					        ?>
						</div>
						</div>

							<div class="form-group  ">

						    <div class="row">

							 
							<div class="col-sm-12">
<button  type="submit"   id="verifyBtnm2" style="position:absolute;left:-9999999999px" />Verify Code</button>
							<button  type="button" class="btn btn-primary btn-block headfont  " onclick="setinptuval()"  id="verifyBtnm" />Verify Code</button>

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
function counttheNumber(k){
	if($(k).val().length=='4'){
	//	$('#verifyBtnm').click();
	}
}

</script>
