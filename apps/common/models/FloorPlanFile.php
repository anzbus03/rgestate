<?php

/**
 * This is the model class for table "mw_floor_plan_file".
 *
 * The followings are the available columns in table 'mw_floor_plan_file':
 * @property integer $id
 * @property integer $floor_plan_id
 * @property string $title
 * @property string $file
 */
class FloorPlanFile extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
     
    public function tableName()
    {
        return 'mw_floor_plan_file';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('floor_plan_id, title, file,property,project_id ', 'required'),
            array('floor_plan_id', 'numerical', 'integerOnly'=>true),
            array('title, file, slug ', 'length', 'max'=>250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, floor_plan_id, title, file, slug ', 'safe' ),
            array('id, floor_plan_id, title, file,slug', 'safe', 'on'=>'search'),
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
           'property1' => array(self::BELONGS_TO, 'Property', 'property','on'=>"property1.isTrash='0'",'joinType'=>'INNER JOIN'),
           'project1' => array(self::BELONGS_TO, 'Project', 'project_id','on'=>"project1.isTrash='0'",'joinType'=>'INNER JOIN'),
			'floorPlan' => array(self::BELONGS_TO, 'FloorPlan', 'floor_plan_id','on'=>"floorPlan.isTrash='0'",'joinType'=>'INNER JOIN'),
      
        );
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'floor_plan_id' => 'Floor Plan',
            'title' => 'Title',
            'project_id' => 'Project',
            'file' => 'File',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('floor_plan_id',$this->floor_plan_id);
        $criteria->compare('property',$this->property);
        $criteria->compare('project_id',$this->project_id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('file',$this->file,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FloorPlanFile the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
        public function behaviors(){
		 
    return array_merge(parent::behaviors(),array(
        'SlugBehavior' => array(
            'class' => 'common.models.SlugBehavior.SlugBehavior',
            'slug_col' => 'slug',
            'title_col' => 'title',
            
            'overwrite' => false
        ))
    );
  }
} 
