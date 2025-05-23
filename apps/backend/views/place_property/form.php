<?php defined('MW_PATH') || exit('No direct script access allowed');

$hooks->doAction('before_view_file_content', $viewCollection = new CAttributeCollection(array(
    'controller'    => $this,
    'renderContent' => true,
)));

if ($viewCollection->renderContent) {
  
    $hooks->doAction('before_active_form', $collection = new CAttributeCollection(array(
        'controller'    => $this,
        'renderForm'    => true,
    )));
    
    // and render if allowed
    if ($collection->renderForm) {
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus))); 
        ?>
		
		<style>
			.jqx-combobox-content { 
				text-indent:4px;
			}
			.select2 {
				width: 100% !important;
			}

			.subhead {
				background-color: #008000;
				border-radius: 3px;
				clear: both;
				color: #ffffff;
				float: left;
				margin-bottom: 7px;
				margin-top: 25px;
				padding: 7px 0;
				text-indent: 9px;
				text-transform: uppercase;
				width: calc(100% - 15px);
			}

			.dropzone {
				min-height: 160px;
				background: #fafafa;
			}
		</style>

        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
                </div>
            </div>
            <div class="card-body">
                <?php 
                $hooks->doAction('before_active_form_fields', new CAttributeCollection(array(
                    'controller'    => $this,
                    'form'          => $form    
                )));
                ?>
                
          		<?php
           
					if((int) $model->state>0){
						$lat = @$model->stateLocation->location_latitude;
						$long =@$model->stateLocation->location_longitude; 
					}else {
						$lat = @$model->country0->location_latitude;
						$long =@$model->country0->location_longitude; 	
					}
					
					if ($model->location_latitude!="" and $model->location_longitude!="") {
						$lat  =  $model->location_latitude;
						$long =  $model->location_longitude;		
					} 
					$model->country  = '66099' ; 
				?>
				
				<div class="subhead font_s ros subhead2">Property Type and Location</div>
                <div class="form-group col-lg-4 hidden">
                   <?php echo $form->labelEx($model, 'country');?>
                    <?php echo $form->dropDownList($model, 'country',Countries::model()->ListData(), $model->getHtmlOptions('country',array('empty'=>'Select Country','class'=>'form-control select2','data-url'=>Yii::App()->createUrl($this->id.'/select_city_new'),'onchange'=>'load_via_ajax(this,"state")'))); ?>
                    <?php echo $form->error($model, 'country');?>
                </div>  
               
                <?php  
					$cities =  CHtml::listData(States::model()->AllListingStatesOfCountry((int) $model->country) ,'state_id' , 'state_name') ;
                    $m_class = empty( $cities ) ? 'hidden' : '' ; 
				?>
                <div class="form-group col-lg-4 <?php echo $m_class;?>">
					<?php echo $form->labelEx($model, 'state');?>
                    <?php echo $form->dropDownList($model, 'state', $cities  , $model->getHtmlOptions('state',array('empty'=>'Select City','class'=>'form-control select2 ' ,'data-url'=>Yii::App()->createUrl($this->id.'/select_location'),'onchange'=>'load_via_ajax(this,"city")'))); ?>
                    <?php echo $form->error($model, 'state');?>
                </div>  
     
				<?php  
					$locationlist =   CHtml::listData(City::model()->FindCities((int) $model->state) ,'city_id' , 'city_name') ;
                    $m_class = empty(  $locationlist ) ? 'hidden' : '' ; 
				?>
                <div class="form-group col-lg-4 <?php echo $m_class;?>">    
                    <?php echo $form->labelEx($model, 'city');?>
                    <?php echo $form->dropDownList($model, 'city', $locationlist, $model->getHtmlOptions('state',array('empty'=>'Select Location','class'=>'form-control select2','onchange'=>'changeMap()'))); ?>
                    <?php echo $form->error($model, 'city');?>
                </div>  
                
				<?php $this->renderPartial('_location',compact('form'));?> 
				<div class="form-group col-lg-3">
					<?php echo $form->labelEx($model, 'section_id'); ?>
					<?php echo $form->dropDownList($model, 'section_id', $section, $model->getHtmlOptions('section_id', [
						'empty' => 'Select Section',
						'class' => 'form-control select2',
						'onchange' => 'openFields(this)'
					])); ?>
					<?php echo $form->error($model, 'section_id'); ?>
				</div>  

				<div class="form-group col-lg-3 w_for <?php echo ($model->section_id == '4') ? '' : 'hide'; ?>">
					<?php echo CHtml::activeLabel($model, 'w_for', ['required' => true]); ?>
					<?php echo $form->dropDownList($model, 'w_for', $model->wanted_for(), $model->getHtmlOptions('w_for', [
						'empty' => 'Select Type',
						'class' => 'form-control select2'
					])); ?>
					<?php echo $form->error($model, 'w_for'); ?>
				</div>  

				<div class="form-group col-lg-3">
					<?php echo $form->labelEx($model, 'listing_type'); ?>
					<?php echo $form->dropDownList($model, 'listing_type', $list_type, $model->getHtmlOptions('listing_type', [
						'empty' => 'Select Type',
						'class' => 'form-control select2',
						'data-url' => Yii::App()->createUrl($this->id . '/select_category2'),
						'onchange' => 'load_via_ajax(this,"category_id")'
					])); ?>
					<?php echo $form->error($model, 'listing_type'); ?>
				</div>  

				<?php  
				$catlist = Category::model()->ListDataForJSON_ID_BySEctionNew($model->listing_type);
				$m_class = empty($catlist) ? 'hidden' : ''; 
				?>
				<div class="form-group col-lg-3 <?php echo $m_class; ?>">
					<?php echo $form->labelEx($model, 'category_id'); ?>
					<?php echo $form->dropDownList($model, 'category_id', $catlist, $model->getHtmlOptions('category_id', [
						'empty' => 'Select Category',
						'class' => 'form-control select2',
						'data-url' => Yii::App()->createUrl($this->id . '/Select_sub_category2'),
						'onchange' => 'load_via_ajax(this,"sub_category_id")'
					])); ?>
					<?php echo $form->error($model, 'category_id'); ?>
				</div>  

				<?php  
				$scatlist = Subcategory::model()->ListDataForJSON_IDNew((int) $model->category_id);
				$m_class = empty($scatlist) ? 'hidden' : ''; 
				?>
				<div class="form-group col-lg-3 <?php echo $m_class; ?>">
					<?php echo $form->labelEx($model, 'sub_category_id'); ?>
					<?php echo $form->dropDownList($model, 'sub_category_id', $scatlist, $model->getHtmlOptions('sub_category_id', [
						'empty' => 'Select Subcategory',
						'class' => 'form-control select2'
					])); ?>
					<?php echo $form->error($model, 'sub_category_id'); ?>
				</div>  

				<div class="subhead font_s ros subhead2">Property Details</div>

				<div class="form-group col-lg-12">
					<?php echo $form->labelEx($model, 'ad_title'); ?>
					<?php echo $form->textField($model, 'ad_title', $model->getHtmlOptions('ad_title')); ?>
					<?php echo $form->error($model, 'ad_title'); ?>
				</div>      
				<div class="form-group col-lg-12">
					<?php echo $form->labelEx($model, 'ad_description'); ?>
					<?php echo $form->textArea($model, 'ad_description', array_merge(
						$model->getHtmlOptions('ad_description'), 
						["rows" => "5", "style" => "max-height: 150px; overflow-y: auto; resize: vertical;"]
					)); ?>
					<?php echo $form->error($model, 'ad_description'); ?>
				</div>

				<div class="form-group col-lg-4">
					<?php echo $form->labelEx($model, 'price'); ?><label>[<?php echo $model->currencyTitle; ?>]</label>
					<?php echo $form->textField($model, 'price', $model->getHtmlOptions('price')); ?>
					<?php echo $form->error($model, 'price'); ?>
				</div>

				<div class="form-group col-lg-4 rent_paid <?php echo $model->section_id == $model::RENT_ID ? '' : 'hidden'; ?>">
					<?php echo $form->labelEx($model, 'rent_paid'); ?>
					<?php echo $form->dropDownList($model, 'rent_paid', ["monthly" => "Monthly", "yearly" => "Yearly"], $model->getHtmlOptions('rent_paid', [
						'empty' => 'Select Option',
						'class' => 'form-control select2'
					])); ?>
					<?php echo $form->error($model, 'rent_paid'); ?>
				</div>

				<?php if ($model->checkFieldsShow2('builtup_area')) { ?> 
				<div class="form-group col-lg-4">
					<?php echo $form->labelEx($model, 'builtup_area'); ?>
					<?php echo $form->textField($model, 'builtup_area', $model->getHtmlOptions('builtup_area')); ?>
					<?php echo $form->error($model, 'builtup_area'); ?>
				</div> 
				<?php } ?> 

				<?php if ($model->checkFieldsShow2('bathrooms')) { ?>
				<div class="form-group col-lg-4">
					<?php echo $form->labelEx($model, 'bathrooms'); ?>
					<?php echo $form->dropDownList($model, 'bathrooms', $model->bathrooms(), array_merge($model->getHtmlOptions('bathrooms'), [
						'empty' => "Select bathrooms",
						'class' => 'form-control select2'
					])); ?>
					<?php echo $form->error($model, 'bathrooms'); ?>
				</div>  
				<?php } ?>

				<?php if ($model->checkFieldsShow2('bedrooms')) { ?> 
				<div class="form-group col-lg-4">
					<?php echo $form->labelEx($model, 'bedrooms'); ?>
					<?php echo $form->dropDownList($model, 'bedrooms', $model->bedrooms(), array_merge($model->getHtmlOptions('bedrooms'), [
						'empty' => "Select bedrooms",
						'class' => 'form-control select2'
					])); ?>
					<?php echo $form->error($model, 'bedrooms'); ?>
				</div> 
				<?php } ?>

				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">More Details</h4>
							</div>
							<div class="modal-body">
								<?php $this->renderPartial('_property_details', compact('form')); ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
					Add More Details / Features
				</button>

				<?php $this->renderPartial('_image_upload', compact('form')); ?>

				<div class="subhead font_s ros subhead_img">Contact Details</div>

				<div class="form-group col-lg-6">
					<?php echo $form->labelEx($model, 'mobile_number'); ?>
					<?php echo $form->textField($model, 'mobile_number', $model->getHtmlOptions('mobile_number')); ?>
					<?php echo $form->error($model, 'mobile_number'); ?>
				</div> 

				<div class="form-group col-lg-6">
					<?php echo $form->labelEx($model, 'user_id'); ?>
					<?php echo $form->dropDownList($model, 'user_id', CHtml::listData(User::model()->findAll(), 'user_id', 'fullName'), array_merge($model->getHtmlOptions('user_id'), [
						'empty' => "Select Customer",
						'class' => "form-control"
					])); ?>
					<?php echo $form->error($model, 'user_id'); ?>
				</div>

            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <button type="submit"  class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php echo Yii::t('app', 'Submit');?></button>
                </div>
            </div>
        </div>
        <?php 
        $this->endWidget(); 
    }
   
    $hooks->doAction('after_active_form', new CAttributeCollection(array(
        'controller'      => $this,
        'renderedForm'    => $collection->renderForm,
    )));
}
$hooks->doAction('after_view_file_content', new CAttributeCollection(array(
    'controller'        => $this,
    'renderedContent'   => $viewCollection->renderContent,
)));
?>
<script
                        src="<?php echo Yii::app()->apps->getBaseUrl('assets_backend/vendor/global/global.min.js'); ?>"
                        type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo  Yii::app()->options->get('system.common.google_map_api_keys','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ');?>"></script>

