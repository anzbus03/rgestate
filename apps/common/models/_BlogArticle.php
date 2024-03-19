<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Article
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $article_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property ArticleCategory[] $categories
 * @property ArticleCategory[] $activeCategories
 */
class BlogArticle extends Article
{
 
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('title', $this->title, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('f_type', 'Bl');

        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder' => array(
                    'article_id' => CSort::SORT_DESC,
                ),
            ),
        ));
    }
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
     public function getAvailableCategoriesArray()
    {
	 
        $category = new ArticleCategory();
        return $category->getRelationalCategoriesArray_blog();
    }
    
   public function beforeSave(){
	   parent::beforeSave();
	   $this->f_type = 'Bl'; 
	   return true;
   }
   public function getArticles($id,$full=false)
    {
		$criteria = new CDbCriteria();
        $criteria->order = 't.article_id DESC';
        $criteria->with = array('categories') ;
        if(empty($full)){
        $criteria->select = 't.title,t.slug'; ;
		}else{
			     $criteria->select = 't.*';  
		}
        $criteria->condition = 't.status=:pub and  categories.category_id=:parent';
        
		$criteria->params[':parent']   = $id  ;
		//$criteria->params[':notin']   = $notid  ;
	    $criteria->together =true;
		$criteria->params[':pub']      = self::STATUS_PUBLISHED ;
        $criteria->limit = 10; 
       return  $this->findAll($criteria);
	}
	public function getPermalink($absolute = false)
    {
        return Yii::app()->apps->getAppUrl('frontend', $this->slug .'/blog', $absolute);
    }
}
