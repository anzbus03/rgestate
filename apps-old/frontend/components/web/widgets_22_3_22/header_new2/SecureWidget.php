<?php defined('MW_PATH') || exit('No direct script access allowed');
class SecureWidget extends CWidget
{
	public $country;
    public function run()
    {
	  $conntroller = $this->controller;
	  $this->country   = $conntroller->c_slug; 
	  $this->render('secure',compact('conntroller'));
    }
}
