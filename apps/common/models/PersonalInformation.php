<?php

/**
 * This is the model class for table "{{freebites_information}}".
 *
 * The followings are the available columns in table '{{freebites_information}}':
 * @property integer $user_id
 * @property string $f_type
 * @property string $full_name
 * @property string $id_number
 * @property string $address
 * @property integer $zip_code
 * @property string $city
 * @property string $phone_number
 * @property string $payment_method
 * @property string $email_payment
 * @property string $id_doc
 * @property integer $country_id
 * @property string $shutterstock_id
 * @property string $istockphoto_id
 * @property string $stock_adobe
 * @property string $facebook
 * @property string $dribbble
 * @property string $pinterest
 *
 * The followings are the available model relations:
 * @property ListingUsers $user
 * @property Country $country
 */
class PersonalInformation extends  ActiveRecord
{
	public $slug; 
	public $website; 
	public $bio; 
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{freebites_information}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id,f_type,slug,bio', 'required'),
            array('website', 'url', 'defaultScheme' => 'http'),
            array('user_id, zip_code, country_id', 'numerical', 'integerOnly'=>true),
            array('f_type', 'length', 'max'=>3),
            array('full_name', 'length', 'max'=>180),
            array('id_number', 'length', 'max'=>30),
            array('bio', 'length', 'max'=>500),
            array('address, city, id_doc, shutterstock_id, istockphoto_id, stock_adobe, facebook, dribbble, pinterest,twitter', 'length', 'max'=>250),
            array('slug, shutterstock_id, istockphoto_id, stock_adobe, facebook, dribbble, pinterest,twitter', 'validateSlug' ),
             array('slug', 'checkMyUniqunessInBrand'),
            array('phone_number', 'length', 'max'=>15),
            array('payment_method', 'length', 'max'=>1),
            array('email_payment', 'length', 'max'=>200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, f_type, full_name, id_number, address, zip_code, city, phone_number, payment_method, email_payment, id_doc, country_id, shutterstock_id, istockphoto_id, stock_adobe, facebook, dribbble, pinterest', 'safe', 'on'=>'search'),
        );
    }
    public function validateSlug($attribute,$params){
	 
			if (!empty($this->$attribute) and !preg_match('/^[A-Za-z0-9._]+$/', $this->$attribute)   ){
			$this->addError($attribute, 'Only english letters numbers and \'_\' allowed');
			}
		 
	}
	public function afterSave(){
		parent::afterSave();
		ListingUsers::model()->updateByPk($this->user_id,array('slug'=>$this->slug,'website'=>$this->website,'description'=>$this->bio,'filled_info'=>'1'));
	}

	public function checkMyUniqunessInBrand($attribute,$params)
	{
		$user = ListingUsers::model()->count('slug=:slug AND user_id!=:user_id', array(':slug'=>$this->slug,':user_id'=>$this->user_id));
		if($user > 0) {
			$this->addError('slug', 'Unique ID already exist');
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
            'user' => array(self::BELONGS_TO, 'ListingUsers', 'user_id'),
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'user_id' => 'User',
            'f_type' => 'F Type',
            'full_name' => 'Full Name',
            'id_number' => 'Id Number',
            'address' => 'Address',
            'zip_code' => 'Zip Code',
            'city' => 'City',
            'phone_number' => 'Phone Number',
            'payment_method' => 'Payment Method',
            'email_payment' => 'Email Payment',
            'id_doc' => 'Id Doc',
            'country_id' => 'Country',
            'shutterstock_id' => 'Shutterstock',
            'istockphoto_id' => 'Istockphoto',
            'stock_adobe' => 'Stock Adobe',
            'facebook' => 'Facebook',
            'dribbble' => 'Dribbble',
            'pinterest' => 'Pinterest',
            'slug' => 'User ID',
            'bio' => 'Description',
        );
    }
    public function getShutterstock(){
		return 'https://www.shutterstock.com/'.$this->shutterstock_id;
	}
    public function getIstockphoto(){
		return 'https://www.istockphoto.com/'.$this->istockphoto_id ; 
	}
    public function getStockAdobe(){
		return 'https://www.stock.adobe.com/'.$this->stock_adobe ; 
	}
    public function getFb(){
		return 'https://www.facebook.com/'.$this->facebook ; 
	}
    public function getDdb(){
		return 'https://dribbble.com/'.$this->dribbble ; 
	}
    public function getPint(){
		return 'https://pinterest.com/'.$this->pinterest ; 
	}
    public function getTwt(){
		return 'https://twitter.com/'.$this->twitter ; 
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

        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('f_type',$this->f_type,true);
        $criteria->compare('full_name',$this->full_name,true);
        $criteria->compare('id_number',$this->id_number,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('zip_code',$this->zip_code);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('phone_number',$this->phone_number,true);
        $criteria->compare('payment_method',$this->payment_method,true);
        $criteria->compare('email_payment',$this->email_payment,true);
        $criteria->compare('id_doc',$this->id_doc,true);
        $criteria->compare('country_id',$this->country_id);
        $criteria->compare('shutterstock_id',$this->shutterstock_id,true);
        $criteria->compare('istockphoto_id',$this->istockphoto_id,true);
        $criteria->compare('stock_adobe',$this->stock_adobe,true);
        $criteria->compare('facebook',$this->facebook,true);
        $criteria->compare('dribbble',$this->dribbble,true);
        $criteria->compare('pinterest',$this->pinterest,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FreebitesInformation the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
