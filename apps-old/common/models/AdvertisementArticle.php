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
class AdvertisementArticle extends Article
{
 
    public function search($return=false)
    {
        $criteria=new CDbCriteria;
        $criteria->condition = '1';
        $criteria->compare('title', $this->title, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('f_type', 'A1');
    	if(defined('LANGUAGE')){
    	    $blan =''; 
    	    switch(LANGUAGE){
    	        case 'en':
    	            $blan = 'E';
    	        break;
    	        case 'ar':
    	             $blan = 'A';
    	        break;
    	    }
    	    if(!empty( $blan)){
		    $criteria->condition .= ' and ( t.blan = "0" or  t.blan = :blan ) ';
		    $criteria->params[':blan'] = $blan ; 
    	    }
		}
       	if(defined('COUNTRY_ID')){
			  	$criteria->join  .= ' left join {{blog_countries}} secCoutry on  secCoutry.country_id =  :country  and secCoutry.article_id = t.article_id  ';
				$criteria->params[':country']   =COUNTRY_ID;
				$criteria->condition .= " and  ( t.show_all = '0' OR secCoutry.country_id is  not    null )";
		  }
		if($return){
			return  $criteria;
		}
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
	   $this->f_type = 'A1'; 
	   return true;
   }
       public function latestBlogs($limit=10){
			$criteria = $this->search(1);
			$criteria->order = 't.article_id DESC';
			$criteria->condition .= ' and t.status=:pub  ';
			$criteria->params[':pub']      = self::STATUS_PUBLISHED ;
		 
			$langaugae = defined('LANGUAGE') ? LANGUAGE : '';
			$criteria->distinct = 't.article_id';
			if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("AdvertisementArticle_title_",t.article_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.article_id = t.article_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("AdvertisementArticle_content_","",t.article_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.article_id = t.article_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'article_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.article_id';
			
			} 
		
			$criteria->limit = $limit; 
			return  $this->findAll($criteria); 
	}
       public function blogBySlug($slug=null){
			$criteria = $this->search(1);
			$criteria->order = 't.article_id DESC';
			$criteria->condition .= ' and t.status=:pub and t.slug =:slug  ';
			$criteria->params[':pub']      = self::STATUS_PUBLISHED ;
			$criteria->params[':slug']      = $slug ;
		 
			$langaugae = defined('LANGUAGE') ? LANGUAGE : '';
			if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("AdvertisementArticle_title_",t.article_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.article_id = t.article_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("AdvertisementArticle_content_","",t.article_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.article_id = t.article_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'article_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.article_id';
			
			} 
			return  $this->find($criteria); 
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
        return Yii::app()->apps->getAppUrl('frontend', 'adv/view/slug/'.$this->slug , $absolute);
    }
     public function countryOption(){
		return array(
		'0' =>'All listing  countries',
		'1' =>'Only for selected countries',
		
		);
	}
    public function afterSave(){
		parent::aftersave();
		if(!$this->isNewRecord){
					BlogCountries::model()->deleteAllByAttributes(array('article_id'=>$this->primaryKey));
		}
		 
		$cn_model = new BlogCountries();
				if(!empty($this->listing_countries) and $this->show_all== '1'){
					foreach($this->listing_countries as $country){
						$cn_model_new = clone $cn_model;
						$cn_model_new->article_id    = $this->primaryKey;
						$cn_model_new->country_id    = $country;
						$cn_model_new->save();
						
					}
				}
		return true; 
	}
		 public function findBySlugPublished($slug)
    {
		$langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
		$criteria=new CDbCriteria;
		$criteria->condition = 't.slug=:slug and status=:status';
		$criteria->params[':slug']   = $slug  ;
		$criteria->params[':status']   =  Article::STATUS_PUBLISHED  ;
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("AdvertisementArticle_title_",t.article_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.article_id = t.article_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("AdvertisementArticle_content_","",t.article_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.article_id = t.article_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'article_id';
				$criteria->select   .= ' ,t.article_id , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.article_id';
		} 
		return $this->find($criteria);
	}
}
