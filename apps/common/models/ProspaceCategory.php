<?php

/**
 * This is the model class for table "{{master}}".
 *
 * The followings are the available columns in table '{{master}}':
 * @property integer $master_id
 * @property string $name
 * @property string $f_type
 * @property string $status
 * @property string $is_trash
 * @property string $last_updated
 */
class ProspaceCategory extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
     const FTYPE = 'SL';
    public function tableName()
    {
        return '{{prospace_categories}}';
    }
	 
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category,type_id,category_id', 'required'),
             array('category', 'length', 'max'=>250),
            array('category, type_id, category_id', 'safe', 'on'=>'search'),
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
            'category' => 'Category Name in Prospace',
            'type_id' => 'Property Type',
            'category_id' => 'Category', 
        );
    }
    public function beforeSave(){
		parent::beforeSave();
		 
		return true; 
	} 
     
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;$criteria->condition = '1'; 
	      $criteria->compare('t.category',$this->category,true);
       		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    } 
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Master the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    } 
}
