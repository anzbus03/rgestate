<?php defined('MW_PATH') || exit('No direct script access allowed');
class HeaderWidget extends CWidget
{
	public $country;
    public function run()
    {
	  $conntroller = $this->controller;
	  $this->country   = $conntroller->c_slug; 
	  $app	  = $conntroller->app; 
	  $languages = OptionCommon::systemLanguages(); 
	  $this->render('header_new_layout',compact('conntroller','languages','app'));
    }
}
