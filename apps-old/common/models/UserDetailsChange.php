<?php

/**
 * This is the model class for table "{{user_details_change}}".
 *
 * The followings are the available columns in table '{{user_details_change}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $contact_name
 * @property string $phone
 * @property string $landline
 * @property string $date_added
 * @property string $status
 */
class UserDetailsChange extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user_details_change}}';
    }
    public $full_number;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, contact_name, phone', 'required'),
            array('user_id', 'numerical', 'integerOnly'=>true),
                array('phone', 'validatePhone'),
                array('phone', 'validateUnique'),
                array('phone', 'length', 'max'=>15),array('phone', 'length', 'min'=>10),
             array('mobile', 'validateLandline'),
            array('landline', 'length', 'max'=>150),
            array('phone, landline', 'length', 'max'=>20),
            array('status', 'length', 'max'=>1),
            array('full_number', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, contact_name, phone, landline, date_added, status', 'safe', 'on'=>'search'),
        );
    }
    	public function validateUnique($attribute,$params){
	 
			 $criteria=new CDbCriteria;
			 $last7 = substr($this->phone, -10);
			 if(strlen($last7)==10){
			 $criteria->compare('RIGHT(t.phone,10)', $last7);
			 //$criteria->compare('t.isTrash','0');
			  $criteria->compare('t.user_id!', $this->user_id);
			 $total_found = ListingUsers::model()->count($criteria);
			 if( $total_found > 0 ){
			     
			     	$this->addError($attribute,Yii::t('app','Phone ends with  "{num}" has already been taken',array('{num}'=> $last7)));
			 }
			 }
		 
	}
	 public   function beforeSave()
    {
        parent::beforeSave();
        $this->whatsapp = $this->whatsapp_false; 
        return true; 
    }
	public function afterSave(){
	   parent::afterSave();
	   		  $criteria=new CDbCriteria;
		   $criteria->select = 't.*, TIMESTAMPDIFF(MINUTE, case WHEN t.o_send_at IS NULL THEN t.date_added ELSE t.o_send_at  END , NOW()) AS hours_different ' ; 
		  $criteria->condition=" t.user_id= :params ";
		  $criteria->params[":params"] =  (int)$this->user_id;
		 // $criteria->select="country_id,country_name";
		   $model =  ListingUsers::model()->find($criteria);
	   
	   if(!empty($model)){
	  
                 
	        $update_array = array('full_number'=> Yii::t('app',$this->full_number,array(' '=>'')),'whatsapp'=> Yii::t('app',$this->whatsapp_false,array(' '=>'')) ,'phone'=>Yii::t('app',$this->phone,array(' '=>'')),'first_name'=>$this->contact_name );
			if($model->phone != Yii::t('app',$this->phone,array(' '=>'')) ) { $update_array['o_verified'] = '0' ; }
                 
	        $model->updateByPk($model->user_id,$update_array);
	      //  $model->SendOtp;
	   }
	   
	   
	}
	
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
          'user'=>array(self::BELONGS_TO, 'ListingUsers', 'user_id'),
       
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'contact_name' => 'Contact Name',
            'phone' => 'Mobile No.',
             'landline'=>'Landline No.',
            'date_added' => 'Date Added',
            'status' => 'Status',
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
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('contact_name',$this->contact_name,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('landline',$this->landline,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('status',$this->status,true);

       $criteria->order = 't.date_added desc';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
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
     * @return UserDetailsChange the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
     public function activeArray()
    {
		$arr = array('W'=>'Waiting','A'=>'Accept Request','D'=>'Decline Request');
		return $arr;
	}
	public function getStatusTitle()
	{
		$ar = $this->activeArray();
		return (isset($ar[$this->status]))?$ar[$this->status]:"Unknown";
	}
	 public function getMemebrApproved(){
			$cl = 'bg-blue';
	        if($this->status=='W'){
				$cl = 'bg-yellow';
			}
			
			return '<span class="label  '.$cl.'" onclick="previewthis(this,event)" href="'.Yii::app()->createUrl('change_contact_request/view',array('id'=>$this->id)).'">'.$this->StatusTitle.'</span>';
		 
	}
	public function getDetails_items(){
			$list =  $this->ServiceLocationStatesDetails; $html = ''; 
			foreach($list  as $k2){
			$html .=  $k2->state_name.','; 
			}
			if($html != '') { $html  =  rtrim($html,','); } 
 
			return array(
			'user_type' => $this->TypeTile,
			'mobile' => $this->mobile,
 

			);
	}
}
