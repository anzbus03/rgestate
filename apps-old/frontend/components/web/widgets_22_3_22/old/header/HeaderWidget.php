<?php defined('MW_PATH') || exit('No direct script access allowed');
class HeaderWidget extends CWidget
{
    public function run()
    {
	  $conntroller = $this->controller;
	  $this->render('menu',compact('conntroller'));
    }
}
