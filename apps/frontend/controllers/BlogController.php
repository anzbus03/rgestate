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
 
class BlogController extends Controller
{
    /**
     * List available published articles 
     */
     public function init()
     {
       if(!Yii::app()->extensionsManager->isExtensionEnabled('blog')):
        throw new CHttpException(404, Yii::t('app', 'Blog is not activated.'));
       endif;
	 }
 
    public function actionIndex($slug='blog')
    {
		 
        print_r(5);
    exit;
		$articleCategoryFromSlug = ArticleCategory::model()->findByAttributes(array('slug'=>$slug));
		 
		if(empty($articleCategoryFromSlug))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
	 
	 
		 
        $this->layout =   Yii::app()->LayoutClass->layoutpath("blog");
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/blogs.css')));
       
        $articleCategoryFromSlug = ArticleCategory::model()->findByAttributes(array('slug'=>$slug));
        if($articleCategoryFromSlug->slug=='blog')
        {
			$category = ArticleCategory::model()->getBlogCategories($articleCategoryFromSlug->category_id);
		}
		else
		{
			$parentCategory = ArticleCategory::model()->findByAttributes(array('slug'=>'blog'));
			if($parentCategory)
			{
			$category = ArticleCategory::model()->getBlogCategories($parentCategory->category_id);
			}
			else
			{
				//No Category
			 $category = array();	
			}
		}
		
	 
		
        $criteria=new CDbCriteria;
		$criteria->with = array('categories') ;
		if($articleCategoryFromSlug->parent_id=="")
		{
			 
        $criteria->condition = 't.status=:pub and  categories.parent_id=:parent';
       
		}
		else
		{
		 
		$criteria->condition = 't.status=:pub and  categories.category_id=:parent';
		
		}
		$criteria->params[':parent']   = $articleCategoryFromSlug->category_id  ;
		$criteria->params[':pub']   = 'published'  ;
		
		$criteria->together =true;
        $count=Article::model()->count($criteria);
        $pages=new CPagination($count);
		//$pages->pageSize= (Yii::app()->options->get('system.common.customer_page_size'))?Yii::app()->options->get('system.common.customer_page_size'):'20' ;
		$pages->pageSize= 10;
		$pages->applyLimit($criteria);
        $model=Article::model()->findAll($criteria);
        
        

        $this->render(Yii::app()->LayoutClass->viewpath("index"),compact('model','pages','category','slug','articleCategoryFromSlug'));
    }
    
    public function actionDetails($slug)
    {
		
		$model  = Article::model()->findByAttributes(array('slug'=>$slug));
		$this->layout =   Yii::app()->LayoutClass->layoutpath("blog");
        $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/blogs.css')));
       
		$parentCategory = ArticleCategory::model()->findByAttributes(array('slug'=>'blog'));
		if($parentCategory)
		{
		$category = ArticleCategory::model()->getBlogCategories($parentCategory->category_id);
		}
		else
		{
			//No Category
		 $category = array();	
		}
		 
		if(empty($model))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
		
		$this->render(Yii::app()->LayoutClass->viewpath("details"),compact('model','category'));
		
	}
    
    
    
}
