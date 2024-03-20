<style>
	  input, input[type=text], input[type=password], input[type=email], input[type=number], textarea, select {
    	height: 51px;
            line-height: 51px;
            padding: 0 20px;
            outline: 0;
            font-size: 15px;
            color: gray;
            margin: 0 0 16px;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
            display: block;
            background-color: #fff;
            border: 1px solid #dbdbdb;
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.06);
            font-weight: 500;
            opacity: 1;
            border-radius: 3px;
    margin-left: 0 !important;
}
#contact input,#contact label,#contact textarea {
    margin-bottom: 0px;  margin-top: 0px;
}
#contact .rows {
    margin-bottom: 15px;
}
.errorMessage {   color:#e13009!important;}
	  </style>
<div class="sub_header_in sticky_header margin_60_35">
		<div class="container">
			<h1>Banner Advertise</h1>
		</div>
	
	</div>
<main>
<div class="container margin_60_35">
			<div class="row justify-content-center">
			 
			<div class="col-xl-12 col-lg-12 col-md-12" >
				<div class="box_account" style="max-width:800px;margin:40px auto;">
					
					<div class="form_container" id="contact">
				
				<?php
					$form = $this->beginWidget('CActiveForm', array(
					'enableAjaxValidation'=>true,
					'htmlOptions'=>array('enctype'=>'multipart/form-data'),
'id'=>'signUpForm',
				'clientOptions' => array(
				'validateOnSubmit'=>true,
				'validateOnChange'=>false,
					'beforeValidate' => 'js:function(form) {

								form.find("#bb").val("'. 'Validating...' .'");
								return true;
								}',
								'afterValidate' => 'js:function(form, data, hasError) { 

								if(hasError) {
								form.find("#bb").val("'. 'Send' .'");
								return false;
								}
								else
								{
								form.find("#bb").val("'. 'please wait..' .'");	return true;
								}
								}',
				),
					));
					?>
					<div class="row">
						 
					 
					 
						<div class="col-md-4 form-group">
									<div>
									<?php echo $form->labelEx($model, 'name');?>
									<?php echo $form->textField($model, 'name',$model->getHtmlOptions('name')); ?>
									<?php echo $form->error($model, 'name');?>
									</div>
								</div>
								
								

						<div class="col-md-4 form-group">
							<div>
							<?php echo $form->labelEx($model, 'phone');?>
							<?php echo $form->textField($model, 'phone',$model->getHtmlOptions('phone')); ?>
							<?php echo $form->error($model, 'phone');?>
							</div>
						</div>
						<div class="col-md-4 form-group">
							<div>
							<?php echo $form->labelEx($model, 'email');?>
							<?php echo $form->textField($model, 'email',$model->getHtmlOptions('email')); ?>
							<?php echo $form->error($model, 'email');?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-12 form-group">
						<h4>Banner Details</h4></div>
						<div class="clearfix"></div>
						<div class="col-md-12 form-group">
							<?php echo $form->labelEx($model, 'position_id');?>
							<div class="clearfix"></div>
							<label><?php echo $position->position_name;?> [ <?php echo   'Width '.$position->banner_width.'px <span class="text-red">X</span> Height  '.$position->banner_height.'px';       ?> ]</label>
							<hr style="border-color:blue" />
							<?php echo $form->hiddenField($model,'position_id'   ); ?>
							<?php echo $form->error($model, 'position_id');?>
							</div>
						<div class="form-group col-lg-12">
						<?php echo $form->labelEx($model, 'image');?>
						<?php echo $form->fileField($model, 'image',$model->getHtmlOptions('image')); ?>
						<?php echo $form->error($model, 'image');?>
					</div>   
						<div class="clearfix"><!-- --></div>
						<div style="height:10px;"></div>        
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model, 'link_url');?>
						<?php echo $form->textField($model, 'link_url',$model->getHtmlOptions('link_url')); ?>
						<?php echo $form->error($model, 'link_url');?>
					</div>   
					
		 
					<div class="form-group col-lg-3">
					<?php echo $form->labelEx($model, 'from_date');?> 
					<div class="clearfix"></div>
					<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'     => $model,
                                'attribute' => 'from_date',
                                'cssFile'   => null,
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => $model->getDatePickerFormat(),
                                ),
                                'htmlOptions' => array('class' => 'form-control','placeholder'=>'from date' ,'autocomplete'=>false,'readonly'=>true),
                            ));
					
					 ?>
					<?php echo $form->error($model, 'from_date');?>
					</div>     
					<div class="form-group col-lg-3">
					<?php echo $form->labelEx($model, 'to_date');?> 
					<div class="clearfix"></div>
					<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'     => $model,
                                'attribute' => 'to_date',
                                'cssFile'   => null,
                                'options'   => array(
                                    'showAnim'   => 'fold',
                                    'dateFormat' => $model->getDatePickerFormat(),
                                ),
                                'htmlOptions' => array('class' => 'form-control','placeholder'=>'to date' ,'autocomplete'=>false,'readonly'=>true),
                            ));
					
					 ?>
					<?php echo $form->error($model, 'to_date');?>
					</div> 
					
					 
					
					
					<div style="width: 100%;display: block;"></div>
					</div>
						 <div class="form-group">
									<script src="https://www.google.com/recaptcha/api.js?render=<?php echo Yii::app()->options->get('system.common.recaptcha_site_key','6Ld3ZsYUAAAAAF0GkEfg-s4vNYDb2u3K3pGucQA7');?>"></script>
									<div class="clearfix"></div>
									 <script>
  grecaptcha.ready(function() {
    
            // do request for recaptcha token
            // response is promise with passed token
            grecaptcha.execute('<?php echo Yii::app()->options->get('system.common.recaptcha_site_key','6Ld3ZsYUAAAAAF0GkEfg-s4vNYDb2u3K3pGucQA7');?>' ).then(function(token) {
                // add token to form
                $('#signUpForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                   
            });;
        });
  </script>
								   
									<div class="clearfix"></div>
									<?php echo $form->error($model, '_recaptcha',array('style'=>'top:0px !important;'));?>
									<div class="clearfix"></div>
					            	</div>
					 

				  
<hr>
 	
								<div class="form-group" style="margin-bottom: 35px; ">
						<p style="margin-bottom: 5px;padding-left: 30px;display:none;"><?php echo Yii::t('app', 'or call {n}' ,array('{n}'=>$this->options->get('system.common.contact_phone')));?></p>
							<label class="container_check"><?php echo Yii::t('app', 'We respect your privacy. See our {l}' ,array('{l}'=>'<a href="#" target="_blano">'. 'Privacy policy' .'.</a>')); ?>
								<?php echo $form->checkbox($model, 'accept' ,array('uncheckValue'=>null,'style'=>'width:auto;height:auto;') ); ?>
								<span class="checkmark"></span>
							</label>
								<?php echo $form->error($model, 'accept');?>
						</div>
					<div class="text-center"><input type="submit" id="bb" value="<?php echo  'Send' ;?>" class="btn_1 full-width"></div>
					
					<?php $this->endWidget();?>
				
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
			</div>
		 
		</div>
			<!-- /row -->
		</div>

</main>

<style>

main{
	background: url('<?php echo AssetsUrl::img('advertise.jpg');?>') no-repeat center center;
    background-size: auto;
background-size: cover;
}
</style> <style>.grecaptcha-badge{ z-index:11; }</style>
<script>
 var change_select_url = '<?php echo Yii::App()->createUrl('advertise_interest/getCategory');?>'
function changeSEctionthis(k){
$('#BannerRequest_category_id').find('option').remove().end().append('<option value="">All Category</option>').val('');
$.get(change_select_url+'/id/'+$(k).val(),function(data){  $('#BannerRequest_category_id').append(data);  })
}

</script>
<style>
main {
    background: url('https://www.askaan.com/polski/frontend/assets/img/advertise.jpg') no-repeat center center;
    background-size: auto;
    background-size: cover;
}.form_container {
    -webkit-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    padding: 25px;
    position: relative;
}
</style>
