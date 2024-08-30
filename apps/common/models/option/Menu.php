<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property integer $id
 * @property string $url
 * @property string $name
 * @property integer $parent_id
 * @property string $date_added
 * @property string $last_updated
 *
 */
class Menu extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{menu}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, parent_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, url, name, parent_id, date_added, last_updated', 'safe', 'on'=>'search'),
        );
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
            'id' => 'ID',
            'url' => 'URL',
            'name' => 'Menu Name',
            'parent_id' => 'Main Menu'
        );
    }
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('url',$this->url);
        $criteria->compare('name',$this->name);
        $criteria->compare('parent_id',$this->parent_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
}