<?php

/**
 * This is the model class for table "{{ad_favourite}}".
 *
 * The followings are the available columns in table '{{ad_favourite}}':
 * @property integer $ad_id
 * @property integer $user_id
 */
class AdFavourite extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{ad_favourite}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ad_id, user_id', 'numerical', 'integerOnly'=>true),
            array('inp_val', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ad_id, user_id', 'safe', 'on'=>'search'),
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
            'ad_id' => 'Ad',
            'user_id' => 'User',
            'property' => $this->mTag()->getTag('property','Property'),
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
     public $user_type;
     public $first_name;
     public $last_name;
     public $image;
     public $ad_title;
     public $slug;
     public $user_slug;
     public $section_id;
 
	 public function getUserDetailUrl(){
		if($this->user_type=='A'){
		return Yii::app()->createUrl('user_listing/detail',array('slug'=>$this->user_slug));
		}
		else if($this->user_type=='D'){
		return Yii::app()->createUrl('user_listing_developers/detail',array('slug'=>$this->user_slug));
		}
	}
	public function getTitleLink(){
		return $this->ad_title.' '.$this->UserLink;
	}
	public function getDetailUrl(){
		if($this->section_id==PlaceAnAd::NEW_ID){
			return Yii::app()->createUrl('detail/project',array('slug'=>$this->slug));
		}
		return Yii::app()->createUrl('detail/index',array('slug'=>$this->slug));
	} 
	 
     public function getUserLink(){
		if(!empty($this->image) and in_array($this->user_type,array('D','A'))){ 
			$image = Yii::app()->apps->getBaseUrl('uploads/resized/'.$this->image); 
			return '<a href="'.$this->UserDetailUrl.'"> <img src="'.$image.'" height="30px"></a>';
			
          }
	}
	public function getinp_val2(){
		return !empty($this->inp_val) ?  $this->inp_val : $this->amenities_id;
	}
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
		$criteria->select = 't.*,usr.user_type,usr.first_name,usr.last_name,usr.image,ad.ad_title,ad.slug,usr.slug as user_slug,ad.section_id';
        $criteria->compare('ad_id',$this->ad_id);
        $criteria->compare('t.user_id',$this->user_id);
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on ad.id=t.ad_id and ad.status="A" and ad.isTrash="0" ';
		$criteria->join .= ' LEFT JOIN {{listing_users}} usr on ad.user_id=usr.user_id   ';
       return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
 public function getPropertyDetail(){
		$modelCriteria  = PlaceAnAd::model()->findAds($formData=array(),$count_future=false,$returnCriteria=1,$calculate=false, false);
		$modelCriteria->condition .= '   and t.id = :thisadid '; 
		$modelCriteria->params[':thisadid']  = $this->ad_id ; 
		$Ad =  PlaceAnAd::model()->find($modelCriteria)  ;
	$html=''; 
		$html .= CHtml::link($Ad->ad_title,Yii::App()->createUrl('place_property/update',array('id'=>$this->ad_id)),array('target'=>'_blank')); $html .= '<br />';
		$html .=   $Ad->ReferenceNumberTitle.'  <t></t>'.CHtml::link('<i class="fa fa-user"></i> '.$Ad->first_name. ' '.$Ad->last_name,Yii::App()->createUrl('listingusers/update',array($Ad->user_id)),array('target'=>'_blank'));
		$html .=  ' <br />'.$Ad->JavascriptPreview;
		return $html;
	}
	public function getAdTitleDetails(){
		if(!empty($this->ad_id)){
		$modelCriteria  = PlaceAnAd::model()->findAds($formData=array(),$count_future=false,$returnCriteria=1,$calculate=false, false);
		$modelCriteria->condition .= '   and t.id = :thisadid '; 
		$modelCriteria->params[':thisadid']  = $this->ad_id; 
		$ad =  PlaceAnAd::model()->find($modelCriteria)  ;
		return '<div class="col-sm-12">'.$ad->ListingLi.'</div><div class="col-sm-12">'.$ad->ListingLiTitle.'</div>' ;
		}
		else{
			return '-';
		}
	}
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AdFavourite the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
