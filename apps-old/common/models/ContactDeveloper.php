<?php

/**
 * This is the model class for table "mw_contact_us".
 *
 * The followings are the available columns in table 'mw_contact_us':
 * @property integer $id
 * @property integer $type
 * @property string $email
 * @property string $name
 * @property string $meassage
 * @property string $city
 * @property string $date
 */
class ContactDeveloper  extends ContactUs
{
	 public $image;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email,  meassage,phone,user_id,considering', 'required'),
            array('type,phone', 'numerical', 'integerOnly'=>true),
            array('email, name', 'length', 'max'=>150),
            array('city', 'length', 'max'=>250),
            array('phone', 'length', 'min'=>10),
            array('phone', 'length', 'max'=>14),
            array('email', 'email'),
            array('contact_type,w_talk', 'safe'),
           // array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
           // array('verifyCode', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, email, name, meassage, city, date', 'safe', 'on'=>'search'),
             array('image', 'file', 'types'=>'pdf,doc,docx', 'allowEmpty'=>true,  'safe' => true),
        );
    }
 
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'ad_id' => 'AD',
            'type' => 'Position',
            'email' => 'Email',
            'name' => 'Name',
            'meassage' => 'Message',
            'city' => 'City',
            'date' => 'Date',
            'w_talk' => 'Date',
            'considering' => 'I am Considering',
        );
    }
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        'ad' => array(self::BELONGS_TO, 'PlaceAnAd', 'ad_id'),
        'developer' => array(self::BELONGS_TO, 'Developer', 'user_id'),
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
        $criteria->compare('email',$this->email,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('meassage',$this->meassage,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('contact_type','ENQUIRY');
         $criteria->order="id desc";
		$pageSize = (Yii::app()->request->getQuery("page_size")) ?  (int) Yii::app()->request->getQuery("page_size") : $pageSize = 10;
		return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
		'pagination'=>array(
		'pageSize'=>$pageSize,
		),
		));
    }
    public function beforeSave(){
		
	   if(parent::beforeSave()) 
	   {
			 $this->contact_type= 'C_AGENT';
		 

			 return true;
	   }
	return false;
	 
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
    public function afterSave(){
		 
		
		     $options = Yii::app()->options ; 
			 
             
			$emailTemplate =  CustomerEmailTemplate::model()->findByAttributes(array('name'=>"enquiry"));
			if($emailTemplate) { $emailTemplate = $emailTemplate->content; }
			else { 	 return true; }
		   
		    $logo =  '<a href=""><img src="'.OptionCommon::logoUrl().'" style="width:70px"  alt=""></a>';
			$emailTemplate = str_replace('{logo}',$logo, $emailTemplate);
			$emailTemplate = str_replace('{name}',$this->name, $emailTemplate);
			$emailTemplate = str_replace('{phone}', $this->phone, $emailTemplate);
			$emailTemplate = str_replace('{email}', $this->email, $emailTemplate);
			$emailTemplate = str_replace('{message}', nl2br($this->meassage), $emailTemplate);
			$emailTemplate = str_replace('{date}', $this->dateAdded, $emailTemplate);
			if(!empty($this->agent)){
				$emailTemplate = str_replace('{url}', '<a href="'.$this->developer->DeveloperDetailUrl.'">'.$this->developer->fullName.'</a>', $emailTemplate);
		    }
		    else{
				$emailTemplate = str_replace('{url}','', $emailTemplate);
			}
			$emailTemplate = str_replace('{from}',Yii::app()->options->get('system.common.site_name'), $emailTemplate);
			if(!empty($this->user_id)){
			$usersList = array_replace( array(Yii::app()->options->get('system.common.admin_email')=>'Admin'),array($this->agent->email=>$this->agent->fullName) ); 
			}else{
			$usersList = array_replace( array(Yii::app()->options->get('system.common.admin_email')=>'Admin')  ); 
			} 
			 
			 
			$server = DeliveryServer::pickServer(); 
			if(!empty($usersList) and !empty($server)){
				foreach($usersList as $k=>$v){
				 
							$params = array(
							'to'            =>   $k,
							'fromName'      =>   Yii::app()->options->get('system.common.site_name'),
							'subject'       =>	'Agent Contact form added on  '. Yii::app()->options->get('system.common.site_name'),
							'body'          =>  str_replace('{user}',$v,$emailTemplate),
							);
							$server->sendEmail($params) ; 
					
				}
			}
			 
	 return true;
       
     
	}
    
}
