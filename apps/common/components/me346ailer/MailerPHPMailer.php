<?php if ( ! defined('MW_PATH')) exit('No direct script access allowed');

/**
 * MailerPHPMailer
 * 
 * @package MailWizz EMA
 * @author Serban George Cristian <cristian.serban@mailwizz.com> 
 * @link http://www.mailwizz.com/
 * @copyright 2013-2014 MailWizz EMA (http://www.mailwizz.com)
 * @license http://www.mailwizz.com/license/
 * @since 1.3.4.2
 */
 
class MailerPHPMailer extends MailerAbstract
{
    private $_transport;
    
    private $_message;
    
    private $_mailer;
    
    private $_sentCounter = 0;

    /**
     * MailerPHPMailer::init()
     * 
     * @return
     */
    public function init()
    {
        require_once Yii::getPathOfAlias('common.vendors.PHPMailer') . '/class.mphpmailer.php';
        parent::init();
    }

    /**
     * MailerPHPMailer::send()
     * 
     * Implements the parent abstract method
     * 
     * @param mixed $params
     * @return bool
     */
    public function send(array $params = array())
    {
        $this->clearLogs()->setTransport($params)->setMessage($params);
        
        if (!$this->getTransport() || !$this->getMessage()) {
            return false;            
        }
        
        $plugins = isset($params['mailerPlugins']) ? $params['mailerPlugins'] : array();
        
        if (isset($plugins['antiFloodPlugin']) && is_array($plugins['antiFloodPlugin'])) {
            $data       = $plugins['antiFloodPlugin'];
            $sendAtOnce = isset($data['sendAtOnce']) && $data['sendAtOnce'] > 0 ? $data['sendAtOnce'] : 100;
            $pause      = isset($data['pause']) && $data['pause'] > 0 ? $data['pause'] : 30;
            
            if ($this->_sentCounter >= $sendAtOnce && (($this->_sentCounter % $sendAtOnce) == 0)) {
                sleep($pause);
            }
        }
        
        if (isset($plugins['throttlePlugin']) && is_array($plugins['throttlePlugin'])) {
            $data      = $plugins['throttlePlugin'];
            $perMinute = isset($data['perMinute']) && $data['perMinute'] > 0 ? $data['perMinute'] : 60;
            usleep(floor((60 / $perMinute) * 1000));
        }
        
        $mailer = $this->getMailer();
        if(!($sent = (bool)$mailer->send())) {
            if ($mailer->SMTPDebug && $mailer->Debugoutput == 'logger' && ($log = $mailer->getLog())){
                $this->addLog($log);
            } elseif (!empty($mailer->ErrorInfo)) {
                $this->addLog($mailer->ErrorInfo);
            }
        } else {
            $this->addLog('OK');
        } 
        
        $this->_sentCounter++;
        
        return $sent;
    }  
    
    /**
     * MailerPHPMailer::getEmailMessage()
     * 
     * Implements the parent abstract method
     * 
     * @param mixed $params
     * @return mixed
     */
    public function getEmailMessage(array $params = array())
    {
        $this->reset()->setMessage($params)->getMailer()->preSend(); 
        if ($lastMessageId = $this->getMailer()->getLastMessageID()) {
            $this->_messageId = str_replace(array('<', '>'), '', $lastMessageId);
        }
        return $this->getMailer()->getSentMIMEMessage();
    } 
    
    /**
     * MailerPHPMailer::reset()
     * 
     * Implements the parent abstract method
     * 
     * @return MailerPHPMailer
     */
    public function reset()
    {
        return $this->resetTransport()->resetMessage()->resetMailer()->clearLogs();
    }
    
    /**
     * MailerPHPMailer::getName()
     * 
     * Implements the parent abstract method
     * 
     * @return string
     */
    public function getName()
    {
        return 'PHPMailer';
    }
    
    /**
     * MailerPHPMailer::getDescription()
     * 
     * Implements the parent abstract method
     * 
     * @return string
     */
    public function getDescription()
    {
        return Yii::t('mailer', 'A very fast mailer.');
    }

    /**
     * MailerPHPMailer::setTransport()
     * 
     * @param mixed $params
     * @return mixed
     */
    protected function setTransport($params = array())
    {
        if ($this->_transport !== null) {
            return $this;
        }
        
        $this->resetTransport()->resetMailer();
        
        $params = new CMap($params);
        if (!($transport = $this->buildTransport($params))) {
            return $this;
        }
        
        $this->_transport = $transport;
        
        return $this;
    }

