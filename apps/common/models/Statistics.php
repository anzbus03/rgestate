<?php

/**
 * This is the model class for table "{{statistics}}".
 *
 * The followings are the available columns in table '{{statistics}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property integer $count
 * @property string $type
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $id0
 * @property ListingUsers $user
 */
class Statistics extends  ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{statistics}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user_id, date, count, type', 'required'),
			array('id, user_id, count', 'numerical', 'integerOnly' => true),
			array('type', 'length', 'max' => 1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, date, count, type', 'safe', 'on' => 'search'),
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
			'id0' => array(self::BELONGS_TO, 'PlaceAnAd', 'id'),
			'user' => array(self::BELONGS_TO, 'ListingUsers', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => $this->mTag()->getTag('ad_title', 'Ad Title'),
			'user_id' => 'User',
			'date' => $this->mTag()->getTag('date', 'Date'),
			'count' => $this->mTag()->getTag('visits', 'Visits'),
			'type' => 'Type',
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
	public $slug;
	public $section_id;
	public function getIpDetail()
	{
		$ip =  inet_ntop($this->ip);
		return CHtml::link($ip, 'https://ipapi.co/' . $ip, array('target' => '_blank'));
	}
	public function getDateDetail()
	{

		return date('d-m-Y h:i A', strtotime($this->date));
	}
	public function getPreviewUrlTrashB()
	{

		if ($this->section_id == '3') {
			return CHtml::link($this->ad_title, Yii::app()->apps->getAppUrl('frontend', 'project/' . $this->slug . '?showTrash=1', true), array('target' => '_blank'));
		}
		return CHtml::link($this->ad_title, Yii::app()->apps->getAppUrl('frontend', 'property/' . $this->slug . '?showTrash=1', true), array('target' => '_blank'));
	}
	public function getuserDetails()
	{
		$name = $this->first_name;
		if (!empty($this->company_name)) {
			$name .= '(' . $this->company_name . ')';
		}
		if (!empty($this->full_number)) {
			$name .= '<br /><small>' . $this->full_number . '</small>';
		}
		return CHtml::link($name, Yii::App()->createUrl('listingusers/update', array('id' => $this->user_id)), array('target' => '_blank'));
	}
	public $full_number;
	public $first_name;
	public $company_name;
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->condition  = '1';
		$criteria->select  = 't.*,ad.slug,ad.section_id,ad.ad_title , usr.first_name , usr.company_name, usr.full_number ';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join .= ' LEFT JOIN {{listing_users}} usr on t.user_id = usr.user_id  ';
		if (!empty($this->user_id)) {
			$criteria->condition  .= ' and (usr.first_name like :user or usr.company_name like :user )';
			$criteria->params[':user'] = $this->user_id;
		}
		$criteria->compare('ad.ad_title', $this->id, true);
		$criteria->compare('type', $this->type);
		$criteria->order = 't.date desc';
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'    => array(
				'pageSize'  => $this->paginationOptions->getPageSize(),
				'pageVar'   => 'page',
			),
		));
	}
	public $s_count;

	public function callCount($duration = '', $pid = null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count ';
		$criteria->condition = '1';
		$criteria->join 	 = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			$criteria->condition .= ' and t.type="C" and ad.status="A" and ad.isTrash="0"';
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {

				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= ' and t.type="C" and ad.status="A" and ad.isTrash="0" and    CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
			$criteria->params[':me'] = (int) Yii::app()->user->getId();
		}
		switch ($duration) {
			case 'today':
				$criteria->condition .= ' and DATE(t.date) = :today ';
				$controller = Yii::App()->controller;
				$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$criteria->params[':today']    =  $t_date;
				break;
			case '30day':
				$criteria->condition .= ' and DATE(t.date) <= :today and DATE(t.date) >= :fromdate ';
				$controller = Yii::App()->controller;
				$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$from_date = date('Y-m-d', strtotime('-30 days', strtotime($t_date)));
				$criteria->params[':today']    =  $t_date;
				$criteria->params[':fromdate']    =  $from_date;
				break;
		}
		if (isset($_GET['property_id'])) {
			$criteria->condition .= '  and t.id = :pid  ';
			$criteria->params[':pid'] = $_GET['property_id'];
		}
		if (!empty($pid)) {
			$criteria->condition .= '  and t.id = :pid  ';
			$criteria->params[':pid'] = $pid;
		}
		return self::model()->find($criteria);
	}

	public function whatsupCount($duration = '', $pid = null, $c_type = 'W')
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count ';
		$criteria->condition = '1';
		$criteria->join 	 = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			$criteria->condition .= ' and t.type="' . $c_type . '" and ad.status="A" and ad.isTrash="0"';
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {

				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= ' and t.type="' . $c_type . '" and ad.status="A" and ad.isTrash="0" and    CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
			$criteria->params[':me'] = (int) Yii::app()->user->getId();
		}
		switch ($duration) {
			case 'today':
				$criteria->condition .= ' and DATE(t.date) = :today ';
				$controller = Yii::App()->controller;
				$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$criteria->params[':today']    =  $t_date;
				break;
			case '30day':
				$criteria->condition .= ' and DATE(t.date) <= :today and DATE(t.date) >= :fromdate ';
				$controller = Yii::App()->controller;
				$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$from_date = date('Y-m-d', strtotime('-30 days', strtotime($t_date)));
				$criteria->params[':today']    =  $t_date;
				$criteria->params[':fromdate']    =  $from_date;
				break;
		}
		if (isset($_GET['property_id'])) {
			$criteria->condition .= '  and t.id = :pid  ';
			$criteria->params[':pid'] = $_GET['property_id'];
		}
		if (!empty($pid)) {
			$criteria->condition .= '  and t.id = :pid  ';
			$criteria->params[':pid'] = $pid;
		}
		return self::model()->find($criteria);
	}
	public $ad_title;
	public $ad_id;
	public function clickCountByProperty($type = 'C')
	{


		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count,ad.ad_title,ad.id as ad_id ,ad.last_updated as last_updateds,ad.section_id ';
		$criteria->group  = 't.id';
		$criteria->condition = '1';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			$criteria->condition .= '  and ad.status="A" and ad.isTrash="0" ';

			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {

				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= '  and ad.status="A" and ad.isTrash="0" and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
			$criteria->params[':me'] = (int) Yii::app()->user->getId();
		}
		if (!empty($type)) {
			$criteria->condition .= ' and t.type= :mtype  ';
			$criteria->params[':mtype'] = $type;
		}

		if (isset($_GET['from_date']) and !empty($_GET['from_date'])) {
			$criteria->condition .= ' and DATE(t.date) >= :from_date ';
			$controller = Yii::App()->controller;
			$from_date = $controller->converToTz($_GET['from_date'] . '00:00:00', 'Asia/Riyadh', 'UTC', 'Y-m-d');
			$criteria->params[':from_date']    =  $from_date;
		}
		if (isset($_GET['to_date']) and !empty($_GET['to_date'])) {
			$criteria->condition .= ' and DATE(t.date) <= :to_date ';
			$controller = Yii::App()->controller;
			$to_date = $controller->converToTz($_GET['to_date'] . '23:59:59', 'Asia/Riyadh', 'UTC', 'Y-m-d');
			$criteria->params[':to_date']    =  $to_date;
		}
		$criteria->order = 'sum(t.count)  desc ';
		if (isset($_GET['limit']) and !empty($_GET['limit'])) {
			$criteria->limit =  $_GET['limit'];
		} else {
			$criteria->limit =  '20';
		}
		return self::model()->findAll($criteria);
	}
	public function mailCount($duration = '', $pid = null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count ';
		$criteria->condition = '1';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			$criteria->condition .= ' and t.type="E" and ad.status="A" and ad.isTrash="0"  ';
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {
				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
			//$criteria->params[':me'] = (int) Yii::app()->user->getId();
		} else {
			$criteria->condition .= ' and t.type="E" and ad.status="A" and ad.isTrash="0" and   CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
			$criteria->params[':me'] = (int) Yii::app()->user->getId();
		}
		switch ($duration) {
			case 'today':
				$criteria->condition .= ' and DATE(t.date) = :today ';
				$controller = Yii::App()->controller;
				$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$criteria->params[':today']    =  $t_date;
				break;
			case '30day':
				$criteria->condition .= ' and DATE(t.date) <= :today and DATE(t.date) >= :fromdate ';
				$controller = Yii::App()->controller;
				$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$from_date = date('Y-m-d', strtotime('-30 days', strtotime($t_date)));
				$criteria->params[':today']    =  $t_date;
				$criteria->params[':fromdate']    =  $from_date;
				break;
		}
		if (!empty($pid)) {
			$criteria->condition .= '  and t.id = :pid  ';
			$criteria->params[':pid'] = $pid;
		}
		return self::model()->find($criteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Statistics the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function all_property_count()
	{


		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count,ad.ad_title,ad.id as ad_id ,ad.last_updated as last_updateds,ad.section_id ';
		$criteria->group  = 't.id';
		$criteria->condition = '1';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			$criteria->condition .= '  and ad.status="A" and ad.isTrash="0" ';

			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {

				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= '  and ad.status="A" and ad.isTrash="0" and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
			$criteria->params[':me'] = (int) Yii::app()->user->getId();
		}
		if (!empty($type)) {
			$criteria->condition .= ' and t.type= :mtype  ';
			$criteria->params[':mtype'] = $type;
		}

		if (isset($_GET['from_date']) and !empty($_GET['from_date'])) {
			$criteria->condition .= ' and DATE(t.date) >= :from_date ';
			$controller = Yii::App()->controller;
			$from_date = $controller->converToTz($_GET['from_date'] . '00:00:00', 'Asia/Riyadh', 'UTC', 'Y-m-d');
			$criteria->params[':from_date']    =  $from_date;
		}
		if (isset($_GET['to_date']) and !empty($_GET['to_date'])) {
			$criteria->condition .= ' and DATE(t.date) <= :to_date ';
			$controller = Yii::App()->controller;
			$to_date = $controller->converToTz($_GET['to_date'] . '23:59:59', 'Asia/Riyadh', 'UTC', 'Y-m-d');
			$criteria->params[':to_date']    =  $to_date;
		}
		$criteria->order = 'sum(t.count)  desc ';
		if (isset($_GET['limit']) and !empty($_GET['limit'])) {
			$criteria->limit =  $_GET['limit'];
		} else {
			$criteria->limit =  '20';
		}
		return self::model()->findAll($criteria);
	}

	public function allsupCount($date, $end_date, $c_type)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count,DATE(t.date) as date ';
		$criteria->condition = '1';
		$criteria->join 	 = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			$criteria->condition .= ' and t.type="' . $c_type . '" and ad.status="A" and ad.isTrash="0"';
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {

				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= ' and t.type="' . $c_type . '" and ad.status="A" and ad.isTrash="0" and    CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
			$criteria->params[':me'] = (int) Yii::app()->user->getId();
		}

		if (!empty($date)) {

			$criteria->condition .= ' and DATE(t.date) <= :date  and DATE(t.date) >= :enddate ';
			$criteria->params[':date']   	 =  date('Y-m-d', $date);
			$criteria->params[':enddate']    =   date('Y-m-d', $end_date);
		}
		if (isset($_GET['property_id'])) {
			$criteria->condition .= '  and t.id = :pid  ';
			$criteria->params[':pid'] = $_GET['property_id'];
		}

		if (!empty($pid)) {
			$criteria->condition .= '  and t.id = :pid  ';
			$criteria->params[':pid'] = $pid;
		}
		$criteria->group = 'DATE(t.date)';
		$result = self::model()->findAll($criteria);

		$ar = array();
		if ($result) {
			foreach ($result as $k => $v) {
				$ar[$v->date]  = $v->s_count;
			}
		}


		return $ar;
	}
	public function saleRent($date, $end_date, $c_type = '')
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'count(t.id) as id,DATE(t.date_added) as date_added ';
		$criteria->condition = '1';

		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		if (Yii::app()->isAppName('backend')) {
			if (!empty($c_type)) {
				$criteria->condition .= ' and t.section_id="' . $c_type . '"';
			}
			$criteria->condition .= ' and t.status="A" and  t.isTrash="0"';
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {

				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   t.user_id = :me )   ELSE     t.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		}
		if (!empty($date)) {

			$criteria->condition .= ' and DATE(t.date_added) <= :date  and DATE(t.date_added) >= :enddate ';
			$criteria->params[':date']   	 =  date('Y-m-d', $date);
			$criteria->params[':enddate']    =   date('Y-m-d', $end_date);
		}
		//	$criteria->distinct ='t.id';
		$criteria->group = 'DATE(t.date_added)';
		$result = PlaceAnAd::model()->findAll($criteria);

		$ar = array();
		if ($result) {
			foreach ($result as $k => $v) {
				$ar[$v->date_added]  = $v->id;
			}
		}

		return $ar;
	}
	/*
    public function saleRent($date,$end_date,$c_type)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
		$criteria->select = 'count(t.id) as id,DATE(t.date_added) as date_added ';
		$criteria->condition = '1';
	 
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = t.user_id ';
		if(Yii::app()->isAppName('backend')){
			$criteria->condition .= ' and t.section_id="'.$c_type.'" and t.status="A" and  t.isTrash="0"'; 
			if(isset($_GET['customer_id']) and !empty($_GET['customer_id'])){
				 
				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   t.user_id = :me )   ELSE     t.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			} 
		}    
		if(!empty($date)){
	 
			$criteria->condition .= ' and DATE(t.date_added) <= :date  and DATE(t.date_added) >= :enddate ';	 
			$criteria->params[':date']   	 =  date('Y-m-d',$date);
			$criteria->params[':enddate']    =   date('Y-m-d',$end_date);
			 
		}
		//	$criteria->distinct ='t.id';
			$criteria->group = 'DATE(t.date_added)';
		$result = PlaceAnAd::model()->findAll($criteria);
		
		$ar = array();
		if($result){
			foreach($result as $k=>$v){
				$ar[$v->date_added]  = $v->id;
				}
			 
		} 
	 
		return $ar;
         
    }
    */
	public function userGrowth($date, $end_date)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'count(t.user_id) as user_id,DATE(t.date_added) as date_added ';
		$criteria->condition = '1';
		$criteria->condition .= ' and    t.user_type = "U" and t.isTrash="0"  ';

		if (!empty($date)) {

			$criteria->condition .= ' and DATE(t.date_added) <= :date  and DATE(t.date_added) >= :enddate ';
			$criteria->params[':date']   	 =  date('Y-m-d', $date);
			$criteria->params[':enddate']    =   date('Y-m-d', $end_date);
		}
		//	$criteria->distinct ='t.id';
		$criteria->group = 'DATE(t.date_added)';
		$result = ListingUsers::model()->findAll($criteria);

		$ar = array();
		if ($result) {
			foreach ($result as $k => $v) {
				$ar[$v->date_added]  = $v->user_id;
			}
		}

		return $ar;
	}
	public function search_count()
	{
		$criteria = new CDbCriteria;
		$criteria->select  = 't.*,ad.slug,ad.section_id,ad.ad_title , usr.first_name , usr.company_name, usr.full_number ';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join .= ' LEFT JOIN {{listing_users}} usr on t.user_id = usr.user_id  ';
		$criteria->condition = '1';
		$criteria->join 	 = ' INNER JOIN {{place_an_ad}} ad on t.id = ad.id  ';
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		$criteria->compare('t.type', $this->type);
		$criteria->order = 't.date desc';
		if (Yii::app()->isAppName('backend')) {
			$criteria->condition .= '   and ad.status="A" and ad.isTrash="0"';
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {

				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END  ';
			$criteria->params[':me'] = (int) $_GET['customer_id'];
		}
		$duration = $_GET['duration'];
		switch ($duration) {
			case 'today':
				$criteria->condition .= ' and DATE(t.date) = :today ';
				$controller = Yii::App()->controller;
				$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$criteria->params[':today']    =  $t_date;
				break;
			case '30day':
				$criteria->condition .= ' and DATE(t.date) <= :today and DATE(t.date) >= :fromdate ';
				$controller = Yii::App()->controller;
				$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$from_date = date('Y-m-d', strtotime('-30 days', strtotime($t_date)));
				$criteria->params[':today']    =  $t_date;
				$criteria->params[':fromdate']    =  $from_date;
				break;
		}

		if (isset($_GET['property_id'])) {
			$criteria->condition .= '  and t.id = :pid  ';
			$criteria->params[':pid'] = $_GET['property_id'];
		}


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'    => array(
				'pageSize'  => 10,
				'pageVar'   => 'page',
			),
		));
	}
}
