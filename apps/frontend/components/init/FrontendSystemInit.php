<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * FrontendSystemInit
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class FrontendSystemInit extends CApplicationComponent 
{
    protected $_hasRanOnBeginRequest = false;
    protected $_hasRanOnEndRequest = false;
    
    public function init()
    {
		 
        parent::init();
        Yii::app()->attachEventHandler('onBeginRequest', array($this, '_runOnBeginRequest'));
        Yii::app()->attachEventHandler('onEndRequest', array($this, '_runOnEndRequest'));
        Yii::app()->urlManager->showScriptName = true;
    }
    
    public function _runOnBeginRequest(CEvent $event)
    {
		
        if ($this->_hasRanOnBeginRequest) {
            return;
        }

        // register core assets if not cli mode and no theme active
        if (!MW_IS_CLI && (!Yii::app()->hasComponent('themeManager') || !Yii::app()->getTheme())) {
		 
            $this->registerAssets();
        }
        else
        {
			 
			$this->registerAssets();
		}
        // and mark the event as completed.
        $this->_hasRanOnBeginRequest = true;
    }
    
    public function _runOnEndRequest(CEvent $event)
    {
        if ($this->_hasRanOnEndRequest) {
            return;
        }

        // and mark the event as completed.
        $this->_hasRanOnEndRequest = true;
    }
    
    public function registerAssets()
    {
        Yii::app()->hooks->addFilter('register_scripts', array($this, '_registerScripts'));
        Yii::app()->hooks->addFilter('register_styles', array($this, '_registerStyles'));
    }
    
    public function _registerScripts(CList $scripts)
    {
	 
		$cs=Yii::app()->clientScript;
		$cs->scriptMap=array(
		'jquery.js'=>    'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js'  , 
		'jquery.min.js'=>    'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js'  , 
		);
        $apps = Yii::app()->apps;
        $scripts->mergeWith(array(          
				array('src' => $apps->getBaseUrl('assets/js/common.js'), 'priority' => -1000),
				array('src' => $apps->getBaseUrl('assets/js/jAlert-v3.min.js'), 'priority' => -996),
				array('src' => $apps->getBaseUrl('assets/js/jAlert-functions.min.js'), 'priority' => -996),
        ));  
        return $scripts;
    }
    
    public function _registerStyles(CList $styles)
    {
	 
        $apps = Yii::app()->apps;
        $styles->mergeWith(array(
				array('src' => $apps->getBaseUrl('assets/new/css/style.css'), 'priority' => -1002),
				array('src' => $apps->getBaseUrl('assets/new/css/colors/main.css'), 'priority' => -1002),
				//array('src' => $apps->getBaseUrl('assets/css/common.css'), 'priority' => -1000),
				array('src' => $apps->getBaseUrl('assets/css/askann_common.css'), 'priority' => -1000),
				array('src' => $apps->getBaseUrl('assets/css/responsive.css?q=1'), 'priority' => 1000),
				array('src' => $apps->getBaseUrl('assets/css/new_style_added.css'), 'priority' => 1000),
				array('src' => $apps->getBaseUrl('assets/css/apply_font.css?q=1'), 'priority' => 1000),
				array('src' => 'https://use.fontawesome.com/releases/v5.0.10/css/all.css', 'priority' => -1000),
				array('src' => $apps->getBaseUrl('assets/css/jAlert-v3.css'), 'priority' => -1000),
                     
                
        ));
        return $styles;
    }
}
