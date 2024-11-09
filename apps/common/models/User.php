<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * User
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $user_uid
 * @property integer $language_id
 * @property integer $service_id
 * @property integer $country_id
 * @property integer $state_id
 * @property string $first_name
 * @property string $last_name
 * @property string $age
 * @property string $gender
 * @property string $phone_number
 * @property string $email
 * @property string $password
 * @property string $description
 * @property string $licence_no
 * @property string $city
 * @property string $address
 * @property string $timezone
 * @property string $removable
 * @property string $status 
 * @property string $is_agent
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property Language $language
 * @property Services $services
 * @property Countries $countries
 * @property States $states
 * @property UserAutoLoginToken[] $autoLoginTokens
 */
class User extends ActiveRecord
{
    public $fake_password;

    public $confirm_password;

    public $confirm_email;

    public $profile_image;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array(
            // when new user is created .
            array('first_name, rules, last_name, email, confirm_email, fake_password, confirm_password, timezone, status', 'required', 'on' => 'insert'),
            // when a user is updated
            array('first_name, last_name, email,confirm_email, timezone, status', 'required', 'on' => 'update'),
            //
            array(
                'phone_number',
                'match',
                'pattern' => '/^[0-9\-\(\)\s]+$/',
                'message' => 'Phone number can only contain numbers, spaces, hyphens, and parentheses.',
                'safe' => true
            ),
            array('language_id', 'numerical', 'integerOnly' => true),
            array('language_id', 'exist', 'className' => 'Language'),
            array('state_id', 'numerical', 'integerOnly' => true),
            array('state_id', 'exist', 'className' => 'States'),
            array('country_id', 'numerical', 'integerOnly' => true),
            array('rules', 'numerical', 'integerOnly' => true),
            array('country_id', 'exist', 'className' => 'Countries'),
            array('service_id', 'numerical', 'integerOnly' => true),
            array('service_id', 'exist', 'className' => 'Services'),
            array('first_name, last_name', 'length', 'min' => 2, 'max' => 100),
            array('email, confirm_email', 'length', 'min' => 4, 'max' => 100),
            array('email, confirm_email,alt_email', 'email'),
            array('profile_image', 'file', 'types' => 'jpg, png, jpeg', 'allowEmpty' => true, 'safe' => true),
            array('description', 'length', 'max' => 3000),
            array('city', 'length', 'max' => 100),
            array('address', 'length', 'max' => 255),
            array('agents', 'length', 'max' => 255),
            array('gender', 'in', 'range' => array('Male', 'Female', 'Other')),
            array('licence_no', 'length', 'max' => 255),
            array('group_id,previousPassword,bank_id', 'safe'),
            array('timezone', 'in', 'range' => array_keys(DateTimeHelper::getTimeZones())),
            array('fake_password, confirm_password', 'length', 'min' => 6, 'max' => 100),
            array('confirm_password', 'compare', 'compareAttribute' => 'fake_password'),
            array('confirm_email', 'compare', 'compareAttribute' => 'email'),
            array('is_agent', 'in', 'range' => array(0, 1), 'message' => 'The value of is_agent must be either 0 (user) or 1 (agent).'),
            array('email', 'unique', 'criteria' => array('condition' => 'user_id != :uid', 'params' => array(':uid' => (int)$this->user_id))),

            array('target_for_sale, target_for_rent', 'numerical', 'integerOnly' => true),
            array('target_for_sale, target_for_rent ', 'safe'),
            array('target_period', 'in', 'range' => array('yearly', 'monthly', 'weekly'), 'message' => 'Please select a valid target period.'),
            array('target_period', 'safe'),

            // mark them as safe for search
            array('first_name, last_name, email, status, is_agent, agents, rules', 'safe', 'on' => 'search'),
        );

