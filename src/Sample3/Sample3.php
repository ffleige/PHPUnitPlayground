<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 17.07.17
 * Time: 11:42
 */

namespace FrankFleige\PHPUnitPlayground\Sample3;

/**
 * Interface Sample3
 * @package FrankFleige\PHPUnitPlayground\Sample3
 */
interface Sample3
{
    /**
     * will return the keys of all entitlements
     * @return string[]
     */
    public function getEntitlements();

    /**
     * checks if the given key is within the list of entitlements
     * @param string $key
     * @return boolean
     */
    public function isEntitledTo($key);
}