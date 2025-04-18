<?php

/**
 * This is the model class for table "mw_contact".
 *
 * The followings are the available columns in table 'mw_contact':
 * @property integer $contact_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property integer $ad_id
 * @property string $added_date
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 */
class Contact extends ActiveRecord
{
    public $verifyCode;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_contact';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email, phone, message', 'required'),
            array('ad_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 250),
            array('email', 'length', 'max' => 150),
            array('email', 'email'),

            array('phone', 'length', 'max' => 15),
            array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty' => !CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
            array('verifyCode', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('contact_id, name, email, phone, message, ad_id, added_date,verifyCode', 'safe', 'on' => 'search'),
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
            'ad' => array(self::BELONGS_TO, 'PlaceAnAd', 'ad_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'contact_id' => 'Contact',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'message' => 'Message',
            'ad_id' => 'Ad',
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

        $criteria = new CDbCriteria;

        $criteria->compare('contact_id', $this->contact_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('ad_id', $this->ad_id);
        $criteria->compare('added_date', $this->added_date, true);
        $criteria->together = true;
        $criteria->with = array('ad' => array("condition" => "ad.isTrash='0'"));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
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
     * @return Contact the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
