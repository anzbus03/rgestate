<?php

/**
 * This is the model class for table "mw_floor_plan".
 *
 * The followings are the available columns in table 'mw_floor_plan':
 * @property integer $floor_plan_id
 * @property string $floor_plan_name
 * @property integer $project_id
 * @property string $description
 * @property string $isTrash
 * @property string $status
 * @property string $slug
 * @property string $added_date
 */
class FloorPlan extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    const  AlternateFloorPlanText = 'Floor Plan';
    public function tableName()
    {
        return 'mw_floor_plan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('floor_plan_name,property, project_id, description ', 'required'),
            array('project_id,property', 'numerical', 'integerOnly'=>true),
            array('floor_plan_name, slug', 'length', 'max'=>250),
            array('isTrash, status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('property,floor_plan_id, floor_plan_name, project_id, description, isTrash, status, slug, added_date', 'safe', 'on'=>'search'),
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
          'plansList' => array(self::HAS_MANY, 'FloorPlanFile', 'floor_plan_id'),
        
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'floor_plan_id' => 'Floor Plan',
            'floor_plan_name' => 'Floor Plan Name',
            'project_id' => 'Project',
            'description' => 'Description',
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

        $criteria->compare('floor_plan_id',$this->floor_plan_id);
        $criteria->compare('floor_plan_name',$this->floor_plan_name,true);
        $criteria->compare('project_id',$this->project_id);
        $criteria->compare('property',$this->property);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('t.isTrash',0,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('slug',$this->slug,true);
        $criteria->compare('added_date',$this->added_date,true);
        $criteria->with['property1'] =array('on'=>'property1.isTrash="0"','together'=>true);
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
            'title_col' => 'floor_plan_name',
            
            'overwrite' => false
        ))
    );
  }
      public function _setDefaultEditorForContent(CEvent $event)
    {
        if ($event->params['attribute'] == 'description') {
            $options = array();
            if ($event->params['htmlOptions']->contains('wysiwyg_editor_options')) {
                $options = (array)$event->params['htmlOptions']->itemAt('wysiwyg_editor_options');
            }
            $options['id'] = CHtml::activeId($this, 'description');
            $options['height'] = 400;
            $options['toolbar']= 'Full';
            $event->params['htmlOptions']->add('wysiwyg_editor_options', $options);
        }
    }
    
    
      public function  ListDataWithproject($id=null)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' and t.project_id=:section";
		 $criteria->params[":section"] = $id ; 
		 $criteria->order="floor_plan_name";
		 return $this->findAll($criteria);
	}
	
     protected function afterConstruct()
    {
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterConstruct();
    }
       protected function afterFind()
    {
        $this->fieldDecorator->onHtmlOptionsSetup = array($this, '_setDefaultEditorForContent');
        parent::afterFind();
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FloorPlan the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    function getFloorPlan()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' and t.status='A'" ,"order"=>"floor_plan_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->floor_plan_id] =  $v->floor_plan_name; 
			 }
	     }
	     return $_options;
		 
	}
} 
