<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 17.07.17
 * Time: 11:30
 */

namespace FrankFleige\PHPUnitPlayground\Sample3;

/**
 * Class B
 * @package FrankFleige\PHPUnitPlayground\Sample3
 */
class B implements Sample3
{
    /**
     * instance of the configuration repository
     * @var C
     * @Inject
     */
    private $configurationRepository;

    /**
     * internal storage of entitlement keys
     * @var string[]
     */
    private $entitlements;

    /**
     * B constructor.
     * @param C $cr instance of the configuration repository
     */
    public function __construct(C $cr)
    {
        $this->configurationRepository = $cr;
        $this->entitlements = [];
        $this->initEntitlements();
    }

    /**
     * will init the entitlement keys
     */
    private function initEntitlements()
    {
        $this->entitlements = $this->configurationRepository->getConfig('entitlements');
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
     * checks if the given key is within the list of entitlements
     * @param string $key
     * @return boolean
     */
    public function isEntitledTo($key)
    {
        return in_array($key, $this->entitlements);
    }
}