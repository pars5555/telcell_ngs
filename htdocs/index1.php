<?php
ini_set('display_errors',true);
error_reporting(E_ALL);
/**
 * Here we should have a small documentation.
 */
require_once("../conf/constants.php");
#$t = microtime(true);
require_once(FRAMEWORK_PATH."/Dispatcher.class.php");
$dispatcher = new Dispatcher();
#var_dump(microtime(true)-$t);
?>