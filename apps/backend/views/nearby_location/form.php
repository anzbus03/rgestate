<?php defined('MW_PATH') || exit('No direct script access allowed');

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
        $form = $this->beginWidget('CActiveForm',array('focus'=>array($model,Yii::app()->controller->focus))); 
        ?>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
                <div class="pull-right">
                    <?php if (!$model->isNewRecord) { ?>
                    <?php echo CHtml::link(Yii::t('app', 'Create new'), array(Yii::app()->controller->id.'/create'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Create new')));?>
                    <?php } ?>
                    <?php echo CHtml::link(Yii::t('app', 'Cancel'), array(Yii::app()->controller->id.'/index'), array('class' => 'btn btn-primary btn-xs', 'title' => Yii::t('app', 'Cancel')));?>
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
                
                 <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'country_id');?> <span id="myDiv" style="padding-left:20px;"></span>
                      <?php $dropdwn =   array_merge( $model->getHtmlOptions('country_id'),array('empty'=>'Select Country ',"style"=>"1", 
                       'ajax' =>
                       array('type'=>'GET',
							'url'=>$this->createUrl('loadState'), //url to call.
							'update'=>'#NearbyLocation_state_id', //selector to update
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
                    <?php echo $form->dropDownList($model, 'country_id', CHtml::listData(Countries::model()->Countrylist(),'country_id','country_name') , $dropdwn ); ?>
                    <?php echo $form->error($model, 'country_name');?>
                </div>      
                 <div class="clearfix"><!-- --></div>  
                 <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'state_id');?>
                   
                    <?php echo $form->dropDownList($model, 'state_id', CHtml::listData(States::model()->getStateList($model->country_id),'state_id','state_name') , array_merge($model->getHtmlOptions('state_id'),array("empty"=>"Select Region","onchange"=>"codeAddress()")) ); ?>
                    <?php echo $form->error($model, 'country_name');?>
                </div>        
                          
                  <div class="clearfix"><!-- --></div>
                    <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'location_name');?>
                    <?php echo $form->textField($model, 'location_name', array_merge($model->getHtmlOptions('location_name'),array("onchange"=>"codeAddress()"))); ?>
                    <?php echo $form->error($model, 'location_name');?>
                </div>
                  <div class="clearfix"><!-- --></div>
                
                
                  <div class="clearfix"><!-- --></div>
                    <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'location_latitude');?>
                    <?php echo $form->textField($model, 'location_latitude', $model->getHtmlOptions('location_latitude')); ?>
                    <?php echo $form->error($model, 'location_latitude');?>
                </div>
                  <div class="clearfix"><!-- --></div>
                    <div class="form-group col-lg-6">
                    <?php echo $form->labelEx($model, 'location_longitude');?>
                    <?php echo $form->textField($model, 'location_longitude', $model->getHtmlOptions('location_longitude')); ?>
                    <?php echo $form->error($model, 'location_longitude');?>
                </div>
                  <div class="clearfix"><!-- --></div>
                
                 <div class="form-group col-lg-6">
					
                    <?php echo $form->labelEx($model, 'location');?>
                     <?php echo $form->error($model, 'location');?>
                    <div class="clearfix"><!-- --></div>
                    
                 
                    
                </div> 
                <div class="clearfix"><!-- --></div>
                <div class="clearfix"><!-- --></div>
               <?php
               Yii::import('backend.extensions.EGMap.*');
				$gMap = new EGMap();
				$gMap->setWidth('100%');
				$gMap->setHeight(550);
				$gMap->zoom = 15;
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
				 
				// Saving coordinates after model dragged our marker.
				$dragevent = new EGMapEvent('dragend', "function (event) {sun(event.latLng.lat(),event.latLng.lng()); ; }", false, EGMapEvent::TYPE_EVENT_DEFAULT);
				 
			// If we have already created marker - show it
			if ($model->location_latitude!="" and $model->location_longitude!="") {
			 
				$marker = new EGMapMarker($model->location_latitude, $model->location_longitude, array('title' => Yii::t('hotel', $model->location_name),
						'icon'=>$icon, 'draggable'=>true,'clickable'=>true), 'marker', array('dragevent'=>$dragevent)); 
				$marker->addHtmlInfoWindow($info_window_a);
				
				 $gMap->addMarker($marker);
			  
				$gMap->setCenter($model->location_latitude,$model->location_longitude);
				$gMap->zoom = 15;
			 
			// If we don't have marker in database - make sure model can create one
			} else {
			 
				 $lat = 25.18;
				 $long = 55.20;
			 
			     $gMap->setCenter($lat, $long);
			    // Setting up new event for model click on map, so marker will be created on place and respectful event added.
			    $gMap->addEvent(new EGMapEvent('click',
					'function (event) {var marker = new google.maps.Marker({position: event.latLng, map: '.$gMap->getJsName().
					', draggable: true, icon: '.$icon->toJs().'}); '.$gMap->getJsName().
					'.setCenter(event.latLng); var dragevent = '.$dragevent->toJs('marker').
					';sun(event.latLng.lat(),event.latLng.lng()); }', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));
		}
		$gMap->renderMap(array(), Yii::app()->language);
					   ?>
                <div class="clearfix"><!-- --></div>
                
                <div class="clearfix"><!-- --></div>     
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
<script type="text/javascript">

function sun(lat,lan)
{
	 
$("#NearbyLocation_location_latitude").val(lat);
$("#NearbyLocation_location_longitude").val(lan);
}
</script>
 
 <script>
	 
        
 function codeAddress() {
	 
    var address = $("#NearbyLocation_state_id :selected").text() + ' , ' + $("#NearbyLocation_location_name").val();
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
        alert("Lat and long cannot be found.");
      }
    });
  }
 
 </script>
