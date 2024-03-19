<?php

/**
 * This is the model class for table "mw_subcategory".
 *
 * The followings are the available columns in table 'mw_subcategory':
 * @property integer $sub_category_id
 * @property integer $section_id
 * @property integer $category_id
 * @property string $sub_category_name
 * @property integer $priority
 * @property string $isTrash
 * @property string $status
 * @property string $slug
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Section $section
 */
class Subcategory extends ActiveRecord
{
	public $amenities;
	public $fields;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_subcategory';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, sub_category_name, slug', 'required'),
            array('section_id, category_id, priority, parent_id', 'numerical', 'integerOnly'=>true),
            array('sub_category_name,image,active_image', 'length', 'max'=>250),
            array('isTrash, status', 'length', 'max'=>1),
            array('slug', 'length', 'max'=>260),
            
            array('modified_date,xml_inserted', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('sub_category_id, section_id, category_id, sub_category_name, priority, parent_id, isTrash, status, slug,change_parent_fields', 'safe', 'on'=>'search'),
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
			 
			$condition = array(self::STAT, 'PlaceAnAd', 'sub_category_id','condition'=>"t.isTrash='0' and t.status='A' and t.country=:con and t.state=:state",  'params'=>array(':con'=>Yii::app()->request->cookies['country'],':state'=>Yii::app()->request->cookies['state']));
		}
		else if(isset(Yii::app()->request->cookies['country']) and isset(Yii::app()->request->cookies['state'])  and  Yii::app()->request->cookies['state']->value==0)
		{
			$condition = array(self::STAT, 'PlaceAnAd', 'sub_category_id','condition'=>"t.isTrash='0' and t.status='A' and t.country=:con",  'params'=>array(':con'=>Yii::app()->request->cookies['country']));
	
		}
		else
		{
		    $condition = array(self::STAT, 'PlaceAnAd', 'sub_category_id','condition'=>"t.isTrash='0' and t.status='A'");
	
		}
        return array(
             'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'section' => array(self::BELONGS_TO, 'Section', 'section_id'),
            'relatedAmenities' => array(self::HAS_MANY, 'SubcategoryAmenitiesList', 'sub_category_id'),
            'relatedFields' => array(self::HAS_MANY, 'SubCategoryFieldList', 'sub_category_id'),
            'relatedFieldsList' => array(self::HAS_MANY, 'SubCategoryFieldList', 'sub_category_id'),
            'adsCount' =>  $condition ,
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'sub_category_id' => 'Sub Category',
            'section_id' => 'Section',
            'category_id' => 'Category',
            'sub_category_name' => 'Sub Category Name',
            'priority' => 'Priority',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'slug' => 'Slug',
        );
    }
    public function YesNoArray()
    {
		return array("N"=>"NO","Y"=>"YES");
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

        $criteria->compare('sub_category_id',$this->sub_category_id);
        $criteria->compare('section_id',$this->section_id);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('sub_category_name',$this->sub_category_name,true);
        $criteria->compare('t.isTrash','0',true);
        $criteria->compare('status','A',true);
        $criteria->order ="t.section_id,category_id,t.sub_category_name" ;
     //   $pageSize = (Yii::app()->request->getQuery("page_size")) ?  (int) Yii::app()->request->getQuery("page_size") : $pageSize = 10;
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
              'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
   public function behaviors(){
		 
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'sub_category_name',
            'overwrite' => false
        ))
    );
  }
  
  
    public function getSubCategoryFromSlug($slug=null)
	{
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition="t.isTrash='0' and t.status='A' and t.slug=:slug";
		 $criteria->params[':slug']=$slug;
		return $this->find($criteria) ;
		 
	}
     public function getSubCategoryOne($id=null)
	{
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition="t.isTrash='0' and t.status='A' and t.sub_category_id=:id";
		 $criteria->params[':id']=$id;
		return $this->find($criteria) ;
		 
	}
	public function Find_id_add_models($id=null)
	{
		$criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and t.sub_category_id=:sub_category_id";
		 $criteria->params[":sub_category_id"] = $id ; 
		 $criteria->params[":field_name"] = 'model' ; 
		 return $this->with(array("relatedFieldsList"=>array("on"=>"relatedFieldsList.field_name=:field_name"),"category.relatedFields"=>array("on"=>"relatedFields.field_name=:field_name")))->find($criteria);
	}
	public function FindSubategory($id=null)
	{
		$criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and t.sub_category_id=:sub_category_id";
		 $criteria->params[":sub_category_id"] = $id ; 
		 return $this->with(array("relatedAmenities","relatedFieldsList","category.relatedFields"))->find($criteria);
	}
	 
  	public function  FindData_SubCategory_With_Amenities_required($id=null)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.status='A' and sub_category_id=:sub_category_id";
		 $criteria->params[":sub_category_id"] = $id ; 
		 return $this->with(array("category"=>array("on"=>"category.amenities_required='Y'")))->find($criteria);
	}
    public function  ListDataForJSON($category)
    {
		 $criteria=new CDbCriteria;
		 $criteria->with = array("category"=>array("on"=>"category.category_name=:cont","joinType"=>"INNER JOIN","params"=>array(":cont"=>$category)));
		 $criteria->condition = "t.isTrash='0'";
		 $criteria->select ="sub_category_id,sub_category_name";
		 $criteria->order="sub_category_name";
		 $arra =  $this->findAll($criteria);
		 print_r($arra);exit;
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->sub_category_id , "name" => $v->sub_category_name );
			 }
		 }
		 return CJSON::encode(array_merge(array("0"=>"Select Subcategory"), $ar));
	}
	public function  ListDataForCategory($id)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' and category_id=:id";
		 $criteria->params['id'] = $id;
		 $criteria->order="sub_category_name";
		 return $this->findAll($criteria);
	}
    public function  ListDataForJSON_ID($category)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and category_id=:id";
		 $criteria->params[":id"] = $category;
		 $criteria->select ="sub_category_id,sub_category_name";
		 $criteria->order="sub_category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->sub_category_id , "name" => $v->sub_category_name );
			 }
		 }
		 return CJSON::encode(array_merge(array("0"=>"Select Subcategory"), $ar));
	}
    public function  ListDataForJSON_IDNew($category)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and category_id=:id";
		 $criteria->params[":id"] = (int) $category;
		 $criteria->select ="sub_category_id,sub_category_name";
		 $criteria->order="sub_category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[$v->sub_category_id]=   $v->sub_category_name  ;
			 }
		 }
		 return $ar;
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Subcategory the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    function getSubCategory()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' and t.status='A'" ,"order"=>"sub_category_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->sub_category_id] =  $v->sub_category_name; 
			 }
	     }
	     return $_options;
		 
	}
	 public function  ListDataForJSON_ID2($category)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and category_id=:id";
		 $criteria->params[":id"] = $category;
		 $criteria->select ="sub_category_id,sub_category_name,image,active_image";
		 $criteria->order="sub_category_name";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->sub_category_id , "name" => $v->sub_category_name  , 'image'=>$v->ImageTitle, 'active_image' => $v->ActiveImageTitle);
			 }
		 }
		 return   $ar  ;
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
	public function findBySubCategoryName($category){
		$criteria=new CDbCriteria;
		$criteria->condition = ' TRIM(LOWER(t.sub_category_name)) like  :sub_category_name  and  t.isTrash="0" and status="A"  ';
		$criteria->params[":sub_category_name"] = '%'.trim(strtolower($category)).'%';
		return $this->find($criteria);
	 }
}