        return CMap::mergeArray($rules, parent::rules());
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        $relations = array(
            'language' => array(self::BELONGS_TO, 'Language', 'language_id'),
            'group'                 => array(self::BELONGS_TO, 'UserGroup', 'group_id'),
            'services'                 => array(self::BELONGS_TO, 'Services', 'service_id'),
            'countries'                 => array(self::BELONGS_TO, 'Countries', 'country_id'),
            'states'                 => array(self::BELONGS_TO, 'States', 'state_id'),
            'soldProperties' => array(self::HAS_MANY, 'SoldProperty', 'user_id'),
            'property'          => array(self::HAS_MANY, 'PlaceAnAd', 'user_id'),
            'autoLoginTokens' => array(self::HAS_MANY, 'UserAutoLoginToken', 'user_id'),
        );

        return CMap::mergeArray($relations, parent::relations());
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'user_id'       => Yii::t('users', 'User'),
            'group_id'       => Yii::t('users', 'User Group'),
            'language_id'   => Yii::t('users', 'Language'),
            'country_id'   => Yii::t('users', 'Country'),
            'state_id'   => Yii::t('users', 'State/Region'),
            'service_id'   => Yii::t('users', 'Designation'),
            'first_name'    => Yii::t('users', 'First name'),
            'last_name'     => Yii::t('users', 'Last name'),
            'profile_image' => Yii::t('users', 'Profile Image'),
            'age'     => Yii::t('users', 'Age'),
            'gender'     => Yii::t('users', 'Gender'),
            'licence_no'     => Yii::t('users', 'Licence No'),
            'phone_number'     => Yii::t('users', 'Phone number'),
            'email'         => Yii::t('users', $this->mTag()->gettag('email', 'Email')),
            'password'      => Yii::t('users', $this->mTag()->gettag('password', 'Password')),
            'timezone'      => Yii::t('users', 'Timezone'),
            'removable'     => Yii::t('users', 'Removable'),
            'is_agent'     => Yii::t('users', 'Is Agent'),
            'description'     => Yii::t('users', 'Description'),
            'address'     => Yii::t('users', 'Address'),
            'city'     => Yii::t('users', 'City'),
            'target_for_sale'      => Yii::t('users', 'Target for Sale'),
            'target_for_rent'      => Yii::t('users', 'Target for Rent'),
            'target_period' => Yii::t('app', 'Target Period'),

