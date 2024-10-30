<?php

/**
 * This is the model class for table "{{ad_floor_plan}}".
 *
 * The followings are the available columns in table '{{ad_floor_plan}}':
 * @property integer $floor_id
 * @property integer $ad_id
 * @property string $floor_title
 * @property string $floor_file
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 */
class AdFloorPlan extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{ad_floor_plan}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id,floor_title,floor_file', 'required'),
            array('floor_id, ad_id', 'numerical', 'integerOnly'=>true),
            array('floor_title, floor_file', 'length', 'max'=>250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('floor_id, isTrash, ad_id, floor_title, floor_file', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'floor_id' => 'Floor',
            'ad_id' => 'Ad',
            'floor_title' => 'Floor Title',
            'floor_file' => 'Floor File',
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

        $criteria->compare('floor_id',$this->floor_id);
        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('floor_title',$this->floor_title,true);
        $criteria->compare('floor_file',$this->floor_file,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
 public $category ; 
    public function getFileDetails(){
	
			$items = explode('|||',$this->floor_file);
			if(isset($items['2'])){
				$this->floor_file 	 = $items['2'];
				$this->floor_title   = $items['1'];
				$this->category		 = $items['0'];
			}
			else if(isset($items['1'])){
				//$this->floor_file 	 = $items['2'];
				$this->floor_file   = $items['1'];
				$this->category		 = $items['0'];
			}
	
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdFloorPlan the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
