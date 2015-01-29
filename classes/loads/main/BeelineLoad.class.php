<?php

require_once (CLASSES_PATH . "/framework/AbstractLoad.class.php");

/**
 *
 * @author Vahagn Sookiasian
 *
 */
class BeelineLoad extends AbstractLoad {

    public function load() {
        
    }

    public function getTemplate() {
        return TEMPLATES_DIR . "/main/beeline.tpl";
    }

}

?>