            'confirm_email'     => Yii::t('users', 'Confirm email'),
            'fake_password'     => Yii::t('users', 'Password'),
            'confirm_password'  => Yii::t('users', 'Confirm password'),
            'bank_id'  => Yii::t('users', 'Associated Company'),
            'alt_email' =>  Yii::t('users', 'Alternate Notification email'),
        );

        return CMap::mergeArray($labels, parent::attributeLabels());
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('is_agent', $this->is_agent, true);
        $criteria->compare('group_id', $this->group_id);
        $criteria->compare('service_id', $this->service_id);
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('state_id', $this->state_id);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('status!', 'deleted');
        return new CActiveDataProvider(get_class($this), array(
            'criteria'      => $criteria,
            'pagination'    => array(
                'pageSize'  => $this->paginationOptions->getPageSize(),
                'pageVar'   => 'page',
            ),
            'sort'  => array(
                'defaultOrder'  => array(
                    'user_id'   => CSort::SORT_DESC,
                ),
            ),
        ));
    }
    public function allAssigned()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('removable', 'yes');
        return User::model()->findAll($criteria);
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }

        // Check if this is a new record
        if ($this->isNewRecord) {
            $this->user_uid = $this->generateUid();
            $this->previousPassword = $this->fake_password;
            $this->sendEmailNotification();
        }

        // Hash the password if fake_password is not empty
        if (!empty($this->fake_password)) {
            $this->password = Yii::app()->passwordHasher->hash($this->fake_password);
        }

        // If the removable flag is set to TEXT_NO, ensure the status is active
        if ($this->removable === self::TEXT_NO) {
            $this->status = self::STATUS_ACTIVE;
        }

        return true;
    }

    public $previousPassword;
    public function sendEmailNotification()
    {
        $emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid('tn482sx22n40f');

        $options     =   Yii::app()->options;
        $support_phone  =  $options->get('system.common.support_phone');
        $support_email  =  $options->get('system.common.support_email');
        $notify     = Yii::app()->notify;
        if (empty($emailTemplate)) {
            return true;
        } else {
            $subject =  $emailTemplate->subject;
            $emailTemplate = $emailTemplate->content;
            $emailTemplate = str_replace('[EMAIL]', $this->email, $emailTemplate);
            $emailTemplate = str_replace('[PASSWORD]', $this->previousPassword, $emailTemplate);

            $status = 'S';

            $adminEmail = new Email();
            $adminEmail->subject = $subject;
            $adminEmail->message = $emailTemplate;
            $receipeints = serialize(array($this->email));
            $adminEmail->status = $status;
            $adminEmail->receipeints = $receipeints;
            $adminEmail->sent_on =   1;
            $adminEmail->type =   'S';
            $adminEmail->sent_on_utc =   new CDbExpression('NOW()');
            $adminEmail->save(false);
            $adminEmail->getSend(false);
        }

        return true;
    }

    protected function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        return $this->removable === self::TEXT_YES;
    }

    public function getFullName()
    {
        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        }
    }

    public function getStatusesArray()
    {
        return array(
            self::STATUS_ACTIVE     => Yii::t('app', 'Active'),
            self::STATUS_INACTIVE   => Yii::t('app', 'Inactive'),
        );
    }
    public function getRulesArray()
    {
        return array(
            1       => Yii::t('app', 'Admin'),
            2       => Yii::t('app', 'Agency'),
            3       => Yii::t('app', 'Agent'),
        );
    }

    public function getTimeZonesArray()
    {
        return DateTimeHelper::getTimeZones();
    }

    public function getNumberOfAgents()
    {
        $locationId = Yii::app()->request->getParam('location');
        $propertyTypeId = Yii::app()->request->getParam('property_type');
        $propertyCategoryId = Yii::app()->request->getParam('property_category');
        $status = Yii::app()->request->getParam('property_status');
    
        $criteria = new \CDbCriteria;
        $criteria->with = array('property');
        $criteria->compare('t.is_agent', 1);
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
    public function getAllAgents()
    {
        $criteria = new \CDbCriteria;
        $criteria->compare('t.is_agent', 1);
        $agentsArr = User::model()->findAll($criteria);
        $agentsRes = [];
        foreach ($agentsArr as $agent) {
            $agentsRes[] = $agent->first_name; // Adjust 'name' to the correct field in your model
        }
        return $agentsRes;
    }
    public function getAllAgentsProperties()
    {
        $criteria = new \CDbCriteria;
        $criteria->compare('t.is_agent', 1); // Only agents

        $criteria->with = array('property'); // Assuming 'property' is the relation defined in your User model

        $agents = User::model()->findAll($criteria);

        $agentPropertyCount = [];

        foreach ($agents as $agent) {
            $propertyCount = count($agent->property); // Get the count of properties for the agent
            $agentPropertyCount[] = $propertyCount; // Replace 'name' with the field for agent's name
        }

        return $agentPropertyCount;
    }

    public function findByUid($user_uid)
    {
        return $this->findByAttributes(array(
            'user_uid' => $user_uid,
        ));
    }

    public function generateUid()
    {
        $unique = StringHelper::uniqid();
        $exists = $this->findByUid($unique);

        if (!empty($exists)) {
            return $this->generateUid();
        }

        return $unique;
    }

    public function getUid()
    {
        return $this->user_uid;
    }

    public function getGravatarUrl($size = 50)
    {
        $hash = md5(strtolower(trim($this->email)));
        return sprintf('//www.gravatar.com/avatar/%s?s=%d', $hash, (int)$size);
    }

    public function hasRouteAccess($route)
    {
        if (empty($this->group_id)) {

            return true;
        }
        return $this->group->hasRouteAccess($route);
    }
    const SALES_TEAM = '8';
}
