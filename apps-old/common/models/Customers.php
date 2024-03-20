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

class Customers extends ListingUsers
{
	
	 public function search()
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
        
        $criteria->compare('zip',$this->zip,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('fax',$this->fax,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('t.isTrash','0');
        $criteria->compare('t.status',$this->status);
        $criteria->compare('user_type','U');
        $criteria->join = ' LEFT  JOIN {{countries}} cn on  cn.country_id = t.country_id ';
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
	 protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }
        $this->user_type =  'U';
        
        return true;
    }
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getAgentAvatarUrl(){
		return Yii::app()->apps->getBaseUrl('uploads/resized/'.$this->image);
	}
	 

}
