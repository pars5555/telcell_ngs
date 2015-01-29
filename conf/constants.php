<?php
date_default_timezone_set('GMT');

define("HTTP_HOST", $_SERVER["HTTP_HOST"] . "");

//---defining document root
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);

//---defining HOMEPAGE ROOT root
$ngsRoot = DOCUMENT_ROOT;
define("NGS_ROOT", $ngsRoot);

//---defining smarty root
define("SMARTY_DIR", NGS_ROOT . "/classes/lib/smarty/");


//---defining classes paths
define("CLASSES_PATH", NGS_ROOT . "/classes");

//---defining framework path
define("FRAMEWORK_PATH", CLASSES_PATH . "/framework");

//---defining smarty paths

define("TEMPLATES_DIR", NGS_ROOT . "/templates");
define("CACHE_DIR", TEMPLATES_DIR . "/cache");
define("COMPILE_DIR", TEMPLATES_DIR . "/compile");
define("CONFIG_DIR", TEMPLATES_DIR . "/config");

//---defining data dir path
define("DATA_DIR", NGS_ROOT . "/data");

//---defining temp dir path
define("TEMP_DIR", NGS_ROOT . "/tmp");


//---defining data bin path
define("BIN_DIR", NGS_ROOT . "/bin");

//---defining interface images dir
define("IMG_ROOT_DIR", NGS_ROOT . "/htdocs/img");
define("CSS_ROOT_DIR", NGS_ROOT . "/htdocs/css");


define("LOAD_MAPPER", CLASSES_PATH."/loads/LoadMapper.class.php");

//defining load and action directories
define("LOADS_DIR", "loads");
define("ACTIONS_DIR", "actions");
?>