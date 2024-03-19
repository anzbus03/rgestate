<?php

/**
 * This is the model class for table "mw_city".
 *
 * The followings are the available columns in table 'mw_city':
 * @property integer $city_id
 * @property string $city_name
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $priority
 * @property string $isTrash
 * @property string $status
 */
class SubCommunity extends ActiveRecord
{
 
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_sub_community';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('community_id,sub_community_name', 'required'),
            array('community_id,sub_community_id', 'numerical', 'integerOnly'=>true),
            array('sub_community_name', 'length', 'max'=>250),
            array('community_id, sub_community_name ,sub_community_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('community_id, sub_community_name ,sub_community_id', 'safe', 'on'=>'search'),
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
         //  'city' => array(self::BELONGS_TO, 'City', 'city_id'),
          'community' => array(self::BELONGS_TO, 'Community', 'community_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'city_id' => 'City',
            'community_id' => 'Community',
            'city_name' => 'City Name',
            'country_id' => 'Country',
            'state_id' => 'Region',
            'priority' => 'Priority',
            'isTrash' => 'Is Trash',
            'status' => 'Status',
            'region_id' => 'Status',
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
     public $community_name;
     public $country_id;
     public $region_id;
     public function getCommmunityLink(){
		return CHtml::link($this->community_name,Yii::app()->createUrl('community/update',array('id'=>$this->community_id)),array('target'=>'_blank'));
	 }
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

       // $criteria->compare('district_id',$this->district_id);
        $criteria->select= 't.*,cm.community_name';
        $criteria->compare('sub_community_id',$this->sub_community_id);
        //$criteria->compare('community_id',$this->community_id);
        $criteria->compare('sub_community_name',$this->sub_community_name,true);
        $criteria->join  .= 'LEFT JOIN {{community}} cm on cm.community_id = t.community_id  ';
		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
    public function subCommunities($id=null)
	{
		$criteria=new CDbCriteria;
		 $criteria->condition = "t.community_id=:community_id";
		 $criteria->params[":community_id"] = $id ; 
		 $criteria->order  = "sub_community_name" ; 
		 return $this->findAll($criteria);
	}
 

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return City the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
}
