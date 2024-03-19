<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * OptionCustomerCampaigns
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.3
 */
 
class OptionCustomerCampaigns extends OptionBase
{
    // settings category
    protected $_categoryName = 'system.customer_campaigns';

    // maximum number of campaigns a customer can have, -1 is unlimited
    public $max_campaigns = -1;

    public function rules()
    {
        $rules = array(
            array('max_campaigns', 'required'),
            array('max_campaigns', 'numerical', 'integerOnly' => true, 'min' => -1),
        );
        
        return CMap::mergeArray($rules, parent::rules());    
    }
    
    public function attributeLabels()
    {
        $labels = array(
            'max_campaigns'  => Yii::t('settings', 'Max. campaigns'),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());    
    }
    
    public function attributePlaceholders()
    {
        $placeholders = array(
            'max_campaigns' => '',
        );
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
    
    public function attributeHelpTexts()
    {
        $texts = array(
            'max_campaigns' => Yii::t('settings', 'Maximum number of campaigns a customer can have, set to -1 for unlimited'),
        );
        
        return CMap::mergeArray($texts, parent::attributeHelpTexts());
    }
}
