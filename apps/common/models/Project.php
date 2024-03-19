<?php

/**
 * This is the model class for table "mw_project".
 *
 * The followings are the available columns in table 'mw_project':
 * @property integer $project_id
 * @property string $project_name
 * @property integer $property_id
 * @property string $isTrash
 * @property string $status
 * @property string $slug
 * @property string $added_date
 */
class Project extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_project';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('project_name, property_id ', 'required'),
            array('property_id', 'numerical', 'integerOnly'=>true),
            array('project_name, slug', 'length', 'max'=>250),
            array('isTrash, status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('project_id, project_name, property_id, isTrash, status, slug, added_date', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
             'property' => array(self::BELONGS_TO, 'Property', 'property_id','on'=>"property.isTrash='0'",'joinType'=>'INNER JOIN'),
      
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'project_id' => 'Project',
            'project_name' => 'Project Name',
            'property_id' => 'Property',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'slug' => 'Slug',
            'added_date' => 'Added Date',
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
		
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('project_id',$this->project_id);
        $criteria->compare('project_name',$this->project_name,true);
        $criteria->compare('property_id',$this->property_id);
        $criteria->compare('t.isTrash',0,true);
        $criteria->compare('t.status',$this->status,true);
        $criteria->compare('slug',$this->slug,true);
        $criteria->compare('added_date',$this->added_date,true);

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
            'title_col' => 'project_name',
            
            'overwrite' => false
        ))
    );
  }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    function getProject()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' and t.status='A'" ,"order"=>"project_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->project_id] =  $v->project_name; 
			 }
	     }
	     return $_options;
		 
	}
    
    public function  ListDataWithProperty($id=null)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' and t.property_id=:section";
		 $criteria->params[":section"] = $id ; 
		 $criteria->order="project_name";
		 return $this->findAll($criteria);
	}
   function renderImageNew($image="")
	{
		
		
					 
					if (file_exists($image)) {
						 
						return $image;
					} 
					else {
						return   Yii::app()->theme->baseUrl.'/images/ucnoimage.jpg'; 
					}
		 
	}
} 