    /**
     * MailerPHPMailer::setMessage()
     * 
     * @param mixed $params
     * @return mixed
     */
    protected function setMessage($params = array())
    {
        $mailer = $this->getMailer();
        
        $this->resetMessage();
        $mailer->clearAllRecipients();
        $mailer->clearCustomHeaders();
        $mailer->clearReplyTos();
        $mailer->clearAttachments();
    
        $params = new CMap($params);
        
        if (!$params->contains('from') && $params->contains('username')) {
            $params->add('from', $params->itemAt('username'));
        }
        
        $requiredKeys = array('to', 'from', 'subject');
        foreach ($requiredKeys as $key) {
            if (!$params->contains($key)) {
                return $this;
            }
        }
        
        if (!$params->contains('body') && !$params->contains('plainText')) {
            return $this;
        }
        
        $this->setLocalServerNameIfMissing();
        $this->_message    = true;
        $mailer->messageID = sprintf('<%s@%s>', md5(StringHelper::uniqid() . StringHelper::uniqid()), $_SERVER['SERVER_NAME']);
        $this->_messageId  = str_replace(array('<', '>'), '', $mailer->messageID);
         
        if ($params->contains('headers') && is_array($params->itemAt('headers'))) {
            foreach ($params->itemAt('headers') as $name => $value) {
                $mailer->addCustomHeader($name, $value);
            }
        }
        
        if (is_string($params->itemAt('from'))) {
            $mailer->From = $params->itemAt('from');
        } else {
            foreach ($params->itemAt('from') as $email => $name) {
                $mailer->From = $email;
                $mailer->FromName = $name;
                break;
            }
        }

        if (is_string($params->itemAt('to'))) {
            $mailer->addAddress($toEmail = $params->itemAt('to'));
        } else {
            foreach ($params->itemAt('to') as $email => $name) {
                $mailer->addAddress($toEmail = $email, $name);
                break;
            }
        }
        
        if ($params->contains('replyTo')) {
            if (is_string($params->itemAt('replyTo'))) {
                $mailer->addReplyTo($params->itemAt('replyTo'));
            } else {
                foreach ($params->itemAt('replyTo') as $email => $name) {
                    $mailer->addReplyTo($email, $name);
                    break;
                }
            }
        }
        
        $mailer->Sender = $mailer->From;
        if ($params->contains('returnPath')) {
            $mailer->ReturnPath = $params->itemAt('returnPath');
        }
        
        if ($params->contains('fromName') && $params->itemAt('fromName') && is_string($params->itemAt('fromName'))) {
            $mailer->FromName = $params->itemAt('fromName');
        }
        
        $mailer->addCustomHeader('X-Sender', $mailer->From);
        $mailer->addCustomHeader('X-Receiver', $toEmail);
        $mailer->addCustomHeader('X-Mw-Mailer', 'PHPMailer');

        if (empty($mailer->FromName) || strtolower($mailer->FromName) == 'root user') {
            $emailParts = explode('@', $mailer->From);
            $mailer->FromName = ucwords(str_replace(array('.', '_'), ' ', $emailParts[0]));
        }

        $mailer->Subject = $params->itemAt('subject');
        $mailer->Body    = $params->itemAt('body');
        $mailer->AltBody = $params->itemAt('plainText');
        
        if (empty($mailer->AltBody)) {
            $mailer->AltBody = CampaignHelper::htmlTotext($params->itemAt('body'));
        }
        
        $attachments = $params->itemAt('attachments');
        if (!empty($attachments) && is_array($attachments)) {
            $attachments = array_unique($attachments);
            foreach ($attachments as $attachment) {
                if (is_file($attachment)) {
                    $mailer->addAttachment($attachment);
                }
            }
            unset($attachments);
        }
        
        $embedImages = $params->itemAt('embedImages');
        if (!empty($embedImages) && is_array($embedImages)) {
            foreach ($embedImages as $imageData) {
                if (!isset($imageData['path'], $imageData['cid'])) {
                    continue;
                }
                if (is_file($imageData['path'])) {
                    $imageData['name'] = empty($imageData['name']) ? basename($imageData['path']) : $imageData['name'];
                    $imageData['mime'] = empty($imageData['mime']) ? '' : $imageData['mime'];
                    $mailer->addEmbeddedImage($imageData['path'], $imageData['cid'], $imageData['name'], 'base64', $imageData['mime']);
                }
            }
            unset($embedImages);
        }
        
        $mailer->XMailer = ' ';
        $mailer->isHTML(true);
        
        return $this;
    }
    
