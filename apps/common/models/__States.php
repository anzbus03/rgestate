<?php

/**
 * This is the model class for table "mw_states".
 *
 * The followings are the available columns in table 'mw_states':
 * @property integer $state_id
 * @property integer $country_id
 * @property string $state_name
 * @property integer $isTrash
 */
class States extends ActiveRecord
{
	public $location;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{states}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id, state_name,location_longitude,location_latitude,location', 'required'),
            array('country_id, isTrash', 'numerical', 'integerOnly'=>true),
            array('state_name', 'length', 'max'=>250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('state_id, country_id, state_name, isTrash', 'safe', 'on'=>'search'),
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
          'con' => array(self::BELONGS_TO, 'Countries', 'country_id','on'=>"con.isTrash='0'"),
          'hotelCount' => array(self::STAT, 'Hotel','state'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'state_id' => 'Region',
            'country_id' => 'Country',
            'state_name' => 'Region Name',
            'isTrash' => 'Is Trash',
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

        $criteria->compare('state_id',$this->state_id);
        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('state_name',$this->state_name,true);
        $criteria->compare('t.isTrash','0');
        $criteria->with ="con";
        $criteria->order="country_name";
        $criteria->order="state_name";
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return States the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function getStateList($val=null)
    {
		 $criteria=new CDbCriteria;
		 $criteria->select="state_id,state_name";
		 $criteria->condition="country_id=:con";
		 $criteria->params[':con'] = $val;
		 return $this->findAll($criteria);
	}
    public function  StateList()
    {
		 $criteria=new CDbCriteria;
		 $criteria->select="state_id,state_name";
		 $criteria->order="isTrash='0'";
		 $criteria->order="state_name";
		 return $this->findAll($criteria);
	}
	function getState_1()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' " ,"order"=>"state_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->state_id] =  $v->state_name; 
			 }
	     }
	     return $_options;
		 
	}
   public function getStateWithCountry()
	{
		 $criteria=new CDbCriteria;
		// $criteria->select="con.country_name,state_name,state_id";
		 $criteria->with ="con";
		 $criteria->condition="t.isTrash=0";
		 $criteria->order ="t.country_id";
		 return $this->findAll($criteria);
		 
	}
   public function getState($id=null)
	{
		 $criteria=new CDbCriteria;
		 $criteria->condition="t.isTrash='0' and state_id=:id";
		 $criteria->params[":id"] = $id;
		 return $this->find($criteria);
		 
	}
	
   public function getStateWithCountry_2($id)
	{
		 $criteria=new CDbCriteria;
		 $criteria->select="state_name,state_id";
		 $criteria->condition="t.isTrash=0 and country_id=:con";
		 $criteria->params[":con"]= $id ;
		 $criteria->order ="t.state_name";
		 return $this->findAll($criteria);
		 
	}
	public function  ListDataForJSON($country)
    {
		 
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and t.country_id=:con";
		 $criteria->params[':con']=$country;
		 $criteria->select ="state_id,state_name";
		 $criteria->order="state_name";
		 $arra =  $this->findAll($criteria);
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->state_id , "name" => $v->state_name );
			 }
		 }
		 
	 	 return CJSON::encode(array_merge(array("0"=>"Select Region"),$ar));
	}
}
