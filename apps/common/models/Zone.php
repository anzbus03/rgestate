<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Zone
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
/**
 * This is the model class for table "zone".
 *
 * The followings are the available columns in table 'zone':
 * @property integer $zone_id
 * @property integer $country_id
 * @property string $name
 * @property string $code
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property ListCompany[] $listCompanies
 * @property UserCompany[] $userCompanies
 * @property Country $country
 */
class Zone extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{zone}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $rules = array(
            array('country_id, name, code, date_added, last_updated', 'required'),
            array('country_id', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>150),
            array('code', 'length', 'max'=>50),
            array('status', 'length', 'max'=>10),
            
            array('zone_id, country_id, name, code, status, date_added, last_updated', 'safe', 'on'=>'search'),
        );
        
        return CMap::mergeArray($rules, parent::rules());
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        $relations = array(
            'listCompanies' => array(self::HAS_MANY, 'ListCompany', 'zone_id'),
            'userCompanies' => array(self::HAS_MANY, 'UserCompany', 'zone_id'),
            'country'       => array(self::BELONGS_TO, 'Country', 'country_id'),
        );
        
        return CMap::mergeArray($relations, parent::relations());
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'zone_id'       => Yii::t('zones', 'Zone'),
            'country_id'    => Yii::t('zones', 'Country'),
            'name'          => Yii::t('zones', 'Name'),
            'code'          => Yii::t('zones', 'Code'),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Zone the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
