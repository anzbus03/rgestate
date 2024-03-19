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
          <h4 class="subheading_font row bold-style"><?php echo $this->tag->getTag('update_password','Update Password');?></h4>
		 
            <!-- Login -->
			<div class="tab-content" id="tab1" style="border-top: 0px solid #e0e0e0;">
				
				<?php 
				$signin_text =$this->tag->getTag('update_password','Update Password');
	$Validating = $this->tag->getTag('validating','Validating..');
	$please_wait = $this->tag->getTag('please_wait','Please wait..');
				
				$form=$this->beginWidget('CActiveForm', array(
							'id'=>'signin-form',
							 
								'enableAjaxValidation'=>true,
							
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {
				     
						form.find("#bb").html("'.$Validating .'");
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
							'htmlOptions'=>array('autocomplete'=>'off','style'=>'margin-top: 5px;max-width:95%;width:340px;margin:auto;' )
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
	
		 <div id="right-col" style="float:none !important;;border-left:0px !important; margin:auto;">
			 
			 
			<div id="signin-form" style="">
			    
			    	<div class="clearfix"></div> 
		<div class="form-group  ">

						    <div class="row">

				 
							<div class="col-sm-12">

							<?php  	echo $form->passwordField($model , 'password' ,  $model->getHtmlOptions('password',array('style'=>'border-color: #ddd;
    appearance: none;
    border-radius: 16px;
    border-style: solid;
    border-width: 2px;
    line-height: 36px;
    min-height: 48px;
    width: 100%;
    text-indent: 18px;
    font-size: 16px !important;','class'=>'input-text form-control LJB','placeholder'=>$this->tag->getTag('password_*','Password *') )));  ?>

							<?php echo $form->error($model, 'password');?>

							</div>

							</div>
		</div> 

	<div class="clear"></div>

		<div class="form-group  ">

						    <div class="row">
 
							<div class="col-sm-12">

							<?php  	echo $form->passwordField($model , 'con_password' ,  $model->getHtmlOptions('con_password',array('style'=>'border-color: #ddd;
    appearance: none;
    border-radius: 16px;
    border-style: solid;
    border-width: 2px;
    line-height: 36px;
    min-height: 48px;
    width: 100%;
    text-indent: 18px;
    font-size: 16px !important;','class'=>'input-text form-control LJB' ,'placeholder'=>$this->tag->getTag('confirm__password_*','Confrm Password *') )));  ?>

							<?php echo $form->error($model, 'con_password');?>

							</div>

							</div>
		</div> 

	<div class="clear"></div>

 	<div class="clearfix"></div> 
	 
	   	<div class="clearfix"></div> 
				<div class="form-group  margin-bottom-5">

						    <div class="row">
 
							<div class="col-sm-12">
	  
							<div class="form-group  margin-bottom-0 ">

						    <div class="row">

							<div class="col-sm-5">&nbsp;</div>

							<div class="col-sm-7">
		<input type="hidden" name="next" value=""/>
					<input type="hidden" name="form_type" value="login"/>
					<input type="hidden" name="login" value="1" />
							<button  type="submit" class="btn btn-primary btn-block headfont btn-sm-s"  id="bb" style=" clear: both;border: 0 none;
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
    width: 100%;max-width: unset !important;"    ><?php echo $signin_text;?></button>
 
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
<?php // $this->renderPartial('popup/_benefits');?>