<script type="text/javascript">
	
	function changeMap(){
	 
		var location_text ='';
		if($('#'+modelName+'_state').val() != ''){
			location_text +=  $('#'+modelName+'_state option:selected').text();
		}
		if($('#'+modelName+'_city').val() != ''){
			location_text +=   ',';
			location_text +=  $('#'+modelName+'_city option:selected').text();
		}
		if(location_text !=''){
			codeAddressInitial(location_text);
		}
	}


	var modelName = '<?php echo $model->modelName;?>'
	function load_via_ajax(k,id){
		var url_load = $(k).attr('data-url') 
		if(url_load !== undefined){
			url_load += '/id/'+$(k).val(); 
		
			$('#'+modelName+'_'+id).val('');
			$('#'+modelName+'_'+id).html('<option value="">Loading...</option>').select2();
			var attr_id = $(k).attr('id');
			if(attr_id== '<?php echo $model->modelName;?>_state'){
				changeMap()
			}
			$.get(url_load,function(data){ var data = JSON.parse(data) ;   $('#'+modelName+'_'+id).html(data.data).select2(); if(data.size != '0') {    $('#'+modelName+'_'+id).closest('.form-group').removeClass('hidden') }else{  $('#'+modelName+'_'+id).closest('.form-group').addClass('hidden') }  })
		}
	}
 

	function sun(lat,lan){	
		$("#<?php echo $model->modelName;?>_location_latitude").val(lat);
		$("#<?php echo $model->modelName;?>_location_longitude").val(lan);
		$(".btn").removeAttr("disabled",true);
	}
	 
	function codeAddress() {
		$("#<?php echo $model->modelName;?>_location_latitude").val("");
		$("#<?php echo $model->modelName;?>_location_longitude").val("");
		$(".btn").attr("disabled", true);

		var address = document.getElementById("locate-add").value;
		var geocoder = new google.maps.Geocoder();

		geocoder.geocode({ 'address': address }, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				initMap(
					results[0].geometry.location.lat().toFixed(6),
					results[0].geometry.location.lng().toFixed(6)
				);
			}
		});
	}

	function codeAddressInitial(address) {
		var geocoder = new google.maps.Geocoder();

		if (geocoder) {
			geocoder.geocode({ 'address': address }, function(results, status) {
				if (status === google.maps.GeocoderStatus.OK) {
					initMap(
						results[0].geometry.location.lat().toFixed(6),
						results[0].geometry.location.lng().toFixed(6)
					);
				}
			});
		}
	}

	$(function(){
		$('.select2').select2(); 
		$('#locate-add').autocomplete({
			
		
			lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
				var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
				return re.test(suggestion.value);
			},
			onSelect: function(suggestion) {

				$("#<?php echo $model->modelName;?>_location_latitude").val("");
				$("#<?php echo $model->modelName;?>_location_longitude").val("");
				$(".btn").attr("disabled",true);

					
				initMap(suggestion.latitude,suggestion.longitude);           
			},
		});
	});
	
	<?php
	if ($model->location_latitude!="" and $model->location_longitude!="") {
		?>
			initMap('<?php echo $model->location_latitude; ?>','<?php echo $model->location_longitude; ?>');
			var latlng = new google.maps.LatLng('<?php echo $model->location_latitude; ?>','<?php echo $model->location_longitude; ?>');
			placeMarker(latlng);
			//geocode('<?php echo @$model->stateLocation->state_name;?>','<?php echo $model->area_location; ?>');
		<?php
		
	}else{
		if(!empty($model->city)){
			?>
				zoomIndex = 15;
				codeAddressInitial('<?php echo @$model->city0->city_name.','.@$model->stateLocation->state_name;?>');;
			<?php
		}else {
			?>
				codeAddressInitial('lahore,pakistan');;
			<?php
		}
	}  
	?>

	function openFields(k){
		var idSwitch = $(k).attr('id');
		switch(idSwitch){
			case '<?php echo $model->modelName;?>_section_id':
			if($(k).val()=='2'){
				$('.rent_paid').removeClass('hidden');
			}
			else{
				$('.rent_paid').addClass('hidden');
			}
			if($(k).val()=='4'){
				$('.w_for').removeClass('hide');
			}
			else{
				$('.w_for').addClass('hide');
			}
			
			break;
		}
	}

	var customer_url = '<?php echo Yii::app()->createUrl('place_an_ad/Customer' );?>';
	$(function(){
		$("#"+modelName+"_user_id").select2({
			placeholder: 'Select User',
			allowClear: true,
			ajax: {
				url:  customer_url ,
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term,
						page: params.page
					};
				},
				processResults: function (data, params) {
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
			escapeMarkup: function (markup) { return markup; },
			minimumInputLength: 0,
		}) ;

	});
</script>

