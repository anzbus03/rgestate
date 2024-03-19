<?php

/**
 * This is the model class for table "{{featured_date}}".
 *
 * The followings are the available columns in table '{{featured_date}}':
 * @property integer $ad_id
 * @property string $date_added
 * @property integer $order_id
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 * @property PricePlanOrder $order
 */
class FeaturedDate extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{featured_date}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id', 'required'),
            array('ad_id, order_id', 'numerical', 'integerOnly'=>true),
            array('f_type', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ad_id, date_added, order_id', 'safe', 'on'=>'search'),
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
            'ad' => array(self::BELONGS_TO, 'PlaceAnAd', 'ad_id'),
            'order' => array(self::BELONGS_TO, 'PricePlanOrder', 'order_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ad_id' => 'Ad',
            'date_added' => 'Date Added',
            'order_id' => 'Order',
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

        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('order_id',$this->order_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FeaturedDate the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
