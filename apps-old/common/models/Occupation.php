<?php

/**
 * This is the model class for table "mw_occupation".
 *
 * The followings are the available columns in table 'mw_occupation':
 * @property integer $occupation_id
 * @property string $occupation_name
 * @property string $status
 * @property string $isTrash
 * @property integer $priority
 */
class Occupation extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_occupation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('occupation_name', 'required'),
            array('priority', 'numerical', 'integerOnly'=>true),
            array('occupation_name', 'length', 'max'=>250),
            array('status, isTrash', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('occupation_id, occupation_name, status, isTrash, priority', 'safe', 'on'=>'search'),
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
            'occupation_id' => 'Occupation',
            'occupation_name' => 'Occupation Name',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
            'priority' => 'Priority',
        );
    }
    public function  listData()
    {
		 $criteria=new CDbCriteria;
		  $criteria->condition = "t.isTrash='0' and t.status='A'";
		 $criteria->order = "priority,occupation_name";
		 return $this->findAll($criteria);
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

        $criteria->compare('occupation_id',$this->occupation_id);
        $criteria->compare('occupation_name',$this->occupation_name,true);
        $criteria->compare('status','A',true);
        $criteria->compare('isTrash','0',true);
        $criteria->order = 'priority' ;

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Occupation the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}