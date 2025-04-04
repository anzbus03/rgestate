 <style>
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-no-suggestion { padding: 2px 5px;}
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: bold; color: #000; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
 </style>
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
         <style>
 #EGMapContainer1{ margin:auto;}
 .jqTransformTextarea{ display:none;}
 </style>
        <div class="card">
            <div class="card-header""">
                <div class="pull-left">
                    <h3 class="card-title"><span class="glyphicon glyphicon-star"></span> <?php echo $pageHeading;?></h3>
                </div>
             
                <div class="clearfix"><!-- --></div>
            </div>
            <div class="card-body">
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
                <ol class="progtrckr" data-progtrckr-steps="4">
					<li class="progtrckr-done"><?php echo $name; ?> Ad Type</li> 
					<li class="progtrckr-done"><?php echo $name; ?>  Details</li> 
					<li class="progtrckr-done"><?php echo $name; ?>  Location</li>
					<li class="progtrckr-todo">Done</li> 
				</ol>
                <div  class="content_place_an_ad">
					
				   <div  class="content_head">Step 3 :<?php echo $name; ?> Location </div>
						   <div style="clear:both"></div>
						   	   <div style="clear:both"></div>
						    <div class="form-group col-lg-6" style="padding-left:14px !important;" >
										 <div style="clear:both;padding:5px 5px 5px 0px;color:#004A8F;font-weight:bold;font-size:15px;">Enter your location , where the map to point..</div>
										<?php    echo $form->hiddenField($model, 'area_location',array("onchange"=>"codeAddress()",'class'=>'form-control'));  ?>
										 <input id="locate-add" autofocus type="text"   onchange="$('#locate-add').val('')"   placeholder="Locate your add" class="form-control">
										
										<?php echo $form->error($model, 'area_location' );?>
								 
						    </div>
						   <div style="clear:both"></div>
				 
				  <div  style="margin:0px 15px;">
								<?php
							 
							 
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
							   
							    if ($model->location_latitude!="" and $model->location_longitude!="") {
									 $lat  =  $model->location_latitude;
									 $long =  $model->location_longitude;
									 
								}  
					   ?>
					   <div style="height:600px;width:100%;"   id="map_canvas"></div>
                 
				 </div>
                <div class="clearfix"><!-- --></div>
                
                     <?php echo $form->hiddenField($model, 'ad_title', $model->getHtmlOptions('ad_title')); ?>
                     <div style="display:none;">
                     <?php echo $form->textArea($model, 'ad_description', array_merge($model->getHtmlOptions('ad_description'),array("style"=>"display:none"))); ?>
                     </div>
                     <?php 
                     
					 if(!empty($model->dynamicArray) and is_array($model->dynamicArray)){
                      foreach($model->dynamicArray as $k=>$v)
                      {
						  echo  $form->hiddenField($model,$v); 
					  }
					}
                         
                      echo $form->hiddenField($model,'listing_type'); 
                      echo $form->hiddenField($model,'section_id'); 
                      echo $form->hiddenField($model,'category_id'); 
                      echo $form->hiddenField($model,'sub_category_id'); 
                      echo $form->hiddenField($model,'country'); 
                      echo $form->hiddenField($model,'mobile_number'); 
                      echo $form->hiddenField($model,'state'); 
                      echo $form->hiddenField($model,'district'); 
                      echo $form->hiddenField($model,'user_id'); 
                      echo $form->hiddenField($model,'community_id'); 
                      echo $form->hiddenField($model,'sub_community_id'); 
                      echo $form->hiddenField($model,'rent_paid');
                      echo $form->hiddenField($model,'price');
                      echo $form->hiddenField($model,'status');  
                      echo $form->hiddenField($model,'featured');
                      echo $form->textArea($model,'nearest_metro',  $model->getHtmlOptions('nearest_metro' ,array("style"=>"display:none"))); 
                      echo $form->textArea($model,'nearest_railway', $model->getHtmlOptions('nearest_railway' ,array("style"=>"display:none"))); 
                      $image = "";
                      if(!empty($image_array) )
                      {
						foreach($image_array as $k=>$v)
						{
							$image .= ",".$v;
						 
						 
						}
				     } 
					 
					$model->image = $image;
			   
			       echo $form->hiddenField($model, 'image');
			       //echo $form->hiddenField($model, 'floor_plan');
			       
			        ?>
			       <?php
                   echo $form->hiddenField($model, 'location_latitude');
                   echo $form->hiddenField($model, 'location_longitude');
                   
				    
				         $amenities_array=	 CHtml::listData(Amenities::model()->findAll(),'amenities_id','amenities_name');
					     
						 ?>
						 <div style="display:none">
							 <?php
						echo CHtml::checkBoxList('amenities',$model->amenities ,$amenities_array);                                              
						?></div>
					  
				</div>	 
				</div>	 
                <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" <?php if(!$model->id) { echo "disabled"; } ?>  class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php if(!$model->id){ echo   Yii::t('app', 'Go to Next');  }else { echo Yii::t('app', 'Go to Next');} ?></button>
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
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo  Yii::app()->options->get('system.common.google_map_api_keys','AIzaSyBJ2Jo_mnCk9CnTNbTQAcb__elC9cKt6WQ');?>"></script>
 
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
 function codeAddressInitial(adress) {
		 
		 
			var address = adress;
			geocoder = new google.maps.Geocoder();		
			if(geocoder )	{ 
			geocoder.geocode( { 'address': address}, function(results, status) {
			 
			if (status == google.maps.GeocoderStatus.OK) {
			
			initMap(results[0].geometry.location.lat().toFixed(6),results[0].geometry.location.lng().toFixed(6));
			} else {

			}
			});
			}
			}
 
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
     
						$("#PlaceAnAd_location_latitude").val("");
						$("#PlaceAnAd_location_longitude").val("");
						$(".btn").attr("disabled",true);

						//geocoder = new google.maps.Geocoder();
						//var mapOptions = {center:new google.maps.LatLng(25.3995, 55.4796),
						//zoom:15,
						//mapTypeId:google.maps.MapTypeId.ROADMAP,
						//mapTypeControlOptions:{position:google.maps.ControlPosition.RIGHT_TOP,
						////style:google.maps.MapTypeControlStyle.HORIZONTAL_BAR}};
						//EGMap0 = new google.maps.Map(document.getElementById("EGMapContainer1"), mapOptions);
						//var latlong = "(" + suggestion.latitude + " , " +
						//+ suggestion.longitude + ")";
						//EGMap0.setCenter(latlong);
						//google.maps.event.addListenerOnce(EGMap0, "click", function (event) {     var marker = new google.maps.Marker({position: event.latLng, map: EGMap0, draggable: true, icon: new google.maps.MarkerImage("http://google-maps-icons.googlecode.com/files/hotel.png", new google.maps.Size(32,37), new google.maps.Point(0,0), new google.maps.Point(16,16.5))}); EGMap0.setCenter(event.latLng); var dragevent = google.maps.event.addListener(marker, "dragend", function (event) {sun(suggestion.latitude,suggestion.longitude  ); ; });
						//;sun(suggestion.latitude,suggestion.longitude ); });
						//EGMap0.setZoom(15);
						initMap(suggestion.latitude,suggestion.longitude);
					
					
           
				},
        
			});

        });
</script>
<script type="text/javascript">
	      
				
			<?php
			 if ($model->location_latitude!="" and $model->location_longitude!="") {
									  ?>
									   initMap('<?php echo $model->location_latitude; ?>','<?php echo $model->location_longitude; ?>');
										var latlng = new google.maps.LatLng('<?php echo $model->location_latitude; ?>','<?php echo $model->location_longitude; ?>');
										placeMarker(latlng);
										//geocode('<?php echo @$model->stateLocation->state_name;?>','<?php echo $model->area_location; ?>');
									  <?
									 
								}
								else{
									?>
									 
									codeAddressInitial('<?php echo @$model->stateLocation->state_name;?>');;
									<?
								}  
								?>
           // var latlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
           // placeMarker(latlng);
			//geocode('<?php echo @$model->stateLocation->state_name;?>','<?php echo $model->area_location; ?>');
    

</script>

