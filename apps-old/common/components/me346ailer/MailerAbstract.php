<?php if ( ! defined('MW_PATH')) exit('No direct script access allowed');

/**
 * MailerAbstract
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.2
 */
 
abstract class MailerAbstract extends CApplicationComponent
{
    protected $_messageId;
    
    protected $_logs = array();

    /**
     * MailerAbstract::send()
     * 
     * @param mixed $params
     * @return
     */
    abstract public function send(array $params = array());
    
    /**
     * MailerAbstract::getEmailMessage()
     * 
     * @param mixed $params
     * @return
     */
    abstract public function getEmailMessage(array $params = array());
    
    /**
     * MailerAbstract::reset()
     * 
     * @return
     */
    abstract public function reset();
    
    /**
     * MailerAbstract::getName()
     * 
     * @return string
     */
    abstract public function getName();
    
    /**
     * MailerAbstract::getDescription()
     * 
     * @return string
     */
    abstract public function getDescription();
    
    /**
     * MailerAbstract::getEmailMessageId()
     * 
     * @return
     */
    public function getEmailMessageId()
    {
        return $this->_messageId;
    }
    
    /**
     * MailerAbstract::addLog()
     * 
     * @param mixed $log
     * @return
     */
    public function addLog($log)
    {
        if (is_array($log)) {
            foreach ($log as $l) {
                $this->addLog($l);
            }
            return $this;
        }
        $this->_logs[] = $log;
        return $this;
    }
    
    /**
     * MailerAbstract::getLogs()
     * 
     * @param bool $clear
     * @return
     */
    public function getLogs($clear = true)
    {
        $logs = $this->_logs = array_unique($this->_logs);
        if ($clear) {
            $this->clearLogs();
        }
        return $logs;
    }
    
    /**
     * MailerAbstract::getLog()
     * 
     * @param string $glue
     * @param bool $clear
     * @return
     */
    public function getLog($glue = "\n", $clear = true)
    {
        return implode($glue, $this->getLogs($clear));
    }
    
    /**
     * MailerAbstract::clearLogs()
     * 
     * @return
     */
    public function clearLogs()
    {
        $this->_logs = array();
        return $this;
    }
    
    /**
     * MailerAbstract::setLocalServerNameIfMissing()
     * 
     * @return
     */
    protected function setLocalServerNameIfMissing()
    {
        if (!empty($_SERVER) && !empty($_SERVER['SERVER_NAME'])) {
            return $this;
        }
        
        if (empty($_SERVER)) {
            $_SERVER = array();
        }
        
        $options  = Yii::app()->options;
        $hostname = $options->get('system.urls.frontend_absolute_url', $options->get('system.urls.backend_absolute_url'));
        if (!empty($hostname)) {
            $hostname = @parse_url($hostname, PHP_URL_HOST);
            if (!empty($hostname)) {
                $_SERVER['SERVER_NAME'] = $hostname;
            }
        }

        if (empty($_SERVER['SERVER_NAME']) && php_uname('n') !== false) {
            $_SERVER['SERVER_NAME'] = php_uname('n');
        }
        
        if (empty($_SERVER['SERVER_NAME'])) {
            $_SERVER['SERVER_NAME'] = 'localhost.localdomain';
        }

        return $this;
    }
}