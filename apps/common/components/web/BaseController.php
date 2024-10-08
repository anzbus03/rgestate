<?php defined('MW_PATH') || exit('No direct script access allowed'); 

/**
 * BaseController
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class BaseController extends CController
{
    /**
     * @var CMap the data to be passed from view to view
     */
    private $_data;
    
    public function init()
    {
        parent::init();
        
        $hooks      = Yii::app()->hooks;
        $options    = Yii::app()->options;
        
        // data passed in each view.
        $this->setData(array(
            'pageMetaTitle'         => $options->get('system.common.site_name'),
            'pageMetaDescription'   => $options->get('system.common.site_tagline'),
            'pageMetaKeywords'      => $options->get('system.common.site_keywords'),
            'pageHeading'           => '',
            'pageBreadcrumbs'       => array(),
            'hooks'                 => $hooks,
        ));
        
        $appName = Yii::app()->apps->getCurrentAppName();
        $hooks->doAction($appName . '_controller_init');
        $hooks->doAction($appName . '_controller_'.$this->id.'_init');
        
        $this->onControllerInit(new CEvent($this));
    }
    
    public function onControllerInit(CEvent $event)
    {
        $this->raiseEvent('onControllerInit', $event);
    }
    
    public function actions()
    {
        $actions = new CMap();
        
        $appName = Yii::app()->apps->getCurrentAppName();
        $actions = Yii::app()->hooks->applyFilters($appName . '_controller_'.$this->id.'_actions', $actions);
        
        $this->onActions(new CEvent($this, array(
            'actions' => $actions,
        )));

        return $actions->toArray();
    }
    
    public function onActions(CEvent $event)
    {
        $this->raiseEvent('onActions', $event);
    }
    
    /**
     * List of behaviors usable in the controller actions
     */
    public function behaviors()
    {
        $behaviors = new CMap();
        
        $appName = Yii::app()->apps->getCurrentAppName();
        $behaviors = Yii::app()->hooks->applyFilters($appName . '_controller_behaviors', $behaviors);
        $behaviors = Yii::app()->hooks->applyFilters($appName . '_controller_'.$this->id.'_behaviors', $behaviors);
        
        $this->onBehaviors(new CEvent($this, array(
            'behaviors' => $behaviors,
        )));
  
        return $behaviors->toArray();
    }
    
    public function onBehaviors(CEvent $event)
    {
        $this->raiseEvent('onBehaviors', $event);
    }
    
    /**
     * List of filters usable in the controller
     */
    public function filters()
    {
        $filters = new CMap();
        
        $appName = Yii::app()->apps->getCurrentAppName();
        $filters = Yii::app()->hooks->applyFilters($appName . '_controller_filters', $filters);
        $filters = Yii::app()->hooks->applyFilters($appName . '_controller_'.$this->id.'_filters', $filters);
        
        $this->onFilters(new CEvent($this, array(
            'filters' => $filters,
        )));

        return $filters->toArray();
    }
    
    public function onFilters(CEvent $event)
    {
        $this->raiseEvent('onFilters', $event);
    }
    
    /**
     * This method is invoked right before an action is to be executed (after all possible filters.)
     * You may override this method to do last-minute preparation for the action.
     * @param CAction $action the action to be executed.
     * @return boolean whether the action should be executed.
     */
    protected function beforeAction($action)
    {
        $appName = Yii::app()->apps->getCurrentAppName();
        Yii::app()->hooks->doAction($appName . '_controller_before_action', $action);
        Yii::app()->hooks->doAction($appName . '_controller_'.$this->id.'_before_action', $action);
        
        $this->onBeforeAction(new CEvent($this, array(
            'action' => $action
        )));

        return parent::beforeAction($action);
    }
    
    public function onBeforeAction(CEvent $event)
    {
        $this->raiseEvent('onBeforeAction', $event);
    }
    
    /**
     * This method is invoked right after an action is executed.
     * You may override this method to do some postprocessing for the action.
     * @param CAction $action the action just executed.
     */
    protected function afterAction($action)
    {
        $appName = Yii::app()->apps->getCurrentAppName();
        Yii::app()->hooks->doAction($appName . '_controller_after_action', $action);
        Yii::app()->hooks->doAction($appName . '_controller_'.$this->id.'_after_action', $action);
        
        $this->onAfterAction(new CEvent($this, array(
            'action' => $action
        )));
        
        parent::afterAction($action);
    }
    
    public function onAfterAction(CEvent $event)
    {
        $this->raiseEvent('onAfterAction', $event);
    }
    
    /**
     * This method is invoked at the beginning of {@link render()}.
     * You may override this method to do some preprocessing when rendering a view.
     * @param string $view the view to be rendered
     * @return boolean whether the view should be rendered.
     * @since 1.1.5
     */
    protected function beforeRender($view)
    {
        if (Yii::app()->request->enableCsrfValidation) {
            Yii::app()->clientScript->registerMetaTag(Yii::app()->request->csrfTokenName, 'csrf-token-name');
            Yii::app()->clientScript->registerMetaTag(Yii::app()->request->csrfToken, 'csrf-token-value');
        }
        
        $hooks = Yii::app()->hooks;
        
        $appName = Yii::app()->apps->getCurrentAppName();
        $hooks->doAction($appName . '_controller_before_render', $view);
        $hooks->doAction($appName . '_controller_'.$this->id.'_before_render', $view);
        
        $this->onBeforeRender(new CEvent($this, array(
            'view' => $view
        )));
        
        // register assets
        $this->_registerAssets();
                
        return parent::beforeRender($view);
    }
    
    public function onBeforeRender(CEvent $event)
    {
        $this->raiseEvent('onBeforeRender', $event);
    }
    
    /**
     * This method is invoked after the specified is rendered by calling {@link render()}.
     * Note that this method is invoked BEFORE {@link processOutput()}.
     * You may override this method to do some postprocessing for the view rendering.
     * @param string $view the view that has been rendered
     * @param string $output the rendering result of the view. Note that this parameter is passed
     * as a reference. That means you can modify it within this method.
     * @since 1.1.5
     */
    protected function afterRender($view, &$output)
    {    
        $appName = Yii::app()->apps->getCurrentAppName();
        $output = Yii::app()->hooks->applyFilters($appName . '_controller_after_render', $output, $view);
        $output = Yii::app()->hooks->applyFilters($appName . '_controller_'.$this->id.'_after_render', $output, $view);
        
        $this->onAfterRender(new CEvent($this, array(
            'view'      => $view,
            'output'    => &$output,
        )));
        
        parent::afterRender($view, $output);
    }
    
    public function onAfterRender(CEvent $event)
    {
        $this->raiseEvent('onAfterRender', $event);
    }
    
    /**
     * Overrides the parent implementation.
     * 
     * Renders a view file.
     * This method includes the view file as a PHP script
     * and captures the display result if required.
     * @param string $_viewFile_ view file
     * @param array $_data_ data to be extracted and made available to the view file
     * @param boolean $_return_ whether the rendering result should be returned as a string
     * @return string the rendering result. Null if the rendering result is not required.
     */
    public function renderInternal($_viewFile_, $_data_=null, $_return_=false)
    {
        if ($_data_ === null) {
            $_data_ = array();
        }
        
        $this->getData()->mergeWith($_data_, false);
        $_data_ = $this->getData()->toArray();
        
        return parent::renderInternal($_viewFile_, $_data_, $_return_);
    }
    
    /**
     * Render JSON instead of HTML
     * 
     * @param array $data the data to be JSON encoded
     * @param int $statusCode the status code
     * @param array $headers list of headers to send in the response
     * @param string $callback the callback for the jsonp calls
     * @return BaseController
     */
    public function renderJson($data = array(), $statusCode = 200, array $headers = array(), $callback = null)
    {
        $response = new JsonResponse();

        $response
            ->setHeaders($headers)
            ->setStatusCode($statusCode)
            ->setData($data)
            ->setCallback($callback)
            ->send();
        
        Yii::app()->end();
    }
    
    /**
     * Set data available in all views and sub views.
     * 
     */
    final public function setData($key, $value = null) 
    {
        if (!is_array($key) && $value !== null) {
            $this->getData()->mergeWith(array($key => $value), false);
        } elseif (is_array($key)) {
            $this->getData()->mergeWith($key, false);
        }
        return $this;
    }
    
    /**
     * Get data available in all views and sub views.
     * 
     * @return CAttributeCollection
     */
    protected $_pageAssetsCListInitialized = false;
    final public function getData($key = null, $defaultValue = null)
    {
        if (!($this->_data instanceof CAttributeCollection)) {
            $this->_data = new CAttributeCollection($this->_data);
            $this->_data->caseSensitive=true;
        }
        
        // special case when clist is not initialized for the keys
        if (!$this->_pageAssetsCListInitialized) {
            $cList = array('pageScripts', 'pageStyles');
            foreach ($cList as $name) {
                if ((!$this->_data->contains($name) || !($this->_data->itemAt($name) instanceof CList))) {
                    $this->_data->add($name, new CList());
                }
            }
            $this->_pageAssetsCListInitialized = true;
        }

        if ($key !== null) {
            return $this->_data->contains($key) ? $this->_data->itemAt($key) : $defaultValue;
        }
        
        return $this->_data;
    }
    
    /**
     * Register the assets.
     * 
     * @return
     */
    protected function _registerAssets()
    {
        $hooks = Yii::app()->hooks;
        
        // enqueue all custom scripts and styles registered so far
        $this->getData('pageScripts')->mergeWith($hooks->applyFilters('register_scripts', new CList()));
        $this->getData('pageStyles')->mergeWith($hooks->applyFilters('register_styles', new CList()));
        
        // register jquery
        $this->getData('pageScripts')->insertAt(0, array('src' => 'jquery', 'core-script' => true));

        // register scripts
        $pageScripts  = array();
        $sort         = array();
        $_pageScripts = $this->getData('pageScripts')->toArray();
        
        foreach ($_pageScripts as $index => $item) {
            if (empty($item['src'])) {
                $this->getData('pageScripts')->removeAt($index);
                continue;
            }
            $priority       = !empty($item['priority']) ? (int)$item['priority'] : 0;
            $sort[]         = $priority + $index;
            $pageScripts[]  = $item;
        }
        array_multisort($sort, $pageScripts);

        foreach ($pageScripts as $item) {
            $htmlOptions = !empty($item['htmlOptions']) ? (array)$item['htmlOptions'] : array();
            $position    = isset($item['position']) ? (int)$item['position'] : null;
            if (!empty($item['core-script'])) {
                Yii::app()->clientScript->registerCoreScript($item['src']);
            } else {
                Yii::app()->clientScript->registerScriptFile($item['src'], $position, $htmlOptions);
            }
        }
        
        // register styles
        $pageStyles   = array();
        $sort         = array();
        $_pageStyles  = $this->getData('pageStyles')->toArray();
        
        foreach ($_pageStyles as $index => $item) {
            if (empty($item['src'])) {
                $this->getData('pageStyles')->removeAt($index);
                continue;
            }
            $priority      = !empty($item['priority']) ? (int)$item['priority'] : 0;
            $sort[]        = $priority + $index;
            $pageStyles[]  = $item;
        }
        array_multisort($sort, $pageStyles);
        
        foreach ($pageStyles as $item) {
            $media = isset($item['media']) ? $item['media'] : null;
            Yii::app()->clientScript->registerCssFile($item['src'], $media);
        }
    }
    /*
    public function fileUploadDropzone(){
		 if (defined('ENABLED_AWS_SERVER') && ENABLED_AWS_SERVER=='1'){
	 
			Yii::import('common.extensions.webp.lib.imageResize');
			$ref=new imageResize;
			$file =  $_FILES['file']['name'];
			$file_orginal = $_FILES['file']['tmp_name'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			$file_format='jpeg';
			$path = '../tmp';  
			$out = $ref->resize($file_orginal,$path,1024,90,$file_format,TRUE);
		    $img = date('Y-m-d').'-'.rand(0,9999).".".$file_format;
			$awsAccessKey = ENABLED_AWS_ACCESS;
			$awsSecretKey = ENABLED_AWS_SECRET;
			$year = date('Y');
			$bucketName = ENABLED_BUCKET_NAME.'/'.$year;
			Yii::import('common.extensions.amazon.S3');
			$s3 = new S3($awsAccessKey, $awsSecretKey);
			$ar = $s3->putObject(S3::inputFile($out, false), $bucketName, $img, S3::ACL_PUBLIC_READ);
			 
			if (!empty($out)) {
				$storagePath = Yii::getPathOfAlias('root.tmp');
				$customerFiles = $storagePath.'/'.$out;
				if (file_exists($customerFiles) && is_file($customerFiles)) {
					@unlink($customerFiles);
				}  
			}
			if(isset($_POST['rand'])){
				echo json_encode(array('img'=>$year.'/'.$img,'rand'=>$_POST['rand']));exit;
			} 
			echo $year.'/'.$img;exit; 
		}
	}
	* */
	
