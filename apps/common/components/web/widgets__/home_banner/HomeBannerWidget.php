<?php defined('MW_PATH') || exit('No direct script access allowed');
class HomeBannerWidget extends CWidget
{
    public function run()
    {
	  $conntroller = $this->controller;
	  
	   /*
	   $criteria = new CDbCriteria();
	    $criteria->select = "t.slug,t.title,t.date_added" ;
        $criteria->compare('t.status', Article::STATUS_PUBLISHED);
         $criteria->with = array(
            'activeCategories' => array(
                'together'    => true,
                'joinType'    => 'INNER JOIN',
            ),
        );
        $criteria->compare('activeCategories.category_id', '22');
        $criteria->limit = 10;
        $criteria->order ="t.article_id desc";
        $news = Article::model()->findAll($criteria);
        */
      
	  $this->render('menu',compact('conntroller','news'));
    }
}
