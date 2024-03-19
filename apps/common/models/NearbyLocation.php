<?php

/**
 * This is the model class for table "mw_nearby_location".
 *
 * The followings are the available columns in table 'mw_nearby_location':
 * @property integer $id
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $location_name
 * @property string $latitude
 * @property string $longitude
 * @property string $isTrash
 *
 * The followings are the available model relations:
 * @property States $state
 * @property Countries $country
 */
class NearbyLocation extends ActiveRecord
{
	public $location;
	public $naqweqweme;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_nearby_location';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id, state_id, location_name,  location_latitude, location_longitude,location', 'required'),
            array('country_id, state_id,  ', 'numerical', 'integerOnly'=>true),
            array('location_latitude, location_longitude', 'length', 'max'=>50),
            array('isTrash', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, country_id, state_id, location_name, location_latitude, location_longitude, isTrash', 'safe', 'on'=>'search'),
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
            'state' => array(self::BELONGS_TO, 'States', 'state_id'),
            'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'country_id' => 'Country',
            'state_id' => 'State',
            'location_name' => 'Location Name',
            'location_latitude' => 'Latitude',
            'location_longitude' => 'Longitude',
            'isTrash' => 'Is Trash',
            'location'=> 'Select From Map'
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
        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('state_id',$this->state_id);
        $criteria->compare('location_name',$this->location_name);
        $criteria->compare('location_latitude',$this->location_latitude,true);
        $criteria->compare('location_longitude',$this->location_longitude,true);
        $criteria->compare('isTrash',0,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return NearbyLocation the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function JsonData()
    {
		$criteria	=	new CDbCriteria;
		$country = Yii::app()->request->cookies['country_id']->value;
		$criteria->condition	=	"isTrash='0' and country_id=:con";  
		$criteria->params[':con'] = $country;
		 //FOR SPECIFI STATES
		 
		 
		
		
		$criteria->select	=	"t.id, location_name,location_latitude,location_longitude  ";
		$criteria->order	=	"location_name";
		$ar = array();
		if($list = $this->findAll($criteria))
		{
			foreach($list as $k=>$v)
			{
				$ar[] = array("value"=>$v->location_name,"label"=>$v->id,"latitude"=>$v->location_latitude,"longitude"=>$v->location_longitude);
			}
		}
		return json_encode($ar);
		 
	 
	}
}
