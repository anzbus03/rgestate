<?php

/**
 * This is the model class for table "mw_developers".
 *
 * The followings are the available columns in table 'mw_developers':
 * @property integer $developer_id
 * @property string $developer_name
 * @property string $description
 * @property string $logo
 * @property string $status
 * @property string $isTrash
 * @property string $added_date
 */
class Developers extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_developers';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('developer_name, description,     link_url ', 'required'),
            array('developer_name, logo', 'length', 'max'=>250),
            array('status, isTrash', 'length', 'max'=>1),
              array('logo', 'file', 'types'=>'jpg,jpeg, gif, png','allowEmpty'=>true ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('developer_id, developer_name, description, logo, status, isTrash, added_date', 'safe', 'on'=>'search'),
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
            'developer_id' => 'Developer',
            'developer_name' => 'Developer Name',
            'description' => 'Description',
            'logo' => 'Logo',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
            'added_date' => 'Added Date',
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

        $criteria->compare('developer_id',$this->developer_id);
        $criteria->compare('developer_name',$this->developer_name,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('logo',$this->logo,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('isTrash',0,true);
        $criteria->compare('added_date',$this->added_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Developers the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    function renderImage($image="")
	{
				 $image_name =Yii::app()->basePath . '/../../uploads/developer/'.$image;
				if(@GetImageSize($image_name)) {
					 
					return     $image; 
				}
				else
				{
					 
					return   Yii::app()->theme->baseUrl.'/images/ucnoimage.jpg'; 
				}
			
	}
} 
