 <?php

/**
 * This is the model class for table "mw_fuel_type".
 *
 * The followings are the available columns in table 'mw_fuel_type':
 * @property integer $fuel_id
 * @property string $fuel_name
 * @property string $status
 * @property string $isTrash
 * @property integer $priority
 */
class FuelType extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_fuel_type';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fuel_name', 'required'),
            array('priority', 'numerical', 'integerOnly'=>true),
            array('fuel_name', 'length', 'max'=>150),
            array('status, isTrash', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('fuel_id, fuel_name, status, isTrash, priority', 'safe', 'on'=>'search'),
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
            'fuel_id' => 'Fuel',
            'fuel_name' => 'Fuel Type',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
            'priority' => 'Priority',
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

      
        $criteria->compare('fuel_name',$this->fuel_name,true);
        $criteria->compare('isTrash','0',true);
        $criteria->compare('status','A',true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
      	public function  listData()
    {
		 $criteria=new CDbCriteria;
		  $criteria->condition = "t.isTrash='0' and t.status='A'";
		 $criteria->order = "fuel_name";
		 return $this->findAll($criteria);
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FuelType the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