    /**
     * MailerPHPMailer::getTransport()
     * 
     * @return mixed
     */
    protected function getTransport()
    {
        return $this->_transport;
    }
    
    /**
     * MailerPHPMailer::getMessage()
     * 
     * @return mixed
     */
    protected function getMessage()
    {
        return $this->_message;
    }

    /**
     * MailerPHPMailer::getMailer()
     * 
     * @return mixed
     */
    protected function getMailer()
    {
        if ($this->_mailer === null) {
            $this->_mailer = new MPHPMailer();
            $this->_mailer->CharSet = Yii::app()->charset;
            $this->_mailer->Priority = 1;
            $this->_mailer->SMTPDebug = 1;
            $this->_mailer->Debugoutput = 'logger';
        }
        return $this->_mailer;
    }

    /**
     * MailerPHPMailer::resetTransport()
     * 
     * @return MailerPHPMailer
     */
    protected function resetTransport()
    {
        $this->_sentCounter = 0;
        $this->_transport = null;
        return $this;
    }
    
    /**
     * MailerPHPMailer::resetMessage()
     * 
     * @return MailerPHPMailer
     */
    protected function resetMessage()
    {
        $this->_messageId = null;
        $this->_message = null;
        return $this;
    }
    
    /**
     * MailerPHPMailer::resetMailer()
     * 
     * @return MailerPHPMailer
     */
    protected function resetMailer()
    {
        if ($this->_mailer !== null && $this->_mailer->SMTPKeepAlive) {
            $this->_mailer->smtpClose();
        }
        $this->_mailer = null;
        return $this;
    }

    /**
     * MailerPHPMailer::buildTransport()
     * 
     * @param CMap $params
     * @return mixed
     */
    protected function buildTransport(CMap $params)
    {
        if (!$params->contains('transport')) {
            $params->add('transport', 'smtp');
        }
        
        if ($params->itemAt('transport') == 'smtp') {
            return $this->buildSmtpTransport($params);
        }
        
        if ($params->itemAt('transport') == 'php-mail') {
            return $this->buildPhpMailTransport($params);
        }
        
        if ($params->itemAt('transport') == 'sendmail') {
            return $this->buildSendmailTransport($params);
        }
        
        return false;
    }
    
    /**
     * MailerPHPMailer::buildSmtpTransport()
     * 
     * @param CMap $params
     * @return mixed
     */
    protected function buildSmtpTransport(CMap $params)
    {
        $requiredKeys = array('hostname', 'username', 'password');
        $hasRequiredKeys = true;
        
        foreach ($requiredKeys as $key) {
            if (!$params->contains($key)) {
                $hasRequiredKeys = false;
                break;
            }
        }
        
        if (!$hasRequiredKeys) {
            return false;
        }
        
        if (!$params->itemAt('port')) {
            $params->add('port', 25);
        }
        
        if (!$params->itemAt('timeout')) {
            $params->add('timeout', 30);
        }
        
        $mailer = $this->getMailer();
        $mailer->isSMTP();
        $mailer->Host = $params->itemAt('hostname');
        $mailer->Port = (int)$params->itemAt('port');
        $mailer->Timeout  = (int)$params->itemAt('timeout');
        $mailer->SMTPAuth = true;
        $mailer->SMTPKeepAlive = true;
        $mailer->Username = $params->itemAt('username');
        $mailer->Password = $params->itemAt('password');

        if ($params->itemAt('protocol')) {
            $mailer->SMTPSecure = $params->itemAt('protocol'); 
        }

        return $this->_transport = $params->itemAt('transport');
    }
    
    /**
     * MailerPHPMailer::buildSendmailTransport()
     * 
     * @param CMap $params
     * @return mixed
     */
    protected function buildSendmailTransport(CMap $params)
    {
        if (!$params->contains('sendmailPath') || !function_exists('popen')) {
            return false;
        }
        
        $mailer = $this->getMailer();
        $mailer->isSendmail();
        $mailer->Sendmail = $params->itemAt('sendmailPath');
        
        return $this->_transport = $params->itemAt('transport');
    }  
    
    /**
     * MailerPHPMailer::buildPhpMailTransport()
     * 
     * @param CMap $params
     * @return mixed
     */
    protected function buildPhpMailTransport(CMap $params)
    {
        if (!function_exists('mail')) {
            return false;
        }
        
        $this->getMailer()->isMail();
        return $this->_transport = $params->itemAt('transport');
    }       
}