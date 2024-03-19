<?php

/**
 * This is the model class for table "mw_amenities_subcategory_list".
 *
 * The followings are the available columns in table 'mw_amenities_subcategory_list':
 * @property integer $sub_category_id
 * @property integer $amenities_id
 *
 * The followings are the available model relations:
 * @property Amenities $amenities
 * @property Subcategory $subCategory
 */
class AmenitiesCategoryList extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_amenities_category_list';
    }

    public function primaryKey(){
    	return 'category_id';
	}
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, amenities_id', 'required'),
            array('category_id, amenities_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id, amenities_id', 'safe', 'on'=>'search'),
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
            'amenities' => array(self::BELONGS_TO, 'Amenities', 'amenities_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'category_id' => 'Category',
            'amenities_id' => 'Amenities',
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

        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('amenities_id',$this->amenities_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AmenitiesSubcategoryList the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
