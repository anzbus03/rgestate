<?php 
					 	$form=$this->beginWidget('CActiveForm', array(
								 
							'id'=>'signup3-form',
							'enableAjaxValidation'=>true,
							
							'clientOptions' => array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'beforeValidate' => 'js:function(form) {
				     
						form.find("#bb").html("Validating..");
						return true;
					}',
					'afterValidate' => 'js:function(form, data, hasError) { 
					 
					if(hasError) {
					 
						  $("html, body").animate({
        scrollTop: form.find(".errorMessage:visible:first").offset().top-90
    }, 2000);
						
							form.find("#bb").html("Register");
							return false;
					}
					else
					{
							form.find("#bb").html("Please wait..");	return true;
					}
					}',
					
					
							),
							'htmlOptions'=>array('autocomplete'=>'off','class'=>'sign-in-form')
							));  ?>
<style>
@media only screen  and     (min-width:993px) and     (max-width:1259px){

    #member .grid-margin #signup-form .col-lg-12 { padding:0px !important; padding-right:10px !important; ; }
}
</style>

	  <div class="clearfix"><!-- --></div> 
	  <div class="row">
                <div class="form-group col-lg-9 div_frst no-padding-left">
					
						 
 <div class="clearfix"></div>
<div class="clearfix"></div>
		<div class="form-group col-sm-12" hint="">
		<?php echo $form->labelEx($model, 'first_name');?>
		 <div style="display:block;"><?php echo $model->first_name;?></div>
		<?php echo $form->error($model, 'first_name');?>
		<div class="clearfix"></div>
		</div>			
         
		 
					
		<div class="clearfix"></div>	

	<div class="form-group col-sm-6" hint="">
			<?php echo $form->labelEx($model, 'phone');?>
			 <div style="display:block;"><?php echo $model->phone;?></div>
			 
			<?php echo $form->error($model, 'phone');?>
			<div class="clear"></div>
	</div>
	<div class="form-group col-sm-6" hint="">
			<?php echo $form->labelEx($model, 'mobile');?>
			 <div  style="display:block;"><?php echo $model->mobile;?></div>
			 
			<?php echo $form->error($model, 'mobile');?>
			<div class="clear"></div>
	</div>
		 <div class="clearfix"></div>
		 <div class="col-sm-12 form-group">
		 <a href="javascript:void(0)" onclick="showPop(this)" data-href="<?php echo Yii::app()->createUrl('member/change_details');?>" class="btn btn-warning">Change Contact Details</a>
		 </div>
		 <div class="clearfix"></div>
		 
		  
					
		<div class="clearfix"></div>	
	 
		<div class="">
		<?php
		if(!Yii::App()->request->isPostRequest and empty($model->country_id) ){$model->country_id = $this->project_country_id;}?> 
		<div class="form-group  col-sm-6    " hint="">
		<?php echo $form->labelEx($model, 'country_id');?>
		<?php
		echo $form->dropDownList($model,'country_id', CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"),array("class"=>"select2", "empty"=>"Select County*",'data-url'=>Yii::App()->createUrl('site/select_city_new'),'onchange'=>'load_via_ajax2(this,"state_id")')); 
		?>
		 
		<?php echo $form->error($model, 'country_id');?>
		<div class="clear"></div>
		</div>
		<?php
		       $cities =  CHtml::listData(States::model()->AllListingStatesOfCountry((int) $model->country_id) ,'state_id' , 'state_name') ;
             ?>
		<div class="form-group  col-sm-6  " hint="">
		<?php echo $form->labelEx($model, 'state_id'); 
		 
		echo $form->dropDownList($model,'state_id',   $cities ,array("class"=>"select2", "empty"=>"Select Region*","style"=>";")); 
		?>
		 
		<?php echo $form->error($model, 'state_id');?>
		<div class="clear"></div>
		</div>
</div>
	<div class="clearfix"></div>
	
	 
	
	 <div class="clearfix"></div>
	 <div class="openWhenUserType <?php if(!in_array($model->user_type,array('A','C','D'))){ echo 'hide';  };?>">
			<div class="form-group col-sm-12" hint="">
			 
			<?php
		  	 echo $form->labelEx($model, 'company_name'); 
			 echo $form->textField($model, 'company_name', $model->getHtmlOptions('company_name',array('class'=>'form-control','placeholder'=>'Agency / Company Name'))); ?>
			 
			<?php echo $form->error($model, 'company_name');?>
			</div> 
				 <div class="clearfix"></div>
				 
				 <div class="clearfix"></div>
			<div class="form-group  col-sm-12">
							 
							<?php
							 echo $form->labelEx($model, 'address');   
							 echo $form->textField($model, 'address', $model->getHtmlOptions('form-control',array('placeholder'=>'Company Address'))); ?>
							 
							<?php echo $form->error($model, 'address');?>
							</div> 
							<div class="clearfix">
								<div class="form-group col-lg-3">
							<?php echo $form->labelEx($model, 'zip');?>
							<?php echo $form->textField($model, 'zip', $model->getHtmlOptions('zip')); ?>
							<?php echo $form->error($model, 'zip');?>
							</div> 
							<div class="form-group col-lg-3">
							<?php echo $form->labelEx($model, 'fax');?>
							<?php echo $form->textField($model, 'fax', $model->getHtmlOptions('fax')); ?>
							<?php echo $form->error($model, 'fax');?>
							</div> 
							<div class="form-group col-lg-3">
								<?php echo $form->labelEx($model, 'webstie');?>
								<?php echo $form->textField($model, 'website', $model->getHtmlOptions('webiste')); ?>
								<?php echo $form->error($model, 'website');?>
								</div> 
							
							</div>
							<div class="clearfix"></div>
								<div class="form-group  col-sm-12" hint="">
					<label>
					<?php
					if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
						$model->service_offerng = CHtml::listData($model->moreSection,'section_id','section_id');
						 
					}
					  echo $form->labelEx($model, 'service_offerng');
					$datas = array('1'=>'Sale','2'=>'Rent') ;
					?>
					<?php echo $form->dropDownList($model, 'service_offerng', $datas , $model->getHtmlOptions('service_offerng',array( 'data-placeholder'=>'Select your Service  Sections', 'class'=>'select2 form-control' ,'style'=>'width:100%;'		,'multiple'=>true	)			)); ?>
					</label>
					<?php echo $form->error($model, 'service_offerng');?>
					</div>
			
				<div class="form-group  col-sm-12" hint="">
					 
					<?php
					if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
						$model->service_offerng_detail = CHtml::listData($model->moreCategory,'category_id','category_id');
						 
					}
					$datas = CHtml::listData(Category::model()->listData(),'category_id','category_name') ;
					?>
					<?php
					 echo $form->labelEx($model, 'service_offerng_detail');
					 echo $form->dropDownList($model, 'service_offerng_detail', $datas , $model->getHtmlOptions('service_offerng_detail',array( 'data-placeholder'=>'Select your Service Categories', 'class'=>'select2 form-control' ,'style'=>'width:100%;'		,'multiple'=>true	)			)); ?>
				 
					<?php echo $form->error($model, 'service_offerng_detail');?>
					</div>
					
					<div class="clearfix"></div>
					      <div class="form-group  col-sm-12"> 
				 
					 
						<?php 
						if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
						$model->mul_state_id = CHtml::listData($model->moreState,'state_id','state_id');
						 
					}
						 echo $form->labelEx($model, 'mul_state_id');
						echo $form->dropDownList($model, 'mul_state_id', CHtml::listData(States::model()->AllListingStatesOfCountry((int) $this->project_country_id),'state_id' , 'state_name') , $model->getHtmlOptions('mul_state_id',array(  'class'=>'select2' ,'style'=>'width:100%;'	,'multiple'=>true	,'data-placeholder'=>'Select Service Areas'	)			)); ?>
				
				 
					
					<?php echo $form->error($model, 'mul_state_id');?>
					</div>
					<div class="clearfix"></div>
					
					<div class="clearfix"></div>
					<div class="form-group col-sm-12" hint="">
			 
			<?php
		  	 echo $form->labelEx($model, 'description'); 
			 echo $form->textArea($model, 'description', $model->getHtmlOptions('description',array('class'=>'form-control', 'style'=>'height:150px'  ))); ?>
			 
			<?php echo $form->error($model, 'description');?>
			</div> 
					<div class="clearfix"></div>
				
		</div>	
		</div>	
		 <div class="form-group col-lg-3 div_sec">
				<?php 
										$fileField = 'image';
										$title_text = 'Add / Change <br /> Photo';
										$types = '.png,.jpg,.jpeg';
										$maxFiles = '1';
									 
										$this->renderPartial('root.apps.frontend.new-theme.views.member._file_field_browse',compact('form','fileField','maxFilesize','types','maxFiles','model','title_text'));
										
		  
		 
		 ?>
		</div>		 				
		</div>
		<div class="clearfix"><!-- --></div>	
						
						    
						   
	
    
 	<div class="">
							<button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
							<div class="clear"></div>
						</div>
					<?php $this->endWidget();?>
					<style>
					#avatar_updator .alert-info ul li { color:#000;font-size:10px;}
					</style>
		 
