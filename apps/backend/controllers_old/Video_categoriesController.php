<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Article_categoriesController
 * 
 * Handles the actions for articles categories related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class Video_categoriesController extends Controller
{
    public function init()
    {
        $this->getData('pageScripts')->add(array('src' => AssetsUrl::js('articles.js')));
        parent::init();
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
     * Listing all the available article categories
     */
    public function actionIndex()
    {
        $request    = Yii::app()->request;$notify = Yii::app()->notify;
        $category   = new VideoCategory('search');
           if($request->isPostRequest) {
                $sortOrderAll = $_POST['priority'];
				if(count($sortOrderAll)>0)
				{
					foreach($sortOrderAll as $menuId=>$sortOrder)
					{
						$category->isNewRecord =true; 
						$category->updateByPk($menuId,array('priority'=>$sortOrder)); 
					}
				}
				  $notify->addSuccess(Yii::t('app', 'Priority successfully updated!'));
				  $this->redirect(Yii::app()->request->urlReferrer) ;
        }
        $category->unsetAttributes();
        
        // for filters.
        $category->attributes = (array)$request->getQuery($category->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('articles', 'View video categories'), 
            'pageHeading'       => Yii::t('videos', 'View video categories'),
            'pageBreadcrumbs'   => array(
                Yii::t('videos', 'videos')      => $this->createUrl('videos/index'),
                Yii::t('videos', 'Categories')    => $this->createUrl('video_categories/index'),
                Yii::t('app', 'View all'),
            )
        ));
        
        $this->render('list', compact('category'));
    }
    
    /**
     * Create a new video category
     */
    public function actionCreate()
    {
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $category   = new VideoCategory();
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($category->modelName, array()))) {
            $category->attributes = $attributes;
            if (isset(Yii::app()->params['POST'][$category->modelName]['description'])) {
                $category->description = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$category->modelName]['description']);
            }
            $uploadedFile=CUploadedFile::getInstance($category,'image');
            if($uploadedFile){	 $fileName  = 'im'.rand(100,1000).$uploadedFile; $category->image = $fileName; }
          
            if (!$category->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
				if($uploadedFile){	$path =  Yii::app()->basePath . '/../../uploads';$uploadedFile->saveAs($path.'/default/'. $fileName);}
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'category'  => $category,
            )));
            
            if ($collection->success) {
                $this->redirect(array('video_categories/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('videos', 'Create new video category'), 
            'pageHeading'       => Yii::t('videos', 'Create new video category'),
            'pageBreadcrumbs'   => array(
                Yii::t('videos', 'videos')      => $this->createUrl('videos/index'),
                Yii::t('videos', 'Categories')    => $this->createUrl('video_categories/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('category'));
    }
    
    /**
     * Update existing video category
     */
    public function actionUpdate($id)
    {
        $category = VideoCategory::model()->findByPk((int)$id);

        if (empty($category)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;

        if ($request->isPostRequest && ($attributes = (array)$request->getPost($category->modelName, array()))) {
		    $oldfilename =$category->image;
			
            $category->attributes = $attributes;
            if (isset(Yii::app()->params['POST'][$category->modelName]['description'])) {
                $category->description = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$category->modelName]['description']);
            }
			$file = CUploadedFile::getInstance($category, 'image');
			if (is_object($file) && get_class($file)==='CUploadedFile') {	     $fileName = 'im'.rand(100,1000).$file; $category->image = $fileName;  } 

            if (!$category->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
					if (is_object($file) && get_class($file)==='CUploadedFile') { $path =  Yii::app()->basePath . '/../../uploads'; $file->saveAs($path.'/default/'. $fileName); 	if ($oldfilename != $fileName) { @unlink(Yii::app()->basePath . '/../../uploads/default/'. $oldfilename); } }  
			
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'category'  => $category,
            )));
            
            if ($collection->success) {
                $this->redirect(array('video_categories/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'         => $this->data->pageMetaTitle . ' | '. Yii::t('videos', 'Update video category'), 
            'pageHeading'           => Yii::t('videos', 'Update video category'),
            'pageBreadcrumbs'       => array(
                Yii::t('videos', 'videos')      => $this->createUrl('videos/index'),
                Yii::t('videos', 'Categories')   => $this->createUrl('video_categories/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('category'));
    }
    
    /**
     * Delete exiting video category, allowed only via POST method
     */
    public function actionDelete($id)
    {
        $category = VideoCategory::model()->findByPk((int)$id);
        
        if (empty($category)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $category->delete();
        
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('video_categories/index')));
        }
    }
    
    /**
     * Generate the slug of the video category based on the video category title.
     * Only ajax requests are allowed for this action
     */
    public function actionSlug()
    {
        $request = Yii::app()->request;
        
        if (!$request->isAjaxRequest) {
            $this->redirect(array('video_categories/index'));    
        }

        $category = new VideoCategory();
        $category->category_id = (int)$request->getPost('category_id');
        $category->slug = $request->getPost('string');

        $video = new video();
        $video->slug = $category->slug;

        $category->slug = $video->generateSlug();
        $category->slug = $video->generateSlug();
        $category->slug = $category->generateSlug();
        
        return $this->renderJson(array('result' => 'success', 'slug' => $category->slug));
    }
}
