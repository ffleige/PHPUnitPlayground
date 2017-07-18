<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 17.07.17
 * Time: 11:39
 */

namespace FrankFleige\PHPUnitPlayground\Test\Sample3;

use FrankFleige\PHPUnitPlayground\Sample3\A1;
use FrankFleige\PHPUnitPlayground\Sample3\C;
use PHPUnit\Framework\TestCase;

class A1Test extends TestCase
{
    /**
     * creates a mocked instance of A1 with the given entitlement keys
     * @param array $e array with entitlement keys
     * @return A1|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockedInstanceWithEntitlements($e) {
        $cr = $this->getMockBuilder(C::class)
            ->disableOriginalConstructor()
            ->setMethods(['getConfig'])
            ->getMock();
        $cr->expects($this::once())
            ->method('getConfig')
            ->with('entitlements')
            ->willReturn($e);
        // mock a itself
        $a = $this->getMockBuilder(A1::class)
            ->setMethods(['getConfigurationRepository'])
            ->getMock();
        $a->expects(self::once())
            ->method('getConfigurationRepository')
            ->willReturn($cr);
        /** @var A1 $a */
        $a->initEntitlements();
        return $a;
    }

    /**
     * @covers A1::getEntitlements()
     */
    public function testGetEntitlements() {
        // no entitlements
        $a = $this->getMockedInstanceWithEntitlements([]);
        $k = $a->getEntitlements();
        $this::assertInternalType("array", $k);
        $this::assertEmpty($k);
        // two entitlements
        $a = $this->getMockedInstanceWithEntitlements(['de.frankfleige.phpunit.sample3.1', 'de.frankfleige.phpunit.sample3.2']);
        $k = $a->getEntitlements();
        $this::assertInternalType("array", $k);
        $this::assertCount(2, $k);
    }

    /**
     * @covers A1::isEntitledTo()
     */
    public function testIsEntitledTo() {
        $a = $this->getMockedInstanceWithEntitlements([]);
        $this::assertFalse($a->isEntitledTo('de.frankfleige.phpunit.sample3.1'));
        $a = $this->getMockedInstanceWithEntitlements(['de.frankfleige.phpunit.sample3.1', 'de.frankfleige.phpunit.sample3.2']);
        $this::assertFalse($a->isEntitledTo('de.frankfleige.phpunit.sample3.3'));
        $this::assertTrue($a->isEntitledTo('de.frankfleige.phpunit.sample3.2'));
        $this::assertTrue($a->isEntitledTo('de.frankfleige.phpunit.sample3.1'));
    }
}
