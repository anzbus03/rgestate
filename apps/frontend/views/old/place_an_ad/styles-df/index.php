<div class="main-content">
  <div class="properties"  style="top:0;">
    <div class="container">
      <div class="grid_full_width gird_sidebar">
        <div class="row">
         <!-- Main content -->
         <div class="span8" style="margin:auto;float:none;">
			 <h3 style="text-align:left; padding:20px 0px;">List Your Property</h3>
			<?php
			if(Yii::app()->user->hasFlash('success'))
			{
			?>
			<div class="alert-box Bsuccess"><span>success: </span><?php echo Yii::app()->user->getFlash('success');?> </div>
			<?php
			}
			?>
			<?php
			if(Yii::app()->user->hasFlash('error'))
			{
			?>
			<div class="alert-box Berror"><span>error: </span><?php echo Yii::app()->user->getFlash('error');?></div>
			<?php
			}
			?>
			<div class="form-style-10">
			 
			<?php
				$form = $this->beginWidget('CActiveForm', array(
				 
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
				'validateOnSubmit'=>true,
				),
				));
				?>
			
			<div class="section"><span>1</span>Title and Description</div>
			<div class="inner-wrap">
				<?php echo $form->labelEx($model, 'ad_title');?>
				<?php echo $form->textField($model, 'ad_title',$model->getHtmlOptions('ad_title')); ?>
				<?php echo $form->error($model, 'ad_title');?>
				
				<?php echo $form->labelEx($model, 'ad_description');?>
				<?php echo $form->textArea($model, 'ad_description',$model->getHtmlOptions('ad_description')); ?>
				<?php echo $form->error($model, 'ad_description');?>
			</div>
<style>
.percent50
{
	width:49%;float:left;
 
}

