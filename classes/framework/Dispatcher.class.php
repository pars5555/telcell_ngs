<?php
if (defined("LOAD_MAPPER")) {
    require_once(LOAD_MAPPER);
}

/**
 * <p><b>Dispatcher class</b> is a base class for initilize configuration and database connection.</p>
 * <p>The main purpose of this this file is dispatching requests in the project.</p>
 * 
 * @author  Naghashyan Solutions, e-mail: info@naghashyan.com
 * @version 1.0
 * @package framework
 */
class Dispatcher {

    protected $toCache = false;
    public $loadsPackage;
    private $isAjax = false;

    /**
     * <p>In the  <b>_construct()</b> we are defining basic goals.</p>
     * <p><b>$package</b> is a folder name(for our custom case it is named "main") that we are create our class folder.</p>  
     * <p><b>$command</b> is a defauld load name,that should be loaded at the first time,when you run it in you web browser.</p>
     * 
     */
    public function __construct() {
               
        //initilize load mapper	
        if (defined("LOAD_MAPPER")) {
            $this->loadMapper = $this->newClass(LOAD_MAPPER);
        }

        $this->actionPackage = ACTIONS_DIR;
        $this->loadsPackage = LOADS_DIR;

        $command = "";
        $isAjax = false;
        $args = array();
        if (preg_match_all("/(\/([^\/]+))/", $_REQUEST["_url"], $matches)) {
            if ($matches[2][0] == "dynamic") {
                array_shift($matches[2]);

                $dynamicIndex = 9; //--/dynamic/
                $loadArr = $this->loadMapper->getDynamicLoad(substr($_REQUEST["_url"], $dynamicIndex), $matches[2]);

                if (is_array($loadArr)) {
                    $package = $loadArr["package"];
                    $command = $loadArr["command"];
                    $args = $loadArr["args"];
                } else {

                    return false;
                }
            } else {
                $package = array_shift($matches[2]);
                $command = array_shift($matches[2]);
                $args = $matches[2];

                if (isset($args[count($args) - 1])) {
                    if (preg_match("/(.+?)\.ajax/", $args[count($args) - 1], $matches1)) {
                        $this->isAjax = true;
                        $args[count($args) - 1] = $matches1[1];
                    }
                }
                $package = str_replace("_", "/", $package);
            }
        }

        $this->dispatch($package, $command, $args);
    }

    /**
     * Return a thing based on $parameter
     * @abstract  
     * @access
     * @param $isAjax 
     * @return integer|babyclass
     */
    public function setIsAjax($isAjax) {
        $this->isAjax = $isAjax;
    }

    /**
     * Return a thing based on $parameter
     * @abstract  
     * @access
     * @param $parameter 
     * @return integer|babyclass
     */
    public function isAjax() {
        return $this->isAjax;
    }

    /**
     * <p>In the <b>dispatch()</b> function you are controlling the request.</p>
     * <p>Actions are requested via a special URL patterns "http://host/dyn/actionpackage_actionInnerPackage/do_action_name".</p>
     * <p>For example, for requesting NgsExampleAction.class.php the "http://host/do_ngs_example" URL should be used.</p>
     * <p><b>"do_"</b> should be cuted and left "ngs_example".After using ucfirst() function we get "Ngs_example".</p>
     * <p>Using preg_replace() function we get "NgsExample".</p>
     * 
     * Return a thing based on $package, $command, $args parameters
     * @abstract  
     * @access
     * @param $package, $command, $args
     * @return
     */
    public function dispatch($package, $command, &$args) {
       
        $this->args = &$args;
        if ($command == "") {
            $command = "default";
        }
        $isCommand = false;
        if (strripos($command, "do_") === 0) {
            $isCommand = true;
            $command = substr($command, 3);
        }
        $command = ucfirst($command);

        function callbackhandler($matches) {
            return strtoupper(ltrim($matches[0], "_"));
        }

        $command = preg_replace_callback("/_(\w)/", "callbackhandler", $command);
        if ($command) {
            if ($isCommand) {
                $this->doAction($package, $command);
            } else {
                $this->loadPage($package, $command);
            }
        }
    }

    /**
     * <p><b>loadPage()</b>function handling load files.</p>
     * <p>In this case $loadName is defining for example "NgsExample" concatenate with "Load" word and we get "NgsExampleLoad".</p>
     *
     * Return a thing based on $package, $command, $args parameters
     * @abstract  
     * @access
     * @param $package, $command, $args
     * @return
     */
    public function loadPage($package, $command, $args = false) {

        $loadName = $command . "Load";
        $actionFileName = CLASSES_PATH . "/" . $this->loadsPackage . "/" . $package . "/" . $loadName . ".class.php";
        require_once($actionFileName);
        $loadObj = new $loadName();
        if (isset($args) && !empty($args) && is_array($args)) {
            $this->args = array_merge($this->args, $args);
        }
        $loadObj->initialize($this->loadMapper, $this->args);
        $loadObj->setDispatcher($this);
        $this->toCache = $loadObj->toCache();
        if (!$this->toCache) {
            $this->dontCache();
        }
        $loads = $this->loadMapper->getCurrentLoads();
        $loadObj->service($loads); //passing arguments

        if (!$this->toCache) {
            $this->dontCache();
        }

        $templator = $loadObj->getTemplator();
        $templator->displayResult();
    }

    /**
     * <p><b>doAction()</b>function handling action files.</p>
     * <p>In this case $actionName is defining for example "NgsExample" concatenate with "Action" word and we get "NgsExampleAction".</p>
     * 
     * Return a thing based on $package, $action parameters
     * @abstract  
     * @access
     * @param $package, $action
     * @return
     */
    private function doAction($package, $action) {
        $actionName = $action . "Action";
        $actionFileName = CLASSES_PATH . "/" . $this->actionPackage . "/" . $package . "/" . $actionName . ".class.php";
        require_once($actionFileName);
        $actionObj = new $actionName();
        $actionObj->initialize($this->loadMapper, $this->args);
        $actionObj->setDispatcher($this);
        $this->toCache = $actionObj->toCache();
        if (!$this->toCache) {
            $this->dontCache();
        }
        $actionObj->service();
    }

   

    /**
     * <p>The <b>redirect()</b> function using for redirect in some cases to the another page.</p>
     *
     * Return a thing based on $url, $isSecure parameters
     * @abstract  
     * @access
     * @param $url, $isSecure 
     * @return
     */
    public function redirect($url, $isSecure = false) {
        $protocol = "http";
        if ($isSecure) {
            $protocol = "https";
        }

        header("location: " . $protocol . "://" . $_SERVER[HTTP_HOST] . "/$url");
    }

    /**
     * <p>The <b>showNotFound()</b> function using for get <i>"404 Not Found"<i> page.</p> 
     *
     * Return a thing based on $code parameter
     * @abstract  
     * @access
     * @param $code 
     * @return
     */
    protected function showNotFound($code = 0) {
        if (!$this->loadMapper->notFoundHandler($code)) {
            header("HTTP/1.0 404 Not Found");
        }
        exit;
    }

    /**
     * Return a thing based on $parameter
     * @abstract  
     * @access
     * @param $parameter 
     * @return
     */
    protected function dontCache() {
        Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        Header("Pragma: no-cache"); // HTTP/1.0
        Header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
    }

    private function newClass($path) {
        require_once($path);
        $args = func_get_args();
        array_shift($args);
        $className = substr($path, strrpos($path, "/") + 1);
        $className = substr($className, 0, strpos($className, "."));
        $reflectionClass = new ReflectionClass($className);
        $obj = $reflectionClass->newInstanceArgs($args);

        return $obj;
    }

}

?>