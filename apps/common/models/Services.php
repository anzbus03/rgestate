<?php

/**
 * This is the model class for table "{{services}}".
 *
 * The followings are the available columns in table '{{services}}':
 * @property integer $service_id
 * @property string $service_name
 * @property string $status
 * @property integer $isTrash
 * @property integer $priority
 *
 * The followings are the available model relations:
 * @property ListingUsers[] $listingUsers
 */
class Services extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{services}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('service_name', 'required'),
            array('isTrash, priority', 'numerical', 'integerOnly'=>true),
            array('service_name', 'length', 'max'=>250),
            array('status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('service_id, service_name, status, isTrash, priority', 'safe', 'on'=>'search'),
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
            'listingUsers' => array(self::HAS_MANY, 'ListingUsers', 'designation_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'service_id' => 'Service',
            'service_name' => 'Service Name',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
            'priority' => 'Priority',
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

        $criteria->compare('service_id',$this->service_id);
        $criteria->compare('service_name',$this->service_name,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('isTrash',$this->isTrash);
        $criteria->compare('priority',$this->priority);

         return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder' => array(
                    'service_id' => CSort::SORT_DESC,
                ),
            ),
        ));
    }
    public function  ListData()
    {	
	  
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A' ";
		 $criteria->select ="t.*";
		 $criteria->order = 'service_name asc ';
		 return  $this->findAll($criteria);
				   
		  
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Services the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
