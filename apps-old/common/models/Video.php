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
class Video extends ActiveRecord
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
        return '{{video}}';
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
            array('content', 'length', 'max' => 250),
            array('status', 'in', 'range' => array(self::STATUS_PUBLISHED, self::STATUS_UNPUBLISHED)),
            array('page_title,meta_title,meta_keywords,meta_description',  'safe'),
            // The following rule is used by search().
            array('title, status,category_id', 'safe', 'on' => 'search'),
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
            'categories' => array(self::MANY_MANY, 'VideoCategory', '{{video_to_category}}(article_id, category_id)'),
            'activeCategories' => array(self::MANY_MANY, 'VideoCategory', '{{video_to_category}}(article_id, category_id)', 'condition' => 'activeCategories.status = :st', 'params' => array(':st' => VideoCategory::STATUS_ACTIVE)),
        );
        
        return CMap::mergeArray($relations, parent::relations());
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'article_id'    => Yii::t('articles', 'Video'),
            'title'         => Yii::t('articles', 'Title'),
            'slug'          => Yii::t('articles', 'Slug'),
            'content'       => Yii::t('articles', 'Youtube Video Url'),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());
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
     public $category_id;
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('title', $this->title, true);
        $criteria->compare('status', $this->status, true);
        if(!empty($this->category_id)){
			$criteria->distinct = 't.category_id' ;
			$criteria->join = ' INNER JOIN {{video_to_category}} vc  on  vc.article_id = t.article_id and vc.category_id = :category_id ' ;
			$criteria->params[':category_id'] = $this->category_id; 
		}
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
		
        //$this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterConstruct();
    }
    
    protected function afterFind()
    {
		//$this->content = Yii::app()->ioFilter->purify($this->content);
       // $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterFind();
    }
    
    protected function beforeValidate()
    {
        $category = new VideoCategory();
        $category->slug = $this->slug;
        $this->slug = $category->generateSlug();
        $this->slug = $this->generateSlug();

        return parent::beforeValidate();
    }
    
    public function generateSlug()
    {
        Yii::import('common.vendors.Urlify.*');
        $string = !empty($this->slug) ? $this->slug : $this->title;
        $slug = URLify::filter($string);
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
            $categories = VideoToCategory::model()->findAllByAttributes(array('article_id' => (int)$this->article_id));
            foreach ($categories as $category) {
                $selectedCategories[] = $category->category_id;
            }
        }
        return $selectedCategories;    
    }
    
    public function getAvailableCategoriesArray()
    {
        $category = new VideoCategory();
        return $category->getRelationalCategoriesArray();
    }
    
    public function getPermalink($absolute = false)
    {
        return Yii::app()->apps->getAppUrl('frontend', 'video/' . $this->slug, $absolute);
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
            'title' => Yii::t('articles', 'Title'),
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
}
