<?php

/**
 * This is the model class for table "{{price_trends}}".
 *
 * The followings are the available columns in table '{{price_trends}}':
 * @property integer $id
 * @property integer $state_id
 * @property integer $sect_id
 * @property integer $type_id
 * @property integer $cat_id
 * @property string $bed
 * @property string $month
 * @property string $year
 * @property string $g_date
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property Category $cat
 * @property Section $sect
 * @property States $state
 * @property Category $type
 */
class PriceTrends extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{price_trends}}';
    }
    public $rowid; 
    public $month; 
    public $year; 

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('state_id, price', 'required'),
            array('state_id, sect_id, type_id, cat_id', 'numerical', 'integerOnly'=>true),
            array('price', 'numerical' ),
            array('bed', 'length', 'max'=>3),
             array('year', 'length', 'max'=>4),
            array('rowid,month,year,g_date', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, state_id, sect_id, type_id, cat_id, bed, month, year, g_date, date_added, last_updated', 'safe', 'on'=>'search'),
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
            'cat' => array(self::BELONGS_TO, 'Category', 'cat_id'),
            'sect' => array(self::BELONGS_TO, 'Section', 'sect_id'),
            'state' => array(self::BELONGS_TO, 'States', 'state_id'),
            'type' => array(self::BELONGS_TO, 'Category', 'type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'state_id' => 'State',
            'sect_id' => 'Sect',
            'type_id' => 'Type',
            'cat_id' => 'Cat',
            'bed' => 'Bed',
            'month' => 'Month',
            'year' => 'Year',
            'g_date' => 'G Date',
            'date_added' => 'Date Added',
            'last_updated' => 'Last Updated',
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
        $criteria->compare('state_id',$this->state_id);
        $criteria->compare('sect_id',$this->sect_id);
        $criteria->compare('type_id',$this->type_id);
        $criteria->compare('cat_id',$this->cat_id);
        $criteria->compare('bed',$this->bed,true);
        $criteria->compare('month',$this->month,true);
        $criteria->compare('year',$this->year,true);
        $criteria->compare('g_date',$this->g_date,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PriceTrends the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public $total_items;
    public function pricetrends1($ar){
		if(!empty($ar)){ 
	    	$criteria = new CDbCriteria;
	    	$criteria->condition = '1'; 
			 
			if(!empty($ar['category_id'])){
				$criteria->compare('t.type_id',(int)$ar['category_id']);
			}
			if(!empty($ar['listing_type'])){
				$criteria->compare('t.cat_id',(int)$ar['listing_type']);
			}
			if(!empty($ar['bedrooms'])){
					
				  $criteria->compare('t.bed',$ar['bedrooms']);
			}
			if(!empty($ar['state'])){
				 
				$criteria->compare('t.state_id',(int)$ar['state']);
			}
			
			if(!empty($ar['section_id']) ){
				
				$criteria->compare('t.sect_id',(int)$ar['section_id']);
	    	   $criteria->select ='sum(t.price) as price,count(t.id) as total_items,t.g_date as date_added';
			}
			 
	     	$criteria->group     = 'MONTH(t.g_date),YEAR(t.g_date)';
	    	$criteria->limit     = 18;
	    	return self::model()->findAll($criteria);
		}
		else{
			return false; 
		}

	}
}
