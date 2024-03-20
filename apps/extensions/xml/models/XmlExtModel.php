<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * CkeditorExtModel
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 */
 
class XmlExtModel extends FormModel
{
    public $access_code = "";
    
    public $group_code = "";
    
    public $sale_xml_url = "";
    
    public $sale_cron_url = '';
    
    public $last_update_sale_xml_url = '';
    
    public $last_update_sale_cron_url = '';
    
    public $rent_xml_url = '';
    
    public $rent_cron_url = '';
    
    public $last_update_rent_xml_url = '';
    
    public $last_update_rent_cron_url = '';
    
    public $get_country_url = '';
    public $get_country_cron_url = '';
    public $get_state_url = '';
    public $get_state_crone_url = '';
    public $get_city_url = '';
    public $get_city_cron_url = '';
    public $get_district_url = '';
    public $get_district_cron_url = '';
    public $get_community_url = '';
    public $get_community_cron_url = '';
    public $get_sub_community_url = '';
    public $get_sub_community_cron_url = '';
    public $get_agent_url = '';
    public $get_agent_cron_url = '';
    
    public function rules()
    {
        $instance = Yii::app()->extensionsManager->getExtensionInstance('xml');
        $rules = array(
            array('access_code, group_code, sale_xml_url,sale_cron_url,  last_update_sale_xml_url,  last_update_sale_cron_url, rent_xml_url,rent_cron_url,  last_update_rent_xml_url,  last_update_rent_cron_url', 'required'),
            array('get_country_url,get_state_url,get_city_url,get_district_url,get_community_url,get_sub_community_url,get_agent_url,get_country_cron_url,get_state_crone_url,get_city_cron_url,get_district_cron_url,get_community_cron_url,get_sub_community_cron_url,get_agent_cron_url', 'safe'),
         
        );
        
        return CMap::mergeArray($rules, parent::rules());    
    }
    
    public function attributeLabels()
    {
        $labels = array(
            'access_code'       => Yii::t('ext_xml', 'Access Code'),
            'group_code'   => Yii::t('ext_xml', 'Group Code'),
            'sale_xml_url'               => Yii::t('ext_xml', 'Sale Xml Url'),
            'sale_cron_url'               => Yii::t('ext_xml', 'Sale Cron Url'),
            'last_update_sale_xml_url'               => Yii::t('ext_xml', 'Last Update Sale Xml Url'),
            'last_update_sale_cron_url'               => Yii::t('ext_xml', 'Last Update Sale Cron Url'),
            'rent_xml_url'               => Yii::t('ext_xml', 'Rent Xml Url'),
            'rent_cron_url'               => Yii::t('ext_xml', 'Rent Cron Url'),
            'last_update_rent_xml_url'               => Yii::t('ext_xml', 'Last Update Rent Xml Url'),
            'last_update_rent_cron_url'               => Yii::t('ext_xml', 'Last Update Rent Cron Url'),
            'get_country_url'               => Yii::t('ext_xml', 'Url Helps for update country'),
            'get_state_url'               => Yii::t('ext_xml', 'Url Helps for update state'),
            'get_city_url'               => Yii::t('ext_xml', 'Url Helps for update city'),
            'get_district_url'               => Yii::t('ext_xml', 'Url Helps for update district'),
            'get_community_url'               => Yii::t('ext_xml', 'Url Helps for update community'),
            'get_sub_community_url'               => Yii::t('ext_xml', 'Url Helps for update subcommunity'),
            'get_agent_url'               => Yii::t('ext_xml', 'Url Helps for update agent'),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());    
    }
    
