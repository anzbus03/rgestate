<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticlesController
 * 
 * Handles the actions for artciles related tasks
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class ArticlesController extends Controller
{
    /**
     * List available published articles 
     */
  public $headerImage;
  public function init(){
	 
	  parent::Init();
      
    }
    public function actionIndex()
    {
		
        $criteria = new CDbCriteria();
        $criteria->compare('status', Article::STATUS_PUBLISHED);
        $criteria->order = 'article_id DESC';
        
        $count = Article::model()->count($criteria);
        
        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        
        $articles = Article::model()->findAll($criteria);
        
        $this->setData(array(
            'pageMetaTitle'     => $this->data->pageMetaTitle.' | '.Yii::t('articles', 'Helpful articles'), 
            'pageBreadcrumbs'   => array()
        ));

        $this->render('index', compact('articles', 'pages'));
    }
    
    /**
     * List available published articles belonging to a category
     */
    public function actionCategory($slug)
    {
        $category = $this->loadCategoryModel($slug);
        
        $criteria = new CDbCriteria();
        $criteria->compare('t.status', Article::STATUS_PUBLISHED);
        $criteria->with = array(
            'activeCategories' => array(
                'select'    => 'activeCategories.category_id',
                'together'  => true,
                'joinType'  => 'INNER JOIN',
                'condition' => 'activeCategories.category_id = :cid',
                'params'    => array(':cid' => $category->category_id),
            )
        );
        $criteria->order = 't.article_id DESC';
        
        $count = Article::model()->count($criteria);
        
        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        
        $articles = Article::model()->findAll($criteria);

        $this->setData(array(
            'pageMetaTitle'         =>  !empty($category->meta_title) ? $category->meta_title :  $category->name,
             'pageTitle'         =>  !empty($category->meta_title) ? $category->meta_title :  $category->name,
            'pageMetaDescription'   => StringHelper::truncateLength($category->description, 150),
        ));
        
        Yii::app()->clientScript->registerLinkTag('canonical', null, $this->createAbsoluteUrl($this->route, array('slug' => $slug)));
        Yii::app()->clientScript->registerLinkTag('shortlink', null, $this->createAbsoluteUrl($this->route, array('slug' => $slug)));
        
        $this->render('category', compact('category', 'articles', 'pages'));
    }
    
    /**
     * View a single article details
     */
    public function actionView($slug)
    {
		 $article = $this->loadArticleModel($slug);
        if(empty($article))
		{
		  
			throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		 }
		 
    
        
        //Yii::app()->clientScript->registerLinkTag('canonical', null, $this->createAbsoluteUrl($this->route, array('slug' => $slug)));
       // Yii::app()->clientScript->registerLinkTag('shortlink', null, $this->createAbsoluteUrl($this->route, array('slug' => $slug)));
       $layot_sidebar = 'view';
		$category_array = $article->getSelectedCategoriesArray() ; 
		if(!empty($category_array)){
			$leftCategories =  $article->leftCategories();
			foreach($leftCategories as $k=>$v){
				if(in_array($v,$category_array)){
					$layot_sidebar = 'view_both';
					$latest = Article::model()->related_articles($v,50);
					break;
				}
			}
		}
        $this->setData(array(
            'pageTitle'     =>   !empty($article->meta_title) ? $article->meta_title: $article->title, 
            'pageMetaDescription'   => 	$article->meta_description,
            'metaKeywords'   => 	$article->	title,
        ));
        $this->render(  $layot_sidebar , compact('article','latest'));
    }
    public function actionProperty_management_services()
    {
		 
		$this->headerImage  =  Yii::app()->theme->baseUrl.'/images/about.jpg'; 
		$this->layout =  Yii::app()->LayoutClass->layoutpath("detail"); 
		//$this->getData('pageStyles')->add(array('src' => AssetsUrl::css('style.css')));
        
		 
 
     //   Yii::app()->clientScript->registerLinkTag('canonical', null, $this->createAbsoluteUrl($this->route, array('slug' => $slug)));
       // Yii::app()->clientScript->registerLinkTag('shortlink', null, $this->createAbsoluteUrl($this->route, array('slug' => $slug)));
        $this->setData(array(
            'pageTitle'     => 'Property management services', 
            'metaDescription'   => 'Property management services',
            'metaKeywords'   => 	'Property management services',
        ));
        $this->render('property-management-services');
    }
   
    
    /**
     * Helper method to load the category AR model
     */
    public function loadCategoryModel($slug)
    {
        $model = ArticleCategory::model()->findByAttributes(array(
            'slug'      => $slug,
            'status'    => Article::STATUS_ACTIVE
        ));
        
        if ($model === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $model;
    }
    
    /**
     * Helper method to load the article AR model
     */
    public function loadArticleModel($slug)
    {
        $model = Article::model()->findByAttributes(array(
            'slug'      => $slug,
            'status'    => Article::STATUS_PUBLISHED
        ));
        
        if ($model === null) {
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        
        return $model;
    }
    
}
