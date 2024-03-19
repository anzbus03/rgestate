<?php

/**
 * This is the model class for table "{{price_unit}}".
 *
 * The followings are the available columns in table '{{price_unit}}':
 * @property integer $master_id
 * @property string $master_name
 * @property string $value
 * @property string $date_added
 * @property string $last_updated
 * @property string $is_trash
 * @property string $show_all
 *
 * The followings are the available model relations:
 * @property Countries[] $mwCountries
 */
class PriceUnit extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
     public $listing_countries;
    
    public function tableName()
    {
        return '{{price_unit}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('master_name, value, show_all', 'required'),
            array('master_name', 'length', 'max'=>150),
            array('value', 'length', 'max'=>15),
            array('is_trash, show_all,f_type', 'length', 'max'=>1),
            array('is_trash, show_all,f_type', 'safe'),
               
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('master_id, master_name, value, date_added, last_updated, is_trash, show_all', 'safe', 'on'=>'search'),
        );
    }
    public function countryOption(){
		return array(
		'0' =>'All listing  countries',
		'1' =>'Only for selected countries',
		
		);
	}
	 protected function beforeSave()
    {
        
         
        
       parent::beforeSave();
       $this->f_type = 'P';
        return  true;
    }
    public function afterSave(){
	 
	 
			 
        return parent::afterSave();
		 
	}

 
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
             
        );
    }
public function getshow_allTitle(){
		return $this->show_all == '1' ? 'Selected' : 'All'; 
	}
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'master_id' => 'Master',
            'master_name' => 'Master Name',
            'value' => 'Value',
            'date_added' => 'Date Added',
            'last_updated' => 'Last Updated',
            'is_trash' => 'Is Trash',
            'show_all' => 'Show All',
        );
    }
public function  ListData($country=null)
    {	 
		 $criteria=new CDbCriteria;
	 
		 $criteria->condition = "t.is_trash='0'   ";
		   
		 $criteria->order="  -t.priority desc , value asc";
		return   $this->findAll($criteria);
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

        $criteria->compare('master_id',$this->master_id);
        $criteria->compare('master_name',$this->master_name,true);
        $criteria->compare('value',$this->value,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);
        $criteria->compare('is_trash',$this->is_trash,true);
        $criteria->compare('show_all',$this->show_all,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PriceUnit the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
     public function findByUnitValue($unit){
		$criteria=new CDbCriteria;
		$criteria->condition = ' TRIM(LOWER(t.master_name)) like  :price   ';
		$criteria->params[":price"] = '%'.trim(strtolower($unit)).'%';
		return $this->find($criteria);
	 }
}
