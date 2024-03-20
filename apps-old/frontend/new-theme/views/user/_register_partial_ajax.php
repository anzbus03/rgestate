<?php
$merge_array = array_filter($_GET);
	$query = '';
	if(!empty($merge_array)){
	$query = http_build_query($merge_array);
	}
	$saveUrl = Yii::app()->createUrl('user/signupajax');
	$saveUrl = $saveUrl.'?'.$query ; 
	
	$form = $this->beginWidget('CActiveForm', array(
	'id' => 'werwer',
	'action'=>Yii::app()->createUrl('user/signup'),
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	'validateOnChange'=>false,
		'beforeValidate' => 'js:function(form) {
				     
						form.find("#reg_btn").html("Validating..");
						return true;
					}',
	'afterValidate' => 'js:function(form, data, hasError) { 
	if(hasError) {
	form.find("#reg_btn").html("Register");
	return false;
	}
	else
	{
	$("#reg_btn").html("Processing...");
	ajaxSubmitHappenFav(form, data, hasError,"'.$saveUrl.'"); 
	}
	}',
	),
	'htmlOptions'=>array('class'=>'form   phs','style'=>'margin-top: 5px;' ),
	));
	?>
						<div class="clearfix"></div>	
	
				<div style="max-width: 350px;margin:  0px auto;position:relative;" id="rmsssss"> 
			
		 <div class="clearfix"></div>
	<div class="form-row" hint="">
			<label for="id_email"><i class="im im-icon-Mail-Inbox"></i>
			<?php 
			echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array("placeholder"=>"Email Address*" ,'class'=>''))); 
			?>
			</label>
			<?php echo $form->error($model, 'email');?>
			<div class="clear"></div>
	</div>
	<div class="clearfix"></div>
	<div class="form-row" hint="">
			<label for="id_email"><i class="im im-icon-Phone"></i>
			<?php 
			echo $form->textField($model , 'phone', array_merge($model->getHtmlOptions('phone'),array("placeholder"=>"Phone Numaber* (+92-3XZ-YYYYYYY)" ,'class'=>''))); 
			?>
			</label>
			<?php echo $form->error($model, 'phone');?>
			<div class="clear"></div>
	</div>
	<div class="clearfix"></div>
		<div class="form-row" hint="">
		<label for="id_first_name"><i class="im im-icon-User"></i>
		<?php 
		echo $form->textField($model , 'first_name', array_merge($model->getHtmlOptions('first_name'),array("placeholder"=>"Full  Name*" ,'class'=>''))); 
		?>
		  </label>
		<?php echo $form->error($model, 'first_name');?>
		<div class="clearfix"></div>
		</div>			
         
		 
					
		<div class="clearfix"></div>	
	
	
	
	
    
 
<div class="clearfix"></div>
<div class="form-row col-sm-6 no-padding-left" hint="">
			<label for="id_email"><i class="im im-icon-Lock-2"></i>
			<?php 
			echo $form->passwordField($model , 'password', array_merge($model->getHtmlOptions('password'),array("placeholder"=>"Password*" ,'class'=>''))); 
			?>
			</label>
			<?php echo $form->error($model, 'password');?>
			<div class="clear"></div>
	</div>
    
	<div class="form-row  col-sm-6   pull-right no-padding-right" hint="">
		<label for="id_email"><i class="im im-icon-Lock-2"></i>		
		<?php 
		echo $form->passwordField($model , 'con_password', array_merge($model->getHtmlOptions('con_password'),array("placeholder"=>"Password(confirm)*" ,'class'=>''))); 
		?>
		</label>
		<?php echo $form->error($model, 'con_password');?>
		<div class="clear"></div>
	</div>

		 
		<div class="clearfix"></div>
		<?php
		if(!Yii::App()->request->isPostRequest){$model->country_id = $this->project_country_id;}?> 
		<div class="form-row  col-sm-6    no-padding-left" hint="" style="position:relative;">
		<label for="id_nationality"><?php
		echo $form->dropDownList($model,'country_id', CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"),array("class"=>"select2 ajx","style"=>"width:100%",  "empty"=>"Select County *",'data-url'=>Yii::App()->createUrl('site/select_city_new'),'onchange'=>'load_via_ajax6(this,"state_id")')); 
		?>
		</label> 
		<?php echo $form->error($model, 'country_id');?>
		<div class="clear"></div>
		</div>
		<?php
		       $cities =  CHtml::listData(States::model()->AllListingStatesOfCountry((int) $model->country_id) ,'state_id' , 'state_name') ;
             ?>
		<div class="form-row  col-sm-6   pull-right no-padding-right" hint="">
		<label for="id_nationality"><?php
		echo $form->dropDownList($model,'state_id',   $cities ,array("class"=>"select2 ajx", "empty"=>"Select City *","style"=>"width:100%",)); 
		?>
		</label> 
		<?php echo $form->error($model, 'state_id');?>
		<div class="clear"></div>
		</div>

	<div class="clearfix"></div>
	
		<div class="clearfix"></div>
	<div class="form-row hide" hint="">
			<label for="id_email"><i class="im im-icon-Mail-Inbox"></i>
			<?php 
			$user_type_array = $model->getUserType();
			if(!Yii::App()->request->isPostRequest and empty($model->user_type)){$model->user_type = 'U';}
			echo $form->dropDownList($model , 'user_type',$user_type_array ,  array_merge($model->getHtmlOptions('user_type'),array("empty"=>"Signing up as*" ,'class'=>'select2','onchange'=>'selectDetailFields(this)'))); 
			?>
			</label>
			<?php echo $form->error($model, 'user_type');?>
			<div class="clear"></div>
	</div>
	<div class="clearfix"></div>

  <div class="clearfix"></div>





 	<div class="fbregister-button-block">
		 
						 
							<button type="submit" id="reg_btn" value="Register" class="btn btn-primary btnLrg btnFullWidth">Register</button>
								<p>By clicking on Register, you agree to the <a href="<?php echo Yii::app()->createUrl('article/terms');?>" target="_blank" class="redbold">  Terms and Conditions</a> and the <a href="<?php echo Yii::app()->createUrl('article/condition');?>" target="_blank" class="redbold">  Privacy Policy</a>.</p>
						
							<div class="clear"></div>
						</div>
					<?php $this->endWidget();?>
		 
		 <div class="clearfix"></div></div>
<script>
var modelName5 = '<?php echo $model->modelName;?>'
</script>
	<p class="font-size:14px !important;margin-bottom:15px;display: block;clear: both;font-weight:400"><span class="pull-right">Already a member? <a href="javascript:void(0)"  onclick="loadSetAcountSign(this)" class="link_color">Click here to login</a></span></p>
		