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
				 
				  <div>
								<?php
								Yii::import('backend.extensions.EGMap.*');
								$gMap = new EGMap();
								$gMap->setWidth('100%');
								$gMap->setHeight(550);
								$gMap->zoom =7;
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
								$lat = @$model->stateLocation->location_latitude;
								$long =@$model->stateLocation->location_longitude;
								// Saving coordinates after model dragged our marker.
								$dragevent = new EGMapEvent('dragend', "function (event) {sun(event.latLng.lat(),event.latLng.lng()); ; }", false, EGMapEvent::TYPE_EVENT_DEFAULT);
							   
							    if ($model->location_latitude!="" and $model->location_longitude!="") {
									$marker = new EGMapMarker($model->location_latitude, $model->location_longitude, array('title' => Yii::t('hotel', ""),
									'icon'=>$icon, 'draggable'=>true), 'marker', array('dragevent'=>$dragevent));
								   $marker->addHtmlInfoWindow($info_window_a);
								   $gMap->addMarker($marker);
								   $gMap->setCenter($model->location_latitude,$model->location_longitude);
								   $gMap->zoom = 7;
								} else {
			 
							  
							 $gMap->setCenter($lat, $long,@$model->stateLocation->state_name);
				
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
                      echo $form->hiddenField($model,'city'); 
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
					 
                <div class="box-footer">
                <div class="pull-right">
                    <button type="submit" <?php if(!$model->id) { echo "disabled"; } ?>  class="btn btn-primary btn-submit" data-loading-text="<?php echo Yii::t('app', 'Please wait, processing...');?>"><?php if(!$model->id){ echo   Yii::t('app', 'Publish my Ad');  }else { echo Yii::t('app', 'Edit my Ad');} ?></button>
                </div>
                <div class="clearfix"><!-- --></div>
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
	 
$("#PlaceAnAd_location_latitude").val(lat);
$("#PlaceAnAd_location_longitude").val(lan);
$(".btn").removeAttr("disabled",true);
}
</script>
