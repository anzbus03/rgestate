<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * OptionBase
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.3.1
 */
 
class OptionBase extends FormModel
{
    // flag for yes text
    const TEXT_YES = 'yes';
    
    // flag for no text
    const TEXT_NO = 'no';
    
    // settings category
    protected $_categoryName;
    
    protected function afterConstruct()
    {
        parent::afterConstruct();
        if ($this->_categoryName) {
            foreach ($this->getAttributes() as $attributeName => $attributeValue) {
                $this->$attributeName = Yii::app()->options->get($this->_categoryName . '.' . $attributeName, $this->$attributeName);
            }    
        }
    }
    
    public function save()
    {
        if (!$this->validate() || !$this->_categoryName) {
            return false;
        }
        
        foreach ($this->getAttributes() as $attributeName => $attributeValue) {
            Yii::app()->options->set($this->_categoryName . '.' . $attributeName, $attributeValue);
        }
        
        return true;
    }
    
    public function getYesNoOptions()
    {
        return array(
            self::TEXT_NO  => Yii::t('app', 'No'),
            self::TEXT_YES => Yii::t('app', 'Yes'),
        );
    }

    public function getFileSizeOptions()
    {
        $options = array();
        $size = 1024 * 1024 * 1;
        $options[$size] = Yii::t('settings', '{n} Megabyte|{n} Megabytes', 1);
        for ($i = 2; $i <= 5; ++$i) {
            $size = 1024 * 1024 * $i;
            $options[$size] = Yii::t('settings', '{n} Megabyte|{n} Megabytes', $i);
        }
        for ($i = 10; $i <= 50; ++$i) {
            if ($i % 5 == 0) {
                $size = 1024 * 1024 * $i;
                $options[$size] = Yii::t('settings', '{n} Megabyte|{n} Megabytes', $i);
            }
        }
        $size = 1024 * 1024 * 100;
        $options[$size] = Yii::t('settings', '{n} Megabyte|{n} Megabytes', 100);
        return $options;
    }
    
    public function getMemoryLimitOptions()
    {
        return array(
            ''      => Yii::t('settings', 'System default'),
            '64M'   => Yii::t('settings', '{n} Megabytes', 64),
            '128M'  => Yii::t('settings', '{n} Megabytes', 128),
            '256M'  => Yii::t('settings', '{n} Megabytes', 256),
            '512M'  => Yii::t('settings', '{n} Megabytes', 512),
            '768M'  => Yii::t('settings', '{n} Megabytes', 768),
            '1G'    => Yii::t('settings', '{n} Gigabyte|{n} Gigabytes', 1),
            '2G'    => Yii::t('settings', '{n} Gigabyte|{n} Gigabytes', 2),
            '3G'    => Yii::t('settings', '{n} Gigabyte|{n} Gigabytes', 3),
            '4G'    => Yii::t('settings', '{n} Gigabyte|{n} Gigabytes', 4),
            '5G'    => Yii::t('settings', '{n} Gigabyte|{n} Gigabytes', 5),
        );
    }
     public function getTranslateHtml($field,$lan='ar',$disableEditer=1){
		 $dataRealtion = 'common_id';/* Translate relation table relation */
		 $fiedId = $this->modelName.'_'.$field;
         
		 return '<div class="pull-right"><a style="color: white !important;" href="javascript:void(0)"    data-id="'.$fiedId.'" data-fieldid="'.$this->modelName.'_'.$field.'" data-disableEditer="'.$disableEditer.'"  data-relation_id="1" data-lan="'.$lan.'" data-relation="'.$dataRealtion.'" onclick="showAjaxModal(this)"><small class="label pull-right bg-blue">'.$lan.'</small></a></div>';
	} 
    public function createTransLinkEditor($filed){
		return $this->getTranslateHtml($filed,'ar',false,'1200px').'<span class="pull-right">&nbsp;</span>' ;
	}
	public function createTransLink($filed){
		return $this->getTranslateHtml($filed,'ar').'<span class="pull-right">&nbsp;</span>' ;
	}
}
