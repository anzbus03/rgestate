<?php

/**
 * This is the model class for table "mw_contact_us".
 *
 * The followings are the available columns in table 'mw_contact_us':
 * @property integer $id
 * @property integer $type
 * @property string $email
 * @property string $name
 * @property string $meassage
 * @property string $city
 * @property string $date
 */
class AdvertisementContact extends ActiveRecord
{
	 public $verifyCode;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_contact_us';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, name,phone', 'required'),
            array('type,phone', 'numerical', 'integerOnly'=>true),
            array('email, name', 'length', 'max'=>150),
            array('city', 'length', 'max'=>250),
            array('phone', 'length', 'min'=>8),
            array('phone', 'length', 'max'=>14),
            array('email', 'email'),
           // array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
           // array('verifyCode', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, email, name, meassage, city, date', 'safe', 'on'=>'search'),
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
    public function beforeSave(){
		parent::beforeSave();
		$this->contact_type  = 'AD';
		return true;
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Subject',
            'email' => 'Email',
            'name' => 'Name',
            'meassage' => 'Message',
            'city' => 'Subject',
            'date' => 'Date',
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
        $criteria->compare('id',$this->id);
        $criteria->compare('type',$this->type);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('meassage',$this->meassage,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('contact_type','AD');
         $criteria->order="id desc";
		$pageSize = (Yii::app()->request->getQuery("page_size")) ?  (int) Yii::app()->request->getQuery("page_size") : $pageSize = 10;
		return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
		'pagination'=>array(
		'pageSize'=>$pageSize,
		),
		));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ContactUs the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function Model_type()
    {
		return array(
		
		'1' => 'Need help with a technical problem',
		'2' => 'Report Copyright Infringement',
		'3' => 'Report Spam/Abuse/Fraud',
		'4' => 'Advertising on RsClassify',
		'5' => 'My property listing account',
		'6' => 'My Autos listing account',
		'7' => 'Feedback / suggestions',
		'8' => 'Other / General business inquiry',
		 
		);
	}
    public function getType($id)
    {
		$ar = $this->Model_type();
		return  (isset($ar[$id]))?  $ar[$id] : 'No Subject Defined';
		 
		 
	}
}
