<?php defined('MW_PATH') || exit('No direct script access allowed');
class FooterWidget extends CWidget
{
	public $setMargin;
    public function run()
    {
		
		$margin = (!empty($this->setMargin)) ? $this->setMargin : ''; ;
		   $conntroller = $this->controller;
		 
		$this->render('footer',compact('margin','conntroller'));
    }
}
