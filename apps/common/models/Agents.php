<?php

/**
 * This is the model class for table "mw_booking_users".
 *
 * The followings are the available columns in table 'mw_booking_users':
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property integer $country
 * @property string $zip
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $password
 * @property integer $isTrash
 * @property string $status
 */

class Agents extends ListingUsers
{
	
	 public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('login_email,login_password', 'required',"on"=>array("login")),
            array('first_name,email,designation_id', 'required',"on"=>array('frontend_insert',"insert","update",'agent_insert','agent_update','developer_insert','developer_update','agent_update1','developer_update1','customer_insert','customer_update')),
            array('country_id,state_id, isTrash', 'numerical', 'integerOnly'=>true),
            array('password,con_password','required','on'=>"frontend_insert,insert,updatepassword,agent_insert,developer_insert, customer_insert"),
            array('image,country_id,phone,mul_country_id','required','on'=>"agent_insert,developer_insert,developer_update,agent_update,agent_update1,developer_update1"),
            array('image,country_id,phone','required','on'=>'customer_insert,customer_update'),
            array('first_name, last_name, city, state, email', 'length', 'max'=>150),
            array('email','email'),
            array('description,image,address','required', 'on'=>"developer_update,agent_update,agent_update1,developer_update1" ),
           
            array('website','safe', 'on'=>"developer_update,agent_update,agent_update1,developer_update1" ),
            array('contact_person,contact_email,facebook,twiter,google,company_name','safe', 'on'=>"developer_update,agent_update,agent_update1,developer_update1" ),
            array('contact_person,contact_email,facebook,twiter,google,company_name', 'length', 'max'=>150),
            array('contact_email','email'),
            array('facebook,twiter,google,website','url','defaultScheme'=>'https'),

            array('email','unique', 'on'=>"frontend_insert,insert,agent_insert,developer_insert,developer_update,agent_update,agent_update1,developer_update1,customer_insert,customer_update" ),
            array('country_slug','required', 'on'=> 'find_step_1' ),
            array('property_type','safe', 'on'=>'find_step_1' ),
            array('address', 'length', 'max'=>500),
            array('licence_no', 'length', 'max'=>50),
            array('description', 'length', 'max'=>3000),
            array('user_type', 'required', 'on'=>'frontend_insert'),
             array('email_verified', 'safe', 'on'=>'frontend_insert'),
            array('user_type,calls_me,country_id,filled_info,transparent', 'safe' ),
            array('image', 'required', 'on'=>'update_logo'),
            array('user_type', 'in', 'range' => array_keys($this->getUserType()),  'message'=>'Please enter a value for {attribute_value}.'),
            array('zip', 'length', 'max'=>7),
            array('phone', 'length', 'max'=>15),
            array('old_password','checkOldPassword', 'on'=>'updatepassword'), 
                array('password', 'required' , 'on'=>'update-new-password'),
			array('password', 'length', 'min'=>5,'on'=>'update-new-password'),
			
            array('first_name','required', 'on'=>'chnage_name'),
            array('fax', 'length', 'max'=>10),
            array('password', 'length', 'max'=>250,"on"=>"frontend_insert,insert,agent_insert,developer_insert,developer_update,agent_update,customer_insert,customer_update"),
            array('password', 'length', 'min'=>5,"on"=>"frontend_insert,insert,agent_insert,developer_insert,developer_update,agent_update,customer_insert,customer_update"),
            array('languages_known', 'required' ,"on"=>"agent_insert,agent_update,agent_update1"),
             array('slug', 'validateSlug' ,'on'=>'developer_update,agent_update,agent_update1,developer_update1' ),
             array('con_password', 'compare', 'compareAttribute' => 'password',"on"=>"frontend_insert,insert,updatepassword,agent_insert,developer_insert,developer_update,agent_update,customer_insert,customer_update"),
            array('status', 'length', 'max'=>1),
            array('mul_country_id,mul_state_id,service_offerng,service_offerng_detail,email_verified', 'safe'),
            array('registered_via', 'safe'),
            array('send_me,featured', 'length', 'max'=>1),
            array('email','unique', 'on'=>'updateEmail'),
            array('email','required', 'on'=>'updateEmail'),
            array('email','updateEmailChecker', 'on'=>'updateEmail'),
            array('cover_letter,dob,calls_me,country,position_level,education_level,updates,advertisement,username,con_password,image,xml_inserted,xml_image,mobile,user_type,phone,city,user_name','safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, first_name, last_name, address, city, state, country, zip, phone, fax, email, password, isTrash, status,date_added,designation_id,tag_list2', 'safe', 'on'=>'search'),
        );
    }
	 public function search($return=false)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->select = 't.*,cn.country_name as country_name';
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('state',$this->state,true);
         $criteria->compare('first_name',$this->user_name,true);
        $criteria->compare('last_name',$this->user_name,true,'OR');
        $criteria->compare('zip',$this->zip,true);
        $criteria->compare('designation_id',$this->designation_id);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('fax',$this->fax,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('t.isTrash','0');
       
        $criteria->compare('t.status',$this->status);
        $criteria->compare('user_type','A');
        $criteria->join = ' LEFT  JOIN {{countries}} cn on  cn.country_id = t.country_id ';
         if(!empty($this->tag_list2)){
			$criteria->join  .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tag_id2'  ;
			$criteria->params[':tag_id2'] = $this->tag_list2;
		} 
        if(!empty($this->country_id)){
			$criteria->compare('cn.country_name',$this->country_id);
		}
        $criteria->order = 't.user_id desc';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
             'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
        ));
    }
    public $sale_total;
    public $rent_total;
    
	 protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }
        $this->user_type =  'A';
        
        return true;
    }
    public function afterSave(){
			parent::afterSave();
			if(!$this->isNewRecord){
					ListingUserCategory::model()->deleteAllByAttributes(array('user_id'=>$this->primaryKey));
					ListingUserSection::model()->deleteAllByAttributes(array('user_id'=>$this->primaryKey));
			}
			$cn_model = new ListingUserSection();
			if(!empty($this->service_offerng)){
				foreach($this->service_offerng as $section_id){
					$cn_model_new = clone $cn_model;
					$cn_model_new->user_id = $this->primaryKey;
					$cn_model_new->section_id = $section_id;
					$cn_model_new->save();
					
				}
			}
			$cn_model = new ListingUserCategory();
			if(!empty($this->service_offerng_detail)){
				foreach($this->service_offerng_detail as $category_id){
					$cn_model_new = clone $cn_model;
					$cn_model_new->user_id = $this->primaryKey;
					$cn_model_new->category_id = $category_id;
					$cn_model_new->save();
				}
			}
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getAgentAvatarUrl(){
		return Yii::app()->apps->getBaseUrl('uploads/resized/'.$this->image);
	}
 
}
