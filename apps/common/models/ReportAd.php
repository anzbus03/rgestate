<?php

/**
 * This is the model class for table "{{report_ad}}".
 *
 * The followings are the available columns in table '{{report_ad}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $ad_id
 * @property string $date_added
 * @property string $status
 * @property integer $master_id
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $ad
 * @property ListingUsers $user
 * @property Master $master
 */
class ReportAd extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{report_ad}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id,master_id,name,email', 'required'), array('email', 'email'),
            array('comment', 'required','message'=>'Please add a comment to help us understand what\'s wrong with this listing.'),
            array('user_id, ad_id, master_id', 'numerical', 'integerOnly'=>true),
            array('status', 'length', 'max'=>1),
              array('comment', 'length', 'max'=>250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, ad_id, date_added, status, master_id', 'safe', 'on'=>'search'),
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
            'user' => array(self::BELONGS_TO, 'ListingUsers', 'user_id'),
            'master' => array(self::BELONGS_TO, 'Master', 'master_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'        => 'ID',
            'user_id'   => 'Reported By',
            'name'      => 'Your Full Name',
            'email'     => 'Your Email Address',
            'ad_id'     => 'Ad',
            'date_added' => 'Date Added',
            'status' => 'Status',
            'master_id' => 'Report reason',
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
        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('master_id',$this->master_id);
		$criteria->order = "  t.id desc    " ;
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
 
    const BULK_ACTION_DELETE = 'delete';
    const BULK_ACTION_ACTION = 'action';
    const BULK_ACTION_PENDING = 'pending';
     
	public function getBulkActionsList()
    {
			  
			 
				$ar[self::BULK_ACTION_DELETE] =  Yii::t('app', 'Delete');
				$ar[self::BULK_ACTION_ACTION] =  Yii::t('app', 'Change Status - Action Taken');
				$ar[self::BULK_ACTION_PENDING] =  Yii::t('app', 'Change Status - Action Pending');
				return $ar; 
			 
				 
    }
    public function getAdInformation(){
		$ad = $this->ad;
		$html = $ad->ad_title .'<br />'; 
		$html .= $ad->JavascriptPreview ; 
		return $html ;
	}

    public function getUserInformation(){
		$ad = $this->user;
		$html = CHtml::link( $ad->first_name , Yii::app()->createUrl('listingusers/update',array('id'=>$this->user_id)),array('target'=>'_blank'))  ; 
		 
		return $html ;
	}
	public function statusArray(){
	 return array(
	     ''=>'User Submitted',
	     'A' => 'Action Taken',
	     'P' => 'Action Pending',
	     );
	}
	public function getStatusTitle(){
	 $ar = $this->statusArray();
	 return (isset($ar[$this->status])) ? $ar[$this->status] : '';
	}

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ReportAd the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function getPropertyDetail(){
        $modelCriteria  = new CDbCriteria();
        $modelCriteria->condition .= 't.id = :thisadid '; 
        $modelCriteria->params[':thisadid']  = $this->ad_id; 
        $Ad = PlaceAnAd::model()->find($modelCriteria);
        $html = CHtml::link($Ad->ad_title, Yii::App()->createUrl('place_property/update', array('id' => $this->ad_id)), array('target' => '_blank', 'class' => "text-dark"));
        $html .= '<br />';
        $html .= CHtml::link($Ad->ReferenceNumberTitle, Yii::App()->createUrl('place_property/update', array('id' => $this->ad_id)), array('target' => '_blank', 'class' => "text-primary")) . '  <t></t>' . CHtml::link(
            $Ad->first_name . ' ' . $Ad->last_name, 
            Yii::App()->createUrl('listingusers/update', array($Ad->user_id)), 
            array('target' => '_blank')
        );
        $html .= ' <br />';
        return $html;
    }
    
}
