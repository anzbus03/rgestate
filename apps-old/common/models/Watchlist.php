<?php

/**
 * This is the model class for table "mw_watchlist".
 *
 * The followings are the available columns in table 'mw_watchlist':
 * @property integer $id
 * @property integer $user_id
 * @property integer $ad_id
 * @property string $added_date
 */
class Watchlist extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_watchlist';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, ad_id', 'required'),
            array('user_id, ad_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, ad_id, added_date', 'safe', 'on'=>'search'),
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
          'Ad' => array(self::BELONGS_TO, 'PlaceAnAd', 'ad_id','on'=>"Ad.isTrash='0' and Ad.status='A'"),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'ad_id' => 'Ad',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('added_date',$this->added_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
  

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Watchlist the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
