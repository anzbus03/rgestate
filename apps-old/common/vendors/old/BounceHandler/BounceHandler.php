<?php if ( ! defined('MW_PATH')) exit('No direct script access allowed');

/**
 * BounceHandler
 * 
 * This class is inspired from PHPMailer-BMH (wonderful class, very smart ideas there) 
 * which has been created by Andy Prevost (andy.prevost@worxteam.com)
 */

class BounceHandler
{
    protected static $_rules = array();
    
    protected $_connection;
    
    protected $_errors = array();
    
    protected $_results;
    
    protected $_searchResults;
    
    public $connectionString;
    
    public $username;
    
    public $password;
    
    public $searchString;
    
    public $deleteMessages = false;

    public $returnHeaders = false;
    
    public $returnBody = false;
    
    public $returnOriginalEmail = false;
    
    public $returnOriginalEmailHeadersArray = false;
    
    public $processLimit = 3000;
    
    public $processOnlyFeedbackReports = false;
    
    public $openTimeout = 10;
    
    public $readTimeout = 60;
    
    const BOUNCE_HARD = 'hard';
    
    const BOUNCE_SOFT = 'soft';
    
    const FEEDBACK_LOOP_REPORT = 'feedback-loop-report';
    
    const DIAGNOSTIC_CODE_RULES = 0;
    
    const DSN_MESSAGE_RULES = 1;
    
    const BODY_RULES = 2;
    
    const COMMON_RULES = 3;
    
    public function __construct($connectionString = null, $username = null, $password = null, array $options = array())
    {
        $this->connectionString = $connectionString;
        $this->username = $username;
        $this->password = $password;
        
        foreach ($options as $name => $value) {
            if (property_exists($this, $name)) {
                $reflection = new ReflectionProperty($this, $name);
                if ($reflection->isPublic()) {
                    $this->$name = $value;
                }
            }
        }
    }
    
    public function getErrors()
    {
        return $this->_errors;
    }
    
