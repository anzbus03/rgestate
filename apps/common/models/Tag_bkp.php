<?php

/**
 * This is the model class for table "{{tag}}".
 *
 * The followings are the available columns in table '{{tag}}':
 * @property integer $tag_id
 * @property string $tag_name
 * @property string $date_added
 * @property string $last_update
 * @property string $tag_sub_title
 * @property string $tag_type
 */
class Tag extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{tag}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tag_name,tag_sub_title,color_code,now_of_rows', 'required'),
            array('tag_id,priority,now_of_rows', 'numerical', 'integerOnly'=>true),
            array('tag_name,  ', 'length', 'max'=>250),
            array('  tag_sub_title', 'length', 'max'=>10),
            array('color_code', 'length', 'max'=>7),
            array('tag_type', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('tag_id, tag_name, date_added, last_update, tag_sub_title, tag_type', 'safe', 'on'=>'search'),
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
            'tag_id' => 'Tag',
            'tag_name' => 'Tag Name',
            'date_added' => 'Date Added',
            'last_update' => 'Last Update',
            'tag_sub_title' => 'Tag Short Code',
            'tag_sub_title' => 'Tag Short Code',
            'tag_type' => 'Tag Type',
            'now_of_rows' => 'No Of Properties in one row',
        );
    }
   public function arrayList(){
	   return array(
	   '5'=>'5 Coloumns',
	   '3'=>'3 Coloumns',
	   '4'=>'4 Coloumns /No Slider',
	   
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

        $criteria->compare('tag_id',$this->tag_id);
        $criteria->compare('tag_name',$this->tag_name,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_update',$this->last_update,true);
        $criteria->compare('tag_sub_title',$this->tag_sub_title,true);
        $criteria->compare('tag_type',$this->tag_type,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
	public function getTagCodeWithColor(){
		return $this->tag_sub_title.'|'.$this->color_code;
	}
	public function listData(){
		 $criteria=new CDbCriteria;$criteria->order = '-t.priority desc';
		return self::model()->findAll($criteria);
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tag the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
