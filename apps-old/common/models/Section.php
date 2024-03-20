<?php

/**
 * This is the model class for table "mw_section".
 *
 * The followings are the available columns in table 'mw_section':
 * @property integer $section_id
 * @property integer $section_name
 * @property string $isTrash
 * @property string $status
 * @property integer $priority
 * @property string $added_date
 * @property string $modified_date
 * @property integer $slug
 */
class Section extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_section';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('section_name,disable_frotend,  slug', 'required'),
            array('priority', 'numerical', 'integerOnly'=>true),
            array('isTrash, status', 'length', 'max'=>1),
            array('slug','unique'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('section_id, section_name, isTrash, status, priority, added_date, modified_date, slug', 'safe', 'on'=>'search'),
        );
    }
    public function Yeno(){
		return array('0'=>'No','1'=>'Yes');
	}

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
             'categories' => array(self::HAS_MANY, 'Category', 'section_id','on'=>"categories.isTrash='0' and categories.status='A'","order"=>"categories.priority"),
            'placeAnAds' => array(self::HAS_MANY, 'PlaceAnAd', 'section_id'),
            'subcategories' => array(self::HAS_MANY, 'Subcategory', 'section_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'section_id' => 'Section',
            'section_name' => 'Section Name',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'priority' => 'Priority',
            'added_date' => 'Added Date',
            'modified_date' => 'Modified Date',
            'slug' => 'Slug',
        );
    }
    public function htmlOption()
    {
		return array("class"=>"form-control");
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
        $condition ="t.isTrash='0' ";
        if($this->section_name!="")
        {
			 $condition .= " and section_name like :like ";
			 $criteria->params[":like"] ='%'.$this->section_name.'%';
	    }
        
        $criteria->order="t.priority,t.section_id asc";
        $criteria->condition =  $condition;
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function behaviors(){
		 
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'section_name',
            
            'overwrite' => false
        ))
    );
}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Section the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function ListData()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 $criteria->order="priority asc";
		  return $this->findAll($criteria);
	}
    public function HighestprioritySection()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 $criteria->order="priority asc";
		 return $this->find($criteria);
	}
    public function auto_prioritySection($id)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' and t.section_id=:secid";
		 $criteria->params[':secid']=$id;
		 return $this->find($criteria);
	}
	 public function getSectionFromSlug($slug=null)
	{
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition="t.isTrash='0' and t.status='A' and t.slug=:slug";
		 $criteria->params[':slug']=$slug;
		return $this->find($criteria) ;
		 
	}
    public function findSectionById($id)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' and section_id=:id";
		 $criteria->params[':id'] = $id;
		 $criteria->order="priority asc";
		  return $this->find($criteria);
	}
	function getSection()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' and t.status='A'" ,"order"=>"section_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->section_id] =  $v->section_name; 
			 }
	     }
	     return $_options;
		 
	}
	public function  ListDataForJSON_ID()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 if(Yii::app()->isAppName('frontend')){
			$criteria->condition .= ' and t.disable_frotend="0" ';
		 }
		 $criteria->params[":req"] = 'Y' ; 
		 $criteria->order="priority";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->section_id , "name" => $v->section_name );
			 }
		 }
		 return CJSON::encode(array_merge(array("0"=>"Select Section"), $ar));
	}
	public function  ListDataForJSON_New()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 //if(Yii::app()->isAppName('frontend')){
			$criteria->condition .= ' and t.disable_frotend="0" ';
		 //}
		 $criteria->params[":req"] = 'Y' ; 
		 $criteria->order="priority";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[$v->section_id]=   $v->section_name  ;
			 }
		 }
		 return $ar;
	}
	public function  ListDataForJSON_ID2()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 if(Yii::app()->isAppName('frontend')){
			$criteria->condition .= ' and t.disable_frotend="0" ';
		 }
		 $criteria->params[":req"] = 'Y' ; 
		 $criteria->order="priority";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->section_id , "name" => $v->section_name );
			 }
		 }
		 return  $ar;
	}
    public function listDatalangMain()
    {	
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 
		 $criteria->order="priority asc";
		  return $this->findAll($criteria);
	}
}
