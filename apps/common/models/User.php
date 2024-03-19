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
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $timezone
 * @property string $removable
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property Language $language
 * @property UserAutoLoginToken[] $autoLoginTokens
 */
class User extends ActiveRecord
{
    public $fake_password;

    public $confirm_password;
    
    public $confirm_email;
    
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
            array('first_name, last_name, email, confirm_email, fake_password, confirm_password, timezone, status', 'required', 'on' => 'insert'),
            // when a user is updated
            array('first_name, last_name, email, confirm_email, timezone, status', 'required', 'on' => 'update'),
            //
            array('language_id', 'numerical', 'integerOnly' => true),
            array('language_id', 'exist', 'className' => 'Language'),
            array('first_name, last_name', 'length', 'min' => 2, 'max' => 100),
            array('email, confirm_email', 'length', 'min' => 4, 'max' => 100),
            array('email, confirm_email,alt_email', 'email'),
            array('group_id,previousPassword,bank_id', 'safe'),
            array('timezone', 'in', 'range' => array_keys(DateTimeHelper::getTimeZones())),
            array('fake_password, confirm_password', 'length', 'min' => 6, 'max' => 100),
            array('confirm_password', 'compare', 'compareAttribute' => 'fake_password'),
            array('confirm_email', 'compare', 'compareAttribute' => 'email'),
            array('email', 'unique', 'criteria' => array('condition' => 'user_id != :uid', 'params' => array(':uid' => (int)$this->user_id) )),

            // mark them as safe for search
            array('first_name, last_name, email, status', 'safe', 'on' => 'search'),
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
            'first_name'    => Yii::t('users', 'First name'),
            'last_name'     => Yii::t('users', 'Last name'),
            'email'         => Yii::t('users', $this->mTag()->gettag('email','Email')),
            'password'      => Yii::t('users', $this->mTag()->gettag('password','Password')),
            'timezone'      => Yii::t('users', 'Timezone'),
            'removable'     => Yii::t('users', 'Removable'),
            
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
        $criteria=new CDbCriteria;

        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('group_id', $this->group_id);
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
        $criteria=new CDbCriteria;
    
        $criteria->compare('removable', 'yes');
        return User::model()->findAll($criteria); 
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }
        
        if ($this->isNewRecord) {
            $this->user_uid = $this->generateUid();
            $this->previousPassword = $this->fake_password;
            $this->sendEmailNotification();
        }
        
        if (!empty($this->fake_password)) {
            $this->password = Yii::app()->passwordHasher->hash($this->fake_password);
        }
        
        if ($this->removable === self::TEXT_NO) {
            $this->status = self::STATUS_ACTIVE;
        }
        
        return true;
    }
    public $previousPassword;
     public function sendEmailNotification(){
			$emailTemplate =  CustomerEmailTemplate::model()->getTemplateByUid('tn482sx22n40f');
			 
			$options     =   Yii::app()->options;
			$support_phone  =  $options->get('system.common.support_phone');
			$support_email  =  $options->get('system.common.support_email');
			$notify     = Yii::app()->notify;
			if(empty($emailTemplate)) { return true ; }
			else{
				  $subject =  $emailTemplate->subject;
				  $emailTemplate = $emailTemplate->content; 
			 	  $emailTemplate = str_replace('[EMAIL]' , $this->email, $emailTemplate);
				  $emailTemplate = str_replace('[PASSWORD]' , $this->previousPassword, $emailTemplate);
				  
				 $status = 'S';
				  
				 $adminEmail = new Email();			 
				 $adminEmail->subject = $subject ;
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
            return $this->first_name.' '.$this->last_name;
        }
    }
    
    public function getStatusesArray()
    {
        return array(
            self::STATUS_ACTIVE     => Yii::t('app', 'Active'),
            self::STATUS_INACTIVE   => Yii::t('app', 'Inactive'),
        );
    }
    
    public function getTimeZonesArray()
    {
        return DateTimeHelper::getTimeZones();
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
	CONST SALES_TEAM = '8';
}
