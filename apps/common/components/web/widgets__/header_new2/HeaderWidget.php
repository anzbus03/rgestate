<?php defined('MW_PATH') || exit('No direct script access allowed');
class HeaderWidget extends CWidget
{
	public $country;
    public function run()
    {
	  $conntroller = $this->controller;
	  $this->country   = $conntroller->c_slug; 
	  $this->render('menu',compact('conntroller'));
    }
}
