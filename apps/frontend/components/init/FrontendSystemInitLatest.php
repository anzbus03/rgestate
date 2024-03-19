<?php defined('MW_PATH') || exit('No direct script access allowed');

 
class FrontendSystemInitLatest extends CApplicationComponent 
{
    protected $_hasRanOnBeginRequest = false;
    protected $_hasRanOnEndRequest = false;
    
    public function init()
    {
		
        parent::init();
        Yii::app()->attachEventHandler('onBeginRequest', array($this, '_runOnBeginRequest'));
        Yii::app()->attachEventHandler('onEndRequest', array($this, '_runOnEndRequest'));
        
        Yii::app()->urlManager->showScriptName = false;  
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
        if(!Yii::app()->request->isAjaxRequest){
            Yii::app()->hooks->addFilter('register_scripts', array($this, '_registerScripts'));
            Yii::app()->hooks->addFilter('register_styles', array($this, '_registerStyles'));
             
        }
    }
    
    public function _registerScripts(CList $scripts)
    {
	 
	
		$cs=Yii::app()->clientScript;
		$apps = Yii::app()->apps;
 
		$assetsUrl  = Yii::app()->controller->assetsUrl;
	 

		$cs->scriptMap=array(
		'jquery.js'=> $assetsUrl.'/js/minified_jquery.js',    
		'jquery.min.js'=> $assetsUrl.'/js/minified_jquery.js' ,  
		'jquery.yiiactiveform.js'=>  false  , 
		'jquery.yiiactiveform.min.js'=>  false  , 
		);
		 
        $scripts->mergeWith(array( 
                array('src' =>  $assetsUrl.'/js/minified.min.js?q=4', 'priority' => -1000,'position'=>CClientScript::POS_HEAD),
                array('src' =>  $assetsUrl.'/js/minified_commonn.min.js?q=27' , 'priority' => -1000,'position'=>CClientScript::POS_HEAD ),
                array('src' =>  $assetsUrl.'/js/build/js/intlTelInput.min.js' , 'priority' => -1000,'position'=>CClientScript::POS_END),
                array('src' => $apps->getBaseUrl('assets/js/main4.min.js?q=2655525'), 'priority' => -1000,'position'=>CClientScript::POS_HEAD),
               array('src' => $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.js?q=111'), 'priority' => -1000,'position'=>CClientScript::POS_END),
        ));  
        return $scripts;
    }
    
    public function _registerStyles(CList $styles)
    {
		$assetsUrl  = Yii::app()->controller->assetsUrl;
        $apps = Yii::app()->apps;
        $const = '1516';
        if(defined('LANGUAGE') and LANGUAGE=='ar'){
       
            
			  $styles->mergeWith(array(
				//array('src' => $assetsUrl.'/new/css/miified_stylesnewar.css?q=1'.$const , 'priority' => -1002),
				array('src' => $assetsUrl.'/new/css/btify.css?q=3'.$const , 'priority' => -1002),
				array('src' => $assetsUrl.'/css/minfied_newar_new.min.css?q=13'.$const, 'priority' => -1002),
				//array('src' =>  $assetsUrl.'/js/build/css/intlTelInput.min.css' , 'priority' => -1000,'position'=>CClientScript::POS_END),
				array('src' => $apps->getBaseUrl('assets/css/unminifiedar.css?q=20'.$const), 'priority' => -1000),
				//array('src' => $apps->getBaseUrl('assets/js/rangeslider/rangeslider.css?q='.$const), 'priority' => -1000,'position'=>CClientScript::POS_END),
				array('src' => $apps->getBaseUrl('assets/css/bothnar-detail2.css?q=484'.$const), 'priority' => -1000),
				array('src' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css', 'priority' => -1000),
					array('src' =>  $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.css?q=1'), 'priority' => -1000),
				
        ));
             
		}else{
        $styles->mergeWith(array(
				array('src' => $assetsUrl.'/new/css/miified_styles.css?q=1'.$const , 'priority' => -1002),
				array('src' => $assetsUrl.'/css/minfied_new.min.css?q=11'.$const, 'priority' => -1002),
				//array('src' =>  $assetsUrl.'/js/build/css/intlTelInput.min.css' , 'priority' => -1000,'position'=>CClientScript::POS_END),
				array('src' => $apps->getBaseUrl('assets/css/unminified.css?q=21'.$const), 'priority' => -1000),
				//array('src' => $apps->getBaseUrl('assets/js/rangeslider/rangeslider.css?q='.$const), 'priority' => -1000,'position'=>CClientScript::POS_END),
				array('src' => $apps->getBaseUrl('assets/css/bothnar-detail2.css?q=484'.$const), 'priority' => -1000),
					array('src' =>  $apps->getBaseUrl('assets/js/multiselect/jquery.dropdown.css?q=1'), 'priority' => -1000),
        ));
		}
        return $styles;
    }
}
