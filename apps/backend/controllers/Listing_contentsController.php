<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticlesController
 * 
 * Handles the actions for articles related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class Listing_contentsController extends Controller
{
    public function init()
    {
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('areaguides.js')));
        parent::init();
		$this->initAjaxCsrfToken();
    }
    protected function initAjaxCsrfToken() {
        Yii::app()->clientScript->registerScript('AjaxCsrfToken', ' $.ajaxSetup({
                         data: {"' . Yii::app()->request->csrfTokenName . '": "' . Yii::app()->request->csrfToken . '"},
                         cache:false
                    });', CClientScript::POS_HEAD);
    }
    /**
     * Define the filters for various controller actions
     * Merge the filters with the ones from parent implementation
     */
    public function filters()
    {
        // $filters = array(
        //     'postOnly + delete, slug',
        // );
        
        return CMap::mergeArray($filters, parent::filters());
    }
    
    /**
     * List all available
     */
	
    public function actionIndex()
    {
		
        $request = Yii::app()->request;
        $areaguide = new ListingContents('search');
		
         $areaguide->attributes = (array)$request->getQuery($areaguide->modelName, array());
		
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('areaguides', 'View listing content'), 
            'pageHeading'       => Yii::t('areaguides', 'View listing contents'),
            'pageBreadcrumbs'   => array(
                Yii::t('areaguides', 'listing content') => $this->createUrl($this->id.'/list'),
                Yii::t('app', 'View all')
            )
        ));
       
        $this->render('list', compact('areaguide'));
    }
    
    /**
     * Create a new article
     */
    public function actionCreate()
    {
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $areaguides    = new ListingContents();
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($areaguides->modelName, array()))) {
            $areaguides->attributes = $attributes;
            $uploadedFile = CUploadedFile::getInstance($areaguides,'image');
            if($uploadedFile){
                $fileName  = 'im'.rand(100,1000).$uploadedFile;
                $areaguides->image = $fileName;
            }
            $postData = Yii::app()->params['POST'][$areaguides->modelName];
            if (isset($postData['highlights'])) {
                $areaguides->highlights = Yii::app()->ioFilter->purify($postData['highlights']);
            }
            if (isset($postData['neighborhood'])) {
                $areaguides->neighborhood = Yii::app()->ioFilter->purify($postData['neighborhood']);
            }
          
            if (!$areaguides->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                if($uploadedFile){
                    $path =  Yii::app()->basePath . '/../../uploads';
                    $uploadedFile->saveAs($path.'/category/'. $fileName);
                }
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'areaguides'   => $areaguides,
            )));
            
            if ($collection->success) {
                $this->redirect(array($this->id.'/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('areaguides', 'Create new'), 
            'pageHeading'       => Yii::t('areaguides', 'Create new'),
            'pageBreadcrumbs'   => array(
                Yii::t('areaguides', 'Areaguides') => $this->createUrl($this->id.'/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('areaguides'));
    }
    
    /**
     * Update existing
     */
    public function actionUpdate($id)
    {
        $areaguides = ListingContents::model()->findByPk((int)$id);
        
        if (empty($areaguides)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($areaguides->modelName, array()))) {
            $oldfilename = $areaguides->image;
            $areaguides->attributes = $attributes;
            $postData = Yii::app()->params['POST'][$areaguides->modelName];
            if (isset($postData['highlights'])) {
                $areaguides->highlights = Yii::app()->ioFilter->purify($postData['highlights']);
            }
            if (isset($postData['neighborhood'])) {
                $areaguides->neighborhood =  $postData['neighborhood'] ;
            }
             
            $areaguides->image = $oldfilename;
            $file = CUploadedFile::getInstance($areaguides, 'image');
            if (is_object($file) && get_class($file) === 'CUploadedFile') {
                $fileName = 'im' . rand(100, 1000) . $file;
                $areaguides->image = $fileName;
            }

            if (!$areaguides->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                if (is_object($file) && get_class($file)==='CUploadedFile') {
                    $path =  Yii::app()->basePath . '/../../uploads'; $file->saveAs($path.'/category/'. $fileName);
                    if ($oldfilename != $fileName) {
                        @unlink(Yii::app()->basePath . '/../../uploads/default/'. $oldfilename);
                    }
                }
                Yii::app()->options->set('system.common.category_cache',date('YmdHis'));
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'areaguides'   => $areaguides,
            )));
            
            if ($collection->success) {
                $this->redirect(array($this->id.'/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('areaguides', 'Update'), 
            'pageHeading'       => Yii::t('areaguides', 'Update'),
            'pageBreadcrumbs'   => array(
                Yii::t('areaguides', 'listing contents') => $this->createUrl($this->id.'/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('areaguides'));
    }
    
    /**
     * Delete an existing
     */
    public function actionDelete($id)
    {   
        $areaguides = ListingContents::model()->findByPk((int)$id);
        
        if (empty($areaguides)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $areaguides->delete();
        
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array($this->id.'/index')));
        }
    }
    
	
	public function actionLoadCities()
	{
	   $id=null;
		if(isset($_REQUEST['area']))
		{ 
			$id =$_REQUEST['area'];  
		}
        $data = CHtml::listData(States::model()->getStateWithCountry_3(66124, $id),"state_id" ,"state_name");
	   echo "<option value=''>Select City</option>";
	   foreach($data as $k=>$v)
	   echo CHtml::tag('option', array('value'=>$k),CHtml::encode($v),true);
	}
	
	
    /**
     * generate the slug for an article based on the article title
     */
    public function actionSlug()
    {
        $request = Yii::app()->request;
        
        if (!$request->isAjaxRequest) {
            $this->redirect(array('areaguides/index'));    
        }

        $areaguides = new Areaguides();
        $areaguides->areaguides_id = (int)$request->getPost('areaguides_id');
        $areaguides->slug = $request->getPost('string');
        
        $areaguides->slug = $areaguides->generateSlug();
        
        return $this->renderJson(array('result' => 'success', 'slug' => $areaguides->slug));
    }
}
