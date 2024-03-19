<?php defined('MW_PATH') || exit('No direct script access allowed');

/**
 * WebCustomer
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.0
 */
 
class WebCustomer extends BaseWebUser
{
    protected $_model;
    
    public function init()
    {
        parent::init();

       
        
        // in case the logged in customer has been deleted while logged in.
        if ($this->getId() > 0 && !$this->getModel()) {
            $this->setId(null);
        }
    }
    
    /**
     * This method is invoked when {@link logout} is called.
     * If the allow auto login feature is enabled, it will destroy the auto login token.
     * 
     * @return bool
     */
    protected function beforeLogout()
    {
        if($this->allowAutoLogin) {
            ListingUserAutoLoginToken::model()->deleteAllByAttributes(array(
                'user_id' => (int)$this->getId(),
            ));  
        }
        return true;
    }
    
    /**
     * Method called right before the user needs to be logged in.
     * If this method returns false, the user will not be logged in.
     * 
     * @param int $id the user id
     * @param array $states the user states
     * @param bool $fromCookie whether the login comes from a cookie
     */
    protected function beforeLogin($id, $states, $fromCookie)
    {
        if (!$fromCookie) {
            return true;
        }
        
        if ($this->allowAutoLogin) {
            
            if (empty($states['__listing_user_auto_login_token'])) {
                return false;
            }
            
            $autoLoginToken = ListingUserAutoLoginToken::model()->findByAttributes(array(
                'user_id'    => (int)$id,
                'token'            => $states['__listing_user_auto_login_token'],
            ));
            
            if(empty($autoLoginToken)) {
                return false;
            }    
        }

        return true;
    }
    
    /**
     * Called after the user logs in.
     * 
     * @param bool $fromCookie whether the login comes from a cookie 
     */
    protected function afterLogin($fromCookie)
    {
    }
    
    public function getModel()
    {
        if ($this->_model !== null) {
			 
            return $this->_model;
             
          
        }
      
      return $this->_model = ListingUsers::model()->findByPk((int)$this->getId());
          
    }
    
    // not the best way i know, but clean enough.
    
}
