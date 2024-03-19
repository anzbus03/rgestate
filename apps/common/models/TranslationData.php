<?php

/**
 * This is the model class for table "{{translation_data}}".
 *
 * The followings are the available columns in table '{{translation_data}}':
 * @property integer $translation_id
 * @property string $lang
 * @property string $message
 *
 * The followings are the available model relations:
 * @property Translate $translation
 */
class TranslationData extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{translation_data}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('translation_id, lang, message', 'required'),
            array('translation_id', 'numerical', 'integerOnly'=>true),
            array('lang', 'length', 'max'=>3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('translation_id, lang, message', 'safe', 'on'=>'search'),
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
            'translation' => array(self::BELONGS_TO, 'Translate', 'translation_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'translation_id' => 'Translation',
            'lang' => 'Lang',
            'message' => 'Message',
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

        $criteria->compare('translation_id',$this->translation_id);
        $criteria->compare('lang',$this->lang,true);
        $criteria->compare('message',$this->message,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TranslationData the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
