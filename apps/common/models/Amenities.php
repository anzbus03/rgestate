<?php

/**
 * This is the model class for table "mw_amenities".
 *
 * The followings are the available columns in table 'mw_amenities':
 * @property integer $amenities_id
 * @property string $amenities_name
 * @property string $isTrash
 * @property string $status
 * @property integer $priority
 */
class Amenities extends ActiveRecord
{
	public $amenities_available_for;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_amenities';
    }
 public function getPrimaryField(){
		 return 'am_id';
	 }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('amenities_name,master_id', 'required'),
            array('amenities_name', 'unique'),
            array('priority', 'numerical', 'integerOnly'=>true),
            array('amenities_name', 'length', 'max'=>250),
            array('isTrash, status', 'length', 'max'=>1),
            array('Title,f_type,i_o,dy', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('amenities_id, amenities_name, isTrash, status, priority', 'safe', 'on'=>'search'),
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
           'relatedCategory' => array(self::HAS_MANY, 'AmenitiesCategoryList', 'amenities_id'),
           'master' => array(self::BELONGS_TO, 'Master', 'master_id'),
        );
    }
      public function getAmentiesValid(){
		$valid =  $this->dy== '1' ? '<i class="fa text-red  fa-check-circle"></i>' : '<i class="fa text-green  fa-check-circle"></i>';
		return $this->amenities_name.' '.$valid;
	}
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'dy' => 'Is Approved',
            'amenities_id' => 'Amenities',
            'amenities_name' => 'Amenities Name',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'priority' => 'Priority',
               'master_id' => 'Category',
               'f_type' => 'Field Type',
               'i_o' => 'integer Only',
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
        $criteria->compare('amenities_name',$this->amenities_name,true);
        $criteria->compare('isTrash','0',true);
        $criteria->compare('status','A',true);
        $criteria->compare('master_id',$this->master_id);
        $criteria->order = 't.priority,amenities_name' ;
         $criteria->order="t.amenities_id desc";
	 	return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
	   'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
		));
    }
    public function findAllCategories($id)
    {
	 
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;$criteria->select  = 't.*'; 
        $criteria->compare('isTrash','0');
        $criteria->compare('status','A');
        $criteria->compare('t.master_id',(int)$id);
        if(defined('LANGUAGE') and LANGUAGE != 'en'){ 
			$criteria->params[':lan'] = LANGUAGE;
			$criteria->join  .= ' left join `mw_translate_relation` `translationRelation` on translationRelation.am_id = t.amenities_id   LEFT  JOIN mw_translation_data tdata ON (`translationRelation`.translate_id=tdata.translation_id and tdata.lang=:lan) ';
			$criteria->select .= ' ,CASE WHEN tdata.message IS NOT NULL THEN    tdata.message ELSE t.amenities_name END  AS amenities_name ';
			}
			 
        $criteria->order = 't.f_type ="2" desc ,  t.f_type ="1" desc , -t.priority desc,t.master_id asc ' ;
        
	 	return  self::model()->findAll($criteria) ;
    }
     public function  ListDataWithAmenities($id=null)
    {
		 $criteria=new CDbCriteria;
		 $criteria->select = "amenities_name,amenities_id";
		 $criteria->condition = "t.isTrash='0' and t.status='A'";
		 $criteria->params[":req"] = 'Y' ; 
		 $criteria->order="amenities_name";
		 return $this->with(array("relatedCategory"=>array("select"=>false,"on"=>"relatedCategory.category_id=$id",'joinType'=>'INNER JOIN',)))->findAll($criteria);
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Amenities the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
       public function findfromArray($amenitiesListArray){
		$criteria=new CDbCriteria;
		$criteria->addInCondition('TRIM(LOWER(t.amenities_name))', $amenitiesListArray);
	 
		return $this->findAll($criteria);
	 }
}
