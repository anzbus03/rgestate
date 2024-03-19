<?php

/**
 * This is the model class for table "mw_countries".
 *
 * The followings are the available columns in table 'mw_countries':
 * @property integer $country_id
 * @property string $country_name
 * @property string $country_code
 * @property integer $isTrash
 */
class Countries extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public $location ; 
    public function tableName()
    {
        return '{{countries}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_name, country_code,location_longitude,location_latitude,location', 'required'),
            array('isTrash', 'numerical', 'integerOnly'=>true),
            array('country_name', 'length', 'max'=>250),
            array('country_code', 'length', 'max'=>5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('country_id, country_name, country_code, isTrash', 'safe', 'on'=>'search'),
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
          'statelist'=>array(self::HAS_MANY, 'States', 'country_id','on'=>'statelist.isTrash=0'),
          
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'country_id' => 'Country',
            'country_name' => 'Country Name',
            'country_code' => 'Country Code',
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

        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('country_name',$this->country_name,true);
        $criteria->compare('country_code',$this->country_code,true);
        $criteria->compare('isTrash',$this->isTrash);
        $criteria->order = "country_name" ;
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Countries the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function Countrylist()
    {
		  $criteria=new CDbCriteria;
		  $criteria->condition="isTrash='0'";
		  $criteria->select="country_id,country_name";
		  return $this->findAll($criteria);
		
	}
	 function getCountry_1()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' " ,"order"=>"country_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->country_id] =  $v->country_name; 
			 }
	     }
	     return $_options;
		 
	}
   	public function getStateWithCountry()
	{
		$criteria=new CDbCriteria;
		$criteria->with =array("statelist","statelist.hotelCount"=>array("condition"=>"t.isTrash='0' and t.status='A'"));
		$criteria->condition="t.isTrash=0";
		$criteria->order = "t.country_name";
		$ar =  $this->findAll($criteria);
		$listarray =array();
		 if($ar)
		 {
			 foreach ($ar as $k=>$v)
			 {
				 if($v->statelist)
				 {
					  
					 foreach($v->statelist as $k1=>$v1)
					 {
						  $listarray[$v->country_id.':'.$v1->state_id] = $v->country_name.','.$v1->state_name."(".$v1->hotelCount.")";
					 }
				
			     }
			     else
			     {
					  $listarray[$v->country_id.':0']  = $v->country_name."(0)";
				 }
		      }
		  }
		  return  $listarray;
		 
	}
	public function  ListDataForJSON()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0'";
		 $criteria->select ="country_id,country_name";
		 $criteria->order="country_name";
		 $arra =  $this->findAll($criteria);
		 $ar =array();
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->country_id , "name" => $v->country_name );
			 }
		 }
	  return CJSON::encode(array_merge(array("0"=>"Select Country"), $ar));
	}
}
