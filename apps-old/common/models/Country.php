<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * Country
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property integer $country_id
 * @property string $name
 * @property string $code
 * @property string $status
 * @property string $date_added
 * @property string $last_updated
 *
 * The followings are the available model relations:
 * @property ListCompany $listCompany
 * @property CustomerCompany $customerCompany
 * @property Zone[] $zones
 */
class Country extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{country}}';
    }


    /**
     * @return array relational rules.
     */
    public function relations()
    {
        $relations = array(
            'listCompany' => array(self::HAS_ONE, 'ListCompany', 'country_id'),
            'customerCompany' => array(self::HAS_ONE, 'CustomerCompany', 'country_id'),
            'zones' => array(self::HAS_MANY, 'Zone', 'country_id'),
        );
        
        return CMap::mergeArray($relations, parent::relations());
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $labels = array(
            'country_id'    => Yii::t('countries', 'Country'),
            'name'          => Yii::t('countries', 'Name'),
            'code'          => Yii::t('countries', 'Code'),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Country the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
