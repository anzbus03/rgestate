<?php defined('MW_PATH') || exit('No direct script access allowed');
class HomeBannerWidget extends CWidget
{
    public function run()
    {
	  $conntroller = $this->controller;
	   $areaData = States::model()->all_cities_list();  
	   $areaData = array_values($areaData); 
	
	  $this->render('menu',compact('conntroller','areaData' ));
    }
}
