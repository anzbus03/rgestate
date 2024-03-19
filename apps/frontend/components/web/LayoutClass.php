<?php
class LayoutClass extends CApplicationComponent {
 
 public function layoutpath($layoutname) {

   
  if( Yii::app()->options->get('system.theme.frontend.enabled_theme'))
  {
	return  Yii::app()->options->get('system.theme.frontend.enabled_theme').'/'.$layoutname;
  }
  else
  {
	  return $layoutname;
  }
  
  
 }
 public function viewpath($pathname) {

   
  if( Yii::app()->options->get('system.theme.frontend.enabled_theme'))
  {
	return  Yii::app()->options->get('system.theme.frontend.enabled_theme').'/'.$pathname;
  }
  else
  {
	  return $pathname;
  }
  
  
 }
}
?>
