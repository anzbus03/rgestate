<?php defined('MW_PATH') || exit('No direct script access allowed');

 

/**
 * This hook gives a chance to prepend content or to replace the default view content with a custom content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * In case the content is replaced, make sure to set {@CAttributeCollection $collection->renderContent} to false 
 * in order to stop rendering the default content.
 * @since 1.3.3.1
 */
$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

// and render if allowed
if ($viewCollection->renderContent) {
    /**
     * This hook gives a chance to prepend content before the active form or to replace the default active form entirely.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * In case the form is replaced, make sure to set {@CAttributeCollection $collection->renderForm} to false 
     * in order to stop rendering the default content.
     * @since 1.3.3.1
     */
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('enctype'=>'multipart/form-data'),'focus'=>array($user,'hotel_name')
        
        )); 
        ?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$user->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array($this->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array($this->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-body">
                <?php 
                /**
                 * This hook gives a chance to prepend content before the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
                <div class="clearfix"><!-- --></div>
                <div class="form-group col-lg-9">
                <div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'first_name');?>
							<?php echo $form->textField($user, 'first_name', $user->getHtmlOptions('first_name')); ?>
							<?php echo $form->error($user, 'first_name');?>
							</div> 
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'last_name');?>
							<?php echo $form->textField($user, 'last_name', $user->getHtmlOptions('last_name')); ?>
							<?php echo $form->error($user, 'last_name');?>
							</div> 
							<div class="clearfix"><!-- --></div>
								 
							<div class="form-group col-lg-12">
							<?php echo $form->labelEx($user, 'company_name');?>
							<?php echo $form->textField($user, 'company_name', $user->getHtmlOptions('company_name')); ?>
							<?php echo $form->error($user, 'company_name');?>
							</div> 
						  
							<div class="clearfix"><!-- --></div>
							
							  <div class="form-group col-lg-6">
                    <?php 
                   
                    echo $form->labelEx($user, 'country_id');?> 
                    <?php $dropdwn =   array_merge( $user->getHtmlOptions('country_id'),array('empty'=>'Select Country ',"style"=>"1",
                       'ajax' =>
                       array('type'=>'GET',
                       'url'=>Yii::app()->createUrl('city/loadStates'), //url to call.
                       'update'=>'#'.$user->modelName.'_state_id', //selector to update
                        'data'=>array('country_id'=>'js:this.value'),
                        'beforeSend' => 'function(){
							$("#myDiv").addClass("grid-view-loading");}',
							'complete' => 'function(){
						    $("#myDiv").removeClass("grid-view-loading");
						   }',
							)
                       )
                       )
                    
                     ;  ?> 
                    <span id="myDiv" style="padding-left:20px;"></span>
                    <?php echo $form->dropDownList($user,'country_id',CHtml::listData(Countries::model()->Countrylist(),"country_id" ,"country_name"), $dropdwn  ); ?> 
                    <?php echo $form->error($user, 'country_id');?>
                </div>
             
                <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($user, 'state_id');?> 
                    <?php $dropdwn =   array_merge( $user->getHtmlOptions('state_id'),array('empty'=>'Select Region ',"style"=>"1")) ;  ?> 
                    <?php echo $form->dropDownList($user,'state_id',CHtml::listData(States::model()->getStateWithCountry_2($user->country_id),"state_id" ,"state_name"), $dropdwn  ); ?>
                    <?php echo $form->error($user, 'state_id');?>
                </div>
                   <div class="clearfix"><!-- --></div>
							
							<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'city');?>
							<?php echo $form->textField($user, 'city', $user->getHtmlOptions('city')); ?>
							<?php echo $form->error($user, 'city');?>
							</div> 
								<div class="form-group col-lg-6">
							<?php echo $form->labelEx($user, 'address');?>
							<?php echo $form->textField($user, 'address', $user->getHtmlOptions('address')); ?>
							<?php echo $form->error($user, 'address');?>
							</div> 
							  <div class="clearfix"><!-- --></div>
						    
							 
							  <div class="clearfix"><!-- --></div>
						    
							<div class="form-group col-lg-2">
							<?php echo $form->labelEx($user, 'zip');?>
							<?php echo $form->textField($user, 'zip', $user->getHtmlOptions('zip')); ?>
							<?php echo $form->error($user, 'zip');?>
							</div> 
							<div class="form-group col-lg-3">
							 <?php echo $form->labelEx($user, 'phone');?>
							<?php echo $form->textField($user, 'phone', $user->getHtmlOptions('phone')); ?>
							<?php echo $form->error($user, 'phone');?>
							</div> 
							<div class="form-group col-lg-3">
							<?php echo $form->labelEx($user, 'fax');?>
							<?php echo $form->textField($user, 'fax', $user->getHtmlOptions('fax')); ?>
							<?php echo $form->error($user, 'fax');?>
							</div> 
								<div class="form-group col-lg-3">
								<?php echo $form->labelEx($user, 'webstie');?>
								<?php echo $form->textField($user, 'website', $user->getHtmlOptions('webiste')); ?>
								<?php echo $form->error($user, 'website');?>
								</div> 
								<?php
							if($user->user_type=='D'){ ?>
								
								<div class="form-group col-lg-3">
								<?php echo $form->labelEx($user, 'contact_person');?>
								<?php echo $form->textField($user, 'contact_person', $user->getHtmlOptions('contact_person')); ?>
								<?php echo $form->error($user, 'contact_person');?>
								</div> 
								<div class="form-group col-lg-3">
								<?php echo $form->labelEx($user, 'contact_email');?>
								<?php echo $form->textField($user, 'contact_email', $user->getHtmlOptions('contact_email')); ?>
								<?php echo $form->error($user, 'contact_email');?>
								</div> 
								
							 <?php } ?> 
							  <div class="clearfix"></div>
						 
								<div class="clearfix"></div>	
							<div class="form-group col-lg-2">
							<?php echo $form->labelEx($user, 'status');?>
							<?php echo $form->dropDownList($user, 'status', $user->activeArray(), $user->getHtmlOptions('status')); ?>
							<?php echo $form->error($user, 'status');?>
							</div> 
							<div class="form-group col-lg-2 hidden">
							<?php echo $form->labelEx($user, 'featured');?>
							<?php echo $form->dropDownList($user, 'featured', $user->featuredArray(), $user->getHtmlOptions('featured')); ?>
							<?php echo $form->error($user, 'featured');?>
							</div> 
		</div>	
		 <div class="form-group col-lg-3">
			  		<div class="form-group col-lg-6"> 
						<?php echo $form->labelEx($user, 'transparent');?>
						<?php echo $form->fileField($user, 'transparent',$user->getHtmlOptions('transparent')); ?>
						<?php echo $form->error($user, 'transparent');?>
					</div>  

			 <?php    $this->renderPartial('_change_avatar',compact('form'));?>
		</div>		 				
		<div class="clearfix"><!-- --></div>	
						
						    
						  
						  
						    <div class="clearfix"><!-- --></div>
						    
							
							<div class="form-group col-lg-6">
							 <?php echo $form->labelEx($user, 'email');?>
							<?php echo $form->textField($user, 'email', $user->getHtmlOptions('email')); ?>
							<?php echo $form->error($user, 'email');?>
							</div> 
						    
						 
							<div class="form-group col-lg-3">
							<?php echo $form->labelEx($user, 'password');?>
							<?php echo $form->passwordField($user, 'password', $user->getHtmlOptions('password')); ?>
							<?php echo $form->error($user, 'password');?>
							</div> 
							<div class="form-group col-lg-3">
							<?php echo $form->labelEx($user, 'con_password');?>
							<?php echo $form->passwordField($user, 'con_password', $user->getHtmlOptions('con_password')); ?>
							<?php echo $form->error($user, 'con_password');?>
							</div> 
					<div class="clearfix"><!-- --></div> 
					<div class="clearfix"><!-- --></div>
								<h3>Developers Social pages</h3>
								<hr />
								<div class="form-group col-lg-3">
								<?php echo $form->labelEx($user, 'facebook');?>
								<?php echo $form->textField($user, 'facebook', $user->getHtmlOptions('facebook')); ?>
								<?php echo $form->error($user, 'facebook');?>
								</div> 	<div class="form-group col-lg-3">
								<?php echo $form->labelEx($user, 'twiter');?>
								<?php echo $form->textField($user, 'twiter', $user->getHtmlOptions('twiter')); ?>
								<?php echo $form->error($user, 'twiter');?>
								</div> 	<div class="form-group col-lg-3">
								<?php echo $form->labelEx($user, 'google');?>
								<?php echo $form->textField($user, 'google', $user->getHtmlOptions('google')); ?>
								<?php echo $form->error($user, 'google');?>
								</div> 
					<div class="clearfix"><!-- --></div>  
					<h3>Developers Service Location</h3>
								<hr />
					<div class="form-group col-lg-12">
					<?php    echo $form->labelEx($user, 'mul_country_id');?> 
					<?php
					if(!$user->isNewRecord and !Yii::app()->request->isPostRequest){
						$user->mul_country_id = CHtml::listData($user->moreCountry,'country_id','country_id');
						$user->mul_state_id = CHtml::listData($user->moreState,'state_id','state_id');
						 
					}
					?>
					<?php echo $form->dropDownList($user, 'mul_country_id', CHtml::listData(Countries::model()->Countrylist2(),'country_id','country_name') , $user->getHtmlOptions('mul_country_id',array( 'data-placeholder'=>'Choose Country', 'class'=>'select2 form-control','onchange'=>'loadCities(this)','style'=>'width:100%;'		,'multiple'=>true	)			)); ?>
					<?php echo $form->error($user, 'mul_country_id');?>
					</div>

					<div class="form-group col-lg-12">
					<?php echo $form->labelEx($user, 'mul_state_id');?> 
					<?php echo $form->dropDownList($user, 'mul_state_id',   CHtml::listData(States::model()->findAllByAttributes(array('state_id'=>$user->mul_state_id)),'state_id','state_name') , $user->getHtmlOptions('mul_state_id',array(  'class'=>'  form-control' ,'style'=>'width:100%;'	,'multiple'=>true		)			)); ?>
					<?php echo $form->error($user, 'mul_state_id');?>
					</div>
						<div class="clearfix"><!-- --></div>  
					<h3>Other Details</h3>
								<hr />
					<div class="form-group col-lg-12">
					<?php echo $form->labelEx($user, 'description');?> 
					<?php echo $form->textArea($user, 'description'   , $user->getHtmlOptions('description',array(  'class'=>'  form-control' ,'style'=>'width:100%;'	 ,'rows'=>'7'	)			)); ?>
					<?php echo $form->error($user, 'description');?>
					</div>
					<div class="clearfix"><!-- --></div>
                	<div class="form-group col-lg-12">
					<?php echo $form->labelEx($user, 'filled_info');?> 
					<?php echo $form->checkbox($user, 'filled_info'  , $user->getHtmlOptions('filled_info',array(  'class'=>'  form-control' ,'style'=>'width:auto;' ,'unCheckValue'=>'0' ,'value'=>'1'		)			)); ?>
					<?php echo $form->error($user, 'filled_info');?>
					</div>
                <div class="clearfix"><!-- --></div>  
                							<div class="clearfix"><!-- --></div>
                	<div class="form-group col-lg-12">
					<?php echo $form->labelEx($user, 'email_verified');?> 
					<?php echo $form->checkbox($user, 'email_verified'  , $user->getHtmlOptions('email_verified',array(  'class'=>'  form-control' ,'style'=>'width:auto;' ,'unCheckValue'=>'0' ,'value'=>'1'		)			)); ?>
					<?php echo $form->error($user, 'email_verified');?>
					</div>
                <?php 
                /**
                 * This hook gives a chance to append content after the active form fields.
                 * Please note that from inside the action callback you can access all the controller view variables 
                 * via {@CAttributeCollection $collection->controller->data}
                 * @since 1.3.3.1
                 */
                $hooks->doAction('after_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?> 
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Save changes');?></button>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <?php 
        $this->endWidget(); 
    }
    /**
     * This hook gives a chance to append content after the active form.
     * Please note that from inside the action callback you can access all the controller view variables 
     * via {@CAttributeCollection $collection->controller->data}
     * @since 1.3.3.1
     */
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));
}
/**
 * This hook gives a chance to append content after the view file default content.
 * Please note that from inside the action callback you can access all the controller view
 * variables via {@CAttributeCollection $collection->controller->data}
 * @since 1.3.3.1
 */
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
<script>
	 
	var cityBaseUrl  = '<?php echo Yii::app()->createUrl('agents/loadCity');?>';
	var modelName = '<?php echo $user->modelName;?>';

	var countryVal = $('#'+modelName+'_mul_country_id').val();
	var cityInput =  modelName+'_mul_state_id';
	var cityVal = $('#'+modelName+'_mul_state_id').val();	 
	var  cityAjaxUrl = cityBaseUrl+'/country_id/'+countryVal+'city_id/'+cityVal;
	var cityInput;
	var newCropUrl = '<?php echo Yii::app()->createUrl('developers/image_crop');?>'
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

 <div class="modal fade" id="modal_cropper" style="width:90%;margin:auto;" aria-labelledby="modalLabel" role="dialog" tabindex="-1">
      <div class="modal-dialog" role="document" style="width:100%;">
        <div class="modal-content">
          <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="modalLabel">Crop the image</h4>
            
            
            <div class="clearfix"></div>
          </div>
          <div class="modal-body no-padding-left" style="padding-left:10px !important;">
        <form id="cropImage"> 
           
      <div class="  docs-buttons" style="width:110px;float:left">
        <!-- <h3>Toolbar:</h3> -->
		<div class="btn-group">
          <button type="button" class="btn btn-primary fullWidth main" data-method="crop" title="Crop" onclick="SaveCropedImage()">
            Crop & Save
          </button>
         
        </div>

		<div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="crop" title="Crop" onclick="$('#crp_image').cropper('crop')">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$().cropper(&quot;crop&quot;)">
              <span class="fa fa-check"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="clear" title="Clear" onclick="$('#crp_image').cropper('clear')">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$().cropper(&quot;clear&quot;)">
              <span class="fa fa-remove"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In" onclick="$('#crp_image').cropper('zoom', 0.1)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('zoom', 0.1)">
              <span class="fa fa-search-plus"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out"  onclick="$('#crp_image').cropper('zoom', -0.1)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('zoom', -0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" onclick="$(#crp_image).cropper('move', -10, 0)" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$(#crp_image).cropper('move', -10, 0)">
              <span class="fa fa-arrow-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right" onclick="$('#crp_image').cropper('move', 10, 0)">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 10, 0)">
              <span class="fa fa-arrow-right"></span>
            </span>
          </button>
        
        </div>

        <div class="btn-group">
			  <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up"  onclick="$('#crp_image').cropper('move', 0, -10)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 0, -10)">
              <span class="fa fa-arrow-up"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down"  onclick="$('#crp_image').cropper('move', 0, 10)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('move', 0, 10)">
              <span class="fa fa-arrow-down"></span>
            </span>
          </button>
           </div>
        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left"  onclick="$('#crp_image').cropper('rotate', -45)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate', -45)">
              <span class="fa fa-rotate-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right"  onclick="$('#crp_image').cropper('rotate', 45)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate', 45)">
              <span class="fa fa-rotate-right"></span>
            </span>
          </button>
        </div>




        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal"  onclick="$('#crp_image').cropper('scaleX', -1)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('scaleX', -1)">
              <span class="fa fa-arrows-h"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical" onclick="$('#crp_image').cropper('scaleY', -1)" >
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('scaleY', -1)">
              <span class="fa fa-arrows-v"></span>
            </span>
          </button>
        </div>

     
  
 
		<div class="btn-group">
				<button type="button" class="btn btn-primary fullWidth" data-method="moveTo" data-option="0"  onclick="$('#crp_image').cropper('move',0)" >
				<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper.moveTo(0)">
				Move   [0,0]
				</span>
				</button>
	    </div>
	 
		<div class="btn-group">
				<button type="button" class="btn btn-primary fullWidth" data-method="rotateTo" data-option="180"  onclick="$('#crp_image').cropper('rotate',180)" >
				<span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="" data-original-title="$('#crp_image').cropper('rotate',180)">
				Rotate 180°
				</span>
				</button>
	    </div>
        
       
       
       
        
      </div><!-- /.docs-buttons -->

      <div class="col-md-10" style=" width: calc(100% - 120px) ! important;float:left">
              <img id="crp_image" src="" alt="Picture">
            </div>
            
            <div class="clearfix"></div>
            
            </form> 
          </div>
         
        </div>
      </div>
    </div>