<script>
	 
	var cityBaseUrl  = '<?php echo Yii::app()->createUrl('site/loadCity');?>';
	var modelName = '<?php echo $model->modelName;?>';
  
	var countryVal = $('#'+modelName+'_mul_country_id').val();
	var cityInput =  modelName+'_mul_state_id';
	var cityVal = $('#'+modelName+'_mul_state_id').val();	 
	var  cityAjaxUrl = cityBaseUrl+'/country_id/'+countryVal+'city_id/'+cityVal;
	var cityInput;
	function cityData(){
			
		    $("#"+cityInput).select2({
			    multiple: true,
			  ajax: {
		url: function () {

									return changeAllNameRelated();
								},
				
			  dataType: 'json',
			  delay: 250,
			  data: function (params) {
			  return {
				q: params.term, // search term
				page: params.page
			  };
			},
			processResults: function (data, params) {
			  // parse the results into the format expected by Select2
			  // since we are using custom formatting functions we do not need to
			  // alter the remote JSON data, except to indicate that infinite
			  // scrolling can be used
			  params.page = params.page || 1;
			  return {
				results: data.items,
				pagination: {
				  more: (params.page * 30) < data.total_count
				}
			  };
			},
			cache: true
		  },
		  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		  minimumInputLength: 0,
		  //templateResult: formatRepo, // omitted for brevity, see the source of this page
		  //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
		});
	}
	$(function(){
		 $('#'+modelName+'_mul_country_id').select2();
		 $('#'+modelName+'_service_offerng').select2();
		 $('#'+modelName+'_service_offerng_detail').select2();
		 $('#'+modelName+'_mul_country_id').select2();
		 $('#'+modelName+'_languages_known').select2();
		 $('#'+modelName+'_country_id').select2();
		 $('#'+modelName+'_designation_id').select2();
		 $('#'+modelName+'_state_id').select2();
		 $('#'+modelName+'_mul_state_id').select2();
	 	 
		 
	})
	function loadCities(k){
			var Cit = $('#'+modelName+'_mul_state_id').val() ;
			cityAjaxUrl = cityBaseUrl+'/country_id/'+$(k).val()+'/city_id/'+Cit;
			
		}
function changeAllNameRelated(){
	 
	return  cityAjaxUrl;
}
	</script>