public function fileUploadDropzone(){
		
			$path_file =  Yii::getPathOfAlias('root.uploads.files');
	 		$ref=new imageResize;
			$file =  $_FILES['file']['name'];
			//$file =  $_FILES['Banner']['name']['image'];
			$file_orginal = $_FILES['file']['tmp_name'];
			//$file_orginal = $_FILES['Banner']['tmp_name']['image'];
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			
		 
			$file_format=$ext ;
			if(Yii::App()->isAppName('backend')){
				$path = '../uploads/tmp'; 
			}else{
			$path = 'uploads/tmp'; 
			}
			 
			/*if(Yii::app()->request->getQuery('no_resize','')=='1'){ */ 
				
				 
					$img = date('Y-m-dhis').'-'.rand(0,9999).".".$file_format;
					$year_folder = $path_file .'/'. date("Y");
					$month_folder = $year_folder . '/' . date("m");
					$month_folder2 = date("Y"). '/' . date("m");
					!file_exists($year_folder) && mkdir($year_folder , 0777);
					!file_exists($month_folder) && mkdir($month_folder, 0777);
					 $path_file = $month_folder ;
					 move_uploaded_file($_FILES['file']['tmp_name'], $path_file."/{$img}");
				/*	
			}
			else{
			$out = $ref->resize($file_orginal,$path,1200,100,$file_format,TRUE);
			$img = date('Y-m-d').'-'.rand(0,9999).".".$file_format;
					 
					$year_folder = $path_file .'/'. date("Y");
					$month_folder = $year_folder . '/' . date("m");
					$month_folder2 = date("Y"). '/' . date("m");
					!file_exists($year_folder) && mkdir($year_folder , 0777);
					!file_exists($month_folder) && mkdir($month_folder, 0777);
					 $path_file = $month_folder ;
					 
					$storagePath = Yii::getPathOfAlias('root.uploads.tmp');
					$customerFiles = $storagePath.'/'.$out;
					  
					 rename( $customerFiles , $path_file."/{$img}");
					 
			  
			} 
			* */		
			if(isset($_POST['rand'])){
				echo json_encode(array('img'=> $month_folder2. '/' .$img,'rand'=>$_POST['rand']));exit;
			} 
			echo  $month_folder2. '/' .$img; exit; 
		 
	}
	 public function getHtmlOrientation()
    {
        // $orientation = Yii::app()->locale->orientation;
        $orientation = defined('MW_HTML_ORIENTATION') ? MW_HTML_ORIENTATION : 'ltr';
        return Yii::app()->hooks->applyFilters('html_orientation', $orientation);
    }
}
