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
class Category extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public $fields;
    public function tableName()
    {
        return 'mw_category';
    }
    public function getPrimaryField(){
		 return 'category_id';
	 }
    public $used_in;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_name,used_in', 'required'),
            array('section_id, priority', 'numerical', 'integerOnly'=>true),
            array('category_name,image,active_image', 'length', 'max'=>250),
            array('image,active_image', 'file', 'types'=>'jpg,jpeg, gif,svg, png,ico','allowEmpty'=>true),
            array('category_name', 'unique'),
             array('use_dev,plural', 'safe'),
            array('amenities_required', 'length', 'max'=>1),
            array('isTrash, status', 'length', 'max'=>1),
            array('modified_date,xml_inserted,search_keyword,h_bd,h_bth,h_in,h_p_limits,h_is_mor,h_r_facade,h_rights,h_may_affect,h_disputes,h_expiry_date,h_l_no,h_plan_no,h_no_of_u,h_floor_no,h_unit_no,h_selling_price', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id, section_id, category_name, priority, isTrash, status, added_date, modified_date,slug', 'safe', 'on'=>'search'),
        );
    }
    public function getCategoryImages(){
         $html='';
        if(!empty($this->image)){
        $html .='<img src="'.Yii::App()->apps->getBaseUrl('uploads/category/'.$this->image).'" style="width:30px;background:#eee" />';
        }
         if(!empty($this->active_image)){
        $html .=' <img src="'.Yii::App()->apps->getBaseUrl('uploads/category/'.$this->active_image).'" style="width:30px;background:#eee" />';
        }
        return $html;
    }
    
