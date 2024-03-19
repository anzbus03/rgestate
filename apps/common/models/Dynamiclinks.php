<?php

/**
 * This is the model class for table "{{master}}".
 *
 * The followings are the available columns in table '{{master}}':
 * @property integer $master_id
 * @property string $name
 * @property string $f_type
 * @property string $status
 * @property string $is_trash
 * @property string $last_updated
 */
class Dynamiclinks extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
     const FTYPE = 'SL';
    public function tableName()
    {
        return '{{dynamic_links}}';
    }
	public function getParent_url_array(){
		return CHtml::listData(FooterCategory::model()->listDataall(),'master_id','FooterCategoryTitle') ;
	}
	public function footercategory(){
		return array('1'=>'Popular Searches Footer','2'=>'Footer','3'=>'Sale Quick links','4'=>'Rent Quick links');
	}
	public function getf_typeTitle(){
	    $ar = $this->footercategory();
	    return isset($ar[$this->f_type]) ? $ar[$this->f_type] : ''; 
	}
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name,f_type', 'required'),
            array('section_id','validateSection'),
            array('name', 'length', 'max'=>250),
            array('f_type', 'length', 'max'=>10),
            array('category_id,type_id,country_id,city_id,location_id,parent_id', 'safe' ),
            array('status, is_trash', 'length', 'max'=>1),
                  array('file_image', 'file', 'types'=>'jpg,jpeg, gif, png','allowEmpty'=>true,'on'=>'update'),
       
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('master_id, name, f_type, status, is_trash, last_updated', 'safe', 'on'=>'search'),
        );
    }
     public function getPrimaryField(){
		 return 'linkid';
	 }
    public function getUrlthis(){
        return 'javascript:void(0)';
    }
     public function validateSection($attribute,$params){
  
     if(!empty($this->parent_id)){ return true; }
		 
			if (empty($this->$attribute)){
				$this->addError($attribute,  Yii::t('app','{attribute} cannot be blank.',array('{attribute}'=>$this->getAttributeLabel($attribute))));
			}
			 
		 
	}
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'master_id' => 'Question',
            'section_id' => 'Section',
            'category_id' => 'Type',
            'type_id' => 'Category',
            'name' => 'Title',
            'f_type' => 'Footer Category',
            'status' => 'Status',
            'is_trash' => 'Is Trash',
            'last_updated' => 'Last Updated',
             'country_id' => 'Country',
              'city_id' => 'City',
               'location_id' => 'Location',
               'country_id' => 'Country',
               'parent_id' => 'Parent Category',
            'url' => ASKAAN_PATH,
        );
    }
    public function beforeSave(){
		parent::beforeSave();
		 
		return true; 
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
     
     public function getlistParent(){
          $criteria=new CDbCriteria;
          $criteria->order = 't.master_id desc';
          $criteria->condition = 't.parent_id is null';
          return CHtml::listData(self::model()->findAll($criteria),'master_id','name');
     }
      public function getlistParentBySectionChild($parent){
          $criteria=new CDbCriteria;
          $criteria->order = '-t.priority desc, t.master_id asc';
          $criteria->params[':con'] = COUNTRY_ID;$criteria->params[':parent_id'] = $parent;
          $criteria->condition = 't.parent_id   = :parent_id  and (t.country_id = null or t.country_id = :con)';
           $criteria->join = ' LEFT JOIN {{category}} lstType on lstType.category_id = t.category_id ';
          $criteria->join .= 'LEFT JOIN {{category}} category on category.category_id = t.type_id ';
          $criteria->join .= 'LEFT JOIN {{main_region}} city on city.region_id = t.city_id ';
          $criteria->join .= 'LEFT JOIN {{states}} location on location.state_id = t.location_id ';
          
      
            $criteria->select = 't.*,lstType.slug as type_slug,category.slug as category_slug,city.slug as city_slug,location.slug as location_slug';
         	$langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
	 
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("Dynamiclinks_name_",t.master_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.linkid = t.master_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
			    $criteria->distinct  ="t.master_id";
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.name END	 as  name   ';
				$criteria->group = 't.master_id';
		} 
          return   self::model()->findAll($criteria) ;
      }
      public $type_slug;public $category_slug;public $city_slug;public $location_slug;
       public function getlistParentBySection($section=null,$f_type=1){
           
           	$cookie_id = Yii::App()->options->get('system.common.foot_link','abcdef'); 
	 
		$cacheKey = 'footer-quicklink'.$section.$f_type. COUNTRY_ID.LANGUAGE . '_'.$cookie_id;	
		if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) {
		 
		 return   $items ; 
		}else{ 
		    
          $criteria=new CDbCriteria;
          $criteria->order = '-t.priority desc, t.master_id asc';
          $criteria->params[':con'] = COUNTRY_ID;$criteria->params[':section'] = $section;$criteria->params[':f_type'] = $f_type;
          $criteria->condition = 't.parent_id is null and t.section_id = :section  and (t.country_id = null or t.country_id = :con) and t.f_type=:f_type  ';
          
          $criteria->join = ' LEFT JOIN {{category}} lstType on lstType.category_id = t.category_id ';
          $criteria->join .= 'LEFT JOIN {{category}} category on category.category_id = t.type_id ';
          $criteria->join .= 'LEFT JOIN {{city}} city on city.city_id = t.city_id ';
          $criteria->join .= 'LEFT JOIN {{city}} location on location.city_id = t.location_id ';
          $criteria->select = 't.*,lstType.slug as type_slug,category.slug as category_slug,city.slug as city_slug,location.slug as location_slug';
         
         
         
		$langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
	 
		if(!empty($langaugae) and  $langaugae != 'en'){
				$criteria->params[':lan'] = $langaugae;
				$criteria->join  .= 'left join `mw_translate` `translate` on (  translate.source_tag = concat("Dynamiclinks_name_",t.master_id) )          left join `mw_translate_relation` `translationRelation` on translationRelation.linkid = t.master_id  and  translationRelation.translate_id = translate.translate_id  LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan  ) ';
			    $criteria->distinct  ="t.master_id";
				$criteria->select   .= ' , CASE WHEN tdata.message IS NOT NULL AND translate.source_tag IS NOT NULL    THEN  tdata.message ELSE t.name END	 as  name   ';
				$criteria->group = 't.master_id';
		} 
         
          $url = Yii::app()->createUrl('listing/index',$ar1);
      
          $items =   self::model()->findAll($criteria) ;
          $ar = array();
          foreach($items as $k=>$v){
               $ar[$v->master_id]['name'] =  Yii::t('app',$v->name,array(' Rent'=>''));
               $ar1 = array();
               switch($section){
                   case'1':
                        $ar1['sec'] = 'property-for-sale'; 
                       break;
                       case'2':
                            $ar1['sec'] = 'property-for-rent';
                       break;
               }
               
                
                if(!empty($v->type_slug)){ $ar1['category'] = $v->type_slug; }
                if(!empty($v->category_slug)){ $ar1['type_of'] = $v->category_slug; }
                if(!empty($v->city_slug)){ $ar1['reg'] = $v->city_slug; $ar1['state'] ='all'; }
                  $url = Yii::app()->createUrl('listing/index',$ar1);
                
               $ar[$v->master_id]['url'] =  $url;
               $sub = self::model()->getlistParentBySectionChild($v->master_id);
              
               if(!empty($sub)){
                   foreach($sub as $k2=>$v2){
                        $ar2 = $ar1;  
                      if(!empty($v2->type_slug)){ $ar2['category'] = $v2->type_slug; }
                        if(!empty($v2->category_slug)){ $ar2['type_of'] =  $v2->category_slug; }
                     if(!empty($v2->city_slug)){ $ar2['state'] = $v2->city_slug; }
                        if(!empty($v2->location_slug)){ $ar2['state'] = $v2->location_slug; }else if(!isset($ar2['state'])){$ar2['state'] = 'all';  }
                         $url2 = Yii::app()->createUrl('listing/index',$ar2);
                        // if(!empty($v2->location_slug)){ $url2 = $url2.'/location/'.$v2->location_slug; }
                       $ar[$v->master_id]['sub'][] = array('name'=>$v2->name,'url'=>$url2);
                   }
               }
          }
       
          Yii::app()->cache->set($cacheKey,$ar, 86400);   
          return $ar;
		}
     }
     public $parent_name;
     public function getnameWithParent(){
         if(empty($this->parent_id)){ 
              return "<span>".$this->name."</span>&nbsp;".$this->getTranslateHtml("name");
                           
             
             return $this->name; }
         else{
             return  $this->parent_name.' -> '."<span>".$this->name."</span>&nbsp;".$this->getTranslateHtml("name");
              
         }
     }
     
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;$criteria->condition = '1'; 
	$criteria->select ='t.*,dl.name as parent_name';
        $criteria->compare('t.master_id',$this->master_id);
        $criteria->compare('t.name',$this->name,true);
       $criteria->compare('t.f_type',$this->f_type);
        $criteria->compare('t.status',$this->status,true);
        $criteria->compare('t.is_trash',$this->is_trash);
        $criteria->compare('t.last_updated',$this->last_updated,true);
		$criteria->order = 't.master_id desc';	  
			$criteria->join  = ' LEFT JOIN {{dynamic_links}} dl on dl.master_id = t.parent_id ';
			$criteria->condition .= ' and t.f_type  in("1","2","3","4")  '; 
		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
    public $name_other ; 
	public function getFooterCategoryTitle(){
		 return !empty($this->name_other) ? $this->name_other : $this->name ;
	}
	public function  ListData( )
    {	 
		 $criteria=new CDbCriteria;
		  $langaugae = OptionCommon::getLanguage();  
		 if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
				 $criteria->select ="t.master_id,name";
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.master_id = t.master_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,tdata.message as  name_other  ';
		 }
		 $criteria->condition = "t.is_trash='0' and status='A' and  t.f_type= :ftype   ";
		 $criteria->params[':ftype'] = self::FTYPE;
	
		 $criteria->order="-t.priority desc ,name asc";
		return   $this->findAll($criteria);
	}
		public function  findSubLinksurl2($section_id=null,$listing_type=null,$category_id=null)
    {
        $country =  defined('COUNTRY_ID') ? COUNTRY_ID : ''; 
		 if(empty($listing_type) and !empty($section_id)){
			
			$data =  MainCategory::model()->ListDataForJSON_ID_BySEctionSub($section_id,$country);
			return $data;
			 
		 }
		 if(!empty($listing_type) ){
			
			$data =  Category::model()-> ListDataForJSON_ID_BySEctionSub($listing_type,$country,$section_id);
			return $data;
			 
		 }
    }
	public function  findSubLinksurl($section_id=null,$listing_type=null,$category_id=null)
    {	 
		 $criteria=new CDbCriteria;
		  $langaugae = OptionCommon::getLanguage();  
		 if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
				 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.master_id = t.master_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,tdata.message as  name_other  ';
		 }
		 
		 $criteria->condition = "t.is_trash='0' and status='A' and  t.f_type= :ftype and t.section_id = :section_id   ";
		 $criteria->params[':section_id']= $section_id ; 
		 
		 if(!empty($listing_type)){
			  $criteria->condition .= " and t.category_id = :listing_type ";   
			   $criteria->params[':listing_type']= $listing_type ; 
		 }
		 $criteria->params[':ftype'] = self::FTYPE;
	
		 $criteria->limit="3";
		 $criteria->order="-t.priority desc ,name asc";
		return   $this->findAll($criteria);
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Master the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function generateUrl(){
		if(!empty($this->url)){
			return ASKAAN_PATH.$this->url;
		}
		return '#';
	}
    public function getmasterTitle(){
		return $this->FooterCategoryTitle;
	}
}
