<?php

/**
 * This is the model class for table "mw_experience".
 *
 * The followings are the available columns in table 'mw_experience':
 * @property integer $experience_id
 * @property string $experience_name
 * @property string $isTrash
 * @property integer $priority
 * @property string $status
 */
class Experience extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_experience';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('experience_name', 'required'),
            array('priority', 'numerical', 'integerOnly'=>true),
            array('experience_name', 'length', 'max'=>250),
            array('isTrash, status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('experience_id, experience_name, isTrash, priority, status', 'safe', 'on'=>'search'),
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
public function  listData()
    {
		 $criteria=new CDbCriteria;
		  $criteria->condition = "t.isTrash='0' and t.status='A'";
		 $criteria->order = "experience_name";
		 return $this->findAll($criteria);
	}
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'experience_id' => 'Experience',
            'experience_name' => 'Experience Level',
            'isTrash' => 'Is Trash',
            'priority' => 'Priority',
            'status' => 'Status',
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

        $criteria->compare('experience_name',$this->experience_name,true);
        $criteria->compare('isTrash','0',true);
        $criteria->compare('status','A',true);
		$criteria->order="priority";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Experience the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
