<?php

/**
 * This is the model class for table "{{mw_authors}}".
 *
 * The followings are the available columns in table '{{mw_authors}}':
 * @property integer $author_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $date_added
 * @property string $last_updated
 */
class BlogAuthors extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{authors}}';
    }
    public function getPrimaryField(){
        return 'author_id';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name,description', 'required'),
            array('name,description,image', 'length', 'max'=>250),
            array('name,description,image', 'safe'),
            array('author_id, name, description, image, date_added, last_updated', 'safe', 'on'=>'search'),
        );
    }
    public function getPermalink($absolute = false)
    {
        return Yii::app()->apps->getAppUrl('frontend', $this->name .'/blog', $absolute);
    }
    public function beforeSave(){
		parent::beforeSave();
		return true;
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Author Name',
            'description' => 'Author Description',
            'image' => 'Author Image',
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

        $criteria->compare('author_id',$this->author_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('description',$this->description);
        $criteria->compare('image',$this->image);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder' => array(
                    'author_id' => CSort::SORT_DESC,
                ),
            ),
        ));
    }
    public function afterSave(){
		parent::aftersave();
		return true; 
	}
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}