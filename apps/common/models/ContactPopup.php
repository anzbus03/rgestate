<?php

/**
 * This is the model class for table "mw_contact_popup".
 *
 * The followings are the available columns in table 'mw_contact_popup':
 * @property integer $id
 * @property integer $type
 * @property string $email
 * @property string $name
 * @property string $message
 * @property string $date
 */
class ContactPopup extends ActiveRecord
{
	 public $verifyCode;  public $_recaptcha ;
	 public $phone_false; 
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_contact_popup';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $required = $this->mTag()->gettag('required','Required');
        return array(
            array('email, name, phone,phone_false,type,message', 'required', 'message' => $required ),
            array('message','safe'),
            array('phone', 'numerical', 'integerOnly'=>true),
            array('email, name', 'length', 'max'=>150),
            array('phone', 'length', 'min'=>10),
            array('phone', 'length', 'max'=>14),
            
            array('email', 'email','message'=>$this->mTag()->getTag('enter_a_valid_email_address.','Enter a valid email address.')),
            array('ip_address', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('type', 'safe', 'on'=>'search'),
        );
    }
  	public function getIp(){
   		$client  = @$_SERVER['HTTP_CLIENT_IP'];

		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];

		$remote  = @$_SERVER['REMOTE_ADDR'];

		$result  = array('country'=>'', 'city'=>'');

		if(filter_var($client, FILTER_VALIDATE_IP)){

		$ip = $client;

		}elseif(filter_var($forward, FILTER_VALIDATE_IP)){

		$ip = $forward;

		}else{

		$ip = $remote;

		}
		return $ip;
    }
		  
	public function beforeSave(){
	     parent::beforeSave();
	     if($this->isNewRecord){
				$this->ip_address      =  $this->getIp();
		 }
		    return true;
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
            'id'      => 'ID',
            'type'    => 'Service',
            'email'   => 'Email',
            'phone'   => 'Mobile No.',
            'name'    => 'Name',
            'message' => 'Message',
            'date'    => 'Date',
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
        $criteria->compare('type',$this->type);
        //$criteria->compare('contact_type','CONTACTPOPUP');
         $criteria->order="id desc";
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
     * @return ContactUs the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function Model_type()
    {
		return array(
		    ''                       => 'Select Your Service',
		    'Real Estate'            => 'Real Estate',
			'Project Funding'        => 'Project Funding',
			'Retail Investments'     => 'Retail Investments',
			'Business Funding'        => 'Business Funding',
			'Project Development'    => 'Project Development',
			'Project Contracting'    => 'Project Contracting',
			'Interior Fitouts'       => 'Interior Fitouts',
			'Building Maintenance'   => 'Building Maintenance',
			'Buy/Sell Business'      => 'Buy/Sell Business',
		 
		);
	}
    public function getType($id)
    {
		$ar = $this->Model_type();
		return  (isset($ar[$id]))?  $ar[$id] : 'No Subject Defined';
		 
		 
	}
	public function getIpInfo(){
	    if(!empty($this->ip_address)){ return $this->ip_address;  }
 
	}
	
	public function findEnquiry($formData=array(),$count_future=false ,$returnCriteria =false){
		  
		$criteria=new CDbCriteria;
		$criteria->compare('contact_type','CONTACTPOPUP');
		$order  = 't.id   desc ';		   
	    $criteria->order  =   $order; 		
		$criteria->limit  = Yii::app()->request->getQuery('limit','10');
		$criteria->offset = Yii::app()->request->getQuery('offset','0');
		if($returnCriteria)	 { return  $criteria; }
		if(!empty($count_future)){
			$Result = self::model()->findAll($criteria);
			$criteria->offset = $criteria->limit+$criteria->offset   ;
			$criteria->select = 't.id'; 
			$criteria->limit = '1'; 
			$future_count = self::model()->find($criteria);
			return array('result'=>$Result,'future_count'=>$future_count );
		}
		else{
			return  self::model()->findAll($criteria)  ; 
		 
		}
	 
	}
	public function getCondsideringTitle(){
		return $this->city;
	}
	  const BULK_ACTION_DELETE = 'delete';
 
	public function getBulkActionsList()
    {
				$ar =   
				array(
							self::BULK_ACTION_DELETE         => Yii::t('app', 'Delete Permanently '),
							 
				);
			 
				return $ar; 
			 
				 
    }
    public function getBackendUrl(){
		return ASKAAN_PATH_BASE.'backend/index.php/contact_services/view?id='.$this->primaryKey;
	}
	
    public function afterSave(){
				parent::afterSave();
		        $options =Yii::app()->options;
			    $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid("az3438eqlm2fc");;
			    $emailTemplate_customer =  CustomerEmailTemplate::model()->getTemplateByUid("gc385h18fmdcc");;
			     $emailTemplate_common = $this->commonTemplate()   ;
			     if($emailTemplate)
			    {
					if(!empty($emailTemplate->receiver_list)){
						$list_receivers = array_filter(explode(',',$emailTemplate->receiver_list));
					}
					$subject		= $emailTemplate->subject;
					$emailTemplate  = $emailTemplate->content;
					$emailTemplate = str_replace('{name}',$this->name, $emailTemplate);
					$emailTemplate = str_replace('{phone}', $this->phone, $emailTemplate);
					$emailTemplate = str_replace('{email}', $this->email, $emailTemplate);
					$emailTemplate = str_replace('{date}',  date('d/m/Y') , $emailTemplate);	
					$emailTemplate = str_replace('{backendurl}',$this->BackendUrl, $emailTemplate);
					$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
					$status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message = $emailTemplate;
					if(!empty($list_receivers)){
						$receipeints = serialize($list_receivers);
					}
					else{
						$receipeints = serialize(array($options->get('system.common.admin_email')));
					}
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
				if( $emailTemplate_customer){
					$subject		= $emailTemplate_customer->subject;
					$emailTemplate = $emailTemplate_customer->content;					 
					$emailTemplate = str_replace('[NAME]',$this->name, $emailTemplate);
					//$emailTemplate = str_replace('[CONTENT]', $emailTemplate, $emailTemplate_common);
				 
					
				    $status = 'S'; 
					$adminEmail = new Email();			 
					$adminEmail->subject = $subject ;
					$adminEmail->message =   Yii::t('app',$emailTemplate_common, array('[CONTENT]'=>$emailTemplate));  
					$receipeints = serialize(array($this->email));
					$adminEmail->status = $status;
					$adminEmail->receipeints = $receipeints;
					$adminEmail->sent_on =   1;
					$adminEmail->type =   'REGISTER';
					$adminEmail->sent_on_utc =   new CDbExpression('NOW()');
					$adminEmail->save(false); 
					$adminEmail->send;
				}
	}

}
