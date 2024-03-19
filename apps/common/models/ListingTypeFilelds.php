<?php

/**
 * This is the model class for table "{{listing_type_filelds}}".
 *
 * The followings are the available columns in table '{{listing_type_filelds}}':
 * @property integer $category_id
 * @property string $listing_type
 *
 * The followings are the available model relations:
 * @property Category $category
 */
class ListingTypeFilelds extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{listing_type_filelds}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, listing_type', 'required'),
            array('category_id', 'numerical', 'integerOnly'=>true),
            array('listing_type', 'length', 'max'=>3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id, listing_type', 'safe', 'on'=>'search'),
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
            'listing_type' => 'Listing Type',
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
        $criteria->compare('listing_type',$this->listing_type,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ListingTypeFilelds the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
