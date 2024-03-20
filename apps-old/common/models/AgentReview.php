<?php

/**
 * This is the model class for table "agent_review".
 *
 * The followings are the available columns in table 'agent_review':
 * @property integer $review_id
 * @property integer $agent_id
 * @property integer $rating
 * @property string $review
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property integer $property_type
 * @property string $location
 * @property string $when_interact
 * @property string $date_added
 * @property string $last_updated
 */
class AgentReview extends  ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{agent_review}}';
    }
	public $phone_false;
	public $_recaptcha;
	public $agree;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rating, name, email, phone, phone_false,agent_id, location, when_interact , sect ,review ', 'required',   'message'=>$this->mTag()->getTag('required','Required'),'on'=>'insert'),
               array('agree', 'required',  'message'=>$this->mTag()->getTag('please_select','Please select.'),'on'=>'insert' ),
            array('agent_id, rating, property_type', 'numerical', 'integerOnly'=>true),
            array('review', 'length', 'max'=>1000),
            array('name, email', 'length', 'max'=>150),
            array('phone', 'length', 'max'=>15),
            array('property_link', 'length', 'max'=>255),
            array('property_link', 'url', 'defaultScheme'=>'https'),
            array('location', 'length', 'max'=>100),
            array('when_interact', 'length', 'max'=>1),
            array('status', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('review_id, agent_id, rating, review, name, email, phone, property_type, location, when_interact, date_added, last_updated', 'safe', 'on'=>'search'),
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
 public function status_array(){
		return array(
				'W'=>$this->mTag()->getTag('waiting','Waiting'),
				'R'=>$this->mTag()->getTag('rejected','Rejected'),
				'A'=>$this->mTag()->getTag('accepted','Accepted') ,
				 
		);
	}
	public function updateReviewField(){
		$criteria=new CDbCriteria;
		$criteria->compare('agent_id',(int)$this->agent_id);
		$criteria->compare('status','A');
		$total_reviews = $this->count($criteria);
		$criteria=new CDbCriteria;
		$criteria->select = 'sum(rating) as rating';
		$criteria->compare('agent_id',(int)$this->agent_id);
		$criteria->compare('status','A');
		$criteria->group = 't.agent_id';
		$avg = 0; 
		$sum_of_reviews = $this->find($criteria);
		if(!empty($sum_of_reviews) and !empty($total_reviews)){
			$avg =  $sum_of_reviews->rating / $total_reviews;
			//echo $avg;exit; 
			//$avg = number_format($avg,2,'.','');
		}
		ListingUsers::model()->updateByPk($this->agent_id,array('avg_r'=>$avg,'total_reviews'=>$total_reviews));
	}
	
	public function afterSave(){
		if(!$this->isNewRecord){
			$this->updateReviewField();
		}
	}
	
	 public function getstatusTitle(){
		$ar = $this->status_array();
		$this->status = empty($this->status) ? '1' : $this->status;
		return isset($ar[$this->status]) ? $ar[$this->status] : '';
	}
	const BULK_ACTION_DELETE = 'delete';
	const BULK_ACTION_ACTIVATE = 'activate';
	const BULK_ACTION_REJECT = 'reject';
	public function getBulkActionsList()
    {
				$ar =   
				array(
							self::BULK_ACTION_DELETE         => Yii::t('app', 'Delete Permanently '),
							self::BULK_ACTION_ACTIVATE         => Yii::t('app', 'Approve Review'),
							self::BULK_ACTION_REJECT         => Yii::t('app', 'Reject Review'),
							 
				);
			 
				return $ar; 
			 
				 
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'review_id' => 'ID',
            'agent_id' => 'Agent',
            'rating' => 'Rating',
            'review' => $this->mTag()->getTag('review','Review'),
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'sect' => 'Sector',
            'property_link' => $this->mTag()->getTag('property_link','Property Link'),
            'property_type' => 'Property Type',
            'location' => $this->mTag()->getTag('property_location','Property Location'), 
            'when_interact' => 'When Interact',
            'date_added' => 'Date Added',
            'last_updated' => 'Last Updated',
        );
    }
    public function when_interact_array(){
		return array(
		
		'1' =>  $this->mTag()->getTag('last_week','Last Week'),
		'2' => $this->mTag()->getTag('last_2_weeks', 'Last 2 Weeks'),
		'3' =>  $this->mTag()->getTag('last_month','Last Month'),
		);
	}
    public function sect_array(){
		return array(
		
		'1' => $this->mTag()->gettag('buying','Buying'),
		'2' =>  $this->mTag()->gettag('renting', 'Renting'), 
		);
	}
