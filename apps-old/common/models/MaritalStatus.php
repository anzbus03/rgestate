<?php

/**
 * This is the model class for table "mw_marital_status".
 *
 * The followings are the available columns in table 'mw_marital_status':
 * @property integer $marital_id
 * @property string $marital_name
 * @property integer $priority
 * @property string $status
 * @property integer $isTrash
 */
class MaritalStatus extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_marital_status';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('marital_name', 'required'),
            array('priority, isTrash', 'numerical', 'integerOnly'=>true),
            array('marital_name', 'length', 'max'=>250),
            array('status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('marital_id, marital_name, priority, status, isTrash', 'safe', 'on'=>'search'),
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
            'marital_id' => 'Marital',
            'marital_name' => 'Marital Status Name',
            'priority' => 'Priority',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
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

        $criteria->compare('marital_id',$this->marital_id);
        $criteria->compare('marital_name',$this->marital_name,true);
        
        $criteria->compare('status','A',true);
        $criteria->compare('isTrash','0');
        $criteria->order = 'priority' ;
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MaritalStatus the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
      public function  listData()
    {
		 $criteria=new CDbCriteria;
		  $criteria->condition = "t.isTrash='0' and t.status='A'";
		 $criteria->order = "priority,marital_name";
		 return $this->findAll($criteria);
	}
}
