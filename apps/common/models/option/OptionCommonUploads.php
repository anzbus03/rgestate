<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * OptionCommon
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class OptionCommonUploads extends OptionBase
{
    // settings category
    protected $_categoryName = 'system.upload';
    
    public $agent_avatar_resize_width;
    public $developer_avatar_resize_width;
    public $agent_avatar_resize_height;
    public $developer_avatar_resize_height;
   
    
    public function rules()
    {
        $rules = array(
            array('agent_avatar_resize_width,agent_avatar_resize_height', 'numerical', 'integerOnly'=>true),
            array('developer_avatar_resize_width,developer_avatar_resize_height', 'numerical', 'integerOnly'=>true),
            
        );
        
        return CMap::mergeArray($rules, parent::rules());    
    }
    
    public function attributeLabels()
    {
           $labels = array(
            'agent_avatar_resize_width'              => Yii::t('settings', 'Agent Profile Picture Resize Width'),
            'developer_avatar_resize_width'          => Yii::t('settings', 'Developer Profile Picture Resize Width'),
            'agent_avatar_resize_height'             => Yii::t('settings', 'Agent Profile Picture Resize Height[Keep blank For Fixed Width]'),
            'developer_avatar_resize_height'         => Yii::t('settings', 'Developer Profile Picture Resize Height[Keep blank For Fixed Width]'),
           
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());    
    }
    
    public function attributePlaceholders()
    {
        $placeholders = array(
            'site_name'         => Yii::t('app', 'sdfsd'),
            'site_tagline'      => Yii::t('app', 'sdfsdfsdf'),
            'site_description'  => '',
            'site_keywords'     => '',
            'company_info'      => '',
        );
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    } 
}
