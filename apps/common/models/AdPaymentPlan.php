<?php

/**
 * This is the model class for table "{{ad_payment_plan}}".
 *
 * The followings are the available columns in table '{{ad_payment_plan}}':
 * @property integer $ad_id
 * @property integer $row_id
 * @property string $title
 * @property string $file
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 */
class AdPaymentPlan extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{ad_payment_plan}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id, row_id, file', 'required'),
            array('ad_id, row_id', 'numerical', 'integerOnly'=>true),
            array('title, file', 'length', 'max'=>250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ad_id, row_id, title, file', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ad_id' => 'Ad',
            'row_id' => 'Row',
            'title' => 'Title',
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

        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('row_id',$this->row_id);
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
     * @return AdPaymentPlan the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
