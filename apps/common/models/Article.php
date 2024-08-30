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
class Article extends ActiveRecord
{
    const STATUS_PUBLISHED = 'published';
    
    const STATUS_UNPUBLISHED = 'unpublished';
    
    const PROJECTS = '17';
    const FLOOR_PLAN  = '26';
    const SITE_MAP  = '27';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{article}}';
    }
  public function getPrimaryField(){
		 return 'article_id';
	 }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array(
            array('title, slug, content, status', 'required'),
            array('title', 'length', 'max' => 200),
            array('slug', 'length', 'max' => 255),
             array('show_all','validateCountries'),
             array('blan', 'safe'),
            array('status', 'in', 'range' => array(self::STATUS_PUBLISHED, self::STATUS_UNPUBLISHED)),
            array('page_title,meta_title,meta_keywords,meta_description',  'safe'),
            // The following rule is used by search().
            array('title, status,', 'safe', 'on' => 'search'),
        );
        
        return CMap::mergeArray($rules, parent::rules());
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        $relations = array(
            'viewCount' => array(self::STAT, 'ArticleView', 'article_id'),
            'listCountries' => array(self::HAS_MANY, 'BlogCountries', 'article_id'),
            'categories' => array(self::MANY_MANY, 'ArticleCategory', '{{article_to_category}}(article_id, category_id)'),
            'activeCategories' => array(self::MANY_MANY, 'ArticleCategory', '{{article_to_category}}(article_id, category_id)', 'condition' => 'activeCategories.status = :st', 'params' => array(':st' => ArticleCategory::STATUS_ACTIVE)),
        );
        
        return CMap::mergeArray($relations, parent::relations());
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'article_id'    => Yii::t('articles', 'Article'),
            'title'         => Yii::t('articles', 'Title'),
            'slug'          => Yii::t('articles', 'Slug'),
            'content'       => Yii::t('articles', 'Content'),
            'blan'          => Yii::t('articles', 'Blog Language'),
            'show_all'      => Yii::t('articles', 'Blog Countries'),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());
    }
    public function blanArray(){
        return array(
        '0' => 'All Language',
        'A' => 'Arabic Only',
        'E' => 'English Only',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('title', $this->title, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('f_type', 'A');

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

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Article the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function afterConstruct()
    {
		
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterConstruct();
    }
    
    protected function afterFind()
    {
		//$this->content = Yii::app()->ioFilter->purify($this->content);
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterFind();
    }
    
    protected function beforeValidate()
    {
        $category = new ArticleCategory();
        $category->slug = $this->slug;
        $this->slug = $category->generateSlug();
        $this->slug = $this->generateSlug();

        return parent::beforeValidate();
    }
    
    public function generateSlug()
    {
        Yii::import('common.vendors.Urlify.*');
        $string = !empty($this->slug) ? $this->slug : $this->title;
        $slug = URLify::filter($string,300);
        $article_id = (int)$this->article_id;

        $criteria = new CDbCriteria();
        $criteria->addCondition('article_id != :id AND slug = :slug');
        $criteria->params = array(':id' => $article_id, ':slug' => $slug);
        $exists = $this->find($criteria);
        
        $i = 0;
        while (!empty($exists)) {
            ++$i;
            $slug = preg_replace('/^(.*)(\d+)$/six', '$1', $slug);
            $slug = URLify::filter($slug . ' '. $i);
            $criteria = new CDbCriteria();
            $criteria->addCondition('article_id != :id AND slug = :slug');
            $criteria->params = array(':id' => $article_id, ':slug' => $slug);
            $exists = $this->find($criteria);
        }

        return $slug;
    }
    
    public function _setDefaultEditorForContent(CEvent $event)
    {
        if ($event->params['attribute'] == 'content') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'content');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
    
    public function getSelectedCategoriesArray()
    {
        $selectedCategories = array();
        if (!$this->isNewRecord) {
            $categories = ArticleToCategory::model()->findAllByAttributes(array('article_id' => (int)$this->article_id));
            foreach ($categories as $category) {
                $selectedCategories[] = $category->category_id;
            }
        }
        return $selectedCategories;    
    }
    
    public function getAvailableCategoriesArray()
    {
        $category = new ArticleCategory();
        return $category->getRelationalCategoriesArray();
    }
    
    public function getPermalink($absolute = false)
    {
        return Yii::app()->apps->getAppUrl('frontend', 'article/' . $this->slug, $absolute);
    }
    
    public function getStatusesArray()
    {
        return array(
            ''                          => Yii::t('app', 'Choose'),
            self::STATUS_PUBLISHED      => Yii::t('articles', 'Published'),
            self::STATUS_UNPUBLISHED    => Yii::t('articles', 'Unpublished'),
        );
    }
    
    public function getStatusText()
    {
        $statuses = $this->getStatusesArray();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : $this->status;
    }
    
    public function attributeHelpTexts()
    {
        $texts = array();
        return CMap::mergeArray($texts, parent::attributeHelpTexts());
    }
    
    public function attributePlaceholders()
    {
        $placeholders = array(
            'title' => Yii::t('articles', 'My article title'),
            'slug'  => Yii::t('articles', 'my-article-title'),
        );
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
    
    public function getExcerpt($length = 200) 
    {
        return StringHelper::truncateLength($this->content, $length);
    }
    
    public function getDelvelopmentList($notid="")
    {
		$criteria = new CDbCriteria();
        $criteria->order = 't.article_id DESC';
        $criteria->with = array('categories') ;
        $criteria->select = 't.title,t.slug'; ;
        $criteria->condition = 't.status=:pub and  categories.category_id=:parent and t.article_id!=:notin';
		$criteria->params[':parent']   = self::PROJECTS  ;
		$criteria->params[':notin']   = $notid  ;
	    $criteria->together =true;
		$criteria->params[':pub']      = self::STATUS_PUBLISHED ;
        $criteria->limit = 10; 
       return  $this->findAll($criteria);
	}
	   public function latest($id,$limit)
    {
		$criteria=new CDbCriteria;
		$criteria->with = array('categories') ;
        $criteria->condition = 't.status=:pub and  categories.parent_id=:parent';
		$criteria->params[':parent']   = $id  ;
		$criteria->params[':pub']   = 'published'  ;
		$criteria->limit =$limit;
		$criteria->together  = true;
		$criteria->order ='t.date_added desc';
		return $this->findAll($criteria);
	}
	 public function latestResource($id)
     {
		$criteria=new CDbCriteria;
		$criteria->with = array('categories') ;
        $criteria->condition = 't.status=:pub and  categories.category_id=:parent';
		$criteria->params[':parent']   = $id  ;
		$criteria->params[':pub']   = 'published'  ;
		$criteria->together  = true;
		$criteria->order ='t.date_added desc';
		return $this->find($criteria);
	}
	public $gallery;
	 public function popular($id,$limit)
    {
		$criteria=new CDbCriteria;
		$criteria->with = array('categories') ;
		
		
		$post_table = ArticleView::model()->tableName();
        $post_count_sql = "(select count(*) from $post_table pt where pt.article_id = t.article_id)";
 
    // select
		$criteria->select = array(
			'*',
			$post_count_sql . " as post_count",
		);
 
        $criteria->condition = 't.status=:pub and  categories.parent_id=:parent';
		$criteria->params[':parent']   = $id  ;
		$criteria->params[':pub']   = 'published'  ;
		$criteria->limit =$limit;
		$criteria->together  = true;
		$criteria->order ='post_count desc';
		
		  


		return $this->findAll($criteria);
	}
	 public function listDataForAjax(){
		$limit = 30;
		$query = Yii::app()->request->getQuery('q');
		$criteria=new CDbCriteria;
		$criteria->with = array('categories') ;
        $criteria->condition = 't.status=:pub and  categories.parent_id=:parent';
		$criteria->params[':parent']   = 20 ;
		$criteria->params[':pub']   = 'published'  ;
		$criteria->together  = true;
		$criteria->condition  .= ' and ( t.title like :query or t.content like :query )  ';
		$criteria->params[':query'] =  '%'.$query.'%';
		$count = self::model()->count($criteria);
		$criteria->order = 'title ASC';
		$criteria->limit   =  $limit ; 
        $page =Yii::app()->request->getQuery('page',1);
        
        $offset = ($page==1) ? '0' : ($page - 1) *  $limit + 1;
		$criteria->offset =  $offset ;
        
        $data = self::model()->findAll($criteria);
        $ar = array(); 
        
        if($data){
			foreach($data as $k=>$v){
				 preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $v->content, $imges);
				 $image = @$imges['1'];
				 $icontactIcon =  '<div style="background-image:url('.$image.'); " class="backimg"></div>' ;
				 $icontactIcon .=  '<div class="backimg-detail"><h3>'.$v->title.'</h3><p>Blog</p></div><div class="clearfix"></div>' ;
				 $ar[]= array('id'=>$v->article_id,'text'=>$icontactIcon  );
			}
		}
        $record = array( "total_count"=>$count, "incomplete_results"=> false, "items" =>$ar) ; 
		echo  json_encode( $record ); Yii::app()->end();
		 
	}
	public function related_articles($id,$limit)
    {
		 
		$criteria=new CDbCriteria;
		$criteria->select = 't.slug,t.title';
		$criteria->with = array('categories') ;
        $criteria->condition = 't.status=:pub and  categories.category_id=:parent';
		$criteria->params[':parent']   = $id  ;
		$criteria->params[':pub']   = 'published'  ;
		$criteria->limit =$limit;
		$criteria->together  = true;
		$criteria->order ='t.date_added desc';
		return $this->findAll($criteria);
	}
	 const HELP_CATEGORY  = '30';
	 const POLICY_URL     = '31';
	 public function leftCategories(){
		return array(self::HELP_CATEGORY,self::POLICY_URL);
	}
	public function findPosts($formData=array(),$count_future=false,$returnCriteria=false,$calculate=false){
        $criteria=new CDbCriteria;  
		$criteria->with = array('categories') ;
        $criteria->order = 't.article_id DESC';
		$criteria->condition  = '1';
 			if(isset($formData['parent_id']) and !empty($formData['parent_id']))
		{
			$criteria->condition .= ' and t.status=:pub and  categories.category_id=:parent';
			$criteria->compare('t.f_type', 'Bl');
				$criteria->params[':parent']   = $formData['parent_id'] ;
		}
		else
		{
		 
			   $criteria->compare('t.f_type', 'Bl');
			$criteria->condition .= ' and t.status=:pub and  categories.parent_id=20';
		}
	
		
		  if(defined('COUNTRY_ID')){
          
			  	$criteria->join  .= ' left join {{blog_countries}} secCoutry on  secCoutry.country_id =  :country and secCoutry.article_id = t.article_id ';
				$criteria->params[':country']   =COUNTRY_ID;
				$criteria->condition .= " and  ( t.show_all  = '0' OR secCoutry.country_id is  not    null )";
		  }
		
		if(isset($formData['keyword']) and !empty($formData['keyword']) ){
			$criteria->condition .= ' and ( t.title like :keyword or content like :keyword ) ';
			$criteria->params[':keyword'] = '%'.$formData['keyword'].'%';
		}
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
		
		// $criteria->compare('t.f_type', 'A');
		$criteria->order  ="t.article_id desc";
		$criteria->distinct  ="t.article_id";
		$langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
	 
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("BlogArticle_title_",t.article_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.article_id = t.article_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("BlogArticle_content_","",t.article_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.article_id = t.article_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'article_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.article_id';
		} 
		$criteria->params[':pub']   = 'published'  ;
		
		$criteria->together =true;
		 $total = false ;
	 
	    if($returnCriteria){
			return $criteria;
		}
		
		$criteria->limit  = Yii::app()->request->getQuery('limit','10');
		$criteria->offset = Yii::app()->request->getQuery('offset','0');
		/* SaFE neighbours */
		 
		if($calculate and $criteria->offset==0){
			$total = self::model()->count($criteria);
		}
		if(!empty($count_future)){
			$Result = self::model()->findAll($criteria);
			$criteria->offset = $criteria->limit+$criteria->offset   ;
			$criteria->select = 't.article_id'; 
			$criteria->limit = '1'; 
			$future_count = self::model()->find($criteria);
			return array('result'=>$Result,'future_count'=>$future_count,'total'=>$total);
		}
		else{
			return  self::model()->findAll($criteria)  ; 
		 
		}
    }  
    public function getShortDescription($length = 400)
    {
        return StringHelper::truncateLength($this->content, (int)$length);
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
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("Article_title_",t.article_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.article_id = t.article_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Article_content_","",t.article_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.article_id = t.article_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'article_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.article_id';
		} 
		return $this->find($criteria);
	}
	public $listing_countries;
   public function validateCountries($attribute,$params){
	 
			if ( $this->show_all=='1'  and  empty($this->listing_countries)   ){
				$this->addError($attribute, 'Please select at least one country');
			}
		 
	}
    public function generateImage($imge){
	        	$app = Yii::app();
		return $app->apps->getBaseUrl('timthumb.php').'?src='.$imge.'&h=223&w=180&zc=1';
	 
	}
}
