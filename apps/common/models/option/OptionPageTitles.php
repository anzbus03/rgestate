<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * OptionImporter
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class OptionPageTitles extends OptionBase
{
    // settings category
    protected $_categoryName = 'system.heading';
     public $banner_heading_h1;
     public $banner_heading_h2;
     public $banner_heading_p;
     
     
     public $about_banner_heading_h1;
     public $about_banner_heading_h2;
     public $about_banner_heading_p;
     
    public function rules()
    {
        $rules = array(
            array('banner_heading_h1, banner_heading_h2, banner_heading_p', 'safe'), 
             array('about_banner_heading_h1, about_banner_heading_h2, about_banner_heading_p', 'safe'), 
        );
        
        return CMap::mergeArray($rules, parent::rules());    
    }
    
    public function attributeLabels()
    {
        $labels = array(
            'banner_heading_h1'           => Yii::t('settings', 'Banner Heading 1'),
            'banner_heading_h2'   => Yii::t('settings', 'Banner Heading 2'),
            'banner_heading_p'   => Yii::t('settings', 'Banner Heading 3'), 
            
                   'about_banner_heading_h1'           => Yii::t('settings', 'Banner Heading 1'),
            'about_banner_heading_h2'   => Yii::t('settings', 'Banner Heading 2'),
            'about_banner_heading_p'   => Yii::t('settings', 'Banner Heading 3'), 
            
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());    
    }
     
}