public function getSectTitle(){
		$ar = $this->sect_array();
		return isset($ar[$this->sect]) ?$ar[$this->sect] : ''; 
	}
public function getWhen_interactTitle(){
		$ar = $this->when_interact_array();
		return isset($ar[$this->when_interact]) ?$ar[$this->when_interact] : ''; 
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
     public $agent_name; 
     public $company_name; 
    public function search($return=false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
		 $criteria->condition = '1'; 
        $criteria->compare('review_id',$this->review_id);
        //$criteria->compare('agent_id',$this->agent_id);
        $criteria->compare('rating',$this->rating);
        $criteria->compare('review',$this->review,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('property_type',$this->property_type);
        $criteria->compare('location',$this->location,true);
        $criteria->compare('when_interact',$this->when_interact,true);
        $criteria->compare('date_added',$this->date_added,true);
        $criteria->compare('last_updated',$this->last_updated,true);
        if(!empty($this->agent_id)){
			$criteria->condition .= ' and ( ls.first_name like :agent or lsp.company_name like :agent ) ';
			$criteria->params[':agent'] = '%'.$this->agent_id.'%';
		}
        $criteria->join  = ' inner join {{listing_users}} ls  on ls.user_id = t.agent_id ' ;
        $criteria->join  .= ' left join {{listing_users}} lsp  on lsp.user_id = ls.parent_user ' ;
         $criteria->select = 't.*,ls.first_name as agent_name,lsp.company_name as company_name';
		if(!empty($return)){return $criteria;}

         return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder'  => array(
                    'review_id'   => CSort::SORT_DESC,
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AgentReview the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function findReviews($formData=array(),$count_future=false,$returnCriteria=false,$calculate=false,$user_id=false){
	    $criteria=new CDbCriteria;
		 
        $criteria->compare('t.status','A');
        $criteria->compare('t.agent_id',(int)$_GET['agent']);
		 
		$total = false ; 
		if($returnCriteria){
			return $criteria;
		}
		$criteria->order = 't.review_id desc';
		$criteria->limit  = Yii::app()->request->getQuery('limit','10');
		$criteria->offset = Yii::app()->request->getQuery('offset','0');
		/* SaFE neighbours */
		 
		if(!empty($count_future)){
			$Result = self::model()->findAll($criteria);
			$criteria->offset = $criteria->limit+$criteria->offset   ;
			//$criteria->select = 't.id'; 
			$criteria->limit = '1'; 
			$future_count = self::model()->find($criteria);
			return array('result'=>$Result,'future_count'=>$future_count,'total'=>$total);
		}
		else{
			return  self::model()->findAll($criteria)  ; 
		 
		}
	 
	}
	public function   is_rtl( $string ) {
		$rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
		return preg_match($rtl_chars_pattern, $string);
	}
	public function getProfileImage(){
			
	        $name =   $this->name ;
	        if( $this->is_rtl( $this->name )) {
				$path =   'a_p.jpg?q=11';
			}
			else{
	        $path =  strtolower(substr( $name,0,'1')).'_p.jpg?q=11';
			}
	        
		    return  Yii::App()->apps->getBaseUrl('uploads/avatar/'.$path); 
	        return Yii::app()->apps->getBaseUrl('assets/img/NoPicAvailable.png');
	    
   }
}
