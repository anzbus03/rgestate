<?php

/**
 * This is the model class for table "{{place_an_ad_units}}".
 *
 * The followings are the available columns in table '{{place_an_ad_units}}':
 * @property integer $ad_id
 * @property integer $unit_id
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 * @property PlaceAnAd $unit
 */
class PlaceAnAdUnits extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{place_an_ad_units}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id, unit_id', 'required'),
            array('ad_id, unit_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ad_id, unit_id', 'safe', 'on'=>'search'),
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
            'unit' => array(self::BELONGS_TO, 'PlaceAnAd', 'unit_id'),
        );
    }
	
	public $ad_title;
	public $section_id;
	public $company_name;
	
    public function getFullUnits($id)
    { 
	 
		$criteria=new CDbCriteria;
		$criteria->condition  = '1'; 
		$criteria->select = 't.unit_id, ad.ad_title,ad.id,ad.section_id,usr.company_name';
		$criteria->join .= 'LEFT JOIN {{place_an_ad}} ad ON ad.id = t.unit_id  ';
		$criteria->join .= 'LEFT JOIN {{listing_users}} usr ON usr.user_id = ad.user_id  ';
		$criteria->compare('ad.isTrash','0');
		$criteria->compare('ad.status','A');
		$criteria->compare('t.ad_id',(int)$id );
		return   self::model()->findAll($criteria); 
		
		 
		 
    }
     public function getReferenceNumberTitle(){
         
		$val = 'ID-'.str_pad($this->unit_id, 5, "0", STR_PAD_LEFT);   
		return $val;
			}
			 
	 
     public function getFullName(){
		return  $this->ReferenceNumberTitle.' | '. $this->ad_title.' | '.$this->company_name ;
	 }
   

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ad_id' => 'Ad',
            'unit_id' => 'Unit',
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
        $criteria->compare('unit_id',$this->unit_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PlaceAnAdUnits the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
