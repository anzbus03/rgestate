<?php

/**
 * This is the model class for table "{{master_category}}".
 *
 * The followings are the available columns in table '{{master_category}}':
 * @property integer $category_id
 * @property integer $category_name
 * @property string $status
 * @property string $isTrash
 * @property string $date_added
 * @property string $last_updated
 */
class MasterCategory extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{master_category}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_name', 'required'),
            array('category_name', 'unique'),
            array('category_name', 'length', 'max'=>250),
            array('status, isTrash', 'length', 'max'=>1),
            array('date_added, last_updated', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id, category_name, status, isTrash, date_added, last_updated', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'category_id' => 'Category',
            'category_name' => 'Category Name',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
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

        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('category_name',$this->category_name);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('isTrash',$this->isTrash,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);

         return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
    public function listData()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('isTrash','0');
        return self::model()->findAll($criteria);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MasterCategory the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
