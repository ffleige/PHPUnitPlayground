<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 17.07.17
 * Time: 11:39
 */

namespace FrankFleige\PHPUnitPlayground\Test\Sample3;

use FrankFleige\PHPUnitPlayground\Sample3\A;
use FrankFleige\PHPUnitPlayground\Sample3\C;
use PHPUnit\Framework\TestCase;

class ATest extends TestCase
{

    public function testGetEntitlements() {
        $cr = $this->getMockBuilder(C::class)
            ->disableOriginalConstructor()
            ->setMethods(['getConfig'])
            ->getMock();
        $cr->expects($this::once())
            ->method('getConfig')
            ->with('entitlements')
            ->willReturn(['de.frankfleige.phpunit.sample3.1', 'de.frankfleige.phpunit.sample3.2']);
        // mock a itself
        $a = $this->getMockBuilder(A::class)
            ->disableOriginalConstructor()
            ->setMethods(['getConfigurationRepository'])
            ->getMock();
        /*
         * bad!
         * We have to call the (mocked) configuration repository externally within
         * our unit test. So we cannot unit test if a configuration respository
         */
        /*$a->expects(self::once())
            ->method('getConfigurationRepository')
            ->willReturn($cr);*/
        /** @var A $a */
        /** @var C $cr */
        $a->setEntitlements($cr->getConfig('entitlements'));
        $k = $a->getEntitlements();
        $this::assertInternalType("array", $k);
        $this::assertCount(2, $k);
    }

}
