<?php

/**
 * This is the model class for table "{{statistics_page}}".
 *
 * The followings are the available columns in table '{{statistics_page}}':
 * @property integer $pid
 * @property string $ip
 * @property string $date
 * @property integer $count
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property PlaceAnAd $p
 * @property ListingUsers $user
 */
class StatisticsPage extends  ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{statistics_page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, ip, date, count', 'required'),
			array('pid, count, user_id', 'numerical', 'integerOnly' => true),
			array('ip', 'length', 'max' => 4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pid, ip, date, count, user_id', 'safe', 'on' => 'search'),
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
			'p' => array(self::BELONGS_TO, 'PlaceAnAd', 'pid'),
			'user' => array(self::BELONGS_TO, 'ListingUsers', 'user_id'),
		);
	}
	public $s_count;
	public function pageCount($duration = '', $pid = null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count ';
		$criteria->condition = '1';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.pid = ad.id  ';
		$criteria->condition .= '  and ad.status="A" and ad.isTrash="0"   ';

		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {
				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END ';
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
			$criteria->condition .= '  and t.pid = :pid  ';
			$criteria->params[':pid'] = $pid;
		}
		if (isset($_GET['property_id'])) {
			$criteria->condition .= '  and t.pid = :pid  ';
			$criteria->params[':pid'] = $_GET['property_id'];
		}
		return self::model()->find($criteria);
	}
	
	public function topPropertyViews($limit = 5, $duration = '30day')
	{
		$userId = (int)Yii::app()->user->getId();

		$criteria = new CDbCriteria;
		$criteria->alias = 't';
		$criteria->select = 't.pid AS property_id, SUM(t.count) AS total_views, ad.ad_title, ad.slug, ad.section_id';

		// Join with place_an_ad and users tables
		$criteria->join = '
			INNER JOIN {{place_an_ad}} ad ON t.pid = ad.id
			INNER JOIN {{listing_users}} usr ON usr.user_id = ad.user_id
		';

		// Base conditions - only active, non-trashed ads for current user
		$criteria->condition = implode(' AND ', [
			'ad.status = :status',
			'ad.isTrash = :isTrash'
		]);

		$criteria->params = [
			':status' => 'A',
			':isTrash' => '0'
		];

		// Handle user ownership (including parent-child relationships)
		$criteria->condition .= ' AND CASE 
			WHEN usr.parent_user IS NOT NULL THEN (usr.parent_user = :me OR ad.user_id = :me)
			ELSE ad.user_id = :me 
		END';
		$criteria->params[':me'] = $userId;

		// Add date filtering based on duration
		switch ($duration) {
			case 'today':
				$criteria->condition .= ' AND DATE(t.date) = :today';
				$controller = Yii::app()->controller;
				$today = $controller->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$criteria->params[':today'] = $today;
				break;

			case '7day':
				$criteria->condition .= ' AND t.date BETWEEN :from_date AND :to_date';
				$controller = Yii::app()->controller;
				$today = $controller->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$fromDate = date('Y-m-d', strtotime('-7 days', strtotime($today)));
				$criteria->params[':to_date'] = $today;
				$criteria->params[':from_date'] = $fromDate;
				break;

			case '30day':
				$criteria->condition .= ' AND t.date BETWEEN :from_date AND :to_date';
				$controller = Yii::app()->controller;
				$today = $controller->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$fromDate = date('Y-m-d', strtotime('-30 days', strtotime($today)));
				$criteria->params[':to_date'] = $today;
				$criteria->params[':from_date'] = $fromDate;
				break;

			case 'all':
			default:
				// No date restriction for 'all' time
				break;
		}

		// Group by property, order by total views desc, limit results
		$criteria->group = 't.pid';
		$criteria->order = 'total_views DESC';
		$criteria->limit = (int)$limit;

		return self::model()->findAll($criteria);
	}
    public $property_id;    // For t.pid AS property_id
    public $total_views;    // For SUM(t.count) AS total_views
    // public $ad_title;       // Already exists but make sure it's public
    // public $ad_id;          // Already exists
    // public $slug;           // Already exists
    // public $section_id;  
	public function getPropertyViews($propertyId, $duration = '30day')
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'SUM(t.count) as total_views';
		$criteria->condition = 't.pid = :property_id';
		$criteria->params[':property_id'] = (int)$propertyId;

		// Add date filtering
		switch ($duration) {
			case 'today':
				$criteria->condition .= ' AND DATE(t.date) = :today';
				$controller = Yii::app()->controller;
				$today = $controller->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$criteria->params[':today'] = $today;
				break;

			case '7day':
				$criteria->condition .= ' AND t.date BETWEEN :from_date AND :to_date';
				$controller = Yii::app()->controller;
				$today = $controller->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$fromDate = date('Y-m-d', strtotime('-7 days', strtotime($today)));
				$criteria->params[':to_date'] = $today;
				$criteria->params[':from_date'] = $fromDate;
				break;

			case '30day':
				$criteria->condition .= ' AND t.date BETWEEN :from_date AND :to_date';
				$controller = Yii::app()->controller;
				$today = $controller->converToTz(date('Y-m-d H:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
				$fromDate = date('Y-m-d', strtotime('-30 days', strtotime($today)));
				$criteria->params[':to_date'] = $today;
				$criteria->params[':from_date'] = $fromDate;
				break;
		}

		return self::model()->find($criteria);
	}

	/**
	 * Get views comparison between two periods
	 * @param string $currentDuration
	 * @param string $previousDuration
	 * @return array
	 */
	public function getViewsComparison($currentDuration = '30day', $previousDuration = '60day')
	{
		$userId = (int)Yii::app()->user->getId();
		
		// Current period views
		$currentViews = $this->pageCount($currentDuration);
		
		// Previous period views (you'll need to create a method for this)
		$previousViews = $this->pageCount($previousDuration, null, true); // true for previous period
		
		$currentCount = $currentViews ? $currentViews->s_count : 0;
		$previousCount = $previousViews ? $previousViews->s_count : 0;
		
		// Calculate percentage change
		$percentageChange = 0;
		if ($previousCount > 0) {
			$percentageChange = (($currentCount - $previousCount) / $previousCount) * 100;
		}
		
		return [
			'current' => $currentCount,
			'previous' => $previousCount,
			'change' => $percentageChange,
			'trend' => $percentageChange > 0 ? 'up' : ($percentageChange < 0 ? 'down' : 'stable')
		];
	}

	/**
	 * Get top properties with additional details
	 * @param int $limit
	 * @param string $duration
	 * @return array
	 */
	public function getTopPropertiesWithDetails($limit = 5, $duration = '30day')
	{
		$topProperties = $this->topPropertyViews($limit, $duration);
		$result = [];
		
		foreach ($topProperties as $property) {
			// Get additional property details
			$propertyModel = PlaceAnAd::model()->findByPk($property->property_id);
			
			if ($propertyModel) {
				$result[] = [
					'property_id' => $property->property_id,
					'total_views' => $property->total_views,
					'ad_title' => $property->ad_title,
					'slug' => $property->slug,
					'section_id' => $property->section_id,
					'property_url' => $this->getPropertyUrl($propertyModel),
					'created_date' => $propertyModel->date_added,
					'status' => $propertyModel->status,
					'views_per_day' => $this->calculateViewsPerDay($property->total_views, $duration)
				];
			}
		}
		
		return $result;
	}

	/**
	 * Calculate average views per day
	 * @param int $totalViews
	 * @param string $duration
	 * @return float
	 */
	private function calculateViewsPerDay($totalViews, $duration)
	{
		$days = 1;
		
		switch ($duration) {
			case 'today':
				$days = 1;
				break;
			case '7day':
				$days = 7;
				break;
			case '30day':
				$days = 30;
				break;
			default:
				$days = 30;
		}
		
		return round($totalViews / $days, 2);
	}

	/**
	 * Get property URL based on section
	 * @param object $property
	 * @return string
	 */
	private function getPropertyUrl($property)
	{
		if ($property->section_id == '3') {
			return Yii::app()->apps->getAppUrl('frontend', 'project/' . $property->slug, true);
		}
		return Yii::app()->apps->getAppUrl('frontend', 'property/' . $property->slug, true);
	}


	public function pageCountDatewise($duration = '')
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count , DATE(t.date) as date ';
		$criteria->condition = '1';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.pid = ad.id  ';
		$criteria->condition .= '  and ad.status="A" and ad.isTrash="0"   ';

		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END ';


		$criteria->params[':me'] = (int) Yii::app()->user->getId();

		$criteria->condition .= ' and DATE(t.date) <= :today and DATE(t.date) >= :fromdate ';
		$controller = Yii::App()->controller;
		$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
		$from_date = date('Y-m-d', strtotime('-45 days', strtotime($t_date)));
		$criteria->params[':today']    =  $t_date;
		$criteria->params[':fromdate']    =  $from_date;
		$criteria->group = 't.date';
		$criteria->order = 't.date desc ';
		return self::model()->findAll($criteria);
	}


	public $ad_title;
	public $ad_id;
	public function pageCountByProperty($duration = '')
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count,ad.ad_title,ad.id as ad_id ,ad.section_id';
		$criteria->group  = 't.pid';
		$criteria->condition = '1';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.pid = ad.id  ';
		$criteria->join  	.=  ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {

				$criteria->condition .= '  and ad.status="A" and ad.isTrash="0" and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= '  and ad.status="A" and ad.isTrash="0" and   CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END';
			$criteria->params[':me'] = (int) Yii::app()->user->getId();
		}
		$criteria->order = ' sum(t.count) desc ';
		if (isset($_GET['from_date']) and !empty($_GET['from_date'])) {
			$criteria->condition .= ' and t.date >= :from_date ';
			$controller = Yii::App()->controller;
			$from_date = $controller->converToTz($_GET['from_date'] . '00:00:00', 'Asia/Riyadh', 'UTC', 'Y-m-d');
			$criteria->params[':from_date']    =  $from_date;
		}
		if (isset($_GET['to_date']) and !empty($_GET['to_date'])) {
			$criteria->condition .= ' and t.date <= :to_date ';
			$controller = Yii::App()->controller;
			$to_date = $controller->converToTz($_GET['to_date'] . '23:59:59', 'Asia/Riyadh', 'UTC', 'Y-m-d');
			$criteria->params[':to_date']    =  $to_date;
		}


		if (isset($_GET['limit']) and !empty($_GET['limit'])) {
			$criteria->limit =  $_GET['limit'];
		} else {
			$criteria->limit =  '20';
		}
		return self::model()->findAll($criteria);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pid' => $this->mTag()->getTag('ad_title', 'Ad Title'),
			'ip' => 'IP',
			'date' => $this->mTag()->getTag('date', 'Date'),
			'count' => $this->mTag()->getTag('visits', 'Visits'),
			'user_id' => 'User',
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
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.pid = ad.id  ';
		$criteria->join .= ' LEFT JOIN {{listing_users}} usr on t.user_id = usr.user_id  ';
		if (!empty($this->user_id)) {
			$criteria->condition  .= ' and (usr.first_name like :user or usr.company_name like :user )';
			$criteria->params[':user'] = $this->user_id;
		}
		$criteria->compare('ad.ad_title', $this->pid, true);
		$criteria->compare('ip', $this->ip, true);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('count', $this->count);

		$criteria->order = 't.date desc';
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'    => array(
				'pageSize'  => $this->paginationOptions->getPageSize(),
				'pageVar'   => 'page',
			),
		));
	}
	public function pageByProperty($id = '0')
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count ';
		$criteria->condition = '1';
		$criteria->condition .= '  and t.pid= :id  ';
		$criteria->params[':id'] = (int) $id;
		$criteria->condition .= ' and t.date <= :today and t.date >= :fromdate ';
		$controller = Yii::App()->controller;
		$t_date = $controller->converToTz(date('Y-m-d h:i:s'), 'Asia/Riyadh', 'UTC', 'Y-m-d');
		$from_date = date('Y-m-d', strtotime('-30 days', strtotime($t_date)));
		$criteria->params[':today']    =  $t_date;
		$criteria->params[':fromdate']    =  $from_date;
		return self::model()->find($criteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StatisticsPage the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function pageCountall($date, $end_date)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = 'sum(t.count) as s_count, DATE(t.date) as date ';
		$criteria->condition = '1';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.pid = ad.id  ';
		$criteria->condition .= '  and ad.status="A" and ad.isTrash="0"   ';

		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {
				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END ';
			$criteria->params[':me'] = (int) Yii::app()->user->getId();
		}
		$criteria->group = ' DATE(t.date)';
		if (!empty($date)) {

			$criteria->condition .= ' and DATE(t.date) <= :date  and  DATE(t.date) >= :enddate ';
			$criteria->params[':date']   	 =  date('Y-m-d', $date);
			$criteria->params[':enddate']    =   date('Y-m-d', $end_date);
		}
		if (!empty($pid)) {
			$criteria->condition .= '  and t.pid = :pid  ';
			$criteria->params[':pid'] = $pid;
		}

		if (isset($_GET['property_id'])) {
			$criteria->condition .= '  and t.pid = :pid  ';
			$criteria->params[':pid'] = $_GET['property_id'];
		}
		$criteria->group = ' DATE(t.date)';
		$result = self::model()->findAll($criteria);

		$ar = array();
		if ($result) {
			foreach ($result as $k => $v) {
				$ar[$v->date]  = $v->s_count;
			}
		}
		return $ar;
	}
	public function page_Count()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select  = 't.*,ad.slug,ad.section_id,ad.ad_title , usr.first_name , usr.company_name, usr.full_number ';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.pid = ad.id  ';
		$criteria->join .= ' LEFT JOIN {{listing_users}} usr on t.user_id = usr.user_id  ';

		$criteria->condition = '1';
		$criteria->join = ' INNER JOIN {{place_an_ad}} ad on t.pid = ad.id  ';
		$criteria->condition .= '  and ad.status="A" and ad.isTrash="0"   ';

		$criteria->join  .=   ' INNER JOIN {{listing_users}} usr on usr.user_id = ad.user_id ';
		if (Yii::app()->isAppName('backend')) {
			if (isset($_GET['customer_id']) and !empty($_GET['customer_id'])) {
				$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END ';
				$criteria->params[':me'] = (int) $_GET['customer_id'];
			}
		} else {
			$criteria->condition .= ' and CASE WHEN usr.parent_user is NOT NULL THEN (usr.parent_user = :me or   ad.user_id = :me )   ELSE     ad.user_id = :me  END ';
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
		$criteria->order = 't.date desc';
		if (!empty($pid)) {
			$criteria->condition .= '  and t.pid = :pid  ';
			$criteria->params[':pid'] = $pid;
		}
		if (isset($_GET['property_id'])) {
			$criteria->condition .= '  and t.pid = :pid  ';
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
