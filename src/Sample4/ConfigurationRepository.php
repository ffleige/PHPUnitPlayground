<?php

namespace FrankFleige\PHPUnitPlayground\Sample4;

/**
 * Class ConfigurationRepository
 * This simple configuration repository represents a dependency.
 * It's possible used by ALL controllers and models in the project
 * In this example we try to give the needed configuration to the model.
 * @package FrankFleige\PHPUnitPlayground\Sample4
 */
class ConfigurationRepository
{
    public function get(string $key)
    {
        switch ($key) {
            case "host":
                return "example.com";
            case "port":
                return "80";
            default:
                return null;
        }
    }
}