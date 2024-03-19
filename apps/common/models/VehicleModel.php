<?php

/**
 * This is the model class for table "mw_model".
 *
 * The followings are the available columns in table 'mw_model':
 * @property integer $model_id
 * @property integer $sub_category_id
 * @property string $model_name
 * @property string $isTrash
 * @property string $status
 * @property integer $priority
 */
class VehicleModel extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_model';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sub_category_id, model_name', 'required'),
            array('sub_category_id, priority', 'numerical', 'integerOnly'=>true),
            array('model_name', 'length', 'max'=>250),
            array('isTrash, status', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('model_id, sub_category_id, model_name, isTrash, status, priority', 'safe', 'on'=>'search'),
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
          'subCategory' => array(self::BELONGS_TO, 'Subcategory', 'sub_category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'model_id' => 'Model',
            'sub_category_id' => 'Sub Category',
            'model_name' => 'Model Name',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'priority' => 'Priority',
        );
    }
   public function findByModels($id)
   {
	    $criteria=new CDbCriteria;
	    $criteria->condition = "t.status='A' and isTrash='0' and sub_category_id=:sub";
	    $criteria->params[":sub"] = $id;
	    return $this->findAll($criteria);
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
    public function search($id)
    {
		 
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('model_id',$this->model_id);
        $criteria->compare('sub_category_id',$id);
        $criteria->compare('model_name',$this->model_name,true);
        $criteria->compare('isTrash',0,true);
        $criteria->compare('status','A',true);
        $criteria->order="model_name";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Model the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
       public function  ListDataForJSON_ID_ByModel($id)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and  t.status='A' and sub_category_id=:id";
		 $criteria->params[":id"] = $id;
		 $criteria->select ="model_id,model_name";
		 $criteria->order="model_name";
		 $arra =  $this->findAll($criteria);
		 
		 $ar =array();
		
		 if($arra)
		 {
			 foreach($arra as $k=>$v)
			 {
				 $ar[]= array("id"=>$v->model_id , "name" => $v->model_name );
			 }
		 }
	     $ar[]= array("id"=>0 , "name" => 'Others' );
		 return CJSON::encode(array_merge(array("0"=>"Select Model"), $ar));
	}
}
