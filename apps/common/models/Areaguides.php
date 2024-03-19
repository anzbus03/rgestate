<?php
defined('MW_PATH') || exit('No direct script access allowed');

class Areaguides extends ActiveRecord
{
    const STATUS_PUBLISHED = 'published';
    
    const STATUS_UNPUBLISHED = 'unpublished';

    public $location;
    public $slug;
    public $image;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{areaguides}}';
    }
    public function getPrimaryField(){
        return 'areaguide_id';
	}
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array(
            array(['city', 'area', 'highlights', 'neighborhood', 'lifestyle', 'location_detail'], 'required'),
            array('show_all','validateCountries'),
            array(['blan', 'image'], 'safe'),
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
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
           'state' => array(self::BELONGS_TO, 'States', 'state_id'),
           'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */ 
    public function attributeLabels()
    {
        $labels = array(
            'areaguides_id'    => Yii::t('areaguides', 'Areaguides'),
            'city'         => Yii::t('areaguides', 'City'),
            'area'         => Yii::t('areaguides', 'Area'),
            'highlights'         => Yii::t('areaguides', 'Highlights'),
            'neighborhood'         => Yii::t('areaguides', 'Neighborhood'),
            'lifestyle'         => Yii::t('areaguides', 'Lifestyle'),
            'location'         => Yii::t('areaguides', 'Location'),
            'location_detail'         => Yii::t('areaguides', 'Location Detail'),
            'blan'          => Yii::t('areaguides', 'Blog Language'),
            'show_all'      => Yii::t('areaguides', 'Blog Countries'),
            'image'      => Yii::t('areaguides', 'Image'),
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

        $criteria->compare('city', $this->city, true);
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
    
    
    public function generateSlug()
    {
        Yii::import('common.vendors.Urlify.*');
        $string = !empty($this->slug) ? $this->slug : $this->title;
        $slug = URLify::filter($string);
        $areaguides_id = (int)$this->areaguides_id;

        $criteria = new CDbCriteria();
        $criteria->addCondition('areaguides_id != :id AND slug = :slug');
        $criteria->params = array(':id' => $areaguides_id, ':slug' => $slug);
        $exists = $this->find($criteria);
        
        $i = 0;
        while (!empty($exists)) {
            ++$i;
            $slug = preg_replace('/^(.*)(\d+)$/six', '$1', $slug);
            $slug = URLify::filter($slug . ' '. $i);
            $criteria = new CDbCriteria();
            $criteria->addCondition('areaguides_id != :id AND slug = :slug');
            $criteria->params = array(':id' => $areaguides_id, ':slug' => $slug);
            $exists = $this->find($criteria);
        }

        return $slug;
    }
    
	
	
    public function _setDefaultEditorForContent(CEvent $event)
    {

	    if ($event->params['attribute'] == 'highlights') {

            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
			//echo"<pre>";print_r($this);
            $options['id'] = CHtml::activeId($this, 'highlights');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);

        }elseif($event->params['attribute'] == 'neighborhood'){
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            //echo"<pre>";print_r($this);
            $options['id'] = CHtml::activeId($this, 'neighborhood');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);

        }elseif($event->params['attribute'] == 'lifestyle'){

            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            //echo"<pre>";print_r($this);
            $options['id'] = CHtml::activeId($this, 'lifestyle');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);

        }elseif($event->params['attribute'] == 'location_detail'){

            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            //echo"<pre>";print_r($this);
            $options['id'] = CHtml::activeId($this, 'location_detail');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
    
    public function getPermalink($absolute = false)
    {
        // return Yii::app()->apps->getAppUrl('frontend', 'areaguides/' . $this->slug, $absolute);
    }
    
    public function getStatusesArray()
    {
        return array(
            ''                          => Yii::t('app', 'Choose'),
            self::STATUS_PUBLISHED      => Yii::t('areaguides', 'Published'),
            self::STATUS_UNPUBLISHED    => Yii::t('areaguides', 'Unpublished'),
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
            'area' => Yii::t('areaguides', 'My area city'),
            'slug'  => Yii::t('areaguides', 'my-area-city'),
        );
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
    
    public function getExcerpt($length = 200) 
    {
        return StringHelper::truncateLength($this->location, $length);
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
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("Article_title_",t.areaguides_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.areaguides_id = t.areaguides_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Article_content_","",t.areaguides_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.areaguides_id = t.areaguides_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'areaguides_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.areaguides_id';
		} 
		return $this->find($criteria);
	}
	public $listing_countries;
   public function validateCountries($attribute,$params){
	 
			if ( $this->show_all=='1'  and  empty($this->listing_countries)   ){
				$this->addError($attribute, 'Please select at least one country');
			}
		 
	}
    public $state_name;public $state_slug;
    public function getCityText(){

        $user = Yii::app()->db->createCommand()
            ->select('state_name')
            ->from('mw_states')
            ->where('state_id=:id', array(':id'=>$this->city))
            ->queryRow();

        return isset($user['state_name']) ? $user['state_name'] : '-';
    }

    public function getAreaText(){

        $user = Yii::app()->db->createCommand()
            ->select('name')
            ->from('mw_main_region')
            ->where('region_id=:id', array(':id'=>$this->area))
            ->queryRow();

        return isset($user['name']) ? $user['name'] : '-';
    }

    public function getCategoryImages(){
        $html='';
        if(!empty($this->image)){
            $html .='<img src="'.Yii::App()->apps->getBaseUrl('uploads/category/'.$this->image).'" style="width:150px;background:#eee" />';
        }else{
            
             $html .='<img src="https://www.openspacevashon.com/wp-content/uploads/2020/02/test-300x300.jpg" style="width:150px;background:#eee" />';
        }
        return $html;
    }
  
}