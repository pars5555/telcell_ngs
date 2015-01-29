<?php



/**
 * <p><b>AbstractRequest class</b> is a base class for all action classes.
 * The child of this class is <b>AbstractAction.class.php,AbstractLoad.class.php</b> files. </p>
 * 
 * @author  Naghashyan Solutions, e-mail: info@naghashyan.com
 * @version 1.0
 * @package framework
 */
abstract class AbstractRequest {

    protected $args;
    protected $loadMapper;
    protected $requestGroup;

    /**
     * Return a thing based on  $loadMapper, $args parameters
     * @abstract  
     * @access
     * @param   $loadMapper, $args
     * @return
     */
    public function initialize( $loadMapper, $args) {
        $this->loadMapper = $loadMapper;       
        $this->args = $args;
    }

    /**
     * Return a thing based on $requestGroup parameter
     * @abstract  
     * @access
     * @param $requestGroup 
     * @return
     */
    public function setRequestGroup($requestGroup) {
        $this->requestGroup = $requestGroup;
    }

    public function secure($var, $defaultValue = null) {
        if (isset($var)) {
            return trim(htmlspecialchars(strip_tags($var)));
        } else {
            return $defaultValue;
        }
    }

    /**
     * Return a thing based on $dispatcher parameter
     * @abstract  
     * @access
     * @param $dispatcher 
     * @return object
     */
    public function setDispatcher($dispatcher) {
        $this->dispatcher = $dispatcher;
    }

   
    /**
     * @abstract  
     * @access
     * @param 
     * @return false
     */
    public function toCache() {
        return false;
    }

      
    /**
     * Return a thing based on $url, $isSecure parameters
     * @abstract  
     * @access
     * @param $url, $isSecure 
     * @return
     */
    protected function redirect($url, $isSecure = false) {
        $protocol = "http";
        if ($isSecure) {
            $protocol = "https";
        }
        header("location: " . $protocol . "://" . HTTP_HOST . "/$url");
        exit();
    }

    /**
     * Return a thing based on parameter
     * @abstract  
     * @access
     * @param  
     * @return
     */
    public static function notFoundHandler() {
        header("HTTP/1.0 404 Not Found");
    }

    /**
     * Return a thing based on $wrapperLoad parameter
     * @abstract  
     * @access
     * @param $wrapperLoad 
     * @return false
     */
    protected function getWrapperLoad() {
        return false;
    }


    public function setCookie($key, $value, $expire = 0) {
        $domain = "." . DOMAIN;
        setcookie($key, $value, $expire, "/", $domain);
    }

}

?>