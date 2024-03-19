<?php
class TranslateRelation extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{translate_relation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('translate_id, rec', 'required'),
            array('translate_id, rec, job_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('translate_id, rec', 'safe', 'on'=>'search'),
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
          
            'translate' => array(self::BELONGS_TO, 'Translate', 'translate_id'),
            'translateData' =>array(self::HAS_ONE, 'TranslationData', 'translation_id','on'=>'translateData.lang=:lang','params'=>array(':lang'=> OptionCommon::getLanguage())),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'translate_id' => 'Translate',
            'rec' => 'Rec',
            'job_id' => 'Job',
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

        $criteria->compare('translate_id',$this->translate_id);
        $criteria->compare('rec',$this->rec);
       
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    
    

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TranslateRelation the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
