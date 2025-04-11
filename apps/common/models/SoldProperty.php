<?php

/**
 * This is the model class for table "{{sold_property}}".
 *
 * The followings are the available columns in table '{{sold_property}}':
 * @property integer $sold_id
 * @property integer $user_id
 * @property integer $property_id
 * @property string $sold_price
 */
class SoldProperty extends ActiveRecord
{
    // Declare virtual properties
    public $full_name;
    public $email;
    public $property_count;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{sold_property}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('user_id, property_id, sold_price', 'required'),
            array('sold_price', 'numerical'),
            array('property_id, user_id', 'numerical', 'integerOnly' => true),
        );
    }


    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        $relations = array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'property' => array(self::BELONGS_TO, 'PlaceAnAd', 'property_id'),
        );

        // Merges the defined relations with the parent relations (if any).
        return \CMap::mergeArray($relations, parent::relations());
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'sold_id' => 'Sold ID',
            'user_id' => 'User ID',
            'property_id' => 'Property ID',
            'sold_price' => 'Sold Price',
        ];
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

        $criteria = new CDbCriteria;

        // Filters for searching
        $criteria->compare('sold_id', $this->sold_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('property_id', $this->property_id);
        $criteria->compare('sold_price', $this->sold_price, true);
        $criteria->compare('isTrash', '0'); // Only retrieve non-deleted entries

        // Ordering results by sold_id descending
        $criteria->order = 't.sold_id desc';

        return new \CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20, // Define page size (or use dynamic configuration)
                'pageVar' => 'page',
            ),
        ));
    }

    /**
     * List data function to retrieve properties that are active and not trashed.
     * 
     * @return array of SoldProperty models
     */
    public function listData()
    {
        $criteria = new \CDbCriteria;
        $criteria->select = "sold_id, sold_price";
        $criteria->condition = "t.status='A' AND t.isTrash='0'";
        $criteria->order = "t.sold_price DESC";

        return $this->findAll($criteria);
    }

    /**
     * Find sold properties by a specific user.
     * 
     * @param integer $userId
     * @return array of SoldProperty models
     */
    public function findByUser($userId)
    {
        $criteria = new \CDbCriteria;
        $criteria->compare('user_id', $userId);
        $criteria->compare('isTrash', '0'); // Ensure non-deleted properties
        $criteria->order = 't.sold_id DESC'; // Order by the latest sold properties

        return $this->findAll($criteria);
    }

    /**
     * Find sold properties within a specific price range.
     * 
     * @param float $minPrice
     * @param float $maxPrice
     * @return array of SoldProperty models
     */
    public function findByPriceRange($minPrice, $maxPrice)
    {
        $criteria = new \CDbCriteria;
        $criteria->addBetweenCondition('sold_price', $minPrice, $maxPrice);
        $criteria->compare('isTrash', '0'); // Ensure non-deleted properties
        $criteria->order = 't.sold_price ASC'; // Order by price ascending

        return $this->findAll($criteria);
    }

    /**
     * Find a sold property by its ID.
     * 
     * @param integer $soldId
     * @return SoldProperty|null
     */
    public function findBySoldId($soldId)
    {
        return $this->findByPk($soldId, 'isTrash = :isTrash', ['isTrash' => '0']);
    }

    // Get the most recent sold property for a specific user
    public function getRevenueForUser($userId, $startDate, $endDate, $sectionId) 
    {
        $sql = "SELECT SUM(sp.sold_price) as totalRevenue 
                FROM {{sold_property}} sp
                JOIN {{place_an_ad}} pa ON sp.property_id = pa.id
                WHERE sp.user_id = :user_id
                AND sp.created_at >= :start_date 
                AND sp.created_at <= :end_date
                AND pa.section_id = :section_id";

        $result = Yii::app()->db->createCommand($sql)
            ->bindParam(':user_id', $userId)
            ->bindParam(':start_date', $startDate)
            ->bindParam(':end_date', $endDate)
            ->bindParam(':section_id', $sectionId)
            ->queryScalar();

        return $result ? $result : 0;
    }
    public function getMonthlySalesData($year)
    {
        // Initialize an array with all months set to 0
        $monthlySalesData = array_fill(1, 12, 0);
    
        // Retrieve filter values from request
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');
    
        // Build the base SQL query
        $sql = "SELECT MONTH(sp.created_at) as saleMonth, SUM(sp.sold_price) as totalRevenue
                FROM {{sold_property}} sp";
    
        // Check if the place_an_ad table join is needed based on filters
        $joinNeeded = !empty($locationId) || !empty($propertyTypeId) || !empty($propertyCategoryId) || !empty($status);
    
        if ($joinNeeded) {
            $sql .= " JOIN {{place_an_ad}} pad ON sp.property_id = pad.id";
        }
    
        $sql .= " WHERE YEAR(sp.created_at) = :year
                  AND (sp.isTrash = '0')"; // Ensure non-deleted ads only if join is used
    
        // Apply filters
        if ($joinNeeded) {
            if (!empty($locationId)) {
                $sql .= " AND pad.state = :locationId";
            }
            if (!empty($propertyTypeId)) {
                $sql .= " AND pad.section_id = :propertyTypeId";
            }
            if (!empty($propertyCategoryId)) {
                $sql .= " AND pad.category_id = :propertyCategoryId";
            }
            if (!empty($status)) {
                $sql .= " AND pad.status = :status";
            }
        }
    
        $sql .= " GROUP BY MONTH(sp.created_at)";
    
        $command = Yii::app()->db->createCommand($sql)
            ->bindParam(':year', $year);
    
        // Bind parameters for filters if the join is needed
        if ($joinNeeded) {
            if (!empty($locationId)) {
                $command->bindParam(':locationId', $locationId);
            }
            if (!empty($propertyTypeId)) {
                $command->bindParam(':propertyTypeId', $propertyTypeId);
            }
            if (!empty($propertyCategoryId)) {
                $command->bindParam(':propertyCategoryId', $propertyCategoryId);
            }
            if (!empty($status)) {
                $command->bindParam(':status', $status);
            }
        }
    
        // Execute the query and fetch results
        $salesResults = $command->queryAll();
    
        // Replace 0 values with actual sales data where available
        foreach ($salesResults as $result) {
            $monthlySalesData[(int)$result['saleMonth']] = (float)$result['totalRevenue'];
        }
    
        return $monthlySalesData;
    }
    
    public function getWeeklySalesData($year, $month)
    {
        // Initialize an array with all weeks set to 0
        $weeklySalesData = array_fill(1, 5, 0); // Assuming up to 5 weeks in a month
    
        // Retrieve filter values from request
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');
    
        // Build the base SQL query
        $sql = "SELECT WEEK(sp.created_at, 3) - WEEK(DATE_SUB(sp.created_at, INTERVAL DAY(sp.created_at)-1 DAY), 3) + 1 as saleWeek, 
                       SUM(sp.sold_price) as totalRevenue
                FROM {{sold_property}} sp";
    
        // Check if the place_an_ad table join is needed based on filters
        $joinNeeded = !empty($locationId) || !empty($propertyTypeId) || !empty($propertyCategoryId) || !empty($status);
    
        if ($joinNeeded) {
            $sql .= " JOIN {{place_an_ad}} pad ON sp.property_id = pad.id";
        }
    
        $sql .= " WHERE YEAR(sp.created_at) = :year
                  AND MONTH(sp.created_at) = :month";
        
        if ($joinNeeded) {
            $sql .= " AND sp.isTrash = '0'"; // Ensure non-deleted ads
        }
    
        // Apply filters if join is needed
        if ($joinNeeded) {
            if (!empty($locationId)) {
                $sql .= " AND pad.state = :locationId";
            }
            if (!empty($propertyTypeId)) {
                $sql .= " AND pad.section_id = :propertyTypeId";
            }
            if (!empty($propertyCategoryId)) {
                $sql .= " AND pad.category_id = :propertyCategoryId";
            }
            if (!empty($status)) {
                $sql .= " AND pad.status = :status";
            }
        }
    
        $sql .= " GROUP BY saleWeek";
    
        $command = Yii::app()->db->createCommand($sql)
            ->bindParam(':year', $year)
            ->bindParam(':month', $month);
    
        // Bind parameters for filters if the join is needed
        if ($joinNeeded) {
            if (!empty($locationId)) {
                $command->bindParam(':locationId', $locationId);
            }
            if (!empty($propertyTypeId)) {
                $command->bindParam(':propertyTypeId', $propertyTypeId);
            }
            if (!empty($propertyCategoryId)) {
                $command->bindParam(':propertyCategoryId', $propertyCategoryId);
            }
            if (!empty($status)) {
                $command->bindParam(':status', $status);
            }
        }
    
        $salesResults = $command->queryAll();
    
        // Replace 0 values with actual sales data where available
        foreach ($salesResults as $result) {
            $weeklySalesData[$result['saleWeek']] = (float)$result['totalRevenue'];
        }
    
        return $weeklySalesData;
    }
    
    
    public function getDailySalesData($startDate, $endDate)
    {
        // Initialize array with all days set to 0
        $dailySalesData = [];
        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval('P1D'),
            new DateTime($endDate)
        );
    
        foreach ($period as $date) {
            $dailySalesData[$date->format('Y-m-d')] = 0; // Default revenue 0 for each day
        }
    
        // Retrieve filter values from request
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');
    
        // Build the base SQL query
        $sql = "SELECT DATE(sp.created_at) as saleDate, SUM(sp.sold_price) as totalRevenue
                FROM {{sold_property}} sp";
    
        // Check if the place_an_ad table join is needed based on filters
        $joinNeeded = !empty($locationId) || !empty($propertyTypeId) || !empty($propertyCategoryId) || !empty($status);
    
        if ($joinNeeded) {
            $sql .= " JOIN {{place_an_ad}} pad ON sp.property_id = pad.id";
        }
    
        $sql .= " WHERE sp.created_at >= :start_date 
                  AND sp.created_at <= :end_date";
    
        if ($joinNeeded) {
            $sql .= " AND sp.isTrash = '0'"; // Ensure non-deleted ads
        }
    
        // Apply filters if join is needed
        if ($joinNeeded) {
            if (!empty($locationId)) {
                $sql .= " AND pad.state = :locationId";
            }
            if (!empty($propertyTypeId)) {
                $sql .= " AND pad.section_id = :propertyTypeId";
            }
            if (!empty($propertyCategoryId)) {
                $sql .= " AND pad.category_id = :propertyCategoryId";
            }
            if (!empty($status)) {
                $sql .= " AND pad.status = :status";
            }
        }
    
        $sql .= " GROUP BY DATE(sp.created_at)";
    
        $command = Yii::app()->db->createCommand($sql)
            ->bindParam(':start_date', $startDate)
            ->bindParam(':end_date', $endDate);
    
        // Bind parameters for filters if the join is needed
        if ($joinNeeded) {
            if (!empty($locationId)) {
                $command->bindParam(':locationId', $locationId);
            }
            if (!empty($propertyTypeId)) {
                $command->bindParam(':propertyTypeId', $propertyTypeId);
            }
            if (!empty($propertyCategoryId)) {
                $command->bindParam(':propertyCategoryId', $propertyCategoryId);
            }
            if (!empty($status)) {
                $command->bindParam(':status', $status);
            }
        }
    
        $salesResults = $command->queryAll();
        // Replace 0 values with actual sales data where available
        foreach ($salesResults as $result) {
            // $dailySalesData[$result['saleDate']] = (float)$result['totalRevenue'];
        }
    
        return $dailySalesData;
    }
    
    public function getRevenueForAll($startDate, $endDate)
    {
        // Retrieve filter values from request
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');

        // Define criteria for querying
        $criteria = new \CDbCriteria;
        $criteria->select = 't.sold_price, t.sold_id'; // Selecting sold_price and sold_id
        $criteria->addBetweenCondition('t.created_at', $startDate, $endDate); // Date range filter
        $criteria->compare('t.isTrash', '0'); // Non-deleted properties

        // Join the place_an_ad table using the 'property_id'
        $criteria->with = array('property');
        $criteria->together = true;

        // Apply the same filters as in the getSalesThisMonth function
        if (!empty($locationId)) {
            $criteria->compare('property.state', (int)$locationId);
        }

        if (!empty($propertyTypeId)) {
            $criteria->compare('property.section_id', (int)$propertyTypeId);
        }

        if (!empty($propertyCategoryId)) {
            $criteria->compare('property.category_id', (int)$propertyCategoryId);
        }

        if (!empty($status)) {
            $criteria->compare('property.status', $status);
        }

        // Fetch the results
        $soldProperties = $this->findAll($criteria);

        // Calculate the total revenue ensuring sold_id is not repeated
        $totalRevenue = 0;
        $uniqueSoldIds = [];

        foreach ($soldProperties as $property) {
            if (!in_array($property->sold_id, $uniqueSoldIds)) {
                $totalRevenue += $property->sold_price; // Add the sold price to the total
                $uniqueSoldIds[] = $property->sold_id; // Keep track of unique sold IDs
            }
        }

        // Return the total revenue or 0 if no records found
        return $totalRevenue;
    }

   
    
    // Get the total number of properties sold by a user
    public function getTotalPropertiesSoldForUserSale($id)
    {
        $user = User::model()->findByPk((int)$id);

        $criteria = new \CDbCriteria;
        $criteria->compare('user_id', $user->user_id);
        $criteria->compare('isTrash', '0'); // Ensure non-deleted properties

        return $this->count($criteria);
    }

    // Get the number of properties sold by a user in the current month
    public function getSalesThisMonthForUser()
    {
        $userId = Yii::app()->user->id; // Get the logged-in user's ID

        // Using PHP's DateTime to get start and end of the current month
        $startOfMonth = (new \DateTime('first day of this month'))->format('Y-m-d H:i:s');
        $endOfMonth = (new \DateTime('last day of this month 23:59:59'))->format('Y-m-d H:i:s');

        $criteria = new \CDbCriteria;
        $criteria->compare('user_id', $userId);
        $criteria->compare('isTrash', '0'); // Ensure non-deleted properties
        $criteria->addBetweenCondition('created_at', $startOfMonth, $endOfMonth);

        return $this->count($criteria);
    }
    public function getSalesThisMonth()
    {
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');
    
        // Using PHP's DateTime to get start and end of the current month
        $startOfMonth = (new \DateTime('first day of this month'))->format('Y-m-d H:i:s');
        $endOfMonth = (new \DateTime('last day of this month 23:59:59'))->format('Y-m-d H:i:s');

        $criteria = new \CDbCriteria;
        $criteria->compare('t.isTrash', '0'); // Ensure non-deleted properties
        $criteria->addBetweenCondition('t.created_at', $startOfMonth, $endOfMonth);
        $criteria->with = array('property');
        if (!empty($locationId)) {
            $criteria->compare('property.state', (int)$locationId);
        }
    
        if (!empty($propertyTypeId)) {
            $criteria->compare('property.section_id', (int)$propertyTypeId);
        }
    
        if (!empty($propertyCategoryId)) {
            $criteria->compare('property.category_id', (int)$propertyCategoryId);
        }
    
        if (!empty($status)) {
            $criteria->compare('property.status', $status);
        }
        return $this->count($criteria);
    }
    public function getSalesTotal()
    {
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');
    
        $startDateYear = date('Y-01-01');
        $endDateYear = date('Y-m-d', strtotime('+1 day'));
    
        $criteria = new CDbCriteria;
        $criteria->compare('t.isTrash', '0'); 
        $criteria->addBetweenCondition('t.created_at', $startDateYear, $endDateYear);
    
        $criteria->with = array('property');
        if (!empty($locationId)) {
            $criteria->compare('property.state', (int)$locationId);
        }
    
        if (!empty($propertyTypeId)) {
            $criteria->compare('property.section_id', (int)$propertyTypeId);
        }
    
        if (!empty($propertyCategoryId)) {
            $criteria->compare('property.category_id', (int)$propertyCategoryId);
        }
    
        if (!empty($status)) {
            $criteria->compare('property.status', $status);
        }
        return $this->count($criteria);
    }
    
    public function getTop5ActiveAgents($startDate = null, $endDate = null)
    {
        // Retrieve additional filter values from the request.
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');
    
        // Base SQL query (adjust the date field name if needed)
        $sql = "SELECT 
                    pa.user_id, 
                    COUNT(pa.id) AS property_count, 
                    CONCAT(u.first_name, ' ', u.last_name) AS full_name,
                    u.email
                FROM {{place_an_ad}} pa
                INNER JOIN mw_user u ON u.user_id = pa.user_id
                WHERE u.rules = 3    
                  AND pa.isTrash = '0'";
    
        // Add date filtering if provided.
        if (!empty($startDate) && !empty($endDate)) {
            $sql .= " AND pa.date_added >= :startDate AND pa.date_added <= :endDate";
        }
    
        // Append additional filters from GET parameters.
        if (!empty($locationId)) {
            $sql .= " AND pa.state = :locationId";
        }
        if (!empty($propertyTypeId)) {
            $sql .= " AND pa.section_id = :propertyTypeId";
        }
        if (!empty($propertyCategoryId)) {
            $sql .= " AND pa.category_id = :propertyCategoryId";
        }
        if (!empty($status)) {
            $sql .= " AND pa.status = :status";
        }
    
        // Complete SQL query.
        $sql .= " 
                 GROUP BY pa.user_id
                 ORDER BY property_count DESC
                 LIMIT 5";
    
        $command = Yii::app()->db->createCommand($sql);
    
        // Bind date parameters, if provided.
        if (!empty($startDate) && !empty($endDate)) {
            $command->bindParam(':startDate', $startDate);
            $command->bindParam(':endDate', $endDate);
        }
        if (!empty($locationId)) {
            $command->bindParam(':locationId', $locationId);
        }
        if (!empty($propertyTypeId)) {
            $command->bindParam(':propertyTypeId', $propertyTypeId);
        }
        if (!empty($propertyCategoryId)) {
            $command->bindParam(':propertyCategoryId', $propertyCategoryId);
        }
        if (!empty($status)) {
            $command->bindParam(':status', $status);
        }
    
        $result = $command->queryAll();
        return $result;
    }
    
    

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            // Set the created_at field to the current timestamp
            $this->created_at = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }



    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return sold_property the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}