.fltright{
	 float:right
} 
.clear
{
	clear:both;
}
</style>
			<div class="section"><span>2</span>Property Details</div>
			<div class="inner-wrap">
				<div class="percent50">
					<?php echo $form->labelEx($model, 'section_id');?>
					<?php $mer =  array_merge($model->getHtmlOptions('section_id'),array('empty'=>"Select","class"=>"","onChange"=>"getCategory(this)")); ?>
					<?php echo $form->dropDownList($model, 'section_id', CHtml::listData(Section::model()->listData(),'section_id','section_name') , $mer ); ?>
					<?php echo $form->error($model, 'section_id');?>
				</div>	
				<div class="percent50 fltright">	
					<?php echo $form->labelEx($model, 'category_id');?>
					<?php $mer =  array_merge($model->getHtmlOptions('category_id'),array('empty'=>"Select","class"=>"","onChange"=>"getSubCategory(this)")); ?>
					<?php echo $form->dropDownList($model, 'category_id',  array() , $mer ); ?>
					<?php echo $form->error($model, 'category_id');?>
				</div>	
				<div class="clear"></div>
					<?php echo $form->labelEx($model, 'sub_category_id');?>
					<?php $mer =  array_merge($model->getHtmlOptions('sub_category_id'),array('empty'=>"Select","class"=>"")); ?>
					<?php echo $form->dropDownList($model, 'sub_category_id',  array() , $mer ); ?>
					<?php echo $form->error($model, 'sub_category_id');?>
				<div class="percent50">		
					<?php echo $form->labelEx($model, 'country');?>
					<?php $mer =  array_merge($model->getHtmlOptions('country'),array('empty'=>"Select","class"=>"","onChange"=>"getState(this)")); ?>
					<?php echo $form->dropDownList($model, 'country', CHtml::listData(Countries::model()->Countrylist(),'country_id','country_name') , $mer ); ?>
					<?php echo $form->error($model, 'country');?>
				</div>	
				<div class="percent50 fltright">		
					<?php echo $form->labelEx($model, 'state');?>
					<?php $mer =  array_merge($model->getHtmlOptions('state'),array('empty'=>"Select","class"=>"","onChange"=>"getCity(this)")); ?>
					<?php echo $form->dropDownList($model, 'state', array()  , $mer ); ?>
					<?php echo $form->error($model, 'state');?>
				</div>		
				<div class="clear"></div>
				<div class="percent50">	
					<?php echo $form->labelEx($model, 'city');?>
					<?php $mer =  array_merge($model->getHtmlOptions('city'),array('empty'=>"Select","class"=>"","onChange"=>"getDistrict(this)")); ?>
					<?php echo $form->dropDownList($model, 'city', array()  , $mer ); ?>
					<?php echo $form->error($model, 'city');?>
				</div>		
				<div class="percent50 fltright">	
					<?php echo $form->labelEx($model, 'district');?>
					<?php $mer =  array_merge($model->getHtmlOptions('district'),array('empty'=>"Select","class"=>"","onChange"=>"getCommunity(this)")); ?>
					<?php echo $form->dropDownList($model, 'district', array()  , $mer ); ?>
					<?php echo $form->error($model, 'district');?>
				</div>		
				<div class="clear"></div>
					
				<div class="percent50">	
					<?php echo $form->labelEx($model, 'community_id');?>
					<?php $mer =  array_merge($model->getHtmlOptions('community_id'),array('empty'=>"Select","class"=>"","onChange"=>"getSubCommunity(this)")); ?>
					<?php echo $form->dropDownList($model, 'community_id', array()   , $mer ); ?>
					<?php echo $form->error($model, 'community_id');?>
				</div>		
				<div class="percent50 fltright">		
					<?php echo $form->labelEx($model, 'sub_community_id');?>
					<?php $mer =  array_merge($model->getHtmlOptions('sub_community_id'),array('empty'=>"Select","class"=>"","onChange"=>"")); ?>
					<?php echo $form->dropDownList($model, 'sub_community_id', array()  , $mer ); ?>
					<?php echo $form->error($model, 'sub_community_id');?>
				</div>		
				<div class="clear"></div>	
				
				<div class="percent50">	
					<?php echo $form->labelEx($model, 'builtup_area_sqft');?>
					<?php echo $form->textField($model, 'builtup_area',$model->getHtmlOptions('builtup_area')); ?>
					<?php echo $form->error($model, 'builtup_area');?>
				</div>		
				<div class="percent50 fltright">		
					
					<?php echo $form->labelEx($model, 'price');?>
					<?php echo $form->textField($model, 'price',$model->getHtmlOptions('price')); ?>
					<?php echo $form->error($model, 'price');?>
				</div>		
				<div class="clear"></div>	
				<div class="percent50">		
					<?php echo $form->labelEx($model, 'property_name');?>
					<?php echo $form->textField($model, 'property_name',$model->getHtmlOptions('property_name')); ?>
					<?php echo $form->error($model, 'property_name');?>
				</div>		
				<div class="percent50 fltright">		
						
					
					<?php echo $form->labelEx($model, 'PrimaryUnitView');?>
					<?php echo $form->textField($model, 'PrimaryUnitView',$model->getHtmlOptions('PrimaryUnitView')); ?>
					<?php echo $form->error($model, 'PrimaryUnitView');?>
				</div>		
				<div class="clear"></div>	
				<div class="percent50">		
					<?php echo $form->labelEx($model, 'bedrooms');?>
					<?php echo $form->textField($model, 'bedrooms',$model->getHtmlOptions('bedrooms')); ?>
					<?php echo $form->error($model, 'bedrooms');?>
				</div>		
				<div class="percent50 fltright">	
					<?php echo $form->labelEx($model, 'bathrooms');?>
					<?php echo $form->textField($model, 'bathrooms',$model->getHtmlOptions('bathrooms')); ?>
					<?php echo $form->error($model, 'bathrooms');?>
				</div>		
				<div class="clear"></div>	
					
					<?php echo $form->labelEx($model, 'occupant_status');?>
					<?php $mer =  array_merge($model->getHtmlOptions('occupant_status'),array('empty'=>"Select","class"=>"" )); ?>
					<?php echo $form->dropDownList($model, 'occupant_status', array("Blocked"=>"Blocked","Vacant"=>"Vacant")   , $mer ); ?>
					<?php echo $form->error($model, 'occupant_status');?>
					 
			</div>

			<div class="section"><span>3</span>Image Gallery</div>
			<div class="inner-wrap">
			 
			 
			 <?php echo $form->hiddenField($model, 'image', $model->getHtmlOptions('image')); ?>
			 <?php echo $form->error($model, 'image');?>
			 <div class="img_h"  >
										Drag and drop Photos here or click below to select photos from your computer<br />  
										<p style="margin-top:10px;font-size:12px;">
										Photos : <font color="#cc0001">File types allowed </font><b>(jpg, jpeg, gif, png)</b>, <font color="#cc0001">Maximum Width &  Height : </font><b>1024px</b>
									   </p>
									</div> 
									 
									<div id="myId" class="dropzone" title="Click or Drag here to upload photos"></div>
									<script type="text/javascript">
									var myDropzone = new Dropzone("div#myId", { url: "<?php echo $this->createUrl('upload'); ?>",addRemoveLinks: true, maxFilesize: 1024, acceptedMimeTypes: 'image/jpeg,image/gif',}) //according to your forms action
									 myDropzone.on("removedfile", function(file, serverFileName) {
									 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:file.serverId,inp:$("#PlaceAnAd_image").val()},function(data){  $("#PlaceAnAd_image").val(data) ; } );
									});
									myDropzone.on("success", function(file,serverFileName) {
										 file.serverId =serverFileName;
										 var vals  = $("#PlaceAnAd_image").val();
										 vals += ","+serverFileName;
										 $("#PlaceAnAd_image").val(vals) ;
										 
									});
									var imgs = $("#PlaceAnAd_image").val(); 
									function delete_property_image(img, val,k)
									{
										 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:img,inp:val},function(data){  $("#PlaceAnAd_image").val(data) ;imgs = data; } );
										 $(k).parent().parent().remove();
									}
									function delete_property_image2(val,k)
									{
					 
										 $.post("<?php echo $this->createUrl('delete_image'); ?>",{file:val,inp:imgs},function(data){  $("#PlaceAnAd_image").val(data) ;imgs=data; } );
										 $(k).parent().parent().remove();
									}
									</script>
									
									<div class="clearfix"><!-- --></div> 
									 
			  
			 
			</div>
			
			
			
			
			<div class="section"><span>4</span>Locate Your Ad</div>
			<div class="inner-wrap">
			       <?php echo $form->hiddenField($model, 'location_latitude',$model->getHtmlOptions('location_latitude')); ?>
			       <?php echo $form->hiddenField($model, 'location_longitude',$model->getHtmlOptions('location_longitude')); ?>
			       <?php echo $form->error($model, 'location_latitude');?>
			       <?php echo $form->error($model, 'location_longitude');?>
				   <input id="locate-add" autofocus type="text"  onkeyup="codeAddress()" placeholder="Locate your add" class="form-control">
				   <div style="height:600px;width:100%;"   id="map_canvas"></div>
			 </div>
			 
			<div class="section"><span>5</span>Your Details</div>
			<div class="inner-wrap">
				    
			
					<?php echo $form->labelEx($model, 'name');?>
					<?php echo $form->textField($model, 'name',$model->getHtmlOptions('name')); ?>
					<?php echo $form->error($model, 'name');?>
					
					<?php echo $form->labelEx($model, 'email');?>
					<?php echo $form->textField($model, 'email',$model->getHtmlOptions('email')); ?>
					<?php echo $form->error($model, 'email');?>
					
					
					<?php echo $form->labelEx($model, 'mobile_number');?>
					<?php echo $form->textField($model, 'mobile_number',$model->getHtmlOptions('mobile_number')); ?>
					<?php echo $form->error($model, 'mobile_number');?>
			
			</div>
			
			
			
			
			<div class="button-section">
			<input type="submit" name="Submit" value="Submit" class="sbmit" />
			<span class="privacy-policy">
			<input type="checkbox" checked="true" name="field7" onChange="getSubmitDisable(this)"> &nbsp;You agree to our Terms and Policy.
			</span>
			</div>
			
			
			
			 <?php $this->endWidget(); ?>
			</div>
    </div>
  </div>
