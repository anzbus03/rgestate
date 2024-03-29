<?php
class HybridAuthIdentity extends CUserIdentity
{
    const VERSION = '2.3.0';
 
    /**
     * 
     * @var Hybrid_Auth
     */
    public $hybridAuth;
 
    /**
     * 
     * @var Hybrid_Provider_Adapter
     */
    public $adapter;
 
    /**
     * 
     * @var Hybrid_User_Profile
     */
    public $userProfile;
 
    public $allowedProviders = array('google', 'facebook', 'linkedin', 'yahoo', 'live',);
 
    protected $config;
 
    function __construct() 
    {
        $path = Yii::getPathOfAlias('root.apps.extensions');
        require_once $path . '/hybridauth-' . self::VERSION . '/hybridauth/Hybrid/Auth.php';  //path to the Auth php file within HybridAuth folder
 
        $this->config = array(
            "base_url" => "http://rsclassify.com/", 
 
            "providers" => array(
                "Google" => array(
                    "enabled" => true,
                    "keys" => array(
                        "id" => "google client id", 
                        "secret" => "google secret",
                    ),
                    "scope" => "https://www.googleapis.com/auth/userinfo.profile " . "https://www.googleapis.com/auth/userinfo.email",
                    "access_type" => "online",
                ),  
                "Facebook" => array (
                   "enabled" => true,
                   "keys" => array ( 
                       "id" => "357776481071916", 
                       "secret" => "640691c45a26076c87c79bb355abf265",
                   ),
                   "scope" => "email"
                ),
                "Live" => array (
                   "enabled" => true,
                   "keys" => array ( 
                       "id" => "windows client id", 
                       "secret" => "Windows Live secret",
                   ),
                   "scope" => "email"
                ),
                "Yahoo" => array(
                   "enabled" => true,
                   "keys" => array ( 
                       "key" => "yahoo client id", 
                       "secret" => "yahoo secret",
                   ),
                ),
                "LinkedIn" => array(
                   "enabled" => true,
                   "keys" => array ( 
                       "key" => "linkedin client id", 
                       "secret" => "linkedin secret",
                   ),
                ),
            ),
 
            "debug_mode" => false, 
 
            // to enable logging, set 'debug_mode' to true, then provide here a path of a writable file 
            "debug_file" => "",             
        );
 
        $this->hybridAuth = new Hybrid_Auth($this->config);
    }
 
    /**
     *
     * @param string $provider
     * @return bool 
     */
    public function validateProviderName($provider)
    {
        if (!is_string($provider))
            return false;
        if (!in_array($provider, $this->allowedProviders))
            return false;
 
        return true;
    }
    public function login()
    {
		print_r( $this->userProfile);exit;
        $this->username = $this->userProfile->email;  //CUserIdentity
        print_r($this->username);echo "SDSD";exit;exit;
        Yii::app()->user->login($this, 0);
    }
 
    public function authenticate() 
    {
        return true;
    }
 
}
?>
