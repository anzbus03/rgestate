<?php

/**
 * This is the model class for table "{{session_indicator}}".
 *
 * The followings are the available columns in table '{{session_indicator}}':
 * @property string $sessionVersion
 * @property string $successIndicator
 * @property string $order_uid
 */
class SessionIndicator extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{session_indicator}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sessionVersion, successIndicator, order_uid', 'required'),
            array('sessionVersion, order_uid', 'length', 'max'=>20),
            array('successIndicator', 'length', 'max'=>50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('sessionVersion, successIndicator, order_uid', 'safe', 'on'=>'search'),
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
            'sessionVersion' => 'Session Version',
            'successIndicator' => 'Success Indicator',
            'order_uid' => 'Order Uid',
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

        $criteria->compare('sessionVersion',$this->sessionVersion,true);
        $criteria->compare('successIndicator',$this->successIndicator,true);
        $criteria->compare('order_uid',$this->order_uid,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SessionIndicator the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