    public function attributePlaceholders()
    {
        $placeholders = array();
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
    
    public function attributeHelpTexts()
    {
        $texts = array(
            'access_code'       => Yii::t('ext_xml', 'GoMasterKey Access Code'),
            'group_code'   => Yii::t('ext_xml', 'GoMasterKey Group Code'),
            'sale_xml_url'               => Yii::t('ext_xml', 'GoMasterKey SalesListings  Url'),
            'sale_cron_url'               => Yii::t('ext_xml', 'Cpanel Crone SalesListings url'),
            'last_update_sale_xml_url'               => Yii::t('ext_xml', 'GoMasterKey SalesListingsLastUpdated  Url'),
            'last_update_sale_cron_url'               => Yii::t('ext_xml', 'Cpanel Crone SalesListingsLastUpdated   url'),
			'rent_xml_url'               => Yii::t('ext_xml', 'GoMasterKey RentListings  Url'),
			'rent_cron_url'               => Yii::t('ext_xml', 'Cpanel Crone RentListings url'),
			'last_update_rent_xml_url'               => Yii::t('ext_xml', 'GoMasterKey  RentListingsLastUpdated   Url'),
			'last_update_rent_cron_url'               => Yii::t('ext_xml', 'Cpanel Crone  RentListingsLastUpdated    url'),
			 'get_country_url'               => Yii::t('ext_xml', 'Url Helps for update country'),
			   'get_state_url'               => Yii::t('ext_xml', 'Url Helps for update state'),
			   'get_city_url'               => Yii::t('ext_xml', 'Url Helps for update city'),
			   'get_district_url'               => Yii::t('ext_xml', 'Url Helps for update district'),
			   'get_community_url'               => Yii::t('ext_xml', 'Url Helps for update community'),
			   'get_sub_community_url'               => Yii::t('ext_xml', 'Url Helps for update subcommunity'),
			   'get_agent_url'               => Yii::t('ext_xml', 'Url Helps for update agent'),
        );
        
        return CMap::mergeArray($texts, parent::attributeHelpTexts());
    }

    public function getOptionsDropDown()
    {
        return array(
            0 => Yii::t('app', 'No'),
            1 => Yii::t('app', 'Yes'),
        );
    }
    
    public function getToolbarsDropDown()
    {
        $instance = Yii::app()->extensionsManager->getExtensionInstance('ckeditor');
        $toolbars = $instance->getEditorToolbars();
        return array_combine($toolbars, $toolbars);
    }
    
    public function populate($extensionInstance)
    {
        $this->access_code      = $extensionInstance->getOption('access_code', $this->access_code);
        $this->group_code  = $extensionInstance->getOption('group_code', $this->group_code);
        $this->sale_xml_url              = $extensionInstance->getOption('sale_xml_url', $this->sale_xml_url);
        $this->sale_cron_url              = $extensionInstance->getOption('cron_url', $this->sale_cron_url);
        $this->last_update_sale_xml_url              = $extensionInstance->getOption('last_update_sale_xml_url', $this->last_update_sale_xml_url);
        $this->last_update_sale_cron_url              = $extensionInstance->getOption('last_update_sale_cron_url', $this->last_update_sale_cron_url);
        $this->rent_xml_url              = $extensionInstance->getOption('rent_xml_url', $this->rent_xml_url);
        $this->rent_cron_url              = $extensionInstance->getOption('rent_cron_url', $this->rent_cron_url);
        $this->last_update_rent_xml_url              = $extensionInstance->getOption('last_update_rent_xml_url', $this->last_update_rent_xml_url);
        $this->last_update_rent_cron_url              = $extensionInstance->getOption('last_update_rent_cron_url', $this->last_update_rent_cron_url);
        $this->get_country_url              = $extensionInstance->getOption('get_country_url', $this->get_country_url);
        $this->get_state_url              = $extensionInstance->getOption('get_state_url', $this->get_state_url);
        $this->get_city_url              = $extensionInstance->getOption('get_city_url', $this->get_city_url);
        $this->get_district_url              = $extensionInstance->getOption('get_district_url', $this->get_district_url);
        $this->get_community_url              = $extensionInstance->getOption('get_community_url', $this->get_community_url);
        $this->get_sub_community_url              = $extensionInstance->getOption('get_sub_community_url', $this->get_sub_community_url);
        $this->get_agent_url              = $extensionInstance->getOption('get_agent_url', $this->get_agent_url);
        return $this;
    }
    
    public function save($extensionInstance)
    {
        $extensionInstance->setOption('access_code', $this->access_code);
        $extensionInstance->setOption('group_code', $this->group_code);
        $extensionInstance->setOption('sale_xml_url', $this->sale_xml_url);
        $extensionInstance->setOption('sale_cron_url', $this->sale_cron_url);
        $extensionInstance->setOption('last_update_sale_xml_url', $this->last_update_sale_xml_url);
        $extensionInstance->setOption('last_update_sale_cron_url', $this->last_update_sale_cron_url);
        $extensionInstance->setOption('rent_xml_url', $this->rent_xml_url);
        $extensionInstance->setOption('rent_cron_url', $this->rent_cron_url);
        $extensionInstance->setOption('last_update_rent_xml_url', $this->last_update_rent_xml_url);
        $extensionInstance->setOption('last_update_rent_cron_url', $this->last_update_rent_cron_url);
        $extensionInstance->setOption('get_country_url', $this->get_country_url);
        $extensionInstance->setOption('get_state_url', $this->get_state_url);
        $extensionInstance->setOption('get_city_url', $this->get_city_url);
        $extensionInstance->setOption('get_district_url', $this->get_district_url);
        $extensionInstance->setOption('get_community_url', $this->get_community_url);
        $extensionInstance->setOption('get_sub_community_url', $this->get_sub_community_url);
        $extensionInstance->setOption('get_agent_url', $this->get_agent_url);
        return $this;
    }
}
