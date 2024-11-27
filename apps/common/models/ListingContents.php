<?php defined('MW_PATH') || exit('No direct script access allowed');

class ListingContents extends ActiveRecord
{
    const STATUS_PUBLISHED = 'published';
    
    const STATUS_UNPUBLISHED = 'unpublished';

    public $location;
    public $slug;
    public $uniq_url;

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
            array(['highlights','section_id'], 'required'),
            array(['city', 'area', 'highlights', 'neighborhood', 'lifestyle', 'location_detail'], 'safe'),
            array('show_all','validateCountries'),
             array('area','validateUid'),
            array(['blan', 'image'], 'safe'),
            array('status', 'in', 'range' => array(self::STATUS_PUBLISHED, self::STATUS_UNPUBLISHED)),
            array('page_title,meta_title,meta_keywords,meta_description,f_type,p_type,sub_category,nested_sub_category',  'safe'),
            // The following rule is used by search().
            array('title, status,', 'safe', 'on' => 'search'),
        );
        
        return CMap::mergeArray($rules, parent::rules());
    }

 public function beforeSave(){
        parent::beforeSave();
        $this->f_type= 'L';
        return true;
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
            'p_type' =>'Category',
            'sub_category' =>'Sub Category',
            'nested_sub_category' =>'Nested Sub Category',
            'section_id' =>'Module',
            'areaguides_id'    => Yii::t('areaguides', 'Areaguides'),
            'city'         => Yii::t('areaguides', 'Community'),
            'area'         => Yii::t('areaguides', 'City'),
            'highlights'         => Yii::t('areaguides', 'Page Content'),
            'neighborhood'         => Yii::t('areaguides', 'Schemea at head section'),
            'lifestyle'         => Yii::t('areaguides', 'Business for Sale'),
            'location'         => Yii::t('areaguides', 'Preleased'),
            'location_detail'         => Yii::t('areaguides', 'Preleased'),
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
     public function getp_typeName(){
         $f =Category::model()->findByPk($this->p_type);
         if($f){ return $f->category_name; }
     }
      public function getsectionArray(){
         return array('1'=>'for Sale','2'=>'to Rent','3'=>'Business'); 
     }
     public function getsectionName(){
         $ar = $this->getsectionArray();
         return isset($ar[$this->section_id]) ? $ar[$this->section_id] : '' ; 
         
     }
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('city', $this->city, true);
        $criteria->compare('status', $this->status, true);
         $criteria->compare('section_id', $this->section_id);
          $criteria->compare('p_type', $this->p_type);
          $criteria->compare('sub_category', $this->sub_category);
          $criteria->compare('nested_sub_category', $this->nested_sub_category);
        $criteria->compare('f_type', 'L');

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
        $areaSlug = States::model()->findByPk($this->city);
        return Yii::app()->apps->getAppUrl('frontend', 'area-guides/' . $areaSlug->slug??'dubai-industrial-city', $absolute);
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
   public function validateUid($attribute,$params){
	 	$criteria=new CDbCriteria;
		$criteria->condition = 't.f_type= "L"';
		if(!empty($this->city)){
                $criteria->condition .= ' and t.city= :city ';
                $criteria->params[':city']  = $this->city;
		}else{
		    $criteria->condition .= ' and t.city is null  ';
		}
		if(!empty($this->area)){
                $criteria->condition .= ' and t.area= :area ';
                $criteria->params[':area']  = $this->area;
		}
		else{
		      $criteria->condition .= ' and t.area is null  ';
		}
		
		if(!empty($this->section_id)){
                $criteria->condition .= ' and t.section_id= :section_id ';
                $criteria->params[':section_id']  = $this->section_id;
		}
		if(!empty($this->p_type)){
                $criteria->condition .= ' and t.p_type= :p_type ';
                $criteria->params[':p_type']  = $this->p_type;
		}
		if(!empty($this->sub_category)){
                $criteria->condition .= ' and t.sub_category= :sub_category ';
                $criteria->params[':sub_category']  = $this->sub_category;
		}
		if(!empty($this->sub_category)){
                $criteria->condition .= ' and t.sub_category= :sub_category ';
                $criteria->params[':sub_category']  = $this->sub_category;
		}
		if(!empty($this->nested_sub_category)){
                $criteria->condition .= ' and t.nested_sub_category= :nested_sub_category ';
                $criteria->params[':nested_sub_category']  = $this->nested_sub_category;
		}
	    $found = self::model()->find($criteria);
	    if($found and ($found->areaguides_id != $this->areaguides_id)  ){
	        	$this->addError($attribute, 'Same Area, City, Category Already Exist. Click here to update it'.Chtml::link('Update',Yii::app()->createUrl('listing_contents/update',array('id'=>$found->areaguides_id))));
	    }
		 
		  
	}
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
        }
        return $html;
    }
    public function getListingContent($section=null,$category=null,$city=null, $subcategory = null, $nested_subcategory = null){
        
        $criteria=new CDbCriteria;
        $criteria->select = 't.*';
		$criteria->condition = 't.f_type= "L"';
		
		if(!empty($city)){
		        $criteria->join .=' left join {{main_region}} reg on reg.region_id = t.area '; 
                $criteria->join .=' left join {{states}} st on st.state_id = t.city   '; 
              
                $criteria->condition .= ' and (reg.slug= :city or st.slug = :city) ';
                $criteria->params[':city']  = $city;
		}else{
		   $criteria->condition .= ' and t.city is null and t.area is null  ';
		}
		
		if(!empty($section)){
		        $sec_id = '';
		        switch($section){
                    case 'property-for-sale':
                    $sec_id = '1';
                    break;
                    case 'preleased':
                    $sec_id = '1';
                    break;
                    case 'property-for-rent':
                    $sec_id = '2';
                    break;
                    case 'business-opportunities':
                    $sec_id = '3';
                    break;
		        }
		        if(!empty($sec_id)){
                $criteria->condition .= ' and t.section_id= :section_id ';
                $criteria->params[':section_id']  =$sec_id;
		        }
		}
		
		if(!empty($category)){
		    $criteria->join .=' inner join {{category}} cat on cat.category_id = t.p_type and  cat.slug = :p_type '; 
            $criteria->params[':p_type']  = $category;
		}else{
		    $criteria->condition .= ' and t.p_type is null  ';
		}
		if(!empty($subcategory)){
		    $criteria->join .=' inner join {{subcategory}} subcat on subcat.sub_category_id = t.sub_category and subcat.slug = :sub_category'; 
            $criteria->params[':sub_category']  = $subcategory;
		}else{
		    $criteria->condition .= ' and t.sub_category is null  ';
		}
		if(!empty($nested_subcategory)){
		    $criteria->join .=' inner join {{subcategory}} nestedsub on nestedsub.sub_category_id = t.nested_sub_category and nestedsub.slug = :nested_sub_category '; 
            $criteria->params[':nested_sub_category']  = $nested_subcategory;
		}else{
		    $criteria->condition .= ' and t.nested_sub_category is null  ';
		}
		if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.areaguides_id'; 
		    $criteria->join  .= ' left join `mw_translate` `translate` on ( translate.source_tag = concat("ListingContents_meta_title_","",t.areaguides_id) ) left join `mw_translate_relation` `translationRelation` on translationRelation.areaguide_id = t.areaguides_id  and  translationRelation.translate_id = translate.translate_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->join  .= '  left join `mw_translate` `translate1` on ( translate1.source_tag = concat("ListingContents_meta_description_","",t.areaguides_id) )  left join `mw_translate_relation` `translationRelationP` on translationRelationP.areaguide_id = t.areaguides_id  and  translationRelationP.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdataP ON (`translationRelationP`.translate_id=tdataP.translation_id and tdataP.lang=:lan) ';
			$criteria->join  .= '  left join `mw_translate` `translate2` on ( translate2.source_tag = concat("ListingContents_highlights_","",t.areaguides_id) )  left join `mw_translate_relation` `translationRelationH` on translationRelationH.areaguide_id = t.areaguides_id  and  translationRelationH.translate_id = translate2.translate_id  LEFT  JOIN mw_translation_data tdataH ON (`translationRelationH`.translate_id=tdataH.translation_id and tdataH.lang=:lan) ';
	    	$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.meta_title END  AS meta_title ,CASE WHEN tdataP.message IS NOT NULL THEN    tdataP.message ELSE t.meta_description END  AS meta_description,CASE WHEN tdataH.message IS NOT NULL THEN    tdataH.message ELSE t.highlights END  AS highlights ';
	    }  
	    	
	     
	    return  self::model()->find($criteria);
	    
    }
  
}
