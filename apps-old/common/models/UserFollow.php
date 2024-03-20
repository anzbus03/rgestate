<?php

/**
 * This is the model class for table "{{user_follow}}".
 *
 * The followings are the available columns in table '{{user_follow}}':
 * @property integer $follow
 * @property integer $followed_by
 *
 * The followings are the available model relations:
 * @property ListingUsers $followedBy
 * @property ListingUsers $follow0
 */
class UserFollow extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user_follow}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('follow, followed_by', 'required'),
            array('follow, followed_by', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('follow, followed_by', 'safe', 'on'=>'search'),
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
            'followedBy' => array(self::BELONGS_TO, 'ListingUsers', 'followed_by'),
            'follow0' => array(self::BELONGS_TO, 'ListingUsers', 'follow'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'follow' => 'Follow',
            'followed_by' => 'Followed By',
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

        $criteria->compare('follow',$this->follow);
        $criteria->compare('followed_by',$this->followed_by);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserFollow the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
