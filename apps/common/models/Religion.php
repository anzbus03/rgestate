<?php

/**
 * This is the model class for table "mw_religion".
 *
 * The followings are the available columns in table 'mw_religion':
 * @property integer $religion_id
 * @property string $religion_name
 * @property string $status
 * @property integer $isTrash
 * @property integer $priority
 */
class Religion extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_religion';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('religion_name', 'required'),
            array('isTrash, priority', 'numerical', 'integerOnly'=>true),
            array('religion_name', 'length', 'max'=>250),
            array('status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('religion_id, religion_name, status, isTrash, priority', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'religion_id' => 'Religion',
            'religion_name' => 'Religion Name',
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

        $criteria->compare('religion_id',$this->religion_id);
        $criteria->compare('religion_name',$this->religion_name,true);
        $criteria->compare('status','A',true);
        $criteria->compare('isTrash','0');
        $criteria->order = 'priority';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
     public function  listData()
    {
		 $criteria=new CDbCriteria;
		  $criteria->condition = "t.isTrash='0' and t.status='A'";
		 $criteria->order = "priority,religion_name";
		 return $this->findAll($criteria);
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Religion the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
