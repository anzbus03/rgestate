<?php

/**
 * This is the model class for table "{{area_unit}}".
 *
 * The followings are the available columns in table '{{area_unit}}':
 * @property integer $master_id
 * @property string $master_name
 * @property string $value
 * @property string $is_default
 * @property integer $country_id
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property Countries $country
 */
class AreaUnit extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public $listing_countries;
    
    public function tableName()
    {
        return '{{area_unit}}';
    }public function getPrimaryField(){
		 return 'a_unt';
	 }
public function validateCountries($attribute,$params){
	 
			if ( $this->show_all=='1'  and  empty($this->listing_countries)   ){
				$this->addError($attribute, 'Please select at least one country');
			}
		 
	}
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(' master_name, value', 'required'),
            array('master_id', 'numerical', 'integerOnly'=>true),
            array('master_name', 'length', 'max'=>50),
            array('value', 'length', 'max'=>12),
            array('is_default', 'length', 'max'=>1),
           
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('master_id, master_name, value, is_default,  date_added, last_updated', 'safe', 'on'=>'search'),
        );
    }
public function  ListData($country=null)
    {	 
         
		 $criteria=new CDbCriteria;
	 $criteria->select  = 't.*'; 
		 $criteria->condition = "t.is_trash='0'   ";
 		 $langaugae = defined('LANGUAGE') ? LANGUAGE : 'en';
		  if(!empty($langaugae) and  $langaugae != 'en'){
			$criteria->params[':lan'] = $langaugae;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.a_unt = t.master_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN tdata.message ELSE t.master_name END as  master_name  ';
		 }
		 $criteria->order="  t.is_default = '1' desc , master_name asc";
		 
		return   $this->findAll($criteria);
	}
	public function  ListDataSort(){
	 $cacheKey = 'area_unit2'.Yii::app()->options->get('system.common.area_unit_cache','123s421');;
       
       if(defined('LANGUAGE')){
		   $cacheKey .= LANGUAGE;
	   }
 
       	if ($items = Yii::app()->cache->get($cacheKey)) {
		   
			 return $items;
		}
		$items = array();
		
		$itemsModel = $this->ListData();
		if(!empty($itemsModel)){
			foreach($itemsModel  as $k=>$v){
				$items[ $v->master_id] = $v->master_name; 
		}
		}
		 Yii::app()->cache->set($cacheKey, $items,60 * 60 * 24 * 360  );
		 return $items; 
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
            'master_name' => 'Unit Name',
            'value' => '1 Unit = __ SQ.M.?',
            'is_default' => 'Is Default',
            'country_id' => 'Country',
            'date_added' => 'Date Added',
            'last_updated' => 'Last Updated',
        );
    }
 protected function beforeValidate()
    {
        
        if ($this->is_default == '0' ) {
            $hasDefault = self::model()->countByAttributes(array('is_default' => '1'));
            if (empty($hasDefault)) {
                $this->is_default = '1';
                $this->value = '1';
            }
        }
        
        return parent::beforeValidate();
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
        $criteria->compare('is_default',$this->is_default,true);
        //$criteria->compare('country_id',$this->country_id);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    	public function countryOption(){
		return array(
		'0' =>'All listing  countries',
		'1' =>'Only for selected countries',
		
		);
	}
	public function afterSave(){
	 
	 
				if ($this->is_default == '1') {
            self::model()->updateAll(array('is_default' => '0'), array('condition' => 'master_id != :cid', 'params' => array(':cid' => (int)$this->master_id)));
        }
        return parent::afterSave();
		 
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AreaUnit the static model class
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
