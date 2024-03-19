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
 
class OptionCommonMessages extends OptionBase
{
    // settings category
    protected $_categoryName = 'system.messages';
    public $_meesage_after_register;
    public $_message_after_register_if_confirmed;
    public $successfully_verified_email_msg;
    public $successfully_saved_personal_information;
     public $successfully_changed_avatar;
     public $_message_after_resent;
     public $_meesage_after_forgot_password;
     public $_meesage_after_login_info_sent;
    public function rules()
    {
        $rules = array(
            array('_meesage_after_register,_message_after_register_if_confirmed,successfully_verified_email_msg,successfully_saved_personal_information,successfully_changed_avatar,_message_after_resent', 'required'),
              array('_meesage_after_forgot_password,_meesage_after_login_info_sent', 'required'),
        
        );
        
        return CMap::mergeArray($rules, parent::rules());    
    }
    
    public function attributeLabels()
    {
        $labels = array(
            '_meesage_after_register'             => Yii::t('settings', 'Message after register succesfully'),
            '_message_after_register_if_confirmed'             => Yii::t('settings', 'Message after register succesfully , and confirmed by default'),
           'successfully_verified_email_msg'             => Yii::t('settings', 'Message after   succesfully verified email  '),
           'successfully_saved_personal_information'             => Yii::t('settings', 'Message after  succesfully saved personal information'),
            'successfully_changed_avatar'             => Yii::t('settings', 'Message after  succesfully changed your profile picture'),
             '_message_after_resent'             => Yii::t('settings', 'Message after  succesfully resent / changed email'),
              '_meesage_after_forgot_password'             => Yii::t('settings', 'Message after  succesfully  reset password link sent'),
               '_meesage_after_login_info_sent'             => Yii::t('settings', 'Message after   login info sent  '),
        );
        
        return CMap::mergeArray($labels, parent::attributeLabels());    
    }
    
    public function attributePlaceholders()
    {
        $placeholders = array(
            '_meesage_after_register'         => Yii::t('app', 'Message after register succesfully'),
             
        );
        
        return CMap::mergeArray($placeholders, parent::attributePlaceholders());
    }
    
    public function attributeHelpTexts()
    {
        $texts = array(
            '_meesage_after_register'             => Yii::t('settings', 'This text will come out after succesfull registartion.'),
        );
        
        return CMap::mergeArray($texts, parent::attributeHelpTexts());
    }

   
}
