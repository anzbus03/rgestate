<style>
	ol.progtrckr {
    margin: 0;
    padding: 0;
    list-style-type none;
}
ol.progtrckr li {
    display: inline-block;
    text-align: center;
    line-height: 3em;
}
ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }
ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }
ol.progtrckr li:after {
    content: "\00a0\00a0";
}
ol.progtrckr li.progtrckr-done {
    color: black;
    border-bottom: 4px solid yellowgreen;
}
ol.progtrckr li.progtrckr-todo {
    color: silver; 
    border-bottom: 4px solid silver;
}
ol.progtrckr li:before {
    position: relative;
    bottom: -2.5em;
    float: left;
    left: 50%;
    line-height: 1em;
}
ol.progtrckr li.progtrckr-done:before {
    content: "\2713";
    color: white;
    background-color: yellowgreen;
    height: 1.2em;
    width: 1.2em;
    line-height: 1.2em;
    border: none;
    border-radius: 1.2em;
}
ol.progtrckr li.progtrckr-todo:before {
    content: "\039F";
    color: silver;
    background-color: white;
    font-size: 1.5em;
    bottom: -1.6em;
}
#jqxWidget 
{
	margin:30px;
}
.wid
{
	float:left; margin:20px;
}
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
                <ol class="progtrckr" data-progtrckr-steps="5">
					<li class="progtrckr-done">Choose Your Region</li> 
					<li class="progtrckr-done">Enter Details</li> 
					<li class="progtrckr-done">Find On Map</li> 
					<li class="progtrckr-todo">Preview Ad</li> 
					<li class="progtrckr-todo">Activate Ad</li>
				</ol>
                <div style="margin-top:20px; width:100%;border:1px solid #eee;">
					
				   <div style="width:90%;margin:auto;margin-top:50px;">
				   
                  <?php echo $form->labelEx($model, 'location');?>
                     <?php echo $form->error($model, 'location');?>
                    <div class="clearfix"><!-- --></div>
                    
                  <?php
                  
                   if($attributes)
                   {
					   foreach($attributes as $k=>$v)
					   {
						    echo $form->hiddenField($model, $k);
					   }
				   }
                   echo $form->hiddenField($model, 'location_latitude');
                   echo $form->hiddenField($model, 'location_longitude');
					?>
					 
                    
                </div> 
                <div class="clearfix"><!-- --></div>
               <?php
               Yii::import('backend.extensions.EGMap.*');
				$gMap = new EGMap();
				$gMap->setWidth('100%');
				$gMap->setHeight(550);
				$gMap->zoom = 6;
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
			 
				$marker = new EGMapMarker($model->location_latitude, $model->location_longitude, array('title' => Yii::t('hotel', ""),
						'icon'=>$icon, 'draggable'=>true), 'marker', array('dragevent'=>$dragevent));
				$marker->addHtmlInfoWindow($info_window_a);
				
				 $gMap->addMarker($marker);
			  
				$gMap->setCenter($model->location_latitude,$model->location_longitude);
				$gMap->zoom = 5;
			 
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
					 
				   </div>
				 
            
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
 
