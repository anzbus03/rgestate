<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Controller
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class Controller extends BaseController
{
	public $is_super;
	public function Init(){
		parent::Init();
		if(Yii::app()->user->getModel()->removable=='no'){ $this->is_super=='1'; };
		 
	}
}
