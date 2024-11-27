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
class ContentPages extends Article
{
     public function rules()
    {
        $rules = array(
            array('title, slug, content,cords, status', 'required'),
            array('title', 'length', 'max' => 200),
            array('slug', 'length', 'max' => 255),
            array('status', 'in', 'range' => array(self::STATUS_PUBLISHED, self::STATUS_UNPUBLISHED)),
            array('page_title,meta_title,meta_keywords,meta_description',  'safe'),
            array('cords',  'safe'),
            // The following rule is used by search().
            array('title, status,', 'safe', 'on' => 'search'),
        );
        
        return CMap::mergeArray($rules, parent::rules());
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('title', $this->title, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('cords', $this->cords );
        $criteria->compare('f_type', 'CP');

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
     public function attributeLabels()
    {
        $labels = array(
            'article_id'    => Yii::t('articles', 'Widget Title'),
            'title'         => Yii::t('articles', 'Title'),
            'slug'          => Yii::t('articles', 'Slug'),
            'content'       => Yii::t('articles', 'Content'),
           
            'cords'         =>'Section used in ',
        );
        
        return  $labels;
    }  public function usedin(){
        return array(
            
            '1' => 'Home',
             
            );
    }
    public function getcordsText(){
        $ar = $this->usedin();
        return isset($ar[$this->cords]) ? $ar[$this->cords] : ''; 
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
	   $this->f_type = 'CP'; 
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
	public function getAllWidgets($page_id)
    {
		$criteria = new CDbCriteria();
     
        $criteria->select = 't.article_id'; ;
		 
		$langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
	 
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
			 	$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Article_content_","",t.article_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.article_id = t.article_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 't.article_id';
				$criteria->select   .= ' ,CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.article_id';
		} else{
		    	$criteria->select   .= ' ,t.content';
		}
		
        $criteria->condition = 't.status=:pub  and t.f_type="CP" and cords=:cords ';
    
		$criteria->params[':pub']      = self::STATUS_PUBLISHED ;
		$criteria->params[':cords']      = $page_id ;
        
        $items =   $this->findAll($criteria);
        $page =array(); 
        foreach($items as $k=>$v){
             $page[$v->article_id] = $v->content; 
        }
        return $page ;
       
       
	}
	
	public $cords;
	public function pageContentList($f_type){
	    $cacheKey = 'page_b'.LANGUAGE. Yii::app()->options->get('system.common.content_c_cahe.'.$f_type,'12e43');
		if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) {
		     
			  return $items;
		}
		  
		$items = $this->getAllWidgets($f_type);
	 
		Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24);
		return $items;
	}
	public function getPermalink($absolute = false)
    {
        $url = $this->slug;
        if (strpos($this->slug, 'business') !== false) {
            $url = "business-opportunities";
        } else if(strpos($this->slug, 'home') !== false){
            $url = "/";
        }
        
        return Yii::app()->apps->getAppUrl('frontend', $url, $absolute);
    }
    
    public function getTranslateHtml($field,$lan='pl', $disableEditer=1){
		$fiedId = 'Article_'.$field;
		$fiedId .= ($this->isNewRecord) ? '_[CREATE]_'.$this->random :'_'.$this->primaryKey;
		$relation_id = $this->primaryField;
		return '<div class="pull-right"><a style="color: white !important;" href="javascript:void(0)" data-id="'.$fiedId.'" data-lan="'.$lan.'" data-fieldid="Article_'.$field.'" data-relation_id="'.$this->primaryKey.'" data-relation="'.$relation_id.'" data-disableEditer="'.$disableEditer.'"  onclick="showAjaxModal(this)"><small class="label pull-right bg-blue">'.$lan.'</small></a></div>';
	} 
}