</div>
</div>
</div>
     
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/frontend/assets/js/yiiactiveform.js';?>"></script>
<link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
<style type="text/css">
.form-style-10{
 
    padding:30px;
    margin:0px auto;
    background: #FFF; 
}
.form-style-10 .inner-wrap{
    padding: 30px;
    background: #F8F8F8;
    border-radius: 6px;
    margin-bottom: 15px;
}
.form-style-10 h1{
    background: #2A88AD;
    padding: 20px 30px 15px 30px;
    margin: -30px -30px 30px -30px;
    border-radius: 10px 10px 0 0;
    -webkit-border-radius: 10px 10px 0 0;
    -moz-border-radius: 10px 10px 0 0;
    color: #fff;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
    font: normal 30px 'Bitter', serif;
    -moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    -webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
    border: 1px solid #257C9E;
}
.form-style-10 h1 > span{
    display: block;
    margin-top: 2px;
    font: 13px Arial, Helvetica, sans-serif;
}
.form-style-10 label{
    display: block;
    font: 13px Arial, Helvetica, sans-serif;
    color: #888;
    margin-bottom: 15px;
}
.form-style-10 input[type="text"],
.form-style-10 input[type="date"],
.form-style-10 input[type="datetime"],
.form-style-10 input[type="email"],
.form-style-10 input[type="number"],
.form-style-10 input[type="search"],
.form-style-10 input[type="time"],
.form-style-10 input[type="url"],
.form-style-10 input[type="password"],
.form-style-10 textarea,
.form-style-10 select {
    display: block;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 100%;
    padding: 8px !important;
    border-radius: 6px;
    -webkit-border-radius:6px;
    -moz-border-radius:6px;
    border: 2px solid #fff;
    box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
    -moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
    -webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
    height:auto !important;
}

