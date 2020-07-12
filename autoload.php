<?php

function autoloader($class) {
    $filepath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";
    require_once APP_DIR.DIRECTORY_SEPARATOR.$filepath;
}

spl_autoload_register('autoloader');