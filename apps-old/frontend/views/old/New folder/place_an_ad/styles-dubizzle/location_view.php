<style>
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-no-suggestion { padding: 2px 5px;}
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: bold; color: #000; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
 </style>
<?php defined('MW_PATH') || exit('No direct script access allowed');?>
 <?php /*
   <nav class="breadcrumbs small">
	 <ul>
		<li><a href="<?php echo Yii::app()->createUrl("");?>">Home</a></li>
		<li><a href="<?php echo Yii::app()->createUrl("user/my_profile");?>">Account</a></li>
		<li class="active"><a href="#">Advertise</a></li>
	 </ul>
 </nav>
 * */
 ?>
 <style>
 #EGMapContainer1{ margin:auto;}
 .jqTransformTextarea{ display:none;}
 </style>
<?php
 
/**
 * This file is part of the MailWizz EMA application.
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

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
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus),'id'=>'top-websites-cr-form_next')); 
        ?>
         <div class="breadcrumbs mar4" >
		<a href="<?php echo Yii::app()->createUrl('');?>/">Home</a> &rsaquo; <a href="<?php echo Yii::app()->createUrl('place_an_ad/create');?>">Place Ad</a>
		</div>
		<div class="clear"></div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                     <h1 id="innerhead">Place Your Ad</h1> 
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
                  <div class="clearfix"><!-- --></div>
                  <?php
                  if($model->id)
                  {
					  $name="Edit";
				  }
				  else
				  {
					   $name="Choose";
				  }
				  ?>
                <ul class="fourStep stepNavigation" style="width:100%;">
					<li  class="done"><a title=""><em>Step 1: Ad Type</em><span>Choose Ad Type</span></a></li>
					<li class="lastDone" ><a title=""><em>Step 2: Details</em><span>Enter Ad details</span></a></li>
					<li class="current"><a title=""><em>Step 3: Location</em><span>Choose Location</span></a></li>
					<li class="lastStep"><a title=""><em>Step 4: Done</em><span>Completed</span></a></li>
	           </ul>
	             <div style="clear:both"></div>
                <div  class="content_place_an_ad">
					
				   <div  class="content_head">Step 3 :<?php echo $name; ?> Location </div>
						   <div style="clear:both"></div>
						    <div class="form-group col-lg-6" style="padding-left:14px !important;" >
										 <div style="clear:both;padding:5px 5px 5px 0px;color:#004A8F;font-weight:bold;font-size:15px;">Enter your location , where the map to point..</div>
										<?php    echo $form->hiddenField($model, 'area_location',array("onchange"=>"codeAddress()"));  ?>
										  <input id="locate-add" autofocus type="text"  onkeyup="codeAddress()" placeholder="Locate your add" class="form-control">
										
										<?php echo $form->error($model, 'area_location');?>
								 
						    </div>
						   
						   <div style="clear:both"></div>
				 
				  <div>
								<?php
								Yii::import('backend.extensions.EGMap.*');
								$gMap = new EGMap();
								$gMap->setWidth('97%');
								$gMap->setHeight(550);
								$gMap->zoom =15;
								$mapTypeControlOptions = array(
								  'position' => EGMapControlPosition::RIGHT_TOP,
								  'style' => EGMap::MAPTYPECONTROL_STYLE_HORIZONTAL_BAR
								);
								 
								$gMap->mapTypeId = EGMap::TYPE_ROADMAP;
								$gMap->mapTypeControlOptions = $mapTypeControlOptions;
								 
								// Preparing InfoWindow with information about our marker.
								$info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Hi! I'm your marker!</div>");
								 
								// Setting up an icon for marker.
								 $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/hotel.png");
								 
								$icon->setSize(32, 37);
								$icon->setAnchor(16, 16.5);
								$icon->setOrigin(0, 0);
								if((int) $model->state>0)
								{
								 
								$lat = @$model->stateLocation->location_latitude;
								$long =@$model->stateLocation->location_longitude; 
								 
								}
								else
								{
								$lat = @$model->country0->location_latitude;
								$long =@$model->country0->location_longitude; 
								 
								}
							 
								// Saving coordinates after model dragged our marker.
								$dragevent = new EGMapEvent('dragend', "function (event) {sun(event.latLng.lat(),event.latLng.lng()); ; }", false, EGMapEvent::TYPE_EVENT_DEFAULT);
							   
							    if ($model->location_latitude!="" and $model->location_longitude!="") {
								
								 
									$marker = new EGMapMarker($model->location_latitude, $model->location_longitude, array('title' => Yii::t('hotel', ""),
									'icon'=>$icon, 'draggable'=>true), 'marker', array('dragevent'=>$dragevent));
								   $marker->addHtmlInfoWindow($info_window_a);
								   $gMap->addMarker($marker);
								   $gMap->setCenter($model->location_latitude,$model->location_longitude);
								   $gMap->zoom = 15;
								} else {
								 
			                  $adress =  $this->Get_LatLng_From_Google_Maps(@$model->stateLocation->state_name.','.$model->area_location); 
							  if($adress)
							  {
								  
								  $lat= $adress['lat'];
								  $long= $adress['lng'];
							  }
							  
							 $gMap->setCenter($lat, $long);
				
								$gMap->addEvent(new EGMapEvent('click',
									'function (event) {var marker = new google.maps.Marker({position: event.latLng, map: '.$gMap->getJsName().
									', draggable: true, icon: '.$icon->toJs().'}); '.$gMap->getJsName().
									'.setCenter(event.latLng); var dragevent = '.$dragevent->toJs('marker').
									';sun(event.latLng.lat(),event.latLng.lng()); }', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));
						}
							  
						$gMap->renderMap(array(), Yii::app()->language);
					   ?>
                 
				 </div>
                <div class="clearfix"><!-- --></div>
                
                     <?php echo $form->hiddenField($model, 'ad_title', $model->getHtmlOptions('ad_title')); ?>
                     <?php echo $form->textArea($model, 'ad_description', array_merge($model->getHtmlOptions('ad_description'),array("style"=>"display:none"))); ?>
                     <?php 
                      foreach($fields as $k=>$v)
                      {
						  echo  $form->hiddenField($model,$k); 
					  }
                         
                      echo $form->hiddenField($model,'sub_category_id'); 
                      echo $form->hiddenField($model,'country'); 
                      echo $form->hiddenField($model,'mobile_number'); 
                      echo $form->hiddenField($model,'state'); 
                      
                      echo $form->hiddenField($model,'user_id'); 
                      $image = "";
                      if(!empty($image_array) )
                      {
						foreach($image_array as $k=>$v)
						{
							$image .= ",".$v;
						 
						 
						}
				     } 
					 
					$model->image = $image;
			   
			       echo $form->hiddenField($model, 'image'); ?>
			       <?php
			       
                   echo $form->hiddenField($model, 'location_latitude');
                   echo $form->hiddenField($model, 'location_longitude');
                   
				         $amenities_array=	 CHtml::listData(Amenities::model()->ListDataWithAmenities($subcategory->category_id),'amenities_id','amenities_name');
					     $amenties=   CHtml::listData($subcategory->relatedAmenities,'amenities_id','amenities_id');
					     $amenitiesArray =  array();
					     if($amenties)
					     {
							 foreach($amenties as $k)
							 {
								 $amenitiesArray[$k] = @$amenities_array[$k];
							 }
						 }
						 ?>
						 <div style="display:none">
							 <?php
						echo CHtml::checkBoxList('amenities',$model->amenities ,$amenitiesArray);                                              
						?></div>
					 
              
                    <button type="submit" <?php if(!$model->id) { echo "disabled"; } ?>  class="btn btn-primary btn-submit next2 btn_my"  style="margin-right:16px;"data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php if(!$model->id){ echo   Yii::t('app', 'Publish my Ad');  }else { echo Yii::t('app', 'Edit my Ad');} ?></button>
                <div style="clear:both;margin-bottom:10px;"></div>
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
 <script type="text/javascript">

function sun(lat,lan)
{
	 
$("#PlaceAnAd_location_latitude").val(lat);
$("#PlaceAnAd_location_longitude").val(lan);
$(".btn").removeAttr("disabled",true);
}
</script>
</div>
</div>
</div>
</div>
</div>
 <script>
	 
        
 function codeAddress() {
			var address = document.getElementById("locate-add").value;
			geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			var mapOptions = {center:new google.maps.LatLng(25.3995, 55.4796),
			zoom:15,
			mapTypeId:google.maps.MapTypeId.ROADMAP,
			mapTypeControlOptions:{position:google.maps.ControlPosition.RIGHT_TOP,
			style:google.maps.MapTypeControlStyle.HORIZONTAL_BAR}};
			EGMap0 = new google.maps.Map(document.getElementById("EGMapContainer1"), mapOptions);
			EGMap0.setCenter(results[0].geometry.location);
			var latlong = "(" + results[0].geometry.location.lat().toFixed(6) + " , " +
			+ results[0].geometry.location.lng().toFixed(6) + ")";
			google.maps.event.addListenerOnce(EGMap0, "click", function (event) {var marker = new google.maps.Marker({position: event.latLng, map: EGMap0, draggable: true, icon: new google.maps.MarkerImage("http://google-maps-icons.googlecode.com/files/hotel.png", new google.maps.Size(32,37), new google.maps.Point(0,0), new google.maps.Point(16,16.5))}); EGMap0.setCenter(event.latLng); var dragevent = google.maps.event.addListener(marker, "dragend", function (event) {sun(event.latLng.lat(),event.latLng.lng()); ; });
			;sun(event.latLng.lat(),event.latLng.lng()); });
			EGMap0.setZoom(15);

			} else {

			}
			});
			}
 
</script>
<script type="text/javascript">
$(function() {
	$.noConflict();
    //find all form with class jqtransform and apply the plugin
    $("input").attr("size","41");
    
    $("#top-websites-cr-form_next").jqTransform();
});
</script>
 <script>
 $(function(){
		 
 var countries =  <?php echo $jsonData;?>;
 
        $('#locate-add').autocomplete({
         
        lookup: countries,
        lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
            var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
            return re.test(suggestion.value);
        },
        onSelect: function(suggestion) {
           // $('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
     
					  
						geocoder = new google.maps.Geocoder();
						var mapOptions = {center:new google.maps.LatLng(25.3995, 55.4796),
						zoom:15,
						mapTypeId:google.maps.MapTypeId.ROADMAP,
						mapTypeControlOptions:{position:google.maps.ControlPosition.RIGHT_TOP,
						style:google.maps.MapTypeControlStyle.HORIZONTAL_BAR}};
						EGMap0 = new google.maps.Map(document.getElementById("EGMapContainer1"), mapOptions);
						var latlong = "(" + suggestion.latitude + " , " +
						+ suggestion.longitude + ")";
						//EGMap0.setCenter(latlong);
						google.maps.event.addListenerOnce(EGMap0, "click", function (event) {     var marker = new google.maps.Marker({position: event.latLng, map: EGMap0, draggable: true, icon: new google.maps.MarkerImage("http://google-maps-icons.googlecode.com/files/hotel.png", new google.maps.Size(32,37), new google.maps.Point(0,0), new google.maps.Point(16,16.5))}); EGMap0.setCenter(event.latLng); var dragevent = google.maps.event.addListener(marker, "dragend", function (event) {sun(suggestion.latitude,suggestion.longitude  ); ; });
						;sun(suggestion.latitude,suggestion.longitude ); });
						EGMap0.setZoom(15);
					
					
           
				},
        
			});

        });
</script>
