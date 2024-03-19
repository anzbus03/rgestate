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
class Community extends ActiveRecord
{
 
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_community';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('community_name ', 'required'),
            array('country_id ', 'validateLocation'),
            array('community_id, district_id,region_id ', 'numerical', 'integerOnly'=>true),
            array('community_name', 'length', 'max'=>250),
            array('community_id, community_name, district_id ,HaveSubComm ', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('community_id, community_name, district_id ,HaveSubComm ', 'safe', 'on'=>'search'),
        );
    }
    public function validateLocation($attribute,$params)
	{
		 if(empty($this->country_id) and empty($this->region_id)){
			$this->addError('country_id', 'Country Cannot be blank!');
		 }
	}
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
             'region' => array(self::BELONGS_TO, 'States', 'region_id'),
             'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
        );
    }
    
    public function beforeSave(){
		parent::beforeSave();
		if(!empty($this->region_id)){
			$this->country_id = null; 
		}
		return true;
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
            'region_id' => 'Region',
             // 'region_id' => 'Region',
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
    public $country_name;
   public  $state_name;
    public function GetLocation(){
		$html = '';
		if(!empty($this->country_name)){
			$html .= $this->country_name;
		}
		if(!empty($this->state_name)){
			$html .= $this->state_name;
		}
		return $html;
	}
    public function search($return=false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
		
        $criteria=new CDbCriteria;$criteria->condition  = '1';
        $criteria->select = 't.community_id,t.community_name,cn.country_name as country_name , st.state_name as state_name ';
        $criteria->compare('district_id',$this->district_id);
        $criteria->compare('community_id',$this->community_id);
        $criteria->compare('community_name',$this->community_name,true);
        $criteria->join  = ' LEFT JOIN {{countries}} cn on cn.country_id = t.country_id  ';
        $criteria->join  .= ' LEFT JOIN {{states}} st on st.state_id = t.region_id  ';
        
        if(!empty($this->region_id)){
			 $criteria->condition .= ' and cn.country_name like :word or st.state_name  like :word  ';
			 $criteria->params[':word'] = '%'.$this->region_id.'%';
		}
		$criteria->order ='t.community_name ASC';
		if($return){
			return $criteria;
		}

          return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
    
    public function communities($id=null)
	{
		$criteria=new CDbCriteria;
		 $criteria->condition = "t.district_id=:district_id";
		 $criteria->params[":district_id"] = $id ; 
		 $criteria->order  = "community_name" ; 
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
