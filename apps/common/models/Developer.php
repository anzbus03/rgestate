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

class Developer extends ListingUsers
{
	
	 public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->select = 't.*,cn.country_name as country_name';
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('first_name',$this->first_name,true);
         $criteria->compare(new CDbExpression('CONCAT(first_name, " ", last_name)'),$this->user_name, true);
       
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
        $criteria->compare('company_name',$this->company_name,true);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('user_type','D');
        $criteria->join = ' LEFT  JOIN {{countries}} cn on  cn.country_id = t.country_id ';
        if(!empty($this->country_id)){
			$criteria->compare('cn.country_name',$this->country_id);
		}
			 if(!empty($this->tag_list2)){
			$criteria->join  .= ' INNER JOIN {{listing_users_tag}} tg on tg.user_id = t.user_id and tg.tag_id = :tag_id2'  ;
			$criteria->params[':tag_id2'] = $this->tag_list2;
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
        $this->user_type =  'D';
        
        return true;
    }
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getAgentAvatarUrl(){
		return Yii::app()->apps->getBaseUrl('uploads/resized/'.$this->image);
	}
	public $ad_title;
	public $ad_slug;
	public $ad_image;
	 public function featured_developers($country_id = null,$state = null,$limit = 2,$not_in=array(),$property=false,$offset=0){
	    $criteria=new CDbCriteria;
		$criteria->select = 'distinct t.user_id,t.*';
	    $criteria->condition  .= '    t.status="A" and t.isTrash= "0" and user_type="D"  ';
	    if(!empty($state)){
			$criteria->join .= ' LEFT JOIN {{listing_users_featured}} fea ON fea.user_id = t.user_id  and fea.country_id = :country ';
			$criteria->join .= ' LEFT JOIN {{listing_users_state_featured}} feaS ON feaS.user_id = t.user_id  and feaS.state_id = :state ';
			if($property){
				 $criteria->distinct = 't.user_id';
				  $criteria->select .= ',super_ad.ad_title as ad_title,super_ad.slug as ad_slug,  (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = super_ad.id and  img.status="A" and  img.isTrash="0"  limit 1 )   as ad_image';
				  $criteria->join .= ' INNER  JOIN ( SELECT  distinct user_id, id,ad_title,slug, status,isTrash,state FROM {{place_an_ad}} adds   GROUP BY  user_id ) as  super_ad  ON   super_ad.user_id = t.user_id and super_ad.status="A" and super_ad.isTrash="0" and super_ad.state = :state ';
			} 
			  
			$criteria->params[':state'] = $state ; 
			$criteria->params[':country'] = $country_id ; 
			 $criteria->condition .= ' and  CASE WHEN feaS.state_id IS NOT NULL THEN 1     WHEN feaS.state_id IS NULL  and fea.country_id IS NOT   NULL  THEN 1  ELSE 0 END  ';
		 
		}
	    else if(!empty($country_id)){
			$criteria->join .= ' LEFT JOIN {{listing_users_featured}} fea ON fea.user_id = t.user_id  and fea.country_id = :country ';
			$criteria->join .= ' LEFT JOIN {{listing_users_state_featured}} feaS ON feaS.user_id = t.user_id   ';
			$criteria->join .= ' LEFT JOIN {{states}} sts ON sts.state_id = feaS.state_id and   sts.country_id  = :country ';
			
			$criteria->params[':country'] = $country_id ;
			if($property){
				// $criteria->distinct = 't.user_ids';
				 $criteria->select .= ',super_ad.ad_title as ad_title,super_ad.slug as ad_slug,  (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = super_ad.id and  img.status="A" and  img.isTrash="0"  limit 1 )   as ad_image';
				 
				//$criteria->select .= ',ad.ad_title as ad_title,ad.slug as ad_slug,   (SELECT image_name FROM {{ad_image}} img  WHERE  img.ad_id = ad.id and  img.status="A" and  img.isTrash="0"  limit 1 )   as ad_image';
				//$criteria->join .= ' INNER JOIN {{place_an_ad}} ad ON ad.user_id = t.user_id and ad.status="A" and ad.isTrash="0" and ad.country = :country ';
						  $criteria->join .= ' INNER  JOIN ( SELECT  distinct user_id, id,ad_title,slug, status,isTrash,country FROM {{place_an_ad}} adds   GROUP BY  user_id,country ) as  super_ad  ON   super_ad.user_id = t.user_id and super_ad.status="A" and super_ad.isTrash="0" and super_ad.country = :country ';
			
			} 
			 $criteria->condition .= ' and    ( fea.country_id IS NOT NULL or sts.state_id IS NOT NULL ) ';
		 
		}
		if(!empty($not_in) and is_array($not_in)){
			$criteria->addNotInCondition("t.user_id",$not_in);
		}
		$criteria->order = '-t.priority  desc';
		$criteria->limit = $limit;
		$criteria->offset =$offset;
	 
		return self::model()->findAll($criteria);
	}

	 

}
