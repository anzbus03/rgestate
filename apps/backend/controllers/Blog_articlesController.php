<?php defined('MW_PATH') || exit('No direct script access allowed');

use DateTime;

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
 
class Blog_articlesController extends Controller
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
     * List all available articles
     */
    public function actionIndex()
    {
        $request = Yii::app()->request;
        $article = new BlogArticle('search');
        $article->unsetAttributes();
        
        // for filters.
        $article->attributes = (array)$request->getQuery($article->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('articles', 'View blogs'), 
            'pageHeading'       => Yii::t('articles', 'View blogs'),
            'pageBreadcrumbs'   => array(
                Yii::t('articles', 'Blogs') => $this->createUrl('blog_articles/index'),
                Yii::t('app', 'View all')
            )
        ));
        
        $this->render('list', compact('article'));
    }
    public function actionIndex_authors()
    {
        $request = Yii::app()->request;
        $authors = new BlogAuthors('search');
        $authors->unsetAttributes();
        
        // for filters.
        $authors->attributes = (array)$request->getQuery($authors->modelName, array());

        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('authors', 'View View Authors'), 
            'pageHeading'       => Yii::t('authors', 'View Authors'),
            'pageBreadcrumbs'   => array(
                Yii::t('authors', 'Authors') => $this->createUrl('blog_articles/index_authors'),
                Yii::t('app', 'View all')
            )
        ));
        
        $this->render('list_authors', compact('authors'));
    }
    
    /**
     * Create a new article
     */
    public function actionCreate()
    {
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $article    = new BlogArticle();
        $articleToCategory = new ArticleToCategory();
        
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($article->modelName, array()))) {
            if (isset(Yii::app()->params['POST'][$article->modelName]['content'])) {
                $article->content = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$article->modelName]['content']);
            }
            if (isset($_FILES['BlogArticle']['name']['featured_image']) && $_FILES['BlogArticle']['error']['featured_image'] == UPLOAD_ERR_OK) {
                $imageName = $this->uploadImage($_FILES['BlogArticle']);
                if ($imageName) {
                    $attributes['featured_image'] = $imageName;
                }
            }
            
            $article->attributes = $attributes;
            $article->listing_countries = Yii::app()->request->getPost("listing_countries");
            if (!$article->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                if ($categories = (array)$request->getPost($articleToCategory->modelName, array())) {
                    foreach ($categories as $category_id) {
                        $articleToCategory = new ArticleToCategory();
                        $articleToCategory->article_id = $article->article_id;
                        $articleToCategory->category_id = (int)$category_id;
                        $articleToCategory->save();
                    }
                }
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'article'   => $article,
            )));
            
            if ($collection->success) {
                $this->redirect(array('blog_articles/index'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('articles', 'Create new blog'), 
            'pageHeading'       => Yii::t('articles', 'Create new blog'),
            'pageBreadcrumbs'   => array(
                Yii::t('articles', 'Blogs') => $this->createUrl('blog_articles/index'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form', compact('article', 'articleToCategory'));
    }
    public function actionCreate_authors()
    {
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        $article    = new BlogAuthors();
        // print_r($request->getPost($article->modelName, array()));
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($article->modelName, array()))) {
            if (isset($_FILES['BlogAuthors']['name']['image']) && $_FILES['BlogAuthors']['error']['image'] == UPLOAD_ERR_OK) {
                $imageName = $this->uploadImage($_FILES['BlogAuthors']);
                if ($imageName) {
                    $attributes['image'] = $imageName;
                }
            }
            
            $article->attributes = $attributes;
            if (!$article->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'article'   => $article,
            )));
            
            if ($collection->success) {
                $this->redirect(array('blog_articles/index_authors'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('articles', 'Create new author'), 
            'pageHeading'       => Yii::t('articles', 'Create new author'),
            'pageBreadcrumbs'   => array(
                Yii::t('articles', 'Authors') => $this->createUrl('blog_articles/index_authors'),
                Yii::t('app', 'Create new'),
            )
        ));
        
        $this->render('form_authors', compact('article', 'articleToCategory'));
    }
    protected function uploadImage($file)
    {
        $imageName = null;
        
        // Check if a file was uploaded
        $tempName = isset($file['tmp_name']['featured_image']) ? $file['tmp_name']['featured_image'] : $file['tmp_name']['image'];
        $fileName = isset($file['name']['featured_image']) ? $file['name']['featured_image'] : $file['name']['image'];
        
        // Ensure that a file is actually uploaded
        if ($tempName && $fileName) {
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            // Allowed file extensions
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            // Check file extension
            if (!in_array($ext, $allowedExtensions)) {
                return null; // Invalid file type
            }
    
            // Generate a unique file name
            $imageName = time() . '_' . rand(0, 9999) . '.' . $ext;
            $path = Yii::getPathOfAlias('root.uploads.images');
            $targetFile = $path . '/' . $imageName;
            
            // Check if the directory exists
            if (!is_dir($path)) {
                mkdir($path, 0777, true); // Create directory if not exists
            }
            
            // Check if the file was uploaded correctly
            if (move_uploaded_file($tempName, $targetFile)) {
                return $imageName; // Return the new file name
            }
        }
        
        return null; // Return null if upload failed
    }
    
    public function actionCheckPublishDates()
    {
        // Get the current datetime
        $now = new DateTime();

        // Query for articles that are not published yet but their publish date has passed
        $articles = BlogArticle::model()->findAll(array(
            'condition' => 'status = :status AND publish_date <= :now',
            'params'    => array(':status' => 'unpublished', ':now' => $now->format('Y-m-d H:i:s')),
        ));

        // Update the status of these articles to 'published'
        foreach ($articles as $article) {
            $article->status = 'published';
            $article->save(false); // Set to true if you want to trigger validation
        }
    }
    
    /**
     * Update existing article
     */
    public function actionUpdate($id)
    {
        $article = BlogArticle::model()->findByPk((int)$id);
        
        if (empty($article)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
        $articleToCategory = new ArticleToCategory();
       
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($article->modelName, array()))) {
            if (isset($_FILES['BlogArticle']['name']['featured_image']) && $_FILES['BlogArticle']['error']['featured_image'] == UPLOAD_ERR_OK) {
                if ($_FILES['BlogArticle']['size']['featured_image'] > 0) {
                    $imageName = $this->uploadImage($_FILES['BlogArticle']);
                    if ($imageName) {
                        $attributes['featured_image'] = $imageName;
                    }
                }
            }
            
            $article->attributes = $attributes;
            if (isset(Yii::app()->params['POST'][$article->modelName]['content'])) {
                $article->content = Yii::app()->ioFilter->purify(Yii::app()->params['POST'][$article->modelName]['content']);
            }
            $article->listing_countries = Yii::app()->request->getPost("listing_countries");
            if (!$article->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                ArticleToCategory::model()->deleteAllByAttributes(array('article_id' => $article->article_id));
                if ($categories = (array)$request->getPost($articleToCategory->modelName, array())) {
                    foreach ($categories as $category_id) {
                        $articleToCategory = new ArticleToCategory();
                        $articleToCategory->article_id = $article->article_id;
                        $articleToCategory->category_id = (int)$category_id;
                        $articleToCategory->save();
                    }
                }
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'article'   => $article,
            )));
            
            if ($collection->success) {
                $this->redirect(array('blog_articles/index'));
            }
        }
        else{
		    $article->listing_countries = CHtml::listData($article->listCountries,'country_id','country_id');
	    }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('articles', 'Update blog'), 
            'pageHeading'       => Yii::t('articles', 'Update blog'),
            'pageBreadcrumbs'   => array(
                Yii::t('articles', 'Blogs') => $this->createUrl('blog_articles/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form', compact('article', 'articleToCategory'));
    }
    public function actionUpdate_author($id)
    {
        $article = BlogAuthors::model()->findByPk((int)$id);
        
        if (empty($article)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $request = Yii::app()->request;
        $notify = Yii::app()->notify;
       
        if ($request->isPostRequest && ($attributes = (array)$request->getPost($article->modelName, array()))) {
            if (isset($_FILES['BlogAuthors']['name']['image']) && !empty($_FILES['BlogAuthors']['name']['image']) && $_FILES['BlogAuthors']['error']['image'] == UPLOAD_ERR_OK) {
                $imageName = $this->uploadImage($_FILES['BlogAuthors']);
                if ($imageName) {
                    $attributes['image'] = $imageName;
                }
            }
            
            $article->attributes = $attributes;
            if (!$article->save()) {
                $notify->addError(Yii::t('app', 'Your form has a few errors, please fix them and try again!'));
            } else {
                $notify->addSuccess(Yii::t('app', 'Your form has been successfully saved!'));
            }
            
            Yii::app()->hooks->doAction('controller_action_save_data', $collection = new CAttributeCollection(array(
                'controller'=> $this,
                'success'   => $notify->hasSuccess,
                'article'   => $article,
            )));
            
            if ($collection->success) {
                $this->redirect(array('blog_articles/index_authors'));
            }
        }
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle . ' | '. Yii::t('articles', 'Update blog'), 
            'pageHeading'       => Yii::t('articles', 'Update blog'),
            'pageBreadcrumbs'   => array(
                Yii::t('articles', 'Blogs') => $this->createUrl('blog_articles/index'),
                Yii::t('app', 'Update'),
            )
        ));
        
        $this->render('form_authors', compact('article', 'articleToCategory'));
    }
    
    /**
     * Delete an existing article
     */
    public function actionDelete($id)
    {
        $article = BlogArticle::model()->findByPk((int)$id);
        
        if (empty($article)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $article->delete();
        
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The item has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('blog_articles/index')));
        }
    }
    
    public function actionDelete_author($id)
    {
        $article = BlogAuthors::model()->findByPk((int)$id);
        
        if (empty($article)) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        $article->delete();
        
        $request    = Yii::app()->request;
        $notify     = Yii::app()->notify;
        
        if (!$request->getQuery('ajax')) {
            $notify->addSuccess(Yii::t('app', 'The author has been successfully deleted!'));
            $this->redirect($request->getPost('returnUrl', array('blog_articles/index_authors')));
        }
    }
    
    /**
     * generate the slug for an article based on the article title
     */
    public function actionSlug()
    {
        $request = Yii::app()->request;
        
        if (!$request->isAjaxRequest) {
            $this->redirect(array('articles/index'));    
        }

        $article = new Article();
        $article->article_id = (int)$request->getPost('article_id');
        $article->slug = $request->getPost('string');
        
        $category = new ArticleCategory();
        $category->slug = $article->slug;
        
        $article->slug = $category->generateSlug();
        $article->slug = $article->generateSlug();
        
        return $this->renderJson(array('result' => 'success', 'slug' => $article->slug));
    }
}
