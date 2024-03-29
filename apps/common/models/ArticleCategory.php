<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * ArticleCategory
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
/**
 * This is the model class for table "article_category".
 *
 * The followings are the available columns in table 'article_category':
 * @property integer $category_id
 * @property integer $parent_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property ArticleCategory $parent
 * @property ArticleCategory[] $categories
 * @property Article[] $articles
 */
class ArticleCategory extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{article_category}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array(
            array('name, slug, status', 'required'),
            array('parent_id', 'numerical', 'integerOnly' => true),
            array('parent_id', 'exist', 'attributeName' => 'category_id'),
            array('name', 'length', 'max' => 200),
            //array('meta_title', 'length', 'max' => 150),
            array('slug', 'length', 'max' => 250),
            array('status', 'in', 'range' => array(self::STATUS_ACTIVE, self::STATUS_INACTIVE)),
            array('description', 'safe'),
            array('f_type', 'safe'),
            
            // The following rule is used by search().
            array('name, status', 'safe', 'on' => 'search'),
        );
        
        return CMap::mergeArray($rules, parent::rules());
    }
  public function getPrimaryField(){
		 return 'm_c_id';
	 }
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        $relations = array(
            'parent' => array(self::BELONGS_TO, 'ArticleCategory', 'parent_id'),
            'categories' => array(self::HAS_MANY, 'ArticleCategory', 'parent_id'),
            'articles' => array(self::MANY_MANY, 'Article', '{{article_to_category}}(category_id, article_id)'),
            'blogCount'=> array(self::STAT, 'Article', '{{article_to_category}}(category_id, article_id)','condition'=>'t.status="published"'),

        );
        
        return CMap::mergeArray($relations, parent::relations());
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'category_id'   => Yii::t('articles', 'Category'),
            'parent_id'     => Yii::t('articles', 'Parent'),
            'name'          => Yii::t('articles', 'Name'),
            'slug'          => Yii::t('articles', 'Slug'),
            'description'   => Yii::t('articles', 'Description'),
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
    public function search()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('name', $this->name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('f_type','A');

        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder'  => array(
                    'category_id'   => CSort::SORT_ASC,
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ArticleCategory the static model class
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
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterFind();
    }
    
    protected function beforeValidate()
    {
        $article = new Article();
        $article->slug = $this->slug;
        $this->slug = $article->generateSlug();
        $this->slug = $this->generateSlug();

        return parent::beforeValidate();
    }
    
    public function generateSlug()
    {
        Yii::import('common.vendors.Urlify.*');
        $string = !empty($this->slug) ? $this->slug : $this->name;

        $slug = URLify::filter($string, 300);
        $category_id = (int)$this->category_id;
        
        $criteria = new CDbCriteria();
        $criteria->addCondition('category_id != :id AND slug = :slug');
        $criteria->params = array(':id' => $category_id, ':slug' => $slug);
        $exists = $this->find($criteria);
        
        $i = 0;
        while (!empty($exists)) {
            ++$i;
            $slug = preg_replace('/^(.*)(\-\d+)$/six', '$1', $slug);
            $slug = URLify::filter($slug . ' '. $i);
            $criteria = new CDbCriteria();
            $criteria->addCondition('category_id != :id AND slug = :slug');
            $criteria->params = array(':id' => $category_id, ':slug' => $slug);
            $exists = $this->find($criteria);
        }
        
        return $slug;
    }
    
    public function _setDefaultEditorForContent(CEvent $event)
    {
        if ($event->params['attribute'] == 'description') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'description');
            $options['height'] = 100;
            $options['toolbar']= 'Simple';
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
    public function getRelationalCategoriesArrayAll($parentId = null, $separator = ' -> ')
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'category_id, parent_id, name';
        if (empty($parentId)) {
            $criteria->condition = 'parent_id IS NULL';
        } else {
            $criteria->compare('parent_id', (int)$parentId);
        }
          
        $criteria->addCondition('slug IS NOT NULL');
        $criteria->order = 'slug ASC';
        
        $categories = array();
        $results = self::model()->findAll($criteria);
        foreach ($results as $result) {
            // dont allow selecting a child as a parent
            if (!empty($this->category_id) && $this->category_id == $result->category_id) {
                continue;
            }
            $categories[$result->category_id] = $result->name;
            $children = $this->getRelationalCategoriesArray($result->category_id);
            foreach ($children as $childId => $childName) {
                $categories[$childId] = $result->name . $separator . $childName;
            }
        }
        return $categories;
    }
    public function getRelationalCategoriesArray($parentId = null, $separator = ' -> ')
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'category_id, parent_id, name';
        if (empty($parentId)) {
            $criteria->condition = 'parent_id IS NULL';
        } else {
            $criteria->compare('parent_id', (int)$parentId);
        }
        $criteria->compare('f_type','A');
           $criteria->condition .= ' and (    t.category_id != :blog_id) ';
         $criteria->params[':blog_id'] = self::BLOG_D;
       
        $criteria->addCondition('slug IS NOT NULL');
        $criteria->order = 'slug ASC';
        
        $categories = array();
        $results = self::model()->findAll($criteria);
        foreach ($results as $result) {
            // dont allow selecting a child as a parent
            if (!empty($this->category_id) && $this->category_id == $result->category_id) {
                continue;
            }
            $categories[$result->category_id] = $result->name;
            $children = $this->getRelationalCategoriesArray($result->category_id);
            foreach ($children as $childId => $childName) {
                $categories[$childId] = $result->name . $separator . $childName;
            }
        }
        return $categories;
    }
    const BLOG_D = 20;
    public function getRelationalCategoriesArray_blog($parentId = null, $separator = ' -> ')
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'category_id, parent_id, name';
        if (empty($parentId)) {
            $criteria->condition = 'parent_id IS NULL';
        } else {
            $criteria->compare('parent_id', (int)$parentId);
        }
        $criteria->compare('f_type','A');
         $criteria->condition .= ' and (    t.category_id = :blog_id) ';
         $criteria->params[':blog_id'] = self::BLOG_D;
        $criteria->addCondition('slug IS NOT NULL');
        $criteria->order = 'slug ASC';
        
        $categories = array();
        $results = self::model()->findAll($criteria);
        foreach ($results as $result) {
            // dont allow selecting a child as a parent
            if (!empty($this->category_id) && $this->category_id == $result->category_id) {
                continue;
            }
            $categories[$result->category_id] = $result->name;
            $children = $this->getRelationalCategoriesArray($result->category_id);
            foreach ($children as $childId => $childName) {
                $categories[$childId] = $result->name . $separator . $childName;
            }
        }
        return $categories;
    }
    public function getParentNameTrail($separator = ' -> ')
    {
        $nameTrail = array($this->name);
        
        if (!empty($this->parent_id)) {
            $criteria = new CDbCriteria();
            $criteria->select = 'category_id, parent_id, name';
            $criteria->compare('category_id', (int)$this->parent_id);
            $parent = $this->find($criteria);
            
            if (!empty($parent)) {
                $nameTrail[] = $parent->getParentNameTrail();
            }    
        }
        
        $nameTrail = array_reverse($nameTrail);
        return implode($separator, $nameTrail);
    }
    
    public function getPermalink($absolute = false)
    {
        return Yii::app()->apps->getAppUrl('frontend', 'articles/' . $this->slug, $absolute);
    }
    public function getHomeCategoryByname($name='Interviews')
    {
		$criteria = new CDbCriteria();
        $criteria->condition = 'name=:name';
        $criteria->params[':name'] = $name;
        return self::model()->find($criteria);
	}
    
    public function getStatusesArray()
    {
        return array(
            ''                      => Yii::t('app', 'Choose'),
            self::STATUS_ACTIVE     => Yii::t('app', 'Active'),
            self::STATUS_INACTIVE   => Yii::t('app', 'Inactive'),
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
            'name'  => Yii::t('articles', 'My category name'),
            'slug'  => Yii::t('articles', 'my-category-name'),
        );
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
   public function getBlogCategories($id)
    {
		 $criteria = new CDbCriteria();
		 $criteria->condition = 'parent_id=:parent and status=:status';
		 $criteria->params[':parent'] = $id;
		 $criteria->params[':status'] =  self::STATUS_ACTIVE;
		 $langaugae = defined('LANGUAGE') ? LANGUAGE : 'en'; 
		 if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.m_c_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN  tdata.message  ELSE t.name END as  name';
		 }
		 return  $this->findAll($criteria);
	}
	public $name_other;
	public function  findBySlg($slug=null)
    { 	 $langaugae = defined('LANGUAGE') ? LANGUAGE : 'en'; 
		$criteria=new CDbCriteria;
		$criteria->select = 't.name,t.category_id';
		$criteria->condition = ' t.slug = :slug';
		if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.m_c_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,tdata.message as  name_other  ';
		 }
		$criteria->params[':slug'] = $slug ;
		return self::model()->find($criteria);
	}
}
