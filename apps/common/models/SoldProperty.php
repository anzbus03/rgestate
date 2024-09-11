<?php

/**
 * This is the model class for table "{{sold_property}}".
 *
 * The followings are the available columns in table '{{sold_property}}':
 * @property integer $sold_id
 * @property integer $user_id
 * @property integer $property_id
 * @property string $sold_price
 */
class SoldProperty extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{sold_property}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('user_id, property_id, sold_price', 'required'),
            array('sold_price', 'numerical'),
            array('property_id, user_id', 'numerical', 'integerOnly' => true),
        );
    }


    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        $relations = array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'property' => array(self::BELONGS_TO, 'Property', 'property_id'),
        );

        // Merges the defined relations with the parent relations (if any).
        return \CMap::mergeArray($relations, parent::relations());
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'sold_id' => 'Sold ID',
            'user_id' => 'User ID',
            'property_id' => 'Property ID',
            'sold_price' => 'Sold Price',
        ];
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

        $criteria = new CDbCriteria;

        // Filters for searching
        $criteria->compare('sold_id', $this->sold_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('property_id', $this->property_id);
        $criteria->compare('sold_price', $this->sold_price, true);
        $criteria->compare('isTrash', '0'); // Only retrieve non-deleted entries

        // Ordering results by sold_id descending
        $criteria->order = 't.sold_id desc';

        return new \CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20, // Define page size (or use dynamic configuration)
                'pageVar' => 'page',
            ),
        ));
    }

    /**
     * List data function to retrieve properties that are active and not trashed.
     * 
     * @return array of SoldProperty models
     */
    public function listData()
    {
        $criteria = new \CDbCriteria;
        $criteria->select = "sold_id, sold_price";
        $criteria->condition = "t.status='A' AND t.isTrash='0'";
        $criteria->order = "t.sold_price DESC";

        return $this->findAll($criteria);
    }

    /**
     * Find sold properties by a specific user.
     * 
     * @param integer $userId
     * @return array of SoldProperty models
     */
    public function findByUser($userId)
    {
        $criteria = new \CDbCriteria;
        $criteria->compare('user_id', $userId);
        $criteria->compare('isTrash', '0'); // Ensure non-deleted properties
        $criteria->order = 't.sold_id DESC'; // Order by the latest sold properties

        return $this->findAll($criteria);
    }

    /**
     * Find sold properties within a specific price range.
     * 
     * @param float $minPrice
     * @param float $maxPrice
     * @return array of SoldProperty models
     */
    public function findByPriceRange($minPrice, $maxPrice)
    {
        $criteria = new \CDbCriteria;
        $criteria->addBetweenCondition('sold_price', $minPrice, $maxPrice);
        $criteria->compare('isTrash', '0'); // Ensure non-deleted properties
        $criteria->order = 't.sold_price ASC'; // Order by price ascending

        return $this->findAll($criteria);
    }

    /**
     * Find a sold property by its ID.
     * 
     * @param integer $soldId
     * @return SoldProperty|null
     */
    public function findBySoldId($soldId)
    {
        return $this->findByPk($soldId, 'isTrash = :isTrash', ['isTrash' => '0']);
    }


    public function beforeSave()
    {
        if ($this->isNewRecord) {
            // Set the created_at field to the current timestamp
            $this->created_at = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }



    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return sold_property the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
