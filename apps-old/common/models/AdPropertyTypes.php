<?php

/**
 * This is the model class for table "{{ad_property_types}}".
 *
 * The followings are the available columns in table '{{ad_property_types}}':
 * @property integer $ad_id
 * @property integer $row_id
 * @property string $size
 * @property string $size_to
 * @property string $from_price
 * @property string $to_price
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 */
class AdPropertyTypes extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{ad_property_types}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
      public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id, title, row_id', 'required'),
            array('ad_id, row_id', 'numerical', 'integerOnly'=>true),
            array('size, size_to, from_price, to_price', 'length', 'max'=>10),
            array('a_unit, p_unit', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ad_id, row_id, size, size_to, from_price, to_price', 'safe', 'on'=>'search'),
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
            'au' => array(self::BELONGS_TO, 'AreaUnit', 'a_unit'),
            'pu' => array(self::BELONGS_TO, 'PriceUnit', 'p_unit'),
        );
    }
    public function getAreaTile(){
		$unit = 'Sq. Ft.';
		if(!empty($this->a_unit)){
			$unit = $this->au->master_name;
		}
		if(!empty($this->size_to) and $this->size_to != '0.00' ){
		  $unit_title = 	$this->size.' - '. $this->size_to.' <b>'.$unit.'</b>';
		}
		else{
			 $unit_title = 	$this->size.' <b>'.$unit.'</b>';
		}
		return Yii::t('app',$unit_title,array('.00'=>''));
	}
    public function getPriceTile(){
        	if(!empty($this->from_price) and $this->from_price !='0.00'){ 
		$unit = '';
		if(!empty($this->p_unit)){
		    	$unit = $this->pu->master_name;
			
        	     
		}
		if(!empty($this->to_price) and $this->to_price != '0.00' ){
        		      $unit_title =   $this->from_price  . ' - ' .     $this->to_price   ; 
        		   
        		}
        		else{
        		  	 $unit_title =   $this->from_price ; 
        		}
        		$unit_title  =  $unit_title.' '.$unit ; 
		return Yii::t('app',$unit_title,array('.00'=>''));
        	}
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ad_id' => 'Ad',
            'row_id' => 'Row',
            'size' => 'Size',
            'size_to' => 'Size To',
            'from_price' => 'From Price',
            'to_price' => 'To Price',
            'a_unit' => 'Area Unit',
            'p_unit' => 'Price Unit',
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
        $criteria->compare('row_id',$this->row_id);
        $criteria->compare('size',$this->size,true);
        $criteria->compare('size_to',$this->size_to,true);
        $criteria->compare('from_price',$this->from_price,true);
        $criteria->compare('to_price',$this->to_price,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdPropertyTypes the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
