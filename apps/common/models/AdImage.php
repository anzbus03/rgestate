<?php

/**
 * This is the model class for table "mw_ad_image".
 *
 * The followings are the available columns in table 'mw_ad_image':
 * @property integer $id
 * @property integer $ad_id
 * @property string $image_name
 * @property integer $priority
 * @property string $isTrash
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 */
class AdImage extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_ad_image';
    }

    /**
     * @return array validation rules for model attributes.
     */
     public $xml_image;
     public $image_type;
     public $Title;
     public $IsMarketingImage;
     public $ImageRemarks;
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id, image_name', 'required'),
            array('ad_id, priority', 'numerical', 'integerOnly'=>true),
            array('image_name', 'length', 'max'=>250),
            array('isTrash,status', 'length', 'max'=>1),
            array('xml_image,image_type , Title , IsMarketingImage , ImageRemarks ', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ad_id, image_name, priority, isTrash,status', 'safe', 'on'=>'search'),
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
            'imageCount' => array(self::STAT, 'PlaceAnAd', 'ad_id','condition'=>"t.isTrash='0' and t.status='A'"),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'ad_id' => 'Ad',
            'image_name' => 'Image Name',
            'priority' => 'Priority',
            'isTrash' => 'Is Trash',
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
        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('image_name',$this->image_name,true);
        $criteria->compare('priority',$this->priority);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('isTrash','0',true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdImage the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function HighestPriorityImage($ad_id)
    {
		 $criteria=new CDbCriteria;
		 $criteria->condition = "t.ad_id=:ad_id and isTrash='0' and status='A'";
		 $criteria->params[':ad_id'] = $ad_id;
		 $criteria->order = "priority";
		 return $this->find($criteria);
	}
 
	public function listImage($id)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('ad_id',$this->ad_id);
        $criteria->order = "t.priority,t.id asc";
        $criteria->condition = "t.ad_id=:ad_id and isTrash='0'";
        // $criteria->compare('status',$this->status);
        $criteria->params[':ad_id'] = $id;
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public function activeArray()
    {
		$arr = array("A"=>"Approved","I"=>"Disapproved");
		return $arr;
	}
	 public function getStatusWithStats($sta=null)
    {
	  $ar = $this->activeArray();
	   return (isset($ar[$sta]))?$ar[$sta]:"Inactive";
		 
    }
	 public function getimageLink()
    {
        if (strpos( $this->image_name ,'/') !== false) {
					
					
					  
					 return Yii::app()->apps->getBaseUrl('uploads/files/'.$this->image_name );;
					 
						
						
					}else{
					return  ENABLED_AWS_PATH.$this->image_name ; 
					}
	   
 
		 
    }
    public function getdetailImages($im)
	   { 
					 if (strpos($im ,'/') !== false) {
					
					
					  
					 return Yii::app()->apps->getBaseUrl('uploads/files/'.$im );;
					 
						
						
					}else{
					return  ENABLED_AWS_PATH.$im; 
					}
			 
   }
    public function  list_profile($count_future=false,$formData=array(),$type=null,$return = false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		if(isset($formData['status']) and $formData['status'] != 'All' ){ 
			$criteria->compare('status',$formData['status']);
		}
		/*
        $criteria->compare('id',$this->id);
        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('image_name',$this->image_name,true);
        $criteria->compare('priority',$this->priority);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('isTrash','0',true);
		*/
		  
		 $criteria->order = 't.id  desc';
		 
		 if($return){ return $criteria; }
		 
			$criteria->limit  = Yii::app()->request->getQuery('limit','10');
			$criteria->offset = Yii::app()->request->getQuery('offset','0');
			
			if(!empty($count_future)){
				 
				$Result = self::model()->findAll($criteria);
				$criteria->offset = $criteria->limit+$criteria->offset   ;
				$criteria->select = 't.id'; 
				$criteria->limit = '1'; 
				 
				$future_count = self::model()->find($criteria);
				return array('result'=>$Result,'future_count'=>$future_count);
			}
			else{
				return  self::model()->findAll($criteria)  ; 
			 
			}
         
	}
	protected function afterDelete()
    {
		 
        if (!empty($this->image_name)) {
			
            // clean customer files, if any.
            $storagePath = Yii::getPathOfAlias('root.uploads.files');
            $customerFiles = $storagePath.'/'.$this->image_name;
          
            if (file_exists($customerFiles) && is_file($customerFiles)) {
				  @unlink($customerFiles);
            }  
            
        }

        parent::afterDelete();
    }
}
