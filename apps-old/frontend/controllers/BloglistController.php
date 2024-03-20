<?php defined('MW_PATH') || exit('No direct script access allowed');

 
 
class BloglistController extends Controller
{
    /**
     * List available published articles 
     */
     public function init() 
     {
		 parent::init();
      // if(!Yii::app()->extensionsManager->isExtensionEnabled('blog')):
      //  throw new CHttpException(404, Yii::t('app', 'Blog is not activated.'));
      // endif;
	 }
 
    public function actionIndex($slug='blog',$page="1")
    {
 
 
      $limit = "3" ;  
      $this->getData('pageStyles')->add(array('src' =>  Yii::app()->apps->getBaseUrl('assets/css/blogs.css')));
	  if($slug=='index' || $slug=='index/page'){ $slug='blog' ; }
		  
		$articleCategoryFromSlug = ArticleCategory::model()->findByAttributes(array('slug'=>$slug));
		
		if(empty($articleCategoryFromSlug))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
	 
	   $latest = Article::model()->latest(6,4);
	   $resource1 = array();
	   $news1 = array();
	   $reviews1 = array();
	   $tips1 = array();
	   if($slug=="blog")
	   {
		   
		   
		 $resource1 =   Article::model()->latestResource(25); 
		 $news1 =   Article::model()->latestResource(22); 
		 $tips1 =   Article::model()->latestResource(23); 
		 $reviews1 =   Article::model()->latestResource(21); 
		 
		  
	   }
 
		 
        
       // $this->getData('pageStyles')->add(array('src' => Yii::app()->apps->getBaseUrl('assets/css/blogs.css')));
       
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
		$criteria->order  ="t.article_id desc";
		$criteria->group  ="t.article_id";
		$criteria->params[':parent']   = $articleCategoryFromSlug->category_id  ;
		$criteria->params[':pub']   = 'published'  ;
		
		$criteria->together =true;
		$criteria->offset = 0 ;
		$criteria->limit = $limit ;
		/*
        $count=Article::model()->count($criteria);
        $pages=new CPagination($count);
		//$pages->pageSize= (Yii::app()->options->get('system.common.customer_page_size'))?Yii::app()->options->get('system.common.customer_page_size'):'20' ;
		$pages->pageSize=3;
		//$pages->route = "page";
	 
		//$pages->currentPage = Yii::app()->request->getQuery('page', 1)-1  ;
		$pages->applyLimit($criteria);
		* */
	 
        $model=Article::model()->findAll($criteria);
        
        
        $this->setData(array(
                    'pageTitle'              => !empty( $articleCategoryFromSlug->meta_title) ?  $articleCategoryFromSlug->meta_title :   $articleCategoryFromSlug->name , 
                    'pageMetaDescription'   => StringHelper::truncateLength($articleCategoryFromSlug->description, 150),
                    
                ));
                
     
        $this->render( "index" ,compact('resource1','news1','tips1','reviews1','model','pages','category','slug','articleCategoryFromSlug','latest','limit'));
    }
    
    public function actionDetails($slug)
    {
	 
		
		$model  = Article::model()->findByAttributes(array('slug'=>$slug));
		 
		if(empty($model))
		{
			  throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}
	 
		$ip = Yii::app()->request->getUserHostAddress(); 
		$articleView = new ArticleView;
		$ipfound =  $articleView->findIPwithId($model->article_id,$ip);
		
		if(!$ipfound)
		{
			$articleView = new ArticleView;
			$articleView->ip_address = $ip; 
			$articleView->article_id =  $model->article_id;
			$articleView->save();
		}
		 
		$latest = Article::model()->latest(20,20);
		
		
		$popular = Article::model()->popular(20,20);
		
	 
		
		$cat = $model->categories;
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
		   $this->setData(array(
                    'pageTitle'         => Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=> !empty($model->meta_title) ? $model->meta_title :  ucfirst($model->title) )), 
                    'pageMetaDescription'   =>  Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=> !empty($model->meta_description) ? $model->meta_description :  ucfirst($model->title) )),
                    'pageMetaKeywords'   =>  Yii::t('app', '{title} :: {name}', array('{name}' =>     Yii::app()->options->get('system.common.site_name') , '{title}'=> !empty($model->meta_keywords) ? $model->meta_keywords :  ucfirst($model->title) )),
                    
                ));
		$this->render( "details" ,compact('model','category','cat','latest','popular'));
		
	}
    
    public function actionRuntimeloader()
    {
	 
	    $slug = (!empty($_GET['slug'])) ? $_GET['slug'] :  'blog' ; 
		$articleCategoryFromSlug = ArticleCategory::model()->findByAttributes(array('slug'=>$slug ));
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
		$criteria->limit = $_GET['number'];
		$criteria->offset = $_GET['offset']+1;
	    $criteria->order  ="t.article_id desc";
	    $criteria->group  ="t.article_id";
	   
		$model=Article::model()->findAll($criteria);
		  if(empty($model))
		  {
			  echo 1; exit;
		  }
		$this->renderPartial('runtime',compact('model'));
	}
    
    
}
