<?php

require_once (CLASSES_PATH . "/framework/AbstractLoad.class.php");

/**
 *
 * @author Vahagn Sookiasian
 *
 */
class HomeLoad extends AbstractLoad{
    
    public function load() {
usleep(500000);
    }

    public function getTemplate() {
        return TEMPLATES_DIR . "/main/home.tpl";
    }

}

?>