    public function getResults()
    {
        if ($this->_results !== null) {
            return $this->_results;
        }
        
        $searchResults = $this->getSearchResults();
        if (empty($searchResults)) {
            $this->closeConnection();
            return $this->_results = array();
        }
        
        $results = array();
        $counter = 0 ;
        
        foreach ($searchResults as $messageId) {
            
            if ($this->processLimit > 0 && $counter >= $this->processLimit) {
                break;
            }
            
            $header = imap_fetchheader($this->_connection, $messageId);
            if (empty($header)) {
                if ($this->deleteMessages) {
                    imap_delete($this->_connection, "$messageId:$messageId");
                }
                continue;
            }
            
            $result = array(
                'email'                     => null,
                'bounceType'                => self::BOUNCE_HARD,
                'action'                    => null,
                'statusCode'                => null,
                'diagnosticCode'            => 'BOUNCED BACK',
                'headers'                   => null,
                'originalEmailHeadersArray' => array(),
            );
            
            $found = false;
            if (preg_match ("/Content-Type:((?:[^\n]|\n[\t ])+)(?:\n[^\t ]|$)/is", $header, $matches)) {
                if (preg_match("/multipart\/report/is", $matches[1]) && preg_match("/report-type=[\"']?feedback-report[\"']?/is", $matches[1])) {
                    $result['bounceType']     = self::FEEDBACK_LOOP_REPORT;
                    $result['diagnosticCode'] = 'FEEDBACK LOOP REPORT';
                    $headersArray = $this->getHeadersArray($header);
                    if ($this->returnOriginalEmailHeadersArray) {
                        $result['originalEmailHeadersArray'] = array_merge($result['originalEmailHeadersArray'], $headersArray);
                    }
                    if (isset($headersArray['Feedback-Type'])) {
                        $result['diagnosticCode'] .= ' - ' . ucfirst($headersArray['Feedback-Type']);
                    } elseif ($body = $this->extractBody($messageId)) {
                        $headersArray = $this->getHeadersArray($body);
                        if ($this->returnOriginalEmailHeadersArray) {
                            $result['originalEmailHeadersArray'] = array_merge($result['originalEmailHeadersArray'], $headersArray);
                        }
                        if (isset($headersArray['Feedback-Type'])) {
                            $result['diagnosticCode'] .= ' - ' . ucfirst($headersArray['Feedback-Type']);
                        }
                    }
                    $found = true;
                }
            }
            
            // just to make sure we catch everything in the account!
            if ($this->processOnlyFeedbackReports && !$found) {
                $result['bounceType']     = self::FEEDBACK_LOOP_REPORT;
                $result['diagnosticCode'] = 'FEEDBACK LOOP REPORT';
                $found = true;
            }
            
            if (!$this->processOnlyFeedbackReports && !$found) {
                if (preg_match ("/Content-Type:((?:[^\n]|\n[\t ])+)(?:\n[^\t ]|$)/is", $header, $matches)) {
                    if (preg_match("/multipart\/report/is", $matches[1]) && preg_match("/report-type=[\"']?delivery-status[\"']?/is", $matches[1])) {
                        $result = array_merge($result, $this->processDsn($messageId));
                    } else {
                        $result = array_merge($result, $this->processBody($messageId));
                    }
                } else {
                    $result = array_merge($result, $this->processBody($messageId));
                }
            }

            // this email headers
            $result['headers'] = null;
            if ($this->returnHeaders) {
                $result['headers'] = $header;
            }
            
            // the body will also contain the original message(with headers and body!!!)
            $result['body'] = null;
            if ($this->returnBody) {
                $result['body'] = imap_body($this->_connection, $messageId);
            }
            
            // just the original message, headers and body!
            $result['originalEmail'] = null;
            if ($this->returnOriginalEmail) {
                $result['originalEmail'] = imap_fetchbody($this->_connection, $messageId, "3");
            }
            
            // this is useful for reading back custom headers sent in the original email.
            if ($this->returnOriginalEmailHeadersArray) {
                if (!($data = $result['originalEmail'])) {
                    $data = imap_fetchbody($this->_connection, $messageId, "3");
                }
                $originalHeaders = $this->getHeadersArray($data);
                if (empty($originalHeaders)) {
                    if (!($data = $result['body'])) {
                        $data = imap_body($this->_connection, $messageId);
                    }
                    $originalHeaders = $this->getHeadersArray($data);
                }
                $result['originalEmailHeadersArray'] = array_merge($result['originalEmailHeadersArray'], $originalHeaders);
            }

            $results[] = $result;
            
            if ($this->deleteMessages) {
                imap_delete($this->_connection, "$messageId:$messageId");
            }
            
            ++$counter;
        }
        
        if ($this->deleteMessages) {
            imap_expunge($this->_connection);
        }
        
        $this->closeConnection();
        return $this->_results = $results;
    }
    
    public function getHeadersArray($rawHeader)
    {
        static $cache = array();
        
        if (!is_string($rawHeader)) {
            return $rawHeader;
        }
        
        $key = sha1($rawHeader);
        if (isset($cache[$key])) {
            return $cache[$key];
        }
        
        $headers     = array();
        $headerLines = array();
        $regexes     = array(
            '/([^: ]+): (.+?(?:\r\n\s(?:.+?))*)\r\n/m', 
            '/([a-z\-\_]+): ([^\r\n]+)/sim'
        );
        
        foreach ($regexes as $regex) {
            $matched = preg_match_all($regex, $rawHeader, $headerLines);
            if ($matched && !empty($headerLines)) {
                break;
            }
        }
        
        if (!empty($headerLines[0])) {
            foreach ($headerLines[0] as $line) {
                if (strpos($line, ':') === false) {
                    continue;
                }
                $lineParts = explode(':', $line, 2);
                if (count($lineParts) != 2) {
                    continue;
                }
                list($name, $value) = $lineParts;
                $headers[$name] = trim($value);
            }
        }
        
        return $cache[$key] = $headers;
    }
    
