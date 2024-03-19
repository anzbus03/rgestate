<?php

/**
 * This is the model class for table "mw_ad_amenities".
 *
 * The followings are the available columns in table 'mw_ad_amenities':
 * @property integer $ad_id
 * @property integer $amenities_id
 *
 * The followings are the available model relations:
 * @property Amenities $amenities
 * @property PlaceAnAd $ad
 */
class AdAmenities extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_ad_amenities';
    }
      public function primaryKey(){
    	return 'amenities_id';
	}

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id, amenities_id', 'required'),
            array('inp_val', 'safe'),
            array('ad_id, amenities_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ad_id, amenities_id', 'safe', 'on'=>'search'),
        );
    }
    public $master_name ; 
    public $master_id ; 

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'amenities' => array(self::BELONGS_TO, 'Amenities', 'amenities_id'),
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
            'amenities_id' => 'Amenities',
        );
    }
	public function getinp_val2(){
		return !empty($this->inp_val) ?  $this->inp_val : $this->amenities_id;
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
        $criteria->compare('amenities_id',$this->amenities_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdAmenities the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public $amenities_name;
}
