<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 17.07.17
 * Time: 11:30
 */

namespace FrankFleige\PHPUnitPlayground\Sample3;


class C
{
    /**
     * singleton instance of C
     * @var C
     */
    private static $singleton;

    /**
     * @var array
     */
    private $config;

    /**
     * C constructor.
     */
    public function __construct()
    {
        $this->config = include_once(__DIR__ . DIRECTORY_SEPARATOR . 'c_config.php');
    }

    /**
     * returns a singleton instance of C
     * @return C
     */
    public static function getInstance()
    {
        if (!static::$singleton) {
            static::$singleton = new static();
        }
        return static::$singleton;
    }

    /**
     * gets the configuration for a given key
     * @param string $key
     * @return mixed|null
     */
    public function getConfig($key)
    {
        return (isset($this->config[$key])) ? $this->config[$key] : null;
    }
}