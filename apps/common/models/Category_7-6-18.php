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

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_name,listing_type', 'required'),
            array('section_id, priority', 'numerical', 'integerOnly'=>true),
            array('category_name', 'length', 'max'=>250),
            array('category_name', 'unique'),
            array('amenities_required', 'length', 'max'=>1),
            array('isTrash, status', 'length', 'max'=>1),
            array('modified_date,xml_inserted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id, section_id, category_name, priority, isTrash, status, added_date, modified_date,slug', 'safe', 'on'=>'search'),
        );
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
            'section' => array(self::BELONGS_TO, 'Section', 'section_id'),
            'relatedFields' => array(self::HAS_MANY, 'CategoryFieldList', 'category_id'),
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
            'section_id' => 'Section',
            'category_name' => 'Category Name',
            'priority' => 'Priority',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'added_date' => 'Added Date',
            'modified_date' => 'Modified Date',
        );
    }
    public function listingTypeArray(){
		return array('B'=>'Both Residential & Commercial ','R'=>'Residential','C'=>'Commercial');
	}
    public function listingTypeArrayMain(){
		return array('0'=>'Listing Type',array('id'=>'R','name'=>'Residential'),array('id'=>'C','name'=>'Commercial'));
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
        $criteria->compare('section_id',$this->section_id);
        $criteria->compare('category_name',$this->category_name,true);
        $criteria->compare('isTrash',0,true);
        $criteria->compare('status','A',true);
        $criteria->order="section_id,t.priority";

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
		 $criteria=new CDbCriteria;
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
}
