<?php

/**
 * This is the model class for table "mw_banner_position".
 *
 * The followings are the available columns in table 'mw_banner_position':
 * @property integer $position_id
 * @property string $position_name
 * @property integer $status
 * @property string $isTrash
 * @property string $banner_width
 * @property string $banner_height
 */
class BannerPosition extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_banner_position';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('position_name, banner_width, banner_height,slider', 'required'),
           
            array('position_name', 'length', 'max'=>250),
            array('isTrash', 'length', 'max'=>1),
            array('banner_width, banner_height', 'length', 'max'=>3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('position_id, position_name, status, isTrash, banner_width, banner_height', 'safe', 'on'=>'search'),
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
            'one' => array(self::HAS_ONE, 'Banner', 'position_id','on'=>"one.isTrash='0'",'joinType'=>'INNER JOIN'),
            'many' => array(self::HAS_MANY, 'Banner', 'position_id','on'=>"many.isTrash='0'",'joinType'=>'INNER JOIN'),
        );
      
    }
       	public function  listData()
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.isTrash='0' and status='A'";
		 
		 $criteria->order="position_name";
		  return $this->findAll($criteria);
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'position_id' => 'Position',
            'position_name' => 'Position Name',
            'status' => 'Status',
            'isTrash' => 'Is Trash',
            'banner_width' => 'Banner Width',
            'banner_height' => 'Banner Height',
            'slider' =>'Slide show'
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

        $criteria->compare('position_id',$this->position_id);
        $criteria->compare('position_name',$this->position_name,true);
        $criteria->compare('isTrash',0,true);
        $criteria->compare('status','A',true);
        $criteria->compare('banner_width',$this->banner_width,true);
        $criteria->compare('banner_height',$this->banner_height,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BannerPosition the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    	function getPosition()
	{
		 static $_options = array();
		 
		 $r= $this->findAll(array("condition"=>"isTrash='0' and t.status='A'" ,"order"=>"position_name"));
	 
		 if($r)
		 {
			 foreach($r as $k=>$v)
			 {
				  $_options[$v->position_id] =  $v->position_name; 
			 }
	     }
	     return $_options;
		 
	}
	public function positionFinder($id)
	{
		 
		 
		return $this->findByPk($id) ;
		 
	}
}
