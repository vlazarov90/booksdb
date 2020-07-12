<?php


namespace Extensions;

/**
 * Class Configuration
 * @package Extensions
 */
class Configuration
{
    /**
     * @param $name
     * @return mixed
     *
     * Get config by name from config folder
     */
    public static function getConfig($name)
    {
        return require_once CONFIG_DIR.DIRECTORY_SEPARATOR.$name.'.php';
    }
}