.form-style-10 .section{
    font: normal 20px 'Bitter', serif;
    color: #967930 !important;
    margin-bottom: 5px;
}
.form-style-10 .section span {
    background: #967930;
    padding: 5px 10px 5px 10px !important;
    position: absolute;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border: 4px solid #fff;
    font-size: 14px;
    margin-left: -45px;
    color: #fff;
    margin-top: -3px;
}
.form-style-10 input[type="button"],
.form-style-10 input[type="submit"]{
 
    background-color: #967930;
    border: medium none;
    color: #ffffff;
    font-family: "Roboto",sans-serif;
    margin-top: 20px;
    padding: 10px 60px;
    text-transform: uppercase;
    transition: all 0.5s ease 0s;
 
}
.form-style-10 input[type="button"]:hover,
.form-style-10 input[type="submit"]:hover{
 
	background-color: #333333;
 
}
.form-style-10 .privacy-policy{
    float: right;
    width: 250px;
    font: 12px Arial, Helvetica, sans-serif;
    color: #4D4D4D;
    margin-top: 10px;
    text-align: right;
}
span.required
{
	color:#b80007;
}
</style>
<script>
function getCategory(k)
{
	 
		   $('#PlaceAnAd_sub_category_id').find('option').not('option:first').remove();
	       $.get("<?php echo Yii::app()->createUrl('place_an_ad/getCategory');?>/id/"+$(k).val(),function(data){  
		 
			$('#PlaceAnAd_category_id')
			.find('option')
			.remove()
			.end()
			.append(data);

		 
		   })
}
function getSubCategory(k)
{
	 
	       $.get("<?php echo Yii::app()->createUrl('place_an_ad/getSubCategory');?>/id/"+$(k).val(),function(data){  
		 
			$('#PlaceAnAd_sub_category_id')
			.find('option')
			.remove()
			.end()
			.append(data);

		 
		   })
}
function getState(k)
{
	       $('#PlaceAnAd_city').find('option').not('option:first').remove();
	       $('#PlaceAnAd_district').find('option').not('option:first').remove();
	       $.get("<?php echo Yii::app()->createUrl('place_an_ad/getState');?>/id/"+$(k).val(),function(data){  
			$('#PlaceAnAd_state')
			.find('option')
			.remove()
			.end()
			.append(data);
		   })
}
function getCity(k)
{
		   $('#PlaceAnAd_district').find('option').not('option:first').remove();
	       $.get("<?php echo Yii::app()->createUrl('place_an_ad/getCity');?>/id/"+$(k).val(),function(data){  
			$('#PlaceAnAd_city')
			.find('option')
			.remove()
			.end()
			.append(data);
		   })
}
function getDistrict(k)
{
	 
	       $.get("<?php echo Yii::app()->createUrl('place_an_ad/getDistrict');?>/id/"+$(k).val(),function(data){  
			$('#PlaceAnAd_district')
			.find('option')
			.remove()
			.end()
			.append(data);
		   })
}
function getCommunity(k)
{
	
	
	 
	      
	 
	       $.get("<?php echo Yii::app()->createUrl('place_an_ad/getCommunity');?>/id/"+$(k).val(),function(data){  
			$('#PlaceAnAd_community_id')
			.find('option')
			.remove()
			.end()
			.append(data);
		   });
		    $("#locate-add").val($("#PlaceAnAd_district option:selected").text()) ; 
	       codeAddress();
}
function getSubCommunity(k)
{
	 
	       $.get("<?php echo Yii::app()->createUrl('place_an_ad/getSubCommunity');?>/id/"+$(k).val(),function(data){  
			$('#PlaceAnAd_sub_community_id')
			.find('option')
			.remove()
			.end()
			.append(data);
		   })
}

function getSubmitDisable(k)
{
	if($(k).is(":checked"))
	{
		$('.sbmit').removeAttr("disabled",true)
	}
	else
	{
		$('.sbmit').attr("disabled",true)
	}
}
</script>
 <script type="text/javascript">

function sun(lat,lan)
{
	 
$("#PlaceAnAd_location_latitude").val(lat);
$("#PlaceAnAd_location_longitude").val(lan);
$(".btn").removeAttr("disabled",true);
}
</script>
<script>
	 
        
 function codeAddress() {
			$("#PlaceAnAd_location_latitude").val("");
			$("#PlaceAnAd_location_longitude").val("");
			$(".btn").attr("disabled",true);
			var address = document.getElementById("locate-add").value;
			geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			initMap(results[0].geometry.location.lat().toFixed(6),results[0].geometry.location.lng().toFixed(6));
			} else {

			}
			});
			}
 
</script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
			initMap('','');
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/frontend/assets/js/yiiactiveform.js';?>"></script>
