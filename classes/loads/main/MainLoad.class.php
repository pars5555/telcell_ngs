<?php

require_once (CLASSES_PATH . "/framework/AbstractLoad.class.php");

class MainLoad extends AbstractLoad {

    public function load() {
        
    }

    public function getDefaultLoads($args) {
        $loads = array();
        $loadName = "HomeLoad";
        $loads["content"]["load"] = "loads/main/" . $loadName;
        $loads["content"]["args"] = array("mainLoad" => &$this);
        $loads["content"]["loads"] = array();
        return $loads;
    }

    public function getTemplate() {
        return TEMPLATES_DIR . "/main/main.tpl";
    }


}

?>
