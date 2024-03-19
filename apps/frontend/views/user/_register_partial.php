						<?php 
					 	$form=$this->beginWidget('CActiveForm', array(
								'action'=>Yii::app()->createUrl("user/signup",array('return'=>@$return)),
							'id'=>'signup3-form',
							'enableAjaxValidation'=>true,
							
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							),
							
							));  ?>
						
	<div class="clearfix"></div>
	<span class="_social"> Register via social : </span><?php   $this->widget('common.extensions.yii-eauth-master.EAuthWidget', array('action' => 'site/login')); ?>
	<div class="clearfix"></div>

	<div class="separator">
	<span>OR</span>
	</div>
	<div class="clearfix"></div>
		<div class="form-row  col-sm-6 no-padding-left" hint="">
		<label for="id_first_name">First Name: <i class="im im-icon-User"></i>
		<?php 
		echo $form->textField($model , 'first_name', array_merge($model->getHtmlOptions('first_name'),array("placeholder"=>"First Name." ,'class'=>''))); 
		?>
		  </label>
		<?php echo $form->error($model, 'first_name');?>
		<div class="clearfix"></div>
		</div>			
         
		<div class="form-row col-sm-6   pull-right no-padding-right" hint="">
		<label for="id_first_name">Last Name: <i class="im im-icon-User"></i>
		<?php 
		echo $form->textField($model , 'last_name', array_merge($model->getHtmlOptions('last_name'),array("placeholder"=>"Last Name" ,'class'=>''))); 
		?>
		 </label>
		<?php echo $form->error($model, 'last_name');?>
		<div class="clearfix"></div>
		</div>
					
						<div class="clearfix"></div>	
	
	
	
	<div class="form-row" hint="">
			<label for="id_email">Email Address: <i class="im im-icon-Mail-Inbox"></i>
			<?php 
			echo $form->textField($model , 'email', array_merge($model->getHtmlOptions('email'),array("placeholder"=>"username@provider.com" ,'class'=>''))); 
			?>
			</label>
			<?php echo $form->error($model, 'email');?>
			<div class="clear"></div>
	</div>
    
 
<div class="clearfix"></div>
<div class="form-row col-sm-6 no-padding-left" hint="">
			<label for="id_email">Password: <i class="im im-icon-Lock-2"></i>
			<?php 
			echo $form->passwordField($model , 'password', array_merge($model->getHtmlOptions('password'),array("placeholder"=>"Password" ,'class'=>''))); 
			?>
			</label>
			<?php echo $form->error($model, 'password');?>
			<div class="clear"></div>
	</div>
    
	<div class="form-row  col-sm-6   pull-right no-padding-right" hint="">
		<label for="id_email">Confirm Password: <i class="im im-icon-Lock-2"></i>		
		<?php 
		echo $form->passwordField($model , 'con_password', array_merge($model->getHtmlOptions('con_password'),array("placeholder"=>"Password(confirm)" ,'class'=>''))); 
		?>
		</label>
		<?php echo $form->error($model, 'con_password');?>
		<div class="clear"></div>
	</div>

		 
		<div class="clearfix"></div>
		<div class="form-row">
		<label for="id_nationality">Nationality </label> 
		<?php
		echo $form->dropDownList($model,'country_id', CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"),array("class"=>"", "empty"=>"- Select One -","style"=>";")); 
		?>
		<?php echo $form->error($model, 'country_id');?>
		<div class="clear"></div>
		</div>

	<div class="clearfix"></div>

 <div class="form-group">
        <div class="form-row ">
          <label class="form-check-label" for="gridCheck">
           Register Me &nbsp;&nbsp;
          </label>
          <div class="clearfix"></div>
           <?php
           $user_type_array = $model->getUserType();
           foreach( $user_type_array as $k=>$v){
			   $checked =  $k=='A' ? true :false ; 
			   echo '<label style="width:auto;float:left;display: inline-block;">'.$form->radioButton($model, 'user_type',$model->getHtmlOptions('user_type',array('class'=>'form-check-input', 'uncheckValue'=>null,'value'=>$k,'checked'=>$checked,'style'=>'width:auto;display: inline-block;float-left;height: auto;'))).'&nbsp;'.$v.'&nbsp;&nbsp;</label>';
		   }
		   ?>
			<div class="clearfix"></div>
      <?php echo $form->error($model, 'user_type');?>
		<div class="clearfix"></div>

</div>
</div>
	<div class="clearfix"></div>





 	<div class="fbregister-button-block">
							<p>By clicking on Register, you agree to the <a href="<?php echo Yii::app()->createUrl('terms');?>" target="_blank" class="redbold">  Terms and Conditions</a> and the <a href="<?php echo Yii::app()->createUrl('privacy');?>" target="_blank" class="redbold">  Privacy Policy</a>.</p>
							<input type="submit" class="red awesome fbregister-button frebites_button" value="Register" />
							<div class="clear"></div>
						</div>
					<?php $this->endWidget();?>
		 