    protected function processDsn($messageId)
    {
        $result = array();
        
        $action = $statusCode = $diagnosticCode = null;
        
        // first part of DSN (Delivery Status Notification), human-readable explanation
        $dsnMessage = imap_fetchbody($this->_connection, $messageId, "1");
        $dsnMessageStructure = imap_bodystruct($this->_connection, $messageId, "1");
        
        if ($dsnMessageStructure->encoding == 4) {
            $dsnMessage = quoted_printable_decode($dsnMessage);
        } elseif ($dsnMessageStructure->encoding == 3) {
            $dsnMessage = base64_decode($dsnMessage);
        }
        
        // second part of DSN (Delivery Status Notification), delivery-status
        $dsnReport = imap_fetchbody($this->_connection, $messageId, "2");

        if (preg_match("/Original-Recipient: rfc822;(.*)/i", $dsnReport, $matches)) {
            $emailArr = imap_rfc822_parse_adrlist($matches[1], 'default.domain.name');
            if (isset($emailArr[0]->host) && $emailArr[0]->host != '.SYNTAX-ERROR.' && $emailArr[0]->host != 'default.domain.name' ) {
                $result['email'] = $emailArr[0]->mailbox.'@'.$emailArr[0]->host;
            }
        } else if (preg_match("/Final-Recipient: rfc822;(.*)/i", $dsnReport, $matches)) {
            $emailArr = imap_rfc822_parse_adrlist($matches[1], 'default.domain.name');
            if (isset($emailArr[0]->host) && $emailArr[0]->host != '.SYNTAX-ERROR.' && $emailArr[0]->host != 'default.domain.name' ) {
                $result['email'] = $emailArr[0]->mailbox.'@'.$emailArr[0]->host;
            }
        }
        
        if (preg_match ("/Action: (.+)/i", $dsnReport, $matches)) {
            $action = strtolower(trim($matches[1]));
        }
        
        if (preg_match ("/Status: ([0-9\.]+)/i", $dsnReport, $matches)) {
            $statusCode = $matches[1];
        }
        
        // Could be multi-line , if the new line is beginning with SPACE or HTAB
        if (preg_match ("/Diagnostic-Code:((?:[^\n]|\n[\t ])+)(?:\n[^\t ]|$)/is", $dsnReport, $matches)) {
            $diagnosticCode = $matches[1];
        }
        
        if (empty($result['email'])) {
            if (preg_match ("/quota exceed.*<(\S+@\S+\w)>/is", $dsnMessage, $matches)) {
                $result['email'] = $matches[1];
                $result['bounceType'] = self::BOUNCE_SOFT;
            }
        } else {
            // "failed" / "delayed" / "delivered" / "relayed" / "expanded"
            if ($action == 'failed') {
                $rules = $this->getRules();
                $foundMatch = false;
                foreach ($rules[self::DIAGNOSTIC_CODE_RULES] as $rule) {
                    if (preg_match($rule['regex'], $diagnosticCode, $matches)) {
                        $foundMatch = true;
                        $result['bounceType'] = $rule['bounceType'];
                        break;
                    }
                }
                if (!$foundMatch) {
                    foreach ($rules[self::DSN_MESSAGE_RULES] as $rule) {
                        if (preg_match($rule['regex'], $dsnMessage, $matches)) {
                            $foundMatch = true;
                            $result['bounceType'] = $rule['bounceType'];
                            break;
                        }
                    }    
                }
                if (!$foundMatch) {
                    foreach ($rules[self::COMMON_RULES] as $rule) {
                        if (preg_match($rule['regex'], $dsnMessage, $matches)) {
                            $foundMatch = true;
                            $result['bounceType'] = $rule['bounceType'];
                            break;
                        }
                    }    
                }
                if (!$foundMatch) {
                    $result['bounceType'] = self::BOUNCE_HARD;
                }
            } else {
                $result['bounceType'] = self::BOUNCE_SOFT;
            }    
        }

        $result['action'] = $action;
        $result['statusCode'] = $statusCode;
        $result['diagnosticCode'] = $diagnosticCode;
        
        return $result;
    }
    