public function beforeSave(){
	   parent::beforeSave();
	   $this->f_type = 'P';
	   return true;
	}
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        if(isset(Yii::app()->request->cookies['country']) and isset(Yii::app()->request->cookies['state'])  and  Yii::app()->request->cookies['state']->value!=0)
        {
			 $condition = array(self::STAT, 'PlaceAnAd', 'category_id','condition'=>"t.isTrash='0' and t.status='A' and t.country=:con and t.state=:state",  'params'=>array(':con'=>Yii::app()->request->cookies['country'],':state'=>Yii::app()->request->cookies['state']));
	
			//$condition = array(self::STAT, 'PlaceAnAd', 'category_id','join' => 'INNER JOIN mw_ad_amenities ON t.id = mw_ad_amenities.ad_id','condition'=>"t.isTrash='0' and t.status='A' and t.country=:con and t.state=:state",  'params'=>array(':con'=>Yii::app()->request->cookies['country']->value,':state'=>Yii::app()->request->cookies['state']->value));
		}
		else if(isset(Yii::app()->request->cookies['country']) and isset(Yii::app()->request->cookies['state'])  and  Yii::app()->request->cookies['state']->value==0)
		{
			$condition = array(self::STAT, 'PlaceAnAd', 'category_id','condition'=>"t.isTrash='0' and t.status='A' and t.country=:con",  'params'=>array(':con'=>Yii::app()->request->cookies['country']));
	
		}
		else
		{
		    $condition = array(self::STAT, 'PlaceAnAd', 'category_id','condition'=>"t.isTrash='0' and t.status='A'");
	
		}
		 

        return array(
			'listTypes' => array(self::HAS_MANY, 'ListingTypeFilelds', 'category_id'),
            'section' => array(self::BELONGS_TO, 'Section', 'section_id'),
            'relatedFields' => array(self::HAS_MANY, 'CategoryFieldList', 'category_id'),
            'relatedFieldsMandatory' => array(self::HAS_MANY, 'CategoryFieldListManadatory', 'category_id'),
            'amenitiesCategoryLists' => array(self::HAS_MANY, 'AmenitiesCategoryList', 'category_id'),
            'categoryFieldLists' => array(self::HAS_MANY, 'CategoryFieldList', 'category_id'),
            'searchLists' => array(self::HAS_MANY, 'Searchlist', 'category_id',"condition"=>'searchLists.user_id=:id','params'=>array(":id"=>Yii::app()->user->getId())),
            'watchlists' => array(self::HAS_MANY, 'Watchlist', 'category_id',"condition"=>'watchlists.user_id=:id','params'=>array(":id"=>Yii::app()->user->getId())),
            'placeAnAds' => array(self::HAS_MANY, 'PlaceAnAd', 'category_id'),
            'MyAds' => array(self::HAS_MANY, 'PlaceAnAd', 'category_id','on'=>"user_id=:usr and MyAds.isTrash='0'","order"=>"MyAds.id desc","params"=>array(":usr"=>Yii::app()->user->getId())),
            'subcategories' => array(self::HAS_MANY, 'Subcategory', 'category_id','on'=>"subcategories.isTrash='0' and subcategories.status='A'","order"=>"subcategories.sub_category_name"),
            
            'adsCount' => $condition,
           
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
            'use_dev' =>'New Development Property type',
            'section_id' => 'Section',
            'category_name' => 'Category Name',
            'priority' => 'Priority',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'added_date' => 'Added Date',
            'modified_date' => 'Modified Date',
                'h_bd' => 'Hide Bed Field',
            'h_bth' => 'Hide Bath Field',
            'h_in' => 'Hide Interior Size Field',
             'h_is_mor' => 'Hide Is there a mortgage or restriction that prevents or limits the use of the property',
            'h_rights' => 'Hide Rights and obligations over real estate that are not documented in the real estate document',
            'h_r_facade' => 'Hide Real_Estate_Facade',
            'h_may_affect' => 'Hide Information that may affect the property',
            'h_disputes' => 'Hide Furnished',
            'h_expiry_date' => 'Hide Construction date',
			'h_l_no'=>$this->mTag()->getTag('h_l_no','Hide Land_Number') ,
			'h_plan_no'=>$this->mTag()->getTag('h_plan_no','Hide Plan Number') ,
			'h_no_of_u'=>$this->mTag()->getTag('h_no_of_u','Hide Number Of Units') ,
			'h_floor_no'=>$this->mTag()->getTag('h_floor_no','Hide Floor_Number') ,
			'h_unit_no'=>$this->mTag()->getTag('h_unit_no','Hide Unit_Number') ,
			'h_selling_price'=>'Hide Selling Meter Price',
			'h_p_limits' => 'Hide Property limits and lenghts',
        );
    }
    public function listingTypeArray(){
		return array('H'=>'Homes','P'=>'Plots','C'=>'Commercial');
	}
    public function listingTypeArrayMain(){
		return array('0'=>'Listing Type',array('id'=>'H','name'=>'Homes'),array('id'=>'P','name'=>'Plots'),array('id'=>'C','name'=>'Commercial'));
	}
	public function listDatalangMain()
    {	
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' " ;
		 $criteria->select = "t.category_id,t.category_name";
		 
		 $criteria->order="priority asc,t.category_name asc";
		 return $this->findAll($criteria);
	}
    public function listingTypeArrayMainData(){
		$ar = $this->listingTypeArrayMain();
		unset($ar [0]);
		$array = array();  
		foreach($ar as $ars){
			
		$array[$ars['id']]	 = $ars['name'];
		}
		return $array;
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('listing_type',$this->listing_type);
        $criteria->compare('section_id',$this->section_id);
        $criteria->compare('category_name',$this->category_name,true);
        $criteria->compare('isTrash',0);
        $criteria->compare('status','A');
        $criteria->compare('f_type  !','C');
        $criteria->order="t.category_id desc   ";

       return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
   public function getCategoryOne($id=null)
	{
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition="t.isTrash='0' and t.status='A' and t.category_id=:id";
		 $criteria->params[':id']=$id;
		return $this->find($criteria) ;
		 
	}
   public function getCategoryFromSlug($slug=null)
	{
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition="t.isTrash='0' and t.status='A' and t.slug=:slug";
		 $criteria->params[':slug']=$slug;
		return $this->find($criteria) ;
		 
	}
    public function FindCategory($id=null,$state=null,$keyword=null)
	{
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and t.category_id=:category_id";
		 if($keyword=="" and $state!="")
		 {
			 $condition = "t.state =:state";
			 $params     = array(":state"=>$state);
		 }
		 else
		 {
			 if($state!="")
			 {
			 $condition = "t.state =:state and   ( t.ad_title like :keyword or t.ad_description like :keyword )";
			 $params     = array(":state"=>$state,":keyword"=>"%{$keyword}%");
		     }
		     else
		     {
				 $condition = " ( t.ad_title like :keyword or t.ad_description like :keyword )";
				 $params     = array(":keyword"=>"%{$keyword}%");
			 }
		 }
		 $criteria->with = array("subcategories","subcategories.adsCount"=>array("condition"=>$condition,"params"=> $params ));
		 
		 $criteria->params[":category_id"] = $id ; 
		 return $this->find($criteria);
	}
    public function FindCategory2($search,$catid,$amenities=array())
	{
		//print_r($search);exit;
		//  print_r($search);exit;
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and t.category_id=:category_id";
		// $criteria->join =" INNER JOIN `mw_ad_amenities` `adAmenities` ON (`adAmenities`.`ad_id`=`t`.`id`)";
		 if(!empty($amenities))
		 {
		 //	 echo "SDS";exit;
		 $list =  implode(',',$amenities);
		// echo $list;exit;
		 $criteria->with = array("subcategories","subcategories.adsCount"=>array('join' => "INNER JOIN `mw_ad_amenities` `adAmenities` ON (`adAmenities`.`ad_id`=`t`.`id`)", "condition"=>$search['condition']." and  (	amenities_id in ({$list}))","params"=> $search['params'],"group"=>"amenities_id"));
	     $criteria->together=true;
	  
	     }
	     else
	     {
			  $criteria->with = array("subcategories","subcategories.adsCount"=>array("condition"=>$search['condition'],"params"=> $search['params']));
	   
		 }
		 $criteria->params[":category_id"] = $catid;
		 return $this->find($criteria);
	}
    public function FindCategoryies($search=array(),$keyword=null,$section="")
	{
		 
		 //print_r( $search);exit;
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A'";
		 if($section !="")
		 {
			  $criteria->condition .= " and t.section_id = {$section}" ; 
		 }
		 $criteria->with = array("adsCount"=>array("condition"=>$search['condition'],"params"=>$search['params']));
		 return $this->findAll($criteria);
	}
    public function FindCategoryies2($state=null,$keyword=null)
	{
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A'";
		 if($keyword=="")
		 {
			 $condition = "t.state =:state";
			 $params     = array(":state"=>$state);
		 }
		 else
		 {
			 $condition = "t.state =:state and   ( t.ad_title like :keyword or t.ad_description like :keyword ) ";
			 $params     = array(":state"=>$state,":keyword"=>"%{$keyword}%");
		 }
		 $criteria->with = array("adsCount"=>array("condition"=> $condition,"params"=> $params ));
		 return $this->findAll($criteria);
	}
    public function getCatgeory($id)
	{
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and category_id=:id";
		 $criteria->params[":id"] = $id ; 
		 return $this->find($criteria);
	}
	public function  ListDataWithSection($id=null)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'  ";
		 $criteria->params[":section"] = $id ; 
		 $criteria->order="category_name";
		  return $this->findAll($criteria);
	}
	public function  ListDataTypeForJSON_ID()
    {
	 
	     $ar = $this->listingTypeArrayMain();
		 return CJSON::encode(  $ar );
	}
	public function  ListDataWithAmenities()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' and amenities_required=:req";
		 $criteria->params[":req"] = 'Y' ; 
		 $criteria->order="category_name";
		 return $this->findAll($criteria);
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    	function getCategory()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' and t.status='A'" ,"order"=>"category_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->category_id] =  $v->category_name; 
			 }
	     }
	     return $_options;
		 
	}
	public function  ListData()
    {
        $criteria->select  =  't.category_id,category_name';
		 $criteria=new CDbCriteria;
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 $criteria->order="priority";
		 return $this->findAll($criteria);
	}

	public function  ListDataForJSON()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 $criteria->params[":req"] = 'Y' ; 
		 $criteria->order="priority";
		 return CJSON::encode(array_merge(array("0"=>"Select Category"),CHtml::listData($this->findAll($criteria),"category_id","category_name")));
	}
	public function  ListDataForJSON_ID()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 $criteria->params[":req"] = 'Y' ; 
		 $criteria->order="priority";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->category_id , "name" => $v->category_name );
			 }
		 }
		 return CJSON::encode(array_merge(array("0"=>"Select Category"), $ar));
	}
	public function YesNoArray()
    {
		return array("N"=>"NO","Y"=>"YES");
	}
	public function  ListDataForJSON_ID_BySEction($section)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		  $criteria->params[":section"] = $section;
		 $criteria->select ="category_id,category_name";
		 $criteria->order="category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->category_id , "name" => $v->category_name );
			 }
		 }
		 return CJSON::encode(array_merge(array("0"=>"Select Category"), $ar));
	}
	public function  ListDataForJSON_ID_ALL()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0'  ";
		 $criteria->select ="category_id,category_name";
		 $criteria->order="category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[$v->category_id]=  $v->category_name ;
			 }
		 }
		 return   $ar ;
	}
	public function  ListDataForJSON_ID_BySEctionNewModel($section)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		  $criteria->params[":section"] =  $section;
		 $criteria->select ="category_id,category_name";
		 $criteria->order="-t.priority desc , category_name";
		 return  $this->findAll($criteria);
	}
	public function getPropertyCount() {
		return PlaceAnAd::model()->count('category_id=:category_id', [':category_id' => $this->category_id]);
	}
	
	public function  ListDataForJSON_ID_BySEctionNewdevelopment($section,$slug=false)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 // $criteria->condition = "t.isTrash='0'  and t.f_type='C'  ";
		 
		// $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section ";
	
		 $criteria->condition = "t.isTrash='0' and t.f_type='P' and  (ls.category_id is not null or use_dev='1' )  ";
		 
		 $criteria->join  = " LEFT JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section ";
		 $criteria->params[":section"] = $section;
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.category_id,t.category_name,t.slug";
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		 if(!empty($array_format)){
		     $ar =array();
		     foreach($arra as $k=>$v)
			 {
			 	 $ar[$v->category_id]=   array('name'=>$v->category_name,'slug'=>$v->slug)   ;
			 }
			 return $ar;
		 }
		 $sec_desend ='';
		 
		 $ar =array();
		 if($arra)
		 {
		     $field = 'category_id';
		     if(!empty($slug)){
		      $field = 'slug';   
		     }
			 foreach($arra as $k=>$v)
			 {
				  
				 $ar[$v->$field]=   $v->category_name  ;
			 }
		 }
		 if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		     
		 return $ar ;
	}
	public function  ListDataForJSON_ID_BySEctionNewdevelopmentNew($section,$slug=false)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		//  $criteria->condition = "t.isTrash='0'  and  ";
		 
		// $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section ";
	
		 $criteria->condition = "t.isTrash='0' and t.f_type='C' and (ls.category_id is not null or use_dev='1' )  ";
		 
		 $criteria->join  = " LEFT JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section ";
		 $criteria->params[":section"] = $section;
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.category_id,t.category_name,t.slug";
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
		}else{
			$criteria->select .= ' ,t.category_name';
		}
		$criteria->order="-t.priority desc , t.category_name";
		$arra =  $this->findAll($criteria);
		if(!empty($array_format)){
			$ar =array();
			foreach($arra as $k=>$v)
			{
				$ar[$v->category_id]=   array('name'=>$v->category_name,'slug'=>$v->slug)   ;
			}
			return $ar;
		}
		$sec_desend ='';
		
		$ar =array();
		if($arra)
		{
			$field = 'category_id';
			if(!empty($slug)){
			$field = 'slug';   
			}
			foreach($arra as $k=>$v)
			{
				
				$ar[$v->$field]=   $v->category_name  ;
			}
		}
		if(!empty( $sec_desend)){  
			foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		}
			
		return $ar ;
	}
		public function  ListDataForJSON_ID_BySEctionNewProperty($section,$slug=false)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 // $criteria->condition = "t.isTrash='0'  and t.f_type='C'  ";
		 
		// $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id in :section ";
	
		 $criteria->condition = "t.isTrash='0' and  (ls.category_id is not null or use_dev='1' ) and ls.section_id in (1,2,3,4,5)";
		 
		 $criteria->join  = " LEFT JOIN {{listing_section}} ls on ls.category_id = t.category_id ";

		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.category_id,t.category_name,t.slug";
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
	
		 if($arra)
		 {
		     $field = 'category_id';
		     if(!empty($slug)){
		      $field = 'slug';   
		     }
			 foreach($arra as $k=>$v)
			 {
				  
				 $ar[$v->$field]=   $v->category_name  ;
			 }
		 }
		 if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		     
		 return $ar ;
	}
	public function  ListDataForJSON_ID_BySEctionNew($section,$array_format=false)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
	 $criteria->condition = "t.isTrash='0'  and t.f_type='C' and t.category_id != '200' ";
		 
	  $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section ";
	
	//	 $criteria->condition = "t.isTrash='0' and  (ls.category_id is not null or use_dev='1' )  ";
		 
		// $criteria->join  = " LEFT JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section ";
		 $criteria->params[":section"] = $section;
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.category_id,t.category_name,t.slug";
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		 if(!empty($array_format)){
		     $ar =array();
		     foreach($arra as $k=>$v)
			 {
			 	 $ar[$v->category_id]=   array('name'=>$v->category_name,'slug'=>$v->slug)   ;
			 }
			 return $ar;
		 }
		 $sec_desend ='';
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 if($section=='2' and $v->category_id == '121'){
					  $sec_desend[$v->category_id] = $v->category_name;
					 continue;
				 }
				 $ar[$v->category_id]=   $v->category_name  ;
			 }
		 }
		 if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		     
		 return $ar ;
	}
	public function  ListDataForJSON_ID_ByListingType($listing_type)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'   ";
		 
		 $criteria->join  = " INNER JOIN {{listing_type_filelds}} ls on ls.category_id = t.category_id and ls.listing_type =  :listing_type ";
		 $criteria->params[":listing_type"] = $listing_type;
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.category_id,t.category_name";
		  if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $sec_desend ='';
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 if($section=='2' and $v->category_id == '121'){
					  $sec_desend[$v->category_id] = $v->category_name;
					 continue;
				 }
				 $ar[$v->category_id]=   $v->category_name  ;
			 }
		 }
		 if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		     
		 return $ar ;
	}
	public $type_field;
	public function  ListDataForJSON_ID_ByListingType2($listing_type)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'   ";
		 
		 $criteria->join  = " INNER JOIN {{listing_type_filelds}} ls on ls.category_id = t.category_id and ls.listing_type =  :listing_type ";
		 $criteria->params[":listing_type"] = $listing_type;
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.category_id,t.category_name,t.plural,t.slug,ls.listing_type as type_field";
		  if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate` `translate` on ( translate.source_tag = concat("Category_category_name_","",t.category_id) ) left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id  and  translationRelation.translate_id = translate.translate_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->join  .= '  left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Category_plural_","",t.category_id) )  left join `mw_translate_relation` `translationRelationP` on translationRelationP.category_id = t.category_id  and  translationRelationP.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdataP ON (`translationRelationP`.translate_id=tdataP.translation_id and tdataP.lang=:lan) ';
	
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ,CASE WHEN tdataP.message IS NOT NULL THEN    tdataP.message ELSE t.plural END  AS plural ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 return   $this->findAll($criteria);
		   
	}
	
	public function  ListDataForJSON_ID_BySEctionSlugNew($section)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'   ";
		 if(!empty($section)){
			 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id  ";
			 $criteria->join  .= " INNER JOIN {{section}} sc on ls.section_id = sc.section_id and sc.slug =  :section ";
			 $criteria->params[":section"] = $section;
		 }
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.category_id,t.category_name";
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		   
		 $sec_desend ='';
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 if($section=='property-for-rent' and $v->category_id == '121'){
					  $sec_desend[$v->category_id] = $v->category_name;
					 continue;
				 }
				 $ar[$v->category_id]=   $v->category_name  ;
			 }
		 }
		  if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		 return $ar ;
	}
	
	public function  ListDataTypeForJSON_ID2()
    {
	 
	     $ar = $this->listingTypeArray();
	     unset($ar['B']); 
		 $ar1 = array()  ;
		 foreach($ar as $k=>$v){
			 $ar1[] = array('id'=>$k, 'name'=>$v) ;  
		 }
		 return $ar1;
	}
	public function  ListDataForJSON_ID_BySEction2($section)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		  $criteria->params[":section"] = $section;
		 $criteria->select ="category_id,category_name,image,active_image";
		 $criteria->order="category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->category_id , "name" => $v->category_name , 'image'=>$v->ImageTitle, 'active_image' => $v->ActiveImageTitle );
			 }
		 }
		 return  $ar ;
	}
		public function getImageTitle(){
		if(!empty($this->image)){
			return Yii::app()->apps->getBaseUrl('uploads/default/'.$this->image,true);
		}
		else{
			return Yii::app()->apps->getBaseUrl('uploads/default/default_category.png',true);
		}
	}
	public function getActiveImageTitle(){
		if(!empty($this->active_image)){
			return Yii::app()->apps->getBaseUrl('uploads/default/'.$this->active_image,true);
		}
		else{
			return Yii::app()->apps->getBaseUrl('uploads/default/default_category_active.png',true);
		}
	}
	public function getListing_typeTitle(){
		$ar =  Category::model()->listingTypeArrayMainData() ;
		return isset($ar[$this->listing_type]) ? $ar[$this->listing_type] : '' ; 
	}
	public function categoryIdLan($category_id=null)
    {	
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' and t.category_id = :category_id " ;
		 $criteria->select = "t.category_id,category_name ,plural";$criteria->params[':category_id'] = $category_id;
		   if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
		     	$criteria->join  .= ' left join `mw_translate` `translate` on ( translate.source_tag = concat("Category_category_name_","",t.category_id) ) left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id  and  translationRelation.translate_id = translate.translate_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
		
		 	$criteria->join  .= '  left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Category_plural_","",t.category_id) )  left join `mw_translate_relation` `translationRelationP` on translationRelationP.category_id = t.category_id  and  translationRelationP.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdataP ON (`translationRelationP`.translate_id=tdataP.translation_id and tdataP.lang=:lan) ';
	    	$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ,CASE WHEN tdataP.message IS NOT NULL THEN    tdataP.message ELSE t.plural END  AS plural ';
	    	}
		 
		 return $this->find($criteria);
	}
	   public function afterSave(){
		parent::aftersave();
		if(!$this->isNewRecord){
				ListingTypeFilelds::model()->deleteAllByAttributes(array('category_id'=>$this->category_id));
		}
		
		if(!empty($this->used_in)){
			$types = new  ListingTypeFilelds() ; 
			 
			foreach($this->used_in as $val){
					$types->isNewRecord = true; 
					$types->category_id = $this->category_id;
					$types->listing_type = $val;
					$types->save();
				}  
		}
		 
		return true; 
	}
	public function  ListDataForJSON_ID_BySEctionNewSlugCache($section=null){
		$cacheKey =  'category_cache130'.Yii::app()->options->get('system.common.category_cache','12').$section;
		if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
		if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) {
			
			 return $items;
		}  
		 
		$items = $this->ListDataForJSON_ID_BySEctionNewSlug($section);
		Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
	}
	
	public function  ListDataForJSON_ID_BySEctionNewSlugCacheNew($section=null){
		// $cacheKey =  'category_cache1306'.Yii::app()->options->get('system.common.category_cache','12').$section;
		// if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
		// if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) {
			
		// 	 return $items;
		// }  
		 
		$items = $this->ListDataForJSON_ID_BySEctionNewSlugNew($section);
		// Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
	}
		public function  ListDataForJSON_ID_BySEctionNewSlugNew($section)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'   ";
		 
		 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section and t.f_type='C' ";
		 $criteria->params[":section"] = $section;
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.slug,t.category_id";
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $sec_desend = array();
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $results =  Category::model()->ListDataForJSON_ID_ByListingType2($v->primaryKey);
				 if($results){
					$ar[$v->category_name][$v->slug] = Yii::t('app', $this->mTag()->getTag('all_of_{type}','All {type}'),array('{type}'=>$v->category_name));
					 foreach($results as $k2=>$v2){
						$ar[$v->category_name][$v2->slug] = $v2->category_name;

					 }
					 
					 }
					 else{
						 $ar[$v->slug] =  $v->category_name  ;
					 }
				 
			 }
		 }
	 
		 if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		     
		 return $ar ;
	}
	public function  ListDataForJSON_ID_BySEctionNewSlug($section)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'   ";
		 
		 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section and t.f_type='C' ";
		 $criteria->params[":section"] = $section;
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.slug,t.category_id";
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $sec_desend = array();
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $results =  Category::model()->ListDataForJSON_ID_ByListingType2($v->primaryKey);
				 if($results){
					$ar[$v->category_name][$v->slug] = Yii::t('app', $this->mTag()->getTag('all_of_{type}','All {type}'),array('{type}'=>$v->category_name));
					 foreach($results as $k2=>$v2){
						$ar[$v->category_name][$v->slug.'_'.$v2->slug] = $v2->category_name;

					 }
					 
					 }
					 else{
						 $ar[$v->slug] =  $v->category_name  ;
					 }
				 
			 }
		 }
	 
		 if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		     
		 return $ar ;
	}
	public function  ListDataForJSON_ID_BySEctionNewSlugNtCache($section){
		// $cacheKey =  'category_cacheslug1291'.Yii::app()->options->get('system.common.category_cache','12').$section;
		// if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
		// if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) {
			
		// 	 return $items;
		// }  
		$items = $this->ListDataForJSON_ID_BySEctionNewSlugNt($section);
		// Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
	}
	public function  ListDataForJSON_ID_BySEctionNewSlugNtCacheWithId($section=null){
		$cacheKey =  'category_cacheslug12911ids1'.Yii::app()->options->get('system.common.category_cache','12').$section;
		if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
		if ($items = Yii::app()->cache->get($cacheKey) and !isset($_GET['refresh'])) {
			
			 return $items;
		}  
		$arra = self::model()->ListDataForJSON_ID_BySEctionNewSlugNtNEw($section,1);

		$items = array();
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
			     
			     	 
				 $results =  Category::model()->ListDataForJSON_ID_ByListingType2($v->primaryKey);
			 	
				/*
				   $criteria=new CDbCriteria;
		  
		 $criteria->condition = "t.isTrash='0'   ";
		 
		 //$criteria->join  = " INNER JOIN {{listing_type_filelds}} ls on ls.category_id = t.category_id and ls.category_id =  :listing_type ";
		  $criteria->join  .= " INNER JOIN {{category}} ca on ca.category_id = :listing_type  ";
		
		 $criteria->params[":listing_type"] = $v->category_id;
		  
		 $criteria->select ="ca.slug"; 
		 $results =    $this->findAll($criteria);
				 */
				 
				 
				 
				 if($results){
				 	 foreach($results as $k2=>$v2){
				 	    $parent_slug =  Category::model()->findByPk($v2->type_field);
						$ar[$v2->category_id] = array('slug'=> $v2->slug , 'parent'=>$parent_slug->slug,   'name' =>  $v2->PluralName);

					 }
					 
					 } 
				 
			 }
		 }
 
		 //business -sale --> 
		   $category =    Category::model()->ListDataForJSON_ID_BySEctionNew('6','1') ;
		   if($category){
		       foreach($category as $km=>$vm){
		           $ar[$km] =$vm;
		       }
		   }
		    
							 
		Yii::app()->cache->set($cacheKey, $ar,60 * 60 * 24 * 360  );
		return $ar; 
	}
	public function getPluralName(){
	    return !empty($this->plural) ? $this->plural : $this->category_name; 
	}
	public function  ListDataForJSON_ID_BySEctionNewSlugNtNEw($section=null,$out=null)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'   ";
		 
		 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id   ";
		 if(!empty($section)){
		  $criteria->join  .= " INNER JOIN {{section}} sc on ls.section_id = sc.section_id and sc.slug =  :section ";
			 $criteria->params[":section"] = $section;
		 $criteria->params[":section"] = $section;
		 }
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.slug,t.category_id";
		  if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		   return  $arra;  
    }
	public function  ListDataForJSON_ID_BySEctionNewSlugNt($section=null,$out=null)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'   ";
		 
		 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id   and t.f_type='C' ";
		 if(!empty($section)){
		  $criteria->join  .= " INNER JOIN {{section}} sc on ls.section_id = sc.section_id and sc.slug =  :section ";
			 $criteria->params[":section"] = $section;
		 $criteria->params[":section"] = $section;
		 }
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.slug,t.category_id";
		  if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		 if($out) { return  $arra; }
		 $sec_desend = array();
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $results =  Category::model()->ListDataForJSON_ID_ByListingType2($v->primaryKey);
				 if($results){
					$ar[$v->category_name][$v->slug] = Yii::t('app',$this->mTag()->getTag('all_of_{type}','All {type}'),array('{type}'=>$v->category_name));
					 foreach($results as $k2=>$v2){
						$ar[$v->category_name][$v->slug.'_'.$v2->slug] = $v2->category_name;

					 }
					 
					 }
					 else{
						 $ar[$v->slug] =  $v->category_name  ;
					 }
				 
			 }
		 }
	 
		 if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		     
		 return $ar ;
	}
	public function  ListDataForJSON_ID_BySEctionSlugNewN($section)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'   ";
		 if(!empty($section)){
			 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id  ";
			 $criteria->join  .= " INNER JOIN {{section}} sc on ls.section_id = sc.section_id and sc.slug =  :section ";
			 $criteria->params[":section"] = $section;
		 }
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.category_id,t.slug,t.category_name";
		 	 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		   
		 $sec_desend ='';
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 if($section=='Rent' and $v->category_id == '121'){
					  $sec_desend[$v->slug] = $v->category_name;
					 continue;
				 }
				 $ar[$v->slug]=   $v->category_name  ;
			 }
		 }
		  if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		 return $ar ;
	}
	public function categorySlugLan($category_id=null)
    {	
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' and t.slug = :category_id " ;
		 $criteria->select = "t.category_id ";$criteria->params[':category_id'] = $category_id;
		   if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
		 	$criteria->join  .= ' left join `mw_translate` `translate` on ( translate.source_tag = concat("Category_category_name_","",t.category_id) ) left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id  and  translationRelation.translate_id = translate.translate_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
		
		 		$criteria->join  .= '  left join `mw_translate` `translate1` on ( translate1.source_tag = concat("Category_plural_","",t.category_id) )  left join `mw_translate_relation` `translationRelationP` on translationRelationP.category_id = t.category_id  and  translationRelationP.translate_id = translate1.translate_id  LEFT  JOIN mw_translation_data tdataP ON (`translationRelationP`.translate_id=tdataP.translation_id and tdataP.lang=:lan) ';
	    	$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ,CASE WHEN tdataP.message IS NOT NULL THEN    tdataP.message ELSE t.plural END  AS plural ';
	    
			}
			else{
				$criteria->select .= ' ,t.category_name';
					$criteria->select .= ' ,t.plural';
			}
		 return $this->find($criteria);
	}
	public function findByCategoryName($category){
		$criteria=new CDbCriteria;
		$criteria->condition = ' TRIM(LOWER(t.category_name)) like  :category_name and t.isTrash="0" and status="A"  ';
		$criteria->params[":category_name"] = '%'.trim(strtolower($category)).'%';
		return $this->find($criteria);
	 }
	 public $score;
	 public function searchCategory($keyword)
	{
		 $criteria=new CDbCriteria;
	 
		 
		 $criteria->select = 't.category_id,t.category_name, MATCH(t.category_name,t.search_keyword) AGAINST( :word IN BOOLEAN MODE)   as score       '; 
		 $criteria->condition = "   MATCH(t.category_name,t.search_keyword) AGAINST(:word IN BOOLEAN MODE) > 0  "; 
		 $criteria->params[':word'] =  $keyword.'*' ;
	 
		 $criteria->limit = 10;
		$criteria->order  = 'score asc';
		 
		  $data =  $this->findAll($criteria);
		   	$cities_chances =   CHtml::listData($data,'category_id','category_name');
			
		   $nearest_city = '';
		   /*
		  if($data){
			 
			$cities_chances =   CHtml::listData($data,'category_id','category_name');
			
			 
			foreach($cities_chances as $city_id => $city){
				
					 if(strpos($keyword, trim(strtolower($city))) !== false){
				 
						  return   strtolower($city); 
						 //   $nearest_city .= $city_id.',';
					  }
				 	   
						 
					   
		    }
		} */
		if(!empty( $data)) { return implode('-',array_keys($cities_chances));  }
		if(!empty($nearest_city)){
			return rtrim($nearest_city,',');
		}
		return $nearest_city;
	}
	public function  all_categories_list()
    {
		$cacheKey =  'all_category_list1'.Yii::app()->options->get('system.common.category_cache','12');
		if(defined('LANGUAGE')){$cacheKey .= LANGUAGE ;   }
		if ($items = Yii::app()->cache->get($cacheKey)) {
			 return $items;
		}  
		
		
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0'   ";
		 $criteria->select ="t.slug,t.category_id";
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
				$criteria->params[':lan'] = LANGUAGE;
				$criteria->distinct = 't.category_id'; 
				$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
				$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
		 }
		 else{
				$criteria->select .= ' ,t.category_name';
		 }
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		 $items =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 	  	$items[$v->category_id]  = $v->category_name;

					  
			 }
		 } 
		Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		return $items; 
		  
	}
		public function  ListDataForJSON_ID_BySEctionNewSlugww($section)
    {
		 $criteria=new CDbCriteria;
		 //$criteria->condition = "t.isTrash='0' and t.listing_type in ('B',:section) ";
		 $criteria->condition = "t.isTrash='0'  and t.f_type='C' ";
		 
		 $criteria->join  = " INNER JOIN {{listing_section}} ls on ls.category_id = t.category_id and ls.section_id =  :section ";
		 $criteria->params[":section"] = $section;
		 
		// if(empty($section)){  $criteria->condition .= " and t.listing_type = :section " ; /* for blank*/ }
		//  $criteria->params[":section"] =  $section;
		
		 $criteria->select ="t.slug,t.category_name";
		 if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->distinct = 't.category_id'; 
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.category_id = t.category_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.category_name END  AS category_name ';
			}
			else{
				$criteria->select .= ' ,t.category_name';
			}
		 $criteria->order="-t.priority desc , t.category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $sec_desend ='';
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				  
				 $ar[$v->slug]=   $v->category_name  ;
			 }
		 }
		 if(!empty( $sec_desend)){  
		     foreach($sec_desend  as $k2=>$v2){ $ar[$k2]  = $v2; }
		 }
		     
		 return $ar ;
	}
	public $slug_str  ; 
	public function getSlugStr(){
	   return '<span class="lst-slug hide">'. $this->slug.'</span>'; 
	      
	}
}
