<?php defined('MW_PATH') || exit('No direct script access allowed');

class Partners extends ActiveRecord
{
    const STATUS_PUBLISHED = 'published';
    
    const STATUS_UNPUBLISHED = 'unpublished';

    public $slug;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{partners}}';
    }
  public function getPrimaryField(){
		 return 'partners_id';
	 }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array(
            array(['title', 'image'], 'required'),
            array('show_all','validateCountries'),
            array(['blan'], 'safe'),
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
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'partners_id'    => Yii::t('partners', 'Partners'),
            'title'         => Yii::t('partners', 'Title'),
            'blan'          => Yii::t('partners', 'Language'),
            'show_all'      => Yii::t('partners', 'Countries'),
            'image'      => Yii::t('partners', 'Image'),
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
                    'partners_id' => CSort::SORT_DESC,
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
        $partners_id = (int)$this->partners_id;

        $criteria = new CDbCriteria();
        $criteria->addCondition('partners_id != :id AND slug = :slug');
        $criteria->params = array(':id' => $partners_id, ':slug' => $slug);
        $exists = $this->find($criteria);
        
        $i = 0;
        while (!empty($exists)) {
            ++$i;
            $slug = preg_replace('/^(.*)(\d+)$/six', '$1', $slug);
            $slug = URLify::filter($slug . ' '. $i);
            $criteria = new CDbCriteria();
            $criteria->addCondition('partners_id != :id AND slug = :slug');
            $criteria->params = array(':id' => $partners_id, ':slug' => $slug);
            $exists = $this->find($criteria);
        }

        return $slug;
    }
    
	
	
    public function _setDefaultEditorForContent(CEvent $event)
    {

	    if ($event->params['attribute'] == 'title') {

            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
			//echo"<pre>";print_r($this);
            $options['id'] = CHtml::activeId($this, 'title');
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);

        }
    }
    
    public function getPermalink($absolute = false)
    {
        // return Yii::app()->apps->getAppUrl('frontend', 'partners/' . $this->slug, $absolute);
    }
    
    public function getStatusesArray()
    {
        return array(
            ''                          => Yii::t('app', 'Choose'),
            self::STATUS_PUBLISHED      => Yii::t('partners', 'Published'),
            self::STATUS_UNPUBLISHED    => Yii::t('partners', 'Unpublished'),
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
            'title' => Yii::t('partners', 'My Title'),
            'slug'  => Yii::t('partners', 'my-title'),
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
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("Article_title_",t.partners_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.partners_id = t.partners_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
				$criteria->join  .= ' left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Article_content_","",t.partners_id) )   left join `mw_translate_relation` `translationRelation1` on translationRelation1.partners_id = t.partners_id  and  translationRelation1.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdata1 ON (`translationRelation1`.translate_id=tdata1.translation_id and tdata1.lang=:lan  ) ';
				$criteria->distinct = 'partners_id';
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.title END	 as  title , CASE WHEN tdata1.message IS NOT NULL AND translate1.source_tag IS NOT NULL THEN  tdata1.message    ELSE t.content END	 as  content ';
				$criteria->group = 't.partners_id';
		} 
		return $this->find($criteria);
	}
	public $listing_countries;
   public function validateCountries($attribute,$params){
	 
			if ( $this->show_all=='1'  and  empty($this->listing_countries)   ){
				$this->addError($attribute, 'Please select at least one country');
			}
		 
	}

    public function getPartnerImages(){
        $html='';
        if(!empty($this->image)){
            $html .='<img src="'.Yii::App()->apps->getBaseUrl('uploads/partners/'.$this->image).'" style="width:110px;background:#eee" />';
        }
        return $html;
    }

    public function getPartnerImages1(){
        $html='';
        if(!empty($this->footer_image)){
            $html .='<img src="'.Yii::App()->apps->getBaseUrl('uploads/partners/'.$this->footer_image).'" style="width:110px;background:#eee" />';
        }
        return $html;
    }
  
}
