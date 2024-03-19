<?php

/**
 * This is the model class for table "{{common_tags}}".
 *
 * The followings are the available columns in table '{{common_tags}}':
 * @property integer $id
 * @property string $conversion_tag
 */
class CommonTags extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{common_tags}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('conversion_tag', 'required'),
            array('conversion_tag', 'unique'),
            array('conversion_tag', 'safe'),
            array('conversion_tag', 'length', 'max'=>30),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, conversion_tag', 'safe', 'on'=>'search'),
        );
    }
    
      public function getPrimaryField(){
		 return 'tag_id';
	 }
     public function getFullName(){
		 return $this->conversion_tag;
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
            'id' => 'ID',
            'conversion_tag' => 'Conversion Tag',
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
     public $translation;
    public function search($return = false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
$criteria->select = 't.*,td.message as translation';
        $criteria->compare('id',$this->id);
        $criteria->compare('conversion_tag',$this->conversion_tag,true);
        $criteria->join  = 'LEFT JOIN {{translate_relation}} tr ON t.id = tr.tag_id  ';
        $criteria->join  .= ' LEFT JOIN {{translation_data}} td ON tr.translate_id  = td.translation_id and td.lang ="ar" ';
$criteria->order='id desc';
if(!empty($return)){
	return $criteria;
}
         return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
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
     * @return CommonTags the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    
    public function getis_verifiedText(){
		$tex = $this->is_verified=='1' ? 'fa  fa-check-square-o  text-green' : 'fa fa-square text-red' ; 
		return CHtml::link('<i class=" '.$tex.'"></i>','javascript:void(0)',array('onclick'=>'upddatethis(this)','data-id'=>$this->id,'data-verify'=>$this->is_verified));
	}
}
