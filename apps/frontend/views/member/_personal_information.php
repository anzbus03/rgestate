<?php 
$form=$this->beginWidget('CActiveForm', array(
'id'=>'signup-form',
'enableAjaxValidation'=>true,
 
'clientOptions' => array(
'validateOnSubmit'=>true,
'validateOnChange'=>true,
),
'action'=>Yii::app()->createUrl("member/Profile_settings",array('return'=>@$return ))
)); 
  
 ?> 


	  <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-9 div_frst no-padding-left">
						<div class="form-group col-lg-12 float-left">
	<?php echo $form->labelEx($model, 'slug');?> 
	<?php echo $form->textField($model,'slug', $model->getHtmlOptions('slug') ); ?>
	<?php echo $form->error($model, 'slug');?>
	</div>
                <div class="form-group col-lg-6">
							<?php echo $form->labelEx($model, 'first_name');?>
							<?php echo $form->textField($model, 'first_name', $model->getHtmlOptions('first_name')); ?>
							<?php echo $form->error($model, 'first_name');?>
							</div> 
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($model, 'last_name');?>
							<?php echo $form->textField($model, 'last_name', $model->getHtmlOptions('last_name')); ?>
							<?php echo $form->error($model, 'last_name');?>
							</div>
								<div class="clearfix"><!-- --></div>
							<?php 
							if($model->user_type=='D'){ 
							if(empty($model->company_name)){ $model->company_name = $model->fullName;  }
							?>
							<div class="form-group col-lg-12">
							<?php echo $form->labelEx($model, 'company_name');?>
							<?php echo $form->textField($model, 'company_name', $model->getHtmlOptions('company_name')); ?>
							<?php echo $form->error($model, 'company_name');?>
							</div> 
							<?php } ?> 
							<div class="clearfix"><!-- --></div>
							
							
							  <div class="form-group col-lg-6">
                    <?php 
                   
                    echo $form->labelEx($model, 'country_id');?> 
                    <?php $dropdwn =   array_merge( $model->getHtmlOptions('country_id'),array('empty'=>'Select Country ',"style"=>"1",
                       'ajax' =>
                       array('type'=>'GET',
                       'url'=>Yii::app()->createUrl('site/loadStates'), //url to call.
                       'update'=>'#'.$model->modelName.'_state_id', //selector to update
                        'data'=>array('country_id'=>'js:this.value'),
                        'beforeSend' => 'function(){
							$("#'.$model->modelName.'_state_id").val("").change();}',
							'complete' => 'function(){
						    $("#myDiv").removeClass("grid-view-loading");
						   }',
							)
                       )
                       )
                    
                     ;  ?> 
                    <span id="myDiv" style="padding-left:20px;"></span>
                    <?php echo $form->dropDownList($model,'country_id',CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"), $dropdwn  ); ?> 
                    <?php echo $form->error($model, 'country_id');?>
                </div>
             
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'state_id');?> 
                    <?php $dropdwn =   array_merge( $model->getHtmlOptions('state_id'),array('empty'=>'Select Region ',"style"=>"1")) ;  ?> 
                    <?php echo $form->dropDownList($model,'state_id',CHtml::listData(States::model()->getStateWithCountry_2($model->country_id),"state_id" ,"state_name"), $dropdwn  ); ?>
                    <?php echo $form->error($model, 'state_id');?>
                </div>
                   <div class="clearfix"><!-- --></div>
							
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($model, 'city');?>
							<?php echo $form->textField($model, 'city', $model->getHtmlOptions('city')); ?>
							<?php echo $form->error($model, 'city');?>
							</div> 
								<div class="form-group col-lg-6">
							<?php echo $form->labelEx($model, 'address');?>
							<?php echo $form->textField($model, 'address', $model->getHtmlOptions('address')); ?>
							<?php echo $form->error($model, 'address');?>
							</div> 
							  <div class="clearfix"><!-- --></div>
						    
							 
							  <div class="clearfix"><!-- --></div>
						    
							<div class="form-group col-lg-3">
							<?php echo $form->labelEx($model, 'zip');?>
							<?php echo $form->textField($model, 'zip', $model->getHtmlOptions('zip')); ?>
							<?php echo $form->error($model, 'zip');?>
							</div> 
							<div class="form-group col-lg-3">
							 <?php echo $form->labelEx($model, 'phone');?>
							<?php echo $form->textField($model, 'phone', $model->getHtmlOptions('phone')); ?>
							<?php echo $form->error($model, 'phone');?>
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
							<?php
							if($model->user_type=='D'){ ?>
								
								<div class="form-group col-lg-3">
								<?php echo $form->labelEx($model, 'contact_person');?>
								<?php echo $form->textField($model, 'contact_person', $model->getHtmlOptions('contact_person')); ?>
								<?php echo $form->error($model, 'contact_person');?>
								</div> 
								<div class="form-group col-lg-3">
								<?php echo $form->labelEx($model, 'contact_email');?>
								<?php echo $form->textField($model, 'contact_email', $model->getHtmlOptions('contact_email')); ?>
								<?php echo $form->error($model, 'contact_email');?>
								</div> 
								
							 <?php } ?> 
							 <div class="clearfix"></div>
							   <div class="form-group col-lg-12"><h5>Social Pages</h5></div>
								<div class="form-group col-lg-3">
								<?php echo $form->labelEx($model, 'facebook');?>
								<?php echo $form->textField($model, 'facebook', $model->getHtmlOptions('facebook')); ?>
								<?php echo $form->error($model, 'facebook');?>
								</div> 	<div class="form-group col-lg-3">
								<?php echo $form->labelEx($model, 'twiter');?>
								<?php echo $form->textField($model, 'twiter', $model->getHtmlOptions('twiter')); ?>
								<?php echo $form->error($model, 'twiter');?>
								</div> 	<div class="form-group col-lg-3">
								<?php echo $form->labelEx($model, 'google');?>
								<?php echo $form->textField($model, 'google', $model->getHtmlOptions('google')); ?>
								<?php echo $form->error($model, 'google');?>
								</div> 
								<div class="clearfix"></div>
						 
		</div>	
		 <div class="form-group col-lg-3 div_sec">
			 <?php
			 if(!empty($model->image)){
				 echo '<div id="imgd"><img src="'.$model->agentAvatarUrl.'" style="width:200px;height:200px;" />';
				 echo '<div style="width:200px;text-align:center;margin-top:10px;"><a href="javascript:void(0)" onclick="openUpdator()" >Change</a></div><div class="clearfix"><!-- --></div></div>';
			 }
			 
			 ?>
			 <script>
				 function openUpdator(){
					 $('#imgd').addClass('hidden');
					 $('#avatar_updator').removeClass('hidden');
				 }
			 
			 </script>
			 <?php  
			 if($model->user_type=='D'){
				  $this->renderPartial('_avatar_developer',compact('form'));
			 }
			 else{
			   $this->renderPartial('_avatar',compact('form'));
		     }
			   ?>
		</div>		 				
		<div class="clearfix"><!-- --></div>	
						
						    
						  
						  
						    <div class="clearfix"><!-- --></div>
						    
						  
                 <div class="clearfix"><!-- --></div>  
                  
                	<div class="clearfix"><!-- --></div>  
                	<?php
                	if(Yii::App()->user->user_type=='A'){ ?> 
					<div class="form-group col-lg-12">
					<?php    echo $form->labelEx($model, 'languages_known');?> 
					<?php
					if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
						$model->languages_known = CHtml::listData($model->moreLanguages,'language_id','language_id');
						 
					}
					?>
					<?php echo $form->dropDownList($model, 'languages_known',  Language::getLanguagesArray() , $model->getHtmlOptions('languages_known',array( 'data-placeholder'=>'Choose Languages Known', 'class'=>'select2 form-control' ,'style'=>'width:100%;'		,'multiple'=>true	)			)); ?>
					<?php echo $form->error($model, 'languages_known');?>
					</div>
					<?php } ?> 
                <div class="clearfix"><!-- --></div>  
                  
                	<div class="clearfix"><!-- --></div>  
					<div class="form-group col-lg-12">
					<?php    echo $form->labelEx($model, 'mul_country_id');?> 
					<?php
					if(!$model->isNewRecord and !Yii::app()->request->isPostRequest){
						$model->mul_country_id = CHtml::listData($model->moreCountry,'country_id','country_id');
						$model->mul_state_id = CHtml::listData($model->moreState,'state_id','state_id');
						 
					}
					?>
					<?php echo $form->dropDownList($model, 'mul_country_id', CHtml::listData(Countries::model()->Countrylist2(),'country_id','country_name') , $model->getHtmlOptions('mul_country_id',array( 'data-placeholder'=>'Choose Country', 'class'=>'select2 form-control','onchange'=>'loadCities(this)','style'=>'width:100%;'		,'multiple'=>true	)			)); ?>
					<?php echo $form->error($model, 'mul_country_id');?>
					</div>

					<div class="form-group col-lg-12">
					<?php echo $form->labelEx($model, 'mul_state_id');?> 
					<?php echo $form->dropDownList($model, 'mul_state_id',   CHtml::listData(States::model()->findAllByAttributes(array('state_id'=>$model->mul_state_id)),'state_id','state_name') , $model->getHtmlOptions('mul_state_id',array(  'class'=>'  form-control' ,'style'=>'width:100%;'	,'multiple'=>true		)			)); ?>
					<?php echo $form->error($model, 'mul_state_id');?>
					</div>
					<div class="form-group col-lg-12">
					<?php echo $form->labelEx($model, 'description');?> 
					<?php echo $form->textArea($model, 'description'   , $model->getHtmlOptions('description',array(  'class'=>'  form-control' ,'style'=>'width:100%;'	 ,'rows'=>'7'	)			)); ?>
					<?php echo $form->error($model, 'description');?>
					</div>
					<div class="form-group col-lg-12">
					<?php echo $form->labelEx($model, 'licence_no');?> 
					<?php echo $form->textField($model, 'licence_no'   , $model->getHtmlOptions('licence_no',array(  'class'=>'  form-control' 	)			)); ?>
					<?php echo $form->error($model, 'licence_no');?>
					</div>
					<div class="clearfix"><!-- --></div>
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
		 $('#'+modelName+'_languages_known').select2();
		 $('#'+modelName+'_country_id').select2();
		 $('#'+modelName+'_state_id').select2();
	 	cityData();
		 
	})
	function loadCities(k){
			var Cit = $('#'+modelName+'_mul_state_id').val() ;
			cityAjaxUrl = cityBaseUrl+'/country_id/'+$(k).val()+'/city_id/'+Cit;
			
		}
function changeAllNameRelated(){
	 
	return  cityAjaxUrl;
}
	</script>
