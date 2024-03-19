<?php

/**
 * This is the model class for table "mw_city".
 *
 * The followings are the available columns in table 'mw_city':
 * @property integer $city_id
 * @property string $city_name
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $priority
 * @property string $isTrash
 * @property string $status
 */
class District extends ActiveRecord
{
	public $location;
	public $country_id;
	public $state_id;
 
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_district';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('district_name,city_id ', 'required'),
            array('city_id, district_id ', 'numerical', 'integerOnly'=>true),
            array('district_name', 'length', 'max'=>250),
            array('district_id, district_name, city_id ,country_id,state_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('district_id, district_name, city_id ', 'safe', 'on'=>'search'),
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
           'city' => array(self::BELONGS_TO, 'City', 'city_id'),
           // 'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'city_id' => 'City',
            'city_name' => 'City Name',
            'country_id' => 'Country',
            'state_id' => 'Region',
            'priority' => 'Priority',
            'isTrash' => 'Is Trash',
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

        $criteria->compare('district_id',$this->district_id);
         if(!empty($this->city_id)){
			 $criteria->with = array('city');
			 $criteria->compare('city.city_name',$this->city_id,true);
		 }
        $criteria->compare('district_name',$this->district_name,true);
         $criteria->order = 't.district_id desc'  ;
     

          return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
      public function FindDistrict($id=null)
	{
		$criteria=new CDbCriteria;
		 $criteria->condition = "t.city_id=:city_id";
		 $criteria->params[":city_id"] = $id ; 
		 $criteria->order  = "district_name" ; 
		 return $this->findAll($criteria);
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return City the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
}
