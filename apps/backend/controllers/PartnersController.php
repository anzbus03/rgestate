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
 
class PartnersController extends Controller
{
    public function init()
    {
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
        $filters = array(
            'postOnly + delete, slug',
        );
        
        return CMap::mergeArray($filters, parent::filters());
    }
    
    /**
     * List all available
     */
	
    public function actionIndex()
    {
		//echo"";print_r('ddd');exit;
        $request = Yii::app()->request;
        $partners = new Partners('search');
		
         $partner->attributes = (array)$request->getQuery($partner->modelName, array());
		
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('partners', 'View Partners'), 
            'pageHeading'       => Yii::t('partners', 'View partners'),
            'pageBreadcrumbs'   => array(
                Yii::t('partners', 'partners') => $this->createUrl('partners/list'),
                Yii::t('app', 'View all')
            )
        ));
       
        $this->render('list', compact('partners'));
    }
    
    /**
     * Create a new article
     */
    public function actionCreate()
    {
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $partners    = new Partners();
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($partners->modelName, array()))) {
            $partners->attributes = $attributes;
            $uploadedFile = CUploadedFile::getInstance($partners,'image');
            $uploadedFile1 = CUploadedFile::getInstance($partners,'footer_image');
            if($uploadedFile){
                $fileName  = 'im'.rand(100,1000).$uploadedFile;
                $partners->image = $fileName;
            }
            if($uploadedFile1){
                $fileName1  = 'im'.rand(100,1000).$uploadedFile1;
                $partners->footer_image = $fileName1;
            }
            $postData = Yii::app()->params['POST'][$partners->modelName];
            if (isset($postData['title'])) {
                $partners->title = Yii::app()->ioFilter->purify($postData['title']);
            }
           
            if (!$partners->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                if($uploadedFile){
                    $path =  Yii::app()->basePath . '/../../uploads';
                    $uploadedFile->saveAs($path.'/partners/'. $fileName);
                }
                if($uploadedFile1){
                    $path1 =  Yii::app()->basePath . '/../../uploads';
                    $uploadedFile1->saveAs($path1.'/partners/'. $fileName1);
                }
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'partners'   => $partners,
            )));
            
            if ($collection->success) {
                $this->redirect(array('partners/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('partners', 'Create new'), 
            'pageHeading'       => Yii::t('partners', 'Create new'),
            'pageBreadcrumbs'   => array(
                Yii::t('partners', 'partners') => $this->createUrl('partners/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('partners'));
    }
    
    /**
     * Update existing
     */
    public function actionUpdate($id)
    {
        $partners = Partners::model()->findByPk((int)$id);
        
        if (empty($partners)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($partners->modelName, array()))) {
            $oldfilename = $partners->image;
            $oldfilename1 = $partners->footer_image;
            $partners->attributes = $attributes;
            $postData = Yii::app()->params['POST'][$partners->modelName];
            if (isset($postData['title'])) {
                $partners->title = Yii::app()->ioFilter->purify($postData['title']);
            }
            
            $partners->image = $oldfilename;
            $partners->footer_image = $oldfilename1;
            $file = CUploadedFile::getInstance($partners, 'image');
            $file1 = CUploadedFile::getInstance($partners, 'footer_image');
            if (is_object($file) && get_class($file) === 'CUploadedFile') {
                $fileName = 'im' . rand(100, 1000) . $file;
                $partners->image = $fileName;
            }
            if (is_object($file1) && get_class($file1) === 'CUploadedFile') {
                $fileName1 = 'im' . rand(100, 1000) . $file1;
                $partners->footer_image = $fileName1;
            }

            if (!$partners->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                if (is_object($file) && get_class($file)==='CUploadedFile') {
                    $path =  Yii::app()->basePath . '/../../uploads'; $file->saveAs($path.'/partners/'. $fileName);
                    if ($oldfilename != $fileName) {
                        @unlink(Yii::app()->basePath . '/../../uploads/default/'. $oldfilename);
                    }
                }
                if (is_object($file1) && get_class($file1)==='CUploadedFile') {
                    $path1 =  Yii::app()->basePath . '/../../uploads'; 
                    $file1->saveAs($path1.'/partners/'. $fileName1);
                    if ($oldfilename1 != $fileName1) {
                        @unlink(Yii::app()->basePath . '/../../uploads/default/'. $oldfilename1);
                    }
                }
                Yii::app()->options->set('system.common.partners_cache',date('YmdHis'));
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'partners'   => $partners,
            )));
            
            if ($collection->success) {
                $this->redirect(array('partners/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('partners', 'Update'), 
            'pageHeading'       => Yii::t('partners', 'Update'),
            'pageBreadcrumbs'   => array(
                Yii::t('partners', 'partners') => $this->createUrl('partners/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('partners'));
    }
    
    /**
     * Delete an existing
     */
    public function actionDelete($id)
    {
        $partners = Partners::model()->findByPk((int)$id);
        
        if (empty($partners)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $partners->delete();
        
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('partners/index')));
        }
    }
    
	
    /**
     * generate the slug for an article based on the article title
     */
    public function actionSlug()
    {
        $request = Yii::app()->request;
        
        if (!$request->isAjaxRequest) {
            $this->redirect(array('partners/index'));    
        }

        $partners = new Partners();
        $partners->partners_id = (int)$request->getPost('partners_id');
        $partners->slug = $request->getPost('string');
        
        $partners->slug = $partners->generateSlug();
        
        return $this->renderJson(array('result' => 'success', 'slug' => $partners->slug));
    }
}
