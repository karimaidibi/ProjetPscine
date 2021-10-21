<?php

class ControllerAcceuil{

    protected static $object='Acceuil';

    public static function readAll() {
        $view='acceuil';
        $pagetitle='acceuil';
        require_once File::build_path(array("view", "view.php"));
    }
}

?>