    protected function processBody($messageId)
    {
        $result = array();

        if (!$body = $this->extractBody($messageId)) {
            $result['bounceType'] = self::BOUNCE_HARD;
            return $result;
        }
        
        $rules = $this->getRules();
        $foundMatch = false;
        foreach ($rules[self::BODY_RULES] as $rule) {
            if (preg_match($rule['regex'], $body, $matches)) {
                $foundMatch = true;
                $result['bounceType'] = $rule['bounceType'];
                if (isset($rule['regexEmailIndex']) && isset($matches[$rule['regexEmailIndex']])) {
                    $result['email'] = $matches[$rule['regexEmailIndex']];
                }
                break;
            }
        }
        if (!$foundMatch) {
            foreach ($rules[self::COMMON_RULES] as $rule) {
                if (preg_match($rule['regex'], $body, $matches)) {
                    $foundMatch = true;
                    $result['bounceType'] = $rule['bounceType'];
                    break;
                }
            }    
        }
        if (!$foundMatch) {
            $result['bounceType'] = self::BOUNCE_HARD;
        }
                
        return $result;
    }
    
    protected function extractBody($messageId)
    {
        static $extracted = array();
        if (isset($extracted[$messageId])) {
            return $extracted[$messageId];
        }
        
        $body = null;
        $structure = imap_fetchstructure($this->_connection, $messageId);
        if (in_array($structure->type, array(0, 1))) {
            $body = imap_fetchbody($this->_connection, $messageId, "1");
            // Detect encoding and decode - only base64
            if (isset($structure->parts) && isset($structure->parts[0]) && $structure->parts[0]->encoding == 4) {
                $body = quoted_printable_decode($body);
            } elseif (isset($structure->parts) && $structure->parts[0] && $structure->parts[0]->encoding == 3) {
                $body = base64_decode($body);
            }
        } elseif ($structure->type == 2) {
            $body = imap_body($this->_connection, $messageId);
            if ($structure->encoding == 4) {
                $body = quoted_printable_decode($body);
            } elseif ($structure->encoding == 3) {
                $body = base64_decode($body);
            }
            $body = substr($body, 0, 1000);
        }
        
        return $extracted[$messageId] = $body;
    }
    
    protected function getSearchResults()
    {
        if ($this->_searchResults !== null) {
            return $this->_searchResults;
        }
        
        if (!$this->openConnection()) {
            return $this->_searchResults = array();
        }
        
        $searchString = sprintf('UNDELETED SINCE "%s"', date('d-M-Y'));
        $searchString = 'ALL';
        if (!empty($this->searchString)) {
            $searchString = $this->searchString;
        }
        
        $searchResults = imap_search($this->_connection, $searchString, null, 'UTF-8');
        if (empty($searchResults)) {
            $searchResults = array();
         }

         return $this->_searchResults = $searchResults;
    }

    protected function openConnection()
    {
        if ($this->_connection !== null) {
            return $this->_connection;
        }
        
        if (!function_exists('imap_open')) {
            $this->_errors[] = 'The IMAP extension is not enabled on this server!';
            return false;
        }
        
        if (empty($this->connectionString) || empty($this->username) || empty($this->password)) {
            $this->_errors[] = 'The connection string, username and password are required in order to open the connection!';
            return false;
        }
        
        imap_timeout(IMAP_OPENTIMEOUT, (int)$this->openTimeout);
        imap_timeout(IMAP_READTIMEOUT, (int)$this->readTimeout);
        
        $connection = @imap_open($this->connectionString, $this->username, $this->password, null, 1);
        if (empty($connection)) {
            if ($imapErrors = imap_errors()) {
                $this->_errors = array_unique(array_values((array)$imapErrors));
            } else {
                $this->_errors[] = 'Unknown error while opening the connection!';
            }
            return false;
        }
        
        $this->_connection = $connection;
        return true;
    }
    
    protected function closeConnection()
    {
        if ($this->_connection !== null) {
            @imap_close($this->_connection);
        }
    }
    
    protected function getRules()
    {
        if (!empty(self::$_rules)) {
            return self::$_rules;
        } 
        
        self::$_rules = require(dirname(__FILE__).'/rules.php');
        
        return self::$_rules;
    }
}