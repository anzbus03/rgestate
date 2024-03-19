<?php

/**
 * This is the model class for table "mw_category".
 *
 * The followings are the available columns in table 'mw_category':
 * @property integer $category_id
 * @property integer $section_id
 * @property string $category_name
 * @property integer $priority
 * @property string $isTrash
 * @property string $status
 * @property string $added_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property Section $section
 */
class MainCategory extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public $master_fields;
    public $fields;
    public $used_in;
    public $sub_image;
    public function tableName()
    {
        return 'mw_category';
    }

    /**
     * @return array validation rules for model attributes.
     */
     public $listing_countries;
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_name,used_in', 'required'),
            array('section_id, priority', 'numerical', 'integerOnly'=>true),
            array('category_name', 'length', 'max'=>250),
           // array('category_name', 'unique'),
            array('amenities_required', 'length', 'max'=>1),
            array('isTrash, status', 'length', 'max'=>1),
            array('listing_countries','safe'),
            //array('show_all','validateCountries'),
            array('modified_date,xml_inserted,f_type,plural_name,master_fields', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id, section_id, category_name, priority, isTrash, status, added_date, modified_date,slug', 'safe', 'on'=>'search'),
        );
    }
      public function validateCountries($attribute,$params){
	 
			if ( $this->show_all=='1'  and  empty($this->listing_countries)   ){
				$this->addError($attribute, 'Please select at least one country');
			}
		 
	}
	public function countryOption(){
		return array(
		'0' =>'All listing  countries',
		'1' =>'Only for selected countries',
		
		);
	}
    public function afterSave(){
		parent::aftersave();
		 
		ListingSection::model()->deleteAllByAttributes(array('category_id'=>$this->category_id));
		if(!empty($this->used_in)){
			$types = new  ListingSection() ; 
			 
			foreach($this->used_in as $val){
					$types->isNewRecord = true; 
					$types->category_id = $this->category_id;
					$types->section_id = $val;
					$types->save();
				} ; 
		}
	 
		return true; 
	}
    public function getPluralTitle(){
		return !empty($this->plural_name) ? $this->plural_name  :$this->category_name ; 
	}
	
	public function getPrimaryField(){
		return 'category_id';
	}
	public function getfullName(){
		return  !empty($this->category_other) ? $this->category_other :   $this->category_name;
	}
	public function beforeSave(){
	   parent::beforeSave();
	   $this->f_type = 'C';
	   return true;
	}
 
	 
	 
	
    /**
     * @return array relational rules.
     */
    public function relations()
    { 
 
             return array(
            'section' => array(self::BELONGS_TO, 'Section', 'section_id'),
            'relatedFields' => array(self::HAS_MANY, 'CategoryFieldList', 'category_id'),
            'relatedFieldsMandatory' => array(self::HAS_MANY, 'CategoryFieldListManadatory', 'category_id'),
            'amenitiesCategoryLists' => array(self::HAS_MANY, 'AmenitiesCategoryList', 'category_id'),
            'categoryFieldLists' => array(self::HAS_MANY, 'CategoryFieldList', 'category_id'),
            //'searchLists' => array(self::HAS_MANY, 'Searchlist', 'category_id',"condition"=>'searchLists.user_id=:id','params'=>array(":id"=>Yii::app()->user->getId())),
            //'watchlists' => array(self::HAS_MANY, 'Watchlist', 'category_id',"condition"=>'watchlists.user_id=:id','params'=>array(":id"=>Yii::app()->user->getId())),
            'placeAnAds' => array(self::HAS_MANY, 'PlaceAnAd', 'category_id'),
            //'MyAds' => array(self::HAS_MANY, 'PlaceAnAd', 'category_id','on'=>"user_id=:usr and MyAds.isTrash='0'","order"=>"MyAds.id desc","params"=>array(":usr"=>Yii::app()->user->getId())),
            'subcategories' => array(self::HAS_MANY, 'Subcategory', 'category_id','on'=>"subcategories.isTrash='0' and subcategories.status='A'","order"=>"subcategories.sub_category_name"),
            
			'listTypes' => array(self::HAS_MANY, 'ListingSection', 'category_id'),
			 'listCountries' => array(self::HAS_MANY, 'CategoryCountries', 'category_id'),
        );
    }
    public function behaviors(){
		 
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'category_name',
            
            'overwrite' => false
        ))
    );
  }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'category_id' => 'Category',
            'section_id' => 'Section',
            'category_name' => 'Category Name',
            'priority' => 'Priority',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'added_date' => 'Added Date',
            'modified_date' => 'Modified Date',
            'plural_name' => 'Plural Name[Eg. Buildings]',
        );
    }
    
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('section_id',$this->section_id);
        $criteria->compare('category_name',$this->category_name,true);
        $criteria->compare('f_type','C');
        $criteria->compare('isTrash',0);
        $criteria->compare('status','A',true);
        $criteria->order="category_name asc";

       return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
       public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function  ListData( )
    {	if(Yii::app()->isAppName('frontend')){
			$langaugae = OptionCommon::getLanguage();  
		}
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.f_type='C'   ";
		 $criteria->select ="t.category_id,category_name,slug";
		 $criteria->order="category_name";
		return   $this->findAll($criteria);
	}
		public function  ListDataForJSON_ID_BySEction($section=null,$json=true,$country=null)
    {	
		 
		if(Yii::app()->isAppName('frontend')){
			$langaugae = OptionCommon::getLanguage();  
		}
		 $criteria=new CDbCriteria;
		 
			 $criteria->condition = "t.isTrash='0' and t.f_type='C'  ";
			 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section ";
		 
		 
		 $criteria->params[":section"] = $section;
		  
		 $criteria->select ="t.category_id,category_name,slug";
		 
		
		 $criteria->distinct = 't.category_id';
		 $criteria->order = '-t.priority desc,category_name asc ';
		 if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,tdata.message as  category_other  ';
		 }
		    
		 
		// $criteria->order="category_name";
		 $arra =  $this->findAll($criteria);
		 if(!$json){
			 return $arra;
		 }
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->category_id , "name" => !empty($v->category_other) ? $v->category_other :  $v->category_name );
			 }
		 }
		 return CJSON::encode(array_merge(array("0"=>Yii::App()->tags->getTag('select-category',"Select Category")), $ar));
	}
	
	public function  findMainCategories()
    {	
		 
		if(Yii::app()->isAppName('frontend')){
			$langaugae = OptionCommon::getLanguage();  
		}
		 $criteria=new CDbCriteria;
		 
			 $criteria->condition = "t.isTrash='0' and t.f_type='C'  ";
			 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id in  ('1','2') ";
		  
		  
		 $criteria->select ="t.category_id,category_name,slug";
		 
		
		 $criteria->distinct = 't.category_id';
		 $criteria->order = '-t.priority desc,category_name asc ';
		 if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,tdata.message as  category_other  ';
		 }
		    
		 
		// $criteria->order="category_name";
		return  $this->findAll($criteria);
		 
	}
		public function  findMainCategoriesBusiness()
    {	
		 
		if(Yii::app()->isAppName('frontend')){
			$langaugae = OptionCommon::getLanguage();  
		}
		 $criteria=new CDbCriteria;
		 
			 $criteria->condition = "t.isTrash='0' and t.f_type='C'  ";
			 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id in  ('6') ";
		  
		  
		 $criteria->select ="t.category_id,category_name,slug";
		 
		
		 $criteria->distinct = 't.category_id';
		 $criteria->order = '-t.priority desc,category_name asc ';
		 if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
		 }
		    
		 
		// $criteria->order="category_name";
		return  $this->findAll($criteria);
		 
	}
	public function generateOpt(){
	    $data = self::model()->findMainCategories( );$ar = array(); 
	    foreach($data as $k=>$v){
	        $sub =  Category::model()->ListDataForJSON_ID_ByListingType2($v->primaryKey);
	        if(!empty($sub)){
	            $sub_array = array();
	            foreach($sub as $k2=>$v2){
	                $sub_array[$v2->primaryKey] = $v2->category_name;
	            }
	            $ar[$v->category_name] = $sub_array; 
	        }else{
	                $ar[$v->primaryKey] = $v->category_name;
	        }
	    }
	    return $ar; 
	}
	 	public function generateOptBusiness(){
	    $data = self::model()->findMainCategoriesBusiness( );$ar = array(); 
	    foreach($data as $k=>$v){
	        $sub =  Category::model()->ListDataForJSON_ID_ByListingType2($v->primaryKey);
	        if(!empty($sub)){
	            $sub_array = array();
	            foreach($sub as $k2=>$v2){
	                $sub_array[$v2->primaryKey] = $v2->category_name;
	            }
	            $ar[$v->category_name] = $sub_array; 
	        }else{
	                $ar[$v->primaryKey] = $v->category_name;
	        }
	    }
	    return $ar; 
	}
	public function  category_property_type()
    {	
	    $criteria=new CDbCriteria;
	    $criteria->condition = "t.isTrash='0' and t.f_type in ('C','P')  ";
	    $criteria->select ="t.category_id,category_name,slug";
	    $criteria->order = 't.f_type="C" desc ,category_name asc ';
	    return  $this->findAll($criteria); 
	}
	public function  findProperties_category()
    {	
		 
	 
        $criteria=new CDbCriteria;
        $criteria->condition = "t.isTrash='0' and t.f_type='C'  ";
        $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id in  ('1','2') ";
        $criteria->select ="t.slug,t.category_id"; 
		$criteria->distinct = 't.category_id';
		$criteria->order = '-t.priority desc,category_name asc ';
		$data= $this->findAll($criteria);
		$items = array();
		foreach($data as $k=>$v){
		    $items[$v->slug]['slug'] = $v->slug; 
		    $criteria=new CDbCriteria;
		    $criteria->condition = "t.isTrash='0'   "; 
		    $criteria->join  = " INNER JOIN {{listing_type_filelds}} ls on ls.category_id = t.category_id and ls.listing_type =  :listing_type ";
		    $criteria->params[":listing_type"] = $v->category_id;
		    $data2 = $this->findAll($criteria);
		    foreach($data2 as $k2=>$v2){
		    $items[$v->slug]['items'][] = $v2->slug; 
		    }
		
		}
		return $items; 
		 
	}
}
