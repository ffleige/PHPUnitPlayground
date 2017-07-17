<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 17.07.17
 * Time: 11:29
 */

namespace FrankFleige\PHPUnitPlayground\Sample3;

/**
 * Class A
 * @package FrankFleige\PHPUnitPlayground\Sample3
 */
class A implements Sample3
{
    /**
     * array with keys of entitlements
     * @var string[]
     */
    private $entitlements;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->entitlements = [];
        $this->initEntitlements();
    }

    /**
     * will init the entitlement keys
     */
    private function initEntitlements()
    {
        $this->entitlements = $this->getConfigurationRepository()->getConfig('entitlements');
    }

    /**
     * will get an instance of the configuration repository
     * @return C
     */
    public function getConfigurationRepository()
    {
        return C::getInstance();
    }

    /**
     * will return the keys of all entitlements
     * @return string[]
     */
    public function getEntitlements()
    {
        return $this->entitlements;
    }

    /**
     * will set the internal entitlements storage
     * @param string[] $entitlements array with entitlement keys
     */
    public function setEntitlements($entitlements)
    {
        $this->entitlements = $entitlements;
    }

    /**
     * checks if the given key is within the list of entitlements
     * @param string $key
     * @return boolean
     */
    public function isEntitledTo($key)
    {
        return in_array($key, $this->entitlements);
    }
}