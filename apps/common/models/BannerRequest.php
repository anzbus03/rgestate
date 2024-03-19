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
class BannerRequest extends ActiveRecord
{
	 public $verifyCode;	
	  public $_recaptcha ;
	  public $link_url ;
	  public $image ;
	  public $from_date ;
	  public $to_date ;
	  public $section_id ;
	  public $category_id ;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mw_contact_us';
    }
    public  $accept;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
		 
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, name,  phone , position_id,link_url,from_date,to_date', 'required',  'message'=>'{attribute} '.  'cannot be blank.' ),
            array('accept', 'required',  'message'=>  'Should be checked for accept our Policy' ),
            array('type', 'numerical', 'integerOnly'=>true),
            array('email, name', 'length', 'max'=>150),
            array('city', 'length', 'max'=>250),
            array('_recaptcha', 'validateRecaptcha' ,"on"=>'insert' ),
            array('phone', 'length', 'min'=>8),
                array('image', 'file', 'types'=>'jpg,jpeg, gif, png','allowEmpty'=>true , 'maxSize'=>1024 * 1024 * 1,),
                array('image', 'validateFilePost' ),
        
            array('section_id,category_id', 'safe' ),
            array('phone', 'length', 'max'=>14),
            array('email', 'email',  'message'=>'{attribute} '.  'is not a valid e-mail address.' ),
           // array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'captchaAction' => 'site/captcha'),
           // array('verifyCode', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, email, name, meassage, city, date', 'safe', 'on'=>'search'),
        );
    }
public function validateRecaptcha($attribute,$params){
		
		  if(!Yii::app()->request->isAjaxRequest){
 
	 
			$captcha= '';
			if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
			}

			if(!$captcha){
				$this->addError($attribute,  'Please check the   captcha form.' );
			}
			else if(!empty($this->slug) and  empty($this->hasErrors('slug'))){
				 
			$data = array(
			'secret' => Yii::app()->options->get('system.common.recaptcha_secrete_key','6Ld3ZsYUAAAAAInHDCPxREnCkb8IU6cCAq0x72k5'),
			'response' => $captcha,
			'remoteip' => $_SERVER['REMOTE_ADDR']
			);

			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$res = curl_exec($verify);

			$captcha = json_decode($res);
			
			 
				if ($captcha->success) {
							
				 }
				 else{
					 $this->addError($attribute,   'You are a spammer.' );
				 }
				
 
			}
		  }
		   
	}
public function validateFilePost($attribute,$params){
		
		  if(!Yii::app()->request->isAjaxRequest){
				 
					if(empty($this->image)){
		 
					 $this->addError($attribute, $attribute .' '.  'cannot be blank.' );
					}
				 
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
        'position' => array(self::BELONGS_TO, 'BannerPosition', 'position_id'),
        );
    }
    public function beforeSave(){
		parent::beforeSave();
		$this->contact_type  = 'B_R';
		return true;
	}
	public $banner_id;
 
    public function afterSave(){
		parent::afterSave();
		
		    $uploadedFile=CUploadedFile::getInstance($this,'image');
            $fileName = rand(100,1000).$uploadedFile;
            $model = new Banner();
            if($uploadedFile)
            {	
				 
				$model->setScenario("imageAD");
				$model->image = $fileName;
				$model->ad_type = 'adImage';
				$model->f_type  = 'R';
				$model->status  = 'I';
				$model->position_id  =  $this->position_id;
				$model->from_date  =  $this->from_date;
				$model->to_date  =  $this->to_date;
				$model->link_url  =  $this->link_url;
				$model->contact_id  =  $this->primaryKey;
				//$model->section_id  =  $this->section_id;
				//$model->category_id  =  $this->category_id;
				if ($model->save()) {
				 
					$this->banner_id = $model->primaryKey;
					$path =  Yii::app()->basePath . '/../../uploads';
					$uploadedFile->saveAs($path.'/banner/'. $fileName);
				 
				}
				 
				 
			}
		
		return true;
	}
	 public function getDatePickerFormat()
    {
        return 'yy-mm-dd';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    { 
        return array(
            'id' => 'ID',
            'type' => 'Subject',
            'email' =>  'Email' ,
             'phone' =>  'Phone' ,
            'name' =>  'Name'   ,
            'meassage' =>  'Message' ,
            'city' =>   'Subject' ,
            'date' =>   'Date' ,
            'i_am' =>   'I am' ,
            'position_id' =>  'Banner position' ,
            'image' =>   'Banner file' ,
            'section_id' =>  'Sector' ,
            'category_id' =>   'Category' ,
             'link_url' => 'Landing page full URL',
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
   public function getBannerUrl(){
	   return CHtml::link('View Banner',Yii::app()->createUrl('banner/update',array('id'=>$this->banner_id)),array('target'=>'_blank'));
   }
    
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->select = 't.*,bn.banner_id as banner_id '; 
        $criteria->join = 'INNER JOIN {{banner}} bn on bn.contact_id = t.id '; 
        $criteria->compare('id',$this->id);
        $criteria->compare('type',$this->type);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('meassage',$this->meassage,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('contact_type','B_R');
         $criteria->order="id desc";
		$pageSize = (Yii::app()->request->getQuery("page_size")) ?  (int) Yii::app()->request->getQuery("page_size") : $pageSize = 10;
		return new CActiveDataProvider($this, array(
		'criteria'=>$criteria,
		'pagination'=>array(
		'pageSize'=>$pageSize,
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
		
		'1' => 'Need help with a technical problem',
		'2' => 'Report Copyright Infringement',
		'3' => 'Report Spam/Abuse/Fraud',
		'4' => 'Advertising on RsClassify',
		'5' => 'My property listing account',
		'6' => 'My Autos listing account',
		'7' => 'Feedback / suggestions',
		'8' => 'Other / General business inquiry',
		 
		);
	}
    public function getType($id)
    {
		$ar = $this->Model_type();
		return  (isset($ar[$id]))?  $ar[$id] : 'No Subject Defined';
		 
		 
	}
    public function getI_amTitle()
    {
		$ar = ListingUsers::model()->getUserType();
		return  (isset($ar[$this->i_am]))?  $ar[$this->i_am] : 'No Subject Defined';
		 
		 
	}
}
