<?php defined('MW_PATH') || exit('No direct script access allowed');?>
<div class="container">

	<div class="row">
	
		<div class="col-md-12">
        <!--Tabs -->
        <div class="sign-in-form style-1"   >
         
			<div class="clearfix"></div>
			<div class="onlyforpoupuplog" style="display:block !important;">
			<div><img src="<?php echo $this->app->apps->getBaseUrl($this->logo_without);?>"></div>
			</div>
			<div class="onlyforpoupuplogrelative"></div>
          <div class="tabs-container alt" > 
          <h4 class="subheading_font row bold-style " style="background:#fff;display: block;text-align: center !important;"><?php echo $this->tag->getTag('enter_promo_code','Enter Promo Code');?></h4>
		 
            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0;">
				
		 
			</div>

			<!-- Register -->
			 		<div class="clearfix"></div>
                  <style>
                         .isOnFram .sign-in-form .form-group { margin-bottom:10px; }
   .isOnFram .container.card-1 { margin-top:  0px; }
</style>
  <div class="clearfix"></div>
	<?php 
		$apply_code = $this->tag->getTag('apply_code','Apply Code');
	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
	
	$form=$this->beginWidget('CActiveForm', array(
							'id'=>'signin-form',
								'action'=>Yii::app()->createUrl('member/applycode'),
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
					 
				 
						
							form.find("#bb").html("'.$apply_code.'");
							return false;
					}
					else
					{
							form.find("#bb").html("'.$please_wait.'");parent.applycouponCode();	return true;
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
}.form-group   label { margin-bottom:0px;  } 
							</style>
							
	<div class="clearfix"></div>
 
	<div class="clearfix"></div>
	
		 <div id="right-col" style="float:none !important;;border-left:0px !important; margin:auto; margin:auto;max-width: 300px;margin: auto;display:block;">
			 
			 
			<div id="signin-form" style="">
			    
			    	<div class="clearfix"></div> 
		<div class="form-group  ">

						    <div class="row">


							<div class="col-sm-12">

							<?php  	echo $form->textField($model , 'code' ,  $model->getHtmlOptions('code',array( 'class'=>'input-text form-control LJB text-center'  )));  ?>

							<?php echo $form->error($model, 'code');?>

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
		 
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s rounded-btn-n"   id="bb" style=" clear: both;width:100%;max-width:100% !important;"   ><?php echo $apply_code;?></button>
 		
							</div>
		</div> 
							</div><!-- end #signin-form -->
						
	
							</div>
		</div> 

	<div class="clear"></div>
	<div class="clear"></div>

  <a href="javascript:void(0)" class="closepopu" onclick="parent.closePopupCode();" style="background:#fff !important;display:block !important; "><img style="width: 64%;vertical-align: bottom;margin-top: 11px;" src="<?php echo Yii::App()->apps->getBaseURl('assets/img/cancel.png');?>"></a>
					<div class="clearfix"></div>
				</div>
		 	<div class="clearfix"></div> 
		
	<?php $this->endWidget();?>
 						<div class="clear_div"></div>
 						
 					 	
 								
						</div>
        
 
 

			
            </div>
          </div>
       

		

		</div>
		 
		
 	</div>

</div> 
<style>
.myaccount-menu { display:none !important; ; }html.secure .sign-in-form.style-1 { padding:0px !important; ; margin:0px !important; }
.bg-bk.card-1 {
    background-color: rgb(255, 255, 255);
    border-radius: 8px;
    margin-top: 40px;
box-shadow: unset;
}html.secure .sign-in-form.style-1 {
  
    -webkit-box-shadow: unset;
    -moz-box-shadow: unset;
    box-shadow: unset;
     
}.bg-bk.card-1 { margin-top:0px !important; }
#magnificathead { display:none; }.sign-in-form .tabs-container {
    margin-top: 100px;
}
</style>
